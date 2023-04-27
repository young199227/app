<?php

namespace App\Http\Controllers\Train;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class TrainController extends Controller
{
    //頁面顯示
    public function train4(Request $req)
    {
        return view('train.train5');
    }

    //train6
    public function train6()
    {
        return view('train.train6');
    }

    //新增
    public function train4_C(Request $req)
    {
        //正則表達
        $userNameRegex = "/^[a-zA-Z0-9]{3,10}$/"; //姓名
        $userIDnumberRegex = "/^[A-Z0-9]{2,10}$/"; //身分證字號
        $userPhoneRegex = "/^[0-9]{2,10}$/"; //電話

        if (
            !preg_match($userNameRegex, $req->name) ||
            !preg_match($userIDnumberRegex, $req->idnumber) ||
            !preg_match($userPhoneRegex, $req->phone) ||
            $req->birthday == "" || //生日,郵遞區號,住址 不能為空
            $req->postalcode == "" ||
            $req->address == ""
        ) {
            return response()->json(['state' => false, 'message' => '欄位值有誤']);
        }

        //身分證重複驗證開關打勾時會驗證
        if ($req->idnumberCheck) {

            //用使用者輸入的身分證查詢有沒有相同的
            $row = DB::table('customer')->where('IDnumber', $req->idnumber)->get();

            //有查到資料就回json格式的錯誤訊息
            if ($row->isNotEmpty()) {

                return response()->json(['state' => false, 'message' => '身分證重複囉']);
            }
        }

        //新增時生日,電話,住址 base64加密
        DB::table('customer')->insert([
            'Name' => $req->name,
            'IDnumber' => $req->idnumber,
            'Birthday' => base64_encode($req->birthday),
            'Phone' => base64_encode($req->phone),
            'Postalcode' => $req->postalcode,
            'Address' => base64_encode($req->address)
        ]);

        return response()->json(['state' => true, 'message' => '新增成功']);
    }

    //查詢全部user
    public function train4_R(Request $req)
    {

        $row = DB::table('customer')->orderByDesc('CustomerId')->get();

        //迴圈 生日,電話,住址 base64解密
        for ($i = 0; $i < count($row); $i++) {

            $row[$i]->Birthday = base64_decode($row[$i]->Birthday);
            $row[$i]->Phone = base64_decode($row[$i]->Phone);
            $row[$i]->Address = base64_decode($row[$i]->Address);
        }

        return $row;
    }

    //用id查詢單個user
    public function train4_R_one(Request $req)
    {

        $row = DB::table('customer')->where('CustomerId', $req->userID)->get();

        //解密
        $row[0]->Birthday = base64_decode($row[0]->Birthday);
        $row[0]->Phone = base64_decode($row[0]->Phone);
        $row[0]->Address = base64_decode($row[0]->Address);

        return $row;
    }

    //依id修改user資料
    public function train4_U(Request $req)
    {
        //正則表達
        $userNameRegex = "/^[a-zA-Z0-9]{3,10}$/"; //姓名
        $userIDnumberRegex = "/^[A-Z0-9]{2,10}$/"; //身分證字號
        $userPhoneRegex = "/^[0-9]{2,10}$/"; //電話

        if (
            !preg_match($userNameRegex, $req->name) ||
            !preg_match($userIDnumberRegex, $req->idnumber) ||
            !preg_match($userPhoneRegex, $req->phone) ||
            $req->birthday == "" || //生日,郵遞區號,住址 不能為空
            $req->postalcode == "" ||
            $req->address == ""
        ) {
            return response()->json(['state' => false, 'message' => '欄位值有誤']);
        }

        //身分證重複驗證開關打勾時會驗證
        if ($req->idnumberCheck) {

            //用使用者輸入的身分證查詢有沒有相同的
            $row = DB::table('customer')->where('IDnumber', $req->idnumber)->get();

            //有查到資料就回json格式的錯誤訊息
            if ($row->isNotEmpty()) {

                return response()->json(['state' => false, 'message' => '身分證重複囉']);
            }
        }

        DB::table('customer')->where("CustomerId", $req->userID)
            ->update([
                'Name' => $req->name,
                'IDnumber' => $req->idnumber,
                'Birthday' => base64_encode($req->birthday),
                'Phone' => base64_encode($req->phone),
                'Postalcode' => $req->postalcode,
                'Address' => base64_encode($req->address)
            ]);

        return response()->json(['state' => true, 'message' => '修改成功']);
    }

    //依id刪除user
    public function train4_D(Request $req)
    {
        DB::table('customer')->where('CustomerId', $req->userID)->delete();
    }
}
