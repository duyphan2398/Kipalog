<?php

namespace App\Http\Controllers;
use App\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Mail\MailNotify;

class ResetPasswordController extends Controller
{
    public function sendEmail(){
        return view('email.sendEmailForm');
    }

    public function resetPassword(Request $request){
        $user = User::whereEmail($request->email)->first();
        if (!$user){
            return redirect()->back()->withErrors('EMAIL KHÔNG TỒN TẠI');
        }
        $newPassword = Str::random(10);
        $user->password = Hash::make($newPassword);
        if ($user->save())
        {
            $details = [
                "password" => $newPassword,
                "name" => $user->name
            ];
            Mail::to($user->email)->send(new MailNotify($details));
            session()->flash('status','MẬT KHẨU ĐÃ ĐƯỢC GỬI ĐẾN EMAIL');
            return redirect('login');
        }
        return redirect()->back()->withErrors('KHÔNG THỂ CẬP NHẬT MẬT KHẨU');

    }
}
