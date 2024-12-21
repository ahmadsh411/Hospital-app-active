<?php

namespace  App\Repository\Conversations;

use App\Events\sendMessage;
use App\Interfaces\Conversations\ConversationInterface;
use App\Models\Admin;
use App\Models\Conversations\Conversation;
use App\Models\Doctors\Doctor;
use App\Models\Messages\Chat;
use App\Models\Notifications\Notification;
use App\Models\Staffs\Staff;
use Exception;
use Illuminate\Support\Facades\DB;

class ConversationRepository implements ConversationInterface
{
    //doctors
    public function index()
    {
        $staffs = Staff::all();
        $admins = Admin::all();
        $doctors=Doctor::where('id','!=',auth('doctor')->user()->id)->get();
        return view('Dashboard.Conversations.Doctors.index', compact('admins', 'staffs','doctors'));
    }

    //send message
    public function store($request, $id)
    {
        try {
            DB::beginTransaction();

            // إنشاء رسالة جديدة
            $message = new Chat();
            $message->sender_email = auth('doctor')->user()->email;
            $message->resiver_email = $request->email;
            $message->body = $request->body;
            $message->conversation_id = $id;
            $message->read = 0;
            $message->save();

            // الحصول على المحادثة الحالية
            $conv = Conversation::findOrFail($id);


            // إنشاء إشعار جديد للمستخدم المستهدف
            $notification = new Notification();
            $notification->user_id = $request->send_id;
            $notification->message = $notification->message = "رسالة جديدة";
            $notification->read_status = 0;
            $notification->save();



            // إرسال الحدث عبر Pusher إلى المستخدم المستهدف
            event(new sendMessage(
                $message->sender_email  ,                     // محتوى الرسالة
                auth('doctor')->user()->name,               // مرسل الرسالة
                $notification->created_at->toDateTimeString(), // وقت الإرسال
                $request->send_id   ,
            // معرف المستخدم المستهدف
            ));

            DB::commit();
            return back();

        } catch (Exception $e) {
            DB::rollBack();
            return back()->withErrors(['error' => $e->getMessage()]);
        }
    }


    public function create()
    {
        // TODO: Implement create() method.
    }

    public function update($id, $request)
    {
        // TODO: Implement update() method.
    }

