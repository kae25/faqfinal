@extends('layouts.app')

@section('content')

    <link rel="icon" href="http://getbootstrap.com/favicon.ico">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap-theme.min.css">


    <div class="container">

        <div class="card float-left mr-3">
        <div style="max-width: 680px; margin: auto;">
            <h3 class="page-header">Profile Picture</h3>
            <p class="lead">Select a PNG or JPEG image, having maximum size <span id="max-size"></span> KB.</p>

            <form id="upload-image-form" action="" method="post" enctype="multipart/form-data">
                <div id="image-preview-div" style="display: none">
                    <label for="exampleInputFile">Selected image:</label>
                    <br>
                    <img id="preview-img" src="noimage">
                </div>
                <div class="form-group">
                    <input type="file" name="file" id="file" required>
                </div>
                <button class="btn btn-lg btn-primary" id="upload-button" type="submit" disabled>Upload image</button>
            </form>

            <br>
            <div class="alert alert-info" id="loading" style="display: none;" role="alert">
                Uploading image...
                <div class="progress">
                    <div class="progress-bar progress-bar-striped active" role="progressbar" aria-valuenow="45" aria-valuemin="0" aria-valuemax="100" style="width: 100%">
                    </div>
                </div>
            </div>
            <div id="message"></div>
        </div>

        </div>
        </div>

    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/js/bootstrap.min.js"></script>
    <script src="/uploadimage.js"></script>
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

            var maxsize = 500 * 1024; // 500 KB

            $('#max-size').html((maxsize/1024).toFixed(2));

            $('#upload-image-form').on('submit', function(e) {

                e.preventDefault();

                $('#message').empty();
                $('#loading').show();

                $.ajax({
                    url: "upload.image.php",
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

                    $('#message').html('<div class="alert alert-warning" role="alert">Unvalid image format. Allowed formats: JPG, JPEG, PNG.</div>');

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
    </body>
<br>
    <div class="container">
    <div class="row ">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">My Profile</div>

                <div class="card-body ">
                    <span class="font-weight-bold">First Name:</span> {{$profile->fname}}</br>
                    <span class="font-weight-bold">Last Name: </span>{{$profile->lname}}</br>
                    <span class="font-weight-bold">Body: </span>{{$profile->body}}</br>
                </div>
                <div class="card-footer">
                    <a class="btn btn-success float-right" href="{{ route('profile.edit', ['profile_id' => $profile->id,'user_id' => $profile->user->id]) }}">
                        Edit
                    </a>
                </div>

            </div>
        </div>
    </div>
</div>
<br>


            </div>
        </div>
    </div>
</div>
@endsection