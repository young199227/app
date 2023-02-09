@if(!Session::has('user'))
<div style="float:right;">
    <a href="login">登入</a>
</div>
@endif
@if(Session::has('user'))
<div style="float:right;">
    <span>你好，{{ Session::get('user') }}</span>
    <a href="logout">登出</a>
</div>
@endif