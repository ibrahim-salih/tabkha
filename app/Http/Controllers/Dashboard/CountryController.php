<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Country;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Request;
use Intervention\Image\Laravel\Facades\Image;
use Illuminate\Support\Facades\Session;
use App\Http\Requests\StoreCountryRequest;
use App\Http\Requests\UpdateCountryRequest;

class CountryController extends Controller
{

    public function index()
    {
        Session::put('page', 'countries');
        $countries = Country::select('*')->paginate(10);
        return view('dashboard.countries.index')->with(compact('countries'));
    }

    public function countryStatus(Request $request)
    {
        if ($request->mode == 'true') {
            Country::where('id', $request->id)->update(['status' => '1']);
            $active = '1';
        } else {
            Country::where('id', $request->id)->update(['status' => '0']);
            $active = '0';
        }
        return response()->json(['msg' => 'تم التحديث', 'active' => $active, 'status' => true]);
    }

    public function create()
    {
        Session::put('page', 'sections');
        return view('dashboard.countries.create');
    }

    public function store(StoreCountryRequest $request)
    {
        try {
            Country::create([
                'name' => $request->name,
                'status' => $request->status,
            ]);
            return redirect('dashboard/countries')->with('success_message', 'تم الحفظ');
        } catch (\Exception $e) {
            return redirect('dashboard/countries')->withErrors(['error_message' => $e->getMessage()]);
        }
    }

    public function show(string $id)
    {
        //
    }

    public function edit(Country $country)
    {
        Session::put('page', 'countries');
        return view('dashboard.countries.edit')->with(compact('country'));
    }

    public function update(UpdateCountryRequest $request, Country $country)
    {
        $country = Country::findOrFail($request->id);
        try {
            $country->update([
                'name' => $request->name,
                'status' => $request->status,
            ]);
            return redirect('dashboard/countries')->with('success_message', 'تم الحفظ');
        } catch (\Exception $e) {
            return redirect('dashboard/countries')->withErrors(['error_message' => $e->getMessage()]);
        }
    }

    public function destroy(Request $request, $id)
    {
        //
        Session::put('page', 'countries');
        Country::where('id', $id)->forceDelete();
        return redirect()->back()->with('success_message', 'تم الحذف ');
    }
}
