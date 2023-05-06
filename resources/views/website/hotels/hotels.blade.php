@extends('layout.website.layout', ['Company' => $Company, 'title' => 'Safer | All Hotels'])

@section('adds_css')
    <meta name="csrf-token" content="{{ csrf_token() }}">
  {{-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"> --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.css" />

    <link rel="stylesheet" href="{{ asset('/website_assets/css/about.css') }}">
    <link rel="stylesheet" href="{{ asset('/website_assets/css/tours.css') }}">
    <link rel="stylesheet" href="{{ asset('/website_assets/css/hotel.css') }}">

    <style>
        .pageActive {
            color: white !important;
            background-color: #210D3A !important;
        }
        .slider_section .slider_details{
            height: 420px !important;
        }
        .icons-container .social-icons .item i.fa-brands {
            padding-top: 15px ;
        }
input.nosubmit {
      border: none;

  margin: 0;
  padding: 7px 8px;
  font-size: 14px;
  color: inherit;
  border: 1px solid #0000001f;
  border-radius: inherit;
  width: 100%;
  /* border: 1px solid #555; */
  display: block;
  padding: 9px 4px 9px 40px;
  background: transparent url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='16' height='16' class='bi bi-search' viewBox='0 0 16 16'%3E%3Cpath d='M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z'%3E%3C/path%3E%3C/svg%3E") no-repeat 13px center;
}
        .header-icon_search_custom:before {
    content: '\0045';
}

[class*='header-']:before {
    display: inline-block;
    font-family: 'header_icons';
    font-style: normal;
    font-weight: normal;
    line-height: 1;
    -webkit-font-smoothing: antialiased;
    -moz-osx-font-smoothing: grayscale;
}
    </style>


@endsection

@section('bottom-header')
    <x-website.header.general title="{{ __('links.hotels') }}" :breadcrumb="$BreadCrumb" current="{{ __('links.hotels') }}" />
@endsection
@section('content')
<?php
 $localVar=LaravelLocalization::getCurrentLocale();
?>
    <!-- booking section -->
    <section class="booking_hotels_section container">
        <form action="{{ LaravelLocalization::localizeUrl('/hotels') }}" method="POST">
            @csrf
            <div class="hotel_details">
                <div class="row mx-0 p-0">
                    <div class="col-sm-12 col-md-6 col-xl-2 p-s-0 ">
                        <h5> {{ __('links.destination') }}</h5>

                        <div class="choices">
                            <i class="fa-solid fa-location-dot"></i>
                            <select class="form-select dynamic" id="country" name="country_id"
                            aria-label="Default select example">                                @foreach ($Countries as $Country)
                                    <option value="{{ $Country->id }}"
                                        @if (session()->has('sessionArr')) {{ Session::get('sessionArr')['country_id'] == $Country->id ? 'selected' : '' }} @endif>
                                        @if (LaravelLocalization::getCurrentLocale() === 'en')

                                        {{ $Country->en_country }}
                                        @else
                                        {{ $Country->ar_country }}
                                        @endif</option>
                                @endforeach
                            </select>
                        </div>
                    </div>


                    <div class="col-sm-12 col-md-6 col-xl-2 p-s-0 ">
                        <h5> {{ __('links.city') }}</h5>

                        <div class="choices">
                            <i class="fa-solid fa-location-dot"></i>
                            <select class="form-select" id="city_id" name="city_id"
                            aria-label="Default select example">
                                     @foreach ($Cities as $city)
                                    <option value="{{ $city->id }}"
                                        @if (session()->has('sessionArr')) {{ Session::get('sessionArr')['city_id'] == $city->id ? 'selected' : '' }} @endif>
                                        @if (LaravelLocalization::getCurrentLocale() === 'en')

                                                    {{ $city->en_city }}
                                                    @else
                                                    {{ $city->ar_city }}
                                                    @endif</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-6 col-xl-3 p-0 ">
                        @if (LaravelLocalization::getCurrentLocale() === 'en')

                        <h5> check in <span>check </span> </h5>
                        @else
                        <h5>تسجيل وصول | <span>تسجبل مغادرة </span> </h5>
                        @endif
                        @if (session()->has('sessionArr'))
                            <input type="hidden" id="from_date" value="{{ Session::get('sessionArr')['from_date'] }}">
                            <input type="hidden" id="end_date" value="{{ Session::get('sessionArr')['end_date'] }}">
                        @endif

                        <div class="datepicker calender">
                            <i class="fa-solid fa-calendar-days"></i>
                            <input type="text" id="demo" name="from_date" class="demo" placeholder=""
                                value="01/01/2018 - 01/15/2018" />
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-6 col-xl-1">
                        <h5> {{ __('links.nights') }} </h5>

                        <input type="text" id="nights" class="form-control" readonly name="nights"
                            value="@if (session()->has('sessionArr')) {{ Session::get('sessionArr')['nights'] }} @else 7 @endif">
                    </div>
                    <div class="col-sm-12 col-md-6 col-xl-3">
                        <h5> {{ __('links.addRoom') }}</h5>
                        <div class="rooms">
                            <button class="info form-select" type="button" onclick="open_addnew()">
                                <i class="fa-regular fa-user"></i>
                                <span id="adults">
                                    @if (session()->has('sessionArr'))
                                        {{ Session::get('sessionArr')['adultsNumber'] }}
                                    @else
                                        1
                                    @endif {{ __('links.adult') }}
                                </span>
                                <span id="children">
                                    @if (session()->has('sessionArr'))
                                        {{ Session::get('sessionArr')['childNumber'] }}
                                    @else
                                        0
                                    @endif {{ __('links.child') }}
                                </span>
                                <span id="rooms">
                                    @if (session()->has('sessionArr'))
                                        {{ Session::get('sessionArr')['roomsNumber'] }}
                                    @else
                                        1
                                    @endif {{ __('links.rooms') }}
                                </span>
                            </button>
                            <div class="add_new" id="add_new">
                                <div class="form-group counter">
                                    <label>{{ __('links.adult') }}</label>
                                    <div class="input-group counter_content">
                                        <div class="input-group-btn">
                                            <button id="down" type="button" class=" btn btn-default"
                                                onclick=" adultdown('0')"><span class="glyphicon glyphicon-minus"> <i
                                                        class="fa-solid fa-minus"></i></span></button>
                                        </div>
                                        <input type="text" name="adultsNumber" id="adultsNumber"
                                            class="form-control input-number"
                                            @if (session()->has('sessionArr'))
                                            value="{{ Session::get('sessionArr')['adultsNumber'] }}"
                                                                                       @else
                                            value="1"
                                             @endif
                                            />
                                        <div class="input-group-btn">
                                            <button id="up" type="button" class="btn btn-default"
                                                onclick="adultup('10')"><span class="glyphicon glyphicon-plus"><i
                                                        class="fa-solid fa-plus"></i></span></button>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group counter">
                                    <label>{{ __('links.child') }}</label>
                                    <div class="input-group counter_content">
                                        <div class="input-group-btn">
                                            <button id="down" type="button" class="btn btn-default"
                                                onclick=" childdown('0') ; removeYearsSelect() "><span
                                                    class="glyphicon glyphicon-minus"> <i
                                                        class="fa-solid fa-minus"></i></span></button>
                                        </div>
                                        <input type="text" name="childNumber" id="childNumber"
                                            class="form-control input-number"
                                            @if (session()->has('sessionArr'))
                                            value="{{ Session::get('sessionArr')['childNumber'] }}"
                                                                                       @else
                                            value="0"
                                             @endif

                                            onchange="addYearsSelect()" />
                                        <div class="input-group-btn">
                                            <button id="up" type="button" class="btn btn-default"
                                                onclick="childup('10'); addYearsSelect()"><span
                                                    class="glyphicon glyphicon-plus"><i
                                                        class="fa-solid fa-plus"></i></span></button>
                                        </div>

                                    </div>

                                </div>
                                <div id="years">
                                    @if (session()->has('sessionArr'))
                                        @if (Session::get('sessionArr')['ages'])
                                        {{-- @if (is_array(session()->has('sessionArr'))) --}}
                                            @foreach (Session::get('sessionArr')['ages'] as $key => $age)
                                                <select class="form-select" name="ages[]"
                                                    aria-label="Default select example">\n\

                                                    @for ($i = 0; $i < 10; $i++)
                                                        <option value="{{ $i + 1 }}"
                                                        @if (session()->has('sessionArr'))
                                                            {{ Session::get('sessionArr')['ages'][$key] == $i + 1 ? 'selected' : '' }}
                                                            @endif >
                                                            {{ $i + 1 }}
                                                            @if (LaravelLocalization::getCurrentLocale() === 'en')
                                                            years old

                                                                          @else
                                                                        سنة
                                                                          @endif
                                                        </option>
                                                    @endfor




                                                </select>
                                            @endforeach
                                        @endif
                                    @endif
                                </div>
                                <div class="form-group counter">
                                    <label>{{ __('links.rooms') }}</label>
                                    <div class="input-group counter_content">
                                        <div class="input-group-btn">
                                            <button id="down" type="button" class="btn btn-default"
                                                onclick=" roomdown('0')"><span class="glyphicon glyphicon-minus"> <i
                                                        class="fa-solid fa-minus"></i></span></button>
                                        </div>
                                        <input type="text" name="roomsNumber" id="roomsNumber"
                                            class="form-control input-number"
                                            @if (session()->has('sessionArr'))
                                            value="{{ Session::get('sessionArr')['roomsNumber'] }}"
                                                                                       @else
                                            value="1"
                                             @endif
                                            />
                                        <div class="input-group-btn">
                                            <button id="up" type="button" class="btn btn-default"
                                                onclick="roomup('10')"><span class="glyphicon glyphicon-plus"><i
                                                        class="fa-solid fa-plus"></i></span></button>
                                        </div>
                                    </div>
                                </div>
                                <button type="button" class="btn done_button" onclick="close_addnew()">
                                    {{ __('links.done') }} </button>
                            </div>
                        </div>

                    </div>
                    <div class="col-sm-12 col-md-6 col-xl-1 p-0 ">
                        <div class="main" id="room_main">

                            <button class="btn" type="submit">
                                {{ __('links.search') }}
                            </button>
                        </div>
                    </div>

                </div>


            </div>
        </form>
    </section>

    <section class="tours container mt-4">
        <div class="row mx-0">
            <div class="  col-sm-0 col-xl-3">
                <button class="btn filtered_button" onclick="openFilter()" id="filterButton">
                    <i class="fa-solid fa-sliders"></i> search tours
                </button>
                <div class="search_tours" id="filtered-menu">

                    <!-- <h6> search tours </h6> -->
                    <div class="filter_labels" id="filtered-menu">
                        {{-- <h6> Search Hotels By Name</h6> --}}
                        {{-- autocomplete --}}
                        <div classs="form-group">
         <input class="typeahead form-control nosubmit" onchange="fetch_hotels()" id="searchId" placeholder=" @if (LaravelLocalization::getCurrentLocale() === 'en')

         search by hotel name
         @else
       بحث باسم الفندق
         @endif" type="text">

        </div>
                        {{-- @foreach ($Hotels as $Hotel)
                            <div class="form-check">
                                <input class="form-check-input hotel_idxx" type="checkbox" data-id="{{ $Hotel->id }}"
                                    value="" id="defaultCheck1">
                                <label class="form-check-label" for="defaultCheck1">
                                    {{ $Hotel->hotel_enname }}
                                </label>
                            </div>
                        @endforeach
                        <input type="hidden" name="hotel_ids" /> --}}


                        <div class="accordion accordion-flush" id="accordionFlushExample">
                            {{-- <div class="accordion-item">
                    <h2 class="accordion-header" id="flush-headingOne">
                      <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne" aria-expanded="false" aria-controls="flush-collapseOne">
                       country
                      </button>
                    </h2>
                    <div id="flush-collapseOne" class="accordion-collapse collapse" aria-labelledby="flush-headingOne" data-bs-parent="#accordionFlushExample">
                      <div class="accordion-body">
                        @foreach ($Countries as $Country)
                        <div class="form-check">
                            <input class="form-check-input hotel_countries_id" data-id="{{$Country->id}}" type="checkbox" value="" id="defaultCheck4" >
                            <label class="form-check-label" for="defaultCheck4">
                            {{$Country->en_country}}
                            </label>
                          </div>
                        @endforeach
                        <input type="hidden" name="hotel_countries_ids" />
                      </div>
                    </div>
                  </div> --}}
                   <div class="accordion-item">
                                <h2 class="accordion-header" id="flush-headingTwo">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#flush-collapseHotel" aria-expanded="false"
                                        aria-controls="flush-collapseTwo">
                                        {{ __('links.hotels') }}
                                    </button>
                                </h2>
                                <div id="flush-collapseHotel" class="accordion-collapse collapse"
                                    aria-labelledby="flush-collapseHotel" data-bs-parent="#accordionFlushExample">
                                    <div class="accordion-body">
                                       @foreach ($Hotels as $Hotel)
                            <div class="form-check">
                                <input class="form-check-input hotel_idxx" type="checkbox" data-id="{{ $Hotel->id }}"
                                    value="" id="defaultCheck1">
                                <label class="form-check-label" for="defaultCheck1">
                                    @if (LaravelLocalization::getCurrentLocale() === 'en')
                                    {{ $Hotel->hotel_enname }}

                @else
                {{ $Hotel->hotel_arname }}
                @endif

                                </label>
                            </div>
                        @endforeach
                                        <input type="hidden" name="hotel_ids" />

                                    </div>
                                </div>
                            </div>
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="flush-headingTwo">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#flush-collapseTwo" aria-expanded="false"
                                        aria-controls="flush-collapseTwo">
                                        {{ __('links.city') }}
                                    </button>
                                </h2>
                                <div id="flush-collapseTwo" class="accordion-collapse collapse"
                                    aria-labelledby="flush-headingTwo" data-bs-parent="#accordionFlushExample">
                                    <div class="accordion-body">
                                        @foreach ($Cities as $City)
                                            <div class="form-check">
                                                <input class="form-check-input hotel_cities_id"
                                                    data-id="{{ $City->id }}" type="checkbox" value=""
                                                    id="defaultCheck4">
                                                <label class="form-check-label" for="defaultCheck4">


  @if (LaravelLocalization::getCurrentLocale() === 'en')
  {{ $City->en_city }}

  @else
  {{ $City->ar_city }}
  @endif
                                                </label>
                                            </div>
                                        @endforeach
                                        <input type="hidden" name="hotel_cities_ids" />

                                    </div>
                                </div>
                            </div>

                            <div class="accordion-item">
                                <h2 class="accordion-header" id="flush-headingTwo">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#flush-collapseZone" aria-expanded="false"
                                        aria-controls="flush-collapseTwo">
                                        {{ __('links.zone') }}
                                    </button>
                                </h2>
                                <div id="flush-collapseZone" class="accordion-collapse collapse"
                                    aria-labelledby="flush-collapseZone" data-bs-parent="#accordionFlushExample">
                                    <div class="accordion-body">
                                        @foreach ($zones as $zone)
                                            <div class="form-check">
                                                <input class="form-check-input hotel_zone_id"
                                                    data-id="{{ $zone->id }}" type="checkbox" value=""
                                                    id="defaultCheck4">
                                                <label class="form-check-label" for="defaultCheck4">

                                                    @if (LaravelLocalization::getCurrentLocale() === 'en')

                                                    {{ $zone->en_zone }}
                                                    @else
                                                    {{ $zone->ar_zone }}
                                                    @endif
                                                </label>
                                            </div>
                                        @endforeach
                                        <input type="hidden" name="hotel_zone_ids" />

                                    </div>
                                </div>
                            </div>
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="flush-headingThree">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#flush-collapseThree" aria-expanded="false"
                                        aria-controls="flush-collapseThree">
                                        {{ __('links.rating') }}
                                    </button>
                                </h2>
                                <div id="flush-collapseThree" class="accordion-collapse collapse"
                                    aria-labelledby="flush-headingThree" data-bs-parent="#accordionFlushExample">
                                    <div class="accordion-body">
                                        <div class="form-check">
                                            <input class="form-check-input rate_val" type="checkbox" value=""
                                                data-val="5" id="defaultCheck12">
                                            <label class="form-check-label price" for="defaultCheck12">
                                                <div class="rating">
                                                    <i class="fa-solid fa-star"></i>
                                                    <i class="fa-solid fa-star"></i>
                                                    <i class="fa-solid fa-star"></i>
                                                    <i class="fa-solid fa-star"></i>
                                                    <i class="fa-solid fa-star"></i>
                                                </div>
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input rate_val" type="checkbox" value=""
                                                data-val="4" id="defaultCheck13">
                                            <label class="form-check-label" for="defaultCheck13">
                                                <div class="rating">
                                                    <i class="fa-solid fa-star"></i>
                                                    <i class="fa-solid fa-star"></i>
                                                    <i class="fa-solid fa-star"></i>
                                                    <i class="fa-solid fa-star"></i>
                                                </div>
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input rate_val" type="checkbox" value=""
                                                data-val="3" id="defaultCheck14">
                                            <label class="form-check-label" for="defaultCheck14">
                                                <div class="rating">
                                                    <i class="fa-solid fa-star"></i>
                                                    <i class="fa-solid fa-star"></i>
                                                    <i class="fa-solid fa-star"></i>
                                                </div>
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input rate_val" type="checkbox" value=""
                                                data-val="2" id="defaultCheck15">
                                            <label class="form-check-label" for="defaultCheck15">
                                                <div class="rating">
                                                    <i class="fa-solid fa-star"></i>
                                                    <i class="fa-solid fa-star"></i>


                                                </div>
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input rate_val" type="checkbox" value=""
                                                data-val="1" id="defaultCheck16">
                                            <label class="form-check-label" for="defaultCheck16">
                                                <div class="rating">
                                                    <i class="fa-solid fa-star"></i>
                                                </div>
                                            </label>
                                        </div>
                                        <input type="hidden" name="hotel_rating" />
                                    </div>
                                </div>
                            </div>
                            {{-- <div class="accordion-item">
                     <h2 class="accordion-header" id="flush-headingForth">
                      <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-colapseForth" aria-expanded="false" aria-controls="flush-colapseForth">
                      price range
                      </button>
                    </h2>
                    <div id="flush-colapseForth" class="accordion-collapse collapse w-100" aria-labelledby="flush-headingForth" data-bs-parent="#accordionFlushExample">
                      <div class="accordion-body">
                        <div class="multiple_range">
                            <div class="multirange">
                              <input type="range" min="0" max="10000" value="0" class="lower" name="price_from">
                              <input type="range" min="0" max="10000" value="10000" class="upper" name="price_to">
                              <span class="line_range"></span>
                            </div>
                            <p><span class="result-l">0</span> L.E -</p>
                            <p><span class="result-u">10000</span> L.E</p>
                          </div>
                      </div>
                     </div>
                  </div> --}}
                        </div>
                    </div>
                </div>

            </div>

            <div class="col-sm-12 col-xl-9">
                <div class="filtered_hotels">
                    <div class="filters">
                        <span>
                            @if (LaravelLocalization::getCurrentLocale() === 'en')

                            Available hotel rooms
                           @else
                            الغرف  المتاحة
                           @endif
                        </span>
                        <div class="left_filter">
                            <ul class="nav nav-pills " id="pills-tab" role="tablist">
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link sort_by active" data-val="rec" id="pills-home-tab"
                                        data-bs-toggle="pill" data-bs-target="#pills-home" type="button" role="tab"
                                        aria-controls="pills-home" aria-selected="true" @if (LaravelLocalization::getCurrentLocale() === 'ar') style="font-size: 12px" @endif >  @if (LaravelLocalization::getCurrentLocale() === 'en')

                                        Recommended
                                        @else
                                      مستحسن
                                        @endif</button>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link sort_by" data-val="price" id="pills-profile-tab"
                                        data-bs-toggle="pill" data-bs-target="#pills-profile" type="button"
                                        role="tab" aria-controls="pills-profile" aria-selected="false" @if (LaravelLocalization::getCurrentLocale() === 'ar') style="font-size: 12px" @endif>
                                        @if (LaravelLocalization::getCurrentLocale() === 'en')

                                        by Price
                                        @else
                                       بالسعر
                                        @endif</button>
                                </li>

                                <li class="nav-item" role="presentation">
                                    <button class="nav-link sort_by" data-val="alpha" id="pills-alpha-tab"
                                        data-bs-toggle="pill" data-bs-target="#pills-alpha" type="button"
                                        role="tab" aria-controls="pills-alpha" aria-selected="false" @if (LaravelLocalization::getCurrentLocale() === 'ar') style="font-size: 12px" @endif>

                                        @if (LaravelLocalization::getCurrentLocale() === 'en')

                                        alphabitic
                                        @else
                                       ترتيب ابجدي
                                        @endif</button>
                                </li>
                                <input type="hidden" name="sort_by" />
                            </ul>

                        </div>
                    </div>
                </div>
                <div id="table_data">

                    @include('website.hotels.hotelsList')



                </div>

            </div>
        </div>
    </section>
@endsection
@section('adds_js')
{{-- <script src="{{ asset('/website_assets/js/hotel_filters.js') }}"></script> --}}

 {{-- <script src="  https://code.jquery.com/jquery-2.2.4.min.js"></script>
<script src="{{ asset('/website_assets/js/typeahead.js') }}"></script>   --}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
<script>
    // $(".sort_by").click(function(){
    //     if($(this).attr("data-val") == "rec"){
    //         sort_by = 0;
    //     }else{
    //         sort_by = 1;
    //     }
    //     // console.log(arr);
    //     $("input[name=hotel_rating]").val(arr_ratings);
    //     fetch_hotels()
    // });
    // $(".page-num").click(function(){
    //     $("input[name=page_num]").val($(this).attr("data-val"));
    //     fetch_hotels()
    // });
    // $(".page-inc").click(function(){
    //     $("input[name=page_num]").val($(this).attr("data-val"));
    // });
    // function paginationSetter(value) {
    //     $("input[name=page_num]").val(value);
    //     fetch_hotels()
    // }

        $(document).ready(function() {


$('.dynamic').change(function() {

    if ($(this).val() != '') {
        var select = $(this).attr("id");
        var value = $(this).val();


        $.ajax({
            url: "{{route('dynamicSearchCity.fetch')}}",
            method: "get",
            data: {
                select: select,
                value: value,

            },
            success: function(result) {

                $('#city_id').html(result);
            }

        })
    }
});

               var path = "{{ route('autocomplete') }}";

    $( "#searchId" ).autocomplete({
        source: function( request, response ) {
          $.ajax({
            url: path,
            type: 'GET',
            dataType: "json",
            data: {
               search: request.term
            },
            success: function( data ) {
               response( data );
            }
          });
        },
        select: function (event, ui) {
           $('#searchId').val(ui.item.label);
           console.log(ui.item);
           return false;
        }
      });
            var arr = [];
    var arr_countries = [];
    var arr_cities = [];
    var arr_zones = [];
    var arr_ratings = [];
    var sort_by = 0; // recommended


    $(".hotel_idxx").change(function(){
        if($(this).is(':checked')){
            arr.push($(this).attr("data-id"));
        }else{
            var removeValue = $(this).attr("data-id");
            arr = $.grep(arr, function(n) {
                return n != removeValue;
            });
        }
        // console.log(arr);
        $("input[name=hotel_ids]").val(arr);
        fetch_hotels()
    });
    $(".hotel_cities_id").change(function(){
        if($(this).is(':checked')){
            arr_cities.push($(this).attr("data-id"));
        }else{
            var removeValue = $(this).attr("data-id");
            arr_cities = $.grep(arr_cities, function(n) {
                return n != removeValue;
            });
        }
        // console.log(arr);
        $("input[name=hotel_cities_ids]").val(arr_cities);
        fetch_hotels()
    });
//zones
    $(".hotel_zone_id").change(function(){
        if($(this).is(':checked')){
            arr_zones.push($(this).attr("data-id"));
        }else{
            var removeValue = $(this).attr("data-id");
            arr_zones = $.grep(arr_zones, function(n) {
                return n != removeValue;
            });
        }
        // console.log(arr);
        $("input[name=hotel_zone_ids]").val(arr_zones);
        fetch_hotels()
    });
    $(".hotel_countries_id").change(function(){
        if($(this).is(':checked')){
            arr_countries.push($(this).attr("data-id"));
        }else{
            var removeValue = $(this).attr("data-id");
            arr_countries = $.grep(arr_countries, function(n) {
                return n != removeValue;
            });
        }
        // console.log(arr);
        $("input[name=hotel_countries_ids]").val(arr_countries);
        fetch_hotels()
    });
    $(".rate_val").change(function(){
        if($(this).is(':checked')){
            arr_ratings.push($(this).attr("data-val"));
        }else{
            var removeValue = $(this).attr("data-val");
            arr_ratings = $.grep(arr_ratings, function(n) {
                return n != removeValue;
            });
        }
        // console.log(arr);
        $("input[name=hotel_rating]").val(arr_ratings);
        fetch_hotels()
    });
            var from_date = $('#from_date').val();
            var end_date = $('#end_date').val();

            $('.demo').daterangepicker({
                    "showISOWeekNumbers": true,
                    "timePicker": false,
                    "autoUpdateInput": true,
                    "locale": {
                        "cancelLabel": 'Clear',
                        "format": "MMMM DD, YYYY ",
                        "separator": " | ",
                        "applyLabel": "Apply",
                        "cancelLabel": "Cancel",
                        "fromLabel": "From",
                        "toLabel": "To",
                        "customRangeLabel": "Custom",
                        "weekLabel": "W",
                        "daysOfWeek": [
                            "Su",
                            "Mo",
                            "Tu",
                            "We",
                            "Th",
                            "Fr",
                            "Sa"
                        ],
                        "monthNames": [
                            "Jan",
                            "Feb",
                            "March",
                            "April",
                            "May",
                            "June",
                            "July",
                            "August",
                            "Sep.t",
                            "Oct.",
                            "Nov.",
                            "Dec."
                        ],
                        "firstDay": 1
                    },
                    "linkedCalendars": true,
                    "showCustomRangeLabel": false,
                    "startDate": from_date,
                    "endDate": end_date,
                    "opens": "center",
                },
                function(start, end) {
                    const date1 = new Date(start);
                    const date2 = new Date(end);

                    // One day in milliseconds
                    const oneDay = 1000 * 60 * 60 * 24;

                    // Calculating the time difference between two dates
                    const diffInTime = date2.getTime() - date1.getTime();

                    // Calculating the no. of days between two dates
                    const diffInDays = Math.round(diffInTime / oneDay);
                    $('#nights').val(diffInDays - 1);
                });







            $(document).on('click', '#productt .pagination a', function(event) {
                event.preventDefault();
                var page = $(this).attr('href').split('page=')[1];
                var arr = [];
                var arr_countries = [];
                var arr_cities = [];
                var arr_zones = [];
                var arr_ratings = [];


                $(".hotel_idxx").change(function() {
                    if ($(this).is(':checked')) {
                        arr.push($(this).attr("data-id"));
                    } else {
                        var removeValue = $(this).attr("data-id");
                        arr = $.grep(arr, function(n) {
                            return n != removeValue;
                        });
                    }

                    $("input[name=hotel_ids]").val(arr);

                });
                $(".hotel_cities_id").change(function() {
                    if ($(this).is(':checked')) {
                        arr_cities.push($(this).attr("data-id"));
                    } else {
                        var removeValue = $(this).attr("data-id");
                        arr_cities = $.grep(arr_cities, function(n) {
                            return n != removeValue;
                        });
                    }
                    // console.log(arr);
                    $("input[name=hotel_cities_ids]").val(arr_cities);

                });
                //zones
                $(".hotel_zone_id").change(function() {
                    if ($(this).is(':checked')) {
                        arr_zones.push($(this).attr("data-id"));
                    } else {
                        var removeValue = $(this).attr("data-id");
                        arr_zones = $.grep(arr_zones, function(n) {
                            return n != removeValue;
                        });
                    }
                    // console.log(arr);
                    $("input[name=hotel_zone_ids]").val(arr_zones);

                });
                $(".hotel_countries_id").change(function() {
                    if ($(this).is(':checked')) {
                        arr_countries.push($(this).attr("data-id"));
                    } else {
                        var removeValue = $(this).attr("data-id");
                        arr_countries = $.grep(arr_countries, function(n) {
                            return n != removeValue;
                        });
                    }
                    // console.log(arr);
                    $("input[name=hotel_countries_ids]").val(arr_countries);

                });
                $(".rate_val").change(function() {
                    if ($(this).is(':checked')) {
                        arr_ratings.push($(this).attr("data-val"));
                    } else {
                        var removeValue = $(this).attr("data-val");
                        arr_ratings = $.grep(arr_ratings, function(n) {
                            return n != removeValue;
                        });
                    }
                    // console.log(arr);
                    $("input[name=hotel_rating]").val(arr_ratings);

                });


                fetch_productdata(page, arr, arr_countries, arr_cities, arr_zones, arr_ratings);

            });
        });
        // End paginate product
        //function of pagination product

        function fetch_productdata(page, billColors, billSizes, billprices, category) {
            // alert(category)
            $.ajax({
                url: "/fetch-hotel-filter?page=" + page,
                data: {
 searchHotelId:$('#searchId').val(),
                    hotel_ids: $("input[name=hotel_ids]").val(),
                    hotel_rating: $("input[name=hotel_rating]").val(),
                    hotel_countries_ids: $("input[name=hotel_countries_ids]").val(),
                    hotel_cities_ids: $("input[name=hotel_cities_ids]").val(),
                    hotel_zone_ids: $("input[name=hotel_zone_ids]").val(),
                    price_from: $("input[name=price_from]").val(),
                    price_to: $("input[name=price_to]").val(),
                },

                success: function(response) {
                    $('#table_data').html(response);
                    // $('#selectSort option[value="'+selection+'"]').prop('selected', true);
                },
                error: function(response) {

                }
            });
        }
        //End function of pagination product


        function fetch_hotels() {
        var url = "/hotels/retrieve";
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: url,
            method: "POST",
            data: {
                searchHotelId:$('#searchId').val(),

                hotel_ids: $("input[name=hotel_ids]").val(),
                hotel_rating: $("input[name=hotel_rating]").val(),
                hotel_countries_ids: $("input[name=hotel_countries_ids]").val(),
                hotel_cities_ids: $("input[name=hotel_cities_ids]").val(),
                hotel_zone_ids: $("input[name=hotel_zone_ids]").val(),
                price_from: $("input[name=price_from]").val(),
                price_to: $("input[name=price_to]").val(),


            },
            success: function(result){
                 console.log(result);
                $("#table_data").html(result);
            },
            error: function(jqXHR, textStatus, error){
                console.log(textStatus + " - " + jqXHR.responseText);
            }
        });
    }
    function search_hotels() {
        var url = "/hotels/search";
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: url,
            method: "POST",
            data: {
                childs: $("[name=childs]").val(),
                adults: $("[name=adults]").val(),
                nights: $("[name=nights]").val(),
                end_date: $("input[name=end_date]").val(),
                from_date: $("input[name=from_date]").val(),
                country_id: $("[name=country_id]").val()

            },
            success: function(result){
                console.log(result);
                $("#hotels_content").html(result);
            },
            error: function(jqXHR, textStatus, error){
                console.log(textStatus + " - " + jqXHR.responseText);
            }
        });
    }


    </script>

