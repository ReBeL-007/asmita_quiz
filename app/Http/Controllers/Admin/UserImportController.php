<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Imports\UsersImport;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Facades\Excel;

class UserImportController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function show(){
        return view('admin.users.import');
    }

    public function store(Request $request){
        $request->validate([
        //use this
            'excel'=>'required|mimes:xlsx'
        ]);

        $file = $request->file('excel');
        Excel::import(new UsersImport,$file);
        Session::flash('flash_success', 'Users added successfully!');
        return redirect()->route('admin.users.index');
    }

}
