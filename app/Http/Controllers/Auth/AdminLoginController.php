<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Validation\ValidationException;
use Auth;

class AdminLoginController extends Controller
{
    //
    public function __construct(){
        $this->middleware('guest:admin')->except('logout');
    }
    public function showLoginForm(){
        return view('admin.login');
    }

    public function login(Request $request){
        //validate the form data
        // dd($request->all());
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required|min:6'
        ]);

        //attempt to log the user in
            // if(Auth::guard('admin')->attempt($credentials, $remember))
        if(Auth::guard('admin')->attempt(['email'=>$request->email, 'password'=>$request->password], $request->remember)){
            //if successful, then redirect to their intended location
            return redirect()->intended(route('admin.dashboard'));
        }

        //if unsuccessful, then redirect back to the login with the form data
        return redirect()->back()->withInput($request->only('email','remember'))->withErrors(["invalid"=>"These credentials do not match our records."]);

    }

    public function logout(Request $request)
    {
        Auth::guard('admin')->logout();
        return redirect()->route('admin.login');
    }
}
