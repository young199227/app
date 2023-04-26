<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>商家</title>
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
        <!-- 新增商品&商品列表 -->
        <div class="row mt-4">

            <!-- 新增商品 -->
            <div class="col-4">
                <h1>新增商品</h1>
                <div class="mb-3">
                    <label for="ex1" class="form-label">商品名稱</label>
                    <input type="text" id="ex2" class="form-control" ng-model="new_ItemsName">
                    <div class="form-text">{{err_ItemsName}}</div>
                </div>
                <div class="mb-3">
                    <label for="ex2" class="form-label">價錢</label>
                    <input type="number" id="ex2" class="form-control" ng-model="new_ItemsPrice">
                    <div class="form-text">{{err_ItemsPrice}}</div>
                </div>

                <button type="submit" class="btn btn-primary" ng-click="new_items()">新增商品</button>

            </div>

            <!-- 商品列表 -->
            <div class="col-8">
                <h1>商品列表</h1>
                <table class="table text-center align-middle">
                    <thead class="table-success">
                        <tr>
                            <th>商品編號</th>
                            <th>所屬店家</th>
                            <th>商品名稱</th>
                            <th>價錢</th>
                            <th>創建時間</th>
                            <th>修改</th>
                            <th>狀態</th>
                            <th>上下架</th>
                        </tr>
                    </thead>
                    <tbody class="table-striped">
                        <tr ng-repeat="item in items">
                            <td>{{item.ItemsId}}</td>
                            <td>{{item.StoreId}}</td>
                            <td>{{item.ItemsName}}</td>
                            <td>${{item.ItemsPrice|number}}</td>
                            <td>{{item.CreatedTime}}</td>
                            <td data-bs-toggle="modal" data-bs-target="#exampleModal" ng-click="items_modal(item.ItemsId,item.ItemsName,item.ItemsPrice)">✎</td>
                            <td>
                                <psan ng-if="item.ItemsState===0">上架</psan>
                                <psan ng-if="item.ItemsState===1">下架</psan>
                            </td>
                            <td>
                                <select class="form-select" aria-label="Default select example" ng-change="items_D(item.ItemsId,items_state)" ng-model="items_state">
                                    <option value="0">上架</option>
                                    <option value="1">下架</option>
                                </select>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- 銷售詳細 -->
        <div class="row mt-5">
            <div class="col-12">
                <h1>銷售詳細</h1>
                <table class="table text-center mt-2">
                    <thead class="table-info">
                        <tr>
                            <th>訂單編號</th>
                            <th>產品編號</th>
                            <th>產品名稱</th>
                            <th>價錢</th>
                            <th>數量</th>
                            <th>總價</th>
                            <th>訂單時間</th>
                        </tr>
                    </thead>
                    <tbody class="table-striped">
                        <tr ng-repeat="order in orders">
                            <td>{{order.OrderId}}</td>
                            <td>{{order.ItemsId}}</td>
                            <td>{{order.ItemsName}}</td>
                            <td>${{order.ItemsPrice|number}}</td>
                            <td>{{order.ItemsQuantity}}</td>
                            <td>${{order.ItemsTotalMoney|number}}</td>
                            <td>{{order.CreatedTime}}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- 修改商品Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">修改商品編號{{u_ItemsId}}</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="ex1" class="form-label">商品名稱</label>
                            <input type="text" id="ex2" class="form-control" ng-model="u_ItemsName">
                            <div class="form-text">{{uerr_ItemsName}}</div>
                        </div>
                        <div class="mb-3">
                            <label for="ex2" class="form-label">價錢</label>
                            <input type="number" id="ex2" class="form-control" ng-model="u_ItemsPrice">
                            <div class="form-text">{{uerr_ItemsPrice}}</div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary" ng-click="items_U()">修改</button>
                    </div>
                </div>
            </div>
        </div>

    </div>

