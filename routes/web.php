<?php

// AUTH
Auth::routes();

// ADMIN VOYAGER
Route::group(["middleware" => "admin", "prefix" => "admin"], function () {

    // VOYAGER ROUTE
    Voyager::routes();

    // NAMESPACE
    $namespacePrefix = '\\'.config('voyager.controllers.namespace').'\\';

    Route::group([
            'as'     => 'crud.',
            'prefix' => 'crud',
    ], function () use ($namespacePrefix) {
        Route::get('/', ['uses' => $namespacePrefix.'VoyagerBreadController@index', 'as' => 'index']);
        Route::get('{table}/create', $namespacePrefix.'VoyagerBreadController@create')->name('crud.create');
        Route::post('/', $namespacePrefix.'VoyagerBreadController@store')->name('crud.store');
        Route::get('{table}/edit', ['uses' => $namespacePrefix.'VoyagerBreadController@edit', 'as' => 'edit']);
        Route::put('{id}', $namespacePrefix.'VoyagerBreadController@update')->name('crud.update');
        Route::delete('{id}', ['uses' => $namespacePrefix.'VoyagerBreadController@destroy',  'as' => 'delete']);
        Route::post('relationship', ['uses' => $namespacePrefix.'VoyagerBreadController@addRelationship',  'as' => 'relationship']);
        Route::get('delete_relationship/{id}', ['uses' => $namespacePrefix.'VoyagerBreadController@deleteRelationship',  'as' => 'delete_relationship']);
    });

    Route::group([
        'as'     => 'documentation.',
        'prefix' => 'documentation',
    ], function () use ($namespacePrefix) {
        Route::get('/', ['uses' => $namespacePrefix.'VoyagerCompassController@index',  'as' => 'index']);
        Route::post('/', $namespacePrefix.'VoyagerCompassController@index')->name('documentation.post');
    });

    Route::post('/users', $namespacePrefix .'VoyagerBaseController@store')->name('voyager.users.store');
    Route::get('/users', $namespacePrefix .'VoyagerBaseController@index')->name('voyager.users.index');
    Route::get('/users/create', $namespacePrefix .'VoyagerBaseController@create')->name('voyager.users.create');
    Route::get('/users/order', $namespacePrefix .'VoyagerBaseController@order')->name('voyager.users.order');
    Route::post('/users/order', $namespacePrefix .'VoyagerBaseController@update_order')->name('voyager.users.order');
    Route::get('/users/{id}', $namespacePrefix .'VoyagerBaseController@show')->name('voyager.users.show');
    Route::delete('/users/{id}', $namespacePrefix .'VoyagerBaseController@destroy')->name('voyager.users.destroy');

    Route::post('/blogs', $namespacePrefix .'VoyagerBaseController@store')->name('voyager.blogs.store');
    Route::get('/blogs', $namespacePrefix .'VoyagerBaseController@index')->name('voyager.blogs.index');
    Route::get('/blogs/create', $namespacePrefix .'VoyagerBaseController@create')->name('voyager.blogs.create');
    Route::get('/blogs/order', $namespacePrefix .'VoyagerBaseController@order')->name('voyager.blogs.order');
    Route::post('/blogs/order', $namespacePrefix .'VoyagerBaseController@update_order')->name('voyager.blogs.order');
    Route::get('/blogs/{id}', $namespacePrefix .'VoyagerBaseController@show')->name('voyager.blogs.show');
    Route::delete('/blogs/{id}', $namespacePrefix .'VoyagerBaseController@destroy')->name('voyager.blogs.destroy');

    Route::post('/tags', $namespacePrefix .'VoyagerBaseController@store')->name('voyager.tags.store');
    Route::get('/tags', $namespacePrefix .'VoyagerBaseController@index')->name('voyager.tags.index');
    Route::get('/tags/create', $namespacePrefix .'VoyagerBaseController@create')->name('voyager.tags.create');
    Route::get('/tags/order', $namespacePrefix .'VoyagerBaseController@order')->name('voyager.tags.order');
    Route::post('/tags/order', $namespacePrefix .'VoyagerBaseController@update_order')->name('voyager.tags.order');
    Route::get('/tags/{id}', $namespacePrefix .'VoyagerBaseController@show')->name('voyager.tags.show');
    Route::delete('/tags/{id}', $namespacePrefix .'VoyagerBaseController@destroy')->name('voyager.tags.destroy');

    Route::post('/products', $namespacePrefix .'VoyagerBaseController@store')->name('voyager.products.store');
    Route::get('/products', $namespacePrefix .'VoyagerBaseController@index')->name('voyager.products.index');
    Route::get('/products/create', $namespacePrefix .'VoyagerBaseController@create')->name('voyager.products.create');
    Route::get('/products/order', $namespacePrefix .'VoyagerBaseController@order')->name('voyager.products.order');
    Route::post('/products/order', $namespacePrefix .'VoyagerBaseController@update_order')->name('voyager.products.order');
    Route::get('/products/{id}', $namespacePrefix .'VoyagerBaseController@show')->name('voyager.products.show');
    Route::delete('/products/{id}', $namespacePrefix .'VoyagerBaseController@destroy')->name('voyager.products.destroy');

    Route::post('/category', $namespacePrefix .'VoyagerBaseController@store')->name('voyager.category.store');
    Route::get('/category', $namespacePrefix .'VoyagerBaseController@index')->name('voyager.category.index');
    Route::get('/category/create', $namespacePrefix .'VoyagerBaseController@create')->name('voyager.category.create');
    Route::get('/category/order', $namespacePrefix .'VoyagerBaseController@order')->name('voyager.category.order');
    Route::post('/category/order', $namespacePrefix .'VoyagerBaseController@update_order')->name('voyager.category.order');
    Route::get('/category/{id}', $namespacePrefix .'VoyagerBaseController@show')->name('voyager.category.show');
    Route::delete('/category/{id}', $namespacePrefix .'VoyagerBaseController@destroy')->name('voyager.category.destroy');
});

