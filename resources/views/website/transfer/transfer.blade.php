@extends('layout.website.layout', ['Company' => $Company, 'title' => 'Safer | All Transfer'])

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
  width: 260px;
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
.obj{
            position:absolute;
            top:0;
            right:0;
        }

        .booking_info .details >label {
    font-size: 12px;
    font-weight: 600;
    text-transform: capitalize;
    color: #1C4482;
    /* width: 80px; */
    margin: 10px;
    padding: 0;
}


.popover-header button{
            border:none !important;
        }



/* webkit solution */
::-webkit-input-placeholder { text-align:right !important; }
/* mozilla solution */
input:-moz-placeholder { text-align:right !important; }
    </style>
     @if (LaravelLocalization::getCurrentLocale() === 'ar')

     <style>
        input[type="number"]:-moz-placeholder {
        text-align: right;
    }
    input[type="number"]:-ms-input-placeholder {
        text-align: right;
    }
    input[type="number"]::-webkit-input-placeholder {
        text-align: right;
    }
        </style>


     @endif


@endsection

@section('bottom-header')
    <x-website.header.general title="{{ __('links.transfer') }}" :breadcrumb="$BreadCrumb" current="{{ __('links.transfer') }}" />
@endsection
@section('content')
 <!-- newsearch section -->
 <section class="booking_hotels_section container">
    <form action="{{ LaravelLocalization::localizeUrl('/transfers') }}" method="POST">
        @csrf
        <div class="hotel_details">
            <div class="row mx-0 p-0">
                <div class="col-sm-12 col-md-6 col-xl-5 p-s-0 ">
                    <h5> {{ __('links.destination') }}</h5>

                    <div class="choices">
                        <i class="fa-solid fa-location-dot"></i>
                        <select class="form-select dynamic" required id="country" name="country_id"
                            aria-label="Default select example">
                            <option value=""> ...</option>
                            @foreach ($Countries as $Country)
                                <option value="{{ $Country->id }}"
                                    @isset($country_id) {{ $country_id == $Country->id ? 'selected' : '' }} @endisset>
                                    @if (LaravelLocalization::getCurrentLocale() === 'en')
                                        {{ $Country->en_country }}
                                    @else
                                        {{ $Country->ar_country }}
                                    @endif
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>


                <div class="col-sm-12 col-md-6 col-xl-5 p-s-0 ">
                    <h5> {{ __('links.city') }}</h5>

                    <div class="choices">
                        <i class="fa-solid fa-location-dot"></i>
                        <select class="form-select" required id="city_id" name="city_id" aria-label="Default select example">
                            <option value=""> ...</option>
                            @foreach ($Cities as $city)
                                <option value="{{ $city->id }}"
                                    @isset($city_id) {{ $city_id == $city->id ? 'selected' : '' }} @endisset>

                                    @if (LaravelLocalization::getCurrentLocale() === 'en')
                                        {{ $city->en_city }}
                                    @else
                                        {{ $city->ar_city }}
                                    @endif
                                </option>
                            @endforeach
                        </select>
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
<!--end search -->

    <section class="tours container mt-4">
        <div class="row mx-0">
            @if (session()->has('message'))
<div class="alert alert-success alert-dismissible fade show" >
                <button type="button" class="close" data-dismiss="alert">×</button>
    {{ session()->get('message') }}
</div>
@endif


@if (count($errors) > 0)
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <button type="button" class="btn-close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        <ul class="p-0 m-0" style="list-style: none;">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
            <div class="  col-sm-0 col-xl-3">
                <button class="btn filtered_button" onclick="openFilter()" id="filterButton">
                    <i class="fa-solid fa-sliders"></i> {{ __('links.search') }}
                </button>
                <div class="search_tours" id="filtered-menu">

                    <!-- <h6> search tours </h6> -->
                    <div class="filter_labels" id="filtered-menu">
                        {{-- <h6> Search Hotels By Name</h6> --}}
                        {{-- autocomplete --}}

                            <div class="row" style="padding-right: 1rem!important;">

                                <div class="col-md-10">
                                    <label for="">  @if (LaravelLocalization::getCurrentLocale() === 'en')search by car capacity
                                        @else البحث بسعة السيارة
                                        @endif</label>
                                <input class="form-control  @if (LaravelLocalization::getCurrentLocale() === 'ar')
