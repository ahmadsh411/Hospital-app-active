<?php

namespace App\Http\Livewire\Admin;

use App\Events\sendMessage;
use App\Models\Conversations\Conversation;
use App\Models\Messages\Chat;
use App\Models\Notifications\Notification;
use Livewire\Component;

class SendmessageAdmin extends Component
{
    public $listeners = ['load_conversationAdmin'];
    public $conversation;
    public $messages = [];
    public $messageContent; // محتوى الرسالة المكتوبة
    public $email; // البريد الإلكتروني للمستلم
    public $send_id; // معرف المستلم

    public function send_messageAdmin($email)
    {

        if ($this->conversation && $this->messageContent) {
            // إنشاء رسالة جديدة
            Chat::create([
                'sender_email' => auth('admin')->user()->email,
                'resiver_email' => $email,
                'conversation_id' => $this->conversation->id,
                'body' => $this->messageContent
            ]);



            // تحديث الرسائل بعد الإرسال
            $this->loadMessages();
            $this->messageContent = ''; // إعادة تعيين الحقل بعد الإرسال
        }
    }

    public function load_conversationAdmin(Conversation $conversation)
    {
        $this->conversation = $conversation;
        $this->loadMessages();
    }

    public function loadMessages()
    {
        // جلب الرسائل المرتبطة بالمحادثة بترتيب تصاعدي حسب تاريخ الإنشاء
        $this->messages = $this->conversation->messages()->orderBy('created_at', 'asc')->get();
    }

    public function render()
    {
        return view('livewire.admin.sendmessage-admin')->extends('Dashboard.layouts.Admin.master');
    }
}

