<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\LoginRequest;
class LoginController extends Controller
{
    public function index(){
        return view('user.auth.login');
    }
    public  function create(LoginRequest $request)
    {

        $credentials = $request->only('username', 'password');

        if (Auth::attempt($credentials)) {
            session()->flash("success", "Login Successfully");
            return redirect('/');
        }
        session()->flash("error", "Wrong Username Or Password");
        return redirect()->back();
    }

    public function logout(){
        if (Auth::check())
        {
            Auth::guard()->logout();
            session()->flash("success", "Logout Successfully");
        }

        return redirect('/');
    }
}

