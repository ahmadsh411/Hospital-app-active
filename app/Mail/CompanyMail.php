<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class CompanyMail extends Mailable
{

    use Queueable, SerializesModels;


    public $companyName;
    public $status;
    public $company_rate;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($companyName, $status,$company_rate)
    {
        $this->companyName = $companyName;
        $this->status = $status;
        $this->company_rate=$company_rate;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $subject = $this->status == '1' ? 'Company Activated By The System' : 'Company Deactivated  By The System';
        return $this->view('emails.companyStatus')
            ->with([
                'companyName' => $this->companyName,
                'status' => $this->status,
                'company_rate'=>$this->company_rate
            ])
            ->subject($subject);
    }

}
