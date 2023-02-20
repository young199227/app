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
        if($req->filled(['member_email'])){
            $row = DB::table('member')
            ->join('goods_car', 'member.Member_id', '=', 'goods_car.Member_id')
            ->select('goods_car.*')
            ->where('member.Member_email', '=', $req->member_email)
            ->get();

        return $row;

        }else{
            return response()->json(['state'=>false,'message'=>'缺少欄位或值']);
        }

    }
}
