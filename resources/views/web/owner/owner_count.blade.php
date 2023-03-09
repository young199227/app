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
    .bg_btn {
        background-color: #B7D6BF;
        padding: 15px;
        border-radius: 10px;
    }

    .color_btn {
        background-color: #61926d;
        color: #fff;
    }

    .color_btn:hover {
        background-color: #7EB68C;
        color: #fff;
    }
</style>
@endsection
<!-- 把內容插入到index_header_footer的section('main')位置 -->
<!-- 最下面還要補上endsection -->
@section('main')
@parent
<div class="row">
    <div class="col-12">

        <div class="col-12 bg_btn m-3 ">
            <span class="me-3 ms-3">分類</span>
            <button class="btn color_btn" id="member_list">會員</button>
            <button class="btn color_btn" id="goods_list">商品</button>
            <button class="btn color_btn" id="order_list">訂單</button>
        </div>

        <div class="ownerbox">

            <div class="row mb-3">
                <div class="col-12 text-center">
                    <div class="fs-2">數量統計</div>
                    <!-- 日期 ＿ 會員（幾月增加人數）、 -->
                    <!-- 訂單（幾月增加幾筆、已完成的總營收） -->
                </div>
            </div>

            <!-- member_count -->
            <div class="row" id="show_member">

                <!-- <div class="col-md-4 offset-md-2">
                        <div class="card">
                            <div class="card-body text-center w-100">
                                <div class="fs-3">會員總數</div>
                                <div class="fs-4"> </div>
                            </div>
                        </div>
                    </div> -->

                <!-- <div class="col-md-4">
                        <div class="card">
                            <div class="card-body text-center w-100">
                                <div class="fs-3">停權會員</div>
                                <div class="fs-4"> </div>
                            </div>
                        </div>
                    </div> -->

            </div>

            <!-- goods_count -->
            <div class="row" id="show_goods">

                <!-- <div class="col-md-4">
                    <div class="card">
                        <div class="card-body text-center w-100">
                            <div class="fs-3">商品總數</div>
                            <div class="fs-4"></div>
                        </div>
                    </div>
                </div>
                
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-body text-center w-100">
                            <div class="fs-3">上架商品</div>
                            <div class="fs-4"></div>
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="card">
                        <div class="card-body text-center w-100">
                            <div class="fs-3">下架商品</div>
                            <div class="fs-4"></div>
                        </div>
                    </div>
                </div> -->

            </div>

            <!-- order_count -->
            <div class="row" id="show_order">
            </div>

            <div class="row mt-3">
                <div class="col-md-6">

                </div>
                <div class="col-md-6"></div>
            </div>
        </div>
    </div>
</div>

@endsection

