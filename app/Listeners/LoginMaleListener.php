<?php

namespace App\Listeners;

use App\Events\LoginMailEvent;
use App\Mail\LoginMail;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class LoginMaleListener
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
     * @param  \App\Events\LoginMailEvent  $event
     * @return void
     */
    public function handle(LoginMailEvent $event)
    {
        //
            Mail::to($event->user->email)->send(new LoginMail($event->user));

    }
}
