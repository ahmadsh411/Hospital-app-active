<!-- main-header opened -->
<style>
    .main-message-list.chat-scroll {
        max-height: 300px; /* تحديد ارتفاع القائمة */
        overflow-y: auto;  /* تفعيل التمرير الرأسي */
    }
</style>
<div class="sticky main-header side-header nav nav-item">
    <div class="container-fluid">
        <div class="main-header-left ">
            <div class="responsive-logo">
                <a href="{{ url('/' . $page='index') }}"><img src="{{URL::asset('Dashboard/img/brand/logo.png')}}"
                                                              class="logo-1" alt="logo"></a>
                <a href="{{ url('/' . $page='index') }}"><img src="{{URL::asset('Dashboard/img/brand/logo-white.png')}}"
                                                              class="dark-logo-1" alt="logo"></a>
                <a href="{{ url('/' . $page='index') }}"><img src="{{URL::asset('Dashboard/img/brand/favicon.png')}}"
                                                              class="logo-2" alt="logo"></a>
                <a href="{{ url('/' . $page='index') }}"><img src="{{URL::asset('Dashboard/img/brand/favicon.png')}}"
                                                              class="dark-logo-2" alt="logo"></a>
            </div>
            <div class="app-sidebar__toggle" data-toggle="sidebar">
                <a class="open-toggle" href="#"><i class="header-icon fe fe-align-left"></i></a>
                <a class="close-toggle" href="#"><i class="header-icons fe fe-x"></i></a>
            </div>
            <div class="mr-3 main-header-center d-sm-none d-md-none d-lg-block">
                <input class="form-control" placeholder="Search for anything..." type="search">
                <button class="btn"><i class="fas fa-search d-none d-md-block"></i></button>
            </div>
        </div>
        <div class="main-header-right">
            <ul class="nav">
                <li class="">
                    <div class="dropdown nav-itemd-none d-md-flex">
                        <a href="#" class="pl-0 d-flex nav-item nav-link country-flag1" data-toggle="dropdown"
                           aria-expanded="false">
                            @if (App::getLocale() == 'ar')
                                <span class="mr-0 bg-transparent avatar country-Flag align-self-center"><img
                                        src="{{URL::asset('Dashboard/img/flags/syiranImageFlage.jpg')}}"
                                        alt="img"></span>
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
            <div class="ml-auto nav nav-item navbar-nav-right">
                <div class="nav-link" id="bs-example-navbar-collapse-1">
                    <form class="navbar-form" role="search">
                        <div class="input-group">
                            <input type="text" class="form-control" placeholder="Search">
                            <span class="input-group-btn">
											<button type="reset" class="btn btn-default">
												<i class="fas fa-times"></i>
											</button>
											<button type="submit" class="btn btn-default nav-link resp-btn">
												<svg xmlns="http://www.w3.org/2000/svg" class="header-icon-svgs"
                                                     viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                     stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                     class="feather feather-search"><circle cx="11" cy="11"
                                                                                            r="8"></circle><line x1="21"
                                                                                                                 y1="21"
                                                                                                                 x2="16.65"
                                                                                                                 y2="16.65"></line></svg>
											</button>
										</span>
                        </div>
                    </form>
                </div>

                <div class="dropdown nav-item main-header-message" >
                    <a class="new nav-link" href="#">
                        <svg xmlns="http://www.w3.org/2000/svg" class="header-icon-svgs" viewBox="0 0 24 24" fill="none"
                             stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                             class="feather feather-mail">
                            <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path>
                            <polyline points="22,6 12,13 2,6"></polyline>
                        </svg>
                        <span class="pulse-danger"></span>
                    </a>
                    <div class="dropdown-menu dropdown-message">
                        <div class="text-right menu-header-content bg-primary">
                            <div class="d-flex">
                                <h6 class="mb-1 text-white dropdown-title tx-15 font-weight-semibold">Messages</h6>
                            </div>
                            <!-- عنصر عرض عدد الرسائل غير المقروءة -->
                            @if(auth('doctor')->user())
                                <p data-count="{{App\Models\Notifications\Notification::where('user_id',auth('doctor')->user()->id)->where('read_status',0)->count()}}" class="dropdown-title-text subtext mb-0 text-white op-6 pb-0 tx-12 notif-count">{{App\Models\Notifications\Notification::where('user_id',auth('doctor')->user()->id)->where('read_status',0)->count()}}</p>
                            @elseif(auth('admin')->user())
                                <p data-count="{{App\Models\Notifications\Notification::where('user_id',auth('admin')->user()->id)->where('read_status',0)->count()}}" class="dropdown-title-text subtext mb-0 text-white op-6 pb-0 tx-12 notif-count">{{App\Models\Notifications\Notification::where('user_id',auth('admin')->user()->id)->where('read_status',0)->count()}}</p>
                            @elseif(auth('staff')->user() && auth('staff')->user()->section->id==3)
                                <p data-count="{{App\Models\Notifications\Notification::where('user_id',auth('staff')->user()->section->id)->where('read_status',0)->count()}}" class="dropdown-title-text subtext mb-0 text-white op-6 pb-0 tx-12 notif-count">{{App\Models\Notifications\Notification::where('user_id',auth('staff')->user()->section->id)->where('read_status',0)->count()}}</p>
                            @elseif(auth('staff')->user() && auth('staff')->user()->section->id==2)
                                <p data-count="{{App\Models\Notifications\Notification::where('user_id',auth('staff')->user()->section->id)->where('read_status',0)->count()}}" class="dropdown-title-text subtext mb-0 text-white op-6 pb-0 tx-12 notif-count">{{App\Models\Notifications\Notification::where('user_id',auth('staff')->user()->section->id)->where('read_status',0)->count()}}</p>

                            @endif
                        </div>

                        <!-- قائمة الرسائل -->
                        <div class="main-message-list chat-scroll">
                            <!-- مثال لرسالة موجودة -->

                            <!-- الرسائل الجديدة سيتم إضافتها هنا بواسطة JavaScript -->
                        </div>

                        <div class="new_messages">
                            <a class="d-flex p-3 border-bottom" href="#">
                                <div class="notifyimg bg-pink">
                                    <i class="la la-file-alt text-white"></i>
                                </div>
                                <div class="mr-3">
                                    <h4 class="notification-labels mb-1"></h4>
                                    <div class="notification-subtext"></div>
                                </div>

                            </a>
                        </div>

                        @if(auth('doctor')->user())
                            @foreach(App\Models\Notifications\Notification::where('user_id',auth('doctor')->user()->id)->where('read_status',0)->latest()->take(2)->get() as $notification )
                                <a class="d-flex p-3 border-bottom" href="#">
                                    <div class="notifyimg bg-pink">
                                        <i class="la la-file-alt text-white"></i>
                                    </div>
                                    <div class="mr-3">
                                        <h5 class="notification-label mb-1">{{$notification->message}}</h5>
                                        <div class="notification-subtext">{{$notification->created_at}}</div>
                                    </div>

                                </a>
                            @endforeach

                        @elseif(auth('admin')->user())
                            @foreach(App\Models\Notifications\Notification::where('user_id',auth('admin')->user()->id)->where('read_status',0)->get() as $notification )
                                <a class="d-flex p-3 border-bottom" href="#">
                                    <div class="notifyimg bg-pink">
                                        <i class="la la-file-alt text-white"></i>
                                    </div>
                                    <div class="mr-3">
                                        <h5 class="notification-label mb-1">{{$notification->message}}</h5>
                                        <div class="notification-subtext">{{$notification->created_at}}</div>
                                    </div>

                                </a>
                            @endforeach

                        @elseif(auth('staff')->user() )
                            @foreach(App\Models\Notifications\Notification::where('user_id',auth('staff')->user()->id)->where('read_status',0)->get() as $notification )
                                <a class="d-flex p-3 border-bottom" href="#">
                                    <div class="notifyimg bg-pink">
                                        <i class="la la-file-alt text-white"></i>
                                    </div>
                                    <div class="mr-3">
                                        <h5 class="notification-label mb-1">{{$notification->message}}</h5>
                                        <div class="notification-subtext">{{$notification->created_at}}</div>
                                    </div>

                                </a>
                            @endforeach
                        @endif



                        <div class="text-center dropdown-footer">
                            <a href="text-center">VIEW ALL</a>
                        </div>
                    </div>
                </div>


                <div class="dropdown nav-item main-header-notification">
                    <a class="new nav-link" href="#">
                        <svg xmlns="http://www.w3.org/2000/svg" class="header-icon-svgs" viewBox="0 0 24 24" fill="none"
                             stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                             class="feather feather-bell">
                            <path d="M18 8A6 6 0 0 0 6 8c0 7-3 9-3 9h18s-3-2-3-9"></path>
                            <path d="M13.73 21a2 2 0 0 1-3.46 0"></path>
                        </svg>
                        <span class=" pulse"></span></a>
                    <div class="dropdown-menu dropdown-notifications">
                        <div class="menu-header-content bg-primary text-right">
                            <div class="d-flex">
                                <h6 class="dropdown-title mb-1 tx-15 text-white font-weight-semibold">الاشعارات</h6>
                                <span
                                    class="badge badge-pill badge-warning mr-auto my-auto float-left">Mark All Read</span>
                            </div>
                            @if(auth('doctor')->user())
                                <p data-count="{{App\Models\Notifications\Notification::where('user_id',auth('doctor')->user()->id)->where('read_status',0)->count()}}" class="dropdown-title-text subtext mb-0 text-white op-6 pb-0 tx-12 notif-count">{{App\Models\Notifications\Notification::where('user_id',auth('doctor')->user()->id)->where('read_status',0)->count()}}</p>
                            @elseif(auth('admin')->user())
                                <p data-count="{{App\Models\Notifications\Notification::where('read_status',0)->count()}}" class="dropdown-title-text subtext mb-0 text-white op-6 pb-0 tx-12 notif-count">{{App\Models\Notifications\Notification::where('read_status',0)->count()}}</p>
                            @elseif(auth('staff')->user() && auth('staff')->user()->section->id==3)
                                <p data-count="{{App\Models\Notifications\Notification::where('user_id',auth('staff')->user()->section->id)->where('read_status',0)->count()}}" class="dropdown-title-text subtext mb-0 text-white op-6 pb-0 tx-12 notif-count">{{App\Models\Notifications\Notification::where('user_id',auth('staff')->user()->section->id)->where('read_status',0)->count()}}</p>
                            @elseif(auth('staff')->user() && auth('staff')->user()->section->id==2)
                                <p data-count="{{App\Models\Notifications\Notification::where('user_id',auth('staff')->user()->section->id)->where('read_status',0)->count()}}" class="dropdown-title-text subtext mb-0 text-white op-6 pb-0 tx-12 notif-count">{{App\Models\Notifications\Notification::where('user_id',auth('staff')->user()->section->id)->where('read_status',0)->count()}}</p>

                            @endif
                        </div>
                        <div class="main-notification-list Notification-scroll">

                            <div class="new_message">
                                <a class="d-flex p-3 border-bottom" href="#">
                                    <div class="notifyimg bg-pink">
                                        <i class="la la-file-alt text-white"></i>
                                    </div>
                                    <div class="mr-3">
                                        <h4 class="notification-label mb-1"></h4>
                                        <div class="notification-subtext"></div>
                                    </div>
                                    <div class="mr-auto">
                                        <i class="las la-angle-left text-left text-muted"></i>
                                    </div>
                                </a>
                            </div>
                             @if(auth('doctor')->user())
                                @foreach(App\Models\Notifications\Notification::where('user_id',auth('doctor')->user()->id)->where('read_status',0)->get() as $notification )
                                    <a class="d-flex p-3 border-bottom" href="#">
                                        <div class="notifyimg bg-pink">
                                            <i class="la la-file-alt text-white"></i>
                                        </div>
                                        <div class="mr-3">
                                            <h5 class="notification-label mb-1">{{$notification->message}}</h5>
                                            <div class="notification-subtext">{{$notification->created_at}}</div>
                                        </div>
                                        <div class="mr-auto">
                                            <i class="las la-angle-left text-left text-muted"></i>
                                        </div>
                                    </a>
                                @endforeach

                            @elseif(auth('admin')->user())
                                @foreach(App\Models\Notifications\Notification::where('read_status',0)->get() as $notification )
                                    <a class="d-flex p-3 border-bottom" href="#">
                                        <div class="notifyimg bg-pink">
                                            <i class="la la-file-alt text-white"></i>
                                        </div>
                                        <div class="mr-3">
                                            <h5 class="notification-label mb-1">{{$notification->message}}</h5>
                                            <div class="notification-subtext">{{$notification->created_at}}</div>
                                        </div>
                                        <div class="mr-auto">
                                            <i class="las la-angle-left text-left text-muted"></i>
                                        </div>
                                    </a>
                                @endforeach

                            @elseif(auth('staff')->user() && auth('staff')->user()->section->id==3)
                                @foreach(App\Models\Notifications\Notification::where('user_id',auth('staff')->user()->section->id)->where('read_status',0)->get() as $notification )
                                    <a class="d-flex p-3 border-bottom" href="#">
                                        <div class="notifyimg bg-pink">
                                            <i class="la la-file-alt text-white"></i>
                                        </div>
                                        <div class="mr-3">
                                            <h5 class="notification-label mb-1">{{$notification->message}}</h5>
                                            <div class="notification-subtext">{{$notification->created_at}}</div>
                                        </div>
                                        <div class="mr-auto">
                                            <i class="las la-angle-left text-left text-muted"></i>
                                        </div>
                                    </a>
                                @endforeach
                            @elseif(auth('staff')->user() && auth('staff')->user()->section->id==2)
                                @foreach(App\Models\Notifications\Notification::where('user_id',auth('staff')->user()->section->id)->where('read_status',0)->get() as $notification )
                                    <a class="d-flex p-3 border-bottom" href="#">
                                        <div class="notifyimg bg-pink">
                                            <i class="la la-file-alt text-white"></i>
                                        </div>
                                        <div class="mr-3">
                                            <h5 class="notification-label mb-1">{{$notification->message}}</h5>
                                            <div class="notification-subtext">{{$notification->created_at}}</div>
                                        </div>
                                        <div class="mr-auto">
                                            <i class="las la-angle-left text-left text-muted"></i>
                                        </div>
                                    </a>
                                @endforeach
                             @endif

                        </div>
                        <div class="dropdown-footer">
                            <a href="">VIEW ALL</a>
                        </div>
                    </div>
                </div>


                <div class="nav-item full-screen fullscreen-button">
                    <a class="new nav-link full-screen-link" href="#">
                        <svg xmlns="http://www.w3.org/2000/svg" class="header-icon-svgs" viewBox="0 0 24 24" fill="none"
                             stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                             class="feather feather-maximize">
                            <path
                                d="M8 3H5a2 2 0 0 0-2 2v3m18 0V5a2 2 0 0 0-2-2h-3m0 18h3a2 2 0 0 0 2-2v-3M3 16v3a2 2 0 0 0 2 2h3"></path>
                        </svg>
                    </a>
                </div>
                <div class="dropdown main-profile-menu nav nav-item nav-link">
                    <a class="profile-user d-flex" href="">
                        @if(auth('doctor')->check() && auth('doctor')->user()->image)
                            <img alt=""
                                 src="{{URL::asset('Dashboard/img/doctors/'.auth('doctor')->user()->image->filename)}}"
                                 class="">

                        @else
                            <img alt="" src="{{URL::asset('Dashboard/img/faces/6.jpg')}}">
                        @endif
                    </a>
                    <div class="dropdown-menu">
                        <div class="p-3 main-header-profile bg-primary">
                            <div class="d-flex wd-100p">
                                <div class="main-img-user">
                                    @if(auth('doctor')->check() && auth('doctor')->user()->image)
                                        <img alt=""
                                             src="{{URL::asset('Dashboard/img/doctors/'.auth('doctor')->user()->image->filename)}}"
                                             class="">
                                    @else
                                        <img alt="" src="{{URL::asset('Dashboard/img/faces/6.jpg')}}">
                                    @endif
                                </div>
                                <div class="my-auto mr-3">
                                    <h6>
                                        @if(auth('web')->check())
                                            <span>{{auth('web')->user()->name}}</span>
                                        @elseif(auth('admin')->check())
                                            <span>{{auth('admin')->user()->name}}</span>
                                        @elseif(auth('doctor')->check())
                                            <span>{{auth('doctor')->user()->name}}</span>
                                        @elseif(auth('staff')->check())
                                            <span>{{auth('staff')->user()->name}}</span>
                                        @endif
                                    </h6>
                                    @if(auth('web')->check())
                                        <span>{{auth('web')->user()->email}}</span>
                                    @elseif(auth('admin')->check())
                                        <span>{{auth('admin')->user()->email}}</span>
                                    @elseif(auth('doctor')->check())
                                        <span>{{auth('doctor')->user()->email}}</span>
                                    @elseif(auth('staff')->check())
                                        <span>{{auth()->user()->email}}</span>
                                    @endif
                                </div>
                            </div>
                        </div>
                        @if(auth('staff')->user())
                            <a class="dropdown-item" href="{{route('staff.staff-profile')}}">
                                <i class="bx bx-user-circle"></i>{{ __('messages.profile') }}
                            </a>
                            <a class="dropdown-item" href="{{route('staff.edit')}}">
                                <i class="bx bx-cog"></i>{{ __('messages.edit_profile') }}
                            </a>
                        @elseif(auth('doctor')->user())
                            <a class="dropdown-item" href="{{route('doctor.profile')}}">
                                <i class="bx bx-user-circle"></i>{{ __('messages.profile') }}
                            </a>
                            <a class="dropdown-item" href="{{route('doctor.profile.edit')}}">
                                <i class="bx bx-cog"></i>{{ __('messages.edit_profile') }}
                            </a>
                        @elseif (auth('admin')->user())
                            <a class="dropdown-item" href="{{route('profile.show')}}">
                                <i class="bx bx-user-circle"></i>{{ __('messages.profile') }}
                            </a>
                            <a class="dropdown-item" href="{{route('profile.edit')}}">
                                <i class="bx bx-cog"></i>{{ __('messages.edit_profile') }}
                            </a>
                        @endif

                        @if (auth('web')->check())
                            <form action="{{ route('logout.user') }}" method="POST">
                                @csrf
                                <a href="{{route('logout.user')}}" class="dropdown-item"
                                   onclick="event.preventDefault(); this.closest('form').submit();">
                                    <i class="bx bx-log-out"></i>{{ __('messages.logout') }}
                                </a>
                            </form>
                        @elseif (auth('admin')->check())
                            <form action="{{ route('logout.admin') }}" method="POST">
                                @csrf
                                <a href="{{route('logout.admin')}}" class="dropdown-item"
                                   onclick="event.preventDefault(); this.closest('form').submit();">
                                    <i class="bx bx-log-out"></i>{{ __('messages.logout') }}
                                </a>
                            </form>
                        @elseif (auth('doctor')->check())
                            <form action="{{ route('logout.doctor') }}" method="POST">
                                @csrf
                                <a href="{{route('logout.doctor')}}" class="dropdown-item"
                                   onclick="event.preventDefault(); this.closest('form').submit();">
                                    <i class="bx bx-log-out"></i>{{ __('messages.logout') }}
                                </a>
                            </form>
                        @elseif(auth('staff')->check())
                            <form action="{{ route('logout.staff') }}" method="POST">
                                @csrf
                                <a href="{{route('logout.staff')}}" class="dropdown-item"
                                   onclick="event.preventDefault(); this.closest('form').submit();">
                                    <i class="bx bx-log-out"></i>{{ __('messages.logout') }}
                                </a>
                            </form>
                        @endif



                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
