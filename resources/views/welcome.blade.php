<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

    <!-- Styles -->
    <style>
        body {
            font-family: 'Nunito', sans-serif;
            background-image: url("{{asset('Dashboard/img/image1.jpg')}}");
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        a {
            color: #3182ce;
            text-decoration: none;
            font-size: 2vw;
            padding: 1vh 2vw;
            border-radius: 8px;
            transition: all 0.3s ease;
            background-color: #f7fafc;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            margin: 10px;
        }

        a:hover {
            background-color: #3182ce;
            color: white;
        }

        .top-right {
            position: fixed;
            top: 1rem;
            right: 1rem;
            z-index: 1000;
        }

        .content {
            text-align: center;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
        }
    </style>
</head>
<body>

<div class="content">
    @if (Route::has('login'))
        @auth
            <a href="{{ url('/dashboard') }}">Dashboard</a>
        @else
            <a href="{{ route('login') }}">Log in</a>
            <a href="{{ route('admin.login') }}" style="margin-left: 15px">Log in Admin</a>
            <a href="{{ route('doctor.login') }}" style="margin-left: 15px">Log in Doctor</a>
            <a href="{{ route('staff.login') }}" style="margin-left: 15px">Log in Staff</a>



            @if (Route::has('register'))
                <a href="{{ route('register') }}" style="margin-left: 15px">Register</a>
            @endif
        @endauth
    @endif
</div>

</body>
</html>
