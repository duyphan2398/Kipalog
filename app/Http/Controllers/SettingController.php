<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
class SettingController extends Controller
{
    public function index(){
        return view('user.wall_user.setting')->with('user',Auth::user());
    }

    public function update(Request $request){
        $user = Auth::user();
        if ($request->name) {
            $user->name = $request->name;
        }
        if ($request->avatar){
            $request->validate([
                'avatar' => 'mimes:jpeg,png,jpg'
            ]);
            if ($user->avatar != 'images/default.png' ){
                /*Do not work*/
                Storage::delete('public/'.$user->avatar);
            }
            $destinationPath = 'images/avatarImages/';
            $profileImage = 'images/avatarImages/'.date('YmdHis') . "." . $request->avatar->getClientOriginalExtension();
            $request->avatar->move($destinationPath, $profileImage);
            $user->avatar = $profileImage;
        }
        if ($request->password){
            $request->validate([
                'password' => "min:6|regex:/^(?=.*[a-zA-Z])(?=.*\d).+$/",
                'passwordConfirm' => 'required|same:password'
            ]);
            $user->password = request()->password;
        }

        if ($user->save()){
            session()->flash('success', 'Updated Successfully');
            return redirect()->back();
        }
        else{
            session()->flash('error', 'Update Password Fail');
            return redirect()->back();
        }
    }
}
