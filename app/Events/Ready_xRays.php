<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class Ready_xRays implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

     public $message;
     public $patient;
     public $description;
     public $doctor_id;
    public function __construct($message, $patient, $description, $doctor_id)
    {
        $this->message = $message;
        $this->patient = $patient;
        $this->description = $description;
        $this->doctor_id = $doctor_id;
    }


    public function broadcastOn()
    {
        return new PrivateChannel('xrays.'.$this->doctor_id);
    }

    public function broadcastAs()
    {
        return 'xrays';
    }
}
