@extends('layout.website.layout', ['Company' => $Company, 'title' => "Safer | {$Tour->en_name}  Profile"])

@section('adds_css')
    <meta name="csrf-token" content="{{ csrf_token() }}">


    <link rel="stylesheet" href="{{ asset('/website_assets/css/about.css') }}">
    <link rel="stylesheet" href="{{ asset('/website_assets/css/tour-details.css') }}">
    <link rel="stylesheet" href="{{ asset('/website_assets/css/hotel-details.css') }}">
    <link rel="stylesheet" href="{{ asset('/website_assets/css/blog.css') }}">
    <style>
        #next,
        #previous {
            display: none;
        }

        .avaliable span>a {

            cursor: pointer;
        }

        .tooltip-body {

            display: flex;
        }

        .tooltip-inner {
            color: black !important;
            border: 3px solid #1C4482 !important;
            background-color: white !important;
            display: flex !important;
            padding: 5px 15px !important;
            max-width: 300px !important; //define whatever width you want
        }

        .tooltip-inner h5 {
            text-align: left;
            color: #1C4482 !important;
        }

        .tooltip-inner h6 {
            text-align: left;
            color: #1C4482 !important;
        }

        .tooltip-inner p {

            color: #7E7E7E !important;
        }

        .popover-header button{
            border:none !important;
        }
    </style>
@endsection
@section('bottom-header')
    <x-website.header.general :title="$Tour->en_name . ' - '" :breadcrumb="$BreadCrumb" :current="$Tour->en_name" />
@endsection

