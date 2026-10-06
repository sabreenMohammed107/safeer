@extends('layout.website.layout', ['Company' => $Company, 'title' => 'Safer | User Cart'])

@section('adds_css')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="{{ asset('/website_assets/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('/website_assets/css/about.css') }}">
    <link rel="stylesheet" href="{{ asset('/website_assets/css/tours.css') }}">
    <link rel="stylesheet" href="{{ asset('/website_assets/css/hotel.css') }}">
    {{-- versioned: the server caches CSS for 7 days --}}
    <link rel="stylesheet" href="{{ asset('/website_assets/css/cart.css') }}?v={{ filemtime(public_path('website_assets/css/cart.css')) }}">
@endsection

@section('bottom-header')
    <x-website.header.general title="{{ __('links.Reservation') }}" :breadcrumb="$BreadCrumb" current="{{ __('links.ReservationStatus') }}" />
@endsection
@section('content')
    @php
        $isEn = LaravelLocalization::getCurrentLocale() === 'en';
        $TotalAfterTax = $Cost * (1 + (float) $Order->tax_percentage / 100);
    @endphp

    <section class="os container">
        @if (session('session-warning'))
            <div class="alert alert-warning">{{ session('session-warning') }}</div>
        @endif
        @if (session('session-success'))
            <div class="alert alert-success">{{ session('session-success') }}</div>
        @endif
        @if (session('session-danger'))
            <div class="alert alert-danger">{{ session('session-danger') }}</div>
        @endif
        @if (session('session-info'))
            <div class="alert alert-info">{{ session('session-info') }}</div>
        @endif

        <div class="os-card">
            <div class="os-icon" aria-hidden="true">
                <i class="fa-solid fa-check"></i>
            </div>

            <h1 class="os-title">{{ $isEn ? 'Order placed successfully' : 'تم تقديم طلبك بنجاح' }}</h1>
            <p class="os-lead">
                {{ $isEn
                    ? 'Thank you for placing your order! It has been received successfully, and we will get in touch with you shortly to complete the process.'
                    : 'شكرًا لتقديم طلبكم! تم استلامه بنجاح، وسنتواصل معكم في أسرع وقت لإتمام الإجراءات.' }}
            </p>

            <dl class="os-details">
                <div class="os-details__order">
                    <dt>{{ $isEn ? 'Order number' : 'رقم الطلب' }}</dt>
                    <dd>#{{ $Order->id }}</dd>
                </div>
                <div>
                    <dt>{{ $isEn ? 'Total cost (incl. VAT)' : 'التكلفة الإجمالية (شاملة الضريبة)' }}</dt>
                    <dd>{{ money($TotalAfterTax) }}</dd>
                </div>
            </dl>
            <p class="os-hint">
                <i class="fa-regular fa-bookmark"></i>
                {{ $isEn ? 'Please keep your order number for reference.' : 'يرجى الاحتفاظ برقم الطلب للمراجعة.' }}
            </p>

            <div class="os-actions">
                <a href="{{ LaravelLocalization::localizeUrl('/safer/profile/' . $Order->user_id) }}#orders"
                    class="os-btn os-btn--primary">
                    <i class="fa-regular fa-file-lines"></i>
                    {{ $isEn ? 'View Order Details' : 'عرض تفاصيل الطلب' }}
                </a>
                <a href="{{ LaravelLocalization::localizeUrl('/tours') }}" class="os-btn os-btn--outline">
                    <i class="fa-solid fa-route"></i>
                    {{ $isEn ? 'Explore Tours' : 'تصفح الجولات' }}
                </a>
            </div>
            <a href="{{ LaravelLocalization::localizeUrl('/') }}" class="os-home">
                {{ $isEn ? 'Back to Home' : 'العودة إلى الرئيسية' }}
            </a>

            <div class="os-support">
                <p>
                    {{ $isEn ? 'Questions about your order? Contact us at' : 'لأي استفسارات، يمكنكم التواصل معنا عبر' }}
                    <a href="mailto:Info@Safer.Travel">Info@Safer.Travel</a>
                </p>
                <p class="os-support__sign">
                    {{ $isEn ? 'The Customer Service Team at Safer Travel Company' : 'فريق خدمة العملاء لدى شركة سافر السياحية' }}
                </p>
            </div>
        </div>
    </section>
@endsection
