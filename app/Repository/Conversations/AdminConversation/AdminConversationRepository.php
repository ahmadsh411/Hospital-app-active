<?php

namespace App\Repository\Conversations\AdminConversation;

use App\Events\sendMessage;
use App\Interfaces\Conversations\AdminConversation\AdminConversationInterface;
use App\Models\Conversations\Conversation;
use App\Models\Doctors\Doctor;
use App\Models\Messages\Chat;
use App\Models\Notifications\Notification;
use App\Models\Staffs\Staff;
use Exception;
use GuzzleHttp\Psr7\Message;
use Illuminate\Support\Facades\DB;

class AdminConversationRepository implements AdminConversationInterface
{
    //Admin

    public function index()
    {

        $doctors = Doctor::all();
        $staffs = Staff::all();

        return view('Dashboard.Conversations.Admin.index', compact('doctors', 'staffs'));
    }

    public function show($email)
    {

        // البحث عن الطبيب باستخدام البريد الإلكتروني
        $doctor = Doctor::where('email', $email)->first();
        if($doctor){
        $adminEmail = auth('admin')->user()->email;
            $doctorEmail = $doctor->email;


            // التحقق من وجود محادثة بغض النظر عن ترتيب الأطراف
            $conv = Conversation::where(function ($query) use ($adminEmail, $doctorEmail) {
                $query->where('sender_email', $adminEmail)
                    ->where('resiver_email', $doctorEmail);
            })->orWhere(function ($query) use ($adminEmail, $doctorEmail) {
                $query->where('sender_email', $doctorEmail)
                    ->where('resiver_email', $adminEmail);
            })->first();


            if($conv){
                $messages=Chat::where('resiver_email',auth('admin')
                ->user()->email)->where('conversation_id',$conv->id)->get();

                foreach($messages as $message){
                    $message->read=1;
                    $message->save();
                }
            }
            if (!$conv) {
                $conv = Conversation::create([
                    'sender_email' => $adminEmail,
                    'resiver_email' => $doctorEmail,
                ]);
            }

            $messages = Chat::where('sender_email', $doctor->email)->where('conversation_id',$conv->id)
                ->orWhere('resiver_email', $doctor->email)
                ->orderBy('created_at', 'asc')
                ->get();



            // إذا لم تكن المحادثة موجودة، يتم إنشاؤها



            return view('Dashboard.Conversations.Admin.show', compact('doctor', 'messages', 'conv'));

        }



        // البحث عن الموظف باستخدام البريد الإلكتروني
        $staff = Staff::where('email', $email)->first();

        if ($staff) {
        $adminEmail = auth('admin')->user()->email;
        $staffEmail = $staff->email;

        $conv = Conversation::where(function ($querey) use ($adminEmail, $staffEmail) {
            $querey->where('sender_email', $adminEmail)->where('resiver_email', $staffEmail);
        })->Orwhere(function ($query) use ($adminEmail, $staffEmail) {
            $query->where('sender_email', $staffEmail)
                ->where('resiver_email', $adminEmail);
        })->first();

        if($conv){
            $messages=Chat::where('resiver_email',auth('admin')
            ->user()->email)->where('conversation_id',$conv->id)->get();

            foreach($messages as $message){
                $message->read=1;
                $message->save();
            }
        }



        if(!$conv){

            $conv = Conversation::create([
                'sender_email' => $adminEmail,
                'resiver_email' => $staffEmail,
            ]);
        }

            $messages = Chat::where('sender_email', $staff->email)->where('conversation_id',$conv->id)
                ->orWhere('resiver_email', $staff->email)->where('conversation_id',$conv->id)
                ->orderBy('created_at', 'asc')
                ->get();


            return view('Dashboard.Conversations.Admin.show', compact('staff', 'messages', 'conv'));
        }

        // إذا لم يتم العثور على البريد الإلكتروني في كلا الجدولين، يتم إرجاع خطأ 404
        abort(404);
    }

