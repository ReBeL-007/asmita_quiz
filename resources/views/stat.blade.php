@extends('layouts.app')

@section('title','Stat')

@section('content')
<style>
    .stats-wrapper {
        flex: 1;
        flex-wrap: wrap;
        text-align: center;
        align-content: flex-start;
    }

    .stats-wrapper .stats {
        width: 50%;
        padding: 0 5px 15px;
    }

    .stats-wrapper .stats .top {
        color: #575FCF;
        font-size: 24px;
        font-weight: 500;
    }

    .stats-wrapper .stats .bottom:last-child {
        margin: 0;
    }

    .stats-wrapper .stats .bottom {
        font-size: 16px;
        color: #b4bfd2;
        font-weight: 500;
        margin: 0 5px 0 0;
    }

    .card-btn-container {
        position: absolute;
        padding: .5rem .8rem;
        top: 50%;
        border-radius: 100%;
        background-color: #d7d7f0;
        color: black;
    }

    .card-btn-container:hover {
        background-color: #575fcf;
        color: white !important;
    }

    .btn-left {
        left: -2%;
    }

    .btn-right {
        right: -2%;
    }

    .animate-left {
        position: relative;
        animation: animateleft 0.4s;
    }

    .animate-right {
        position: relative;
        animation: animateright 0.4s;
    }

    .animate__fadeOutLeft {
        -webkit-animation-name: fadeOutLeft;
        animation-name: fadeOutLeft
    }


    /* slider */
    .next-question {
        position: absolute;
        color: #8b8b8b;
        transition: transform 0.3s;
        outline: none !important;
        border: none;
        display: inline-block;
        background-color: transparent;
    }

    .next-question-right {
        top: 50%;
        right: 3%;
        /* bottom: 16rem; */
    }

    .next-question-left {
        top: 50%;
        left: 3%;
    }

    .next-question:hover {
        transform: scale(1.5);
    }

    .slider {
        position: relative;
        height: 40vh;
        overflow: hidden;
    }

    .slide {
        width: 100%;
        position: absolute;
        transition: transform 0.5s;
    }



    /* dots */
    .dots {
        position: absolute;
        bottom: 5%;
        left: 50%;
        transform: translateX(-50%);
        display: flex;
    }

    .dots__dot {
        border: none;
        background-color: #b9b9b9;
        opacity: 0.7;
        height: 1rem;
        width: 1rem;
        border-radius: 50%;
        margin-right: 1.75rem;
        cursor: pointer;
        transition: all 0.5s;
    }

    .dots__dot:last-child {
        margin: 0;
    }

    ​ .dots__dot--active {
        background-color: #575FCF;
        opacity: 1;
    }

    .dots-active {
        background-color: #575FCF;
        opacity: 1;

    }

    .dots-active:focus {
        outline: none;
    }

    @-webkit-keyframes fadeOutLeftBig {
        0% {
            opacity: 1
        }

        to {
            opacity: 0;
            -webkit-transform: translate3d(-2000px, 0, 0);
            transform: translate3d(-2000px, 0, 0)
        }
    }

    @keyframes fadeOutLeftBig {
        0% {
            opacity: 1
        }

        to {
            opacity: 0;
            -webkit-transform: translate3d(-2000px, 0, 0);
            transform: translate3d(-2000px, 0, 0)
        }
    }

    .animate__animated {
        -webkit-animation-duration: 1s;
        animation-duration: 1s;
        -webkit-animation-duration: var(--animate-duration);
        animation-duration: var(--animate-duration);
        -webkit-animation-fill-mode: both;
        animation-fill-mode: both
    }
