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
Route::get('/test2', [TestController::class, 'test_index']);

//測試頁面
Route::get('/test', [OwnerController::class, 'test']);
Route::get('/test1',function(){return view('test');});


//首頁(展示頁面)
Route::get('/', [GoodsController::class, 'show_index']);

//fruit的group
Route::group(["prefix" => "fruit"], function () {
    //第二首頁
    Route::get('/', [GoodsController::class, 'fruit_index']);

    //購物車
    Route::get('/goods_car', [GoodsController::class, 'goods_car']);

    //商品列表
    Route::get('/goods_list', [GoodsController::class, 'goods_list']);

    //商品詳細
    Route::get('/goods_only/{goods_id}', [GoodsController::class, 'test']);
});



//會員的group
Route::group(["prefix" => "member"],function(){

    Route::get('/', [MemberController::class, 'member_index']);

    Route::get('/member_sign_up', [MemberController::class, 'member_sign_up']);

});



//owner的group
Route::group(["prefix" => "owner"], function () {
    //後臺首頁(顯示所有商品)
    Route::get('/', [OwnerController::class, 'owner_index']);

    //後臺owner_po_goods
    Route::get('/owner_po_goods', [OwnerController::class, 'owner_po_goods']);

    //後台owner_update_goods
    Route::get('/owner_update_goods/{goods_id}', [OwnerController::class, 'owner_update_goods']);
});
