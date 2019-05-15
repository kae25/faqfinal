@extends('layouts.app')

@section('content')

    <link rel="icon" href="http://getbootstrap.com/favicon.ico">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap-theme.min.css">
    <style>body { padding-top:50px; }.navbar-inverse .navbar-nav > li > a { color: #DBE4E1; }</style>

    <div class="container">
        <div class="col-md-12">
        <div class="card">
        <div style="max-width: 650px; margin: auto;">
            <h3 class="page-header">Profile Picture</h3>
            <p class="lead">Select a PNG or JPEG image, having maximum size <span id="max-size"></span> KB.</p>

            <form id="upload-image-form" action="" method="get" enctype="multipart/form-data">
                <div id="image-preview-div" style="display: none">
                    <label for="exampleInputFile">Selected image:</label>
                    <br>
                    <img id="preview-img" src="noimage">
                </div>
                <div class="form-group">
                    <input type="file" name="file" id="file" required>
                </div>
                <button class="btn btn-lg btn-primary" id="upload-button" type="submit">Upload image</button>
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
<div class="container">
    <div class="row ">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Upload Your Files</div>

                <div class="card-body ">

                </div>
                <div class="card-footer">

                </div>

            </div>
        </div>
    </div>
</div>
@endsection