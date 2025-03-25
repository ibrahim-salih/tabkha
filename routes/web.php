<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Website\IndexController;
use App\Http\Controllers\Website\SiteMapController;
use App\Http\Controllers\Website\ConfigController;

// Route::get('/', function () {
//     return 'welcome';
// });

Route::get('/clear-route', [ConfigController::class, 'clearRoute']);
Route::get('/clear-config', [ConfigController::class, 'clearConfig']);
// //Route::get('/clear-cache', [ConfigController::class,'clearCache']);
Route::get('/clear-view', [ConfigController::class, 'clearView']);

Route::get('/', [IndexController::class, 'index'])->name('index');
Route::get('/cooked/{id}', [IndexController::class, 'cooked'])->name('cooked');
Route::get('/detail/{id}', [IndexController::class, 'detail'])->name('detail');

Route::get('/getStates', [IndexController::class , 'getStates'])->name('getStates');
Route::get('/getCities', [IndexController::class , 'getCities'])->name('getCities');
//search
Route::get('/search', [IndexController::class,'search']);
