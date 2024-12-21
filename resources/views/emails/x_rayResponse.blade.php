<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>إشعار جهوزية صور الأشعة</title>
    <style>
        body { font-family: Arial, sans-serif; color: #333; background-color: #f9f9f9; padding: 20px; }
        .email-container { max-width: 600px; margin: 0 auto; background-color: #fff; border-radius: 8px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); overflow: hidden; }
        .header { background-color: #4CAF50; color: #fff; padding: 10px 20px; text-align: center; }
        .content { padding: 20px; line-height: 1.6; text-align: right; }
        .footer { background-color: #f1f1f1; padding: 10px; text-align: center; font-size: 12px; color: #777; }
        .button { display: inline-block; padding: 10px 20px; margin-top: 20px; color: #fff; background-color: #4CAF50; text-decoration: none; border-radius: 5px; }
    </style>
</head>
<body>

<div class="email-container">
    <div class="header">
        <h1>إشعار جهوزية صور الأشعة</h1>
    </div>

    <div class="content">
        <p>مرحباً  {{ $patient }},</p>

        <p>نود إعلامك بأن صور الأشعة الخاصة بك  أصبحت جاهزة للاطلاع.</p>

        <p>يرجى مراجعة الصور في النظام لتقديم التشخيص المناسب.</p>

        <strong>راجع الطبيب :{{$doctor}}</strong>


    </div>

    <div class="footer">
        <p>جميع الحقوق محفوظة © {{ date('Y') }}. فريق المستشفى</p>
    </div>
</div>

</body>
</html>
