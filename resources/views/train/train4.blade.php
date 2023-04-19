<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>train4</title>
    <link rel="stylesheet" href="/css/bootstrap.min.css">

    <style>

    </style>
</head>

<body>
    @verbatim
    <div id="app">
        <div class="container">

            <!-- 資料填寫區 -->
            <div class="row">
                <div class="col-12  mt-3">
                    <div class="card">
                        <div class="card-body">

                            <div class="row">
                                <div class="col-4">
                                    <label>姓名</label>
                                    <input type="text" class="form-control" v-model="userName">
                                    <div class="form-text">　</div>
                                </div>
                                <div class="col-4">
                                    <label>身份証號</label>
                                    <input type="text" class="form-control" v-model="userIDnumber">
                                    <div class="form-text">　</div>
                                </div>
                                <div class="col-4">
                                    <label>生日</label>
                                    <input type="text" class="form-control" v-model="userBirthday">
                                    <div class="form-text">　</div>
                                </div>
                                <div class="col-4">
                                    <label>電話</label>
                                    <input type="text" class="form-control" v-model="userPhone">
                                    <div class="form-text">　</div>
                                </div>
                                <div class="col-4">
                                    <label>郵遞區號</label>
                                    <input type="text" class="form-control" v-model="userPostalcode">
                                    <div class="form-text">　</div>
                                </div>
                                <div class="col-4">
                                    <label>住址</label>
                                    <input type="text" class="form-control" v-model="userAddress">
                                    <div class="form-text">　</div>
                                </div>

                            </div>

                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckChecked" checked>
                                <label class="form-check-label" for="flexSwitchCheckChecked">身分證驗證開關</label>
                            </div>

                            <div class="text-center mt-3">

                                <button type="button" class="btn btn-dark" id="die">清空</button>
                                <button type="button" class="btn btn-primary" v-on:click="user_C">新增</button>

                            </div>

                        </div>
                    </div>
                </div>
            </div>

            <!-- 資料顯示區 -->
            <div class="row">
                <div class="col-xl-12 mt-3">

                    <table class="table">
                        <thead>
                            <tr>
                                <th>姓名</th>
                                <th>身份証號</th>
                                <th>生日</th>
                                <th>電話</th>
                                <th>郵遞區號</th>
                                <th>住址</th>
                                <th>修改</th>
                                <th>刪除</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="(item ,index) in userArray">
                                <td>{{item.Name}}</td>
                                <td>{{item.IDnumber}}</td>
                                <td>{{item.Birthday}}</td>
                                <td>{{item.Phone}}</td>
                                <td>{{item.Postalcode}}</td>
                                <td>{{item.Address}}</td>
                                <td v-on:click="user_U_modal(item.id)" data-bs-toggle="modal" data-bs-target="#exampleModal">✎</td>
                                <td v-on:click="user_D(item.id)">✖</td>
                            </tr>
                        </tbody>
                    </table>

                </div>
            </div>

        </div>

        <!-- 修改modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">

                    <div class="modal-header">
                        <h1 class="modal-title fs-5">user_U</h1>

                    </div>

                    <div class="modal-body">

                        <label>姓名</label>
                        <input type="text" class="form-control" v-model="updateUserName">
                        <div class="form-text">　</div>

                        <label>身份証號</label>
                        <input type="text" class="form-control" v-model="updateUserIDnumber">
                        <div class="form-text">　</div>

                        <label>生日</label>
                        <input type="text" class="form-control" v-model="updateUserBirthday">
                        <div class="form-text">　</div>

                        <label>電話</label>
                        <input type="text" class="form-control" v-model="updateUserPhone">
                        <div class="form-text">　</div>

                        <label>郵遞區號</label>
                        <input type="text" class="form-control" v-model="updateUserPostalcode">
                        <div class="form-text">　</div>

                        <label>住址</label>
                        <input type="text" class="form-control" v-model="updateUserAddress">
                        <div class="form-text">　</div>

                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" id="modalclear">取消</button>
                        <button type="button" class="btn btn-primary" v-on:click="user_U">確認修改</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endverbatim
</body>
<script src="/js/bootstrap.bundle.min.js"></script>
<script src="/js/vue.global.js"></script>
<script src="/js/axios.min.js"></script>
<script>
    var app = {
        data() {
            return {
                userArray: [],
                //新增用
                userName: "",
                userIDnumber: "",
                userBirthday: "",
                userPhone: "",
                userPostalcode: "",
                userAddress: "",
                //修改用
                updateUserID: "",
                updateUserName: "",
                updateUserIDnumber: "",
                updateUserBirthday: "",
                updateUserPhone: "",
                updateUserPostalcode: "",
                updateUserAddress: "",
            }
        },
        created() {
            //進入頁面後先撈user的陣列
            axios.get('/train4_R').then(response => {
                    // console.log(response.data);
                    this.userArray = response.data;
                })
                .catch(error => {
                    console.error(error);
                });
        },
        methods: {

            //新增user
            user_C() {
                axios.post('/train4_C', {
                    name: this.userName,
                    idnumber: this.userIDnumber,
                    birthday: this.userBirthday,
                    phone: this.userPhone,
                    postalcode: this.userPostalcode,
                    address: this.userAddress,
                }).then(response => {
                    window.location.reload();
                }).catch(error => {
                    console.error(error);
                    console.log(this.userName);
                });
            },

            //點鉛筆的時候用id查詢把值帶入input
            user_U_modal(id) {

                axios.post('/train4_R_one', {
                    userID: id
                }).then(response => {
                    this.updateUserID = response.data[0].id;
                    this.updateUserName = response.data[0].Name;
                    this.updateUserIDnumber = response.data[0].IDnumber;
                    this.updateUserBirthday = response.data[0].Birthday;
                    this.updateUserPhone = response.data[0].Phone;
                    this.updateUserPostalcode = response.data[0].Postalcode;
                    this.updateUserAddress = response.data[0].Address;
                });
            },

            //modal內的確認修改
            user_U() {
                axios.post('/train4_U', {
                    userID: this.updateUserID,
                    name: this.updateUserName,
                    idnumber: this.updateUserIDnumber,
                    birthday: this.updateUserBirthday,
                    phone: this.updateUserPhone,
                    postalcode: this.updateUserPostalcode,
                    address: this.updateUserAddress,
                }).then(response => {
                    window.location.reload();
                });
            },

            //刪除
            user_D(id) {
                console.log(id);
                axios.post('/train4_D', {
                    userID: id
                }).then(response => {
                    window.location.reload();
                });
            }

        }
    }

    Vue.createApp(app).mount('#app');
</script>

</html>