<?php

use App\Http\Controllers\Admin\Goods\GoodsController;
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

//首頁(展示頁面)
Route::get('/',[GoodsController::class,'show_index']);

//第二首頁
Route::get('/fruit',[GoodsController::class,'fruit_index']);


