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
    //http://127.0.0.1:8000/api/goods_car/count_update
    //{"member_id":3,"goods_id":25,"goods_count":"1"}
    public function goods_car_count_update(Request $req)
    {
        if($req->filled(['member_id','goods_id','goods_count'])){
            //UPDATE `goods_car` SET `Goods_count` = 1 WHERE Member_id = 3 AND Goods_id = 25;
            DB::table('goods_car')
            ->where('Member_id',$req->member_id)
            ->where('Goods_id',$req->goods_id)
            ->update(['Goods_count'=>$req->goods_count]);

            return response()->json(['state' => true, 'message' => '修改成功']);
            
        }else{
            return response()->json(['state' => false, 'message' => '缺少欄位或值']);
        }
    }
    //購物車商品刪除
    public function goods_car_delete(Request $req)
    {
        if($req->filled(['member_id','goods_id'])){

            DB::table('goods_car')
            ->where('Member_id',$req->member_id)
            ->where('Goods_id',$req->goods_id)
            ->delete();

            return response()->json(['state' => true, 'message' => '修改成功']);

        }else{
            return response()->json(['state'=>false,'message'=>'缺少欄位或值']);
        }
    }
}
