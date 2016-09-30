<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Support\Facades\Auth;
use App\Note;
use App\Aircraft;
use App\FleetList;
use Session;

class NotesController extends Controller
{
      protected $rules = [
      'title' => ['required'],
      'user_id' => ['required'],
    ];

    public function __construct() {
      $this->middleware('auth');
    }

    public function index(FleetList $fleet_list, Aircraft $aircraft){
      $user = Auth::user();
      if(!$fleet_list->is_accessible_by($user)){
        return view('common.not_authorized');
      }
      Session::put('backUrl', route('fleet_lists.aircrafts.notes.index', [$fleet_list, $aircraft]));
      return view('aircrafts.show', compact('fleet_list','aircraft'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

   public function show(FleetList $fleet_list, Aircraft $aircraft, Note $note) {
       $user = Auth::user();
       if($aircraft != $note->aircraft || $fleet_list != $aircraft->fleet_list || !$fleet_list->is_accessible_by($user)){
         return view('common.not_authorized');
       }
       Session::put('backUrl', route('fleet_lists.aircrafts.notes.show', array($fleet_list, $aircraft, $note)));
       return view('notes.show', compact('fleet_list', 'aircraft', 'note'));
     }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
