<?php

use App\Http\Controllers\Admin\Goods\GoodsController;
use App\Http\Controllers\Admin\Owner\OwnerController;
use App\Http\Controllers\Admin\Member\MemberController;
use App\Http\Controllers\Admin\Test\TestController;
use Illuminate\Support\Facades\Route;

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
//測試頁面2
Route::post('/test2/test_upload',[TestController::class,'test_upload']);
Route::get('/test2/{goods_id}',[TestController::class,'test_update']);
Route::get('/test2',[TestController::class,'test_index']);

//測試頁面
Route::get('/test',function(){return view('test');});

//首頁(展示頁面)
Route::get('/',[GoodsController::class,'show_index']);

//第二首頁
Route::get('/fruit',[GoodsController::class,'fruit_index']);

//購物車
Route::get('/fruit/goods_car',[GoodsController::class,'goods_car']);

//商品列表
Route::get('/fruit/goods_list',[GoodsController::class,'goods_list']);

//商品詳細
Route::get('/fruit/goods_only/{goods_id}',[GoodsController::class,'test']);

//會員註冊
Route::get('/member_sign_up',[MemberController::class,'member_sign_up']);

//後臺首頁(顯示所有商品)
Route::get('/owner',[OwnerController::class,'owner_index']);

//後臺owner_po_goods
Route::get('/owner_po_goods',[OwnerController::class,'owner_po_goods']);
