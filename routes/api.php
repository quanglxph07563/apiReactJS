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

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });
Route::apiResource('/products', 'Api\ProductController');
Route::get('products/search/{key}', 'Api\ProductController@searchKeyProduct');
Route::get('products/get-product-client/{id}', 'Api\ProductController@getProductClinet');
Route::post('products/delete-multiple-products', 'Api\ProductController@deleteMultipleProducts');


Route::apiResource('/category', 'Api\CategoryController');
Route::get('/get-all-category', 'Api\CategoryController@getAllCateGory');