    public function destroy($id)
    {
        // TODO: Implement destroy() method.
    }
    public function show($email)
    {
        // البحث عن المدير باستخدام البريد الإلكتروني
        $admin = Admin::where('email', $email)->first();
        if ($admin) {
        $adminEmail = $admin->email;
        $doctorEmail = auth('doctor')->user()->email;

        // التحقق من وجود محادثة بغض النظر عن ترتيب الأطراف
        $conv = Conversation::where(function ($query) use ($adminEmail, $doctorEmail) {
            $query->where('sender_email', $adminEmail)
                ->where('resiver_email', $doctorEmail);
        })->orWhere(function ($query) use ($adminEmail, $doctorEmail) {
            $query->where('sender_email', $doctorEmail)
                ->where('resiver_email', $adminEmail);
        })->first();

        if($conv){
            $messages=Chat::where('resiver_email',auth('doctor')
            ->user()->email)->where('conversation_id',$conv->id)->get();

            foreach($messages as $message){
                $message->read=1;
                $message->save();
            }
        }
        if (!$conv) {
            $conv = Conversation::create([
                'sender_email' => $doctorEmail,
                'resiver_email' => $adminEmail,
            ]);
        }



            $messages = Chat::where('sender_email', $admin->email)->where('conversation_id',$conv->id)
                ->orWhere('resiver_email', $admin->email)->where('conversation_id',$conv->id)
                ->orderBy('created_at', 'asc')
                ->get();

            return view('Dashboard.Conversations.Doctors.show', compact('admin', 'messages','conv'));
        }


        // البحث عن الموظف باستخدام البريد الإلكتروني
        $staff = Staff::where('email', $email)->first();
        if ($staff)
        {
        $doctorEmail = auth('doctor')->user()->email;
        $staffEmail = $staff->email;

        $conv = Conversation::where(function ($querey) use ($doctorEmail, $staffEmail) {
            $querey->where('sender_email', $doctorEmail)->where('resiver_email', $staffEmail);
        })->Orwhere(function ($query) use ($doctorEmail, $staffEmail) {
            $query->where('sender_email', $staffEmail)
                ->where('resiver_email', $doctorEmail);
        })->first();

        if($conv){
            $messages=Chat::where('resiver_email',auth('doctor')
            ->user()->email)->where('conversation_id',$conv->id)->get();

            foreach($messages as $message){
                $message->read=1;
                $message->save();
            }
        }



        if(!$conv){

            $conv = Conversation::create([
                'sender_email' => $doctorEmail,
                'resiver_email' => $staffEmail,
            ]);
        }


            $messages = Chat::where('sender_email', $staff->email)->where('conversation_id',$conv->id)
                ->orWhere('resiver_email', $staff->email)->where('conversation_id',$conv->id)
                ->orderBy('created_at', 'asc')
                ->get();


            return view('Dashboard.Conversations.Doctors.show', compact('staff', 'messages','conv'));
        }


        //للأطباء

        $doctor=Doctor::where('email',$email)->first();
        if($doctor){
            $doctorEmail_R=$doctor->email;
            $doctorEmail_S=auth('doctor')->user()->email;

            $conv=Conversation::where(function($query) use($doctorEmail_S,$doctorEmail_R){
                 $query->where('sender_email',$doctorEmail_S)->where('resiver_email',$doctorEmail_R);
            })->Orwhere(function($query) use($doctorEmail_R,$doctorEmail_S){
                $query->where('sender_email',$doctorEmail_R)->where('resiver_email',$doctorEmail_S);
            })->first();

            if(!$conv){
                $conv=Conversation::create([
                    'sender_email' => $doctorEmail_S,
                     'resiver_email' => $doctorEmail_R,
                ]);
            }

            if($conv){
                $messages=Chat::where('resiver_email',auth('doctor')
                ->user()->email)->where('conversation_id',$conv->id)->get();

                foreach($messages as $message){
                    $message->read=1;
                    $message->save();
                }
            }

            $messages=Chat::where('sender_email',auth('doctor')->user()->email)->where('conversation_id',$conv->id)
            ->Orwhere('resiver_email',auth('doctor')->user()->email)->where('conversation_id',$conv->id)
              ->orderBy('created_at', 'asc')
             ->get();

             return view('Dashboard.Conversations.Doctors.show', compact('doctor', 'messages','conv'));

        }


        // إذا لم يتم العثور على البريد الإلكتروني في كلا الجدولين، يتم إرجاع خطأ 404
        abort(404);
    }


    public function lastconversation()
    {
        $conv = Conversation::where(function ($query) {
            $query->where('sender_email', auth('doctor')->user()->email);
        })
            ->orWhere(function ($query) {
                $query->where('resiver_email', auth('doctor')->user()->email);
            })
            ->orderBy('created_at', 'desc') // ترتيب المحادثات من الأحدث إلى الأقدم
            ->take(25) // جلب آخر 10 محادثات فقط
            ->get();

        return view('Dashboard.Conversations.Doctors.chat_box', compact('conv'));
    }



