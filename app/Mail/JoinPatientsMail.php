<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class JoinPatientsMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    protected $patient;
    public function __construct($patient)
    {
       $this->patient=$patient;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $subject="Your data has been entered correctly";
          return $this->subject($subject)->view('emails.joinPatients')
          ->with(['patient'=>$this->patient]);
    }
}
