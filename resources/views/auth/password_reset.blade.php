@extends("layout.website.layout", ["Company" => $Company, "title" => "Safer | Password Reset"])

@section('adds_css')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="{{ asset('/website_assets/css/sign-in.css') }}">
@endsection

@section("content")
<div class="row mx-0">
    <div class="col-md-6 offset-md-3">
        <div class="slider_details side_right_details">
            <h5>
                @if (LaravelLocalization::getCurrentLocale() === 'en')
                    Forgot Your Password?
                @else
                    هل نسيت كلمة المرور؟
                @endif
            </h5>
            <p>
                @if (LaravelLocalization::getCurrentLocale() === 'en')
                    Enter your email address, and we will send you a link to reset your password.
                @else
                    أدخل بريدك الإلكتروني، وسنرسل لك رابطًا لإعادة تعيين كلمة المرور الخاصة بك.
                @endif
            </p>

            @if (session('status'))
                <div class="alert alert-success">
                    {{ session('status') }}
                </div>
            @endif

            <form action="{{ LaravelLocalization::getLocalizedURL($localVar, route('password.email')) }}" method="POST">
                @csrf
                @if ($errors->any())
                    <div class="alert alert-danger">
                        @foreach ($errors->all() as $error)
                            <p class="text-danger fs-6">{{ $error }}</p>
                        @endforeach
                    </div>
                @endif

                <input type="email" class="form-control" name="email" placeholder="{{ __('links.email') }}*" required>
                <button type="submit" class="btn sign_button">
                    @if (LaravelLocalization::getCurrentLocale() === 'en')
                        Send Reset Link
                    @else
                        إرسال رابط إعادة التعيين
                    @endif
                </button>
            </form>
        </div>
    </div>
</div>
@endsection
