<?php

namespace App\Http\Controllers\Admin\Owner;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class OwnerApiController extends Controller
{
    //新增商品 http://127.0.0.1:8000/api/owner/insert_goods
    //{"goods_name":"蘋果","goods_money":"100","goods_sum":"1","goods_area":"南投","goods_detail":"超級好吃喔"} 
    public function insert_goods(Request $req)
    {
        //filled檢查欄位&&空值
        if ($req->filled(['goods_name', 'goods_money', 'goods_sum', 'goods_area', 'goods_detail'])) {

            $row = DB::table('goods')->insert([
                'Goods_name' => $req->goods_name,
                'Goods_money' => $req->goods_money,
                'Goods_sum' => $req->goods_sum,
                'Goods_area' => $req->goods_area,
                'Goods_detail' => $req->goods_detail
            ]);

            return response()->json(["state" => true, "message" => "新增成功"]);
        } else {
            return response()->json(["state" => false, "message" => "新增失敗"]);
        }
    }

    //修改商品 http://127.0.0.1:8000/api/owner/update_goods
    public function update_goods(Request $req)
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

    //刪除商品 http://127.0.0.1:8000/api/owner/delete_goods {"id":"1"}
    public function delete_goods(Request $req)
    {
        $row = DB::table('goods')->where('Goods_id', $req->id)->delete();

        if ($row) {
            return response()->json(["state" => true, "message" => "刪除成功"]);
        } else {
            return response()->json(["state" => false, "message" => "刪除失敗"]);
        }
    }

    //備案
        // return response()->json(["state" => true, "message" => "新增成功"]);
        // $array =  array($req->id,$filename);

        // if($req->filled(['id'])){

        //     if($req->hasFile('ggyy')){

        //         $image = $req->file('ggyy');
        //         $filename = $image->getClientOriginalName();
        //         $uploadPic = Storage::disk('publicFruit')->put($filename,file_get_contents($image->getRealPath()));

        //         return response()->json(["state" => true, "message" => $req->id]);
        //     }

        //     return response()->json(["state" => false, "message" => ""]);
        // } else {
        //     return response()->json(["state" => false, "message" => ""]);
        // }
}
