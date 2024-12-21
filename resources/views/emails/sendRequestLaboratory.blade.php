<!-- resources/views/emails/sendRequestLaboratory.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Analysis Result</title>
</head>
<body>
<h1>مرحبا، {{ $patient }}!</h1>
<p>تم إصدار نتيجة التحليل.</p>

<p><strong>الرسالة:</strong> تم اجراء التحليل بنجاح</p>


    <p><strong>الدكتور:</strong> {{ $doctor }}</p>


<p>نشكركم على ثقتكم بخدماتنا الطبية.</p>
</body>
</html>
