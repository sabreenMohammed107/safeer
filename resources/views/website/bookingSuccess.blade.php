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
    <x-website.header.general title="Reservation" :breadcrumb="$BreadCrumb" current="Reservation Status" />
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
        <h3 class="my-2"><strong>Congratulations!</strong> You've Purchased your Order Successfully</h3>
        <h5 class="my-2">Order Number : <span class="badge bg-success"> {{$Room->order_detail->order_id}}</span></h5>
        <p class="fw-bold my-2">Total Cost (After Tax): ${{$Room->total_cost}}</p>
    </div>
</div>

@endsection
