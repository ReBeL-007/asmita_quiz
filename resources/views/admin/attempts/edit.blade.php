@inject('request', 'Illuminate\Http\Request')
@extends('admin.backend.layouts.master')
@section('title','Attempts')

@section('content')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css"
    integrity="sha512-+4zCK9k+qNFUR5X+cKL9EIR+ZOhtIloNl9GIKS57V1MyNsYpYcUrUeQc9vNfzsWfV28IaLL3i96P9sdNyeRssA=="
    crossorigin="anonymous" />

<style>
    input:disabled {
        color: -internal-light-dark(rgb(8, 8, 8), rgb(14, 14, 14)) !important;
        cursor: default;
    }

    .center {
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .option_text {
        font-weight: normal !important;
    }

    .check {
        float: right;
    }

    .answers:not(:first-child) {
        margin-top: 20px;
    }

    .grading-comtainer {
        background-color: #489aba29;
        height: 7vw;
        display: flex;
        align-items: center;
        border-radius: 20px;
    }

    .grading-text {
        display: flex;
        align-items: center;
        justify-content: center;
        min-width: 170px;
    }

    .select2-selection {
        background-color: white;
    }

    .change-btn {

        font-size: 1.5rem;
    }

    .select2 {
        width: 300px !important;
        text-align: center;
    }

    .select-container {
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .select2-selection__rendered {
        line-height: 32px !important;
    }

    .select2-selection {
        height: 34px !important;
    }

    .select2-container--krajee .select2-dropdown--below {
        width: 230px !important;
        margin-left: -70px !important;
    }

    .feedback {
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .complete-time {
        min-width: 175px;
    }

    .correct-option {
        margin-top: 10px;
        border: #45d667 solid;
        background-color: #71e98d65;
    }

    .wrong-option {
        margin-top: 10px;
        border: rgb(255, 53, 53) solid 1px;
        background-color: #e9717139;
    }

    .option {
        padding-left: 10px;
        padding-right: 10px;
        display: flex;
        align-items: center;
    }

    @media screen and (min-device-width: 1000px) and (max-device-width: 1600px) and (-webkit-min-device-pixel-ratio: 1) {

        /* .select-container{
        width: 100%;
        flex: none;
        max-width: none;
    } */
        .grading-comtainer {
            height: 160px;
        }

        /* .review-elem{
        margin-top:10px;
        width: 100%;
        flex: none;
        max-width: none;
    } */
    }


    @media screen and (min-device-width: 768px) and (max-device-width: 1000px) and (-webkit-min-device-pixel-ratio: 1) {
        .review-elem {
            width: 100%;
            flex: none;
            max-width: none;
        }

        .grading-comtainer {
            height: 150px;
        }

    }

    label {
        margin-bottom: 0 !important;
    }

    .grading-input {
        width: 40px;
        height: 30px;
        text-align: center;
    }

    .grading-input-container {
        display: flex;
        justify-content: flex-end;
        align-items: center;
    }

    .next {
        float: right;
    }

    .back {
        float: left;
    }

    .question {
        display: flex;
        align-items: center;
    }

    .option_text {
        display: flex;
        align-items: center;
    }
</style>
<div class="review-container d-flex justify-content-center">
    <div class="col-md-8">
        {{-- <div class="attempt-nav">
            <div class="back">
                <a><i class="fas fa-arrow-left"></i>&nbsp;&nbsp;Back</a>
            </div>
            <div class="next">
                <a>Review Next&nbsp;&nbsp;<i class="fas fa-arrow-right"></i></a>
            </div>
        </div> --}}
        <div class="card">
            <div class="card-body">
                <h3>Review: Quiz</h3>
                <div class="grading-comtainer">
                    <div class="row w-100">
                        <div class="col-md-5 review-elem select-container">
                            <a class="change-btn left-btn"><i class="fas fa-angle-left"
                                    style="color: rgb(166, 166, 166);"></i></a>
                            &nbsp;
                            <select class="users-select">
                            </select>
                            &nbsp;
                            <a class="change-btn right-btn"><i class="fas fa-angle-right"
                                    style="color: rgb(166, 166, 166);"></i></a>
                        </div>
                        <div class="col-md-3 complete-time review-elem grading-text">
                            Time to complete: <span class="complete-time-span"></span>
                        </div>
                        <div class="col-md-3 review-elem grading-text">
                            Points: <span class="point-span"></span>
                        </div>
                        <div class="col-md-1  review-elem feedback-attempt-btn"><i class="far fa-comment-alt"></i>
                        </div>
                    </div>
                </div>
                <br>
                <div class="row w-100">
                    <div class="form-group w-100">
                        <textarea class="form-control feedback-attempt d-none"
                            placeholder="Enter feedback (max 1000 characters)" spellcheck="true" maxlength="1000"
                            rows="3"></textarea>
                    </div>
                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-body">
                <div class="answers-container">
                </div>
                <template id="attempt-template">
                    <div class="attempt-container row">
                        <div class="answers col-md-8">
                            <h5 class="question">[[[question]]]</h5>
                            [[[option]]]
                            <br>
                            [[[feedback_field]]]
                        </div>
                        [[[feedback]]]
                    </div>
                </template>
                <template id="option-template">
                    <div class="option [[[state]]]">
                        <input type="[[[input_type]]]" disabled="" [[[status]]]>&nbsp;&nbsp;<label class="option_text"
                            for="">[[[option_text]]]</label><span class="check ml-auto">[[[icon]]]</span></div>
                </template>
                <template id="feedback-template">
                    <div class="col-md-4">
                        <div class="row">
                            <div class="col-md-8 grading-input-container">
                                <h6><input type="text" class="grading-input" rel="[[[answer]]]" value="[[[marks]]]"> /
                                    [[[total_marks]]] pts</h6>
                            </div>
                            <div class="col-md-3 center"><a class="feedback-btn" rel="[[[answer]]]"><i
                                        class="far fa-comment-alt"></i></a>
                            </div>
                        </div>
                    </div>
                </template>
            </div>
        </div>
    </div>
</div>

{{-- <script>
    var msg = new SpeechSynthesisUtterance();
msg.text = "Hello World";
window.speechSynthesis.speak(msg);
</script> --}}
@stop
@section('scripts')
<script>
    $(function(){


        $attempts = [];
        $.ajax({    async:false,
                    type: 'POST'
                    , url: "{{ route('admin.get_quiz_attempts') }}"
                    , data: {
                        '_token': '{{ csrf_token() }}',
                        'id':'{{request()->route()->parameters["id"]}}'
                    , }
                    ,success:function(json) {
                    $attempts = JSON.parse(json);
                    }

                });

        $attempt_no = 0;

        $.each($attempts,function(i,ele){
            if($attempt_no==i){
            $('.users-select').append('<option value='+i+'>'+$attempts[i].user.name+'</option>').trigger('selected');
            }else{
            $('.users-select').append('<option value='+i+'>'+$attempts[i].user.name+'</option>');
            }
        });

        // '<div class="option "><input type="radio" disabled="">&nbsp;&nbsp;<label class="option_text" for="">b.test2</label></div>'
        $(document).on('click','.right-btn',function(){
            if($attempts.length >$attempt_no ){
            $attempt_no++;
            $('.users-select').val($attempt_no).trigger('change');
            loadAttempts();
            }
        });
        $(document).on('click','.left-btn',function(){
            if($attempt_no !=0 ){
            $attempt_no--;
            $('.users-select').val($attempt_no).trigger('change');
            loadAttempts();
            }
        });
        if($attempts.length ==0){
            $('.answers-container').append('<p class="text-center">No attempts available</p>');
        }else{
        loadAttempts();
        }
        function loadAttempts(){
            $attempt = $attempts[$attempt_no];
            $quiz = $attempt.quiz;
            if($attempt.feedback!=''){
                $('.feedback-attempt').html($attempt.feedback).removeClass('d-none');
            }else{
                $('.feedback-attempt').addClass('d-none');
            }
            $('.feedback-attempt').attr('rel',$attempt.id);
            $('.answers-container').html('');
            $.each($quiz.questions,function(i,ele){
            $template = $('#attempt-template').html();
            $template = $template.replace('[[[question]]]',i+1+'.<div class="readonly-editor" id="re-'+i+'"> '+ele.question_text+'</div>');
            $attempted_answer = findByQuestion(ele.id);
            $option = '';
            if(ele.type=="Long Answer" || ele.type=="Short Answer"){
                        $image = '<div class="row image-viewer">';
                        $.each($attempt_answers.attempt_options,function($i,$ele){
                        if($ele.answer_text!=null){
                            $option += '<div class="readonly-editor" id="answer_'+i+'">'+$ele.answer_text+'</div>';
                        }
                        if($ele.image !=null){
                        $image += '<div class="col-md-4"><img class="img-thumbnail rounded" src="/'+$ele.image.replace('public','storage')+'" alt="Picture "'+$i+'></div>';
                        }
                        });
                        $image += '</div>';
                        $option+=$image;
                    }else{
                $.each(ele.question_options,function(index,element){
                    // console.log(ele);
                    $option_template = $('#option-template').html();

                    if(ele.type=="Multiple Choices" || ele.type=="True or False"){
                        $option_template = $option_template.replace('[[[input_type]]]','radio');
                    }else if(ele.type=="Multiple Answers"){
                        $option_template = $option_template.replace('[[[input_type]]]','checkbox');
                    }
                    $.each($attempt_answers.attempt_options,function($i,$ele){
                        if(element.id == $ele.option_id){
                            if(element.points==1 && $ele.option_id == element.id){
                                $option_template = $option_template.replace('[[[state]]]','correct-option');
                            }else{
                                $option_template = $option_template.replace('[[[state]]]','wrong-option');
                                $option_template = $option_template.replace('[[[icon]]]','<i class="fas fa-times"></i>');
                            }
                            $option_template = $option_template.replace('[[[status]]]','checked');
                        }
                        $option_template = $option_template.replace('[[[status]]]','');
                    });
                    $option_template = $option_template.replace('[[[option_text]]]',String.fromCharCode(97+index)+'.<div class="readonly-editor" id="o-re-'+i+index+'"> '+element.option_text+'</div>');
                    if(element.points==1){
                        $option_template = $option_template.replace('[[[icon]]]','<i class="fas fa-check"></i>');
                    }else{
                        $option_template = $option_template.replace('[[[icon]]]','');
                    }
                    $option_template = $option_template.replace('[[[state]]]','');
                    $option+=$option_template;
                });
            }

            $feedback_template = $('#feedback-template').html();
            $feedback_template = $feedback_template.replace('[[[total_marks]]]',ele.marks);
            $feedback_template = $feedback_template.replace('[[[marks]]]',($attempted_answer.marks==undefined)?0:$attempted_answer.marks);
            $feedback_template = $feedback_template.replaceAll('[[[answer]]]',$attempted_answer.id);
            $template = $template.replace('[[[feedback]]]',$feedback_template);
            if($attempt_answers.feedback!=''){
                $template = $template.replace('[[[feedback_field]]]','<div class="form-group"><textarea class="form-control feedback" rel="'+$attempt_answers.id+'" placeholder="Enter feedback (max 1000 characters)" spellcheck="true" maxlength="1000" rows="3">'+($attempted_answer.feedback==undefined)?'':$attempt_answers.feedback+'</textarea></div>');
            }else{
                $template = $template.replace('[[[feedback_field]]]','');
            }
            $template = $template.replace('[[[option]]]',$option);
            $('.answers-container').append($template);
            });
                $('.readonly-editor').each(function(i,ele){
        let value = $(this).html();
        let $this = $(this);
            InlineEditor.create( document.querySelector( '#'+$(this).attr('id') ), {
                image: {
        toolbar: [
            'imageTextAlternative',
            'imageStyle:full',
            'imageStyle:side'
        ]
    },
            isReadOnly: true,
            } ).then(editor=>{
                editor.isReadOnly = true;
                editor.setData(value);
            });
    });

    $('.image-viewer').each(function(i,ele){
        new Viewer(document.getElementsByClassName('image-viewer')[i]);
    });
        }

        function findByQuestion($id){
            $attempt_answers ={};
            $.each($attempt.attempt_answers,function(i,ele){
                if(ele.question_id === $id){
                    console.log('test');
                    $attempt_answers = ele;
                }
            });
            return $attempt_answers;
        }

        $(document).on('click','.feedback-btn',function(){
            if($(this).parents('.attempt-container').find('.feedback').length == 0){
            $(this).parents('.attempt-container').find('.answers').append('<div class="form-group"><textarea class="form-control feedback" rel="'+$(this).attr("rel")+'"placeholder="Enter feedback (max 1000 characters)" spellcheck="true" maxlength="1000" rows="3"></textarea></div>');
            }
        });

        $(document).on('click','.feedback-attempt-btn',function(){
            $('.feedback-attempt').removeClass('d-none');
        });

        $(document).on('change','.grading-input',function(){
            $marks = ($(this).val()=='')?0:$(this).val();
            $.ajax({
                    type: 'POST'
                    , url: "{{ route('admin.update_answer') }}"
                    , data: {
                        '_token': '{{ csrf_token() }}',
                        'answer_id':$(this).attr('rel'),
                        'marks': $marks
                    , }
                });
        });

        $(document).on('change','.feedback',function(){
            $feedback = ($(this).val()=='')?'[[[clear]]]':$(this).val();
            $.ajax({
                    type: 'POST'
                    , url: "{{ route('admin.update_answer') }}"
                    , data: {
                        '_token': '{{ csrf_token() }}',
                        'answer_id':$(this).attr('rel'),
                        'feedback': $feedback
                    , }
                });
        });
        $(document).on('change','.feedback-attempt',function(){
            $.ajax({
                    type: 'POST'
                    , url: "{{ route('admin.update_attempt') }}"
                    , data: {
                        '_token': '{{ csrf_token() }}',
                        'attempt_id':$(this).attr('rel'),
                        'feedback': $(this).val()
                    , }
                });
        });

    });
</script>
@endsection
