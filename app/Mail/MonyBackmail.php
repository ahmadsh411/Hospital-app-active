<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class MonyBackmail extends Mailable
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
             $subject="Payment Mony From Hospital";
             return $this->subject($subject)->view('emails.MoyBack')
             ->with(['payment'=>$this->payment,'rest'=>$this->rest]);
    }
}
