<?php

namespace App\Providers;

use App\Mail\WelcomeEmail;
use App\Providers\UserRegistrationEvent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class SendWelcomingEmail
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
     * @param  \App\Providers\UserRegistrationEvent  $event
     * @return void
     */
    public function handle(UserRegistrationEvent $event)
    {
        Mail::to($event->user)->send(new WelcomeEmail($event->user));
    }
}
