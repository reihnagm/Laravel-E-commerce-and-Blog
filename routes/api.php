<?php

use Illuminate\Http\Request;

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
    Route::post('/auth/signup', 'AuthController@signup');
    Route::post('/auth/signin', 'AuthController@signin');

    // Route::group(['middleware' => ['jwt.auth']], function() {
    //   Route::get('/profile', )
    // })
    // }
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

// API RESOURCE COMMENT BLOG
// Route::get('/blog-comment','BlogCommentController@index')->name('blog.comment.index');

// Route::post('/blog-comment/{id}', 'BlogCommentController@store')->name('blog.comment.store');

// Route::put('/blog-comment/{id}/update', 'BlogCommentController@update')->name('blog.comment.update');

// Route::delete('/blog-comment/{id}','BlogCommentController@destroy')->name('blog.comment.destroy');