<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class sendMessage implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $message;
    public $user;
    public $date;
    public $ids;

    public function __construct($message, $user, $date, $ids)
    {
        $this->message = $message;
        $this->user = $user;
        $this->date = $date;
        $this->ids = $ids;
    }

    public function broadcastOn()
    {
        // بث إلى قناة خاصة بناءً على البريد الإلكتروني للمستقبل
        return new PrivateChannel('sndmessage.'.$this->ids);
    }

    public function broadcastAs()
    {
        return 'sndmessage';
    }
}

