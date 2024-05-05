<?php

namespace App\Providers;
use App\Models\Logo;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\ServiceProvider;

use Illuminate\Support\Facades\View;
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
        Paginator::useBootstrap();
        
        View::composer('adminHT/layout', function ($view) {
            $view->with('logo', Logo::get());
        });
        View::composer('interface/layout_interface', function ($view) {
            $view->with('logo', Logo::get());
        });
    }
}
