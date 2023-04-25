<?php

namespace App\Http\Controllers\Train;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class ItemsController extends Controller
{
    //商品頁面
    public function items()
    {
        //有登入session的時候直接跳轉商品頁面 沒有就會員登入畫面
        if (session()->has('CustomerId') && session()->has('Name')) {
            return view('train.items_list');
        } else {
            return view('train.customer_longin');
        }
    }

    //商品資料
    public function items_R()
    {
        //拿session裡面的值
        $CustomerId = session('CustomerId');
        $Name = session('Name');

        $items = DB::table('items')->get();

        $items_car = DB::table('items_car')->where('CustomerId', $CustomerId)->get();

        return response()->json(['items' => $items, 'items_car' => $items_car, 'CustomerId' => $CustomerId, 'Name' => $Name]);
    }
}
