@extends('admin.backend.layouts.master')
@section('title','Add Users')
@section('content')

<div class="card">
    <div class="card-header">
        Create Users
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.users.importUser") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <div class="mb-2">
                    <a href="{{ asset('/format/Users.xlsx') }}" download="" class="btn btn-primary">Download Format <i class="far fa-file-excel"></i></a>
                </div>
                <label for="excel">Add Excel File for User</label>
                <div class=" mb-2">
                    <div class="form-control {{ $errors->has('excel') ? 'is-invalid' : '' }} custom-file"
                        style="border:0"> <input type="file" name="excel" class="custom-file-input" accept="excel/*">
                        <label class="custom-file-label text-truncate" for="id_excel">---</label>
                        <script type="text/javascript" id="script-id_excel">
                            document.getElementById("script-id_excel").parentNode.querySelector('.custom-file-input').onchange =  function (e){
                        var filenames = "";
                        for (let i=0;i<e.target.files.length;i++){
                            filenames+=(i>0?", ":"")+e.target.files[i].name;
                        }
                        e.target.parentNode.querySelector('.custom-file-label').textContent=filenames;
                    }
                        </script>
                    </div>
                </div>
            </div>
            @if($errors->has('excel'))
            <div class="invalid-feedback">
                {{ $errors->first('excel') }}
            </div>
            @endif

            <div class="form-group">
                <button class="btn btn-success" type="submit">
                    {{ trans('global.save') }}
                </button>
            </div>
        </form>
    </div>
</div>



@endsection
