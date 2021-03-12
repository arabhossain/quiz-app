<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Question;
use App\Quiz;
use App\TempMedia;
use Illuminate\Http\Request;

class QuestionsController extends Controller
{
    public function index(Request $request, $quizId)
    {
        $items = Quiz::with(['course', 'questions'])->where('id', $quizId)->get();
        if ($items->isEmpty())
            return redirect('admin/quizzes')->with('flash_message', 'Invalid Quiz!');

        $items = $items->first();
        return view('admin.questions.index', compact('items'));
    }

    public function create($quizId)
    {
        $quiz = Quiz::findOrFail($quizId);
        return view('admin.questions.create', compact('quiz'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'question' => 'required',
            'quiz_id' => 'required',
            'point' => 'required',
            'answer_type' => 'required',
            'visible' => 'required',
        ]);

        $question = Question::create( $request->except('image'));

        if ($request->image){
            $tempFile = TempMedia::where('folder', $request->image)->get();
            if ($tempFile->isNotEmpty()){
                $filePath = storage_path("app/temp/".$tempFile->first()->folder.'/'.$tempFile->first()->filename);
                $fileCoptyToDir = 'images/questions/'.$question->id;

                if (!is_dir($fileCoptyToDir))
                    mkdir($fileCoptyToDir,0777);

                $fileCopyTo = $fileCoptyToDir.'/'.$tempFile->first()->filename;
                copy($filePath, public_path($fileCopyTo));
                $question->update(['image' => $fileCopyTo]);

                if (file_exists($filePath)) {
                    unlink($filePath);
                    rmdir(storage_path("app/temp/" . $tempFile->first()->folder));
                }

                $tempFile->first()->delete();
            }
        }

        return redirect('admin/quizzes/'.$request->quiz_id.'/questions')->with('flash_message', 'New Question Added To The Quiz!');
    }

    public function show($id)
    {
        $item = Question::where('id', $id)->with(['quiz'])->withCount(['options'])->get()->first();

        return view('admin.questions.show', compact('item'));
    }

    public function edit($id)
    {
        $item = Question::findOrFail($id);
        return view('admin.questions.edit', compact('item'));
    }

    public function update(Request $request, $id)
    {
        $item = Question::findOrFail($id);
        $item->update($request->except('image'));

        if ($request->image){

            //delete the old one
            if ($item->image && file_exists(public_path($item->image)))
                unlink(public_path($item->image));

            $tempFile = TempMedia::where('folder', $request->image)->get();
            if ($tempFile->isNotEmpty()){
                $filePath = storage_path("app/temp/".$tempFile->first()->folder.'/'.$tempFile->first()->filename);
                $fileCoptyToDir = 'images/questions/'.$item->id;

                if (!is_dir($fileCoptyToDir))
                    mkdir($fileCoptyToDir,0777);

                $fileCopyTo = $fileCoptyToDir.'/'.$tempFile->first()->filename;
                copy($filePath, public_path($fileCopyTo));
                $item->update(['image' => $fileCopyTo]);

                if (file_exists($filePath)) {
                    unlink($filePath);
                    rmdir(storage_path("app/temp/" . $tempFile->first()->folder));
                }

                $tempFile->first()->delete();
            }
        }
        return redirect('admin/quizzes/'.$item->quiz_id.'/questions/'.$item->id)->with('flash_message', 'Question has been updated!');
    }

    public function destroy($quizId, $questionId)
    {
        try {
            Question::destroy($questionId);
        }catch (\Exception $exception){
            return redirect()->back()->with('flash_message', 'Question can not be delete until it has options!');
        }

        return redirect('admin/quizzes/'.$quizId.'/questions')->with('flash_message', 'Question is deleted!');
    }
}
