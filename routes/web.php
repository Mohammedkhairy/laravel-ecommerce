<?php

Route::get('/', function () {
    return view('welcome');
});

Route::namespace ('BackEnd')->prefix('admin')->group(function () {

    Route::get('/home', 'HomeController@index');
    Route::resource('users' , 'UserController');
    Route::resource('categories' , 'CategoriesController');
    Route::resource('skills' , 'SkillsController');
    Route::resource('tags' , 'TagsController');
    Route::resource('pages' , 'PagesController');
    Route::resource('videos' , 'VideosController');
    
});

Auth::routes();

