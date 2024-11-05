<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        \View::share('brandName', config('settings.brand_name'));
        \View::share('address', config('settings.address'));
        \View::share('clinic_phone', config('settings.clinic_phone'));
        \View::share('start_time', config('settings.start_time'));
        \View::share('end_time', config('settings.end_time'));
        \Route::aliasMiddleware('check.admin', \App\Http\Middleware\CheckAdminMiddleware::class);
    }
}
