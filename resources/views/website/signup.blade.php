@extends("layout.website.layout", ["Company" => $Company,"title"=>"Safer | sign in"])

@section('adds_css')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="{{ asset('/website_assets/css/sign-in.css') }}">
@endsection
@section("content")
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
                <h5  @if (LaravelLocalization::getCurrentLocale() === 'ar')

               style="text-align: right"
                @endif >{{ __('links.signin_up2') }}</h5>
                <a @if (LaravelLocalization::getCurrentLocale() === 'ar')

                style="text-align: right"
                 @endif href="{{ LaravelLocalization::getLocalizedURL($localVar, route('siteLogin'))}}">  {{ __('links.haveAccount') }}<span> {{ __('links.signin') }}</span>   </a>
                <form action="{{ LaravelLocalization::getLocalizedURL($localVar, route('ProceedRegister'))}}" method="POST">
                    @csrf
                    @if ($errors->any())
                        <div class="alert alert-danger">
                                @foreach ($errors->all() as $error)
                                    <p class="text-danger">{{ $error }}</p>
                                @endforeach
                        </div>
                    @endif
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
                  <input type="text" name="name" value="{{session('Data')? session('Data')['name'] : ""}}" class="form-control" id="exampleFormControlInput1" placeholder="{{ __('links.name') }} *" required>
                  <input type="text" name="phone" value="{{session('Data')? session('Data')['phone'] : ""}}" class="form-control" id="exampleFormControlInput2" placeholder="{{ __('links.phone') }}*" required>
                  <input type="text" name="email" value="{{session('Data')? session('Data')['email'] : ""}}" class="form-control" id="exampleFormControlInput3" placeholder="{{ __('links.email') }}  *" required>
                  <input type="password" name="password" class="form-control" id="exampleFormControlInput4" placeholder=" {{ __('links.password') }}*" required>
                  <div class="form-group mb-4">
                    <div class="captcha">
                        <span>{!! captcha_img() !!}</span>
                        <button type="button" class="btn btn-danger" class="reload" id="reload">
                            &#x21bb;
                        </button>
                    </div>
                </div>
                {{-- <div class="form-group mb-4"> --}}
                    <input id="captcha" type="text" class="form-control" required placeholder="{{ __('links.enterCapcha') }}" name="captcha">
                    @if ($errors->has('captcha'))
                    <div class="error">
                        {{ $errors->first('captcha') }}
                    </div>
                @endif
                {{-- </div> --}}

                  <button type="submit" class="btn sign_button">{{ __('links.signin_up2') }} </button>
                  <div class="remember">
                    <input required class="form-check-input" type="checkbox" class="checked_input" value="" id="flexCheckDefault">
                    <label class="form-check-label confirmed" for="flexCheckDefault">
                        @if (LaravelLocalization::getCurrentLocale() === 'en')
                        I confirmed that I have read and accepted the <a href="#" class="privacy">privacy policy </a>

                        @else


لقد أكدت أنني قد قرأت ووافقت على <a href="#" class="privacy">سياسة الخصوصية </a>

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

@section('adds_js')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

<script type="text/javascript">
    $('#reload').click(function () {
        $.ajax({
            type: 'GET',
            url: 'reload-captcha-register',
            success: function (data) {
                $(".captcha span").html(data.captcha);
            }
        });
    });
</script>
@endsection
