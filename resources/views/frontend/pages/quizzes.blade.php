@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row mt-5 mb-5">
            <!-- BEGIN SEARCH RESULT -->
            <div class="col-md-12">
                <div class="grid search">
                    <div class="grid-body">
                        <div class="row">
                            <!-- BEGIN FILTERS -->
                            <div class="col-md-3">
                                <h2 class="grid-title"><i class="fa fa-filter"></i> Filters</h2>
                                <hr>
                                <form class="d-inline" method="get" action="{{ route('quizzes') }}">
                                    <div class="form-group">
                                        <label for="search" class="col-form-label text-md-right">{{ __('Search') }}</label>
                                        <input id="search" type="text" class="form-control" name="search" value="{{ request()->search }}" autofocus>
                                    </div>
                                    <!-- BEGIN FILTER BY CATEGORY -->
                                    <h4>By Courses</h4>
                                    @foreach($courses as $course)
                                    <div class="checkbox">
                                        <label><input type="checkbox" name="courses[]" value="{{$course->id}}" class="icheck"
                                                      {{request()->courses && is_array(request()->courses) && in_array($course->id, request()->courses) ? 'checked': ''}}> {{$course->name}}</label>
                                    </div>
                                    @endforeach
                                    <!-- END FILTER BY CATEGORY -->

                                    <hr>
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-primary">
                                            {{ __('Apply') }}
                                        </button>
                                    </div>
                                </form>
                            </div>
                            <!-- END FILTERS -->
                            <!-- BEGIN RESULT -->
                            <div class="col-md-9">
                                <h2><i class="fa fa-file-o"></i> Quizzes</h2>
                                <hr>
                                <p>Total {{$quizzes->count()}} quizzes found.</p>
                                <!-- BEGIN TABLE RESULT -->
                                <div class="table-responsive">
                                    <table class="table table-hover">
                                        <thead>
                                            <tr>
                                                <th width="5%">#</th><th width="60%">Quiz Title</th><th>Questions</th><th>Total Score</th><th>Taken</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($quizzes as $quiz)
                                                <tr>
                                                    <td class="number text-center">1</td>
                                                    <td class="product"><a href="{{url('quizzes/'.$quiz->id.'/'.$quiz->slug)}}"><strong>{{$quiz->title}}</strong></a><br>
                                                        {{$quiz->course->name}}
                                                    </td>
                                                    <td class="rate text-right">
                                                        {{$quiz->questions_count}}
                                                    </td>
                                                    <td class="rate text-right">
                                                        {{ $quiz->total_point }}
                                                    </td>
                                                    <td class="price text-right">{{$quiz->attempts_count}}</td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                                <!-- END TABLE RESULT -->
                                {{ $quizzes->links() }}
                                <nav class="d-none" aria-label="Page navigation example ">
                                    <ul class="pagination">
                                        <li class="page-item">
                                            <a class="page-link" href="#" aria-label="Previous">
                                                <span aria-hidden="true">&laquo;</span>
                                                <span class="sr-only">Previous</span>
                                            </a>
                                        </li>
                                        <li class="page-item"><a class="page-link" href="#">1</a></li>
                                        <li class="page-item"><a class="page-link" href="#">2</a></li>
                                        <li class="page-item"><a class="page-link" href="#">3</a></li>
                                        <li class="page-item">
                                            <a class="page-link" href="#" aria-label="Next">
                                                <span aria-hidden="true">&raquo;</span>
                                                <span class="sr-only">Next</span>
                                            </a>
                                        </li>
                                    </ul>
                                </nav>
                            </div>
                            <!-- END RESULT -->
                        </div>
                    </div>
                </div>
            </div>
            <!-- END SEARCH RESULT -->
        </div>
@endsection
