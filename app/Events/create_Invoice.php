<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class create_Invoice implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public  $doctor_id;
    public $message;
    public  $total;
    public $patient;
    public $created_at;
    public function __construct($doctor_id,$message,$total,$patient,$created_at)
    {
        $this->doctor_id = $doctor_id;
        $this->message = $message;
        $this->total = $total;
        $this->patient = $patient;
        $this->created_at=$created_at;
    }


    public function broadcastOn()
    {
        return new PrivateChannel('invoices.' . $this->doctor_id);
    }


    public function broadcastAs()
    {
        return 'invoices';
    }
}
