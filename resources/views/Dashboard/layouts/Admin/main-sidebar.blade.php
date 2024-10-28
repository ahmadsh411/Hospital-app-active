<!-- main-sidebar -->
		<div class="app-sidebar__overlay" data-toggle="sidebar"></div>
		<aside class="app-sidebar sidebar-scroll">
			<div class="main-sidebar-header active">
				<a class="desktop-logo logo-light active" href="{{ url('/' . $page='index') }}"><img src="{{URL::asset('Dashboard/img/brand/logo.png')}}" class="main-logo" alt="logo"></a>
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
					<li class="side-item side-item-category">برنامج ادارة المستشفيات </li>
					<li class="slide">
                        <a class="side-menu__item" href="{{ route('admin.dashboard') }}">
                            <i class="fas fa-tachometer-alt side-menu__icon"></i>
                            <span class="side-menu__label">Dashboard</span>
                        </a>
					</li>
					<li class="side-item side-item-category">عناصر المشفى </li>

					<li class="slide">
                        <a class="side-menu__item" data-toggle="slide" href="{{ url('/' . $page='#') }}">
                            <i class="fas fa-th-list side-menu__icon"></i>
                            <span class="side-menu__label">{{ trans('Sections.Sections') }}</span>
                            <i class="angle fe fe-chevron-down"></i>
                        </a>
						<ul class="slide-menu">
							<li><a class="slide-item" href="{{ route('section.all')}}">كل الاقسام</a></li>

						</ul>
					</li>
					<li class="slide">
                        <a class="side-menu__item" data-toggle="slide" href="{{ url('/' . $page='#') }}">
                            <i class="fas fa-user-md side-menu__icon"></i>
                            <span class="side-menu__label">الاطباء</span>
                            <i class="angle fe fe-chevron-down"></i>
                        </a>
                        <ul class="slide-menu">
                            <li><a class="slide-item" href="{{ route('doctor.index') }}">كل الاطباء</a></li>
                        </ul>
					</li>
					<li class="side-item side-item-category">الخدمات</li>
                    <li class="slide">
                        <a class="side-menu__item" data-toggle="slide" href="#"">
                            <i class="fas fa-concierge-bell side-menu__icon"></i>
                            <span class="side-menu__label">الخدمات</span>
                            <i class="angle fe fe-chevron-down"></i>
                        </a>
                        <ul class="slide-menu">
                            <li><a class="slide-item" href="{{ route('services.index')}}">المفردة</a></li>
                            <li><a class="slide-item" href="{{ route('multi-services.index') }}">العروض</a></li>
                        </ul>
                    </li>
                    <li class="slide">
                        <a class="side-menu__item" data-toggle="slide" href="#">
                            <i class="fas fa-shield-alt side-menu__icon"></i>
                            <span class="side-menu__label">شركات التامين</span>
                            <i class="angle fe fe-chevron-down"></i>
                        </a>
                        <ul class="slide-menu">
                            <li><a class="slide-item" href="{{ route('insurance-company.index') }}">شركات التامين</a></li>
                        </ul>
                    </li>
                    <li class="slide">
                        <a class="side-menu__item" data-toggle="slide" href="#">
                            <i class="fas fa-ambulance side-menu__icon"></i>
                            <span class="side-menu__label">الاسعاف</span>
                            <i class="angle fe fe-chevron-down"></i>
                        </a>
                        <ul class="slide-menu">
                            <li><a class="slide-item" href="{{ route('ambulance-hospital.index')}}">ادارة الاسعاف</a></li>
                        </ul>
                    </li>

                    <!-- تأكد من تضمين Font Awesome في الصفحة -->
                    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

                    <li class="side-item side-item-category">العناصر</li>
                    <li class="slide">
                        <a class="side-menu__item" data-toggle="slide" href="{{ url('/' . $page='#') }}">
                            <i class="fas fa-user-injured side-menu__icon"></i>
                            <span class="side-menu__label">المرضى</span>
                            <i class="angle fe fe-chevron-down"></i>
                        </a>
                        <ul class="slide-menu">
                            <li><a class="slide-item" href="{{route('patient-hospital.index')}}">ادراة المرضى</a></li>
                        </ul>
                    </li>
                    <li class="slide">
                        <a class="side-menu__item" data-toggle="slide" href="#">
                            <i class="fas fa-file-invoice side-menu__icon"></i>
                            <span class="side-menu__label">الفواتير</span>
                            <i class="angle fe fe-chevron-down"></i>
                        </a>
                        <ul class="slide-menu">
                            <li><a class="slide-item" href="{{route('invoices.index')}}">الفواتير</a></li>
                        </ul>
                    </li>
                    <li class="slide">
                        <a class="side-menu__item" data-toggle="slide" href="#">
                            <i class="fas fa-wallet side-menu__icon"></i>
                            <span class="side-menu__label">الحسابات</span>
                            <i class="angle fe fe-chevron-down"></i>
                        </a>
                        <ul class="slide-menu">
                            <li><a class="slide-item" href="{{ route('receipt-box.index') }}">سندات القبض</a></li>
                            <li><a class="slide-item" href="{{ route('paiment-box.index') }}">سندات الدفع</a></li>
                        </ul>
                    </li>
                    <li class="slide">
                        <a class="side-menu__item" data-toggle="slide" href="#">
                            <i class="fas fa-user-tie side-menu__icon"></i>
                            <span class="side-menu__label">الموظفين </span>
                            <i class="angle fe fe-chevron-down"></i>
                        </a>
                        <ul class="slide-menu">
                            <li><a class="slide-item" href="{{route('staff-hospital.index')}}">كل الموظفين</a></li>
                        </ul>
                    </li>



				</ul>
			</div>
		</aside>
<!-- main-sidebar -->
