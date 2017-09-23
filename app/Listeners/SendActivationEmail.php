<?php

namespace App\Listeners;

use App\Notifications\SendActivationToken;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendActivationEmail
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
     * @param  $event
     * @return void
     */
    public function handle($event)
    {
        $event->user->notify(new SendActivationToken($event->user->activationToken));
        $event->user->activationToken->update(['last_mail_sent_at' => \Carbon\Carbon::now()]);
    }
}
