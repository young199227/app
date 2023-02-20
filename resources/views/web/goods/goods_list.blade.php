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
                    <strong>價錢分類</strong>
                    <li><a href="/fruit/goods_list/1000">1000元↑</a></li>
                    <li><a href="/fruit/goods_list/599">500~999元</a></li>
                    <li class="mb-3"><a href="/fruit/goods_list/500">500元↓</a></li>
                    
                    <strong>水果大分類</strong>
                    <li ><a href="/fruit/goods_google/蘋果">蘋果</a></li>
                    <li ><a href="/fruit/goods_google/西瓜">西瓜</a></li>
                    <li ><a href="/fruit/goods_google/葡萄">葡萄</a></li>
                    <li ><a href="/fruit/goods_google/蕃茄">蕃茄</a></li>
                    <li ><a href="/fruit/goods_google/草莓">草莓</a></li>
                    <li ><a href="/fruit/goods_google/橘子">橘子</a></li>
                </ul>
            </div>
        </div>
        <!-- 右上 #篩選/綜合排行/最新  -->
        <div class="col-md-9 col-12 mt-4">
            <div class="sort ">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="d-inline-block">篩選</div>
                        <a href="/fruit/goods_list"><div class="btn sorttext">綜合排行</div></a>
                        <a href="/fruit/goods_list/new"><div class="btn sorttext">最新</div></a>
                    </div>
                    <div class="col-6">

                    </div>
                </div>
            </div>

            <!-- 商品排列 -->
            <div class="row mt-2 showgoodsitem" id="show_goods">
                <!-- result_items showgoodsitem-->

                @foreach ($row as $goods)
                @if($goods->Goods_state!=0)
                <div class="col-lg-3 mt-2">
                    <a href="/fruit/goods_only/{{$goods->Goods_id}}">
                        <div class="itemsbox">
                            <div class="imgbox img-fluid">
                                <!-- 商品沒有圖片時就用img_Prepare.png代替 -->
                                @if(isset($goods->Goods_imges))
                                <img src="{{$goods->Goods_imges}}" alt="">
                                @else
                                <img src="/img/img_Prepare.png" alt="">
                                @endif  
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
                @endif
                @endforeach

            </div>
        </div>

    </div>
</div>
@endsection

@section('script')
@parent
<script>
</script>
@endsection