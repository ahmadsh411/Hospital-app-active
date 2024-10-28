<?php

namespace App\Http\Controllers;

use App\Models\Email;
use Webklex\IMAP\Facades\Client;

use Carbon\Carbon; // لإدارة التواريخ بشكل صحيح
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Symfony\Component\Console\Input\Input;
use Webklex\PHPIMAP\Exceptions\MessageNotFoundException;

class EmailController extends Controller
{







 

    public function fetchInboxMessages()
    {
        // الاتصال بحساب IMAP
        $client = Client::account('default');
        $client->connect();

        // الوصول إلى صندوق الوارد (INBOX)
        $folder = $client->getFolder('INBOX');

        // جلب الرسائل غير المقروءة
        $messages = $folder->messages()->unseen()->get();

        $conversations = []; // مصفوفة لتجميع المحادثات حسب الأطراف

        // معالجة كل رسالة
        foreach ($messages as $message) {
            // معلومات عن المرسل والمستلم
            $from = $message->getFrom()[0]->mail;
            $to = $message->getTo()[0]->mail ?? 'N/A';
            $emailId = $message->getUid(); // UID هو معرف الرسالة

            // محتوى الرسالة
            $subject = $message->getSubject();
            $body = $message->getTextBody();
            $htmlBody = $message->getHTMLBody(); // محتوى HTML (إذا كان متاحاً)

            // معالجة التاريخ
            $date = $message->getDate();
            $formattedDate = $date ? Carbon::parse($date)->format('Y-m-d H:i:s') : 'N/A';

            // تجميع المحادثات حسب المرسل والمستلم
            $conversationKey = $from . '-' . $to; // مفتاح فريد لكل محادثة بناءً على المرسل والمستلم

            if (!isset($conversations[$conversationKey])) {
                // إذا لم تكن المحادثة موجودة بعد، ننشئ محادثة جديدة
                $conversations[$conversationKey] = [
                    'participants' => $from . ' & ' . $to,
                    'messages' => [],
                    'last_message_id' => $emailId // معرف آخر رسالة في المحادثة
                ];
            }

            // إضافة الرسالة إلى المحادثة
            $conversations[$conversationKey]['messages'][] = [
                'id' => $emailId,
                'from' => $from,
                'to' => $to,
                'subject' => $subject,
                'body' => $body,
                'date' => $formattedDate,
                'type' => 'received' // أو 'sent' إذا كانت الرسالة مرسلة
            ];

            // تحديث معرف آخر رسالة
            $conversations[$conversationKey]['last_message_id'] = $emailId;
        }

        // تمرير المحادثات إلى العرض (view)
        return view('emails.inbox', ['conversations' => $conversations]);
    }




    public function replyToMessage(Request $request, $messageId)
    {
        try {
            // الاتصال بحساب IMAP
            $client = Client::account('default');
            $client->connect();

            // الوصول إلى صندوق الوارد وجلب الرسالة المطلوبة
            $folder = $client->getFolder('INBOX');
            $message = $folder->messages()->getMessageByUid($messageId);

            // التأكد من أن الرسالة تم العثور عليها
            if (!$message) {
                throw new MessageNotFoundException('لم يتم العثور على الرسالة بالمعرف المحدد');
            }

            // جلب عنوان البريد الإلكتروني للمرسل
            $from = $message->getFrom()[0]->mail;

            // محتوى الرد
            $replyBody = $request->input('reply_body');
            $replySubject = 'RE: ' . $message->getSubject(); // إضافة "RE:" لموضوع الرسالة

            // إرسال الرد عبر وظيفة Laravel Mail
            Mail::raw($replyBody, function ($mail) use ($from, $replySubject) {
                $mail->to($from) // تأكد أن $from هو البريد الصحيح للمرسل
                     ->subject($replySubject);
            });

            return back()->with('success', 'تم إرسال الرد بنجاح.');

        } catch (MessageNotFoundException $e) {
            // التعامل مع خطأ في حال عدم العثور على الرسالة
            return back()->with('error', 'تعذر العثور على الرسالة.');
        } catch (\Exception $e) {
            // التعامل مع أي خطأ آخر غير متوقع
            return back()->with('error', 'حدث خطأ أثناء معالجة طلبك.');
        }



}


}
