<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Gate;
use Symfony\Component\HttpFoundation\Response;
use App\User;
use App\Role;
use App\Http\Requests\StoreStudentRequest;
use App\Http\Requests\UpdateStudentRequest;
use App\Http\Requests\MassDestroyStudentRequest;
use Session;

class StudentsController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth:admin');
    }
    //
    public function index()
    {
       
        abort_if(Gate::denies('student-access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $students = User::get();
        // dd($students);
        return view('admin.students.index', compact('students'));
    }

    public function create()
    {
        abort_if(Gate::denies('student-create'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        return view('admin.students.create');
    }

    public function store(StoreStudentRequest $request)
    {
        $data=[
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'contact' => $request->contact,
            'address' => $request->address,
            'school' => $request->school,
            'passed' => $request->passed,
        ];
        $user = User::create($data);
        // $student->roles()->sync($request->input('roles', []));

        Session::flash('flash_success', 'Student created successfully!.');
        Session::flash('flash_type', 'alert-success');
        return redirect()->route('admin.students.index');

    }

    public function edit(User $student)
    {
        abort_if(Gate::denies('student-edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        
        return view('admin.students.edit', compact('student'));
    }

    public function update(UpdateStudentRequest $request, User $student)
    {
        $data=[
            'name' => $request->name,
            'email' => $request->email,
            'contact' => $request->contact,
            'address' => $request->address,
            'school' => $request->school,
            'passed' => $request->passed,
        ];
        if($request->password) {
            // if($request->password !== $student->password){
                $data['password'] = bcrypt($request->password);
            // }
        }
        $student->update($data);

        Session::flash('flash_success', 'Student updated successfully!.');
        Session::flash('flash_type', 'alert-success');
        return redirect()->route('admin.students.index');

    }

    public function show(Admin $user)
    {
        abort_if(Gate::denies('student-show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.students.show', compact('user'));
    }

    public function destroy(User $student)
    {
        abort_if(Gate::denies('student-delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $student->delete();

        Session::flash('flash_danger', 'Student has been deleted !.');
        Session::flash('flash_type', 'alert-danger');
        return back();

    }

    public function massDestroy(MassDestroyStudentRequest $request)
    {
        // dd($request);
        User::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);

    }
}
