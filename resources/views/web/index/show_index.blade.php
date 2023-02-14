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
        
        header {
            background-color: rgba(255, 231, 243, 0.859);
            backdrop-filter: blur(5px);
        }

        header ul {
            list-style-type: none;
        }

        header ul li {
            display: inline-block;
        }

        header ul li a {
            text-decoration: none;
            color: #403426;
            padding: 15px;
            line-height: 72px;
        }

        header ul li a:hover {
            color: red;
        }

        main .icon {
            box-shadow: 5px 5px 10px 4px #53242e;
            padding: 10px;
            border-radius: 3px;
            /* transition: 0.1s ease-in-out; */
        }
    </style>
</head>

<body>
    <!-- 頁眉 -->
    <!-- <header style="z-index: 2;position: relative;">
        <div class="container">
            <div class="row text-center">
                <div class="col-6 mt-3 d-flex align-items-center">
                    <i class="fa-solid fa-tree fa-5x" style="color:#06843c"></i>
                    <span class="fa-2x p-3" style="color:#403426">水果很好ㄘ</span>
                </div>
                <div class="col-6 mt-3 d-inline-flex justify-content-end">
                    <ul class="">
                        <li><a href="#">Home</a></li>
                        <li><a href="#">Blog</a></li>
                        <li><a href="#">Shop</a></li>
                        <li><a href="#">About us</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </header> -->

    <!-- 主內容 -->
    <main style="z-index: 1;position: relative;">
        <section
            style="background:linear-gradient(to right,transparent 50%,pink 50%);z-index: -99; position: relative;">
            <div class="container">
                <div class="row">
                    <div class="col-12 d-flex flex-column justify-content-center position-relative wow animate__fadeInLeft"
                        data-wow-duration="1s" style="height: 100vh;">
                        <div class="display-3">Fruit world</div>
                        <small class="">the fruit is so sweet.</small>
                        <div class="col-5 d-flex justify-content-end">
                            <a href="/fruit" class="btn btn-danger" style="width: 200px;">Go to shopping</a>
                        </div>
                    </div>

                    <div class="bg-cover position-absolute wow animate__fadeInDown" data-wow-duration="1.5s"
                        style="background-image: url(img/fruit_images/fruit40.png);height: 100vh; width: 600px;z-index: -100;left:60%">
                    </div>

                </div>
            </div>
        </section>

        <br><br>

        <section class="d-flex align-items-center"
            style="height:100vh;background:linear-gradient(115deg ,rgb(186, 220, 165) 50%,transparent 50%);">
            <div class="container">
                <div class="row text-center d-flex justify-content-center align-items-center">
                    <div class="col-7 pe-5 mt-5">
                        <div class="bg-cover wow animate__fadeInLeft" data-wow-duration="1.7s"
                            style="background-image: url(img/fruit_images/fruit49.png);height: 650px;width: 540px;z-index: -2;">
                        </div>
                    </div>
                    <div class="col-5 p-5 wow animate__fadeInRight" data-wow-duration="1.7s">
                        <div class="display-3">Avocado</div>
                        <small>酪梨，牛酪梨、鱷梨</small>
                        <hr>
                        <div class="mt-5">
                            產地主要集中於嘉南地區，又以台南縣大內鄉首屈一指，而以麻豆鎮栽植歷史最久，嘉義縣竹崎鄉也少量栽培。近年來，屏東內埔及高雄六龜等地亦開始零星栽培。
                        </div>
                        <div class="row mt-5">
                            <div class="col-12 d-flex justify-content-center">
                                <div class="">
                                    <a href="/fruit" class="btn btn-outline-secondary p-2">了解更多</a>
                                    <a href="/fruit" class="btn btn-success p-2">買買買</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <br><br>

        <section class="d-flex align-items-end"
            style="height:100vh;background:linear-gradient(180deg ,transparent 60%,rgb(255, 239, 175) 40%);">
            <div class="container">
                <div class="row text-center">

                    <div class="col-12  wow animate__fadeInUp" data-wow-duration="1.7s">
                        <div class="display-3 ">Fruit world</div>
                        <a href="/fruit" class="btn btn-warning">點我去商店:3</a>
                    </div>

                    <div class="col-6 d-flex justify-content-center">
                        <div class="bg-cover wow animate__fadeInUp" data-wow-duration="1.7s"
                            style="background-image: url(img/fruit_images/fruit21.png);height: 500px;width: 750px;">
                        </div>
                    </div>

                    <div class="col-6 d-flex justify-content-center">
                        <div class="bg-cover wow animate__fadeInUp" data-wow-duration="1.7s"
                            style="background-image: url(img/fruit_images/fruit20.png);height: 500px;width: 750px;">
                        </div>
                    </div>


                </div>

            </div>
        </section>

    </main>


    <!-- 頁尾 -->
    <footer>

    </footer>
</body>
<script src="/js/bootstrap.bundle.min.js"></script>
<script src="/js/wow.min.js"></script>
<script>
    new WOW().init();
</script>

</html>