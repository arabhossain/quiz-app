<div class="container">
    <div class="m-5">
        <h1 class="my-4 pb-3  text-center">Top Quizzes!</h1>
        <div class="row">
            @foreach($courses as $course)
                <div class="col-xl-4 col-md-6 mb-3">
                    <div class="card shadow" style="min-width: 320px">
                    <div class="card-body">
                        <h5 class="card-title">{{$course->name}}</h5>
                        <p class="card-text">{!! $course->description !!}</p>
                    </div>
                    <ul class="list-group list-group-flush">
                        @foreach($course->quizzes as $quiz)
                            <li class="list-group-item"><a href="#">{{$quiz->title}}</a></li>
                        @endforeach
                    </ul>
                    <div class="card-body">
                        <a href="#" class="btn btn-success">See all {{$course->quizzes->count()}} quizzes</a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>
