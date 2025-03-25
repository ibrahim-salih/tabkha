<?php

namespace App\Http\Controllers\Cooker;

use App\Http\Controllers\Controller;
use App\Models\Charge;
use App\Models\ChargeValue;
use Illuminate\Http\Request;
use App\Models\Cooker;
use App\Models\Country;
use App\Models\Menu;
use App\Models\Nationality;
use App\Models\Package;
use App\Models\State;
use ArPHP\I18N\Arabic;
use Illuminate\Support\Facades\File;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Session;
use Illuminate\Validation\Rules\Password;
use Intervention\Image\Drivers\Gd\Driver;
use Intervention\Image\ImageManager;
use Intervention\Image\Typography\FontFactory;

use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class ProfileController extends Controller
{
    public function checkPassword(Request $request)
    {
        $data = $request->all();
        //return $data;die;
        if (Hash::check($data['current_password'], Auth::guard('cooker')->user()->password)) {
            return "true";
        } else {
            return "false";
        }
    }

    public function password()
    {
        Session::put('page', 'update-cooker-password');
        $cookerDetails = Cooker::where('email', Auth::guard('cooker')->user()->email)->first();
        return view('cooker.profile.password')->with(compact('cookerDetails'));
    }

    public function profile(Request $request)
    {
        Session::put('page', 'cookers');
        $countries = Country::select('*')->active()->get();
        $staties = State::select('*')->active()->get();
        $nationalities = Nationality::select('*')->active()->get();
        $cookerDetails = Cooker::where('email', Auth::guard('cooker')->user()->email)->first();
        return view('cooker.profile.details')->with(compact('cookerDetails', 'countries', 'staties', 'nationalities'));
    }

    public function updateProfile(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'f_name' => [
                'required',
                'max:100',
                // 'between', 'between:5,150',
                Rule::unique('cookers', ',f_name')->ignore($request->id),
            ],
            'email' => [
                'required',
                'max:255',
                // 'between', 'between:5,150',
                Rule::unique('cookers', 'email')->ignore($request->id),
            ],
            'phone' => [
                'required',
                'max:13',
                // 'between', 'between:5,150',
                Rule::unique('cookers', 'phone')->ignore($request->id),
            ],
            'phoneCash' => [
                'required',
                'max:13',
                // 'between', 'between:5,150',
                Rule::unique('cookers', 'phoneCash')->ignore($request->id),
            ],
            // 'admin_name' => 'required|max:100|unique:admins,name',
            // 'admin_email' => 'required|email|max:255|unique:admins,email',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,gif,svg|max:2048',
            // 'admin_mobile' => 'required|numeric|max:20|unique:admins,mobile',
        ], $messages = [
            'f_name.required' => 'الاسم مطلوب',
            'f_name.max' => 'يجب أن يحتوي :الاسم :100 حرف/حروف',
            'f_name.unique' => 'قيمة الاسم مستخدم من قبل',
            'email.required' => 'الايميل مطلوب',
            'email.email' => 'يجب أن يكون الايميل ايميل',
            'email.max' => 'يجب أن يحتوي :الايميل :255 حرف/حروف',
            'email.unique' => 'قيمة الايميل مستخدم من قبل',
            'image.required' => 'الصورة مطلوب',
            'image.image' => 'الصورة يجب ان تكون من نوع صورة',
            'image.mimes' => 'الصورة يجب ان تكون jpg,jpeg,png',
            'image.max' => 'الصورة يجب ان لا تزيد عن 2 ميجابايت',
            'phone.required' => 'رقم الموبايل مطلوب',
            'phone.numeric' => 'يجب أن يكون رقم الموبايل رقم',
            'phone.max' => 'يجب أن يحتوي :رقم الموبايل :20 حرف/حروف',
            'phone.unique' => 'قيمة رقم الموبايل مستخدم من قبل',
            'phoneCash.required' => ' رقم محفظة كاش مطلوب',
            'phoneCash.numeric' => 'يجب أن يكون رقم محفظة كاش رقم',
            'phoneCash.max' => 'يجب أن يحتوي :رقم رقم محفظة كاش :20 حرف/حروف',
            'phoneCash.unique' => 'قيمة رقم رقم محفظة كاش مستخدم من قبل',
        ]);

        $cooker = Cooker::where('id', Auth::guard('cooker')->user()->id)->first();
        //$data = $request->all();
        if ($request->hasFile('image')) {
            $adm = Cooker::find(Auth::guard('cooker')->user()->id);
            //find old image
            $image = DB::table('cookers')->where('id', Auth::guard('cooker')->user()->id)->first();
            //delete old image
            ## Check file exists
            if ($image->image != NULL || $image->image != '') {
                if (File::exists(public_path('uploads/cookers/' . $image->image))) {
                    //dd('File exists.');
                    unlink(public_path('uploads/cookers/' . $image->image));
                }
            }
            //uploade
            $image_tmp = $request->file('image');
            if ($image_tmp->isValid()) {
                $manager = new ImageManager(new Driver());
                $image = $manager->read($request->file('image'));
                // main image upload on folder code
                $iamgeName = time() . '.' . $request->file('image')->getClientOriginalExtension();
                $destinnationPath = 'uploads/cookers/';
                $image->save($destinnationPath . $iamgeName);
                $path = 'uploads/cookers/' . $iamgeName;
            }
        } else {
            $path = $cooker->image;
        }
        try {
            $cooker->f_name = $request->f_name;
            $cooker->l_name = $request->l_name;
            $cooker->gender = $request->gender;
            $cooker->country_id = $request->country;
            $cooker->state_id = $request->state;
            $cooker->address = $request->address;
            $cooker->username = $request->username;
            $cooker->image =  $path;
            //$admin->email =  $request->email;
            $cooker->phone =  $request->phone;
            $cooker->phoneCash =  $request->phoneCash;
            $cooker->save();
            return redirect()->back()->with('success_message',  'تم التحديث');
        } catch (\Exception $e) {
            return redirect()->back()->with('error_message', $e->getMessage());
        }
    }

    public function updatePassword(Request $request)
    {
        $data = $request->all();
        if (Hash::check($data['current_password'], Auth::guard('cooker')->user()->password)) {
            //return "true";
            if ($data['new_password'] == $data['confirm_password']) {
                Cooker::where('id', Auth::guard('cooker')->user()->id)->update(['password' => bcrypt($data['new_password'])]);
                return redirect()->back()->with('success_message', 'تم التحديث');
            } else {
                return redirect()->back()->with('error_message', 'كلمة المرور غير متطابقة');
            }
        } else {
            return redirect()->back()->with('error_message', 'خطا حاول فيما بعد');
        }
    }

    public function settings(Request $request)
    {
        // return 'settings';
        Session::put('page', 'settings');
        $details = Cooker::where('email', Auth::guard('cooker')->user()->email)->first();
        return view('cooker.profile.settings')->with(compact('details'));
    }

    public function updateSettings(Request $request)
    {
        if (Auth::guard('cooker')->user()->confirm == '1') {
            return redirect('cooker/settings')->with('error_message', 'الحساب تم توثيقة من قبل ');
        }
        $validator = Validator::make($request->all(), [
            'ID_img_front' => 'nullable|image|mimes:jpg,jpeg,png,gif,svg|max:5096',
            'ID_img_back' => 'nullable|image|mimes:jpg,jpeg,png,gif,svg|max:5096',
        ], $messages = [
            'ID_img_front.required' => 'سيلفى البطاقة وش مطلوب',
            'ID_img_front.image' => 'سيلفى البطاقة وش يجب ان تكون من نوع صورة',
            'ID_img_front.mimes' => 'سيلفى البطاقة وش يجب ان تكون jpg,jpeg,png',
            'ID_img_front.max' => 'سيلفى البطاقة وش يجب ان لا تزيد عن 5 ميجا',
            'ID_img_back.required' => 'سيلفى البطاقة ظهر مطلوب',
            'ID_img_back.image' => 'سيلفى البطاقة ظهر يجب ان تكون من نوع صورة',
            'ID_img_back.mimes' => 'سيلفى البطاقة ظهر يجب ان تكون jpg,jpeg,png',
            'ID_img_back.max' => 'سيلفى البطاقة ظهر يجب ان لا تزيد عن 5 ميجا',
        ]);
        $cooker = Cooker::where('id', Auth::guard('cooker')->user()->id)->first();
        // upload وش البطاقة
        if ($request->hasFile('ID_img_front')) {
            //find old image
            $image = DB::table('cookers')->where('id', Auth::guard('cooker')->user()->id)->first();
            //delete old image
            ## Check file exists
            if ($image->ID_img_front != NULL || $image->ID_img_front != '') {
                if (File::exists(public_path('uploads/cookers/' . $image->image))) {
                    //dd('File exists.');
                    unlink(public_path('uploads/cookers/' . $image->image));
                }
            }
            $file_tmp = $request->file('ID_img_front');
            if ($file_tmp->isValid()) {
                $manager = new ImageManager(new Driver());
                $image = $manager->read($request->file('ID_img_front'));
                // main image upload on folder code
                $iamgeName = time() . '.' . $request->file('ID_img_front')->getClientOriginalExtension();
                $destinnationPath = 'uploads/cookers/';
                $image->save($destinnationPath . $iamgeName);
                $image = 'uploads/cookers/' . $iamgeName;
            }
        } else {
            $image = NULL;
        }
        // upload ظهر البطاقة
        if ($request->hasFile('ID_img_back')) {
            $file_tmp2 = $request->file('ID_img_back');
            if ($file_tmp2->isValid()) {
                //find old image
            $image = DB::table('cookers')->where('id', Auth::guard('cooker')->user()->id)->first();
            //delete old image
            ## Check file exists
            if ($image->ID_img_back != NULL || $image->ID_img_back != '') {
                if (File::exists(public_path('uploads/cookers/' . $image->image))) {
                    //dd('File exists.');
                    unlink(public_path('uploads/cookers/' . $image->image));
                }
            }
                $manager = new ImageManager(new Driver());
                $image2 = $manager->read($request->file('ID_img_back'));
                // main image upload on folder code
                $iamgeName = time() . '.' . $request->file('ID_img_back')->getClientOriginalExtension();
                $destinnationPath = 'uploads/cookers/';
                $image2->save($destinnationPath . $iamgeName);
                $image2 = 'uploads/cookers/' . $iamgeName;
            }
        } else {
            $image2 = NULL;
        }
        try {
            // $cooker->image =  $path;
            $cooker->ID_img_front = $image;
            $cooker->ID_img_back = $image2;
            $cooker->save();
            return redirect()->back()->with('success_message',  'تم التحديث');
        } catch (\Exception $e) {
            return redirect()->back()->with('error_message', $e->getMessage());
        }
    }

    public function workStatus(Request $request)
    {
        if ($request->mode == 'true') {
            Cooker::where('id', $request->id)->update(['work' => '1']);
            $active = '1';
        } else {
            Cooker::where('id', $request->id)->update(['work' => '0']);
            $active = '0';
        }
        return response()->json(['msg' => 'تم التحديث', 'active' => $active, 'status' => true]);
    }

    public function prePay(Request $request)
    {
        if ($request->mode == 'true') {
            Cooker::where('id', $request->id)->update(['prePay' => '1']);
            $active = '1';
        } else {
            Cooker::where('id', $request->id)->update(['prePay' => '0']);
            $active = '0';
        }
        return response()->json(['msg' => 'تم التحديث', 'active' => $active, 'status' => true]);
    }

    public function codPay(Request $request)
    {
        if ($request->mode == 'true') {
            Cooker::where('id', $request->id)->update(['COD' => '1']);
            $active = '1';
        } else {
            Cooker::where('id', $request->id)->update(['COD' => '0']);
            $active = '0';
        }
        return response()->json(['msg' => 'تم التحديث', 'active' => $active, 'status' => true]);
    }

    public function package(Request $request)
    {
        Session::put('page', 'package');
        if (Auth::guard('cooker')->user()->confirm == '0') {
            return redirect('cooker/settings')->with('error_message', 'لم تتم الموافقة على حساب الطباخ الخاص بك حتى الآن ، يرجى التأكد من ملء بياناتك الشخصية وبيانات التوثيق الصالحة');
        }
        if (Auth::guard('cooker')->user()->confirm == '2') {
            return redirect('cooker/settings')->with('error_message', 'تم رفض بيانات التوثيق ، يرجى اعادة الارسال مرة اخرى و ملء بياناتك الشخصية وسيلفى صور البطاقة وش وظهر');
        }
        $details = Cooker::where('email', Auth::guard('cooker')->user()->email)->first();
        $packages = Package::select('id', 'title', 'description', 'price')->where('type', 'cookers')->where('status', '1')->get();
        $charge = ChargeValue::select('id', 'cooker_id', 'charge', 'total_charge', 'total_use')->where('cooker_id', Auth::guard('cooker')->user()->id)->first();
        return view('cooker.profile.package')->with(compact('details', 'packages', 'charge'));
    }

    public function updatePackage(Request $request, $id)
    {
        $package = Package::findOrFail($id);
        $details = Cooker::where('email', Auth::guard('cooker')->user()->email)->first();
        $charge = ChargeValue::select('id', 'cooker_id', 'charge', 'total_charge', 'total_use')->where('cooker_id', Auth::guard('cooker')->user()->id)->first();
        $cookerMenus = Menu::where('status', '2')->where('cooker_id', Auth::guard('cooker')->user()->id)->get();
        // if select free package
        if ($package->price == 0 && $details->freePackage == 'Yes') {
            // عفوا قد استخدمت الباقة المجانية من قبل
            $Msg = 'عفوا لقد حصلت على الباقة المجانية من قبل';
            return redirect()->back()->with('error_message', $Msg);
        }
        $startDate = date('Y-m-d');
        $endDate = now()->parse($startDate)->addDays($package->days);
        $endDate->format("Y-m-d");
        // if charge < package
        // سعر الباقة
        $valPrice = $package->price;
        // الرصيد المتاح
        $valCharge = $charge->charge;
        if ($valPrice > $valCharge) {
            // الرصيد المتاح غير كافى
            $Msg = 'عفوا رصيدك غير كافى';
            return redirect()->back()->with('error_message', $Msg);
        }
        // if charge > or = package update
        // الرصيد قبل التحديث
        $oldCharge = $charge->charge;
        // الرصيد بعد التحديث
        $newCharge = $charge->charge - $valPrice;
        // اجمالى الرصيد المستخدم قبل التحديث
        $allUseCharge = $charge->total_use;
        // اجمالى الرصيد المستخدم بعد التحديث
        $newUseCharge = $charge->total_use + $valPrice;
        try {
            DB::beginTransaction();
            // update charge
            $charge->update(['charge' => $newCharge, 'total_use' => $newUseCharge]);
            // vendor package 
            $details->update(['package_id' => $id, 'start_date' => $startDate, 'end_date' => $endDate]);
            // vendor products
            if ($cookerMenus) {
                foreach ($cookerMenus as $menu) {
                    $menu->update(['status' => '1']);
                }
            }
            DB::commit();
            return redirect()->back()->with('success_message', 'تم التعديل بنجاح');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function charge(Request $request)
    {
        Session::put('page', 'charge');
        if (Auth::guard('cooker')->user()->confirm == '0') {
            return redirect('cooker/settings')->with('error_message', 'لم تتم الموافقة على حساب الطباخ الخاص بك حتى الآن ، يرجى التأكد من ملء بياناتك الشخصية وبيانات التوثيق الصالحة');
        }
        if (Auth::guard('cooker')->user()->confirm == '2') {
            return redirect('cooker/settings')->with('error_message', 'تم رفض بيانات التوثيق ، يرجى اعادة الارسال مرة اخرى و ملء بياناتك الشخصية وسيلفى صور البطاقة وش وظهر');
        }
        $details = Cooker::with('package')->where('email', Auth::guard('cooker')->user()->email)->first();
        $allcharges = Charge::select('id', 'cooker_id', 'admin_id', 'image', 'price', 'status_of', 'resonse', 'created_at')->where('cooker_id', Auth::guard('cooker')->user()->id)->get();
        $charges = ChargeValue::select('id', 'cooker_id', 'charge', 'total_charge', 'total_use')->where('cooker_id', Auth::guard('cooker')->user()->id)->first();
        return view('cooker.profile.charages')->with(compact('details', 'allcharges', 'charges'));
    }

    public function storeCharge(Request $request)
    {
        // return $request->all();
        //1- get the user data
        $data = request()->all();
        // return $data;
        // if ($request->hasFile('image')) {
        //     //uploade
        //     $image_tmp = $request->file('image');
        //     if ($image_tmp->isValid()) {
        //         //get image extension
        //         $extension = $image_tmp->getClientOriginalExtension();
        //         //generate new name
        //         $imageName = rand(111, 99999) . '.' . $extension;
        //         $imagePath = 'uploads/vendors/charages/' . $imageName;
        //         //upload the image
        //         Image::make($image_tmp)->save($imagePath, 100);
        //         $image = $imagePath;
        //     }
        // }
        if ($request->hasFile('image')) {
            $file_tmp = $request->file('image');
            if ($file_tmp->isValid()) {
                $manager = new ImageManager(new Driver());
                $image = $manager->read($request->file('image'));
                // add cooker name on image
                // $size = getimagesize($request->file('image'));
                // $width = $size[0] / 2;
                // $height = $size[1] / 2;
                $arabic = new Arabic();
                $name = $arabic->utf8Glyphs(Auth::guard('cooker')->user()->username);
                $image->text($name, 50, 30, function ($font) {
                    $font->file(public_path("fonts/Cairo-VariableFont_slnt,wght.ttf"));
                    $font->size(20);
                    $font->color('red');
                    $font->align('top');
                    $font->valign('middle');
                    $font->stroke('ff5500', 2);
                    // $font->lineHeight(1.6); 
                    // $font->angle(45);  
                });
                // main image upload on folder code
                $iamgeName = time() . '.' . $request->file('image')->getClientOriginalExtension();
                $destinnationPath = 'uploads/charages/';
                // $image->resize(350, 200);
                $image->save($destinnationPath . $iamgeName);
                // thumbnail image upload on folder code
                // $destinnationPathThumbnail = 'uploads/posts/thumbnail/';
                // $image->resize(110, 110);
                // $image->save($destinnationPathThumbnail.$iamgeName);
                $image = 'uploads/charages/' . $iamgeName;
            }
        } else {
            $image = NULL;
        }
        //2- store user data in database
        try {
            Charge::create([
                'user_type' => 'cooker',
                'cooker_id' => Auth::guard('cooker')->user()->id,
                'image' => $image,
                'price' => $request->price,
                'mobile' => $request->mobile,
            ]);
            //3- redirection to sections index
            return redirect()->back()->with('success_message', 'تم الارسال بنجاح');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error_message' => $e->getMessage()]);
        }
    }
}
