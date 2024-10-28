<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class passwordResetmail extends Mailable
{
    use Queueable, SerializesModels;
     protected  $user;
     public $verificationcode;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($user,$verificationcode)
    {
       $this->user=$user;
       $this->verificationcode=$verificationcode;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('std.ahmad.shehade@gmail.com')
            ->subject('Password Changed Notification')
            ->view('emails.passwordReset') ->with([
                'user' => $this->user,
                'verificationcode' => $this->verificationcode,
            ]);

    }
}
