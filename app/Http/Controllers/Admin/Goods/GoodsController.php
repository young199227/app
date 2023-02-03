<?php

namespace App\Http\Controllers\Admin\Goods;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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

        $row = DB::table('goods')->get();

        return view('web.goods.goods_list',compact('row'));
    }

    //商品詳細
    public function test(Request $req,$goods_id){

        $row = DB::table('goods')->where('goods_id',$goods_id)->first();

        return view('web.goods.goods_only', compact('row'));
    }

}
