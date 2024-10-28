<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class PasswordChangedMail extends Mailable
{
    use Queueable, SerializesModels;

    public $doctor;
    protected $password;
    protected $verificationcode;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($doctor,$password)
    {
        $this->doctor = $doctor;
        $this->password=$password;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('std.ahmad.shehade@gmail.com.com')
            ->subject('Password Changed Notification')
            ->view('emails.password_changed')
            ->with([
                'doctorName' => $this->doctor->name,
                'newPassword' => $this->password,

            ]);
    }
}
