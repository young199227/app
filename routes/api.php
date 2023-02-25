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
    //後臺下架商品 owner下架商品
    Route::post('/delete_goods', [OwnerApiController::class, 'delete_goods']);
    //後臺上架商品 owner上架商品
    Route::post('/up_goods', [OwnerApiController::class, 'up_goods']);
    //後臺停權會員
    Route::post('/delete_member',[OwnerApiController::class, 'delete_member']);
    //後臺正常會員
    Route::post('/up_member',[OwnerApiController::class, 'up_member']);
});

//goods_car group
Route::group(["prefix"=>"goods_car"],function(){
    //至頂購物車商品數量(紅點)
    Route::post('/count', [GoodsApiController::class, 'goods_car_count']);
    //購物車商品數量更改
    Route::post('/count_update', [GoodsApiController::class, 'goods_car_count_update']);
    //購物車商品刪除
    Route::post('/delete', [GoodsApiController::class, 'goods_car_delete']);
    //商品頁面加入購物車 寫在web.php session的group裡面(因為api.php無法處理session)
});

