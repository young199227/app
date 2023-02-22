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

                <div class="col-md-4 offset-2">
                    <div class="card">
                        <div class="card-body text-center w-100">
                            <div class="fs-3">會員總數</div>
                            <div class="fs-4">{{ $member_count->Member_count }}</div>
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="card">
                        <div class="card-body text-center w-100">
                            <div class="fs-3">停權會員</div>
                            <div class="fs-4">{{ $member_old_count->Member_count }}</div>
                        </div>
                    </div>
                </div>

            </div>

            <div class="row mt-3">

                <div class="col-md-4">
                    <div class="card">
                        <div class="card-body text-center w-100">
                            <div class="fs-3">商品總數</div>
                            <div class="fs-4">{{$goods_up_count->Goods_count + $goods_old_count->Goods_count}}</div>
                        </div>
                    </div>
                </div>
                
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-body text-center w-100">
                            <div class="fs-3">上架商品</div>
                            <div class="fs-4">{{ $goods_up_count->Goods_count }}</div>
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="card">
                        <div class="card-body text-center w-100">
                            <div class="fs-3">下架商品</div>
                            <div class="fs-4">{{ $goods_old_count->Goods_count }}</div>
                        </div>
                    </div>
                </div>
                
            </div>


            <div class="row mt-3">
                <div class="col-6">
                    <canvas id="memberChart"></canvas>
                </div>
                <div class="col-6"></div>
            </div>
        </div>
    </div>
</div>

@endsection

@section('script')
@parent
<script src="/js/chart.js"></script>
<script>

    var M_Count = "{{$member_count->Member_count}}" ; 
    var M_old_Count = "{{ $member_old_count->Member_count }}" ;

    new Chart($("#memberChart"), {
        type: 'bar',
        data: {
            labels: ['會員總數', '停權會員',],
            datasets: [{
                label: '會員數量',
                data: [M_Count, M_old_Count],
                borderWidth: 0.5
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });

</script>
@endsection