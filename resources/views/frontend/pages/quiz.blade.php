@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row mt-5 mb-5">
            <div class="col-md-12">
                <div class="grid search">
                    <div class="grid-body">
                        <div class="row">
                            <div class="col">
                                <h2 class="grid-title">Quiz: {{$quiz->title}}</h2>
                                <strong>{{$quiz->course->name}}</strong>
                                <hr>
                                <div class="row">
                                    <div class="col col-md-3">
                                        Quiz Hints
                                    </div>
                                    <div class="col">{!! $quiz->quiz_hints !!}</div>
                                </div>
                                <div class="row">
                                    <div class="col col-md-3">
                                        Min/Pass Score
                                    </div>
                                    <div class="col">{{$quiz->min_score}}</div>
                                </div>
                                <div class="row">
                                    <div class="col col-md-3">
                                        Total Point
                                    </div>
                                    <div class="col">{{$quiz->total_point}}</div>
                                </div>
                                <div class="row">
                                    <div class="col col-md-3">
                                        Questions
                                    </div>
                                    <div class="col">{{$quiz->questions_count}}</div>
                                </div>

                                <a href="{{url('quiz/attempt/'.$quiz->id.'/'.$quiz->slug)}}" class="btn btn-success mt-4">Start</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
@endsection
