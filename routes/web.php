<?php

use Illuminate\Support\Facades\Route;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Auth;

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

Route::get('/route-cache', function() {
    $exitCode = Artisan::call('route:cache');
    return 'Routes cache cleared';
})->middleware("guest");

Route::get('/config-cache', function() {
    $exitCode = Artisan::call('config:cache');
    return 'Config cache cleared';
})->middleware("guest");

//common Brands
Route::get('/shared/brand', 'BrandsController@index')->name('Brands');
// 

Route::get('/', 'HomepageController@index')->name('Homepage');
Route::get('/contact', 'HomepageController@contact')->name('contact');
Route::post('/contact', 'HomepageController@contact')->name('contact.send');

Route::get('/privacy-policy', 'HomeController@privacy')->name('privacy');
Route::get('/terms-and-conditions', 'HomeController@condition')->name('conditions');
Route::get('/delivery-decription', 'HomeController@delivery');


//login
Route::post('/logout', 'LoginController@logout')->name('logout');

Route::get('/shop', 'ShopController@index')->name('shop.index');
Route::get('/shop/{id}', 'ShopController@show')->name('shop.details'); 
Route::get('/search', 'ShopController@search')->name('search'); 

Route::get('/cart', 'CartController@index')->name('cart.index');
Route::post('/cart', 'CartController@store')->name('cart.store');
Route::patch('/cart/{product}', 'CartController@update')->name('cart.update');
Route::delete('/cart/{product}', 'CartController@destroy')->name('cart.destroy');

Route::get('/checkout', 'CheckoutController@index')->name('checkout.index');

Route::post('/checkout', 'CheckoutController@create')->name('checkout');
Route::post('/checkout-store', 'CheckoutController@store')->name('checkout.store');
Route::get('/confirmation/{id}', 'CheckoutController@confirmation')->name('confirmation');

Route::get('empty', function(){
    Cart::destroy();
});



//Admin Panel 

Route::get('/admindash', 'DashboardController@getResentOrders')->name('dashboard')->middleware("auth");
Route::get('/admindashallOrders', 'DashboardController@checkoutall')->name('checkoutall');
Route::get('/checkout/{checkoutidt}', 'DashboardController@checkoutdetails')->name('checkout.details'); 
Route::get('/checkout-delete/{checkoutidt}', 'DashboardController@checkoutdelete')->name('checkout.delete'); 
Route::get('/delivered/{id}', 'DashboardController@delivered')->name('delivered');

//Products
Route::get('/ManageProducts', 'ProductController@index')->name('ManageProducts');
Route::get('/ProductsDetail/{product}', 'ProductController@show')->name('product.details');
Route::match(['get', 'post'], '/admin/add-product', 'ProductController@addProduct')->name('AddProduct');
Route::match(['get', 'post'], '/admin/edit-product/{id}', 'ProductController@editProduct')->name('EditProduct');
Route::get('/admin/delete-product/{id}', 'ProductController@deleteProduct')->name('DeleteProduct');
Route::get('/admin/delete-image/{id}', 'ProductController@deleteImage')->name('DeleteImage');

//Category
Route::match(['get', 'post'], '/admin/add-category', 'CategoryController@addCategory')->name('AddCategory');
Route::match(['get', 'post'], '/admin/edit-category/{id}', 'CategoryController@editCategory')->name('EditCategory');
Route::match(['get', 'post'], '/admin/delete-category/{id}', 'CategoryController@deleteCategory')->name('DeleteCategory');
Route::match(['get', 'post'], '/admin/delete-subcategory/{id}', 'CategoryController@deleteSubCategory')->name('DeleteSubCategory');

Route::match(['get', 'post'], '/admin/add-sub-category', 'CategoryController@addSubCategory')->name('AddSubCategory');

//get sub-category
Route::get('/getSubCat/{id}', 'CategoryController@getSubCategory');

//Brands
Route::match(['get', 'post'], '/admin/brands', 'BrandsController@index')->name('Brands');
Route::get('/admin/brands/{id}', 'BrandsController@deleteBrand')->name('DeleteBrands');
Route::match(['get', 'post'], '/admin/add-brands', 'BrandsController@addBrand')->name('AddBrand');

//Contacts
Route::get('/contacts', 'ContactController@index')->name('ViewContacts');
Route::get('/ViewMessage/{id}', 'ContactController@Message')->name('ViewMessage');
Route::get('/AllMessage', 'ContactController@AllMessage')->name('allMessages');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
