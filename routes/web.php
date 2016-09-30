<?php

/*
  |--------------------------------------------------------------------------
  | Web Routes
  |--------------------------------------------------------------------------
  |
  | This file is where you may define all of the routes that are handled
  | by your application. Just tell Laravel the URIs it should respond
  | to using a Closure or controller method. Build something great!
  |
 */

Route::get('/', function () {
    return redirect()->route('fleet_lists.index');
});

Route::model('notes', 'Note');
Route::model('aircrafts', 'Aircraft');
Route::model('fleet_lists', 'FleetList');

Route::resource('fleet_lists', 'FleetListsController');
Route::resource('fleet_lists.aircrafts', 'AircraftsController');
Route::resource('fleet_lists.aircrafts.notes', 'NotesController');

Auth::routes();

Route::get('/home', 'HomeController@index');
