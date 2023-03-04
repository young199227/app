<!-- 繼承了fruit_index_header_footer頁面 -->
@extends('web.index.fruit_index_header_footer')

<!-- link回傳 -->
@section('link')
@parent
<link rel="stylesheet" href="/css/goods_car.css">
@endsection
<!-- 把內容插入到index_header_footer的section('main')位置 -->
<!-- 最下面還要補上endsection -->
@section('main')
@parent
<div class="container">
    <div class="display-3 mt-3 d-flex justify-content-center text-success">購物車</div>
    <div class="row mt-3">
        <div class="col-12">
            <div class="ownerbox">

                <table class="table text-center table-hover">
                    <thead class="table-success ">
                        <tr>
                            <th>編號</th>
                            <th>商品圖片</th>
                            <th>商品名稱</th>
                            <th>商品數量</th>
                            <th>商品價格</th>
                            <th>操作</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if(empty($row))

                        @else
                        @foreach($row as $goods)
                        <tr style="line-height: 80px;">
                            <td>{{$goods->Goods_id}}</td>
                            <td class="imgbox"><img src="{{$goods->Goods_img}}" onerror="this.onerror=null;this.src='/img/img_Prepare.png';"></td>
                            <td>{{$goods->Goods_name}}</td>
                            <td>
                                <select class="w-50" aria-label="Default select example" id="car_goods_count" data-member_id="{{$goods->Member_id}}" data-goods_id="{{$goods->Goods_id}}" data-goods_money="{{$goods->Goods_money}}">
                                    <option selected disabled value="{{$goods->Goods_count}}">{{$goods->Goods_count}}</option>
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>
                                    <option value="5">5</option>
                                </select>
                            </td>
                            <td id="car_goods_money{{$goods->Goods_id}}">{{$goods->Goods_money * $goods->Goods_count}}</td>
                            <td>
                                <button class="btn btn-danger ms-3" id="car_goods_delete" data-member_id="{{$goods->Member_id}}" data-goods_id="{{$goods->Goods_id}}">刪除</button>
                            </td>
                        </tr>
                        @endforeach
                        @endif
                    </tbody>
                </table>

            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12 text-end">
            <!-- 算出購物車內商品總價 -->
            @if(empty($row))
            <span class="fs-5">總金額: $<span id="goods_car_toto">0</span></span>
            @else
            @php
            $goods_car_toto = 0;
            for ($i = 0; $i < count($row); $i++) { $goods_car_toto +=$row[$i]->Goods_money * $row[$i]->Goods_count;}
                @endphp
                <span class="fs-5">總金額: $<span id="goods_car_toto">{{$goods_car_toto}}</span></span>
                @endif
                <!-- 算出購物車內商品總價 -->

                <button class="btn btn-warning" style="width:150px" data-bs-toggle="modal" data-bs-target="#exampleModal" id="checkout">去買單</button>
        </div>
    </div>
