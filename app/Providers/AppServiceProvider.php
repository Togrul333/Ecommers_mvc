<?php

namespace App\Providers;

use App\Models\Product;
use App\Observers\ProductObserver;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
       Blade::directive('routeactiv',function ($route)
       {
           return "<?php echo \Illuminate\Support\Facades\Route::currentRouteNamed($route) ? 'class=\"active\"' : '' ?>";
       });

       Product::observe(ProductObserver::class);
    }
}
