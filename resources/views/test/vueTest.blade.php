<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>vueTest</title>
    <link rel="stylesheet" href="/css/bootstrap.min.css">

    <style>

    </style>
</head>

<body>
    @verbatim
    <div id="app">
        <div class="container">

            <div class="row">

                <!-- 選擇每頁數量 -->
                <div class="col-12 mt-3">

                    <h1>每頁數量</h1>

                    <nav aria-label="Page navigation example">
                        <ul class="pagination">

                            <li class="page-item"><a class="page-link" href="#" v-on:click="pageUpdate(1)">1</a></li>
                            <li class="page-item"><a class="page-link" href="#" v-on:click="pageUpdate(2)">2</a></li>
                            <li class="page-item"><a class="page-link" href="#" v-on:click="pageUpdate(3)">3</a></li>
                            <li class="page-item"><a class="page-link" href="#" v-on:click="pageUpdate(4)">4</a></li>

                        </ul>
                    </nav>
                </div>

                <!-- 顯示商品 -->
                <div class="col-md-3 mt-3 h-100" v-for="item in listData" :key="item">

                    <div class="card" style="width: 18rem;">
                        <img v-bind:src="item.Goods_imges" class="card-img-top" style="width: 100%; height: 200px">
                        <div class="card-body">
                            <h5 class="card-title">名稱:{{item.Goods_name}}</h5>
                            <p class="card-text">價錢:{{item.Goods_money}}</p>
                            <p class="card-text">產地:{{item.Goods_area}}</p>
                            <p class="card-text">描述:{{item.Goods_detail}}</p>
                        </div>
                    </div>

                </div>

                <!-- 換頁 -->
                <div class="col-12 mt-3">

                    <nav aria-label="Page navigation example">
                        <ul class="pagination justify-content-center">
                            <li class="page-item"><a class="page-link" href="#">Previous</a></li>

                            <span v-for="(page, index) in ajaxData" :key="index">
                                <li class="page-item"><a class="page-link" href="#" v-on:click="message_state(index)">{{index+1}}</a></li>
                            </span>

                            <li class="page-item"><a class="page-link" href="#">Next</a></li>
                        </ul>
                    </nav>

                </div>

                <!-- 新增帳號 -->
                <div class="col-6 mt-3">
                    <input type="text" class="form-control" placeholder="帳號" v-model="userName">
                    <input type="text" class="form-control" placeholder="密碼" v-model="userPw">

                    <button type="button" class="btn btn-success" v-on:click="addUser()">新增帳號</button>
                </div>

                <!-- 查詢商品 -->
                <div class="col-6 mt-3">
                    <h1>查詢商品id</h1>
                    <input type="text" class="form-control" placeholder="密碼" v-model="goodsId">

                    <button type="button" class="btn btn-success" v-on:click="selectGoods()">查詢</button>

                    <div class="col-md-12 mt-3 h-100" v-for="item in goodsData" :key="item">

                        <div class="card" style="width: 18rem;">
                            <img v-bind:src="item.Goods_imges" class="card-img-top" style="width: 100%; height: 200px">
                            <div class="card-body">
                                <h5 class="card-title">名稱:{{item.Goods_name}}</h5>
                                <p class="card-text">價錢:{{item.Goods_money}}</p>
                                <p class="card-text">產地:{{item.Goods_area}}</p>
                                <p class="card-text">描述:{{item.Goods_detail}}</p>
                            </div>
                        </div>
                    </div>
                </div>


            </div>

        </div>
    </div>
    @endverbatim
</body>
<script src="/js/bootstrap.bundle.min.js"></script>
<script src="/js/jquery-3.6.1.min.js"></script>
<script src="/js/vue.global.js"></script>
<script src="/js/axios.min.js"></script>
<script>
    var App = {
        data() {
            return {
                page: 4,
                userName: "",
                userPw: "",
                goodsId: "",
                ajaxData: [
                    []
                ],
                listData: [],
                goodsData: []
            }
        },
        created() {
            axios.get('/api/goods_list_api')
                .then(response => {
                    // console.log(response.data);

                    //把傳進來的data迴圈全部跑出來一次
                    for (i = 0; i < response.data.length; i++) {

                        //當i取this.page的餘數=0的 且 i不等於0 的時候 在ajaxData增加一個空陣列
                        //ajaxData是一個二維陣列 ajaxData[增加這個] [] 
                        if (i % this.page == 0 && i != 0) {
                            this.ajaxData.push([]);
                        }

                        //把傳進來的data資料丟進ajaxData[][]
                        //this.ajaxData.length-1 解釋 第一個[]會一直增加 -1後才能當陣列的變數
                        //this.page是4的時候 i%this.page 0%4=0  1%4=1 2%4=2 3%4=3 如下以此類推 
                        //ajaxData[0][0] ajaxData[0][1] ajaxData[0][2] ajaxData[0][3]
                        //ajaxData[1][0] ajaxData[1][1] ajaxData[1][2] ajaxData[1][3]
                        this.ajaxData[this.ajaxData.length - 1][i % this.page] = response.data[i];
                    }

                    //this.ajaxData[0]的資料先存進this.listData 讓畫面有資料
                    this.listData = this.ajaxData[0];
                })
                .catch(error => {
                    console.error(error);
                });


        },
        methods: {
            //跳到第幾個頁數的方法
            message_state(page) {
                this.listData = this.ajaxData[page];
            },

            //新增user的方法
            addUser() {
                axios.post('/test1', {
                    member_email: this.userName,
                    member_password: this.userPw
                }).then(response => {
                    console.log(response.data);
                });
            },

            //修改一頁顯示幾個商品的方法
            pageUpdate(member) {
                this.page = member;

                axios.get('/api/goods_list_api')
                    .then(response => {

                        this.ajaxData = [
                            []
                        ];
                        this.listData = [];

                        for (i = 0; i < response.data.length; i++) {

                            if (i % this.page == 0 && i != 0) {
                                this.ajaxData.push([]);
                            }
                            this.ajaxData[this.ajaxData.length - 1][i % this.page] = response.data[i];
                        }
                        this.listData = this.ajaxData[0];
                    })
                    .catch(error => {
                        console.error(error);
                    });
            },

            //用商品id查詢商品的方法
            selectGoods() {

                axios.post('/test2', {
                        goods_id: this.goodsId
                    }).then(response => {
                        // console.log(response.data);
                        this.goodsData = response.data;
                    })
                    .catch(error => {
                        console.error(error);
                    });
            }

        },
        computed: {

        }
    }

    Vue.createApp(App).mount('#app');
</script>

</html>