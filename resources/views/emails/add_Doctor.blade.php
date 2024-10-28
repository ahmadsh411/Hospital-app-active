<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome to the Hospital</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            color: #333;
            line-height: 1.6;
            margin: 0;
            padding: 0;
        }
        .email-container {
            max-width: 600px;
            margin: 20px auto;
            background-color: #ffffff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        h1 {
            color: #2c3e50;
            font-size: 24px;
        }
        p {
            font-size: 16px;
            margin-bottom: 20px;
        }
        .footer {
            font-size: 14px;
            color: #7f8c8d;
        }
        .button {
            display: inline-block;
            padding: 10px 20px;
            background-color: #3498db;
            color: #ffffff;
            text-decoration: none;
            border-radius: 5px;
        }
    </style>
</head>
<body>
    <div class="email-container">
        <h1>Welcome, Dr. {{ $doctor->name }}!</h1>
        <p>We are excited to inform you that you have been successfully added to our hospital team. You have been assigned to the <strong>{{ $doctor->section->name }}</strong> department. We are confident that your expertise and experience will be a valuable addition to our staff, and we look forward to seeing the positive impact you will make in your new department.</p>

        <p>If you have any questions or need assistance with your onboarding process, please don't hesitate to reach out to us. We are here to support you and ensure a smooth transition into your new role.</p>

        <p>We are excited to have you on board, and we wish you all the best in your journey with us.</p>

        <br>
        <p>Best regards,</p>
        <p>Your Hospital Admin Team</p>

        <div class="footer">
            <p>&copy; 2024 Hospital Admin. All rights reserved.</p>
        </div>
    </div>
</body>
</html>
