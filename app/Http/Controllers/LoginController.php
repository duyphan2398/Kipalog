<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\LoginRequest;
use Illuminate\Support\Facades\Validator;

class LoginController extends Controller
{
    public function index(){
        return view('user.auth.login');
    }
    public  function create(LoginRequest $request)
    {
        $credentials = $request->only('username', 'password');
        $validator = Validator::make($request->all(), [
            'username' => 'email'
        ]);
        if ($validator->fails()){
            if (Auth::attempt($credentials)) {
                session()->flash("success", "Login Successfully");
                return redirect('/');
            }
        }
        elseif (Auth::guard('admin')->attempt([
                'email' => $request->username,
                'password' => $request->password
            ])){
                session()->flash("success", "Login Successfully ");
                return redirect('admin/dashboard');
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

