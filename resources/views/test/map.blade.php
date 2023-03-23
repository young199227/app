<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>台中熱門地標停車場查詢</title>
    <link rel="stylesheet" href="/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.3/dist/leaflet.css" integrity="sha256-kLaT2GOSpHechhsozzB+flnD+zUyjE2LlfWPgU04xyI=" crossorigin="" />

</head>

<body>
    <div class="container">
        <div class="row">
            <div class="col-md-3 bg-warning vh-100">
                <h1 id="show_name">你好{{ Session('demomap') }}</h1>
                <a href="/session/member/logout"><button type="button" class="btn btn-danger" id="exit">登出</button></a>
                <select class="form-select mt-3" aria-label="Default select example" id="area_name">
                    <option selected>區域選擇</option>
                </select>
            </div>
            <div class="col-md-9 bg-info">
                <div id="map" class="vh-100">

                </div>
            </div>
        </div>
    </div>
</body>
<script src="/js/bootstrap.bundle.min.js"></script>
<script src="/js/jquery-3.6.1.min.js"></script>
<script src="/json/car.js"></script>
<script src="https://unpkg.com/leaflet@1.9.3/dist/leaflet.js" integrity="sha256-WBkoXOwTeyKclOHuWtc+i2uENFpDZ9YPdf5Hf+D7ewM=" crossorigin=""></script>
<script>

    //預設地圖在台中顯示
    var map = L.map('map').setView([24.15911076044162, 120.6540480461248], 12);
    L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
    }).addTo(map);

    //把區域名稱抓出來
    CarData.forEach(element => {
        $("#area_name").append(
            '<option value="' + element.Name + '">' + element.Name + '</option>'
        );
    });

    //變換區域時
    $("#area_name").change(function() {
        //清除圖標
        removeMarker();
        //移動座標儲存
        var lat = 0;
        var lng = 0;

        CarData.forEach(element => {

            if(element.Name==$("#area_name :selected").val()){

                element.ParkingLots.forEach(element => {

                    L.marker([element.Y,element.X]).addTo(map)
                            .bindPopup(element.Position + "<br>" + "剩餘車位:" + element.TotalCar + "<br>" + "資訊:" + element.Notes)
                            .openPopup();

                    lat = element.Y;
                    lng = element.X;
                });
            }
        });
        //畫面移動到這個座標
        map.panTo([lat, lng]);
    });

    //清除圖標
    function removeMarker() {
        map.eachLayer(function(layer) {
            if (layer instanceof L.Marker) {
                map.removeLayer(layer)
            }
        });
    }
</script>

</html>