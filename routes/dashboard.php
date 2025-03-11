<?php
use Illuminate\Support\Facades\Route;
use \Mcamara\LaravelLocalization\Facades\LaravelLocalization;
use App\Http\Controllers\Dashboard\Auth\AuthController;
use App\Http\Controllers\Dashboard\WelcomeController;
use App\Http\Controllers\Dashboard\ProfileController;
use App\Http\Controllers\Dashboard\Auth\ForgetPasswordController;
use App\Http\Controllers\Dashboard\Auth\ResetPasswordController;

Route::group(
    [
        // 'prefix' => LaravelLocalization::setLocale() . '/dashboard',
        'as' => 'dashboard.',
        // 'middleware' => [ 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath' ]
    ],
    function () { //...
        // Route::get('dashboard', function () {
        //     return view('dashboard.welcome');
        // });
        ########################### Auth #####################################################
        Route::get('login', [AuthController::class, 'showLoginForm'])->name('login')->middleware('guest:admin');
        Route::post('login', [AuthController::class, 'login'])->name('login.post')->middleware('guest:admin');
        Route::post('logout', [AuthController::class, 'logout'])->name('logout');
        Route::group(['prefix' => 'password', 'as' => 'password.'], function () {
            Route::controller(ForgetPasswordController::class)->group(function () {
                Route::get('email', 'showMailForm')->name('email');
                Route::post('email', 'sendOtp')->name('email.post');
                Route::get('verify/{email}', 'showOtpForm')->name('verify');
                Route::post('verify', 'verifyOtp')->name('verify.post');
            });
            Route::controller(ResetPasswordController::class)->group(function () {
                Route::get('reset', 'showResetForm')->name('reset');
                Route::post('reset', 'resetPassword')->name('reset.post');
            });
        });
        ########################### Protected Routes #########################################
        Route::group(['middleware' => 'auth:admin'], function () {
            ########################### welcome ##############################################
            Route::get('welcome', [WelcomeController::class, 'index'])->name('welcome');
            ########################### admins ##############################################
            // Check Admin Password
            Route::get('check-password', [ProfileController::class, 'checkPassword']);
            Route::get('/password', [ProfileController::class, 'password'])->name('password');
            Route::get('/profile', [ProfileController::class, 'profile'])->name('profile');
            Route::post('/update-profile', [ProfileController::class, 'updateProfile']);
            Route::post('/update-password', [ProfileController::class, 'updatePassword']);
        });
        ########################### End Protected Routes #####################################
    }
);