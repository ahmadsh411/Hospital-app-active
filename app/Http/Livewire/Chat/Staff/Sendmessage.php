<?php

namespace App\Http\Livewire\Chat\Staff;

use App\Models\Conversations\Conversation;
use App\Models\Messages\Chat;
use Livewire\Component;

class Sendmessage extends Component
{
    public $listeners=['load_conversationStaff'];
    public $conversation;
    public $messages=[];

    public $messageContent; // محتوى الرسالة المكتوبة
    public $email; // البريد الإلكتروني للمستلم

    public function send_messageStaff($email)
    {
        if ($this->conversation && $this->messageContent) {
            // إنشاء رسالة جديدة
            Chat::create([
                'sender_email' => auth('staff')->user()->email,
                'resiver_email' => $email,
                'conversation_id' => $this->conversation->id,
                'body' => $this->messageContent
            ]);

            // تحديث الرسائل بعد الإرسال
            $this->loadMessages();
            $this->messageContent = ''; // إعادة تعيين الحقل بعد الإرسال
        }
    }

    public function load_conversationStaff(Conversation  $conversation){
        $this->conversation=$conversation;
        $this->loadMessages();// جلب الرسائل من الأقدم إلى الأحدث
    }

    public function loadMessages()
    {
        $this->messages = $this->conversation->messages()->orderBy('created_at', 'asc')->get();
    }
    public function render()
    {
        return view('livewire.chat.Staff.sendmessage');
    }
}
