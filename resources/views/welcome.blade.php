
@extends('Website.layouts.master')
@section('content')
    @section('content')

        <!-- Main Slider Three -->
        <section class="main-slider-three">
            <div class="banner-carousel">
                <!-- Swiper -->
                <div class="swiper-wrapper">

                    <!-- Slide 1 -->
                    <div class="swiper-slide slide">
                        <div class="auto-container">
                            <div class="row clearfix">

                                <!-- Content Column -->
                                <div class="content-column col-lg-6 col-md-12 col-sm-12">
                                    <div class="inner-column">
                                        <h2>{{ __('slider.trusted_partner') }}</h2>
                                        <div class="text">{{ __('slider.free_consulting') }}</div>
                                        <div class="btn-box">
                                            <a href="contact.html" class="theme-btn appointment-btn">
                                                <span class="txt">{{ __('slider.appointment') }}</span>
                                            </a>
                                            <a href="services.html" class="theme-btn services-btn">
                                                {{ __('slider.services') }}
                                            </a>
                                        </div>
                                    </div>
                                </div>

                                <!-- Image Column -->
                                <div class="image-column col-lg-6 col-md-12 col-sm-12">
                                    <div class="inner-column">
                                        <div class="image">
                                            <img src="{{asset('Website\images\doctor\mature-woman-talking-male-doctor-hospital-waiting-room.jpg')}}" alt="{{ __('slider.image_alt') }}" />
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>

                    <!-- Slide 2 -->
                    <div class="swiper-slide slide">
                        <div class="auto-container">
                            <div class="row clearfix">

                                <!-- Content Column -->
                                <div class="content-column col-lg-6 col-md-12 col-sm-12">
                                    <div class="inner-column">
                                        <h2>{{ __('slider.trusted_partner') }}</h2>
                                        <div class="text">{{ __('slider.free_consulting') }}</div>
                                        <div class="btn-box">
                                            <a href="contact.html" class="theme-btn appointment-btn">
                                                <span class="txt">{{ __('slider.appointment') }}</span>
                                            </a>
                                            <a href="services.html" class="theme-btn services-btn">
                                                {{ __('slider.services') }}
                                            </a>
                                        </div>
                                    </div>
                                </div>

                                <!-- Image Column -->
                                <div class="image-column col-lg-4 col-md-12 col-sm-12">
                                    <div class="inner-column">
                                        <div class="image" >
                                            <img src="{{asset('Website\images\doctor\side-view-doctors-chatting-work.jpg')}}" alt="{{ __('slider.image_alt') }}"  />
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>

                    <!-- Slide 3 -->
                    <div class="swiper-slide slide">
                        <div class="auto-container">
                            <div class="row clearfix">

                                <!-- Content Column -->
                                <div class="content-column col-lg-6 col-md-12 col-sm-12">
                                    <div class="inner-column">
                                        <h2>{{ __('slider.trusted_partner') }}</h2>
                                        <div class="text">{{ __('slider.free_consulting') }}</div>
                                        <div class="btn-box">
                                            <a href="contact.html" class="theme-btn appointment-btn">
                                                <span class="txt">{{ __('slider.appointment') }}</span>
                                            </a>
                                            <a href="services.html" class="theme-btn services-btn">
                                                {{ __('slider.services') }}
                                            </a>
                                        </div>
                                    </div>
                                </div>

                                <!-- Image Column -->
                                <div class="image-column col-lg-6 col-md-12 col-sm-12">
                                    <div class="inner-column">
                                        <div class="image">
                                            <img src="images/main-slider/3.jpg" alt="{{ __('slider.image_alt') }}" />
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>

                </div>

                <!-- Add Arrows -->
                <div class="swiper-button-next"></div>
                <div class="swiper-button-prev"></div>
            </div>
        </section>

        <!-- End Main Slider -->

        <!-- Health Section -->
        <section class="health-section">
            <div class="auto-container">
                <div class="inner-container">

                    <div class="row clearfix">

                        <!-- Content Column -->
                        <div class="content-column col-lg-7 col-md-12 col-sm-12">
                            <div class="inner-column">
                                <div class="border-line"></div>
                                <!-- Sec Title -->
                                <div class="sec-title">
                                    <h2>{{ __('health.who_we_are') }} <br> {{ __('health.pioneering_in_health') }}</h2>
                                    <div class="separator"></div>
                                </div>
                                <div class="text">{{ __('health.description') }}</div>
                                <a href="about.html" class="theme-btn btn-style-one">
                                    <span class="txt">{{ __('health.more_about_us') }}</span>
                                </a>
                            </div>
                        </div>

                        <!-- Image Column -->
                        <div class="image-column col-lg-5 col-md-12 col-sm-12">
                            <div class="inner-column wow fadeInRight" data-wow-delay="0ms" data-wow-duration="1500ms">
                                <div class="image">
                                    <img src="{{asset('Website\images\doctor\labor-union-members-working-together.jpg')}}" alt="{{ __('health.image_alt') }}" />
                                </div>
                            </div>
                        </div>

                    </div>

                </div>
            </div>
        </section>

        <!-- End Health Section -->

        <!-- Featured Section -->
        <section class="featured-section">
            <div class="auto-container">
                <div class="row clearfix">

                    <!-- Feature Block 1 -->
                    <div class="feature-block col-lg-3 col-md-6 col-sm-12">
                        <div class="inner-box wow fadeInLeft" data-wow-delay="0ms" data-wow-duration="1500ms">
                            <div class="upper-box">
                                <div class="icon flaticon-doctor-stethoscope"></div>
                                <h3><a href="#">{{ __('features.medical_treatment_title') }}</a></h3>
                            </div>
                            <div class="text">{{ __('features.medical_treatment_text') }}</div>
                        </div>
                    </div>

                    <!-- Feature Block 2 -->
                    <div class="feature-block col-lg-3 col-md-6 col-sm-12">
                        <div class="inner-box wow fadeInLeft" data-wow-delay="250ms" data-wow-duration="1500ms">
                            <div class="upper-box">
                                <div class="icon flaticon-ambulance-side-view"></div>
                                <h3><a href="#">{{ __('features.emergency_help_title') }}</a></h3>
                            </div>
                            <div class="text">{{ __('features.emergency_help_text') }}</div>
                        </div>
                    </div>

                    <!-- Feature Block 3 -->
                    <div class="feature-block col-lg-3 col-md-6 col-sm-12">
                        <div class="inner-box wow fadeInLeft" data-wow-delay="500ms" data-wow-duration="1500ms">
                            <div class="upper-box">
                                <div class="icon fas fa-user-md"></div>
                                <h3><a href="#">{{ __('features.qualified_doctors_title') }}</a></h3>
                            </div>
                            <div class="text">{{ __('features.qualified_doctors_text') }}</div>
                        </div>
                    </div>

                    <!-- Feature Block 4 -->
                    <div class="feature-block col-lg-3 col-md-6 col-sm-12">
                        <div class="inner-box wow fadeInLeft" data-wow-delay="750ms" data-wow-duration="1500ms">
                            <div class="upper-box">
                                <div class="icon fas fa-briefcase-medical"></div>
                                <h3><a href="#">{{ __('features.medical_professionals_title') }}</a></h3>
                            </div>
                            <div class="text">{{ __('features.medical_professionals_text') }}</div>
                        </div>
                    </div>

                </div>
            </div>
        </section>

        <!-- End Featured Section -->

        <!-- Department Section Three -->
        <section class="department-section-three">
            <div class="image-layer" style="background-image:url('images/background/6.jpg')"></div>
            <div class="auto-container">
                <!-- Department Tabs -->
                <div class="department-tabs tabs-box">
                    <div class="row clearfix">
                        <!-- Column: Tabs -->
                        <div class="col-lg-4 col-md-12 col-sm-12">
                            <!-- Section Title -->
                            <div class="sec-title light">
                                <h2>{{ __('department.title_main') }} <br> {{ __('department.title_sub') }}</h2>
                                <div class="separator"></div>
                            </div>
                            <!-- Tab Buttons -->
                            <ul class="tab-btns tab-buttons clearfix">
                                @foreach(\App\Models\Sections\Section::latest()->take(5)->get() as $key => $section)
                                    <li data-tab="#tab-{{ $section->id }}" class="tab-btn {{ $key == 0 ? 'active-btn' : '' }}">
                                        {{ $section->name }}
                                    </li>
                                @endforeach
                            </ul>
                        </div>

                        <!-- Column: Tab Content -->
                        <div class="col-lg-8 col-md-12 col-sm-12">
                            <!-- Tabs Content -->
                            <div class="tabs-content">
                                @foreach(\App\Models\Sections\Section::latest()->take(5)->get() as $key => $section)
                                    <div class="tab {{ $key == 0 ? 'active-tab' : '' }}" id="tab-{{ $section->id }}">
                                        <div class="content">
                                            <h2>{{ $section->name }}</h2>
                                            <div class="title">{{ __('department.fixed_title') }}</div>
                                            <div class="text">
                                                <p>{{ __('department.fixed_description_paragraph1') }}</p>
                                                <p>{{ __('department.fixed_description_paragraph2') }}</p>
                                            </div>
                                            <div class="two-column row clearfix">
                                                <div class="column col-lg-6 col-md-6 col-sm-12">
                                                    <h3>{{ __('department.fixed_service1') }}</h3>
                                                    <div class="column-text">{{ __('department.fixed_service1_text') }}</div>
                                                </div>
                                                <div class="column col-lg-6 col-md-6 col-sm-12">
                                                    <h3>{{ __('department.fixed_service2') }}</h3>
                                                    <div class="column-text">{{ __('department.fixed_service2_text') }}</div>
                                                </div>
                                            </div>
                                            <a href="{{ $section->more_details_link }}" class="theme-btn btn-style-two">
                                                <span class="txt">{{ __('department.view_more') }}</span>
                                            </a>
                                        </div>
                                    </div>
                                @endforeach

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>


        <!-- End Department Section -->

        <style>
            .doctor-image {
                width: 200px; /* العرض الثابت للصورة */
                height: 200px; /* الارتفاع الثابت للصورة */
                object-fit: cover; /* يجعل الصورة تتناسب مع الحاوية */
                /*border-radius: 50%; !* لجعل الصور دائرية *!*/
                display: block; /* لإزالة أي مسافات إضافية حول الصورة */
                margin: 0 auto; /* محاذاة الصورة إلى المنتصف */
            }

        </style>
        <!-- Team Section -->
        <section class="team-section">
            <div class="auto-container">

                <!-- Sec Title -->
                <div class="sec-title centered">
                    <h2>{{ __('team.title') }}</h2>
                    <div class="separator"></div>
                </div>

                <div class="row clearfix">
                    @foreach(\App\Models\Doctors\Doctor::latest()->take(4)->get() as $doctor)
                        <!-- Team Block -->
                        <div class="team-block col-lg-3 col-md-6 col-sm-6 col-xs-12">
                            <div class="inner-box wow fadeInLeft" data-wow-delay="0ms" data-wow-duration="1500ms">
                                <div class="image">
                                    @if($doctor->image)
                                        <img src="{{ asset('Dashboard/img/doctors/' . $doctor->image->filename) }}" class="doctor-image" alt="{{ $doctor->name }}">
                                    @else
                                        <img src="{{ asset('Website/images/doctor/img1.avif') }}" class="doctor-image" alt="Default Doctor Image">
                                    @endif

                                    <div class="overlay-box">
                                        <ul class="social-icons">
                                            @if($doctor->facebook)<li><a href="{{ $doctor->facebook }}"><span class="fab fa-facebook-f"></span></a></li>@endif
                                            @if($doctor->google)<li><a href="{{ $doctor->google }}"><span class="fab fa-google"></span></a></li>@endif
                                            @if($doctor->twitter)<li><a href="{{ $doctor->twitter }}"><span class="fab fa-twitter"></span></a></li>@endif
                                            @if($doctor->skype)<li><a href="{{ $doctor->skype }}"><span class="fab fa-skype"></span></a></li>@endif
                                            @if($doctor->linkedin)<li><a href="{{ $doctor->linkedin }}"><span class="fab fa-linkedin-in"></span></a></li>@endif
                                        </ul>
                                        <a href="#" class="appointment">{{ __('team.make_appointment') }}</a>
                                    </div>
                                </div>

                                <div class="lower-content">
                                    <h3><a href="#">{{ $doctor->name }}</a></h3>
                                    <div class="designation">{{ $doctor->speciality }}</div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

            </div>
        </section>


        <!-- End Team Section -->

        <!-- Video Section -->
        <section class="video-section" style="background-image:url(images/background/5.jpg)">
            <div class="auto-container">
                <div class="content">
                    <a href="https://youtu.be/HMjc-UHyDjk?si=Teb8FBvAga2gRhdd" class="lightbox-image play-box">
                        <span class="flaticon-play-button"><i class="ripple"></i></span>
                    </a>
                    <div class="text">{{ __('video.text') }}</div>
                    <h2>{{ __('video.heading') }}</h2>
                </div>
            </div>
        </section>

        <!-- End Video Section -->

        <!-- Appointment Section Two -->


        <!-- Testimonial Section Two -->
        <section class="testimonial-section-two">
            <div class="auto-container">
                <!-- Sec Title -->
                <div class="sec-title centered">
                    <h2>{{ __('testimonial.title') }}</h2>
                    <div class="separator"></div>
                </div>
                <div class="testimonial-carousel owl-carousel owl-theme">

                    @foreach(__('testimonial.reviews') as $review)
                        <!-- Testimonial Block Two -->
                        <div class="testimonial-block-two">
                            <div class="inner-box">
                                <div class="image">
                                    <img src="{{ $review['image'] }}" alt="{{ $review['alt'] }}" />
                                </div>
                                <div class="text">{{ $review['text'] }}</div>
                                <div class="lower-box">
                                    <div class="clearfix">
                                        <div class="pull-left">
                                            <div class="quote-icon flaticon-quote"></div>
                                        </div>
                                        <div class="pull-right">
                                            <div class="author-info">
                                                <h3>{{ $review['name'] }}</h3>
                                                <div class="author">{{ $review['designation'] }}</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach

                </div>
            </div>
        </section>

        <!-- End Testimonial Section Two -->

        <!-- Counter Section -->
        <section class="counter-section style-two" style="background-image: url('images/background/pattern-3.png')">
            <div class="auto-container">

                <!-- Fact Counter -->
                <div class="fact-counter style-two">
                    <div class="row clearfix">

                        @foreach(__('counter.items') as $item)
                            <!--Column-->
                            <div class="column counter-column col-lg-3 col-md-6 col-sm-12">
                                <div class="inner wow fadeInLeft" data-wow-delay="{{ $item['delay'] }}" data-wow-duration="1500ms">
                                    <div class="content">
                                        <div class="icon {{ $item['icon'] }}"></div>
                                        <div class="count-outer count-box {{ $item['alternate'] ? 'alternate' : '' }}">
                                            {{ $item['prefix'] }}<span class="count-text" data-speed="{{ $item['speed'] }}" data-stop="{{ $item['count'] }}">0</span>
                                        </div>
                                        <h4 class="counter-title">{{ $item['title'] }}</h4>
                                    </div>
                                </div>
                            </div>
                        @endforeach

                    </div>
                </div>

            </div>
        </section>
        <!-- End Counter Section -->

        <!-- Doctor Info Section -->
        <!-- Doctor Info Section -->
        <section class="doctor-info-section">
            <div class="auto-container">
                <div class="inner-container">
                    <div class="row clearfix">

                        @foreach(__('doctor_info.blocks') as $block)
                            <!-- Doctor Block -->
                            <div class="doctor-block col-lg-4 col-md-6 col-sm-12">
                                <div class="inner-box wow fadeIn{{ $block['animation'] }}" data-wow-delay="0ms" data-wow-duration="1500ms">
                                    <h3>{{ $block['title'] }}</h3>

                                    @if(isset($block['list']))
                                        <ul class="doctor-time-list">
                                            @foreach($block['list'] as $item)
                                                <li>{{ $item['day'] }} <span>{{ $item['hours'] }}</span></li>
                                            @endforeach
                                        </ul>
                                    @endif

                                    <div class="text">{{ $block['text'] ?? '' }}</div>
                                    @if(isset($block['contact']))
                                        <div class="phone">{{ $block['contact'] }} <strong>{{ $block['phone'] }}</strong></div>
                                    @endif
                                    @if(isset($block['link']))
                                        <a href="#" class="detail">{{ $block['link'] }}</a>
                                    @endif
                                </div>
                            </div>
                        @endforeach

                    </div>
                </div>
            </div>
        </section>

        <!-- News Section Two -->
        <section class="news-section-two">
            <div class="auto-container">
                <!-- Sec Title -->
                <div class="sec-title centered">
                    <h2>{{ __('news_section.title') }}</h2>
                    <div class="separator style-three"></div>
                </div>
                <div class="row clearfix">

                    @foreach(__('news_section.articles') as $article)
                        <!-- News Block Two -->
                        <div class="news-block-two col-lg-6 col-md-12 col-sm-12">
                            <div class="inner-box">
                                <div class="image">
                                    <a href="blog-detail.html"><img src="{{ $article['image'] }}" alt="" /></a>
                                </div>
                                <div class="lower-content">
                                    <div class="content">
                                        <ul class="post-info">
                                            <li><span class="icon flaticon-chat-comment-oval-speech-bubble-with-text-lines"></span> {{ $article['comments'] }}</li>
                                            <li><span class="icon flaticon-heart"></span> {{ $article['likes'] }}</li>
                                        </ul>
                                        <ul class="post-meta">
                                            <li>{{ $article['date'] }}</li>
                                            <li>{{ $article['author'] }}</li>
                                        </ul>
                                        <h3><a href="blog-detail.html">{{ $article['title'] }}</a></h3>
                                        <div class="text">{{ $article['excerpt'] }}</div>
                                        <a href="blog-detail.html" class="theme-btn btn-style-five"><span class="txt">{{ $article['read_more'] }}</span></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach

                </div>
            </div>
        </section>

        <!-- Clients Section -->
        <section class="clients-section">
            <div class="outer-container">
                <div class="sponsors-outer">
                    <!-- Sponsors Carousel -->
                    <ul class="sponsors-carousel owl-carousel owl-theme">
                        @foreach(__('clients.logos') as $logo)
                            <li class="slide-item">
                                <figure class="image-box">
                                    <a href="#"><img src="{{ $logo }}" alt=""></a>
                                </figure>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </section>

    @endsection


