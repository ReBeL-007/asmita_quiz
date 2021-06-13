<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Attempt;
use App\Contact;
use App\Category;
use App\Course;
use App\Lesson;
use App\Quiz;
use Auth;
use Carbon\Carbon;
use Session;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth')->except('contactUs');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $now = Carbon::now();
        $quizzes = Quiz::all();
        $attempted_quizzes = [];
        $upcoming_tests = [];
        $quiz_for_leaderboard = [];
        foreach ($quizzes as $key => $quiz) {
            if($quiz->start_at != null){
                $start_date = new Carbon($quiz->start_at);
                $remaining_days = $start_date->diffInSeconds($now,false);
                if($remaining_days<0 && $quiz->start_at !=null){
                    array_push($upcoming_tests,$quiz);
                    $quizzes = $quizzes->forget($key);
                    continue;
                }
                if(!($now >= new Carbon($quiz->start_at) && $now <= new Carbon($quiz->end_at))){
                    array_push($attempted_quizzes,$quiz);
                    array_push($quiz_for_leaderboard,$quiz);
                    $quizzes = $quizzes->forget($key);
                }
            }
            array_push($quiz_for_leaderboard,$quiz);
            $attemptsCount = auth()->user()->attempts()->where('quiz_id',$quiz->id)->count();
            if(!($quiz->attempts_no > $attemptsCount || $quiz->attempts_no == 0 )){
                array_push($attempted_quizzes,$quiz);
                $quizzes = $quizzes->forget($key);
            }
        }
        $attempts = Attempt::orderBy('total_marks','DESC')->take(5)->get();
        return view('home',compact('upcoming_tests','quizzes','attempts','quiz_for_leaderboard'));
    }

    public function get_notifications(){
        return Auth::user()->unreadNotifications;
    }

    public function show_notifications($id){
        $notification = Auth::user()->notifications()->where('id', $id)->first();
        if ($notification) {
            $notification->markAsRead();
            return redirect($notification->data['url']);
        }
    }

    public function read_all_notifications()
    {
        Auth::user()->unreadNotifications()->get()->map(function($n) {
            $n->markAsRead();
        });
        return back();
    }

    public function courses()
    {
        $categories = Category::pluck('name','id');
        return view('student.courses.index',compact('categories'));
    }

    public function courseDetail(Course $course)
    {
        return view('student.courses.courseDetail',compact('course'));
    }

    public function getLesson(Lesson $lesson){
        return $lesson;
    }

    public function getspecificCourses(Request $request) {
        return Course::where('category_id',$request->category_id)->with('teachers')->get();
    }

    public function contactUs(Request $request)
    {
        $data = $this->validate($request,[
                    'fname' => 'required',
                    'lname' => 'required',
                    'email' => 'required',
                    'contact' => 'required',
                    'message' => 'required',
                ]);
        Contact::create($data);
        Session::flash('flash_success', 'Thank you for leaving message!');
        Session::flash('flash_type', 'alert-success');
        return redirect()->back();
    }

    public function get_attempt_top($quiz)
    {
        $quiz = Quiz::findorfail($quiz);
        $attempts = $quiz->attempts()->with('user')->where('status','submitted')->orderBy('total_marks','DESC')->get();
        $filter_attempt = collect();
        foreach ($attempts as $key=>$attempt) {
            if(!$filter_attempt->contains('user_id',$attempt->user_id)){
                $filter_attempt->push($attempt);
            }
            if($key>4){
                break;
            }
        }
        return $filter_attempt;
    }
}
