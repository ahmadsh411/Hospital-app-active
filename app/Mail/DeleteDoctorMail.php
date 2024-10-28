<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class DeleteDoctorMail extends Mailable
{
    use Queueable, SerializesModels;

    protected $doctor;

    /**
     * Create a new message instance.
     *
     * @param $doctor
     */
    public function __construct($doctor)
    {
        $this->doctor = $doctor;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Doctor ' . $this->doctor->name . ' Removed from the Hospital')
                    ->view('emails.Delete_Doctor')
                    ->with([
                        'doctor' => $this->doctor->name,
                    ]);
    }
}
