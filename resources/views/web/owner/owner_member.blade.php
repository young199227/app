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

            <table class="table text-center">
                <thead>
                    <tr>
                        <th>編號</th>
                        <th>會員信箱</th>
                        <th>創建日期</th>
                        <th>操作</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($row as $member)
                    <tr id="member_id{{ $member->Member_id}}" style="line-height: 80px;">
                        <td>{{ $member->Member_id}}</td>
                        <td>{{ $member->Member_email}}</td>
                        <td>{{ $member->Member_created_at}}</td>
                        <td>
                            <a href=""><button class="btn btn-outline-dark">修改</button></a>
                            <!-- <button class="btn btn-danger ms-3" onclick="delete_goods(this)" data-member_id="">刪除</button> -->
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>

        </div>
    </div>
</div>
<div class="row">
    <div class="col d-flex justify-content-center">
        <div class="">
            {{ $row ->links() }} 
        </div>
    </div>
</div>

@endsection

@section('script')
@parent
<script>
    //ajax刪除商品
    //delete_goods方法傳入按鈕自身html(this)改名(html)
    // function delete_goods(html) {

    //     if (confirm("確實要刪除嗎?")) {

    //         dataJson = {};
    //         dataJson["id"] = $(html).data("goods_id");
    //         //console.log(JSON.stringify(dataJson));
    //         $.ajax({
    //             type: "post",
    //             url: "/api/owner/delete_goods",
    //             data: JSON.stringify(dataJson),
    //             dataType: "json",
    //             contentType: "application/json; charset=utf-8",
    //             success: function(data) {

    //                 if (data.state) {
    //                     $("#goods_id" + $(html).data("goods_id")).remove();
    //                 }
    //             },
    //             error: function() {
    //                 console.log("ajax失敗");
    //             }
    //         });
    //     }
    // }
</script>
@endsection