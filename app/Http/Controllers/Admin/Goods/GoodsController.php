<?php

namespace App\Http\Controllers\Admin\Goods;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class GoodsController extends Controller
{
    //首頁(展示頁面)
    public function show_index(){
        return view('web.index.show_index');
    }

    //第二首頁
    public function fruit_index(){
        return view('web.index.fruit_index');
    }

    //購物車
    public function goods_car(){
        return view('web.goods.goods_car');
    }

    //商品列表
    public function goods_list(){
        return view('web.goods.goods_list');
    }

    //商品詳細
    public function goods_only(){
        return view('web.goods.goods_only');
    }

}
