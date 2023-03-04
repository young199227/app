<!-- 繼承了member_index_header頁面 -->
@extends('web.member.member_index_header')

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
            @if(empty($row))
            <!-- 沒訂單時顯示 -->
            <div class="text-center">
                <img src="/img/GIF/27.gif" alt="">
                <p class="h4 mt-3">這裡空空如也～沒有任何訂單！</p>
                <a href="/fruit" class="text-danger h5">點我去看商品！</a>
            </div>
            @else
            <!-- 有訂單時顯示 -->
            @foreach ($row as $Order)
            <!-- 使用 loop 變數來取得目前迴圈的索引值，並利用 $row[$loop->index - 1] 取得上一筆資料。-->
            <!-- 使用 if 判斷如果這是第一筆資料，或者這筆資料的 Order ID（訂單編號） 跟上一筆不同，就顯示訂單資訊  -->
            @if($loop->first || $Order->Order_id != $row[$loop->index - 1]->Order_id)
            <p>
                <div class="row" style="border: 1px solid #ced4da;padding: 15px;border-radius: 10px;">
                    <div class="col-5">
                        <a class="text-decoration-none text-black" data-bs-toggle="collapse" href="#collex{{ $Order->Order_id }}" role="button" aria-expanded="false" aria-controls="collapseExample">
                        <div class="h3 text-danger"><i class="fa-solid fa-burger"></i> 訂單編號：{{ $Order->Order_id }} </div>
                            <p>總金額：{{ $Order->Order_money }}</p>
                            <p>訂單創建時間：{{ $Order->Order_created_at }}</p>
                        </a>
                    </div>
                    <div class="col-5">
                        <p>收件人：{{ $Order->Member_name }}</p>
                        <p>電話：{{ $Order->Member_phone }}</p>
                        <p>地址：{{ $Order->Member_area }}</p>
                    </div>
                    @if ($Order->Order_state == 1)
                    <div class="col-2 text-center">
                        狀態
                        <p class="h3 text-success mt-4">進行中</p>
                    @elseif ($Order->Order_state == 2)
                    <div class="col-2 text-center">
                        狀態
                        <p class="h3 text-secondary mt-4">已完成</p>
                    @elseif ($Order->Order_state == 0)
                    <div class="col-2 text-center">
                        狀態
                        <p class="h3 test-danger mt-4">已取消</p>
                    @endif
                    </div>
                </div>
            </p>
            <div class="collapse" id="collex{{ $Order->Order_id }}">
                <div class="card card-body">
                    <div class="row">
                        <div class="h3">購物內容</div>
            @endif
                        <div class="col">
                            <div class="imgbox"><img src="{{ $Order->Goods_img }}" alt=""></div>
                            <p>商品名稱：{{ $Order->Goods_name }}</p>
                            <p>商品數量：{{ $Order->Order_goods_count }}</p>
                        </div>
                        <!-- 如果這是最後一筆資料，或者這筆資料的 Order ID（訂單編號） 跟下一筆不同，就結束訂單區塊 -->
                        @if ($loop->last || $Order->Order_id !== $row[$loop->index + 1]->Order_id)
                    </div>
                </div>
            </div>
            @endif
        <!-- 訂單迴圈結束 -->
        @endforeach
    <!-- 顯示訂單結束 -->
    @endif
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
</script>
@endsection