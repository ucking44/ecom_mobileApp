<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('layout');
// });

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CheckoutController;

Route::get('/', function () {
    return view('/welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::group(['middleware' => ['auth', 'admin']], function () {

    ////////////////////////////// DASHBOARD /////////////////////////////
    Route::get('/dashboard', 'Admin\DashboardController@dashboard')->name('dashboard');
    Route::get('/dashboard', 'Admin\DashboardController@index')->name('dashboard');


    ////////////////////////////  REGISTER ROLE ///////////////////////////////
    Route::get('/role-register', 'Admin\AdminController@registered')->name('role-register');
    Route::get('/edit/{id}', 'Admin\AdminController@edit')->name('edit');
    Route::put('/update/{id}', 'Admin\AdminController@update')->name('update');
    Route::delete('/delete/{id}', 'Admin\AdminController@delete')->name('delete');


    /////////////////////////// CATEGORY ROUTE /////////////////////////
    Route::get('/add-category', 'CategoryController@admin_index');
    Route::get('/all-category', 'CategoryController@all_category');
    Route::post('/save-category', 'CategoryController@save_category');
    Route::get('/edit-category/{category_id}', 'CategoryController@edit_category');
    Route::put('/update-category/{category_id}', 'CategoryController@update_category');
    Route::get('/delete-category/{category_id}', 'CategoryController@delete_category');
    Route::get('/unactive_category/{category_id}', 'CategoryController@unactive_category');
    Route::get('/active_category/{category_id}', 'CategoryController@active_category');


    ////////////////////////////    MANUFACTURE ROUTE ////////////////////////
    Route::get('/all-manufacture', 'ManufactureController@all_manufacture');
    Route::get('/add-manufacture', 'ManufactureController@manufacture_create');
    Route::post('/save-manufacture', 'ManufactureController@save_manufacture');
    Route::get('/show-manufacture/{manufacture_id}', 'ManufactureController@show');
    Route::get('/edit-manufacture/{id}', 'ManufactureController@edit_manufacture');
    Route::post('/update-manufacture/{id}', 'ManufactureController@update_manufacture');
    Route::get('/delete-manufacture/{id}', 'ManufactureController@delete_manufacture');
    Route::get('/unactive_manufacture/{id}', 'ManufactureController@unactive_manufacture');
    Route::get('/active_manufacture/{id}', 'ManufactureController@active_manufacture');


    ///////////////////////////     PRODUCT ROUTE  /////////////////////////
    Route::get('/add-product', 'ProductController@product_create');
    Route::post('/save-product', 'ProductController@save_product');
    Route::get('/all-product', 'ProductController@all_product');
    Route::get('/show-product/{product_id}', 'ProductController@show');
    Route::get('/edit-product/{product_id}', 'ProductController@edit');
    Route::put('/update-product/{product_id}', 'ProductController@update_product');
    Route::get('/delete-product/{id}', 'ProductController@delete_product');
    Route::get('/unactive_product/{product_id}', 'ProductController@unactive_product');
    Route::get('/active_product/{product_id}', 'ProductController@active_product');


});


Route::get('/', 'HomeController@index');

Route::get('/product_by_category/{category_id}', 'HomeController@show_product_by_category');
Route::get('/product_by_manufacture/{manufacture_id}', 'HomeController@show_product_by_manufacture');
Route::get('/view_product/{product_id}', 'HomeController@product_details_by_id');


////////////////////   CART ROUTE   ////////////////////////
Route::post('/add-to-cart', 'CartController@add_to_cart');
Route::get('/show-cart', 'CartController@show_cart');
Route::get('/delete-to-cart/{rowId}', 'CartController@delete_to_cart');
Route::post('/update-cart', 'CartController@update_cart');

///////////////////////// CHECKOUT ROUTE   ////////////////////////
Route::get('/login-check', 'CheckoutController@login_check');
Route::post('/customer_registration', 'CheckoutController@customer_registration');
Route::get('/checkout', 'CheckoutController@checkout');
Route::post('/save-shipping-details', 'CheckoutController@save_shipping_details');

////////////////////  CUSTOMER LOGIN AND LOGOUT ROUTE  ////////////////
Route::post('/customer_login', 'CheckoutController@customer_login');
Route::get('/customer_logout', 'CheckoutController@customer_logout');

Route::get('/payment', 'CheckoutController@payment');
Route::post('/order-place', 'CheckoutController@order_place');

Route::get('/manage-order', 'CheckoutController@manage_order');
Route::get('/view-order/{order_id}', 'CheckoutController@view_order');




////////////////////////////    SLIDER ROUTE   ////////////////////////
Route::get('/sliders', 'SliderController@index');
Route::get('/create/slider', 'SliderController@create');
Route::post('/save-slider', 'SliderController@save_slider');
//Route::get('/all-slider', 'SliderController@all_slider');
Route::delete('/delete-slider/{id}', 'SliderController@delete_slider');
Route::get('/unactive_slider/{id}', 'SliderController@unactive_slider');
Route::get('/active_slider/{id}', 'SliderController@active_slider');

///////////////////  SEARCH ROUTE  ////////////////////////
Route::get('/search', 'ProductController@search');


///////////////////   REVIEWS ROUTE  ///////////////////
// Route::post('/products', 'ReviewController@store');
// Route::get('/get-reviews', 'ReviewController@getReview');
//Route::get('/write-review/{product_id}', 'ReviewController@createReview');
Route::get('/product-show-review/{product_id}', 'HomeController@productReview');
Route::get('/show-reviews/{id}', 'ProductController@showReview');
// Route::resource('reviews', 'ReviewsController');
Route::post('/reviews', 'ReviewsController@store');


///////////////////  ADD TO WISHLIST ROUTE  //////////////////
Route::post('/addToWishList', 'HomeController@wishList');
Route::get('/wishList', 'HomeController@view_wishList');
Route::get('/removeWishList/{id}', 'HomeController@removeWishList');






// Route::post('products/{product_id}/#reviews-anchor', 'ReviewController@storeReview'); //->only('store', 'update', 'destroy');
// Route::post('/products/{product_id}', 'ReviewController@storeReview'); //->only('store', 'update', 'destroy');
// Route::get('/product-review/{product_id}', 'ReviewController@product_review_by_id');
// Route::get('/product-review/{product_id}/#reviews-anchor', 'ReviewController@reviews_anchor');
// Route::get('/productReviews/{product_id}', 'ReviewController@index');

// Route::get('/search-category/{category_name}', 'CategoryController@search');

// Route::get('/search-manufacture/{manufacture_name}', 'ManufactureController@search');

