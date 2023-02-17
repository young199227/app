<?php

namespace App\Http\Controllers\Admin\Goods;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class GoodsController extends Controller
{
    //首頁(展示頁面)
    public function show_index()
    {
        return view('web.index.show_index');
    }

    //第二首頁
    public function fruit_index()
    {
        return view('web.index.fruit_index');
    }

    //搜尋商品
    //http://127.0.0.1:8000/fruit/goods_google/?
    public function fruit_google_goods($goods_name = null)
    {
        if ($goods_name != null) {

            $row = DB::table('goods')
                ->select('*', DB::raw('(select Goods_img FROM goods_imges where Goods_id = a.Goods_id LIMIT 1) as Goods_imges'))
                ->from('goods as a')
                ->where('Goods_name', 'like', '%' . $goods_name . '%')
                ->get();

            return view('web.goods.goods_list', compact('row'));
        } else {
            return redirect()->route('fruit');
        }
    }

    //購物車
    public function goods_car()
    {

        return view('web.goods.goods_car');
    }

    //商品列表
    public function goods_list()
    {
        $row = DB::table('goods')
            ->select('*', DB::raw('(select Goods_img FROM goods_imges where Goods_id = a.Goods_id LIMIT 1) as Goods_imges'))
            ->from('goods as a')
            ->get();

        return view('web.goods.goods_list', compact('row'));
    }

    //商品詳細
    public function goods_only(Request $req, $goods_id)
    {
        $row = DB::table('goods')->where('goods_id', $goods_id)->first();

        $row_img = DB::table('goods_imges')->where('goods_id', $goods_id)->get();

        //$row_img查詢到圖片時視圖才會帶圖片資料
        if ($row_img->count() > 0) {

            return view('web.goods.goods_only', compact('row', 'row_img'));
        } else {
            return view('web.goods.goods_only', compact('row'));
        }
    }
}
