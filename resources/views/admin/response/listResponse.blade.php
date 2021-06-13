@inject('request', 'Illuminate\Http\Request')
@extends('admin.backend.layouts.master')
@section('title','Quizzes')

@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('cruds.response.title_singular') }} @lang('global.list')
    </div>
    @if (count($quiz->attempts->where('status','submitted')) !=0)
    <div>
        <a class="btn btn-success mt-3 " href="{{route('admin.responses.export',['id'=>$quiz->id])}}">Download Excel <i class="far fa-file-excel"></i></a>
    </div>
    @endif
    <div class="card-body">
        <table class=" table table-bordered table-striped datatable table-hover datatable-Quiz">
            <thead>
                <tr>
                    <th>SN</th>
                    <th>User</th>
                    <th>Total Marks</th>
                </tr>
            </thead>

            <tbody>
                @foreach ($quiz->attempts()->where('status','submitted')->orderBy('total_marks', 'DESC')->get() as $key=>$attempt)
                <tr data-entry-id="{{ $attempt->id }}">
                    <td>{{$key+1}}</td>
                    <td>{{$attempt->user->name}}</td>
                    <td>{{$attempt->total_marks}}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection

@section('scripts')
<script>
    $(function () {
  let table = $('.datatable-Quiz').DataTable({
    select: false,
    columnDefs: [ {
                orderable: true
                , searchable: true
                , targets: -1
            }],
  });
})
</script>
@endsection
