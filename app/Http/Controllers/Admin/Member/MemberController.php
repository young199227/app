<?php

namespace App\Http\Controllers\Admin\Member;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MemberController extends Controller
{
    //註冊頁面
    public function member_sign_up(){

        return view('web.member.member_sign_up');
    }

    //登入頁面
    public function member_login(){

        return view('web.member.member_login');
    }

    //會員中心（基礎頁面）
    public function member_index(){

        return view('web.member.member_index');
    }

    //會員中心（訂單頁面）
    public function member_order(Request $req){

        $member_id = $req->session()->get('member_id');

        $row = DB::table('order AS a')
        ->select('a.*','b.*','c.Goods_name', DB::raw('(SELECT goods_img FROM goods_imges WHERE Goods_id = b.Goods_id LIMIT 1) as Goods_img'))
        ->join('order_content AS b', 'a.Order_id', '=', 'b.Order_id')
        ->join('goods AS c','b.Goods_id','=','c.Goods_id')
        ->where('a.Member_id', '=', $member_id)
        ->get();

        // return $row;

        //判斷$row有沒有資料 沒有的話只傳視圖
        if ($row->isNotEmpty()) {

            return view('web.member.member_order', compact('row'));

        }else{
            return view('web.member.member_order');
        }
    }
}
