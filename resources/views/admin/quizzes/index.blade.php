@inject('request', 'Illuminate\Http\Request')
@extends('admin.backend.layouts.master')
@section('title','Quizzes')

@section('content')
@can('quiz-create')
<p>
    <a href="{{ route('admin.quizzes.create') }}" class="btn btn-success">@lang('global.add')
        {{ trans('cruds.quizzes.title_singular') }}</a>

</p>
@endcan

<p>
    <ul class="list-inline">
        <li><a href="{{ route('admin.quizzes.index') }}"
                style="{{ request('show_deleted') == 1 ? '' : 'font-weight: 700' }}">All</a></li> |
        <li><a href="{{ route('admin.quizzes.index') }}?show_deleted=1"
                style="{{ request('show_deleted') == 1 ? 'font-weight: 700' : '' }}">Trash</a></li>
    </ul>
</p>

<div class="card">
    <div class="card-header">
        {{ trans('cruds.quizzes.title_singular') }} @lang('global.list')
    </div>

    <div class="card-body table-responsive">
        <table class=" table table-bordered table-striped table-hover datatable datatable-Quiz">
            <thead>
                <tr>
                    <th></th>
                    <th>@lang('cruds.quizzes.fields.course')</th>
                    @if (Auth::user()->isAdmin())
                    @endif
                    <th>@lang('cruds.quizzes.fields.title')</th>
                    <th>@lang('cruds.quizzes.fields.description')</th>
                    {{-- <th>@lang('cruds.quizzes.fields.questions')</th> --}}
                    <th>@lang('cruds.quizzes.fields.published')</th>
                    <th>@lang('cruds.quizzes.fields.answer_published')</th>
                    @if( request('show_deleted') == 1 )
                    <th>&nbsp;</th>
                    @else
                    <th>&nbsp;</th>
                    @endif
                </tr>
            </thead>

            <tbody>
                @foreach ($quizzes as $key=>$quiz)
                <tr data-entry-id="{{ $quiz->id }}">
                    <td></td>
                    <td>{{ $quiz->course->title or '' }}</td>
                    @if (Auth::user()->isAdmin())
                    @endif
                    <td>{{ $quiz->title }}</td>
                    <td>{!! $quiz->description !!}</td>
                    <td>
                        <div class="container">
                            <label class="switch" for="publish-checkbox-{{$quiz->id}}" >
                              <input type="checkbox" class="publish-switch" id="publish-checkbox-{{$quiz->id}}" rel-id="{{$quiz->id}}" {{$quiz->published == 1 ? 'checked' : ''}}/>
                              <div class="toggle-slider round"></div>
                            </label>
                          </div>
                    </td>
                    <td>
                        <div class="container">
                            <label class="switch" for="answer-publish-checkbox-{{$quiz->id}}" >
                              <input type="checkbox" class="answer-publish-switch" id="answer-publish-checkbox-{{$quiz->id}}" rel-id="{{$quiz->id}}"  {{$quiz->answer_publish == 1 ? 'checked' : ''}}/>
                              <div class="toggle-slider publish-slider round"></div>
                            </label>
                          </div>
                    </td>
                    @if( request('show_deleted') == 1 )
                    <td>
                        {!! Form::open(array(
                        'style' => 'display: inline-block;',
                        'method' => 'POST',
                        'onsubmit' => "return confirm('".trans("global.areYouSure")."');",
                        'route' => ['admin.quizzes.restore', $quiz->id])) !!}
                        {!! Form::submit(trans('global.restore'), array('class' => 'btn btn-xs btn-success')) !!}
                        {!! Form::close() !!}
                        {!! Form::open(array(
                        'style' => 'display: inline-block;',
                        'method' => 'DELETE',
                        'onsubmit' => "return confirm('".trans("global.areYouSure")."');",
                        'route' => ['admin.quizzes.perma_del', $quiz->id])) !!}
                        {!! Form::submit(trans('global.permadel'), array('class' => 'btn btn-xs btn-danger')) !!}
                        {!! Form::close() !!}
                    </td>
                    @else
                    <td>
                        @can('quiz-show')
                        <a href="{{ route('admin.quizzes.show',[$quiz->id]) }}"
                            class="btn btn-xs btn-primary">@lang('global.view')</a>
                        @endcan
                        @can('question-show')
                        <a href="{{ route('admin.questions.index').'?quiz='.$quiz->id }}"
                            class="btn btn-xs btn-primary">@lang('global.view')
                            {{ trans('cruds.question.title_singular')}}</a> @endcan
                        @can('quiz-edit') <a href="{{ route('admin.quizzes.edit',[$quiz->id]) }}"
                            class="btn btn-xs btn-info">@lang('global.edit')</a>
                        @endcan
                        @can('quiz-delete')
                        {!! Form::open(array(
                        'style' => 'display: inline-block;',
                        'method' => 'DELETE',
                        'onsubmit' => "return confirm('".trans("global.areYouSure")."');",
                        'route' => ['admin.quizzes.destroy', $quiz->id])) !!}
                        {!! Form::submit(trans('global.delete'), array('class' => 'btn btn-xs btn-danger')) !!}
                        {!! Form::close() !!}
                        @endcan
                    </td>
                    @endif
                </tr>
                @endforeach

            </tbody>
        </table>
    </div>
</div>
@stop

@section('scripts')
@parent
<script>
    $(function () {
  var i = '<?php echo request('show_deleted')?>';

  let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
    if (i != 1) {
    @can('quiz-delete')
    let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
    let deleteButton = {
        text: deleteButtonTrans,
        url: "{{ route('admin.quizzes.mass_destroy') }}",
        className: 'btn-danger',
        action: function (e, dt, node, config) {
        var ids = $.map(dt.rows({ selected: true }).nodes(), function (entry) {
            return $(entry).data('entry-id')
        });

        if (ids.length === 0) {
            alert('{{ trans('global.datatables.zero_selected') }}')

            return
        }

        if (confirm('{{ trans('global.areYouSure') }}')) {
            $.ajax({
            headers: {'x-csrf-token': _token},
            method: 'POST',
            url: config.url,
            data: { ids: ids, _method: 'DELETE' }})
            .done(function () { location.reload() })
        }
        }
    }
    dtButtons.push(deleteButton)
    @endcan
    }
  $.extend(true, $.fn.dataTable.defaults, {
    order: [[ 1, 'desc' ]],
    pageLength: 100,
  });
  $('.datatable-Quiz:not(.ajaxTable)').DataTable({ buttons: dtButtons })
    $('a[data-toggle="tab"]').on('shown.bs.tab', function(e){
        $($.fn.dataTable.tables(true)).DataTable()
            .columns.adjust();
    });

    $(document).on('click','.publish-switch',function(){
        let is_published = false;
        let id = $(this).attr('rel-id');
        if($(this).prop('checked')){
            is_published = true;
        }
        $.ajax({
            headers: {'x-csrf-token': _token},
            method: 'POST',
            url: "{{ route('admin.quizzes.updatePublish') }}",
            data: { id: id, is_published : is_published},
            success : function(data){

            },
        })
    })

    $(document).on('click','.answer-publish-switch',function(){
        let is_published = false;
        let id = $(this).attr('rel-id');
        if($(this).prop('checked')){
            is_published = true;
        }
        $.ajax({
            headers: {'x-csrf-token': _token},
            method: 'POST',
            url: "{{ route('admin.quizzes.updateAnswerPublish') }}",
            data: { id: id, is_published : is_published},
            success : function(data){

            },
        })
    })

})

</script>
@endsection
