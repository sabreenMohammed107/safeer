@if (session()->get('SiteUser'))
    <div class="cartbox">
        <a href="{{ route('get_cart') }}"><i class="fa-solid fa-cart-shopping"></i></a>
        @if (session()->get('SiteUser') && session()->get('SiteUser')['hasCart'])
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
                <button class="offcan_buttons active">
                    <a href="{{ url('/') }}">home</a>
                </button>
                <button class="offcan_buttons">
                    <a href="{{ url('/about') }}">about us</a>
                </button>
                <button class="offcan_buttons">
                    <a href="{{ url('/hotels') }}">hotels</a>
                </button>
                <button class="offcan_buttons">
                    <a href="./tours.html">tours</a>
                </button>
                <button class="offcan_buttons">
                    <a href="#">transfer</a>
                </button>
                <button class="offcan_buttons">
                    <a href="#">visa</a>
                </button>
                <button class="offcan_buttons">
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
                <button class="offcan_buttons_lang">
                    <a class="dropdown-btn" >Language <i class="fa fa-caret-down"></i></a>

                    <div class="dropdown-container">
                        <a href="#"><img src="{{ asset('img/flags/ar.png') }}" class="flag-img">Arabic language</a>
                        <a href="#"><img src="{{ asset('img/flags/en.png') }}" class="flag-img">English language</a>
                    </div>
                </button>

            </div>
        </div>
        <!-- end of oofcanvas  -->
        <!-- navigation links  -->
        <div class="navbar-collapse">
            <ul class="navbar-nav ms-auto">
                <!-- first link tab  -->
                <li>
                    <a href="{{ url('/') }}" class="links hybrid active">home</a>
                </li>
                <li>
                    <a href="{{ url('/about') }}" class="links hybrid">about us </a>
                </li>
                <li>
                    <a href="{{ url('/hotels') }}" class="links hybrid">hotels </a>
                </li>
                <li>
                    <a href="./tours.html" class="links hybrid">tours </a>
                </li>
                <li>
                    <a href="#" class="links hybrid">transfer </a>
                </li>
                <li>
                    <a href="#" class="links hybrid">visa</a>
                </li>
                <li>
                    <a href="{{ url('/contact') }}" class="links hybrid">contact us</a>
                </li>
                <div class="register">
                    {{-- <ul>
                <span class="line">  <a href="./my-profile.html">
                    <img src="./images/my-profile/profile_picture.webp" alt="profile image">
                </a> </span>
                <li class=" profile_name">
                  <button class="links hybrid btn profile_name_button" onclick="opendropdown()"> Ghada Mohamed <i class="fa-solid fa-angle-down"></i></button>
                    <div class="logout_dropdown" id="logout_dropdown">
                      <i class="fa-solid fa-arrow-right-from-bracket"></i> Log out
                    </div>
                </li>

              </ul> --}}

                    <ul>
                        <span class="line"> <i class="fa-solid fa-user"></i> </span>
                        @if (session()->get('SiteUser'))
                            <li class="sign_in">
                                <?php
                                $userId = session()->get('SiteUser')['ID'];
                                ?>

                                <a href="{{ route('siteProfile', $userId) }}"
                                    class="links hybrid sign_in">{{ session()->get('SiteUser')['Name'] }}</a>
                            </li>
                            <li class="sign_up">
                                <a href="{{ route('siteLogout') }}" class="links hybrid sign_up">Logout</a>
                            </li>
                        @else
                            <li class="sign_in">
                                <a href="{{ route('siteLogin') }}" class="links hybrid sign_in">sign in</a>
                            </li>
                            <li class="sign_up">
                                <a href="{{ route('siteRegister') }}" class="links hybrid sign_up">sign up</a>
                            </li>
                        @endif
                        <li class=" profile_name">
                            <button class="links hybrid btn profile_name_button" onclick="opendropdown()">
                                <i class="fa-solid fa-globe"></i></button>
                              <div class="logout_dropdown" id="logout_dropdown">

                                <a class="links hybrid p-2" href='' ><img title="Arabic" src="{{ asset('img/flags/ar.png') }}" class="flag-img"> </a>
                                <a class="links hybrid p-2" href='' ><img title="English" src="{{ asset('img/flags/en.png') }}" class="flag-img"> </a>
                              </div>

                        </li>
                    </ul>
                </div>
            </ul>
        </div>
        <!-- end of navigation links  -->
    </nav>


</div>
