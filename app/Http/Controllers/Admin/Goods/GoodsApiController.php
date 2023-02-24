<?php

namespace App\Http\Controllers\Admin\Goods;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class GoodsApiController extends Controller
{
    //購物車數量(紅點)
    public function goods_car_count(Request $req)
    {
        if ($req->filled(['member_email'])) {

            $row = DB::table('member')
                ->join('goods_car', 'member.Member_id', '=', 'goods_car.Member_id')
                ->select('goods_car.*')
                ->where('member.Member_email', '=', $req->member_email)
                ->get();

            return $row;
        } else {
            return response()->json(['state' => false, 'message' => '缺少欄位或值']);
        }
    }
    //購物車數量更新
    public function goods_car_count_update(Request $req)
    {
        if($req->filled(['member_id','goods_id','goods_count'])){

            return "123";
            
        }else{
            return response()->json(['state' => false, 'message' => '缺少欄位或值']);
        }
    }
    //購物車商品刪除
    public function goods_car_delete(Request $req)
    {

    }
}
