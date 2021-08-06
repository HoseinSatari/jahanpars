<?php

namespace App\Listeners;

use App\Events\resetpasswordEmail;
use App\Mail\supportsend;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class resetpasswordEmailListener
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
     * @param  resetpasswordEmail  $event
     * @return void
     */
    public function handle(resetpasswordEmail $event)
    {
        Mail::to($event->email)->send(new supportsend('تایید کد', $event->code));
    }
}
