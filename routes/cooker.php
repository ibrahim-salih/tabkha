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
        Route::get('terms', [AuthController::class , 'terms'])->name('terms')->middleware('guest:cooker');
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
            Route::get('/cooker-password', [ProfileController::class, 'password'])->name('cooker-password');
            Route::get('/cooker-details', [ProfileController::class, 'profile'])->name('cooker-details');
            Route::post('/update-profile', [ProfileController::class, 'updateProfile']);
            Route::post('/update-password', [ProfileController::class, 'updatePassword']);
            ########################### menu ##############################################
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
            ########################### orders ##############################################
            
        });
        ########################### End Protected Routes #####################################
    }
);
