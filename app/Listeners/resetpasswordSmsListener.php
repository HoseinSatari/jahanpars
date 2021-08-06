<?php

namespace App\Listeners;

use App\Events\resetpasswordSms;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Melipayamak\MelipayamakApi;

class resetpasswordSmsListener
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
     * @param  resetpasswordSms  $event
     * @return void
     */
    public function handle(resetpasswordSms $event)
    {

        $username = '09305257455';
        $password = '4630';
        $api = new MelipayamakApi($username, $password);
        $smsSoap = $api->sms('soap');
        $to = $event->phone;
        $code = $event->code;
        $smsSoap->sendByBaseNumber($code, $to, '52633');
    }
}
