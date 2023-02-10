<?php

namespace App\Http\Controllers\Admin\Member;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MemberApiController extends Controller
{
    //會員登入 http://127.0.0.1:8000/api/member/long
    //{"member_meail":"123","member_password":"123"}
    public function member_long(Request $req)
    {
        if ($req->filled(['member_meail', 'member_password'])) {

            $row = DB::table('member')
                ->where('Member_meail', $req->member_meail)
                ->where('Member_password', $req->member_password)
                ->first();

            if ($row) {

                session(['member' => $row->Member_meail]);

                return response()->json(['state' => true, 'message' => '登入成功', 'data' => $row->Member_meail]);
            } else {
                return response()->json(['state' => false, 'message' => '登入失敗']);
            }
        } else {
            return response()->json(['state' => false, 'message' => '缺少欄位或空值']);
        }
    }
}
