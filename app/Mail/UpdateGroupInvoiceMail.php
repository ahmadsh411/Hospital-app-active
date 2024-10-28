<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class UpdateGroupInvoiceMail extends Mailable
{
    use Queueable, SerializesModels;

    protected $invoice;
    /**
     * Create a new message instance.
     *
     * @return void
     */
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
        $subject="Group Invoice By Hospital";
        return $this->subject($subject)->view('emails.UpdateGroupInvoice')->with(['invoice'=>$this->invoice]);
    }
}
