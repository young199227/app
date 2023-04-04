<?php

namespace App\Http\Controllers\Admin\Test;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use App\Models\Goods;

class TestController extends Controller
{
    //測試
    public function test(Request $req)
    {
        // $row = DB::table('goods')->all();

        return view('test.vueTest');
    }

    public function test1(Request $req)
    {
        DB::table('member')->insert([
            'Member_email' => $req->member_email,
            'Member_password' => $req->member_password
        ]);

        return response()->json(["state" => true, 'message' => '新增成功']);
    }

    public function test2(Request $req)
    {
        // $row = DB::table('goods')
        // ->where('Goods_id', '=', $req->goods_id)
        // ->get();

        $row = DB::table('goods')
            ->select('*', DB::raw('(SELECT goods_img FROM goods_imges WHERE Goods_id = ' . $req->goods_id . ' LIMIT 1) as Goods_img'))
            ->where('Goods_id', '=', $req->goods_id)
            ->get();

        return $row;
    }

    public function php()
    {
        function twoSum(array $nums, int $target): array
        {
            //歷遍$nums 用$target減$nums[$i] 拿到扣除後的值
            //比如說二數之和是6 $nums[0]是2 6-2=4 再用4去尋找陣列裡面有沒有4這個值
            for ($i = 0; $i < count($nums); $i++) {

                $residue = $target - $nums[$i];

                //array_search 尋找陣列裡面有沒有扣除後的值
                //有的話$match_index=這個數字 在$nums裡面的索引值(key值)
                $match_index = array_search($residue, $nums);

                if ($match_index !== false && $match_index != $i) {
                    return array($i, $match_index);
                }
            }
            return [];
        }

        // 測試結果 
        $nums = array(2, 5, 4, 3, 2, 4);
        $target = 6;

        $result = twoSum($nums, $target);

        print_r($result);
    }

    // //判斷這個session是不是==123
    // if (session()->get('email_session') == 'dhNwdr') {
    //     echo '==';
    // }

    //map
    public function map()
    {

        if (!session()->has('demomap')) {
            return redirect()->route('fruit');
        }

        return view('test.map');
    }
    //vue
    public function vue()
    {

        if (!session()->has('demomap')) {
            return redirect()->route('fruit');
        }

        return view('test.vue');
    }


    // 雜湊函數
    public function pasw(Request $req)
    {
        //真正密碼
        $pww = '123';
        // 存在資料庫的密碼
        $pwwadd = password_hash($pww, PASSWORD_DEFAULT);

        //前面是輸入的密碼 比對
        if (password_verify($req->password, $pwwadd)) {
            echo "123";
        } else {
            echo "沒有";
        }
    }
}
