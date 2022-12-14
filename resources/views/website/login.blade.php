@extends("layout.website.layout", ["Company" => $Company,"title"=>"Safer | sign in"])

@section('adds_css')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="{{ asset('/website_assets/css/sign-in.css') }}">
@endsection
@section("content")
<!-- start of nav bar  and mega menu -->
<div class="row mx-0">
    <div class="col-sm-12 col-md-6">
        <div class="slider_section slider_details">
              <h1> the best way <br> to plan your  trip around the world   </h1>
              <p>there are endless  posibilities  when planning your next <br> vacation  so we are waiting  for you to use travelling</p>
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
                <h5>Sign in To SAFER</h5>
                <a href="{{route("siteRegister")}}"> Don't have an Account ?<span> Sign up</span>   </a>
                <form action="{{route("ProceedLogin")}}" method="POST">
                    @csrf
                    @if ($errors->any())
                        <div class="alert alert-danger">
                                @foreach ($errors->all() as $error)
                                <p class="text-danger fs-6">{{ $error }}</p>
                                @endforeach
                        </div>
                    @endif
                  <input type="text" class="form-control" name="email" id="exampleFormControlInput1" placeholder="E-mail or User Name*" required>
                  <input type="password" class="form-control" name="password" id="exampleFormControlInput1" placeholder=" Password*" required>
                  <button type="submit" class="btn sign_button">Sign in </button>
                  <div class="remember">
                    <input class="form-check-input" type="checkbox" class="checked_input" value="" id="flexCheckDefault">
                    <label class="form-check-label" for="flexCheckDefault">
                      Remember me
                      </label>
                  </div>
                </form>
                <span class="or_title">
                  or sign in with
                </span>
                <section class="sign_socail">
                    <button class="btn">
                    <img src="{{ asset('/website_assets/images/signin-up/socail-logins/facebook.webp')}}" alt="facebook logo">
                        <a href="#">Sign in with Facebook</a>
                    </button>
                    <button class="btn">
                      <img src="{{ asset('/website_assets/images/signin-up/socail-logins/google.webp')}}" alt="google logo">

                        <a href="#">Sign in with Google</a>
                    </button>
                </section>
      </div>
    </div>
 </div>
@endsection
