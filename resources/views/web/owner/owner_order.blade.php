<!-- 繼承了member_index_header頁面 -->
@extends('web.owner.owner_index_header')

<!-- link回傳 -->
@section('link')
@parent
@endsection

<!-- style回傳 -->
@section('style')
@parent
<style>
    /* 右上 #篩選*/
    .main .sort {
        background-color: var(--grey01);
        padding: 15px;
        border-radius: 10px;
    }

    .main .sort .sorttext {
        color: #ffffff;
        background-color: #449440;

        border-radius: 5px;
        padding: 5px 10px;
    }

    .main .sort .sorttext:hover {
        color: #123456;
        background-color: #b8fcbe;
    }
</style>
@endsection
<!-- 把內容插入到index_header_footer的section('main')位置 -->
<!-- 最下面還要補上endsection -->
@section('main')
@parent
<div class="row">
    <div class="col-12">

        <!-- 篩選 -->
        <div class="sort mt-3 ms-3">
            <div class="row">
                <div class="col-lg-6">
                    <div class="d-inline-block">篩選</div>

                    <div class="btn sorttext" onclick="manage_order(1)">處理中訂單</div>
                    <div class="btn sorttext" onclick="manage_order(2)">已完成</div>
                    <div class="btn sorttext" onclick="manage_order(3)">已取消</div>
                </div>
                <div class="col-6">

                </div>
            </div>
        </div>

        <div class="ownerbox">

            <!-- main開始 -->
            <h3>訂單資訊(點擊查看內容)</h3>

            <!-- 訂單內容 -->
            <div id="add_order">
                <!-- <p>
                <div class="row" style="border: 1px solid #ced4da;padding: 15px;border-radius: 10px;">
                    <div class="col-5">
                        <a class="text-decoration-none text-black" data-bs-toggle="collapse" href="#collex" role="button" aria-expanded="false" aria-controls="collapseExample">
                            <div class="text-danger">訂單編號：</div>
                            <p>總金額：</p>
                            <p>訂單創建時間：</p>
                        </a>
                    </div>
                    <div class="col-5">
                        <p>收件人：</p>
                        <p>電話：</p>
                        <p>地址：</p>
                    </div>
                    <div class="col-2 text-center">
                        狀態
                        <p class="h3 text-success mt-4">012</p>
                    </div>
                    </p>
                    <div class="collapse" id="collex">
                        <div class="card card-body">
                            <div class="row">


                            </div>
                        </div>
                    </div>

                </div> -->

            </div>
        </div>
    </div>
    <div class="row">
        <div class="col d-flex justify-content-center">
            <div class="">
            </div>
        </div>
    </div>

    @endsection

    @section('script')
    @parent
    <script>
        //進入後先撈取處理中的訂單
        manage_order(1);

        //用傳值的方式撈出訂單(1=處理中 2=完成 3=取消)
        function manage_order(order_state) {
            //先刪除#add_order內的訂單
            $("#add_order").empty();

            var dataJson={};
            dataJson['order_state'] = order_state;

            $.ajax({
                type: "POST",
                url: "/api/owner/read_order",
                data:JSON.stringify(dataJson),
                dataType: "json",
                contentType: "application/json; charset=utf-8",
                success: function(data) {

                    if (data.state) {
                        //切開不同oreder的變數
                        var each_id = 0;
                        //全部訂單的迴圈
                        data.data.forEach(data => {

                            //當訂單id跟each_id不同的時候 印出一張新訂單
                            if (each_id != data.Order_id) {
                                //新訂單
                                $("#add_order").append(
                                    '<p>' +
                                    '<div class="row" style="border: 1px solid #ced4da;padding: 15px;border-radius: 10px;">' +
                                    '<div class="col-5">' +
                                    '<a class="text-decoration-none text-black" data-bs-toggle="collapse" href="#collex' + data.Order_id + '" role="button" aria-expanded="false" aria-controls="collapseExample">' +
                                    '<div class="text-danger">訂單編號：' + data.Order_id + '</div>' +
                                    '<p>總金額：' + data.Order_money + '</p>' +
                                    '<p>訂單創建時間：' + data.Order_created_at + '</p>' +
                                    '</a>' +
                                    '</div>' +
                                    '<div class="col-5">' +
                                    '<p>收件人：' + data.Member_name + '</p>' +
                                    '<p>電話：' + data.Member_phone + '</p>' +
                                    '<p>地址：' + data.Member_area + '</p>' +
                                    '</div>' +
                                    '<div class="col-2 text-center">狀態 ' +
                                    '<p class="h3 text-success mt-4">012</p>' +
                                    '</div>' +
                                    '</p>' +
                                    '<div class="collapse" id="collex' + data.Order_id + '">' +
                                    '<div class="card card-body">' +
                                    '<div class="row" id="order_detail' + data.Order_id + '">' +
                                    '</div>' +
                                    '</div>' +
                                    '</div>' +
                                    '</div>'
                                );
                            }

                            //訂單內容
                            $("#order_detail" + data.Order_id).append(
                                '<div class="col-3">' +
                                '<div class="imgbox"><img src="' + data.Goods_img + '" onerror="this.onerror=null;this.src=' + "'/img/img_Prepare.png'" + ';"></div>' +
                                '<p>商品名稱：' + data.Goods_name + '</p>' +
                                '<p>商品數量：' + data.Order_goods_count + '</p>' +
                                '</div>'
                            );

                            console.log(data);
                            //結束迴圈前讓 each_id= data.Order_id 
                            //下一次是不同訂單id的時候才會新增一張新訂單
                            each_id = data.Order_id;
                        });
                    }
                },
                error: function() {
                    console.log("沒有進去");
                }
            });
        }
    </script>
    @endsection