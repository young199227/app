<!-- 繼承了owner_index_header頁面 -->
@extends('web.test.owner_index_header')

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
            <h1>修改商品 No.{{ $row->Goods_id}}</h1>
            <!-- 商品圖片 -->
            <div class="row mt-4">
                <div class="col-3 d-flex align-items-center justify-content-end">
                    <div class="">商品圖片：</div>
                </div>
                <div class="col-9">
                    <input accept="image/*" type='file' id="imgInp" style="width: 100%;" multiple />
                    <div class="imgrow" id="show_img">
                        <!-- 圖片顯示的地方 -->
                    </div>
                </div>
            </div>

            <!-- 商品名稱 -->
            <div class="row mt-4">
                <div class="col-3 d-flex align-items-center justify-content-end">
                    <div class="">商品名稱：</div>
                </div>
                <div class="col-9">
                    <input type="text" class="form-control inputtext" id="Goods_name" name="Goods_name" value="{{$row->Goods_name}}">
                </div>
            </div>

            <!-- 商品價錢 -->
            <div class="row mt-4">
                <div class="col-3 d-flex align-items-center justify-content-end">
                    <div class="">商品價錢：</div>
                </div>
                <div class="col-9 goodsPNW">
                    <input type="number" class="form-control inputtext" min="1" max="100000" id="Goods_money" name="Goods_money" value="{{$row->Goods_money}}">
                </div>
            </div>

            <!-- 商品數量 -->
            <div class="row mt-4">
                <div class="col-3 d-flex align-items-center justify-content-end">
                    <div class="">商品數量(箱)：</div>
                </div>
                <div class="col-9 goodsPNW">
                    <input type="number" class="form-control inputtext" id="Goods_sum" name="Goods_sum" value="{{$row->Goods_sum}}">
                </div>
            </div>

            <!-- 產地 -->
            <div class="row mt-4">
                <div class="col-3 d-flex align-items-center justify-content-end">
                    <div class="">產地：</div>
                </div>
                <div class="col-9 goodsPNW">
                    <select class="form-select" aria-label="Default select example" id="Goods_area">
                        <!-- <option selected>ㄧ請選擇ㄧ</option> -->
                        <option selected value="{{ $row->Goods_area }}">{{ $row->Goods_area }}</option> 
                        <option value="台北">台北</option>
                        <option value="台中">台中</option>
                        <option value="南投">南投</option>
                    </select>
                </div>
            </div>

            <!-- 商品描述 -->
            <div class="row mt-4">
                <div class="col-3 d-flex align-items-center justify-content-end">
                    <div class="">商品描述：</div>
                </div>
                <!-- Goods_detail -->
                <div class="col-9">
                    <textarea name="Goods_detail" id="Goods_detail" class="goods_textarea" rows="6">{{$row->Goods_detail}}</textarea>
                </div>
            </div>

            <!-- 更新按鈕 -->
            <div class="row mt-4">
                <div class="col-12 d-flex align-items-center justify-content-center">
                    <div class="btn btn-outline-success" onclick="update_goods(this)" data-goods_id="{{ $row->Goods_id}}">更新</div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
@parent
<script>
    //圖片上傳前預覽
    $("#imgInp").bind('input propertychange', function() {

        //把過長的files名稱縮短
        var img_array = $("#imgInp")[0].files;

        if (img_array.length <= 6 && img_array.length >= 1) {

            $("#show_img").empty();

            for (i = 0; i < img_array.length; i++) {

                $("#show_img").append(
                    '<div class="imgbox img-fluid ">' +
                    '<img id="blah" src="' + URL.createObjectURL(img_array[i]) + '" alt="your image" />' +
                    '</div>'
                );
            }

        } else {

            $("#show_img").empty();

            $("#imgInp").val("");

            alert("圖片不能超過六張 或 沒圖片");
        }

    });

    function update_goods(html) {

        dataJson = {};
        dataJson["Goods_id"] = $(html).data("goods_id");
        dataJson["Goods_name"] = $("#Goods_name").val();
        dataJson["Goods_money"] = $("#Goods_money").val();
        dataJson["Goods_sum"] = $("#Goods_sum").val();
        dataJson["Goods_area"] = $("#Goods_area :selected").val();
        dataJson["Goods_detail"] = $("#Goods_detail").val();
        console.log(JSON.stringify(dataJson));
        $.ajax({
            type: "post",
            url: "/test2/test_upload",
            data: JSON.stringify(dataJson),
            dataType: "json",
            contentType: "application/json; charset=utf-8",
            success: function(data) {
                if(data.state){
                    console.log(data.message);
                    $(location).attr("href","http://127.0.0.1:8000/owner");
                }else{
                    alert (data.message);
                }
            },
            error: function() {
                console.log("ajax失敗");
            }
        });
    }
</script>
@endsection