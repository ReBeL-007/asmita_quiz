<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Role;
use App\Permission;
use Gate;
use Symfony\Component\HttpFoundation\Response;
use App\Http\Requests\StoreRoleRequest;
use App\Http\Requests\UpdateRoleRequest;
use App\Http\Requests\MassDestroyRoleRequest;
use Session;
use Auth;

class RolesController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth:admin');
    }
    //
    public function index()
    {
       
        abort_if(Gate::denies('role-access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $roles = Role::all();

        return view('admin.backend.roles.index', compact('roles'));
    }

    public function create()
    {
        abort_if(Gate::denies('role-create'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $permissions = Permission::pluck('title', 'id');
        return view('admin.backend.roles.create',compact('permissions'));
    }

    public function store(StoreRoleRequest $request)
    {
        // dd($request->all());
        $data=[
            'title' => $request->title,
            'slug' => str_slug($request->title)
        ];
        // dd($data);
        $role = Role::create($data);
        $role->permissions()->sync($request->input('permissions', []));

        Session::flash('flash_success', 'Role created successfully!.');
        Session::flash('flash_type', 'alert-success');
        return redirect()->route('admin.roles.index');

    }

    public function edit(Role $role)
    {
        abort_if(Gate::denies('role-edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $permissions = Permission::all()->pluck('title', 'id');
        $role->load('permissions');

        return view('admin.backend.roles.edit', compact('role','permissions'));
    }

    public function update(UpdateRoleRequest $request, Role $role)
    {
        // dd($request);
        $data=[
            'title' => $request->title,
            'slug' => str_slug($request->title)
        ];
        // dd($data);
        $role->update($data);
        $role->permissions()->sync($request->input('permissions', []));

        Session::flash('flash_success', 'Role updated successfully!.');
        Session::flash('flash_type', 'alert-success');
        return redirect()->route('admin.roles.index');

    }

    public function show(Role $role)
    {
        abort_if(Gate::denies('role-show'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $role->load('permissions');
        
        return view('admin.backend.roles.show', compact('role'));
    }

    public function destroy(Role $role)
    {
        abort_if(Gate::denies('role-delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $role->delete();

        Session::flash('flash_danger', 'Role has been deleted !.');
        Session::flash('flash_type', 'alert-danger');
        return back();

    }

    public function massDestroy(MassDestroyRoleRequest $request)
    {
        Role::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);

    }
}
