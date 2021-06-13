@extends('admin.backend.layouts.master')
@section('title','Add Question')

@section('styles')
<!-- iCheck for checkboxes and radio inputs -->
<link rel="stylesheet" href="{{ asset('css/bootstrap/plugins/icheck-bootstrap/icheck-bootstrap.min.css')}}">
<link rel="stylesheet" href="{{ asset('css/admin/addQuizform.css') }}">
<style>
    .mcq,
    .add_mcq_option,
    .maq,
    .add_maq_option {
        display: none;
    }
</style>
@endsection

@section('content')
<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.question.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" id="create-question-form" action="{{ route("admin.questions.store") }}"
            enctype="multipart/form-data">
            @csrf
            <div class="field-wrapper">
                <label for="quiz_id" placeholder="Please select a quiz">Please select a quiz</label>
                <select class="{{ $errors->has('quiz') ? 'is-invalid' : '' }}" name="quiz_id" id="quiz_id" required>
                    @if (count($quizzes)>1)
                    <option value="" rel-time="" rel-marks="" rel-type="">Please select Quiz</option>
                    @endif
                    @foreach($quizzes as $id => $quiz)
                    <option value="{{ $quiz->id }}" {{ old('quiz_id') == $quiz->id ? 'selected' : '' }}
                        rel-time="{{$quiz->time}}" rel-marks="{{$quiz->remaining_marks}}"
                        rel-type="{{$quiz->quiz_type}}">{{ $quiz->title }}
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
            {{-- <div class="field-wrapper">
                <label for="subcategory_id" placeholder="Please select a subcategory">Please select a subcategory</label>
                <select class="{{ $errors->has('subcategory') ? 'is-invalid' : '' }}" name="subcategory_id"
            id="subcategory_id" required>

            <option value="">Please select a subcategory</option>

            </select>
            @if($errors->has('subcategory_id'))
            <div class="invalid-feedback">
                {{ $errors->first('subcategory_id') }}
            </div>
            @endif
            <span class="help-block">{{ trans('cruds.question.fields.subcategory_helper') }}</span>
    </div> --}}
    <div class="field-wrapper">
        <label for="type" placeholder="Please select a question type">Please select a question type</label>
        <select class="{{ $errors->has('type') ? 'is-invalid' : '' }}" name="type" id="type" required>
            <option value="">Please select a question type</option>
            <option value="Multiple Choices" {{ old('type') == 'Multiple Choices' ? 'selected' : '' }}>Multiple Choices
            </option>
            <option value="Multiple Answers" {{ old('type') == 'Multiple Answers' ? 'selected' : '' }}>Multiple Answers
            </option>
            <option value="True or False" {{ old('type') == 'True or False' ? 'selected' : '' }}>True or False </option>
            <option value="Short Answer" {{ old('type') == 'Short Answer' ? 'selected' : '' }}>Short Answer
            </option>
            {{-- <option value="Long Answer" {{ old('type') == 'Long Answer' ? 'selected' : '' }}>Long Answer </option>
            --}}
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
        <textarea class="d-none" name="question_text" required></textarea>
        <div class="editor {{ $errors->has('question_text') ? 'is-invalid' : '' }}" id="question_text">
            {{ old('question_text') }}</div>
        @if($errors->has('question_text'))
        <div class="invalid-feedback">
            {{ $errors->first('question_text') }}
        </div>
        @endif
        <span class="help-block">{{ trans('cruds.question.fields.question_text_helper') }}</span>
    </div>

    <div class="mcq" id="mcq">
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
    </div>

    {{-- multi answers --}}
    <div class="maq" id="maq">
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
    </div>
    <div class="form-group editor-container">
        <label for="question-hint" class="editor-label"> Write hint for the question</label>
        <textarea class="d-none" name="question_hint"></textarea>
        <div id="question_hint" class="editor {{ $errors->has('question_hint') ? 'is-invalid' : '' }}">
            {{ old('question_hint') }}</div>
        @if($errors->has('question_hint'))
        <div class="invalid-feedback">
            {{ $errors->first('question_hint') }}
        </div>
        @endif
        <span class="help-block">{{ trans('cruds.question.fields.question_text_helper') }}</span>
    </div>
    <div class="form-group editor-container">
        <label for="question-hint" class="editor-label"> Write explanation of correct answer here</label>
        <textarea class="d-none" name="answer_explanation"></textarea>
        <div id="answer_explanation" class="editor {{ $errors->has('answer_explanation') ? 'is-invalid' : '' }}">
            {{ old('answer_explanation') }}</div>
        @if($errors->has('answer_explanation'))
        <div class="invalid-feedback">
            {{ $errors->first('answer_explanation') }}
        </div>
        @endif
        <span class="help-block">{{ trans('cruds.question.fields.question_text_helper') }}</span>
    </div>
    <div class="form-group row d-none" id="time-container">
        <label for="time" placeholder="Time Limit">Time Limit: </label>
        <div class="form-group col-lg-2">
            <input class="col-lg-12" type="number" name="time" id="time" value="{{ old('time',0) }}" required disabled>
        </div>
        <div class="form-group col-lg-2">
            <select class="{{ $errors->has('time_type') ? 'is-invalid' : '' }} col-lg-12" name="time_type"
                id="time_type" required disabled>
                <option value="0" {{ old('time_type') ? 'selected' : '' }}>seconds</option>
                <option value="1" {{ old('time_type') ? 'selected' : '' }}>minutes</option>
                <option value="2" {{ old('time_type') ? 'selected' : '' }}>hours</option>
            </select>
        </div>
        <div class="form-group">
            <input type="checkbox" name="" id="time_limit"> Enable
        </div>
    </div>
    <div class="form-group row ">
        <label class="col-lg-2" for="marks" placeholder="">{{ trans('cruds.question.fields.marks') }}</label>
        <div class="col-lg-2">
            <input type="number" name="marks" id="marks" value="1">
            <small id="remaining-marks"></small><br>
            <small class="marks-help-block help-block">
                {{ trans('cruds.question.fields.marks_helper') }}</small>
        </div>
        @if($errors->has('marks'))
        <div class="invalid-feedback">
            {{ $errors->first('marks') }}
        </div>
        @endif
    </div>
