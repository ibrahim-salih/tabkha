<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;

class ConfigController extends Controller
{
    public function clearRoute()
    {
        Artisan::call('route:clear');
        return "Route cleared successfully";
    }
    public function clearConfig()
    {
        Artisan::call('config:cache');
        return "Config cleared successfully";
    }
    public function clearCache()
    {
        Artisan::call('cache:clear');
        return "Cache cleared successfully";
    }
    public function clearView()
    {
        Artisan::call('view:clear');
        return "View cleared successfully";
    }
}
