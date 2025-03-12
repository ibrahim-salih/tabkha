<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin;
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
        if (Hash::check($data['current_password'], Auth::guard('admin')->user()->password)) {
            return "true";
        } else {
            return "false";
        }
    }

    public function password()
    {
        Session::put('page', 'update-admin-password');
        $adminDetails = Admin::where('email', Auth::guard('admin')->user()->email)->first();
        return view('dashboard.profile.password')->with(compact('adminDetails'));
    }

    public function profile(Request $request)
    {
        Session::put('page', 'admins');
        $adminDetails = Admin::where('email', Auth::guard('admin')->user()->email)->first();
        return view('dashboard.profile.details')->with(compact('adminDetails'));
    }

    public function updateProfile(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'admin_name' => [
                'required',
                'max:100',
                // 'between', 'between:5,150',
                Rule::unique('admins', ',name')->ignore($request->id),
            ],
            'admin_email' => [
                'required',
                'max:255',
                // 'between', 'between:5,150',
                Rule::unique('admins', 'email')->ignore($request->id),
            ],
            'admin_mobile' => [
                'required',
                'max:13',
                // 'between', 'between:5,150',
                Rule::unique('admins', 'mobile')->ignore($request->id),
            ],
            // 'admin_name' => 'required|max:100|unique:admins,name',
            // 'admin_email' => 'required|email|max:255|unique:admins,email',
            'admin_image' => 'nullable|image|mimes:jpg,jpeg,png,gif,svg|max:2048',
            // 'admin_mobile' => 'required|numeric|max:20|unique:admins,mobile',
        ], $messages = [
            'admin_name.required' => 'الاسم مطلوب',
            'admin_name.max' => 'يجب أن يحتوي :الاسم :100 حرف/حروف',
            'admin_name.unique' => 'قيمة الاسم مستخدم من قبل',
            'admin_email.required' => 'الايميل مطلوب',
            'admin_email.email' => 'يجب أن يكون الايميل ايميل',
            'admin_email.max' => 'يجب أن يحتوي :الايميل :255 حرف/حروف',
            'admin_email.unique' => 'قيمة الايميل مستخدم من قبل',
            'admin_image.required' => 'الصورة مطلوب',
            'admin_image.image' => 'الصورة يجب ان تكون من نوع صورة',
            'admin_image.mimes' => 'الصورة يجب ان تكون jpg,jpeg,png',
            'admin_image.max' => 'الصورة يجب ان لا تزيد عن 2 ميجابايت',
            'admin_mobile.required' => 'رقم الموبايل مطلوب',
            'admin_mobile.numeric' => 'يجب أن يكون رقم الموبايل رقم',
            'admin_mobile.max' => 'يجب أن يحتوي :رقم الموبايل :20 حرف/حروف',
            'admin_mobile.unique' => 'قيمة رقم الموبايل مستخدم من قبل',
        ]);

        $admin = Admin::where('id', Auth::guard('admin')->user()->id)->first();
        //$data = $request->all();
        if ($request->hasFile('admin_image')) {
            $adm = Admin::find(Auth::guard('admin')->user()->id);
            //find old image
            $image = DB::table('admins')->where('id', Auth::guard('admin')->user()->id)->first();
            //delete old image
            ## Check file exists
            if ($image->image != null || $image->image != '') {
                if (File::exists(public_path('uploads/admins/' . $adm->image))) {
                    //dd('File exists.');
                    unlink(public_path('uploads/admins/' . $adm->image));
                }
            }
            //uploade
            $image_tmp = $request->file('admin_image');
            if ($image_tmp->isValid()) {
                $manager = new ImageManager(new Driver());
                $image = $manager->read($request->file('admin_image'));
                // main image upload on folder code
                $iamgeName = time() . '.' . $request->file('admin_image')->getClientOriginalExtension();
                $destinnationPath = 'uploads/admins/';
                $image->save($destinnationPath . $iamgeName);
                // thumbnail image upload on folder code
                $destinnationPathThumbnail = 'uploads/admins/thumbnail/';
                $image->resize(25, 25);
                $image->save($destinnationPathThumbnail . $iamgeName);
                $path = 'uploads/admins/' . $iamgeName;

                // $extension = $image_tmp->getClientOriginalExtension();
                // $fileName = rand(111, 99999) . '.' . $extension;
                // $filePath = 'uploads/admins/';
                // $image_tmp->move($filePath, $fileName);
                // $path = 'uploads/admins/' . $fileName;
            }
        }else {
            $path = $admin->image;
        }
        try {
            $admin->name = $request->admin_name;
            $admin->image =  $path;
            //$admin->email =  $request->email;
            $admin->mobile =  $request->admin_mobile;
            $admin->save();
            return redirect()->back()->with('success_message',  'تم التحديث');
        } catch (\Exception $e) {
            return redirect()->back()->with('error_message', $e->getMessage());
        }
    }

    public function updatePassword(Request $request)
    {
        $data = $request->all();
        if (Hash::check($data['current_password'], Auth::guard('admin')->user()->password)) {
            //return "true";
            if ($data['new_password'] == $data['confirm_password']) {
                Admin::where('id', Auth::guard('admin')->user()->id)->update(['password' => bcrypt($data['new_password'])]);
                return redirect()->back()->with('success_message', 'تم التحديث');
            } else {
                return redirect()->back()->with('error_message', 'كلمة المرور غير متطابقة');
            }
        } else {
            return redirect()->back()->with('error_message', 'خطا حاول فيما بعد');
        }
    }
}
