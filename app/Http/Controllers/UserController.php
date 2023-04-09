<?php
namespace App\Http\Controllers;

use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;

use Mail;
use App\Mail\EmailVerification;
use App\Mail\ForgotPasswordMail;
use App\Models\User;
use App\Models\PasswordReset;
use Carbon\Carbon;

class UserController extends Controller
{
    function login(Request $req){
        $user = User::where(['email' => $req->email])->first();
        if(!$user || !Hash::check($req->password,$user->password)){
            $errors = ['Username or password is not correct. '];
            return view('login',['errors' => $errors]);
        }else{
            $req->session()->put('user',$user);
            return redirect('/');
        }
    }
    
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required',
            'password' => 'required|min:6',
        ]);

        if ($validator->fails()) {
            $errors = ['Please ensure that password has more than six characters,email and name are correctly entered in the form. '];
            return view('register',['errors' => $errors]);
        }

        $name = $request->input('name');
        $email = $request->input('email');
        $password = Hash::make($request->input('password'));

        $user = new User();
        $user->name = $name;
        $user->email = $email;
        $user->password = $password;
        $user->save();

        return redirect('/login');
    }
     

    public function showLinkRequestForm()
    {
        return view('emails.auth.email_verification');
    }

    public function sendResetLinkEmail(Request $request)
    {
        // $request->required([
        //     'email' => 'required|email'
        // ]);

        $user = User::where('email', $request->email)->first();

        if(!$user){
            return redirect()->back()->with('error', 'Email not found in our database');
        } else {
            $reset_code = Str::random(200);
            PasswordReset::create([
                'user_id' => $user->id,
                'reset_code' => $reset_code
            ]);

            try {
                Mail::to($user->email)->send(new ForgotPasswordMail($user->name, $reset_code));
                return redirect()->back()->with('Success', 'We have sent you a password reset link. Please check your email.');
            } catch (\Exception $e) {
                return redirect('password/reset')->with('error', 'Failed to send email. Please try again & check that your mail is correct.');
            }

        }

    }

    public function showResetForm($reset_code){
        $password_reset_data = PasswordReset::where('reset_code',$reset_code)->first();

        if(!$password_reset_data || Carbon::now()->subMinutes(10) > $password_reset_data->created_at){
            return redirect('password/reset')->with('error','Invalid password reset link or link expired.');
        }else{
            return view('emails.auth.reset_password',compact('reset_code'));
        }
    }

    public function reset($reset_code,Request $request){
        $password_reset_data = PasswordReset::where('reset_code',$reset_code)->first();

        if(!$password_reset_data || Carbon::now()->subMinutes(10) > $password_reset_data->created_at){
            return redirect('password/reset')->with('error','Invalid password reset link or link expired.');
        }else{
            $request->validate([
                'email' => 'required|email',
                'password' => 'required|min:6|max:100',
                'confirm_password' => 'required|same:password'
            ]);

            $user = User::find($password_reset_data->user_id);

            if($user->email != $request->email){
                return redirect()->back()->with('error','Enter correct email.');
            }else{
                $password_reset_data->delete();
                $user->update([
                    'password' => bcrypt($request->password)
                ]);

                return redirect('login')->with('success', 'Password was successfully changed');
            }
        }
    }

}