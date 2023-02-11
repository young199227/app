<?php

namespace App\Http\Controllers\Admin\Member;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Routing\Redirector;

class MemberApiController extends Controller
{
    //會員登入 http://127.0.0.1:8000/api/member/long
    //{"member_meail":"123","member_password":"123"}
    public function member_long(Request $req)
    {
        if ($req->filled(['member_email', 'member_password'])) {

            $row = DB::table('member')
                ->where('Member_email', $req->member_email)
                ->where('Member_password', $req->member_password)
                ->first();

            if ($row) {

                $member_session = $row->Member_email;
                session(['member' => $member_session]);

                return response()->json(['state' => true, 'message' => '登入成功', 'data' => $row->Member_email]);
            } else {
                return response()->json(['state' => false, 'message' => '登入失敗']);
            }
        } else {
            return response()->json(['state' => false, 'message' => '缺少欄位或空值']);
        }
    }

    //會員登出
    public function member_logout(){

        session()->flush();

        return redirect()->route('fruit');
    }
}
