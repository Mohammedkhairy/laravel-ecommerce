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

Route::namespace ('Api\Chat')->group(function () {
    Route::middleware([])->group(function () {

        Route::apiResource('chat', 'ApiChatController');
        Route::apiResource('message', 'ApiMessageController');
        Route::post('user/notification', 'ApiMessageController@getUserNotification');
        Route::post('user/messages', 'ApiMessageController@getUserMessages');
        Route::post('user/message/{id}', 'ApiMessageController@getUserMessageById');
        Route::post('user/send/message', 'ApiMessageController@getSentMessages');

    });


});


