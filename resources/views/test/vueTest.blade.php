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

                            <span v-for="(page, index) in ajaxData" :key="index">
                                <li class="page-item"><a class="page-link" href="#" v-on:click="message_state(index)">{{index+1}}</a></li>
                            </span>

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
                            <img v-bind:src="item.Goods_img" class="card-img-top" style="width: 100%; height: 200px">
                            <div class="card-body">
                                <h5 class="card-title">名稱:{{item.Goods_name}}</h5>
                                <p class="card-text">價錢:{{item.Goods_money}}</p>
                                <p class="card-text">產地:{{item.Goods_area}}</p>
                                <p class="card-text">描述:{{item.Goods_detail}}</p>
                            </div>
                        </div>
                    </div>
                    <h1>{{selectState}}</h1>
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
                goodsData: [],
                selectState: ""
            }
        },
        created() {
            //進入頁面後先撈取全部商品的陣列
            axios.get('/api/goods_list_api').then(response => {

                    //to2dArray是自定義的function能把一維陣列排序成一個二維陣列
                    //to2dArray(要排序的陣列, 一頁有幾個資料)
                    this.ajaxData = to2dArray(response.data, this.page);

                    //this.ajaxData[0]的資料先存進this.listData 讓畫面有資料
                    this.listData = this.ajaxData[0];

                    //console.log(this.ajaxData);
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

                        //to2dArray是自定義的function能把一維陣列排序成一個二維陣列
                        //to2dArray(要排序的陣列, 一頁有幾個資料)
                        this.ajaxData = to2dArray(response.data, this.page);

                        //this.ajaxData[0]的資料先存進this.listData 讓畫面有資料
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
                        console.log(this.goodsData.length);
                        this.goodsData = response.data;

                        if (this.goodsData.length === 0) {
                            console.log(this.goodsData.length);
                            this.selectState = "空空如也!";
                        } else {
                            this.selectState = "";
                        }


                    })
                    .catch(error => {
                        console.error(error);
                        this.selectState = "空空如也!";
                    });
            },

        },
        computed: {

        }
    }

    Vue.createApp(App).mount('#app');

    //把一個陣列轉換(排序)成二維陣列 arr=你要轉換的陣列 size=1頁要幾個
    function to2dArray(arr, size) {

        //宣告一個二維陣列
        var _2dArr = [
            []
        ];

        //把傳進來的arr陣列迴圈全部跑出來一次
        for (i = 0; i < arr.length; i++) {

            //當i取size的餘數=0 且 i不等於0 的時候 在_2dArr增加一個空陣列
            //_2dArr是一個二維陣列 _2dArr[增加這個] [] 
            if (i % size == 0 && i != 0) {
                _2dArr.push([]);
            }

            //把傳進來的data資料丟進_2dArr[][]
            //_2dArr.length-1 解釋 第一個[]會一直增加 -1後才能當陣列的變數
            //size是4的時候 i%size 0%4=0  1%4=1 2%4=2 3%4=3 如下以此類推 
            //_2dArr[0][0] _2dArr[0][1] _2dArr[0][2] _2dArr[0][3]
            //_2dArr[1][0] _2dArr[1][1] _2dArr[1][2] _2dArr[1][3]
            _2dArr[_2dArr.length - 1][i % size] = arr[i];
        }

        return _2dArr;
    }
</script>

</html>