<?php

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

Route::namespace ('Api\Users')->group(function () {
    Route::middleware('AccessToken')->group(function () {
        Route::resource('users', 'ApiUserController');
    });
    Route::post('login', 'ApiUserController@login');
    Route::post('register', 'ApiUserController@register');
});
