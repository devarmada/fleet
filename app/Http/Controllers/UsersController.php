<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\User;
use App\Group;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Redirect;
use Session;

class UsersController extends Controller
{

    protected $rules = [
      'name' => ['required'],
      'email' => ['required', 'email'],
    ];

    protected $group_rules = [
      'groups'  => ['required', 'array', 'min:1', 'exists:groups,id'],
    ];

    protected $create_rules = [
      'name' => ['unique:users'],
      'email' => ['unique:users'],
    ];

    protected $messages = [
      'groups' => 'You must select at least one group.',
    ];

    public function __construct() {
      $this->middleware('auth');
    }

    public function index() {
      Session::put('backUrl', route('users.index'));
      $current_user = Auth::user();
      if(!$current_user->is_admin()){
        return view('common.not_authorized');
      }
      $users = User::get_regular_users();
      return view('users.index', compact('users'));
    }

    public function create() {
      $current_user = Auth::user();
      if(!$current_user->is_admin()){
        return view('common.not_authorized');
      }
      $groups = Group::all();
      return view('users.create', compact('groups'));
    }

    public function store(Request $request) {
      $current_user = Auth::user();
      if(!$current_user->is_admin()){
        return redirect(Session::get('backUrl'))->withErrors('Create error: not authorized');
      }

      $this->validate($request, $this->rules, $this->messages);
      $this->validate($request, $this->group_rules, $this->messages);
      $this->validate($request, $this->create_rules, $this->messages);
      $input = Input::all();
      $user = User::create($input);

      $user->groups()->sync(Input::get('groups'));

      $token = hash_hmac('sha256', str_random(40), config('app.key'));
      DB::table('password_resets')->insert(['email' => $input['email'], 'token' => $token]);
      Mail::send('users.welcomemail', ['user' => $user, 'token' => $token],
                 function ($message) use ($input) {
                    $message->from(config('mail.from')['address'], config('mail.from')['name']);
                    $message->to($input['email'], $input['name'])->subject('Welcome to ' .config('app.name'));
                 });

      return redirect(Session::get('backUrl'))->with('message', 'User created. A welcome email has been sent to the user.');
    }

    public function show(User $user) {
      $current_user = Auth::user();
      if(!$current_user->is_admin()){
        return view('common.not_authorized');
      }
      Session::put('backUrl', route('users.show', $user));
      return view('users.show', compact('user'));
    }

    public function edit(User $user) {
      $current_user = Auth::user();
      if(!$current_user->is_admin() || $user->is_native_admin()){
        return view('common.not_authorized');
      }
      $groups = Group::all();
      return view('users.edit', compact('user', 'groups'));
    }

    public function update(Request $request, User $user) {
      $current_user = Auth::user();
      if(!$current_user->is_admin() || $user->is_native_admin()){
        return redirect(Session::get('backUrl'))->withErrors('Update error: not authorized');
      }

      $this->validate($request, $this->rules, $this->messages);
      $this->validate($request, $this->group_rules, $this->messages);
      $input = array_except(Input::all(), '_method');
      $user->update($input);

      $user->groups()->sync(Input::get('groups'));

      return redirect(Session::get('backUrl'))->with('message', 'User updated');
    }

    public function destroy(User $user)
    {
      $current_user = Auth::user();
      if(!$current_user->is_admin() || $user->is_native_admin() || $current_user->id == $user->id){
        return redirect(Session::get('backUrl'))->withErrors('Delete error: not authorized');
      }
      $user->delete();
      return Redirect::route('users.index')->with('message', 'User deleted.');
    }

    public function remove_group(User $user, $group_id){
      $current_user = Auth::user();
      if(!$current_user->is_admin() || $user->is_native_admin()){
        return redirect(Session::get('backUrl'))->withErrors('Group removal error: not authorized');
      }

      if($user->groups()->count() < 2){
        return redirect(Session::get('backUrl'))->withErrors('Group removal error: cannot remove the only group the user belongs to');
      }

      $group = Group::findOrFail($group_id);
      $user->groups()->detach($group);
      return redirect(Session::get('backUrl'))->with('message', 'Group association removed');
    }

    public function add_group(User $user) {
      $current_user = Auth::user();
      if(!$current_user->is_admin() || $user->is_native_admin()){
        return view('common.not_authorized');
      }
      $groups = Group::get_groups_but($user->groups);
      return view('users.add_group', compact('user', 'groups'));
    }

    public function store_group(Request $request, User $user) {
      $current_user = Auth::user();
      if(!$current_user->is_admin() || $user->is_native_admin()){
        return redirect(Session::get('backUrl'))->withErrors('Update error: not authorized');
      }

      $this->validate($request, $this->group_rules, $this->messages);
      $user->groups()->attach(Input::get('groups'));

      return redirect(Session::get('backUrl'))->with('message', 'Group(s) added');
    }
}
