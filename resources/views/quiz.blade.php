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
                    <div class="question-container">
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
<script>
    $(function () {

        var quiz = [];
        var $answer = [];
        var $attempt;
        var $question_no = 1;
        var $total_question = 0;
        var $user_id = '{{auth()->user()->id }}';
        let timer;

        //question from ajax
        $.ajax({
            url: "{{route('get_question',$quiz)}}"
            , async: false
            , dataType: 'json'
            , success: function(json) {
                quiz = json;
                $total_question = quiz.questions.length;
            }
        });
        function setCookie(cname, cvalue, exdays) {
            d = new Date();
            d.setTime(d.getTime() + (exdays * 24 * 60 * 60 * 1000));
            expires = "expires=" + d.toUTCString();
            document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/;";
        }

        // fuction to get cookie
        function getCookie(cname) {
            name = cname + "=";
            ca = document.cookie.split(';');
            for (i = 0; i < ca.length; i++) {
                c = ca[i];
                while (c.charAt(0) == ' ') {
                    c = c.substring(1);
                }
                if (c.indexOf(name) == 0) {
                    return c.substring(name.length, c.length);
                }
            }
            return "";
        }
        if (getCookie('attempt_' + quiz.id + '_' + $user_id) == '' || getCookie('attempt_' + quiz.id + '_' + $user_id) == 'undefined') {
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


        if (getCookie('answer_'+quiz.id + '_' + $user_id) != '') {
            $answer = JSON.parse(getCookie('answer_'+quiz.id + '_' + $user_id));
        }
        if (getCookie('question_no_' + quiz.id + '_' + $user_id) != '') {
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
            console.log(time);
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
            $ele--;
            setCookie('question_no_' + quiz.id + '_' + $user_id, $question_no, 1);
            //disabling prev and next button
            if ($question_no != 1) {
                $('.prev').prop('disabled', false);
            } else {
                $('.prev').prop('disabled', true);
            }
            if ($question_no <= $total_question) {
                $('.next').prop('disabled', false);
            } else {
                $('.next').prop('disabled', true);
            }
            //updating question as per question number
            $options = '';
            console.log(quiz.questions[$ele].time);
            console.log(quiz.questions[$ele].time_type);
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
            $('.prev').remove();
            setLogoutTimer(time,'question');
            $('.time-indicator').removeClass('d-none');
            }
            switch (quiz.questions[$ele].type) {
                case "Multiple Choices":
                    $.each(quiz.questions[$ele].question_options, function(i, ele) {
                        $options += renderOption(i,ele);
                    });
                    break;
                case "True or False":
                $.each(quiz.questions[$ele].question_options, function(i, ele) {
                        $options += renderOption(i,ele);
                    });;
                    break;
                case "Multiple Answers":
                $.each(quiz.questions[$ele].question_options, function(i, ele) {
                        $options += renderOption(i,ele,'checkbox');
                    });
                    break;
            }
            $question_template = renderQuestion($question_no,quiz.questions[$ele].question_text,quiz.questions[$ele].question_hint,$options,quiz.questions[$ele].id);
            $('.question-container').html($question_template);
            console.log(quiz.questions[$ele].time);

            $('[data-toggle="tooltip"]').tooltip();
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
                editor.setData(""+value);
            });
    });

    //progress bar
    progress = ($answer.length/$total_question)*100;
    console.log($answer.length);
    $('.progress-bar').css('width',progress+'%');
    $('.progress-percent').html(parseInt(progress)+'%');
    //selecting selected answers
    selectOption();
        }

        function selectOption() {
            $.each($answer, function(i, ele) {
                if (ele.question_id == quiz.questions[$question_no-1].id) {
                    $.each(ele.options, function(key, val) {
                        $("#option-" + val).trigger('click');
                    });
                }
            });
        }

        function renderQuestion(question_no,question_text,hint_text,option,question_id){
            hint = (hint_text != null)?'hint_on':'hint_off';
            return `<div class="questions-${question_no} question" rel="${question_id}">
                            <div class="row">
                                <div class="question-no">Q.${question_no}</div>
                                <div class="question-text col-md-11">
                                    <div class="readonly-editor" id="q${question_no}">
                                        ${question_text} </div>
                                </div>
                                <span class="hint-container ml-auto"><img data-toggle="tooltip" title="${(hint == 'hint_off')?'No':''} Hint available"
                                        src="{{asset('img/${hint}.svg')}}" class="hint ${(hint == 'hint_on')?'active':''}" /></span>
                            </div>
                            <div class="hint-text-container d-none">
                                <div class="hint-text readonly-editor" id="h${question_no}">
                                    ${hint_text}
                                </div>
                                <div class="hint-append">Hint</div>
                            </div>
                            <div class="options">
                                <div class="row">
                                    ${option}
                                </div>
                            </div>
                        </div>`;
        }

        function renderOption(option_no,ele,option_type='radio'){
            return `<div class="option-wrapper col-md-12">
                            <input
                              id="option-${ele.id}"
                              type="${(option_type=='checkbox')?'checkbox':'radio'}"
                              class="input-radio"
                              name="option"
                              value="${ele.id}"
                            />
                            <label for="option-${ele.id}" class="option-wrapper-label"
                              ><div class="readonly-editor label-text" id="l${option_no}">
                                            ${ele.option_text}</div><span class="radio-container"></span>
                            </label>
                          </div>`;
            return `<div class="col-md-6">
                                    <div class="option">
                                        <input id="option-${ele.id}" name="option" type="${(option_type=='checkbox')?'checkbox':'radio'}" value="${ele.id}" />
                                        <label for="option-${ele.id}"><div class="readonly-editor label-text" id="l${option_no}">
                                            ${ele.option_text}</div></label><span></span>
                                    </div>
                                </div>`;
        }


        //when next btn is clicked
        $(document).on('click', '.next', function() {
            var selected_options = [];
            $.each($("input[name='option']:checked"), function() {
                selected_options.push($(this).val());
            });
            addAnswer(selected_options);
            if($question_no<$total_question){
                $question_no++;
            getQuestion($question_no);
            }else{
            getQuestion($question_no);
            }
        });

        function addAnswer(option) {
            var $question_id = quiz.questions[$question_no-1].id;
            if(option.length!=0){
            $answer.map(function(ele,i){
                if (ele.question_id == $question_id) {
                        $answer.splice(i, 1);
                }
            });
                $answer.push({
                'question_id': $question_id
                , 'options': option
            });
            setCookie('answer_'+quiz.id + '_' + $user_id, JSON.stringify($answer), 1);
            }
        }

        //when prev button is clicked
        $(document).on('click', '.prev', function() {
            var selected_options = [];
            $.each($("input[name='option']:checked"), function() {
                selected_options.push($(this).val());
            });
            addAnswer(selected_options);
            if($question_no>0){
                $question_no--;
            getQuestion($question_no);
            }else{
            getQuestion($question_no);
            }
        });

        $(document).on('click','.hint.active',function(){
            $('.hint-text-container').removeClass('d-none');
        });
        $(document).on('change',"input[name='option']:checked",function(){
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
            submit();
        });

        function submit(){
            $.ajax({
                type: 'POST'
                , url: "{{ route('test_update') }}"
                , headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                , }
                , data: {
                    'answers': $answer
                    , 'quiz': quiz.id
                    , 'user': $user_id
                    ,'attempt': $attempt.id
                , }
                ,success: function(data) {
                    setCookie('attempt_' + quiz.id + '_' + $user_id,'');
                    setCookie('answer_' + quiz.id + '_' + $user_id,'');
                    setCookie('question_no_' + quiz.id + '_' + $user_id,'');
                    window.location.replace("/response/"+$attempt.id);
                }
            , });
        }


    function getReadOnlyEditor(id){
        InlineEditor.create( document.querySelector( id ), {
                image: {
        toolbar: [
            'imageTextAlternative',
            'imageStyle:full',
            'imageStyle:side'
        ]
    },
                isReadOnly: true,
            }) .then( editor => {
                if(value!=undefined){
                editor.setData(value);
                }
                editor.isReadOnly = true;
    } );
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
          //if time = 0

        if (parseInt(time) === 0) {
            if (type == 'quiz'){
                submit();
            }else{
                var selected_options = [];
                $.each($("input[name='option']:checked"), function() {
                    selected_options.push($(this).val());
                });
                addAnswer(selected_options);
                if($question_no<$total_question){
                    $question_no++;
                getQuestion($question_no);
                }else{
                getQuestion($question_no);
                }
            }
            clearInterval(timer);
              updateTimer.textContent = 'Time Up';
            if($total_question == $question_no){
                submit();
            }
        }

          //delay
          time--;
        };
        // conversion
        let intoSeconds = minutes * 60;
        let time = intoSeconds;
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