    public function store($request, $id) {

        try{

            $message= new Chat();
            $message->sender_email=auth('admin')->user()->email;
            $message->resiver_email=$request->email;
            $message->body=$request->body;
            $message->conversation_id=$id;
            $message->read=0;
            $message->save();

            $notification = new Notification();
            $notification->user_id = $request->send_id;
            $notification->message = "رسالة جديدة";
            $notification->read_status = 0;
            $notification->save();


            event(new sendMessage(
                'رساله جديدة وصلتك',
                auth('admin')->user()->name,
                $notification->created_at->toDateTimeString(),
                $request->send_id
            ));


            return back();

        }catch(Exception $e){
           return redirect()->back()->withErrors(['error'=>$e->getMessage()]);
        }

    }

    public function lastconversation()
    {
        $conv = Conversation::where(function ($query) {
            $query->where('sender_email', auth('admin')->user()->email);
        })
            ->orWhere(function ($query) {
                $query->where('resiver_email', auth('admin')->user()->email);
            })
            ->orderBy('created_at', 'desc') // ترتيب المحادثات من الأحدث إلى الأقدم
            ->take(25) // جلب آخر 10 محادثات فقط
            ->get();

        return view('Dashboard.Conversations.Admin.chat_box', compact('conv'));
    }



    public function showAjax($email)
    {
        // البحث عن الطبيب باستخدام البريد الإلكتروني
        $doctor = Doctor::where('email', $email)->first();
        if ($doctor) {
            $adminEmail = auth('admin')->user()->email;
            $doctorEmail = $doctor->email;

            $conv = Conversation::where(function ($query) use ($adminEmail, $doctorEmail) {
                $query->where('sender_email', $adminEmail)
                    ->where('resiver_email', $doctorEmail);
            })->orWhere(function ($query) use ($adminEmail, $doctorEmail) {
                $query->where('sender_email', $doctorEmail)
                    ->where('resiver_email', $adminEmail);
            })->first();

            if ($conv) {
                $messages = Chat::where('resiver_email', auth('admin')->user()->email)
                    ->where('conversation_id', $conv->id)
                    ->get();
                foreach ($messages as $message) {
                    $message->read = 1;
                    $message->save();
                }
            }

            if (!$conv) {
                $conv = Conversation::create([
                    'sender_email' => $adminEmail,
                    'resiver_email' => $doctorEmail,
                ]);
            }

            $messages = Chat::where('conversation_id', $conv->id)
                ->orderBy('created_at', 'asc')
                ->get();

            $html = view('Dashboard.Conversations.Admin.messages', compact('doctor', 'messages', 'conv'))->render();
            return response()->json(['html' => $html]); // تأكد أن المفتاح html هو الأساسي
        }

        // البحث عن الموظف باستخدام البريد الإلكتروني
        $staff = Staff::where('email', $email)->first();
        if ($staff) {
            $adminEmail = auth('admin')->user()->email;
            $staffEmail = $staff->email;

            $conv = Conversation::where(function ($query) use ($adminEmail, $staffEmail) {
                $query->where('sender_email', $adminEmail)
                    ->where('resiver_email', $staffEmail);
            })->orWhere(function ($query) use ($adminEmail, $staffEmail) {
                $query->where('sender_email', $staffEmail)
                    ->where('resiver_email', $adminEmail);
            })->first();

            if ($conv) {
                $messages = Chat::where('resiver_email', auth('admin')->user()->email)
                    ->where('conversation_id', $conv->id)
                    ->get();
                foreach ($messages as $message) {
                    $message->read = 1;
                    $message->save();
                }
            }

            if (!$conv) {
                $conv = Conversation::create([
                    'sender_email' => $adminEmail,
                    'resiver_email' => $staffEmail,
                ]);
            }

            $messages = Chat::where('conversation_id', $conv->id)
                ->orderBy('created_at', 'asc')
                ->get();

            $html = view('Dashboard.Conversations.Admin.messages', compact('staff', 'messages', 'conv'))->render();
            return response()->json(['html' => $html]); // تأكد من المفتاح
        }

        return response()->json(['error' => 'Not found'], 404);
    }


}
