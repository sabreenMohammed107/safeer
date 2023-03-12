@if (session()->get('SiteUser'))
<div class="cartbox">
    <a href="{{ route('get_cart') }}"><i class="fa-solid fa-cart-shopping"></i></a>
    @if (session()->get('SiteUser') && session()->get('hasCart'))
    <div class="cartCount"></div>
    @endif
</div>
@endif
<div class="main-wrapper">
    <nav class="navbar container">
        <img src="{{ asset('/website_assets/images/homePage/logo.webp') }}" alt="logo">
        <!-- offcanvas nav bar    -->
        <button class="btn canvase_button" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight"
            aria-controls="offcanvasRight">
            <span>Menu</span> <i class="fas fa-bars"></i>
        </button>
        <div class="offcanvas offcanvas-end canvase_section" tabindex="-1" id="offcanvasRight"
            aria-labelledby="offcanvasRightLabel">
            <div class="offcanvas-body">
                <button type="button" class="canvase_close_button" data-bs-dismiss="offcanvas" aria-label="Close">
                    <i class="fa-solid fa-xmark"></i>
                </button>
                <button class="{{ Request::segment(2)==null? 'offcan_buttons active' : 'offcan_buttons' }} ">
                    <a href="{{ url('/') }}">home</a>
                </button>
                <button class="{{ Request::segment(2)=='about' ? 'offcan_buttons active' : 'offcan_buttons' }}">
                    <a href="{{ url('/about') }}">about us</a>
                </button>
                <button class="{{ Request::segment(2)=='hotels' ? 'offcan_buttons active' : 'offcan_buttons' }}">
                    <a href="{{ url('/hotels') }}">hotels</a>
                </button>
                <button class="{{ Request::segment(2)=='tours' ? 'offcan_buttons active' : 'offcan_buttons' }}">
                    <a href=".{{ url('/tours') }}">tours</a>
                </button>
                <button class="{{ Request::segment(2)=='transfers' ? 'offcan_buttons active' : 'offcan_buttons' }}">
                    <a href="{{  url('/transfers')  }}">transfer</a>
                </button>
                <button class="{{ Request::segment(2)=='visa' ? 'offcan_buttons active' : 'offcan_buttons' }}">
                    <a href="{{ url('/visa')  }}">visa</a>
                </button>
                <button class="{{ Request::segment(2)=='contact' ? 'offcan_buttons active' : 'offcan_buttons' }}">
                    <a href="{{ url('/contact') }}">contact</a>
                </button>
                {{-- {{session()->get("SiteUser")["Name"]}} --}}
                @if (session()->get('SiteUser'))
                <a href="#">{{ session()->get('SiteUser')['Name'] }}</a>
                @else
                <button class="offcan_buttons">
                    <a href="#">sign in</a>
                </button>
                <button class="offcan_buttons">
                    <a href="#">Sign up</a>
                </button>
                @endif
                {{-- <button class="offcan_buttons_lang">
                    <a class="dropdown-btn">Language <i class="fa fa-caret-down"></i></a>

                    <div class="dropdown-container">
                        <a href="#"><img src="{{ asset('img/flags/ar.png') }}" class="flag-img">Arabic language</a>
                        <a href="#"><img src="{{ asset('img/flags/en.png') }}" class="flag-img">English language</a>
                    </div>
                </button> --}}

            </div>
        </div>
        <!-- end of oofcanvas  -->
        <!-- navigation links  -->
        <div class="navbar-collapse">
            <ul class="navbar-nav ms-auto">
                <!-- first link tab  -->
                <li>
                    <a href="{{ url('/') }}" class="{{ Request::segment(1)==null? 'links hybrid active' : 'links hybrid' }}"> home</a>
                </li>
                <li>
                    <a href="{{ url('/about') }}" class="{{ Request::segment(1)=='about' ? 'links hybrid active' : 'links hybrid' }}">about us </a>
                </li>
                <li>
                    <a href="{{ url('/hotels') }}" class="{{ Request::segment(1)=='hotels' ? 'links hybrid active' : 'links hybrid' }}">hotels </a>
                </li>
                <li>
                    <a href="{{ url('/tours') }}" class="{{ Request::segment(1)=='tours' ? 'links hybrid active' : 'links hybrid' }}" >tours </a>
                </li>
                <li>
                    <a href="{{ url('/transfers') }}" class="{{ Request::segment(1)=='transfers' ? 'links hybrid active' : 'links hybrid' }}" >transfer </a>
                </li>
                <li>
                    <a href="{{ url('/visa') }}" class="{{ Request::segment(1)=='visa' ? 'links hybrid active' : 'links hybrid' }}" >visa</a>
                </li>
                <li>
                    <a href="{{ url('/contact') }}" class="{{ Request::segment(1)=='contact' ? 'links hybrid active' : 'links hybrid' }}">contact us</a>
                </li>
                <div class="register">
                    {{-- <ul>
                        <span class="line"> <a href="./my-profile.html">
                                <img src="./images/my-profile/profile_picture.webp" alt="profile image">
                            </a> </span>
                        <li class=" profile_name">
                            <button class="links hybrid btn profile_name_button" onclick="opendropdown()"> Ghada Mohamed
                                <i class="fa-solid fa-angle-down"></i></button>
                            <div class="logout_dropdown" id="logout_dropdown">
                                <i class="fa-solid fa-arrow-right-from-bracket"></i> Log out
                            </div>
                        </li>

                    </ul> --}}

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
                                            class="fa-solid fa-user"></i>Profile</a></li>
                                <li><a href="{{ route('get_cart') }}" class="links hybrid sign_in"><i class="fa-solid fa-cart-shopping"></i>My
                                        Cart</a></li>
                                {{-- <li><a href="#" class="links hybrid sign_in"><i
                                            class="fa-solid fa-solid fa-bag-shopping"></i>My Orders</a></li> --}}
                                <li><a class="links hybrid sign_in" href="{{ route('siteLogout') }}"><i
                                            class="fa-solid fa-right-from-bracket"></i>Logout</a></li>
                            </ul>



                        </li>
                        {{-- <li class="sign_up">
                            <a href="{{ route('siteLogout') }}" class="links hybrid sign_up">Logout</a>
                        </li> --}}
                        @else
                        <li class="sign_in">
                            <a href="{{ route('siteLogin') }}" class="links hybrid sign_in">sign in</a>
                        </li>
                        <li class="sign_up">
                            <a href="{{ route('siteRegister') }}" class="links hybrid sign_up">sign up</a>
                        </li>
                        @endif
                         {{-- <li class=" profile_name" style="opacity: 0.8">
                            <img title="Arabic" src="{{ asset('img/flags/ar.png') }}" class="flag-img main-lang">
                            <img title="English" src="{{ asset('img/flags/en.png') }}" class="flag-img ">
                        </li> --}}

                        {{-- <li class=" profile_name">
                            <button class="links hybrid btn profile_name_button" onclick="opendropdown()">
                                <i class="fa-solid fa-globe"></i></button>
                            <div class="logout_dropdown" id="logout_dropdown">

                                <a class="links hybrid p-2" href=''><img title="Arabic"
                                        src="{{ asset('img/flags/ar.png') }}" class="flag-img"> </a>
                                <a class="links hybrid p-2" href=''><img title="English"
                                        src="{{ asset('img/flags/en.png') }}" class="flag-img"> </a>
                            </div>

                        </li> --}}
                    </ul>
                </div>
            </ul>
        </div>
        <!-- end of navigation links  -->
    </nav>


