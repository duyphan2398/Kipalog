<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\LoginRequest;
class LoginController extends Controller
{
    public function index(){
        return view('auth.login');
    }
    public  function create(LoginRequest $request)
    {
        $credentials = $request->only('username', 'password');
        if (Auth::attempt($credentials)) {
            return redirect('/');
        }
        return redirect()->back()->withErrors('KHÔNG THỂ ĐĂNG NHẬP');
    }

    public function logout(){
        if (Auth::check())
        {
            Auth::guard()->logout();
        }
        return redirect('/');
    }
}

