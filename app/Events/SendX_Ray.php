<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class SendX_Ray implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $message;
    public $doctor;
    public $description;
    public $section_id;
    public function __construct($doctor,$message,$description,$section_id)
    {
        $this->doctor = $doctor;
        $this->message = $message;
        $this->description = $description;
        $this->section_id = $section_id;
    }


    public function broadcastOn()
    {
        return new PrivateChannel('sendXray.'.$this->section_id);
    }

    public function broadcastAs()
    {
        return 'sendXray';
    }
}
