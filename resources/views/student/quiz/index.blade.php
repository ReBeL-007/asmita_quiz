@extends('.layouts.app')

@section('title','Test')

@section('content')
<style>
    .previous-result-container {
        padding: 5px 15px;
        background-color: #F2F2F2;
        border-radius: 10px;
    }

    .test-card {
        min-height: 320px;
        justify-content: center;
    }
</style>
<div class="content">
    <div class="row row-margin" style="padding: 5px 20px">
        <div>Available Test</div>
        @if (count($quizzes)>3)
        <div class="ml-auto lb-btn com-btn">See All</div>
        @endif
    </div>
    @if (count($quizzes)==0)
    <p style="padding: 5px 15px" class="text-danger">No Available Test</p>
    @endif
    <div class="row">
        @foreach ($quizzes as $key=>$quiz)
        <div class="col-lg-3 rem-test" style="@if($key>3)display:none; @endif">
            <div class="card test-card">
                <div class="card-body d-flex align-content-between flex-wrap justify-content-center">
                    <div class="quiz-card-body">
                        {{-- <small class="progress-percent">0% Completed</small>
                        <div class="progress">
                            <div class="progress-bar"></div>
                        </div>
                        <br>
                        <br> --}}
                        <div class="w-100 d-flex justify-content-center">
                            <img src="{{asset('img/to_do.svg')}}">
                        </div>
                        <div class="text-center mt-1">
                            <h6>{{$quiz->title}}</h6>
                            <small>{{$quiz->lesson->title ?? ''}}</small>
                        </div>
                    </div>
                    @php
                    $attempts = $quiz->attempts->where('user_id',auth()->user()->id)->where('status','submitted');
                    $attemptsNo = count($attempts);
                    @endphp
                    @if ($attemptsNo!=0 )
                    <div class="attempt-container w-100">
                        <small>Previous Result</small>
                        <div class="previous-result-container">
                            <div class="row d-flex justify-content-between">
                                <small>Total attempts:</small>
                                <small>{{$attemptsNo}}</small>
                            </div>
                            <div class="row d-flex justify-content-between">
                                <small>Average Score:</small>
                                <small>@php
                                    $total_marks = 0;
                                    foreach ($attempts as $key => $attempt) {
                                    $total_marks+=$attempt->total_marks;
                                    }
                                    echo(round($total_marks/$attemptsNo,2));
                                    @endphp</small>
                            </div>
                        </div>
                    </div>
                    @endif
                    <div class="w-100 d-flex justify-content-center">
                        <a class="btn lb-btn" href="{{route('quizUrl',['id'=>$quiz->id])}}">Take Test</a>&nbsp;
                        @if ($attemptsNo!=0) <a class="btn lb-alt-btn" href="{{route('stat',['id'=>$quiz->id])}}">View
                            Stat</a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
    <div class="row row-margin" style="padding: 5px 20px">
        <div>Completed Test</div>
        @if (count($attempted_quizzes)>3)
        <div class="ml-auto lb-btn com-btn">See All</div>
        @endif
    </div>
    @if (count($attempted_quizzes)==0)
    <p style="padding: 5px 15px" class="text-danger">No Completed Test</p>
    @endif
    <div class="row">
        @foreach ($attempted_quizzes as $key=>$quiz)
        <div class="col-lg-3 com-test" style="@if($key>3)display:none; @endif">
            <div class="card test-card">
                <div class="card-body d-flex align-content-between flex-wrap justify-content-center">
                    <div class="quiz-card-body">
                        {{-- <small class="progress-percent">0% Completed</small>
                        <div class="progress">
                            <div class="progress-bar"></div>
                        </div>
                        <br>
                        <br> --}}
                        <div class="w-100 d-flex justify-content-center">
                            <img src="{{asset('img/to_do.svg')}}">
                        </div>
                        <div class="text-center mt-1">
                            <h6>{{$quiz->title}}</h6>
                            <small>{{$quiz->lesson->title ?? ''}}</small>
                        </div>
                    </div>
                    @php
                    $attempts = $quiz->attempts->where('user_id',auth()->user()->id)->where('status','submitted');
                    $attemptsNo = count($attempts);
                    @endphp
                    @if ($attemptsNo!=0 )
                    <div class="attempt-container w-100">
                        <small>Previous Result</small>
                        <div class="previous-result-container">
                            <div class="row d-flex justify-content-between">
                                <small>Total attempts:</small>
                                <small>{{$attemptsNo}}</small>
                            </div>
                            <div class="row d-flex justify-content-between">
                                <small>Average Score:</small>
                                <small>@php
                                    $total_marks = 0;
                                    foreach ($attempts as $key => $attempt) {
                                    $total_marks+=$attempt->total_marks;
                                    }
                                    echo(round($total_marks/$attemptsNo,2));
                                    @endphp</small>
                            </div>
                        </div>
                    </div>
                    @endif
                    <div class="w-100 d-flex justify-content-center">
                        @if ($attemptsNo!=0) <a class="btn lb-alt-btn" href="{{route('stat',['id'=>$quiz->id])}}">View
                            Stat</a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
    <div class="row row-margin" style="padding: 5px 20px">
        <div>Upcoming Test</div>
        @if (count($upcoming_quizzes)>3)
        <div class="ml-auto lb-btn com-btn">See All</div>
        @endif
    </div>
    @if (count($upcoming_quizzes)==0)
    <p style="padding: 5px 15px" class="text-danger">No Upcoming Test</p>
    @endif
    <div class="row">
        @foreach ($upcoming_quizzes as $key=>$quiz)
        <div class="col-lg-3 com-test" style="@if($key>3)display:none; @endif">
            <div class="card test-card">
                <div class="card-body d-flex align-content-between flex-wrap justify-content-center">
                    <div class="quiz-card-body">
                        <div class="w-100 d-flex justify-content-center">
                            <img src="{{asset('img/to_do.svg')}}">
                        </div>
                        <div class="text-center mt-1">
                            <h6>{{$quiz->title}}</h6>
                            <small>{{$quiz->lesson->title}}</small><br>
                            @php
                            $start_date = new Carbon\Carbon($quiz->start_at);
                            $remaining_days = $start_date->diffForHumans(Carbon\Carbon::now(),false);
                            @endphp
                            <small>Remaining Time: {{str_replace('after','left',$remaining_days)}}</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
    @endsection
    @section('script')
    <script>
        $(function(){
            $(document).on('click','.com-btn',function(){
                console.log($('.com-test.d-none'));
                $('.com-test').slideDown('slow');
            });
            $(document).on('click','.rem-btn',function(){
                console.log($('.rem-test.d-none'));
                $('.rem-test').slideDown('slow');
            });
        });
    </script>
    @endsection
