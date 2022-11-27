@extends("layout.website.layout",["Company"=>$Company, "title"=>"Safer | All Hotels"])

@section("adds_css")
<meta name="csrf-token" content="{{ csrf_token() }}">
<link rel="stylesheet" href="{{ asset('/website_assets/css/about.css') }}">
<link rel="stylesheet" href="{{ asset('/website_assets/css/tours.css') }}">
<link rel="stylesheet" href="{{ asset('/website_assets/css/hotel.css') }}">
@endsection

@section("bottom-header")
<x-website.header.general title="All Hotels" :breadcrumb="$BreadCrumb" current="All Hotels" />
@endsection
@section("content")
<!-- booking section -->
<section class="booking_hotels_section container">
    <div class="hotel_details">
        <div class="row mx-0 p-0 align-items-center">
            <div class="col-sm-12 col-md-6 col-xl-2 p-s-0 ">
                <h5> destination</h5>

              <div class="choices">
                <i class="fa-solid fa-location-dot"></i>
                <select class="form-select" name="country_id" aria-label="Default select example">
                    @foreach ($Countries as $Country)
                  <option value="{{$Country->id}}">{{$Country->en_country}}</option>
                  @endforeach
                </select>
              </div>
            </div>
            {{-- <div class="col-sm-12 col-md-6 col-xl-3">
                <h5> check in <span>check </span> </h5> --}}
               {{-- <div class="row mx-0">
                <div class="col-6 p-0">
                  <div class="calender">
                    <i class="fa-solid fa-calendar-days"></i>
                    <input type="text" class="start-date form-control" name="from_date" placeholder="ex 2022-12-12">

                  </div>
                </div> --}}

                 {{--<div class="col-6 p-0">
                    <div class="calender">
                        <i class="fa-solid fa-calendar-days"></i>
                        <input type="text" class="end-date form-control" name="end_date" placeholder="ex 2022-12-12">
                    </div>
                </div>
               </div>
            </div> --}}
            <div class="col-sm-12 col-md-6 col-xl-3">
                <h5> check in <span>check </span> </h5>
                <div class="datepicker calender">
                  <i class="fa-solid fa-calendar-days"></i>
                  <input type="text" id="demo" class="demo" name="datefilter" value="" />
                </div>
            </div>
            <div class="col-sm-12 col-md-6 col-xl-2">
                <h5> nights</h5>
                <select class="form-select" name="nights" aria-label="Default select example">
                    <option selected>1</option>
                    <option value="1">2 </option>
                    <option value="2">3</option>
                    <option value="3">4</option>
                    <option value="4">4</option>
                    <option value="5">5</option>
                    <option value="6">6</option>
                    <option value="7">7</option>
                    <option value="8">8</option>
                    <option value="9">9</option>
                    <option value="10">10</option>
                  </select>
            </div>
            <div class="col-sm-12 col-md-6 col-xl-2">
                <h5> adults</h5>
                <select class="form-select" name="adults" aria-label="Default select example">
                    <option selected>1</option>
                    <option value="1">2 </option>
                    <option value="2">3</option>
                    <option value="3">4</option>
                    <option value="4">4</option>
                    <option value="5">5</option>
                    <option value="6">6</option>
                    <option value="7">7</option>
                    <option value="8">8</option>
                    <option value="9">9</option>
                    <option value="10">10</option>
                  </select>
            </div>
            <div class="col-sm-12 col-md-6 col-xl-2">
                <h5> childs</h5>
                <select class="form-select" name="childs" aria-label="Default select example">
                    <option selected>1</option>
                    <option value="1">2</option>
                    <option value="2">3</option>
                    <option value="3">4</option>
                    <option value="4">4</option>
                    <option value="5">5</option>
                    <option value="6">6</option>
                    <option value="7">7</option>
                    <option value="8">8</option>
                    <option value="9">9</option>
                    <option value="10">10</option>
                  </select>
            </div>
            <div class="col-sm-12 col-md-6 col-xl-1 p-0">
                <div class="main">
                    {{-- <div class="">
                        <a href="#">
                          <i class="fa-solid fa-circle-plus"></i>
                            Add room
                        </a>
                    </div> --}}
                    <button class="btn">
                        <a onclick="search_hotels()"> search</a>
                    </button>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="tours container mt-4">
