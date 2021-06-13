@extends('admin.backend.layouts.master')
@section('title','Edit Question')


@section('styles')
<!-- iCheck for checkboxes and radio inputs -->
<link rel="stylesheet" href="{{ asset('css/bootstrap/plugins/icheck-bootstrap/icheck-bootstrap.min.css')}}">
<link rel="stylesheet" href="{{ asset('css/admin/addQuizform.css') }}">
@endsection

@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.question.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.questions.update", [$question->id]) }}"
            enctype="multipart/form-data">
            @method('PUT')
            @csrf

            <div class="field-wrapper">
                <label for="quiz_id" placeholder="Please select a quiz">Please select a quiz</label>
                <select class="{{ $errors->has('quiz_id') ? 'is-invalid' : '' }}" name="quiz_id" id="quiz_id" required>
                    @foreach($quizzes as $id => $quiz)
                    <option value="{{ $id }}" @foreach($question->quizzes as
                        $q){{ ($q->title ? $q->id : old('quiz_id')) == $id ? 'selected' : '' }}@endforeach>{{ $quiz }}
                    </option>
                    @endforeach
                </select>
                @if($errors->has('quiz_id'))
                <div class="invalid-feedback">
                    {{ $errors->first('quiz_id') }}
                </div>
                @endif
                <span class="help-block">{{ trans('cruds.question.fields.quiz_helper') }}</span>
            </div>
            <div class="field-wrapper">
                <label for="type" placeholder="Please select a type">Please select a type</label>
                <select class="{{ $errors->has('type') ? 'is-invalid' : '' }}" name="type" id="type" required>
                    <option value="Multiple Choices" {{$question->type == 'Multiple Choices' ? 'selected' : '' }}>
                        Multiple Choices</option>
                    <option value="Multiple Answers" {{$question->type == 'Multiple Answers' ? 'selected' : '' }}>
                        Multiple Answers</option>
                    <option value="True or False" {{($question->type == 'True or False') ? 'selected' : '' }}>True or
                        False </option>
                    <option value="Short Answer" {{$question->type == 'Short Answer' ? 'selected' : '' }}>Short Answer
                    </option>
                    {{-- <option value="Long Answer" {{$question->type == 'Long Answer' ? 'selected' : '' }}>Long Answer
                    </option> --}}
                </select>
                @if($errors->has('type'))
                <div class="invalid-feedback">
                    {{ $errors->first('type') }}
                </div>
                @endif
                {{-- <span class="help-block">{{ trans('cruds.question.fields.type_helper') }}</span> --}}
            </div>
            <br>
            <div class="form-group editor-container" id="quest">
                <label for="question-text" class="editor-label"> Write Question</label>
                <textarea class="d-none" name="question_text"
                    required>{{ $question->question_text , old('question_text') }}</textarea>
                <div class="editor {{ $errors->has('question_text') ? 'is-invalid' : '' }}" id="question_text">
                </div>
                @if($errors->has('question_text'))
                <div class="invalid-feedback">
                    {{ $errors->first('question_text') }}
                </div>
                @endif
                <span class="help-block">{{ trans('cruds.question.fields.question_text_helper') }}</span>
            </div>


            @if($question->type == 'Multiple Choices')

            <div class="mcq" id="mcq">
                @foreach($question->questionOptions as $key=>$options)
                <div class="col-md-12 row option-pad">
                    <div class="icheck-success">
                        <input type="radio" name="points" id="option{{ $key+1 }}" value="{{ $key+1 }}"
                            {{ (($options->points==1) ? 'checked' : '' )}}>
                        <label for="option{{ $key+1 }}">
                        </label>
                    </div>
                    <div class="col-md-8 option-container">
                        <label for="question-text" class="editor-label">Option {{$key+1}}</label>
                        <textarea class="d-none"
                            name="option_text[]">{{ $options->option_text , old('option_text[]') }}</textarea>
                        <div class="option-editor {{ $errors->has('option_text') ? 'is-invalid' : '' }}"
                            id="option_text_{{$key+1}}">
                        </div>
                    </div>
                    @if($errors->has('option_text'))
                    <div class="invalid-feedback">
                        {{ $errors->first('option_text') }}
                    </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.option.fields.option_text_helper') }}</span>
                </div>
                @endforeach
            </div>
            <div class="form-group add_mcq_option" id="add_mcq_option">
                <input type="button" class="btn btn-default" id="add" value="Add more option">
            </div>

            {{-- multi answers --}}
            @elseif($question->type == 'Multiple Answers')
            <div class="maq" id="maq">
                <div class="col-md-12 row">
                    @foreach($question->questionOptions as $key=>$options)
                    <div class="col-md-12 row option-pad">
                        <div class="icheck-success">
                            <input type="checkbox" name="maq_points[]" id="checkbox{{ $key+1 }}" value="{{ $key+1 }}"
                                {{ (($options->points==1) ? 'checked' : '' )}}>
                            <label for="checkbox{{ $key+1 }}">
                            </label>
                        </div>
                        <div class="col-md-8 option-container">
                            <label for="question-text" class="editor-label">Option {{$key+1}}</label>
                            <textarea class="d-none"
                                name="option_text2[]">{{ $options->option_text , old('option_text2[]') }}</textarea>
                            <div class="option-editor {{ $errors->has('option_text2') ? 'is-invalid' : '' }}"
                                id="option_text_maq_{{$key+1}}">
                            </div>
                        </div>
                        @if($errors->has('option_text2'))
                        <div class="invalid-feedback">
                            {{ $errors->first('option_text2') }}
                        </div>
                        @endif
                        <span class="help-block">{{ trans('cruds.option.fields.option_text_helper') }}</span>
                    </div>
                    @endforeach
                </div>
            </div>
            <div class="form-group add_maq_option" id="add_maq_option">
                <input type="button" class="btn btn-default" id="add" value="Add more option">
            </div>
            @endif
            <div class="form-group editor-container">
                <label for="question-hint" class="editor-label"> Write hint for the question</label>
                <textarea class="d-none"
                    name="question_hint"> {{ $question->question_hint,old('question_hint') }}</textarea>
                <div id="question_hint" class="editor {{ $errors->has('question_hint') ? 'is-invalid' : '' }}">
                </div>
                @if($errors->has('question_hint'))
                <div class="invalid-feedback">
                    {{ $errors->first('question_hint') }}
                </div>
                @endif
                <span class="help-block">{{ trans('cruds.question.fields.question_text_helper') }}</span>
            </div>
            <div class="form-group editor-container">
                <label for="question-hint" class="editor-label"> Write explanation of correct answer here</label>
                <textarea class="d-none"
                    name="answer_explanation">{{$question->question_explanation, old('answer_explanation') }}</textarea>
                <div id="answer_explanation"
                    class="editor {{ $errors->has('answer_explanation') ? 'is-invalid' : '' }}">
                </div>
                @if($errors->has('answer_explanation'))
                <div class="invalid-feedback">
                    {{ $errors->first('answer_explanation') }}
                </div>
                @endif
                <span class="help-block">{{ trans('cruds.question.fields.question_text_helper') }}</span>
            </div>
            <div class="form-group row">
                <label for="time" placeholder="Time Limit">Time Limit: </label>
                <div class="form-group col-lg-2">
                    <input class="col-lg-12" type="number" name="time" id="time" value="{{ $question->time }}" required
                        {{$question->time?'':'disabled'}}>
                </div>
                <div class="form-group col-lg-2">
                    <select class="{{ $errors->has('time_type') ? 'is-invalid' : '' }} col-lg-12" name="time_type"
                        id="time_type" required {{$question->time_type?'':'disabled'}}>
                        <option value="0" {{ (($question->time_type==0) || old('time_type')) ? 'selected' : '' }}>
                            seconds
                        </option>
                        <option value="1" {{ (($question->time_type==1) || old('time_type')) ? 'selected' : '' }}>
                            minutes
                        </option>
                        <option value="2" {{ (($question->time_type==2) || old('time_type')) ? 'selected' : '' }}>hours
                        </option>
                    </select>
                </div>
                <div class="form-group">
                    <input type="checkbox" name="" id="time_limit"> Enable
                </div>
            </div>
            <div class="form-group" style="margin-top: 15px;">
                <label class="col-lg-2" for="marks" placeholder="">{{ trans('cruds.question.fields.marks') }}</label>
                <input class="col-lg-1" type="number" name="marks" id="marks" value="{{$question->marks}}">
                @if($errors->has('marks'))
                <div class="invalid-feedback">
                    {{ $errors->first('marks') }}
                </div>
                @endif
                <span class="help-block">{{ trans('cruds.question.fields.marks_helper') }}</span>
            </div>
    </div>

    <div class="card-footer">
        <div class="form-group">
            <button class="btn btn-danger" type="submit">
                {{ trans('global.update') }}
            </button>
        </div>
    </div>
    </form>
