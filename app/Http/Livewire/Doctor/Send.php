<?php

namespace App\Http\Livewire\Doctor;

use App\Models\Conversations\Conversation;
use App\Models\Messages\Chat;
use Livewire\Component;

class Send extends Component
{
    public $listeners = ['load_conversationDoctor'];
    public $conversation;
    public $messages = [];
    public $messageContent; // محتوى الرسالة المكتوبة
    public $email; // البريد الإلكتروني للمستلم

    public function send_messageDoctor($email)
    {
        if ($this->conversation && $this->messageContent) {
            // إنشاء رسالة جديدة
            Chat::create([
                'sender_email' => auth('doctor')->user()->email,
                'resiver_email' => $email,
                'conversation_id' => $this->conversation->id,
                'body' => $this->messageContent
            ]);

            // تحديث الرسائل بعد الإرسال
            $this->loadMessages(); // استدعاء دالة تحميل الرسائل لتحديث العرض
            $this->messageContent = ''; // إعادة تعيين الحقل بعد الإرسال
        }
    }

    public function load_conversationDoctor(Conversation $conversation)
    {
        $this->conversation = $conversation;
        $this->loadMessages(); // تحميل الرسائل مباشرة عند تحميل المحادثة
    }

    public function loadMessages()
    {
        $this->messages = $this->conversation->messages()->orderBy('created_at', 'asc')->get();
    }

    public function render()
    {
        return view('livewire.doctor.send')->extends('Dashboard.layouts.Doctor.master_doctor');
    }
}