<!-- /main-header -->
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
<script src="//js.pusher.com/3.1/pusher.min.js"></script>
<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>


<script src="{{asset('js/app.js')}}"></script>

<script>


        var notificationsWrapper = $('.dropdown-notifications');
        var notificationsCountElem = notificationsWrapper.find('p[data-count]');
        var notificationsCount = parseInt(notificationsCountElem.data('count'));

        var notifications = notificationsWrapper.find('h4.notification-label');
        var new_message = notificationsWrapper.find('.new_message');
        new_message.hide();

        Echo.private('invoices.{{ auth('doctor')->user() ? auth('doctor')->user()->id : '' }}')
            .listen('.invoices', (data) => {
                var newNotificationHtml = `

        <div class="notification-content ml-3">
            <h5 class="notification-label mb-1 text-dark font-weight-bold">` + data.message + `</h5>
            <p class="notification-subtext mb-0 text-muted">Patient: ` + data.patient + `</p>
            <p class="notification-subtext mb-0 text-muted">Total: ` + data.total + `</p>
            <p class="notification-subtext mb-0 text-muted"> At:` + data.created_at + `</p>
        </div>

    </div>`;






                new_message.show();
                notifications.html(newNotificationHtml);
                notificationsCount += 1;
                notificationsCountElem.attr('data-count', notificationsCount);
                notificationsWrapper.find('.notif-count').text(notificationsCount);
                notificationsWrapper.show();
            });




