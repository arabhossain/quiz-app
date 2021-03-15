@extends('layouts.app')

@section('content')
    @include('frontend.components.search-with-slider')
    @include('frontend.components.top-courses-quizes')
    @include('frontend.components.counter-board')
    @include('frontend.components.top-students')
@endsection
