<p>Dear User,</p>
<p>We received a request to reset your password. Click the link below to reset it:</p>
<p><a href="{{ route('password.reset.form', ['token' => $token, 'email' => $user->email]) }}">Reset Password</a></p>
<p>If you didn't request a password reset, you can ignore this email.</p>
