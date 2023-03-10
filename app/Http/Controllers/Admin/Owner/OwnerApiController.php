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
        if ($req->filled(['goods_name', 'goods_money', 'goods_sum', 'goods_area', 'goods_detail']) && $req->hasFile('ggyy00')) {

            $row = DB::table('goods')->insert([
                'Goods_name' => $req->goods_name,
                'Goods_money' => $req->goods_money,
                'Goods_sum' => $req->goods_sum,
                'Goods_area' => $req->goods_area,
                'Goods_detail' => $req->goods_detail
            ]);

            if ($row) {

                //查詢最新新增的商品
                $id = DB::table('goods')->select('Goods_id')->orderByDesc('Goods_id')->first();

                //把$req圖片名稱存到$img_array
                $img_array = array($req->file('ggyy00'), $req->file('ggyy01'), $req->file('ggyy02'), $req->file('ggyy03'), $req->file('ggyy04'), $req->file('ggyy05'));
                //array_filter刪除陣列空值
                $img_array_filter = array_filter($img_array);

                //再用count($img_array_filter)跑迴圈的次數
                for ($i = 0; $i < count($img_array_filter); $i++) {

                    $image = $img_array[$i];
                    $imageType = explode(".", $image->getClientOriginalName());
                    $imageName = $id->Goods_id . '_' . $i . '.' . $imageType[1];
                    Storage::disk('publicFruit')->put($imageName, file_get_contents($image->getRealPath()));

                    //把圖片名稱存到資料庫
                    $row = DB::table('goods_imges')->insert([
                        'Goods_id' => $id->Goods_id,
                        'Goods_img' => '/storage/images/' . $imageName
                    ]);
                }

                return response()->json(["state" => true, "message" => "新增成功"]);
            } else {
                return response()->json(["state" => false, "message" => "新增失敗資料庫問題"]);
            }
        } else {
            return response()->json(["state" => false, "message" => "新增失敗缺少欄位或值"]);
        }
    }

    //修改商品 http://127.0.0.1:8000/api/owner/update_goods
    public function update_goods(Request $req)
    {

        if ($req->filled(['goods_name', 'goods_money', 'goods_sum', 'goods_area', 'goods_detail'])) {

            $row =
                DB::table('goods')->where('Goods_id', $req->goods_id)->update([
                    'Goods_name' => $req->goods_name,
                    'Goods_money' => $req->goods_money,
                    'Goods_sum' => $req->goods_sum,
                    'Goods_area' => $req->goods_area,
                    'Goods_detail' => $req->goods_detail,
                ]);

            if ($row) {

                //如果圖片沒有值(使用者沒上傳圖片)
                //圖片就不會改動
                if($req->file('ggyy00')==""&&$req->file('ggyy01')==""&&$req->file('ggyy02')==""&&$req->file('ggyy03')==""&&$req->file('ggyy04')==""&&$req->file('ggyy05')==""){
                    return response()->json(["state" => true, "message" => "更新成功"]);
                }

                //把$req圖片名稱存到$img_array
                $img_array = array($req->file('ggyy00'), $req->file('ggyy01'), $req->file('ggyy02'), $req->file('ggyy03'), $req->file('ggyy04'), $req->file('ggyy05'));
                //array_filter刪除陣列空值
                $img_array_filter = array_filter($img_array);

                $row = DB::table('goods_imges')->where('Goods_id', $req->goods_id)->delete();

                //再用count($img_array_filter)跑迴圈的次數
                for ($i = 0; $i < count($img_array_filter); $i++) {

                    $image = $img_array[$i];
                    $imageType = explode(".", $image->getClientOriginalName());
                    $imageName = $req->goods_id . '_' . $i . '.' . $imageType[1];
                    Storage::disk('publicFruit')->put($imageName, file_get_contents($image->getRealPath()));

                    //把圖片名稱存到資料庫
                    $row = DB::table('goods_imges')->insert([
                        'Goods_id' => $req->goods_id,
                        'Goods_img' => '/storage/images/' . $imageName
                    ]);
                }

                return response()->json(["state" => true, "message" => "更新成功"]);
            } else {
                return response()->json(["state" => false, "message" => "資料無變動,修改失敗"]);
            }
        } else {
            return response()->json(["state" => false, "message" => "缺少欄位或沒有值"]);
        }
    }

    //下架商品 http://127.0.0.1:8000/api/owner/delete_goods {"id":"1"}
    public function delete_goods(Request $req)
    {
        $row = DB::table('goods')->where('Goods_id', $req->id)->update(['Goods_state' => 0]);

        if ($row) {
            return response()->json(["state" => true, "message" => "下架成功"]);
        } else {
            return response()->json(["state" => false, "message" => "下架失敗"]);
        }
    }

    //上架商品 http://127.0.0.1:8000/api/owner/up_goods {"id":"1"}
    public function up_goods(Request $req)
    {

        $row = DB::table('goods')->where('Goods_id', $req->id)->update(['Goods_state' => 1]);

        if ($row) {
            return response()->json(["state" => true, "message" => "上架成功"]);
        } else {
            return response()->json(["state" => false, "message" => "上架失敗"]);
        }
    }

    // 停權會員 http://127.0.0.1:8000/api/owner/delete_member {"id":"2"}
    public function delete_member(Request $req)
    {

        $row = DB::table('member')->where('Member_id', $req->id)->update(['Member_state' => 2]);

        if ($row) {
            return response()->json(["state" => true, "message" => "停權成功"]);
        } else {
            return response()->json(["state" => false, "message" => "停權失敗"]);
        }
    }

    // 恢復會員 http://127.0.0.1:8000/api/owner/up_member {"id":"2"}
    public function up_member(Request $req)
    {

        $row = DB::table('member')->where('Member_id', $req->id)->update(['Member_state' => 1]);

        if ($row) {
            return response()->json(["state" => true, "message" => "恢復成功"]);
        } else {
            return response()->json(["state" => false, "message" => "恢復失敗"]);
        }
    }

    // 撈取訂單資料 http://127.0.0.1:8000/api/owner/read_order
    public function read_order(Request $req)
    {

        if ($req->filled(['order_state'])) {

            $row = DB::table('order AS a')
                ->select('a.*', 'b.*', 'c.Goods_name', DB::raw('(SELECT goods_img FROM goods_imges WHERE Goods_id = b.Goods_id LIMIT 1) as Goods_img'))
                ->join('order_content AS b', 'a.Order_id', '=', 'b.Order_id')
                ->join('goods AS c', 'b.Goods_id', '=', 'c.Goods_id')
                ->where('a.Order_state', $req->order_state)
                ->get();

            if ($row) {
                return response()->json(["state" => true, "message" => "讀取成功", "data" => json_decode($row)]);
            } else {
                return response()->json(["state" => false, "message" => "讀取失敗"]);
            }
        } else {
            return response()->json(["state" => false, "message" => "缺少欄位或值"]);
        }
    }

    // 修改訂單資料 http://127.0.0.1:8000/api/owner/update_order
    public function update_order(Request $req)
    {
        if ($req->filled(['order_id','order_state'])) {

            DB::table('order')
            ->where('Order_id',$req->order_id)
            ->update([
                'Order_state'=>$req->order_state
            ]);

            return response()->json(["state" => true, "message" => "修改成功"]);
        } else {
            return response()->json(["state" => false, "message" => "缺少欄位或值"]);
        }
    }

    // 撈取未處理訂單數量(紅點) http://127.0.0.1:8000/api/owner/unprocessed_order_count
    public function unprocessed_order_count()
    {

        $row = DB::table('order')->where('Order_state', 1)->get();

        if ($row) {
            return response()->json(["state" => true, "message" => "讀取成功", "data" => count($row)]);
        } else {
            return response()->json(["state" => false, "message" => "讀取失敗"]);
        }
    }

    // 撈取會員統計資料
    public function read_member_count()
    {

        $member_count = DB::table('member')
            ->select('Member_created_at', 'Member_id', 'Member_state')
            ->get();

        if ($member_count) {
            return response()->json(["state" => true, "message" => "讀取成功", "data" => json_decode($member_count)]);
        } else {
            return response()->json(["state" => false, "message" => "讀取失敗"]);
        }
    }

    // 撈取商品統計資料
    public function read_goods_count()
    {

        $goods_count = DB::table('goods')
            ->select('Goods_created_at', 'Goods_id', 'Goods_state')
            ->get();

        if ($goods_count) {
            return response()->json(["state" => true, "message" => "讀取成功", "data" => json_decode($goods_count)]);
        } else {
            return response()->json(["state" => false, "message" => "讀取失敗"]);
        }
    }

    // 撈取訂單統計資料 state=1進行中 state=2已完成 state=0已取消
    public function read_order_count()
    {

        $order_count = DB::table('order')
            ->select('*')
            ->get();

        if ($order_count) {
            return response()->json(["state" => true, "message" => "讀取成功", "data" => json_decode($order_count)]);
        } else {
            return response()->json(["state" => false, "message" => "讀取失敗"]);
        }
    }

    // //圖片上傳
    // $image = $req->file('ggyy');
    // $filename = $image->getClientOriginalName();
    // $uploadPic = Storage::disk('publicFruit')->put($filename, file_get_contents($image->getRealPath()));
}
