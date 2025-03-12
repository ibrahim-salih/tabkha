<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;

use App\Models\Category;
use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
use App\Models\Section;
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

class CategoryController extends Controller
{

    public function index()
    {
        Session::put('page', 'categories');
        // return Section::all();
        $categories = Category::select('*')->with('section')->paginate(10);
        //meta
        return view('dashboard.categories.index')->with(compact('categories'));
    }

    public function categoryStatus(Request $request)
    {
        if ($request->mode == 'true') {
            Category::where('id', $request->id)->update(['status' => '1']);
            $active = '1';
        } else {
            Category::where('id', $request->id)->update(['status' => '0']);
            $active = '0';
        }
        return response()->json(['msg' => 'تم التحديث', 'active' => $active, 'status' => true]);
    }

    public function create()
    {
        Session::put('page', 'categories');
        $sections = Section::active()->get();
        return view('dashboard.categories.create')->with(compact('sections'));
    }

    public function store(StoreCategoryRequest $request)
    {
        try {
            Category::create([
                'section_id' => $request->section,
                'name' => $request->name,
                'slug' => $this->Slug($request->name),
                'status' => $request->status,
            ]);
            return redirect('dashboard/categories')->with('success_message', 'تم الحفظ');
        } catch (\Exception $e) {
            return redirect('dashboard/categories')->withErrors(['error_message' => $e->getMessage()]);
        }
    }

    public function show(Category $category)
    {
        //
    }

    public function edit(Category $category)
    {
        Session::put('page', 'categories');
        $sections = Section::active()->get();
        $category = Category::findOrFail($category->id);
        return view('dashboard.categories.edit')->with(compact('category','sections'));
    }

    public function update(UpdateCategoryRequest $request, Category $category)
    {
        $category = Category::findOrFail($request->id);
        try {
            $category->update([
                'section_id' => $request->section,
                'name' => $request->name,
                'slug' => $this->Slug($request->name),
                'status' => $request->status,
            ]);
            // return redirect('dashboard/sections')->with(toastr()->success('Data has been saved successfully!','successfully'));
            return redirect('dashboard/categories')->with('success_message', 'تم الحفظ');
        } catch (\Exception $e) {
            return redirect('dashboard/categories')->withErrors(['error_message' => $e->getMessage()]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        //
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
