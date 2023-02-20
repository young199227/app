<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>後臺管理</title>
    <link rel="stylesheet" href="/css/bootstrap.min.css">
</head>

<body>

    <div class="container-fluid">
        <div class="row mt-3">

            <div class="col-md-12 mb-3">
                <div class="card h-100">
                    <div class="card-body d-flex align-items-center">
                        <i class="fa-regular fa-money-bill-1 fa-6x"></i>
                        <div class="text-center w-100" id="member_sum">
                            <div class="fs-4">會員總數</div>
                            <h1 id="member_count">{{$member_count->Member_count}}</h1>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card h-100">
                    <div class="card-body d-flex align-items-center">
                        <i class="fa-regular fa-money-bill-1 fa-6x"></i>
                        <div class="text-center w-100">
                            <div class="fs-4">商品數量</div>
                            <h1 id="goods_count">{{$goods_up_count->Goods_count + $goods_old_count->Goods_count}}</h1>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card h-100">
                    <div class="card-body d-flex align-items-center">
                        <i class="fa-regular fa-money-bill-1 fa-6x"></i>
                        <div class="text-center w-100" style="color:red">
                            <div class="fs-4">上架商品</div>
                            <h1 id="goods_count">{{$goods_up_count->Goods_count}}</h1>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card h-100">
                    <div class="card-body d-flex align-items-center">
                        <i class="fa-regular fa-money-bill-1 fa-6x"></i>
                        <div class="text-center w-100" style="color:green">
                            <div class="fs-4">下架商品</div>
                            <h1 id="goods_count">{{$goods_old_count->Goods_count}}</h1>
                        </div>
                    </div>
                </div>
            </div>


            <div class="row mt-3">

                <div class="col-md-6">
                    <canvas id="myChart"></canvas>
                </div>
                <div class="col-md-6">
                    <canvas id="myPie"></canvas>
                </div>

            </div>

            <div id="app">
                <input type="text" class="form-control" v-model="text01">
                @verbatim
                <input type="text" class="form-control" v-model="text02">
                {{text01}}
                <br>
                {{text02}}
                @endverbatim
                <h1 v-text="text01"></h1>
            </div>

        </div>
</body>
<script src="/js/bootstrap.bundle.min.js"></script>
<script src="/js/jquery-3.6.1.min.js"></script>
<script src="/js/chart.js"></script>
<script src="https://unpkg.com/vue@3/dist/vue.global.js"></script>
<script>
    var ggyy = "{{$member_count->Member_count}}";

    new Chart($("#myChart"), {
        type: 'bar',
        data: {
            labels: ['會員數', '水豚數量', '鴨子數量', '烏龜數量'],
            datasets: [{
                label: '會員數',
                data: [ggyy, 10, 0, 0],
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

    new Chart($("#myPie"), {
        type: 'pie',
        data: {
            labels: ['上架數量', '下架數量'],
            datasets: [{
                label: '數量',
                data: ["{{$goods_up_count->Goods_count}}", "{{$goods_old_count->Goods_count}}"],
                borderWidth: 0.5
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    position: 'top',
                },
                title: {
                    display: true,
                    text: '水果'
                }
            }
        },
    });

    var App = {
        data() {
            return {
                text01: 'test!!!',
                text02: 'test2222'
            }
        }
    };

    Vue.createApp(App).mount('#app');
</script>

</html>