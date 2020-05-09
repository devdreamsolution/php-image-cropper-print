<!DOCTYPE html>
<html>
    <head>
        <title></title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
        <link href="https://cdnjs.cloudflare.com/ajax/libs/cropper/2.3.4/cropper.min.css" rel="stylesheet" type="text/css" />
    </head>

    <body>
        <div class="container">
            <h3 class="mt-4 text-center">Image Print</h3>
            <div class="row">
                <div class="col-md-8 offset-md-2 mt-2">
                    <img id="image" class="col-md-8" src="images/image.jpg" alt="Picture"/>
                    <div class="col-md-12 preview p-2" style="display: none"></div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-3 offset-md-2 mt-2">
                    <label for="width">Width in Cm :</label>
                    <input type="number" id="width" name="width" onchange="changeWidth()" value="5" class="form-control" />
                </div>
                <div class="col-md-2">
                    <label for="lock" style="width: 100%;"></label>
                    <input type="checkbox" checked class="form-control" onclick="setData();" style="height: 20px" id="lock">
                </div>
                <div class="col-md-3 mt-2">
                    <label for="height">Height in Cm :</label>
                    <input type="number" id="height" name="height" onchange="changeHeight()" value="5" class="form-control" />
                </div>
            </div>
            <div class="row">
                <div class="col-md-8 offset-md-2 mt-4 text-right">
                    <button class="btn btn-primary" style="width: 150px;" onclick="printDiv();">Print</button>
                </div>
            </div>
        </div>

        <script type="text/JavaScript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
        <script type="text/JavaScript" src="https://cdnjs.cloudflare.com/ajax/libs/cropper/2.3.4/cropper.min.js"></script>
        <script type="text/JavaScript" src="https://cdnjs.cloudflare.com/ajax/libs/jQuery.print/1.3.3/jQuery.print.min.js"></script>
        <script type="text/JavaScript" src="https://allurewebsolutions.com/allure.js"></script>

        <script type="text/javascript">
            var $image = $('#image');
            var image_height = $image.height();
            var image_width = $image.width();
            $(function(){
                $image.cropper({
                    preview: '.preview',
                    aspectRatio: image_width / image_height,
                    data: {
                        x: 50,
                        y: 50
                    },
                    crop(event) {
                        $("#width").val((event.width / 37.795275591 / 2).toFixed());
                        $("#height").val((event.height / 37.795275591 / 2).toFixed());
                    },
                });
            });
            function changeWidth(){
                if($("#lock").prop("checked") == true){
                    var width = $("#width").val();
                    $("#height").val((width * image_height / image_width).toFixed());
                }
                setData();
            }
            function changeHeight(){
                if($("#lock").prop("checked") == true){
                    var height = $("#height").val();
                    $("#width").val((height * image_width / image_height).toFixed());
                }
                setData();
            }
            function printDiv(){
                var img = document.createElement("img");
                var imageData = $image.cropper('getCroppedCanvas').toDataURL();
                $(img).attr('src', imageData);
                $(img).attr('width', "1097");
                $(img).attr('height', 1097 * image_height / image_width);
                $.print(img);
            }
            function setData(){
                var width = $('#width').val();
                var height = $('#height').val();
                initCropper(width * 37.795275591, height * 37.795275591);
            }
            function initCropper(width, height){
                if($("#lock").prop("checked") == true){
                    $image.cropper('setAspectRatio', image_width / image_height);
                    $image.cropper('setCropBoxData', {
                        width: Math.round(width),
                        height: Math.round(height)
                    });
                } else if($("#lock").prop("checked") == false){
                    $image.cropper('setAspectRatio', NaN);
                    $image.cropper('setCropBoxData', {
                        width: Math.round(width),
                        height: Math.round(height)
                    });
                }
            }
        </script>
    </body>
</html>