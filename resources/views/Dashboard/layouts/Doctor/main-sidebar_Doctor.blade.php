<!-- main-sidebar -->
<div class="app-sidebar__overlay" data-toggle="sidebar"></div>
<aside class="app-sidebar sidebar-scroll">
    <div class="main-sidebar-header active">
        <a class="desktop-logo logo-light active" href="{{ url('/' . $page='index') }}" style="display: flex; align-items: center; text-decoration: none;">
            <img src="{{URL::asset('Website/images/logo-6.png')}}"
                 class="main-logo"
                 alt="{{ __('messages.logo') }}"
                 style="width: 60px; height: 45px; transition: transform 0.3s ease;"/>
            <span style="font-size: 20px; font-weight: bold; margin-left: 10px; color: #007BFF; transition: color 0.3s ease;">
                {{ __('messages.hospital') }}
            </span>
        </a>

        <style>


            .desktop-logo:hover .main-logo {
                transform: scale(1.1); /* تكبير الشعار عند التمرير */
            }
            .desktop-logo:hover span {
                color: #FF5733; /* تغيير لون النص عند التمرير */
            }
        </style>
    </div>
    <div class="main-sidemenu">
        <div class="app-sidebar__user clearfix">
            <div class="dropdown user-pro-body">
                <div class="">
                    @php $doctor = auth('doctor')->user(); @endphp
                    @if($doctor->image)
                        <img alt="{{ __('messages.user_image') }}" class="avatar avatar-xl brround" src="{{URL::asset('Dashboard/img/doctors/'.$doctor->image->filename)}}">
                    @else
                        <img alt="{{ __('messages.default_user_image') }}" class="avatar avatar-xl brround" src="{{URL::asset('Dashboard/img/6.jpg')}}">
                    @endif
                </div>

                <div class="user-info">
                    @if(auth('admin')->check())
                        <h4 class="mt-3 mb-0 font-weight-semibold">{{ auth('admin')->user()->name }}</h4>
                        <span class="mb-0 text-muted">{{ auth('admin')->user()->email }}</span>
                    @elseif(auth('web')->check())
                        <h4 class="mt-3 mb-0 font-weight-semibold">{{ auth('web')->user()->name }}</h4>
                        <span class="mb-0 text-muted">{{ auth('web')->user()->email }}</span>
                    @elseif(auth('doctor')->check())
                        <h4 class="mt-3 mb-0 font-weight-semibold">{{ auth('doctor')->user()->name }}</h4>
                        <span class="mb-0 text-muted">{{ auth('doctor')->user()->email }}</span>
                    @elseif(auth('staff')->check())
                        <h4 class="mt-3 mb-0 font-weight-semibold">{{ auth('staff')->user()->name }}</h4>
                        <span class="mb-0 text-muted">{{ auth('staff')->user()->email }}</span>
                    @endif
                </div>
            </div>
        </div>
        <ul class="side-menu">
            <li class="side-item side-item-category">
                {{ __('messages.hospital_management_program') }}
            </li>

            <!-- Dashboard Icon -->
            <li class="slide">
                <a class="side-menu__item" href="{{route('doctor.dashboard')}}">
                    <i class="fas fa-tachometer-alt side-menu__icon"></i>
                    <span class="side-menu__label">{{ __('sidebar.dashboard') }}</span>
                </a>
            </li>

            <li class="side-item side-item-category">{{ __('sidebar.hospital_elements') }}</li>


            <!-- Statements Section -->
            <li class="slide">
                <a class="side-menu__item" data-toggle="slide" href="#">
                    <i class="fas fa-chart-bar side-menu__icon"></i>
                    <span class="side-menu__label">{{ __('messages.statements') }}</span>
                    <i class="angle fe fe-chevron-down"></i>
                </a>
                <ul class="slide-menu">
                    <li>
                        <a class="slide-item" href="{{ route('doctor-invoices.index') }}">
                            <i class="fas fa-file-alt side-menu__icon"></i>
                            {{ __('messages.all_statements') }}
                        </a>
                    </li>
                    <li>
                        <a class="slide-item" href="{{ route('complete.statements') }}">
                            <i class="fas fa-check-circle side-menu__icon"></i>
                            {{ __('messages.complete_statements_list') }}
                        </a>
                    </li>
                    <li>
                        <a class="slide-item" href="{{ route('reviews') }}">
                            <i class="fas fa-clipboard-list side-menu__icon"></i>
                            {{ __('messages.review_list') }}
                        </a>
                    </li>
                </ul>
            </li>

            <!-- Messages Section -->
            <li class="slide">
                <a class="side-menu__item" data-toggle="slide" href="#">
                    <i class="fas fa-envelope side-menu__icon"></i>
                    <span class="side-menu__label">{{ __('messages.messages') }}</span>
                    <i class="angle fe fe-chevron-down"></i>
                </a>
                <ul class="slide-menu">
                    <li>
                        <a class="slide-item" href="{{ route('doctor.conversation') }}">
                            <i class="fas fa-envelope-open-text side-menu__icon"></i>
                            {{ __('messages.all_messages') }}
                        </a>
                    </li>
                    <li>
                        <a class="slide-item" href="{{ route('doctor.main') }}">
                            <i class="fas fa-envelope side-menu__icon"></i>
                            {{ __('messages.recent_messages') }}
                        </a>
                    </li>
                </ul>
            </li>
        </ul>

    </div>
</aside>
<!-- main-sidebar -->
