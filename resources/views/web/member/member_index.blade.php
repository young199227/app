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

            <h3>個人資訊</h3>

            <div class="row mt-4">
                <div class="col-3 d-flex align-items-center justify-content-end">
                    <div class="">註冊信箱：</div>
                </div>
                <div class="col-6">
                    <input type="text" class="form-control inputtext" id="" value="" disabled>
                </div>
            </div>
            

            <h3 class="mt-5">更改密碼</h3>
            
            <div class="row mt-4">
                <div class="col-3 d-flex align-items-center justify-content-end">
                    <div class="">舊密碼：</div>
                </div>
                <div class="col-6">
                    <input type="text" class="form-control inputtext" id="">
                </div>
            </div>
            <div class="row mt-4">
                <div class="col-3 d-flex align-items-center justify-content-end">
                    <div class="">新密碼：</div>
                </div>
                <div class="col-6">
                    <input type="text" class="form-control inputtext" id="">
                </div>
            </div>
            <div class="row mt-4">
                <div class="col-3 d-flex align-items-center justify-content-end">
                    <div class="">確認密碼：</div>
                </div>
                <div class="col-6">
                    <input type="text" class="form-control inputtext" id="">
                </div>
            </div>
            <div class="row mt-4">
                <div class="col-9 d-flex align-items-center justify-content-end">
                    <button class="btn btn-success">修改密碼</button>
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
</script>
@endsection