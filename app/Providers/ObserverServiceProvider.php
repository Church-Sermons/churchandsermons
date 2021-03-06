<?php

namespace App\Providers;

use App\Event;
use App\Observers\CategoryObserver;
use App\Observers\EventObserver;
use App\Observers\OrganisationObserver;
use App\Observers\ProfileObserver;
use App\Observers\ResourceObserver;
use App\Observers\ReviewObserver;
use App\Observers\SermonObserver;
use App\Observers\UserObserver;
use App\User;
use App\Review;
use App\Organisation;
use App\OrganisationCategory;
use App\Resource;
use App\Profile;
use App\Sermon;
use Illuminate\Support\ServiceProvider;
use Illuminate\Container\Container;
use Illuminate\Events\Dispatcher;
use Illuminate\Database\Eloquent\Model;

class ObserverServiceProvider extends ServiceProvider
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
        User::observe(UserObserver::class);
        Review::observe(ReviewObserver::class);
        Organisation::observe(OrganisationObserver::class);
        Profile::observe(ProfileObserver::class);
        Resource::observe(ResourceObserver::class);
        Event::observe(EventObserver::class);
        OrganisationCategory::observe(CategoryObserver::class);
        Sermon::observe(SermonObserver::class);
    }
}
