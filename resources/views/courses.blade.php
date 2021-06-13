@extends('site.master')
@section('title','Courses')

@section('content')
<section id="title">
        <h1>Courses</h1>
        <hr class="rounded-title">
    </section>
    <section id="courses-body">
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    <div class="single-course">
                        <div class="single-course-image">
                            <img src="{{ asset('frontend/img/Rectangle 4.png')}}" alt="">
                        </div>
                        <div class="course-title">
                            <h4>Mathematics</h4>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="single-course">
                        <div class="single-course-image">
                            <img src="{{ asset('frontend/img/Rectangle 4.png')}}" alt="">
                        </div>
                        <div class="course-title">
                            <h4>English</h4>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="single-course">
                        <div class="single-course-image">
                            <img src="{{ asset('frontend/img/Rectangle 4.png')}}" alt="">
                        </div>
                        <div class="course-title">
                            <h4>General Knowledge</h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection