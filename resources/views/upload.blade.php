<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

        <!-- Styles -->
        <style>
          
        </style>
    </head>
    <body>
    <input accept="image/png, image/jpeg, image/gif, image/jpg" id="upload" type="file">
    <a href="" class="img" target="_blank"></a>
    <script src="http://libs.baidu.com/jquery/2.0.0/jquery.min.js"></script>
    <script>
        $("#upload").change(function (e) {
            var file = e.target.files[0];
            var reader = new FileReader();
            reader.readAsDataURL(file); // 读取文件
            reader.onload = function (arg) {
                $.ajax({
                    url:"/baidu/queryCarNumber",
                    method:'post',
                    header:{
                        'X-CSRF-TOKEN':"{{csrf_token()}}"
                    },
                    data:{
                        file:arg.target.result
                    },
                    dataType:'json',
                    success:function (res) {
                        $(".img").attr("href",res.data)
                        $(".img").html(res.data)
                    }
                })
            }

        })
    </script>
    </body>
</html>
