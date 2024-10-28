<!DOCTYPE html>
<html>
<head>
    <title>Status Changed</title>
</head>
<body>
<h1>Hello, Dr. {{ $doctor_name }}</h1>
<p>Your status has been successfully changed by the admin to:</p>

@if($status == 'Inactive')
    <p><strong style="color: red" >{{$status}}</strong></p> <!-- اللون الأحمر للحالة 0 -->
@elseif($status == 'Active')
    <p><strong style="color: green">{{$status}}</strong></p> <!-- اللون الأخضر للحالة 1 -->
@endif

<p>If you did not request this change, please contact support immediately.</p>
<br>
<p>Best regards,</p>
<p>Your Admin Team</p>
</body>
</html>
