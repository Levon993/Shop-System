<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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
//
//Route::middleware('auth:api')->get('/user', function (Request $request) {
//    return $request->user();
//});
Route::post('/register', 'AuthController@register');
Route::post('/login', 'AuthController@login');
Route::post('/logout', 'AuthController@logout');
Route::post('/get/user','AuthController@authUser' )->middleware(['auth:api']);;


Route::post('/categories/create', 'CategoryController@create')->middleware(['auth:api']);;
Route::get('/categories/index', 'CategoryController@index');
Route::get('/categories/CategoryWithProducts', 'CategoryController@CategoryWithProducts');//->middleware(['auth:api']);;
Route::post('/categories/destroy', 'CategoryController@destroy')->middleware(['auth:api']);;

Route::post('/products/create', 'ProductController@create')->middleware(['auth:api']);
Route::post('/products/index', 'ProductController@index');//->middleware(['auth:api']);
Route::post('/products/search', 'ProductController@search')->middleware(['auth:api']);
Route::post('/products/destroy', 'ProductController@destroy')->middleware(['auth:api']);
Route::post('/products/getByCategory', 'ProductController@getByCategory')->middleware(['auth:api']);
Route::post('/products/update', 'ProductController@update')->middleware(['auth:api']);
Route::post('/products/addToChoice', 'ProductController@addToChoice')->middleware(['auth:api']);
Route::post('/products/getChoices', 'ProductController@getChoices');//->middleware(['auth:api']);
Route::post('/products/getChoicesForUser', 'ProductController@getChoicesForUser');//->middleware(['auth:api']);

Route::post('/products/addToDiscount', 'ProductController@addToDiscount')->middleware(['auth:api']);
Route::get('/products/getDiscounts', 'ProductController@getDiscounts')->middleware(['auth:api']);
Route::get('/products/getDiscountsForUsers', 'ProductController@getDiscountsForUsers');//->middleware(['auth:api']);


Route::post('/brands/create', 'BrandController@create')->middleware(['auth:api']);
Route::get('/brands/index', 'BrandController@index')->middleware(['auth:api']);
Route::post('/brands/destroy', 'BrandController@destroy')->middleware(['auth:api']);

Route::post('/orders/index', 'OrderController@index')->middleware(['auth:api']);
Route::post('/orders/NonRegisterIndex', 'OrderController@NonRegisterIndex')->middleware(['auth:api']);
Route::post('/brands/create', 'OrderController@create')->middleware(['auth:api']);
Route::post('/brands/destroy', 'OrderController@destroy');

Route::post('/orders/getProductsForBasket', 'OrderController@getProductsForBasket');
Route::post('/orders/create', 'OrderController@create');

Route::post('/offers/index', 'OfferController@index');
Route::post('/offers/create', 'OfferController@create')->middleware(['auth:api']);
Route::post('/offers/destroy', 'OfferController@destroy');
