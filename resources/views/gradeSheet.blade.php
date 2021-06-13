@inject('request', 'Illuminate\Http\Request')
@extends('admin.backend.layouts.master')
@section('title','Grade Sheet')

@section('content')
<div class="card">
    <div class="card-body">
        <div class="text-center"><h6>Grade Sheet</h6></div>
        <div class="row">
        <div class="p-1 bg-light rounded rounded-pill shadow-sm mb-4 col-md-9">
            <div class="input-group">
              <input type="search" placeholder="Symbol Number" class="form-control border-0 bg-light">
            </div>
        </div>
        <div class="form-group col-md-3">
            <button type="submit" class="btn btn-primary rounded-pill btn-block shadow-sm">Search</button>
    </div>
        </div>
        
    </div>
    </div>
    <style>
        .grade_sheet{
            font-weight: bolder;
            font-family: 'Times New Roman'
        }
    </style>
    <div class="card">
        <div class="card-body grade_sheet">

        <div class="sheet-header text-center" >
            <span><h4>Mid-Western University</h4></span>
            <span><h2 style="font-weight: bolder">School of Management (MUSOM)</h2></span>
            <h4 style="font-weight: bolder">An Autonomous Institution</h4>
            <h4 style="font-weight: bolder">Surkhet Nepal</h4>
            <br>
            <h4 style="font-weight: bolder"><u>Grade Sheet</u></h4>
        </div>
        <br>
        <div class="student_details">
            <div class="row">
                <div class="name row col-md-4">
                    <div class="col-md-2">Name: </div>
                    <div id="student_name" class="col-md-10">Bibek Bahadur Khatri</div>
                </div>
                <div class="regd_no row col-md-4">
                    <div class="col-md-2">Regd. No.: </div>
                    <div id="student_regd_no" class="col-md-10">74581653541512</div>
                </div>
            </div>
            <div class="row">
                <div class="name row col-md-4">
                    <div class="col-md-2">DOB: </div>
                    <div id="student_name" class="col-md-6">2057-04-01</div>
                </div>
                <div class="year row col-md-4">
                    <div class="col-md-2">Year: </div>
                    <div id="student_year" class="col-md-6">2075</div>
                </div>
                <div class="symbol_no row col-md-4">
                    <div class="col-md-3">Symbol No: </div>
                    <div id="student_symbol_no" class="col-md-9">74581653541512</div>
                </div>
            </div>
            <div class="row">
                <div class="level row col-md-4">
                    <div class="col-md-2">Level: </div>
                    <div id="student_level" class="col-md-6">Batchleor</div>
                </div>
                <div class="programme row col-md-4">
                    <div class="col-md-3">Programme: </div>
                    <div id="student_programme" class="col-md-6">Management</div>
                </div>
                <div class="semester row col-md-4">
                    <div class="col-md-3">Semester: </div>
                    <div id="student_semester" class="col-md-9">First</div>
                </div>
            </div>
            <br>
            <table class="table table-bordered table-responsive-sm">
                <thead>
                    <tr>
                        <th>S.N.</th>
                        <th>Course Code No.</th>
                        <th>Course Title</th>
                        <th>Cr. Hr.</th>
                        <th>Grade Point</th>
                        <th>Grade</th>
                        <th>Remarks</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td colspan="3">Total Credit Hour & Semester Wise Grade Point Average</td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                </tbody>
            </table>
            <br>
                <div class="result row col-md-4 float-right">
                    <div class="col-md-2">Result: </div>
                    <div id="student_result" class="col-md-6">A-</div>
                </div>
        </div>
        </div>
        <div>

        </div>
    </div>
    </div>
@endsection
