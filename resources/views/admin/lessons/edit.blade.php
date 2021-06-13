@extends('admin.backend.layouts.master')
@section('title','Edit Lesson')
@section('styles')
<style>
    img[data-dz-thumbnail] {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }
</style>
@endsection
@section('content')
<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.lessons.title_singular') }}
    </div>
    <div class="card-body">
        {!! Form::model($lesson, ['method' => 'PUT', 'route' => ['admin.lessons.update', $lesson->id], 'files' =>
        true,]) !!}
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
                {!! Form::text('title', old('title'), ['class' => 'form-control', 'placeholder' => '', 'required' =>
                '']) !!}
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
                <div class="needsclick dropzone {{ $errors->has('thumbnail') ? 'is-invalid' : '' }}"
                    id="thumbnail-dropzone">
                </div>
                @if($errors->has('thumbnail'))
                <span class="text-danger">{{ $errors->first('thumbnail') }}</span>
                @endif
                {{-- <span class="help-block">{{ trans('cruds.lesson.fields.thumbnail_helper') }}</span> --}}
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 form-group">
                {!! Form::label('short_text', 'Description ', ['class' => 'control-label']) !!}
                {!! Form::textarea('short_text', old('short_text'), ['class' => 'form-control ', 'placeholder' => ''])
                !!}
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
                <label for="exampleInputDetails">Video:</label>
                <li class="tg-list-item">
                    <input name="video_type" class="tgl tgl-skewed" id="preview" type="checkbox"
                        {{ $lesson->video_type=="video" ? 'checked' : '' }} />
                    <label class="tgl-btn" data-tg-off="URL" data-tg-on="Upload" for="preview"></label>
                </li>
                <!-- <input type="hidden" name="free" value="0" id="cx">                  -->

                <div class="" id="document1" @if($lesson->video_type =="url" || $lesson->video_type =="" )
                    style="display:none;" @endif">
                    <label for="video">Upload Video</label>
                    <div class="needsclick dropzone {{ $errors->has('video') ? 'is-invalid' : '' }}"
                        id="video-dropzone">
                    </div>

                    @if(isset($lesson->video))
                    <video src="{{$lesson->video->getUrl()}}" width="420" height="315" controls>
                    </video>
                    @endif
                </div>

                <div class="" id="document2" @if($lesson->video_type =="video" ) style="display:none;" @endif>
                    <label for="">Video URL (use embed url) </label>
                    <input type="text" name="url" id="url" placeholder="Enter Your URL" class="form-control"
                        value="{{ (old('url',$lesson->video_url)) }}">
                    <iframe width="420" height="315" id="iframe" src="{{$lesson->video_url}}" class="mt-5"
                        allow="accelerometer" frameborder="0" allowfullscreen>
                    </iframe>
                </div>

            </div>
        </div>
        <div class="row">
            <div class="col-md-12 form-group">
                <label for="resource">Resource</label>
                <div class="needsclick dropzone {{ $errors->has('resource') ? 'is-invalid' : '' }}"
                    id="resource-dropzone">
                </div>
                @if($errors->has('resource'))
                <span class="text-danger">{{ $errors->first('resource') }}</span>
                @endif
                {{-- <span class="help-block">{{ trans('cruds.lesson.fields.resource_helper') }}</span> --}}
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
    $(function() {
        $(document).on('change','#url',function(){
            if($(this).val().includes('iframe') || $(this).val().includes('IFRAME')){
                let url = $($.parseHTML($(this).val())).attr('src')
                 $(this).val(url);
                 $('#iframe').attr('src',url);
            }
        });

        $('#preview').on('change',function(){

        if($('#preview').is(':checked')){
        $('#document1').show('fast');
        $('#document2').hide('fast');

        }else{
        $('#document2').show('fast');
        $('#document1').hide('fast');
        }
        });
    })
</script>
<script>
    var uploadedThumbnailMap = {}
    Dropzone.options.thumbnailDropzone = {
        url: '{{ route('admin.lessons.storeMedia') }}',
        maxFilesize: 2, // MB
        maxFiles: 1,
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
          uploadedThumbnailMap[file.name] = response.name;
          let extension = file.name.split('.').slice(-1)[0];
              if(! file.type.includes('image')){
              this.emit("thumbnail", file, "/img/extension/"+extension+".png");
              }
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
    // dd($lesson);
          var files =
            {!! json_encode($lesson->thumbnail) !!}
              for (var i in files) {
              var file = files[i]
              this.options.addedfile.call(this, file)
              this.options.thumbnail.call(this, file, file.url)
              let extension = file.file_name.split('.').slice(-1)[0];
              if(! file.mime_type.includes('image')){
              this.emit("thumbnail", file, "/img/extension/"+extension+".png");
              }
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
<script>
    var uploadedResourceMap = {}
        Dropzone.options.resourceDropzone = {
        url: '{{ route('admin.lessons.storeMedia') }}',
        maxFilesize: 20, // MB
        addRemoveLinks: true,
        headers: {
          'X-CSRF-TOKEN': "{{ csrf_token() }}"
        },
        params: {
          size: 20
        },
        success: function (file, response) {
          $('form').append('<input type="hidden" name="resource[]" value="' + response.name + '">');
          uploadedResourceMap[file.name] = response.name;
          let extension = file.name.split('.').slice(-1)[0];
              if(! file.type.includes('image')){
              this.emit("thumbnail", file, "/img/extension/"+extension+".png");
              }
        },
        removedfile: function (file) {
          file.previewElement.remove()
          var name = ''
          if (typeof file.file_name !== 'undefined') {
            name = file.file_name
          } else {
            name = uploadedResourceMap[file.name]
          }
          $('form').find('input[name="resource[]"][value="' + name + '"]').remove()
        },
        init: function () {
    @if(isset($lesson) && $lesson->resource)
    // dd($lesson);
          var files =
            {!! json_encode($lesson->resource) !!}
              for (var i in files) {
              var file = files[i]
              this.options.addedfile.call(this, file)
              this.options.thumbnail.call(this, file, file.url)
              let extension = file.file_name.split('.').slice(-1)[0];
              if(! file.mime_type.includes('image')){
              this.emit("thumbnail", file, "/img/extension/"+extension+".png");
              }
              file.previewElement.classList.add('dz-complete')
              $('form').append('<input type="hidden" name="resource[]" value="' + file.file_name + '">')
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
        maxFilesize: 1024, // MB
        maxFiles: 1,
        acceptedFiles: "video/*",
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
