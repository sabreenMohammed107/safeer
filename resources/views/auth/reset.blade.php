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

            <form method="POST" action="{{ route('password.update') }}">
                @csrf
                <input type="hidden" name="token" value="{{ $token }}">

                <div>
                    <label for="email" class="col-md-4 col-form-label text-md-end" >{{ __('Email Address') }}</label>
                    <input id="email" type="email" class="form-control" name="email" value="{{ old('email', $email ?? '') }}" required>
                </div>

                <div>
                    <label for="password" class="col-md-4 col-form-label text-md-end" >{{ __('Password') }}</label>
                    <input id="password" type="password" class="form-control" name="password" required>
                </div>

                <div>
                    <label for="password_confirmation" class="col-md-4 col-form-label text-md-end" >{{ __('Confirm Password') }}</label>
                    <input id="password_confirmation" class="form-control" type="password" name="password_confirmation" required>
                </div>
                <div class="col-md-6 offset-md-4">
                    <button type="submit" class="btn btn-primary">
                        {{ __('save') }}
                    </button>
                </div>
            </form>

        </div>
    </div>
</div>
@endsection
