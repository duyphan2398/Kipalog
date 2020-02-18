<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function index(){
        return view('auth.login');
    }
    public  function create(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);

        $credentials = $request->only('username', 'password');
        if (Auth::attempt($credentials)) {
            return redirect('/');
        }
        if (Auth::guard('admin')->attempt($credentials)){
            return redirect('dashboard');
        }
        return redirect()->back()->withErrors('KHÔNG THỂ ĐĂNG NHẬP');
    }

    public function logout(){
        if (Auth::check())
        {
            Auth::logout();
        }
        else
        {
            Auth::guard('admin')->logout();
        }
        return redirect('login');
    }
}

