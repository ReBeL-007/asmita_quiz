<?php

namespace App\Http\Controllers;

use App\Quiz;
use App\Question;
use App\Attempt;
use App\AttemptAnswer;
use App\AttemptOption;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\Models\Media;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Storage;

class TestController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index($quiz)
    {
        return view('new_quiz',compact('quiz'));
    }

    public function store(Request $request){

        $attemptData=[
            'quiz_id'=>$request->quiz,
            'user_id' => $request->user,
        ];
        $attempt = Attempt::create($attemptData);
    return $attempt;
    }

    public function update(Request $request){
        $attempt_id = $request->attempt;
        $attempt = Attempt::find($attempt_id);
        if(isset($request->answers)){
        foreach ($request->answers as $key => $answer) {
                $attemptAnswerData = [
                    'attempt_id' => $attempt_id,
                    'question_id' => $answer['question_id'],
                ];
                $question = Question::find($answer['question_id']);
                $correct_answer = [];
                foreach ($question->questionOptions()->get() as $key => $option) {

                    if($option->points == 1){
                        array_push($correct_answer,$option->id);
                    }
                }
                if($question->type == "Short Answer"){
                    $attemptAnswerData += ['marks' => 0];
                    $attemptAnswer = AttemptAnswer::create($attemptAnswerData);
                    $attemptOptionData = [
                        'attempt_answer_id' => $attemptAnswer->id,
                        'answer_text' => $answer['options'],
                    ];
                    AttemptOption::create($attemptOptionData);
                }else{
                if(count(array_diff($answer['options'],$correct_answer))==0&&count(array_diff($correct_answer,$answer['options']))==0){
                    $attemptAnswerData += ['marks' => $question->marks];
                }else{
                    $attemptAnswerData += ['marks' =>0];
                }
                $attemptAnswer = AttemptAnswer::create($attemptAnswerData);
                foreach ($answer['options'] as $option) {
                    if($option!=null){
                    $attemptOptionData = [
                        'attempt_answer_id' => $attemptAnswer->id,
                        'option_id' => $option,
                    ];
                    AttemptOption::create($attemptOptionData);
                }
            }
        }
        }
        $attempt_answers = $attempt->attemptAnswers()->get();
        $marks = 0;
        foreach ($attempt_answers as $key => $answer) {
            $marks+= $answer->marks;
        }
        $attempt->total_marks = $marks;
    }
    $attempt->status = 'submitted';
    $attempt->save();
    }

    public function attemptStat($id){
        $attempts = Quiz::findOrFail($id)->attempts()->where('user_id',auth()->user()->id)->where('status','submitted')->get();
        return view('stat',compact('attempts'));
    }

    public function getQuestions($quiz_id)
    {
        $questions = Quiz::where('id', $quiz_id)->with('questions.questionOptions')->first();
        return $questions;
    }

    public function saveImageAsTemp(Request $request)
    {
        foreach ($request->file as $key => $file) {
            $file->storeAs('/public/quiz/temp/'.$request->quiz_id.'/'.$request->user.'/'.$request->question_id, $file->getClientOriginalName());
        }
        return response('success');
    }

    public function getImageFromTemp(Request $request){
        $storedFiles = Storage::allFiles('/public/quiz/temp/'.$request->quiz_id.'/'.$request->user.'/'.$request->question_id);
        $files = [];
        foreach ($storedFiles as $key => $file) {
            array_push($files, array('file'=> $file,
            'url' => str_replace('public','storage',$file) ));
        }
        return $files;
    }

    public function removeImage(Request $request){
        Storage::delete(str_replace('storage','public',$request->file));
        return response('success');
    }

    public function getAttempts(){
        $attempts = Attempt::where('quiz_id','=', 1)->with('quiz','attemptAnswers.attemptOptions.option')->get();
        return view('admin.attempts.index',compact('attempts'));
    }

    public function showAttempts($id){
        $attempts = Attempt::findOrFail($id);
        if(!$attempts->quiz->answer_publish){
            abort(404);
        }
        return view('admin.attempts.show',compact('attempts'));
    }

    public function quizUrl(Request $request,$id){
        $quiz = Quiz::findOrFail($id);
        $attemptsCount = auth()->user()->attempts()->where('quiz_id',$quiz->id)->where('status','submitted')->count();
            if(!($quiz->attempts_no > $attemptsCount || $quiz->attempts_no == 0 )){
                abort(404);
            }
            $now = Carbon::now();
            if($quiz->start_at !=null || $quiz->end_at !=null ){
                if(!($now >= new Carbon($quiz->start_at) && $now <= new Carbon($quiz->end_at))){
                abort(404);
                }
            }
            switch ($quiz->time_type) {
                case 1:
                    $time = $quiz->time*60;
                    break;
                case 2:
                    $time = $quiz->time*60*60;
                    break;
                default:
                    $time = $quiz->time;
                    break;
            }
            if($request->cookie('quiz_url_'.$id.'_'.auth()->user()->id)!=null) {
                return redirect($request->cookie('quiz_url_'.$id.'_'.auth()->user()->id));
            }else{
                $url = URL::signedRoute($name='test',$parameters = ['quiz'=>$id], $expiration = $time);
                return redirect($url)->withCookie('quiz_url_'.$id.'_'.auth()->user()->id,$url,$time/60);
            }
    }

    public function quizResponse($id){
        $attempts = Attempt::findOrFail($id);
        return view('response',compact('attempts'));
    }
}
