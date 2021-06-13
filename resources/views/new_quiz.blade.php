@extends('layouts.app')

@section('title','Quiz')

@section('content')
<style>
    .timer-container {
        border: #D6D6EF 2px solid;
        border-radius: 20px;
    }

    .question {
        padding: 30px;
        text-align: justify;
    }

    .question-no {
        padding: 5px;
        background-color: #DCDCF1;
        border-radius: 10px;
        max-height: 36.8px;
        font-weight: bold;
    }

    .question-text {
        align-items: center;
        margin-top: auto;
        margin-bottom: auto;
        font-weight: bold;
        padding: 0px 10px;
    }

    .span_pseudo,
    .option span:before,
    .option span:after {
        content: "";
        display: inline-block;
        background: #fff;
        width: 0;
        height: 0.2rem;
        position: absolute;
        transform-origin: 0% 0%;
    }

    .option {
        position: relative;
        min-height: 2rem;
        display: flex;
        align-items: flex-start;
    }

    .option input {
        display: none;
    }

    .option input:checked~span {
        background: #44C385;
        border-color: #44C385;
    }

    .option input:checked~span:before {
        width: 1rem;
        height: 0.15rem;
        transition: width 0.1s;
        transition-delay: 0.3s;
    }

    .option input:checked~span:after {
        width: 0.4rem;
        height: 0.15rem;
        transition: width 0.1s;
        transition-delay: 0.2s;
    }

    .option input:disabled~span {
        background: #ececec;
        border-color: #dcdcdc;
    }

    .option input:disabled~label {
        color: #dcdcdc;
    }

    .option input:disabled~label:hover {
        cursor: default;
    }

    .option label {
        padding-left: 2rem;
        position: relative;
        z-index: 2;
        cursor: pointer;
        margin-bottom: 0;
        font-weight: normal !important;
        width: 100%;
        margin-bottom: 0px;
    }

    .option span {
        display: inline-block;
        width: 1.2rem;
        height: 1.2rem;
        border: 2px solid #ccc;
        position: absolute;
        left: 0;
        transition: all 0.2s;
        z-index: 1;
        box-sizing: content-box;
    }

    .option span:before {
        transform: rotate(-55deg);
        top: 1rem;
        left: 0.37rem;
    }

    .option span:after {
        transform: rotate(35deg);
        bottom: 0.35rem;
        left: 0.2rem;
    }

    .options {
        padding: 10px 50px;
    }

    .hint {
        height: 2rem;
        cursor: pointer;
    }

    .hint-text-container {
        padding: 20px 30px;
        position: relative;
    }

    .hint-text {
        padding: 10px;
        border: #D6D6EF solid 2px;
        border-radius: 20px;
    }

    .hint-append {
        position: absolute;
        top: .65rem;
        left: 20%;
        background-color: white;
        padding: 0px 5px;
    }

    .solution-text-container {
        padding: 20px 30px !important;
        position: relative !important;
    }

    .solution-text {
        padding: 10px !important;
        border: #D6D6EF solid 2px !important;
        border-radius: 20px !important;
    }

    .solution-append {
        position: absolute;
        top: .65rem !important;
        left: 3.5 !important;
        background-color: white;
        padding: 0px 5px !important;
    }


    .timer--clock * {
        cursor: default;
    }

    .timer--clock {
        position: relative;
    }

    .timer--clock .clock-display-grp {
        position: relative;
    }

    .timer--clock .clock-display-grp .number-grp {
        width: auto;
        display: block;
        height: 56px;
        float: left;
        overflow: hidden;
    }

    .timer--clock .clock-display-grp .number-grp .number-grp-wrp {
        width: 100%;
        position: relative;
    }

    .timer--clock .clock-display-grp .number-grp .number-grp-wrp .num {
        width: 100%;
        position: relative;
        height: 156px;
    }

    .timer--clock .clock-display-grp .number-grp .number-grp-wrp .num p {
        width: auto;
        display: table;
        font-size: 3rem;
        line-height: 55px;
        font-weight: bolder;
    }

    .minutes-group,
    .hours-group,
    .score-group,
    .seconds-group {
        display: flex;
        justify-content: space-around;
    }

    .minutes-group>.number-grp {
        color: #2927A3;
    }

    .score-group>.number-grp {
        color: #2927A3;
    }

    .hours-group>.number-grp {
        color: #2927A3;
    }

    .seconds-group>.number-grp {
        color: #FF8353;
    }

    .minutes-container,
    .score-container,
    .hours-container,
    .seconds-container {
        background-color: #F5F5FC;
        text-align: center;
        padding: 10px;
        margin: 10px;
        border-radius: 20px;
    }

    .counter-wrapper {
        padding-left: 5px !important;
        padding-right: 0px !important;
    }

    .counter-wrapper::first {
        padding-right: 5px !important;
    }

    /* side */
    .quiz-nav-btn {
        color: #8b8b8b;
        transition: transform 0.3s;
        outline: none !important;
        border: none;
        display: inline-block;
        background-color: transparent;
    }

    .quiz-nav-btn:hover {
        transform: scale(1.2);
    }

    .animate-left {
        animation: moveright 1s;
        animation-fill-mode: forwards;
    }

    @keyframes moveright {
        0% {
            position: relative;
            left: 5rem;
        }

        80% {
            opacity: 0;
        }

        100% {
            opacity: 0;
            left: 200rem;
        }
    }

    @media only screen and (max-width: 800px) {
        html {
            font-size: 60%;
        }
    }

    @media only screen and (max-width: 600px) {
        html {
            font-size: 58%;
        }

        .questions-2 {
            padding: 1rem 2rem !important;
        }
    }

    .progress {
        border-radius: 25px;
    }

    .progress-bar {
        background-color: #05C56B !important;
    }

    .quiz-card {
        min-height: 40rem;
    }

    @media screen and (max-width: 468px) {
        .options {
            padding: 5px 10px !important;
        }

        .time-indicator {
            margin-top: 5px;
        }

        .quiz-btn-container {
            min-width: 200px !important;
        }

        .submit-btn {
            margin-left: 3rem !important;
        }
    }

    .quiz-btn-container {
        width: 20%;
        display: flex;
        justify-content: space-around;
        min-width: 300px;
    }

    .quiz-btn {
        margin-top: 1.5rem;
        display: flex;
        justify-content: center
    }

    .submit-btn {
        background: #575FCF;
        color: white;
        font-size: 1rem !important;
        border-radius: 40px !important;
        padding: 1rem 2.5rem !important;
        margin-left: 5rem;
    }

    .label-text {
        margin-left: 3rem;
    }

    .btn-container {
        display: flex;
        align-items: flex-end;
        width: 100%;
        height: 70%;
    }

    .timer-container {
        border: #d6d6ef 2px solid;
        border-radius: 20px;
        padding: 8rem;
    }

    .question {
        padding: 3rem;
        text-align: justify;
    }

    .question-no {
        padding: 0.5rem;
        background-color: #dcdcf1;
        border-radius: 0.5rem;
        max-height: 2.68rem;
        font-weight: bold;
        margin-top: auto;
        margin-bottom: auto;
    }

    .question-text {
        align-items: center;
        margin-top: auto;
        margin-bottom: auto;
        font-weight: bold;
        padding: 0px 1rem;
    }

    .hint {
        height: 2rem;
    }

    .hint-text-container {
        padding: 1.4rem 2.1rem;
        position: relative;
    }

    .hint-text {
        padding: 1.5rem 1.5rem !important;
        border: #d6d6ef solid 2px !important;
        border-radius: 20px !important;
    }

    .hint-append {
        position: absolute;
        top: 0.65rem;
        left: 3.5rem;
        background-color: white;
        padding: 0px 5px;
    }

    .courses-form {
        width: 15rem !important;
    }

    /* clock */
    .clock {
        width: 50px;
        height: 50px;
        background-color: #f2f1f9;
        border-radius: 100px;
        position: relative;
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .clock-img {
        width: 60%;
    }

    .btn-quiz {
        padding: 1rem 1.2rem;
        background: #575FCF;
        border-radius: 100%;
        color: white;
    }

    #hr,
    #mi,
    #se {
        position: absolute;
        background-color: black;
        border-radius: 0.2rem;
    }

    .hour {
        width: 5%;
        height: 1.3rem;
        top: 28%;
        left: 49.5%;
        transform-origin: bottom;
        transform: rotate(140deg);
    }

    .minute {
        width: 4%;
        height: 1.5rem;
        top: 25%;
        left: 49.5%;
        background-color: red !important;
        z-index: 10000;
        transform-origin: bottom;
        transform: rotate(10deg);
    }

    .second {
        width: 3%;
        height: 1.8rem;
        top: 20.5%;
        left: 49.5%;
        background-color: blue !important;
        transform-origin: bottom;
        transform: rotate(250deg);
    }

    /* time-indicatior */
    .time-indicator {
        display: flex;
        justify-content: flex-end;
        align-items: center;
    }

    .time-counter {
        margin: 0rem 2rem;
    }

    .ck-editor__editable,
    textarea {
        min-height: 0px;
    }

    .option-wrapper {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 0rem 0.5rem;
        border: 0.5px solid #808E9B;
        cursor: pointer;
        margin-bottom: 2rem;
        border-radius: 3px;
    }

    .option-wrapper.active {
        transform: translateZ(1.1);
        background-color: #fff;
        border-left: 7px solid #575fcf;
        filter: drop-shadow(0px 3px 20px rgba(0, 0, 0, 0.1));
    }

    .option-wrapper-label {
        margin-bottom: 0px;
        margin-left: 2rem;
        order: 1;
        cursor: pointer;
        position: relative;
        flex-basis: 100%;
    }

    .input-radio {
        order: 2;
        margin-right: 2rem;
        visibility: hidden;
    }

    .radio-container {
        width: 1.5rem;
        height: 1.5rem;
        border-radius: 50%;
        border: 0.1rem solid #575fcf;
        display: inline-block;
        position: absolute;
        right: -1rem;
        top: .9rem;
    }

    .radio-container::after {
        content: "";
        width: 0.8rem;
        height: 0.8rem;
        background-color: #575fcf;
        display: block;
        border-radius: 50%;
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        opacity: 0;
    }

    .input-radio:checked~.option-wrapper-label .radio-container::after {
        opacity: 1;
    }

    .checkbox-container {
        width: 1.5rem;
        height: 1.5rem;
        border: 0.1rem solid #575fcf;
        display: inline-block;
        position: absolute;
        right: -1rem;
        top: .9rem;
    }

    .checkbox-container::after {
        content: "";
        width: 0.8rem;
        height: 0.8rem;
        background-color: #575fcf;
        display: block;
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        opacity: 0;
    }

    .input-checkbox:checked~.option-wrapper-label .checkbox-container::after {
        opacity: 1;
    }

    .solution {
        height: 2rem;
    }

    .solution {
        height: 2rem;
        cursor: pointer;
    }

    .answer-container {
        border: 1px #0e7fe1 solid;
        position: relative;
        border-radius: 8px;
    }

    .answer-append {
        position: absolute;
        top: -.5rem;
        left: 1rem;
        background-color: white;
        padding: 0px 10px 0px 10px;
        font-size: .7rem;
    }

    .ck.ck-editor__editable:not(.ck-editor__nested-editable).ck-rounded-corners {
        border-radius: 8px;
    }
