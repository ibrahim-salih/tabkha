<?php

namespace App\Http\Controllers\Cooker;

use App\Http\Controllers\Controller;
use App\Models\Cooker;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class WelcomeController extends Controller
{
    //.
    public function index(){
        Session::put('page', 'cooker');
        $details = Cooker::where('email', Auth::guard('cooker')->user()->email)->first();
        return view('cooker.welcome')->with(compact('details'));
    }
}
