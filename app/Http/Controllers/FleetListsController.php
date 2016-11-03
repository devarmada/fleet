<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\FleetList;
use Illuminate\Database\QueryException;
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
    $current_user = Auth::user();
    $fleet_lists = FleetList::get_all_visible($current_user);
    return view('fleet_lists.index', compact('fleet_lists'));
  }

  public function create() {
    $current_user = Auth::user();
    $groups = $current_user->get_allowed_groups();
    return view('fleet_lists.create', compact('current_user', 'groups'));
  }

  public function store(Request $request) {
    $this->validate($request, $this->rules);
    $input = Input::all();
    FleetList::create($input);
    return redirect(Session::get('backUrl'))->with('message', 'List created');
  }

  public function show(FleetList $fleet_list) {
    $current_user = Auth::user();
    if(!$fleet_list->is_accessible_by($current_user)){
      return view('common.not_authorized');
    }
    Session::put('backUrl', route('fleet_lists.show', $fleet_list));
    return view('fleet_lists.show', compact('fleet_list'));
  }

  public function edit(FleetList $fleet_list) {
    $current_user = Auth::user();
    if(!$fleet_list->is_accessible_by($current_user)){
      return view('common.not_authorized');
    }
    $groups = $current_user->get_allowed_groups();
    return view('fleet_lists.edit', compact('fleet_list', 'current_user', 'groups'));
  }

  public function update(Request $request, FleetList $fleet_list) {
    $current_user = Auth::user();
    if(!$fleet_list->is_accessible_by($current_user)){
      return redirect(Session::get('backUrl'))->withErrors('Update error: not authorized');
    }
    $this->validate($request, $this->rules);
    $input = array_except(Input::all(), '_method');
    $fleet_list->update($input);
    return redirect(Session::get('backUrl'))->with('message', 'List updated');
  }

  public function destroy(FleetList $fleet_list) {
    $current_user = Auth::user();
    if(!$fleet_list->is_accessible_by($current_user)){
      return redirect(Session::get('backUrl'))->withErrors('Delete error: not authorized');
    }
    try {
      $fleet_list->delete();
    } catch (QueryException $e) {
      $msg = $e->getMessage();
      if($e->getcode() == "23000"){
        $msg = "this list is not empty.";
      }
      return redirect (Session::get('backUrl'))->withErrors('Delete error: ' . $msg);
    }
    return Redirect::route('fleet_lists.index')->with('message', 'List deleted.');
  }

}
