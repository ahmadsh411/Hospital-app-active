<?php

namespace App\Http\Livewire\Doctor;

use App\Models\Conversations\Conversation;
use Livewire\Component;

class Listchat extends Component
{
    public $conversations = [];

    public $email;
    public $conversation;
    public  function userSelected($email )
    {
        $this->email = $email;
        $userEmail=auth('doctor')->user()->email;
        $this->conversation = Conversation::where(function ($query) use ($email, $userEmail) {
            $query->where('sender_email', $email)->where('resiver_email', $userEmail);
        })->orWhere(function ($query) use ($email, $userEmail) {
            $query->where('resiver_email', $email)->where('sender_email', $userEmail);
        })->first();

        $this->emitTo('doctor.send','load_conversationDoctor',$this->conversation);


    }
    public  function loadconversation()
    {
        if (auth('doctor')->check()) {  // تأكد من أنك تستخدم "doctor" بدلًا من "staff"
            $this->conversations = Conversation::where(function ($query) {
                $query->where('sender_email', auth('doctor')->user()->email)
                    ->orWhere('resiver_email', auth('doctor')->user()->email);
            })->orderBy('updated_at', 'desc')->get();
        }
    }

    public function render()
    {
        $this->loadconversation();
        return view('livewire.doctor.listchat')->extends('Dashboard.layouts.Doctor.master_doctor');
    }
}
