<?php

namespace App\Http\Controllers;
use App\Http\Requests\ResetPasswordRequest;
use App\Models\User;
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
    /*Return the form to enter email*/
    public function showLinkRequestForm()
    {
        return view('email.sendEmailForm');
    }

    /*Verify the email and create the token*/
    public function sendResetLinkEmail(Request $request)
    {
        $this->validateEmail($request);
        $email = $this->credentials($request);
        $user = User::whereEmail($email)->first();
        if ($user == null) {
            /*If the email do not exist in users table -> will back */
            session()->flash("error", 'Email Has Not Been Register');
            return redirect()->back();
        }
        $row = DB::table('password_resets')->where('email', $email['email'])->first();
        /* True if the email exist in password_resets table*/
        if ($row) {
            if (Carbon::now()->subMinutes(60)->lte($row->created_at)){
                /*Each token is only alive in 60 minutes, If the token is alive -> will back with message "Too much request",
                Unless  -> will delete this token and create new one then send an email to user */
                session()->flash("error", 'Too Much Request Please Check Your EMail or Wait 60 Minutes and Try Again');
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

    /*Action for sending email*/
    private function sendResetEmail($email, $token){
        $user = User::whereEmail($email)->first();
        /* \request()->getHost()  -> get the current host */
        $link = \request()->getHost().'/resetpassword/form/'.$token.'/'.$user->email;
        $details = [
            "link" => $link,
            "name" => $user->username
        ];
        Mail::to($user->email)->send(new MailNotify($details));
    }

    /*Return the form to resset password*/
    public function resetPasswordForm($token, $email){
        /*Query the row which equal email AND token*/
        $row = DB::table('password_resets')->where('email', $email)->where('token', $token)->first();
        /*If the row exist, the after condition will true*/
        if ($row) {
            /* Checking the token is alive (a token is alive in 60 minutes) */
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

    /*Verify the email and password in request to reset password*/
    public function resetPassword($token,$email,ResetPasswordRequest $request){
        $row = DB::table('password_resets')->where('email', $request->email)->first();
        /*If */
        /* True if the email exist in password_resets table*/
        if ($row && $row->email == $email) {
            /* Check the token being alive*/
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
        /* Enter wrong email or email don not math with the token */
        session()->flash('error', 'Email Is Not Suitable For This Link');
        return redirect()-back();
    }
}
