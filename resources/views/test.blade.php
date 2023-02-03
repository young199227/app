<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/css/bootstrap.min.css">

    <title>Document</title>

    <style>

        img{

            height: 200px;
            width: 200px;
        }

    </style>
</head>



<body>




    <input accept="image/*" type='file' id="imgInp" enctype="multipart/form-data" name="formName" multiple />
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

    
    $("#imgInp").bind('input propertychange', function () {

        $("#show_img").empty();

        var img_array = $("#imgInp")[0].files;

        console.log(img_array[0]);

        for (i = 0; i < img_array.length; i++) {

            $("#show_img").append(
                '<div class="imgbox img-fluid ">'+
                '<img src="' + URL.createObjectURL(img_array[i]) + '>'+
                '</div>'
            );
        }

        $.ajax({
            type:"post",
            url:"/api/owner/update_goods",
            data:"",
            dataType:"",
            success:function(data){
                console.log(data);
            },
            error:function(){console.log("失敗");}
        });

    });

</script>

</html>