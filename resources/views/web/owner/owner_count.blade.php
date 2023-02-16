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
            <div class="row">
                <div class="col-12 text-center">
                    <div class="fs-2">數量統計</div>
                </div>
            </div>
            <div class="row mt-3">

                <div class="col-md-4">
                    <div class="card">
                        <div class="card-body text-center w-100">
                            <div class="fs-3">註冊會員</div>
                            <div class="fs-4">{{ $row_member[0]->member_count }}</div>
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="card">
                        <div class="card-body text-center w-100">
                            <div class="fs-3">上架商品</div>
                            <div class="fs-4">{{ $row_goods[0]->goods_count }}</div>
                        </div>
                    </div>
                </div>

                <div class="col-md-4"></div>
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