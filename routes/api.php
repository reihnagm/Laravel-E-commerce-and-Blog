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

Route::group(['middleware' => ['api']], function () {

    Route::post('/auth/signup', 'AuthController@signup')->name('signup');
    Route::post('/auth/signin', 'AuthController@signin')->name('signin');
    Route::get('/auth/signout', 'AuthController@signout')->name('signout');

});



// API RESOURCE BLOG /api/blog
// Route::get('/blog', 'BlogController@index')->name('blog.index');

// get Recents Blogs
// Route::get('/blog/recents', 'BlogController@getRecentsBlog')->name('blog.recents');

// get all tags
// Route::get('/tags', 'BlogController@getTags')->name('get.tags');

// Route::post('/blog', 'BlogController@store')->name('blog.store');

// Route::put('/blog/{id}/update', 'BlogController@update')->name('blog.update');

// Route::delete('/blog/{id}', 'BlogController@destroy')->name('blog.destroy');

/*--------------------
-- API USERS /api/user
----------------------*/

// Route::get('/users_index', 'UserController@users_index');
//
// Route::get('/users_total', 'UserController@users_total');

/*-----------------------------------
-- API COMMENT BLOG /api/blog-comment
-------------------------------------*/


/*------------------------
--  API ORDERS /api/orders
--------------------------*/

// Route::get('/orders_index', 'OrderController@orders_index');
//
// Route::get('/orders/pending', 'OrderController@orders_pending');
//
// Route::get('/orders/delivered', 'OrderController@orders_delivered');
//
// Route::post('/orders/toggle/delivered/{boolean}', 'OrderController@toggleDeliver');
