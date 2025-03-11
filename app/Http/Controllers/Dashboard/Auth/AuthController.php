<?php

namespace App\Http\Controllers\Dashboard\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\CreateAdminRequest;
use App\Services\Auth\AuthService;

class AuthController extends Controller
{
    protected $authService;
    public function __construct(AuthService $authService)
    {
        $this->authService = $authService;
    }
    public function showLoginForm(){
        return view('dashboard.auth.login');
    }

    public function login(CreateAdminRequest $request){
        // return $request;
        $credentials = $request->only(['email' , 'password']);
        if($this->authService->login($credentials,'admin',$request->remember)){
            return redirect()->intended(route('dashboard.welcome'));
        }else{
            return redirect()->back()->withErrors(['email'=> __('auth.not_match')]);
        }
    }

    public function logout(){
        $this->authService->logout('admin');
        return redirect()->route('dashboard.login');
    }

}
