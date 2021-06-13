@inject('request', 'Illuminate\Http\Request')
@extends('admin.backend.layouts.master')
@section('title','Courses')

@section('content')
    @can('course-create')
    <p>
        <a href="{{ route('admin.courses.create') }}" class="btn btn-success">{{ trans('global.add') }} {{ trans('cruds.courses.title_singular') }}</a>
    </p>
    @endcan

    <p>
        <ul class="list-inline">
            <li><a href="{{ route('admin.courses.index') }}" style="{{ request('show_deleted') == 1 ? '' : 'font-weight: 700' }}">All</a></li> |
            <li><a href="{{ route('admin.courses.index') }}?show_deleted=1" style="{{ request('show_deleted') == 1 ? 'font-weight: 700' : '' }}">Trash</a></li>
        </ul>
    </p>


    <div class="card">
        <div class="card-header">
            {{ trans('cruds.courses.title_singular') }} {{ trans('global.list') }}
        </div>

        <div class="card-body table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-Course">
                {{-- <table class="table table-bordered table-striped {{ count($courses) > 0 ? 'datatable' : '' }} @can('course_delete') @if ( request('show_deleted') != 1 ) dt-select @endif @endcan"> --}}
                <thead>
                    <tr>
                        {{-- @can('course_delete')
                            @if ( request('show_deleted') != 1 )<th style="text-align:center;"><input type="checkbox" id="select-all" /></th>@endif
                        @endcan --}}
                        <th width="10">

                        </th>
                        <th>@lang('cruds.courses.fields.title')</th>
                        <th>@lang('cruds.courses.fields.category')</th>
                        <th>@lang('cruds.courses.fields.grade')</th>
                        <th>@lang('cruds.courses.fields.description')</th>
                        <th>@lang('cruds.courses.fields.course-image')</th>
                        @if( request('show_deleted') == 1 )
                        <th>&nbsp;</th>
                        @else
                        <th>&nbsp;</th>
                        @endif
                    </tr>
                </thead>

                <tbody>
                        @foreach ($courses as $course)
                            <tr data-entry-id="{{ $course->id }}">
                                {{-- @can('course-delete')
                                    @if ( request('show_deleted') != 1 )<td></td>@endif
                                @endcan --}}
                                <td></td>
                                <td>{{ $course->title }}</td>
                                <td><span class="badge badge-success"> {{ ($course->category)?$course->category->name:'' }} </span></td>
                                <td><span class="badge badge-success"> {{ ($course->grade)?$course->grade->name:'' }} </span></td>
                                <td>{!! $course->description !!}</td>
                                <td>  @foreach($course->thumbnail as $key => $media)
                                    <a href="{{ $media->getUrl() }}" target="_blank">
                                        <img src="{{ $media->getUrl('thumb') }}" width="50px" height="50px">
                                    </a>
                                    {{-- <a href="{{ url('storage/'.$media->id.'/'.$media->file_name) }}" target="_blank">
                                        <img src="{{ asset('storage/'.$media->id.'/'.$media->file_name) }}" width="50px" height="50px">
                                    </a> --}}
                                    @endforeach
                                </td>
                                @if( request('show_deleted') == 1 )
                                <td>
                                    {!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'POST',
                                        'onsubmit' => "return confirm('".trans("global.areYouSure")."');",
                                        'route' => ['admin.courses.restore', $course->id])) !!}
                                    {!! Form::submit(trans('global.restore'), array('class' => 'btn btn-xs btn-success')) !!}
                                    {!! Form::close() !!}
                                                                    {!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("global.areYouSure")."');",
                                        'route' => ['admin.courses.perma_del', $course->id])) !!}
                                    {!! Form::submit(trans('global.permadel'), array('class' => 'btn btn-xs btn-danger')) !!}
                                    {!! Form::close() !!}
                                </td>
                                @else
                                <td>
                                    @can('course-show')
                                    {{-- <a href="{{ route('admin.lessons.index',['-id' => $course->id]) }}" class="btn btn-xs btn-primary">@lang('global.lessons.title')</a> --}}
                                    @endcan
                                    @can('lesson-access')
                                    <a class="btn btn-xs btn-primary" href="{{ route('admin.lessons.index').'?course='.$course->id }}">
                                    View {{ trans('cruds.lessons.title') }}
                                    </a>
                                    @endcan
                                    @can('course-edit')
                                    <a href="{{ route('admin.courses.edit',[$course->id]) }}" class="btn btn-xs btn-info">@lang('global.edit')</a>
                                    @endcan
                                    @can('course-delete')
                                    {!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("global.areYouSure")."');",
                                        'route' => ['admin.courses.destroy', $course->id])) !!}
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

{{-- @section('javascript')
    <script>
        @can('course_delete')
            @if ( request('show_deleted') != 1 ) window.route_mass_crud_entries_destroy = '{{ route('admin.courses.mass_destroy') }}'; @endif
        @endcan

    </script>
@endsection --}}

@section('scripts')
@parent
<script>
    $(function () {
  var i = '<?php echo request('show_deleted')?>';

  let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
    if (i != 1) {
    @can('course-delete')
    let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
    let deleteButton = {
        text: deleteButtonTrans,
        url: "{{ route('admin.courses.mass_destroy') }}",
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
  $('.datatable-Course:not(.ajaxTable)').DataTable({ buttons: dtButtons })
    $('a[data-toggle="tab"]').on('shown.bs.tab', function(e){
        $($.fn.dataTable.tables(true)).DataTable()
            .columns.adjust();
    });
})

</script>
@endsection
