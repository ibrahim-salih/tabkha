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
use ArPHP\I18N\Arabic;
use Illuminate\Support\Facades\File;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Session;
use Intervention\Image\Drivers\Gd\Driver;
use Intervention\Image\ImageManager;
use Intervention\Image\Typography\FontFactory;

class MenuController extends Controller
{
    public function index()
    {
        Session::put('page', 'menus');
        // return Menu::all();
        if (Auth::guard('cooker')->user()->confirm == '0') {
            return redirect('cooker/settings')->with('error_message', 'لم تتم الموافقة على حساب الطباخ الخاص بك حتى الآن ، يرجى التأكد من ملء بياناتك الشخصية وبيانات التوثيق الصالحة');
        }
        if (Auth::guard('cooker')->user()->confirm == '2') {
            return redirect('cooker/settings')->with('error_message', 'تم رفض بيانات التوثيق ، يرجى اعادة الارسال مرة اخرى و ملء بياناتك الشخصية وسيلفى صور البطاقة وش وظهر');
        }
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
        if (Auth::guard('cooker')->user()->confirm == '0') {
            return redirect('cooker/settings')->with('error_message', 'لم تتم الموافقة على حساب الطباخ الخاص بك حتى الآن ، يرجى التأكد من ملء بياناتك الشخصية وبيانات التوثيق الصالحة');
        }
        if (Auth::guard('cooker')->user()->confirm == '2') {
            return redirect('cooker/settings')->with('error_message', 'تم رفض بيانات التوثيق ، يرجى اعادة الارسال مرة اخرى و ملء بياناتك الشخصية وسيلفى صور البطاقة وش وظهر');
        }
        $sections = Section::select('*')->active()->get();
        $categories = Category::select('*')->active()->get();
        $Qtypes = QuantityType::select('*')->active()->get();
        return view('cooker.menus.create')->with(compact('sections', 'categories', 'Qtypes'));
    }

