@extends('site.master')
@section('title','About')
@section('styles')
<style>
    @media screen and (max-width:800px) and (min-width:501px) {
        #title .rounded {
            margin-left: 35%;
        }
    }
    
    @media screen and (max-width:425px) {}
</style>
@endsection
@section('content')
    <section id="title">
        <h1>About Us</h1>
        <hr class="rounded-title">
    </section>
    <section id="about-body">
        <div class="container">
            <div class="row">
                <div class="col-md-8">
                    <div class="video">
                        <h2> Video Content 1920*1080px</h2>
                    </div>
                </div>
                <div class="col-md-4 ">
                    <p>This video explains what you’ll be getting and how we operate </p>
                </div>
            </div>
        </div>
    </section>
@endsection