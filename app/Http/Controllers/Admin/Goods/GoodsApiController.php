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
        if ($req->filled(['member_id', 'goods_id', 'goods_count'])) {
            //UPDATE `goods_car` SET `Goods_count` = 1 WHERE Member_id = 3 AND Goods_id = 25;
            DB::table('goods_car')
                ->where('Member_id', $req->member_id)
                ->where('Goods_id', $req->goods_id)
                ->update(['Goods_count' => $req->goods_count]);

            return response()->json(['state' => true, 'message' => '修改成功']);
        } else {
            return response()->json(['state' => false, 'message' => '缺少欄位或值']);
        }
    }
    //購物車商品刪除
    //http://127.0.0.1:8000/api/goods_car/delete
    //{"member_id":3,"goods_id":25}
    public function goods_car_delete(Request $req)
    {
        if ($req->filled(['member_id', 'goods_id'])) {

            DB::table('goods_car')
                ->where('Member_id', $req->member_id)
                ->where('Goods_id', $req->goods_id)
                ->delete();

            return response()->json(['state' => true, 'message' => '修改成功']);
        } else {
            return response()->json(['state' => false, 'message' => '缺少欄位或值']);
        }
    }
    //新增購物車商品  購物車限制: 1.同種商品最多5個 2.不能有相同商品
    //http://127.0.0.1:8000/session/goods_car/add
    //{"member_id":3,"goods_id":25,"goods_count":1}
    public function goods_car_add(Request $req)
    {
        //先過濾欄位跟空值
        if ($req->filled(['member_id', 'goods_id', 'goods_count'])) {
            
            //先查詢購物車內容
            $row = DB::table('goods_car')
                ->where([
                    'Member_id' => $req->member_id,
                    'Goods_id' => $req->goods_id,
                ])->first();

            //購物車內沒有相同商品時新增新商品
            if (!$row) {

                DB::table('goods_car')->insert([
                    'Member_id' => $req->member_id,
                    'Goods_id' => $req->goods_id,
                    'Goods_count' => $req->goods_count,
                ]);
                //<<--更改message文字的話goods_only.blade.php ajax if的判斷要改!!!-->>
                return response()->json(['state' => true, 'message' => '購物車增加新商品']);

            //有相同商品時繼續往下執行
            } else {

                //當購物車相同商品超過5或等於5樣時 sql更新成只有5樣
                if (($row->Goods_count + $req->goods_count) > 5) {

                    DB::table('goods_car')
                        ->where('Member_id', $req->member_id)
                        ->where('Goods_id', $req->goods_id)
                        ->update(['Goods_count' => 5]);
                    //<<--更改message文字的話goods_only.blade.php ajax if的判斷要改!!!-->>
                    return response()->json(['state' => true, 'message' => '購物車內容最多5樣喔']);
                }
                
                //不超過5樣時 購物車count繼續往上加
                DB::table('goods_car')
                    ->where('Member_id', $req->member_id)
                    ->where('Goods_id', $req->goods_id)
                    ->update(['Goods_count' => $row->Goods_count+$req->goods_count]);
                //<<--更改message文字的話goods_only.blade.php ajax if的判斷要改!!!-->>
                return response()->json(['state' => true, 'message' => '同樣商品數量增加','goods_count'=>$row->Goods_count+$req->goods_count]);
            }
        } else {
            return response()->json(['state' => false, 'message' => '缺少欄位或值']);
        }
    }
}
