<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>水果登入</title>
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

        /* 內容物 的 登入框 */
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
                    <!-- 登入框 -->
                    <div class="card">

                        <!-- 登入大字 -->
                        <div class="signuptext">
                            <span>登入</span>
                        </div>

                        <div class="mb-5">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="member_email" placeholder="輸入信箱">
                            <div class="form-text" id="error_em"></div>
                        </div>

                        <div class="mb-5">
                            <label for="password" class="form-label">密碼</label>
                            <input type="password" class="form-control" id="member_password" placeholder="輸入密碼">
                            <div class="form-text" id="error_pw"></div>
                        </div>

                        <div class="mb-5 text-center">
                            <button type="button" id="member_login" class="btn btn-outline-secondary">送出</button>
                        </div>

                        <a href="/member/member_sign_up">沒有帳號，前往註冊</a>
                    </div>
                </div>
            </div>

        </div>
    </div>
</body>

<script src="/js/bootstrap.bundle.min.js"></script>
<script src="/js/jquery-3.6.1.min.js"></script>
<script>

    $("#member_login").click(function() {

        var jsonData = {};
        jsonData["member_email"] = $("#member_email").val();
        jsonData["member_password"] = $("#member_password").val();

        $.ajax({
            type: "POST",
            url: "http://127.0.0.1:8000/session/member/long",
            data: JSON.stringify(jsonData),
            dataType: "json",
            contentType: "application/json; charset=utf-8",
            success: function(data) {

                if (data.state) {
                    // console.log(data);
                    $(location).attr("href","http://127.0.0.1:8000/fruit");
                } else {
                    $("#member_email_error").text(data.message + "帳號或密碼錯誤").css("color", "red");
                }
            },
            error: function() {
                console.log("ajax失敗");
            }
        });
    });

</script>

</html>