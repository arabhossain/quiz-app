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
                                <question :user="{{json_encode(auth()->user())}}" :quiz="{{json_encode($quiz->toArray())}}"></question>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
@endsection
