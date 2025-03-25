<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        api: __DIR__.'/../routes/api.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
        then: function(){
            Route::middleware('api')
            ->prefix('api')
            ->group(base_path('routes/api.php'));
            Route::middleware('web')
            ->prefix('dashboard')
            // ->name('dashboard')
            ->group(base_path('routes/dashboard.php'));
            Route::middleware('web')
            ->prefix('cooker')
            ->group(base_path('routes/cooker.php'));
            // Route::middleware('web')
            // ->group(base_path('routes/web.php'));
        }
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->redirectGuestsTo(function(){
            if(request()->is('*/dashboard/*')){
                return route('dashboard.login');
            }else{
                return route('login');
            }
        });
        
        $middleware->redirectUsersTo(function(){
            if(Auth::guard('admin')->check()){
                return route('dashboard.welcome');
            }else{
                return route('dashboard.login');
            }
        });
        $middleware->redirectGuestsTo(function(){
            if(request()->is('*/cooker/*')){
                return route('cooker.login');
            }else{
                return route('cooker.login');
            }
        });
        $middleware->redirectUsersTo(function(){
            if(Auth::guard('cooker')->check()){
                return route('cooker.welcome');
            }else{
                return route('cooker.login');
            }
        });
        $middleware->alias([
            /**** OTHER MIDDLEWARE ALIASES ****/
            // 'localize'                => \Mcamara\LaravelLocalization\Middleware\LaravelLocalizationRoutes::class,
            // 'localizationRedirect'    => \Mcamara\LaravelLocalization\Middleware\LaravelLocalizationRedirectFilter::class,
            // 'localeSessionRedirect'   => \Mcamara\LaravelLocalization\Middleware\LocaleSessionRedirect::class,
            // 'localeCookieRedirect'    => \Mcamara\LaravelLocalization\Middleware\LocaleCookieRedirect::class,
            // 'localeViewPath'          => \Mcamara\LaravelLocalization\Middleware\LaravelLocalizationViewPath::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
