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

                <div class="col-3" v-for="item in ajaxData" :key="item.id">

                    <div class="card" style="width: 18rem;">
                        <!-- <img src="..." class="card-img-top" alt="..."> -->
                        <div class="card-body">
                            <h5 class="card-title">{{item.Goods_name}}</h5>
                            <p class="card-text"></p>
                            <a href="#" class="btn btn-primary"></a>
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
                text01: '123456',
                showMessage: true,
                ajaxData: null
            }
        },
        created() {
            axios.get('/api/goods_list_api')
                .then(response => {
                    this.ajaxData = response.data;
                })
                .catch(error => {
                    console.error(error);
                });
        },
        methods: {
            message_state() {
                this.showMessage = !this.showMessage;
                this.text01 = "不是";
            }

        },
        computed: {

        }
    }

    Vue.createApp(App).mount('#app');
</script>

</html>