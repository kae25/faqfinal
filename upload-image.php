<?php

session_start();

if ( isset($_FILES["file"]["type"]) )
{
    $max_size = 500 * 1024;
    $destination_directory = "/public/upload/uploaded";
    $validextensions = array("jpeg", "jpg", "png");

    $temporary = explode(".", $_FILES["file"]["tmp_name"]);
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
                    $sourcePath = $_FILES["file"]["name"];
                    $targetPath = $destination_directory . $_FILES["image"]["tmp_name"];
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