text-right



                                @endif" min="1"   id="searchId"  type="number">
                                </div>

                                <div class="col-md-2 mt-4" ><button onclick="fetch_transfer()" class="btn btn-primary" ><i class="fa-solid fa-magnifying-glass"></i></button></div>

                           </div>
                        <div class="accordion accordion-flush" id="accordionFlushExample">


                            <div class="accordion-item">
                                <h2 class="accordion-header" id="flush-headingTwo">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#flush-collapseTwo" aria-expanded="false"
                                        aria-controls="flush-collapseTwo">

                                        @if (LaravelLocalization::getCurrentLocale() === 'en')

                                        pick-up from
                                        @else
                                        استقبال من
                                        @endif
                                    </button>
                                </h2>
                                <div id="flush-collapseTwo" class="accordion-collapse collapse"
                                    aria-labelledby="flush-headingTwo" data-bs-parent="#accordionFlushExample">
                                    <div class="accordion-body">
                                        @foreach ($pickups as $pickup)
                                            <div class="form-check">
                                                <input class="form-check-input pickups_id"
                                                    data-id="{{ $pickup->id }}" type="checkbox" value=""
                                                    id="defaultCheck4">
                                                <label class="form-check-label" for="defaultCheck4">

                                                    @if (LaravelLocalization::getCurrentLocale() === 'en')

                                                    {{ $pickup->location_enname }}
                                                    @else
                                                    {{ $pickup->location_arname }}
                                                    @endif
                                                </label>
                                            </div>
                                        @endforeach
                                        <input type="hidden" name="pickups_ids" />

                                    </div>
                                </div>
                            </div>

                            {{-- tour types --}}
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="flush-headingFive">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#flush-collapseFive" aria-expanded="false"
                                        aria-controls="flush-collapseFive">

                                        @if (LaravelLocalization::getCurrentLocale() === 'en')

                                        drop-off
                                        @else
                                      وصول الى
                                        @endif
                                    </button>
                                </h2>
                                <div id="flush-collapseFive" class="accordion-collapse collapse"
                                    aria-labelledby="flush-headingFive" data-bs-parent="#accordionFlushExample">
                                    <div class="accordion-body">
                                        @foreach ($dropoff as $drop)
                                            <div class="form-check">
                                                <input class="form-check-input dropoff_id"
                                                    data-id="{{ $drop->id }}" type="checkbox" value=""
                                                    id="defaultCheck4">
                                                <label class="form-check-label" for="defaultCheck4">

                                                    @if (LaravelLocalization::getCurrentLocale() === 'en')

                                                    {{ $drop->location_enname }}
                                                    @else
                                                    {{ $drop->location_arname }}
                                                    @endif
                                                </label>
                                            </div>
                                        @endforeach
                                        <input type="hidden" name="dropoff_ids" />

                                    </div>
                                </div>
                            </div>

{{-- model --}}
<div class="accordion-item">
    <h2 class="accordion-header" id="flush-headingElev">
        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
            data-bs-target="#flush-collapseElev" aria-expanded="false"
            aria-controls="flush-collapseFive">

            @if (LaravelLocalization::getCurrentLocale() === 'en')

            car models
            @else
            موديلات السيارات
            @endif
        </button>
    </h2>
    <div id="flush-collapseElev" class="accordion-collapse collapse"
        aria-labelledby="flush-headingElev" data-bs-parent="#accordionFlushExample">
        <div class="accordion-body">
            @foreach ($CarModels as $model)
                <div class="form-check">
                    <input class="form-check-input CarModels_id"
                        data-id="{{ $model->id }}" type="checkbox" value=""
                        id="defaultCheck4">
                    <label class="form-check-label" for="defaultCheck4">

                        @if (LaravelLocalization::getCurrentLocale() === 'en')
                        {{ $model->model_enname }}

                        @else
                        {{ $model->model_arname }}
                        @endif
                    </label>
                </div>
            @endforeach
            <input type="hidden" name="CarModels_ids" />

        </div>
    </div>
</div>
{{-- class --}}
<div class="accordion-item">
    <h2 class="accordion-header" id="flush-headingTen">
        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
            data-bs-target="#flush-collapseTen" aria-expanded="false"
            aria-controls="flush-collapseTen">

           @if (LaravelLocalization::getCurrentLocale() === 'en')

           car class
           @else

