@extends('admin.backend.layouts.master')
@section('title','Add Assignment')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.grade.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.grades.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label class="required" for="title">{{ trans('cruds.grade.fields.title') }}</label>
                <input class="form-control {{ $errors->has('title') ? 'is-invalid' : '' }}" type="text" name="title"
                    id="title" value="{{ old('title', '') }}" required>
                @if($errors->has('title'))
                <div class="invalid-feedback">
                    {{ $errors->first('title') }}
                </div>
                @endif
                <span class="help-block">{{ trans('cruds.grade.fields.title_helper') }}</span>
            </div>
            <div class="form-group editor-container">
                <label class="" for="instruction">{{ trans('cruds.grade.fields.instruction') }}</label>
                <input type="hidden" class="form-control {{ $errors->has('instruction') ? 'is-invalid' : '' }}"
                    name="instruction" value="{{ old('instruction', '') }}">
                <div class="editor" id="editor"></div>
                @if($errors->has('instruction'))
                <div class="invalid-feedback">
                    {{ $errors->first('instruction') }}
                </div>
                @endif
                <span class="help-block">{{ trans('cruds.grade.fields.instruction_helper') }}</span>
                <a class="resource-add  my-2"><i class="fas fa-paperclip"></i> Add Resources</a>
                <div class="row resource-container" style="display: none;">
                    <div class="col-md-12 form-group">
                        <label for="resource">Resources</label>
                        <div class="needsclick dropzone {{ $errors->has('resource') ? 'is-invalid' : '' }}"
                            id="resource-dropzone">
                        </div>
                        @if($errors->has('resource'))
                        <span class="text-danger">{{ $errors->first('resource') }}</span>
                        @endif
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label class="" for="points">{{ trans('cruds.grade.fields.points') }}</label>
                    <input class="form-control {{ $errors->has('points') ? 'is-invalid' : '' }}" type="text"
                        name="points" id="points" value="{{ old('points', '') }}" required>
                    @if($errors->has('points'))
                    <div class="invalid-feedback">
                        {{ $errors->first('points') }}
                    </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.grade.fields.points_helper') }}</span>
                </div>
                <a class="criteria-add  my-2" data-toggle="modal" data-target="#criteria-modal"><i
                        class="fas fa-cubes"></i> Add Point Criteria</a>
            </div>
            <div class="row">
                <div class="form-group col-md-6">
                    <label class="required" for="due_date">{{ trans('cruds.grade.fields.due_date') }}</label>
                    <input class="form-control date-time-picker {{ $errors->has('due_date') ? 'is-invalid' : '' }}"
                        typd="tdxt" name="cue_Date" id="due_date" value="{{ old('due_date', '') }}" required>
                    @if($errors->has('due_date'))
                    <div class="invalid-feedback">
                        {{ $errors->first('due_date') }}
                    </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.grade.fields.title_helper') }}</span>
                </div>
                <div class="form-group col-md-6">
                    <label class="required" for="end_date">{{ trans('cruds.grade.fields.end_date') }}</label>
                    <input class="form-control date-time-picker {{ $errors->has('end_date') ? 'is-invalid' : '' }}"
                        typd="tdxt" name="cue_Date" id="end_date" value="{{ old('end_date', '') }}" required>
                    @if($errors->has('end_date'))
                    <div class="invalid-feedback">
                        {{ $errors->first('end_date') }}
                    </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.grade.fields.title_helper') }}</span>
                </div>
            </div>


            <div class="form-group">
                <button class="btn btn-success" type="submit">
                    {{ trans('global.save') }}
                </button>
            </div>
        </form>
    </div>
</div>

