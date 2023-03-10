<!-- 繼承了owner_index_header頁面 -->
@extends('web.owner.owner_index_header')

<!-- link回傳 -->
@section('link')
@parent
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
<div class="row">
    <div class="col-12">
        <div class="ownerbox">

            <table class="table text-center table-rwd">
                <thead>
                    <tr>
                        <th>編號</th>
                        <th>商品圖</th>
                        <th>商品名稱</th>
                        <th>商品價格</th>
                        <th>商品數量</th>
                        <th>刊登日期</th>
                        <th>操作</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($row as $goods)
                    @if($goods->Goods_state==0)
                    <tr id="goods_id{{ $goods->Goods_id}}" style="background-color:#aaaaaa">
                        @else
                    <tr id="goods_id{{ $goods->Goods_id}}" >
                        @endif
                        <td data-th="編號">{{ $goods->Goods_id}}</td>
                        <td data-th="商品圖" class="imgbox"><img src="{{ $goods->Goods_imges}}" alt=""></td>
                        <td data-th="商品名稱">{{ $goods->Goods_name}}</td>
                        <td data-th="商品價格">{{ $goods->Goods_money}}</td>
                        <td data-th="商品數量">{{ $goods->Goods_sum}}</td>
                        <td data-th="刊登日期">{{ $goods->Goods_created_at}}</td>
                        <td data-th="操作">
                            <a href="/owner/owner_update_goods/{{$goods->Goods_id}}"><button class="btn btn-outline-dark">修改</button></a>
                            @if($goods->Goods_state==0)
                            <button class="btn btn-success ms-3" onclick="up_goods(this)" data-goods_id="{{ $goods->Goods_id}}">上架</button>
                            @else
                            <button class="btn btn-danger ms-3" onclick="delete_goods(this)" data-goods_id="{{ $goods->Goods_id}}">下架</button>
                            @endif
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>

        </div>
    </div>
</div>
<div class="row">
    <div class="col d-flex justify-content-center">
        <div class="">
            {{ $row ->links() }}
        </div>
    </div>
</div>

@endsection

@section('script')
@parent
<script>
    //ajax下架商品
    //delete_goods方法傳入按鈕自身html(this)改名(html)
    function delete_goods(html) {

        dataJson = {};
        dataJson["id"] = $(html).data("goods_id");
        //console.log(JSON.stringify(dataJson));
        $.ajax({
            type: "post",
            url: "/api/owner/delete_goods",
            data: JSON.stringify(dataJson),
            dataType: "json",
            contentType: "application/json; charset=utf-8",
            success: function(data) {

                if (data.state) {
                    // $("#goods_id" + $(html).data("goods_id")).css('background-color','dimgrey');
                    window.location.reload();
                }
            },
            error: function() {
                console.log("ajax失敗");
            }
        });

    }

    //ajax上架商品
    function up_goods(html){

        dataJson = {};
        dataJson["id"] = $(html).data("goods_id");
        //console.log(JSON.stringify(dataJson));
        $.ajax({
            type: "post",
            url: "/api/owner/up_goods",
            data: JSON.stringify(dataJson),
            dataType: "json",
            contentType: "application/json; charset=utf-8",
            success: function(data) {

                if (data.state) {
                    // $("#goods_id" + $(html).data("goods_id")).css('background-color','dimgrey');
                    window.location.reload();
                }
            },
            error: function() {
                console.log("ajax失敗");
            }
        });
    }
</script>
@endsection