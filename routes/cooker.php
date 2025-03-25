<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Cooker\WelcomeController;
use App\Http\Controllers\Cooker\Auth\AuthController;
use App\Http\Controllers\Cooker\MenuController;
use App\Http\Controllers\Cooker\ProfileController;
use \Mcamara\LaravelLocalization\Facades\LaravelLocalization;

Route::group(
    [
        // 'prefix' => LaravelLocalization::setLocale() . '/cooker',
        'as' => 'cooker.',
        // 'middleware' => [ 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath' ]
    ],
    function () { //...
        // Route::get('login', function () {
        //     return 'cooker login page';
        //     // return view('cooker.welcome');
        // });
        ########################### Auth #####################################################
        // Route::view('register', 'livewire.show-form');
        Route::get('/getStates', [AuthController::class , 'getStates'])->name('getStates');
        Route::get('confirm/{code}', [AuthController::class , 'confirm'])->name('confirm')->middleware('guest:cooker');
        // Route::get('/vendor/confirm/{code}', 'VendorController@confirmVendor');
        Route::get('register', [AuthController::class , 'showRegisterForm'])->name('register')->middleware('guest:cooker');
        Route::post('register', [AuthController::class , 'register'])->name('register.post')->middleware('guest:cooker');
        Route::get('/cooker/confirm/{code}', [AuthController::class, 'confirmCooker']);
        Route::get('login', [AuthController::class , 'showLoginForm'])->name('login')->middleware('guest:cooker');
        Route::post('login', [AuthController::class , 'login'])->name('login.post')->middleware('guest:cooker');
        Route::post('logout', [AuthController::class , 'logout'])->name('logout');
        ########################### Protected Routes #########################################
        Route::group(['middleware' => 'auth:cooker'], function (){
            ########################### welcome ##############################################
            Route::get('welcome', [WelcomeController::class , 'index'])->name('welcome');
            ########################### cookers ##############################################
            // Check Cooker Password
            Route::get('check-password', [ProfileController::class, 'checkPassword']);
            Route::get('/password', [ProfileController::class, 'password'])->name('password');
            Route::get('/profile', [ProfileController::class, 'profile'])->name('profile');
            Route::post('/update-profile', [ProfileController::class, 'updateProfile']);
            Route::post('/update-password', [ProfileController::class, 'updatePassword']);

            Route::get('/settings', [ProfileController::class, 'settings'])->name('settings');
            Route::post('/update-settings', [ProfileController::class, 'updateSettings']);
            Route::get('/package', [ProfileController::class, 'package'])->name('package');
            Route::post('/update-package/{package}', [ProfileController::class, 'updatePackage'])->name('updatePackageDetails');
            Route::get('/charge', [ProfileController::class, 'charge'])->name('charge');
            Route::post('/store-charge', [ProfileController::class, 'storeCharge']);

            Route::post('/work', [ProfileController::class, 'workStatus'])->name('workStatus');
            Route::post('/prePay', [ProfileController::class, 'prePay'])->name('prePay');
            Route::post('/codPay', [ProfileController::class, 'codPay'])->name('codPay');
            ########################### menu #################################################
            Route::group(['prefix' => 'menus', 'as' => 'menus.'], function () {
                Route::controller(MenuController::class)->group(function () {
                    Route::get('/', 'index')->name('index');
                    Route::get('/create', 'create')->name('create');
                    Route::get('/{menu}/edit', 'edit')->name('edit');
                    Route::post('/store', 'store')->name('store');
                    Route::post('/update', 'update')->name('update');
                    Route::post('/status', 'menuStatus')->name('status');
                    Route::get('/getCats', 'getCats')->name('getCats');
                    Route::get('/getFoods', 'getFoods')->name('getFoods');
                    // Route::get('softDelete/{id}', 'softDelete');
                    // Route::get('delete/{id}', 'destroy');
                    // Route::get('/trashed', 'trashed')->name('trashed');
                    // Route::get('/restore/{id}', 'restore')->name('restore');
                    // Route::get('/restore-all', 'restoreAll'])->name('restore');
                });
            });
            ########################### orders ###############################################
        });
        ########################### End Protected Routes #####################################
    }
);
