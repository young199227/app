<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>管理商品一好ㄘ的水果</title>
    <link rel="shortcut icon" href="/img/tree.png" type="image/x-icon">
    <link rel="stylesheet" href="/css/bootstrap.min.css">
    <link rel="stylesheet" href="/css/mycolor.css">
    <link rel="stylesheet" href="/css/owner.css">
    <link rel="stylesheet" href="/css/all.min.css">
    <!-- link Blade 模板顯示-->
    @section('link')
    @show
    <!-- style Blade 模板顯示-->
    @section('style')
    @show
    <style>

    </style>
</head>

<body>
    <!-- 置頂導覽列-->
    <div class="header">
        <div class="container">

            <!-- 上方導覽 -->
            <div class="navigation">

                <!-- RWD選單 -->
                <div class="dropdown">
                    <button class="navaside d-md-none btn" type="button" data-bs-toggle="dropdown" aria-expanded="false"></button>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href=""></a></li>
                        <li><a class="dropdown-item" href="/owner/owner_po_goods">上架商品<i class="fa-regular fa-circle-up fs-5"></i></a></li>
                        <li><a class="dropdown-item" href="/owner">管理商品<i class="fa-regular fa-face-smile fs-5"></i></a></li>
                        <li><a class="dropdown-item" href="/owner/owner_member">管理會員<i class="fa-solid fa-cloud fs-5"></i></a></li>
                        <li><a class="dropdown-item" href="/owner/owner_order">管理訂單<i class="fa-solid fa-cloud fs-5"></i></a></li>
                        <li><a class="dropdown-item" href="/owner/owner_count">數量統計<i class="fa-solid fa-list fs-5"></i></a></li>
                    </ul>
                </div>

                <div class="row ">
                    <!-- 左上角 LOGO+可自行增加 -->
                    <div class="col-md-6 col-6">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="laftNav d-flex align-items-center text-center">
                                    <ul>
                                        <span class="d-none d-md-inline-block">
                                            <li><a href="/index.html"><img src="/img/tree.png" class="logo"></a></li>
                                        </span>
                                        <li><a href="/fruit">水果超好ㄘ</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- 右上角 使用者名稱＆歡迎-->
                    <div class="col-md-6 col-6">
                        <div class="row">
                            <div class="col-md-12 d-flex justify-content-end ">
                                <div class="rightNav">
                                    <ul>
                                        <li><a href="/session/member/logout">owner登出</a></li>
                                        <span class="d-none d-md-inline-block">
                                            <li><a href="/fruit"><img src="/img/tree.png" class="logo "></a></li>
                                        </span>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <!-- 內容物 -->
    <div class="main">
        <div class="container">

            <!-- 左區塊 -->
            <div class="aside">
                <div class="row">
                    <div class="col-12">
                        <ul>
                            <li><a href=""></a></li>
                            <li><a href="/owner/owner_po_goods">上架商品<i class="fa-regular fa-circle-up fs-5"></i></a></li>
                            <li><a href="/owner">管理商品<i class="fa-regular fa-face-smile fs-5"></i></a></li>
                            <li><a href="/owner/owner_member">管理會員<i class="fa-solid fa-cloud fs-5"></i></a></li>
                            <li><a href="/owner/owner_order" class="position-relative">管理訂單
                                    <i class="fa-solid fa-truck-fast fs-5">
                                        <span class="position-absolute top-20 start-1000 translate-middle badge rounded-pill bg-danger p-2" id="unprocessed_order_count">
                                            <span class="visually-hidden">unread messages</span>
                                        </span>
                                    </i></a></li>
                            <li><a href="/owner/owner_count">數量統計<i class="fa-solid fa-list fs-5"></i></a></li>
                        </ul>
                    </div>
                </div>
            </div>

            <!-- 主內容 Blade 模板顯示-->
            <div class="article">
                @section('main')
                @show
            </div>

        </div>
    </div>
</body>
<script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
<script src="/js/bootstrap.bundle.min.js"></script>
<script src="/js/jquery-3.6.1.min.js"></script>

<script>
    //進入頁面後先讀取未處理訂單數量
    order_count_ajax();
    //顯示未處理的訂單數量方法(紅點)
    function order_count_ajax() {
        $.ajax({
            type: "GET",
            url: "/api/owner/unprocessed_order_count",
            dataType: "json",
            success: function(data) {
                if (data.state) {
                    $("#unprocessed_order_count").text(data.data + "");
                } else {
                    console.log("讀取失敗");
                }
            },
            error: function() {
                console.log("ajax失敗");
            }
        });
    }
</script>
<!-- script Blade 模板顯示-->
@section('script')
@show

</html>