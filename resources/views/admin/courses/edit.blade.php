@extends('admin.backend.layouts.master')
@section('title','Edit Course')
@section('styles')
<style>
    img[data-dz-thumbnail] {     width: 100%;     height: 100%;     object-fit: cover; }
    </style>
@endsection
@section('content')
<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.courses.title_singular') }}
    </div>

    <div class="card-body">
    {!! Form::model($course, ['method' => 'PUT', 'route' => ['admin.courses.update', $course->id], 'files' => true,]) !!}

            <div class="row">
                <div class="col-md-12 form-group">
                    {!! Form::label('category_id', 'Category', ['class' => 'control-label row required']) !!}
                    {!! Form::select('category_id', $categories, old('category_id'), ['class' => 'form-control select2']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('category_id'))
                        <p class="help-block">
                            {{ $errors->first('category_id') }}
                        </p>
                    @endif
                </div>
            </div>

            <div class="row">
                <div class="col-md-12 form-group">
                    {!! Form::label('grade_id', 'Grade', ['class' => 'control-label row required']) !!}
                    {!! Form::select('grade_id', $grades, old('grade_id'), ['class' => 'form-control select2']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('grade_id'))
                        <p class="help-block">
                            {{ $errors->first('grade_id') }}
                        </p>
                    @endif
                </div>
            </div>
            @if (Auth::user()->isAdmin())
            <div class="row">
                <div class="col-md-12 form-group">
                    {!! Form::label('teachers', 'Teachers', ['class' => 'control-label row']) !!}
                    {!! Form::select('teachers', $teachers, old('teachers') ? old('teachers') : $course->teachers->pluck('id')->toArray(), ['class' => 'form-control select2  col-md-12 row']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('teachers'))
                        <p class="help-block">
                            {{ $errors->first('teachers') }}
                        </p>
                    @endif
                </div>
            </div>
            @endif
            <div class="row">
                <div class="col-md-12 form-group">
                    {!! Form::label('title', 'Title', ['class' => 'control-label required']) !!}
                    {!! Form::text('title', old('title'), ['class' => 'form-control', 'placeholder' => '', 'required' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('title'))
                        <p class="help-block">
                            {{ $errors->first('title') }}
                        </p>
                    @endif
                </div>
            </div>

            <div class="row">
                <div class="col-md-12 form-group">
                    <label for="thumbnail">Course image</label>
                    <div class="needsclick dropzone {{ $errors->has('thumbnail') ? 'is-invalid' : '' }}" id="thumbnail-dropzone">
                    </div>
                    @if($errors->has('thumbnail'))
                        <span class="text-danger">{{ $errors->first('thumbnail') }}</span>
                    @endif
                    <!-- {!! Form::label('course_image', 'Course image', ['class' => 'control-label']) !!}
                    {!! Form::file('course_image', ['class' => 'form-control', 'style' => 'margin-top: 4px;']) !!}
                    {!! Form::hidden('course_image_max_size', 8) !!}
                    {!! Form::hidden('course_image_max_width', 4000) !!}
                    {!! Form::hidden('course_image_max_height', 4000) !!}
                    @if ($course->course_image)
                    <a href="{{ asset('uploads/'.$course->course_image) }}" target="_blank"><img src="{{ asset('uploads/thumb/'.$course->course_image) }}"></a>
                    @endif
                    <p class="help-block"></p>
                    @if($errors->has('course_image'))
                        <p class="help-block">
                            {{ $errors->first('course_image') }}
                        </p>
                    @endif -->
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 form-group">
                    {!! Form::label('description', 'Description', ['class' => 'control-label']) !!}
                    {!! Form::textarea('description', old('description'), ['class' => 'form-control', 'id'=>'editor', 'placeholder' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('description'))
                        <p class="help-block">
                            {{ $errors->first('description') }}
                        </p>
                    @endif
                </div>
            </div>
            {!! Form::submit(trans('global.update'), ['class' => 'btn btn-success']) !!}
        </div>
    </div>
    {!! Form::close() !!}
@stop

@section('scripts')
    @parent
    <script>
        $('.date').datepicker({
            autoclose: true,
            format: "{{ config('app.date_format_js') }}"
        });
    </script>
    <script>
        var uploadedThumbnailMap = {}
    Dropzone.options.thumbnailDropzone = {
        url: '{{ route('admin.courses.storeMedia') }}',
        maxFilesize: 2, // MB
        // maxFiles: 1,
        acceptedFiles: '.jpeg,.jpg,.png,.gif',
        addRemoveLinks: true,
        headers: {
        'X-CSRF-TOKEN': "{{ csrf_token() }}"
        },
        params: {
        size: 2,
        width: 4096,
        height: 4096
        },
        success: function (file, response) {
        $('form').append('<input type="hidden" name="thumbnail[]" value="' + response.name + '">')
        uploadedThumbnailMap[file.name] = response.name
        },
        removedfile: function (file) {
        file.previewElement.remove()
        var name = ''
        if (typeof file.file_name !== 'undefined') {
            name = file.file_name
        } else {
            name = uploadedThumbnailMap[file.name]
        }
        $('form').find('input[name="thumbnail[]"][value="' + name + '"]').remove()
        },
        init: function () {
    @if(isset($course) && $course->thumbnail)
    // dd($course);
        var files =
            {!! json_encode($course->thumbnail) !!}
            for (var i in files) {
            var file = files[i]
            this.options.addedfile.call(this, file)
            this.options.thumbnail.call(this, file, file.url)
            file.previewElement.classList.add('dz-complete')
            $('form').append('<input type="hidden" name="thumbnail[]" value="' + file.file_name + '">')
            }
    @endif
        },
        error: function (file, response) {
            if ($.type(response) === 'string') {
                var message = response //dropzone sends it's own error messages in string
            } else {
                var message = response.errors.file
            }
            file.previewElement.classList.add('dz-error')
            _ref = file.previewElement.querySelectorAll('[data-dz-errormessage]')
            _results = []
            for (_i = 0, _len = _ref.length; _i < _len; _i++) {
                node = _ref[_i]
                _results.push(node.textContent = message)
            }

            return _results
        }
    }
    </script>
@stop
