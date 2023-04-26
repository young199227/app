<?php

namespace App\Http\Controllers\Train;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SalesController extends Controller
{
    //業務登入頁面
    public function sales()
    {
        //有登入session的時候直接跳轉管理頁面
        if (session()->has('SalesId') && session()->has('SalesName')) {
            return view('train.sales_manage');
        } else {
            return view('train.sales_login');
        }
    }

    //業務管理頁面
    public function sales_manage()
    {
        //有登入session才能到管理頁面
        if (session()->has('SalesId') && session()->has('SalesName')) {
            return view('train.sales_manage');
        } else {
            return view('train.sales_login');
        }
    }

    //業務登入
    public function sales_login(Request $req)
    {
        if (!$req->filled(['salesName', 'salesPw'])) {
            return response()->json(['state' => false, 'message' => '登入失敗']);
        }

        $row = DB::table('sales')
            ->where('SalesName', $req->salesName)
            ->where('SalesPw', $req->salesPw)->get();

        //有查到帳號密碼就給一組sales的session
        if (count($row) > 0) {

            session(['SalesId' => $row[0]->SalesId]);
            session(['SalesName' => $row[0]->SalesName]);

            return response()->json(['state' => true, 'message' => '登入成功']);
        }

        return response()->json(['state' => false, 'message' => '登入失敗']);
    }

    //業務底下的全部商家
    public function sales_store_R()
    {
        //拿session裡面的值
        $salesId = session('SalesId');
        $salesName = session('SalesName');

        //用salesId查詢 所以只會拿到登入管理員所擁有的商家
        $row = DB::table('store')->where('SalesId', $salesId)->get();

        $orders = DB::table('store as a')
            ->join('items as b', 'a.StoreId', '=', 'b.StoreId')
            ->join('order_content as c', 'b.ItemsId', '=', 'c.ItemsId')
            ->select('a.SalesId', 'b.ItemsId', 'b.ItemsName', 'b.ItemsPrice', 'c.ItemsQuantity', 'c.ItemsTotalMoney', 'c.CreatedTime')
            ->where('a.SalesId', '=', $salesId)
            ->get();

        //總銷售價錢與業務獎金
        $TotalMoney = DB::table('store as a')
            ->join('items as b', 'a.StoreId', '=', 'b.StoreId')
            ->join('order_content as c', 'b.ItemsId', '=', 'c.ItemsId')
            ->selectRaw('SUM(c.ItemsTotalMoney) as TotalMoney, SUM(c.ItemsTotalMoney * 0.1) as SalesMoney')
            ->where('a.SalesId', '=', $salesId)
            ->first();

        return response()->json(['data' => $row, 'orders' => $orders, 'totalMoney' => $TotalMoney->TotalMoney, 'salesMoney' => $TotalMoney->SalesMoney,  'salesId' => $salesId, 'salesName' => $salesName]);;
    }

    //業務登出
    public function sales_logout()
    {
        //清空業務session
        session()->forget(['SalesId','SalesName']);
        //返回登入頁面
        return view('train.sales_login');
    }

    //業務新增商家
    public function store_C(Request $req)
    {
        if (!$req->filled(['StoreName', 'StorePw'])) {
            return response()->json(['state' => false, 'message' => '新增失敗']);
        }

        //拿session裡面的業務id
        $salesId = session('SalesId');

        DB::table('store')->insert([
            'SalesId' => $salesId,
            'StoreName' => $req->StoreName,
            'StorePw' => $req->StorePw
        ]);

        return response()->json(['state' => true, 'message' => '新增成功']);
    }

    //業務修改商家狀態
    public function store_state_U(Request $req)
    {
        if (!$req->filled(['StoreId', 'StoreState'])) {
            return response()->json(['state' => false, 'message' => '修改失敗']);
        }

        DB::table('store')->where('StoreId', $req->StoreId)->update(['StoreState' => $req->StoreState]);

        return response()->json(['state' => true, 'message' => '修改成功']);
    }
}
