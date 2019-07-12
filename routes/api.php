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
// protected endpoints
Route::group(['middleware' => 'auth:api'], function () {
    Route::get('v1/questions/{id}', 'QuestionController@api_get_question');
    Route::get('v1/votings/{id}', 'VotingController@api_get_voting');
    Route::put('v1/vote/{id}', 'OptionController@api_vote');
 });
