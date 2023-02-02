<?php

namespace App\Http\Controllers\Admin\Goods;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class GoodsController extends Controller
{
    //首頁(展示頁面)
    public function index(){

        return view('web.index');
    }

    //第二首頁
    public function fruit(){

        return view('web.fruit');
    }

}
