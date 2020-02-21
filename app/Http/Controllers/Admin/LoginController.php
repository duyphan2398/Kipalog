<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\LoginAdminRequest;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
class LoginController extends Controller
{
    public function __construct()
    {
    }

    public function index(){
        return view('admin.login');
    }

    public function  login(LoginAdminRequest $request){
        $credentials = $request->only('email', 'password');
        if (Auth::guard('admin')->attempt($credentials)){
            return redirect('admin/dashboard');
        }
        return redirect()->back()->withErrors('SAI THÔNG TIN ĐĂNG NHẬP');
    }

    public function logout(){
        if (Auth::guard('admin')->check())
        {
            Auth::guard('admin')->logout();
        }
        return redirect('/');
    }
}
