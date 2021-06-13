@extends('admin.backend.layouts.master')
@section('title','Add Lessons')

@section('content')
<div class="card">
    <div class="card-header">
        {{ trans('global.add') }} {{ trans('cruds.lessons.title_singular') }}
    </div>

    <div class="card-body">
        {!! Form::open(['method' => 'POST', 'route' => ['admin.lessons.store'], 'files' => true,]) !!}
        <div class="row">
            <div class="col-md-12 form-group">
                {!! Form::label('course_id', 'Course', ['class' => 'control-label row required']) !!}
                {!! Form::select('course_id', $courses, old('course_id'), ['class' => 'form-control select2']) !!}
                <p class="help-block"></p>
                @if($errors->has('course_id'))
                <p class="help-block">
                    {{ $errors->first('course_id') }}
                </p>
                @endif
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 form-group">
                {!! Form::label('title', 'Title', ['class' => 'control-label required']) !!}
                {!! Form::text('title', old('title'), ['class' => 'form-control', 'placeholder' => '', 'required' =>
                '']) !!}
                <p class="help-block"></p>
                @if($errors->has('title'))
                <p class="help-block">
                    {{ $errors->first('title') }}
                </p>
                @endif
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 form-group editor-container">
                {!! Form::label('short_text', 'Description', ['class' => 'editor-label']) !!}
                {!! Form::textarea('short_text', old('short_text'), ['class' => 'form-control ', 'placeholder' => '',
                'rows' => '5']) !!}
                <p class="help-block"></p>
                @if($errors->has('short_text'))
                <p class="help-block">
                    {{ $errors->first('short_text') }}
                </p>
                @endif
            </div>
        </div>

        {!! Form::submit(trans('global.add'), ['class' => 'btn btn-success']) !!}
    </div>
</div>

{!! Form::close() !!}
@stop

