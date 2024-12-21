<?php

namespace App\Http\Livewire\Chat\Staff;

use App\Models\Admin;
use App\Models\Conversations\Conversation;
use Livewire\Component;

class Chatlist extends Component
{
    public $conversations;
    public $email;

    public  function userSelectedstaff($email )
    {
        $this->email = $email;
        $userEmail=auth('staff')->user()->email;
        $this->conversation = Conversation::where(function ($query) use ($email, $userEmail) {
            $query->where('sender_email', $email)->where('resiver_email', $userEmail);
        })->orWhere(function ($query) use ($email, $userEmail) {
            $query->where('resiver_email', $email)->where('sender_email', $userEmail);
        })->first();

        $this->emitTo('chat.staff.sendmessage', 'load_conversationStaff', $this->conversation);


    }

    public function loadConversations()
    {
        if (auth('staff')->check()) {
            $this->conversations = Conversation::where(function ($query) {
                $query->where('sender_email', auth('staff')->user()->email)
                    ->orWhere('resiver_email', auth('staff')->user()->email);
            })->orderBy('updated_at', 'desc')->get();
        }
    }

    public function render()
    {
        $this->loadConversations();
        return view('livewire.chat.Staff.chatlist')->extends('Dashboard.layouts.Staff.master_staff');
    }
}
