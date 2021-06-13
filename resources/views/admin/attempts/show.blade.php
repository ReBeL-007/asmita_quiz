@inject('request', 'Illuminate\Http\Request')
@extends('layouts.app')
@section('title','Attempt')

@section('content')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css"
    integrity="sha512-+4zCK9k+qNFUR5X+cKL9EIR+ZOhtIloNl9GIKS57V1MyNsYpYcUrUeQc9vNfzsWfV28IaLL3i96P9sdNyeRssA=="
    crossorigin="anonymous" />

<style>
    .option_text {
        font-weight: normal !important;
        display: flex;
        align-items: center;
    }

    .check {
        color: #45d667;
    }

    .error-question {
        background-color: #ffe9e9;
        position: relative;
        margin-top: 40px;
        padding: 20px;
    }

    .answers {
        margin-top: 20px;
    }

    .correct-question {
        background-color: #79ff7673;
        position: relative;
        margin-top: 40px;
        padding: 20px;
    }

    .validation-error-circle-big {
        position: absolute;
        width: 64px;
        height: 64px;
        background: #fff;
        border-radius: 32px;
        top: -32px;
        left: 20px;
    }

    .validation-error-circle-small {
        position: absolute;
        width: 54px;
        height: 54px;
        background: #ffe9e9;
        border-radius: 27px;
        top: -27px;
        left: 25px;
    }

    .error-icon {
        position: absolute;
        top: -19px;
        left: 42px;
        color: #f79ba1;
        font-size: 28px;
        display: inline-block;
        font-weight: 400;
    }

    .validation-correct-circle-big {
        position: absolute;
        width: 64px;
        height: 64px;
        background: #fff;
        border-radius: 32px;
        top: -32px;
        left: 20px;
    }

    .validation-correct-circle-small {
        position: absolute;
        width: 54px;
        height: 54px;
        background: #79ff7673;
        border-radius: 27px;
        top: -27px;
        left: 25px;
    }

    .correct-icon {
        position: absolute;
        top: -19px;
        left: 37px;
        color: #6ed669;
        font-size: 28px;
        display: inline-block;
        font-weight: 400;
    }

    .question {
        display: flex;
        align-items: center;
    }

    .option {
        display: flex;
        align-items: center;
    }

    .grading-container {
        background-color: #489aba29;
        height: 7vw;
        display: flex;
        align-items: center;
        padding: 5rem;
        border-radius: 20px;
        display: flex;
    }

    .question {
        display: flex;
        align-items: center;
    }
</style>
<div class="d-flex justify-content-center align-items-center">
    <div class="card col-md-8">
        <div>
            <span>Attempt: </span><span>{{$attempts->quiz->title}}</span></div>
        <div class="grading-container">
            <div class="row w-100" style="display: flex;justify-content: space-around;">
                <div class="col-md-4 average-score review-elem grading-text">
                    Your Score: <span>{{($attempts->total_marks != null)?$attempts->total_marks:0}}</span>
                </div>
                <div class="col-md-4 review-elem grading-text">
                    Time Taken:
                    <span>{{round((strtotime($attempts->updated_at)-strtotime($attempts->created_at))/60,2)}}</span> Min
                </div>
            </div>
        </div>
        <div class="card-body">
            @foreach ($attempts->quiz->questions as $sn=>$question)
            @php
            $marks = 0;
            if(count($attempts->attemptAnswers)>0){
            try {
            $marks = $attempts->attemptAnswers->where('question_id',$question->id)->first()->marks;
            } catch (\Throwable $th) {
            $marks = 0;
            }
            }
            @endphp
            <div class="@if($marks==0) error-question @else correct-question @endif">
                <div class="answers">
                    <div class="question">
                        <div>{{($sn+1).'. '}}</div>
                        <div class="readonly-editor" id="q{{($sn+1)}}">
                            {{$question->question_text }}</div>
                    </div>
                    @php
                    $selected_options = [];
                    foreach ($attempts->attemptAnswers as $answer) {
                    if($question->id == $answer->question_id){
                    $selected_options = $answer->attemptOptions;
                    }
                    }
                    @endphp
                    <h6>({{$marks}} / {{$question->marks}})Points</h6>
                    {{$question->type}}
                    @if ($question->type=='Long Answer' || $question->type=='Short Answer')
                    @foreach($attempts->attemptAnswers->where('question_id',$question->id)->first()->attemptOptions()->get()
                    as $option)
                    @if($option->answer_text!='')
                    <div class="readonly-editor" id="answer_{{$question->id}}">{{$option->answer_text}}</div>
                    @endif
                    @endforeach
                    <div>
                        <div id="images" class="row">
                            @foreach($attempts->attemptAnswers->where('question_id',$question->id)->first()->attemptOptions()->get()
                            as $i=>$option)
                            @if($option->image!='')
                            <div class="col-md-4"><img class="img-thumbnail rounded"
                                    src="{{asset(str_replace('public','storage',$option->image))}}"
                                    alt="Picture {{$i}}">
                            </div>
                            @endif
                            @endforeach
                        </div>
                    </div>
                    @else
                    @endif
                    @foreach($question->questionOptions as $key=> $option)
                    <div class="option">
                        @if($question->type=='Multiple Answers')
                        <input type="checkbox" disabled @php foreach ($selected_options as $selected_option) {
                            if($option->id == $selected_option->option_id){
                        echo('checked');
                        }
                        }
                        @endphp
                        >
                        @else
                        <input type="radio" disabled @php foreach ($selected_options as $selected_option) {
                            if($option->id==$selected_option->option_id){
                        echo('checked');
                        }
                        }
                        @endphp
                        >
                        @endif
                        &nbsp;&nbsp;<div class="option_text">
                            <div>{{chr($key+97)}}.</div>
                            <div class="readonly-editor" id="o{{($option->id)}}">{{ $option->option_text }}</div>
                        </div>
                        @if ($option->points == 1)
                        <span class="check"><i class="fas fa-check"></i></span>
                        @endif
                    </div>
                    @endforeach
                    @if($marks==0)
                    <div aria-live="assertive" role="alert">
                        <div class="validation-error-circle-big"></div>
                        <div class="validation-error-circle-small"></div><span class="error-icon"><i
                                class="fas fa-times"></i></span>
                    </div>
                    @else
                    <div aria-live="assertive" role="alert">
                        <div class="validation-correct-circle-big"></div>
                        <div class="validation-correct-circle-small"></div><span class="correct-icon"><i
                                class="fas fa-check"></i></span>
                    </div>
                    @endif
                </div>
            </div>
            @if ($attempts->quiz->answer_view != '' && $question->answer_explanation != '')
            <div class="solution-text-container">
                <label for="">Solution for Question {{$sn+1}}</label>
                <div class="solution-text readonly-editor" id="solutio-{{$sn}}">{{$question->answer_explanation}}</div>
            </div>
            @endif
            @endforeach
        </div>
    </div>
</div>
{{-- <script>
    var msg = new SpeechSynthesisUtterance();
msg.text = "Hello World";
window.speechSynthesis.speak(msg);
</script> --}}

@stop