<div class="modal fade" id="criteria-modal" tabindex="-1" role="dialog" aria-labelledby="criteria-modalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="criteria-modalLabel">Choose Point Criteria</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-6">
                        <a data-toggle="modal" data-target="#add-criteria-modal" data-dismiss="modal"
                            aria-label="Close"><i class="fas fa-plus"></i>
                            <small>Add Point Criteria</small></a>
                    </div>
                    <div class="cold-md-6">
                        <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-success">Next</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="add-criteria-modal" tabindex="-1" role="dialog" aria-labelledby="criteria-modalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg" style="max-width: 90vw !important; " role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="criteria-modalLabel">New Point Criteria</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label class="required" for="criteria-title">{{ trans('cruds.grade.fields.title') }}</label>
                    <input class="form-control {{ $errors->has('title') ? 'is-invalid' : '' }}" type="text" name="title"
                        id="criteria-title" value="{{ old('title', '') }}" required>
                    @if($errors->has('title'))
                    <div class="invalid-feedback">
                        {{ $errors->first('title') }}
                    </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.grade.fields.title_helper') }}</span>
                </div>
                <div class="form-group editor-container">
                    <label class="" for="instruction">{{ trans('cruds.grade.fields.instruction') }}</label>
                    <textarea type="hidden" class="form-control {{ $errors->has('instruction') ? 'is-invalid' : '' }}"
                        name="instruction" value="{{ old('instruction', '') }}"></textarea>
                    @if($errors->has('instruction'))
                    <div class="invalid-feedback">
                        {{ $errors->first('instruction') }}
                    </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.grade.fields.instruction_helper') }}</span>
                </div>
                <label for="">Grading Criteria</label>
                <div class="row">
                    <div class="col-md-2">
                        <input class="form-control" type="text" name="criteria-category[]" placeholder="Enter Category">
                        <hr>
                        <textarea name="criteria-description[]" class="form-control"
                            placeholder="Enter Description"></textarea>
                    </div>
                    <div class="col-md-2">
                        <input class="form-control" type="text" name="criteria-category[]" placeholder="Enter Category">
                        <hr>
                        <textarea name="criteria-description[]" class="form-control"
                            placeholder="Enter Description"></textarea>
                    </div>
                    <div class="col-md-2">
                        <input class="form-control" type="text" name="criteria-category[]" placeholder="Enter Category">
                        <hr>
                        <textarea name="criteria-description[]" class="form-control"
                            placeholder="Enter Description"></textarea>
                    </div>
                    <div class="col-md-2">
                        <input class="form-control" type="text" name="criteria-category[]" placeholder="Enter Category">
                        <hr>
                        <textarea name="criteria-description[]" class="form-control"
                            placeholder="Enter Description"></textarea>
                    </div>
                    <div class="col-md-2">
                        <input class="form-control" type="text" name="criteria-category[]" placeholder="Enter Category">
                        <hr>
                        <textarea name="criteria-description[]" class="form-control"
                            placeholder="Enter Description"></textarea>
                    </div>
                    <div class="col-md-2">
                        <input class="form-control" type="text" name="criteria-category[]" placeholder="Enter Category">
                        <hr>
                        <textarea name="criteria-description[]" class="form-control"
                            placeholder="Enter Description"></textarea>
                    </div>
                </div>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-success">Save</button>
            </div>
        </div>
    </div>
</div>



@endsection
@section('scripts')
<script>
    var uploadedResourceMap = {}
        Dropzone.options.resourceDropzone = {
        url: '{{ route('admin.assignments.storeMedia') }}',
        maxFilesize: 2, // MB
        addRemoveLinks: true,
        headers: {
          'X-CSRF-TOKEN': "{{ csrf_token() }}"
        },
        params: {
          size: 2
        },
        success: function (file, response) {
          $('form').append('<input type="hidden" name="resource[]" value="' + response.name + '">');
          uploadedResourceMap[file.name] = response.name;
          console.log(file);
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
    @if(isset($assignment) && $assignment->resource)
          var files =
            {!! json_encode($assignment->resource) !!}
              for (var i in files) {
              var file = files[i]
              this.options.addedfile.call(this, file)
              this.options.resource.call(this, file, file.url)
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
    $(function(){

    $(document).on('click','.resource-add',function(){
        if($(this).hasClass('active')){
            $(this).removeClass('active');
            $('.resource-container').slideUp();
        }else{
        $(this).addClass('active');
        $('.resource-container').slideDown();
        }
    });

});

</script>
@endsection
