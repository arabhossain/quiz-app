<?php

namespace App\Http\Controllers\Admin;

use App\Course;
use App\Http\Controllers\Controller;
use App\Question;
use App\Quiz;
use Illuminate\Http\Request;

class QuizzesController extends Controller
{
    public function index(Request $request)
    {
        $keyword = $request->get('search');
        $perPage = 25;

        if (!empty($keyword)) {
            $items = Quiz::where('title', 'LIKE', "%$keyword%")
                ->orWhereHas('course', function ($query) use ($keyword) {
                    $query->where('name', 'like', "%$keyword%");
                })->with(['course'])->withCount(['questions'])
                ->latest()->paginate($perPage);
        } else {
            $items = Quiz::with(['course'])->withCount(['questions'])->latest()->paginate($perPage);
        }

        return view('admin.quizzes.index', compact('items'));
    }

    public function create()
    {
        $courses = Course::pluck('name', 'id');
        return view('admin.quizzes.create', compact('courses'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required',
            'course_id' => 'required',
            'visible' => 'required',
            'private' => 'required',
            'negative_point' => 'required',
        ]);

        $requestData = $request->all();

        $quiz = Quiz::create($requestData);

        return redirect('admin/quizzes/' . $quiz->id)->with('flash_message', 'New Quiz Added!');
    }

    public function show($id)
    {
        $item = Quiz::where('id', $id)->with(['course', 'questions'])->get()->first();

        return view('admin.quizzes.show', compact('item'));
    }

    public function edit($id)
    {
        $item = Quiz::findOrFail($id);
        $courses = Course::pluck('name', 'id');
        return view('admin.quizzes.edit', compact('item', 'courses'));
    }

    public function update(Request $request, $id)
    {
        $item = Quiz::findOrFail($id);
        $item->update($request->all());
        return redirect('admin/quizzes/' . $item->id)->with('flash_message', 'Quiz has been updated!');
    }

    public function destroy($id)
    {
        try {
            Quiz::destroy($id);
        }catch (\Exception $exception){
            return redirect()->back()->with('flash_message', 'Quiz can not be delete until it has questions!');
        }
        return redirect('admin/quizzes')->with('flash_message', 'Quiz is deleted!');
    }
}
