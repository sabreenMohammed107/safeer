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
    <x-website.header.general title="User Cart" :breadcrumb="$BreadCrumb" current="All your pre-booked rooms" />
@endsection
@section('content')
     <!-- passenger details -->
     <section class="passenger_section container py-5">
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
        {{-- <h5 class="text-primary fw-bold fs-2 my-4"> Cart Details </h5> --}}
        <div class="row mx-0">
            <div class="col-md-8 col-12">
                @php
                    $TotalCost = 0;
                @endphp
                @foreach ($RoomCosts as $Room)
                @php
                    if($Room->room_cap == 1){
                        $TotalCost += $Room->single_cost;
                    }else if($Room->room_cap == 2){
                        $TotalCost += $Room->double_cost;
                    }else{
                        $TotalCost += $Room->triple_cost;
                    }
                @endphp
                <div class="card-content">
                    <div class=" card setted_tour_cards ">
                      <img src="{{ asset('uploads/hotels') }}/{{$Room->hotel_banner}}" alt=" blogimage">
                      <div class="card-body setted_info">
                        @if (LaravelLocalization::getCurrentLocale() === 'en')
                        <div class="card_info">
                            <h6> <a href="{{ LaravelLocalization::localizeUrl('/hotels/'.$Room->hotel_id) }}" class="stretched-link">{{$Room->hotel_enname}} – {{$Room->hotel_stars}} Stars - @if($Room->room_cap == 1) Single @elseif($Room->room_cap == 2) Double @else Triple @endif</a></h6>
                            <span>
                                <a href="{{ LaravelLocalization::localizeUrl("cart/$Room->id") }}" class="text-secondary"><i class="fa-solid fa-trash"></i></a>
                            </span>
                        </div>

                                                    @else
                                                    <div class="card_info">
                                                        <h6> <a href="{{ LaravelLocalization::localizeUrl('/hotels/'.$Room->hotel_id) }}" class="stretched-link">{{$Room->hotel_arname}} – {{$Room->hotel_stars}} نجوم - @if($Room->room_cap == 1) فردي @elseif($Room->room_cap == 2) زوجي @else ثلاثية @endif</a></h6>
                                                        <span>
                                                            <a href="{{ LaravelLocalization::localizeUrl("cart/$Room->id") }}" class="text-secondary"><i class="fa-solid fa-trash"></i></a>
                                                        </span>
                                                    </div>
                                                    @endif

                        <span>     <i class="fa-solid fa-location-dot"></i>  @if (LaravelLocalization::getCurrentLocale() === 'en')

                            {{$Room->en_country}}
                            @else
                            {{$Room->ar_country}}
                            @endif <span>|</span> @if (LaravelLocalization::getCurrentLocale() === 'en')

                            {{$Room->en_city}}
                            @else
                            {{$Room->ar_city}}
                            @endif</span>
                        <p>
                            @if (LaravelLocalization::getCurrentLocale() === 'en')

                            {{$Room->hotel_enoverview}}
                                                    @else
                                                    {{$Room->hotel_aroverview}}
                                                    @endif
                        </p>
                        <div class="price">
                          <div class="rating">

                            @for ($i = 0; $i < $Room->hotel_stars; $i++)
                                    <i class="fa-solid fa-star"></i>
                                @endfor
                                @for ($i = 5; $i > $Room->hotel_stars; $i--)
                                    <i class="fa-regular fa-star"></i>
                                @endfor

                          </div>
                          <span class="hotels_price"> $@if($Room->room_cap == 1){{$Room->single_cost}}@elseif($Room->room_cap == 2){{$Room->double_cost}}@else{{$Room->triple_cost}}@endif</span>
                        </div>
                      </div>
                    </div>
                </div>
                @endforeach

            </div>
            <div class="col-md-4 col-12">
                <div class="passenger_info">
                    <div class="booking_info_card">
                        @foreach ($RoomCosts as $RoomC)
                            <div class="remain_info pt-3">
                                <h5>
                                    @if (LaravelLocalization::getCurrentLocale() === 'en')

                                    {{$RoomC->hotel_enname}}
                                                    @else
                                                    {{$RoomC->hotel_enname}}
                                                    @endif – {{$RoomC->hotel_stars}} Stars
                                </h5>
                                <p>
                                    1 X Standers @if($RoomC->room_cap == 1) @if (LaravelLocalization::getCurrentLocale() === 'en')

                                    Single
                                    @else
                                   فردي
                                    @endif @elseif($RoomC->room_cap == 2) @if (LaravelLocalization::getCurrentLocale() === 'en')

                                    Double
                                    @else
                                   زوجي
                                    @endif @else @if (LaravelLocalization::getCurrentLocale() === 'en')

                                    Triple
                                    @else
                                   ثلاتية
                                    @endif @endif

                                    <span class="float-end">$@if($RoomC->room_cap == 1) {{$RoomC->single_cost}} @elseif($RoomC->room_cap == 2) {{$RoomC->double_cost}} @else {{$RoomC->triple_cost}} @endif</span>
                                </p>
                            </div>
                        @endforeach
                        <div class="grand_total">
                            <h5> @if (LaravelLocalization::getCurrentLocale() === 'en')

                                grand total
                                @else

المجموع الإجمالي
                                @endif </h5>
                            <span> {{$TotalCost}} <span>$</span></span>
                        </div>
                        <button class="btn d-block w-100 mt-4 btn-primary">@if (LaravelLocalization::getCurrentLocale() === 'en')

                            Proceed to Payment
                            @else

استكمال الدفع
                            @endif </button>
                    </div>
                 </div>
            </div>
        </div>
    </section>

@endsection
