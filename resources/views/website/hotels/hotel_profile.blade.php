@extends("layout.website.layout",["Company"=>$Company, "title"=>"Safer | {$Hotel->hotel_enname} Room Profile"])

@section("adds_css")
<meta name="csrf-token" content="{{ csrf_token() }}">
<link rel="stylesheet" href="{{ asset('/website_assets/css/about.css') }}">
<link rel="stylesheet" href="{{ asset('/website_assets/css/tour-details.css') }}">
<link rel="stylesheet" href="{{ asset('/website_assets/css/hotel-details.css') }}">
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
</style>
@endsection

@section("bottom-header")
<x-website.header.general :title="$Hotel->hotel_enname .' - '" :breadcrumb="$BreadCrumb"
    :current="$Hotel->hotel_enname" />
@endsection
@section("content")
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
        @if(count($HotelTourGallery))
        <div class="col-sm-12 col-xl-6">
            <div class="row mx-0 left_side_imgages">
                <div class="col-12 d-flex align-items-center justify-content-center image_cover ">
                    <img id="mainImage" src="{{ asset('uploads/galleries') }}/{{$HotelTourGallery[0]->img ?? " "}}"
                        class="w-100 mb-3" alt=" tour hotel image " />
                    <button id="previous"> <i class="fa-solid fa-angle-left"></i></button>
                    <button id="next"> <i class="fa-solid fa-angle-right"></i></button>
                </div>
                <div class="col-12">
                    <div id="divId" onclick="changeImageOnClick(event)">
                        @for ($i = 1; $i < 4; $i++) @if (count($HotelTourGallery)> $i)

                            <img class="imgStyle"
                                src="{{ asset('uploads/galleries') }}/{{$HotelTourGallery[$i]->img ?? " "}}"
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

    @if (count($HotelTourGallery))
    <div class="col-sm-12 col-xl-6">
        @else
        <div class="col-sm-12 col-xl-12">
            @endif
            <div class="tour_info">
                <div class="titles">
                    <h6> {{$Hotel->hotel_enname}}</h6>
                    <span> {{$Hotel->city->country->en_country}} <span>|</span> {{$Hotel->city->en_city}} </span>
                    <div class="rating">
                        @for ($i = 0; $i < $Hotel->hotel_stars; $i++)
                            <i class="fa-solid fa-star"></i>
                            @endfor
                            @for ($i = 5; $i > $Hotel->hotel_stars; $i--)
                            <i class="fa-regular fa-star"></i>
                            @endfor

                            <span> ( {{count($Hotel->reviews)}} review) </span>
                    </div>
                    <div class="sharing_icons">
                        {{-- <i class="fa-solid fa-share-nodes"></i> --}}


                            @if (session()->get('SiteUser'))
                            <a href="{{ url('/favourite/' . $Hotel->id) }}"
                                ><i class="fa-regular fa-heart"></i> </a>
                            @else

                            <a href="{{ route('siteLogin') }}"
                            ><i class="fa-regular fa-heart"></i></a>
                            @endif
                        {{-- <div class="heart" data-bs-toggle="modal"
                            data-bs-target="#staticBack{{ $Hotel->hotel_id }}drop">
                            {{-- <input type="checkbox" id="fav" type="submit modl_fav_add_remov"
                                onclick="setHeart(this)" data-info-fav="not_added">

                            <label class="heart" for="fav"></label> --}}
                        {{--</div> --}}


                        {{-- this is model modified by AHMEDsyd --}}
                        {{-- this is model modified by AHMEDsyd --}}
                        {{-- this is model modified by AHMEDsyd --}}
                        <div class="modal fade addFavDialog" id="staticBack{{ $Hotel->hotel_id }}drop"
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
                                        <h6> <a class="stretched-link">{{
                                                $Hotel->hotel_enname }} ???
                                                {{ $Hotel->hotel_stars }} Stars</a></h6>
                                    </div>
                                    <div class="modal-footer">
                                        <button class="btn btn-primary" onclick="setHeart(this)"
                                            data-bs-dismiss="modal">Add</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        {{-- this is model modified by AHMEDsyd --}}
                        {{-- this is model modified by AHMEDsyd --}}
                        {{-- <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                            <button class="btn btn-primary modl_fav_add_remov" onclick="setHeart(this)"
                                data-info-fav="not_added" data-bs-dismiss="modal">Add</button>
                        </div> --}}
                        {{-- this is model modified by AHMEDsyd --}}
                    </div>
                </div>

                <h6> important note </h6>
                <p>
                    {{$Hotel->hotel_enoverview}}
                </p>


            </div>
        </div>

    </div>
</section>


<!-- included and not included section -->

<section class="included container">
    <h5> hotel facilities</h5>
    <div class="row mx-0">
        <div class="col-sm-12 col-xl-6 pb-5">
            @if (count($Hotel->features))
            @foreach ($FeaturesCategories as $k => $category)
            <div class="accordion" id="accordionPanelsStayOpenExample{{$k}}">
                <div class="accordion-item">
                    <h2 class="accordion-header" id="panelsStayOpen-headingTwo">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                            data-bs-target="#panelsStayOpen-collapseTwo{{$k}}" aria-expanded="false"
                            aria-controls="panelsStayOpen-collapseTwo{{$k}}">
                            {{$category->en_category}}
                        </button>
                    </h2>
                    <div id="panelsStayOpen-collapseTwo{{$k}}" class="accordion-collapse collapse show"
                        aria-labelledby="panelsStayOpen-headingTwo">
                        <div class="accordion-body">
                            <div class="included_info">
                                @foreach ($Hotel->features as $feature)
                                @if ($feature->feature_category_id == $category->id)
                                <div class="include-1">
                                    <img src="{{asset(" /website_assets/images/tour-details/included/$feature->icon")}}"
                                    alt="">
                                    <span>{{$feature->en_feature}}</span>
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

            @if ($Hotel->hotel_vedio)
            <div class="images image-2">
                <!-- <img src="./images/tour-details/video.webp" class="w-100" alt="image mask"> -->
                <button type="button" class="btn js-modal-btn " data-video-url="{{$Hotel->hotel_vedio}}"
                    data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                    <img src="{{asset(" /website_assets/images/homePage/play_button.webp")}}" alt=" video play button">
                </button>

            </div>
            @endif
            @if ($Hotel->google_map)
            <div class="map">
                <iframe src="{{$Hotel->google_map}}" style="border:0;" allowfullscreen="" loading="lazy"
                    referrerpolicy="no-referrer-when-downgrade"></iframe>
            </div>
            @endif

        </div>
</section>
<!-- search hitels and rooms avaliable  section -->
<section class="rooms_search">

    <img src="{{asset("/website_assets/images/hotel-details/slider-mask_top.webp")}}" alt="slider mask">
    <img src="{{ asset('/website_assets/images/hotel-details/slider-mask-bottom.webp') }}" alt="slider mask">

    <div class="hotels container">
        <h5> search hotels </h5>
        <section class="booking_hotels_section container">
            <div class="hotel_details">
                <div class="row mx-0 p-0">
                    <div class="col-sm-12 col-md-6 col-xl-2 p-s-0 ">
                        <h5> destination</h5>

                        <div class="choices">
                            <i class="fa-solid fa-location-dot"></i>
                            <select class="form-select" name="country_id" aria-label="Default select example">
                                @foreach ($Countries as $Country)
                                    <option value="{{ $Country->id }}"
                                        @if (session()->has('sessionArr')) {{ Session::get('sessionArr')['country_id'] == $Country->id ? 'selected' : '' }} @endif>
                                        {{ $Country->en_country }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>


                    <div class="col-sm-12 col-md-6 col-xl-2 p-s-0 ">
                        <h5> city</h5>

                        <div class="choices">
                            <i class="fa-solid fa-location-dot"></i>
                            <select class="form-select" name="city_id" aria-label="Default select example">
                                @foreach ($Cities as $city)
                                    <option value="{{ $city->id }}"
                                        @if (session()->has('sessionArr')) {{ Session::get('sessionArr')['city_id'] == $city->id ? 'selected' : '' }} @endif>
                                        {{ $city->en_city }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-6 col-xl-3 p-0 ">
                        <h5> check in <span>check </span> </h5>
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
                        <h5> nights </h5>

                        <input type="text" id="nights" class="form-control" readonly name="nights"
                            value="@if (session()->has('sessionArr')) {{ Session::get('sessionArr')['nights'] }} @else 7 @endif">
                    </div>
                    <div class="col-sm-12 col-md-6 col-xl-3">
                        <h5> Add room</h5>
                        <div class="rooms" style="padding: 0;box-shadow: 0">
                            <button class="info form-select" type="button" onclick="open_addnew()">
                                <i class="fa-regular fa-user"></i>
                                <span id="adults">
                                    @if (session()->has('sessionArr'))
                                        {{ Session::get('sessionArr')['adultsNumber'] }}
                                    @else
                                        1
                                    @endif adults
                                </span>
                                <span id="children">
                                    @if (session()->has('sessionArr'))
                                        {{ Session::get('sessionArr')['childNumber'] }}
                                    @else
                                        0
                                    @endif children
                                </span>
                                <span id="rooms">
                                    @if (session()->has('sessionArr'))
                                        {{ Session::get('sessionArr')['roomsNumber'] }}
                                    @else
                                        1
                                    @endif rooms
                                </span>
                            </button>
                            <div class="add_new" id="add_new">
                                <div class="form-group counter">
                                    <label>adults</label>
                                    <div class="input-group counter_content">
                                        {{-- <div class="input-group-btn">
                                            <button id="down" type="button" class=" btn btn-default"
                                                onclick=" adultdown('0')"><span class="glyphicon glyphicon-minus"> <i
                                                        class="fa-solid fa-minus"></i></span></button>
                                        </div> --}}
                                        <input type="text" name="adultsNumber" id="adultsNumber"
                                            class="form-control input-number"
                                            @if (session()->has('sessionArr'))
                                            value="{{ Session::get('sessionArr')['adultsNumber'] }}"
                                                                                       @else
                                            value="1"
                                             @endif
                                            />
                                        {{-- <div class="input-group-btn">
                                            <button id="up" type="button" class="btn btn-default"
                                                onclick="adultup('10')"><span class="glyphicon glyphicon-plus"><i
                                                        class="fa-solid fa-plus"></i></span></button>
                                        </div> --}}
                                    </div>
                                </div>
                                <div class="form-group counter">
                                    <label>children</label>
                                    <div class="input-group counter_content">
                                        {{-- <div class="input-group-btn">
                                            <button id="down" type="button" class="btn btn-default"
                                                onclick=" childdown('0') ; removeYearsSelect() "><span
                                                    class="glyphicon glyphicon-minus"> <i
                                                        class="fa-solid fa-minus"></i></span></button>
                                        </div> --}}
                                        <input type="text" name="childNumber" id="childNumber"
                                            class="form-control input-number"
                                            @if (session()->has('sessionArr'))
                                            value="{{ Session::get('sessionArr')['childNumber'] }}"
                                                                                       @else
                                            value="0"
                                             @endif

                                            onchange="addYearsSelect()" />
                                        {{-- <div class="input-group-btn">
                                            <button id="up" type="button" class="btn btn-default"
                                                onclick="childup('10'); addYearsSelect()"><span
                                                    class="glyphicon glyphicon-plus"><i
                                                        class="fa-solid fa-plus"></i></span></button>
                                        </div> --}}

                                    </div>

                                </div>
                                <div id="years">
                                    @if (session()->has('sessionArr'))
                                        {{-- @if (!empty(session()->has('sessionArr')['ages'])) --}}
                                        @if (Session::get('sessionArr')['ages'])
                                            @foreach (Session::get('sessionArr')['ages'] as $key => $age)
                                                <select class="form-select" name="ages[]"
                                                    aria-label="Default select example">\n\

                                                    @for ($i = 0; $i < 10; $i++)
                                                        <option value="{{ $i + 1 }}"
                                                            {{ Session::get('sessionArr')['ages'][$key] == $i + 1 ? 'selected' : '' }}>
                                                            {{ $i + 1 }} years old
                                                        </option>
                                                    @endfor




                                                </select>
                                            @endforeach
                                        @endif
                                    @endif
                                </div>
                                <div class="form-group counter">
                                    <label>rooms</label>
                                     <div class="input-group counter_content">
                                        {{--<div class="input-group-btn">
                                            <button id="down" type="button" class="btn btn-default"
                                                onclick=" roomdown('0')"><span class="glyphicon glyphicon-minus"> <i
                                                        class="fa-solid fa-minus"></i></span></button>
                                        </div> --}}
                                        <input type="text" name="roomsNumber" id="roomsNumber"
                                            class="form-control input-number"
                                            @if (session()->has('sessionArr'))
                                            value="{{ Session::get('sessionArr')['roomsNumber'] }}"
                                                                                       @else
                                            value="1"
                                             @endif
                                            />
                                        {{-- <div class="input-group-btn">
                                            <button id="up" type="button" class="btn btn-default"
                                                onclick="roomup('10')"><span class="glyphicon glyphicon-plus"><i
                                                        class="fa-solid fa-plus"></i></span></button>
                                        </div> --}}
                                    </div>
                                </div>
                                <button type="button" class="btn done_button" onclick="close_addnew()">
                                    Done </button>
                            </div>
                        </div>

                    </div>
                    {{-- <div class="col-sm-12 col-md-6 col-xl-1 p-0 ">
                        <div class="main" id="room_main">

                            <button class="btn" type="submit">
                                Search
                            </button>
                        </div>
                    </div> --}}

                </div>
            </section>
        </div>
        <div class="rooms_avaliable container">
            <h5> available rooms
                @if(session("hasCart"))
                <span class="text-danger fs-6">*You have an existing Room in Your Cart</span>
                @endif
            </h5>
            <div id="rooms_content">

                @foreach ($RoomCosts as $Room)


                @if($Room->single_cost != null)
                <div class="rooms">

                    <div class="row mx-0 align-items-center text-center">
                        <div class="col-xl-2 col-sm-12 col-md-6">
                            <h6>{{$Room->en_room_type}} </h6>
                        </div>

                        <div class="col-xl-2 col-sm-12 col-md-6">
                            <h6>Single </h6>
                        </div>



                        <div class="col-xl-2 col-sm-12 col-md-6">
                            <span class="category">
                                {{$Room->food_bev_type}}
                            </span>
                        </div>
                        <div class="col-xl-2 col-sm-12 col-md-6">
                            <div class="avaliable">
                                <span> avaliable</span>

                                <span><a data-bs-toggle="tooltip" data-bs-html="true" data-bs-placement="top"
                                     title='
                                    <div class="tooltip-body">
                                      <div class="row">
                                        <h5 class="col-12">Booking for 7 nights</h5>
                                        <h6 class="col-12">Rooms</h6>
                                        <p  class="col-12"><span class="float-start">1 x Sea view Double(BB)</span> <span class="float-end">1 x $600 <br> <b>$600</b></sapn></p>
                                            <p  class="col-12"><span class="float-start">1 x Adults</span></p>
                                            <p  class="col-12"><span class="float-start">0 x Free childs (Age From 1 to 5) </span> <span class="float-end">Free</sapn></p>
                                            <p  class="col-12"><span class="float-start">2 x Paid childs (Age From 6 to 11) </span> <span class="float-end">2 x $250 <br> <b>$500</b></sapn></p>
                                      </div>
                                    </div>
                                      '>Cancellation Policy</a></span>
                            </div>
                        </div>
                        <div class="col-xl-2 col-sm-12 col-md-6">
                            <span class="price_info">
                             Cost/Day: {{$Room->single_cost}} $
                            </span>
                        </div>

                        <div class="col-xl-2 col-sm-12 col-md-6 p-0">
                            @if(!session("hasCart"))
                            <button class="btn rooms_button"> <a href="{{url("/safer/room/$Room->id/book/1")}}">Book</a> </button>
                            @else
                            <button class="btn rooms_button"><a href="{{url("/safer/room/$Room->id/book/1/exchange")}}">Replace Cart</a> </button>
                            @endif
                        </div>


                    </div>
                </div>
                @endif

                @if($Room->double_cost != null)
                <div class="rooms">

                    <div class="row mx-0 align-items-center text-center">
                        <div class="col-xl-2 col-sm-12 col-md-6">
                            <h6>{{$Room->en_room_type}}  </h6>
                        </div>



                        <div class="col-xl-2 col-sm-12 col-md-6">
                            <h6>Double </h6>
                        </div>

                        <div class="col-xl-2 col-sm-12 col-md-6">
                            <span class="category">
                                {{$Room->food_bev_type}}
                            </span>
                        </div>
                        <div class="col-xl-2 col-sm-12 col-md-6">
                            <div class="avaliable">
                                <span> avaliable</span>
                                <span><a data-bs-toggle="tooltip" data-bs-placement="top" data-bs-html="true" title='
                                    <div class="tooltip-body">
                                      <div class="row">
                                        <h5 class="col-12">Booking for 7 nights</h5>
                                        <h6 class="col-12">Rooms</h6>
                                        <p  class="col-12"><span class="float-start">1 x Sea view Double(BB)</span> <span class="float-end">1 x $600 <br> <b>$600</b></sapn></p>
                                            <p  class="col-12"><span class="float-start">1 x Adults</span></p>
                                            <p  class="col-12"><span class="float-start">0 x Free childs (Age From 1 to 5) </span> <span class="float-end">Free</sapn></p>
                                            <p  class="col-12"><span class="float-start">2 x Paid childs (Age From 6 to 11) </span> <span class="float-end">2 x $250 <br> <b>$500</b></sapn></p>
                                      </div>
                                    </div>
                                      '>Cancellation Policy</a></span>
                            </div>
                        </div>
                        <div class="col-xl-2 col-sm-12 col-md-6">
                            <span class="price_info">
                             Cost/Day: {{$Room->double_cost}} $
                            </span>
                        </div>

                        <div class="col-xl-2 col-sm-12 col-md-6 p-0">
                            @if(!session("hasCart"))
                            <button class="btn rooms_button"> <a href="{{url("/safer/room/$Room->id/book/2")}}">Book</a> </button>
                            @else
                            <button class="btn rooms_button"> <a href="{{url("/safer/room/$Room->id/book/2/exchange")}}">Replace Cart</a> </button>
                            @endif
                        </div>


                    </div>
                </div>
                @endif
                @if($Room->triple_cost != null)
                <div class="rooms">

                    <div class="row mx-0 align-items-center text-center">
                        <div class="col-xl-2 col-sm-12 col-md-6">
                            <h6>{{$Room->en_room_type}}  </h6>
                        </div>


                        <div class="col-xl-2 col-sm-12 col-md-6">
                            <h6>Triple </h6>
                        </div>

                        <div class="col-xl-2 col-sm-12 col-md-6">
                            <span class="category">
                                {{$Room->food_bev_type}}
                            </span>
                        </div>
                        <div class="col-xl-2 col-sm-12 col-md-6">
                            <div class="avaliable">
                                <span> avaliable</span>
                                <span><a data-bs-toggle="tooltip" data-bs-html="true" data-bs-placement="top" title='
                                    <div class="tooltip-body">
                                      <div class="row">
                                        <h5 class="col-12">Booking for 7 nights</h5>
                                        <h6 class="col-12">Rooms</h6>
                                        <p  class="col-12"><span class="float-start">1 x Sea view Double(BB)</span> <span class="float-end">1 x $600 <br> <b>$600</b></sapn></p>
                                            <p  class="col-12"><span class="float-start">1 x Adults</span></p>
                                            <p  class="col-12"><span class="float-start">0 x Free childs (Age From 1 to 5) </span> <span class="float-end">Free</sapn></p>
                                            <p  class="col-12"><span class="float-start">2 x Paid childs (Age From 6 to 11) </span> <span class="float-end">2 x $250 <br> <b>$500</b></sapn></p>
                                      </div>
                                    </div>
                                      '>Cancellation Policy</a></span>

                            </div>
                        </div>
                        <div class="col-xl-2 col-sm-12 col-md-6">
                            <span class="price_info">
                             Cost/Day: {{$Room->triple_cost}} $
                            </span>
                        </div>

                        <div class="col-xl-2 col-sm-12 col-md-6 p-0">
                        @if(!session("hasCart"))
                        <button class="btn rooms_button"> <a href="{{url("/safer/room/$Room->id/book/3")}}">Book</a> </button>
                        @else
                        <button class="btn rooms_button"> <a href="{{url("/safer/room/$Room->id/book/3/exchange")}}">Replace Cart</a> </button>
                        @endif
                        </div>


                    </div>
                </div>
                @endif

                @endforeach

            </div>
    </div>

</section>


<!-- rooms section -->
<section class="reviews container">
    <div class="review_heading">
        <h5>
            room review
        </h5>

        <!-- modal -->
        <!-- Button trigger modal -->
        @if (session()->get('SiteUser'))
        <button type="button" class="btn add_comment_button" data-bs-toggle="modal" data-bs-target="#exampleModal">
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
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form action="{{url(" /hotels/review/add")}}" method="POST">
                        @csrf
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">add comment </h5>
                            <input type="hidden" name="hotel_id" value="{{$Hotel->id}}" />
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
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
                                <textarea class="form-control" name="review_text" placeholder="Leave a comment here"
                                    id="floatingTextarea2" style="height: 200px"></textarea>
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
    @foreach ($Hotel->reviews as $rev)
    <div class="review_details">
        <img src="{{asset(" /website_assets/images/tour-details/profile/profile-1.webp")}}" alt="profile picture ">
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
                {{$rev->review_text}}
            </p>
        </div>

    </div>
    @endforeach

    @if(count($Hotel->reviews) > 10)
    <button class="btn comments_button">
        load all comments
    </button>
    @endif
</section>
<!--  ending page  -->
@endsection


@section('adds_js')
<script>
    $(document).ready(function() {

        var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
        var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
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
        $('#rating_stars').children('i').each(function (i) {
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
        var url = "/hotels/" + {{ $Hotel-> id
    }} + "/fetch";
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
        success: function (result) {
            console.log(result);
            $("#rooms_content").html(result);
        },
        error: function (jqXHR, textStatus, error) {
            console.log(textStatus + " - " + jqXHR.responseText);
        }
    });

    }

</script>
@endsection
