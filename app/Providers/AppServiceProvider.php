<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use Hashids\Hashids;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(Hashids::class, function () {
            return new Hashids(env('HASHIDS_SALT'), 10);
        });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
