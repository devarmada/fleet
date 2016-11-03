<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use App\Note;
use App\Aircraft;
use App\FleetList;
use Redirect;
use Session;

class NotesController extends Controller
{
    protected $rules = [
      'title' => ['required'],
      'aircraft_id' => ['required'],
      'user_id' => ['required'],
    ];

    public function __construct() {
      $this->middleware('auth');
    }

    public function index(FleetList $fleet_list, Aircraft $aircraft){
      $current_user = Auth::user();
      if(!$fleet_list->is_accessible_by($current_user)){
        return view('common.not_authorized');
      }
      Session::put('backUrl', route('fleet_lists.aircrafts.notes.index', [$fleet_list, $aircraft]));
      return view('aircrafts.show', compact('fleet_list', 'aircraft', 'user'));
    }

    public function create(FleetList $fleet_list, Aircraft $aircraft) {
      $current_user = Auth::user();
      if(!$fleet_list->is_accessible_by($current_user)){
        return view('common.not_authorized');
      }
      return view('notes.create', compact('current_user', 'fleet_list', 'aircraft'));
    }

    public function store(FleetList $fleet_list, Aircraft $aircraft, Request $request) {
      $current_user = Auth::user();
      if(!$fleet_list->is_accessible_by($current_user)){
        return redirect(Session::get('backUrl'))->withErrors('Create error: not authorized');
      }
      $this->validate($request, $this->rules);
      $input = Input::all();
      Note::create($input);
      return Redirect::route('fleet_lists.aircrafts.show', [$fleet_list, $aircraft, $user])->with('message', 'Note created.');
    }

    public function show(FleetList $fleet_list, Aircraft $aircraft, Note $note) {
       $current_user = Auth::user();
       if($aircraft->id != $note->aircraft->id || $fleet_list->id != $aircraft->fleet_list->id || !$fleet_list->is_accessible_by($current_user)){
         return view('common.not_authorized');
       }
       Session::put('backUrl', route('fleet_lists.aircrafts.notes.show', array($fleet_list, $aircraft, $note, $current_user)));
       return view('notes.show', compact('fleet_list', 'aircraft', 'note', 'current_user'));
    }

    public function edit(FleetList $fleet_list, Aircraft $aircraft, Note $note) {
       $current_user = Auth::user();
       if($aircraft->id != $note->aircraft->id || $fleet_list->id != $aircraft->fleet_list->id || !$fleet_list->is_accessible_by($current_user) || !$note->is_accessible_by($current_user)){
         return view('common.not_authorized');
       }
       return view('notes.edit', compact('current_user', 'fleet_list', 'aircraft', 'note'));
    }

    public function update(Request $request, FleetList $fleet_list, Aircraft $aircraft, Note $note) {
       $current_user = Auth::user();
       if($aircraft->id != $note->aircraft->id || $fleet_list->id != $aircraft->fleet_list->id || !$fleet_list->is_accessible_by($current_user) || !$note->is_accessible_by($current_user)){
         return redirect(Session::get('backUrl'))->withErrors('Update error: not authorized');
       }
       $this->validate($request, $this->rules);
       $input = array_except(Input::all(), '_method');
       $note->update($input);
       return redirect(Session::get('backUrl'))->with('message', 'Note updated');
    }

    public function destroy(FleetList $fleet_list, Aircraft $aircraft, Note $note) {
       $current_user = Auth::user();
       if($aircraft->id != $note->aircraft->id || $fleet_list->id != $aircraft->fleet_list->id || !$fleet_list->is_accessible_by($current_user) || !$note->is_accessible_by($current_user)){
         return redirect (Session::get('backUrl'))->withErrors('Delete error: not authorized');
       }
       $note->delete();
       return Redirect::route('fleet_lists.aircrafts.show', [$fleet_list->id, $aircraft->id, $current_user])->with('message', 'Note deleted.');
    }

}
