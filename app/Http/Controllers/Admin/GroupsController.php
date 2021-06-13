<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Group;
use App\Permission;
use Gate;
use Symfony\Component\HttpFoundation\Response;
use App\Http\Requests\StoreGroupRequest;
use App\Http\Requests\UpdateGroupRequest;
use App\Http\Requests\MassDestroyGroupRequest;
use Session;

class GroupsController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth:admin');
    }
    //
    public function index()
    {
       
        abort_if(Gate::denies('group-access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $groups = Group::all();

        return view('admin.backend.groups.index', compact('groups'));
    }

    public function create()
    {
        abort_if(Gate::denies('group-create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.backend.groups.create');
    }

    public function store(StoreGroupRequest $request)
    {
        // dd($request->all());
        $data=[
            'title' => $request->title,
            'slug' => str_slug($request->title),
            'description' => $request->description,
        ];
        // dd($data);
        $group = Group::create($data);

        Session::flash('flash_success', 'group created successfully!.');
        Session::flash('flash_type', 'alert-success');
        return redirect()->route('admin.groups.index');

    }

    public function edit(Group $group)
    {
        abort_if(Gate::denies('group-edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $group->load('admins');

        return view('admin.backend.groups.edit', compact('group'));
    }

    public function update(UpdateGroupRequest $request, Group $group)
    {
        // dd($request);
        $data=[
            'title' => $request->title,
            'slug' => str_slug($request->title),
            'description' => $request->description,
        ];
        // dd($data);
        $group->update($data);

        Session::flash('flash_success', 'group updated successfully!.');
        Session::flash('flash_type', 'alert-success');
        return redirect()->route('admin.groups.index');

    }

    public function show(Group $group)
    {
        abort_if(Gate::denies('group-show'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $group->load('admins');
        
        return view('admin.backend.groups.show', compact('group'));
    }

    public function destroy(Group $group)
    {
        abort_if(Gate::denies('group-delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $group->delete();

        Session::flash('flash_danger', 'group has been deleted !.');
        Session::flash('flash_type', 'alert-danger');
        return back();

    }

    public function massDestroy(MassDestroyGroupRequest $request)
    {
        Group::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);

    }
}
