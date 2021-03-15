<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Question;
use App\QuestionOption;
use App\Quiz;
use App\TempMedia;
use Illuminate\Http\Request;

class OptionsController extends Controller
{
    public function index(Request $request, $quizId, $questionId)
    {
        $items = Question::with(['options'])->where('id', $questionId)->get();
        if ($items->isEmpty())
            return redirect('admin/quizzes')->with('flash_message', 'Invalid Quiz!');

        $items = $items->first();
        return view('admin.options.index', compact('items', 'quizId'));
    }

    public function create($quizId, $questionId)
    {
        $question = Question::findOrFail($questionId);
        return view('admin.options.create', compact('question'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'question_id' => 'required',
            'correct' => 'required',
        ]);


        $question = QuestionOption::create($request->except('image'));

        if ($request->image){
            $tempFile = TempMedia::where('folder', $request->image)->get();
            if ($tempFile->isNotEmpty()){
                $filePath = storage_path("app/temp/".$tempFile->first()->folder.'/'.$tempFile->first()->filename);
                $fileCoptyToDir = 'images/questions/'.$question->id.'/options';
                if (!is_dir($fileCoptyToDir))
                    mkdir($fileCoptyToDir,0777, true);
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

        return redirect('admin/quizzes/'.$request->quiz_id.'/questions/'.$request->question_id.'/options')->with('flash_message', 'New Option added to Question!');
    }


    public function destroy($quizId, $questionId, $optionId)
    {
        try {
            QuestionOption::destroy($optionId);
        }catch (\Exception $exception){
            return redirect()->back()->with('flash_message', 'Something went wrong! Student may have selected this option on a quiz');
        }

        return redirect('admin/quizzes/'.$quizId.'/questions/'.$questionId.'/options')->with('flash_message', 'Option is deleted from that questions!');
    }
}
