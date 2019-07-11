<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

// protected endpoints
Route::group(['middleware' => 'auth:api'], function () {
    Route::get('v1/questions', 'QuestionController@index');
    // more endpoints ...
 });
Route::get('/hello', function () {
    return ':)';
});