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
    <link rel="stylesheet" href="/css/fruit.css">
    <link href="https://cdn.jsdelivr.net/npm/@sweetalert2/theme-dark@4/dark.css" rel="stylesheet">
    <style>
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

        .swal2-title {
            color:#403426;
        }
        .swal2-popup {
            background:#fff;
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
                <div class="col-lg-6 col-md-8 col-12 mt-3">
                    <!-- 註冊框 -->
                    <div class="card">

                        <!-- 註冊大字 -->
                        <div class="signuptext">
                            <span>註冊</span>
                        </div>

                        <div class="mb-5">
                            <label for="email" class="form-label">驗證email</label>
                            <div class="input-group">
                                <input type="email" class="form-control" id="member_email" placeholder="輸入信箱">
                                <button id="member_email_session" class="btn btn-outline-secondary">發送驗證信</button>
                            </div>
                            <div class="form-text" id="error_em"></div>
                        </div>

                        <div class="mb-5 d-none email_verify">
                            <label for="email" class="form-label">驗證碼</label>
                            <div class="input-group">
                                <input type="email" class="form-control" id="email_session_verify" placeholder="請輸入驗證碼">
                                <button id="email_session_check" class="btn btn-outline-secondary">驗證</button>
                            </div>
                            <div class="form-text" id="error_em"></div>
                        </div>

                        <div class="mb-5">
                            <label for="password" class="form-label">密碼 6-12</label>
                            <input type="password" class="form-control" id="member_password" placeholder="輸入密碼">
                            <div class="form-text" id="error_pw"></div>
                        </div>

                        <div class="mb-5 text-center">
                            <button type="button" id="member_sign_up" class="btn btn-outline-secondary">送出</button>
                        </div>

                        <a href="/member/member_login">我有帳號，前往登入</a>
                    </div>
                </div>
            </div>

        </div>
    </div>
</body>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.js"></script>
<script src="/js/bootstrap.bundle.min.js"></script>
<script src="/js/jquery-3.6.1.min.js"></script>
<script>
    //發送驗證信按鈕
    $("#member_email_session").click(function() {

        if($("#member_email").val()!=""){

            //重新發送時間設定 300s
            var stop_time = 300;
            //改變發送驗證信按鈕 文字
            $("#member_email_session").text(stop_time+"s");
            //顯示驗證框框
            $(".email_verify").removeClass("d-none");
            //鎖定框框
            $("#member_email,#member_email_session").attr('disabled', true);

            //每1秒鐘重複執行1次
            var timer = setInterval(function(){
                stop_time--;
                $("#member_email_session").text(stop_time+"s");

                //時間為0的時候停止
                if(stop_time==0){
                    clearInterval(timer);

                    $("#member_email,#member_email_session").attr('disabled', false);
                    $("#member_email_session").text("發送驗證信");
                }
            },1000);

            var dataJson = {};
            dataJson["member_email"] = $("#member_email").val();
            // console.log(JSON.stringify(dataJson));
            $.ajax({
                type:"POST",
                url:"/session/member/email_session",
                data:JSON.stringify(dataJson),
                dataType:"json",
                contentType: "application/json; charset=utf-8",
                success:function(data){
                    console.log(data);
                },
                error:function(){console.log("ajax失敗");}
            });

        }else{
            Swal.fire({
                icon: 'error',
                title: '請填寫信箱！',
            })
        }

    });

    var flag_eml = false;

    //驗證email驗證碼
    $("#email_session_check").click(function(){

        var dataJson = {};
        dataJson["email_session"] = $("#email_session_verify").val();
        // console.log(JSON.stringify(dataJson));
        $.ajax({
            type:"POST",
            url:"/session/member/email_session_verify",
            data:JSON.stringify(dataJson),
            dataType:"json",
            contentType: "application/json; charset=utf-8",
            success:function(data){
                // console.log(data);
                if(data.state){
                    $("#email_session_check").css("color","green").text("認證成功");
                    flag_eml = true;
                }else{
                    $("#email_session_check").css("color","red").text("認證失敗");
                    flag_eml = false;
                }
            },
            error:function(){console.log("ajax失敗");}
        });
    });

    var flag_pas = false;

    //送出註冊資料
    $("#member_sign_up").click(function() {

        if(flag_eml){

            if(flag_pas){

                var dataJson = {};
                dataJson["member_email"] = $("#member_email").val();
                dataJson["email_session"] = $("#email_session_verify").val();
                dataJson["member_password"] = $("#member_password").val();
                // console.log(JSON.stringify(dataJson));
                $.ajax({
                    type:"POST",
                    url:"/session/member/member_sign_up",
                    data:JSON.stringify(dataJson),
                    dataType:"json",
                    contentType: "application/json; charset=utf-8",
                    success:function(data){
                        // console.log(data);
                        if(data.state){
                            Swal.fire({
                                icon: 'success',
                                title: '註冊成功，請登入！',
                                timer: 2500,
                                timerProgressBar: true,
                                didOpen: () => {
                                    Swal.showLoading()
                                }
                            })
                            setTimeout(function() {
                                $(location).attr("href","/member/member_login");
                            }, 2000);
                        }else{
                            console.log(data);
                        }
                    },
                    error:function(){console.log("ajax失敗");}
                });
            }else{
                Swal.fire({
                    icon: 'error',
                    title: '密碼規格不符！',
                })
            }

        }else{
            Swal.fire({
                icon: 'error',
                title: '請完成信箱驗證！',
            })
        }
        
    });


    // 監聽 密碼長度限制
    $("#member_password").bind("input propetychange",function(){

        if($("#member_password").val().length<6 || $("#member_password").val().length>12){
            $("#error_pw").text("密碼長度須為6-12").css("color","red");
            flag_pas = false ;
        }else{
            $("#error_pw").text("密碼長度OK").css("color","green");
            flag_pas = true ;
        }
    });

</script>

</html>