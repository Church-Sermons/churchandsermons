<?php

namespace App\Providers;

use App\Event;
use App\Observers\EventObserver;
use App\Observers\OrganisationObserver;
use App\Observers\ProfileObserver;
use App\Observers\ResourceObserver;
use App\Observers\ReviewObserver;
use App\Observers\UserObserver;
use App\User;
use App\Review;
use App\Organisation;
use App\Resource;
use App\Profile;
use Illuminate\Support\ServiceProvider;

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
    }
}
