<?php
use Illuminate\Support\Facades\Route;
use \Mcamara\LaravelLocalization\Facades\LaravelLocalization;
use App\Http\Controllers\Dashboard\Auth\AuthController;
use App\Http\Controllers\Dashboard\WelcomeController;
use App\Http\Controllers\Dashboard\ProfileController;
use App\Http\Controllers\Dashboard\CountryController;
use App\Http\Controllers\Dashboard\StateController;
use App\Http\Controllers\Dashboard\NationalityController;
use App\Http\Controllers\Dashboard\SectionController;
use App\Http\Controllers\Dashboard\CategoryController;
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
            ########################### nationalities ##############################################
            Route::group(['prefix' => 'nationalities', 'as' => 'nationalities.'], function () {
                Route::controller(NationalityController::class)->group(function () {
                    Route::get('/', 'index')->name('index');
                    Route::get('/create', 'create')->name('create');
                    Route::get('/{nationality}/edit', 'edit')->name('edit');
                    Route::post('/store', 'store')->name('store');
                    Route::post('/update', 'update')->name('update');
                    Route::post('/status', 'nationalityStatus')->name('status');
                    Route::get('softDelete/{id}', 'softDelete');
                    Route::get('delete/{id}', 'destroy');
                    Route::get('/trashed', 'trashed')->name('trashed');
                    Route::get('/restore/{id}', 'restore')->name('restore');
                });
            });
            ########################### countries ##############################################
            Route::group(['prefix' => 'countries', 'as' => 'countries.'], function () {
                Route::controller(CountryController::class)->group(function () {
                    Route::get('/', 'index')->name('index');
                    Route::get('/create', 'create')->name('create');
                    Route::get('/{country}/edit', 'edit')->name('edit');
                    Route::post('/store', 'store')->name('store');
                    Route::post('/update', 'update')->name('update');
                    Route::post('/update-country-status', 'updateCountryStatus')->name('updateCountryStatus');
                    Route::post('/status', 'countryStatus')->name('status');
                    Route::get('softDelete/{id}', 'softDelete');
                    Route::get('delete/{id}', 'destroy');
                    Route::get('/trashed', 'trashed')->name('trashed');
                    Route::get('/restore/{id}', 'restore')->name('restore');
                });
            });
            ########################### cities ##############################################
            Route::group(['prefix' => 'staties', 'as' => 'staties.'], function () {
                Route::controller(StateController::class)->group(function () {
                    Route::get('/', 'index')->name('index');
                    Route::get('/create', 'create')->name('create');
                    Route::get('/{state}/edit', 'edit')->name('edit');
                    Route::post('/store', 'store')->name('store');
                    Route::post('/update', 'update')->name('update');
                    Route::post('/update-state-status', 'updateStateStatus')->name('updateStateStatus');
                    Route::post('/status', 'stateStatus')->name('status');
                    Route::get('softDelete/{id}', 'softDelete');
                    Route::get('delete/{id}', 'destroy');
                    Route::get('/trashed', 'trashed')->name('trashed');
                    Route::get('/restore/{id}', 'restore')->name('restore');
                });
            });
            ########################### Sections ##############################################
            Route::group(['prefix' => 'sections', 'as' => 'sections.'], function () {
                Route::controller(SectionController::class)->group(function () {
                    Route::get('/', 'index')->name('index');
                    Route::get('/create', 'create')->name('create');
                    Route::get('/{section}/edit', 'edit')->name('edit');
                    Route::post('/store', 'store')->name('store');
                    Route::post('/update', 'update')->name('update');
                    Route::post('/status', 'sectionStatus')->name('status');
                    Route::get('softDelete/{id}', 'softDelete');
                    Route::get('delete/{id}', 'destroy');
                    Route::get('/trashed', 'trashed')->name('trashed');
                    Route::get('/restore/{id}', 'restore')->name('restore');
                    // Route::get('/restore-all', 'restoreAll'])->name('restore');
                });
            });
            ########################### categories ##############################################
            Route::group(['prefix' => 'categories', 'as' => 'categories.'], function () {
                Route::controller(CategoryController::class)->group(function () {
                    Route::get('/', 'index')->name('index');
                    Route::get('/create', 'create')->name('create');
                    Route::get('/{category}/edit', 'edit')->name('edit');
                    Route::post('/store', 'store')->name('store');
                    Route::post('/update', 'update')->name('update');
                    Route::post('/status', 'categoryStatus')->name('status');
                    Route::get('softDelete/{id}', 'softDelete');
                    Route::get('delete/{id}', 'destroy');
                    Route::get('/trashed', 'trashed')->name('trashed');
                    Route::get('/restore/{id}', 'restore')->name('restore');
                    // Route::get('/restore-all', 'restoreAll'])->name('restore');
                });
            });
        });
        ########################### End Protected Routes #####################################
    }
);