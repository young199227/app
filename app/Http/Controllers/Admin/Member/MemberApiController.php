<?php

namespace App\Http\Controllers\Admin\Member;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Mail;

class MemberApiController extends Controller
{
    //會員登入 http://127.0.0.1:8000/session/member/long
    //{"member_email":"123","member_password":"123"}
    public function member_long(Request $req)
    {
        if ($req->filled(['member_email', 'member_password'])) {

            $row = DB::table('member')
                ->where('Member_email', $req->member_email)
                // ->where('Member_password', $req->member_password)
                ->first();

            if ($row && password_verify($req->member_password, $row->Member_password)) {
                //如果是管理員的帳號改丟一個owner session給他
                if ($row->Member_email == 'owner') {
                    session(['owner' => $row->Member_email]);
                }
                if ($row->Member_email == 'demomap') {
                    session(['demomap' => $row->Member_email]);
                }
                session(['member' => $row->Member_email]);
                session(['member_id' => $row->Member_id]);

                return response()->json(['state' => true, 'message' => '登入成功', 'data' => $row->Member_email]);
            } else {
                return response()->json(['state' => false, 'message' => '帳號或密碼錯誤']);
            }
        } else {
            return response()->json(['state' => false, 'message' => '帳號或密碼錯誤']);
        }
    }

    //會員登出
    public function member_logout()
    {
        //清空session
        session()->flush();
        //返回首頁
        return redirect()->route('fruit');
    }

    //註冊頁面 發送email認證碼
    //http://127.0.0.1:8000/session/member/email_session
    //{"member_email":"youngsxz892@gmail.com"}
    public function email_session(Request $req)
    {
        if ($req->filled('member_email')) {

            // //查詢輸入的email是否已註冊
            $row = DB::table('member')->where('Member_email',$req->member_email)->first();
            //如果已註冊就return false
            if($row!=""){
                return response()->json(['state' => false, 'message' => 'email已註冊']);
            }

            //儲存$req的email
            $to_email = $req->member_email;

            //6位數驗證碼
            $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
            $code666 = '';
            for ($i = 0; $i < 6; $i++) {
                $code666 .= $characters[rand(0, 61)];
            }
            //信件內容
            $data = [
                'title' => '你的神奇驗證碼如下',
                'content' => $code666
            ];
            //把驗證碼存到email_session
            session(['email_session' => $code666]);

            //發送email
            Mail::send('email', $data, function ($message) use ($to_email) {
                $message->from('youngsxz8929@gmail.com', '水果人ggyy');
                $message->to($to_email);
                $message->subject('水果驗證信!');
            });

            return response()->json(['state' => true, 'message' => '發送成功']);
        } else {
            return response()->json(['state' => false, 'message' => '缺少欄位或空值']);
        }
    }

    //驗證 email_session驗證碼
    //http://127.0.0.1:8000/session/member/email_session_verify
    //{"email_session":""}
    public function email_session_verify(Request $req)
    {

        if ($req->filled('email_session')) {

            if (session()->get('email_session') == $req->email_session) {

                return response()->json(['state' => true, 'message' => '驗證成功']);
            }

            return response()->json(['state' => false, 'message' => '驗證失敗']);
        } else {
            return response()->json(['state' => false, 'message' => '缺少欄位或空值']);
        }
    }

    //會員註冊
    public function member_sign_up(Request $req)
    {
        if ($req->filled(['member_email','member_password','email_session'])) {

            if (session()->get('email_session') == $req->email_session) {

                // 把密碼弄進雜湊函數再新增進去
                $pas = password_hash($req->member_password,PASSWORD_DEFAULT);

                DB::table('member')->insert([
                    'Member_email'=>$req->member_email,
                    // 'Member_password'=>$req->member_password
                    'Member_password'=>$pas
                ]);

                return response()->json(['state' => true, 'message' => '註冊成功,請登入']);
            }

            return response()->json(['state' => false, 'message' => 'session驗證失敗']);

        } else {
            return response()->json(['state' => false, 'message' => '缺少欄位或空值']);
        }
    }

    //會員修改密碼
    //{"old_password":"123","new_password":"12345"}
    public function updata_password(Request $req)
    {
        if($req->filled(['old_password','new_password'])){


            $see = session()->get('member');

                $row = DB::table('member')
                ->where('Member_email',$see)
                // ->where('Member_password',$req->old_password)
                ->first();

                if($row && password_verify($req->old_password, $row->Member_password)){
                    
                    // 把密碼弄進雜湊函數再新增進去
                    $pas = password_hash($req->new_password,PASSWORD_DEFAULT);

                    DB::table('member')
                    ->where('Member_email',$see)
                    // ->where('Member_password',$req->old_password)
                    ->update(['Member_password'=>$pas]);
                    
                    return response()->json(['state' => true, 'message' => '修改成功,請重新登入']);
                    
                }else{
                    return response()->json(['state' => false, 'message' => '舊密碼錯誤']);
                }
        }else{
            return response()->json(['state' => false, 'message' => '缺少欄位或空值']);
        }
    }
}
