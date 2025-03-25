<?php

namespace App\Http\Controllers\Cooker\Auth;

use App\Models\Admin;
use App\Models\Cooker;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Requests\CreateAdminRequest;
use App\Notifications\ConfirmCooker;
use App\Notifications\NewCooker;
use App\Http\Requests\RegisterCookerRequest;
use App\Helpers\UserSystemInfoHelper;
use Stevebauman\Location\Facades\Location;
use App\Mail\ConfirmMail;
use App\Models\ChargeValue;
use App\Models\CookerChart;
use App\Models\Country;
use App\Models\Nationality;
use App\Models\Package;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Services\Auth\AuthService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Notification;
use Intervention\Image\Drivers\Gd\Driver;
use Intervention\Image\ImageManager;
use Intervention\Image\Typography\FontFactory;

class AuthController extends Controller
{

    protected $authService;
    public function __construct(AuthService $authService)
    {
        $this->authService = $authService;
    }

    public function showLoginForm()
    {
        return view('cooker.auth.login');
    }

    public function login(CreateAdminRequest $request)
    {
        // return $request;
        $credentials = $request->only(['email', 'password']);
        if ($this->authService->login($credentials, 'cooker', $request->remember)) {
            if (Auth::guard('cooker')->user()->status == '0') {
                Auth::guard('cooker')->logout();
                return redirect()->back()->with('error_message', "يرجى تأكيد بريدك الإلكتروني لتفعيل حسابك");
            } elseif (Auth::guard('cooker')->user()->confirm == "2") {
                Auth::guard('cooker')->logout();
                return redirect()->back()->with('error_message', "الحساب موقوف");
            } else {
                // Auth::guard('cooker')->logout();
                // return redirect()->back()->with('error_message', "يمكنك الان تسجيل الدخول");
                return redirect()->intended(route('cooker.welcome'));
            }
        } else {
            return redirect()->back()->withErrors(['email' => 'بيانات الدخول غير صحيحة']);
        }
    }

    public function showRegisterForm()
    {
        $countries = Country::select('*')->active()->get();
        $nationalities = Nationality::select('*')->active()->get();
        $packages = Package::select('id', 'title', 'description', 'price')->where('type', 'cookers')->where('status', '1')->get();
        return view('cooker.auth.register')->with(compact('countries', 'nationalities', 'packages'));
    }

    public function getStates(Request $request)
    {
        $states = DB::table('states')
            ->where('country_id', $request->country)
            ->get();

        if (count($states) > 0) {
            return response()->json($states);
        }
    }

    public function terms() {}

