<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SendInvoiceMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    protected  $invoice;
    public function __construct($invoice)
    {
       $this->invoice=$invoice;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $subject="Invoice By Hospital";
        return $this->subject($subject)->
        view('emails.sendInvoice')->with(['invoice'=>$this->invoice]);
    }
}
