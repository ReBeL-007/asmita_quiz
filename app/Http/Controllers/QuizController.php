<?php

namespace App\Http\Controllers;

use App\Quiz;
use Illuminate\Http\Request;
use Carbon\Carbon;

class QuizController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $now = Carbon::now();
        $quizzes = Quiz::all();
        $attempted_quizzes = [];
        $upcoming_quizzes = [];
        foreach ($quizzes as $key => $quiz) {
            if($quiz->published){
                $quizzes = $quizzes->forget($key);
            }
            if($quiz->start_at != null){
                $start_date = new Carbon($quiz->start_at);
                $remaining_days = $start_date->diffInSeconds($now,false);
                if($remaining_days<0 && $quiz->start_at !=null){
                    array_push($upcoming_quizzes,$quiz);
                    $quizzes = $quizzes->forget($key);
                    continue;
                }
                if(!($now >= new Carbon($quiz->start_at) && $now <= new Carbon($quiz->end_at))){
                    array_push($attempted_quizzes,$quiz);
                    $quizzes = $quizzes->forget($key);
                }
            }
            $attemptsCount = auth()->user()->attempts()->where('quiz_id',$quiz->id)->count();
            if(!($quiz->attempts_no > $attemptsCount || $quiz->attempts_no == 0 )){
                array_push($attempted_quizzes,$quiz);
                $quizzes = $quizzes->forget($key);
            }
        }
        return view('student.quiz.index',compact('quizzes','attempted_quizzes','upcoming_quizzes'));
    }

}

