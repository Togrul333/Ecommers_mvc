<?php

namespace App\Providers;

use App\ViewComposers\BestProductsComposer;
use App\ViewComposers\CategoriesComposer;
use App\ViewComposers\CurrenciesComposer;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class ViewServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        View::composer(['master','categories'],CategoriesComposer::class);
        View::composer(['master'],CurrenciesComposer::class);
        View::composer(['master'],BestProductsComposer::class);

//        View::composer('*',CategoriesComposer::class);
//        View::composer('*',CurrenciesComposer::class);
    }
}
