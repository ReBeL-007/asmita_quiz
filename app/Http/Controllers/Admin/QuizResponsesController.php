<?php

namespace App\Http\Controllers\Admin;

use App\Attempt;
use App\AttemptAnswer;
use App\Exports\QuizAttemptsExport;
use App\Http\Controllers\Controller;
use App\Quiz;
use Gate;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class QuizResponsesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function index(Request $request)
    {
        abort_if(Gate::denies('response-access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
            $quizzes = Quiz::ofTeacher()->get();
        return view('admin.response.index', compact('quizzes'));
    }

    /**
     * Show the form for creating new Test.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        abort_if(Gate::denies('quiz-create'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $courses = \App\Course::ofTeacher()->get();
        $courses_ids = $courses->pluck('id');
        $courses = $courses->pluck('title', 'id')->prepend('Please select Course', '');
        $lessons = ['Please select Course First'=> ''];
        return view('admin.response.create', compact('courses', 'lessons'));
    }

    /**
     * Store a newly created Test in storage.
     *
     * @param  \App\Http\Requests\StoreTestsRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreTestsRequest $request)
    {
        abort_if(Gate::denies('quiz-create'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $quiz = Quiz::create($request->all());
        $teachers = \Auth::user()->isAdmin() ? array_filter((array)$request->input('teachers')) : [\Auth::user()->id];
        $quiz->teachers()->sync($teachers);
        $quiz->remaining_marks = $quiz->full_marks;
        $quiz->save();
        $users = User::all();
        $admins = Admin::all();
        Notification::send($users,new QuizNotification($quiz,route('quiz_index')));
        Notification::send($admins,new QuizNotification($quiz,route('admin.response.index')));
        return redirect()->route('admin.response.index');
    }


    /**
     * Show the form for editing Test.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        abort_if(Gate::denies('quiz-edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $courses = \App\Course::get();
        $courses_ids = $courses->pluck('id');
        $courses = $courses->pluck('title', 'id')->prepend('Please select course', '');
        $lessons = \App\Lesson::whereIn('course_id', $courses_ids)->get()->pluck('title', 'id')->prepend('Please select lesson', '');
        $test = Quiz::findOrFail($id);

        return view('admin.response.edit', compact('test', 'courses', 'lessons'));
    }

    /**
     * Update Test in storage.
     *
     * @param  \App\Http\Requests\UpdateTestsRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateTestsRequest $request, $id)
    {
        abort_if(Gate::denies('quiz-edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $quiz = Quiz::findOrFail($id);
        if (!isset($request->start_at)) {
            $request->request->add(['start_at' => null]);
        }
        if (!isset($request->end_at)) {
            $request->request->add(['end_at' => null]);
        }
        if (!isset($request->time)) {
            $request->request->add(['time' => null, 'time_type' => null]);
        }
        $quiz->update($request->all());
        return redirect()->route('admin.response.index');
    }


    /**
     * Display Test.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        abort_if(Gate::denies('quiz-show'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $test = Quiz::findOrFail($id);

        return view('admin.response.show', compact('test'));
    }


    /**
     * Remove Test from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        abort_if(Gate::denies('quiz-delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $test = Quiz::findOrFail($id);
        $test->delete();

        return redirect()->route('admin.response.index');
    }

    /**
     * Delete all selected Test at once.
     *
     * @param Request $request
     */
    public function massDestroy(Request $request)
    {
        abort_if(Gate::denies('quiz-delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        if ($request->input('ids')) {
            $entries = Quiz::whereIn('id', $request->input('ids'))->get();

            foreach ($entries as $entry) {
                $entry->delete();
            }
        }
    }


    /**
     * Restore Test from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function restore($id)
    {
        abort_if(Gate::denies('quiz-delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $test = Quiz::onlyTrashed()->findOrFail($id);
        $test->restore();

        return redirect()->route('admin.quizzes.index');
    }

    /**
     * Permanently delete Test from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function perma_del($id)
    {
        abort_if(Gate::denies('quiz-delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $test = Quiz::onlyTrashed()->findOrFail($id);
        $test->forceDelete();

        return redirect()->route('admin.quizzes.index');
    }

    public function response($id)
    {
        $quiz = Quiz::findOrFail($id);
        return view('admin.quizzes.response', compact('quiz'));
    }

    public function listResponse($id)
    {
        $quiz = Quiz::findOrFail($id);
        return view('admin.response.listResponse', compact('quiz'));
    }

    public function editAttempts($id)
    {
        $attempts = Attempt::where('quiz_id', '=', $id)->with('quiz', 'user', 'quiz.questions.questionOptions', 'attemptAnswers.attemptOptions')->where('status','submitted')->get()->toJSON();
        return view('admin.attempts.edit', compact('id'));
    }

    public function getQuizAttempts(Request $request)
    {
        $id = $request->id;
        $attempts = Attempt::where('quiz_id', '=', $id)->where('status','submitted')->with('quiz', 'user', 'quiz.questions.questionOptions', 'attemptAnswers.attemptOptions')->get()->toJSON();
        return $attempts;
    }

    public function getListAttempt()
    {
        $attempts = Attempt::where('status','submitted');
        return view('admin.attempts.list', compact('attempts'));
    }

    public function updateAttempt(Request $request)
    {
        $attempt = Attempt::find($request->attempt_id);
        dd($attempt);
        if ($request->feedback != null) {
            $attempt->feedback = $request->feedback;
        } else {
            $attempt->feedback = '';
        }
        $attempt->save();
    }

    public function updateAnswer(Request $request)
    {
        $attempt_answer = AttemptAnswer::find($request->answer_id);
        if ($request->feedback != null) {
            if ($request->feedback == '[[[clear]]]') {
                $attempt_answer->feedback = '';
                $attempt_answer->save();
            } else {
                $attempt_answer->feedback = $request->feedback;
                $attempt_answer->save();
            }
        }

        if ($request->marks != null) {
            $attempt_answer->marks = $request->marks;
            $attempt_answer->save();
        }
    }

    public function export($id)
    {
        $quiz = Quiz::findOrFail($this->id);
        return Excel::download(new QuizAttemptsExport($id), $quiz->title.'.xlsx');
    }
}
