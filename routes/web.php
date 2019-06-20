<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});


//  Test crud
Route::get('add','CarController@create');
Route::post('add','CarController@store');
Route::get('car','CarController@index');
Route::get('edit/{id}','CarController@edit');
Route::post('edit/{id}','CarController@update');
Route::delete('{id}','CarController@destroy');

Route::get('admin', function () {
    return view('admin_template');
});

// Voting
Route::get('option','OptionController@create');

Route::get('option/add','OptionController@create');
Route::post('option/add','OptionController@store');
Route::get('option','OptionController@index');
Route::get('option/edit/{id}','OptionController@edit');
Route::post('option/edit/{id}','OptionController@update');
Route::delete('option/{id}','OptionController@destroy');
