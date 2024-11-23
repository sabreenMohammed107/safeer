@extends("layout.website.layout", ["Company" => $Company, "title" => "Safer | Reset Password"])

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
                    Reset Your Password
                @else
                    إعادة تعيين كلمة المرور
                @endif
            </h5>
            <p>
                @if (LaravelLocalization::getCurrentLocale() === 'en')
                    Enter your new password below.
                @else
                    أدخل كلمة المرور الجديدة أدناه.
                @endif
            </p>

            @if ($errors->any())
                <div class="alert alert-danger">
                    @foreach ($errors->all() as $error)
                        <p class="text-danger fs-6">{{ $error }}</p>
                    @endforeach
                </div>
            @endif

            <form action="{{ LaravelLocalization::getLocalizedURL($localVar, route('password.update')) }}" method="POST">
                @csrf
                <input type="hidden" name="token" value="{{ $token }}">
                <input type="email" class="form-control mb-3" name="email" placeholder="{{ __('links.email') }}*" value="{{ old('email') }}" required>
                <input type="password" class="form-control mb-3" name="password" placeholder="{{ __('links.password') }}*" required>
                <input type="password" class="form-control mb-3" name="password_confirmation" placeholder="{{ __('links.confirm_password') }}*" required>
                <button type="submit" class="btn sign_button">
                    @if (LaravelLocalization::getCurrentLocale() === 'en')
                        Reset Password
                    @else
                        إعادة تعيين كلمة المرور
                    @endif
                </button>
            </form>
        </div>
    </div>
</div>
@endsection
