<?php

namespace App\Providers;

use App\OrganisationCategory;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use View;
use Auth;
use DB;
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
        Schema::defaultStringLength(191);
        // @isTribrid($user) @endIsTribrid
        // custom blade directive -owner admin
        Blade::if('isTribrid', function ($model, $fk = null) {
            return $this->isTribrid($model, $fk);
        });

        // setting categories available in all views
        // check if table exists to avoid migrate reset error
        if (Schema::hasTable('categories')) {
            // get categories
            $categories = OrganisationCategory::distinctCategoryNames();
            View::share('categories', $categories);
        }

        if (Schema::hasTable('social_media')) {
            $sites = DB::table('social_media')->get();
            View::share('sites', $sites);
        }
    }

    public function isTribrid($thing, $fk = null)
    {
        if (Auth::check()) {
            $expression = Auth::user();

            $logic = $expression->hasRoleAndOwns('author', $thing, [
                'foreignKeyName' => $fk
            ]);

            if ($logic) {
                return true;
            }

            if ($expression->hasRole(['admin', 'superadmin'])) {
                return true;
            }

            return false;
        }

        return false;
    }
}