</body>
@endverbatim
<script>
    var app = angular.module('myApp', []);

    app.controller('myCtrl', function($scope) {

        //新增商品的input
        $scope.new_ItemsName = "";
        $scope.new_ItemsPrice = "";
        //新增商品的err
        $scope.err_ItemsName = "";
        $scope.err_ItemsPrice = "";

        //商品狀態的變數
        $scope.items_state = "";

        //modal修改商品變數
        $scope.u_ItemsId = "";
        $scope.u_ItemsName = "";
        $scope.u_ItemsPrice = "";
        //modal修改的err
        $scope.uerr_ItemsName = "";
        $scope.uerr_ItemsPrice = "";

        //登入後 用後端的session直接撈取值
        //店家商品資料
        $scope.items = [];
        //銷售情況
        $scope.orders = [];
        //店家id
        $scope.salesId = "";
        //店家名稱
        $scope.salesName = "";

        axios.post('/store_R', {

        }).then(response => {
            $scope.items = response.data.items;
            $scope.orders = response.data.orders;
            $scope.salesId = response.data.salesId;
            $scope.salesName = response.data.salesName;
            console.log(response.data);
            $scope.$apply();
        });

        //店家登出
        $scope.logout = function() {

            axios.post('/store_logout', {

            }).then(response => {
                window.location.reload();
            });
        }

        //新增商品
        $scope.new_items = function() {

            // console.log($scope.new_ItemsName);
            // console.log($scope.new_ItemsPrice);

            //新增前先驗證
            const ItemsNameRegex = /^[a-zA-Z0-9]{1,10}$/;
            const ItemsPriceRegex = /^[0-9]{1,10}$/;

            if (!ItemsNameRegex.test($scope.new_ItemsName)) {
                $scope.err_ItemsName = "商品名稱不符合要求，1~10字 英文數字";
                return;
            }

            $scope.err_ItemsName = "";

            if (!ItemsPriceRegex.test($scope.new_ItemsPrice) || $scope.new_ItemsPrice > 200000) {
                $scope.err_ItemsPrice = "價錢不符合要求，數字0~9 20萬上限";
                return;
            }

            $scope.err_ItemsPrice = "";

            axios.post('/store_C', {
                StoreId: $scope.salesId,
                ItemsName: $scope.new_ItemsName,
                ItemsPrice: $scope.new_ItemsPrice,
            }).then(response => {

                if (response.data.state) {
                    window.location.reload();
                }

                console.log(response.data);
            });
        }

        //按下鉛筆把要修改的值帶到modal
        $scope.items_modal = function(itemsId, itemsName, itemsPrice) {

            $scope.u_ItemsId = itemsId;
            $scope.u_ItemsName = itemsName;
            $scope.u_ItemsPrice = itemsPrice;
        }

        //店家修改商品
        $scope.items_U = function() {

            //新增前先驗證
            const ItemsNameRegex = /^[a-zA-Z0-9]{1,10}$/;
            const ItemsPriceRegex = /^[0-9]{1,10}$/;

            if (!ItemsNameRegex.test($scope.u_ItemsName)) {
                $scope.uerr_ItemsName = "商品名稱不符合要求，1~10字 英文數字";
                return;
            }

            $scope.uerr_ItemsName = "";

            if (!ItemsPriceRegex.test($scope.u_ItemsPrice) || $scope.u_ItemsPrice > 200000) {
                $scope.uerr_ItemsPrice = "價錢不符合要求，數字0~9 20萬上限";
                return;
            }

            $scope.uerr_ItemsPrice = "";

            // console.log($scope.u_ItemsId);
            // console.log($scope.u_ItemsName);
            // console.log($scope.u_ItemsPrice);

            axios.post('store_U', {
                ItemsId: $scope.u_ItemsId,
                ItemsName: $scope.u_ItemsName,
                ItemsPrice: $scope.u_ItemsPrice,
            }).then(response => {

                if (response.data.state) {
                    window.location.reload();
                }

                console.log(response.data);
            })
        }

        //店家上下架商品
        $scope.items_D = function(itemsId, itemsState) {
            // console.log(itemsId);
            // console.log(itemsState);

            axios.post('/store_D', {
                ItemsId: itemsId,
                ItemsState: itemsState,
            }).then(response => {

                if(response.data.state){
                    window.location.reload();
                }

                console.log(response.data);
            })
        }

    });
</script>

</html>