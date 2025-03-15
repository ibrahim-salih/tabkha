<?php

namespace App\Http\Controllers\Cooker;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Cooker;
use App\Models\Country;
use App\Models\State;
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
        $cookerDetails = Cooker::where('email', Auth::guard('cooker')->user()->email)->first();
        return view('cooker.profile.details')->with(compact('cookerDetails','countries','staties'));
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
                // thumbnail image upload on folder code
                // $destinnationPathThumbnail = 'uploads/cookers/thumbnail/';
                // $image->resize(25, 25);
                // $image->save($destinnationPathThumbnail . $iamgeName);
                $path = 'uploads/cookers/' . $iamgeName;

                // $extension = $image_tmp->getClientOriginalExtension();
                // $fileName = rand(111, 99999) . '.' . $extension;
                // $filePath = 'uploads/admins/';
                // $image_tmp->move($filePath, $fileName);
                // $path = 'uploads/admins/' . $fileName;
            }
        }else {
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
}
