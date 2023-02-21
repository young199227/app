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


            <!-- <div class="row mt-3">

                <div class="col-md-6">
                    <canvas id="myChart"></canvas>
                </div>
                <div class="col-md-6">
                    <canvas id="myPie"></canvas>
                </div>

            </div> -->

            <div id="app" class="container">
                @verbatim
                <div class="row">

                    <div class="col-8 offset-2">
                        <div class="card mt-4">
                            <div class="card-body">
                                <div class="fs-3">1.綁定v-model</div>
                                <input type="text" class="from-control" v-model="test01">
                                <h1>{{test01}}</h1>
                                <div v-text="test03"></div>
                                <div v-html="test03"></div>
                            </div>
                        </div>
                    </div>

                    <div class="col-8 offset-2">
                        <div class="card mt-4">
                            <div class="card-body">
                                <div class="fs-3">2.綁定v-bind</div>
                                <img v-bind:src="imgGG" alt="" class="w-25">
                            </div>
                        </div>
                    </div>

                    <div class="col-8 offset-2">
                        <div class="card mt-4">
                            <div class="card-body">
                                <div class="fs-3">3.v-if and v-for</div>

                                <ul class="list-group">
                                    <li class="list-group-item" v-for="(item,index) in listData" v-bind:key="item.id">
                                        {{index}} - {{item.goods}} -{{item.price}}元
                                    </li>
                                </ul>

                                <ul class="list-group mt-3">
                                    <template v-for="(item,index) in listData" v-bind:key="item.id">
                                        <li class="list-group-item" v-if="item.price > 60">
                                            {{index}} - {{item.goods}} -{{item.price}}元
                                        </li>
                                    </template>
                                </ul>

                            </div>
                        </div>
                    </div>

                    <div class="col-8 offset-2">
                        <div class="card mt-4">
                            <div class="card-body">
                                <div class="fs-3">4.v-on</div>
                                <button class="btn btn-primary" v-on:click="test01Fun">監聽</button>

                                <div class="fs-3">tabd選單</div>
                                <ul class="nav nav-tabs">
                                    <li class="nav-item">
                                        <a class="nav-link" v-on:click="mylink='蘋果'" v-bind:class="{'active':mylink=='蘋果'}">蘋果</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" v-on:click="mylink='香蕉'" v-bind:class="{'active':mylink=='香蕉'}">香蕉</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link">Link</a>
                                    </li>
                                </ul>

                                <div class="fs-2">反轉文字</div>
                                <input type="text" class="form-control" v-model="newText">
                                <button class="btn btn-primary" v-on:click="reverseText">反轉</button>

                                <div class="fs-2">BMI計算</div>
                                <input type="number" class="form-control" v-model="bmiCm" placeholder="身高(cm)">
                                <input type="number" class="form-control" v-model="bmiKg" placeholder="體重(kg)">
                                
                                <button class="btn btn-primary" v-on:click="bmi">計算</button>
                                <h1 v-bind:class="{'text-danger': BMI>30 , 'text-success':BMI<30}">BMI:{{BMI}}</h1>


                            </div>
                        </div>
                    </div>

                </div>
                @endverbatim
            </div>

        </div>
</body>
<script src="/js/bootstrap.bundle.min.js"></script>
<script src="/js/jquery-3.6.1.min.js"></script>
<script src="/js/chart.js"></script>
<script src="/js/vue.global.js"></script>
<script>

    const App = {
        data() {
            return {
                test01: '測試用',
                test02: '123',
                test03: '<h1>321</h1>',
                imgGG: '/img/GIF/01.gif',
                mylink: '蘋果',
                newText: '',
                bmiKg:'',
                bmiCm:'',
                BMI: '',
                listData: [{
                        id: '01',
                        goods: '蘋果',
                        price: 50
                    },
                    {
                        id: '02',
                        goods: '草莓',
                        price: 500
                    },
                    {
                        id: '03',
                        goods: '香蕉',
                        price: 5
                    }
                ]
            }
        },
        methods: {
            test01Fun() {
                console.log(123);
            },
            reverseText() {
                this.newText = this.newText.split("").reverse().join("");
            },
            bmi(){
                this.BMI = this.bmiKg/((this.bmiCm/100)*2);
                this.BMI = this.BMI.toFixed(2);
            }
        },
    }

    Vue.createApp(App).mount('#app');

    // new Chart($("#myChart"), {
    //     type: 'bar',
    //     data: {
    //         labels: ['會員數', '水豚數量', '鴨子數量', '烏龜數量'],
    //         datasets: [{
    //             label: '會員數',
    //             data: [ggyy, 10, 0, 0],
    //             borderWidth: 0.5
    //         }]
    //     },
    //     options: {
    //         scales: {
    //             y: {
    //                 beginAtZero: true
    //             }
    //         }
    //     }
    // });

    // new Chart($("#myPie"), {
    //     type: 'pie',
    //     data: {
    //         labels: ['上架數量', '下架數量'],
    //         datasets: [{
    //             label: '數量',
    //             data: ["{{$goods_up_count->Goods_count}}", "{{$goods_old_count->Goods_count}}"],
    //             borderWidth: 0.5
    //         }]
    //     },
    //     options: {
    //         responsive: true,
    //         plugins: {
    //             legend: {
    //                 position: 'top',
    //             },
    //             title: {
    //                 display: true,
    //                 text: '水果'
    //             }
    //         }
    //     },
    // });
</script>

</html>