فئة السيارة
           @endif
        </button>
    </h2>
    <div id="flush-collapseTen" class="accordion-collapse collapse"
        aria-labelledby="flush-headingTen" data-bs-parent="#accordionFlushExample">
        <div class="accordion-body">
            @foreach ($CarClass as $car)
                <div class="form-check">
                    <input class="form-check-input CarClass_id"
                        data-id="{{ $car->id }}" type="checkbox" value=""
                        id="defaultCheck4">
                    <label class="form-check-label" for="defaultCheck4">

                        @if (LaravelLocalization::getCurrentLocale() === 'en')

                        {{ $car->class_enname }}
                        @else
                        {{ $car->class_arname }}
                        @endif
                    </label>
                </div>
            @endforeach
            <input type="hidden" name="CarClass_ids" />

        </div>
    </div>
</div>


                        </div>
                    </div>
                </div>

            </div>

            <div class="col-sm-12 col-xl-9">
                <div class="filtered_hotels">
                    <div class="filters">
                        <span>
                            @if (LaravelLocalization::getCurrentLocale() === 'en')

                            Pick up your car
                            @else

التقط سيارتك
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

                    @include('website.transfer.transferList')



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

    {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/dayjs/1.11.4/dayjs.min.js" integrity="sha512-Ot7ArUEhJDU0cwoBNNnWe487kjL5wAOsIYig8llY/l0P2TUFwgsAHVmrZMHsT8NGo+HwkjTJsNErS6QqIkBxDw==" crossorigin="anonymous" referrerpolicy="no-referrer" defer=""defer"></script> --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/js/all.min.js" integrity="sha512-Tn2m0TIpgVyTzzvmxLNuqbSJH3JP8jm+Cy3hvHrW7ndTDcJ1w5mBiksqDBb8GpE2ksktFvDB/ykZ0mDpsZj20w==" crossorigin="anonymous" referrerpolicy="no-referrer" defer="defer"></script>
    {{-- <script src="{{ asset('/website_assets/js/datepicker-bs4.js?')}}" defer="defer"></script> --}}

<script>

            let startDate = new Date();
            startDate.setDate(startDate.getDate() + 1);

        $(document).ready(function() {
            $('.dynamic').change(function() {

if ($(this).val() != '') {
    var select = $(this).attr("id");
    var value = $(this).val();


    $.ajax({
        url: "{{ route('dynamicSearchCity.fetch') }}",
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
            // $('.transfer_date').datepicker().datepicker('setDate', new Date());
            flatpickr(".transfer_date", {
    enableTime: true,
    dateFormat: "Y-m-d H:i",

    defaultDate: startDate,
    minDate: startDate,
});
//
            var arr = [];

    var arr_pickups = [];
    var arr_dropoff = [];
    var arr_CarModels = [];
    var arr_CarClass = [];

    var sort_by = 0; // recommended


    $(".pickups_id").change(function(){
        if($(this).is(':checked')){
            arr_pickups.push($(this).attr("data-id"));
        }else{
            var removeValue = $(this).attr("data-id");
            arr_pickups = $.grep(arr_pickups, function(n) {
                return n != removeValue;
            });
        }
        // console.log(arr);
        $("input[name=pickups_ids]").val(arr_pickups);
        fetch_transfer()
    });
//zones
    $(".dropoff_id").change(function(){
        if($(this).is(':checked')){
            arr_dropoff.push($(this).attr("data-id"));
        }else{
            var removeValue = $(this).attr("data-id");
            arr_dropoff = $.grep(arr_dropoff, function(n) {
                return n != removeValue;
            });
        }
        // console.log(arr);
        $("input[name=dropoff_ids]").val(arr_dropoff);
        fetch_transfer()
    });
//zones
$(".CarModels_id").change(function(){
        if($(this).is(':checked')){
            arr_CarModels.push($(this).attr("data-id"));
        }else{
            var removeValue = $(this).attr("data-id");
            arr_CarModels = $.grep(arr_CarModels, function(n) {
                return n != removeValue;
            });
        }
        // console.log(arr);
        $("input[name=CarModels_ids]").val(arr_CarModels);
        fetch_transfer()
    });
    //zones
    $(".CarClass_id").change(function(){
        if($(this).is(':checked')){
            arr_CarClass.push($(this).attr("data-id"));
        }else{
            var removeValue = $(this).attr("data-id");
            arr_CarClass = $.grep(arr_CarClass, function(n) {
                return n != removeValue;
            });
        }
        // console.log(arr);
        $("input[name=CarClass_ids]").val(arr_CarClass);
        fetch_transfer()
    });




            $(document).on('click', '#productt .pagination a', function(event) {
                event.preventDefault();
                var page = $(this).attr('href').split('page=')[1];
                var arr = [];

                var arr_pickups = [];
    var arr_dropoff = [];
    var arr_CarModels = [];
    var arr_CarClass = [];

    var sort_by = 0; // recommended


    $(".pickups_id").change(function(){
        if($(this).is(':checked')){
            arr_pickups.push($(this).attr("data-id"));
        }else{
            var removeValue = $(this).attr("data-id");
            arr_pickups = $.grep(arr_pickups, function(n) {
                return n != removeValue;
            });
        }
        // console.log(arr);
        $("input[name=pickups_ids]").val(arr_pickups);
    });
//zones
    $(".dropoff_id").change(function(){
        if($(this).is(':checked')){
            arr_dropoff.push($(this).attr("data-id"));
        }else{
            var removeValue = $(this).attr("data-id");
            arr_dropoff = $.grep(arr_dropoff, function(n) {
                return n != removeValue;
            });
        }
        // console.log(arr);
        $("input[name=dropoff_ids]").val(arr_dropoff);
    });
//zones
$(".CarModels_id").change(function(){
        if($(this).is(':checked')){
            arr_CarModels.push($(this).attr("data-id"));
        }else{
            var removeValue = $(this).attr("data-id");
            arr_CarModels = $.grep(arr_CarModels, function(n) {
                return n != removeValue;
            });
        }
        // console.log(arr);
        $("input[name=CarModels_ids]").val(arr_CarModels);
    });
    //zones
    $(".CarClass_id").change(function(){
        if($(this).is(':checked')){
            arr_CarClass.push($(this).attr("data-id"));
        }else{
            var removeValue = $(this).attr("data-id");
            arr_CarClass = $.grep(arr_CarClass, function(n) {
                return n != removeValue;
            });
        }
        // console.log(arr);
        $("input[name=CarClass_ids]").val(arr_CarClass);
    });


                fetch_productdata(page, arr, arr_pickups, arr_dropoff,arr_CarClass,arr_CarClass);

            });
        });
        // End paginate product
        //function of pagination product

        function fetch_productdata(page, arr, arr_pickups, arr_dropoff,arr_CarClass,arr_CarClass) {
            // alert(category)
            var country_id = $('#country').find(":selected").val();
            var city_id = $('#city_id').find(":selected").val();
            $.ajax({
                url: "/fetch-transfers-filter?page=" + page,
                data: {
                    searchCarCapacity:$('#searchId').val(),
                    pickups_ids: $("input[name=pickups_ids]").val(),
                    dropoff_ids: $("input[name=dropoff_ids]").val(),

                    CarModels_ids: $("input[name=CarModels_ids]").val(),
                    CarClass_ids: $("input[name=CarClass_ids]").val(),
                    country_id:country_id,
                    city_id:city_id,
                },

                success: function(response) {
                    $('#table_data').html(response);
                    $("#pills-home-tab").focus();
                    flatpickr(".transfer_date", {
    enableTime: true,
    dateFormat: "Y-m-d H:i",

    defaultDate: startDate,
    minDate: startDate,
});
                    // $('#selectSort option[value="'+selection+'"]').prop('selected', true);
                },
                error: function(response) {

                }
            });
        }
        //End function of pagination product


        function fetch_transfer() {

        var url = "/transfers/retrieve";
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: url,
            method: "POST",
            data: {

                searchCarCapacity:$('#searchId').val(),
                pickups_ids: $("input[name=pickups_ids]").val(),
                    dropoff_ids: $("input[name=dropoff_ids]").val(),

                    CarModels_ids: $("input[name=CarModels_ids]").val(),
                    CarClass_ids: $("input[name=CarClass_ids]").val(),


            },
            success: function(result){
                 console.log(result);
                $("#table_data").html(result);
                flatpickr(".transfer_date", {
    enableTime: true,
    dateFormat: "Y-m-d H:i",

    defaultDate: startDate,
    minDate: startDate,
});

            },
            error: function(jqXHR, textStatus, error){
                console.log(textStatus + " - " + jqXHR.responseText);
            }
        });
    }


    </script>