</div>
</div>
<!-- 藏一下會員ID -->
@if(empty($row))
@else
<span class="d-none" id="car_member_id">{{$row[0]->Member_id}}</span>
@endif
<!-- 藏一下會員ID -->

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">送出訂單</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">

                <!-- 送出訂單＿輸入部分 -->
                <div class="row mb-3 text-center">
                    <div class="col-2">
                        <label for="address" class="form-label col-form-label">收件人</label>
                    </div>
                    <div class="col-9">
                        <input type="text" class="form-control" id="member_name">
                    </div>
                </div>

                <div class="row mb-3 text-center">
                    <div class="col-2">
                        <label for="address" class="form-label col-form-label">地址</label>
                    </div>
                    <div class="col-9">
                        <input type="text" class="form-control" id="member_area">
                    </div>
                </div>

                <div class="row mb-3 text-center">
                    <div class="col-2">
                        <label for="address" class="form-label col-form-label">電話</label>
                    </div>
                    <div class="col-9">
                        <input type="text" class="form-control" id="member_phone">
                    </div>
                </div>

                <div class="row mt-3">
                    <div class="col-4 d-flex justify-content-center">
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault1" checked>
                            <label class="form-check-label" for="flexRadioDefault1">
                                貨到付款
                            </label>
                        </div>
                    </div>
                    <div class="col-4 d-flex justify-content-center">
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="flexRadioDisabled" id="flexRadioDisabled" disabled>
                            <label class="form-check-label" for="flexRadioDisabled">
                                ATM
                            </label>
                        </div>
                    </div>
                    <div class="col-4 d-flex justify-content-center">
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="flexRadioDisabled" id="flexRadioDisabled" disabled>
                            <label class="form-check-label" for="flexRadioDisabled">
                                visa
                            </label>
                        </div>
                    </div>
                </div>

                <!-- 送出訂單＿確認物品部分 -->
                <div class="h5 text-center mt-4">購買內容</div>
                <div class="text-danger text-center">總價格: $ <span id="goods_car_order_money"></span></div>
                <div class="shpbox" style="border: 2px solid rgb(228, 228, 228);" id="show_goods_car_list">

                    <!-- 單一物品 -->
                    <!-- <div class="row mb-3 mt-3 text-center">
                        <div class="col-3 d-flex justify-content-center">
                            <div class="">
                                <div class="imgbox"><img src="/img/fruit_images/fruit50.png" alt=""></div>
                            </div>
                        </div>
                        <div class="col-3 d-flex justify-content-center align-items-center">
                            <div class="">
                                <span class="h5">超好ㄔ蘋果</span>
                            </div>
                        </div>
                        <div class="col-3 d-flex justify-content-center align-items-center">
                            <div class="">
                                <div class="h5">$20000</div>
                            </div>
                        </div>
                        <div class="col-3 d-flex justify-content-center align-items-center">
                            <div class="">
                                <div class="h5">4箱</div>
                            </div>
                        </div>
                    </div> -->

                </div>

            </div>
            <!-- 最後確認 -->
            <div class="modal-footer">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" id="order_check_ok">
                    <label class="form-check-label" for="order_check_ok">
                        確認同意
                    </label>
                </div>
                <button type="button" class="btn btn-warning" id="add_order">送出</button>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
