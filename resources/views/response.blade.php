@extends('layouts.app')

@section('title','Response')

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
<div class="row d-flex align-items-center justify-content-center" style="height: 80vh;">
    <div class="col-lg-3">
        <div class="card">
            <div class="card-body">
                <div>
                    Your Response has been submitted
                </div>
                <div>
                    <img style="width: 100%;" src="{{asset('img/plane.gif')}}">
                </div>
                <div class="d-flex justify-content-center">
                    @if (!$attempts->quiz->answer_publish)
                    <a class="mx-auto lb-btn" href="{{route('home')}}">Back to Home</a>
                    @else
                    <a class="mx-auto lb-btn" href="{{route('view_attempts',['id'=>$attempts->id])}}">View Your
                        Result</a>
                    @endif

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
