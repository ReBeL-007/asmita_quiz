@inject('request', 'Illuminate\Http\Request')
@extends('admin.backend.layouts.master')
@section('title','Categories')
@section('content')
@can('category-create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route("admin.categories.create") }}">
                {{ trans('global.add') }} {{ trans('cruds.category.title_singular') }}
            </a>
        </div>
    </div>
@endcan
<!-- css for admit card -->
<link rel="stylesheet" href="{{asset('/css/admit-card.css')}}">

<p>
    <ul class="list-inline">
        <li><a href="{{ route('admin.categories.index') }}" style="{{ request('show_deleted') == 1 ? '' : 'font-weight: 700' }}">All</a></li> |
        <li><a href="{{ route('admin.categories.index') }}?show_deleted=1" style="{{ request('show_deleted') == 1 ? 'font-weight: 700' : '' }}">Trash</a></li>
    </ul>
</p>
<div class="card">
    <div class="card-header">
        {{ trans('cruds.category.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label>Filter by College</label>
                        <select class="college form-control">
                        </select>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label>Filter by Department</label>
                        <input type="text" class="department form-control" placeholder="Filter by Department">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                    <label>Filter by Semester</label>
                    <input type="text" class="college form-control" placeholder="Filter by Semester">
                    </div>
                </div>
            </div>
            <table class=" table table-bordered table-striped table-hover datatable datatable-Category">
                <thead>
                    <tr>
                        <th width="10">

                        </th>

                        <th>
                            Registration No
                        </th>
                        <th>
                            Symbol No
                        </th>
                        <th>
                            Student Name
                        </th>
                        <th>
                            College
                        </th>
                        <th>
                            Department
                        </th>
                        <th>
                            Semester
                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($admitCards as $key => $admitCard)
                        <tr data-entry-id="{{ $admitCard->id }}">
                            <td>

                            </td>

                            <td>
                                {{ $admitCard->registration_no ?? '' }}
                            </td>
                            <td>
                                {{ $admitCard->symbol_no ?? '' }}
                            </td>
                            <td>
                                {{ $admitCard->student_name ?? '' }}
                            </td>
                            <td>
                                {{ $admitCard->college ?? '' }}
                            </td>
                            <td>
                                {{ $admitCard->department ?? '' }}
                            </td>
                            <td>
                                {{ $admitCard->semester ?? '' }}
                            </td>
                            @if( request('show_deleted') == 1 )
                                <td>
                                    {!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'POST',
                                        'onsubmit' => "return confirm('".trans("global.areYouSure")."');",
                                        'route' => ['admin.categories.restore', $admitCard->id])) !!}
                                    {!! Form::submit(trans('global.restore'), array('class' => 'btn btn-xs btn-success')) !!}
                                    {!! Form::close() !!}
                                                                    {!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("global.areYouSure")."');",
                                        'route' => ['admin.categories.perma_del', $admitCard->id])) !!}
                                    {!! Form::submit(trans('global.permadel'), array('class' => 'btn btn-xs btn-danger')) !!}
                                    {!! Form::close() !!}
                                </td>
                                @else
                                <td>
                                    @can('category-show')
                                        <a class="btn btn-xs btn-primary" href="{{ route('admin.categories.show', $admitCard->id) }}">
                                            {{ trans('global.view') }}
                                        </a>
                                    @endcan

                                    @can('category-edit')
                                        <a class="btn btn-xs btn-info" href="{{ route('admin.categories.edit', $admitCard->id) }}">
                                            {{ trans('global.edit') }}
                                        </a>
                                    @endcan

                                    @can('category-delete')
                                        <form action="{{ route('admin.categories.destroy', $admitCard->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
                                            <input type="hidden" name="_method" value="DELETE">
                                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                            <input type="submit" class="btn btn-xs btn-danger" value="{{ trans('global.delete') }}">
                                        </form>
                                    @endcan
                                    <a class="btn btn-xs btn-success admit-card" data="{{$data}}" href=javascript:void(0)">
                                            Get Card
                                        </a>
                                </td>
                            @endif
                        </tr>
                    @endforeach
                </tbody>
            </table>
    </div>
</div>

<div class="modal"  tabindex="-1" role="dialog">
  <div class="modal-dialog d-flex justify-content-center align-items-center" role="document" style="width:80vw;">
    <div class="modal-content" >
      <div class="modal-header">
        <h5 class="modal-title">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body" style="height:60vh;">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary">Save changes</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
