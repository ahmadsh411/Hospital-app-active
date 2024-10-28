<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class JoinDoctorMail extends Mailable
{
    use Queueable, SerializesModels;
    protected  $doctor;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($doctor)
    {
        $this->doctor=$doctor;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
   $subject="Hospital annexation";
       return $this->subject($subject)->view('emails.add_Doctor')->with(
        ['doctor'=>$this->doctor]
       );

    }
}