// APP INDEX
Route::get('/', 'HomeController@index')->name('home');

//     Route::get('/orders', 'OrderController@orders')->name('admin.orders');
//     Route::post('/orders/toggle/delivered/{boolean}', 'OrderController@toggleDeliver')->name('toggle.deliver');
// });

// SOCIALITE
Route::get('/redirect/{service}', 'SocialAuthController@redirect');
Route::get('/callback/{service}', 'SocialAuthController@callback');
Route::get('/social/account/logout', 'SocialAuthController@logout')->name('social.logout');

// USER PROFILE
Route::get('/profile/{id?}', 'UserController@profile')->name('user.profile');
Route::get('/profile/{id}/info', 'UserController@info')->name('user.statistic');
Route::post('/user/uploadTinymce', 'UserController@uploadTinymce')->name('user.uploadtinymce');

// PRODUCT
Route::resource('/product', 'ProductController');

// CART
Route::resource('/cart', 'CartController');
Route::post('/cart/addCart', 'CartController@addCart')->name('cart.add');
Route::post('/move_to_cart/{id}', 'CartController@moveToCart')->name('move.to.cart');
Route::post('/switchToSaveForLater/{id}', 'CartController@switchToSaveForLater')->name('cart.saveForLater');
Route::get('/emptySaveForLater', 'CartController@emptySaveForLater')->name('empty.saveForLater');

// SEARCH BASED ON PRODUCT
Route::get('/blog&product', 'HomeController@blogProductSearch')->name('blog.and.product.search');

// SEARCH BASED ON CATEGORIES
Route::get('/blog/filter/{id}', 'HomeController@blogFilter')->name('blog.filter');
Route::get('/product/filter/{id}', 'HomeController@productFilter')->name('product.filter');

// BLOG
Route::resource('/blog', 'BlogController');

// BLOG COMMENT
Route::get('/blog_comment/{id}', 'BlogCommentController@index')->name('blog.comment.index');

Route::post('/blog_comment/{id}/{user_id}', 'BlogCommentController@store')->name('blog.comment.store');

Route::put('/blog_comment/{id}/update', 'BlogCommentController@update')->name('blog.comment.update');

Route::delete('/blog_comment/{id}', 'BlogCommentController@destroy')->name('blog.comment.destroy');

// Route::get('/blog-comment','BlogCommentController@index')->name('blog.comment.index');

// Route::post('/blog-comment/{id}', 'BlogCommentController@store')->name('blog.comment.store');

// Route::get('/blog-comment/{id}', 'BlogCommentController@edit')->name('blog.comment.edit');

// Route::put('/blog-comment/{id}/update', 'BlogCommentController@update')->name('blog.comment.update');

// Route::delete('/blog-comment/{id}','BlogCommentController@destroy')->name('blog.comment.destroy');

// LIKE & UNLIKE
Route::get('/like/{model}/{type}', 'LikeController@like');
Route::get('/cancel_like/{model}/{type}', 'LikeController@unlike');

Route::get('/unlike/{model}/{type}', 'UnlikeController@unlike');
Route::get('/cancel_unlike/{model}/{type}', 'UnlikeController@cancelUnlike');

// EMOTION
Route::get('/emotions/{blog_id}', 'EmotionController@index');
Route::get('/emotions/{emotion_id}/{blog_id}', 'EmotionController@save');

// NOTIFICATION
Route::get('/notification', 'NotificationController@index')->name('notifications.index');
Route::get('/mark_as_read/{id}', 'NotificationController@markAsRead');

// CHAT
Route::get('/chat', 'ChatController@index')->name('chat.index');
Route::get('/messages', 'ChatController@getMessages');
Route::post('/messages', 'ChatController@postMessage');

// CHANGE AVATAR USERS
Route::put('/change_avatar/{user_id}/update', 'UserController@changeAvatar');

// COUPON
Route::post('/coupon', 'CouponController@store')->name('coupon.store');
Route::delete('/coupon', 'CouponController@destroy')->name('coupon.destroy');

// CHECKOUT
Route::get('/checkout', 'CheckoutController@index')->name('checkout.index');
Route::post('/checkout', 'CheckoutController@store')->name('checkout.store');
Route::get('/guestCheckout', 'CheckoutController@index')->name('guestCheckout');

Route::post('/paypal-checkout', 'CheckoutController@paypalCheckout')->name('checkout.paypal');

// CURRENCY MONEY
Route::get('/switch/{id?}/', 'CurrencyController@switch')->name('switch.currency');

// ORDER
Route::get('/order', 'OrderController@index')->name('order.index'); 

// Route::get('/{checkout?}', function() {
//   return view('homepage/home');
// })->where('checkout', '[V\w\.-]*'); // fix mode vue router history use Laravel
