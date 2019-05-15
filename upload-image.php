<?php
session_start();
if ( isset($_FILES["file"]["type"]) )
{
    $max_size = 500 * 1024; // 500 KB
    $destination_directory = "upload/";
    $validextensions = array("jpeg", "jpg", "png");
    $temporary = explode(".", $_FILES["file"]["name"]);
    $file_extension = end($temporary);



    if ( (($_FILES["file"]["type"] == "image/png") ||
            ($_FILES["file"]["type"] == "image/jpg") ||
            ($_FILES["file"]["type"] == "image/jpeg")
        ) && in_array($file_extension, $validextensions))
    {
        if ( $_FILES["file"]["size"] < ($max_size) )
        {
            if ( $_FILES["file"]["error"] > 0 )
            {
                echo "<div class=\"alert alert-danger\" role=\"alert\">Error: <strong>" . $_FILES["file"]["error"] . "</strong></div>";
            }
            else
            {
                if ( file_exists($destination_directory . $_FILES["file"]["name"]) )
                {
                    echo "<div class=\"alert alert-danger\" role=\"alert\">Error: File <strong>" . $_FILES["file"]["name"] . "</strong> already exists.</div>";
                }
                else
                {
                    $sourcePath = $_FILES["file"]["tmp_name"];
                    $targetPath = $destination_directory . $_FILES["file"]["name"];
                    move_uploaded_file($sourcePath, $targetPath);

                    echo "<div class=\"alert alert-success\" role=\"alert\">";
                    echo "<p>Image uploaded successful</p>";
                    echo "<p>File Name: <a href=". $targetPath . "<strong>" . $targetPath . "</strong></p>";
                    echo "<p>Type: <strong>" . $_FILES["file"]["type"] . "</strong></p>";
                    echo "<p>Size: <strong>" . round($_FILES["file"]["size"]/1024, 2) . " kB</strong></p>";
                    echo "<p>Temp file: <strong>" . $_FILES["file"]["tmp_name"] . "</strong></p>";
                    echo "</div>";
                }
            }
        }
        else
        {
            echo "<div class=\"alert alert-danger\" role=\"alert\">The size of image you are attempting to upload is " . round($_FILES["file"]["size"]/1024, 2) . " KB, maximum size allowed is " . round($max_size/1024, 2) . " KB</div>";
        }
    }
    else
    {
        echo "<div class=\"alert alert-danger\" role=\"alert\">Invalid image format. Allowed formats: JPG, JPEG, PNG.</div>";
    }
}
?>

<script>

    function noPreview() {
        $('#image-preview-div').css("display", "none");
        $('#preview-img').attr('src', 'noimage');
        $('upload-button').attr('disabled', '');
    }

    function selectImage(e) {
        $('#file').css("color", "green");
        $('#image-preview-div').css("display", "block");
        $('#preview-img').attr('src', e.target.result);
        $('#preview-img').css('max-width', '550px');
    }

    $(document).ready(function (e) {

        var maxsize = 500 * 1024;

        $('#max-size').html((maxsize/1024).toFixed(2));

        $('#upload-image-form').on('submit', function(e) {

            e.preventDefault();

            $('#message').empty();
            $('#loading').show();

            $.ajax({
                url: "upload-image.php",
                type: "POST",
                data: new FormData(this),
                contentType: false,
                cache: false,
                processData: false,
                success: function(data)
                {
                    $('#loading').hide();
                    $('#message').html(data);
                }
            });

        });

        $('#file').change(function() {

            $('#message').empty();

            var file = this.files[0];
            var match = ["image/jpeg", "image/png", "image/jpg"];

            if ( !( (file.type == match[0]) || (file.type == match[1]) || (file.type == match[2]) ) )
            {
                noPreview();

                $('#message').html('<div class="alert alert-warning" role="alert">Invalid image format. Allowed formats: JPG, JPEG, PNG.</div>');

                return false;
            }

            if ( file.size > maxsize )
            {
                noPreview();

                $('#message').html('<div class=\"alert alert-danger\" role=\"alert\">The size of image you are attempting to upload is ' + (file.size/1024).toFixed(2) + ' KB, maximum size allowed is ' + (maxsize/1024).toFixed(2) + ' KB</div>');

                return false;
            }

            $('#upload-button').removeAttr("disabled");


            var reader = new FileReader();
            reader.onload = selectImage;
            reader.readAsDataURL(this.files[0]);

        });

    });
</script>
