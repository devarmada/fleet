<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Group;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Redirect;
use Session;

class GroupsController extends Controller
{

    protected $rules = [
      'name' => ['required']
    ];

    protected $create_rules = [
      'name' => ['unique:groups'],
    ];

    protected $user_rules = [
      'users'  => ['array', 'exists:users,id'],
    ];

    protected $user_add_rules = [
      'users'  => ['required', 'array', 'min:1'],
    ];

    protected $messages = [
      'users' => 'You must select at least one user.',
    ];

    public function __construct() {
      $this->middleware('auth');
    }

    public function index()
    {
      Session::put('backUrl', route('groups.index'));
      $user = Auth::user();
      if($user->id != 1){
        return view('common.not_authorized');
      }
      $groups = Group::where('id', '>', '1')->get();
      return view('groups.index', compact('groups'));
    }

    public function create()
    {
      $user = Auth::user();
      if($user->id != 1){
        return view('common.not_authorized');
      }
      $users = User::where('id', '>', '1' )->get();
      return view('groups.create', compact('users'));
    }

    public function store(Request $request)
    {
      $current_user = Auth::user();
      if($current_user->id != 1){
        return redirect(Session::get('backUrl'))->with('message', 'Create error: not authorized');
      }

      $this->validate($request, $this->rules);
      $this->validate($request, $this->create_rules);
      $this->validate($request, $this->user_rules);
      $input = Input::all();
      $group = Group::create($input);

      if(Input::get('users')){
        $group->users()->sync(Input::get('users'));
      }

      return redirect(Session::get('backUrl'))->with('message', 'Group created.');
    }

    public function show(Group $group)
    {
      $current_user = Auth::user();
      if($current_user->id != 1 || $group->id == 1){
        return view('common.not_authorized');
      }
      Session::put('backUrl', route('groups.show', $group));
      return view('groups.show', compact('group'));
    }

    public function edit(Group $group)
    {
      $current_user = Auth::user();
      if($current_user->id != 1 || $group->id == 1){
        return view('common.not_authorized');
      }
      $users = User::where('id', '>', '1' )->get();
      return view('groups.edit', compact('group', 'users'));
    }

    public function update(Request $request, Group $group)
    {
      $current_user = Auth::user();
      if($current_user->id != 1 || $group->id == 1){
        return redirect(Session::get('backUrl'))->with('message', 'Update error: not authorized');
      }

      $this->validate($request, $this->rules);
      $this->validate($request, $this->user_rules);
      $input = array_except(Input::all(), '_method');
      $group->update($input);

      if(Input::get('users')){
        $group->users()->sync(Input::get('users'));
      }

      return redirect(Session::get('backUrl'))->with('message', 'Group updated');
    }

    public function destroy(Group $group)
    {
      $current_user = Auth::user();
      if($current_user->id != 1 || $group->id == 1){
        return redirect(Session::get('backUrl'))->with('message', 'Update error: not authorized');
      }
      $group->delete();
      return Redirect::route('groups.index')->with('message', 'Group deleted.');
    }

    public function remove_user(Group $group, $user_id){
      $current_user = Auth::user();
      if($current_user->id != 1 || $group->id == 1 || $user_id == 1){
        return redirect(Session::get('backUrl'))->with('message', 'User removal error: not authorized');
      }

      $user = User::findOrFail($user_id);
      $group->users()->detach($user);
      return redirect(Session::get('backUrl'))->with('message', 'User removed from group');
    }

    public function add_user(Group $group) {
      $current_user = Auth::user();
      if($current_user->id != 1 || $group->id == 1){
        return view('common.not_authorized');
      }
      $users = User::where('id', '>', '1')->whereNotIn('id', $group->users->pluck('id'))->get();
      return view('groups.add_user', compact('group', 'users'));
    }

    public function store_user(Request $request, Group $group) {
      $current_user = Auth::user();
      if($current_user->id != 1 || $group->id == 1){
        return redirect(Session::get('backUrl'))->with('message', 'Update error: not authorized');
      }

      $this->validate($request, $this->user_rules);
      $this->validate($request, $this->user_add_rules, $this->messages);
      $group->users()->attach(Input::get('users'));

      return redirect(Session::get('backUrl'))->with('message', 'User(s) added');
    }
}
