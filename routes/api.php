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
// Route::get('products/search/{key}', 'Api\ProductController@searchKeyProduct');
Route::get('products/get-product-client/{id}', 'Api\ProductController@getProductClinet');
Route::get('get-client-cua-hang-product', 'Api\ProductController@getProductPageCuaHang');
Route::post('products/delete-multiple-products', 'Api\ProductController@deleteMultipleProducts');
Route::get('total-product', 'Api\ProductController@totalProduct');
Route::get('get-san-pham-cung-danh-muc/{id}', 'Api\ProductController@getSanPhamCungDanhMuc');

Route::apiResource('/category', 'Api\CategoryController');
Route::get('/get-all-category', 'Api\CategoryController@getAllCateGory');

Route::group([
    'prefix' => 'auth'
], function () {
    Route::get('/get-all-user', 'Api\AuthController@getAllUser');
    Route::post('/login', 'Api\AuthController@login');
    Route::post('/create', 'Api\AuthController@signup');
    Route::get('/logout', 'Api\AuthController@logout');
    Route::get('/cap-nhat-quyen/{id}', 'Api\AuthController@changePermission');
    Route::group([
      'middleware' => 'auth:api'
    ], function() {

        Route::get('/user', 'Api\AuthController@user');
    });
});

Route::post('checkout', 'Api\CheckOutController@thanhToan');
Route::get('donhang', 'Api\CheckOutController@donHang');
Route::get('donhang-da-phe-duyet', 'Api\CheckOutController@donHangDaPheDuyet');
Route::get('chang-status-don-hang/{id}', 'Api\CheckOutController@changeStatusDonHang');
Route::get('get-total-price', 'Api\CheckOutController@getTotalPrice');
Route::get('get-total-san-pham-da-ban', 'Api\CheckOutController@sanPhamDaBan');

Route::apiResource('/article-category', 'Api\ArticleCategoriesController');
Route::get('/get-all-article-category', 'Api\ArticleCategoriesController@getAllArticleCategory');

Route::apiResource('/posts', 'Api\PostsController');
Route::get('total-posts', 'Api\PostsController@totalPosts');
Route::get('get-posts-danh-muc/{id}', 'Api\PostsController@getPostsDanhMuc');


Route::apiResource('/lien-he', 'Api\LienHeController');
