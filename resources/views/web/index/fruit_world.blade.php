<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fruit world</title>
    <link rel="shortcut icon" href="/img/tree.png" type="image/x-icon">
    <link rel="stylesheet" href="/css/bootstrap.min.css">
    <link rel="stylesheet" href="/css/mycolor.css">
    <link rel="stylesheet" href="/css/all.min.css">
    <link rel="stylesheet" href="/css/animate.min.css">
    <style>
        * {
            font-family: Arial, Helvetica, sans-serif;
        }

        .header {
            height: 150px;
            /* background-color: rgb(186, 220, 165); */
            background-image: url(/img/flower.png);
        }

        .main a {
            /* text-decoration: none; */
            color: var(--grey03);
        }

        .main ul {
            list-style: decimal;
            line-height: 36px;
        }

        .footer {
            height: 150px;
            background-color: withe;
            background-image: url(/img/flower.png);
        }
    </style>
</head>

<body>

    <div class="header">

    </div>

    <div class="main">
        <div class="container">

            <!-- 大標 -->
            <div class="row mt-5">
                <div class="col-6 offset-3">

                    <div class="fs-1 fw-bold">Fruit World</div>
                    <hr>

                    <div class="">專題網址：<a href="http://43.206.108.197/">http://43.206.108.197/</a></div>
                    <div class="mt-2">GitHub：<a href="https://github.com/young199227/app">https://github.com/young199227/app</a></div>
                    <hr>

                </div>
            </div>

            <!-- 簡介 -->
            <div class="row mt-3">
                <div class="col-6 offset-3">

                    <p class="fs-3 fw-bold">專題簡介</p>

                    <p class="mt-2">這是一個在LAMP環境下寫的水果購物網站專題(Linux + Apache + MySQL + PHP)</p>
                    <p class="mt-2">使用了laravel框架,架設在aws雲端(網址ip問題是因為沒錢買網域QQ)</p>
                    <p class="mt-4">快速測試請使用以下二組帳號<br>網站管理者－帳號：owner 密碼：123456<br>內建會員－帳號：123 密碼：123456</p>
                    <p class="mt-4">下面是網站詳細內容</p>

                    <hr class="mt-2">

                </div>
            </div>

            <!-- 簡介 -->
            <div class="row mt-3">
                <div class="col-6 offset-3">

                    <p class="fs-3 fw-bold">ER Model</p>

                    <img src="/img/ER關聯圖.png" class="" >

                    <hr class="mt-5">
                </div>
            </div>

            <!-- 網站 -->
            <div class="row mt-3">
                <div class="col-6 offset-3">

                    <p class="fs-3 fw-bold">網站頁面簡介</p>

                    <ul>
                        <li>形象頁面（引導進入網站）</li>
                        <li>商場首頁（輪播圖、多樣分類）</li>
                        <li>商品列表（價錢分類、項目分類）</li>
                        <li>商品查詢（可直接查詢相關名稱、搜尋欄）</li>
                        <li>商品獨立頁面（預覽圖片、名稱、金額、產地、紙箱規格表、購物車、直購：如購物車內有相同商品直接上加）</li>
                        <li>商品購物車（可直接更改商品數量、數量最多限制為五箱、刪除商品）</li>
                        <li>會員中心頁面（會員專屬）</li>
                        <li>後台頁面（網站管理者專屬）</li>
                    </ul>

                    <hr class="mt-5">
                </div>
            </div>

            <!-- 使用者 -->
            <div class="row mt-3">
                <div class="col-6 offset-3">

                    <p class="fs-3 fw-bold">三種使用者簡介</p>


                    <p class="fs-5 fw-bold mt-5">非會員</p>
                    <ul>
                        <li>遊覽網站、觀看商品</li>
                        <li>可查詢商品（查詢”果”：蘋果、富士蘋果⋯⋯）</li>
                        <li>註冊功能（驗證信箱、驗證碼功能、限制密碼長度６～１２）</li>
                        <li>登入功能（執行註冊完後自動跳轉登入頁面，或網站首頁右上登入）</li>
                        <li>點擊購物車、直接購買商品 跳轉註冊畫面（判斷有無會員）</li>
                    </ul>

                    <p class="fs-5 fw-bold mt-5">會員（內建會員 帳號:123 密碼:123456）</p>
                    <ul>
                        <li>使用購物車（可更改商品數量、刪除）</li>
                        <li>下訂單購買商品（訂單確認內容金額、勾選確認送出）</li>
                        <li>瀏覽過往訂單（包含金額、收件人、電話、地址、訂單狀態、購物商品）</li>
                        <li>修改密碼（須有舊密碼、新密碼、確認密碼）</li>
                        <li>會員中心（可看註冊信箱）</li>
                        <li>置頂購物車紅點（顯示購物車內有多少商品）</li>
                    </ul>

                    <p class="fs-5 fw-bold mt-5">網站管理者（帳號:owner 密碼:123456）</p>
                    <ul>
                        <li>上傳商品（設置圖片、名稱、產地、數量、敘述）</li>
                        <li>管理商品（修改商品內容、可上下架商品（下架後商品列表會消失））</li>
                        <li>管理會員（正常使用、停權（無法登入））</li>
                        <li>管理訂單（修改狀態：進行中、完成、取消）</li>
                        <li>數據統計（數據整合：可看項目總數ex.會員數量、商品上下架數量）</li>
                    </ul>

                </div>
            </div>
        </div>
    </div>

    <div class="footer mt-5"></div>


</body>
<script src="/js/bootstrap.bundle.min.js"></script>
<script src="/js/wow.min.js"></script>
<script>
    new WOW().init();
</script>

</html>