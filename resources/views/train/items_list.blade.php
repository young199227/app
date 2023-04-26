<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>商品</title>
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
                <h5>hi~{{Name}}</h5>
                <button type="button" class="btn btn-danger" ng-click="logout()">登出</button>
            </div>
        </div>
        <!-- 商品列表 -->
        <div class="row mt-4">
            <div class="col-12">
                <h1>商品列表</h1>
                <table class="table text-center align-middle">
                    <thead class="table-primary">
                        <tr>
                            <th>商品編號</th>
                            <th>店家編號</th>
                            <th>商品名稱</th>
                            <th>價錢</th>
                            <th>創建時間</th>
                            <th>加入購物車</th>
                        </tr>
                    </thead>
                    <tbody class="table-striped">
                        <tr ng-repeat="item in items">
                            <td>{{item.ItemsId}}</td>
                            <td>{{item.StoreId}}</td>
                            <td>{{item.ItemsName}}</td>
                            <td>${{item.ItemsPrice | number}}</td>
                            <td>{{item.CreatedTime}}</td>
                            <td><button type="button" class="btn btn-primary" ng-click="add_car(item.ItemsId,item.ItemsPrice)">✚</button></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <!-- 購物車 -->
        <div class="row mt-4">
            <div class="col-12">
                <h1>購物車</h1>
                <table class="table text-center">
                    <thead class="table-success">
                        <tr>
                            <th>商品編號</th>
                            <th>商品名稱</th>
                            <th>數量</th>
                            <th>價錢</th>
                            <th>取消商品</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr ng-repeat="car in items_car">
                            <td>{{car.ItemsId}}</td>
                            <td>{{car.ItemsName}}</td>
                            <td>{{car.ItemsQuantity}}</td>
                            <td>${{car.ItemsTotalMoney | number}}</td>
                            <th ng-click="car_D(car.ItemsId)">✖</th>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- 確認購買 -->
        <div class="row mt-4 justify-content-end">
            <div class="col-2">
                <button type="button" class="btn btn-success" ng-click="add_order()">確認購買</button>
            </div>
        </div>
    </div>

</body>
@endverbatim
<script>
    var app = angular.module('myApp', []);

    app.controller('myCtrl', function($scope) {

        //登入後 用後端的session直接撈取值
        //商品資料
        $scope.items = [];
        //購物車資料
        $scope.items_car = [];
        //顧客id
        $scope.CustomerId = "";
        //顧客名稱
        $scope.Name = "";

        axios.post('/items_R', {

        }).then(response => {
            $scope.items = response.data.items;
            $scope.items_car = response.data.items_car;
            $scope.CustomerId = response.data.CustomerId;
            $scope.Name = response.data.Name;
            console.log(response.data);
            $scope.$apply();
        });

        //顧客登出
        $scope.logout = function() {

            axios.post('/customer_logout', {

            }).then(response => {
                window.location.reload();
            });
        }

        //購物車新增商品
        $scope.add_car = function(itemsId, itemsPrice) {
            // console.log($scope.CustomerId);
            // console.log(itemsId);
            // console.log(itemsPrice);

            axios.post('/add_car', {
                CustomerId: $scope.CustomerId,
                ItemsId: itemsId,
                ItemsPrice: itemsPrice,
            }).then(response => {

                if (response.data.state) {
                    window.location.reload();
                }

                console.log(response.data);
            });
        }

        //購物車商品移除
        $scope.car_D = function(itemsId) {

            // console.log(itemsId);

            axios.post('/car_D', {
                CustomerId: $scope.CustomerId,
                ItemsId: itemsId,
            }).then(response => {

                if (response.data.state) {
                    window.location.reload();
                }
                console.log(response.data);
            });
        }

        //新訂單
        $scope.add_order = function() {

            axios.post('/add_order', {
                CustomerId: $scope.CustomerId,
            }).then(response => {
                
                if(response.data.state){
                    window.location.reload();
                }
                console.log(response.data);
            });
        }

    });
</script>

</html>