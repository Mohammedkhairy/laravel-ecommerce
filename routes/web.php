<?php

Route::get('/', function () {
    return view('welcome');
});

Route::namespace ('BackEnd')->prefix('admin')->group(function () {

    Route::get('/', 'HomeController@index');
    Route::get('/home', 'HomeController@index');
    Route::resource('users' , 'UserController');
    
});

Auth::routes();

