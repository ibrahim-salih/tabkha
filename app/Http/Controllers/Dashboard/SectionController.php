<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Section;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\StoreSectionRequest;
use App\Http\Requests\UpdateSectionRequest;
use Illuminate\Support\Facades\File;
use Illuminate\Validation\Rule;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Session;
use Intervention\Image\Laravel\Facades\Image;

class SectionController extends Controller
{

    public function index()
    {
        Session::put('page', 'sections');
        // return Section::all();
        $sections = Section::select('*')->paginate(10);
        //meta
        return view('dashboard.sections.index')->with(compact('sections'));
    }

    public function sectionStatus(Request $request)
    {
        if ($request->mode == 'true') {
            Section::where('id', $request->id)->update(['status' => '1']);
            $active = '1';
        } else {
            Section::where('id', $request->id)->update(['status' => '0']);
            $active = '0';
        }
        return response()->json(['msg' => 'تم التحديث', 'active' => $active, 'status' => true]);
    }

    public function updateSectionStatus(Request $request)
    {
        // return 'ok';
        if ($request->ajax()) {
            $data = $request->all();
            if ($data['status'] == "Active") {
                $status = '0';
            } else {
                $status = '1';
            }
            Section::where('id', $data['section_id'])->update(['status' => $status]);
            return response()->json(['status' => $status, 'section_id' => $data['section_id']]);
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $admin = Auth::guard('admin');
        // if(!Auth::guard('admin')->user()->id->hasRole("owner")){
        // if(!$admin->can("اضافة قسم","web")){
        //     return redirect(route('welcome'))->with('error_message', 'you not have permission ');
        // //     // return 'you not have permission';
        // //     // return redirect('dashboard/index')->with('success_message', ' you not have permission');
        // //     // return response()->json(['msg' => ' you not have permission', 'status' => true]);
        //     // return redirect()->back()->with('success_message', 'you not have permission ');
        // }
        Session::put('page', 'sections');
        return view('dashboard.sections.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreSectionRequest $request)
    {
        // return $request;
        // toastr()->success('Data has been saved successfully!','title');
        try {
            Section::create([
                'name' => $request->name,
                'slug' => $this->Slug($request->name),
                // 'type' => $request->type,
                'status' => $request->status,
            ]);
            return redirect('dashboard/sections')->with('success_message', 'تم الحفظ');
        } catch (\Exception $e) {
            return redirect('dashboard/sections')->withErrors(['error_message' => $e->getMessage()]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Section $section)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Section $section)
    {
        Session::put('page', 'sections');
        return view('dashboard.sections.edit')->with(compact('section'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateSectionRequest $request, Section $section)
    {
        $section = Section::findOrFail($request->id);
        try {
            $section->update([
                'name' => $request->name,
                'slug' => $this->Slug($request->name),
                // 'type' => $request->type,
                'status' => $request->status,
            ]);
            // return redirect('dashboard/sections')->with(toastr()->success('Data has been saved successfully!','successfully'));
            return redirect('dashboard/sections')->with('success_message', 'تم الحفظ');
        } catch (\Exception $e) {
            return redirect('dashboard/sections')->withErrors(['error_message' => $e->getMessage()]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, $id)
    {
        //
        Session::put('page', 'sections');
        Section::where('id', $id)->forceDelete();
        return redirect()->back()->with('success_message', 'تم الحذف ');
    }

    public function trashed()
    {
        //delete forever 
        //Post::where('id', $id)->forceDelete();
        Session::put('page', 'sections-trashed');
        $sections = Section::onlyTrashed()->select('*')->paginate(20);
        return view('dashboard.sections.trashed')->with(compact('sections'));
    }
    public function softDelete(Request $request, $id)
    {
        Section::where('id', $id)->delete();
        //        return back();
        return redirect()->route('dashboard.sections.trashed');
    }
    public function restore($id)
    {
        Section::where('id', $id)->restore();
        //        return back();
        return redirect()->route('dashboard.sections.index');
    }
    public function restoreAll()
    {
        Section::onlyTrashed()->restore();
        //        return back();
        return redirect()->route('dashboard.sections.index');
    }

    public function Slug($string, $separator = '-'){
        if (is_null($string)) {
            return "";
        }
        $string = trim($string);
        $string = mb_strtolower($string, "UTF-8");;
        $string = preg_replace("/[^a-z0-9_\sءاأإآؤئبتثجحخدذرزسشصضطظعغفقكلمنهويةى]#u/", "", $string);
        $string = preg_replace("/[\s-]+/", " ", $string);
        $string = preg_replace("/[\s_]/", $separator, $string);
        return $string;
    }

}
