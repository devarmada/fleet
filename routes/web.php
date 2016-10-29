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

Route::get('users/{user}/add_group', ['as' => 'users.add_group', 'uses' => 'UsersController@add_group']);
Route::patch('users/{user}/store_group', ['as' => 'users.store_group', 'uses' => 'UsersController@store_group']);
Route::post('users/{user}/remove_group/{group}', ['as' => 'users.remove_group', 'uses' => 'UsersController@remove_group']);

Route::get('fleet_lists/{fleet_list}/aircrafts/{aircraft}/attachments/{attachment}/get_attachment', ['as' => 'fleet_lists.aircrafts.attachments.get_attachment', 'uses' => 'AttachmentsController@get_attachment']);

Route::model('notes', 'Attachment');
Route::model('notes', 'Note');
Route::model('aircrafts', 'Aircraft');
Route::model('fleet_lists', 'FleetList');

Route::resource('fleet_lists', 'FleetListsController');
Route::resource('fleet_lists.aircrafts', 'AircraftsController');
Route::resource('fleet_lists.aircrafts.notes', 'NotesController');
Route::resource('fleet_lists.aircrafts.attachments', 'AttachmentsController');
Route::resource('users', 'UsersController');
Route::resource('groups', 'GroupsController');

Auth::routes();

Route::get('/home', 'HomeController@index');