</div>

<div id='whatsapp-chat' class='hide'>
    <div class='header-chat'>
      <div class='head-home'>
        <div class='info-avatar'>
            <img src="{{asset("/website_assets/images/llogo.JPG")}}" alt="profile picture "></div>
        <p><span class="whatsapp-name">Safer</span><br><small>Typically replies within few minutes</small></p>

      </div>
      <div class='get-new hide'>
        <div id='get-label'></div>
        <div id='get-nama'></div>
      </div>
    </div>
    <div class='home-chat'>

    </div>
    <div class='start-chat'>
      <div pattern="https://elfsight.com/assets/chats/patterns/whatsapp.png" class="WhatsappChat__Component-sc-1wqac52-0 whatsapp-chat-body">
        <div class="WhatsappChat__MessageContainer-sc-1wqac52-1 dAbFpq">
          <div style="opacity: 0;" class="WhatsappDots__Component-pks5bf-0 eJJEeC">
            <div class="WhatsappDots__ComponentInner-pks5bf-1 hFENyl">
              <div class="WhatsappDots__Dot-pks5bf-2 WhatsappDots__DotOne-pks5bf-3 ixsrax"></div>
              <div class="WhatsappDots__Dot-pks5bf-2 WhatsappDots__DotTwo-pks5bf-4 dRvxoz"></div>
              <div class="WhatsappDots__Dot-pks5bf-2 WhatsappDots__DotThree-pks5bf-5 kXBtNt"></div>
            </div>
          </div>
          <div style="opacity: 1;" class="WhatsappChat__Message-sc-1wqac52-4 kAZgZq">
            <div class="WhatsappChat__Author-sc-1wqac52-3 bMIBDo">Safer</div>
            <div class="WhatsappChat__Text-sc-1wqac52-2 iSpIQi">Hi there 👋<br><br>How can I help you?</div>
            <div class="WhatsappChat__Time-sc-1wqac52-5 cqCDVm"></div>
          </div>
        </div>
      </div>

      <div class='blanter-msg'>
        <textarea id='chat-input' placeholder='Write a response' maxlength='120' row='1'></textarea>
        <a href='javascript:void;' id='send-it'><svg viewBox="0 0 448 448"><path d="M.213 32L0 181.333 320 224 0 266.667.213 416 448 224z"/></svg></a>

      </div>
    </div>
    <div id='get-number'></div><a class='close-chat' href='javascript:void'>×</a>
  </div>
  <a class='blantershow-chat' href='javascript:void' title='Show Chat'><svg width="20" viewBox="0 0 24 24"><defs/><path fill="#eceff1" d="M20.5 3.4A12.1 12.1 0 0012 0 12 12 0 001.7 17.8L0 24l6.3-1.7c2.8 1.5 5 1.4 5.8 1.5a12 12 0 008.4-20.3z"/><path fill="#4caf50" d="M12 21.8c-3.1 0-5.2-1.6-5.4-1.6l-3.7 1 1-3.7-.3-.4A9.9 9.9 0 012.1 12a10 10 0 0117-7 9.9 9.9 0 01-7 16.9z"/><path fill="#fafafa" d="M17.5 14.3c-.3 0-1.8-.8-2-.9-.7-.2-.5 0-1.7 1.3-.1.2-.3.2-.6.1s-1.3-.5-2.4-1.5a9 9 0 01-1.7-2c-.3-.6.4-.6 1-1.7l-.1-.5-1-2.2c-.2-.6-.4-.5-.6-.5-.6 0-1 0-1.4.3-1.6 1.8-1.2 3.6.2 5.6 2.7 3.5 4.2 4.2 6.8 5 .7.3 1.4.3 1.9.2.6 0 1.7-.7 2-1.4.3-.7.3-1.3.2-1.4-.1-.2-.3-.3-.6-.4z"/></svg> Chat with Us</a>
<!--Start Social Icon-->
{{-- <div class="fixed-icon">
	<div class="f-icon f1"><a href="https://www.facebook.com/Safer4Free/" target="_blank" ><i class="fab fa-facebook-f"></i></a></div>
	<div class="f-icon f2"><a href="http://twitter.com/safer4free" target="_blank"><i class="fab fa-twitter"></i></a></div>
	<div class="f-icon f3"><a href="https://www.linkedin.com/in/safer-4free-107287132" target="_blank"><i class="fab fa-linkedin-in"></i></a></div>
	<div class="f-icon f3"><a href="https://wa.me/?text={{ urlencode('https://safer.travel/') }}" target="_blank"><i class="fab fa-whatsapp"></i></a></div>
	<div class="f-icon f4"><a href="https://www.instagram.com/safer4free.official/" target="_blank" ><i class="fab fa-instagram"></i></a></div>
</div> --}}
<!--End Social Icon-->
