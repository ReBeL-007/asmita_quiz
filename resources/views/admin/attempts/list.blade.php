@inject('request', 'Illuminate\Http\Request')
@extends('admin.backend.layouts.master')
@section('title','Attempts')

@section('content')


<div class="card">
    <div class="card-header">
        {{ trans('cruds.quizzes.title_singular') }} @lang('global.list')
    </div>

    <div class="card-body table-responsive">
        <table class=" table table-bordered table-striped table-hover datatable datatable-Quiz">
            <thead>
                <tr>
                    <th></th>
                    <th>User</th>
                    <th>Points</th>
                </tr>
            </thead>

            <tbody>
                @foreach ($attempts as $key=>$attempt)
                <tr>
                    <td>{{$key+1}}</td>
                    <td>{{$attempt->user}}</td>
                    <td></td>
                </tr>
                @endforeach

            </tbody>
        </table>
    </div>
</div>
@stop
@section('scripts')
    <script>
        $(function(){
            let table = $('.table').DataTable();
            table.button.remove();
        });
    </script>
@endsection
