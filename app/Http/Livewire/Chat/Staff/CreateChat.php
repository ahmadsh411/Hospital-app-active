<?php

namespace App\Http\Livewire\Chat\Staff;

use App\Models\Admin;
use App\Models\Conversations\Conversation;
use App\Models\Doctors\Doctor;
use App\Models\Messages\Chat;

use App\Models\Staffs\Staff;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class CreateChat extends Component
{
   public $doctors;
   public $admins;
   public $email;
   public $staffs;



    public function createConversation($email)
    {
        try {

            DB::beginTransaction();

                    //            create_conversation;
            $this->email = $email;

            // التحقق من تسجيل دخول المستخدم
            $userEmail = auth('staff')->user()->email ?? null;
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
                    'sender_email' => auth('staff')->user()->email,
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
        if(auth('staff')->user()){
            $this->doctors = Doctor::all();
            $this->admins = Admin::all();
            $this->staffs = Staff::where('id','!=',auth('staff')->user()->id)->get();


        }

        return view('livewire.chat.Staff.create-chat')->extends('Dashboard.layouts.Staff.master_staff');
    }


}
