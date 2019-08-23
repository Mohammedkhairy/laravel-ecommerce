<?php

Route::get('/', function () {
    // \Artisan::call('websockets:serve');
    return view('welcome');
});
Route::get('/home', 'HomeController@index');

Route::namespace ('BackEnd')->prefix('admin')->group(function () {

    Route::get('/home', 'HomeController@index');
    Route::resource('users' , 'UserController');
    Route::resource('categories' , 'CategoriesController');
    Route::resource('skills' , 'SkillsController');
    Route::resource('tags' , 'TagsController');
    Route::resource('pages' , 'PagesController');
    Route::resource('videos' , 'VideosController');
    Route::resource('comments' , 'CommentsController');

});

Auth::routes();

