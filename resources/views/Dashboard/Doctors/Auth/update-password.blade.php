<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password</title>
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

        input[type="password"] {
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

        .email-display {
            text-align: center;
            margin-bottom: 20px;
            font-style: italic;
            color: #555;
        }
    </style>
</head>
<body>
<div class="form-container">
    <h2>Reset Your Password</h2>

    <!-- Display the email stored in the session -->
    <div class="email-display">
        Resetting password for: <strong>{{ session('email') }}</strong>
    </div>

    <form action="{{ route('password.reset.Doctor') }}" method="POST">
        @csrf
        <label for="password">New Password:</label>
        <input type="password" name="password" id="password" placeholder="Enter your new password" required>

        <label for="password_confirmation">Confirm Password:</label>
        <input type="password" name="password_confirmation" id="password_confirmation" placeholder="Confirm your new password" required>

        <button type="submit">Reset Password</button>
    </form>
    <div class="message">
        Please enter and confirm your new password.
    </div>
</div>
</body>
</html>