    public function register(RegisterCookerRequest $request)
    {
        // return $request->package;
        $package = Package::select('id', 'title', 'description', 'price')->where('type', 'cookers')->where('id', $request->package)->first();
        if ($package->price == 0) {
            $free = 'Yes';
        } else {
            $free = 'No';
        }
        // return $free;
        // upload وش البطاقة
        if ($request->hasFile('image')) {
            $file_tmp = $request->file('image');
            if ($file_tmp->isValid()) {
                $manager = new ImageManager(new Driver());
                $image = $manager->read($request->file('image'));
                // main image upload on folder code
                $iamgeName = time() . '.' . $request->file('image')->getClientOriginalExtension();
                $destinnationPath = 'uploads/cookers/';
                $image->resize(350, 200);
                $image->save($destinnationPath . $iamgeName);
                // thumbnail image upload on folder code
                // $destinnationPathThumbnail = 'uploads/posts/thumbnail/';
                // $image->resize(110, 110);
                // $image->save($destinnationPathThumbnail.$iamgeName);
                $image = 'uploads/cookers/' . $iamgeName;
            }
        } else {
            $image = NULL;
        }
        // upload ظهر البطاقة
        if ($request->hasFile('image2')) {
            $file_tmp2 = $request->file('image2');
            if ($file_tmp2->isValid()) {
                $manager = new ImageManager(new Driver());
                $image2 = $manager->read($request->file('image2'));
                // main image upload on folder code
                $iamgeName = time() . '.' . $request->file('image2')->getClientOriginalExtension();
                $destinnationPath = 'uploads/cookers/';
                $image2->resize(350, 200);
                $image2->save($destinnationPath . $iamgeName);
                // thumbnail image upload on folder code
                // $destinnationPathThumbnail = 'uploads/posts/thumbnail/';
                // $image->resize(110, 110);
                // $image->save($destinnationPathThumbnail.$iamgeName);
                $image2 = 'uploads/cookers/' . $iamgeName;
            }
        } else {
            $image2 = NULL;
        }
        try {
            DB::beginTransaction();
            // date_default_timezone_set("Africa/Cairo");
            //     $admin->created_at = date("Y-m-d H:i:s");
            //     $admin->updated_at = date("Y-m-d H:i:s");
            $cooker = Cooker::create([
                'f_name' => $request->firstName,
                'l_name' => $request->lastName,
                'username' => $request->username,
                'gender' => $request->gender,
                'email' => $request->email,
                'phone' => $request->phone,
                'country_id' => $request->country,
                'state_id' => $request->state,
                'nationalty_id' => $request->nationality,
                'address' => $request->address,
                'ID_img_front' => $image,
                'ID_img_back' => $image2,
                'package_id' =>  $request->package,
                'freePackage' => $free,
                'start_date' => date('Y-m-d'),
                'end_date' => now()->parse(date('Y-m-d'))->addDays(30),
                'password' => bcrypt($request->password),
                date_default_timezone_set("Africa/Cairo"),
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s"),
            ]);
            $charge = ChargeValue::create([
                'user_type' => 'cooker',
                'cooker_id' => $cooker->id,
            ]);
            // info chart//
            $getbrowser = UserSystemInfoHelper::get_browsers();
            $getdevice = UserSystemInfoHelper::get_device();
            $getos = UserSystemInfoHelper::get_os();
            // $ip = $request->ip(); /*Dynamic IP address */
            $ip = '162.159.24.227'; /* Static IP address */
            $currentUserInfo = Location::get($ip);
            if ($currentUserInfo) {
                $CountryName = $currentUserInfo->countryName;
                $CountryCode = $currentUserInfo->countryCode;
                $RegionCode  = $currentUserInfo->regionCode;
                $RegionName  = $currentUserInfo->regionName;
                $CityName    = $currentUserInfo->cityName;
                $ZipCode     = $currentUserInfo->zipCode;
                $Latitude    = $currentUserInfo->latitude;
                $Longitude   = $currentUserInfo->longitude;
            } else {
                $CountryName = '';
                $CountryCode = '';
                $RegionCode = '';
                $RegionName = '';
                $CityName = '';
                $ZipCode = '';
                $Latitude = '';
                $Longitude = '';
            }
            // return $currentUserInfo;
            $infoChart = CookerChart::create([
                'user_type' => 'cooker',
                'cooker_id' => $cooker->id,
                'name' =>  $request->name,
                'city' => $CityName,
                'browser' => $getbrowser,
                'device' => $getdevice,
                'os' => $getos,
                'latitude' => $Latitude,
                'longitude' => $Longitude,
            ]);
            // send confirmation email
            $email = $request->email;
            $mailData = [
                'title' => 'طبخة بيتى',
                'body' => 'تأكيد البريد الالكترونى ',
                'name' => $request->username,
                'code' => base64_encode($request->email)
            ];
            Mail::to($email)->send(new ConfirmMail($mailData));
            // send Notification new cooker register to admin
            $admins = Admin::get();
            Notification::send($admins, new NewCooker($cooker->id, $cooker->username));
            DB::commit();
            $message = "نشكرك على التسجيل كطباخ. ستصلك رسالة تأكيد الايميل على الايميل بعد قليل";
            // return response()->json(['type' => 'success', 'message' => $message]);
            return redirect()->back()->with('success_message', $message);
        } catch (\Exception $e) {
            return response()->json($e->getMessage(), 401);
        }
    }

    public function confirm($email)
    {
        //decode user email
        $email = base64_decode($email);
        $cookerCount = Cooker::where('email', $email)->count();
        if ($cookerCount > 0) {
            //vendor email already exists
            $cookerDetails = Cooker::where('email', $email)->first();
            if ($cookerDetails->status == '1') {
                $message = "تم تأكيد حساب الطباخ الخاص بك بالفعل ، يمكنك تسجيل الدخول";
                Session::put('error_message', $message);
                return redirect('/cooker/login');
            } else {
                //update Cooker confirm to yes
                Cooker::where('email', $email)->update(['status' => '1']);
                //send register sms
                //                    $message ="Dear Customer, you have been successfully registered with Ecom website, Login to your account to access orders and available offers";
                //                    $mobile = $data['mobile'];
                //                    Sms::sendSms($message,$mobile);
                //     send register email
                //                    $email = $data['email'];
                //                $messageData =['name'=>$cookerDetails['f_name'],'mobile'=>$cookerDetails['phone'],'email'=>$email];
                //                Mail::send('emails.cooker_confirmed',$messageData,function ($message) use($email){
                //                    $message->to($email)->subject('اهلا بك فى موقعنا');
                //                });
                //redirect to login page
                $message = "تم تأكيد حساب الطباخ الخاص بك ، يمكنك تسجيل الدخول الآن";
                Session::put('error_message', $message);
                return redirect('/cooker/login');
            }
        } else {
            abort(404);
        }
    }

    public function logout()
    {
        $this->authService->logout('cooker');
        return redirect()->route('cooker.login');
    }
}
