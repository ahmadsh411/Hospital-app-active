<div class="app-sidebar__overlay" data-toggle="sidebar"></div>
<aside class="app-sidebar sidebar-scroll">
    <div class="main-sidebar-header active">
        <a class="desktop-logo logo-light active" href="{{ url('/' . $page='index') }}"
           style="display: flex; align-items: center; text-decoration: none;">
            <img src="{{URL::asset('Website/images/logo-6.png')}}"
                 class="main-logo"
                 alt="logo"
                 style="width: 60px; height: 45px; transition: transform 0.3s ease;"/>
            <span
                style="font-size: 20px; font-weight: bold; margin-left: 10px; color: #007BFF; transition: color 0.3s ease;">
                {{ trans('messages.Hospital') }}
            </span>
        </a>
    </div>
    <div class="main-sidemenu">
        <div class="app-sidebar__user clearfix">
            <div class="dropdown user-pro-body">
                <div class="">
                    <img alt="user-img" class="avatar avatar-xl brround"
                         src="{{URL::asset('Dashboard/img/faces/6.jpg')}}"><span
                        class="avatar-status profile-status bg-green"></span>
                </div>
                <div class="user-info">
                    <h4 class="mt-3 mb-0 font-weight-semibold">
                        @if(auth('admin')->check())
                            {{ auth('admin')->user()->name }}
                        @elseif(auth('web')->check())
                            {{ auth('web')->user()->name }}
                        @elseif(auth('doctor')->check())
                            {{ auth('doctor')->user()->name }}
                        @elseif(auth('staff')->check())
                            {{ auth('staff')->user()->name }}
                        @endif
                    </h4>
                </div>
            </div>
            <ul class="side-menu">
                <li class="side-item side-item-category">{{ trans('messages.hospital_management_program') }}</li>
                <li class="slide">
                    <a class="side-menu__item" href="{{ route('staff.dashboard') }}">
                        <i class="fas fa-tachometer-alt side-menu__icon"></i>
                        <span class="side-menu__label">{{ trans('messages.dashboard') }}</span>
                    </a>
                </li>
                <li class="side-item side-item-category">{{ trans('messages.xrays') }}</li>
                @if(auth('staff')->user()->section->id==3)
                    <li class="slide">
                        <a class="side-menu__item" href="{{ route('staff.x-rays') }}">
                            <i class="fas fa-file-medical side-menu__icon"></i>
                            <span class="side-menu__label">{{ trans('messages.xrays') }}</span>
                            <span
                                class="badge badge-success side-badge">{{ \App\Models\Rays\Ray::where('status', 0)->count() }}</span>
                        </a>
                    </li>
                    <li class="slide">
                        <a class="side-menu__item" href="{{ route('staff.x-rays-show') }}">
                            <i class="fas fa-file-medical side-menu__icon"></i>
                            <span class="side-menu__label">{{ trans('messages.completed_xrays') }}</span>
                            <span
                                class="badge badge-success side-badge">{{ \App\Models\Rays\Ray::where('status', 1)->where('staff_id', auth('staff')->user()->id)->count() }}</span>
                        </a>
                    </li>
                @endif
                @if(auth('staff')->user()->section->id == 2)

                    <li class="slide">
                        <a class="side-menu__item" href="{{ route('staff.all-laboratory') }}">
                            <i class="fas fa-file-medical side-menu__icon"></i>
                            <span class="side-menu__label">{{ __('messages.laboratory_reports') }}</span>
                            <span
                                class="badge badge-success side-badge">
                {{ \App\Models\Laboratories\Laboratory::where('status', 0)->where('staff_id', auth('staff')->user()->id)->count() }}
            </span>
                        </a>
                    </li>

                    <li class="slide">
                        <a class="side-menu__item" href="{{ route('staff.laboratory-show') }}">
                            <i class="fas fa-file-medical side-menu__icon"></i>
                            <span class="side-menu__label">{{ __('messages.completed_reports') }}</span>
                            <span
                                class="badge badge-success side-badge">
                {{ \App\Models\Laboratories\Laboratory::where('status', 1)->where('staff_id', auth('staff')->user()->id)->count() }}
            </span>
                        </a>
                    </li>

                @endif


                <li class="side-item side-item-category">{{ trans('messages.messages') }}</li>
                <li class="slide">
                    <a class="side-menu__item" data-toggle="slide" href="#">
                        <i class="fas fa-envelope side-menu__icon"></i>
                        <span class="side-menu__label">{{ trans('messages.messages') }}</span>
                        <i class="angle fe fe-chevron-down"></i>
                    </a>
                    <ul class="slide-menu">
                        <li><a class="slide-item" href="{{route('staff.chat-list')}}"><i
                                    class="fas fa-envelope-open-text side-menu__icon"></i> {{ trans('messages.all_messages') }}
                            </a></li>
                        <li><a class="slide-item" href="{{route('showstaff.messages')}}"><i
                                    class="fas fa-envelope side-menu__icon"></i> {{ trans('messages.recent_messages') }}
                            </a></li>
                    </ul>
                </li>
            </ul>
        </div>
</aside>
