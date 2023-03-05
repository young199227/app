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

</style>
@endsection
<!-- 把內容插入到index_header_footer的section('main')位置 -->
<!-- 最下面還要補上endsection -->
@section('main')
@parent
<div class="row">
    <div class="col-12">
        <div class="ownerbox">
            <!-- main開始 -->
            <h3>訂單資訊(點擊查看內容)</h3>

            <!-- 訂單內容 -->
            <div id="">

                <p>
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
                            <div class="h3">購物內容</div>
                            <div class="col">
                                <div class="imgbox"><img src="" alt=""></div>
                                <p>商品名稱：</p>
                                <p>商品數量：</p>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
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

    $.ajax({
        type:"get",
        url:"/api/owner/read_order",
        contentType: "application/json; charset=utf-8",
        dataType:"json",
        success:function(data){
            console.log(data[0]);
        },
        error:function(){
            console.log("沒有進去");
        }
    });
</script>
@endsection