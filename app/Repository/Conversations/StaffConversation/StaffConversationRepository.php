<?php

namespace  App\Repository\Conversations\StaffConversation;


use App\Events\sendMessage;
use App\Interfaces\Conversations\StaffConversation\StaffConversationInterface;
use App\Models\Admin;
use App\Models\Conversations\Conversation;
use App\Models\Doctors\Doctor;
use App\Models\Messages\Chat;
use App\Models\Notifications\Notification;
use App\Models\Staffs\Staff;
use Exception;
use Illuminate\Support\Facades\DB;

class StaffConversationRepository implements StaffConversationInterface
{

    public function index()
    {
        $admins=Admin::all();
        $doctors=Doctor::all();
        $staffs=Staff::where('id','!=',auth('staff')->user()->id)->get();
        return view('Dashboard.Conversations.Staffs.index',
            compact('admins','doctors','staffs'));

    }

    public function show($email)
    {

        // البحث عن الطبيب باستخدام البريد الإلكتروني
        $doctor = Doctor::where('email', $email)->first();
        if($doctor){
        $staffEmail = auth('staff')->user()->email;
            $doctorEmail = $doctor->email;


            // التحقق من وجود محادثة بغض النظر عن ترتيب الأطراف
            $conv = Conversation::where(function ($query) use ($staffEmail, $doctorEmail) {
                $query->where('sender_email', $staffEmail)
                    ->where('resiver_email', $doctorEmail);
            })->orWhere(function ($query) use ($staffEmail, $doctorEmail) {
                $query->where('sender_email', $doctorEmail)
                    ->where('resiver_email', $staffEmail);
            })->first();


            if($conv){
                $messages=Chat::where('resiver_email',auth('staff')
                ->user()->email)->where('conversation_id',$conv->id)->get();

                foreach($messages as $message){
                    $message->read=1;
                    $message->save();
                }
            }
            if (!$conv) {
                $conv = Conversation::create([
                    'sender_email' => $staffEmail,
                    'resiver_email' => $doctorEmail,
                ]);
            }

            $messages = Chat::where('sender_email', $doctor->email)->where('conversation_id',$conv->id)
                ->orWhere('resiver_email', $doctor->email)->where('conversation_id',$conv->id)
                ->orderBy('created_at', 'asc')
                ->get();



            // إذا لم تكن المحادثة موجودة، يتم إنشاؤها



            return view('Dashboard.Conversations.Staffs.show', compact('doctor', 'messages', 'conv'));

        }



        // البحث عن الموظف باستخدام البريد الإلكتروني
        $admin = Admin::where('email', $email)->first();

        if ($admin) {
        $staffEmail = auth('staff')->user()->email;
        $adminEmail = $admin->email;

        $conv = Conversation::where(function ($querey) use ($adminEmail, $staffEmail) {
            $querey->where('sender_email', $adminEmail)->where('resiver_email', $staffEmail);
        })->Orwhere(function ($query) use ($adminEmail, $staffEmail) {
            $query->where('sender_email', $staffEmail)
                ->where('resiver_email', $adminEmail);
        })->first();

        if($conv){
            $messages=Chat::where('resiver_email',$staffEmail)->where('conversation_id',$conv->id)->get();

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

            $messages = Chat::where('sender_email', $admin->email)->where('conversation_id',$conv->id)
                ->orWhere('resiver_email', $admin->email)->where('conversation_id',$conv->id)
                ->orderBy('created_at', 'asc')
                ->get();


            return view('Dashboard.Conversations.Staffs.show', compact('admin', 'messages', 'conv'));
        }

        $staff=Staff::where('email',$email)->first();
        if($staff){
            $staffEmail_S=auth('staff')->user()->email;
            $staffEmail_R=$staff->email;

            $conv = Conversation::where(function ($querey) use ($staffEmail_S, $staffEmail_R) {
                $querey->where('sender_email', $staffEmail_S)->where('resiver_email', $staffEmail_R);
            })->Orwhere(function ($query) use ($staffEmail_S, $staffEmail_R) {
                $query->where('sender_email', $staffEmail_R)
                    ->where('resiver_email', $staffEmail_S);
            })->first();

            if($conv){
                $messages=Chat::where('resiver_email',auth('staff')->user()->email)->where('conversation_id',$conv->id)->get();
                foreach($messages as $message){
                    $message->read=1;
                    $message->save();
                }
            }

            if(!$conv){
                $conv=Conversation::create([
                    'sender_email'=>auth('staff')->user()->email,
                    'resiver_email'=>$staff->email,
                ]);
            }

            $messages=Chat::where('sender_email',auth('staff')->user()->email)->where('conversation_id',$conv->id)
                ->Orwhere('resiver_email',auth('staff')->user()->email)->
                 where('conversation_id',$conv->id)
                 ->orderBy('created_at', 'asc')
                 ->get();


            return view('Dashboard.Conversations.Staffs.show', compact('staff', 'messages', 'conv'));



        }



        // إذا لم يتم العثور على البريد الإلكتروني في كلا الجدولين، يتم إرجاع خطأ 404
        abort(404);
    }

    public function store($request, $id)
    {

        try {
            DB::beginTransaction();

            $message = new Chat();
            $message->sender_email = auth('staff')->user()->email;
            $message->resiver_email = $request->email;
            $message->body = $request->body;
            $message->conversation_id = $id;
            $message->read = 0;
            $message->save();

            $notification = new Notification();
            $notification->user_id = $request->send_id;
            $notification->message = "رسالة جديدة";
            $notification->read_status = 0;
            $notification->save();

            event(new sendMessage(
                'رساله جديدة وصلتك',
                auth('staff')->user()->name,
                $notification->created_at->toDateTimeString(),
                $request->send_id
            ));

            DB::commit();

            return back();
        } catch (Exception $e) {
            DB::rollBack();
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }


    public function lastconversation()
    {
        $conv = Conversation::where(function ($query) {
            $query->where('sender_email', auth('staff')->user()->email);
        })
            ->orWhere(function ($query) {
                $query->where('resiver_email', auth('staff')->user()->email);
            })
            ->orderBy('created_at', 'desc') // ترتيب المحادثات من الأحدث إلى الأقدم
            ->take(25) // جلب آخر 10 محادثات فقط
            ->get();

        return view('Dashboard.Conversations.Staffs.chat_box', compact('conv'));
    }


    public function showAjax($email)
    {
        // البحث عن المدير باستخدام البريد الإلكتروني

        // البحث عن المدير باستخدام البريد الإلكتروني
        // البحث عن الطبيب باستخدام البريد الإلكتروني
        $doctor = Doctor::where('email', $email)->first();
        if($doctor){
            $staffEmail = auth('staff')->user()->email;
            $doctorEmail = $doctor->email;


            // التحقق من وجود محادثة بغض النظر عن ترتيب الأطراف
            $conv = Conversation::where(function ($query) use ($staffEmail, $doctorEmail) {
                $query->where('sender_email', $staffEmail)
                    ->where('resiver_email', $doctorEmail);
            })->orWhere(function ($query) use ($staffEmail, $doctorEmail) {
                $query->where('sender_email', $doctorEmail)
                    ->where('resiver_email', $staffEmail);
            })->first();


            if($conv){
                $messages=Chat::where('resiver_email',auth('staff')
                    ->user()->email)->where('conversation_id',$conv->id)->get();

                foreach($messages as $message){
                    $message->read=1;
                    $message->save();
                }
            }
            if (!$conv) {
                $conv = Conversation::create([
                    'sender_email' => $staffEmail,
                    'resiver_email' => $doctorEmail,
                ]);
            }

            $messages = Chat::where('sender_email', $doctor->email)->where('conversation_id',$conv->id)
                ->orWhere('resiver_email', $doctor->email)->where('conversation_id',$conv->id)
                ->orderBy('created_at', 'asc')
                ->get();



            // إذا لم تكن المحادثة موجودة، يتم إنشاؤها



            $html = view('Dashboard.Conversations.Staffs.messages', compact('doctor', 'messages', 'conv'))->render();
            return response()->json(['html' => $html]); // تأكد من المفتاح
        }
        // البحث عن الموظف باستخدام البريد الإلكتروني
        $admin = Admin::where('email', $email)->first();
        if ($admin) {
            $staffEmail = auth('staff')->user()->email;
            $adminEmail = $admin->email;

            $conv = Conversation::where(function ($querey) use ($adminEmail, $staffEmail) {
                $querey->where('sender_email', $adminEmail)->where('resiver_email', $staffEmail);
            })->Orwhere(function ($query) use ($adminEmail, $staffEmail) {
                $query->where('sender_email', $staffEmail)
                    ->where('resiver_email', $adminEmail);
            })->first();

            if ($conv) {
                $messages = Chat::where('resiver_email', $staffEmail)->where('conversation_id', $conv->id)->get();

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

            $messages = Chat::where('sender_email', $admin->email)->where('conversation_id', $conv->id)
                ->orWhere('resiver_email', $admin->email)->where('conversation_id', $conv->id)
                ->orderBy('created_at', 'asc')
                ->get();


            $html = view('Dashboard.Conversations.Staffs.messages', compact('admin', 'messages', 'conv'))->render();
            return response()->json(['html' => $html]); // تأكد من المفتاح
            //        }

        }
        $staff=Staff::where('email',$email)->first();
        if($staff){
            $staffEmail_S=auth('staff')->user()->email;
            $staffEmail_R=$staff->email;

            $conv = Conversation::where(function ($querey) use ($staffEmail_S, $staffEmail_R) {
                $querey->where('sender_email', $staffEmail_S)->where('resiver_email', $staffEmail_R);
            })->Orwhere(function ($query) use ($staffEmail_S, $staffEmail_R) {
                $query->where('sender_email', $staffEmail_R)
                    ->where('resiver_email', $staffEmail_S);
            })->first();

            if($conv){
                $messages=Chat::where('resiver_email',auth('staff')->user()->email)->where('conversation_id',$conv->id)->get();
                foreach($messages as $message){
                    $message->read=1;
                    $message->save();
                }
            }

            if(!$conv){
                $conv=Conversation::create([
                    'sender_email'=>auth('staff')->user()->email,
                    'resiver_email'=>$staff->email,
                ]);
            }

            $messages=Chat::where('sender_email',auth('staff')->user()->email)->where('conversation_id',$conv->id)
                ->Orwhere('resiver_email',auth('staff')->user()->email)->
                where('conversation_id',$conv->id)
                ->orderBy('created_at', 'asc')
                ->get();


            $html = view('Dashboard.Conversations.staffs.messages', compact('staff', 'messages', 'conv'))->render();
            return response()->json(['html' => $html]); // تأكد من المفتاح


        }
        //للأطباء



        return response()->json(['error' => 'Not found'], 404);
    }

}
