@extends('admin.backend.layouts.master')

@section('content')
<h3 class="page-title">@lang('cruds.lessons.title')</h3>

<div class="panel panel-default">
    <div class="panel-heading">
        @lang('global.view')
    </div>

    <div class="panel-body">
        <div class="row">
            <div class="col-md-6">
                <table class="table table-bordered table-striped">
                    <tr>
                        <th>@lang('cruds.lessons.fields.course')</th>
                        <td>{{ $lesson->course->title or '' }}</td>
                    </tr>
                    <tr>
                        <th>@lang('cruds.lessons.fields.title')</th>
                        <td>{{ $lesson->title }}</td>
                    </tr>
                    <tr>
                        <th>@lang('cruds.lessons.fields.slug')</th>
                        <td>{{ $lesson->slug }}</td>
                    </tr>
                    <tr>
                        <th>@lang('cruds.lessons.fields.short-text')</th>
                        <td>{!! $lesson->short_text !!}</td>
                    </tr>
                </table>
            </div>
        </div><!-- Nav tabs -->

        <p>&nbsp;</p>

        <a href="{{ route('admin.lessons.index') }}" class="btn btn-default">@lang('global.back_to_list')</a>
    </div>
</div>
@stop
