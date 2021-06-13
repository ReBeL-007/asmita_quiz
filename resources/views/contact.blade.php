@extends('site.master')
@section('title','Contact')

@section('content')
<!-- title -->
<section id="title">
        <h1>Contact Us</h1>
        <hr class="rounded-title">
    </section>
    <!-- session messages -->
    <div class="row">
        <div class="col-lg-3"></div>
        <div class="col-lg-6">
        @include('admin.backend.includes.messages')
        </div>
    </div>
    <!-- contact us body -->
    <section id="contact-body">
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    <div class="contact-info">
                        <h4>Contact Information</h4>
                        <p class="head">Any questions or remarks? Just write us a message!</p>
                        <p class="subtitle"> Fill up the form and our team will get back to you within 24 hours. </p>
                        <div class="contact-icon">
                            <img src="{{ asset('frontend/img/phone.png')}}" alt="">
                            <span style="font-size: 13px;">+977 9860187639</span>
                        </div>
                        <div class="contact-icon">
                            <img src="{{ asset('frontend/img/maiil.png')}}" alt="">
                            <span>info@sikaai.com</span>
                        </div>
                        <div class="contact-social">
                            <a href="https://www.facebook.com/sikaai/" target="_blank"><img src="{{ asset('frontend/img/jam_facebook-circle.png')}}" alt=""></a>
                            <a href="https://www.instagram.com/sikaai_/" target="_blank"><img src="{{ asset('frontend/img/entypo-social_instagram-with-circle.png')}}" alt="">
                            </a>
                            <a href="https://www.linkedin.com/company/sikaai" target="_blank"><img src="{{ asset('frontend/img/linked.png')}}" alt=""></a>
                            <a href="#"><img src="{{ asset('frontend/img/Group 382.png')}}" alt=""></a>

                        </div>
                    </div>
                </div>
                <div class="col-md-8">
                    <form method="POST" action="{{ route('contact_us') }}" class="contact-form">
                        @csrf
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label>First Name</label>
                                <input type="text" class="form-control" name="fname" required>
                            </div>
                            <div class="form-group col-md-6">
                                <label>Last Name</label>
                                <input type="text" class="form-control" name="lname" required>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label>Email</label>
                                <input type="email" class="form-control" name="email" required>
                            </div>
                            <div class="form-group col-md-6">
                                <label>Phone Number</label>
                                <input type="tel" class="form-control" name="contact" required>
                            </div>
                        </div>
                        <div class="form-group ">
                            <label>Message</label>
                            <input type="text" class="form-control" name="message" placeholder="Write your message here..." required>
                        </div>

                        <button type="submit" class="btn ">Submit</button>

                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection