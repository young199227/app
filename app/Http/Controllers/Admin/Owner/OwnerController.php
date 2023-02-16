<?php

namespace App\Http\Controllers\Admin\Owner;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class OwnerController extends Controller
{
    //後台首頁(顯示所有商品)
    public function owner_index()
    {

        $row = DB::table('goods')
            ->select('*', DB::raw('(select Goods_img FROM goods_imges where Goods_id = a.Goods_id LIMIT 1) as Goods_imges'))
            ->from('goods as a')
            ->paginate(5);


        return view('web.owner.owner_index', compact('row'));
    }

    //後台PO商品頁面
    public function owner_po_goods()
    {

        return view('web.owner.owner_po_goods');
    }

    //後台修改商品頁面 把商品值帶過ㄑ並顯示
    public function owner_update_goods(Request $req, $goods_id)
    {

        $row = DB::table('goods')->where('goods_id', $goods_id)->first();

        $row_img = DB::table('goods_imges')->where('goods_id', $goods_id)->get();

        // 把地址拆成兩部分顯示  一個中文字=3
        $string = $row->Goods_area;
        $part1 = substr($string, 0, 9);
        $part2 = substr($string, 9);

        // return $row_img;

        return view('web.owner.owner_update_goods', compact('row', 'row_img','part1','part2'));
    }

    //後台管理會員頁面 (顯示所有會員)
    public function owner_member()
    {
        $row = DB::table('member')->paginate(5);

        return view('web.owner.owner_member', compact('row'));
    }

    //後台管理統計圖 （顯示總數）
    public function owner_count()
    {
        // 註冊會員總數
        $row_member = DB::table('member')
        ->selectRaw('count(*) as member_count')
        ->get();

        // 上架商品總數
        $row_goods = DB::table('goods')
        ->selectRaw('count(*) as goods_count')
        ->get();

        return view('web.owner.owner_count', compact('row_member','row_goods'));
    }
}
