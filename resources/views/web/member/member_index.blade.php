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
                <div class="col-md-3 col-5 d-flex align-items-center justify-content-end">
                    <div class="">註冊信箱：</div>
                </div>
                <div class="col-md-6 col-7">
                    <input type="text" class="form-control inputtext" id="" value="{{ Session('member') }}" disabled>
                </div>
            </div>
            

            <h3 class="mt-5 d-inline-block">更改密碼</h3><span>(6~12字)</span>
            
            <div class="row mt-4">
                <div class="col-md-3 col-5 d-flex align-items-center justify-content-end">
                    <div class="">舊密碼：</div>
                </div>
                <div class="col-md-6 col-7">
                    <input type="password" class="form-control inputtext" id="old_password">
                </div>
            </div>
            <div class="row mt-4">
                <div class="col-md-3 col-5 d-flex align-items-center justify-content-end">
                    <div class="">新密碼：</div>
                </div>
                <div class="col-md-6 col-7">
                    <input type="password" class="form-control inputtext" id="new_password">
                </div>
            </div>
            <div class="row mt-4">
                <div class="col-md-3 col-5 d-flex align-items-center justify-content-end">
                    <div class="">確認密碼：</div>
                </div>
                <div class="col-md-6 col-7">
                    <input type="password" class="form-control inputtext" id="re_new_password">
                </div>
            </div>

            <div class="row mt-4">
                <div class="col-md-9 col-12 d-flex align-items-center justify-content-end">
                    <div class="form-text" id="err_text"></div>
                    <button class="btn btn-success" id="password_btn">修改密碼</button>
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
    $("#password_btn").click(function(){

        if($("#new_password").val() == $("#re_new_password").val() ){
            
            $("#err_text").text("");

            var psd = {} ;
            psd["old_password"] = $("#old_password").val();
            psd["new_password"] = $("#new_password").val();

            $.ajax({
                type:"post",
                url:"/session/member/updata_password",
                data:JSON.stringify(psd),
                dataType:"json",
                contentType: "application/json; charset=utf-8",
                success:function(data){
                    if(data.state){
                        alert("修改成功，請重新登入！");
                        $(location).attr("href","/session/member/logout");
                    }else{
                        alert(data.message);
                    }
                },
                error:function(){
                    console.log("沒進去ajax");
                }
            });


        }else{
            $("#err_text").text("新、確認密碼必須一致！").css("color","red");
        }
    });
</script>
@endsection