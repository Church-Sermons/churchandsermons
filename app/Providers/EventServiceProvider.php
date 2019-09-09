<?php

namespace App\Providers;

use App\Listeners\CategoryCreationSuccessfullListener;
use App\Events\CategoryCreationSuccessfull;
use App\Events\ResouceUploadSuccessfull;
use App\Events\ResourceCreationSuccessful;
use App\Listeners\MediaLogger;
use App\Listeners\ResourceCreationSuccessfulListener;
use App\Listeners\ResourceUploadSuccessfullListener;
use Illuminate\Support\Facades\Event;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Spatie\MediaLibrary\Events\MediaHasBeenAdded;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        Registered::class => [SendEmailVerificationNotification::class],
        ResouceUploadSuccessfull::class => [
            ResourceUploadSuccessfullListener::class
        ]
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();

        //
    }
}
