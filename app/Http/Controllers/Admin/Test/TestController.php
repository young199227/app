<?php

namespace App\Http\Controllers\Admin\Test;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TestController extends Controller
{

    //顯示商品管理頁面
    public function test_index (Request $seq)
    {
        $row = DB::table('goods')->get();

        return view('web.test.owner_index',compact('row'));
    }

    //把商品值帶過ㄑ並顯示
    public function test_update (Request $req,$goods_id)
    {
        $row = DB::table('goods')->where('goods_id',$goods_id)->first();

        // return $row;

        return view('web.test.owner_update_goods',compact('row'));
    }

    //商品更新
    public function test_upload (Request $req)
    {
        if ($req->filled(['Goods_name', 'Goods_money', 'Goods_sum', 'Goods_area', 'Goods_detail'])) {

            $row =
            DB::table('goods')->
            where('Goods_id',$req->Goods_id)->
            update([
                    'Goods_name' => $req -> Goods_name,
                    'Goods_money' => $req -> Goods_money,
                    'Goods_sum' => $req -> Goods_sum,
                    'Goods_area' => $req -> Goods_area,
                    'Goods_detail' => $req -> Goods_detail,
            ]);

            if ($row) {
                return response()->json(["state" => true, "message" => "更新成功"]);
            } else {
                return response()->json(["state" => false, "message" => "更新失敗或資料一樣沒更新"]);
            }
        }else{
            return response()->json(["state" => false, "message" => "缺少欄位或沒有值"]);
        }
    }

}
