<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Company Status</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        .email-container {
            max-width: 600px;
            margin: 0 auto;
            background-color: #ffffff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }

        .header {
            background-color: #28a745;
            color: white;
            padding: 10px;
            border-radius: 8px 8px 0 0;
            text-align: center;
        }

        .header h1 {
            margin: 0;
            font-size: 24px;
        }

        .content {
            padding: 20px;
            text-align: center;
        }

        .content p {
            font-size: 16px;
            line-height: 1.6;
            color: #333333;
        }

        .content .status {
            font-weight: bold;
            color: {{ $status == 'active' ? '#28a745' : '#dc3545' }};
        }

        .footer {
            text-align: center;
            padding: 20px;
            font-size: 14px;
            color: #888888;
        }

        .footer a {
            color: #28a745;
            text-decoration: none;
        }

        .button {
            display: inline-block;
            padding: 10px 20px;
            background-color: #28a745;
            color: white;
            text-decoration: none;
            border-radius: 4px;
            margin-top: 20px;
        }

        .button:hover {
            background-color: #218838;
        }
    </style>
</head>
<body>

<div class="email-container">
    <!-- Header Section -->
    <div class="header">
        <h1>Company Status </h1>
    </div>

    <!-- Content Section -->
    <div class="content">
        <h2>Hello, {{ $companyName }}</h2>
        <p>Your company has been
            <span class="status">{{ $status == '1' ? 'activated' : 'deactivated' }}</span> successfully.</p>
            @if($status=='1')
            <p>The insurance percentage to be paid is: <span class="status">{{$company_rate}}%</span></p>
            @endif
        <!-- Button (Optional) -->
        <a href="#" class="button">{{ $status == '1' ? 'View Your Account' : 'Contact Support' }}</a>
    </div>

    <!-- Footer Section -->
    <div class="footer">
        <p>If you have any questions, feel free to <a href="#">contact us</a>.</p>
        <p>© 2024 Your Company. All rights reserved.</p>
    </div>
</div>

</body>
</html>