</script>



<script>


    var notificationsWrapper = $('.dropdown-notifications');
    var notificationsCountElem = notificationsWrapper.find('p[data-count]');
    var notificationsCount = parseInt(notificationsCountElem.data('count'));

    var notifications = notificationsWrapper.find('h4.notification-label');
    var new_message = notificationsWrapper.find('.new_message');
    new_message.hide();

    Echo.private('xrays.{{ auth('doctor')->user() ? auth('doctor')->user()->id : '' }}')
        .listen('.xrays', (data) => {
            var newNotificationHtml = `

        <div class="notification-content ml-3">
            <h5 class="notification-label mb-1 text-dark font-weight-bold">` + data.message + `</h5>
            <p class="notification-subtext mb-0 text-muted">Patient: ` + data.patient + `</p>
            <p class="notification-subtext mb-0 text-muted">Description: ` + data.description + `</p>

        </div>

    </div>`;


            new_message.show();
            notifications.html(newNotificationHtml);
            notificationsCount += 1;
            notificationsCountElem.attr('data-count', notificationsCount);
            notificationsWrapper.find('.notif-count').text(notificationsCount);
            notificationsWrapper.show();
        });




</script>

<script>


    var notificationsWrapper = $('.chat-scroll');
    var notificationsCountElem = notificationsWrapper.find('p[data-count]');
    var notificationsCount = parseInt(notificationsCountElem.data('count'));

    var notifications = notificationsWrapper.find('h4.notification-label');
    var new_message = notificationsWrapper.find('.new_message');
    new_message.hide();

    Echo.private('laboratory.{{ auth('doctor')->user() ? auth('doctor')->user()->id : '' }}')
        .listen('.laboratory', (data) => {
            var newNotificationHtml = `

        <div class="notification-content ml-3">
            <h5 class="notification-label mb-1 text-dark font-weight-bold">` + data.message + `</h5>
            <p class="notification-subtext mb-0 text-muted">Patient: ` + data.patient + `</p>
            <p class="notification-subtext mb-0 text-muted">Description: ` + data.description + `</p>

        </div>

    </div>`;


            new_message.show();
            notifications.html(newNotificationHtml);
            notificationsCount += 1;
            notificationsCountElem.attr('data-count', notificationsCount);
            notificationsWrapper.find('.notif-count').text(notificationsCount);
            notificationsWrapper.show();
        });