@section('content')
    {{-- google reviews --}}
    <?php
    // $cid =0x424a7b3906d2a73e;
    $cid = $Tour->google_place;
    //CID of a place can be genrated from https://pleper.com/index.php?do=tools&sdo=cid_converter
    //execute curl
    $url = 'https://maps.googleapis.com/maps/api/place/details/json?cid=' . $cid . '&key=AIzaSyB9BVYo2lK6DClKsR5crlGhu-31lYgfK9U';
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_HEADER, 1);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HEADER, false);
    $data = curl_exec($ch);
    curl_close($ch);

    $arrayData = json_decode($data, true); // json object to array conversion
    if (isset($arrayData['result'])) {
        $result = $arrayData['result'];

        // $total_users    = $result['user_ratings_total']; // display total number of users who rated
        $overall_rating = $result['rating']; // display total average rating
        $reviews = $result['reviews']; //holds information like author_name, author_url, language, profile_photo_url, rating, relative_time_description, text, time

        //display on view
        // var_dump($total_users);

        // var_dump($reviews);
        // $data = "https://www.google.com/maps/place/%D9%81%D9%86%D8%AF%D9%82+%D9%85%D8%B1%D9%85%D8%B1%D8%A9+%D8%AA%D9%82%D8%B3%D9%8A%D9%85+%D9%85%D9%8A%D8%AF%D8%A7%D9%86%E2%80%AD/@41.0362673,28.9863785,15z/data=!4m8!3m7!1s0x0:0x424a7b3906d2a73e!5m2!4m1!1i2!8m2!3d41.0362673!4d28.9863785";
        // $last_index_of_i = strripos($data, ':');

        // $whatIWant = substr($data, $last_index_of_i+1);
        // $first_index_of_i = stripos($whatIWant,'!');

        // $whatIWant2 = substr($whatIWant,0, $first_index_of_i);
        // echo $whatIWant2;
    }
    ?>
    {{-- @foreach ($reviews as $review)
{{$review['author_name']}}
@endforeach --}}
    {{-- end googlereviews --}}
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
    <!-- tour details -->
    <section class="container details_section">
        <div class="row mx-0">
            @if (count($TourGallery))
                <div class="col-sm-12 col-xl-6">
                    <div class="row mx-0 left_side_imgages">
                        <div class="col-12 d-flex align-items-center justify-content-center image_cover ">
                            <img id="mainImage" src="{{ asset('uploads/galleries') }}/{{ $TourGallery[0]->img ?? ' ' }}"
                                class="w-100 mb-3" alt=" tour hotel image " />
                            <button id="previous"> <i class="fa-solid fa-angle-left"></i></button>
                            <button id="next"> <i class="fa-solid fa-angle-right"></i></button>
                        </div>
                        <div class="col-12">
                            <div id="divId" onclick="changeImageOnClick(event)">
                                @for ($i = 1; $i < 4; $i++)
                                    @if (count($TourGallery) > $i)
                                        <img class="imgStyle"
                                            src="{{ asset('uploads/galleries') }}/{{ $TourGallery[$i]->img ?? ' ' }}"
                                            alt=" tour hotel image " />
                                    @endif
                                @endfor
                            </div>
                        </div>
                    </div>
                </div>
            @endif
            {{--
    </div> --}}

            @if (count($TourGallery))
                <div class="col-sm-12 col-xl-6">
                @else
                    <div class="col-sm-12 col-xl-12">
            @endif
            <div class="tour_info px-2">
                <div class="titles">
                    <h6> {{ $Tour->en_name }}</h6>
                    <span> {{ $Tour->city->country->en_country }} <span>|</span> {{ $Tour->city->en_city }} </span>
                    <div class="rating">


                        <span> ( {{ count($Tour->reviews) }} review) </span>
                    </div>
                    <div class="sharing_icons">
                        {{-- <i class="fa-solid fa-share-nodes"></i> --}}


                        @if (session()->get('SiteUser'))



                        @php
                            $favExist = 0;
                            $favUser = App\Models\Favorite_hotels_tour::where('tour_id', $Tour->id)
                                ->where('user_id', session()->get('SiteUser')['ID'])
                                ->first();
                            if ($favUser) {
                                $favExist = 1;
                            }
                        @endphp

                        @else
                            @php
                                $favExist=0;
                            @endphp
                        @endif
                        <span >
                            @if($favExist==1)
                        <a  href="{{ url('/removeFavouriteTours/' . $Tour->id) }}"  ><i
                                 class="fa-regular fa-heart "  style="background-color: #1C4482; color:#fff"></i> </a>

                                 @else

                                <a  href="{{ url('/favouriteTours/' . $Tour->id) }}"  ><i
                                    class="fa-regular fa-heart"></i> </a>

                            @endif </span>

                        {{-- <div class="heart" data-bs-toggle="modal"
                            data-bs-target="#staticBack{{ $Tour->hotel_id }}drop">
                            {{-- <input type="checkbox" id="fav" type="submit modl_fav_add_remov"
                                onclick="setHeart(this)" data-info-fav="not_added">

                            <label class="heart" for="fav"></label> --}}
                        {{-- </div> --}}


                        {{-- this is model modified by AHMEDsyd --}}
                        {{-- this is model modified by AHMEDsyd --}}
                        {{-- this is model modified by AHMEDsyd --}}
                        <div class="modal fade addFavDialog" id="staticBack{{ $Tour->id }}drop"
                            data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
                            aria-labelledby="staticBackdropLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="staticBackdropLabel">Add
                                            Favorite</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <h3>Add To Favorite</h3>
                                        <h6> <a class="stretched-link">{{ $Tour->en_name }}
                                            </a></h6>
                                    </div>
                                    <div class="modal-footer">
                                        <button class="btn btn-primary" onclick="setHeart(this)"
                                            data-bs-dismiss="modal">Add</button>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>

                <h6> important note </h6>
                <p>
                    {!! $Tour->en_overview !!}
                </p>


            </div>
        </div>

        </div>
    </section>

    <section class="tour_add_info container">
        <div class="row mx-0">
            <div class="col-md-6 col-sm-12 col-xl-3">
                <div class="tour_info_details">
                    <img src="{{ asset('/website_assets/images/tour-details/tour_info/timer.webp') }}" alt=" timer image">
                    <h6> Tour Type </h6>
                    <span> {{ $Tour->type->en_name ?? '' }}</span>
                </div>
            </div>
            <div class="col-md-6 col-sm-12 col-xl-3">
                <div class="tour_info_details ">
                    <img src="{{ asset('/website_assets/images/tour-details/tour_info/requires-interpreter.webp') }}"
                        alt=" requires-interpreter image">
                    <h6> Tour Language </h6>
                    <span> {{ $Tour->tour_en_language }} </span>
                </div>
            </div>
            <div class="col-md-6 col-sm-12 col-xl-3">
                <div class="tour_info_details second_details">
                    <img src="{{ asset('/website_assets/images/tour-details/tour_info/clock.webp') }}" alt=" clock image">
                    <h6> Tour Days  </h6>
                    <span> {{ $Tour->tour_en_days }}</span>
                </div>
            </div>

            <div class="col-md-6 col-sm-12 col-xl-3">
                <div class="tour_info_details after_details">
                    <img src="{{ asset('/website_assets/images/tour-details/tour_info/passenger-with-baggage.webp') }}"
                        alt=" passenger-with-baggage image">
                    <h6> Cost / Person </h6>
                    <span>{{ $Tour->tour_person_cost }} </span>
                </div>
            </div>

        </div>
    </section>
    <!-- included and not included section -->

    <section class="included container">
        <h5> Tour facilities</h5>
        <div class="row mx-0">
            <div class="col-sm-12 col-xl-6 pb-5">
                @if (count($Tour->features))
                    @foreach ($FeaturesCategories as $k => $category)
                        <div class="accordion" id="accordionPanelsStayOpenExample{{ $k }}">
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="panelsStayOpen-headingTwo">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#panelsStayOpen-collapseTwo{{ $k }}"
                                        aria-expanded="false"
                                        aria-controls="panelsStayOpen-collapseTwo{{ $k }}">
                                        {{ $category->en_category }}
                                    </button>
                                </h2>
                                <div id="panelsStayOpen-collapseTwo{{ $k }}"
                                    class="accordion-collapse collapse show" aria-labelledby="panelsStayOpen-headingTwo">
                                    <div class="accordion-body">
                                        <div class="included_info">
                                            @foreach ($Tour->features as $feature)
                                                @if ($feature->feature_category_id == $category->id)
                                                    <div class="include-1">
                                                        <img width="20" src="{{ asset('uploads/features') }}/{{$feature->icon ?? ' ' }}"
                                                            alt="">

                                                        <span>{{ $feature->en_feature }}</span>
                                                    </div>
                                                @endif
                                            @endforeach

                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    @endforeach
                @else
                    No hotel facilities provided
                @endif
            </div>
            <div class="col-sm-12 col-xl-6 ">

                @if ($Tour->tour_vedio)
                    <div class="images image-2">
                        <!-- <img src="./images/tour-details/video.webp" class="w-100" alt="image mask"> -->
                        <button type="button" class="btn js-modal-btn " data-video-url="{{$Tour->tour_vedio}}"
                            data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                            <img src="{{ asset('/website_assets/images/homePage/play_button.webp') }}"
                               style="border-radius: 50%" alt=" video play button">
                        </button>

                    </div>
                @endif

                @if ($Tour->google_map)
                    <div class="map">
                        <iframe src="{{ $Tour->google_map }}" style="border:0;" allowfullscreen="" loading="lazy"
                            referrerpolicy="no-referrer-when-downgrade"></iframe>
                    </div>
                @endif

            </div>
    </section>
    <!-- search hitels and rooms avaliable  section -->
    <section class="rooms_search">

        <img src="{{ asset('/website_assets/images/hotel-details/slider-mask_top.webp') }}" alt="slider mask">
        <img src="{{ asset('/website_assets/images/hotel-details/slider-mask-bottom.webp') }}" alt="slider mask">

        <div class="hotels container">
            <h5> book tour </h5>
            <section class="booking_hotels_section container">
                <form action="{{ url('/bookTours') }}" method="POST">
                    @csrf
                    <input type="hidden" name="tour_id" value="{{ $Tour->id }}">
                    <div class="hotel_details">
                        <div class="row mx-0 p-0">
                            <div class="col-sm-12 col-md-6 col-xl-2 p-s-0 ">
                                <h5> {{ $Tour->en_name }}</h5>

                                <div class="choices">
                                    {{-- <i class="fa-solid fa-location-dot"></i> --}}
                                    {{ $Tour->city->en_city ?? '' }}
                                </div>
                            </div>


                            <div class="col-sm-12 col-md-6 col-xl-2 p-s-0 ">
                                <h5> Tour Type</h5>

                                <div class="choices">
                                    {{ $Tour->type->en_name ?? '' }}
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-6 col-xl-3 p-0 ">
                                <h5> Tour Date </h5>

                                <input type="text" id="end_date" placeholder="DD/MM/YYYY" class="form-control" name="tour_date" min="2000-01-01" max="2025-12-31" autocomplete="off" />

                            </div>

                            <div class="col-sm-12 col-md-6 col-xl-3">
                                <h5>Adults | Child No.</h5>
                                <div class="rooms" style="padding: 0;box-shadow: 0">
                                    <button class="info form-select" type="button" onclick="open_addnew()">
                                        <i class="fa-regular fa-user"></i>
                                        <span id="adults"> 1 adults </span>
                                        <span id="children"> 0 children </span>
                                    </button>
                                    <div class="add_new" id="add_new">
                                        <div class="form-group counter">
                                            <label>adults</label>
                                            <div class="input-group counter_content">
                                                <div class="input-group-btn">
                                                    <button id="down" type="button" class=" btn btn-default"
                                                        onclick=" adultdown('1')"><span class="glyphicon glyphicon-minus">
                                                            <i class="fa-solid fa-minus"></i></span></button>
                                                </div>
                                                <input type="text" name="adultsNumber" id="adultsNumber"
                                                    class="form-control input-number" value="1" />
                                                <div class="input-group-btn">
                                                    <button id="up" type="button" class="btn btn-default"
                                                        onclick="adultup('10')"><span class="glyphicon glyphicon-plus"><i
                                                                class="fa-solid fa-plus"></i></span></button>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group counter">
                                            <label>children</label>
                                            <div class="input-group counter_content">
                                                <div class="input-group-btn">
                                                    <button id="down" type="button" class="btn btn-default"
                                                        onclick=" childdown('0') ; removeYearsSelect() "><span
                                                            class="glyphicon glyphicon-minus"> <i
                                                                class="fa-solid fa-minus"></i></span></button>
                                                </div>
                                                <input type="text" name="childNumber" id="childNumber"
                                                    class="form-control input-number" value="0"
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

                                        </div>

                                        <button type="button" class="btn done_button" onclick="close_addnew()">
                                            Done </button>
                                    </div>
                                </div>

                            </div>
                            <div class="col-sm-12 col-md-6 col-xl-1 p-0 ">
                                <div class="main" id="room_main">

                                    <button class="btn" type="submit">
                                        BOOK
                                    </button>
                                </div>
                            </div>

                        </div>
                    </div>
                </form>
            </section>
        </div>


    </section>


    <!-- rooms section -->
    <section class="reviews container">
        <div class="review_heading">
            <h5>
                tour review
                @isset($arrayData['result'])
                    <div><span style="margin-right:5px" class="Aq14fc" aria-hidden="true">


                        </span>
                        <span class="z3HNkc" aria-label="Rated 4.4 out of 5," role="img">
                            <span style="width:62px"></span></span>
                        <a class="hqzQac" style="white-space:nowrap;font-size:14px;margin-left:5px"
                            href="{{ $Tour->google_reviews }}" target="_blank">
                            {{ number_format((float) $result['rating'], 1, '.', '') }} Google reviews</a>
                    </div>
                @endisset
            </h5>
            <!-- modal -->
            <!-- Button trigger modal -->
            @if (session()->get('SiteUser'))
                <button type="button" class="btn add_comment_button" data-bs-toggle="modal"
                    data-bs-target="#exampleModal">
                    <i class="fa-solid fa-plus"></i> add comment
                </button>
            @else
                <a href="{{ route('siteLogin') }}" class="btn add_comment_button"> <i class="fa-solid fa-plus"></i> add
                    comment</a>
            @endif
            {{-- <button type="button" class="btn add_comment_button" data-bs-toggle="modal" data-bs-target="#exampleModal">
            <i class="fa-solid fa-plus"></i> add comment
        </button> --}}

            <!-- Modal -->
            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <form action="{{ url('/tours/review/add') }}" method="POST">
                            @csrf
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">add comment </h5>
                                <input type="hidden" name="tour_id" value="{{ $Tour->id }}" />
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div class="rating" id="rating_stars">
                                    <i onclick="changeRate(1)" class="fa-regular fa-star rate_1"></i>
                                    <i onclick="changeRate(2)" class="fa-regular fa-star rate_2"></i>
                                    <i onclick="changeRate(3)" class="fa-regular fa-star rate_3"></i>
                                    <i onclick="changeRate(4)" class="fa-regular fa-star rate_4"></i>
                                    <i onclick="changeRate(5)" class="fa-regular fa-star rate_5"></i>
                                    <input type="hidden" value="0" name="rate_val" />
                                </div>
                                <div class="form-floating comment_input">
                                    <textarea class="form-control" name="review_text" placeholder="Leave a comment here" id="floatingTextarea2"
                                        style="height: 200px"></textarea>
                                    <label for="floatingTextarea2"> your Comments ...</label>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-primary comment_pop_btn">add comment </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        @isset($arrayData['result'])
            @foreach ($reviews as $key => $review)
                <div class="review_details">
                    <img src="{{ $review['profile_photo_url'] }}" alt="profile picture ">
                    <div class="review_info">
                        <div class="heading">
                            <h6>{{ $review['author_name'] }}
                                <p> {{ $review['relative_time_description'] }}
                                </p>
                                <img src={{ asset('/website_assets/images/google-icon-isolated_68185-565.webp') }}
                                    width='30'>
                            </h6>

                            <div class="rating">
                                @for ($i = 0; $i < $review['rating']; $i++)
                                    <i class="fa-solid fa-star"></i>
                                @endfor
                                @for ($i = 5; $i > $review['rating']; $i--)
                                    <i class="fa-regular fa-star"></i>
                                @endfor
                            </div>
                        </div>
                        <p>
                            {{ $review['text'] }}
                        </p>
                    </div>

                </div>
            @endforeach
        @endisset


        @foreach ($Tour->reviews as $rev)
            <div class="review_details">
                <img src="{{ asset('/website_assets/images/tour-details/profile/profile-1.webp') }}"
                    alt="profile picture ">
                <div class="review_info">
                    <div class="heading">
                        <h6> user name </h6>
                        <div class="rating">
                            @for ($i = 0; $i < $rev->review_stars; $i++)
                                <i class="fa-solid fa-star"></i>
                            @endfor
                            @for ($i = 5; $i > $rev->review_stars; $i--)
                                <i class="fa-regular fa-star"></i>
                            @endfor
                        </div>
                    </div>
                    <p>
                        {{ $rev->review_text }}
                    </p>
                </div>

            </div>
        @endforeach

        @if (count($Tour->reviews) > 10)
            <button class="btn comments_button">
                load all comments
            </button>
        @endif
    </section>
    <!--  ending page  -->
@endsection


@section('adds_js')
    <script>
document.addEventListener('DOMContentLoaded', function () {
	jQuery('#start_date, #end_date, #birth_date').datepicker({

	});
});
        $(document).ready(function() {
            // $('.datepicker').datepicker({
            //     "setDate": new Date(),
            //     "autoclose": true
            // });
            var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
            var tooltipList = tooltipTriggerList.map(function(tooltipTriggerEl) {
                return new bootstrap.Tooltip(tooltipTriggerEl)
            })

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

        });

        function changeRate(value) {
            debugger;
            $('#rating_stars').children('i').each(function(i) {
                // if(i < value){
                //     this.removeClass("fa-regular");
                //     this.addClass("fa-solid");
                // }else{
                //     this.removeClass("fa-solid");
                //     this.addClass("fa-regular");
                // }
                console.log(this);

            });
            for (let index = 0; index < 5; index++) {
                if (index < value) {
                    $(".rate_" + (index + 1)).removeClass("fa-regular");
                    $(".rate_" + (index + 1)).addClass("fa-solid");
                } else {
                    $(".rate_" + (index + 1)).removeClass("fa-solid");
                    $(".rate_" + (index + 1)).addClass("fa-regular");
                }
                $("input[name=rate_val]").val(value);
            }
        }

        function fetch_hotel_rooms() {
            var url = "/hotels/" + {{ $Tour->id }} + "/fetch";
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: url,
                method: "POST",
                data: {
                    hotel_id: $("[name=hotel_id]").val(),
                    adults: $("[name=adults]").val(),
                    nights: $("[name=nights]").val(),
                    childs: $("[name=childs]").val(),
                    end_date: $("input[name=end_date]").val(),
                    from_date: $("input[name=from_date]").val()

                },
                success: function(result) {
                    console.log(result);
                    $("#rooms_content").html(result);
                },
                error: function(jqXHR, textStatus, error) {
                    console.log(textStatus + " - " + jqXHR.responseText);
                }
            });

        }

        function close_addnew() {
            // adultsNumber;
            var adultsNumber = document.getElementById("adultsNumber").value;
            var childNumber = document.getElementById("childNumber").value;

            document.getElementById("add_new").classList.toggle("show");
            document.getElementById("adults").innerHTML = adultsNumber + ' adults';
            document.getElementById("children").innerHTML = childNumber + ' children';

        }
    </script>
@endsection
