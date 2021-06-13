<?php

namespace App\Http\Controllers\Admin;

use App\Grade;
use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyGradeRequest;
use App\Http\Requests\StoreGradeRequest;
use App\Http\Requests\UpdateGradeRequest;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class GradesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function index()
    {
        abort_if(Gate::denies('grade-access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        if (request('show_deleted') == 1) {
            abort_if(Gate::denies('grade-delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');
            $grades = Grade::onlyTrashed()->get();
        } else {
            $grades = Grade::all();
        }
        return view('admin.grades.index', compact('grades'));
    }

    public function create()
    {
        abort_if(Gate::denies('grade-create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.grades.create');
    }

    public function store(StoreGradeRequest $request)
    {

        $grade = Grade::create($request->all());

        return redirect()->route('admin.grades.index');
    }

    public function edit(Grade $grade)
    {
        abort_if(Gate::denies('grade-edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.grades.edit', compact('grade'));
    }

    public function update(UpdateGradeRequest $request, Grade $grade)
    {
        $grade->update($request->all());

        return redirect()->route('admin.grades.index');
    }

    public function show(Grade $grade)
    {
        abort_if(Gate::denies('grade-show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.grades.show', compact('grade'));
    }

    public function destroy(Grade $grade)
    {
        abort_if(Gate::denies('grade-delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $grade->delete();

        return back();
    }

    public function massDestroy(MassDestroyGradeRequest $request)
    {
        Grade::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

     /**
     * Restore Course from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function restore($id)
    {
        abort_if(Gate::denies('grade-delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $grade = Grade::onlyTrashed()->findOrFail($id);
        $grade->restore();

        return redirect()->route('admin.grades.index');
    }

    /**
     * Permanently delete grade from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function perma_del($id)
    {
        abort_if(Gate::denies('grade-delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $grade = Grade::onlyTrashed()->findOrFail($id);
        $grade->forceDelete();

        return redirect()->route('admin.grades.index');
    }
}
