@extends('layout.website.layout', ['Company' => $Company, 'title' => 'Safer | User Cart'])

@section('adds_css')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="{{ asset('/website_assets/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('/website_assets/css/about.css') }}">
    <link rel="stylesheet" href="{{ asset('/website_assets/css/tours.css') }}">
    <link rel="stylesheet" href="{{ asset('/website_assets/css/hotel.css') }}">
    <link rel="stylesheet" href="{{ asset('/website_assets/css/booking-hotel.css') }}">
@endsection

@section('bottom-header')
    <x-website.header.general title="{{ __('links.Reservation') }}" :breadcrumb="$BreadCrumb" current="{{ __('links.ReservationStatus') }}" />
@endsection
@section('content')
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

<div class="alert-success text-center p-5 m-5">
    <div class="success-order d-inline-block">
        <i class="fa-solid fa-check"></i>
    </div>
    <div class="row mt-2">
        @if (LaravelLocalization::getCurrentLocale() === 'en')
        {{-- <h3 class="my-2"><strong>Congratulations!</strong> You've Purchased your Order Successfully</h3>
        <h5 class="my-2">Order Number : <span class="badge bg-success"> {{$Order->id}}</span></h5>
        <h4 class="fw-bold my-2">Total Cost (After Tax): ${{number_format($Cost * (1 + (float)$Order->tax_percentage/100),2,'.','')}}</h4> --}}
        <p class="my-2">Dear Customer,</p>
        <p class="my-2">Thank you for placing your order! It has been received successfully, and we will get in touch with you shortly to complete the process.</p>
        <p class="my-2 badge bg-success">Order Number: {{$Order->id}} – Please keep it for reference.</p>
        <p class="my-2 badge bg-success">Total Cost: ${{number_format($Cost * (1 + (float)$Order->tax_percentage/100),2,'.','')}}</p>
        <p class="my-2">If you have any questions, feel free to contact us at Info@Safer.Travel</p>
        <p class="my-2">Best regards,</p>
        <p class="my-2">The Customer Service Team at Safer Travel Company</p>
        @else
        {{-- <h3 class="my-2"><strong>تهانينا! </ strong> لقد تم طلبك بنجاح </ h3>
        <h5 class="my-2">طلب رقم : <span class="badge bg-success"> {{$Order->id}}</span></h5>
        <h4 class="fw-bold my-2">التكلفة اجمالي (بعد الضريبة): ${{number_format($Cost * (1 + (float)$Order->tax_percentage/100),2,'.','')}}</h4> --}}
        <p class="my-2">عزيزي العميل،</p>
        <p class="my-2">شكرًا لتقديم طلبكم! تم استلامه بنجاح، وسنتواصل معكم في أسرع وقت لإتمام الإجراءات.</p>
        <p class="my-2 badge bg-success">رقم الطلب: {{$Order->id}} – احتفظ به للمراجعة.</p>
        <p class="my-2 badge bg-success">التكلفة الإجمالية: ${{number_format($Cost * (1 + (float)$Order->tax_percentage/100),2,'.','')}}</p>
        <p class="my-2">لأي استفسارات، يمكنكم التواصل معنا عبر Info@Safer.Travel</p>
        <p class="my-2">تقبلوا تحياتنا،</p>
        <p class="my-2">فريق خدمة العملاء لدى شركة سافر السياحية</p>

        @endif

    </div>
</div>

@endsection
