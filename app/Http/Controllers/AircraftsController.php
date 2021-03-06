<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use App\Note;
use App\Aircraft;
use App\FleetList;
use Redirect;
use Session;

class AircraftsController extends Controller {

  protected $rules = [
    'model' => ['required'],
    'year' => ['required', 'numeric'],
    'description' => ['required'],
    'user_id' => ['required'],
  ];

  public function __construct() {
    $this->middleware('auth');
  }

  public function index(FleetList $fleet_list) {
    $current_user = Auth::user();
    if(!$fleet_list->is_accessible_by($current_user)){
      return view('common.not_authorized');
    }
    Session::put('backUrl', route('fleet_lists.aircrafts.index', $fleet_list));
    return view('fleet_lists.show', compact('fleet_list'));
  }

  public function create(FleetList $fleet_list) {
    $current_user = Auth::user();
    if(!$fleet_list->is_accessible_by($current_user)){
      return view('common.not_authorized');
    }
    return view('aircrafts.create', compact('current_user', 'fleet_list'));
  }

  public function store(FleetList $fleet_list, Request $request) {
    $current_user = Auth::user();
    if(!$fleet_list->is_accessible_by($current_user)){
      return redirect(Session::get('backUrl'))->withErrors('Create error: not authorized');
    }
    $this->validate($request, $this->rules);
    $input = Input::all();
    Aircraft::create($input);
    return Redirect::route('fleet_lists.show', $fleet_list)->with('message', 'Aircraft created.');
  }

  public function show(FleetList $fleet_list, Aircraft $aircraft) {
    $user = Auth::user();
    if($fleet_list != $aircraft->fleet_list || !$fleet_list->is_accessible_by($user)){
      return view('common.not_authorized');
    }
    Session::put('backUrl', route('fleet_lists.aircrafts.show', array($fleet_list, $aircraft, $user)));
    return view('aircrafts.show', compact('fleet_list', 'aircraft', 'user'));
  }

  public function edit(FleetList $fleet_list, Aircraft $aircraft) {
    $current_user = Auth::user();
    if($fleet_list->id != $aircraft->fleet_list->id || !$fleet_list->is_accessible_by($current_user)){
      return view('common.not_authorized');
    }
    return view('aircrafts.edit', compact('current_user', 'fleet_list', 'aircraft'));
  }

  public function update(Request $request, FleetList $fleet_list, Aircraft $aircraft) {
    $current_user = Auth::user();
    if($fleet_list->id != $aircraft->fleet_list->id || !$fleet_list->is_accessible_by($current_user)){
      return redirect(Session::get('backUrl'))->withErrors('Update error: not authorized');
    }
    $this->validate($request, $this->rules);
    $input = array_except(Input::all(), '_method');
    $aircraft->update($input);
    return redirect(Session::get('backUrl'))->with('message', 'Aircraft updated');
  }

  public function destroy(FleetList $fleet_list, Aircraft $aircraft) {
    $current_user = Auth::user();
    if($fleet_list->id != $aircraft->fleet_list->id || !$fleet_list->is_accessible_by($current_user)){
      return redirect (Session::get('backUrl'))->withErrors('Delete error: not authorized');
    }
    try {
      $aircraft->delete();
    } catch (QueryException $e) {
      $msg = $e->getMessage();
      if($e->getcode() == "23000"){
        $msg = "this aircraft has notes and/or attachments connected.";
      }
      return redirect (Session::get('backUrl'))->withErrors('Delete error: ' . $msg);
    }
    return Redirect::route('fleet_lists.show', $fleet_list->id)->with('message', 'Aircraft deleted.');
  }

}
