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
    return view('default');
});

Route::model('aircrafts', 'Aircraft');
Route::model('fleet_lists', 'FleetList');

/*Route::bind('lists', function($id, $route) {
    dd($id);
    return App\FleetList::find($id);
});
Route::bind('aircrafts', function($id, $route) {
    return App\Aircraft::find($id);
});*/

Route::resource('fleet_lists', 'FleetListsController');
Route::resource('fleet_lists.aircrafts', 'AircraftsController');
