<?php

namespace App\Providers;

use App\OrganisationCategory;
use Illuminate\Support\ServiceProvider;
use View;
class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $categories = OrganisationCategory::all();
        View::share('categories', $categories);
    }
}
