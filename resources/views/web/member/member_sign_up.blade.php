<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>水果註冊</title>
    <link rel="shortcut icon" href="/img/tree.png" type="image/x-icon">
    <link rel="stylesheet" href="/css/bootstrap.min.css">
    <link rel="stylesheet" href="/css/mycolor.css">
    <!-- <link rel="stylesheet" href="/css/fruit.css"> -->
    <style>
        @font-face {
            font-family: Naikai;
            src: url("/fonts/NaikaiFont-Regular.woff2") format("woff2");
            src: url("/fonts/NaikaiFont-Regular.woff") format("woff");
        }

        * {
            padding: 0;
            margin: 0;
            font-family: Naikai;
        }


        body {
            background-color: rgb(255, 253, 232);
        }

        /* 置頂導覽列 */
        .header {
            background-color: #449440;
            color: white;
        }

        /* 水果超好ㄘ */
        .navigation .logo {
            height: 50px;
            margin-bottom: 7px;
        }

        .navigation .logo-text {
            font-size: 2.5em;
        }

        /* 內容物 的 註冊框 */
        .main .card {
            /* background-color: #222; */
            padding: 4.5em;

        }

        /* 最上方註冊大字 */
        .main .card .signuptext {
            font-size: 2.5em;
            text-align: center;
        }
    </style>
</head>

<body>
    <!-- 置頂導覽列 -->
    <div class="header">
        <div class="container">

            <!-- LOGO -->
            <div class="navigation">
                <div class="row ">
                    <div class="col-12">
                        <div class="row">
                            <!-- LOGO -->
                            <div class="col-md-6">
                                <a href="/fruit" style="text-decoration:none;color:#fff">
                                    <span class="logo-text">
                                        <img src="/img/tree.png" class="logo ">水果超好ㄘ
                                    </span>
                                </a>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- 內容物 -->
    <div class="main">
        <div class="container ">
            <div class="row d-flex justify-content-center mt-4">
                <div class="col-md-6 mt-3">
                    <!-- 註冊框 -->
                    <div class="card">

                        <!-- 註冊大字 -->
                        <div class="signuptext">
                            <span>註冊</span>
                        </div>

                        <div class="mb-5">
                            <label for="email" class="form-label">驗證email</label>
                            <div class="input-group">
                                <input type="email" class="form-control" id="email" placeholder="輸入信箱">
                                <button id="" class="btn btn-outline-secondary">驗證</button>
                            </div>
                            <div class="form-text" id="error_em"></div>
                        </div>

                        <div class="mb-5">
                            <label for="password" class="form-label">密碼</label>
                            <input type="password" class="form-control" id="password" placeholder="輸入密碼">
                            <div class="form-text" id="error_pw"></div>
                        </div>

                        <div class="mb-5 text-center">
                            <button type="button" id="goodsmember_btn" class="btn btn-outline-secondary">送出</button>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</body>

<script src="/js/bootstrap.bundle.min.js"></script>
<script src="/js/jquery-3.6.1.min.js"></script>
<script>
    $(function(){


        $("#goodsmember_btn").click(function(){

            var memJ = {};
            memJ["email"] = $("#email").val();
            memJ["password"] = $("#password").val();
            console.log(JSON.stringify(memJ));


        });

    });
</script>
</html>