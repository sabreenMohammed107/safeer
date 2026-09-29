<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}" dir="{{ app()->getLocale() === 'ar' ? 'rtl' : 'ltr' }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Safer Travel')</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            background-color: #f4f6f9;
            font-family: Arial, Helvetica, sans-serif;
            color: #333333;
            direction: {{ app()->getLocale() === 'ar' ? 'rtl' : 'ltr' }};
        }

        .email-wrapper {
            max-width: 600px;
            margin: 0 auto;
            background-color: #ffffff;
        }

        .email-header {
            background-color: #1C4482;
            padding: 24px;
            text-align: center;
        }

        .email-header img {
            max-height: 42px;
        }

        .email-body {
            padding: 32px 28px;
            line-height: 1.6;
            font-size: 15px;
        }

        .email-body h2 {
            color: #1C4482;
            margin-top: 0;
        }

        .email-footer {
            padding: 20px 28px;
            background-color: #f4f6f9;
            text-align: center;
            font-size: 12px;
            color: #888888;
        }

        .btn-primary {
            display: inline-block;
            background-color: #1C4482;
            color: #ffffff !important;
            text-decoration: none;
            padding: 12px 28px;
            border-radius: 8px;
            font-weight: bold;
        }

        table.data-table {
            width: 100%;
            border-collapse: collapse;
            margin: 16px 0;
        }

        table.data-table th,
        table.data-table td {
            padding: 10px;
            border-bottom: 1px solid #e4e6ef;
            text-align: {{ app()->getLocale() === 'ar' ? 'right' : 'left' }};
            font-size: 14px;
        }

        table.data-table th {
            background-color: #f8f9fb;
            color: #1C4482;
        }
    </style>
</head>
<body>
    <div class="email-wrapper">
        <div class="email-header">
            <img src="{{ asset('website_assets/images/logo3.webp') }}" alt="Safer Travel">
        </div>
        <div class="email-body">
            @yield('content')
        </div>
        <div class="email-footer">
            &copy; {{ date('Y') }} Safer Travel. {{ __('emails.footer_rights') }}<br>
            {{ config('mail.admin_address', 'info@safer.travel') }}
        </div>
    </div>
</body>
</html>
