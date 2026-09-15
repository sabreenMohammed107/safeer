@if (session()->get('SiteUser'))
<div class="cartbox">
    <a href="{{ LaravelLocalization::getLocalizedURL($localVar, route('get_cart')) }}"><i
            class="fa-solid fa-cart-shopping"></i></a>
    @if (session()->get('SiteUser') && session()->get('hasCart'))
    <div class="cartCount"></div>
    @endif
</div>
@endif
<?php
$localVar = LaravelLocalization::getCurrentLocale();
?>
<div class="main-wrapper">
    <nav class="navbar container">
        <img src="{{ asset('/website_assets/images/logo3.webp') }}" @if (LaravelLocalization::getCurrentLocale()==='en'
            ) style=" margin: 0 0 0 15px;" @else style=" margin: 0 15px 0 0;" @endif alt="logo">
        <!-- offcanvas nav bar    -->
        <button class="btn canvase_button" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight"
            aria-controls="offcanvasRight">
            <span>{{ __('links.menu') }}</span> <i class="fas fa-bars"></i>
        </button>
        <div class="offcanvas offcanvas-end canvase_section" tabindex="-1" id="offcanvasRight"
            aria-labelledby="offcanvasRightLabel">
            <div class="offcanvas-body">
                <button type="button" class="canvase_close_button" data-bs-dismiss="offcanvas" aria-label="Close">
                    <i class="fa-solid fa-xmark"></i>
                </button>
                <button class="{{ Request::segment(2) == null ? 'offcan_buttons active' : 'offcan_buttons' }} ">
                    <a href="{{ LaravelLocalization::localizeUrl('/') }} ">{{ __('links.home') }}</a>
                </button>
                {{-- <button class="{{ Request::segment(2)=='about' ? 'offcan_buttons active' : 'offcan_buttons' }}">
                    <a href="{{ LaravelLocalization::localizeUrl('/about') }}">{{ __('links.about_us') }}</a>
                </button> --}}
                {{-- <button class="{{ Request::segment(2) == 'hotels' ? 'offcan_buttons active' : 'offcan_buttons' }}">
                    <a href="{{ LaravelLocalization::localizeUrl('/hotels') }}">{{ __('links.hotels') }}</a>
                </button> --}}
                <button class="{{ Request::segment(2) == 'tours' ? 'offcan_buttons active' : 'offcan_buttons' }}">
                    <a href="{{ LaravelLocalization::localizeUrl('/tours') }}">{{ __('links.tours') }}</a>
                </button>
                <button class="{{ Request::segment(2) == 'offers' ? 'offcan_buttons active' : 'offcan_buttons' }}">
                    <a href="{{ LaravelLocalization::localizeUrl('/offers') }}">{{ __('links.offers') }}</a>
                </button>
                <button class="{{ Request::segment(2) == 'transfers' ? 'offcan_buttons active' : 'offcan_buttons' }}">
                    <a href="{{ LaravelLocalization::localizeUrl('/transfers') }}">{{ __('links.transfer') }}</a>
                </button>
                <button class="{{ Request::segment(2) == 'visa' ? 'offcan_buttons active' : 'offcan_buttons' }}">
                    <a href="{{ LaravelLocalization::localizeUrl('/visa') }}">{{ __('links.visa') }}</a>
                </button>

                <button class="{{ Request::segment(2) == 'blogs' ? 'offcan_buttons active' : 'offcan_buttons' }}">
                    <a href="{{ LaravelLocalization::localizeUrl('/blogs') }}">{{ __('links.blogs') }}</a>
                </button>
                <button class="offcan_buttons dropdown-mobile">
                    <a href="#" class="dropdown-toggle">{{ __('links.about_us') }}</a>
                    <ul class="dropdown-menu-mobile">
                        <li><a href="{{ LaravelLocalization::localizeUrl('/contact') }}">{{ __('links.contact_us') }}</a></li>
                        <li><a href="{{ LaravelLocalization::localizeUrl('/about') }}">{{ __('links.about_us') }}</a></li>
                        <li><a href="{{ LaravelLocalization::localizeUrl('/agents') }}">{{ __('links.become_agent') }}</a></li>
                        <li><a href="{{ LaravelLocalization::localizeUrl('/careers') }}">{{ __('links.careers') }}</a></li>
                    </ul>
                </button>


                <style>
                    .dropdown-mobile {
                        position: relative;
                    }

                    .dropdown-menu-mobile {
                        display: none;
                        list-style: none;
                        padding: 10px 0;
                        margin: 0;
                        background: #fff;
                        border-radius: 8px;
                        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
                    }

                    .dropdown-menu-mobile.show {
                        display: block;
                        background-color: #68c2e5;
                    }

                    .dropdown-menu-mobile li a {
                        display: block;
                        padding: 8px 20px;
                        color: #1c4482;
                        text-decoration: none;
                    }

                </style>

                {{-- <button
                    class="{{ Request::segment(2) == 'contact' ? 'offcan_buttons active' : 'offcan_buttons' }}">
                    <a href="{{ LaravelLocalization::localizeUrl('/contact') }}">{{ __('links.contact_us') }}</a>
                </button> --}}
                {{--<button class="offcan_buttons dropdown">
                    <li class="dropdown">
                        <a href="#">Services</a>
                        <ul class="sub-menu">
                            <li><a href="services.html">Services</a></li>
                            <li><a href="services-carousel.html">Service Carousel</a></li>
                            <li><a href="agriculture-services.html">Agriculture services</a>
                            </li>
                            <li><a href="organic-services.html">Organic services</a></li>
                            <li><a href="delivery-services.html">Delivery services</a></li>
                            <li><a href="farming-products.html">Farming products</a>
                            </li>
                        </ul>
                    </li>

                    {{-- <a class="dropdown-toggle" data-bs-toggle="dropdown">
                        {{ __('links.contact_us') }} <i class="fa-solid fa-chevron-down"></i>
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="#">Safeer 1</a></li>
                        <li><a class="dropdown-item" href="#">Safeer 2</a></li>
                        <li><a class="dropdown-item" href="#">Safeer 3</a></li>
                        <li><a class="dropdown-item" href="#">Safeer 4</a></li>
                    </ul>
                </button>--}}
                <button class="offcan_buttons">
                    @foreach (LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
                    @if (LaravelLocalization::getCurrentLocale() != 'ar' && $localeCode == 'ar')
                    <a rel="alternate" hreflang="{{ $localeCode }}"
                        href="{{ LaravelLocalization::getLocalizedURL($localeCode, null, [], true) }}">

                        <!--{{ $properties['native'] }}-->
                        <span>عربي</span>
                        {{-- <img title="عربي" src="{{ asset('website_assets/images/saudi-arabia.webp') }}"
                            style="width: 40px;height:40px" class="flag-img "> --}}

                    </a>
                    @endif
                    @if (LaravelLocalization::getCurrentLocale() != 'en' && $localeCode == 'en')
                    <a rel="alternate" hreflang="{{ $localeCode }}"
                        href="{{ LaravelLocalization::getLocalizedURL($localeCode, null, [], true) }}">
                        <span>EN</span>
                        {{-- <img title="English" src="{{ asset('website_assets/images/united-states.webp') }}"
                            class="flag-img "> --}}
                    </a>
                    @endif
                    <!--|-->
                    @endforeach
                </button>
                {{-- {{session()->get("SiteUser")["Name"]}} --}}
                @if (session()->get('SiteUser'))
                <button class="offcan_buttons">
                    <a href="#">{{ session()->get('SiteUser')['Name'] }}</a>
                </button>
                @else
                <button class="offcan_buttons">
                    <a href="{{ LaravelLocalization::getLocalizedURL($localVar, route('siteLogin')) }}#login_forms">{{
                        __('links.signin') }}</a>
                </button>
                <button class="offcan_buttons">
                    <a href="{{ LaravelLocalization::getLocalizedURL($localVar, route('siteRegister')) }}">{{
                        __('links.signin_up2') }}</a>
                </button>
                @endif






            </div>
        </div>
        <!-- end of oofcanvas  -->
        <!-- navigation links  -->
        <div class="navbar-collapse">
            <ul class="navbar-nav ms-auto">
                <!-- first link tab  -->
                <li>
                    <a href="{{ LaravelLocalization::localizeUrl('/') }} "
                        class="{{ Request::segment(1) == null ? 'links hybrid active' : 'links hybrid' }}">
                        {{ __('links.home') }}</a>
                </li>
                {{-- <li>
                    <a href="{{ LaravelLocalization::localizeUrl('/about') }}"
                        class="{{ Request::segment(1)=='about' ? 'links hybrid active' : 'links hybrid' }}">{{
                        __('links.about_us') }} </a>
                </li> --}}
                {{-- <li>
                    <a href="{{ LaravelLocalization::localizeUrl('/hotels') }}"
                        class="{{ Request::segment(1) == 'hotels' ? 'links hybrid active' : 'links hybrid' }}">{{
                        __('links.hotels') }}
                    </a>
                </li> --}}
                <li>
                    <a href="{{ LaravelLocalization::localizeUrl('/tours') }}"
                        class="{{ Request::segment(1) == 'tours' ? 'links hybrid active' : 'links hybrid' }}">{{
                        __('links.tours') }}
                    </a>
                </li>

                <li>
                    <a href="{{ LaravelLocalization::localizeUrl('/offers') }}"
                        class="{{ Request::segment(1) == 'offers' ? 'links hybrid active' : 'links hybrid' }}">{{
                        __('links.offers') }}
                    </a>
                </li>
                <li>
                    <a href="{{ LaravelLocalization::localizeUrl('/transfers') }}"
                        class="{{ Request::segment(1) == 'transfers' ? 'links hybrid active' : 'links hybrid' }}">{{
                        __('links.transfer') }}
                    </a>
                </li>
                <li>
                    <a href="{{ LaravelLocalization::localizeUrl('/visa') }}"
                        class="{{ Request::segment(1) == 'visa' ? 'links hybrid active' : 'links hybrid' }}">
                        {{ __('links.visa') }}</a>
                </li>
                <li>
                    <a href="{{ LaravelLocalization::localizeUrl('/blogs') }}"
                        class="{{ Request::segment(1) == 'blogs' ? 'links hybrid active' : 'links hybrid' }}">{{
                        __('links.blogs') }}</a>
                </li>
                {{-- <li>
                    <a href="{{ LaravelLocalization::localizeUrl('/contact') }}"
                        class="{{ Request::segment(1) == 'contact' ? 'links hybrid active' : 'links hybrid' }}">{{
                        __('links.contact_us') }}</a>
                </li> --}}

                <li class="dropdown new-drop">
                    <a href="#" class="links hybrid">{{ __('links.about_us') }} </a>
                    <ul class="sub-menu">
                        <li><a href="{{ LaravelLocalization::localizeUrl('/contact') }}">{{
                                __('links.contact_us') }}</a></li>
                        <li><a href="{{ LaravelLocalization::localizeUrl('/about') }}"> {{ __('links.about_us') }}</a></li>
                        <li><a href="{{ LaravelLocalization::localizeUrl('/agents') }}"> {{ __('links.become_agent') }}</a>
                        </li>
                        <li><a href="{{ LaravelLocalization::localizeUrl('/careers') }}"> {{ __('links.careers') }}</a></li>

                    </ul>
                </li>
                <style>
                    li.dropdown.new-drop:hover ul {}

                    li.dropdown.new-drop ul {
                        padding: 8px !important;
                        width: max-content;
                        left: -18px;
                        z-index: 989;
                        border-radius: 15px;
                    }

                    li.dropdown.new-drop ul li {
                        padding: 8px 16px 8px 8px !important;

                    }

                    li.dropdown.new-drop ul li:hover {
                        background-color: #68c2e5;
                        border-radius: 6px;

                    }

                    li.dropdown.new-drop ul li a {
                        padding: 0 !important;
                        margin: 0;
                        width: 100%;
                        color: #1c4482;
                        text-decoration: none !important;
                    }

                    li.dropdown.new-drop ul li a::after {
                        content: none !important;
                    }

                    li.dropdown.new-drop ul li:hover a {
                        padding: 0 !important;
                        margin: 0;
                        width: 100%;
                        text-decoration: none !important;
                    }
                </style>
                {{-- <li class="dropdown">
                    <a class="links hybrid dropdown-toggle" data-bs-toggle="dropdown">
                        {{ __('links.contact_us') }} <i class="fa-solid fa-chevron-down"></i>
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="#">Item 1</a></li>
                        <li><a class="dropdown-item" href="#">Item 2</a></li>
                        <li><a class="dropdown-item" href="#">Item 3</a></li>
                        <li><a class="dropdown-item" href="#">Item 4</a></li>
                    </ul>
                </li> --}}

                <li>

                    @foreach (LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
                    @if (LaravelLocalization::getCurrentLocale() != 'ar' && $localeCode == 'ar')
                    <a class="links hybrid p-2" rel="alternate" hreflang="{{ $localeCode }}"
                        href="{{ LaravelLocalization::getLocalizedURL($localeCode, null, [], true) }}">

                        <!--{{ $properties['native'] }}-->
                        <span>عربي</span>
                        {{-- <img title="عربي" src="{{ asset('website_assets/images/saudi-arabia.webp') }}"
                            style="width: 40px;height:40px" class="flag-img "> --}}

                    </a>
                    @endif
                    @if (LaravelLocalization::getCurrentLocale() != 'en' && $localeCode == 'en')
                    <a class="links hybrid p-2" rel="alternate" hreflang="{{ $localeCode }}"
                        href="{{ LaravelLocalization::getLocalizedURL($localeCode, null, [], true) }}">
                        <span>EN</span>
                        {{-- <img title="English" src="{{ asset('website_assets/images/united-states.webp') }}"
                            class="flag-img "> --}}
                    </a>
                    @endif
                    <!--|-->
                    @endforeach
                    {{-- <a class="links hybrid p-2" href=''> AR </a>
                    <a class="links hybrid p-2" href=''>EN </a> --}}
                </li>
                <div class="register">


                    <ul>
                        <span class="line sign_in already_loged"> <i class="fa-solid fa-user"></i> </span>
                        @if (session()->get('SiteUser'))
                        <li class="sign_in">
                            <?php
                                $userId = session()->get('SiteUser')['ID'];
                                ?>

                            {{-- <a href="{{ route('siteProfile', $userId) }}" class="links hybrid sign_in">{{
                                session()->get('SiteUser')['Name'] }}</a> --}}


                            <a class="links hybrid sign_in already_loged">
                                {{ session()->get('SiteUser')['Name'] }}
                                <i class="fa-solid fa-arrow-down-short-wide"></i>
                            </a>
                            <ul class="menu user_info_options">
                                <li><a href="{{ route('siteProfile', $userId) }}" class="links hybrid sign_in"><i
                                            class="fa-solid fa-user"></i>{{ __('links.my_profile') }}</a></li>
                                <li><a href="{{ LaravelLocalization::getLocalizedURL($localVar, route('get_cart')) }}"
                                        class="links hybrid sign_in"><i class="fa-solid fa-cart-shopping"></i>
                                        {{ __('links.cart') }}</a></li>
                                {{-- <li><a href="#" class="links hybrid sign_in"><i
                                            class="fa-solid fa-solid fa-bag-shopping"></i>My Orders</a></li> --}}
                                <li><a class="links hybrid sign_in" href="{{ route('siteLogout') }}"><i
                                            class="fa-solid fa-right-from-bracket"></i>{{ __('links.logout') }}</a>
                                </li>
                            </ul>



                        </li>
                        {{-- <li class="sign_up">
                            <a href="{{ route('siteLogout') }}" class="links hybrid sign_up">Logout</a>
                        </li> --}}
                        @else
                        <li class="sign_in">
                            <a href="{{ LaravelLocalization::getLocalizedURL($localVar, route('siteLogin')) }}#login_forms"
                                class="links hybrid sign_in">{{ __('links.signin') }}</a>
                        </li>
                        <li class="sign_up">
                            <a href="{{ LaravelLocalization::getLocalizedURL($localVar, route('siteRegister')) }}"
                                class="links hybrid sign_up">{{ __('links.signin_up2') }}</a>
                        </li>
                        @endif


                    </ul>
                </div>
            </ul>
        </div>
        <!-- end of navigation links  -->
    </nav>


</div>
{{-- WhatsApp widget moved to <x-website.whatsapp-widget /> (rendered once,
     near the end of layout.website.layout body) — see that component for the
     modern floating button, and public/website_assets/css/whatsapp-widget.css
     + .../js/whatsapp-widget.js for its styling/behavior. --}}
<!--Start Social Icon-->
{{-- <div class="fixed-icon">
    <div class="f-icon f1"><a href="https://www.facebook.com/Safer4Free/" target="_blank"><i
                class="fab fa-facebook-f"></i></a></div>
    <div class="f-icon f2"><a href="http://twitter.com/safer4free" target="_blank"><i class="fab fa-twitter"></i></a>
    </div>
    <div class="f-icon f3"><a href="https://www.linkedin.com/in/safer-4free-107287132" target="_blank"><i
                class="fab fa-linkedin-in"></i></a></div>
    <div class="f-icon f3"><a href="https://wa.me/?text={{ urlencode('https://safer.travel/') }}" target="_blank"><i
                class="fab fa-whatsapp"></i></a></div>
    <div class="f-icon f4"><a href="https://www.instagram.com/safer4free.official/" target="_blank"><i
                class="fab fa-instagram"></i></a></div>
</div> --}}
<!--End Social Icon-->
