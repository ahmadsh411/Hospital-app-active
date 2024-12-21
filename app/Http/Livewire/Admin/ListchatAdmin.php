<?php

namespace App\Http\Livewire\Admin;

use App\Models\Conversations\Conversation;
use App\Models\Messages\Chat;
use Illuminate\Support\Facades\DB;
use Livewire\Component;


class ListchatAdmin extends Component
{
    public $conversations = [];
     public $email;
     public $conversation;
    public  function userSelected($email )
    {
        $this->email = $email;
        $userEmail=auth('admin')->user()->email;
        $this->conversation = Conversation::where(function ($query) use ($email, $userEmail) {
            $query->where('sender_email', $email)->where('resiver_email', $userEmail);
        })->orWhere(function ($query) use ($email, $userEmail) {
            $query->where('resiver_email', $email)->where('sender_email', $userEmail);
        })->first();

        $this->emitTo('admin.sendmessage-admin','load_conversationAdmin',$this->conversation);





    }

    public  function loadConversations()
    {
        if (auth('admin')->check()) {
            $this->conversations = Conversation::where(function ($query) {
                $query->where('sender_email', auth('admin')->user()->email)
                    ->orWhere('resiver_email', auth('admin')->user()->email);
            })->orderBy('updated_at', 'desc')->get();
        }
    }
    public function render()
    {

        $this->loadConversations();
        return view('livewire.admin.listchat-admin')->extends('Dashboard.layouts.Admin.master');
    }
}
