<?php

use App\Http\Controllers\Admin\Goods\GoodsController;
use App\Http\Controllers\Admin\Owner\OwnerController;
use App\Http\Controllers\Admin\Member\MemberController;
use App\Http\Controllers\Admin\Test\TestController;
use App\Http\Controllers\Admin\Member\MemberApiController;
use App\Http\Controllers\Admin\Goods\GoodsApiController;
use App\Http\Controllers\Train\TrainController;
use App\Http\Controllers\Train\SalesController;
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
//map
Route::get('/map', [TestController::class, 'map']);
//vue
Route::get('/vue', [TestController::class, 'vue']);
//測試頁面2
Route::post('/testpas', [TestController::class, 'pasw']);

//train
Route::get('/train5', [TrainController::class, 'train4']);
Route::post('/train4_C', [TrainController::class, 'train4_C']);
Route::get('/train4_R', [TrainController::class, 'train4_R']);
Route::post('/train4_R_one', [TrainController::class, 'train4_R_one']);
Route::post('/train4_U', [TrainController::class, 'train4_U']);
Route::post('/train4_D', [TrainController::class, 'train4_D']);

//train
Route::get('/sales', [SalesController::class, 'sales']);

//測試頁面
Route::get('/php', [TestController::class, 'php']);
Route::get('/test', [TestController::class, 'test']);
Route::post('/test1', [TestController::class, 'test1']);
Route::post('/test2', [TestController::class, 'test2']);

//處理session的group (因為aip.php不能分發seeion)
Route::group(["prefix" => "session"], function () {
    //會員登入 
    Route::post('/member/long', [MemberApiController::class, 'member_long']);
    //會員登出
    Route::get('/member/logout', [MemberApiController::class, 'member_logout']);
    //會員註冊頁面 發送認證email
    Route::post('/member/email_session', [MemberApiController::class, 'email_session']);
    //會員註冊頁面 認證email_session
    Route::post('/member/email_session_verify', [MemberApiController::class, 'email_session_verify']);
    //會員註冊
    Route::post('/member/member_sign_up', [MemberApiController::class, 'member_sign_up']);
    //會員更改密碼
    Route::post('/member/updata_password', [MemberApiController::class, 'updata_password']);

    //商品頁面加入購物車
    Route::post('/goods_car/add', [GoodsApiController::class, 'goods_car_add'])->middleware('check.member');
});


//關於專題fruit world
Route::get('/Fruit_World', [GoodsController::class, 'Fruit_World']);

//首頁(展示頁面)
Route::get('/', [GoodsController::class, 'show_index']);

//fruit的group
Route::group(["prefix" => "fruit"], function () {
    //第二首頁
    Route::get('/', [GoodsController::class, 'fruit_index'])->name('fruit');
    //搜尋商品
    Route::get('/goods_google/{goods_name?}', [GoodsController::class, 'fruit_google_goods']);
    //商品詳細
    Route::get('/goods_only/{goods_id}', [GoodsController::class, 'goods_only']);
    //購物車
    Route::get('/goods_car', [GoodsController::class, 'goods_car'])->middleware('check.member');
    //商品列表 
    Route::get('/goods_list', [GoodsController::class, 'goods_list']);
    //商品列表 新到舊
    Route::get('/goods_list/new', [GoodsController::class, 'goods_list_new']);
    //商品列表 500內
    Route::get('/goods_list/500', [GoodsController::class, 'goods_list_500']);
    //商品列表 500~999
    Route::get('/goods_list/599', [GoodsController::class, 'goods_list_599']);
    //商品列表 1000以上
    Route::get('/goods_list/1000', [GoodsController::class, 'goods_list_1000']);
});

//會員的group
Route::group(["prefix" => "member"], function () {
    //會員中心（基礎頁面）
    Route::get('/', [MemberController::class, 'member_index'])->middleware('check.member');
    //會員中心（訂單頁面）
    Route::get('/member_order',[MemberController::class, 'member_order']);
    //會員註冊頁面
    Route::get('/member_sign_up', [MemberController::class, 'member_sign_up']);
    //單獨的會員登入頁面
    Route::get('/member_login', [MemberController::class, 'member_login'])->name('member_login');
});

//owner的group
//check.owner中間件判斷沒有owner session時回到首頁
Route::group(["prefix" => "owner", "middleware" => "check.owner"], function () {
    //後台首頁(顯示所有商品)
    Route::get('/', [OwnerController::class, 'owner_index'])->name('owner');
    //後台owner_po_goods
    Route::get('/owner_po_goods', [OwnerController::class, 'owner_po_goods']);
    //後台owner_update_goods
    Route::get('/owner_update_goods/{goods_id}', [OwnerController::class, 'owner_update_goods']);
    //後台owner_member(管理會員頁面)
    Route::get('/owner_member', [OwnerController::class, 'owner_member']);
    //後台owner_count(管理統計圖)
    Route::get('/owner_count', [OwnerController::class, 'owner_count']);
    //後台owner_order(管理訂單)
    Route::get('/owner_order', [OwnerController::class, 'owner_order']);
});
