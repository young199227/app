<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/css/bootstrap.min.css">

    <title>Document</title>
</head>

<body>

    <input accept="image/*" type='file' id="imgInp" multiple />

    <br>
    <button type="button" class="btn btn-success" id="upload_btn">上傳</button>
    <br>
    <div class="row mt-4 img_ee">
        <div class="col-3 d-flex align-items-center justify-content-end">
            <div class="">商品圖片：</div>
        </div>
        <div class="col-9">

            <div class="imgrow" id="show_img">

            </div>

        </div>
    </div>
</body>
<script src="/js/bootstrap.bundle.min.js"></script>
<script src="/js/jquery-3.6.1.min.js"></script>
<script>
    $(function() {

        $("#imgInp").bind('input propertychange', function() {

            for (i = 0; i < imgInp.files.length; i++) {
                console.log("123");
                console.log(imgInp.files[i]);
                $("#show_img").append(
                    '<div class="imgbox img-fluid ">' +
                    '<img src="' + URL.createObjectURL(imgInp.files[i]) + '">' +
                    '</div>'
                );
            }

            //按鈕監聽 #upload_btn
            $("#upload_btn").bind("click", function() {

                    var formData = new FormData();
                    formData.append("ggyy", imgInp.files[0]);
                    formData.append("id", "321");
                    $.ajax({
                        type: "POST",
                        url: "/api/owner/update_goods",
                        data: formData,
                        dataType: "json",
                        cache: false,
                        contentType: false,
                        processData: false,
                        success: function(data){
                            console.log(data);
                        },
                        error: function(data) {
                            console.log(data);
                        }
                    });
            })

        });

    });
</script>

</html>