</style>
<div class="row d-flex align-items-center justify-content-center position-relative" style="height: 80vh;">
    <div class="col-lg-6">
        <div class="card">
            <div class="card-header">
                <small>{{$attempts[0]->quiz->course->title}}</small>
                <div>{{$attempts[0]->quiz->title}}</div>
            </div>
            <div class="card-body">
                @php
                $highestMark = 0;
                foreach ($attempts as $key => $attempt) {
                if($key==0){
                $totalMarks = 0;
                foreach($attempt->quiz->questions as $question){
                $totalMarks+=$question->marks;
                }
                }
                if($highestMark < $totalMarks){ $highestMark=$attempt->total_marks;
                    }
                    }
                    @endphp
                    <div class="card-body slider">

                        @foreach ($attempts as $key=>$attempt)
                        <div class="slides  slide" id="slide-{{$key+1}}">
                            <div class="slideshow-content">
                                <div class="quiz-subhead">
                                    <span>Quiz
                                        Result</span>&nbsp;<span>{{$key+1}} of {{count($attempts)}}</span>
                                    <small>{{date_format(date_create($attempt->created_at),'dS M Y')}}</small>
                                </div>
                                <div>{{$attempt->quiz->title}}</div>
                                <div class="stats-wrapper d-flex col-md-7 col-sm-12 col-xs-12 mx-auto m-3">
                                    <div class="stats"
                                        style="border-bottom: 1px solid #b4bfd2;border-right: 1px solid #b4bfd2;">
                                        <label>Your Score</label>
                                        <div><span class="top">
                                                {{($attempt->total_marks != null)?$attempt->total_marks:0}}</span><span
                                                class="bottom">
                                                /
                                                {{$totalMarks}}</span>
                                        </div>
                                    </div>
                                    <div class="stats"
                                        style="border-bottom: 1px solid #b4bfd2;border-left: 1px solid #b4bfd2;">
                                        <label>Top Score</label>

                                        <div><span class="top">{{$highestMark}}</span><span class="bottom"> /
                                                {{$totalMarks}}</span></div>
                                    </div>
                                    <div class="stats"
                                        style="border-top: 1px solid #b4bfd2;border-right: 1px solid #b4bfd2;">
                                        <label>Time Spent</label>
                                        <div>
                                            @php
                                            $startTime = Carbon\Carbon::parse( $attempt->updated_at);
                                            $finishTime = Carbon\Carbon::parse($attempt->created_at);
                                            $taken_time = '<span class="top sec">';
                                                $taken_time = $taken_time.
                                                str_replace('after','',$startTime->diffForHumans($finishTime));
                                                $taken_time = str_replace('before','',$taken_time);
                                                $taken_time = str_replace('minutes','<span
                                                    class="bottom">mins</span>',$taken_time);
                                                $taken_time = str_replace('hours','<span
                                                    class="bottom">hrs</span>',$taken_time);
                                                $taken_time = str_replace('seconds','<span
                                                    class="bottom">secs</span>',$taken_time);
                                                $taken_time =$taken_time. "</span>";
                                            echo(html_entity_decode($taken_time));
                                            @endphp
                                        </div>
                                    </div>
                                    <div class="stats"
                                        style="border-top: 1px solid #b4bfd2;border-left: 1px solid #b4bfd2;">
                                        <label>Your attempt</label>
                                        <div><span class="top">{{count($attempts)}}</span></div>
                                    </div>
                                </div>
                                <div class="d-flex justify-content-center">
                                    <a class="mx-auto lb-btn"
                                        href="{{route('view_attempts',['id'=>$attempt->id])}}">View
                                        Your
                                        Result</a>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
            </div>
            <div class="card-btn-container btn-left">
                <i class="fas fa-arrow-left next-question-left"></i>
            </div>
            <div class="card-btn-container btn-right">
                <i class="fas fa-arrow-right next-question-right"></i>
            </div>
            <div class="dots"></div>
        </div>
    </div>
    @endsection
    @section('script')
    <script>
        const questionSlider = document.querySelector(".slider");

    const questionSlides = document.querySelectorAll(".slide");

    const nextQuestionBtn = document.querySelector(".btn-right");

    const previousQuestionBtn = document.querySelector(".btn-left");

    const maxQuestion = questionSlides.length;

    const dotContainer = document.querySelector(".dots");

    let currentSlide = 0;

    // creating dots
    const createDots = function () {
      questionSlides.forEach((slide, idx) => {
        dotContainer.insertAdjacentHTML(
          "beforeend",
          `<button class="dots__dot" data-slide="${idx}"></button>`
        );
      });
    };

    // change dot color

    const activeDotColor = function (slide) {
      document.querySelectorAll(".dots__dot").forEach((dot) => dot.classList.remove("dots-active"));

      document.querySelector(`.dots__dot[data-slide="${slide}"]`).classList.add("dots-active");
    };

    const goToQuestion = function (currentSlide) {
      questionSlides.forEach((question, idx) => {
        question.style.transform = `translateX(${100 * (idx - currentSlide)}%)`;
      });
    };

    const nextQuestionSlide = function () {
      // check whether it exceeds the length or not
      if (currentSlide === maxQuestion - 1) {
        currentSlide = 0;
      } else {
        currentSlide++;
      }

      goToQuestion(currentSlide);

      activeDotColor(currentSlide);
    };

    const previousQuestionSlide = function () {
      // check whether it exceeds the length or not
      if (currentSlide === 0) {
        currentSlide = maxQuestion - 1;
      } else {
        currentSlide--;
      }

      goToQuestion(currentSlide);

      activeDotColor(currentSlide);
    };

    function init() {
      // immediately call
      createDots();

      goToQuestion(0);

      activeDotColor(0);
    }

    init();

    nextQuestionBtn.addEventListener("click", nextQuestionSlide);

    previousQuestionBtn.addEventListener("click", previousQuestionSlide);

    dotContainer.addEventListener("click", function (e) {
      if (e.target.classList.contains("dots__dot")) {
        console.log("entry");

        const questionSlide = e.target.dataset.slide;

        console.log(questionSlide);

        goToQuestion(questionSlide);

        activeDotColor(questionSlide);
      }
    });
    </script>
    <script>
        $(function(){
        let $attemptNo = 1;
        console.log('test');
        // $(document).on('click','.btn-right',function(){
        //     $('#slide-'+$attemptNo).animate({
        //     width: "toggle",
        //     opacity: "toggle"
        //     }, {
        //     duration: "slow"
        //     });
        //     $attemptNo++;
        //     $('#slide-'+$attemptNo).animate({
        //     width: "toggle",
        //     opacity: "toggle"
        //     }, {
        //     duration: "slow"
        //     });
        // });
    });
    </script>
    @endsection
