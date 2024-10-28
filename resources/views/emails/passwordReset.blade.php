<!DOCTYPE html>
<html>
<head>
    <title>Password Recovery</title>
</head>
<body>
<h1>Hello, {{ $user->name }}</h1>
<p>Your verification code for password recovery is: <strong>{{ $verificationcode }}</strong></p>
<p>If you did not request this, please ignore this email.</p>
</body>
</html>

