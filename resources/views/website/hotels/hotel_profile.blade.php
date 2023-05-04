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
@if (LaravelLocalization::getCurrentLocale() === 'en')

<x-website.header.general :title="$Hotel->hotel_enname " :breadcrumb="$BreadCrumb"
    :current="$Hotel->hotel_enname" />
@else
<x-website.header.general :title="$Hotel->hotel_arname " :breadcrumb="$BreadCrumb"
    :current="$Hotel->hotel_arname" />
@endif

@endsection
@section("content")
{{-- google reviews --}}
<?php
// $cid =0x424a7b3906d2a73e;
$cid=$Hotel->google_place;
//CID of a place can be genrated from https://pleper.com/index.php?do=tools&sdo=cid_converter
//execute curl
$url = 'https://maps.googleapis.com/maps/api/place/details/json?cid='.$cid.'&key=AIzaSyB9BVYo2lK6DClKsR5crlGhu-31lYgfK9U';
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_HEADER, 1);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HEADER, false);
$data = curl_exec($ch);
curl_close($ch);

$arrayData = json_decode($data, true); // json object to array conversion
if(isset($arrayData['result'])){
    $result = $arrayData['result'];

// $total_users    = $result['user_ratings_total']; // display total number of users who rated
 $overall_rating = $result['rating']; // display total average rating
 $reviews = $result['reviews'];   //holds information like author_name, author_url, language, profile_photo_url, rating, relative_time_description, text, time

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
{{-- @foreach($reviews as $review)
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
                    <h6> @if (LaravelLocalization::getCurrentLocale() === 'en')
                        {{$Hotel->hotel_enname}}

                        @else
                        {{$Hotel->hotel_arname}}
                        @endif </h6>
                    <span>  @if (LaravelLocalization::getCurrentLocale() === 'en')
                        {{$Hotel->city->country->en_country}}

                        @else
                        {{$Hotel->city->country->ar_country}}
                        @endif
                         <span>|</span>  @if (LaravelLocalization::getCurrentLocale() === 'en')

                         {{$Hotel->city->en_city}}
                        @else
                        {{$Hotel->city->ar_city}}
                        @endif
                         </span>
                    <div class="rating">
                        @for ($i = 0; $i < $Hotel->hotel_stars; $i++)
                            <i class="fa-solid fa-star"></i>
                            @endfor
                            @for ($i = 5; $i > $Hotel->hotel_stars; $i--)
                            <i class="fa-regular fa-star"></i>
                            @endfor

                            <span> ( {{count($Hotel->reviews)}} {{ __('links.review') }}) </span>
                    </div>
                    <div class="sharing_icons"
                    @if (LaravelLocalization::getCurrentLocale() === 'ar')

                    style="right:100% !important"

                    @endif >
                        {{-- <i class="fa-solid fa-share-nodes"></i> --}}


                            @if (session()->get('SiteUser'))
                            <a href="{{ LaravelLocalization::localizeUrl('/favourite/' . $Hotel->id) }}"
                                ><i class="fa-regular fa-heart"></i> </a>
                            @else

                            <a href="{{ LaravelLocalization::getLocalizedURL($localVar, route('siteLogin'))}}"
                            ><i class="fa-regular fa-heart"></i></a>
                            @endif

                    </div>
                </div>

                <h6>  @if (LaravelLocalization::getCurrentLocale() === 'en')
                    important note

                    @else
                  ملاحظات مهمة
                    @endif </h6>
                <p>
                    @if (LaravelLocalization::getCurrentLocale() === 'en')

                    {{$Hotel->hotel_enoverview}}
                    @else
                    {{$Hotel->hotel_aroverview}}
                    @endif

                </p>


            </div>
        </div>

    </div>
</section>


<!-- included and not included section -->

<section class="included container">
    <h5>  @if (LaravelLocalization::getCurrentLocale() === 'en')
        hotel facilities

        @else
        مرافق الفندق
        @endif</h5>
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

                            @if (LaravelLocalization::getCurrentLocale() === 'en')

                            {{$category->en_category}}
                            @else
                            {{-- {{$category->ar_category}} --}}
                            @endif
                        </button>
                    </h2>
                    <div id="panelsStayOpen-collapseTwo{{$k}}" class="accordion-collapse collapse show"
                        aria-labelledby="panelsStayOpen-headingTwo">
                        <div class="accordion-body">
                            <div class="included_info">
                                @foreach ($Hotel->features as $feature)
                                @if ($feature->feature_category_id == $category->id)
                                <div class="include-1">
                                    <img width="20" src="{{ asset('uploads/features') }}/{{$feature->icon ?? ' ' }}"
                                    alt="">
                                    <span>
                                        @if (LaravelLocalization::getCurrentLocale() === 'en')
                                        {{$feature->en_feature}}

                                        @else
                                        {{$feature->ar_feature}}
                                        @endif</span>
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
            @if (LaravelLocalization::getCurrentLocale() === 'en')

            No hotel facilities provided
            @else
            لم يتم توفير مرافق الفندق

            @endif

            @endif
        </div>
        <div class="col-sm-12 col-xl-6 ">

            @if ($Hotel->hotel_vedio)
            <div class="images image-2">
                <!-- <img src="./images/tour-details/video.webp" class="w-100" alt="image mask"> -->
                <button type="button" class="btn js-modal-btn " data-video-url="{{$Hotel->hotel_vedio}}"
                    data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                    <img src="{{asset("/website_assets/images/homePage/play_button.webp")}}" style="border-radius: 50%" alt=" video play button">
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
        <h5> @if (LaravelLocalization::getCurrentLocale() === 'en')

               hotel search
            @else
          بحث فى الفندق
            @endif </h5>
        <section class="booking_hotels_section container">
            <div class="hotel_details">
                <div class="row mx-0 p-0">
                    <div class="col-sm-12 col-md-6 col-xl-2 p-s-0 ">
                        <h5>   @if (LaravelLocalization::getCurrentLocale() === 'en')

                            destination
                            @else
                          الوجهة
                            @endif </h5>

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
                                        @endif </option>
                                @endforeach
                            </select>
                        </div>
                    </div>


                    <div class="col-sm-12 col-md-6 col-xl-2 p-s-0 ">
                        <h5> {{ __('links.city') }}</h5>

                        <div class="choices">
                            <i class="fa-solid fa-location-dot"></i>
                            <select class="form-select" id="city_id" name="city_id"
                                            aria-label="Default select example">                                @foreach ($Cities as $city)
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
                        <div class="rooms" style="padding: 0;box-shadow: 0">
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
                                    <label>{{ __('links.child') }}</label>
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
                                                            {{ $i + 1 }}   @if (LaravelLocalization::getCurrentLocale() === 'en')
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
                                    {{ __('links.done') }} </button>
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
            <h5>   @if (LaravelLocalization::getCurrentLocale() === 'en')

                available rooms
                @else
              الغرف المتاحة
                @endif
                @if($HasRoom != 0)
                <span class="text-danger fs-6">
                    @if (LaravelLocalization::getCurrentLocale() === 'en')

                    *You have an existing Room in Your Cart
                    @else
                    * لديك غرفة موجودة في عربة التسوق الخاصة بك

                    @endif
                    </span>
                @endif
            </h5>
            <div id="rooms_content">

                @foreach ($RoomCosts as $Room)


                @if($Room->single_cost != null)
                <div class="rooms">

                    <div class="row mx-0 align-items-center text-center">
                        <div class="col-xl-2 col-sm-12 col-md-6">
                            <h6>  @if (LaravelLocalization::getCurrentLocale() === 'en')

                                {{$Room->en_room_type}}
                                @else
                                {{$Room->ar_room_type}}
                                @endif </h6>
                        </div>

                        <div class="col-xl-2 col-sm-12 col-md-6">
                            <h6>  @if (LaravelLocalization::getCurrentLocale() === 'en')

                                Single
                                @else
                              فردى
                                @endif </h6>
                        </div>



                        <div class="col-xl-2 col-sm-12 col-md-6">
                            <span class="category">
                                {{$Room->food_bev_type}}
                            </span>
                        </div>
                        <div class="col-xl-2 col-sm-12 col-md-6">
                            <div class="avaliable">
                                <a
                                                                href="{{ url('/terms') }}" target="_blank" >{{ __('links.term_condation') }}</a>
                                {{-- <span>   @if (LaravelLocalization::getCurrentLocale() === 'en')

                                    avaliable
                                    @else
                                  متاح
                                    @endif</span>

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
                                      '>  @if (LaravelLocalization::getCurrentLocale() === 'en')
                                      Cancellation Policy

                                      @else
                                    سياسة الإلغاء
                                      @endif</a></span> --}}
                            </div>
                        </div>
                        <div class="col-xl-2 col-sm-12 col-md-6">
                            <span class="price_info">
                                {{ __('links.costDay') }} {{$Room->single_cost}} $
                            </span>
                        </div>

                        <div class="col-xl-2 col-sm-12 col-md-6 p-0">
                            @if(!$HasRoom)
                            <button class="btn rooms_button"> <a href="{{url("/safer/room/$Room->id/book/1")}}">{{ __('links.book') }}</a> </button>
                            @else
                            <button class="btn rooms_button"><a href="{{url("/safer/room/$Room->id/book/1/exchange")}}">{{ __('links.replaceCart') }}</a> </button>
                            @endif
                        </div>


                    </div>
                </div>
                @endif

                @if($Room->double_cost != null)
                <div class="rooms">

                    <div class="row mx-0 align-items-center text-center">
                        <div class="col-xl-2 col-sm-12 col-md-6">
                            <h6>
                                @if (LaravelLocalization::getCurrentLocale() === 'en')

                                {{$Room->en_room_type}}
                                              @else
                                              {{$Room->ar_room_type}}
                                              @endif  </h6>
                        </div>



                        <div class="col-xl-2 col-sm-12 col-md-6">
                            <h6>
                                @if (LaravelLocalization::getCurrentLocale() === 'en')

                                Double
                                              @else
                                            زوجي
                                              @endif </h6>
                        </div>

                        <div class="col-xl-2 col-sm-12 col-md-6">
                            <span class="category">
                                {{$Room->food_bev_type}}
                            </span>
                        </div>
                        <div class="col-xl-2 col-sm-12 col-md-6">
                            <div class="avaliable">
                                <a
                                href="{{ url('/terms') }}" target="_blank" >{{ __('links.term_condation') }}</a>
                                {{-- <span>
                                    @if (LaravelLocalization::getCurrentLocale() === 'en')

                                    avaliable
                                                  @else
                                                متاح
                                                  @endif</span>
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
                                      '>
                                      @if (LaravelLocalization::getCurrentLocale() === 'en')

                                      Cancellation Policy
                                                    @else
                                                  سياسة الإلغاء
                                                    @endif</a></span> --}}
                            </div>
                        </div>
                        <div class="col-xl-2 col-sm-12 col-md-6">
                            <span class="price_info">
                                {{ __('links.costDay') }} {{$Room->double_cost}} $
                            </span>
                        </div>

                        <div class="col-xl-2 col-sm-12 col-md-6 p-0">
                            @if(!$HasRoom)
                            <button class="btn rooms_button"> <a href="{{url("/safer/room/$Room->id/book/2")}}">{{ __('links.book') }}</a> </button>
                            @else
                            <button class="btn rooms_button"> <a href="{{url("/safer/room/$Room->id/book/2/exchange")}}">{{ __('links.replaceCart') }}</a> </button>
                            @endif
                        </div>


                    </div>
                </div>
                @endif
                @if($Room->triple_cost != null)
                <div class="rooms">

                    <div class="row mx-0 align-items-center text-center">
                        <div class="col-xl-2 col-sm-12 col-md-6">
                            <h6>
                                @if (LaravelLocalization::getCurrentLocale() === 'en')

                                {{$Room->en_room_type}}
                                              @else
                                              {{$Room->ar_room_type}}
                                              @endif  </h6>
                        </div>


                        <div class="col-xl-2 col-sm-12 col-md-6">
                            <h6>
                                @if (LaravelLocalization::getCurrentLocale() === 'en')

                                Triple
                                              @else
                                            ثلاثية
                                              @endif </h6>
                        </div>

                        <div class="col-xl-2 col-sm-12 col-md-6">
                            <span class="category">
                                {{$Room->food_bev_type}}
                            </span>
                        </div>
                        <div class="col-xl-2 col-sm-12 col-md-6">
                            <div class="avaliable">
                                <a
                                href="{{ url('/terms') }}" target="_blank" >{{ __('links.term_condation') }}</a>
                                {{-- <span>
                                    @if (LaravelLocalization::getCurrentLocale() === 'en')

                                    avaliable
                                                  @else
                                                متاحة
                                                  @endif</span>
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
                                      '>
                                      @if (LaravelLocalization::getCurrentLocale() === 'en')

                                      Cancellation Policy
                                                    @else
                                                  سياسة الإلغاء
                                                    @endif</a></span> --}}

                            </div>
                        </div>
                        <div class="col-xl-2 col-sm-12 col-md-6">
                            <span class="price_info">
                                {{ __('links.costDay') }}{{$Room->triple_cost}} $
                            </span>
                        </div>

                        <div class="col-xl-2 col-sm-12 col-md-6 p-0">
                        @if(!$HasRoom)
                        <button class="btn rooms_button"> <a href="{{url("/safer/room/$Room->id/book/3")}}">{{ __('links.book') }}</a> </button>
                        @else
                        <button class="btn rooms_button"> <a href="{{url("/safer/room/$Room->id/book/3/exchange")}}">{{ __('links.replaceCart') }}</a> </button>
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

  @if (LaravelLocalization::getCurrentLocale() === 'en')

  room review
  @else
تعليقات الغرف
  @endif
            @isset($arrayData['result'])
        <div><span style="margin-right:5px" class="Aq14fc" aria-hidden="true">


        </span>
        <span class="z3HNkc" aria-label="Rated 4.4 out of 5," role="img">
        <span style="width:62px"></span></span>
        <a class="hqzQac" style="white-space:nowrap;font-size:14px;margin-left:5px" href="{{$Hotel->google_reviews}}" target="_blank"
>
         {{number_format((float)$result['rating'], 1, '.', '') }}
         @if (LaravelLocalization::getCurrentLocale() === 'en')

         Google reviews
                       @else
                     تعليقات جوجل
                       @endif </a>
        </div>
        @endisset
        </h5>
        <!-- modal -->
        <!-- Button trigger modal -->
        @if (session()->get('SiteUser'))
        <button type="button" class="btn add_comment_button" data-bs-toggle="modal" data-bs-target="#exampleModal">
            <i class="fa-solid fa-plus"></i> {{ __('links.addComment') }}
        </button>
        @else

        <a href="{{ route('siteLogin') }}" class="btn add_comment_button"> <i class="fa-solid fa-plus"></i>  {{ __('links.addComment') }}</a>

        @endif
        {{-- <button type="button" class="btn add_comment_button" data-bs-toggle="modal" data-bs-target="#exampleModal">
            <i class="fa-solid fa-plus"></i> add comment
        </button> --}}

        <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="alert alert-danger" style="display:none"></div>
                    <form action="{{ LaravelLocalization::localizeUrl("/hotels/review/add") }}" method="POST">
                        @csrf
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel"> {{ __('links.addComment') }}</h5>
                            <input type="hidden" id="hotel_id" name="hotel_id" value="{{$Hotel->id}}" />
                            <button type="button"  @if (LaravelLocalization::getCurrentLocale() === 'ar') style="margin: unset;" @endif class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
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
                                <textarea class="form-control" id="review_text" name="review_text" placeholder=" @if (LaravelLocalization::getCurrentLocale() === 'en')

                                Leave a comment here
                                @else
                              اترك تعليقك هنا
                                @endif"
                                   style="height: 100px"></textarea>
                            </div>
                            <div class="form-floating my-1">
                                <div class="captcha">
                                    <span>{!! captcha_img() !!}</span>
                                    <button type="button" class="btn btn-danger" class="reload" id="reload">
                                        &#x21bb;
                                    </button>
                                </div>
                            </div>
                            <div class="form-floating my-1">
                                <input id="captcha" type="text" class="form-control" required placeholder="{{ __('links.enterCapcha') }}" name="captcha">
                                @if ($errors->has('captcha'))
                                <div class="error">
                                    {{ $errors->first('captcha') }}
                                </div>
                            @endif
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-primary comment_pop_btn" id="formSubmit" >{{ __('links.addComment') }} </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@isset($arrayData['result'])
@foreach($reviews as $key => $review)
<div class="review_details">
     <img src="{{$review['profile_photo_url']}}" alt="profile picture ">
     <div class="review_info">
         <div class="heading">
             <h6>{{$review['author_name']}}
                          <p>  {{$review['relative_time_description']}}
</p>
<img src={{asset("/website_assets/images/google-icon-isolated_68185-565.webp")}} width='30' >
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
             {{$review['text']}}
         </p>
     </div>

 </div>
@endforeach
@endisset


    @foreach ($Hotel->reviews as $rev)
    <div class="review_details">
        <img src="{{asset("/website_assets/images/llogo.JPG")}}" alt="profile picture ">
        <div class="review_info">
            <div class="heading">

                        <h6> {{ $rev->user->name ?? ''}} </h6>
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
        @if (LaravelLocalization::getCurrentLocale() === 'en')

        load all comments
                @else

تحميل كافة التعليقات
                @endif
    </button>
    @endif
</section>
<!--  ending page  -->
@endsection


@section('adds_js')
<script>
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
        $('#formSubmit').click(function(e){
                e.preventDefault();
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                    }
                });
                $.ajax({
                    url: "{{ url('/hotels/review/add') }}",
                    method: 'get',
                    data: {

        review_text: $('#review_text').val(),
        rate_val: $('#rate_val').val(),
        hotel_id: $('#hotel_id').val(),
        captcha: $('#captcha').val(),
                    },
                    success: function(result){
                        if(result.errors)
                        {


                            $('.alert-danger').html('');

                            $.each(result.errors, function(key, value){
                                $('.alert-danger').show();
                                $('.alert-danger').append('<li>'+value+'</li>');
                            });
                        }
                        else
                        {

                            $('.alert-danger').hide();
                            $('#exampleModal').modal('hide');
                        }
                    }
                });
            });







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
