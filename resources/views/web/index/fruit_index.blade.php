<!-- 繼承了fruit_index_header_footer頁面 -->
@extends('web.index.fruit_index_header_footer')

<!-- 把內容插入到index_header_footer的section('main')位置 -->
<!-- 最下面還要補上endsection -->
@section('main')
@parent

<div class="container">
    <div class="row">
        <div class="col-md-8 mt-3">


            <div id="carouselExampleCaptions" class="carousel slide" data-bs-ride="false">
                <div class="carousel-indicators">
                    <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                    <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1" aria-label="Slide 2"></button>
                    <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="2" aria-label="Slide 3"></button>
                </div>
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <a href="/fruit/goods_list">
                            <img src="/img/fruit_images/fruit6.jpg" class="d-block w-100" alt="...">
                        </a>
                        <div class="carousel-caption d-none d-md-block">
                            <h5>看起來超好ㄘ</h5>
                            <p>台灣大香蕉</p>
                        </div>
                    </div>
                    <div class="carousel-item">
                        <a href="/fruit/goods_list">
                        <img src="/img/fruit_images/fruit4.jpg" class="d-block w-100" alt="...">
                        </a>
                        <div class="carousel-caption d-none d-md-block">
                            <h5>超大葡萄</h5>
                            <p>沒有仔</p>
                        </div>
                    </div>
                    <div class="carousel-item">
                        <a href="/fruit/goods_list">
                        <img src="/img/fruit_images/fruit5.jpg" class="d-block w-100" alt="...">
                        </a>
                        <div class="carousel-caption d-none d-md-block">
                            <h5>超厲害草莓</h5>
                            <p>又大又甜</p>
                        </div>
                    </div>
                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>
            </div>


        </div>
        <div class="col-md-4 mt-3">
            <img src="/img/fruit_images/fruit005.jpg" width="100%" height="100%">
            <!-- <img src="/img/fruit_images/fruit001.jpg" width="100%" height="100%"> -->
        </div>
    </div>

    <div class="row mt-2 mb-3">
        <div class="col-md-3 mt-3">
            <div class="shopee-box p-3 d-flex flex-column h-100">

                <img src="/img/fruit_images/fruit23.png" alt="">
                <a href="" class="mt-auto">
                    <h3>橘子</h3>
                </a>

            </div>
        </div>
        <div class="col-md-3 mt-3">
            <div class="shopee-box p-3 d-flex flex-column h-100">

                <img src="/img/fruit_images/fruit37.png" alt="">
                <a href="" class="mt-auto">
                    <h3>柳橙</h3>
                </a>

            </div>
        </div>
        <div class="col-md-3 mt-3">
            <div class="shopee-box p-3 d-flex flex-column h-100">

                <img src="/img/fruit_images/fruit31.png" alt="">
                <a href="" class="mt-auto">
                    <h3>奇異果</h3>
                </a>

            </div>
        </div>
        <div class="col-md-3 mt-3">
            <div class="shopee-box p-3 d-flex flex-column h-100">

                <img src="/img/fruit_images/fruit30.png" alt="">
                <a href="" class="mt-auto">
                    <h3>草莓</h3>
                </a>
                <!-- <a href="#" target="_blank" class="bttn mt-auto">詳細</a> -->

            </div>
        </div>
        <div class="col-md-3 mt-3">
            <div class="shopee-box p-3 d-flex flex-column h-100">

                <img src="/img/fruit_images/fruit23.png" alt="">
                <a href="" class="mt-auto">
                    <h3>橘子</h3>
                </a>

            </div>
        </div>
        <div class="col-md-3 mt-3">
            <div class="shopee-box p-3 d-flex flex-column h-100">

                <img src="/img/fruit_images/fruit37.png" alt="">
                <a href="" class="mt-auto">
                    <h3>柳橙</h3>
                </a>

            </div>
        </div>
        <div class="col-md-3 mt-3">
            <div class="shopee-box p-3 d-flex flex-column h-100">

                <img src="/img/fruit_images/fruit31.png" alt="">
                <a href="" class="mt-auto">
                    <h3>奇異果</h3>
                </a>

            </div>
        </div>
        <div class="col-md-3 mt-3">
            <div class="shopee-box p-3 d-flex flex-column h-100">

                <img src="/img/fruit_images/fruit30.png" alt="">
                <a href="" class="mt-auto">
                    <h3>草莓</h3>
                </a>
                <!-- <a href="#" target="_blank" class="bttn mt-auto">詳細</a> -->

            </div>
        </div>
        <div class="col-md-3 mt-3">
            <div class="shopee-box p-3 d-flex flex-column h-100">

                <img src="/img/fruit_images/fruit23.png" alt="">
                <a href="" class="mt-auto">
                    <h3>橘子</h3>
                </a>

            </div>
        </div>
        <div class="col-md-3 mt-3">
            <div class="shopee-box p-3 d-flex flex-column h-100">

                <img src="/img/fruit_images/fruit37.png" alt="">
                <a href="" class="mt-auto">
                    <h3>柳橙</h3>
                </a>

            </div>
        </div>
        <div class="col-md-3 mt-3">
            <div class="shopee-box p-3 d-flex flex-column h-100">

                <img src="/img/fruit_images/fruit31.png" alt="">
                <a href="" class="mt-auto">
                    <h3>奇異果</h3>
                </a>

            </div>
        </div>
        <div class="col-md-3 mt-3">
            <div class="shopee-box p-3 d-flex flex-column h-100">

                <img src="/img/fruit_images/fruit30.png" alt="">
                <a href="" class="mt-auto">
                    <h3>草莓</h3>
                </a>
                <!-- <a href="#" target="_blank" class="bttn mt-auto">詳細</a> -->

            </div>
        </div>
    </div>

</div>
@endsection