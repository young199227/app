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
                        <li><a class="dropdown-item" href="/index.html"></a></li>
                        <li><a class="dropdown-item" href="/index.html">測試</a></li>
                        <li><a class="dropdown-item" href="/index.html">測試2</a></li>
                        <li><a class="dropdown-item" href="/index.html">測試3</a></li>
                        <li><a class="dropdown-item" href="/index.html">測試4</a></li>
                        <li><a class="dropdown-item" href="/index.html">測試5</a></li>
                        <li><a class="dropdown-item" href="/index.html">測試6</a></li>
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
                                        <li><a href="/index.html">你好,owner</a></li>
                                        <span class="d-none d-md-inline-block">
                                            <li><a href="/index.html"><img src="/img/tree.png" class="logo "></a></li>
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
                            <li><a href="/owner_po_goods">上架商品✈</a></li>
                            <li><a href="/owner">管理商品☺</a></li>
                            <li><a href="">訂單➤</a></li>
                            <li><a href="">上架廣告</a></li>
                            <li><a href="">管理廣告</a></li>
                            <li><a href="">私☺</a></li>
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

</script>
<!-- script Blade 模板顯示-->
@section('script')
@show

</html>