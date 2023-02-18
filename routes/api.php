<?php

use App\Http\Controllers\Admin\Member\MemberApiController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\Owner\OwnerApiController;
use App\Http\Controllers\Admin\Goods\GoodsApiController;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

//owner group
Route::group(["prefix" => "owner"], function () {
    //後臺新增商品 owner新增商品
    Route::post('/insert_goods', [OwnerApiController::class, 'insert_goods']);
    //後臺修改商品 owner修改商品
    Route::post('/update_goods', [OwnerApiController::class, 'update_goods']);
    //後臺刪除商品 owner刪除商品
    Route::post('/delete_goods', [OwnerApiController::class, 'delete_goods']);
});

//goods_car group
Route::group(["prefix"=>"goods_car"],function(){
    //購物車商品數量
    Route::post('/count', [GoodsApiController::class, 'goods_car_count']);
});

