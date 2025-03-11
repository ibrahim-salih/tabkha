<?php

namespace App\Http\Controllers\Dashboard\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\ForgetPasswordRequest;
use App\Models\Admin;
use Ichtrojan\Otp\Otp;
use App\Notifications\SendOtpNotify;
use App\Services\Auth\PasswordService;
use Illuminate\Http\Request;

class ForgetPasswordController extends Controller
{
    //
    protected $otp2;
    protected $passwordService;
    public function __construct(PasswordService $passwordService) {
        $this->passwordService =  $passwordService;
        $this->otp2 = new Otp;
    }
    public function showMailForm(){
        return view('dashboard.auth.password.email');
    }

    public function sendOtp(ForgetPasswordRequest $request){
        $admin = $this->passwordService->sendOtp($request->email);
        if(!$admin){
            return redirect()->back()->withErrors(['email'=>'This Email is not registered']);
        }
        return redirect()->route('dashboard.password.verify', ['email'=>$admin->email]);
    }

    public function showOtpForm($email){
        return view('dashboard.auth.password.confirm', ['email'=>$email]);
    }

    public function verifyOtp(ForgetPasswordRequest $request){
        $data = $request->only(['email' , 'code']);
        $otp = $this->passwordService->verifyOtp($data);
        if(!$otp){
            return redirect()->back()->withErrors(['code'=>'Code is invalid']);
        }
        return redirect()->route('dashboard.password.reset', ['email'=>$request->email]);
    }

}
