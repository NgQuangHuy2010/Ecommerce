<?php

namespace App\Providers;
use App\Models\Logo;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Auth;
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


        Blade::directive('permission', function ($permission) {
            return "<?php if (Auth::check() && Auth::user()->hasPermission({$permission})): ?>";
        });

        Blade::directive('endpermission', function () {
            return "<?php endif; ?>";
        });
    }
}