<div class="row mx-0">
    <div class="  col-sm-0 col-xl-3">
      <button class="btn filtered_button" onclick="openFilter()" id="filterButton">
        <i class="fa-solid fa-sliders"></i>   search tours
      </button>
        <div class="search_tours" id="filtered-menu">
            <!-- <h6> search tours </h6> -->
            <div class="filter_labels" id="filtered-menu">
                <h6> hotels</h6>
                @foreach ($Hotels as $Hotel)
                <div class="form-check">
                    <input class="form-check-input hotel_id" type="checkbox" data-id="{{$Hotel->id}}" value="" id="defaultCheck1">
                    <label class="form-check-label" for="defaultCheck1">
                      {{$Hotel->hotel_enname}}
                    </label>
                  </div>
                @endforeach
                <input type="hidden" name="hotel_ids" />


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
                      <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseTwo" aria-expanded="false" aria-controls="flush-collapseTwo">
                       city
                      </button>
                    </h2>
                    <div id="flush-collapseTwo" class="accordion-collapse collapse" aria-labelledby="flush-headingTwo" data-bs-parent="#accordionFlushExample">
                      <div class="accordion-body">
                        @foreach ($Cities as $City)
                        <div class="form-check">
                            <input class="form-check-input hotel_cities_id" data-id="{{$City->id}}" type="checkbox" value="" id="defaultCheck4" >
                            <label class="form-check-label" for="defaultCheck4">
                            {{$City->en_city}}
                            </label>
                          </div>
                        @endforeach
                        <input type="hidden" name="hotel_cities_ids" />

                      </div>
                     </div>
                  </div>
                  <div class="accordion-item">
                    <h2 class="accordion-header" id="flush-headingThree">
                      <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseThree" aria-expanded="false" aria-controls="flush-collapseThree">
                       rating
                      </button>
                    </h2>
                    <div id="flush-collapseThree" class="accordion-collapse collapse" aria-labelledby="flush-headingThree" data-bs-parent="#accordionFlushExample">
                      <div class="accordion-body">
                        <div class="form-check">
                          <input class="form-check-input rate_val" type="checkbox" value="" data-val="5" id="defaultCheck12" >
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
                          <input class="form-check-input rate_val" type="checkbox" value="" data-val="4" id="defaultCheck13" >
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
                          <input class="form-check-input rate_val" type="checkbox" value="" data-val="3" id="defaultCheck14" >
                          <label class="form-check-label" for="defaultCheck14">
                            <div class="rating">
                              <i class="fa-solid fa-star"></i>
                              <i class="fa-solid fa-star"></i>
                              <i class="fa-solid fa-star"></i>
                          </div>
                          </label>
                        </div>
                        <div class="form-check">
                          <input class="form-check-input rate_val" type="checkbox" value="" data-val="2" id="defaultCheck15" >
                          <label class="form-check-label" for="defaultCheck15">
                            <div class="rating">
                              <i class="fa-solid fa-star"></i>
                              <i class="fa-solid fa-star"></i>


                          </div>
                          </label>
                        </div>
                        <div class="form-check">
                          <input class="form-check-input rate_val" type="checkbox" value="" data-val="1" id="defaultCheck16" >
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

    <div class="col-sm-12 col-xl-9" id="hotels_content">
      <div class="filtered_hotels">
        <div class="filters">
          <span> {{$Count}} Available hotel rooms</span>
          <div class="left_filter">
            <ul class="nav nav-pills " id="pills-tab" role="tablist">
              <li class="nav-item" role="presentation">
                <button class="nav-link sort_by active" data-val="rec" id="pills-home-tab" data-bs-toggle="pill" data-bs-target="#pills-home" type="button" role="tab" aria-controls="pills-home" aria-selected="true">Recommended </button>
              </li>
              <li class="nav-item" role="presentation">
                <button class="nav-link sort_by" data-val="price" id="pills-profile-tab" data-bs-toggle="pill" data-bs-target="#pills-profile" type="button" role="tab" aria-controls="pills-profile" aria-selected="false"> by price</button>
              </li>

              <li class="nav-item" role="presentation">
                <button class="nav-link sort_by" data-val="alpha" id="pills-alpha-tab" data-bs-toggle="pill" data-bs-target="#pills-alpha" type="button" role="tab" aria-controls="pills-alpha" aria-selected="false"> alphabitic</button>
              </li>
              <input type="hidden" name="sort_by" />
            </ul>
            {{-- <div class="dropdown">
              <button class="btn dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
               alphabitic
              </button>
              <ul class="dropdown-menu">
                <li><a class="dropdown-item" href="#">A</a></li>
                <li><a class="dropdown-item" href="#">B</a></li>
                <li><a class="dropdown-item" href="#">C</a></li>
              </ul>
            </div> --}}
            {{-- <div class="dropdown">
              <button class="btn  dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
              EUR
              </button>
              <ul class="dropdown-menu">
                <li><a class="dropdown-item" href="#">EUR</a></li>
                <li><a class="dropdown-item" href="#">LE</a></li>
                <li><a class="dropdown-item" href="#">USA</a></li>
              </ul>
            </div> --}}
          </div>
        </div>
      </div>
      <div class="row mx-0">
        <div class="col-sm-12 p-0">

            <div class="tab-content" id="pills-tabContent">
                <div class="tab-pane fade show active w-100" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab" tabindex="0">

                    @foreach ($HotelsRecommended as $HRec)
                    <div class="card-content">
                        <div class=" card setted_tour_cards ">
                            <div class="card_image">
                                <div class="image_overlay">

                          <img src=" {{ asset('uploads/hotels') }}/{{$HRec->hotel_banner}}" alt=" blogimage">
                                </div>
                            </div>
                          <div class="card-body  setted_info">
                            <div class="card_info">
                                @php
                                $datetime1 = new DateTime($HRec->from_date);
                                $datetime2 = new DateTime($HRec->end_date);
                                $interval = $datetime1->diff($datetime2);
                                $days = $interval->format('%a');
                                @endphp
                                <h6> <a href="{{url('/hotels/'.$HRec->hotel_id)}}" class="stretched-link">{{$HRec->hotel_enname}} – {{$HRec->hotel_stars}} Stars</a></h6>
                                <span>
                                  <i class="fa-regular fa-heart"></i>
                                </span>
                            </div>
                            <span>     <i class="fa-solid fa-location-dot"></i>{{$HRec->en_country}}  <span>|</span> {{$HRec->en_city}}</span>
                            <p>
                              {{$HRec->hotel_enoverview}}
                            </p>
                            <div class="price">
                              <div class="rating">
                                @for ($i = 0; $i < $HRec->hotel_stars; $i++)
                                    <i class="fa-solid fa-star"></i>
                                @endfor
                                @for ($i = 5; $i > $HRec->hotel_stars; $i--)
                                    <i class="fa-regular fa-star"></i>
                                @endfor

                                  <span> ({{$HRec->totalreviews}} review) </span>
                              </div>
                              <span class="hotels_price"><span style="color:#5f5858;font-size: 16px;font-weight: 300">start with</span> $ {{$HRec->single_cost}}</span>
                            </div>
                          </div>
                      </div>
                    </div>
                    @endforeach

                </div>
                <div class="tab-pane fade w-100" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab" tabindex="0">

                    @foreach ($HotelsByPrice as $HPrice)
                    <div class="card-content">
                        <div class=" card setted_tour_cards ">
                            <div class="card_image">
                                <div class="image_overlay">

                          <img src="{{ asset('uploads/hotels') }}/{{$HPrice->hotel_banner}}" alt=" blogimage">
                                </div>
                            </div>
                          <div class="card-body  setted_info">
                            <div class="card_info">
                                @php
                                $datetime1 = new DateTime($HRec->from_date);
                                $datetime2 = new DateTime($HRec->end_date);
                                $interval = $datetime1->diff($datetime2);
                                $days = $interval->format('%a');
                                @endphp
                                <h6> <a href="./hotel_details.html" class="stretched-link">{{$HPrice->hotel_enname}} – {{$HPrice->hotel_stars}} Stars</a></h6>
                                <span>
                                  <i class="fa-regular fa-heart"></i>
                                </span>
                            </div>
                            <span>     <i class="fa-solid fa-location-dot"></i>  {{$HPrice->en_country}}  <span>|</span> {{$HPrice->en_city}}</span>
                            <p>
                              {{$HPrice->hotel_enoverview}}
                            </p>
                            <div class="price">
                              <div class="rating">
                                @for ($i = 0; $i < $HPrice->hotel_stars; $i++)
                                    <i class="fa-solid fa-star"></i>
                                @endfor
                                @for ($i = 5; $i > $HPrice->hotel_stars; $i--)
                                    <i class="fa-regular fa-star"></i>
                                @endfor

                                  <span> ({{$HPrice->totalreviews}} review) </span>
                              </div>
                              <span class="hotels_price"><span style="color:#5f5858;font-size: 16px;font-weight: 300">start with</span> $ {{$HPrice->single_cost}}</span>
                              {{-- <span class="hotels_price"> $ {{$HPrice->cost}}</span> --}}
                            </div>
                          </div>
                      </div>
                    </div>
                    @endforeach

                </div>
                <div class="tab-pane fade w-100" id="pills-alpha" role="tabpanel" aria-labelledby="pills-alpha-tab" tabindex="0">

                    @foreach ($HotelsByAlpha as $HAlpha)
                    <div class="card-content">
                        <div class=" card setted_tour_cards ">
                            <div class="card_image">
                                <div class="image_overlay">

                          <img src="{{ asset('uploads/hotels') }}/{{$HAlpha->hotel_banner}}" alt=" blogimage">
                                </div>
                            </div>
                          <div class="card-body  setted_info">
                            <div class="card_info">
                                @php
                                $datetime1 = new DateTime($HAlpha->from_date);
                                $datetime2 = new DateTime($HAlpha->end_date);
                                $interval = $datetime1->diff($datetime2);
                                $days = $interval->format('%a');
                                @endphp
                                <h6>   <a href="./hotel_details.html" class="stretched-link">{{$HAlpha->hotel_enname}} – {{$HAlpha->hotel_stars}} Stars</a></h6>
                                <span>
                                  <i class="fa-regular fa-heart"></i>
                                </span>
                            </div>
                            <span>     <i class="fa-solid fa-location-dot"></i>  {{$HAlpha->en_country}}  <span>|</span> {{$HAlpha->en_city}}</span>
                            <p>
                              {{$HAlpha->hotel_enoverview}}
                            </p>
                            <div class="price">
                              <div class="rating">
                                @for ($i = 0; $i < $HAlpha->hotel_stars; $i++)
                                    <i class="fa-solid fa-star"></i>
                                @endfor
                                @for ($i = 5; $i > $HAlpha->hotel_stars; $i--)
                                    <i class="fa-regular fa-star"></i>
                                @endfor

                                  <span> ({{$HAlpha->totalreviews}}  review) </span>
                              </div>
                              <span class="hotels_price"><span style="color:#5f5858;font-size: 16px;font-weight: 300">start with</span> $ {{$HAlpha->single_cost}}</span>
                              {{-- <span class="hotels_price"> $ {{$HPrice->cost}}</span> --}}
                            </div>
                          </div>
                      </div>
                    </div>
                    @endforeach

                </div>
              </div>

        </div>
        <nav aria-label="Page navigation page_pagination example">
          <ul class="pagination">
            @for ($i = 0; $i < $Count/ 6; $i++)
            <li class="page-item page-num" data-val="{{$i+1}}"><a class="page-link" href="#">{{$i+1}}</a></li>
            @endfor
            <input type="hidden" name="page_num" />
            <li class="page-item page-inc">
              <a class="page-link" href="#">Next</a>
            </li>
          </ul>
        </nav>
      </div>
    </div>
</div>
</section>


@endsection
@section('adds_js')

<script src="{{asset("/website_assets/js/hotel_filters.js")}}"></script>
@endsection

