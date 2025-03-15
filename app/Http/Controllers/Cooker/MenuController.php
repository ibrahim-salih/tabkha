<?php

namespace App\Http\Controllers\Cooker;

use App\Http\Controllers\Controller;

use App\Models\Menu;
use App\Http\Requests\StoreMenuRequest;
use App\Http\Requests\UpdateMenuRequest;
use App\Models\Category;
use App\Models\Foodlist;
use App\Models\QuantityType;
use App\Models\Section;
use Illuminate\Support\Facades\File;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Session;

class MenuController extends Controller
{
    public function index()
    {
        Session::put('page', 'menus');
        // return Menu::all();
        $menus = Menu::select('*')->with('section')->with('category')->with('food')->with('qtype')->where('cooker_id', Auth::guard('cooker')->user()->id)->paginate(10);
        //meta
        return view('cooker.menus.index')->with(compact('menus'));
    }

    public function menuStatus(Request $request)
    {
        if ($request->mode == 'true') {
            Menu::where('id', $request->id)->update(['status' => '1']);
            $active = '1';
        } else {
            Menu::where('id', $request->id)->update(['status' => '0']);
            $active = '0';
        }
        return response()->json(['msg' => 'تم التحديث', 'active' => $active, 'status' => true]);
    }

    public function create()
    {
        Session::put('page', 'menus');
        $sections = Section::select('*')->active()->get();
        $categories = Category::select('*')->active()->get();
        $Qtypes = QuantityType::select('*')->active()->get();
        return view('cooker.menus.create')->with(compact('sections','categories','Qtypes'));
    }

    public function store(StoreMenuRequest $request)
    {
        try {
            Menu::create([
                'section_id' => $request->Xsection,
                'category_id' => $request->Xcategory,
                'food_id' => $request->food,
                'cooker_id' => Auth::guard('cooker')->user()->id,
                'Qtype_id' => $request->type,
                'description' => $request->description,
                'price' => $request->price,
                'status' => $request->status,
            ]);
            return redirect('cooker/menus')->with('success_message', 'تم الحفظ');
        } catch (\Exception $e) {
            return redirect('cooker/menus')->withErrors(['error_message' => $e->getMessage()]);
        }
    }

    public function show(Menu $menu)
    {
        //
    }

    public function edit(Menu $menu)
    {
        //
        Session::put('page', 'menus');
        $sections = Section::select('*')->active()->get();
        $categories = Category::select('*')->active()->get();
        $foods = Foodlist::select('*')->active()->get();
        $Qtypes = QuantityType::select('*')->active()->get();
        return view('cooker.menus.edit')->with(compact('menu','sections','categories','Qtypes','foods'));
    }

    public function update(UpdateMenuRequest $request, Menu $menu)
    {
        $menu = Menu::findOrFail($request->id);
        try {
            $menu->update([
                'section_id' => $request->Xsection,
                'category_id' => $request->Xcategory,
                'food_id' => $request->food,
                'cooker_id' => Auth::guard('cooker')->user()->id,
                'Qtype_id' => $request->type,
                'description' => $request->description,
                'price' => $request->price,
                'status' => $request->status,
            ]);
            return redirect('cooker/menus')->with('success_message', 'تم الحفظ');
        } catch (\Exception $e) {
            return redirect('cooker/menus')->withErrors(['error_message' => $e->getMessage()]);
        }
    }

    public function destroy(Request $request, $id)
    {
        //
        Session::put('page', 'menus');
        Menu::where('id', $id)->forceDelete();
        return redirect()->back()->with('success_message', 'تم الحذف ');
    }

    public function getCats(Request $request)
    {
        $cats = DB::table('categories')
            ->where('section_id', $request->category)
            ->get();

        if (count($cats) > 0) {
            return response()->json($cats);
        }
    }
    public function getFoods(Request $request)
    {
        $foods = DB::table('foodlists')
            ->where('category_id', $request->food)
            ->get();

        if (count($foods) > 0) {
            return response()->json($foods);
        }
    }
}
