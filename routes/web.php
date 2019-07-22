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

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::group(['middleware' => 'custom_auth'], function () {
    
    Route::get('/', function () {
        return redirect('voting');
    });

    Route::get('admin', function () {
        return view('admin_template');
    });

    // option
    Route::get('option/add','OptionController@create');
    Route::post('option/add','OptionController@store');
    Route::get('option','OptionController@index');
    Route::get('option/edit/{id}','OptionController@edit');
    Route::post('option/edit/{id}','OptionController@update');
    Route::delete('option/{id}','OptionController@destroy');

    Route::post('ajax/option/add','OptionController@ajax_store');



    // question
    Route::get('question/add','QuestionController@create');
    Route::post('question/add','QuestionController@store');
    Route::get('question','QuestionController@index');
    Route::get('question/edit/{id}','QuestionController@edit');
    Route::post('question/edit/{id}','QuestionController@update');
    Route::delete('question/{id}','QuestionController@destroy');
    Route::get('question/search','QuestionController@search');

    // Route::get('api/v1/question/add','QuestionController@apicreate');
    // Route::post('api/v1/question/add','QuestionController@apistore');
    // Route::get('api/v1/question','QuestionController@apiindex');
    // Route::get('api/v1/question/edit/{id}','QuestionController@apiedit');
    // Route::post('api/v1/question/edit/{id}','QuestionController@apiupdate');
    // Route::delete('api/v1/question/{id}','QuestionController@apidestroy');
    // Route::get('api/v1/question/search','QuestionController@apisearch');


    // Voting
    Route::get('voting/add','VotingController@create');
    Route::post('voting/add','VotingController@store');
    Route::get('voting','VotingController@index');
    Route::get('voting/edit/{id}','VotingController@edit');
    Route::post('voting/edit/{id}','VotingController@update');
    Route::delete('voting/{id}','VotingController@destroy');
    Route::get('voting/search','VotingController@search');

    Route::get('voting/get/{id}','VotingController@api_get_voting');

    // Route::get('api/v1/voting/add','VotingController@apicreate');
    // Route::post('api/v1/voting/add','VotingController@apistore');
    // Route::get('api/v1/voting','VotingController@apiindex');
    // Route::get('api/v1voting/edit/{id}','VotingController@apiedit');
    // Route::post('api/v1/voting/edit/{id}','VotingController@apiupdate');
    // Route::delete('api/v1/voting/{id}','VotingController@apidestroy');
    // Route::get('api/v1/voting/search','VotingController@apisearch');

    // Iframe
    // Route::get('iframe/voting/{id}','VotingController@show');
    // Route::get('iframe/question/{id}','QuestionController@show');

});




