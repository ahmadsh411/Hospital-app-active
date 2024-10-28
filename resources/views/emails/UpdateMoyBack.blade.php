<!DOCTYPE html>
<html>
<head>
    <title>المبلغ المعاد المحدث من المشفى </title>
</head>
<body>
    <h1>إعادة المبلغ المدفوع</h1>
    <p>عزيزي {{ $payment->patient->name }},</p>

    <p>نحيطك علمًا بأنه تم  تحديث استرجاع المبلغ الخاص بك كما يلي:</p>

    <ul>
        <li><strong>التاريخ:</strong> {{ $payment->date }}</li>
        <li><strong>المبلغ:</strong> {{ $payment->debit }} ريال</li>
        <li><strong>الوصف:</strong> {{ $payment->description }}</li>
        <li><strong>باقي لك معنا </strong>{{$rest}}</li>
    </ul>

    <p>إذا كان لديك أي استفسار، لا تتردد في التواصل معنا.</p>

    <p>تحياتنا،</p>
    <p>إدارة المستشفى</p>
</body>
</html>
