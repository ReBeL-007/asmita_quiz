<?php

namespace App\Http\Controllers\Admin;

use App\Course;
use App\Lesson;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreLessonsRequest;
use App\Http\Requests\UpdateLessonsRequest;
use App\Http\Controllers\Traits\FileUploadTrait;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use Symfony\Component\HttpFoundation\Response;
use Spatie\MediaLibrary\Models\Media;

class LessonsController extends Controller
{
    use FileUploadTrait, MediaUploadingTrait;

    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    /**
     * Display a listing of Lesson.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        abort_if(Gate::denies('lesson-access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        // $lessons = Lesson:  :whereIn('course_id', Course::ofTeacher()->pluck('id'));

        if(isset($request->course)){
            $lessons = Course::findOrFail($request->course)->lessons();
        }else{
            $lessons = Lesson::whereHas('course', function ($q) {
                $q->whereIn('course_id', Course::ofTeacher()->pluck('id'));
            });
        }


        if (request('show_deleted') == 1) {
            abort_if(Gate::denies('lesson-access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
            $lessons = $lessons->onlyTrashed()->get();
        } else {
            $lessons = $lessons->get();
        }
        return view('admin.lessons.index', compact('lessons'));
    }

    public function courseLessons(Request $request)
    {
        // dd($id);
        abort_if(Gate::denies('lesson-access'), Response::HTTP_FORBIDDEN, '403 Forbidden');



        // $lessons = Lesson::where('course_id',$id)->with('course')->get();
        // if ($request->input('course_id')) {
        //     $lessons = $lessons->where('course_id', $request->input('course_id'));
        // }
        if(isset($request->quiz)){

        $lessons = Lesson::where('course_id',$id)->whereIn('course_id', Course::ofTeacher()->pluck('id'));
        }else{
            $lessons = Lesson::all();
        }

        if (request('show_deleted') == 1) {
            abort_if(Gate::denies('lesson-access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
            $lessons = $lessons->onlyTrashed()->get();
        } else {
            $lessons = $lessons->get();
        }
        // dd($lessons);

        return view('admin.lessons.index', compact('lessons','id'));
    }

    /**
     * Show the form for creating new Lesson.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        abort_if(Gate::denies('lesson-create'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        if(isset($request->course)){
            $courses = \App\Course::where('id',$request->course)->ofTeacher()->pluck('title', 'id');
        }else{
            $courses = \App\Course::ofTeacher()->get()->pluck('title', 'id');

        }

        return view('admin.lessons.create', compact('courses'));
    }

    /**
     * Store a newly created Lesson in storage.
     *
     * @param  \App\Http\Requests\StoreLessonsRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreLessonsRequest $request)
    {
        abort_if(Gate::denies('lesson-create'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        // $request = $this->saveFiles($request);
        // dd($request->all());
          $data=[
            'title' => $request->title,
            'slug' => str_slug($request->title),
            'course_id' => $request->course_id,
            'short_text' => $request->short_text,
            'full_text' => $request->full_text,
            'published' => $request->published,
        ];

        $lesson = Lesson::create($data
            + ['position' => Lesson::where('course_id', $request->course_id)->max('position') + 1]);


        // foreach ($request->input('downloadable_files_id', []) as $index => $id) {
        //     $model          = config('laravel-medialibrary.media_model');
        //     $file           = $model::find($id);
        //     $file->model_id = $lesson->id;
        //     $file->save();
        // }

        return back()->with('flash_success','Question Created Successfully.');
    }


    /**
     * Show the form for editing Lesson.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        abort_if(Gate::denies('lesson-edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $courses = \App\Course::get()->pluck('title', 'id')->prepend('Please select', '');

        $lesson = Lesson::findOrFail($id);
        // dd($lesson);
        return view('admin.lessons.edit', compact('lesson', 'courses'));
    }

    /**
     * Update Lesson in storage.
     *
     * @param  \App\Http\Requests\UpdateLessonsRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateLessonsRequest $request, $id)
    {
        abort_if(Gate::denies('lesson-edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        // $request = $this->saveFiles($request);
        $lesson = Lesson::findOrFail($id);
        $data=[
            'title' => $request->title,
            'slug' => str_slug($request->title),
            'course_id' => $request->course_id,
            'short_text' => $request->short_text,
            'full_text' => $request->full_text,
            'published' => $request->published,
        ];

        // dd($data);
        // dd($request->input('resource',[]));
        $lesson->update($data);

        // $media = [];
        // foreach ($request->input('downloadable_files_id', []) as $index => $id) {
        //     $model          = config('laravel-medialibrary.media_model');
        //     $file           = $model::find($id);
        //     $file->model_id = $lesson->id;
        //     $file->save();
        //     $media[] = $file;
        // }
        // $lesson->updateMedia($media, 'downloadable_files');

        return redirect()->route('admin.lessons.courseLessons', ['id' => $request->course_id]);
    }


    /**
     * Display Lesson.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        abort_if(Gate::denies('lesson-show'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $courses = \App\Course::get()->pluck('title', 'id')->prepend('Please select', '');
        // $tests = \App\Test::where('lesson_id', $id)->get();
        $tests = '';

        $lesson = Lesson::findOrFail($id);

        return view('admin.lessons.show', compact('lesson'));
    }


    /**
     * Remove Lesson from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        abort_if(Gate::denies('lesson-delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $lesson = Lesson::findOrFail($id);
        $lesson->delete();

        return redirect()->back();
    }

    /**
     * Delete all selected Lesson at once.
     *
     * @param Request $request
     */
    public function massDestroy(Request $request)
    {
        abort_if(Gate::denies('lesson-delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        if ($request->input('ids')) {
            $entries = Lesson::whereIn('id', $request->input('ids'))->get();

            foreach ($entries as $entry) {
                $entry->delete();
            }
        }
    }


    /**
     * Restore Lesson from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function restore($id)
    {
        abort_if(Gate::denies('lesson-delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $lesson = Lesson::onlyTrashed()->findOrFail($id);
        $lesson->restore();

        return redirect()->back('admin.lessons.index');
    }

    /**
     * Permanently delete Lesson from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function perma_del($id)
    {
        abort_if(Gate::denies('lesson-delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $lesson = Lesson::onlyTrashed()->findOrFail($id);
        $lesson->forceDelete();

        return redirect()->back();
    }
}