</style>
<div class="live-test-wrapper">
    <div class="row d-flex justify-content-center cover">
        <div class="col-lg-10">
            <div class="card quiz-card">
                <div class="card-body">
                    <div class="card__header row">
                        <div class="row w-100">
                            <div class="col-md-3">
                                <div class="mt-3">
                                    <h4>Practice Test</h4>
                                </div>
                            </div>
                            <div class="col-md-5">
                                <small class="progress-percent">0%</small>
                                <div class="progress">
                                    <div class="progress-bar"></div>
                                </div>
                            </div>
                            <div class="time-indicator col-md-4 d-none">
                                <div class="clock">
                                    <img class="clock-img" src="{{asset('img/clock.svg')}}">
                                </div>
                                <div class="time-counter">
                                    <span class="timer"></span>
                                    <div><small class="ml-auto">Time left</small></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <br />
                    <div>
                        Question <span class="question-no-span"></span> out of <span class="total-question-span"></span>
                    </div>
                    <div class="question-container">
                        <div class="question" rel="">
                            <div class="row">
                                <div class="question-no">Q.<span class="question_no_span"></span></div>
                                <div class="question-text col-md-10">
                                    <div id="question-editor"> </div>
                                </div>
                                <span class="solution-container ml-auto"><img data-toggle="tooltip" src=""
                                        class="solution" /></span>
                                <span class="hint-container ml-auto"><img data-toggle="tooltip" src=""
                                        class="hint" /></span>
                            </div>
                            <div class="hint-text-container d-none">
                                <div class="hint-text" id="hint-editor">
                                </div>
                                <div class="hint-append">Hint</div>
                            </div>
                            <div class="solution-text-container d-none">
                                <div class="solution-text" id="solution-editor">
                                </div>
                                <div class="solution-append">Solution</div>
                            </div>
                            <div class="options">
                                <div class="row">
                                    <div class="option-wrapper col-md-12">
                                        <input id="" type="checkbox" class="input-radio" name="option" value="" />
                                        <label for="" class="option-wrapper-label">
                                            <div class="readonly-option-editor label-text" id="option-1">
                                            </div><span class="radio-container"></span>
                                        </label>
                                    </div>
                                    <div class="option-wrapper col-md-12">
                                        <input id="" type="checkbox" class="input-radio" name="option" value="" />
                                        <label for="" class="option-wrapper-label">
                                            <div class="readonly-option-editor label-text" id="option-2">
                                            </div><span class="radio-container"></span>
                                        </label>
                                    </div>
                                    <div class="option-wrapper col-md-12">
                                        <input id="option-" type="checkbox" class="input-radio" name="option"
                                            value="" />
                                        <label for="option-" class="option-wrapper-label">
                                            <div class="readonly-option-editor label-text" id="option-3">
                                            </div><span class="radio-container"></span>
                                        </label>
                                    </div>
                                    <div class="option-wrapper col-md-12">
                                        <input id="option-" type="checkbox" class="input-radio" name="option"
                                            value="" />
                                        <label for="option-" class="option-wrapper-label">
                                            <div class="readonly-option-editor label-text" id="option-4">
                                            </div><span class="radio-container"></span>
                                        </label>
                                    </div>
                                </div>
                                <div class="answer-container d-none">
                                    <div class="answer" id="answer-editor">
                                    </div>
                                    <div class="answer-append">Write your answer</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="quiz-btn">
    <div class="quiz-btn-container">
        <button class="prev quiz-nav-btn">
            <span class="btn-quiz"><i class="fas fa-arrow-left"></i></span>&nbsp;<span>Previous</span>
        </button>
        <button class="next quiz-nav-btn">
            <span>Next</span>&nbsp;<span class="btn-quiz"><i class="fas fa-arrow-right"></i></span>
        </button>
    </div>
    <div>
        <button class="btn submit-btn submit">Submit</button>
    </div>