</div>
<div class="card-footer">
    <div class="form-group">
        <button class="btn btn-success" type="submit" id="submit-btn">
            {{ trans('global.save') }}
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
        $(document).on('change','#quiz_id',function(){
            $selected_option = $(this).find('option:selected');
            console.log($selected_option.attr('rel-type'));
            if( $selected_option.attr('rel-time') == ''){
                $('#time-container').removeClass('d-none');
            }else{
                $('#time-container').addClass('d-none');
            }
            if($selected_option.attr('rel-type').trim()=='Practice Quiz'){
                $('#remaining-marks').addClass('d-none');
            }
            $remaining_marks = $selected_option.attr('rel-marks');
            if($selected_option != ''&& $remaining_marks!=''){
                $('#remaining-marks').html('Remaining marks:'+$remaining_marks);
                $('#remaining-marks').attr('rel-marks',$remaining_marks);
                if(parseInt($remaining_marks)<=0 && $selected_option.attr('rel-type').trim()!='Practice Quiz'){
                    $('#submit-btn').attr('disabled');
                }
            }
        });
        $('#quiz_id').val($('#quiz_id').val()).trigger('change');
        $(document).on('keyup','#marks',function(){
            $remaining_marks = $('#remaining-marks').attr('rel-marks') - $(this).val();
            $selected_option = $('#quiz_id').find('option:selected');
            if($selected_option.attr('rel-type').trim()=='Practice Quiz'){
                $('#remaining-marks').addClass('d-none');
            }
            else{
                $('#remaining-marks').removeClass('d-none');
            }
            if($remaining_marks<0 && $selected_option.attr('rel-type').trim()!='Practice Quiz'){
                $('#submit-btn').attr('disabled',true);
                $('.marks-help-block').html('Marks is more than remaining marks');
            }else{
                $('#submit-btn').removeAttr('disabled');
                $('.marks-help-block').html('');
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
        //adding options dynamically
        $('#add_mcq_option').click(function(){
            var i=$('#mcq input[type="radio"]').length;
            i++;
            if($('#maq-row'+i).length >0 && i == 4){
                i=3;
            }
            $('#mcq').append('<div class="col-md-12 row option-pad" id="row'+i+'"><br><div class="icheck-success"> <input type="radio" name="points" id="option'+i+'" value="1"> <label for="option'+i+'"> </label> </div> <div class="col-md-8 option-container"> <label for="question-text" class="editor-label">Option '+i+'</label> <textarea class="d-none" name="option_text[]" required></textarea> <div class="option-editor " id="option_text_'+i+'">{{ old('option_text[]', '') }}</div> </div> <div class="col-md-1"><button id="'+i+'" class="btn btn-secondary remove" alt="Delete this option"><i class="fas fa-trash"></i></button></div>');

            var j = $('#mcq input[type="radio"]').length;

            if(j>=4){
                    $('#add_mcq_option').hide();
                }
                let $this = $('#option_text_'+i);
            InlineEditor.create( document.querySelector( '#option_text_'+i ), optionConfig ).then(editor=>{
                editor.model.document.on( 'change', ( evt, data ) => {
                    $this.parents('.option-container').find('textarea').html(editor.getData());
                });
            });
        });

        $(document).on('click','.remove',function(){
            var button_id = $(this).attr("id");
            $('#row'+button_id+'').remove();
            var j = $('#mcq input[type="radio"]').length;
            if(j<4){
                        $('#add_mcq_option').show();
                    }
        });

        //adding maq options dynamically
        $('#add_maq_option').click(function(){
            a=$('#maq input[type="checkbox"]').length;
            a++;
            if($('#maq-row'+a).length >0 && a == 4){
                a=3;
            }
            $('#maq').append(`<div class="col-md-12 row option-pad" id="maq-row${a}">
                <div class="icheck-success"> <input type="checkbox" name="maq_points[]" id="checkbox${a}" value="${a}"> <label
                        for="checkbox${a}"> </label> </div>
                <div class="col-md-8 option-container"> <label for="question-text" class="editor-label">Option ${a}</label>
                    <textarea class="d-none" name="option_text2[]" required></textarea>
                    <div class="option-editor" id="option_text_maq_${a}">
                        {{ old('option_text2[]', '') }}</div>
                </div>
                <div class="col-md-1"><button id="${a}" class="btn btn-secondary remove2" alt="Delete this option"><i
                            class="fas fa-trash"></i></button>
                </div>
            </div>`);
            let $this = $('#option_text_maq_'+a);
            InlineEditor.create( document.querySelector( '#option_text_maq_'+a ), optionConfig ).then(editor=>{
                editor.model.document.on( 'change', ( evt, data ) => {
                    $this.parents('.option-container').find('textarea').html(editor.getData());
                });
            });
            var b = $('#maq input[type="checkbox"]').length;
            // console.log(j)
            if(b>=4){
                    $('#add_maq_option').hide();
                }
        });

        $(document).on('click','.remove2',function(){
            var button_id = $(this).attr("id");
            $('#maq-row'+button_id+'').remove();
            var b = $('#maq input[type="checkbox"]').length;
            if(b<4){
                        $('#add_maq_option').show();
                    }
        });


        $("#type").change(function() {
            var selected_type = $(this).val();
            if(selected_type == 'Multiple Choices') {
                $("#maq , #add_maq_option").hide();
                $(".option_text2").removeAttr('required');
                $('#checkbox1').removeAttr('required');

                $("#torf").remove();
                $("#saq").remove();
                // $('#mcq , #add_mcq_option').removeClass('mcq , add_mcq_option');
                $("#mcq , #add_mcq_option").show();
                $("#option1, #option_text").attr('required','true');
            }
            else if(selected_type == 'Multiple Answers') {
                $("#mcq , #add_mcq_option").hide();
                $("#option1, #option_text").removeAttr('required');
                $("#torf").remove();
                $("#saq").remove();
                // $('#mcq , #add_mcq_option').addClass('mcq , add_mcq_option');
                $("#maq , #add_maq_option").show();
                $(".option_text2").attr('required','true');
                $('#checkbox1').attr('required','true');
            }
            else if(selected_type == 'True or False') {
                $("#torf").remove();
                $("#saq").remove();
                $("#maq , #add_maq_option").hide();
                $(".option_text2").removeAttr('required');
                $("#mcq , #add_mcq_option").hide();
                $("#option1, #option_text").removeAttr('required');
                $("#quest").append(`<br><div class="torf" id="torf">
                                    <div class="col-md-12 row" style="margin-bottom:5px;">
                                        <div class="icheck-success">
                                            <input type="radio" name="points" id="option1" value="1" required>
                                            <label for="option1">
                                            </label>
                                        </div>
                                        <div class="col-md-8">
                                        <input class="{{ $errors->has('torf') ? 'is-invalid' : '' }}" name="torf[]" id="torf" type="text" value="True" readonly>
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
                                        <input class="{{ $errors->has('torf') ? 'is-invalid' : '' }}" name="torf[]" id="torf" type="text" value="False" readonly>

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
    let $this = $('#saq');
            InlineEditor.create( document.querySelector( '#saq' ), optionConfig ).then(editor=>{
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
    });

    $(document).on('click','#submit-btn',function(){
        $('textarea').each(function(i,ele){
            if($(this).prop('required') && $(this).val() == ''){
                $(this).parent().addClass('invalid');
            }
        });
        if($('input[type=radio]:checked').length == 0){
                $('input[type=radio]').parent().addClass('invalid');
        }
        if($('input[type=checkbox]:checked').length == 0){
                $('input[type=checkbox]').parent().addClass('invalid');
        }

    });
    $(document).on('click','.ck',function(){
        $(this).parent().removeClass('invalid');
    });
    $(document).on('click','.icheck-success>label',function(){
        $('.icheck-success').removeClass('invalid');
    });
    });

</script>
@endsection
