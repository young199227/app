<!-- 繼承了fruit_index_header_footer頁面 -->
@extends('web.index.fruit_index_header_footer')

<!-- link回傳 -->
@section('link')
@parent
@endsection

<!-- style回傳 -->
@section('style')
@parent
<style>
    .show_img {
        border-radius: 25px;
        height: 500px;
        /* background-image: url(/img/fruit_images/123456.png); */
        background-size: cover;
        background-position: center center;
    }

    .main_body {
        border-radius: 25px;
        background-color: #f4f5f5;
    }

    /* 商品圖片等比例縮放 */
    .main img {
        width: 100%;
        height: 100%;
        object-fit: contain;
    }

    /* 商品圖片限制 */
    .main .imgbox {
        width: 150px;
        height: 150px;
        margin: 0px 10px 10px 0px;
    }

    .main .textbox {
        font-size: 20px;
    }
</style>
@endsection
<!-- 把內容插入到index_header_footer的section('main')位置 -->
<!-- 最下面還要補上endsection -->
@section('main')
@parent
<div class="container">
    <div class="row mt-3 main_body">
        <div class="col-md-8">

            <div class="row">
                <div class="col-12">
                    <!-- 商品沒有圖片時就用img_Prepare.png代替 -->
                    @if(isset($row_img))
                    <div class="show_img" id="goodshover" style="background-image:url({{$row_img[0]->Goods_img}})">
                    </div>
                    @else
                    <div class="show_img" id="goodshover" style="background-image:url(/img/img_Prepare.png)">
                    </div>
                    @endif
                </div>
                <div class="col-12 d-inline-flex justify-content-center">
                    <div class="row overflow-auto flex-nowrap">
                        <!-- 商品有圖片資料才會foreach -->
                        @if(isset($row_img))
                        @foreach ($row_img as $goods)
                        <div class="imgbox" id="ho"><img id="goodshover2" src="{{$goods->Goods_img}}" alt="">
                        </div>
                        @endforeach
                        @endif
                    </div>
                </div>
            </div>

        </div>
        <div class="col-md-4 col-12 d-flex justify-content-center align-items-center">

            <div class="textbox w-100 mt-3">
                <div class="h1 text-center">{{ $row->Goods_name }}</div>

                <div class="row mt-4">
                    <div class="col-mt-3 col-4 d-flex align-items-center justify-content-end">
                        <div class="">價錢：</div>
                    </div>
                    <div class="col-mt-9 col-8">
                        <div class="">{{ $row->Goods_money }}元</div>
                    </div>
                </div>

                <div class="row mt-4">
                    <div class="col-mt-3 col-4 d-flex align-items-center justify-content-end">
                        <div class="">產地：</div>
                    </div>
                    <div class="col-mt-9 col-8">
                        <div class="">{{ $row->Goods_area }}</div>
                    </div>
                </div>

                <div class="row mt-4">
                    <div class="col-mt-3 col-4 d-flex align-items-center justify-content-end">
                        <div class="">數量：</div>
                    </div>
                    <div class="col-mt-9 col-8">
                        <div class="row">
                            <div class="col-6">

                                <select class="form-select" aria-label="Default select example" id="goods_count">
                                    <option selected value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>
                                    <option value="5">5</option>
                                </select>
                            </div>
                            <div class="col-6">
                                <!-- Button trigger modal -->
                                <button type="button" class="btn btn-dark position-relative" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                    箱<span class="badge text-bg-danger position-absolute top-0 start-100 translate-middle">？</span>
                                </button>

                                <!-- Modal -->
                                <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content" style="width: 900px;right:200px">
                                            <div class="modal-header">
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <img src="/img/fruit_images/農糧署全球資訊網1024_1.jpg" alt="">
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>

                <div class="row mt-4">
                    <div class="col-mt-3 col-4 d-flex align-items-center justify-content-end">
                        <div class="">描述：</div>
                    </div>
                    <div class="col-mt-9 col-8">
                        <div class="">{{ $row->Goods_detail }}</div>
                    </div>
                </div>
                <div class="row">
                    <div class="mt-4 mb-4 d-inline-flex justify-content-evenly">
                        <button class="btn btn-success" data-member_id="{{ Session('member_id') }}" data-goods_id="{{ $row->Goods_id }}" id="goods_car_add">加入購物車</button>
                        <button class="btn btn-success" id="goods_car_add_buy">直接購買</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
