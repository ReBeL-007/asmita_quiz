<?php

namespace App\Http\Controllers\Admin;

use App\Course;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Symfony\Component\HttpFoundation\Response;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCoursesRequest;
use App\Http\Requests\UpdateCoursesRequest;
use App\Http\Controllers\Traits\FileUploadTrait;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use Spatie\MediaLibrary\Models\Media;

class CoursesController extends Controller
{
    use FileUploadTrait, MediaUploadingTrait;

    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    /**
     * Display a listing of Course.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        abort_if(Gate::denies('course-access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        if (request('show_deleted') == 1) {
            abort_if(Gate::denies('course-delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');
            $courses = Course::onlyTrashed()->ofTeacher()->get();
        } else {
            $courses = Course::with('category')->ofTeacher()->get();
        }

        // foreach($courses as $course) {

        //     dd($course->category);
        // }
        return view('admin.courses.index', compact('courses'));
    }

    /**
     * Show the form for creating new Course.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        abort_if(Gate::denies('course-create'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $grades = \App\Grade::all()->pluck('name', 'id')->prepend('Please select a grade...','');;
        $categories = \App\Category::all()->pluck('name', 'id')->prepend('Please select a category...','');
        $teachers = \App\Admin::whereHas('roles', function ($q) { $q->where('role_id', 3); } )->get()->pluck('name', 'id')->prepend('Please select teacher...','');

        return view('admin.courses.create', compact('grades','categories','teachers'));
    }

    /**
     * Store a newly created Course in storage.
     *
     * @param  \App\Http\Requests\StoreCoursesRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCoursesRequest $request)
    {
        abort_if(Gate::denies('course-create'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        // $request = $this->saveFiles($request);
        // dd($request->all());
        $data=[
            'title' => $request->title,
            'description' => $request->description,
            'slug' => str_slug($request->title),
            'category_id' => $request->category_id,
            'grade_id' => $request->grade_id,
        ];
        // dd($data);
        $course = Course::create($data);
        $teachers = \Auth::user()->isAdmin() ? array_filter((array)$request->input('teachers')) : [\Auth::user()->id];
        // dd($teachers);
        // if($teachers) {
            $course->teachers()->sync($teachers);
        // }

        foreach ($request->input('thumbnail', []) as $file) {
            $course->addMedia(storage_path('app/public/tmp/uploads/' . $file))->toMediaCollection('thumbnail');
        }

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $course->id]);
        }

        return redirect()->route('admin.courses.index');
    }


    /**
     * Show the form for editing Course.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        abort_if(Gate::denies('course-edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $categories = \App\Category::all()->pluck('name', 'id')->prepend('Please select a category...','');
        $grades = \App\Grade::all()->pluck('name', 'id')->prepend('Please select a grade...','');
        $teachers = \App\Admin::whereHas('roles', function ($q) { $q->where('role_id', 3); } )->get()->pluck('name', 'id')->prepend('Please select a teacher...','');
        $course = Course::findOrFail($id);
        return view('admin.courses.edit', compact('course','teachers','grades','categories'));
    }

    /**
     * Update Course in storage.
     *
     * @param  \App\Http\Requests\UpdateCoursesRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCoursesRequest $request, $id)
    {
        // dd($request->all());
        abort_if(Gate::denies('course-edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        // $request = $this->saveFiles($request);
        $data=[
            'title' => $request->title,
            'description' => $request->description,
            'slug' => str_slug($request->title),
            'category_id' => $request->category_id,
            'grade_id' => $request->grade_id,
        ];
        $course = Course::findOrFail($id);
        $course->update($data);
        $teachers = \Auth::user()->isAdmin() ? array_filter((array)$request->input('teachers')) : [\Auth::user()->id];
        $course->teachers()->sync($teachers);

        if (count($course->thumbnail) > 0) {
            foreach ($course->thumbnail as $media) {
                if (!in_array($media->file_name, $request->input('thumbnail', []))) {
                    $media->delete();
                }
            }
        }

        $media = $course->thumbnail->pluck('file_name')->toArray();

        foreach ($request->input('thumbnail', []) as $file) {
            if (count($media) === 0 || !in_array($file, $media)) {
                $course->addMedia(storage_path('app/public/tmp/uploads/' . $file))->toMediaCollection('thumbnail');
            }
        }
        return redirect()->route('admin.courses.index');
    }


    /**
     * Display Course.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        abort_if(Gate::denies('course-show'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $teachers = \App\Admin::get()->pluck('name', 'id');
        $lessons = \App\Lesson::where('course_id', $id)->get();
        $tests = \App\Test::where('course_id', $id)->get();

        $course = Course::findOrFail($id);

        return view('admin.courses.show', compact('course', 'lessons', 'tests'));
    }


    /**
     * Remove Course from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        abort_if(Gate::denies('course-delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $course = Course::findOrFail($id);
        $course->delete();

        return redirect()->route('admin.courses.index');
    }

    /**
     * Delete all selected Course at once.
     *
     * @param Request $request
     */
    public function massDestroy(Request $request)
    {
        // dd($request->all());
        abort_if(Gate::denies('course-delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        if ($request->input('ids')) {
            $entries = Course::whereIn('id', $request->input('ids'))->get();

            foreach ($entries as $entry) {
                $entry->delete();
            }
        }
    }


    /**
     * Restore Course from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function restore($id)
    {
        abort_if(Gate::denies('course-delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $course = Course::onlyTrashed()->findOrFail($id);
        $course->restore();

        return redirect()->route('admin.courses.index');
    }

    /**
     * Permanently delete Course from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function perma_del($id)
    {
        abort_if(Gate::denies('course-delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $course = Course::onlyTrashed()->findOrFail($id);
        $course->forceDelete();

        return redirect()->route('admin.courses.index');
    }

    public function getCourseLesson(Course $course){
        return $course->lessons;
    }
}