</script>


<script>


    var notificationsWrapper = $('.dropdown-notifications');
    var notificationsCountElem = notificationsWrapper.find('p[data-count]');
    var notificationsCount = parseInt(notificationsCountElem.data('count'));

    var notifications = notificationsWrapper.find('h4.notification-label');
    var new_message = notificationsWrapper.find('.new_message');
    new_message.hide();

    Echo.private('sendXray.{{ auth('staff')->user() && auth('staff')->user()->section->id==3 ? auth('staff')->user()->section->id : '' }}')
        .listen('.sendXray', (data) => {
            var newNotificationHtml = `

        <div class="notification-content ml-3">
            <h5 class="notification-label mb-1 text-dark font-weight-bold">` + data.message + `</h5>
            <p class="notification-subtext mb-0 text-muted">Doctor: ` + data.doctor + `</p>
            <p class="notification-subtext mb-0 text-muted">Description: ` + data.description + `</p>

        </div>

    </div>`;


            new_message.show();
            notifications.html(newNotificationHtml);
            notificationsCount += 1;
            notificationsCountElem.attr('data-count', notificationsCount);
            notificationsWrapper.find('.notif-count').text(notificationsCount);
            notificationsWrapper.show();
        });




</script>

<script>


    var notificationsWrapper = $('.dropdown-notifications');
    var notificationsCountElem = notificationsWrapper.find('p[data-count]');
    var notificationsCount = parseInt(notificationsCountElem.data('count'));

    var notifications = notificationsWrapper.find('h4.notification-label');
    var new_message = notificationsWrapper.find('.new_message');
    new_message.hide();

    Echo.private('sendlaboratory.{{ auth('staff')->user() && auth('staff')->user()->section->id==2 ? auth('staff')->user()->section->id : '' }}')
        .listen('.sendlaboratory', (data) => {
            var newNotificationHtml = `

        <div class="notification-content ml-3">
            <h5 class="notification-label mb-1 text-dark font-weight-bold">` + data.message + `</h5>
            <p class="notification-subtext mb-0 text-muted">Doctor: ` + data.doctor + `</p>
            <p class="notification-subtext mb-0 text-muted">Description: ` + data.description + `</p>

        </div>

    </div>`;


            new_message.show();
            notifications.html(newNotificationHtml);
            notificationsCount += 1;
            notificationsCountElem.attr('data-count', notificationsCount);
            notificationsWrapper.find('.notif-count').text(notificationsCount);
            notificationsWrapper.show();
        });