</div>

@endsection

@section('scripts')
<script src="{{ asset('js/admin/adaptiveDropdown.js') }}"></script>
<script type="text/javascript">
    $(document).ready(function(){
        $('#time_limit'). click(function(){
                if($(this). is(":checked")){
                $("#time, #time_type").removeAttr('disabled');
                }
                else if($(this). is(":not(:checked)")){
                $("#time, #time_type").attr('disabled','true');
                }
            });
                        $(document).on('click','#add_maq_option',function(){
                        var i=$('#maq input[type="checkbox"]').length;
                        i++;
                        if($('#row4').length !=0){
                            i=3
                        }
                        $('#maq').append('<div class="col-md-12 row option-pad" id="row'+i+'"> <div class="icheck-success"> <input type="checkbox" name="maq_points[]" id="checkbox'+i+'" value="'+i+' required"> <label for="checkbox'+i+'"> </label> </div> <div class="col-md-8 option-container"> <label for="question-text" class="editor-label">Option '+i+'</label> <textarea class="d-none" name="option_text2[]" required></textarea> <div class="option-editor {{ $errors->has('option_text2') ? 'is-invalid' : '' }}" id="option_text_maq_'+i+'">{{ old('option_text2[]', '') }}</div>  @if($errors->has('option_text2')) <div class="invalid-feedback"> {{ $errors->first('option_text2') }} </div> @endif <span class="help-block">{{ trans('cruds.option.fields.option_text_helper') }}</span> </div><div class="col-md-1"><button id="'+i+'" class="btn btn-secondary remove2" alt="Delete this option"><i class="fas fa-trash"></i></button></div>');
                        $this = $('#option_text_maq_'+i);
                        InlineEditor.create( document.querySelector( '#option_text_maq_'+i ), optionConfig ).then(editor=>{
                        editor.model.document.on( 'change', ( evt, data ) => {
                        $this.parents('.option-container').find('textarea').html(editor.getData());
                            });
                        });
                        var j = $('#maq input[type="checkbox"]').length;
                        if(j>=4){
                                $('#add_maq_option').hide();
                            }
                        });

                    $(document).on('click','.remove2',function(){
                        var button_id = $(this).attr("id");
                        $('#row'+button_id).remove();
                        var j = $('#maq input[type="checkbox"]').length;
                        if(j<4){
                                    $('#add_maq_option').show();
                                }
                    });
                    $(document).on('click','#add_mcq_option',function(){
                    var i=$('#mcq input[type="radio"]').length;
                        i++;
                        if($('#row4').length !=0){
                            i=3
                        }
                        $('#mcq').append('<div class="col-md-12 row option-pad" id="row'+i+'"><br><div class="icheck-success"> <input type="radio" name="points" id="option'+i+'" value="1 required"> <label for="option'+i+'"> </label> </div> <div class="col-md-8 option-container"> <label for="question-text" class="editor-label">Option '+i+'</label> <textarea class="d-none" name="option_text[]" required></textarea> <div class="option-editor {{ $errors->has('option_text') ? 'is-invalid' : '' }}" id="option_text_'+i+'">{{ old('option_text[]', '') }}</div> </div> <div class="col-md-1"><button id="'+i+'" class="btn btn-secondary remove" alt="Delete this option"><i class="fas fa-trash"></i></button></div> @if($errors->has('option_text')) <div class="invalid-feedback"> {{ $errors->first('option_text') }} </div> @endif <span class="help-block">{{ trans('cruds.option.fields.option_text_helper') }}</span> </div>');
                        let $this = $('#option_text_'+i);
                        InlineEditor.create( document.querySelector( '#option_text_'+i ), optionConfig ).then(editor=>{
                            editor.model.document.on( 'change', ( evt, data ) => {
                                $this.parents('.option-container').find('textarea').html(editor.getData());
                            });
                        });
                        var j = $('#mcq input[type="radio"]').length;
                        if(j>=4){
                                $('#add_mcq_option').hide();
                            }
                    });

                    $(document).on('click','.remove',function(){
                        var button_id = $(this).attr("id");
                        $('#row'+button_id).remove();
                        var j = $('#option input[type="radio"]').length;
                        if(j<4){
                                    $('#add_mcq_option').show();
                                }
                    });
            var selected_type = $("#type").val();
            if(selected_type == 'Multiple Choices') {
                    $("#maq , #add_maq_option").hide();
                    $(".option_text2").removeAttr('required');
                    // $('#mcq , #add_mcq_option').removeClass('mcq , add_mcq_option');
                    $("#mcq , #add_mcq_option").show();
                    var i=$('#mcq input[type="radio"]').length;
                    if(i>=4){
                            $('#add_mcq_option').hide();
                        }
                        //adding options dynamically

                    $("#option1, #option_text").attr('required','true');
                }
                else if(selected_type == 'Multiple Answers') {
                    $("#mcq , #add_mcq_option").hide();
                    $("#option1, #option_text").removeAttr('required');
                    // $('#mcq , #add_mcq_option').addClass('mcq , add_mcq_option');
                    $("#maq , #add_maq_option").show();
                    var i=$('#maq input[type="checkbox"]').length;
                    if(i>=4){
                            $('#add_maq_option').hide();
                        }
                        //adding options dynamically

                    $(".option_text2").attr('required','true');
                }
                else if(selected_type == 'True or False') {
                    $("#torf").remove();
                    $("#maq , #add_maq_option").hide();
                    $(".option_text2").removeAttr('required');
                    $("#mcq , #add_mcq_option").hide();
                    $("#option1, #option_text").removeAttr('required');
                    $("#quest").append(`<div class="torf" id="torf">
                                        @foreach($question->questionOptions as $key=>$options)
                                        <div class="col-md-12 row" style="margin-bottom:5px;">
                                            <div class="icheck-success">
                                                <input type="radio" name="points" id="option{{ $key+1 }}" value="{{ $key+1 }}"  {{ (($options->points==1) ? 'checked' : '' )}} >
                                                <label for="option{{ $key+1 }}">
                                                </label>
                                            </div>
                                            <div class="col-md-8">
                                            <input class="{{ $errors->has('torf') ? 'is-invalid' : '' }}" name="torf[]" id="torf" type="text" value="{{ $options->option_text , old('torf[]') }}" readonly>

                                            </div>
                                            @if($errors->has('torf'))
                                                <div class="invalid-feedback">
                                                    {{ $errors->first('torf') }}
                                                </div>
                                            @endif
                                            <span class="help-block">{{ trans('cruds.option.fields.option_text_helper') }}</span>
                                        </div>
                                        @endforeach
                                    </div>`);
                }
                else if(selected_type == 'Short Answer') {
                    $("#torf").remove();
                    $("#maq , #add_maq_option").hide();
                    $(".option_text2").removeAttr('required');
                    $("#mcq , #add_mcq_option").hide();
                    $("#option1, #option_text").removeAttr('required');
                    $("#quest").after(`<div class="form-group option-container">
        <label for="saq" class="editor-label"> Write correct answer here</label>
        <textarea class="d-none" name="saq"></textarea>
        <div id="saq" class="editor {{ $errors->has('saq') ? 'is-invalid' : '' }}">{{ old('saq') }}</div>
        @if($errors->has('saq'))
        <div class="invalid-feedback">
            {{ $errors->first('saq') }}
        </div>
        @endif
        <span class="help-block">{{ trans('cruds.question.fields.question_text_helper') }}</span>
    </div>
    `);
            $this = $('#saq');
            InlineEditor.create( document.querySelector( '#saq' ),ckConfig ).then(editor=>{
            editor.model.document.on( 'change', ( evt, data ) => {
            $this.parents('.option-container').find('textarea').html(editor.getData());
                });
            });
                }
                else {
                    $("#maq , #add_maq_option").hide();
                    $("#mcq , #add_mcq_option").hide();
                    $("#torf").remove();
                    $("#saq").remove();
                    // $('#mcq , #add_mcq_option').addClass('mcq , add_mcq_option');
                }

                // changing options according to type of question selected
                $("#type").change(function() {
                var selected_type = $(this).val();
                if(selected_type == 'Multiple Choices') {
                    $("#maq , #add_maq_option").remove();
                    // $(".option_text2").removeAttr('required');
                    $("#torf").remove();
                    $("#saq").remove();
                    $("#mcq , #add_mcq_option").remove();
                    // $("#mcq , #add_mcq_option").show();
                    // $("#option1, #option_text").attr('required','true');

                    $("#quest").after(`<div class="mcq" id="mcq">
        <div class="col-md-12 row option-pad">
            <div class="icheck-success">
                <input type="radio" name="points" id="option1" value="1">
                <label for="option1">
                </label>
            </div>
            <div class="col-md-8 option-container">
                <label for="question-text" class="editor-label">Option 1</label>
                <textarea class="d-none" name="option_text[]"></textarea>
                <div class="option-editor {{ $errors->has('option_text') ? 'is-invalid' : '' }}" id="option_text_1">
                    {{ old('option_text[]', '') }}</div>
            </div>
            @if($errors->has('option_text'))
            <div class="invalid-feedback">
                {{ $errors->first('option_text') }}
            </div>
            @endif
            <span class="help-block">{{ trans('cruds.option.fields.option_text_helper') }}</span>
        </div>
        <div class="col-md-12 row option-pad">
            <div class="icheck-success">
                <input type="radio" name="points" id="option2" value="1">
                <label for="option2">
                </label>
            </div>
            <div class="col-md-8 option-container">
                <label for="question-text" class="editor-label">Option 2</label>
                <textarea class="d-none" name="option_text[]"></textarea>
                <div class="option-editor {{ $errors->has('option_text') ? 'is-invalid' : '' }}" id="option_text_2">
                    {{ old('option_text[]', '') }}</div>
            </div>
            @if($errors->has('option_text'))
            <div class="invalid-feedback">
                {{ $errors->first('option_text') }}
            </div>
            @endif
            <span class="help-block">{{ trans('cruds.option.fields.option_text_helper') }}</span>
        </div>
    </div>
    <div class="form-group add_mcq_option" id="add_mcq_option">
        <input type="button" class="btn btn-default" id="add1" value="Add more option">
    </div>`);
                }
                else if(selected_type == 'Multiple Answers') {
                    // $("#mcq , #add_mcq_option").hide();
                    // $("#option1, #option_text").removeAttr('required');
                    $("#torf").remove();
                    $("#saq").remove();
                    $("#mcq , #add_mcq_option").remove();
                    $("#maq , #add_maq_option").remove();
                    // $("#maq , #add_maq_option").show();
                    // $(".option_text2").attr('required','true');

                    $("#quest").append(`<div class="maq" id="maq">
        <div class="col-md-12 row option-pad">
            <div class="icheck-success">
                <input type="checkbox" name="maq_points[]" id="checkbox1" value="1">
                <label for="checkbox1">
                </label>
            </div>
            <div class="col-md-8 option-container">
                <label for="question-text" class="editor-label">Option 1</label>
                <textarea class="d-none" name="option_text2[]"></textarea>
                <div class="option-editor {{ $errors->has('option_text2') ? 'is-invalid' : '' }}"
                    id="option_text_maq_1">{{ old('option_text2[]', '') }}</div>
            </div>
            @if($errors->has('option_text2'))
            <div class="invalid-feedback">
                {{ $errors->first('option_text2') }}
            </div>
            @endif
            <span class="help-block">{{ trans('cruds.option.fields.option_text_helper') }}</span>
        </div>
        <div class="col-md-12 row option-pad">
            <div class="icheck-success">
                <input type="checkbox" name="maq_points[]" id="checkbox2" value="2">
                <label for="checkbox2">
                </label>
            </div>
            <div class="col-md-8 option-container">
                <label for="question-text" class="editor-label">Option 2</label>
                <textarea class="d-none" name="option_text2[]"></textarea>
                <div class="option-editor {{ $errors->has('option_text2') ? 'is-invalid' : '' }}"
                    id="option_text_maq_2">{{ old('option_text2[]', '') }}</div>
            </div>
            @if($errors->has('option_text2'))
            <div class="invalid-feedback">
                {{ $errors->first('option_text2') }}
            </div>
            @endif
            <span class="help-block">{{ trans('cruds.option.fields.option_text_helper') }}</span>
        </div>
    </div>
    <div class="form-group add_maq_option" id="add_maq_option">
        <input type="button" class="btn btn-default" id="add" value="Add more option">
    </div>`);
                }
                else if(selected_type == 'True or False') {
                    // $("#torf").remove();
                    $("#saq").remove();
                    $("#maq , #add_maq_option").remove();
                    // $(".option_text2").removeAttr('required');
                    $("#mcq , #add_mcq_option").remove();
                    // $("#option1, #option_text").removeAttr('required');
                    $("#quest").append(`<div class="torf" id="torf">
                        <br>
                                    <div class="col-md-12 row" style="margin-bottom:5px;">
                                        <div class="icheck-success">
                                            <input type="radio" name="points" id="option1" value="1" required>
                                            <label for="option1">
                                            </label>
                                        </div>
                                        <div class="col-md-8">
                                        <input class="{{ $errors->has('torf') ? 'is-invalid' : '' }}" name="torf[]" type="text" value="True" readonly>
                                        </div>
                                        @if($errors->has('torf'))
                                            <div class="invalid-feedback">
                                                {{ $errors->first('torf') }}
                                            </div>
                                        @endif
                                        <span class="help-block">{{ trans('cruds.option.fields.option_text_helper') }}</span>
                                    </div>
                                    <br>
                                    <div class="col-md-12 row">
                                        <div class="icheck-success">
                                            <input type="radio" name="points" id="option2" value="2" required>
                                            <label for="option2">
                                            </label>
                                        </div>
                                        <div class="col-md-8">
                                        <input class="{{ $errors->has('torf') ? 'is-invalid' : '' }}" name="torf[]" type="text" value="False" readonly>

                                        </div>
                                        @if($errors->has('torf'))
                                            <div class="invalid-feedback">
                                                {{ $errors->first('torf') }}
                                            </div>
                                        @endif
                                        <span class="help-block">{{ trans('cruds.option.fields.option_text_helper') }}</span>
                                    </div>
                                </div><br>`);
                }
                else if(selected_type == 'Short Answer') {
                $("#saq").remove();
                $("#torf").remove();
                $("#maq , #add_maq_option").hide();
                $(".option_text2").removeAttr('required');
                $("#mcq , #add_mcq_option").hide();
                $("#option1, #option_text").removeAttr('required');
                $("#quest").append(`<div class="form-group option-container">
        <label for="saq" class="editor-label"> Write correct answer here</label>
        <textarea class="d-none" name="saq"></textarea>
        <div id="saq" class="editor {{ $errors->has('saq') ? 'is-invalid' : '' }}">{{ old('saq') }}</div>
        @if($errors->has('saq'))
        <div class="invalid-feedback">
            {{ $errors->first('saq') }}
        </div>
        @endif
        <span class="help-block">{{ trans('cruds.question.fields.question_text_helper') }}</span>
    </div>`);
    InlineEditor.create( document.querySelector( '#saq' ),ckConfig ).then(editor=>{
            editor.model.document.on( 'change', ( evt, data ) => {
            $this.parents('.option-container').find('textarea').html(editor.getData());
                });
            });
                }
                else {
                    $("#maq , #add_maq_option").hide();
                    $("#mcq , #add_mcq_option").hide();
                    $("#torf").remove();
                    $("#saq").remove();
                    // $('#mcq , #add_mcq_option').addClass('mcq , add_mcq_option');
                }

                //adding editor
                $('.option-editor').each(function(i,ele){
                    if(! $(this).hasClass('ck')){
                        $this = $(this);
                        let value = $this.parents('.option-container').find('textarea').text();
                        let $id = $(this).attr('id');
                        InlineEditor.create( document.querySelector( '#'+$(this).attr('id') ), optionConfig ).then(editor=>{
                        editor.setData(value);
                        //adding data in text editor
                            editor.model.document.on( 'change', ( evt, data ) => {
                                $('#'+$id).parent().find('textarea').html(editor.getData());
                            });
                    });
                    }
                });
            });
        });
</script>
@endsection
