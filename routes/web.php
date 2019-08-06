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
Route::middleware('auth:api')
    ->get('/user', function (Request $request) {
        return $request->user();
    });
Route::post('register', 'Auth\RegisterController@register');
Route::post('login', 'Auth\LoginController@login');