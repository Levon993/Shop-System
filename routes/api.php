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
Route::post('/categories/create', 'CategoryController@create');
Route::get('/categories/index', 'CategoryController@index');
Route::post('/categories/destroy', 'CategoryController@destroy');

Route::post('/products/create', 'ProductController@create');
Route::post('/products/index', 'ProductController@index');
Route::post('/products/destroy', 'ProductController@destroy');

Route::post('/brands/create', 'BrandController@create');
Route::get('/brands/index', 'BrandController@index');
Route::post('/brands/destroy', 'BrandController@destroy');