<div class="admit-cards"></div>
<template id="admit-card-template">
<div id="Web_1920__1" class="admit-card-view">
	<div id="Group_1">
		<img id="mwu-logo" src="mwu-logo.png" srcset="mwu-logo.png 1x, mwu-logo@2x.png 2x">
		<div id="Mid-Western_University">
			<span>Mid-Western University</span>
		</div>
		<div id="Examinations_Management_Office">
			<span>Examinations Management Office</span>
		</div>
		<div id="Surkhet_Nepal">
			<span>Surkhet, Nepal</span>
		</div>
		<div id="Examination_Admission_Card">
			<span>Examination Admission Card</span>
		</div>
		<div id="Full_Name_">
			<span>Full Name :</span>
		</div>
		<svg class="Line_1" viewBox="0 0 944.482 3">
			<path id="Line_1" d="M 0 0 L 944.4818115234375 0">
			</path>
		</svg>
		<div id="Symbol_No">
			<span>Symbol No:</span>
		</div>
		<svg class="Line_2" viewBox="0 0 432 3">
			<path id="Line_2" d="M 0 0 L 432 0">
			</path>
		</svg>
		<svg class="Rectangle_2">
			<rect id="Rectangle_2" rx="49" ry="49" x="0" y="0" width="217" height="217">
			</rect>
		</svg>
		<div id="Photo_PP_Size">
			<span>Photo P/P<br/>Size</span>
		</div>
		<div id="Registration_No_">
			<span>Registration No: </span>
		</div>
		<svg class="Line_4" viewBox="0 0 883.221 3">
			<path id="Line_4" d="M 0 0 L 883.2205200195313 0">
			</path>
		</svg>
		<div id="SchoolCampus">
			<span>School/Campus:</span>
		</div>
		<svg class="Line_5" viewBox="0 0 356 3">
			<path id="Line_5" d="M 0 0 L 356 0">
			</path>
		</svg>
		<div id="Faculty_">
			<span>Faculty :</span>
		</div>
		<svg class="Line_6" viewBox="0 0 983.482 3">
			<path id="Line_6" d="M 0 0 L 983.4818115234375 0">
			</path>
		</svg>
		<div id="Exam_Year_">
			<span>Exam. Year :</span>
		</div>
		<svg class="Line_7" viewBox="0 0 412 3">
			<path id="Line_7" d="M 0 0 L 412 0">
			</path>
		</svg>
		<div id="Level_">
			<span>Level :</span>
		</div>
		<div id="Exam_Centre_">
			<span>Exam. Centre :</span>
		</div>
		<svg class="Line_9" viewBox="0 0 381 3">
			<path id="Line_9" d="M 0 0 L 381 0">
			</path>
		</svg>
		<div id="Bachelor__Master__MPhil">
			<span>Bachelor / Master / M.Phil</span>
		</div>
		<div id="Semester">
			<span>Semester:</span>
		</div>
		<svg class="Rectangle_4">
			<rect id="Rectangle_4" rx="0" ry="0" x="0" y="0" width="1744" height="527">
			</rect>
		</svg>
		<svg class="Line_10" viewBox="0 0 1744 1">
			<path id="Line_10" d="M 0 0 L 1744 0">
			</path>
		</svg>
		<svg class="Line_12" viewBox="0 0 1744 1">
			<path id="Line_12" d="M 0 0 L 1744 0">
			</path>
		</svg>
		<svg class="Line_13" viewBox="0 0 1744 1">
			<path id="Line_13" d="M 0 0 L 1744 0">
			</path>
		</svg>
		<svg class="Line_14" viewBox="0 0 1744 1">
			<path id="Line_14" d="M 0 0 L 1744 0">
			</path>
		</svg>
		<svg class="Line_15" viewBox="0 0 1744 1">
			<path id="Line_15" d="M 0 0 L 1744 0">
			</path>
		</svg>
		<svg class="Line_16" viewBox="0 0 1744 1">
			<path id="Line_16" d="M 0 0 L 1744 0">
			</path>
		</svg>
		<svg class="Line_17" viewBox="0 0 1744 1">
			<path id="Line_17" d="M 0 0 L 1744 0">
			</path>
		</svg>
		<svg class="Line_18" viewBox="0 0 1744 1">
			<path id="Line_18" d="M 0 0 L 1744 0">
			</path>
		</svg>
		<div id="Regular">
			<span>Regular</span>
		</div>
		<svg class="Rectangle_5">
			<rect id="Rectangle_5" rx="0" ry="0" x="0" y="0" width="44" height="37">
			</rect>
		</svg>
		<div id="Chance">
			<span>Chance</span>
		</div>
		<svg class="Rectangle_6">
			<rect id="Rectangle_6" rx="0" ry="0" x="0" y="0" width="44" height="37">
			</rect>
		</svg>
		<div id="Partial">
			<span>Partial</span>
		</div>
		<svg class="Rectangle_7">
			<rect id="Rectangle_7" rx="0" ry="0" x="0" y="0" width="44" height="37">
			</rect>
		</svg>
		<svg class="Line_19" viewBox="0 0 1 474">
			<path id="Line_19" d="M 0 0 L 0 474">
			</path>
		</svg>
		<svg class="Line_20" viewBox="0 0 1 474">
			<path id="Line_20" d="M 0 0 L 0 474">
			</path>
		</svg>
		<div id="SN">
			<span>S.N.</span>
		</div>
		<div id="Subjects">
			<span>Subjects</span>
		</div>
		<div id="Sub_Code">
			<span>Sub. Code</span>
		</div>
		<svg class="Line_21" viewBox="0 0 1744 1">
			<path id="Line_21" d="M 0 0 L 1744 0">
			</path>
		</svg>
		<svg class="Line_22" viewBox="0 0 1744 1">
			<path id="Line_22" d="M 0 0 L 1744 0">
			</path>
		</svg>
		<svg class="Line_23" viewBox="0 0 365 3">
			<path id="Line_23" d="M 0 0 L 365 0">
			</path>
		</svg>
		<div id="__">
			<span>परीक्षार्थि पुरा दस्तखत</span>
		</div>
		<svg class="Line_24" viewBox="0 0 365 3">
			<path id="Line_24" d="M 0 0 L 365 0">
			</path>
		</svg>
		<div id="Full_Signature_of_Applicant">
			<span>Full Signature of Applicant</span>
		</div>
		<div id="_M___________">
			<span>नोट M प्रवेशपत्र र उत्तरपुस्तिकामा गरिएको हस्ताक्षर फरक परेमा परिक्षा रद्द गर्न सकिन्छ।</span>
		</div>
		<div id="student_name">
				<span id="student_name_span"></span>
			</div>
			<div id="symbol_no">
				<span id="symbol_no_span"></span>
			</div>
			<div id="college_name">
				<span id="college_name_span"></span>
			</div>
			<div id="registration_no">
				<span id="registration_no_span"></span>
			</div>
			<div id="faculty">
				<span id="faculty_span"></span>
			</div>
			<div id="exam_year">
				<span id="exam_year_span"></span>
			</div>
			<div id="exam_centre">
				<span id="exam_centre_span"></span>
			</div>
		<svg class="Rectangle_8">
			<rect id="Rectangle_8" rx="0" ry="0" x="0" y="0" width="257" height="74">
			</rect>
		</svg>
		<svg class="Rectangle_9">
			<rect id="Rectangle_9" rx="0" ry="0" x="0" y="0" width="257" height="74">
			</rect>
		</svg>
	</div>
