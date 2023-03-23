<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="/css/bootstrap.min.css">

    <style>
        .completed {
            text-decoration: line-through;
            color: red;
        }
    </style>
</head>

<body>
    @verbatim
    <div id="app">
        <div class="container">
            <div class="row">
                <div class="col-8 offset-2">

                    <div class="input-group mb-3 mt-3">
                        <span class="input-group-text">$</span>
                        <input type="text" class="form-control" aria-label="Amount (to the nearest dollar)" v-model="newTodo" placeholder="請輸入代辦事項" v-on:keyup.enter="addTodo">
                        <button class="btn btn-outline-secondary" type="button" id="button-addon2" v-on:click="addTodo">Button</button>
                    </div>

                    <div class="card">
                        <div class="card-header">
                            <ul class="nav nav-tabs">
                                <li class="nav-item" v-on:click="visibility='all'">
                                    <a class="nav-link" v-bind:class="{'active':visibility=='all'}" href="#">全部</a>
                                </li>
                                <li class="nav-item" v-on:click="visibility='active'">
                                    <a class="nav-link" v-bind:class="{'active':visibility=='active'}" href="#">進行中</a>
                                </li>
                                <li class="nav-item" v-on:click="visibility='comleted'">
                                    <a class="nav-link" v-bind:class="{'active':visibility=='comleted'}" href="#">已完成</a>
                                </li>
                            </ul>
                        </div>

                        <div class="card-body">
                            <ul class="list-group">
                                <li class="list-group-item" v-for="(item, index) in filterTodo" v-bind:key="index">

                                    <div class="d-flex" v-if="cacheItem.id != item.id">

                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value="" v-bind:id="index" v-model="item.completed">
                                            <label class="form-check-label" v-bind:class="{'completed': item.completed}" v-bind:for="index" v-on:dblclick="editItem(item)">
                                                {{item.title}}
                                            </label>
                                        </div>
                                        <span class="ms-auto" v-on:click="editItem(item)">✎</span>
                                        <button type="button" class="btn-close ms-auto" aria-label="Close" v-on:click="removeTode(item)"></button>

                                    </div>

                                    <input type="text" class="form-control" v-if="cacheItem.id == item.id" v-model="cacheTitle" v-on:keyup.enter="doneTode(item)" v-on:keyup.esc="ggyy(item)">

                                    <div class="fs-5" v-if="cacheItem2.id != item.id">{{item.ggyygy}}
                                        <span class="ms-auto" v-on:click="editItem2(item)">✎</span>
                                    </div>

                                    <input type="text" class="form-control" v-if="cacheItem2.id == item.id" v-model="cacheTitle2" v-on:keyup.enter="doneTode2(item)" v-on:keyup.esc="ggyy2(item)">

                                </li>

                            </ul>
                        </div>

                        <div class="card-footer">
                            <div class="d-flex">
                                <div class="fs-6 me-auto">還有{{countActive}}筆未完成</div>
                                <a href="#" v-on:click="destory">清除所有任務</a>
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
<script>
    var App = {
        data() {
            return {
                text01: '123456',
                newTodo: '',
                visibility: 'all', //all;全部 active:進行中 ,  comleted:
                cacheTitle: '',
                cacheItem: [],
                cacheTitle2: '',
                cacheItem2: [],
                todos: [{
                        id: '001',
                        title: '訂午餐',
                        ggyygy: '代辦事項的詳細內容',
                        completed: false
                    },
                    {
                        id: '002',
                        title: '訂飲料',
                        ggyygy: '代辦事項的詳細內容',
                        completed: false
                    }
                ]

            }
        },
        methods: {
            addTodo() {

                var vm = this;
                var timestamp = Date.now();
                var newTitle = vm.newTodo.trim();

                if (newTitle != "") {

                    vm.todos.push({
                        id: timestamp,
                        title: newTitle,
                        ggyygy: '代辦事項的詳細內容',
                        completed: false
                    });

                    vm.newTodo = '';
                }
            },
            removeTode(todo) {

                console.log(todo);

                var vm = this;
                var newIndex = vm.todos.findIndex((item, index) => {
                    return todo.id == item.id
                });

                vm.todos.splice(newIndex, 1);
            },
            editItem(todo) {
                var vm = this;
                vm.cacheTitle = todo.title;
                vm.cacheItem = todo;
            },
            doneTode(todo) {
                var vm = this;
                todo.title = vm.cacheTitle;
                vm.cacheTitle = '';
                vm.cacheItem = '';
            },
            ggyy(todo) {
                var vm = this;
                vm.cacheTitle = '';
                vm.cacheItem = '';
            },
            destory() {
                this.todos = [];
            },

            editItem2(todo) {
                var vm = this;
                vm.cacheTitle2 = todo.ggyygy;
                vm.cacheItem2 = todo;
            },
            doneTode2(todo) {
                var vm = this;
                todo.ggyygy = vm.cacheTitle2;
                vm.cacheTitle2 = '';
                vm.cacheItem2 = '';
            },
            ggyy2(todo) {
                var vm = this;
                vm.cacheTitle2 = '';
                vm.cacheItem2 = '';
            },


        },
        computed: {
            filterTodo() {
                var vm = this;

                if (vm.visibility == 'all') {

                    return vm.todos;

                }

                if (vm.visibility == 'active') {

                    var activeTodo = [];
                    vm.todos.forEach((item, key) => {
                        if (!item.completed) {
                            activeTodo.push(item);
                        }
                    });

                    return activeTodo;

                }

                if (vm.visibility == 'comleted') {

                    var activeTodo = [];
                    vm.todos.forEach((item, key) => {
                        if (item.completed) {
                            activeTodo.push(item);
                        }
                    });

                    return activeTodo;
                }
            },
            countActive() {
                var vm = this;
                var active = 0;
                vm.todos.forEach(function(item, key) {

                    if (!item.completed) {
                        active++;
                    }
                });
                return active;
            }
        }
    }

    Vue.createApp(App).mount('#app');
</script>

</html>