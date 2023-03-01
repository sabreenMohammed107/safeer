@extends("layout.website.layout", ["Company" => $Company,"title"=>"Safer | sign in"])

@section('adds_css')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="{{ asset('/website_assets/css/sign-in.css') }}">
@endsection
@section("content")
<div class="row mx-0">
    <div class="col-sm-12 col-md-6">
        <div class="slider_section slider_details ">
              <h1> the best way <br> to plan your  trip around the world   </h1>
              <p>there are endless  posibilities  when planning your next <br> vacation  so we are waiting  for you to use travelling</p>
        </div>
    </div>
    <div class="col-sm-12 col-md-6">
        <div class=" slider_details side_right_details">
                <h5>Sign up To SAFER</h5>
                <a href="{{route("siteLogin")}}">  have an Account ?<span> Sign in</span>   </a>
                <form action="{{route("ProceedRegister")}}" method="POST">
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
                  <input type="text" name="name" class="form-control" id="exampleFormControlInput1" placeholder="Full Name *" required>
                  <input type="text" name="phone" class="form-control" id="exampleFormControlInput2" placeholder="Phone Number*" required>
                  <input type="text" name="email" class="form-control" id="exampleFormControlInput3" placeholder="E-mail or User Name  *" required>
                  <input type="password" name="password" class="form-control" id="exampleFormControlInput4" placeholder=" Password*" required>
                  <button type="submit" class="btn sign_button">Sign up </button>
                  <div class="remember">
                    <input required class="form-check-input" type="checkbox" class="checked_input" value="" id="flexCheckDefault">
                    <label class="form-check-label confirmed" for="flexCheckDefault">
                        I confirmed that I have read and accepted the <a href="#" class="privacy">privacy policy </a>
                      </label>
                  </div>
                </form>
                <span class="or_title">
                  or sign up with
                </span>
                <section class="sign_socail">
                    <button class="btn">
                    <img src="{{ asset('/website_assets/images/signin-up/socail-logins/facebook.webp')}}" alt="facebook logo">
                        <a href="{{ route('facebook.login') }}" class="btn btn-facebook btn-user btn-block">
                        {{-- <i class="fab fa-facebook-f fa-fw"></i> --}}
                            Login with Facebook
                        </a>
                    </button>

                    <button class="btn">
                      <img src="{{ asset('/website_assets/images/signin-up/socail-logins/google.webp')}}" alt="google logo">

                        <a href="{{ route('google.login') }}" class="btn btn-google btn-user btn-block">
                            {{-- <i class="fab fa-google fa-fw"></i>  --}}
                            Login with Google
                        </a>
                    </button>
                </section>
      </div>
    </div>
 </div>
@endsection
