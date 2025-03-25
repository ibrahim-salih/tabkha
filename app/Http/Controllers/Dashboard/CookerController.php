<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Cooker;
use App\Models\Country;
use App\Models\Menu;
use App\Models\Nationality;
use App\Models\State;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class CookerController extends Controller
{
    //
    public function index()
    {
        Session::put('page', 'cookers');
        $cookers = Cooker::with('nationalty')->get();
        return view('dashboard.cookers.index')->with(compact('cookers'));
    }

    public function activated(){
        Session::put('page', 'cookers-activated');
        $cookers = Cooker::active()->with('nationalty')->get();
        return view('dashboard.cookers.index')->with(compact('cookers'));
    }

    public function not_activated(){
        Session::put('page', 'cookers-not-activated');
        $cookers = Cooker::where('status','=', '0')->with('nationalty')->get();
        return view('dashboard.cookers.index')->with(compact('cookers'));
    }

    public function edit($id)
    {
        Session::put('page', 'cookers');
        $cooker = Cooker::findOrFail($id);
        $countries = Country::select('*')->active()->get();
        $staties = State::select('*')->active()->get();
        $nationalities = Nationality::select('*')->active()->get();
        return view('dashboard.cookers.edit')->with(compact('cooker','countries','staties','nationalities'));
    }

    public function show($id)
    {
        $cooker = Cooker::find($id);
        if(!$cooker)
            return response()->json(['error'=>'البيانات غير متوفرة' ],401);
        //notification is read
        $getID = DB::table('notifications')->where('data->cooker_id', $id)->pluck('id');
        // DB::table('notifications')->where('id', $getID)->update(['read_at'=>now()]);
        return view('dashboard.cookers.show')->with(compact('cooker'));
    }

    public function showCook($id)
    {
        $cooker = Cooker::find($id);
        if(!$cooker)
            return response()->json(['error'=>'البيانات غير متوفرة' ],401);
        $menus = Menu::where('cooker_id',$id)->with('section')->with('category')->with('food')->with('qtype')->with('cooker')->paginate(10);
        //notification is read
        $getID = DB::table('notifications')->where('data->cooker_id', $id)->pluck('id');
        // DB::table('notifications')->where('id', $getID)->update(['read_at'=>now()]);
        return view('dashboard.cookers.showCook')->with(compact('cooker','menus'));
    }

}
