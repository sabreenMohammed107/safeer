@extends("layout.website.layout", ["Company" => $Company,"title"=>"Safer | sign in"])

@section('adds_css')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="{{ asset('/website_assets/css/sign-in.css') }}">
@endsection
@section("content")
<!-- start of nav bar  and mega menu -->
<div class="row mx-0">
    <div class="col-sm-12 col-md-6">
        <div class="slider_section slider_details px-5">
            @if (LaravelLocalization::getCurrentLocale() === 'en')

            <h1 class="px-2"> {{ $Company->login_en_title }}  </h1>
            <p>{{ $Company->login_en_sub_title }}</p>
            @else

            <h1 class="px-2"> {{ $Company->login_ar_title }}</ h1>
                <p> {{ $Company->login_ar_sub_title }}</ p>


            @endif

        </div>
    </div>
    <div class="col-sm-12 col-md-6">

        <div class=" slider_details side_right_details">
            @if (session('session-warning'))
            <div class="alert alert-warning">
                {{ session('session-warning') }}
            </div>
        @endif
        @if (session('session-success'))
            <div class="alert alert-success">
                {{ session('session-success') }}
            </div>
        @endif
        @if (session('session-danger'))
            <div class="alert alert-danger">
                {{ session('session-danger') }}
            </div>
        @endif
        @if (session('session-info'))
            <div class="alert alert-info">
                {{ session('session-info') }}
            </div>
        @endif
                <h5> @if (LaravelLocalization::getCurrentLocale() === 'en')

                    Sign in To SAFER
                    @else

                    سجّل الدخول إلى سافر


                    @endif </h5>
                <a href="{{ LaravelLocalization::getLocalizedURL($localVar, route("siteRegister"))}}"> {{ __('links.dontHaveAccount') }}<span>{{ __('links.signin_up2') }} </span>   </a>
                <form action="{{ LaravelLocalization::getLocalizedURL($localVar, route("ProceedLogin"))}}" method="POST">
                    @csrf
                    @if ($errors->any())
                        <div class="alert alert-danger">
                                @foreach ($errors->all() as $error)
                                <p class="text-danger fs-6">{{ $error }}</p>
                                @endforeach
                        </div>
                    @endif
                  <input type="text" class="form-control" name="email" id="exampleFormControlInput1" placeholder="{{ __('links.email') }}*" required>
                  <input type="password" class="form-control" name="password" id="exampleFormControlInput1" placeholder=" {{ __('links.password') }}*" required>
                  <button type="submit" class="btn sign_button">{{ __('links.signin') }} </button>
                  <div class="remember">
                    <input class="form-check-input" type="checkbox" class="checked_input" value="" id="flexCheckDefault">
                    <label class="form-check-label" for="flexCheckDefault">

                      @if (LaravelLocalization::getCurrentLocale() === 'en')
                      Remember me

                      @else


تذكرني

                      @endif
                      </label>
                  </div>
                </form>
                <span class="or_title">
                    @if (LaravelLocalization::getCurrentLocale() === 'en')
                    or sign up with
                    @else
                    أو اشترك مع


                    @endif

                </span>
                <section class="sign_socail">
                    <button class="btn">
                    <img src="{{ asset('/website_assets/images/signin-up/socail-logins/facebook.webp')}}" alt="facebook logo">
                        <a href="{{ route('facebook.login') }}" class="btn btn-facebook btn-user btn-block">
                        {{-- <i class="fab fa-facebook-f fa-fw"></i> --}}
                        @if (LaravelLocalization::getCurrentLocale() === 'en')
                        Login with Facebook
                        @else
                      تسجيل الدخول بالفيس بوك


                        @endif

                        </a>
                    </button>

                    <button class="btn">
                      <img src="{{ asset('/website_assets/images/signin-up/socail-logins/google.webp')}}" alt="google logo">

                        <a href="{{ route('google.login') }}" class="btn btn-google btn-user btn-block">
                            {{-- <i class="fab fa-google fa-fw"></i>  --}}
                            @if (LaravelLocalization::getCurrentLocale() === 'en')
                            Login with Google
                            @else
                          تسجيل الدخول  بجوجل


                            @endif
                        </a>
                    </button>
                </section>
      </div>
    </div>
 </div>
@endsection
