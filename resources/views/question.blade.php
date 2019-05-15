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
                           href="{{ route('question.edit',['id'=> $question->id])}}">
                            Edit Question
                        </a>

                        {{ Form::open(['method'  => 'DELETE', 'route' => ['question.destroy', $question->id]])}}
                        <button class="btn btn-danger float-right mr-2" value="submit" type="submit" id="submit">Delete
                        </button>
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card">
                    <div class="card-header"><a class="btn btn-primary float-left"
                                                href="{{ route('answers.create', ['question_id'=> $question->id])}}">
                            Answer Question
                        </a></div>

                    <div class="card-body">
                        @forelse($question->answers as $answer)
                            <div class="card">
                                <div class="card-body">{{$answer->body}}</div>
                                <div class="card-footer">

                                    <a class="btn btn-primary float-right"
                                       href="{{ route('answers.show', ['question_id'=> $question->id,'answer_id' => $answer->id]) }}">
                                        View
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
                                                        var cnt=11;
                                                        var btn = $(this);
                                                        btn.button('loading');
                                                        setTimeout(function () {
                                                            cnt++;
                                                            btn.button('reset');
                                                            btn.text('  ' + cnt);
                                                        }, 1000);
                                                    });

                                                    $('#testBtnDown').click(function () {
                                                        var cnt=3;
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
                                        11</button>
                                    <button type="button" id="testBtnDown" class="btn btn-success glyphicon glyphicon-thumbs-down" data-loading-text=" ... ">
                                        3</button>
                                    </body>
                                    </html>
                                </div>
                            </div>
                        @empty
                            <div class="card">

                                <div class="card-body"> No Answers</div>
                            </div>
                        @endforelse


                    </div>
                </div>
            </div>
@endsection