<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;

use App\Models\Nationality;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\Http\Requests\StoreNationalityRequest;
use App\Http\Requests\UpdateNationalityRequest;

class NationalityController extends Controller
{

    public function index()
    {
        Session::put('page', 'nationalities');
        $nationalities = Nationality::select('*')->paginate(10);
        return view('dashboard.nationalities.index')->with(compact('nationalities'));
    }

    public function nationalityStatus(Request $request)
    {
        if ($request->mode == 'true') {
            Nationality::where('id', $request->id)->update(['status' => '1']);
            $active = '1';
        } else {
            Nationality::where('id', $request->id)->update(['status' => '0']);
            $active = '0';
        }
        return response()->json(['msg' => 'تم التحديث', 'active' => $active, 'status' => true]);
    }

    public function create()
    {
        Session::put('page', 'nationalities');
        return view('dashboard.nationalities.create');
    }

    public function store(StoreNationalityRequest $request)
    {
        try {
            Nationality::create([
                'name' => $request->name,
                'status' => $request->status,
            ]);
            return redirect('dashboard/nationalities')->with('success_message', 'تم الحفظ');
        } catch (\Exception $e) {
            return redirect('dashboard/nationalities')->withErrors(['error_message' => $e->getMessage()]);
        }
    }

    public function show(Nationality $nationality)
    {
        //
    }

    public function edit(Nationality $nationality)
    {
        Session::put('page', 'nationalities');
        return view('dashboard.nationalities.edit')->with(compact('nationality'));
    }

    public function update(UpdateNationalityRequest $request, Nationality $nationality)
    {
        $nationality = Nationality::findOrFail($request->id);
        try {
            $nationality->update([
                'name' => $request->name,
                'status' => $request->status,
            ]);
            return redirect('dashboard/nationalities')->with('success_message', 'تم الحفظ');
        } catch (\Exception $e) {
            return redirect('dashboard/nationalities')->withErrors(['error_message' => $e->getMessage()]);
        }
    }

    public function destroy(Nationality $nationality, $id)
    {
        Session::put('page', 'countries');
        Nationality::where('id', $id)->forceDelete();
        return redirect()->back()->with('success_message', 'تم الحذف ');
    }
}
