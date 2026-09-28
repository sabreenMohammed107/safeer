@extends('emails.layout')

@section('title', 'Reset Your Password')

@section('content')
    <h2>Password Reset Request</h2>
    <p>Hi {{ $user->name ?? $user->first_name ?? 'there' }},</p>
    <p>We received a request to reset the password for your Safer Travel account ({{ $user->email }}). Click the button below to choose a new one:</p>
    <p style="text-align: center; margin: 28px 0;">
        <a class="btn-primary" href="{{ route('password.reset.form', ['token' => $token, 'email' => $user->email]) }}">
            Reset Password
        </a>
    </p>
    <p>This link will expire in {{ config('auth.passwords.users.expire', 60) }} minutes for your security.</p>
    <p>If you didn't request a password reset, you can safely ignore this email — your password will remain unchanged.</p>
@endsection
