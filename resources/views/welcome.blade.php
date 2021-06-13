@extends('site.master')

@section('title','Home')

@section('content')
<!-- header content -->
<section id="header-content">
    <div class="container">
        <div class="ellipse"></div>
        <!-- <div class="ellipse-1"></div> -->
        <div class="row" style="justify-content: space-between; width: 90vw;">
            <div class="col-md-5 text mobile-view">
                <h1>Join CMAT & <br> KUUMAT preparation <br> classes online</h1>
                <p class="text-subheading">Pre-registration open for CMAT & KUUMAT <br> courses on Sikaai.</p>
                <a data-toggle="modal" data-target="#exampleModal" class=" btn btn-primary start">Get Started</a>
            </div>
            <div class="col-md-7 image">
                <img src="{{ asset('frontend/img/ART.svg')}}" alt="">
            </div>
        </div>
    </div>
    <div class="button-2">
        <a data-toggle="modal" data-target="#exampleModal" class=" btn btn-primary" id="fixed-btn">Get Started</a>
    </div>
</section>
<div class="ribbon">

    <!-- courses -->
    <section id="courses">
        <div class="row course-section">
            <div class="col-lg-8 col-md-8">
                <div class="course-image">
                    <img src="{{ asset('frontend/img/Design For success.png')}}" alt=""></div>
            </div>
            <div class="col-lg-4 col-md-4">
                <div class="right">
                    <h1 class="title-font">Designed for 100% Success </h1>
                    <hr class="rounded" style="margin-left: 100px;">
                    <p class="text-subheading">Sikaai brings intuitive and user friendly approach to online education
                        making teaching and learning easy whereas, the highly regarded teaching faculty brings years of
                        experience and assurance.</p>
                    <div class="course-btn">
                        <a data-toggle="modal" data-target="#exampleModal" class="btn"> See Courses</a></div>
                </div>
            </div>
        </div>

    </section>
    <!-- what's in it for you -->
    <section id="third">
        <div class="row">
            <div class="col-md-5 left third-align">
                <h1 class="title-font">What’s In It
                    <!--<br>--> for You?</h1>
                <hr class="rounded" style=" margin-left: 50px;">
                <p class="text-subheading">Sikaai provides a complete package for online learning with live classes,
                    dedicated faculties, regular exams and resources for CMAT and KUUMAT preparation. </p>
                <div class="course-btn">
                    <a data-toggle="modal" data-target="#exampleModal" class="btn"> See Courses</a></div>
            </div>
            <div class="col-md-7 right">
                <div class="right-img">
                    <img src="{{ asset('frontend/img/iNTERDUCTION TO PREOSITION.png')}}" alt="">
                </div>
            </div>
        </div>

    </section>
    <!-- faculty -->
    <section id="faculty">
        <h1 class="title-font">Classes Taught by </br>Highly Experienced Faculty</h1>
        <hr class="rounded" style="margin-left:696px">
        <p class="text-subheading">Our teaching panel consists of highly regarded and experienced
            <br> faculties in the field of CMAT & KUUMAT preparation class</p>

        <section class="testimonials my-slider">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div id="customer-testimonoals" class="owl-carousel owl-theme">
                            <div class="item">
                                <div class="card">
                                    <div class="img">
                                        <img src="{{asset('frontend/img/2.jpg')}}" alt="Khagendra P. Chamlagain"
                                            width="300" height="200" data-toggle="modal" data-target="#exampleModal1"
                                            class="img" />
                                    </div>

                                    <div class="content">
                                        <div class="title">Khagendra P. Chamlagain</div>
                                        <p class="card-text">English</p>
                                    </div>
                                </div>
                            </div>
                            <div class="item">
                                <div class="card">
                                    <div class="img">
                                        <img src="{{asset('frontend/img/Rectangle 4.png')}}" alt="Kedar Chhatkuli"
                                            width="300" height="200" data-toggle="modal" data-target="#exampleModal2"
                                            class="img" />
                                    </div>

                                    <div class="content">
                                        <div class="title">Kedar Chhatkuli</div>
                                        <p class="card-text">Mathematics</p>
                                    </div>
                                </div>
                            </div>
                            <div class="item">
                                <div class="card">
                                    <div class="img">
                                        <img src="{{asset('frontend/img/haribaniya.jpg')}}" alt="hari baniya"
                                            width="300" height="200" data-toggle="modal" data-target="#exampleModal3"
                                            class="img" />
                                    </div>

                                    <div class="content">
                                        <div class="title">Hari Baniya</div>
                                        <p class="card-text">Mathematics</p>
                                    </div>
                                </div>
                            </div>
                            <div class="item">
                                <div class="card">
                                    <div class="img">
                                        <img src="{{asset('frontend/img/1.1.jpg')}}" alt="Arjun Chapagain" width="300"
                                            height="200" data-toggle="modal" data-target="#exampleModal4" class="img" />
                                    </div>

                                    <div class="content">
                                        <div class="title">Arjun Chapagain</div>
                                        <p class="card-text">General Awareness</p>
                                    </div>
                                </div>
                            </div>
                            <!-- <div class="item">
                                <div class="card">
                                    <div class="img">
                                        <img src="{{asset('frontend/img/2.jpg')}}" alt="" class="img" />
                                    </div>

                                    <div class="content">
                                        <div class="title">Khagendra P. Chamlagain</div>
                                        <p class="card-text">English</p>
                                    </div>
                                </div>
                            </div> -->
                        </div>
                    </div>
                </div>
        </section>
    </section>
    <!-- study -->
    <section id="study">
        <div class="container">
            <div class="row">
                <div class="col-md-6 study-text mobile-view">
                    <h1 class="title-font">Study From <br> Anywhere
                    </h1>
                    <hr class="rounded">

                    <p class="text-subheading">Take classes on the go with Sikaai <br>Study from your room, the bus, or
                        wherever you learn best</p>
                    <!-- <div class="download">
                    <img src="assets/apple-app-store-icon.png" alt="">
                    <img src="assets/en_badge_web_generic.png" alt="">
                </div> -->
                </div>

                <div class="col-md-6 study-image">
                    <img src="{{ asset('frontend/img/Group 367.png')}}" alt="">
                </div>
            </div>
        </div>
    </section>

    <!-- Modal -->
    <div class="modal fade" id="exampleModal1" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel"> Khagendra Prasad Chamlagain</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Double masters in English and over fifteen years of experience, Khagendra Prasad Chamlagain is a
                    reputed name amongst all the students. His energy and knowledge transfer is parallel to none. His
                    range of teaching from formal teaching to competitive examination has made a great impact to
                    students. Khagendra Prasad Chamlagain is an expert and competitive instructor for English in CMAT.
                </div>

            </div>
        </div>
    </div>
    <div class="modal fade" id="exampleModal2" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel"> Kedar Chhatkuli</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    A definitive mathematics teacher with two decades of experience and a name to look after is Kedar
                    Chhatkuli. Vast experience and in depth knowledge makes him apart from other teachers in the market.
                    He has given guidance to over a thousand students in different colleges and streams. His experience
                    in CMAT is immense and is one of the most searched and sought instructors.
                </div>

            </div>
        </div>
    </div>
    <div class="modal fade" id="exampleModal3" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel"> Hari Baniya </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    With an experience of over two decades, Hari Baniya is a renowned instructor for CMAT. His
                    experience, teaching methodology and specialty in CMAT is beyond comparison. His enthusiasm in
                    evolving with every passing day has made him most sought after instructor for CMAT. In short, Hari
                    Baniya is synonymous with Mathematics in CMAT.
                </div>

            </div>
        </div>
    </div>
    <div class="modal fade" id="exampleModal4" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Arjun Chapagain</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <p class="modal-body">
                    Young, knowledgeable and result oriented is how one describes Arjun Chapagain and his teaching
                    method. He has published several books on General Knowledge and has a reputation of making students
                    aware about the world with simple and effective teaching is Arjun Chapagain’s ability. He teaches
                    with conviction and his knowledge.
                </p>

            </div>
        </div>
    </div>
    @endsection
    @section('scripts')
    <script>
        $(document).ready(function() {
            const href = window.location.href.split('/');
            const modal = href[href.length-1];
            if(window.location.href.indexOf(modal) != -1) {
            $(modal).modal('show');
            }
        });
    </script>
    @endsection
