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

            <table class="table text-center">
                <thead>
                    <tr>
                        <th>編號</th>
                        <th>商品圖片</th>
                        <th>商品名稱</th>
                        <th>商品價格</th>
                        <th>商品數量</th>
                        <th>刊登日期</th>
                        <th>操作</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($row as $goods)
                    <tr id="goods_id{{ $goods->Goods_id}}" style="line-height: 80px;">
                        <td>{{ $goods->Goods_id}}</td>
                        <td class="imgbox"><img src="/img/fruit_images/fruit{{ $goods->Goods_id}}.jpg" alt=""></td>
                        <td>{{ $goods->Goods_name}}</td>
                        <td>{{ $goods->Goods_money}}</td>
                        <td>{{ $goods->Goods_sum}}</td>
                        <td>{{ $goods->Goods_created_at}}</td>
                        <td>
                            <button class="btn btn-outline-dark" data-bs-toggle="modal" data-bs-target="#updateModal">修改</button>
                            <button class="btn btn-danger ms-3" onclick="delete_goods(this)" data-goods_id="{{ $goods->Goods_id}}">刪除</button>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>

        </div>
    </div>
</div>


<!-- 修改Modal -->
<div class="modal fade" id="updateModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">修改商品</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <h1>商品ID</h1>
                
                <input type="text" class="form-control mt-3" placeholder="Username">
                <input type="text" class="form-control mt-3" placeholder="Username">
                <input type="text" class="form-control mt-3" placeholder="Username">
                <input type="text" class="form-control mt-3" placeholder="Username">
                
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">取消</button>
                <button type="button" class="btn btn-primary" data-bs-dismiss="modal">確認</button>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
@parent
<script>
    //ajax刪除商品
    //delete_goods方法傳入按鈕自身html(this)改名(html)
    function delete_goods(html) {

        if (confirm("確實要刪除嗎?")) {

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
                        $("#goods_id" + $(html).data("goods_id")).remove();
                    }
                },
                error: function() {
                    console.log("ajax失敗");
                }
            });
        }
    }
</script>
@endsection