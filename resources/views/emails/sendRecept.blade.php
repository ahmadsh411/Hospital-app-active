<!DOCTYPE html>
<html>
<head>
    <title>إعادة المبلغ من المستشفى</title>
</head>
<body>
    <h1>قبض مبلغ مالي </h1>
    <p>عزيزي {{ $recept->patient->name }},</p>

    <p>تم قبض مبلغ مالي منك :</p>

    <ul>
        <li><strong>التاريخ:</strong> {{ $recept->date }}</li>
        <li><strong>المبلغ:</strong> {{ $recept->debit }} ريال</li>
        <li><strong>الوصف:</strong> {{ $recept->description }}</li>
        @if($Account>0)
        <li><strong>باقي لنا معك</strong>{{$Account}}</li>
        @elseif ($Account==0)
        <li><strong>تم دفع كامل الفاتورة </strong></li>
        @else
        <li>باقي لك معنا <strong>{{$Account}}</strong></li>
        @endif
    </ul>

    <p>إذا كان لديك أي استفسار، لا تتردد في التواصل معنا.</p>

    <p>تحياتنا،</p>
    <p>إدارة المستشفى</p>
</body>
</html>
