<style>
    /* تحسين نمط زر اللغة */
    .language-switcher a {
        display: flex;
        align-items: center;
        padding: 10px;
        color: #333;
        font-weight: bold;
        text-decoration: none;
        transition: color 0.3s ease;
    }

    .language-switcher a:hover {
        color: #007bff;
    }

    .language-switcher .avatar img {
        width: 30px; /* حجم الصورة */
        height: 20px;
        margin-right: 8px;
        border-radius: 4px;
    }

    .language-switcher strong {
        font-size: 14px;
    }

    /* تحسين شكل القائمة Dropdown */
    .language-switcher .dropdown-menu {
        padding: 10px;
        border-radius: 5px;
        background-color: #f8f9fa;
        border: none;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }

    .language-switcher .dropdown-item {
        display: flex;
        align-items: center;
        padding: 5px 10px;
        color: #333;
        transition: background-color 0.3s ease;
    }

    .language-switcher .dropdown-item:hover {
        background-color: #007bff;
        color: white;
    }

    .language-switcher .dropdown-item i {
        margin-right: 8px;
        color: #007bff;
    }
    .navigation {
        display: flex;
        justify-content: space-between;
        align-items: center;
        list-style: none;
        padding: 0;
        margin: 0;
    }

    .navigation .auth-btn {
        margin-left: auto;
        margin-right: 10px;
    }

    .navigation li {
        position: relative;
        margin: 0 10px;
    }

    .navigation a {
        text-decoration: none;
        color: #333; /* لون أسود أو محايد */
        padding: 5px 10px;
        transition: color 0.3s ease;
    }

    .navigation a:hover {
        color: #555; /* لون خافت عند التمرير */
    }

    .navigation .dropdown-menu {
        display: none;
        position: absolute;
        top: 100%;
        left: 0;
        background-color: #fff;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        list-style: none;
        padding: 10px 0;
    }

    .navigation .dropdown:hover .dropdown-menu {
        display: block;
    }

    .auth-btn a {
        color: #000; /* أزرار تسجيل الدخول بدون لون إضافي */
        font-weight: bold;
    }

    .auth-btn a:hover {
        text-decoration: underline; /* لمسة بسيطة عند التمرير */
    }

</style>

