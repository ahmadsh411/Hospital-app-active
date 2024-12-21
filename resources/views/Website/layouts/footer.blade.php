<!--Main Footer-->
<footer class="main-footer style-two">
    <div class="auto-container">
        <!--Widgets Section-->
        <div class="widgets-section">
            <div class="row clearfix">

                <!--Big Column-->
                <div class="big-column col-lg-6 col-md-12 col-sm-12">
                    <div class="row clearfix">

                        <!--Footer Column-->
                        <div class="footer-column col-lg-7 col-md-6 col-sm-12">
                            <div class="footer-widget logo-widget">
                                <div class="logo">
                                    <a href="index.html"><img src="images/logo-3.png" alt="{{ __('footer.logo_alt') }}" /></a>
                                </div>
                                <div class="text">{{ __('footer.about_text') }}</div>
                                <ul class="social-icons">
                                    <li><a href="#"><span class="fab fa-facebook-f"></span></a></li>
                                    <li><a href="#"><span class="fab fa-google"></span></a></li>
                                    <li><a href="#"><span class="fab fa-twitter"></span></a></li>
                                    <li><a href="#"><span class="fab fa-skype"></span></a></li>
                                    <li><a href="#"><span class="fab fa-linkedin"></span></a></li>
                                </ul>
                            </div>
                        </div>

                        <!--Footer Column-->
                        <div class="footer-column col-lg-5 col-md-6 col-sm-12">
                            <div class="footer-widget links-widget">
                                <div class="footer-title clearfix">
                                    <h2>{{ __('footer.departments_title') }}</h2>
                                    <div class="separator"></div>
                                </div>
                                <ul class="footer-list">
                                    <li><a href="#">{{ __('footer.departments.surgery_radiology') }}</a></li>
                                    <li><a href="#">{{ __('footer.departments.family_medicine') }}</a></li>
                                    <li><a href="#">{{ __('footer.departments.womens_health') }}</a></li>
                                    <li><a href="#">{{ __('footer.departments.optician') }}</a></li>
                                    <li><a href="#">{{ __('footer.departments.pediatrics') }}</a></li>
                                    <li><a href="#">{{ __('footer.departments.dermatology') }}</a></li>
                                </ul>
                            </div>
                        </div>

                    </div>
                </div>

                <!--Big Column-->
                <div class="big-column col-lg-6 col-md-12 col-sm-12">
                    <div class="row clearfix">

                        <!--Footer Column-->
                        <div class="footer-column col-lg-6 col-md-6 col-sm-12">
                            <div class="footer-widget news-widget">
                                <div class="footer-title clearfix">
                                    <h2>{{ __('footer.news_title') }}</h2>
                                    <div class="separator"></div>
                                </div>

                                <!--News Widget Block-->
                                <div class="news-widget-block">
                                    <div class="widget-inner">
                                        <div class="image">
                                            <img src="{{asset('Website\images\doctor\health-assistant-taking-care-female-patient.jpg')}}" alt="{{ __('footer.news_image1_alt') }}" />
                                        </div>
                                        <h3><a href="blog-detail.html">{{ __('footer.news1_title') }}</a></h3>
                                        <div class="post-date">{{ __('footer.news1_date') }}</div>
                                    </div>
                                </div>

                                <!--News Widget Block-->
                                <div class="news-widget-block">
                                    <div class="widget-inner">
                                        <div class="image">
                                            <img src="{{asset('Website\images\doctor\hands-unrecognizable-female-doctor-giving-pills-patient.jpg')}}" alt="{{ __('footer.news_image2_alt') }}" />
                                        </div>
                                        <h3><a href="blog-detail.html">{{ __('footer.news2_title') }}</a></h3>
                                        <div class="post-date">{{ __('footer.news2_date') }}</div>
                                    </div>
                                </div>

                            </div>
                        </div>

                        <!--Footer Column-->
                        <div class="footer-column col-lg-6 col-md-6 col-sm-12">
                            <div class="footer-widget contact-widget">
                                <div class="footer-title clearfix">
                                    <h2>{{ __('footer.contact_title') }}</h2>
                                    <div class="separator"></div>
                                </div>

                                <ul class="contact-list">
                                    <li><span class="icon flaticon-placeholder"></span>{{ __('footer.contact.address') }}</li>
                                    <li><span class="icon flaticon-call"></span>{{ __('footer.contact.hours') }} <br> <a href="tel:+898-68679-575-09">{{ __('footer.contact.phone') }}</a></li>
                                    <li><span class="icon flaticon-message"></span>{{ __('footer.contact.question') }} <a href="mailto:info@gmail.com">{{ __('footer.contact.email') }}</a></li>
                                </ul>

                            </div>
                        </div>

                    </div>
                </div>

            </div>
        </div>
    </div>

    <!-- Footer Bottom -->
    <div class="footer-bottom">
        <div class="auto-container">
            <div class="copyright">{{ __('footer.copyright') }}</div>
        </div>
    </div>

</footer>
