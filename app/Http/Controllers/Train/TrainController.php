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

        return view('train.train4');
    }

    //新增
    public function train4_C(Request $req)
    {   
        //新增時生日,電話,住址 base64加密
        DB::table('user')->insert([
            'Name' => $req->name,
            'IDnumber' => $req->idnumber,
            'Birthday' => base64_encode($req->birthday),
            'Phone' => base64_encode($req->phone),
            'Postalcode' => $req->postalcode,
            'Address' => base64_encode($req->address)
        ]);
    }

    //查詢全部user
    public function train4_R(Request $req)
    {
        $row = DB::table('user')->orderByDesc('id')->get();

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

        $row = DB::table('user')->where('id', $req->userID)->get();

        //解密
        $row[0]->Birthday = base64_decode($row[0]->Birthday);
        $row[0]->Phone = base64_decode($row[0]->Phone);
        $row[0]->Address = base64_decode($row[0]->Address);

        return $row;
    }

    //依id修改user資料
    public function train4_U(Request $req)
    {
        DB::table('user')->where("id",$req->userID)
        ->update([
            'Name' => $req->name,
            'IDnumber' => $req->idnumber,
            'Birthday' => base64_encode($req->birthday),
            'Phone' => base64_encode($req->phone),
            'Postalcode' => $req->postalcode,
            'Address' => base64_encode($req->address)
        ]);
    }

    //依id刪除user
    public function train4_D(Request $req)
    {
        DB::table('user')->where('id',$req->userID)->delete();
    }
}
