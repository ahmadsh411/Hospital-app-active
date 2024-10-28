<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Entry Successful</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f9;
            color: #333;
            margin: 0;
            padding: 0;
        }
        .container {
            width: 80%;
            margin: 0 auto;
            background-color: #fff;
            padding: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
        }
        h1 {
            color: #4CAF50;
        }
        p {
            font-size: 16px;
            line-height: 1.5;
        }
        ul {
            list-style: none;
            padding: 0;
        }
        ul li {
            background-color: #e7f3e7;
            padding: 10px;
            margin-bottom: 10px;
            border-radius: 4px;
        }
        ul li strong {
            color: #4CAF50;
        }
        .footer {
            margin-top: 20px;
            font-size: 14px;
            color: #888;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Hello, {{ $patient['name'] }}!</h1>
        <p>We are pleased to inform you that your data has been successfully entered into our system.</p>
        <p>Here are your details:</p>
        <ul>
            <li><strong>Name:</strong> {{ $patient['name'] }}</li>
            <li><strong>Email:</strong> {{ $patient['email'] }}</li>
            <li><strong>Phone Number:</strong> {{ $patient['phone'] }}</li>
        </ul>
        <p>If you have any questions, feel free to contact our team at any time.</p>
        <p>Thank you,</p>
        <p>The XYZ Hospital Team</p>
        <div class="footer">
            &copy; 2024 XYZ Hospital. All rights reserved.
        </div>
    </div>
</body>
</html>
