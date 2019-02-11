<?php

// AUTH
Auth::routes();

// ADMIN VOYAGER
// OVERRIDE ROUTE VOYAGER
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
    // OVERRIDE
    Route::put('/users/{user}','\\App\\Http\\Controllers\\Voyager\\' .'UserController@update')->name('voyager.users.update');

    Route::delete('/users/{u}', $namespacePrefix .'VoyagerBaseController@destroy')->name('voyager.users.destroy');

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

    Route::post('/orders', $namespacePrefix .'VoyagerBaseController@store')->name('voyager.orders.store');
    Route::get('/orders', $namespacePrefix .'VoyagerBaseController@index')->name('voyager.orders.index');
    Route::get('/orders/create', $namespacePrefix .'VoyagerBaseController@create')->name('voyager.orders.create');
    Route::get('/orders/order', $namespacePrefix .'VoyagerBaseController@order')->name('voyager.orders.order');
    Route::post('/orders/order', $namespacePrefix .'VoyagerBaseController@update_order')->name('voyager.orders.order');
    Route::get('/orders/{id}', $namespacePrefix .'VoyagerBaseController@show')->name('voyager.orders.show');
    Route::delete('/orders/{id}', $namespacePrefix .'VoyagerBaseController@destroy')->name('voyager.orders.destroy');
});

// APP INDEX
Route::get('/', 'HomeController@index')->name('home');

// SOCIALITE
Route::get('/redirect/{service}', 'SocialAuthController@redirect');
Route::get('/callback/{service}', 'SocialAuthController@callback');
Route::get('/social/account/logout', 'SocialAuthController@logout')->name('social.logout');

// USER PROFILE
Route::get('/profile/{id?}', 'UserController@profile')->name('user.profile');

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
Route::post('/change_avatar/{user_id}/update', 'UserController@changeAvatar')->name('changeAvatar');

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
