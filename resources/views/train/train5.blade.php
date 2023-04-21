<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>train5</title>
    <link rel="stylesheet" href="/css/bootstrap.min.css">
    <script src="/js/vue.global.js"></script>
    <script src="/js/bootstrap.bundle.min.js"></script>
    <script src="/js/axios.min.js"></script>
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
                                    <div class="form-text" style="color: red;">{{userNameErr}}</div>
                                </div>
                                <div class="col-4">
                                    <label>身份証號</label>
                                    <input type="text" class="form-control" v-model="userIDnumber">
                                    <div class="form-text" style="color: red;">{{userIDnumberErr}}</div>
                                </div>
                                <div class="col-4">
                                    <label>生日</label>
                                    <input type="date" class="form-control" v-model="userBirthday">
                                    <div class="form-text" style="color: red;">{{userBirthdayErr}}</div>
                                </div>
                                <div class="col-4">
                                    <label>電話</label>
                                    <input type="text" class="form-control" v-model="userPhone">
                                    <div class="form-text" style="color: red;">{{userPhoneErr}}</div>
                                </div>
                                <div class="col-4">
                                    <label>郵遞區號</label>
                                    <input type="text" class="form-control" v-model="userPostalcode">
                                    <div class="form-text" style="color: red;">{{userPostalcodeErr}}</div>
                                </div>
                                <div class="col-4">
                                    <label>住址</label>
                                    <input type="text" class="form-control" v-model="userAddress">
                                    <div class="form-text" style="color: red;">{{userAddressErr}}</div>
                                </div>

                            </div>

                            <div class="text-center mt-3">
                                <div class="form-check form-switch d-inline-block">
                                    <input class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckChecked" v-model="userIDnumberCheck">
                                    <label class="form-check-label" for="flexSwitchCheckChecked">身分證重複驗證開關</label>
                                </div>
                            </div>

                            <div class="text-center mt-3">
                                <button type="button" class="btn btn-dark mx-3" v-on:click="user_clear">清空</button>
                                <button type="button" class="btn btn-primary" v-on:click="user_C">新增</button>
                            </div>

                        </div>
                    </div>
                </div>
            </div>

            <!-- 資料顯示區 -->
            <div class="row">
                <div class="col-xl-12 mt-4">

                    <table class="table table-striped table-hover text-center">
                        <thead class="table-dark">
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
                        <div class="form-text" style="color: red;">{{errUpdateUserName}}</div>

                        <label>身份証號</label>
                        <input type="text" class="form-control" v-model="updateUserIDnumber">
                        <div class="form-text" style="color: red;">{{errUpdateUserIDnumber}}</div>

                        <label>生日</label>
                        <input type="date" class="form-control" v-model="updateUserBirthday">
                        <div class="form-text" style="color: red;">{{errUpdateUserBirthday}}</div>

                        <label>電話</label>
                        <input type="text" class="form-control" v-model="updateUserPhone">
                        <div class="form-text" style="color: red;">{{errUpdateUserPhone}}</div>

                        <label>郵遞區號</label>
                        <input type="text" class="form-control" v-model="updateUserPostalcode">
                        <div class="form-text" style="color: red;">{{errUpdateUserPostalcode}}</div>

                        <label>住址</label>
                        <input type="text" class="form-control" v-model="updateUserAddress">
                        <div class="form-text" style="color: red;">{{errUpdateUserAddress}}</div>

                    </div>

                    <div class="text-center">
                        <div class="form-check form-switch d-inline-block">
                            <input class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckChecked" v-model="userIDnumberCheck">
                            <label class="form-check-label" for="flexSwitchCheckChecked">身分證重複驗證開關</label>
                        </div>
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
<script>
    var app = {
        data() {
            return {
                //user的資料
                userArray: [],
                //新增用
                userName: "",
                userIDnumber: "",
                userBirthday: "",
                userPhone: "",
                userPostalcode: "",
                userAddress: "",
                //驗證錯誤訊息_新增用
                userNameErr: "",
                userIDnumberErr: "",
                userBirthdayErr: "",
                userPhoneErr: "",
                userPostalcodeErr: "",
                userAddressErr: "",
                //檢查身分證是否重複變數 預設false
                userIDnumberCheck: false,
                //修改用
                updateUserID: "",
                updateUserName: "",
                updateUserIDnumber: "",
                updateUserBirthday: "",
                updateUserPhone: "",
                updateUserPostalcode: "",
                updateUserAddress: "",
                //驗證錯誤訊息_修改用
                errUpdateUserName: "",
                errUpdateUserIDnumber: "",
                errUpdateUserBirthday: "",
                errUpdateUserPhone: "",
                errUpdateUserPostalcode: "",
                errUpdateUserAddress: "",
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

                //新增前先驗證
                const userNameRegex = /^[a-zA-Z0-9]{3,10}$/;
                const userIDnumberRegex = /^[A-Z0-9]{2,10}$/;
                const userPhoneRegex = /^[0-9]{2,10}$/;

                if (!userNameRegex.test(this.userName)) {
                    this.userNameErr = "使用者名稱不符合要求，3~10字";
                } else {
                    this.userNameErr = "";
                }

                if (!userIDnumberRegex.test(this.userIDnumber)) {
                    this.userIDnumberErr = "身份証號不符合要求，2~10字";
                } else {
                    this.userIDnumberErr = "";
                }

                if (this.userBirthday === "") {
                    this.userBirthdayErr = "請填選生日";
                } else {
                    this.userBirthdayErr = "";
                }

                if (!userPhoneRegex.test(this.userPhone)) {
                    this.userPhoneErr = "電話不符合要求，2~10數字";
                } else {
                    this.userPhoneErr = "";
                }

                if (this.userPostalcode === "") {
                    this.userPostalcodeErr = "請填郵遞區號";
                } else {
                    this.userPostalcodeErr = "";
                }

                if (this.userAddress === "") {
                    this.userAddressErr = "請填住址";
                } else {
                    this.userAddressErr = "";
                }

                //如果有一項條件沒過就return
                if (
                    !userNameRegex.test(this.userName) ||
                    !userIDnumberRegex.test(this.userIDnumber) ||
                    this.userBirthday === "" ||
                    !userPhoneRegex.test(this.userPhone) ||
                    this.userPostalcode === "" ||
                    this.userAddress === ""
                ) {
                    return;
                }

                axios.post('/train4_C', {
                    name: this.userName,
                    idnumber: this.userIDnumber,
                    birthday: this.userBirthday,
                    phone: this.userPhone,
                    postalcode: this.userPostalcode,
                    address: this.userAddress,
                    idnumberCheck: this.userIDnumberCheck,
                }).then(response => {

                    //新增成功刷新頁面
                    if (response.data.state) {
                        window.location.reload();
                    }

                    //失敗
                    if (!response.data.state) {
                        console.log(response.data);
                        alert(response.data.message);
                    }

                }).catch(error => {
                    console.error(error);
                });
            },

            //點鉛筆的時候用id查詢把值帶入input
            user_U_modal(id) {

                //進入model時把err清空
                this.errUpdateUserName = "";
                this.errUpdateUserIDnumber = "";
                this.errUpdateUserBirthday = "";
                this.errUpdateUserPhone = "";
                this.errUpdateUserPostalcode = "";
                this.errUpdateUserAddress = "";

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

                //修改前先驗證
                const userNameRegex = /^[a-zA-Z0-9]{3,10}$/;
                const userIDnumberRegex = /^[A-Z0-9]{2,10}$/;
                const userPhoneRegex = /^[0-9]{2,10}$/;

                if (!userNameRegex.test(this.updateUserName)) {
                    this.errUpdateUserName = "使用者名稱不符合要求，3~10字";
                } else {
                    this.errUpdateUserName = "";
                }

                if (!userIDnumberRegex.test(this.updateUserIDnumber)) {
                    this.errUpdateUserIDnumber = "身份証號不符合要求，2~10字";
                } else {
                    this.errUpdateUserIDnumber = "";
                }

                if (this.updateUserBirthday === "") {
                    this.errUpdateUserBirthday = "請填選生日";
                } else {
                    this.errUpdateUserBirthday = "";
                }

                if (!userPhoneRegex.test(this.updateUserPhone)) {
                    this.errUpdateUserPhone = "電話不符合要求，2~10數字";
                } else {
                    this.errUpdateUserPhone = "";
                }

                if (this.updateUserPostalcode === "") {
                    this.errUpdateUserPostalcode = "請填郵遞區號";
                } else {
                    this.errUpdateUserPostalcode = "";
                }

                if (this.updateUserAddress === "") {
                    this.errUpdateUserAddress = "請填住址";
                } else {
                    this.errUpdateUserAddress = "";
                }

                //如果有一項條件沒過就return
                if (
                    !userNameRegex.test(this.updateUserName) ||
                    !userIDnumberRegex.test(this.updateUserIDnumber) ||
                    this.updateUserBirthday === "" ||
                    !userPhoneRegex.test(this.updateUserPhone) ||
                    this.updateUserPostalcode === "" ||
                    this.updateUserAddress === ""
                ) {
                    return;
                }

                axios.post('/train4_U', {
                    userID: this.updateUserID,
                    name: this.updateUserName,
                    idnumber: this.updateUserIDnumber,
                    birthday: this.updateUserBirthday,
                    phone: this.updateUserPhone,
                    postalcode: this.updateUserPostalcode,
                    address: this.updateUserAddress,
                    idnumberCheck: this.userIDnumberCheck
                }).then(response => {

                    //修改成功刷新頁面
                    if (response.data.state) {
                        window.location.reload();
                    }

                    //失敗
                    if (!response.data.state) {
                        console.log(response.data);
                        alert(response.data.message);
                    }
                });
            },

            //刪除
            user_D(id) {

                axios.post('/train4_D', {
                    userID: id
                }).then(response => {
                    window.location.reload();
                });
            },

            //清除
            user_clear() {
                //輸入框跟err清空
                this.userName = "";
                this.userIDnumber = "";
                this.userBirthday = "";
                this.userPhone = "";
                this.userPostalcode = "";
                this.userAddress = "";
                this.userNameErr = "";
                this.userIDnumberErr = "";
                this.userBirthdayErr = "";
                this.userPhoneErr = "";
                this.userPostalcodeErr = "";
                this.userAddressErr = "";            
            },

        }
    }

    Vue.createApp(app).mount('#app');
</script>

</html>