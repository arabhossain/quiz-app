<?php

namespace App\Http\Controllers;

use App\Course;
use App\Quiz;
use Illuminate\Http\Request;

class QuizzesController extends Controller
{
    public function index(Request $request){


        $courses = Course::get();
        $quizzes = new Quiz();

        if($request->search) {
            $keyword = $request->search;
            $quizzes= $quizzes->where('title', 'LIKE', "%$keyword%")->orWhere('quiz_hints', 'LIKE', "%$keyword%");
        }

        if ($request->courses && is_array($request->courses) && count($request->courses) > 0) {
            $quizzes = $quizzes->whereHas('course', function ($q) use($request){
                $q->whereIn('id', $request->courses);
            });
        }

        $quizzes = $quizzes->with(['course' => function($q){
            $q->select(['id', 'name']);
        }])->withCount(['questions'])->visible()->paginate(30);


        return view('frontend.pages.quizzes', compact('courses', 'quizzes'));
    }

    public function viewQuiz($quizId, $quizSlug)
    {

        $quiz = Quiz::with(['course' => function($q){
            $q->select(['id', 'name']);
        }])->withCount(['questions'])->visible()->where('id', $quizId)->get();

        if ($quiz->isEmpty()){
            abort(404);
        }

        $quiz = $quiz->first();

        return view('frontend.pages.quiz', compact('quiz'));

    }

    public function attemptQuiz($quizId, $quizSlug)
    {

        $quiz = Quiz::with(['course' => function($q){
            $q->select(['id', 'name']);
        },'questions' => function($q){
            $q->visible()->with(['options']);
        }])->visible()->where('id', $quizId)->get();

        if ($quiz->isEmpty()){
            abort(404);
        }

        $quiz = $quiz->first();

        return view('frontend.pages.quiz-attempt', compact('quiz'));

    }


}
