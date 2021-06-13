@inject('request', 'Illuminate\Http\Request')
@extends('admin.backend.layouts.master')
@section('title','Quizzes')

@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('cruds.response.title_singular') }} @lang('global.list')
    </div>

    <div class="card-body table-responsive">
        <table class=" table table-bordered table-striped table-hover datatable datatable-Quiz">
            <thead>
                <tr>
                    <th></th>
                    <th>@lang('cruds.response.fields.title')</th>
                    <th>@lang('cruds.response.fields.course')</th>
                    <th>@lang('cruds.response.fields.response')</th>
                    <th>&nbsp;</th>
                </tr>
            </thead>

            <tbody>
                @foreach ($quizzes as $quiz)
                <tr data-entry-id="{{ $quiz->id }}">
                    <td></td>
                    <td>{{ $quiz->course->title or '' }}</td>
                    @if (Auth::user()->isAdmin())
                    @endif
                    <td>{{ $quiz->title }}</td>
                    <td><span class="badge badge-{{count($quiz->attempts) != 0 ? 'success' : 'danger'}}">{{ count($quiz->attempts) ==0 ? 'No Response' : count($quiz->attempts)}}</span></td>
                    <td>
                        <a href="{{ route('admin.responses.response',[$quiz->id]) }}"
                            class="btn btn-xs btn-success">View Response</a>
                            <a href="{{ route('admin.responses.responseList',[$quiz->id]) }}"
                                class="btn btn-xs btn-primary">Response List</a>
                    </td>
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
  $('.datatable-Quiz:not(.ajaxTable)').DataTable();
})


</script>
@endsection
