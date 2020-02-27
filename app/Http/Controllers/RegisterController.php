<?php

namespace App\Http\Controllers;

use App\User;
use App\Http\Requests\RegisterRequest;
class RegisterController extends Controller
{
    public function index(){
        return view('user.auth.register');
    }

    public function create(RegisterRequest $request){
        $user = new User();
        $user->fill(request()->all());
        $user->avatar = 'images/default.png';
        $user->password = request()->password;
        if ($user->save()){
            session()->flash('status','ĐĂNG KÝ THÀNH CÔNG');
            return redirect('/login');
        }
        return redirect()->back()->withErrors('KHÔNG THỂ ĐĂNG KÝ');
    }
}
