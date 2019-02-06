<?php

Route::group(['middleware' => ['api']], function () {

    Route::post('/auth/signup', 'AuthController@signup')->name('signup');
    Route::post('/auth/signin', 'AuthController@signin')->name('signin');
    Route::get('/auth/signout', 'AuthController@signout')->name('signout');

});