<div class="nav-outer clearfix ">
    <!--Mobile Navigation Toggler For Mobile--><div class="mobile-nav-toggler"><span class="icon flaticon-menu"></span></div>
    <nav class="main-menu navbar-expand-md navbar-light">
        <div class="navbar-header">
            <!-- Togg le Button -->
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="icon flaticon-menu"></span>
            </button>
        </div>

        <div class="collapse navbar-collapse clearfix" id="navbarSupportedContent">
            <ul class="navigation clearfix">

                <!-- الرئيسية -->
                <li class="current dropdown">
                    <a href="#">{{ __('menu.home') }}</a>
                    <ul>
                        <li><a href="index.html">{{ __('menu.home_page_01') }}</a></li>
                        <li><a href="index-2.html">{{ __('menu.home_page_02') }}</a></li>
                        <li><a href="index-3.html">{{ __('menu.home_page_03') }}</a></li>
                        <li><a href="index-4.html">{{ __('menu.home_page_04') }}</a></li>
                        <li class="dropdown">
                            <a href="#">{{ __('menu.header_styles') }}</a>
                            <ul>
                                <li><a href="index.html">{{ __('menu.header_style_one') }}</a></li>
                                <li><a href="index-2.html">{{ __('menu.header_style_two') }}</a></li>
                                <li><a href="index-3.html">{{ __('menu.header_style_three') }}</a></li>
                                <li><a href="index-4.html">{{ __('menu.header_style_four') }}</a></li>
                            </ul>
                        </li>
                    </ul>
                </li>

                <!-- من نحن -->
                <li class="dropdown">
                    <a href="#">{{ __('menu.about_us') }}</a>
                    <ul>
                        <li><a href="about.html">{{ __('menu.about_us') }}</a></li>
                        <li><a href="team.html">{{ __('menu.our_team') }}</a></li>
                        <li><a href="faq.html">{{ __('menu.faq') }}</a></li>
                        <li><a href="services.html">{{ __('menu.services') }}</a></li>
                        <li><a href="gallery.html">{{ __('menu.gallery') }}</a></li>
                        <li><a href="coming-soon.html">{{ __('menu.coming_soon') }}</a></li>
                    </ul>
                </li>

                <!-- الصفحات -->
                <li class="dropdown has-mega-menu">
                    <a href="#">{{ __('menu.pages') }}</a>
                    <div class="mega-menu">
                        <div class="mega-menu-bar row clearfix">
                            <div class="column col-md-3 col-xs-12">
                                <h3>{{ __('menu.about_us') }}</h3>
                                <ul>
                                    <li><a href="about.html">{{ __('menu.about_us') }}</a></li>
                                    <li><a href="team.html">{{ __('menu.our_team') }}</a></li>
                                    <li><a href="faq.html">{{ __('menu.faq') }}</a></li>
                                    <li><a href="services.html">{{ __('menu.services') }}</a></li>
                                </ul>
                            </div>
                            <div class="column col-md-3 col-xs-12">
                                <h3>{{ __('menu.doctors') }}</h3>
                                <ul>
                                    <li><a href="doctors.html">{{ __('menu.doctors') }}</a></li>
                                    <li><a href="doctors-detail.html">{{ __('menu.doctors_detail') }}</a></li>
                                </ul>
                            </div>
                            <div class="column col-md-3 col-xs-12">
                                <h3>{{ __('menu.blog') }}</h3>
                                <ul>
                                    <li><a href="blog.html">{{ __('menu.our_blog') }}</a></li>
                                    <li><a href="blog-classic.html">{{ __('menu.blog_classic') }}</a></li>
                                    <li><a href="blog-detail.html">{{ __('menu.blog_detail') }}</a></li>
                                </ul>
                            </div>
                            <div class="column col-md-3 col-xs-12">
                                <h3>{{ __('menu.shop') }}</h3>
                                <ul>
                                    <li><a href="shop.html">{{ __('menu.shop') }}</a></li>
                                    <li><a href="shop-single.html">{{ __('menu.shop_details') }}</a></li>
                                    <li><a href="shoping-cart.html">{{ __('menu.cart_page') }}</a></li>
                                    <li><a href="checkout.html">{{ __('menu.checkout_page') }}</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </li>

                <!-- الأطباء -->
                <li class="dropdown">
                    <a href="#">{{ __('menu.doctors') }}</a>
                    <ul>
                        <li><a href="doctors.html">{{ __('menu.doctors') }}</a></li>
                        <li><a href="doctors-detail.html">{{ __('menu.doctors_detail') }}</a></li>
                    </ul>
                </li>

                <!-- الأقسام -->
                <li class="dropdown">
                    <a href="#">{{ __('menu.departments') }}</a>
                    <ul>
                        <li><a href="department.html">{{ __('menu.department') }}</a></li>
                        <li><a href="department-detail.html">{{ __('menu.department_detail') }}</a></li>
                    </ul>
                </li>

                <!-- المقالات -->
                <li class="dropdown">
                    <a href="#">{{ __('menu.articles') }}</a>
                    <ul>
                        <li><a href="blog.html">{{ __('menu.our_blog') }}</a></li>
                        <li><a href="blog-classic.html">{{ __('menu.blog_classic') }}</a></li>
                        <li><a href="blog-detail.html">{{ __('menu.blog_detail') }}</a></li>
                    </ul>
                </li>

                <!-- المتجر -->
                <li class="dropdown">
                    <a href="#">{{ __('menu.shop') }}</a>
                    <ul>
                        <li><a href="shop.html">{{ __('menu.shop') }}</a></li>
                        <li><a href="shop-single.html">{{ __('menu.shop_details') }}</a></li>
                        <li><a href="shoping-cart.html">{{ __('menu.cart_page') }}</a></li>
                        <li><a href="checkout.html">{{ __('menu.checkout_page') }}</a></li>
                    </ul>
                </li>

                <!-- تواصل معنا -->
                <li><a href="contact.html">{{ __('menu.contact') }}</a></li>
                <li class="dropdown">
                    <div class="language-switcher dropdown nav-item">
                        <a href="#" class="pl-0 d-flex nav-item nav-link country-flag1" data-toggle="dropdown" aria-expanded="false">
                            @if (App::getLocale() == 'ar')
                                <span class="avatar country-Flag align-self-center">
                <img src="{{URL::asset('Dashboard/img/flags/syiranImageFlage.jpg')}}" alt="img">
            </span>
                                <strong>{{ LaravelLocalization::getCurrentLocaleName() }}</strong>
                            @else
                                <span class="avatar country-Flag align-self-center">
                <img src="{{URL::asset('Dashboard/img/flags/us_flag.jpg')}}" alt="img">
            </span>
                                <strong>{{ LaravelLocalization::getCurrentLocaleName() }}</strong>
                            @endif
                        </a>
                        <div class="dropdown-menu dropdown-menu-left dropdown-menu-arrow">
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

                @if (Route::has('login'))
                    @auth
                        <li class="auth-btn">
                            <a href="{{ url('/dashboard') }}">
                                <i class="fas fa-user-circle me-2"></i>{{ __('menu.dashboard') }}
                            </a>
                        </li>
                    @else
                        <li class="auth-btn dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <i class="fas fa-sign-in-alt me-2"></i>{{ __('menu.login') }}
                            </a>
                            <ul class="dropdown-menu">
                                <li><a href="{{ route('login') }}">{{ __('menu.user_login') }}</a></li>
                                <li><a href="{{ route('admin.login') }}">{{ __('menu.admin_login') }}</a></li>
                                <li><a href="{{ route('doctor.login') }}">{{ __('menu.doctor_login') }}</a></li>
                                <li><a href="{{ route('staff.login') }}">{{ __('menu.staff_login') }}</a></li>
                            </ul>
                        </li>

                    @endauth
                @endif

            </ul>

        </div>



    </nav>
    <!-- Main Menu End-->

    <!-- Main Menu End-->
    <div class="outer-box clearfix">
        <!-- Main Menu End-->
        <div class="nav-box">
            <div class="nav-btn nav-toggler navSidebar-button">
                <span class="icon flaticon-menu-1"></span>
            </div>
        </div>

        <!-- Search Btn -->

    </div>

</div>

