@parent
<script src="/js/sweetalert2.js"></script>
<script>
    //滑鼠移動到圖片 更換顯示大圖
    $("#ho #goodshover2").hover(function() {
        var T0 = $(this).attr("src");
        $("#goodshover").css('background-image', 'url("' + T0 + '")');
    });

    //把商品加入購物車
    $("#goods_car_add").click(function() {

        dataJson = {};

        dataJson['member_id'] = $(this).data('member_id');
        dataJson['goods_id'] = $(this).data('goods_id');
        dataJson['goods_count'] = $("#goods_count").val();
        // console.log(JSON.stringify(dataJson));
        $.ajax({
            type: "POST",
            url: "/session/goods_car/add",
            data: JSON.stringify(dataJson),
            dataType: "json",
            contentType: "application/json; charset=utf-8",
            success: function(data) {
                if (data.state) {
                    if (data.message == "購物車增加新商品") {
                        //置頂購物車紅點+1(購物車內多一項新商品時)
                        $("#goods_car_count").text(parseInt($("#goods_car_count").text()) + 1);
                        Swal.fire({
                            icon: 'success',
                            title: '購物車有新東西囉',
                        })
                    }
                    if (data.message == "購物車內容最多5樣喔") {
                        //購物車滿了警告
                        Swal.fire({
                            icon: 'error',
                            title: '1項商品最多5箱喔',
                            text: '購物車內同樣商品已有5箱',
                        })
                    }
                    if (data.message == "同樣商品數量增加") {
                        //購物車物品增加
                        Swal.fire({
                            icon: 'success',
                            title: '商品數量已增加',
                            text: '現在商品有' + data.goods_count + '箱',
                        })
                    }
                }
            },
            error: function() {
                $(location).attr("href", "/member/member_login");
            }
        });
    });

    //直接購買
    $("#goods_car_add_buy").click(function() {

        dataJson = {};

        dataJson['member_id'] = $("#goods_car_add").data('member_id');
        dataJson['goods_id'] = $("#goods_car_add").data('goods_id');
        dataJson['goods_count'] = $("#goods_count").val();
        // console.log(JSON.stringify(dataJson));
        $.ajax({
            type: "POST",
            url: "/session/goods_car/add",
            data: JSON.stringify(dataJson),
            dataType: "json",
            contentType: "application/json; charset=utf-8",
            success: function(data) {
                if (data.state) {
                    if (data.message == "購物車增加新商品") {
                        //置頂購物車紅點+1(購物車內多一項新商品時)
                        $("#goods_car_count").text(parseInt($("#goods_car_count").text()) + 1);
                        Swal.fire({
                            icon: 'success',
                            title: '轉跳中',
                            timer: 2500,
                            timerProgressBar: true,
                            didOpen: () => {
                                Swal.showLoading()
                            }
                        })
                        setTimeout(function() {
                            $(location).attr("href", "/fruit/goods_car");
                        }, 2500);
                    }
                    if (data.message == "購物車內容最多5樣喔") {
                        //購物車滿了警告
                        Swal.fire({
                            icon: 'success',
                            title: '轉跳中',
                            text: '購物車內同樣商品已有5箱',
                            timer: 2500,
                            timerProgressBar: true,
                            didOpen: () => {
                                Swal.showLoading()
                            }
                        })
                        setTimeout(function() {
                            $(location).attr("href", "/fruit/goods_car");
                        }, 2500);
                    }
                    if (data.message == "同樣商品數量增加") {
                        //購物車物品增加
                        Swal.fire({
                            icon: 'success',
                            title: '轉跳中',
                            text: '現在商品有' + data.goods_count + '箱',
                            timer: 2500,
                            timerProgressBar: true,
                            didOpen: () => {
                                Swal.showLoading()
                            }
                        })
                        setTimeout(function() {
                            $(location).attr("href", "/fruit/goods_car");
                        }, 2500);
                    }
                }
            },
            error: function() {
                $(location).attr("href", "/member/member_login");
            }
        });
    });
</script>
@endsection