</div>
</template>
@endsection
@section('scripts')
@parent
<script>

    $(function () {

        $('input.college').on( 'keyup click', function () {
        $('.datatable-Category').DataTable().column( 4 ).search($('input.college').val()).draw();
    } );
    $('input.department').on( 'keyup click', function () {
        $('.datatable-Category').DataTable().column( 5 ).search($('input.department').val()).draw();
    } );





        $(document).on('click','.admit-card',function(){
            var $data =$(this).attr("data");
            console.log($data);
            $('.admit-cards').html($('#admit-card-template').html());
            $scale = 1920 / ($( document ).height()*2);
            $('.modal-body').html($('.admit-cards').html());
            $('.admit-card-view').css('transform-origin','0px 0px').css('transform','scale('+$scale+')');
            $('.modal-body').css('height',$('.admit-card-view').height()*$scale*2).css('width',$('.admit-card-view').width()*$scale*2 +30);
            $('.modal').modal();
        });

        var i = '<?php echo request('show_deleted')?>';

  let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
    if (i != 1) {
@can('category-delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.categories.massDestroy') }}",
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
  dtButtons.push(deleteButton);
@endcan
    }
  let admitCardButton = {
    text: 'Get Card',
    url: "{{ route('admin.categories.massDestroy') }}",
    className: 'btn-success admit-card',
    action: function (e, dt, node, config) {
      var ids = $.map(dt.rows({ selected: true }).nodes(), function (entry) {
          return $(entry).data('entry-id')
      });

      if (ids.length === 0) {
        alert('{{ trans('global.datatables.zero_selected') }}')

        return
      }
    }
  }
  dtButtons.push(admitCardButton);
  $.extend(true, $.fn.dataTable.defaults, {
    order: [[ 1, 'desc' ]],
    pageLength: 100,
  });
  $dataTable = $('.datatable-Category:not(.ajaxTable)').DataTable({ buttons: dtButtons ,
    initComplete: function(){
    console.log($dataTable.column(4).data().unique());
    $('.college').html('<option value="">Select College</option>');
    $.each($dataTable.column(4).data().unique(),function(i,ele){
        $('.college').append('<option value="virinchi">Virinchi</option>');
    });
  },
  });
    $('a[data-toggle="tab"]').on('shown.bs.tab', function(e){
        $($.fn.dataTable.tables(true)).DataTable()
            .columns.adjust();
    });
})

</script>
@endsection
