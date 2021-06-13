<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Permission;
use Gate;
use Symfony\Component\HttpFoundation\Response;
use App\Http\Requests\StorePermissionRequest;
use App\Http\Requests\UpdatePermissionRequest;
use App\Http\Requests\MassDestroyPermissionRequest;
use Session;

class PermissionsController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:admin');
    }
    //
    public function index()
    {

        abort_if(Gate::denies('permission-access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $permissions = Permission::all();

        return view('admin.backend.permissions.index', compact('permissions'));
    }

    public function create()
    {
        abort_if(Gate::denies('permission-create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.backend.permissions.create');
    }

    public function store(StorePermissionRequest $request)
    {
        // dd($request->all());
        $titles = $request->title;
        foreach($titles as $title){

            $data=[
                'title' => $title,
                'slug' => str_slug($title)
            ];
            // dd($data);
            $permission = Permission::create($data);
        }

        Session::flash('flash_success', 'Permission created successfully!.');
        Session::flash('flash_type', 'alert-success');
        return redirect()->route('admin.permissions.index');

    }

    public function edit(Permission $permission)
    {
        abort_if(Gate::denies('permission-edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.backend.permissions.edit', compact('permission'));
    }

    public function update(UpdatePermissionRequest $request, Permission $permission)
    {
        // dd($request);
        $data=[
            'title' => $request->title,
            'slug' => str_slug($request->title)
        ];
        // dd($data);
        $permission->update($data);

        Session::flash('flash_success', 'Permission updated successfully!.');
        Session::flash('flash_type', 'alert-success');
        return redirect()->route('admin.permissions.index');

    }

    public function show(Permission $permission)
    {
        abort_if(Gate::denies('permission-show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.backend.permissions.show', compact('permission'));
    }

    public function destroy(Permission $permission)
    {
        abort_if(Gate::denies('permission-delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $permission->delete();

        Session::flash('flash_danger', 'Permission has been deleted !.');
        Session::flash('flash_type', 'alert-danger');
        return back();

    }

    public function massDestroy(MassDestroyPermissionRequest $request)
    {
        Permission::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);

    }
}
