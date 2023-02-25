@extends('layout.website.layout', ['Company' => $Company, 'title' => 'Safer | All Tours'])

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
    </style>


@endsection

@section('bottom-header')
    <x-website.header.general title="All Tours" :breadcrumb="$BreadCrumb" current="All Tours" />
@endsection
@section('content')


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


                        <div class="accordion accordion-flush" id="accordionFlushExample">


                            <div class="accordion-item">
                                <h2 class="accordion-header" id="flush-headingTwo">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#flush-collapseTwo" aria-expanded="false"
                                        aria-controls="flush-collapseTwo">
                                        city
                                    </button>
                                </h2>
                                <div id="flush-collapseTwo" class="accordion-collapse collapse"
                                    aria-labelledby="flush-headingTwo" data-bs-parent="#accordionFlushExample">
                                    <div class="accordion-body">
                                        @foreach ($Cities as $City)
                                            <div class="form-check">
                                                <input class="form-check-input tour_cities_id"
                                                    data-id="{{ $City->id }}" type="checkbox" value=""
                                                    id="defaultCheck4">
                                                <label class="form-check-label" for="defaultCheck4">
                                                    {{ $City->en_city }}
                                                </label>
                                            </div>
                                        @endforeach
                                        <input type="hidden" name="tour_cities_ids" />

                                    </div>
                                </div>
                            </div>

                            {{-- tour types --}}
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="flush-headingFive">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#flush-collapseFive" aria-expanded="false"
                                        aria-controls="flush-collapseFive">
                                        Tour Type
                                    </button>
                                </h2>
                                <div id="flush-collapseFive" class="accordion-collapse collapse"
                                    aria-labelledby="flush-headingFive" data-bs-parent="#accordionFlushExample">
                                    <div class="accordion-body">
                                        @foreach ($TourTypes as $Type)
                                            <div class="form-check">
                                                <input class="form-check-input tour_types_id"
                                                    data-id="{{ $Type->id }}" type="checkbox" value=""
                                                    id="defaultCheck4">
                                                <label class="form-check-label" for="defaultCheck4">
                                                    {{ $Type->en_name }}
                                                </label>
                                            </div>
                                        @endforeach
                                        <input type="hidden" name="tour_types_ids" />

                                    </div>
                                </div>
                            </div>



                            <div class="accordion-item">
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
                             </div>
                        </div>
                    </div>
                </div>

            </div>

            <div class="col-sm-12 col-xl-9">
                <div class="filtered_hotels">
                    <div class="filters">
                        <span> Available Tours</span>
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

                    @include('website.tours.toursList')



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



            var arr = [];

    var arr_cities = [];
    var arr_types = [];

    var sort_by = 0; // recommended


    $(".tour_cities_id").change(function(){
        if($(this).is(':checked')){
            arr_cities.push($(this).attr("data-id"));
        }else{
            var removeValue = $(this).attr("data-id");
            arr_cities = $.grep(arr_cities, function(n) {
                return n != removeValue;
            });
        }
        // console.log(arr);
        $("input[name=tour_cities_ids]").val(arr_cities);
        fetch_tours()
    });
//zones
    $(".tour_types_id").change(function(){
        if($(this).is(':checked')){
            arr_types.push($(this).attr("data-id"));
        }else{
            var removeValue = $(this).attr("data-id");
            arr_types = $.grep(arr_types, function(n) {
                return n != removeValue;
            });
        }
        // console.log(arr);
        $("input[name=tour_types_ids]").val(arr_types);
        fetch_tours()
    });





            $(document).on('click', '#productt .pagination a', function(event) {
                event.preventDefault();
                var page = $(this).attr('href').split('page=')[1];
                var arr = [];

                var arr_cities = [];
                var arr_types = [];


                $(".tour_cities_id").change(function() {
                    if ($(this).is(':checked')) {
                        arr_cities.push($(this).attr("data-id"));
                    } else {
                        var removeValue = $(this).attr("data-id");
                        arr_cities = $.grep(arr_cities, function(n) {
                            return n != removeValue;
                        });
                    }
                    // console.log(arr);
                    $("input[name=tour_cities_ids]").val(arr_cities);

                });
                //type
                $(".tour_Types_id").change(function() {
                    if ($(this).is(':checked')) {
                        arr_types.push($(this).attr("data-id"));
                    } else {
                        var removeValue = $(this).attr("data-id");
                        arr_types = $.grep(arr_types, function(n) {
                            return n != removeValue;
                        });
                    }
                    // console.log(arr);
                    $("input[name=tour_Types_ids]").val(arr_types);

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

                    tour_Types_ids: $("input[name=tour_types_ids]").val(),
                    tour_cities_ids: $("input[name=tour_cities_ids]").val(),

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


        function fetch_tours() {
        var url = "/tours/retrieve";
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: url,
            method: "POST",
            data: {


                tour_Types_ids: $("input[name=tour_types_ids]").val(),
                    tour_cities_ids: $("input[name=tour_cities_ids]").val(),

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


    </script>

