<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SendRequestLaboratory extends Mailable
{
    use Queueable, SerializesModels;


    protected $doctor;
    protected $patient; // أضف هذا المتغير

    public function __construct($doctor, $patient)
    {
        $this->doctor = $doctor;

        $this->patient = $patient; // احفظ هذا البارامتر
    }

    public function build()
    {
        $subject = "The analysis result has been issued.";
        return $this->subject($subject)
            ->view('emails.sendRequestLaboratory')
            ->with([
                'doctor' => $this->doctor->name,
                'patient' => $this->patient->name, // مرر هذا إلى الفيو
            ]);
    }
}
