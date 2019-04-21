@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row ">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Question</div>

                    <div class="card-body">

                        {{$question->body}}
                    </div>
                    <div class="card-footer">
                        <a class="btn btn-primary float-right"
                           href="3">
                            Edit Question
                        </a>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card">
                    <div class="card-header"><a class="btn btn-primary float-left"
                                                href="#">
                            Answer Question
                        </a></div>

                    <div class="card-body">

                            <div class="card">
                                <div class="card-body"></div>
                                <div class="card-footer">

                                    <a class="btn btn-primary float-right"
                                       href="#">
                                        View
                                    </a>

                                </div>
                            </div>



                    </div>
                </div>
            </div>
@endsection