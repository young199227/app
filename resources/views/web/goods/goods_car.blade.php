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
                    <thead class="table-success">
                        <tr>
                            <th>編號</th>
                            <th>商品圖片</th>
                            <th>商品名稱</th>
                            <th>商品價格</th>
                            <th>商品數量</th>
                            <th>操作</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr style="line-height: 80px;">
                            <td>12314</td>
                            <td class="imgbox"><img src="/img/fruit_images/fruit50.png" alt=""></td>
                            <td>abcefg</td>
                            <td>20000</td>
                            <td>1</td>
                            <td>
                                <button class="btn btn-danger ms-3">刪除</button>
                            </td>
                        </tr>

                    </tbody>
                </table>

            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12 text-end">
            <span class="">總金額(0個商品) : $0</span>
            <button class="btn btn-warning" style="width:150px" data-bs-toggle="modal" data-bs-target="#exampleModal">去買單</button>
        </div>
    </div>
</div>
</div>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">詳細訂單</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">

                <!-- 送出訂單＿輸入部分 -->
                <div class="row mb-3 text-center">
                    <div class="col-2">
                        <label for="address" class="form-label col-form-label">收件人</label>
                    </div>
                    <div class="col-9">
                        <input type="text" class="form-control" id="address" name="address">
                    </div>
                </div>
                <div class="row mb-3 text-center">
                    <div class="col-2">
                        <label for="address" class="form-label col-form-label">地址</label>
                    </div>
                    <div class="col-9">
                        <input type="text" class="form-control" id="address" name="address">
                    </div>
                </div>
                <div class="row mb-3 text-center">
                    <div class="col-2">
                        <label for="address" class="form-label col-form-label">電話</label>
                    </div>
                    <div class="col-9">
                        <input type="text" class="form-control" id="address" name="address">
                    </div>
                </div>

                <!-- 送出訂單＿確認物品部分 -->
                <div class="h5 text-center mt-5">購買內容</div>
                <div class="shpbox" style="border: 2px solid rgb(228, 228, 228);">

                    <!-- 單一物品 -->
                    <div class="row mb-3 mt-3 text-center">
                        <div class="col-4 d-flex justify-content-center">
                            <div class="">
                                <div class="imgbox"><img src="/img/fruit_images/fruit50.png" alt=""></div>
                            </div>
                        </div>
                        <div class="col-4 d-flex justify-content-center align-items-center">
                            <div class="">
                                <span class="h5">超好ㄔ蘋果</span>
                            </div>
                        </div>
                        <div class="col-4 d-flex justify-content-center align-items-center">
                            <div class="">
                                <div class="h5">$20000</div>
                            </div>
                        </div>
                    </div>

                </div>

            </div>

            <div class="modal-footer">
                <input type="checkbox" id="check_ok">確認同意
                <button type="button" class="btn btn-warning">送出</button>
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