    public function showAjax($email)
    {
        // البحث عن المدير باستخدام البريد الإلكتروني

        // البحث عن المدير باستخدام البريد الإلكتروني
        $admin = Admin::where('email', $email)->first();
        if ($admin) {
            $adminEmail = $admin->email;
            $doctorEmail = auth('doctor')->user()->email;

            // التحقق من وجود محادثة بغض النظر عن ترتيب الأطراف
            $conv = Conversation::where(function ($query) use ($adminEmail, $doctorEmail) {
                $query->where('sender_email', $adminEmail)
                    ->where('resiver_email', $doctorEmail);
            })->orWhere(function ($query) use ($adminEmail, $doctorEmail) {
                $query->where('sender_email', $doctorEmail)
                    ->where('resiver_email', $adminEmail);
            })->first();

            if ($conv) {
                $messages = Chat::where('resiver_email', auth('doctor')
                    ->user()->email)->where('conversation_id', $conv->id)->get();

                foreach ($messages as $message) {
                    $message->read = 1;
                    $message->save();
                }
            }
            if (!$conv) {
                $conv = Conversation::create([
                    'sender_email' => $doctorEmail,
                    'resiver_email' => $adminEmail,
                ]);
            }


            $messages = Chat::where('sender_email', $admin->email)->where('conversation_id', $conv->id)
                ->orWhere('resiver_email', $admin->email)->where('conversation_id', $conv->id)
                ->orderBy('created_at', 'asc')
                ->get();

            $html = view('Dashboard.Conversations.Admin.messages', compact('admin', 'messages', 'conv'))->render();
            return response()->json(['html' => $html]); // تأكد من المفتاح       }
        }

        // البحث عن الموظف باستخدام البريد الإلكتروني
        $staff = Staff::where('email', $email)->first();
        if ($staff) {
            $doctorEmail = auth('doctor')->user()->email;
            $staffEmail = $staff->email;

            $conv = Conversation::where(function ($querey) use ($doctorEmail, $staffEmail) {
                $querey->where('sender_email', $doctorEmail)->where('resiver_email', $staffEmail);
            })->Orwhere(function ($query) use ($doctorEmail, $staffEmail) {
                $query->where('sender_email', $staffEmail)
                    ->where('resiver_email', $doctorEmail);
            })->first();

            if ($conv) {
                $messages = Chat::where('resiver_email', auth('doctor')
                    ->user()->email)->where('conversation_id', $conv->id)->get();

                foreach ($messages as $message) {
                    $message->read = 1;
                    $message->save();
                }
            }


            if (!$conv) {

                $conv = Conversation::create([
                    'sender_email' => $doctorEmail,
                    'resiver_email' => $staffEmail,
                ]);
            }


            $messages = Chat::where('sender_email', $staff->email)->where('conversation_id', $conv->id)
                ->orWhere('resiver_email', $staff->email)->where('conversation_id', $conv->id)
                ->orderBy('created_at', 'asc')
                ->get();


            $html = view('Dashboard.Conversations.Doctors.messages', compact('staff', 'messages', 'conv'))->render();
            return response()->json(['html' => $html]); // تأكد من المفتاح        }

        }
        //للأطباء

        $doctor=Doctor::where('email',$email)->first();
        if($doctor){
            $doctorEmail_R=$doctor->email;
            $doctorEmail_S=auth('doctor')->user()->email;

            $conv=Conversation::where(function($query) use($doctorEmail_S,$doctorEmail_R){
                $query->where('sender_email',$doctorEmail_S)->where('resiver_email',$doctorEmail_R);
            })->Orwhere(function($query) use($doctorEmail_R,$doctorEmail_S){
                $query->where('sender_email',$doctorEmail_R)->where('resiver_email',$doctorEmail_S);
            })->first();

            if(!$conv){
                $conv=Conversation::create([
                    'sender_email' => $doctorEmail_S,
                    'resiver_email' => $doctorEmail_R,
                ]);
            }

            if($conv){
                $messages=Chat::where('resiver_email',auth('doctor')
                    ->user()->email)->where('conversation_id',$conv->id)->get();

                foreach($messages as $message){
                    $message->read=1;
                    $message->save();
                }
            }

            $messages=Chat::where('sender_email',auth('doctor')->user()->email)->where('conversation_id',$conv->id)
                ->Orwhere('resiver_email',auth('doctor')->user()->email)->where('conversation_id',$conv->id)
                ->orderBy('created_at', 'asc')
                ->get();

            $html = view('Dashboard.Conversations.Doctors.messages', compact('doctor', 'messages', 'conv'))->render();
            return response()->json(['html' => $html]); // تأكد من المفتاح
        }

        return response()->json(['error' => 'Not found'], 404);
    }


}
