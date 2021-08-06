<?php

namespace App\Listeners;

use App\Events\ApprovedOrder;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Melipayamak\MelipayamakApi;

class ApprovedOrderUserSmsListener
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
     * @param  ApprovedOrder  $event
     * @return void
     */
    public function handle(ApprovedOrder $event)
    {
        $username = '09305257455';
        $password = '4630';
        $api = new MelipayamakApi($username,$password);
        $sms = $api->sms('soap');
        $to = $event->phone;
        $from = '50004001257455';
        $text =
           $event->name . " عزیز ".PHP_EOL.
           "سفارش شما پرداخت و تایید شد ، تیم ما در حال پردازش سفارش شما میباشند و بزودی برای شما ارسال خواهد شد".PHP_EOL.
           "کد سفارش :".$event->code.PHP_EOL.
           "مبلغ سفارش :".$event->total.PHP_EOL.
           "همچنین میتوانید در پنل کاربری بخش سفارشات وضعیت سفارش خود را مشاهده کنید یا با پشتیبانی سایت تماس حاصل فرمایید".PHP_EOL.
           "با تشکر تیم جهانپارس".PHP_EOL.
           "jahanpars-elc.ir"
        ;
        $isFlash = false;
        $sms->send($to,$from,$text,$isFlash);
    }
}
