@inject('request', 'Illuminate\Http\Request')
@extends('admin.backend.layouts.master')
@section('title','Questions')

@section('content')
@can('question-create')
<div style="margin-bottom: 10px;" class="row">
    <div class="col-lg-12">

        <a class="btn btn-success"
            href="{{ route("admin.questions.create")}}{{(request()->get('quiz') != Null)?'?quiz='.request()->get('quiz'):''}}">
            {{ trans('global.add') }} {{ trans('cruds.question.title_singular') }}
        </a>
        @if(isset($quiz))
            <a href="{{ route('admin.questions.showImport').'?quiz='.$quiz->id }}"
                class="btn btn-primary">Add Questions <i class="fas fa-file-excel"></i><a>
        @endif
    </div>
</div>

@endcan

<p>
    <ul class="list-inline">
        <li><a href="{{ route('admin.questions.index') }}"
                style="{{ request('show_deleted') == 1 ? '' : 'font-weight: 700' }}">All</a></li> |
        <li><a href="{{ route('admin.questions.index') }}?show_deleted=1"
                style="{{ request('show_deleted') == 1 ? 'font-weight: 700' : '' }}">Trash</a></li>
    </ul>
</p>
<div class="card">
    <div class="card-header">
        {{ trans('cruds.question.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-Question">
                <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th>
                            {{ trans('cruds.question.fields.id') }}
                        </th>
                        {{-- <th>
                            {{ trans('cruds.question.fields.category') }}
                        </th> --}}
                        <th>
                            {{ trans('cruds.question.fields.quiz') }} Title
                        </th>
                        <th>
                            {{ trans('cruds.question.fields.question_text') }}
                        </th>
                        <th>
                            {{ trans('cruds.question.fields.options') }}
                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($questions as $key => $question)
                    <tr data-entry-id="{{ $question->id }}">
                        <td>

                        </td>
                        <td>
                            {{ $key+1 }}
                        </td>
                        {{-- <td>
                                {{ $question->subcategory->category->name ?? '' }}
                        </td> --}}
                        <td>
                            @foreach($question->quizzes as $q) {{ $q->title ?? '' }} @endforeach
                        </td>
                        <td>
                            <div class="readonly-editor" id="q{{ $key}}">
                                {{  $question->question_text ?? '' }}</div>
                        </td>
                        <td>
                            @foreach($question->questionOptions as $i=>$options) <label
                                class=" @if($options->points !== 0) badge badge-success @else badge badge-secondary @endif">
                                <div class="readonly-editor" id="o{{$key.''.$i}}">
                                    {{ $options->option_text ?? '' }}</div>
                            </label> @endforeach
                        </td>
                        @if( request('show_deleted') == 1 )
                        <td>
                            {!! Form::open(array(
                            'style' => 'display: inline-block;',
                            'method' => 'POST',
                            'onsubmit' => "return confirm('".trans("global.areYouSure")."');",
                            'route' => ['admin.questions.restore', $question->id])) !!}
                            {!! Form::submit(trans('global.restore'), array('class' => 'btn btn-xs btn-success')) !!}
                            {!! Form::close() !!}
                            {!! Form::open(array(
                            'style' => 'display: inline-block;',
                            'method' => 'DELETE',
                            'onsubmit' => "return confirm('".trans("global.areYouSure")."');",
                            'route' => ['admin.questions.perma_del', $question->id])) !!}
                            {!! Form::submit(trans('global.permadel'), array('class' => 'btn btn-xs btn-danger')) !!}
                            {!! Form::close() !!}
                        </td>
                        @else
                        <td>
                            @can('question-show')
                            <a href="{{ route('admin.questions.show',[$question->id]) }}"
                                class="btn btn-xs btn-primary">@lang('global.view')</a>
                            @endcan
                            @can('question-edit')
                            <a href="{{ route('admin.questions.edit',[$question->id]) }}"
                                class="btn btn-xs btn-info">@lang('global.edit')</a>
                            @endcan
                            @can('question-delete')
                            {!! Form::open(array(
                            'style' => 'display: inline-block;',
                            'method' => 'DELETE',
                            'onsubmit' => "return confirm('".trans("global.areYouSure")."');",
                            'route' => ['admin.questions.perma_del', $question->id])) !!}
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
</div>



@endsection
@section('scripts')
@parent
<script>
    $(function () {
  var i = '<?php echo request('show_deleted')?>';

  let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
    if (i != 1) {
        @can('question-delete')
        let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
        let deleteButton = {
            text: deleteButtonTrans,
            url: "{{ route('admin.questions.massDestroy') }}",
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
  $('.datatable-Question:not(.ajaxTable)').DataTable({ buttons: dtButtons })
    $('a[data-toggle="tab"]').on('shown.bs.tab', function(e){
        $($.fn.dataTable.tables(true)).DataTable()
            .columns.adjust();
    });
})

</script>
@endsection
