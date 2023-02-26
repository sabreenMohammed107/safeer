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
    margin-right: 10px;
    padding: 0;
}
    </style>


@endsection

@section('bottom-header')
    <x-website.header.general title="All Transfer" :breadcrumb="$BreadCrumb" current="All Transfer" />
@endsection
@section('content')


    <section class="tours container mt-4">
        <div class="row mx-0">
            <div class="  col-sm-0 col-xl-3">
                <button class="btn filtered_button" onclick="openFilter()" id="filterButton">
                    <i class="fa-solid fa-sliders"></i> search Transfer
                </button>
                <div class="search_tours" id="filtered-menu">

                    <!-- <h6> search tours </h6> -->
                    <div class="filter_labels" id="filtered-menu">
                        {{-- <h6> Search Hotels By Name</h6> --}}
                        {{-- autocomplete --}}


                        <div class="accordion accordion-flush" id="accordionFlushExample">


                            <div class="accordion-item">
                                <h2 class="accordion-header" id="flush-headingTwo">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#flush-collapseTwo" aria-expanded="false"
                                        aria-controls="flush-collapseTwo">
                                        pick-up from
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
                                                    {{ $pickup->location_enname }}
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
                                        drop-off
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
                                                    {{ $drop->location_enname }}
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
            car models
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
                        {{ $model->model_enname }}
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
           car class
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
                        {{ $car->class_enname }}
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
                        <span> pick up your car</span>
                        <div class="left_filter">
                            <ul class="nav nav-pills " id="pills-tab" role="tablist">
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link sort_by active" data-val="rec" id="pills-home-tab"
                                        data-bs-toggle="pill" data-bs-target="#pills-home" type="button" role="tab"
                                        aria-controls="pills-home" aria-selected="true">Recommended </button>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link sort_by" data-val="price" id="pills-profile-tab"
                                        data-bs-toggle="pill" data-bs-target="#pills-profile" type="button"
                                        role="tab" aria-controls="pills-profile" aria-selected="false"> by
                                        price</button>
                                </li>

                                <li class="nav-item" role="presentation">
                                    <button class="nav-link sort_by" data-val="alpha" id="pills-alpha-tab"
                                        data-bs-toggle="pill" data-bs-target="#pills-alpha" type="button"
                                        role="tab" aria-controls="pills-alpha" aria-selected="false">
                                        alphabitic</button>
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
<script>


        $(document).ready(function() {

            $('.datepicker').datepicker({
                "setDate": new Date(),
                "autoclose": true
            });

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


                fetch_productdata(page, arr, arr_cities, arr_types);

            });
        });
        // End paginate product
        //function of pagination product

        function fetch_productdata(page,city, tourType, priceRange) {
            // alert(category)
            $.ajax({
                url: "/fetch-tour-filter?page=" + page,
                data: {

                    pickups_ids: $("input[name=pickups_ids]").val(),
                    dropoff_ids: $("input[name=dropoff_ids]").val(),

                    CarModels_ids: $("input[name=CarModels_ids]").val(),
                    CarClass_ids: $("input[name=CarClass_ids]").val(),
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


        function fetch_transfer() {
        var url = "/transfers/retrieve";
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: url,
            method: "POST",
            data: {


                pickups_ids: $("input[name=pickups_ids]").val(),
                    dropoff_ids: $("input[name=dropoff_ids]").val(),

                    CarModels_ids: $("input[name=CarModels_ids]").val(),
                    CarClass_ids: $("input[name=CarClass_ids]").val(),


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


    </script>

