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


@if (session()->has('user'))
    <h1>Welcome {{ session('user') }}</h1>
@else
    <h1>Please Login</h1>
@endif

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/css/bootstrap.min.css">
    <title>Document</title>
</head>
<body>
    @foreach ($row as $goods)
    <table>
        <tr>
            <td>{{ $goods->Goods_name }}</td>
            <td>{{ $goods->Goods_money }}</td>
        </tr>
    </table>
    @endforeach

    {{ $row->links() }}
</body>
<script src="/js/bootstrap.bundle.min.js"></script>
<script>
    var data = "{{ Session::get('user') }}";
    console.log(data);
</script>
</html>