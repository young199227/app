<?php

namespace App\Http\Controllers\Admin\Owner;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OwnerApiController extends Controller
{
    //新增商品
    public function insert_goods(Request $req){

    }

    //修改商品
    public function update_goods(Request $req){

    }

    //刪除商品
    public function delete_goods(Request $req){
        //http://127.0.0.1:8000/api/owner/delete_goods {"id":"1"}
        $row = DB::table('goods')->where('Goods_id',$req->id)->delete();

        if($row){
            return response()->json(["state"=>true,"message"=>"刪除成功"]);
        }else{
            return response()->json(["state"=>false,"message"=>"刪除失敗"]);
        }
        
    }
}
