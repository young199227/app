<?php

namespace App\Http\Controllers\Admin\Test;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use App\Models\Goods;
use Illuminate\Support\Facades\Http;

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
        // LINE Messaging API URL
        $url = 'https://api.line.me/v2/bot/message/broadcast';

        // LINE Channel Access Token
        $channelAccessToken = 'blFCEUm/yeOEVInfAcGe+9sHG9mIZxYAUQPZEwvDxSu65WT6pglb+/mCNj5PNDemgrRh4N2/Hrz+dwnc1scOE95IldCEiCoKDoW5t7aPoxG6MoRiQNiXfxvVrYwpHahhjYKuwsxpf4lr5hzpzwTPpgdB04t89/1O/w1cDnyilFU=';

        // LINE Message Data
        $data = [
            'messages' => [
                [
                    'type' => 'text',
                    'text' => '$$$新增了一筆訂單:編號',
                    'emojis' => [
                        [
                            'index' => 0,
                            'productId' => "5ac22c9e031a6752fb806d68",
                            'emojiId' => "040"
                        ],
                        [
                            'index' => 1,
                            'productId' => "5ac22c9e031a6752fb806d68",
                            'emojiId' => "041"
                        ],
                        [
                            'index' => 2,
                            'productId' => "5ac22c9e031a6752fb806d68",
                            'emojiId' => "042"
                        ],
                    ]
                ]
            ]
        ];

        // 使用 Laravel HTTP 客户端发送请求
        $response = Http::withHeaders([
            'Content-Type' => 'application/json',
            'Authorization' => 'Bearer ' . $channelAccessToken,
        ])->withOptions([
            'verify' => false,
        ])->post($url, $data);


        // 检查是否有错误或根据需要处理响应
        if ($response->failed()) {
            return response()->json(['state' => false, 'message' => 'LINE API失敗' . $response->body()]);
        }
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
