@extends('Dashboard.layouts.master2')

@section('css')

    <!-- Sidemenu-responsive-tabs css -->
    <link href="{{URL::asset('Dashboard/plugins/sidemenu-responsive-tabs/css/sidemenu-responsive-tabs.css')}}" rel="stylesheet">
@endsection

@section('content')

    <div class="container-fluid">
        <div class="row no-gutter">

            <!-- The content half -->
            <div class="bg-white col-md-6 col-lg-6 col-xl-5">
                <div class="py-2 login d-flex align-items-center">
                    <!-- Demo content-->

                    <div class="container p-0">
                        <div class="row">
                            <div class="mx-auto col-md-10 col-lg-10 col-xl-9">
                                <div class="card-sigin">
                                    <div class="mb-5 d-flex">
                                        <a href="{{ url('/' . $page='index') }}">
                                            <img src="{{URL::asset('Dashboard/img/brand/favicon.png')}}" class="sign-favicon ht-40" alt="logo">
                                        </a>

                                        <h1 class="my-auto ml-1 mr-0 main-logo1 tx-28">Va<span>le</span>x</h1>
                                        <ul class="nav">
                                            <li class="">
                                                <div class="dropdown nav-itemd-none d-md-flex">
                                                    <a href="#" class="pl-0 d-flex nav-item nav-link country-flag1" data-toggle="dropdown"
                                                       aria-expanded="false">
                                                        @if (App::getLocale() == 'ar')
                                                            <span class="mr-0 bg-transparent avatar country-Flag align-self-center"><img
                                                                    src="{{URL::asset('Dashboard/img/flags/syiranImageFlage.jpg')}}" alt="img"></span>
                                                            <strong
                                                                class="my-auto ml-2 mr-2">{{ LaravelLocalization::getCurrentLocaleName() }}</strong>
                                                        @else
                                                            <span class="mr-0 bg-transparent avatar country-Flag align-self-center"><img
                                                                    src="{{URL::asset('Dashboard/img/flags/us_flag.jpg')}}" alt="img"></span>
                                                            <strong
                                                                class="my-auto ml-2 mr-2">{{ LaravelLocalization::getCurrentLocaleName() }}</strong>
                                                        @endif
                                                        <div class="my-auto">
                                                        </div>
                                                    </a>
                                                    <div class="dropdown-menu dropdown-menu-left dropdown-menu-arrow" x-placement="bottom-end">
                                                        @foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
                                                            <a class="dropdown-item" rel="alternate" hreflang="{{ $localeCode }}"
                                                               href="{{ LaravelLocalization::getLocalizedURL($localeCode, null, [], true) }}">
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
                                            </li>
                                        </ul>
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

                                                 {{--Doctor Login Form--}}
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
                                                    
                                                    <p> <a href="{{ route('show.password.reset.doctor')}}">Forgot password?</a></p>
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
                        <img src="{{URL::asset('Dashboard/img/media/login.png')}}" class="mx-auto my-auto ht-xl-80p wd-md-100p wd-xl-80p" alt="logo">
                    </div>
                </div>
            </div><!-- End -->
        </div>
    </div>
@endsection

@section('js')

@endsection
