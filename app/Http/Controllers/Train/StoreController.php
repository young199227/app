<?php

namespace App\Http\Controllers\Train;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class StoreController extends Controller
{
    //店家登入畫面
    public function store()
    {
        //有登入session的時候直接跳轉管理頁面
        if (session()->has('StoreId') && session()->has('StoreName')) {
            return view('train.store_manage');
        } else {
            return view('train.store_login');
        }
    }

    //店家管理畫面
    public function store_manage()
    {
        //有登入session才能到管理頁面
        if (session()->has('StoreId') && session()->has('StoreName')) {
            return view('train.store_manage');
        } else {
            return view('train.store_login');
        }
    }

    //店家登入
    public function store_login(Request $req)
    {
        if (!$req->filled(['storeName', 'storePw'])) {
            return response()->json(['state' => false, 'message' => '登入失敗']);
        }

        $row = DB::table('store')
            ->where('StoreName', $req->storeName)
            ->where('StorePw', $req->storePw)->get();


        //有查到帳號密碼就給一組store的session
        if (count($row) > 0) {

            session(['StoreId' => $row[0]->StoreId]);
            session(['StoreName' => $row[0]->StoreName]);

            return response()->json(['state' => true, 'message' => '登入成功']);
        }

        return response()->json(['state' => false, 'message' => '登入失敗']);
    }

    //店家詳細資料
    public function store_R()
    {
        //拿session裡面的值
        $salesId = session('StoreId');
        $salesName = session('StoreName');

        $items = DB::table('items')->where('StoreId', $salesId)->get();

        $orders = DB::table('store AS a')
            ->join('items AS b', 'a.StoreId', '=', 'b.StoreId')
            ->join('order_content AS c', 'b.ItemsId', '=', 'c.ItemsId')
            ->where('a.StoreId', $salesId)
            ->select('c.OrderId', 'b.ItemsId', 'b.ItemsName', 'b.ItemsPrice', 'c.ItemsQuantity', 'c.ItemsTotalMoney', 'c.CreatedTime')
            ->get();

        return response()->json(['salesId' => $salesId, 'salesName' => $salesName, 'items' => $items, 'orders' => $orders]);
    }

    //店家新增商品
    public function store_C(Request $req)
    {
        if (!$req->filled(['ItemsName', 'ItemsPrice', 'StoreId'])) {
            return response()->json(['state' => false, 'message' => '新增失敗']);
        }

        DB::table('items')->insert([
            'StoreId' => $req->StoreId,
            'ItemsName' => $req->ItemsName,
            'ItemsPrice' => $req->ItemsPrice
        ]);


        return response()->json(['state' => true, 'message' => '新增成功']);
    }

    //店家登出
    public function store_logout()
    {
        //清空session
        session()->flush();
        //返回登入頁面
        return view('train.store_login');
    }

    //店家修改商品
    public function store_U(Request $req)
    {
        if (!$req->filled(['ItemsName', 'ItemsPrice', 'ItemsId'])) {
            return response()->json(['state' => false, 'message' => '修改失敗']);
        }

        DB::table('items')->where('ItemsId', $req->ItemsId)->update([
            'ItemsName' => $req->ItemsName,
            'ItemsPrice' => $req->ItemsPrice
        ]);

        return response()->json(['state' => true, 'message' => '修改成功']);
    }

    //店家上下架商品
    public function store_D(Request $req)
    {
        if (!$req->filled(['ItemsId', 'ItemsState'])) {
            return response()->json(['state' => false, 'message' => '修改狀態失敗']);
        }

        DB::table('items')->where('ItemsId', $req->ItemsId)->update(['ItemsState' => $req->ItemsState]);

        return response()->json(['state' => true, 'message' => '修改成功']);
    }
}
