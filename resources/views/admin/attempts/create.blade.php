@extends('admin.backend.layouts.master')
@section('title','Add Lessons')

@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.add') }} {{ trans('cruds.lessons.title_singular') }}
    </div>

    <div class="card-body">
        {!! Form::open(['method' => 'POST', 'route' => ['admin.lessons.store'], 'files' => true,]) !!}
            <div class="row">
                <div class="col-md-12 form-group">
                    {!! Form::label('course_id', 'Course', ['class' => 'control-label row required']) !!}
                    {!! Form::select('course_id', $courses, old('course_id'), ['class' => 'form-control select2']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('course_id'))
                        <p class="help-block">
                            {{ $errors->first('course_id') }}
                        </p>
                    @endif
                </div>
            </div>
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
                      <label for="thumbnail">Lesson image</label>
                        <div class="needsclick dropzone {{ $errors->has('thumbnail') ? 'is-invalid' : '' }}" id="thumbnail-dropzone">
                        </div>
                        @if($errors->has('thumbnail'))
                            <span class="text-danger">{{ $errors->first('thumbnail') }}</span>
                        @endif
                        {{-- <span class="help-block">{{ trans('cruds.lesson.fields.thumbnail_helper') }}</span> --}}

                    {{-- {!! Form::label('lesson_image', 'Lesson image', ['class' => 'control-label']) !!}
                    {!! Form::file('lesson_image', ['class' => 'form-control', 'style' => 'margin-top: 4px;']) !!}
                    {!! Form::hidden('lesson_image_max_size', 8) !!}
                    {!! Form::hidden('lesson_image_max_width', 4000) !!}
                    {!! Form::hidden('lesson_image_max_height', 4000) !!}
                    <p class="help-block"></p>
                    @if($errors->has('lesson_image'))
                        <p class="help-block">
                            {{ $errors->first('lesson_image') }}
                        </p>
                    @endif --}}
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 form-group">
                    {!! Form::label('short_text', 'Short text', ['class' => 'control-label']) !!}
                    {!! Form::textarea('short_text', old('short_text'), ['class' => 'form-control ', 'placeholder' => '', 'rows' => '5']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('short_text'))
                        <p class="help-block">
                            {{ $errors->first('short_text') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 form-group">
                    {!! Form::label('full_text', 'Full text', ['class' => 'control-label']) !!}
                    {!! Form::textarea('full_text', old('full_text'), ['class' => 'form-control', 'id'=>'editor', 'placeholder' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('full_text'))
                        <p class="help-block">
                            {{ $errors->first('full_text') }}
                        </p>
                    @endif
                </div>
            </div>

            <div class="row">
                <div class="col-md-12 form-group">
                    {{-- {!! Form::label('downloadable_files', 'Downloadable files', ['class' => 'control-label']) !!}
                    {!! Form::file('downloadable_files[]', [
                        'multiple',
                        'class' => 'form-control file-upload',
                        'data-url' => route('admin.media.upload'),
                        'data-bucket' => 'downloadable_files',
                        'data-filekey' => 'downloadable_files',
                        ]) !!}
                    <p class="help-block"></p>
                    <div class="photo-block">
                        <div class="progress-bar form-group">&nbsp;</div>
                        <div class="files-list"></div>
                    </div>
                    @if($errors->has('downloadable_files'))
                        <p class="help-block">
                            {{ $errors->first('downloadable_files') }}
                        </p>
                    @endif --}}


                    <label for="video">Video</label>
                    <div class="needsclick dropzone {{ $errors->has('video') ? 'is-invalid' : '' }}" id="video-dropzone">
                    </div>
                    @if($errors->has('video'))
                        <span class="text-danger">{{ $errors->first('video') }}</span>
                    @endif

                    <label for="lesson_files">Files</label>
                    <div class="needsclick dropzone {{ $errors->has('lesson_files') ? 'is-invalid' : '' }}" id="file-dropzone">
                    </div>
                    @if($errors->has('lesson_files'))
                        <span class="text-danger">{{ $errors->first('lesson_files') }}</span>
                    @endif
                    {{-- <span class="help-block">{{ trans('cruds.lesson.fields.video_helper') }}</span> --}}
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 form-group">
                    {!! Form::label('free_lesson', 'Free lesson', ['class' => 'control-label']) !!}
                    {!! Form::hidden('free_lesson', 0) !!}
                    {!! Form::checkbox('free_lesson', 1, false, []) !!}
                    <p class="help-block"></p>
                    @if($errors->has('free_lesson'))
                        <p class="help-block">
                            {{ $errors->first('free_lesson') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 form-group">
                    {!! Form::label('published', 'Published', ['class' => 'control-label']) !!}
                    {!! Form::hidden('published', 0) !!}
                    {!! Form::checkbox('published', 1, false, []) !!}
                    <p class="help-block"></p>
                    @if($errors->has('published'))
                        <p class="help-block">
                            {{ $errors->first('published') }}
                        </p>
                    @endif
                </div>
            </div>

            {!! Form::submit(trans('global.add'), ['class' => 'btn btn-danger']) !!}
        </div>
    </div>

    {!! Form::close() !!}
@stop

@section('scripts')
    @parent
    <script>
        var uploadedThumbnailMap = {}
    Dropzone.options.thumbnailDropzone = {
        url: '{{ route('admin.lessons.storeMedia') }}',
        maxFilesize: 2, // MB
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
          console.log(file)
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
    @if(isset($lesson) && $lesson->thumbnail)
          var files =
            {!! json_encode($lesson->thumbnail) !!}
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
    Dropzone.options.fileDropzone = {
        url: '{{ route('admin.lessons.storeMedia') }}',
        maxFilesize: 20, // MB
        addRemoveLinks: true,
        headers: {
          'X-CSRF-TOKEN': "{{ csrf_token() }}"
        },
        success: function (file, response) {
          $('form').append('<input type="hidden" name="lesson_files[]" value="' + response.name + '">')
          uploadedThumbnailMap[file.name] = response.name
        },
        removedfile: function (file) {
          console.log(file)
          file.previewElement.remove()
          var name = ''
          if (typeof file.file_name !== 'undefined') {
            name = file.file_name
          } else {
            name = uploadedThumbnailMap[file.name]
          }
          $('form').find('input[name="lesson_files[]"][value="' + name + '"]').remove()
        },
        init: function () {
    @if(isset($lesson) && $lesson->lesson_files)
          var files = {!! json_encode($lesson->lesson_files) !!};
              for (var i in files) {
              var file = files[i];
              this.options.addedfile.call(this, file);
              this.options.thumbnail.call(this, file, file.url);
              file.previewElement.classList.add('dz-complete');
              console.log('test')
              $('form').append('<input type="hidden" name="lesson_files[]" value="' + file.file_name + '">');
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

    <script>
        Dropzone.options.videoDropzone = {
        url: '{{ route('admin.lessons.storeMedia') }}',
        maxFilesize: 2, // MB
        maxFiles: 1,
        addRemoveLinks: true,
        headers: {
          'X-CSRF-TOKEN': "{{ csrf_token() }}"
        },
        params: {
          size: 2
        },
        success: function (file, response) {
          $('form').find('input[name="video"]').remove()
          $('form').append('<input type="hidden" name="video" value="' + response.name + '">')
        },
        removedfile: function (file) {
          file.previewElement.remove()
          if (file.status !== 'error') {
            $('form').find('input[name="video"]').remove()
            this.options.maxFiles = this.options.maxFiles + 1
          }
        },
        init: function () {
    @if(isset($lesson) && $lesson->video)
          var file = {!! json_encode($lesson->video) !!}
              this.options.addedfile.call(this, file)
          file.previewElement.classList.add('dz-complete')
          $('form').append('<input type="hidden" name="video" value="' + file.file_name + '">')
          this.options.maxFiles = this.options.maxFiles - 1
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
