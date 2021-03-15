<?php

namespace App\Http\Controllers;

use App\Course;
use App\Quiz;
use App\QuizAttempt;
use App\User;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
       // $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $courses = Course::withCount(['quizzes'])->with(['quizzes' => function($q) {
            $q->visible()->limit(5);
        }])->orderByDesc('quizzes_count')->limit(6)->get();

        $courses = Course::get();
        $quizzesCount = Quiz::visible()->count();
        $quizAttemptsCount = QuizAttempt::count();
        $studentsCount = User::whereHas(
            'roles', function($q){
            $q->where('name', 'student');
        }
        )->count();

        return view('frontend.pages.home', compact('courses', 'courses', 'quizzesCount', 'quizAttemptsCount', 'studentsCount'));
    }

    public function about(){
        return view('frontend.pages.about');
    }
}
