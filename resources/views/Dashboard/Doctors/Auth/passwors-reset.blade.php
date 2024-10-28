<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Password Recovery</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f7f7f7;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        .form-container {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 400px;
        }

        h2 {
            text-align: center;
            margin-bottom: 20px;
            color: #333;
        }

        label {
            display: block;
            margin-bottom: 8px;
            font-weight: bold;
        }

        input[type="email"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #ddd;
            border-radius: 4px;
            box-sizing: border-box;
        }

        button {
            width: 100%;
            padding: 10px;
            background-color: #28a745;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
        }

        button:hover {
            background-color: #218838;
        }

        .message {
            text-align: center;
            margin-top: 10px;
            color: #666;
        }
    </style>
</head>
<body>
<div class="form-container">
    <h2>Password Recovery</h2>
    <form method="POST" action="{{ route('get.password.Doctor') }}">
        @csrf
        <label for="email">Enter your email to recover your account:</label>
        <input type="email" id="email" name="email" placeholder="yourname@example.com" required>
        <button type="submit">Send Verification Code</button>
    </form>
    <div class="message">
        Please enter your email to receive a verification code.
    </div>
</div>
</body>
</html>