</script>


<script>


    var notificationsWrapper = $('.dropdown-message');
    var notificationsCountElem = notificationsWrapper.find('p[data-count]');
    var notificationsCount = parseInt(notificationsCountElem.data('count'));

    var notifications = notificationsWrapper.find('h4.notification-labels');
    var new_message = notificationsWrapper.find('.new_messages');
    new_message.hide();


    var ids=
        @auth('web')
            "{{ auth('web')->user()->id }}"
    @endauth
        @auth('admin')
        "{{ auth('admin')->user()->id }}"
    @endauth
        @auth('doctor')
        "{{ auth('doctor')->user()->id }}"
    @endauth
        @auth('staff')
        "{{ auth('staff')->user()->id }}"
    @endauth;

    Echo.private('sndmessage.' + ids)
        .listen('.sndmessage', (data) => {
            var newNotificationHtml = `

        <div class="notification-content ml-3">
            <h5 class="notification-label mb-1 text-dark font-weight-bold">` + data.message + `</h5>
            <p class="notification-subtext mb-0 text-muted">Doctor: ` + data.user + `</p>
            <p class="notification-subtext mb-0 text-muted">Description: ` +  data.message + `</p>
                <p class="notification-subtext mb-0 text-muted">Date: ` +  data.date + `</p>

        </div>

    </div>`;


            new_message.show();
            notifications.html(newNotificationHtml);
            notificationsCount += 1;
            notificationsCountElem.attr('data-count', notificationsCount);
            notificationsWrapper.find('.notif-count').text(notificationsCount);
            notificationsWrapper.show();


        });



    $('.main-header-message a').on('click', function(event) {
        event.preventDefault();
        notificationsWrapper.toggle(); // تبديل الظهور والإخفاء عند النقر
    });

    // إغلاق القائمة عند النقر خارجها
    $(document).on('click', function(event) {
        if (!$(event.target).closest('.dropdown-message, .main-header-message').length) {
            notificationsWrapper.hide();
        }
    });
</script>




