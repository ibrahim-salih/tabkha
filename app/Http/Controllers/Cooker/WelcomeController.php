<?php

namespace App\Http\Controllers\Cooker;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class WelcomeController extends Controller
{
    //.
    public function index(){
        Session::put('page', 'cooker');
        return view('cooker.welcome');
    }
}
