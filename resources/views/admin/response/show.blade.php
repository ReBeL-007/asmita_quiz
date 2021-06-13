@extends('layouts.app')

@section('content')
<h3 class="page-title">@lang('cruds.quizzes.title')</h3>

<div class="panel panel-default">
    <div class="panel-heading">
        @lang('global.app_view')
    </div>

    <div class="panel-body">
        <div class="row">
            <div class="col-md-6">
                <table class="table table-bordered table-striped">
                    <tr>
                        <th>{{ trans('cruds.quizzes.fields.title') }}</th>
                        <td>{{ $test->course->title or '' }}</td>
                    </tr>
                    <tr>
                        <th>{{ trans('cruds.quizzes.fields.lesson')}}</th>
                        <td>{{ $test->lesson->title or '' }}</td>
                    </tr>
                    <tr>
                        <th>{{ trans('cruds.quizzes.fields.title')}}</th>
                        <td>{{ $test->title }}</td>
                    </tr>
                    <tr>
                        <th>{{ trans('cruds.quizzes.fields.description')}}</th>
                        <td>{!! $test->description !!}</td>
                    </tr>
                    <tr>
                        <th>{{ trans('cruds.quizzes.fields.questions')}}</th>
                        <td>
                            @foreach ($test->questions as $singleQuestions)
                            <span class="label label-info label-many">{{ $singleQuestions->question }}</span>
                            @endforeach
                        </td>
                    </tr>
                    <tr>
                        <th>{{ trans('cruds.quizzes.fields.published')}}</th>
                        <td>{{ Form::checkbox("published", 1, $test->published == 1 ? true : false, ["disabled"]) }}
                        </td>
                    </tr>
                </table>
            </div>
        </div>

        <p>&nbsp;</p>

        <a href="{{ route('admin.quizzes.index') }}" class="btn btn-default">@lang('global.app_back_to_list')</a>
    </div>
</div>
@stop
