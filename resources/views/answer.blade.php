@extends('layouts.app')

@section('content')



    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Answer</div>
                    <div class="card-body">
                        {{$answer->body}}
                    </div>
                    <div class="card-footer">

                        {{ Form::open(['method'  => 'DELETE', 'route' => ['answers.destroy', $question, $answer->id]])}}
                        <button class="btn btn-danger float-right mr-2" value="submit" type="submit" id="submit">Delete
                        </button>
                        {!! Form::close() !!}
                        <a class="btn btn-primary float-right" href="{{ route('answers.edit',['question_id'=> $question, 'answer_id'=> $answer->id, ])}}">
                            Edit Answer
                        </a>

                        <html>
                        <head>
                            <script type='text/javascript'
                                    src='http://code.jquery.com/jquery-1.9.1.js'></script>
                            <link rel="stylesheet" type="text/css"
                                  href="http://netdna.bootstrapcdn.com/twitter-bootstrap/2.3.2/css/bootstrap-combined.no-icons.min.css">
                            <script type='text/javascript'
                                    src="http://netdna.bootstrapcdn.com/twitter-bootstrap/2.3.2/js/bootstrap.min.js"></script>
                            <script type='text/javascript'>//<![CDATA[
                                $(window).load(function(){<!--   w  w w .  j a v  a  2s  .  c  om-->
                                    $(document).ready(function () {
                                        $('#testBtn').click(function () {
                                            var cnt=1;
                                            var btn = $(this);
                                            btn.button('loading');
                                            setTimeout(function () {
                                                cnt++;
                                                btn.button('reset');
                                                btn.text('  ' + cnt);
                                            }, 1000);
                                        });

                                        $('#testBtnDown').click(function () {
                                            var cnt=2;
                                            var btn = $(this);
                                            btn.button('loading');
                                            setTimeout(function () {
                                                if (cnt > 0) {
                                                    cnt--;
                                                }
                                                btn.button('reset');
                                                btn.text('  ' + cnt);
                                            }, 1000);
                                        });
                                    });
                                });//]]>
                            </script>
                        </head>
                        <body>
                        <button type="button" id="testBtn" class="btn btn-success glyphicon glyphicon-thumbs-up" data-loading-text=" ... ">
                            1</button>
                        <button type="button" id="testBtnDown" class="btn btn-success glyphicon glyphicon-thumbs-down" data-loading-text=" ... ">
                            2</button>
                        </body>
                        </html>

                        </div>

                    </div>
                </div>

            </div>
        </div>
    </div>

@endsection

