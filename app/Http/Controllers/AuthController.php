<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    function __construct()
    {
        $this->middleware('guest')->only(['login', 'logisProccess']);
        $this->middleware('auth')->only('logout');
    }

    public function login()
    {
        return view('auth.login');
    }

    public function loginProccess(Request $request){
        $credentials = $request->only('email', 'password');

        $isLoginSuccess = Auth::attempt($credentials, $request->remember);

        if($isLoginSuccess){
            return redirect()->intended('/home');
        }else{
            return redirect()->back();
        }
    }

    public function logout(){
        Auth::logout();

        return redirect('/login');
    }
}
