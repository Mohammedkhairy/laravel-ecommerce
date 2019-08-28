<?php



//this route for passport only just for test
Route::namespace ('Api\Users')->middleware('auth:api')->group(function () {
    Route::get('all_users', 'ApiUserController@index');
});

Route::namespace ('Api\Users')->group(function () {
    Route::middleware('jwt')->group(function () {

        Route::apiResource('users', 'ApiUserController');
        // auth router
        Route::post('refresh', 'ApiUserController@refresh');
        Route::get('logout', 'ApiUserController@logout');
        Route::post('register', 'ApiUserController@register');

    });

    Route::post('login', 'ApiUserController@login'); 

});




