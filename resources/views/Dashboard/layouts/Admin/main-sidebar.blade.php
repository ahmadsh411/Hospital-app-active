<!-- main-sidebar -->
		<div class="app-sidebar__overlay" data-toggle="sidebar"></div>
		<aside class="app-sidebar sidebar-scroll">
			<div class="main-sidebar-header active">
                <a class="desktop-logo logo-light active" href="{{ url('/' . $page='index') }}" style="display: flex; align-items: center; text-decoration: none;">
                    <img src="{{URL::asset('Website/images/logo-6.png')}}"
                         class="main-logo"
                         alt="logo"
                         style="width: 60px; height: 45px; transition: transform 0.3s ease;"/>
                    <span style="font-size: 20px; font-weight: bold; margin-left: 10px; color: #007BFF; transition: color 0.3s ease;">
        Hospital
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
				<a class="desktop-logo logo-dark active" href="{{ url('/' . $page='index') }}"><img src="{{URL::asset('Dashboard/img/brand/logo-white.png')}}" class="main-logo dark-theme" alt="logo"></a>
				<a class="logo-icon mobile-logo icon-light active" href="{{ url('/' . $page='index') }}"><img src="{{URL::asset('Dashboard/img/brand/favicon.png')}}" class="logo-icon" alt="logo"></a>
				<a class="logo-icon mobile-logo icon-dark active" href="{{ url('/' . $page='index') }}"><img src="{{URL::asset('Dashboard/img/brand/favicon-white.png')}}" class="logo-icon dark-theme" alt="logo"></a>
			</div>
			<div class="main-sidemenu">
				<div class="clearfix app-sidebar__user">
					<div class="dropdown user-pro-body">
						<div class="">
							<img alt="user-img" class="avatar avatar-xl brround" src="{{URL::asset('Dashboard/img/faces/6.jpg')}}"><span class="avatar-status profile-status bg-green"></span>
						</div>
						<div class="user-info">
                            @if(auth('admin')->check())
							<h4 class="mt-3 mb-0 font-weight-semibold">{{ auth('admin')->user()->name }}</h4>
                            <span class="mb-0 text-muted">{{ auth('admin')->user()->email }}</span>
                            @elseif (auth('web')->check())
                            <h4 class="mt-3 mb-0 font-weight-semibold">{{  auth('web')->user()->name}}</h4>
                            <span class="mb-0 text-muted">{{auth('web')->user()->email}}</span>
                            @elseif(auth('staff')->check())
                                <h4 class="mt-3 mb-0 font-weight-semibold">{{  auth('staff')->user()->name}}</h4>
                                <span class="mb-0 text-muted">{{auth('staff')->user()->email}}</span>
                            @endif

						</div>
					</div>
				</div>
                <ul class="side-menu">
                    <li class="side-item side-item-category">{{ __('sidebar.hospital_management_program') }}</li>
                    <li class="slide">
                        <a class="side-menu__item" href="{{ route('admin.dashboard') }}">
                            <i class="fas fa-tachometer-alt side-menu__icon"></i>
                            <span class="side-menu__label">{{ __('sidebar.dashboard') }}</span>
                        </a>
                    </li>
                    <li class="side-item side-item-category">{{ __('sidebar.hospital_elements') }}</li>

                    <li class="slide">
                        <a class="side-menu__item" data-toggle="slide" href="#">
                            <i class="fas fa-th-list side-menu__icon"></i>
                            <span class="side-menu__label">{{ __('sidebar.sections') }}</span>
                            <i class="angle fe fe-chevron-down"></i>
                        </a>
                        <ul class="slide-menu">
                            <li><a class="slide-item" href="{{ route('section.all') }}">{{ __('sidebar.all_sections') }}</a></li>
                        </ul>
                    </li>

                    <li class="slide">
                        <a class="side-menu__item" data-toggle="slide" href="#">
                            <i class="fas fa-user-md side-menu__icon"></i>
                            <span class="side-menu__label">{{ __('sidebar.doctors') }}</span>
                            <i class="angle fe fe-chevron-down"></i>
                        </a>
                        <ul class="slide-menu">
                            <li><a class="slide-item" href="{{ route('doctor.index') }}">{{ __('sidebar.all_doctors') }}</a></li>
                        </ul>
                    </li>

                    <li class="side-item side-item-category">{{ __('sidebar.services') }}</li>
                    <li class="slide">
                        <a class="side-menu__item" data-toggle="slide" href="#">
                            <i class="fas fa-concierge-bell side-menu__icon"></i>
                            <span class="side-menu__label">{{ __('sidebar.services') }}</span>
                            <i class="angle fe fe-chevron-down"></i>
                        </a>
                        <ul class="slide-menu">
                            <li><a class="slide-item" href="{{ route('services.index') }}">{{ __('sidebar.single_service') }}</a></li>
                            <li><a class="slide-item" href="{{ route('multi-services.index') }}">{{ __('sidebar.service_offers') }}</a></li>
                        </ul>
                    </li>

                    <li class="slide">
                        <a class="side-menu__item" data-toggle="slide" href="#">
                            <i class="fas fa-shield-alt side-menu__icon"></i>
                            <span class="side-menu__label">{{ __('sidebar.insurance_companies') }}</span>
                            <i class="angle fe fe-chevron-down"></i>
                        </a>
                        <ul class="slide-menu">
                            <li><a class="slide-item" href="{{ route('insurance-company.index') }}">{{ __('sidebar.all_insurance_companies') }}</a></li>
                        </ul>
                    </li>

                    <li class="slide">
                        <a class="side-menu__item" data-toggle="slide" href="#">
                            <i class="fas fa-ambulance side-menu__icon"></i>
                            <span class="side-menu__label">{{ __('sidebar.ambulance') }}</span>
                            <i class="angle fe fe-chevron-down"></i>
                        </a>
                        <ul class="slide-menu">
                            <li><a class="slide-item" href="{{ route('ambulance-hospital.index') }}">{{ __('sidebar.manage_ambulance') }}</a></li>
                        </ul>
                    </li>

                    <li class="side-item side-item-category">{{ __('sidebar.elements') }}</li>
                    <li class="slide">
                        <a class="side-menu__item" data-toggle="slide" href="#">
                            <i class="fas fa-user-injured side-menu__icon"></i>
                            <span class="side-menu__label">{{ __('sidebar.patients') }}</span>
                            <i class="angle fe fe-chevron-down"></i>
                        </a>
                        <ul class="slide-menu">
                            <li><a class="slide-item" href="{{ route('patient-hospital.index') }}">{{ __('sidebar.manage_patients') }}</a></li>
                        </ul>
                    </li>

                    <li class="slide">
                        <a class="side-menu__item" data-toggle="slide" href="#">
                            <i class="fas fa-file-invoice side-menu__icon"></i>
                            <span class="side-menu__label">{{ __('sidebar.invoices') }}</span>
                            <i class="angle fe fe-chevron-down"></i>
                        </a>
                        <ul class="slide-menu">
                            <li><a class="slide-item" href="{{ route('invoices.index') }}">{{ __('sidebar.manage_invoices') }}</a></li>
                        </ul>
                    </li>

                    <li class="slide">
                        <a class="side-menu__item" data-toggle="slide" href="#">
                            <i class="fas fa-wallet side-menu__icon"></i>
                            <span class="side-menu__label">{{ __('sidebar.accounts') }}</span>
                            <i class="angle fe fe-chevron-down"></i>
                        </a>
                        <ul class="slide-menu">
                            <li><a class="slide-item" href="{{ route('receipt-box.index') }}">{{ __('sidebar.receipt_vouchers') }}</a></li>
                            <li><a class="slide-item" href="{{ route('paiment-box.index') }}">{{ __('sidebar.payment_vouchers') }}</a></li>
                        </ul>
                    </li>

                    <li class="slide">
                        <a class="side-menu__item" data-toggle="slide" href="#">
                            <i class="fas fa-user-tie side-menu__icon"></i>
                            <span class="side-menu__label">{{ __('sidebar.staff') }}</span>
                            <i class="angle fe fe-chevron-down"></i>
                        </a>
                        <ul class="slide-menu">
                            <li><a class="slide-item" href="{{ route('staff-hospital.index') }}">{{ __('sidebar.all_staff') }}</a></li>
                        </ul>
                    </li>

                    <li class="slide">
                        <a class="side-menu__item" data-toggle="slide" href="#">
                            <i class="fas fa-envelope side-menu__icon"></i>
                            <span class="side-menu__label">{{ __('sidebar.messages') }}</span>
                            <i class="angle fe fe-chevron-down"></i>
                        </a>
                        <ul class="slide-menu">
                            <li><a class="slide-item" href="{{ route('create.conversation') }}">{{ __('sidebar.all_messages') }}</a></li>
                            <li><a class="slide-item" href="{{ route('admin.chat') }}">{{ __('sidebar.recent_messages') }}</a></li>
                        </ul>
                    </li>
                </ul>

            </div>
		</aside>
<!-- main-sidebar -->
