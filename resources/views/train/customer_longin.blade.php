@verbatim
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="/css/bootstrap.min.css">
    <script src="https://cdn.staticfile.org/angular.js/1.4.6/angular.min.js"></script>
    <script src="/js/bootstrap.bundle.min.js"></script>
    <script src="/js/axios.min.js"></script>
</head>

<body ng-app="myApp">

    <div class="container">

        <div class="row align-items-center" style="height:650px;">

            <div class="col-4 offset-4">

                <div ng-controller="myCtrl">


                    <div class="mb-3">
                        <label for="ex1" class="form-label">帳號</label>
                        <input type="text" class="form-control" id="ex1" ng-model="customerName">
                    </div>
                    <div class="mb-3">
                        <label for="ex2" class="form-label">密碼</label>
                        <input type="password" class="form-control" id="ex2" ng-model="customerIDnumber">
                    </div>
                    <br>
                    <div class="text-center">
                        <h1 style="color:red;">{{login_err}}</h1>
                        <button type="button" class="btn btn-primary mt-3 text-center" ng-click="login()">login</button>
                    </div>

                </div>

            </div>
        </div>
    </div>

</body>

<script>
    var app = angular.module('myApp', []);

    app.controller('myCtrl', function($scope) {

        $scope.customerName = "";
        $scope.customerIDnumber = "";
        $scope.login_err = "";

        //顧客登入
        $scope.login = function() {

            if ($scope.customerName == "" || $scope.customerIDnumber == "") {
                $scope.login_err = "請填入帳號&密碼";
                return;
            }
            console.log($scope.customerName);
            console.log($scope.customerIDnumber);

            axios.post('/customer_login', {
                CustomerName: $scope.customerName,
                CustomerIDnumber: $scope.customerIDnumber,
            }).then(response => {

                if (response.data.state) {
                    console.log(response.data);
                    window.location.href = '/items';
                }

                if (!response.data.state) {
                    console.log(response.data.state);
                    $scope.login_err = "登入失敗";
                    $scope.$apply();
                }
            });

        }


    });
</script>

</html>

@endverbatim