<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class Create_Event implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;


    public $message;
    public $name;
    public $invoice_id;
    public $total;
    public $created_at;
    public  $doctor;
    public $doctor_id;
    public function __construct($message, $name, $invoice_id, $total, $created_at,$doctor,$doctor_id)
    {
        $this->message = $message;
        $this->name = $name;
        $this->invoice_id = $invoice_id;
        $this->total = $total;
        $this->doctor=$doctor;
        $this->created_at = $created_at;
        $this->doctor_id = $doctor_id;
    }


    public function broadcastOn()
    {
        return new PrivateChannel('create-invoice.'.$this->doctor_id);
//        return ['create-invoice'];
    }
    public function broadcastAs()
    {
        return 'create-invoice';
    }


}
