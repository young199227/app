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
                        <th>目前狀態</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($row as $member)
                    <tr id="member_id{{ $member->Member_id}}" style="line-height: 80px;">
                        <td>{{ $member->Member_id}}</td>
                        <td>{{ $member->Member_email}}</td>
                        <td>{{ $member->Member_created_at}}</td>
                        <td>
                            @if( $member->Member_state==1 )
                            <button class="btn btn-outline-danger ms-3" onclick="delete_member(this)" data-member_id="{{$member->Member_id}}">正常</button>
                            @elseif( $member->Member_state==2 )
                            <button class="btn btn-outline-success ms-3" onclick="up_member(this)" data-member_id="{{$member->Member_id}}">停權</button>
                            @endif
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
    //ajax修改會員正常與停權

    //delete_member 停權會員
    function delete_member(html){

        dataJson = {};
        dataJson["id"] = $(html).data("member_id");
        console.log(JSON.stringify(dataJson));
        $.ajax({
            type: "post",
            url: "/api/owner/delete_member",
            data: JSON.stringify(dataJson),
            dataType: "json",
            contentType: "application/json; charset=utf-8",
            success: function(data) {

                if (data.state) {
                    // $("#goods_id" + $(html).data("goods_id")).css('background-color','dimgrey');
                    window.location.reload();
                }
            },
            error: function() {
                console.log("ajax失敗");
            }
        });
    }

    //up_member 恢復會員
    function up_member(html){

        dataJson = {};
        dataJson["id"] = $(html).data("member_id");
        console.log(JSON.stringify(dataJson));
        $.ajax({
            type: "post",
            url: "/api/owner/up_member",
            data: JSON.stringify(dataJson),
            dataType: "json",
            contentType: "application/json; charset=utf-8",
            success: function(data) {

                if (data.state) {
                    // $("#goods_id" + $(html).data("goods_id")).css('background-color','dimgrey');
                    window.location.reload();
                }
            },
            error: function() {
                console.log("ajax失敗");
            }
        });
    }
</script>
@endsection