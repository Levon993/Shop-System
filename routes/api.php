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
Route::post('/test/user','AuthController@authUser' );//->middleware(['Headers','auth:api']);;


Route::post('/categories/create', 'CategoryController@create');
Route::get('/categories/index', 'CategoryController@index');
Route::post('/categories/destroy', 'CategoryController@destroy');

Route::post('/products/create', 'ProductController@create');
Route::post('/products/index', 'ProductController@index');
Route::post('/products/destroy', 'ProductController@destroy');

Route::post('/brands/create', 'BrandController@create');
Route::get('/brands/index', 'BrandController@index');
Route::post('/brands/destroy', 'BrandController@destroy');

Route::get('/orders/index', 'OrderController@index')->middleware(['Headers','auth:api']);;;
Route::post('/brands/create', 'OrderController@create');
Route::post('/brands/destroy', 'OrderController@destroy');

Route::post('/orders/getProductsForBasket', 'OrderController@getProductsForBasket');

Route::post('/offers/index', 'OfferController@index');
Route::post('/offers/create', 'OfferController@create');
Route::post('/offers/destroy', 'OfferController@destroy');
