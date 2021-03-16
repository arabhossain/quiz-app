<section>
    <div id="carouselExampleFade" class="carousel slide carousel-fade" data-ride="carousel">
        <div class="carousel-inner home-carousel" >
            <div class="carousel-item active">
                <img src="{{asset('images/slider/child-sutdying-at-home.jpeg')}}" class="d-block w-100" alt="...">
            </div>
            <div class="carousel-item">
                <img src="{{asset('images/slider/bibliography-clipart-kids-2.jpeg')}}" class="d-block w-100" alt="...">
            </div>
            <div class="carousel-item">
                <img src="{{asset('images/slider/big-girl-teaching-younger-boy-cropped-2.jpeg')}}" class="d-block w-100" alt="...">
            </div>
        </div>
        <a class="carousel-control-prev" href="#carouselExampleFade" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#carouselExampleFade" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>
    </div>
</section>
<section class="search-sec">
    <div class="container">
        <form method="get" action="{{ route('quizzes') }}">
            <div class="row">
                <div class="col-lg-12">
                    <div class="row">
                        <div class="col-lg-3 col-md-3 col-sm-12 p-0">
                            <select class="form-control search-slt" name="courses[]" id="exampleFormControlSelect1">
                               <option value="all"> All Courses</option>
                               @foreach($courses as $course)
                                    <option value="{{$course->id}}"> {{$course->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-lg-6 col-md-3 col-sm-12 p-0">
                            <input type="text" class="form-control search-slt" name="search" placeholder="Enter Quiz Title">
                        </div>
                        <div class="col-lg-3 col-md-3 col-sm-12 p-0">
                            <button type="submit" class="btn btn-danger wrn-btn">Search</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</section>
