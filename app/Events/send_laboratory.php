<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class send_laboratory implements  ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public  $message;
    public $section_id;
    public $doctor;
    public  $description;
    public function __construct($doctor,$section_id,$message,$description)
    {
      $this->doctor = $doctor;
      $this->section_id = $section_id;
      $this->message = $message;
      $this->description = $description;
    }


    public function broadcastOn()
    {
        return new PrivateChannel('sendlaboratory.'.$this->section_id);
    }

    public function broadcastAs()
    {
        return 'sendlaboratory';
    }
}
