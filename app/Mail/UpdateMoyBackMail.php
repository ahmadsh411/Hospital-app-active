<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class UpdateMoyBackMail extends Mailable
{
    use Queueable, SerializesModels;
    protected $payment;
    protected $rest;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($payment,$rest)
    {
        $this->payment=$payment;
        $this->rest=$rest;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $subject="Update Payment";
        return $this->subject($subject)
        ->view('emails.UpdateMoyBack')->with(
            ['payment'=>$this->payment,
            'rest'=>$this->rest
            ]
        );
    }
}
