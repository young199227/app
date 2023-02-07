<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>水果超好ㄘ</title>
  <link rel="shortcut icon" href="/img/tree.png" type="image/x-icon">
  <link rel="stylesheet" href="/css/bootstrap.min.css">
  <link rel="stylesheet" href="/css/fruit.css">
  <link rel="stylesheet" href="/css/mycolor.css">
  <!-- link Blade 模板顯示-->
  @section('link')
  @show
  <!-- style Blade 模板顯示-->
  @section('style')
  @show

</head>


<body>
  <!-- 置頂導覽列-->
  <div class="header">

    <div class="container">
      <div class="menu">
        <div class="row">
          <div class="col-md-6 d-flex d-none d-md-block ">
            <a href="/">水豚</a>
            <a href="/">烏龜</a>
            <a href="/">鯊鯊</a>
          </div>
          <div class="col-md-6 d-md-flex justify-content-end d-none">
            <a href="https://www.google.com.tw/" target="_blank">幫助中心</a>
            <a href="/member_sign_up">會員註冊</a>
            <a href="" data-bs-toggle="modal" data-bs-target="#login_modal">會員登入</a>
          </div>
        </div>
      </div>
      <!-- LOGO/search -->
      <div class="navigation">
        <div class="row ">
          <div class="col-12">
            <div class="row">
              <!-- LOGO -->
              <div class="col-md-3 d-none d-md-block">
                <a href="/fruit" style="text-decoration:none;color:#fff">
                  <span class="logo-text">
                    <img src="/img/tree.png" class="logo ">水果超好ㄘ
                  </span>
                </a>
              </div>
              <!-- 搜尋框 -->
              <div class="col-md-6 col-9">

                <div class="input-group mt-2 mb-2">
                  <input type="text" class="form-control" placeholder="蘋果,香蕉,草莓..." aria-label="Recipient's username" aria-describedby="button-addon2">
                  <button class="btn" type="button" id="button-addon2">搜尋</button>
                </div>

              </div>
              <!-- 購物車 -->
              <div class="col-md-3 d-none d-md-block">
                <a href="/fruit/goods_car" class="text-light"><ion-icon name="cart-outline" class="icon"></ion-icon></a>
              </div>

              <!-- RWD縮進 -->
              <div class="col-3 d-md-none">

               <div class="dropdown mt-2">
                  <button class="btn btn-secondary dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                    選單
                  </button>
                  <ul class="dropdown-menu">                   
                    <li><a class="dropdown-item" href="/member_sign_up">會員註冊 </a></li>
                    <li><a class="dropdown-item" data-bs-toggle="modal" data-bs-target="#login_modal" href="">會員登入</a></li>
                  </ul>
                </div>

              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

  </div>

    <!-- Modal -->
<div class="modal fade" id="login_modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">會員登入</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">

            <div class="row mb-4 mt-4 text-center">
                <div class="col-2">
                    <label for="email" class="form-label col-form-label">信箱</label>
                </div>
                <div class="col-9 text-start">
                    <input type="text" class="form-control" id="email" placeholder="輸入信箱">
                  <div class="form-text" id="">測試</div>
                </div>
            </div>
            <div class="row mb-4 text-center">
                <div class="col-2">
                    <label for="password" class="form-label col-form-label">密碼</label>
                </div>
                <div class="col-9 text-start">
                    <input type="password" class="form-control" id="password" placeholder="輸入密碼">
                  <div class="form-text" id="">測試</div>
                </div>
            </div>

      </div>

      <div class="modal-footer">
        <button type="button" class="btn btn-primary">送出</button>
      </div>
    </div>
  </div>
</div>


  <!-- 內容物 Blade 模板顯示-->
  <div class="main">
    @section('main')
    @show
  </div>

  <!-- 頁尾標籤-->
  <div class="footer mt-3">

    <div class="container">
      <div class="row">
        <div class="col-12 mt-1">
          @2023-2-1~現在
        </div>
      </div>
    </div>

  </div>

</body>

<!-- icon圖片載入 -->
<script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
<script src="/js/bootstrap.bundle.min.js"></script>
<script src="/js/jquery-3.6.1.min.js"></script>
<script>
  $(function() {

  });
</script>
<!-- script Blade 模板顯示-->
@section('script')
@show

</html>