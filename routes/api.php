<?php

use Illuminate\Http\Request;
Use App\Episode;
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


Route::get('epidodes', function() {
    // If the Content-Type and Accept headers are set to 'application/json',
    // this will return a JSON structure. This will be cleaned up later.
    return Episode::all();
});

Route::get('epidodes/{id}', function($id) {
    return Episode::find($id);
});

Route::post('epidodes', function(Request $request) {
    return Episode::create($request->all);
});

Route::put('epidodes/{id}', function(Request $request, $id) {
    $episode = Episode::findOrFail($id);
    $episode->update($request->all());

    return $episode;
});

Route::group(['middleware' => 'auth:api'], function() {
    Route::get('epidodes', 'EpisodeController@index');
    Route::get('epidodes/{id}', 'EpisodeController@show');
    Route::post('epidodes', 'EpisodeController@store');
    Route::put('epidodes/{id}', 'EpisodeController@update');
    Route::delete('epidodes/{id}', 'EpisodeController@delete');
});

Route::post('logout', 'Auth\LoginController@logout');
