<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class Response_X_Ray extends Mailable
{
    use Queueable, SerializesModels;

    protected  $patient;
    protected $doctor;
    public function __construct($patient,$doctor)
    {
        $this->patient = $patient;
        $this->doctor = $doctor;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $subject="X-ray completion notification";
        return  $this->subject($subject)->view('emails.x_rayResponse')
            ->with('patient',$this->patient)
            ->with('doctor',$this->doctor);
    }
}
