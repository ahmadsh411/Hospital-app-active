<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ActivationDoctorMail extends Mailable
{
    use Queueable, SerializesModels;
    protected $doctor;
    protected $status;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($doctor,$status)
    {
        $this->doctor=$doctor;
        $this->status=$status;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('std.ahmad.shehade@gmail.com')
            ->subject('Activation Doctor Notification')
            ->view('emails.Activation_Doctor')->with(
              [  'doctor_name' => $this->doctor->name,
                'status' => $this->status==0?"Inactive":"Active",]

            );
    }
}
