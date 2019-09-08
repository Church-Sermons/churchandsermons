<?php

namespace App\Providers;

use App\OrganisationCategory;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;
use View;
use Auth;

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
        // @isTribrid($user) @endIsTribrid
        // custom blade directive -owner admin
        Blade::if('isTribrid', function ($expression, $model, $fk = null) {
            return $this->isTribrid($expression, $model, $fk);
        });

        // setting categories available in all views
        $categories = OrganisationCategory::all();
        View::share('categories', $categories);
    }

    public function isTribrid($expression, $thing, $fk = null)
    {
        $logic = $expression->hasRoleAndOwns('author', $thing, [
            'foreignKeyName' => $fk
        ]);

        if ($logic) {
            return true;
        }

        if ($expression->hasRole(['administrator', 'superadministrator'])) {
            return true;
        }

        return false;
    }
}
