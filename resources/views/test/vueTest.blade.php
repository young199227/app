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
                <div class="col-8 offset-2">
                {{text01}}
                <br>
                <input type="text" v-model="text01">
                </div>
                <div class="col-8 offset-2">
                <h1 v-if="showMessage">訊息!</h1>
                <button class="btn button-green" v-on:click="message_state">123</button>
                </div>
            </div>
        </div>
    </div>
    @endverbatim
</body>
<script src="/js/bootstrap.bundle.min.js"></script>
<script src="/js/jquery-3.6.1.min.js"></script>
<script src="/js/vue.global.js"></script>
<script>
    var App = {
        data() {
            return {
                text01: '123456',
                showMessage:false,
            }
        },
        methods: {
            message_state(){
                this.showMessage = !this.showMessage;
            }

        },
        computed: {

        }
    }

    Vue.createApp(App).mount('#app');
</script>

</html>