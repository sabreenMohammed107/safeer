@extends('emails.layout')

@section('title', __('emails.password_reset_title'))

@section('content')
    <h2>{{ __('emails.password_reset_title') }}</h2>
    <p>{{ __('emails.password_reset_greeting', ['name' => $user->name ?? $user->first_name ?? 'there']) }}</p>
    <p>{{ __('emails.password_reset_intro', ['email' => $user->email]) }}</p>
    <p style="text-align: center; margin: 28px 0;">
        <a class="btn-primary" href="{{ route('password.reset.form', ['token' => $token, 'email' => $user->email]) }}">
            {{ __('emails.password_reset_button') }}
        </a>
    </p>
    <p>{{ __('emails.password_reset_expiry', ['minutes' => config('auth.passwords.users.expire', 60)]) }}</p>
    <p>{{ __('emails.password_reset_ignore') }}</p>
@endsection
