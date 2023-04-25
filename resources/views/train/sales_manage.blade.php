<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="/css/bootstrap.min.css">
    <script src="https://cdn.staticfile.org/angular.js/1.4.6/angular.min.js"></script>
    <script src="/js/bootstrap.bundle.min.js"></script>
    <script src="/js/axios.min.js"></script>
</head>
@verbatim

<body ng-app="myApp">

    <div class="container" ng-controller="myCtrl">
        <!-- 登出 -->
        <div class="row mt-3 justify-content-end">
            <div class="col-1">
                <h5>hi~{{salesName}}</h5>
                <button type="button" class="btn btn-danger" ng-click="logout()">登出</button>
            </div>
        </div>
        <!-- 新增商家&商家列表 -->
        <div class="row mt-4">

            <div class="col-4">

                <div class="mb-3">
                    <label for="ex1" class="form-label">商家帳號</label>
                    <input type="text" id="ex2" class="form-control" ng-model="new_StoreName">
                    <div class="form-text">{{err_StoreName}}</div>
                </div>
                <div class="mb-3">
                    <label for="ex2" class="form-label">密碼</label>
                    <input type="password" id="ex2" class="form-control" ng-model="new_StorePw">
                    <div class="form-text">{{err_StorePw}}</div>
                </div>

                <button type="submit" class="btn btn-primary" ng-click="new_store()">新增商家</button>

            </div>
            <div class="col-8">

                <table class="table text-center">
                    <thead class="table-success">
                        <tr>
                            <th>編號</th>
                            <th>所屬業務</th>
                            <th>商家名稱</th>
                            <th>密碼</th>
                            <th>創建時間</th>
                            <th>狀態</th>
                        </tr>
                    </thead>
                    <tbody class="table-striped">
                        <tr ng-repeat="items in stores">
                            <td>{{items.StoreId}}</td>
                            <td>{{items.SalesId}}</td>
                            <td>{{items.StoreName}}</td>
                            <td>{{items.StorePw}}</td>
                            <td>{{items.CreatedTime}}</td>
                            <td>

                                <select class="form-select" aria-label="Default select example" ng-change="store_state_U(items.StoreId,store_state)" ng-model="store_state">
                                    <option selected ng-if="items.StoreState===0">開通</option>
                                    <option selected ng-if="items.StoreState===1">停權</option>
                                    <option selected ng-if="items.StoreState===2">刪除</option>
                                    <option value="0">開通</option>
                                    <option value="1">停權</option>
                                    <option value="2">刪除</option>
                                </select>

                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <div class="row mt-2">
            <div class="col-12">

                <h1 class="">{{salesName}}的業績</h1>
                <table class="table text-center mt-3">
                    <thead class="table-danger">
                        <tr>
                            <th>總銷售金額</th>
                            <th>獎金</th>
                        </tr>
                    </thead>
                    <tbody class="table-striped">
                        <tr>
                            <td>{{totalMoney}}</td>
                            <td>{{salesMoney}}</td>
                        </tr>
                    </tbody>
                </table>
                
                <h1>銷售詳細</h1>
                <table class="table text-center mt-3">
                    <thead class="table-info">
                        <tr>
                            <th>店家編號</th>
                            <th>產品編號</th>
                            <th>產品名稱</th>
                            <th>價錢</th>
                            <th>數量</th>
                            <th>總價</th>
                            <th>訂單時間</th>
                        </tr>
                    </thead>
                    <tbody class="table-striped">
                        <tr ng-repeat="items in orders">
                            <td>{{items.SalesId}}</td>
                            <td>{{items.ItemsId}}</td>
                            <td>{{items.ItemsName}}</td>
                            <td>{{items.ItemsPrice}}</td>
                            <td>{{items.ItemsQuantity}}</td>
                            <td>{{items.ItemsTotalMoney}}</td>
                            <td>{{items.CreatedTime}}</td>
                        </tr>
                    </tbody>
                </table>

            </div>
        </div>
    </div>

</body>
@endverbatim
<script>
    var app = angular.module('myApp', []);

    app.controller('myCtrl', function($scope) {

        //新增商家的input
        $scope.new_StoreName = "";
        $scope.new_StorePw = "";
        //新增商家的err
        $scope.err_StoreName = "";
        $scope.err_StorePw = "";

        //商家狀態的變數
        $scope.store_state = "";


        //登入後 用後端的session直接撈取值
        //店家資料
        $scope.stores = [];
        //銷售情況
        $scope.orders = [];
        //總金額
        $scope.totalMoney = "";
        //業務分紅
        $scope.salesMoney = "";
        //業務名稱
        $scope.salesName = "";


        axios.post('/sales_store_R', {

        }).then(response => {

            $scope.stores = response.data.data;
            $scope.orders = response.data.orders;
            $scope.totalMoney = response.data.totalMoney;
            $scope.salesMoney = response.data.salesMoney;
            $scope.salesName = response.data.salesName;
            console.log(response.data);
            $scope.$apply();

        });

        //業務登出
        $scope.logout = function() {

            axios.post('/sales_logout', {}).then(response => {
                window.location.href = '/sales';
            });
        }

        //新增商家
        $scope.new_store = function() {

            //新增前先驗證
            const StoreNameRegex = /^[a-zA-Z0-9]{1,10}$/;
            const StorePwRegex = /^[a-zA-Z0-9]{1,10}$/;

            if (!StoreNameRegex.test($scope.new_StoreName)) {
                $scope.err_StoreName = "商家名稱不符合要求，1~10字";
                return;
            }

            if (!StorePwRegex.test($scope.new_StorePw)) {
                $scope.err_StorePw = "密碼不符合要求，1~10字";
                return;
            }

            $scope.err_StoreName = "";
            $scope.err_StorePw = "";

            //驗證後新增
            axios.post('/store_C', {
                StoreName: $scope.new_StoreName,
                StorePw: $scope.new_StorePw,
            }).then(response => {

                if (response.data.state) {
                    window.location.reload();
                }
            });
        }

        //修改商家狀態
        $scope.store_state_U = function(storeId, state) {

            //空值return
            if (storeId == "" || state == "") {
                return;
            }

            //驗證後修改
            axios.post('/store_state_U', {
                StoreId: storeId,
                StoreState: state,
            }).then(response => {

                if (response.data.state) {
                    window.location.reload();
                }

                console.log(response.data);
            });
        }


    });
</script>

</html>