    public function store(StoreMenuRequest $request)
    {
        // upload صورة الطبخة
        if ($request->hasFile('image')) {
            $file_tmp = $request->file('image');
            if ($file_tmp->isValid()) {
                $manager = new ImageManager(new Driver());
                $image = $manager->read($request->file('image'));
                // add cooker name on image
                $size = getimagesize($request->file('image'));
                $width = $size[0] / 2;
                $height = $size[1] / 2;
                $arabic = new Arabic();
                $name = $arabic->utf8Glyphs(Auth::guard('cooker')->user()->username);
                $image->text($name, $width, $height, function ($font) {
                    $font->file(public_path("fonts/Cairo-VariableFont_slnt,wght.ttf"));
                    $font->size(12);
                    $font->color('red');
                    $font->align('center');
                    $font->valign('middle');
                    $font->stroke('ff5500', 2);
                    // $font->lineHeight(1.6); 
                    // $font->angle(45);  
                });
                // main image upload on folder code
                $iamgeName = time() . '.' . $request->file('image')->getClientOriginalExtension();
                $destinnationPath = 'uploads/menus/';
                // $image->resize(350, 200);
                $image->save($destinnationPath . $iamgeName);
                // thumbnail image upload on folder code
                // $destinnationPathThumbnail = 'uploads/posts/thumbnail/';
                // $image->resize(110, 110);
                // $image->save($destinnationPathThumbnail.$iamgeName);
                $image = 'uploads/menus/' . $iamgeName;
            }
        } else {
            $image = NULL;
        }
        try {
            Menu::create([
                'section_id' => $request->Xsection,
                'category_id' => $request->Xcategory,
                'food_id' => $request->food,
                'cooker_id' => Auth::guard('cooker')->user()->id,
                'Qtype_id' => $request->type,
                'country_id' => Auth::guard('cooker')->user()->country_id,
                'state_id' => Auth::guard('cooker')->user()->state_id,
                'image' => $image,
                'description' => $request->description,
                'price' => $request->price,
                'minQty' => $request->minQty,
                'bforeOrder' => $request->bforeOrder,
                'timeEnd' => $request->timeEnd,
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
        if (Auth::guard('cooker')->user()->confirm == '0') {
            return redirect('cooker/settings')->with('error_message', 'لم تتم الموافقة على حساب الطباخ الخاص بك حتى الآن ، يرجى التأكد من ملء بياناتك الشخصية وبيانات التوثيق الصالحة');
        }
        if (Auth::guard('cooker')->user()->confirm == '2') {
            return redirect('cooker/settings')->with('error_message', 'تم رفض بيانات التوثيق ، يرجى اعادة الارسال مرة اخرى و ملء بياناتك الشخصية وسيلفى صور البطاقة وش وظهر');
        }
        $sections = Section::select('*')->active()->get();
        $categories = Category::select('*')->active()->get();
        $foods = Foodlist::select('*')->active()->get();
        $Qtypes = QuantityType::select('*')->active()->get();
        return view('cooker.menus.edit')->with(compact('menu', 'sections', 'categories', 'Qtypes', 'foods'));
    }

    public function update(UpdateMenuRequest $request, Menu $menu)
    {
        $menu = Menu::findOrFail($request->id);
        $image = $menu->image;
        // upload صورة الطبخة
        if ($request->hasFile('image')) {
            $file_tmp = $request->file('image');
            if ($file_tmp->isValid()) {
                if ($menu->image != null || $menu->image != '') {
                    // return $post->image;
                    // user doesn't exist
                    if (File::exists(public_path($menu->image))) {
                        //dd('File exists.');
                        unlink(public_path($menu->image));
                    }
                }
                $manager = new ImageManager(new Driver());
                $image = $manager->read($request->file('image'));
                // add cooker name on image
                $size = getimagesize($request->file('image'));
                $width = $size[0] / 2;
                $height = $size[1] / 2;
                $arabic = new Arabic();
                $name = $arabic->utf8Glyphs(Auth::guard('cooker')->user()->username);
                $image->text($name, $width, $height, function ($font) {
                    $font->file(public_path("fonts/Cairo-VariableFont_slnt,wght.ttf"));
                    $font->size(12);
                    $font->color('red');
                    $font->align('center');
                    $font->valign('middle');
                    $font->stroke('ff5500', 2);
                    // $font->lineHeight(1.6); 
                    // $font->angle(45);  
                });
                // main image upload on folder code
                $iamgeName = time() . '.' . $request->file('image')->getClientOriginalExtension();
                $destinnationPath = 'uploads/menus/';
                // $image->resize(350, 200);
                $image->save($destinnationPath . $iamgeName);
                // thumbnail image upload on folder code
                // $destinnationPathThumbnail = 'uploads/posts/thumbnail/';
                // $image->resize(110, 110);
                // $image->save($destinnationPathThumbnail.$iamgeName);
                $image = 'uploads/menus/' . $iamgeName;
            }
        }
        try {
            $menu->update([
                'section_id' => $request->Xsection,
                'category_id' => $request->Xcategory,
                'food_id' => $request->food,
                'cooker_id' => Auth::guard('cooker')->user()->id,
                'Qtype_id' => $request->type,
                'country_id' => Auth::guard('cooker')->user()->country_id,
                'state_id' => Auth::guard('cooker')->user()->state_id,
                'image' => $image,
                'description' => $request->description,
                'price' => $request->price,
                'minQty' => $request->minQty,
                'bforeOrder' => $request->bforeOrder,
                'timeEnd' => $request->timeEnd,
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
        // Session::put('page', 'menus');
        // Menu::where('id', $id)->forceDelete();
        // return redirect()->back()->with('success_message', 'تم الحذف ');
        $menu = Menu::onlyTrashed()->find($id);
        if (!is_null($menu->image) || $menu->image != '') {
            // user doesn't exist
            if (File::exists(public_path($menu->image))) {
                //dd('File exists.');
                unlink(public_path($menu->image));
            }
        } else {
        }
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
