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
            <h1>修改商品 No.{{ $row->Goods_id}}</h1>
            <!-- 商品圖片 -->
            <div class="row mt-4">
                <div class="col-3 d-flex align-items-center justify-content-end">
                    <div class="">商品圖片：</div>
                </div>
                <div class="col-9">
                    <input accept="image/*" type='file' id="fruit_imginp" style="width: 100%;" multiple />
                    <div class="imgrow" id="show_img">
                        <!-- 圖片顯示的地方 -->
                    @foreach ($row_img as $goods)
                        <div class="imgbox img-fluid">
                            <img src="{{$goods->Goods_img}}" alt="">
                        </div>
                    @endforeach
                    </div>
                </div>
            </div>

            <!-- 商品名稱 -->
            <div class="row mt-4">
                <div class="col-3 d-flex align-items-center justify-content-end">
                    <div class="">商品名稱：</div>
                </div>
                <div class="col-9">
                    <input type="text" class="form-control inputtext" id="fruit_name" value="{{$row->Goods_name}}">
                </div>
            </div>

            <!-- 商品價錢 -->
            <div class="row mt-4">
                <div class="col-3 d-flex align-items-center justify-content-end">
                    <div class="">商品價錢：</div>
                </div>
                <div class="col-9 goodsPNW">
                    <input type="number" class="form-control inputtext" min="1" max="100000" id="fruit_money" value="{{$row->Goods_money}}">
                </div>
            </div>

            <!-- 商品數量 -->
            <div class="row mt-4">
                <div class="col-3 d-flex align-items-center justify-content-end">
                    <div class="">商品數量(箱)：</div>
                </div>
                <div class="col-9 goodsPNW">
                    <input type="number" class="form-control inputtext" id="fruit_sum" value="{{$row->Goods_sum}}">
                </div>
            </div>

            <!-- 產地 -->
            <div class="row mt-4">
                <div class="col-3 d-flex align-items-center justify-content-end">
                    <div class="">產地：</div>
                </div>
                <div class="col goodsPNW">
                    <select class="form-select" aria-label="Default select example" id="fruit_city">
                        <option selected value="{{ $part1 }}">{{ $part1 }}</option>
                    </select>
                </div>
                <div class="col goodsPNW">
                    <select class="form-select" aria-label="Default select example" id="fruit_area">
                        <option selected value="{{ $part2 }}">{{ $part2 }}</option>
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
                    <textarea id="fruit_detail" class="goods_textarea" rows="6">{{$row->Goods_detail}}</textarea>
                </div>
            </div>

            <!-- 更新按鈕 -->
            <div class="row mt-4">
                <div class="col-12 d-flex align-items-center justify-content-center">
                    <div class="btn btn-outline-success" id="upd" onclick="update_goods(this)" data-goods_id="{{ $row->Goods_id}}">更新</div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
@parent
<!-- 全台縣市鎮資料引入 -->
<script src="/js/CityCountyData.js"></script>
<script>
    //縣市選擇變動
    CityCountyData.forEach(element => {

        if (element.CityName == "釣魚臺" || element.CityName == "南海島") {
            return;
        }

        $("#fruit_city").append(
            '<option value="' + element.CityName + '">' + element.CityName + '</option>'
        );
    });

    $("#fruit_city").change(function() {

        $("#fruit_area").empty();

        for (i = 0; i < CityCountyData.length; i++) {

            if (CityCountyData[i].CityName == $("#fruit_city :selected").val()) {

                CityCountyData[i].AreaList.forEach(element => {

                    $("#fruit_area").append(
                        '<option value="' + element.AreaName + '">' + element.AreaName + '</option>'
                    );
                });
            }
        }
    });


    //圖片上傳前預覽
    $("#fruit_imginp").bind('input propertychange', function() {

        //把過長的files名稱縮短
        var img_array = $("#fruit_imginp")[0].files;

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

    // 修改上傳商品
    function update_goods(html) {

        // dataJson["Goods_id"] = $(html).data("goods_id");

        var formData = new FormData();
        formData.append("ggyy00", fruit_imginp.files[0]);
        formData.append("ggyy01", fruit_imginp.files[1]);
        formData.append("ggyy02", fruit_imginp.files[2]);
        formData.append("ggyy03", fruit_imginp.files[3]);
        formData.append("ggyy04", fruit_imginp.files[4]);
        formData.append("ggyy05", fruit_imginp.files[5]);


        formData.append("goods_id", $("#upd").data('goods_id'));
        formData.append("goods_name", $("#fruit_name").val());
        formData.append("goods_money", $("#fruit_money").val());
        formData.append("goods_sum", $("#fruit_sum").val());
        formData.append("goods_area", $("#fruit_city :selected").val() + $("#fruit_area :selected").val());
        formData.append("goods_detail", $("#fruit_detail").val());

        console.log(formData);
        $.ajax({
            type: "post",
            url: "/api/owner/update_goods",
            data: formData,
            dataType: "json",
            cache: false,
            contentType: false,
            processData: false,
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