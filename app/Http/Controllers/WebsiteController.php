<?php

namespace App\Http\Controllers;

use App\Mail\Websitemail;
use App\Models\User;
use Illuminate\Http\Request;
use Hash;
use Auth;

class WebsiteController extends Controller
{
    
    public function index()
    {
       return view('home');
    }

    public function dashboard()
    {
       return view('dashboard');
    }

    public function login()
    {
       return view('login');
    }

    public function registration()
    {
       return view('registration');
    }


    public function loginCheck(Request $request){
      // dd($request);
       $credentials = [
            'email' => $request->email,
            'password' => $request->password,
            'status' => 'active'
       ];

       
       //dd(Auth::attempt($credentials));
       if(Auth::attempt($credentials)){
         return redirect()->route('dashboard');
       }
       else{
        return redirect()->route('login');
       }
      
    }

    public function registrationStore(Request $request)
    {
        $token  = hash('sha256', time());
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->token = $token;
        $user->status = 'pending';

        $user->save();

        $verify = url('/registration/verify/'.$token."/".$request->email);
        $subject = "Registration Confirmation";
        $message = "Please  <a href=".$verify.">click this link</a> to activate";
        \Mail::to($request->email)->send(new Websitemail($subject,$message));
        echo "Email Sent to Activate";

        return view('registration');
    }

    public function registrationVerify($token, $email)
    {
       
        $user =  User::where('token',$token)->where('email',$email)->first();
        if(!$user){
            return redirect()->route('login');
        }

       $user->status ='Active';
       $user->token = '';
       $user->update();
       echo "Regsitration successfull";


    }


    function logout(){
        Auth::guard('web')->logout();
        return redirect()->route('login');
    }

    function forgetPassword(){
        return view('forget_password');
    }

    public function forgetPasswordProcess(Request $request)
    {
        $token  = hash('sha256', time());
        $email = $request->email;
        $user = User::where('email',$email)->first();
        if(!$user){
            dd('Email Not found');
        }
        $user->token = $token;
        $user->update();
        $verify = url('/reset/password/'.$token."/".$email);
        $subject = "Password Reset";
        $message = "Please  <a href=".$verify.">click this link</a> to reset";
        \Mail::to($request->email)->send(new Websitemail($subject,$message));
        echo "Check your email to Reset the password";
    }

    public function resetPassword($token, $email){
        $user =  User::where('token',$token)->where('email',$email)->first();
        if(!$user){
            return redirect()->route('login');
        }
        else{
            return view('reset_password_form', compact('token','email'));
        }
    }

    public function resetPasswordSubmit(Request $request)
    {

        $token = $request->token;
        $email = $request->email;
        $user =  User::where('token',$token)->where('email',$email)->first();

        if(!$user){
            return redirect()->route('login');
        }
        $password = $request->password;
            $user->password = Hash::make($password);
            $user->token = '';

            $user->update();
    }
      


}
