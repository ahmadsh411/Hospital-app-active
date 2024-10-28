<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SendingReceptMail extends Mailable
{
    use Queueable, SerializesModels;

    protected $recept;
    protected $Account;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct( $recept,$Account)
    {
        $this->recept=$recept;
        $this->Account=$Account;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $subject="Sending Recept Notification";
        return $this->subject($subject)
        ->view('emails.sendRecept')->with(['recept'=>$this->recept,'Account'=>$this->Account]);
    }
}
