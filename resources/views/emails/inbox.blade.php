<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>المحادثات</title>
    <!-- إضافة Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background-color: #f0f2f5;
            font-family: 'Tajawal', sans-serif;
        }

        .conversation-box {
            padding: 20px;
            border-radius: 10px;
            margin-bottom: 30px;
            background-color: #ffffff;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .message {
            padding: 15px;
            border-radius: 10px;
            margin-bottom: 10px;
            max-width: 60%;
            position: relative;
            clear: both;
        }

        /* الرسائل الواردة */
        .message.received {
            background-color: #e9f7ff;
            float: right;
            border-left: 5px solid #007bff;
        }

        /* الرسائل المرسلة */
        .message.sent {
            background-color: #d4f8d4;
            float: left;
            border-right: 5px solid #28a745;
        }

        h1 {
            color: #28a745;
            font-weight: bold;
            margin-bottom: 40px;
        }

        hr {
            margin-top: 15px;
            margin-bottom: 15px;
            border-top: 1px solid #ddd;
        }

        .btn-primary {
            background-color: #007bff;
            border: none;
            border-radius: 5px;
        }

        .btn-primary:hover {
            background-color: #0056b3;
        }

        .message-container {
            margin-top: 30px;
        }

        .reply-form {
            margin-top: 20px;
        }

        .conversation-header {
            font-weight: bold;
            margin-bottom: 20px;
        }

        .message-box {
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }
    </style>
</head>
<body>
    <div class="container mt-4">
        <h1 class="text-center mb-4">المحادثات</h1>

        <!-- عرض رسالة النجاح أو الخطأ -->
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @elseif (session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif

        <!-- عرض المحادثات -->
        @if (isset($conversations) && is_array($conversations) && count($conversations) > 0)
        <div class="message-container">
            @foreach ($conversations as $conversation)
                <div class="conversation-box">
                    <div class="conversation-header">
                        محادثة بين: {{ $conversation['participants'] }}
                    </div>
                    @foreach ($conversation['messages'] as $message)
                        <div class="message {{ $message['type'] === 'received' ? 'received' : 'sent' }}">
                            <p><strong>{{ $message['type'] === 'received' ? 'من' : 'إلى' }}:</strong> {{ $message['type'] === 'received' ? $message['from'] : $message['to'] }}</p>
                            <p><strong>التاريخ:</strong> {{ $message['date'] }}</p>
                            <p>{{ $message['body'] }}</p>
                        </div>
                    @endforeach

                    <!-- نموذج الرد على الرسالة -->
                    <form class="reply-form message-box" method="POST" action="{{ route('reply', ['messageId' => $conversation['last_message_id']]) }}">
                        @csrf
                        <textarea class="form-control mt-3" name="reply_body" placeholder="اكتب ردك هنا..." rows="3"></textarea>
                        <button type="submit" class="btn btn-success mt-2">إرسال الرد</button>
                    </form>
                </div>
            @endforeach
        </div>
    @else
        <p class="text-center">لا توجد محادثات جديدة.</p>
    @endif

    </div>

    <!-- إضافة Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

    <!-- إضافة JavaScript لتحديث الرسائل المرسلة -->
    <script>
        // تحديث الصفحة بعد إرسال الرد لإظهار الرسالة المرسلة
        document.querySelectorAll('.reply-form').forEach(form => {
            form.addEventListener('submit', function(e) {
                e.preventDefault(); // منع إعادة تحميل الصفحة
                const formData = new FormData(this);

                fetch(this.action, {
                    method: 'POST',
                    body: formData,
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        // إنشاء رسالة جديدة وإضافتها إلى قائمة الرسائل المرسلة
                        const newMessage = document.createElement('div');
                        newMessage.classList.add('message', 'sent');
                        newMessage.innerHTML = `<p><strong>إلى:</strong> ${data.to}</p>
                                                <p><strong>التاريخ:</strong> ${data.date}</p>
                                                <p>${data.body}</p>`;

                        this.parentElement.querySelector('.conversation-box').appendChild(newMessage);
                        this.querySelector('textarea').value = ''; // إعادة تعيين الحقل
                    }
                })
                .catch(error => console.error('Error:', error));
            });
        });
    </script>
</body>
</html>
