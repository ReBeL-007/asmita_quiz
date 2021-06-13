<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Gate;
use Symfony\Component\HttpFoundation\Response;
use App\Admin;
use App\Role;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Http\Requests\MassDestroyUserRequest;
use Session;

class UsersController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth:admin');
    }
    //
    public function index()
    {

        abort_if(Gate::denies('user-access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $users = Admin::with('roles')->get();

        return view('admin.backend.users.index', compact('users'));
    }

    public function create()
    {
        abort_if(Gate::denies('user-create'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $roles = Role::all()->pluck('title', 'id');
        return view('admin.backend.users.create', compact('roles'));
    }

    public function store(StoreUserRequest $request)
    {
        // dd($request->all());
        $data=[
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password)
        ];
        // dd($data);
        $user = Admin::create($data);
        $user->roles()->sync($request->input('roles', []));

        Session::flash('flash_success', 'User created successfully!.');
        Session::flash('flash_type', 'alert-success');
        return redirect()->route('admin.users.index');

    }

    public function edit(Admin $user)
    {
        abort_if(Gate::denies('user-edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $user->load('roles');
        // dd($user);
        $roles = Role::all()->pluck('title', 'id');

        return view('admin.backend.users.edit', compact('user','roles'));
    }

    public function update(UpdateUserRequest $request, Admin $user)
    {
        // dd($request);
        $data=[
            'name' => $request->name,
            'email' => $request->email,
        ];
        if($request->password) {
            if($request->password !== $user->password){
                $data['password'] = bcrypt($request->password);
            }
        }
        // dd($data);
        $user->update($data);
        $user->roles()->sync($request->input('roles', []));

        Session::flash('flash_success', 'User updated successfully!.');
        Session::flash('flash_type', 'alert-success');
        return redirect()->route('admin.users.index');

    }

    public function show(Admin $user)
    {
        abort_if(Gate::denies('user-show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.backend.users.show', compact('user'));
    }

    public function destroy(Admin $user)
    {
        abort_if(Gate::denies('user-delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $user->delete();

        Session::flash('flash_danger', 'User has been deleted !.');
        Session::flash('flash_type', 'alert-danger');
        return back();

    }

    public function massDestroy(MassDestroyUserRequest $request)
    {
        // dd($request);
        Admin::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);

    }

}
