<?php

namespace App\Http\Controllers\Admin\Owner;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OwnerController extends Controller
{
    //測試
    public function test()
    {
        session(['user' => '123']);

        session()->flush();
    }

    //後臺首頁(顯示所有商品)
    public function owner_index()
    {

        $row = DB::table('goods')
            ->select('*', DB::raw('(select Goods_img FROM goods_imges where Goods_id = a.Goods_id LIMIT 1) as Goods_imges'))
            ->from('goods as a')
            ->get();

        return view('web.owner.owner_index', compact('row'));
    }

    //後臺PO商品頁面
    public function owner_po_goods()
    {

        return view('web.owner.owner_po_goods');
    }

    //後台修改商品頁面 把商品值帶過ㄑ並顯示
    public function owner_update_goods(Request $req, $goods_id)
    {

        $row = DB::table('goods')->where('goods_id', $goods_id)->first();

        $row_img = DB::table('goods_imges')->where('goods_id', $goods_id)->get();

        // return $row_img;
        return view('web.owner.owner_update_goods', compact('row', 'row_img'));
        // return view('web.owner.owner_update_goods',compact('row'));
    }
}
