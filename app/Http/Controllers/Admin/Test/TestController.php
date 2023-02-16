<?php

namespace App\Http\Controllers\Admin\Test;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class TestController extends Controller
{
    //測試
    public function test(Request $req)
    {

        $member_count = DB::table('member')->selectRaw('count(*) AS Member_count')->first();

        $goods_count = DB::table('goods')->selectRaw('count(*) AS Goods_count')->first();

        return view('test',compact('member_count','goods_count'));

    }

    public function test1(Request $req){

        $value = '123';
        //下一個全域session
        session(['email_session' => $value]);
        //用key讀取他的值
        $ggyy = session('email_session');

        echo $ggyy;
    }

    public function test2(Request $req){
        //判斷這個session是不是==123
        if(session()->get('email_session')=='dhNwdr'){
            echo '==';
        }
    }

    //map
    public function map(){

        if(!session()->has('demomap')){
            return redirect()->route('fruit');
        }

        return view('map');
    }

}
