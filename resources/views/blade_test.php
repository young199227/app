<!-- 繼承了???頁面 -->
@extends('')

<!-- link回傳 -->
@section('link')
@parent
<link rel="stylesheet" href="">
@endsection

<!-- style回傳 -->
@section('style')
@parent
<style>

</style>
@endsection

<!-- main回傳 -->
@section('main')
@parent
<body>
    
</body>
@endsection

@section('script')
@parent
<script>
    console.log("test");
</script>
@endsection