@section('script')
@parent
<script src="/js/chart.js"></script>
<script>
    //會員資料 撈取 & 處理
    var member_count = 0; //總數
    var member_bad_count = 0; //停權會員數
    $("#member_list").click(function() {

        member_count = 0;
        member_bad_count = 0;

        $("#show_goods").empty();
        $("#show_order").empty();

        $.ajax({
            type: "get",
            url: "/api/owner/read_member_count",
            dataType: "json",
            success: function(data) {

                if (data) {
                    // console.log(data.data);
                    $("#show_member").empty();

                    data.data.forEach(function(item) {

                        if (item.Member_state == 2) {
                            member_bad_count += 1;
                        };
                        member_count += 1;
                    });

                    $("#show_member").append(

                        '<div class="col-md-4 offset-md-2">' +
                        '<div class="card">' +
                        '<div class="card-body text-center w-100">' +
                        '<div class="fs-3">會員總數</div>' +
                        '<div class="fs-4">' + member_count + '</div>' +
                        '</div>' +
                        '</div>' +
                        '</div>' +
                        '<div class="col-md-4">' +
                        '<div class="card">' +
                        '<div class="card-body text-center w-100">' +
                        '<div class="fs-3">停權會員</div>' +
                        '<div class="fs-4">' + member_bad_count + '</div>' +
                        '</div>' +
                        '</div>' +
                        '</div>'

                    )
                    // 建立canvas元素並設定id及class屬性
                    var member_chart = $("<canvas>").attr("id", "myChart");
                    // 將canvas元素加入到一個div元素中
                    var member_c = $("<div>").append(member_chart);
                    // 修改div元素的class屬性
                    member_c.addClass("col-6 offset-3");
                    $("#show_member").append(member_c);

                    var ctx = member_chart[0].getContext("2d");
                    new Chart(ctx, {
                        type: 'bar',
                        data: {
                            labels: ['會員總數', '停權會員'],
                            datasets: [{
                                label: '# of member',
                                data: [member_count, member_bad_count],
                                backgroundColor: [
                                    '#1D6A96', //藍色
                                    '#ff8eb3', //粉色
                                ],
                                borderWidth: 1
                            }]
                        },
                        options: {
                            scales: {
                                y: {
                                    beginAtZero: true
                                }
                            }
                        }
                    });
                }

            },
            error: function() {
                console.log("沒有");
            }
        });
    });


    //商品資料 撈取 ＆ 處理
    var goods_count = 0; //總數
    var goods_bad_count = 0; //下架商品數
    var goods_up_count = 0; //上架商品數
    $("#goods_list").click(function() {

        goods_count = 0;
        goods_bad_count = 0;
        goods_up_count = 0;

        $("#show_member").empty();
        $("#show_order").empty();

        $.ajax({
            type: "get",
            url: "/api/owner/read_goods_count",
            dataType: "json",
            success: function(data) {

                if (data) {
                    // console.log(data.data);
                    $("#show_goods").empty();

                    data.data.forEach(function(item) {

                        if (item.Goods_state == 1) {
                            goods_up_count += 1;
                        } else if (item.Goods_state == 0) {
                            goods_bad_count += 1;
                        }
                        goods_count += 1;
                    });

                    $("#show_goods").append(

                        '<div class="col-md-4">' +
                        '<div class="card">' +
                        '<div class="card-body text-center w-100">' +
                        '<div class="fs-3">商品總數</div>' +
                        '<div class="fs-4">' + goods_count + '</div>' +
                        '</div>' +
                        '</div>' +
                        '</div>' +

                        '<div class="col-md-4">' +
                        '<div class="card">' +
                        '<div class="card-body text-center w-100">' +
                        '<div class="fs-3">上架商品</div>' +
                        '<div class="fs-4">' + goods_up_count + '</div>' +
                        '</div>' +
                        '</div>' +
                        '</div>' +

                        '<div class="col-md-4">' +
                        '<div class="card">' +
                        '<div class="card-body text-center w-100">' +
                        '<div class="fs-3">下架商品</div>' +
                        '<div class="fs-4">' + goods_bad_count + '</div>' +
                        '</div>' +
                        '</div>' +
                        '</div>'
                    )

                    // 建立canvas元素並設定id及class屬性
                    var goods_chart = $("<canvas>").attr("id", "myChart");
                    // 將canvas元素加入到一個div元素中
                    var goods_c = $("<div>").append(goods_chart);
                    // 修改div元素的class屬性
                    goods_c.addClass("col-6 offset-3");
                    $("#show_goods").append(goods_c);

                    var ctx = goods_chart[0].getContext("2d");
                    new Chart(ctx, {
                        type: 'bar',
                        data: {
                            labels: ['商品總數', '上架商品', '下架商品'],
                            datasets: [{
                                label: '# of goods',
                                data: [goods_count, goods_up_count, goods_bad_count],
                                backgroundColor: [
                                    '#1D6A96', //藍色
                                    '#B7D6BF', //綠色
                                    '#ff8eb3', //粉色
                                ],
                                borderWidth: 1
                            }]
                        },
                        options: {
                            scales: {
                                y: {
                                    beginAtZero: true
                                }
                            }
                        }
                    });
                }

            },
            error: function() {
                console.log("沒有");
            }

        });
    });


    //訂單資料 撈取 ＆ 處理
    var order_count = 0; //總數
    var order_go_count = 0; //進行中數量
    var order_ok_count = 0; //已完成數量
    var order_cancel_count = 0; //被取消數量
    $("#order_list").click(function() {

        order_count = 0;
        order_go_count = 0;
        order_ok_count = 0;
        order_cancel_count = 0;

        $("#show_member").empty();
        $("#show_goods").empty();

        $.ajax({
            type: "get",
            url: "/api/owner/read_order_count",
            dataType: "json",
            success: function(data) {

                if (data) {
                    // console.log(data.data);
                    $("#show_order").empty();

                    data.data.forEach(function(item) {

                        if (item.Order_state == 1) {
                            order_go_count += 1;

                        } else if (item.Order_state == 2) {
                            order_ok_count += 1;

                        } else if (item.Order_state == 0) {
                            order_cancel_count += 1;
                        }
                        order_count += 1;
                    });

                    $("#show_order").append(

                        '<div class="col-md-3">' +
                        '<div class="card">' +
                        '<div class="card-body text-center w-100">' +
                        '<div class="fs-3">訂單總數</div>' +
                        '<div class="fs-4">' + order_count + '</div>' +
                        '</div>' +
                        '</div>' +
                        '</div>' +

                        '<div class="col-md-3">' +
                        '<div class="card">' +
                        '<div class="card-body text-center w-100">' +
                        '<div class="fs-3">進行中訂單</div>' +
                        '<div class="fs-4">' + order_go_count + '</div>' +
                        '</div>' +
                        '</div>' +
                        '</div>' +

                        '<div class="col-md-3">' +
                        '<div class="card">' +
                        '<div class="card-body text-center w-100">' +
                        '<div class="fs-3">已完成訂單</div>' +
                        '<div class="fs-4">' + order_ok_count + '</div>' +
                        '</div>' +
                        '</div>' +
                        '</div>' +

                        '<div class="col-md-3">' +
                        '<div class="card">' +
                        '<div class="card-body text-center w-100">' +
                        '<div class="fs-3">被取消訂單</div>' +
                        '<div class="fs-4">' + order_cancel_count + '</div>' +
                        '</div>' +
                        '</div>' +
                        '</div>'
                    )

                    // 建立canvas元素並設定id及class屬性
                    var order_chart = $("<canvas>").attr("id", "myChart");
                    // 將canvas元素加入到一個div元素中
                    var order_c = $("<div>").append(order_chart);
                    // 修改div元素的class屬性
                    order_c.addClass("col-6 offset-3");
                    $("#show_order").append(order_c);

                    var ctx = order_chart[0].getContext("2d");
                    new Chart(ctx, {
                        type: 'bar',
                        data: {
                            labels: ['訂單總數', '進行中訂單', '已完成訂單', '被取消訂單'],
                            datasets: [{
                                label: '# of order',
                                data: [order_count, order_go_count, order_ok_count, order_cancel_count],
                                backgroundColor: [
                                    '#1D6A96', //藍色
                                    '#ff8eb3', //粉色
                                    '#B7D6BF', //綠色
                                    '#c2c3be' //灰色
                                ],
                                borderWidth: 1
                            }]
                        },
                        options: {
                            scales: {
                                y: {
                                    beginAtZero: true
                                }
                            }
                        }
                    });
                }

            },
            error: function() {
                console.log("沒有");
            }

        });
    });
</script>
@endsection