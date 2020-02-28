<?php

namespace App\Http\Controllers;
use App\Http\Requests\ResetPasswordRequest;
use App\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\MailNotify;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;

class ResetPasswordController extends Controller
{
    use SendsPasswordResetEmails;
    /*Show form nhập email*/
    public function showLinkRequestForm()
    {
        return view('email.sendEmailForm');
    }

    /*Xác thực email và tạo token*/
    public function sendResetLinkEmail(Request $request)
    {
        $this->validateEmail($request);
        $email = $this->credentials($request);
        $user = User::whereEmail($email)->first();
        if ($user == null) {
            /*Nếu email không có trong bảng User thì back*/
            session()->flash("error", 'Email Has Not Been Register');
            return redirect()->back();
        }
        $row = DB::table('password_resets')->where('email', $email['email'])->first();
        /*Nếu email có trong bảng password_resets thì đúng với điều kiện này*/
        if ($row) {
            /*Mỗi token chỉ sống 60 phút, nếu  trong 60 phút thì back, còn ngoài 60 phút thì xóa tạo lại token và gửi email lại */
            if (Carbon::now()->subMinutes(60)->lte($row->created_at)){
                session()->flash("error", 'To Much Request Please Check Your EMail or Wait 60 Minutes and Try Again');
                return redirect()->back();
            }
            else {
                DB::table('password_resets')->where('email', $email['email'])->delete();
            }
        }
        DB::table('password_resets')->insert(
            [
                'email' => $email['email'],
                'token' => Str::random(60),
                'created_at' => Carbon::now()
            ]
        );
        $tokenData = DB::table('password_resets')->whereEmail($email)->first();
        $this->sendResetEmail($email, $tokenData->token);
        session()->flash('success', 'Success ! Please Check Your Email');
        return redirect()->back();
    }

    /*Gửi mail*/
    private function sendResetEmail($email, $token){
        $user = User::whereEmail($email)->first();
        $link = \request()->getHost().'/resetpassword/form/'.$token.'/'.$user->email;
        $details = [
            "link" => $link,
            "name" => $user->username
        ];
        Mail::to($user->email)->send(new MailNotify($details));
    }

    /*Trả về form resset password*/
    public function resetPasswordForm($token, $email){
        $row = DB::table('password_resets')->where('email', $email)->first();
        /*Nếu email có trong bảng password_resets thì đúng với điều kiện này*/
        if ($row) {
            /* Kiểm tra token còn sống hay không*/
            if (Carbon::now()->subMinutes(60)->lte($row->created_at)){
                return view('email.resetPasswordForm')->with([
                    'token' => $token,
                    'email' => $email
                ]);
            }
            else {
                return abort(404);
            }
        }
        return abort(404);
    }

    /*Xác thực email và password gửi lên và thực hiện đổi mật khẩu*/
    public function resetPassword($token,$email,ResetPasswordRequest $request){
        $row = DB::table('password_resets')->where('email', $request->email)->first();
        /*Nếu email có trong bảng password_resets thì đúng với điều kiện này*/
        if ($row && $row->email == $email) {
            /* Kiểm tra token còn sống hay không*/
            if (Carbon::now()->subMinutes(60)->lte($row->created_at)) {

                $user= User::whereEmail($email)->first();
                $user->password = request()->password;
                if ($user->save()){
                    session()->flash('success', 'Password Was Changed');
                    return redirect('login');
                }
                else {
                    session()->flash('error', 'Can Not Change Your Password Please Try Again ');
                    return redirect()->back();
                }
            } else {
                session()->flash('error', 'Link Is Not Avaiable');
                return redirect()-back();
            }
        }
        /* Nhập sai email hoặc email không khớp với token*/
        session()->flash('error', 'Email Is Not Suitable For This Link');
        return redirect()-back();
    }
}
