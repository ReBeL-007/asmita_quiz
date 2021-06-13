<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"
        integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/flipclock/0.7.8/flipclock.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.14.0/css/all.min.css"
        integrity="sha512-1PKOgIY59xJ8Co8+NE6FZ+LOAZKjy+KY8iq0G4B3CyeY6wYHN3yt9PW0XpSriVlkMXe40PTKnXrLnZ9+fkDaog=="
        crossorigin="anonymous" />
    <title>Quiz</title>
    <style>
        .question {

            background-color: #75ba48;
            padding: 20px;
            color: #fff;
            border-bottom-right-radius: 55px;
            border-top-left-radius: 55px;
            min-height: 5rem;
            width: 100%;
        }

        .question-info {
            margin-bottom: 400px;
        }

        #question {
            margin-left: 20px;
        }

        .question-numbers {
            display: flex !important;
            align-items: center;
            justify-content: center !important;
            min-height: 100px;
        }

        .question-nav>.nav-btns>button {
            height: 40px;
            background-color: gray;
            color: white;
            margin-left: 5px;
            font-size: 2rem;
        }

        .nav-btns {
            float: right !important;
        }

        .circle {
            border: solid 1.5px #75ba48;
            height: 4rem;
            width: 4rem;
            border-radius: 50%;
            display: flex !important;
            align-items: center;
            justify-content: center !important;
            cursor: pointer;
        }

        .question-nav {
            width: 100%;
            min-height: 50px;
            height: 5%;
        }

        .circle.active {
            background-color: #76ba4888;
        }

        .circle.selected {
            background-color: #489aba88;
            border: solid 1.5px #489aba88;
        }

        .circle:not(:first-child) {
            margin-left: 60px;
        }

        .card {
            min-height: 90vh !important;
            border-radius: 55px;
            padding: 40px;
            box-shadow: 0 19px 38px rgba(0, 0, 0, 0.30), 0 15px 12px rgba(0, 0, 0, 0.22);
        }

        .question-number {
            background-color: white;
            color: gray;
        }

        .container ul {
            list-style: none;
            margin: 0;
            padding: 0;
        }


        ul li {
            display: block;
            position: relative;
            float: left;
            width: 100%;
            height: 80px;
            border-bottom: 1px solid #111111;
        }

        ul li input[type=radio] {
            position: absolute;
            visibility: hidden;
        }

        ul {
            width: 100%;
            margin-right: 40px;
        }

        ul li label {
            display: block;
            position: relative;
            font-weight: 300;
            font-size: 1.35em;
            padding: 25px 25px 25px 80px;
            margin: 10px auto;
            height: 30px;
            z-index: 9;
            cursor: pointer;
            -webkit-transition: all 0.25s linear;
        }

        ul li:hover label {
            color: #75ba48;
        }

        ul li .check {
            display: block;
            position: absolute;
            border: 5px solid #AAAAAA;
            border-radius: 100%;
            height: 30px;
            width: 30px;
            top: 30px;
            left: 20px;
            z-index: 5;
            transition: border .25s linear;
            -webkit-transition: border .25s linear;
        }

        ul li:hover .check {
            border: 5px solid #75ba48;
        }

        ul li .check::before {
            display: block;
            position: absolute;
            content: '';
            border-radius: 100%;
            height: 14px;
            width: 14px;
            top: 3px;
            left: 3px;
            margin: auto;
            transition: background 0.25s linear;
            -webkit-transition: background 0.25s linear;
        }

        input[type=radio]:checked~.check {
            border: 5px solid #75ba48;
        }

        input[type=radio]:checked~.check::before {
            background: #75ba48;
            /*attr('data-background');*/
        }

        input[type=radio]:checked~label {
            color: #75ba48;
        }

        ul li .checkbox {
            display: block;
            position: absolute;
            border: 5px solid #AAAAAA;
            height: 30px;
            width: 30px;
            top: 30px;
            left: 20px;
            z-index: 5;
            transition: border .25s linear;
            -webkit-transition: border .25s linear;
        }

        ul li:hover .checkbox {
            border: 5px solid #75ba48;
        }

        ul li .checkbox::before {
            display: block;
            position: absolute;
            content: '';
            height: 14px;
            width: 14px;
            top: 3px;
            left: 3px;
            margin: auto;
            transition: background 0.25s linear;
            -webkit-transition: background 0.25s linear;
        }

        input[type=checkbox]:checked~.checkbox {
            border: 5px solid #75ba48;
        }

        input[type=checkbox]:checked~.checkbox::before {
            background: #75ba48;
            /*attr('data-background');*/
        }

        input[type=checkbox]:checked~label {
            color: #75ba48;
        }

        .ink {
            display: inline;
            position: absolute;
            background: #75ba48;
            border-radius: 100%;
            transform: scale(0);
        }

        /*animation effect*/
        .ink.animate {
            animation: ripple 0.65s linear;
        }

        @keyframes ripple {

            /*scale the element to 250% to safely cover the entire link and fade it out*/
            100% {
                opacity: 0;
                transform: scale(2.5);
            }
        }

        .flip-clock-wrapper ul li a div.down {
            border-bottom-left-radius: 0px !important;
            border-bottom-right-radius: 0px !important;
        }

        .clock.flip-clock-wrapper ul li a div div.inn {
            font-size: 11px !important;
            line-height: 25px !important;
        }

        .loading {
            position: fixed;
            z-index: 999;
            height: 2em;
            width: 2em;
        }

        .loading-gif {
            position: fixed;
            z-index: 999;
            overflow: visible;
            margin: auto;
            top: 0;
            left: 0;
            bottom: 0;
            right: 0;
        }

        .loading:before {
            content: '';
            display: block;
            position: fixed;
            z-index: -50;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: white;
        }

        ul.flip {
            padding: 0px 10px !important;
        }

        .clock.flip-clock-wrapper ul {
            width: 15px !important;
            height: 25px !important;
        }

        .clock.flip-clock-wrapper ul li a div.up:after {
            top: 12px !important;
        }

        .flip-clock-wrapper ul.flip.flip:nth-child(even) {
            margin: 0px 10px 0px 0px !important;
            border-radius: 0px 6px 6px 0px !important;
        }

        .flip-clock-wrapper ul.flip:nth-child(even) li a div div.inn {
            background-color: #444444 !important;
            border-radius: 0px 6px 6px 0px !important;
        }

        .flip-clock-wrapper ul.flip.flip:nth-child(odd) {
            margin: 0px !important;
            border-radius: 6px 0px 0px 6px !important;
        }

        .flip-clock-wrapper ul.flip:nth-child(odd) li a div div.inn {
            background-color: #2e2e2e !important;
            border-radius: 6px 0px 0px 6px !important;
        }

        .qa-answer {
            height: 40vh !important;
        }

        .dropzone {
            width: 100%;
        }

        .done {
            background-color: #9eabe4;
            background-image: linear-gradient(315deg, #9eabe4 0%, #77eed8 74%);
            color: white;
            font-weight: bold;
            border-radius: 25px;
        }

        .submit {
            color: white;
            font-weight: bold;
            border-radius: 25px;
            background: #FC5C7D;
            background: -webkit-linear-gradient(to right, #6A82FB, #FC5C7D);
            background: linear-gradient(to right, #6A82FB, #FC5C7D);
        }

        .skip {
            color: white;
            font-weight: bold;
            background-color: #ee8c68;
            background-image: linear-gradient(315deg, #ee8c68 0%, #eb6b9d 74%);
            border-radius: 25px;
        }

        .upload {
            width: 10vw;
            height: 10vw;
        }

        .upload-container {
            margin-top: 4vh;
        }

        .upload-file-container {
            cursor: pointer;
        }

        .write-file-container {
            cursor: pointer;
        }

        img[data-dz-thumbnail] {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }
    </style>
    <link rel="stylesheet" href="{{ asset('/backend/dropzone-5.7.0/dist/min/dropzone.min.css')}}">
</head>

<body class="">
    <div class="loading">
        <img class="loading-gif" src="{{ asset ('loading.gif') }}">
    </div>
    <div class="content">
        <div class="d-flex justify-content-center align-items-center" style="height: 100%;">
            <div class="col-md-10">
                <div class="card">

                    <div class="row">
                        <div class="clock2 d-flex justify-content-center" style="margin:2em;"></div>
                        <div class="message"></div>
                    </div>
                    <div class="question-nav">
                        <span class="question-info">Question <span class="question_no"></span> out of <span
                                class="total_question"></span></span>
                        <div class="nav-btns">
                            <button class="btn btn-sm prev"><i class="fas fa-angle-left"></i></button>
                            <button class="btn btn-sm next"><i class="fas fa-angle-right"></i></button>
                        </div>
                    </div>
                    <div class="row question-numbers">
                    </div>
                    <div class="row d-flex justify-content-center">
                        <div class="question">
                            <h3><span class="badge question-number" id="qid"><span class="question_no"></span></span>
                                <span id="question"
                                    style="-moz-user-select: none; -webkit-user-select: none; -ms-user-select:none; user-select:none;-o-user-select:none;"
                                    unselectable="on" onselectstart="return false;" onmousedown="return false;"></span>
                            </h3>
                        </div>
                        <ul class="options">

                        </ul>

                    </div>
                    <div class="row button-container" style="margin-left: 2vw; display: flex;
                    justify-content: flex-start;">
                        <div class="buttons">
                            <button class="skip btn btn-lg">Skip</button>
                            <button class="done btn btn-lg">Done</button>
                            <button class="submit btn btn-lg">Submit</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <template class="option_template">
        <li class="option">
            <input type="[[[ option_type ]]]" class="d-none" id="option-[[[ option_value ]]]" name="selector"
                value="[[[ option_value ]]]">
            <label for="option-[[[ option_value ]]]" class="element-animation">[[[ option_text ]]]</label>
            <div class="[[[ option_class ]]]"></div>
        </li>
    </template>
    <div class="qa_template d-none">
        <div class="row upload-container" style="width: 100%;">
            <div class="col-md-5 d-flex justify-content-end">
                <div class="upload-file-container">
                    <img class="upload" src="{{ asset('upload.png') }}" alt="Upload">
                    <div style="text-align: center;margin-top: 2vh;">Upload Photo or File</div>
                </div>
            </div>
            <div class="col-md-1 d-flex justify-content-center align-items-center">
                OR
            </div>
            <div class="col-md-5 d-flex justify-content-start">
                <div class="write-file-container">
                    <img class="upload" src="{{ asset('write.png') }}" alt="Write">
                    <div style="text-align: center;margin-top: 2vh;">Add Answer Online</div>
                </div>
            </div>
        </div>
        <div class="loader d-none">
            <div class="d-flex justify-content-center ">
                <div>
                    <div>Please wait a moment... the Editor is being loaded...</div>
                    <img src="{{ asset('loader.gif') }}">
                </div>
            </div>
        </div>
        <div class="needsclick dropzone d-none" id="dropzone_question_[[[ question_id ]]]" style="100%"></div>
        <textarea class="form-control qa-answer d-none" id="editor_question_[[[ question_id ]]]"></textarea>
        <div><a href="javascript:void(0);" class="back d-none">Back</a></div>
    </div>
</body>
<script src="https://code.jquery.com/jquery-3.5.1.js" integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc="
    crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"
    integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous">
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/flipclock/0.7.8/flipclock.js"></script>
<script src="{{ asset('/backend/dropzone-5.7.0/dist/min/dropzone.min.js')}}"></script>
<script src="{{ asset('ckeditor/ckeditor.js') }}"></script>
<script>
    var uploadedThumbnailMap = {}
    Dropzone.autoDiscover = false;
    $(document).ready(function() {
        $('.loading').removeClass('d-none');
        var $question_no = 1;
        var clock2;
        var $total_question = 0;
        var $max = parseInt($(window).width() / 150);
        var $user_id = '{{auth()->user()->id }}';
        var autosave;
        let singleDropzoneOptions = {
            // maxFiles: 1
            url: '/test/image/'
            , clickable: true
            , thumbnailWidth: 140
            , thumbnailHeight: 140
            , maxThumbnailFilesize: 0.5
            , uploadMultiple: true
            , parallelUploads: 10
            , addRemoveLinks: true
            , headers: {
                'X-CSRF-TOKEN': "{{ csrf_token() }}"
            }
            , removedfile: function(file) {
                console.log(file.url)
                $.ajax({
                    type: 'POST'
                    , url: "{{ route('image_remove') }}"
                    , data: {
                        '_token': '{{ csrf_token() }}'
                        , 'file': file.url
                    , }
                });
                file.previewElement.remove()
            }
            , init: function() {
                $.ajax({
                    type: 'POST'
                    , async: false
                    , url: "{{ route('get_image') }}"
                    , data: {
                        '_token': '{{ csrf_token() }}'
                        , 'quiz_id': quiz.id
                        , 'question_id': $question_no
                        , 'user': $user_id
                    , }
                    , success: function(data) {
                        files = data;
                    }
                });
                for (i in files) {
                    var file = files[i];
                    this.options.addedfile.call(this, file);
                    this.options.thumbnail.call(this, file, file.url);
                    file.previewElement.classList.add('dz-complete');
                }
                this.on('sending', function(file, xhr, formData) {
                    formData.append('quiz_id', quiz.id);
                    formData.append('question_id', $question_no);
                    formData.append('user', $user_id);
                });

            }
        }
        //function to save cookie
        function setCookie(cname, cvalue, exdays) {
            var d = new Date();
            d.setTime(d.getTime() + (exdays * 24 * 60 * 60 * 1000));
            var expires = "expires=" + d.toUTCString();
            document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
        }

        // fuction to get cookie
        function getCookie(cname) {
            var name = cname + "=";
            var ca = document.cookie.split(';');
            for (var i = 0; i < ca.length; i++) {
                var c = ca[i];
                while (c.charAt(0) == ' ') {
                    c = c.substring(1);
                }
                if (c.indexOf(name) == 0) {
                    return c.substring(name.length, c.length);
                }
            }
            return "";
        }

        // creating flipclock
        clock2 = $('.clock2').FlipClock({
            clockFace: 'HourCounter'
            , autoStart: false
            , callbacks: {
                stop: function() {
                    $('.message').html('The clock has stopped!')
                }
            }
        });
        // decreasing no nav circle on window resize
        $(window).resize(function() {
            $max = parseInt($(window).width() / 150);
            createQuestionNavCircle($total_question, $max);
            selectOption();
            $('div[data-id="' + quiz.questions[$question_no-1].id + '"]').addClass('selected');
        });

        $("span.flip-clock-divider").remove();

        // function to set time in clock
        function setTime(time, unit) {
            $time =0;
            switch (unit) {
                case 0:
                    $time = time;
                    break;
                case 1:
                    $time = time * 60
                    break;
                case 2:
                    $time = time * 60 * 60
                    break;
            }
        $time = $time*1000;
        $date =new Date($attempt.created_at);
        $now  = new Date();
        $leftTime = (($date.getTime()+$time)-$now)/1000;
            clock2.setTime($leftTime);
            clock2.setCountdown(true);
            clock2.start();
        }

        var quiz = [];
        var $answer = [];
        var $attempt;
        //extracting questions and options
        $.ajax({
            url: "{{route('get_question',$quiz)}}"
            , async: false
            , dataType: 'json'
            , success: function(json) {
                quiz = json;
                $total_question = quiz.questions.length;
                createQuestionNavCircle($total_question, $max);
            }
        });

        if (getCookie('attempt_' + quiz.id + '_' + $user_id) == '') {
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
        selectOption();
        getQuestion($question_no);
        $('.total_question').html($total_question);

        //when next btn is clicked
        $(document).on('click', '.next', function() {
            $question_no++;
            getQuestion($question_no);
        });

        //when prev button is clicked
        $(document).on('click', '.prev', function() {
            $question_no--;
            getQuestion($question_no);
        });
        $(document).on('click', '.circle', function() {
            $question_no = $(this).html();
            getQuestion($question_no);
        });

        function getQuestion($ele) {
            $ele--;
            clearInterval(autosave);
            setCookie('question_no_' + quiz.id + '_' + $user_id, $question_no, 1);
            //disabling prev and next button
            if ($question_no != 1) {
                $('.prev').prop('disabled', false);
            } else {
                $('.prev').prop('disabled', true);
            }
            if ($question_no != $total_question) {
                $('.next').prop('disabled', false);
            } else {
                $('.next').prop('disabled', true);
            }

            //for question circle nav
            if ($question_no > parseInt($('.circle').last().html())) {
                $('.circle').first().remove();
                $('.question-numbers').append('<div class="circle row" data-id="' + quiz.questions[$question_no-1].id + '" >' + $question_no + '</div>');
            }
            if ($question_no < parseInt($('.circle').first().html())) {
                $('.circle').last().remove();
                $('.question-numbers').prepend('<div class="circle row" data-id="' + quiz.questions[$question_no-1].id + '" >' + $question_no + '</div>');
            }

            //changing selected question in question nav
            $(".selected").removeClass('selected');
            $('div[data-id="' + quiz.questions[$question_no-1].id + '"]').addClass('selected');
            $('.question_no').html($question_no);

            //updating question as per question number
            $("#question").html(quiz.questions[$ele].question_text);
            $('.options').html('');
            $('.loading').removeClass('d-none');
            if($question_no >1 && CKEDITOR.instances['editor_question_' + quiz.questions[$question_no-2].id] != undefined){
                CKEDITOR.instances['editor_question_' + quiz.questions[$question_no-2].id].destroy();
            }
            switch (quiz.questions[$ele].type) {
                case "Multiple Choices":
                    $.each(quiz.questions[$ele].question_options, function(i, ele) {
                        $option = $('.option_template').html();
                        $option = renderTemplate($option, ele).replace('[[[ option_type ]]]', 'radio').replace('[[[ option_class ]]]', 'check');
                        $('.options').append($option);
                    });
                    break;
                case "True or False":
                    $.each(quiz.questions[$ele].question_options, function(i, ele) {
                        $option = $('.option_template').html();
                        $option = renderTemplate($option, ele).replace('[[[ option_type ]]]', 'radio').replace('[[[ option_class ]]]', 'check');
                        $('.options').append($option);
                    });
                    break;
                case "Multiple Answers":
                    $.each(quiz.questions[$ele].question_options, function(i, ele) {
                        $option = $('.option_template').html();
                        $option = renderTemplate($option, ele).replace('[[[ option_type ]]]', 'checkbox').replace('[[[ option_class ]]]', 'checkbox');
                        $('.options').append($option);
                    });
                    break;
                case "Short Answer":
                    $option = $('.qa_template').html();
                    $question_id = quiz.questions[$ele].id;
                    $option = $option.replace(/\[\[\[ question_id \]\]\]/g, $question_id);
                    $('.options').append($option);
                    dropzone = $("#dropzone_question_" + $question_id).dropzone(singleDropzoneOptions);
                    break;
                case "Long Answer":
                    $option = $('.qa_template').html();
                    $question_id = quiz.questions[$ele].id;
                    $option = $option.replace(/\[\[\[ question_id \]\]\]/g, $question_id);
                    $('.options').append($option);
                    dropzone = $("#dropzone_question_" + $question_id).dropzone(singleDropzoneOptions);
                    break;
            }
            selectOption();
            $('.loading').addClass('d-none');
        }

        $(document).on('click', '.upload-file-container', function() {
            $(this).parents('.options').find('.upload-container').addClass('d-none');
            $(this).parents('.options').find('.dropzone').removeClass('d-none');
            $('.back').removeClass('d-none');
        });

        $(document).on('click', '.write-file-container', function() {
            ul = $(this).parents('.options');
            $(ul).find('.loader').removeClass('d-none');
            $(ul).find('.upload-container').addClass('d-none');
            $('.back').removeClass('d-none');
            $id = $(ul).find('.qa-answer').prop('id');
            var ckeditor = CKEDITOR.replace($id, {
                height: 200
                , width: "100%"
                , uploadUrl: '/'
                , removePlugins: ['source', 'about', 'insertMath']
                , mathJaxLib: 'mathjax.js'
            , });
        });


        $(document).on('click', '.done', function() {
            var selected_options = [];
            $.each($("input[name='selector']:checked"), function() {
                selected_options.push($(this).val());
            });
            question_type = quiz.questions[($question_no-1)].type;
            if( question_type === 'Short Answer' || question_type === 'Long Answer'){
                $.ajax({
                    type: 'POST'
                    , async: false
                    , url: "{{ route('get_image') }}"
                    , data: {
                        '_token': '{{ csrf_token() }}'
                        , 'quiz_id': quiz.id
                        , 'question_id': $question_no
                        , 'user': $user_id
                    , }
                    , success: function(data) {
                        files = data;
                        console.log(data);
                    }
                });
                if(files.length !=0){
                    selected_options.push('image');
                }
                if(CKEDITOR.instances['editor_question_' + quiz.questions[$question_no-1].id] == undefined){
                    if(localStorage.getItem('qa_'+quiz.questions[$question_no-1].id+'_' + quiz.id + '_' + $user_id)!=''){
                        selected_options.push('answer');
                    }
                }else{
                    selected_options.push('answer');
                var editor = CKEDITOR.instances['editor_question_' + quiz.questions[$question_no-1].id];
                localStorage.setItem('qa_'+quiz.questions[$question_no-1].id+'_' + quiz.id + '_' + $user_id,editor.getData());
                }
            }
            addAnswer(selected_options);

            if($question_no < $total_question){
                $question_no++;
            }
            getQuestion($question_no);
        });

        $(document).on('click', '.skip', function() {
            $question_no++;
            getQuestion($question_no);
        });

        $(document).on('click', '.submit', function() {
            var $lastAnswer = $answer;
            $.each($lastAnswer,function(i,ele){
                if(ele.options.includes('answer')){
                    $.each(ele.options,function(index,option){
                        if(option == 'answer'){
                            $lastAnswer[i].options[index] = localStorage.getItem('qa_'+ele.question_id+'_' + quiz.id + '_' + $user_id);
                        }
                    });
                }
            });
            console.log($lastAnswer);
            $.ajax({
                type: 'POST'
                , url: "{{ route('test_update') }}"
                , headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                , }
                , data: {
                    'answers': $lastAnswer
                    , 'quiz': quiz.id
                    , 'user': $user_id
                    ,'attempt': $attempt.id
                , }
                ,success: function(data) {
                    setCookie('attempt_' + quiz.id + '_' + $user_id,'');
                }
            , });
        });

        function selectOption() {
            $.each($answer, function(i, ele) {
                if (ele.question_id == quiz.questions[$question_no-1].id) {
                    $.each(ele.options, function(key, val) {
                        $("#option-" + val).trigger('click');
                    });
                }
                $('div[data-id="' + ele.question_id + '"]').addClass('active');
            });
        }

        function addAnswer(option) {
            var $question_id = quiz.questions[$question_no-1].id;
            if(option.length!=0){
            $.each($answer, function(i, ele) {
                if (ele.question_id == $question_id) {
                    $answer.splice(i, 1);
                }
            });

            $answer.push({
                'question_id': $question_id
                , 'options': option
            });
            setCookie('answer_'+quiz.id + '_' + $user_id, JSON.stringify($answer), 1);
            console.log(getCookie('answer_'+quiz.id + '_' + $user_id));
            $('div[data-id="' + $question_id + '"]').addClass('active');
            }
        }

        function renderTemplate($option, ele) {
            return $option.replace(/\[\[\[ option_value \]\]\]/g, ele.id).replace('[[[ option_text ]]]', ele.option_text);
        }

        //creating nav circles on load
        function createQuestionNavCircle($count, $max) {
            $('.question-numbers').html('');
            for (i = 1; i <= $count; i++) {
                if (i <= $max) {
                    $('.question-numbers').append('<div class="circle row" data-id="' + quiz.questions[i-1].id + '">' + i + '</div>')
                }
            }
        }

        CKEDITOR.on('instanceReady', function() {
            $('.loader').addClass('d-none');
                        var callback = function(){
                CKEDITOR.instances['editor_question_' + quiz.questions[$question_no-1].id].focus();
                CKEDITOR.instances['editor_question_' + quiz.questions[$question_no-1].id].insertHtml(localStorage.getItem('qa_'+quiz.questions[$question_no-1].id+'_' + quiz.id + '_' + $user_id));
            };
            CKEDITOR.instances['editor_question_' + quiz.questions[$question_no-1].id].setData("", callback);
            autosave = setInterval(function() {
            var editor = CKEDITOR.instances['editor_question_' + quiz.questions[$question_no-1].id];
                localStorage.setItem('qa_'+quiz.questions[$question_no-1].id+'_' + quiz.id + '_' + $user_id,editor.getData());
            }, 5000);
        });

        // $(document).on('click','.back',function(){
        //     $('.upload-container').removeClass('d-none');
        //     $(this).addClass('d-none');
        //     $('#cke_editor_question_' + quiz.questions[$question_no-1].id).addClass('d-none');
        //     $('.dropzone').addClass('d-none');
        // });
        setTime(quiz.time,quiz.time_type);

        $('.loading').addClass('d-none');
    });

</script>

</html>
