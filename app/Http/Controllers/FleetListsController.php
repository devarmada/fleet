<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\FleetList;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Redirect;
use Session;

class FleetListsController extends Controller {

  protected $rules = [
    'name' => ['required'],
    'description' => ['required'],
    'user_id' => ['required'],
    'group_id' => ['required'],
  ];

  public function __construct() {
    $this->middleware('auth');
  }

  public function index() {
    Session::put('backUrl', route('fleet_lists.index'));
    $fleet_lists = FleetList::all();
    return view('fleet_lists.index', compact('fleet_lists'));
  }

  public function create() {
    $user = Auth::user();
    $groups = $user->groups;
    return view('fleet_lists.create', compact('user', 'groups'));
  }

  public function store(Request $request) {
    $this->validate($request, $this->rules);
    $input = Input::all();
    FleetList::create($input);
    return redirect(Session::get('backUrl'))->with('message', 'List created');
  }

  public function show(FleetList $fleet_list) {
    Session::put('backUrl', route('fleet_lists.show', $fleet_list));
    return view('fleet_lists.show', compact('fleet_list'));
  }

  public function edit(FleetList $fleet_list) {
    $user = Auth::user();
    $groups = $user->groups;
    return view('fleet_lists.edit', compact('fleet_list', 'user', 'groups'));
  }

  public function update(Request $request, FleetList $fleet_list) {
    $this->validate($request, $this->rules);
    $input = array_except(Input::all(), '_method');
    $fleet_list->update($input);
    return redirect(Session::get('backUrl'))->with('message', 'List updated');
  }

  public function destroy(FleetList $fleet_list) {
    $fleet_list->delete();
    //return redirect(Session::get('backUrl'))->with('message', 'List deleted');
    return Redirect::route('fleet_lists.index')->with('message', 'List deleted.');
  }

}