</div>

@endsection
@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/js-cookie@rc/dist/js.cookie.min.js"></script>
<script>
    let $question_editor;
    InlineEditor.create( document.querySelector('#question-editor'), {
                image: {
        toolbar: [
            'imageTextAlternative',
            'imageStyle:full',
            'imageStyle:side'
        ]
    },
                isReadOnly: true,
            }) .then( editor => {
                $question_editor = editor;
                editor.isReadOnly = true;
    } );
    let $hint_editor;
    InlineEditor.create( document.querySelector('#hint-editor'), {
                image: {
        toolbar: [
            'imageTextAlternative',
            'imageStyle:full',
            'imageStyle:side'
        ]
    },
                isReadOnly: true,
            }) .then( editor => {
                $hint_editor = editor;
                editor.isReadOnly = true;
    } );

    let $solution_editor;
    InlineEditor.create( document.querySelector('#solution-editor'), {
                image: {
        toolbar: [
            'imageTextAlternative',
            'imageStyle:full',
            'imageStyle:side'
        ]
    },
                isReadOnly: true,
            }) .then( editor => {
                $solution_editor = editor;
                editor.isReadOnly = true;
    } );

    let $option_editors = [];
    $('.readonly-option-editor').each(function(i,ele){
        InlineEditor.create( document.querySelector('#'+$(this).attr('id')), {
                image: {
        toolbar: [
            'imageTextAlternative',
            'imageStyle:full',
            'imageStyle:side'
        ]
    },
                isReadOnly: true,
            }) .then( editor => {
                $option_editors.push(editor);
                editor.isReadOnly = true;
    } );
    });

    let $answer_editor;
        InlineEditor.create( document.querySelector('#answer-editor'), answerConfig
        ) .then( editor => {
                $answer_editor = editor;
    } );
    $(function () {
        let editors = [];
        var quiz = [];
        var $answer = [];
        var $attempt;
        var $question_no = 1;
        var $total_question = 0;
        var $user_id = '{{auth()->user()->id }}';
        let timer;
        let answerInterval;
        let $left_time = null;
        let $time_answer = [];
        let $timers = [];
        //question from ajax
        $.ajax({
            url: "{{route('get_question',$quiz)}}"
            , async: false
            , dataType: 'json'
            , success: function(json) {
                quiz = json;
                $total_question = quiz.questions.length;
                $('.total-question-span').html($total_question);
            }
        });
        function setCookie(cname, cvalue, exdays) {
            Cookies.set(cname, cvalue, { expires: exdays});
        }

        // fuction to get cookie
        function getCookie(cname) {
            return Cookies.get(cname) ;
        }

        if (getCookie('attempt_' + quiz.id + '_' + $user_id) == '' || getCookie('attempt_' + quiz.id + '_' + $user_id) == undefined) {
            $.ajax({
                type: 'POST'
                ,async:false
                , url: "{{ route('test_store') }}"
                , headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                , }
                , data: {
                     'quiz': quiz.id
                    , 'user': $user_id
                , }
                , success: function(data){
                    $attempt = data;
                }
            , });
            setCookie('attempt_' + quiz.id + '_' + $user_id,JSON.stringify($attempt));
        }else{
            $attempt = JSON.parse(getCookie('attempt_' + quiz.id + '_' + $user_id));
        }

        if (getCookie('answer_'+quiz.id + '_' + $user_id) != undefined) {
            $answer = JSON.parse(getCookie('answer_'+quiz.id + '_' + $user_id));
        }
        if (getCookie('time_answer_'+quiz.id + '_' + $user_id) != undefined) {
            $time_answer = JSON.parse(getCookie('time_answer_'+quiz.id + '_' + $user_id));
        }
        if (getCookie('question_no_' + quiz.id + '_' + $user_id) != undefined) {
            $question_no = parseInt(getCookie('question_no_' + quiz.id + '_' + $user_id));
        }
        if(quiz.time!=null){
            switch(quiz.time_type){
                case 1:
                    time = quiz.time*60;
                    break;
                case 2:
                time = quiz.time*60*60;
                    break;
                default:
                time = quiz.time;
                break;
            }
            time *= 1000;
            $date =new Date($attempt.created_at);
            $now  = new Date();
            $leftTime = (($date.getTime()+time)-$now)/(1000*60);
            if($leftTime<0){
                submit();
            }
            setLogoutTimer($leftTime,'quiz');
            $('.time-indicator').removeClass('d-none');
        }

        getQuestion($question_no);

        function getQuestion($ele) {
            clearInterval(answerInterval);
            $answer_editor.setData('');
            $ele--;
            setCookie('question_no_' + quiz.id + '_' + $user_id, $question_no, 1);
            //disabling prev and next button
            if ($question_no != 1) {
                $('.prev').removeClass('d-none');
                $('.prev').prop('disabled', false);
            } else {
                $('.prev').addClass('d-none');
                $('.prev').prop('disabled', true);
            }
            if ($question_no <= $total_question) {
                $('.next').removeClass('d-none');
                $('.next').prop('disabled', false);
            } else {
                $('.next').addClass('d-none');
                $('.next').prop('disabled', true);
            }
            //updating question as per question number
            let is_time_up = false;
            if(quiz.questions[$ele].time != null){
                switch(quiz.questions[$ele].time_type){
                case 1:
                    time = quiz.questions[$ele].time;
                    break;
                case 2:
                time = quiz.questions[$ele].time*60;
                    break;
                default:
                time = quiz.questions[$ele].time/60;
                break;
            }
            // $('.prev').remove();
            $.each($time_answer,function(i,data){
                if(data.question_id == quiz.questions[$ele].id){
                    time = data.time;
                    if(time<=0){
                        is_time_up = true;
                    }
                }
            });
            if(is_time_up){
                $('.option-wrapper').addClass('d-none');
            }else{
                $timers.push({"timer":setLogoutTimer(time,'question'),"question_no":quiz.questions[$ele].id});
            }
            $('.time-indicator').removeClass('d-none');
            }
            $('.option-wrapper').addClass('d-none');
            $('.answer-container').addClass('d-none');
            switch (quiz.questions[$ele].type) {
                case "Multiple Choices":
                    $.each(quiz.questions[$ele].question_options, function(i, ele) {
                       renderOption(i,ele,is_time_up=is_time_up);
                    });
                    break;
                case "True or False":
                $.each(quiz.questions[$ele].question_options, function(i, ele) {
                       renderOption(i,ele,is_time_up=is_time_up);
                    });;
                    break;
                case "Multiple Answers":
                $.each(quiz.questions[$ele].question_options, function(i, ele) {
                       renderOption(i,ele,'checkbox',is_time_up=is_time_up);
                    });
                    break;
                case "Short Answer":
                    $('.answer-container').removeClass('d-none');
                    answerInterval = setInterval(function() {
                        localStorage.setItem('short_answer_'+quiz.questions[$ele].id+ '_' + $user_id,$answer_editor.getData());
                    }, 5000);
                    break;
            }
            $question_template = renderQuestion($question_no,quiz.questions[$ele].question_text,quiz.questions[$ele].question_hint,quiz.questions[$ele].id,quiz.answer_view,quiz.questions[$ele].answer_explanation);

            $('[data-toggle="tooltip"]').tooltip();

    //progress bar
    progress = ($answer.length/$total_question)*100;
    $('.progress-bar').css('width',progress+'%');
    $('.progress-percent').html(parseInt(progress)+'%');
    //selecting selected answers
    selectOption();
        }

        function selectOption() {
            $.each($answer, function(i, ele) {
                if (ele.question_id == quiz.questions[$question_no-1].id) {
                    if(ele.options == 'text_answer'){
                        $answer_editor.setData(localStorage.getItem('short_answer_'+quiz.questions[$question_no-1].id + '_' + $user_id));
                    }else{
                    $.each(ele.options, function(key, val) {
                        $("#option-" + val).trigger('click');
                    });
                }
                }
            });
        }

        function renderQuestion(question_no,question_text,hint_text,question_id,answer_available,solution_text){
            $('.hint-text-container').addClass('d-none');
            $('.hint').removeClass('show');
            $('.question').addClass(`questions-${question_no}`).attr('rel',`${question_id}`);
            $('.question-no').html('Q.'+question_no);
            $('.question-no-span').html(question_no);
            $question_editor.setData(question_text);
            if(answer_available == 'during_quiz'){
                $('.solution').attr('src',"{{asset('solution.png')}}").attr('data-original-title','Solution available').addClass('active');
                $solution_editor.setData(solution_text);
            }else{
                $('.solution').attr('src',"").attr('data-original-title','No Solution available').removeClass('active');
                $solution_editor.setData('');
            }
            if(hint_text != undefined){
            $hint_editor.setData(hint_text);
            }
            if(solution_text != undefined && !answer_available == 'during_quiz' ){
                $solution_editor.setData(solution_text);
            }
            hint = (hint_text != null)?'hint_on':'hint_off';
            if (hint == 'hint_on'){
                $('.hint').attr('src',"{{asset('img/hint_on.svg')}}").attr('data-original-title','Hint available').addClass('active');
                $hint_editor.setData(hint_text);
            }else{
                $('.hint').attr('src',"{{asset('img/hint_off.svg')}}").attr('data-original-title','No Hint available').removeClass('active');
                $hint_editor.setData('');
            }
        }

        function renderOption(option_no,ele,option_type='radio',is_time_up=false){
            let $option_wrapper = $('.option-wrapper')[option_no];
            if(!is_time_up){
                $($option_wrapper).removeClass('d-none').removeClass('active');
            }
            $($option_wrapper).find('input').attr('id','option-'+ele.id).val(ele.id);
            if(option_type == 'checkbox'){
                $($option_wrapper).find('input').attr('type','checkbox').prop("checked", false);
                $($option_wrapper).find('.radio-container').css('border-radius','0');
            }else{
                $($option_wrapper).find('input').attr('type','radio').prop("checked", false);
                $($option_wrapper).find('.radio-container').css('border-radius','50%');
            }
            $($option_wrapper).find('label').attr('for','option-'+ele.id);
            $option_editors[option_no].setData(ele.option_text);
        }

        //when next btn is clicked
        $(document).on('click', '.next', function() {
            var selected_options = [];
            $.each($("input[name='option']:checked"), function() {
                selected_options.push($(this).val());
            });
            if(quiz.questions[$question_no-1].time == null){
                $left_time = null;
            }
            addAnswer(selected_options,$left_time);
            if(!quiz.time){
                // clearInterval(timer);
                $('.time-indicator').addClass('d-none');
            }
            $.each($("input[name='option']"), function() {
                $(this).prop('checked',false);
            });
            if($question_no<$total_question){
                $question_no++;
            getQuestion($question_no);
            }else{
            getQuestion($question_no);
            }
        });

        function addAnswer(option,time=null) {
            var $question_id = quiz.questions[$question_no-1].id;
            if(quiz.questions[$question_no-1].type == "Short Answer"){
                if($answer_editor.getData() != ''){
                    option = "text_answer";
                localStorage.setItem('short_answer_'+$question_id + '_' + $user_id,$answer_editor.getData());
                }
            }
            if(option.length!=0){
            $answer.map(function(ele,i){
                if (ele.question_id == $question_id) {
                        $answer.splice(i, 1);
                }
            });
            $ans = {
                'question_id': $question_id
                , 'options': option
            }
            $answer.push($ans);
            setCookie('answer_'+quiz.id + '_' + $user_id, JSON.stringify($answer), 1);
            }
            if(time!=null){
            $time_answer.map(function(ele,i){
            if (ele.question_id == $question_id) {
                    $time_answer.splice(i, 1);
            }
            });
            $time_answer.push({
                'question_id': $question_id
                , 'options': (option == 0) ? 0:option
                ,'time' : time
            });
            setCookie('time_answer_'+quiz.id + '_' + $user_id, JSON.stringify($time_answer), 1);
            }
        }

        //when prev button is clicked
        $(document).on('click', '.prev', function() {
            var selected_options = [];
            $.each($("input[name='option']:checked"), function() {
                selected_options.push($(this).val());
            });
            if(quiz.questions[$question_no-1].time == null){
                $left_time = null;
            }
            addAnswer(selected_options,$left_time);
            if(!quiz.time){
                // clearInterval(timer);
                $('.time-indicator').addClass('d-none');
            }
            $.each($("input[name='option']"), function() {
                $(this).prop('checked',false);
            });
            if($question_no>0){
                $question_no--;
            getQuestion($question_no);
            }else{
            getQuestion($question_no);
            }
        });


        $(document).on('click','.hint.active',function(){
            $('.hint-text-container').removeClass('d-none');
            $(this).addClass('show');
        });
        $(document).on('click','.hint.active.show',function(){
            $('.hint-text-container').addClass('d-none');
            $(this).removeClass('show');
        });
        $(document).on('click','.solution.active',function(){
            $('.solution-text-container').removeClass('d-none');
            $(this).addClass('show');
        });
        $(document).on('click','.solution.active.show',function(){
            $('.solution-text-container').addClass('d-none');
            $(this).removeClass('show');
        });

        $(document).on('change',"input[name='option']",function(){
            $(this).parents('.option-wrapper').addClass('active');
            $("input[name='option']:not(:checked)").each(function(i,ele){
                $(ele).parents('.option-wrapper').removeClass('active');
            });

        });
        // $(document).on('click','.option-wrapper-label',function(){
        //     if($(this).parents('.option-wrapper').hasClass('active')){
        //         $(this).parents('.option-wrapper').removeClass('active');
        //     }else{
        //         $(this).parents('.option-wrapper').addClass('active');
        //     }
        // });

        $(document).on('click', '.submit', function() {
            var selected_options = [];
            $.each($("input[name='option']:checked"), function() {
                selected_options.push($(this).val());
            });
            addAnswer(selected_options);
            clearInterval(answerInterval);
            submit();
        });

        function submit(){
            console.log($answer);
            let finalAnswer = [];
            $.each($answer,function(i,element){
                ele = element;
                if(ele.options == "text_answer"){
                    ele.options = localStorage.getItem('short_answer_'+ele.question_id + '_' + $user_id);
                }
                finalAnswer.push(ele);
            });
            console.log(finalAnswer);
            $.ajax({
                type: 'POST'
                , url: "{{ route('test_update') }}"
                , headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                , }
                , data: {
                    'answers': finalAnswer
                    , 'quiz': quiz.id
                    , 'user': $user_id
                    ,'attempt': $attempt.id
                , }
                ,success: function(data) {
                    Cookies.remove('attempt_' + quiz.id + '_' + $user_id);
                    Cookies.remove('answer_' + quiz.id + '_' + $user_id);
                    Cookies.remove('question_no_' + quiz.id + '_' + $user_id);
                    window.location.replace("/response/"+$attempt.id);
                }
            , });
        }


    function getReadOnlyEditor(id){
    //
    }


    function setLogoutTimer (minutes,type) {
        let updateTimer = document.querySelector(".timer");
        const tick = function () {
          let hour = String(Math.trunc(time / (60 * 60))).padStart(2, 0);
          let minute =
            time / 60 >= 60? String(Math.trunc(time / 60) - Math.trunc(time / (60 * 60)) * 60)
              : String(Math.trunc(time / 60)).padStart(2, 0);
          let second = String(parseInt(time % 60)).padStart(2,0);
          const stringTimer =+hour <= 0? `${minute}:${second}` : `${hour}:${minute}:${second}`;
          updateTimer.textContent = stringTimer;
          $left_time = time/60;
          //if time = 0

        if (parseInt(time) === 0) {
            if (type == 'quiz'){
                submit();
            }else{
                if(timer_question_id == quiz.questions[$question_no-1].id){
                var selected_options = [];
                $.each($("input[name='option']:checked"), function() {
                    selected_options.push($(this).val());
                });
                addAnswer(selected_options,time=$left_time);
                if($question_no<$total_question){
                    $question_no++;
                getQuestion($question_no);
                }else{
                getQuestion($question_no);
                }
            }
        }
                $time_answer.map(function(ele,i){
                if (ele.question_id == timer_question_id) {
                        $time_answer.splice(i, 1);
                }
                });
                $time_answer.push({
                    'question_id': timer_question_id
                    ,'time' : time/60
                });
                setCookie('time_answer_'+quiz.id + '_' + $user_id, JSON.stringify($time_answer), 1);
                clearInterval(timer);
                updateTimer.textContent = 'Time Up';
                $('.time-indicator').addClass('d-none');
        }
            if(timer_question_id != undefined){
                $time_answer.map(function(ele,i){
            if (ele.question_id == timer_question_id) {
                    $time_answer.splice(i, 1);
            }
            });
            $time_answer.push({
                'question_id': timer_question_id
                ,'time' : time/60
            });
            setCookie('time_answer_'+quiz.id + '_' + $user_id, JSON.stringify($time_answer), 1);
            }

          //delay
          time--;
        };
        // conversion
        let intoSeconds = minutes * 60;
        let time = intoSeconds;
        let timer_question_id = quiz.questions[$question_no-1].id
        tick();
        try{
        clearInterval(timer);
        }finally{

        }
        timer = setInterval(tick, 1000);
        return timer;
      };

});

</script>
@endsection
