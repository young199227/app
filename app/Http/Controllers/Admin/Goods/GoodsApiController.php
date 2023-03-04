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
                    ->update(['Goods_count' => $row->Goods_count + $req->goods_count]);
                //<<--更改message文字的話goods_only.blade.php ajax if的判斷要改!!!-->>
                return response()->json(['state' => true, 'message' => '同樣商品數量增加', 'goods_count' => $row->Goods_count + $req->goods_count]);
            }
        } else {
            return response()->json(['state' => false, 'message' => '缺少欄位或值']);
        }
    }

    //購物車頁面按下去買單撈出購物車內容
    public function goods_car_list(Request $req)
    {
        if ($req->filled(['member_id'])) {

            $row = DB::table('goods_car AS a')
                ->select('a.*', 'b.*', DB::raw('(SELECT goods_img FROM goods_imges WHERE goods_id = b.goods_id LIMIT 1) as Goods_img'))
                ->join('goods AS b', 'a.Goods_id', '=', 'b.Goods_id')
                ->where('a.Member_id', '=', 3)
                ->get();

            return $row;
        } else {
            return response()->json(['state' => false, 'message' => '缺少欄位或值']);
        }
    }
    //購物車新增訂單
    public function add_order(Request $req)
    {
        if ($req->filled(['member_id', 'member_name', 'member_area', 'member_phone', 'order_money'])) {

            //交易語法(確保資料庫一致性)
            DB::transaction(function () use ($req) {

                //新增一筆訂單
                DB::table('order')->insert([
                    'Member_id' => $req->member_id,
                    'Member_name' => $req->member_name,
                    'Member_area' => $req->member_area,
                    'Member_phone' => $req->member_phone,
                    'Order_money' => $req->order_money,
                ]);

                //查詢這個會員的購物車內容
                $row = DB::table('goods_car')->where('Member_id', $req->member_id)->get();

                //查詢最新增加的訂單
                $order = DB::table('order')->orderBy('Order_id', 'desc')->first();

                //在最新的訂單,迴圈增加訂單內容
                for ($i = 0; $i < count($row); $i++) {
                    DB::table('order_content')->insert([
                        'Order_id' => $order->Order_id,
                        'Goods_id' => $row[$i]->Goods_id,
                        'Order_goods_count' => $row[$i]->Goods_count
                    ]);
                }

                //新增訂單後清空購物車
                DB::table('goods_car')->where('Member_id',$req->member_id)->delete();
            });

            return response()->json(['state' => true, 'message' => '成功購買!']);
        } else {
            return response()->json(['state' => false, 'message' => '缺少欄位或值']);
        }
    }
}
