@extends('Dashboard.layouts.master2')

@section('css')
    <!-- Sidemenu-responsive-tabs css -->
    <link href="{{URL::asset('Dashboard/plugins/sidemenu-responsive-tabs/css/sidemenu-responsive-tabs.css')}}" rel="stylesheet">

    <!-- Animate.css -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">

    <!-- Custom CSS -->
    <style>
        body {
            background: linear-gradient(45deg, #007BFF, #6C63FF);
            color: #fff;
        }

        .card-sigin {
            background: rgba(255, 255, 255, 0.9);
            border-radius: 10px;
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
            padding: 20px;
        }

        h2, h5 {
            color: #007BFF;
            font-weight: bold;
        }

        .btn-main-primary {
            background: linear-gradient(45deg, #007BFF, #6C63FF);
            color: #fff;
            border: none;
            transition: background 0.3s ease;
        }

        .btn-main-primary:hover {
            background: linear-gradient(45deg, #6C63FF, #007BFF);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.3);
        }

        .dropdown-menu {
            background: #007BFF;
            color: #fff;
            border-radius: 5px;
        }

        .dropdown-menu a {
            color: #fff !important;
        }

        .sign-favicon {
            animation: bounceIn 1.5s;
        }
    </style>
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row no-gutter">
            <!-- The content half -->
            <div class="bg-white col-md-6 col-lg-6 col-xl-5">
                <div class="py-2 login d-flex align-items-center">
                    <div class="container p-0">
                        <div class="row">
                            <div class="mx-auto col-md-10 col-lg-10 col-xl-9">
                                <div class="card-sigin animate__animated animate__fadeInLeft">
                                    <div class="mb-5 d-flex justify-content-between align-items-center">
                                        <a href="{{ url('/' . $page='index') }}">
                                            <img src="{{URL::asset('Website/images/logo-6.png')}}"
                                                 class="sign-favicon ht-40 animate__animated animate__fadeIn"
                                                 style="width: 70px;height: 70px" alt="logo">
                                        </a>
                                        <h1 class="animate__animated animate__heartBeat" style="font-size: 20px; font-weight: bold; margin-left: 10px; color: #007BFF;">
                                            {{ __('messages.hospital') }}
                                        </h1>
                                        <div class="dropdown nav-item language-switcher">
                                            <a href="#" class="pl-0 d-flex nav-item nav-link country-flag1" data-toggle="dropdown">
                                                @if (App::getLocale() == 'ar')
                                                    <span class="avatar country-Flag align-self-center"><img src="{{URL::asset('Dashboard/img/flags/syiranImageFlage.jpg')}}" alt="img"></span>
                                                    <strong class="my-auto ml-2 mr-2">{{ LaravelLocalization::getCurrentLocaleName() }}</strong>
                                                @else
                                                    <span class="avatar country-Flag align-self-center"><img src="{{URL::asset('Dashboard/img/flags/us_flag.jpg')}}" alt="img"></span>
                                                    <strong class="my-auto ml-2 mr-2">{{ LaravelLocalization::getCurrentLocaleName() }}</strong>
                                                @endif
                                            </a>
                                            <div class="dropdown-menu dropdown-menu-left dropdown-menu-arrow">
                                                @foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
                                                    <a class="dropdown-item" href="{{ LaravelLocalization::getLocalizedURL($localeCode) }}">
                                                        @if($properties['native'] == "English")
                                                            <i class="flag-icon flag-icon-us"></i>
                                                        @elseif($properties['native'] == "العربية")
                                                            <i class="flag-icon flag-icon-sy"></i>
                                                        @endif
                                                        {{ $properties['native'] }}
                                                    </a>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>

                                    <div class="card-sigin">
                                        <div class="main-signup-header">
                                            <h2>{{trans('Dashboard/login_trans.Welcome')}}</h2>
                                            @if ($errors->any())
                                                <div class="alert alert-danger">
                                                    <ul>
                                                        @foreach ($errors->all() as $error)
                                                            <li>{{ trans('Dashboard/auth.failed') }}</li>
                                                        @endforeach
                                                    </ul>
                                                </div>
                                            @endif

                                            <div id="admin" class="loginform">
                                                <h5 class="mb-4 font-weight-semibold">Login Doctor </h5>
                                                <form method="POST" action="{{route('login.Doctor')}}" autocomplete="off">
                                                    @csrf
                                                    <div class="form-group">
                                                        <label>Email</label>
                                                        <input class="form-control" placeholder="Enter your email" name="email" type="email">
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Password</label>
                                                        <input class="form-control" placeholder="Enter your password" name="password" type="password">
                                                    </div>
                                                    <button class="btn btn-main-primary btn-block">Sign In</button>
                                                </form>
                                                <div class="mt-5 main-signin-footer">
                                                    <p><a href="{{ route('show.password.reset.doctor')}}">Forgot password?</a></p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div><!-- End -->
                </div>
            </div>
            <!-- The image half -->
            <div class="col-md-6 col-lg-6 col-xl-7 d-none d-md-flex bg-primary-transparent">
                <div class="mx-auto text-center row wd-100p">
                    <div class="mx-auto my-auto col-md-12 col-lg-12 col-xl-12 wd-100p">
                        <img src="{{URL::asset('Dashboard/img/4033.jpg')}}" class="animate__animated animate__zoomIn mx-auto my-auto ht-xl-80p wd-md-100p wd-xl-80p" alt="logo">
                    </div>
                </div>
            </div><!-- End -->
        </div>
    </div>
@endsection

@section('js')
    <script>
        // تأثير عند تحريك الماوس فوق الصورة
        const img = document.querySelector('img.animate__animated');
        img.addEventListener('mouseover', () => {
            img.classList.add('animate__pulse');
        });

        img.addEventListener('mouseout', () => {
            img.classList.remove('animate__pulse');
        });
    </script>
@endsection
