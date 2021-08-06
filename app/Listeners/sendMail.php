<?php

namespace App\Listeners;

use App\Events\support;
use App\Mail\supportsend;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class sendMail
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
     * @param  support  $event
     * @return void
     */
    public function handle(support $event)
    {
        Mail::to($event->email)->send(new supportsend($event->subject, $event->text));

    }
}
