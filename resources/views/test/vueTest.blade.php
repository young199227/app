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

                <div class="col-12 mt-3" >

                    <nav aria-label="Page navigation example" >
                        <ul class="pagination justify-content-center">
                            <li class="page-item"><a class="page-link" href="#" >Previous</a></li>

                            <span v-for="(page, index) in ajaxData" :key="index">
                            <li class="page-item"><a class="page-link" href="#" v-on:click="message_state(index)">{{index+1}}</a></li>
                            </span>

                            <li class="page-item"><a class="page-link" href="#">Next</a></li>
                        </ul>
                    </nav>

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
                ajaxData: [
                    []
                ],
                listData: []
            }
        },
        created() {
            axios.get('/api/goods_list_api')
                .then(response => {
                    console.log(response.data);
                    // this.ajaxData[0] = response.data;

                    for (i = 0; i < response.data.length; i++) {

                        if (i % 4 == 0 && i != 0) {
                            this.ajaxData.push([]);
                        }

                        this.ajaxData[this.ajaxData.length - 1][i % 4] = response.data[i];
                    }
                    this.listData = this.ajaxData[0];
                })
                .catch(error => {
                    console.error(error);
                });
        },
        methods: {
            message_state(page) {
                this.listData = this.ajaxData[page];
            }

        },
        computed: {

        }
    }

    Vue.createApp(App).mount('#app');
</script>

</html>