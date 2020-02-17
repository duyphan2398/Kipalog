<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
class RegisterController extends Controller
{
    public function index(){
        return view('auth.register');
    }

    public function create(Request $request){
        $request->validate([
            'name' => 'required|max:255',
            'username' => 'required|unique:users',
            'email' => 'required|unique:users|email',
            'password' => 'required',
            'passwordConfirm' => 'required|same:password'
        ],[
            'username.unique' => 'USERNAME ĐÃ TỒN TẠI',
            'email.unique' => 'EMAIL ĐÃ TỒN TẠI',
            'email.email' => 'KHÔNG PHẢI EMAIL',
            'passwordConfirm.same' => 'PASSWORD CONFIRM KHÔNG GIỐNG PASSWORD'
        ]);

        $request['password'] = Hash::make($request->password);
        $request['avatar'] = 'images/default.png';
        if (User::create($request->all())){
            session()->flash('status','ĐĂNG KÝ THÀNH CÔNG');
            return redirect('/login');
        }
        return redirect()->back()->withErrors('KHÔNG THỂ ĐĂNG KÝ');
    }
}
