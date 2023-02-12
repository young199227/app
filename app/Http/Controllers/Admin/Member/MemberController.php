<?php

namespace App\Http\Controllers\Admin\Member;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class MemberController extends Controller
{
    //註冊頁面
    public function member_sign_up(){

        return view('web.member.member_sign_up');
    }

    //登入頁面
    public function member_login(){

        return view('web.member.member_login');
    }

    //登入後的使用者中心
    public function member_index(){

        return view('web.member.member_index');
    }

}
