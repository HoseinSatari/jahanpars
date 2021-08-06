<?php

namespace App\Listeners;

use App\Events\CreateOrder;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Melipayamak\MelipayamakApi;

class CreateOrderAdminSmsListener
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
     * @param  CreateOrder  $event
     * @return void
     */
    public function handle(CreateOrder $event)
    {

        $username = '09305257455';
        $password = '4630';
        $api = new MelipayamakApi($username,$password);
        $sms = $api->sms('soap');
        $to = $event->phoneAdmin;
        $from = '50004001257455';
        $text =
            "سفارشی در سایت ثبت شده".PHP_EOL.
            'کد سفارش :'.$event->code.PHP_EOL.
            'مبلغ :'.$event->totalprice.PHP_EOL.
            'شماره تماس :'.$event->phoneUser.PHP_EOL.
            'در تاریخ :'.$event->date
              ;
        $isFlash = false;
        $sms->send($to,$from,$text,$isFlash);
    }
}
