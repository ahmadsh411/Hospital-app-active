<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class laboratory_event implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public  $message;
    public $doctor_id;
    public $patient;
    public $description;
    public function __construct($message, $doctor_id, $patient, $description)
    {
       $this->message = $message;
       $this->doctor_id = $doctor_id;
       $this->patient = $patient;
       $this->description = $description;
    }


    public function broadcastOn()
    {
        return new PrivateChannel('laboratory.'.$this->doctor_id);
    }
    public function broadcastAs()
    {
        return 'laboratory';
    }
}
