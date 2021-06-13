@extends('admin.backend.layouts.master')
@section('title','Edit Quiz')

@section('styles')
<link rel="stylesheet" type="text/css" href="{{ asset('backend/datetime-picker/jquery.datetimepicker.min.css') }}" />
@endsection

@section('content')
<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.quizzes.title_singular') }}
    </div>

    <div class="card-body">
        {!! Form::model($test, ['method' => 'PUT', 'route' => ['admin.quizzes.update', $test->id]]) !!}
        <div class="row">
            <div class="col-md-12 form-group">
                {!! Form::label('course_id', 'Course', ['class' => 'control-label required']) !!}
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
                {!! Form::label('lesson_id', 'Lesson', ['class' => 'control-label']) !!}
                {!! Form::select('lesson_id', $lessons, old('lesson_id'), ['class' => 'form-control select2']) !!}
                <p class="help-block"></p>
                @if($errors->has('lesson_id'))
                <p class="help-block">
                    {{ $errors->first('lesson_id') }}
                </p>
                @endif
            </div>
        </div>
        <div class="form-group" id="quiz_type-container">
            <label for="quiz_type" class="required">Quiz Type: </label>
            <div class="form-group">
                <select class="{{ $errors->has('quiz_type') ? 'is-invalid' : '' }} col-lg-12" name="quiz_type"
                    id="quiz_type" required>
                    <option value="" {{ $test->quiz_type || old('quiz_type') ? 'selected' : '' }}>Select Quiz Type
                    </option>
                    <option value="Mock Test" {{ ($test->quiz_type == "Mock Test"|| old('quiz_type') == "Mock Test") ? 'selected' : '' }}>Mock Test
                    </option>
                    <option value="Practice Quiz" {{ ($test->quiz_type == "Practice Quiz" || old('quiz_type') == "Practice Quiz")? 'selected' : '' }}>
                        Practice
                        Quiz</option>
                    <option value="Normal Quiz" {{ ($test->quiz_type == "Normal Quiz" || old('quiz_type') == "Normal Quiz") ? 'selected' : '' }}>Normal
                        Quiz</option>
                </select>
            </div>
            <div class="help-block"></div>
            @if($errors->has('quiz_type'))
            <p class="help-block">
                {{ $errors->first('quiz_type') }}
            </p>
            @endif
        </div>
        {{-- <div class="row">
            <div class="col-md-12 form-group">
                {!! Form::label('quiz_type', 'Quiz Type', ['class' => 'control-label required']) !!}
                {!! Form::select('quiz_type', [''=>'Select Quiz Type','Mock Test'=>'Mock Test','Practice
                Quiz'=>'Practice Quiz','Normal Quiz'=>'Normal Quiz'],
                old('quiz_type'), ['class' => 'form-control select2']) !!}
                <p class="help-block"></p>
                @if($errors->has('quiz_type'))
                <p class="help-block">
                    {{ $errors->first('quiz_type') }}
        </p>
        @endif
    </div>
</div> --}}
<div class="row">
    <div class="col-md-12 form-group">
        {!! Form::label('title', 'Title', ['class' => 'control-label required']) !!}
        {!! Form::text('title', old('title'), ['class' => 'form-control', 'placeholder' => '']) !!}
        <p class="help-block"></p>
        @if($errors->has('title'))
        <p class="help-block">
            {{ $errors->first('title') }}
        </p>
        @endif
    </div>
</div>
<div class="row">
    <div class="col-md-12 form-group">
        {!! Form::label('description', 'Description', ['class' => 'control-label']) !!}
        {!! Form::textarea('description', old('description'), ['class' => 'form-control ', 'placeholder' => ''])
        !!}
        <p class="help-block"></p>
        @if($errors->has('description'))
        <p class="help-block">
            {{ $errors->first('description') }}
        </p>
        @endif
    </div>
</div>

{{-- <div class="row">
    <div class="col-md-12 form-group">
        {!! Form::label('published', 'Published', ['class' => 'control-label']) !!}
        {!! Form::hidden('published', 0) !!}
        {!! Form::checkbox('published', 1, old('published'), []) !!}
        <p class="help-block"></p>
        @if($errors->has('published'))
        <p class="help-block">
            {{ $errors->first('published') }}
        </p>
        @endif
    </div>
</div> --}}

<div class="row">
    <div class="col-md-12 form-group">
        {!! Form::label('answer_publish', 'Publish Result', ['class' => 'control-label']) !!}
        {!! Form::hidden('answer_publish', 0) !!}
        {!! Form::checkbox('answer_publish', 1, false, ['id'=>'',($test->answer_publish)?'checked':'']) !!}
        <p class="help-block"></p>
        @if($errors->has('answer_publish'))
        <p class="help-block">
            {{ $errors->first('answer_publish') }}
        </p>
        @endif
    </div>
</div>

<div class="form-group" id="answer-view-container">
    <div class="row">
        <label for="answer_view">Solution: </label>
        <div class="form-group col-lg-2">
            <select class="{{ $errors->has('answer_view') ? 'is-invalid' : '' }} col-lg-12"
                {{($test->answer_view != '')?'':'disabled'}} name="answer_view" id="answer_view">
                <option value="" {{ $test->answer_view || old('answer_view') ? 'selected' : '' }}>No Solution
                </option>
                <option value="during_quiz" {{($test->answer_view) || old('answer_view') ? 'selected' : '' }}>
                    During Quiz</option>
                <option value="end_of_quiz" {{ $test->answer_view || old('answer_view') ? 'selected' : '' }}>
                    End of Quiz</option>
            </select>
        </div>
        <div class="form-group">
            <input type="checkbox" name="" id="answer_view_check" {{($test->answer_view)?'checked':''}}> Enable
        </div>
    </div>
    <div class="help-block"></div>
</div>

<div class="form-group row">
    <div class="form-group">
        {!! Form::label('start_at', 'Open the quiz:', ['class' => 'control-label']) !!}
        {!! Form::text('start_at', old('start_at'), ['class' => '', 'placeholder' => 'select opening time' ,
        'id' =>
        'open', 'required', ($test->start_at)?'':'disabled']) !!}
        <p class="help-block"></p>
        @if($errors->has('start_at'))
        <p class="help-block">
            {{ $errors->first('start_at') }}
        </p>
        @endif
    </div>
    <div class="form-group col-lg-1">
        <input type="checkbox" name="" id="start_at" {{($test->start_at)?'checked':''}}> Enable
    </div>
</div>
<div class="form-group row">
    <div class="form-group">
        {!! Form::label('end_at', 'Close the quiz:', ['class' => 'control-label']) !!}
        {!! Form::text('end_at', old('end_at'), ['class' => '', 'placeholder' => 'select closing time' , 'id' =>
        'close', 'required', ($test->end_at)?'':'disabled']) !!}
        <p class="help-block"></p>
        @if($errors->has('end_at'))
        <p class="help-block">
            {{ $errors->first('end_at') }}
        </p>
        @endif
    </div>
    <div class="form-group col-lg-1">
        <input type="checkbox" name="" id="end_at" {{($test->end_at)?'checked':''}}> Enable
    </div>
</div>
<div class="form-group row d-none " id="time-container">
    <div class="col-12 row">
        <label for="time" placeholder="Time Limit">Time Limit: </label>
        <div class="form-group col-lg-2">
            <input class="col-lg-12" type="number" name="time" id="time" value="{{ $test->time }}" required
                {{$test->time?'':'disabled'}}>
        </div>
        <div class="form-group col-lg-2">
            <select class="{{ $errors->has('time_type') ? 'is-invalid' : '' }} col-lg-12" name="time_type"
                id="time_type" required {{$test->time_type?'':'disabled'}}>
                <option value="0" {{ (($test->time_type==0) || old('time_type')) ? 'selected' : '' }}>seconds
                </option>
                <option value="1" {{ (($test->time_type==1) || old('time_type')) ? 'selected' : '' }}>minutes
                </option>
                <option value="2" {{ (($test->time_type==2) || old('time_type')) ? 'selected' : '' }}>hours
                </option>
            </select>
        </div>
        <div class="form-group">
            <input type="checkbox" name="" id="time_limit" {{($test->time)?'checked':''}} value=""> Enable
        </div>
    </div>
    <p class="help-block">
        <small class="text-muted"><i class="fas fa-exclamation"></i>&nbsp;&nbsp;&nbsp;Enable to add time in quiz
            and disable
            to add time per each question</small>
    </p>
</div>
<div class="row d-none" id="attempt-container">
            <div class="col-md-12 form-group">
                {!! Form::label('attempts_no', 'No of attempts', ['class' => 'control-label required']) !!}
                {!! Form::number('attempts_no', old('attempts_no',0),
                ['class' =>
                'form-control', 'placeholder' => '','disabled']) !!}
                <p class="help-block"><small class="form-text text-muted">0 means can attempt multiple times</small></p>
                @if($errors->has('attempts_no'))
                <p class="help-block">
                    {{ $errors->first('attempts_no') }}
                </p>
                @endif

            </div>
        </div>
<div class="row d-none" id="full-mark-container">
    <div class="col-md-12 form-group">
        {!! Form::label('full_marks', 'Total Marks', ['class' => 'control-label']) !!}
        {!! Form::number('full_marks', old('full_marks'), ['class' => 'form-control', 'placeholder' => '']) !!}
        <p class="help-block"></p>
        @if($errors->has('full_marks'))
        <p class="help-block">
            {{ $errors->first('full_marks') }}
        </p>
        @endif
    </div>
</div>
<div class="row d-none" id="pass-mark-container">
    <div class="col-md-12 form-group">
        {!! Form::label('pass_marks', 'Grade to pass', ['class' => 'control-label']) !!}
        {!! Form::number('pass_marks', old('pass_marks'), ['class' => 'form-control', 'placeholder' => '']) !!}
        <p class="help-block"></p>
        @if($errors->has('pass_marks'))
        <p class="help-block">
            {{ $errors->first('pass_marks') }}
        </p>
        @endif
    </div>
</div>
{!! Form::submit(trans('global.update'), ['class' => 'btn btn-success']) !!}
</div>
</div>

{!! Form::close() !!}
@stop

@section('scripts')
<script src="{{ asset('backend/datetime-picker/jquery.datetimepicker.full.min.js')}}"></script>
<script>
    $('#open, #close').datetimepicker({

        });
</script>
<script>
    // $('#start_at').checked()
        // $("#open").removeAttr('disabled');
        $(document).ready(function(){
            // console.log($('#end_at').val());
            $(document).on('change','#quiz_type',function() {
                $('#full-mark-container').addClass('d-none');
                $('#full_marks').attr('disabled');
                $('#pass-mark-container').addClass('d-none');
                $('#pass_marks').attr('disabled');
                $('#time-container').addClass('d-none');
                $('#attempt-container').addClass('d-none');
                $('#attempts_no').attr('disabled');
                switch ($(this).val()) {
                    case 'Mock Test':
                        $('#full-mark-container').removeClass('d-none');
                        $('#full_marks').removeAttr('disabled');
                        $('#pass-mark-container').removeClass('d-none');
                        $('#pass_marks').removeAttr('disabled');
                        $('#time-container').removeClass('d-none');
                        $('#attempts_no').val(1);
                        break;
                    case 'Normal Quiz':
                        $('#full-mark-container').removeClass('d-none');
                        $('#full_marks').removeAttr('disabled');
                        $('#pass-mark-container').removeClass('d-none');
                        $('#pass_marks').removeAttr('disabled');
                        $('#time-container').removeClass('d-none');
                        $('#attempt-container').removeClass('d-none');
                        $('#attempts_no').removeAttr('disabled');
                        break;
                    default:
                        $('#attempts_no').val(0);
                        break;
                }
            });

            $('#start_at'). click(function(){
                if($(this). is(":checked")){
                $("#open").removeAttr('disabled');
                }
                else if($(this). is(":not(:checked)")){
                $("#open").attr('disabled','true');
                }
            });

            $('#end_at'). click(function(){
                if($(this). is(":checked")){
                $("#close").removeAttr('disabled');
                }
                else if($(this). is(":not(:checked)")){
                $("#close").attr('disabled','true');
                }
            });

            $('#time_limit'). click(function(){
                if($(this). is(":checked")){
                $("#time, #time_type").removeAttr('disabled');
                }
                else if($(this). is(":not(:checked)")){
                $("#time, #time_type").attr('disabled','true');
                }
            });

            $('#answer_view_check'). click(function(){
                if($(this). is(":checked")){
                $("#answer_view").removeAttr('disabled');
                }
                else if($(this). is(":not(:checked)")){
                $("#answer_view").attr('disabled','true');
                }
            });
        });
</script>
@endsection
