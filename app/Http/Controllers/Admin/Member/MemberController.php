<?php

namespace App\Http\Controllers\Admin\Member;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class MemberController extends Controller
{
    public function member_sign_up(){

        return view('web.member.member_sign_up');
    }

    public function member_index(){

        return view('web.member.member_index');
    }
}
