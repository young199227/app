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
                        <div class="imgbox" id="ho" ><img id="goodshover2"src="{{$goods->Goods_img}}" alt="">
                        </div>
                    @endforeach
                    @endif
                    </div>
                </div>
            </div>

        </div>
        <div class="col-md-4 d-flex justify-content-center align-items-center">

            <div class="textbox">
                <div class="h1 text-center">{{ $row->Goods_name }}</div>

                <div class="row mt-4">
                    <div class="col-3 d-flex align-items-center justify-content-end">
                        <div class="">價錢：</div>
                    </div>
                    <div class="col-9">
                        <div class="">{{ $row->Goods_money }}元</div>
                    </div>
                </div>

                <div class="row mt-4">
                    <div class="col-3 d-flex align-items-center justify-content-end">
                        <div class="">產地：</div>
                    </div>
                    <div class="col-9">
                        <div class="">{{ $row->Goods_area }}</div>
                    </div>
                </div>

                <div class="row mt-4">
                    <div class="col-3 d-flex align-items-center justify-content-end">
                        <div class="">數量：</div>
                    </div>
                    <div class="col-9">
                        <div class="row">
                            <div class="col-6">
                                <div class="input-group">
                                    <button class="btn btn-dark">－</button>
                                    <input type="text" class="form-control" value="1" name="" oninput="value=value.replace(/[^\d]/g,'')">
                                    <button class="btn btn-dark">＋</button>
                                </div>
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
                    <div class="col-3 d-flex align-items-center justify-content-end">
                        <div class="">描述：</div>
                    </div>
                    <div class="col-9">
                        <div class="">{{ $row->Goods_detail }}</div>
                    </div>
                </div>
                <div class="row">
                    <div class="mt-4 d-inline-flex justify-content-evenly">
                        <a href="/fruit/goods_car"><button class="btn btn-success">加入購物車</button></a>
                        <a href="/fruit/goods_car"><button class="btn btn-success">直接購買</button></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
@parent
<script>
    $(function() {
        

        $("#ho #goodshover2").hover(function(){
            var T0 = $(this).attr("src");
            $("#goodshover").css('background-image', 'url("'+T0+'")');
        });

    });
</script>
@endsection