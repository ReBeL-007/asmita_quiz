@extends('layouts.app')
@section('title','Course')
@section('styles')
<link rel="stylesheet" href="{{ asset('css/student/courseDetail.css')}}">
<style>
    .video {
        height: 25rem;
        width: inherit;
    }

    .resource-icon {
        height: 2rem;
    }

    a {
        color: inherit;
    }
</style>
@endsection

@section('content')
<section class="container playerCourse">
    <div class="row">
        <div class="col-lg-7 col-md-12 change-layout">
            <h4 class="lesson-heading">
            </h4>
            <span class="tutor-name">{{$course->teachers->first()->name}}, {{$course->category->name}}</span>
            <div class="video-container">
                <iframe src="" id="video-frame" class="video d-none" frameborder="0"></iframe>
                <video src="" id="video" class="video d-none" controls></video>
            </div>
        </div>
        <div class="col-md-5 video-player-list">
            <div class="desc-1">
                <p class="total-lesson">{{count($course->lessons)}} lesson</p>
            </div>

            <ul class="list-items-video">
                @foreach ($course->lessons as $key => $lesson)
                <li class="lesson-list-items @if($key==0)active-list-video @endif">
                    <img src="{{asset('frontend/img/video-player.png')}}" alt="" class="icon">
                    <a class="lesson" rel-id="{{$lesson->id}}">{{$key+1}}. {{$lesson->title}}</a>
                </li>
                @endforeach
            </ul>
        </div>
        <!-- description title link center -->
        <div class="course-headlines col-md-12">
            <ul class="course-headlines-list">
                <li class="course-headlines-list__items lesson-mobile">
                    <a class="course-headlines-list__link">Lessons</a>
                </li>
                <li class="course-headlines-list__items active" rel-tab="about">
                    <a class="course-headlines-list__link">About</a>
                </li>
                <li class="course-headlines-list__items" rel-tab="discussion">
                    <a class="course-headlines-list__link">Discussion</a>
                </li>
                <li class="course-headlines-list__items" rel-tab="resources">
                    <a class="course-headlines-list__link">Resources</a>
                </li>
            </ul>
        </div>

        <!--detail lesson center  -->
        <div class="course-lesson-2 col-md-12">
            <ul class="list-items-video">
                @foreach ($course->lessons as $key => $lesson)
                <li class="lesson-list-items @if($key==0)active-list-video @endif">
                    <img src="{{asset('frontend/img/video-player.png')}}" alt="" class="icon">
                    <a class="lesson" rel-id="{{$lesson->id}}">{{$key+1}}. {{$lesson->title}}</a>
                </li>
                @endforeach
            </ul>
        </div>
        <!-- end of  lesson center-->
        <!-- start of about section -->
        <div class="course-about course-tab col-md-10" id="about">
            <h5 class="course-about__title">About This Lesson</h5>
            <p class="course-about__text">
            </p>
        </div>
        <div class="course-about course-tab col-md-10" style="display: none;" id="discussion">
            <h5 class="course-tab__title">Discussion</h5>
            <!-- discussion  -->
            <div class="chat-section col-md-7">
                <div class="chat-box">
                    <div class="comment-box">
                        <img src="{{asset('frontend/img/Group 72.png')}}" alt="" class="cmmt-box__img"
                            style="width: 3rem; height: 3rem">
                        <div class="comment-comment">
                            <div class="comment-name">Teacher Name</div>
                            <div class="text__paragraph comment-desciption ">Hey i am, not able t rotate the object it's
                                getting back to the old postion </div>
                            <a href="" class="reply" id="reply-1">Reply</a>
                            <form action="" class="reply-box">
                                <div class="cmmt-details">
                                    <img src="{{asset('frontend/img/Group 72.png')}}" class="cmmt__img" alt=""
                                        style="width: 3rem; height: 3rem">
                                    <textarea class="text-reply__box" class="">I am writting a reply</textarea>
                                </div>
                                <button class="post-form">Post</button>
                            </form>
                        </div>
                    </div>

                    <div class="comments">
                        <div class="comment-box">
                            <img src="{{asset('frontend/img/Group 72.png')}}" alt="" class="cmmt-box__img"
                                style="width: 3rem; height: 3rem">
                            <div class="comment-comment">
                                <div class="comment-name">Teacher Name</div>
                                <div class="text__paragraph comment-description ">Hey i am, not able t rotate the object
                                    it's
                                    getting back to the old postion </div>
                                <a href="" class="reply" id="reply-1">Reply</a>
                                <div class="reply-box">
                                    <div class="cmmt-details ">
                                        <img src="{{asset('frontend/img/Group 72.png')}}" class="cmmt-box__img" alt=""
                                            style="width: 3rem; height: 3rem">
                                        <div class="feedback__details feedback__spacing">
                                            <div class="comment-name">Teacher Name</div>
                                            <div class="text__paragraph comment-description ">Hey i am, not able t
                                                rotate
                                                the object it's getting bachanks Justin! I wonder if this is a MacBook
                                                (MacBook Air 2020) issue as even with the card out (the new MacBook has
                                                no
                                                card reader, so an adapter again) it still won't read it. FCPX will
                                                recognize it, but not the computer. </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <ul class="remaining-comments">
                            <li>
                                <div class="reply-box">
                                    <div class="cmmt-details ">
                                        <img src="{{asset('frontend/img/Group 72.png')}}" class="cmmt-box__img" alt=""
                                            style="width: 3rem; height: 3rem">
                                        <div class="feedback__details feedback__spacing">
                                            <div class="comment-name">Profile</div>
                                            <div class="text__paragraph comment-description ">Hey i am, not able t
                                                rotate
                                                the object it's getting bachanks Justin! I wonder if this is a MacBook
                                                (MacBook Air 2020) issue as even with the card out (the new MacBook has
                                                no
                                                card reader, so an adapter again) it still won't read it. FCPX will
                                                recognize it, but not the computer. </div>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <form action="" class="reply-box">
                                    <div class="cmmt-details">
                                        <img src="{{asset('frontend/img/Group 72.png')}}" class="cmmt__img" alt=""
                                            style="width: 3rem; height: 3rem">
                                        <textarea class="text-reply__box" class="">I am writting a reply</textarea>
                                    </div>
                                </form>
                            </li>
                        </ul>

                    </div>
                </div>
            </div>
        </div>
        <div class="course-about course-tab col-md-10" style="display: none;" id="resources">
            <h5 class="course-tab__title">Resources</h5>
            <table class="mt-4 table table-responsive resource-table">
                <thead>
                    <tr>
                        <th>
                            Name
                        </th>
                        <th>
                            Published Date
                        </th>
                        <th>
                            File Size
                        </th>
                    </tr>
                </thead>
                <tbody class="resource-table-body">

                </tbody>
            </table>


        </div>
