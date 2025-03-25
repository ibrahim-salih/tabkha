<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;

use App\Models\WebPrivacy;
use Illuminate\Support\Facades\File;
use Illuminate\Validation\Rule;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Http\Requests\StoreWebPrivacyRequest;
use App\Http\Requests\UpdateWebPrivacyRequest;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Session;
use Intervention\Image\Laravel\Facades\Image;

class WebPrivacyController extends Controller
{

    public function index()
    {
        //
        Session::put('page', 'privacys');
        $privacys = WebPrivacy::select('*')->get();
        return view('dashboard.privacys.index')->with(compact('privacys'));
    }

    public function create()
    {
        //
        Session::put('page', 'privacys');
        return view('dashboard.privacys.create');
    }

    public function store(StoreWebPrivacyRequest $request)
    {
        //
        try {
            WebPrivacy::create([
                'name' => $request->name,
                'description' => $request->description,
            ]);
            return redirect('dashboard/privacys')->with('success_message', 'تم الحفظ');
        } catch (\Exception $e) {
            return redirect('dashboard/privacys')->withErrors(['error_message' => $e->getMessage()]);
        }
    }

    public function show(WebPrivacy $webPrivacy)
    {
        //
    }

    public function edit(WebPrivacy $webPrivacy,$id)
    {
        //
        // return $id;
        Session::put('page', 'privacys');
        $webPrivacy = WebPrivacy::findOrFail($id);
        return view('dashboard.privacys.edit')->with(compact('webPrivacy'));
    }

    public function update(UpdateWebPrivacyRequest $request, WebPrivacy $webPrivacy)
    {
        //
        $webPrivacy = WebPrivacy::findOrFail($request->id);
        try {
            $webPrivacy->update([
                'name' => $request->name,
                'description' => $request->description,
            ]);
            // return redirect('dashboard/sections')->with(toastr()->success('Data has been saved successfully!','successfully'));
            return redirect('dashboard/privacys')->with('success_message', 'تم الحفظ');
        } catch (\Exception $e) {
            return redirect('dashboard/privacys')->withErrors(['error_message' => $e->getMessage()]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(WebPrivacy $webPrivacy)
    {
        //
    }
}
