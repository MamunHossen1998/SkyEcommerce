<?php

Route::get('/', 'FrontendController@index');
Route::get('/product/details/{product_id}', 'FrontendController@productdetails');
Route::get('/about', 'FrontendController@about');
Route::get('/contact', 'FrontendController@contact');
Route::get('/category/wise/product/{category_id}', 'FrontendController@categorywiseproduct');

Route::post('/checkout', 'FrontendController@checkout');
Route::post('/checkout/insert', 'FrontendController@checkoutinsert');
Route::post('/city/list', 'FrontendController@citylist');

Route::get('/banner/add/view','FrontendController@addbannerview');
Route::post('/baner/add/insert','FrontendController@baneraddinsert');

Route::get('/add/to/cart/{product_id}','FrontendController@addtocart');
Route::get('/cart','FrontendController@cart');
Route::get('/cart/{coupon_name}','FrontendController@cart');
Route::get('/clear/cart','FrontendController@clearcart');
Route::get('/single/cart/delete/{cart_id}','FrontendController@singlecartdelete');
Route::post('/update/cart','FrontendController@updatecart');

Route::get('/customer/register','FrontendController@customerregister');
Route::post('/customer/register/insert','FrontendController@customerregisterinsert');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

// All backend routting
Route::get('/product/add/view', 'ProductController@productaddview');
Route::post('/product/add/insert', 'ProductController@productaddinsert');
Route::get('/product/delete/{product_id}', 'ProductController@productdelete');
Route::get('/product/edit/{product_id}', 'ProductController@productedit');
Route::post('/product/edit/insert', 'ProductController@producteditinsert');

Route::get('/category/add/view', 'CategoryController@categoryaddview');
Route::post('/category/add/insert', 'CategoryController@categoryaddinsert');

Route::get('/coupon/add/view','CouponController@index');
Route::post('coupon/add/insert','CouponController@couponaddinsert');

//Customer Controller
Route::get('/customer/dashboard','CustomerController@customerdashboard');
Route::get('/customer/profile','CustomerController@customerprofile');
Route::post('/customer/profile/insert','CustomerController@customerprofileinsert');
Route::post('/customer/profile/update','CustomerController@customerprofileupdate');
Route::get('/customer/order','CustomerController@order');
Route::get('/view/details/order/{shipping_id}','CustomerController@viewdetailsorder');

//payment Routes
Route::get('stripe', 'StripePaymentController@stripe');
Route::post('stripe', 'StripePaymentController@stripePost')->name('stripe.post');
