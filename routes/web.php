<?php

Auth::routes();

Route::get('/', 'AppController@index')->name('app.index');

// Admin route
Route::prefix('admin')->group(function () {
    Route::get('/login', 'Auth\AdminLoginController@showLoginForm')->name('admin.login');
    Route::post('/login', 'Auth\AdminLoginController@login')->name('admin.login.submit');
    Route::get('/', 'AdminController@index')->name('admin.dashboard');
    Route::get('/logout', 'Auth\AdminLoginController@logout')->name('admin.logout');

    // Password reset route
    Route::post('/password/email', 'Auth\AdminForgotPasswordController@sendResetLinkEmail')->name('admin.password.email');
    Route::get('/password/reset', 'Auth\AdminForgotPasswordController@showLinkRequestForm')->name('admin.password.request');
    Route::post('/password/reset', 'Auth\AdminResetPasswordController@reset');
    Route::get('/password/reset/{token}', 'Auth\AdminResetPasswordController@showResetForm')->name('admin.password.reset');
});

// Admin orders
Route::group(['middleware' => 'auth:admin', 'prefix' => 'admin'], function() {
    Route::get('/orders', 'OrderController@orders')->name('orders');
    Route::post('/orders/toggle/delivered/{boolean}', 'OrderController@toggleDeliver')->name('toggle.deliver');
});

// Social auth login
Route::get('/redirect/{service}', 'SocialAuthController@redirect');
Route::get('/callback/{service}', 'SocialAuthController@callback');
Route::get('/social/account/logout', 'SocialAuthController@logout');

// User profile
Route::get('/profile/{id?}', 'UserController@profile')->name('user.profile');

// Product
Route::resource('/product', 'ProductController');

// Cart
Route::post('/switchToSaveForLater/{product}', 'CartController@switchToSaveForLater')->name('cart.ToSaveForLater');
Route::resource('/cart', 'CartController');
Route::get('cart/addCart/{productId}', 'CartController@addCart')->name('cart.add');
Route::get('/emptySaveForLater', function() {
  Cart::instance('saveForLater')->destroy();
  return back();
});

// SISTEM SEARCH
Route::get('/blog&product','AppController@blogProductSearch')->name('blog.and.product.search');

// SISTEM FILTER 
Route::get('/blog/filter/{id}', 'AppController@blogFilter')->name('blog.filter');
Route::get('/product/filter/{id}','AppController@productFilter')->name('product.filter');

// Blog
Route::resource('/blog', 'BlogController');

// Address
Route::group(['middleware' => 'auth'], function() {
  Route::resource('/address', 'AddressController');
});

// Payment
Route::get('/payment', 'PaymentController@index')->name('payment.index');
Route::post('/payment/store', 'PaymentController@store')->name('payment.store');

// Notification Blog
Route::get('/notification', 'NotificationController@get');
Route::post('/notification/{id}', 'NotificationController@markAsRead');

// Like & Unlike
Route::get('/like/{model}/{type}', 'LikeController@like');
Route::get('/unlike/{model}/{type}', 'UnlikeController@unlike');

// Emotion
Route::get('/emotion', 'EmotionController@index');
Route::get('/emotion/{id}', 'EmotionController@create');
Route::get('/emotion/emotionid/{emotionid}/blogid/{blogid}','EmotionController@saveEmotion');

// Route::get('/{checkout?}', function() {
//   return view('homepage/home');
// })->where('checkout', '[V\w\.-]*'); // fix mode vue router history use Laravel
