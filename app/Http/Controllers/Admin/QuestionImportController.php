<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Imports\QuestionsImport;
use App\Quiz;
use Illuminate\Support\Facades\Session;
use Maatwebsite\Excel\Facades\Excel;

class QuestionImportController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function show(Request $request){
        $quiz = Quiz::find($request->quiz);
        return view('admin.questions.import',compact('quiz'));
    }

    public function store(Request $request){
        $request->validate([
        //use this
            'excel'=>'required|mimes:xlsx'
        ]);
        $quiz = Quiz::find($request->quiz);
        if($quiz){
        $file = $request->file('excel');
        Excel::import(new QuestionsImport($quiz->id),$file);
        Session::flash('flash_success', 'Questions added successfully!');
        return redirect()->route('admin.quizzes.index');
        }
        return back()->withErrors('Quiz is required');

    }

}
