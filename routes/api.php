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
Route::get('v1/votings/{id}', 'APIVote@get_voting');
// protected endpoints
Route::group(['middleware' => 'auth:api'], function () {
    Route::get('v1/questions/{id}', 'APIVote@get_question');
    // Route::put('v1/vote/{id}', 'OptionController@api_vote');
    Route::put('v1/votes', 'APIVote@api_votes');

 });