</section>

@endsection


@section('scripts')
<script src="{{ asset('js/student/navigationSearch.js')}}"></script>
<script>
    $(function(){
        let lesson_id = $('.lesson').attr('rel-id');
        let lesson = [];

        render(lesson_id);
        function render(lesson_id){
            $.ajax({
            url: '/lesson/'+lesson_id
            , async: false
            , dataType: 'json'
            , success: function(json) {
                lesson = json;
            }
        });
        console.log(lesson);

            $('.lesson-heading').text(lesson.title);
            $('#video').addClass('d-none');
            $('#video-frame').addClass('d-none');
            $('#video-frame').attr('src','');
            $('#video').attr('src','');
            if(lesson.video_url!=null){
            $('#video-frame').attr('src',lesson.video_url);
            $('#video-frame').removeClass('d-none');
            }else{
                $('#video').attr('src',lesson.video.url);
                $('#video').removeClass('d-none');
            }
            let description = lesson.short_text;
            $('.course-about__text').html('');
            if(description!=null){
            $(description.split('\n')).each(function(i,token){
                $('.course-about__text').append(`<span class="text__paragraph">
                    ${token}
                </span>`);
            });
        }
            $('.resource-table-body').html('');
            if(lesson.resource.length == 0){
                $('.resource-table').hide();
                $('#resources').append('<span class="no-resources" >No resources available</span>');
            }else{
                $('.resource-table').show();
                $('.no-resources').remove();
            }
            $.each(lesson.resource,function(i,resource){
                let extension = resource.file_name.split('.').slice(-1)[0];
                if(! resource.mime_type.includes('image')){
                  icon = "/img/extension/"+extension+".png";
                }else{
                    icon = resource.url;
                }
                $('.resource-table-body').append(` <tr>
                        <td><a href="${resource.url}" download><img class="resource-icon" src="${icon}">&nbsp;${resource.name}</a></td>
                        <td>${new Date(resource.created_at).toDateString()}</td>
                        <td>${((resource.size)/1000000).toFixed(2)} MB</td>
                    </tr>`);
            });

        }
        $(document).on('click','.lesson-list-items',function(){
            lesson_id = $(this).find('a').attr('rel-id');
            $('.lesson-list-items').removeClass('active-list-video');
            $(this).addClass('active-list-video');
            render(lesson_id);
            });

            $(document).on('click','.course-headlines-list__items',function(){
                $('.course-headlines-list__items').removeClass('active');
                $(this).addClass('active');
                $('.course-tab').hide();
                $('#'+$(this).attr('rel-tab')).fadeIn('slow');
            });

});
</script>

@endsection
