<?php

namespace App\Listeners;

use App\Events\ContactMessageSendingSuccessful;
use App\Mail\SendContactMessageToAdministrator;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Mail;

class ContactMessageSendingSuccessfulListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle(ContactMessageSendingSuccessful $event)
    {
        $email = env('CUSTOMER_CARE_EMAIL', 'admin@churchandsermons.com');

        Mail::to($email)->send(
            new SendContactMessageToAdministrator($event->message)
        );
    }
}
