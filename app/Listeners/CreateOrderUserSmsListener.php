<?php

namespace App\Listeners;

use App\Events\CreateOrder;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Melipayamak\MelipayamakApi;

class CreateOrderUserSmsListener
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
        $to = $event->phoneUser;
        $from = '50004001257455';
        $text =
            auth()->user()->name . " عزیز ".PHP_EOL.
            "سفارش شما ثبت شد منتظر تماس همکاران ما باشید".PHP_EOL.
            "کد سفارش :".$event->code.PHP_EOL.
            "مبلغ سفارش :".$event->totalprice.PHP_EOL.
            "تاریخ ثبت :".$event->date.PHP_EOL.
            "تشکر بابت خرید شما تیم جهانپارس".PHP_EOL.
            "jahanpars-elc.ir"
        ;
        $isFlash = false;
        $sms->send($to,$from,$text,$isFlash);
    }
}
