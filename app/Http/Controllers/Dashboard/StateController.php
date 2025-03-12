<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\State;
use App\Models\City;
use App\Models\Country;
use App\Http\Requests\StoreCityRequest;
use App\Http\Requests\UpdateCityRequest;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Request;
use Intervention\Image\Laravel\Facades\Image;
use Illuminate\Support\Facades\Session;
use App\Http\Requests\StoreStateRequest;
use App\Http\Requests\UpdateStateRequest;

class StateController extends Controller
{
    
    public function index()
    {
        Session::put('page', 'staties');
        $staties = State::select('*')->with('country')->paginate(10);
        return view('dashboard.staties.index')->with(compact('staties'));
    }

    public function stateStatus(Request $request)
    {
        if ($request->mode == 'true') {
            State::where('id', $request->id)->update(['status' => '1']);
            $active = '1';
        } else {
            State::where('id', $request->id)->update(['status' => '0']);
            $active = '0';
        }
        return response()->json(['msg' => 'تم التحديث', 'active' => $active, 'status' => true]);
    }

    public function create()
    {
        Session::put('page', 'staties');
        $countries = Country::select('*')->get();
        return view('dashboard.staties.create')->with(compact('countries'));
    }

    public function store(StoreStateRequest $request)
    {
        try {
            State::create([
                'name' => $request->name,
                'country_id' => $request->country_id ,
                'status' => $request->status,
            ]);
            return redirect('dashboard/staties')->with('success_message', 'تم الحفظ');
        } catch (\Exception $e) {
            return redirect('dashboard/staties')->withErrors(['error_message' => $e->getMessage()]);
        }
    }

    public function show(State $state)
    {
        //
    }

    public function edit(State $state)
    {
        Session::put('page', 'staties');
        $countries = Country::select('*')->get();
        return view('dashboard.staties.edit')->with(compact('state','countries'));
    }

    public function update(UpdateStateRequest $request, State $state)
    {
        $state = State::findOrFail($request->id);
        try {
            $state->update([
                'name' => $request->name,
                'country_id' => $request->country_id ,
                'status' => $request->status,
            ]);
            return redirect('dashboard/staties')->with('success_message', 'تم الحفظ');
        } catch (\Exception $e) {
            return redirect('dashboard/staties')->withErrors(['error_message' => $e->getMessage()]);
        }
    }

    public function destroy(Request $request, $id)
    {
        //
        Session::put('page', 'staties');
        State::where('id', $id)->forceDelete();
        return redirect()->back()->with('success_message', 'تم الحذف ');
    }
}
