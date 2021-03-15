<div class="counter-home">
    <div class="container">
        <div class="m-5 text-center">
            <h1 class="my-4 pb-3">See How Reach We Are!</h1>
            <div class="row w-100 ">
                <div class="col-md-3">
                    <div class="card border-info mx-sm-1 p-3">
                        <div class="card border-info shadow text-info p-3 my-card">
                            <span class="fa fa-car"aria-hidden="true"></span>
                        </div>
                        <div class="text-info text-center mt-3"><h4>Courses</h4></div>
                        <div class="text-info text-center mt-2"><h1>{{$courses->count()}}</h1></div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card border-success mx-sm-1 p-3">
                        <div class="card border-success shadow text-success p-3 my-card">
                            <span class="fa fa-eye" aria-hidden="true"></span>
                        </div>
                        <div class="text-success text-center mt-3"><h4>Quizzes</h4></div>
                        <div class="text-success text-center mt-2"><h1>{{$quizzesCount}}</h1></div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card border-danger mx-sm-1 p-3">
                        <div class="card border-danger shadow text-danger p-3 my-card">
                            <span class="fa fa-heart" aria-hidden="true"></span>
                        </div>
                        <div class="text-danger text-center mt-3"><h4>Students</h4></div>
                        <div class="text-danger text-center mt-2"><h1>{{$studentsCount}}</h1></div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card border-warning mx-sm-1 p-3">
                        <div class="card border-warning shadow text-warning p-3 my-card">
                            <span class="fa fa-inbox" aria-hidden="true"></span>
                        </div>
                        <div class="text-warning text-center mt-3"><h4>Attempts</h4></div>
                        <div class="text-warning text-center mt-2"><h1>{{$quizAttemptsCount}}</h1></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
