<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class CreateOrder
{
    use Dispatchable, InteractsWithSockets, SerializesModels;
   public $phoneAdmin;
   public $phoneUser;
   public $totalprice;
   public $date;
   public $code;
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($phoneAdmin , $phoneUser , $totalprice , $date , $code)
    {
          $this->phoneAdmin = $phoneAdmin;
          $this->phoneUser = $phoneUser;
          $this->totalprice = $totalprice;
          $this->date = $date;
          $this->code = $code;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('channel-name');
    }
}
