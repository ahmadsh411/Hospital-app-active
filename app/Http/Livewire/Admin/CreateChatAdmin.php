<?php

namespace App\Http\Livewire\Admin;

use App\Models\Conversations\Conversation;
use App\Models\Doctors\Doctor;
use App\Models\Messages\Chat;
use App\Models\Staffs\Staff;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class CreateChatAdmin extends Component
{
    public $staffs;
    public $doctors;
    public $email;

    public  function createConversationAdmin($email)
    {
        try {

            DB::beginTransaction();

            //            create_conversation;
            $this->email = $email;



            // التحقق من تسجيل دخول المستخدم
            $userEmail = auth('admin')->user()->email ?? null;
            if (!$userEmail) {
                // التعامل مع حالة عدم تسجيل الدخول (إذا لزم الأمر)
                return;
            }


            // التحقق من وجود المحادثة
            $conv = Conversation::where(function ($query) use ($email, $userEmail) {
                $query->where('sender_email', $email)->where('resiver_email', $userEmail);
            })->orWhere(function ($query) use ($email, $userEmail) {
                $query->where('resiver_email', $email)->where('sender_email', $userEmail);
            })->first();


            // إذا لم توجد محادثة، يتم إنشاؤها
            if (!$conv) {
                $conv=  Conversation::create([
                    'sender_email' => auth('admin')->user()->email,
                    'resiver_email' => $email,
                ]);
            }

            //create message

            Chat::create([
                'conversation_id' => $conv->id,
                'sender_email' => $userEmail,
                'resiver_email' => $email,
                'read'=>0,
                'body'=>'هاي',
            ]);



            DB::commit();


        }catch (\Exception $exception) {
            return $exception->getMessage();
        }

    }


    public function render()
    {
        if(auth('admin')->user()){
             $this->doctors=Doctor::all();
             $this->staffs=Staff::all();
        }
        return view('livewire.admin.create-chat-admin')->extends('Dashboard.layouts.Admin.master');
    }
}