@parent
<script src="/js/sweetalert2.js"></script>
<script>
    //商品數量變動後改單個商品價錢+總價錢
    $("td #car_goods_count").bind('input propertychange', function() {

        //總價的變數
        var goods_car_toto = 0;
        //儲存$("td #car_goods_count")讓他可以在ajax裡面作用
        var count_html = $(this);

        var dataJson = {};
        dataJson['member_id'] = $(this).data('member_id');
        dataJson['goods_id'] = $(this).data('goods_id');
        dataJson['goods_count'] = $(this).val();
        // console.log(JSON.stringify(dataJson));
        $.ajax({
            type: "POST",
            url: "/api/goods_car/count_update",
            data: JSON.stringify(dataJson),
            dataType: "json",
            contentType: "application/json; charset=utf-8",
            success: function(data) {

                if (data.state) {
                    //修改後的單個商品總價錢更改
                    $("#car_goods_money" + count_html.data('goods_id')).text(count_html.val() * count_html.data('goods_money'));
                    // 使用each()方法遍歷所有car_goods_money開頭的元素 text相加變成goods_car_toto
                    $('[id^="car_goods_money"]').each(function() {
                        goods_car_toto += parseInt($(this).text());
                    });
                    //修改後的總價錢更改
                    $("#goods_car_toto").text(goods_car_toto);
                }
            },
            error: function() {
                console.log("ajax失敗");
            }
        });
    });
    //刪除購物車內的商品
    $("td #car_goods_delete").click(function() {
        var dataJson = {};
        dataJson['member_id'] = $(this).data('member_id');
        dataJson['goods_id'] = $(this).data('goods_id');
        // console.log(JSON.stringify(dataJson));
        $.ajax({
            type: "POST",
            url: "/api/goods_car/delete",
            data: JSON.stringify(dataJson),
            dataType: "json",
            contentType: "application/json; charset=utf-8",
            success: function(data) {

                if (data.state) {
                    window.location.reload();
                }
            },
            error: function() {
                console.log("ajax失敗");
            }
        });
    });

    //按下去買單 撈出所有購物車內容顯示在Modal
    $("#checkout").click(function() {

        var dataJson = {};
        dataJson['member_id'] = $("#car_member_id").text();
        // console.log(JSON.stringify(dataJson));
        $.ajax({
            type: "POST",
            url: "/api/goods_car/goods_car_list",
            data: JSON.stringify(dataJson),
            dataType: "json",
            contentType: "application/json; charset=utf-8",
            success: function(data) {
                //迴圈前先清空
                $("#show_goods_car_list").empty();
                //總價錢的變數
                var goods_car_order_money = 0;

                data.forEach(item => {
                    $("#show_goods_car_list").append(
                        '<div class="row mb-3 mt-3 text-center">' +
                        '<div class="col-3 d-flex justify-content-center">' +
                        '<div class="">' +
                        '<div class="imgbox"><img src="' + item.Goods_img + '" onerror="this.onerror=null;this.src=' + "'/img/img_Prepare.png'" + ';"></div>' +
                        '</div>' +
                        '</div>' +
                        '<div class="col-3 d-flex justify-content-center align-items-center">' +
                        '<div class="">' +
                        '<span class="h5">' + item.Goods_name + '</span>' +
                        '</div>' +
                        '</div>' +
                        '<div class="col-3 d-flex justify-content-center align-items-center">' +
                        '<div class="">' +
                        '<div class="h5">' + item.Goods_count + "箱" + '</div>' +
                        '</div>' +
                        '</div>' +
                        '<div class="col-3 d-flex justify-content-center align-items-center">' +
                        '<div class="">' +
                        '<div class="h5">' + "$" + item.Goods_money * item.Goods_count + '</div>' +
                        '</div>' +
                        '</div>' +
                        '</div>'
                    );

                    goods_car_order_money += item.Goods_money * item.Goods_count;
                });
                //更改model總價錢
                $("#goods_car_order_money").text(goods_car_order_money);
            },
            error: function() {
                console.log("ajax失敗");
            }
        });
    });

    //送出訂單
    $("#add_order").click(function() {

        if ($("#member_name").val() != "" && $("#member_area").val() != "" && $("#member_phone").val() != "") {

            if ($('#order_check_ok').prop('checked')) {

                var dataJson = {};
                dataJson['member_id'] = $("#car_member_id").text();
                dataJson['member_name'] = $("#member_name").val();
                dataJson['member_area'] = $("#member_area").val();
                dataJson['member_phone'] = $("#member_phone").val();
                dataJson['order_money'] = $("#goods_car_order_money").text();
                console.log(JSON.stringify(dataJson));

                $.ajax({
                    type: "POST",
                    url: "/api/goods_car/add_order",
                    data: JSON.stringify(dataJson),
                    dataType: "json",
                    contentType: "application/json; charset=utf-8",
                    success: function(data) {

                        console.log(data);

                        Swal.fire({
                            icon: 'success',
                            title: '成功購買!',
                            timer: 2500,
                            timerProgressBar: true,
                            didOpen: () => {
                                Swal.showLoading()
                            }
                        })
                        setTimeout(function() {
                            $(location).attr("href", "/member");
                        }, 2500);
                    },
                    error: function() {
                        console.log("ajax失敗");
                    }
                });

            } else {
                Swal.fire({
                    icon: 'error',
                    title: '請點同意並確認訂單內容'
                })
            }
        } else {
            Swal.fire({
                icon: 'error',
                title: '請確認資料都有填寫!'
            })
        }
    });
</script>
@endsection