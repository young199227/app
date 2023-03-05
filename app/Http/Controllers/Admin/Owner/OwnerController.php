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
            ->paginate(7);


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
        $member_count = DB::table('member')
            ->selectRaw('count(*) AS Member_count')
            ->first();
            
        // 停權會員數量
        $member_old_count = DB::table('member')
            ->selectRaw('count(*) AS Member_count')
            ->where('Member_state','=', 2)
            ->first();

        // 上下架商品數量
        $goods_up_count = DB::table('goods')
            ->selectRaw('count(*) AS Goods_count')
            ->where('Goods_state', '=', 1)
            ->first();

        $goods_old_count = DB::table('goods')
            ->selectRaw('count(*) AS Goods_count')
            ->where('Goods_state', '=', 0)
            ->first();

        return view('web.owner.owner_count', compact('member_count','member_old_count', 'goods_up_count', 'goods_old_count'));
        
    }

    //後台管理訂單頁面（顯示所有訂單）
    public function owner_order()
    {
        
        return view('web.owner.owner_order');
    }
}
