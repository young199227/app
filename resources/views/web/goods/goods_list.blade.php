<!-- 繼承了fruit_index_header_footer頁面 -->
@extends('web.index.fruit_index_header_footer')

<!-- link回傳 -->
@section('link')
@parent
<link rel="stylesheet" href="/css/goods_list.css">
@endsection

<!-- style回傳 -->
@section('style')
@parent
<style>

</style>
@endsection
<!-- 把內容插入到index_header_footer的section('main')位置 -->
<!-- 最下面還要補上endsection -->
@section('main')
@parent
<div class="container">
    <div class="row d-flex justify-content-center">
        <!-- 左分類表 -->
        <div class="col-3 mt-4 d-none d-lg-block d-flex justify-content-center">
            <div class="category">
                <ul>
                    <strong>大分類大分類大</strong>
                    <li><a href="#">小分類1</a></li>
                    <li><a href="#">小分類2</a></li>
                    <li><a href="#">小分類3</a></li>

                    <strong>大分類2</strong>
                    <li><a href="#">小分類1</a></li>
                    <li><a href="#">小分類2</a></li>
                    <li><a href="#">小分類3</a></li>

                    <strong>大分類3</strong>
                    <li><a href="#">小分類1</a></li>
                    <li><a href="#">小分類2</a></li>
                    <li><a href="#">小分類3</a></li>
                </ul>
            </div>
        </div>
        <!-- 右上 #篩選/綜合排行/最新  -->
        <div class="col-md-9 col-12 mt-4">
            <div class="sort ">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="d-inline-block">篩選</div>
                        <div class="btn sorttext">綜合排行</div>
                        <div class="btn sorttext">最新</div>
                        <div class="btn sorttext">最熱銷</div>
                    </div>
                    <div class="col-6">

                    </div>
                </div>
            </div>

            <!-- 商品排列 -->
            <div class="row mt-2 showgoodsitem" id="show_goods">
                <!-- result_items showgoodsitem-->

                @foreach ($row as $goods)
                <div class="col-lg-3 mt-2">
                    <a href="/fruit/goods_only/{{$goods->Goods_id}}">
                        <div class="itemsbox">
                            <div class="imgbox img-fluid">
                                <img src="/img/fruit_images/fruit{{$goods->Goods_id}}.jpg" alt="">
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <span class="">{{$goods->Goods_name}}</span>
                                </div>
                                <div class="col-12">
                                    <span class="">{{$goods->Goods_money}}元</span>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
                @endforeach

            </div>
        </div>

    </div>
</div>
@endsection

@section('script')
@parent
<script>
    $(function() {

        // for (i = 0; i < 10; i++) {

        //     $("#show_goods").append(
        //         '<div class="col-lg-3 mt-2">' +
        //         '<div class="itemsbox">' +
        //         '<div class="imgbox img-fluid">' +
        //         '<img src="/img/fruit_images/fruit1.jpg" alt="">' +
        //         '</div>' +
        //         '<div class="row">' +
        //         '<div class="col-12">' +
        //         '<span class="">商品名稱</span>' +
        //         '</div>' +
        //         '<div class="col-12">' +
        //         '<span class="">價格元</span>' +
        //         '</div>' +
        //         '</div>' +
        //         '</div>' +
        //         '</div>'
        //     );
        // }

    });
</script>
@endsection