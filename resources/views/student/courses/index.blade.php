@extends('layouts.app')
@section('styles')
<link rel="stylesheet" href="{{ asset('css/student/coursesDashboard.css')}}">
@endsection

@section('content')
<section class="courses">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-3 col-md-3 sidebar-topic">
                <nav id="sidebar-courses">
                    <ul class="list-items">
                        @foreach($categories as $key => $category)
                        <!-- <li class="active-list-class"> -->
                        <li class="">
                            <a onClick="getCourses({{$key}})">{{$category}}</a>
                        </li>
                        @endforeach
                    </ul>
                </nav>
            </div>

            <div class="col-lg-9 col-md-9">
                <div class="all-courses">
                    <h4 class="lessons">Lessons</h4>
                    <div class="row card-wrapper-courses" id="lessons">
                        @if (count($categories)==0)
                        <p>No Lessons Available</p>
                        @else
                        <p style="color: #575fcf;">Select Course to view lessons...</p>
                        @endif
                    </div>

                </div>
            </div>

        </div>


    </div>
</section>
@endsection


@section('scripts')
<script src="{{ asset('js/student/courseDashboard.js')}}"></script>
<script>
    function getCourses(id) {
        let category_id = id;
        $.ajax({
            url: "{{ route('getspecificCourses') }}",
            data: {category_id: category_id},
            method: "GET",
            dataType: 'json',
            beforeSend: function(request) {
                        return request.setRequestHeader('X-CSRF-Token', $("meta[name='csrf-token']").attr('content'));
                    },
            success: function(data) {
                $('#lessons').empty();
                if(data.length>0) {
                    for(i=0;i<data.length;i++) {
                        let thumbnail = '';
                        let teacher = '';
                        $.each(data[i].thumbnail, function(index,value) {
                            return thumbnail = value.url;
                            });
                        $.each(data[i].teachers, function(index,value) {
                            return teacher = teacher+' '+value.name;
                            })
                    $('#lessons').append(
                        `<div class="card-courses"><a href="courseDetail/${data[i]['id']}">
                            <img src="`+(thumbnail ? thumbnail : 'frontend/img/Rectangle 4.png')+`" alt="" class="card-img-1" />
                            <div class="card-content-1">
                                <h6 class="lesson-title">`+data[i]['title']+`</h6>
                                <p class="teacher-name">`+teacher+`</p>
                            </div></a>
                        </div>`
                        );
                    }
                } else {
                    $('#lessons').append(
                        `<p style = "color: #575fcf;">No lessons to display...</p>`
                    );
                }
            }
        });
    }

    $(document).ready(function() {
    });
</script>
@endsection
