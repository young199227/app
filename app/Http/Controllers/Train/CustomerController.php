<?php

namespace App\Http\Controllers\Train;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CustomerController extends Controller
{
    //顧客登入頁面
    public function customer()
    {
        //有登入session的時候直接跳轉商品頁面 沒有就會員登入畫面
        if (session()->has('CustomerId') && session()->has('Name')) {
            return view('train.items_list');
        } else {
            return view('train.customer_longin');
        }
    }

    //顧客登入
    public function customer_login(Request $req)
    {
        if (!$req->filled(['CustomerName', 'CustomerIDnumber'])) {
            return response()->json(['state' => false, 'message' => '登入失敗']);
        }

        $row = DB::table('customer')
            ->where('Name', $req->CustomerName)
            ->where('IDnumber', $req->CustomerIDnumber)->get();

        //有查到帳號密碼就給一組store的session
        if (count($row) > 0) {

            session(['CustomerId' => $row[0]->CustomerId]);
            session(['Name' => $row[0]->Name]);

            return response()->json(['state' => true, 'message' => '登入成功']);
        }

        return response()->json(['state' => false, 'message' => '登入失敗']);
    }

    //顧客登出
    public function customer_logout()
    {
        //清空顧客session
        session()->forget(['CustomerId','Name']);
        //返回登入頁面
        return view('train.customer_longin');
    }

    //顧客把商品加入購物車
    public function add_car(Request $req)
    {
        if (!$req->filled(['CustomerId', 'ItemsId', 'ItemsPrice'])) {
            return response()->json(['state' => false, 'message' => '加入失敗']);
        }

        //先查同個顧客購物車內有沒有相同商品
        $row = DB::table('items_car')
            ->where('CustomerId', $req->CustomerId)
            ->where('ItemsId', $req->ItemsId)
            ->get();
        //如果有就在原本的數量上+1 順便算好價錢
        if (count($row) > 0) {
            DB::table('items_car')
                ->where('CustomerId', $req->CustomerId)
                ->where('ItemsId', $req->ItemsId)
                ->update([
                    'ItemsQuantity' => $row[0]->ItemsQuantity + 1,
                    'ItemsTotalMoney' => ($row[0]->ItemsQuantity + 1) * $req->ItemsPrice
                ]);
            return response()->json(['state' => true, 'message' => '加入成功']);
        }

        //沒有相同商品單純+1
        DB::table('items_car')->insert([
            'CustomerId' => $req->CustomerId,
            'ItemsId' => $req->ItemsId,
            'ItemsQuantity' => 1,
            'ItemsTotalMoney' => $req->ItemsPrice
        ]);

        return response()->json(['state' => true, 'message' => '加入成功']);
    }

    //顧客移除購物車商品
    public function car_D(Request $req)
    {
        if (!$req->filled(['CustomerId', 'ItemsId'])) {
            return response()->json(['state' => false, 'message' => '移除失敗']);
        }

        DB::table('items_car')
            ->where('CustomerId', $req->CustomerId)
            ->where('ItemsId', $req->ItemsId)
            ->delete();

        return response()->json(['state' => true, 'message' => '移除成功']);
    }

    //顧客確認購買新增訂單
    public function add_order(Request $req)
    {
        if (!$req->filled(['CustomerId'])) {
            return response()->json(['state' => false, 'message' => '新增失敗']);
        }

        //先用id查詢購物車內容
        $car = DB::table('items_car')->where('CustomerId', $req->CustomerId)->get();

        //算出購物車總金額 $orderMoney = 訂單總金額
        $orderMoney = 0;
        for ($i = 0; $i < count($car); $i++) {
            $orderMoney += $car[$i]->ItemsTotalMoney;
        }

        //交易語法(確保資料庫一致性) 
        DB::transaction(function () use ($req, $car, $orderMoney) {

            //先用顧客id新增一張訂單 附上訂單總金額
            DB::table('order')
                ->insert([
                    'CustomerId' => $req->CustomerId,
                    'OrderMoney' => $orderMoney
                ]);

            //再用顧客id查詢最新增加的顧客訂單
            $newOrder = DB::table('order')
                ->where('CustomerId', $req->CustomerId)
                ->orderBy('CustomerId', 'desc')
                ->first();
            
            //再把購物車的內容迴圈增加到最新的訂單上
            for ($i = 0; $i < count($car); $i++) {

                DB::table('order_content')
                 ->insert([
                        'OrderId'=> $newOrder->OrderId,
                        'ItemsId'=> $car[$i]->ItemsId,
                        'ItemsQuantity'=>$car[$i]->ItemsQuantity,
                        'ItemsTotalMoney'=> $car[$i]->ItemsTotalMoney
                 ]);
            }

            //成功後把原有的購物車內容刪除
            DB::table('items_car')->where('CustomerId',$req->CustomerId)->delete();
        });

        return response()->json(['state' => false, 'message' => '新增訂單成功']);
    }
}
