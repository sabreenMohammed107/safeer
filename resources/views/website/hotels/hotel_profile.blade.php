@extends("layout.website.layout",["Company"=>$Company, "title"=>"Safeer | {$RoomCost->hotelRooms->hotel->hotel_enname} Room Profile"])

@section("adds_css")
<meta name="csrf-token" content="{{ csrf_token() }}">
<link rel="stylesheet" href="{{ asset('/website_assets/css/about.css') }}">
<link rel="stylesheet" href="{{ asset('/website_assets/css/tour-details.css') }}">
<link rel="stylesheet" href="{{ asset('/website_assets/css/hotel-details.css') }}">
@endsection

@section("bottom-header")
<x-website.header.general :title="$RoomCost->hotelRooms->hotel->hotel_enname .' - '. $RoomCost->hotelRooms->room->en_room_type" :breadcrumb="$BreadCrumb" :current="$RoomCost->hotelRooms->hotel->hotel_enname" />
@endsection
@section("content")

    <!-- tour details -->
    <section class="container details_section">
        <div class="row mx-0">
            @if(count($HotelTourGallery))

                <div class="col-sm-12 col-xl-6">
                    <div class="row mx-0 left_side_imgages">
                        <div class="col-12">

                            <img src="{{ asset("/website_assets/images/tour-details/") }}{{ $HotelTourGallery[0]->img ?? " "}}" class="w-100 mb-3" alt=" tour hotel image ">

                        </div>
                        @for ($i = 1; $i < 4; $i++)
                        <div class="col-4">
                            <img src="{{ asset("/website_assets/images/tour-details/") }}{{$HotelTourGallery[$i]->img ?? " "}}"  class="w-100" alt=" tour hotel image ">

                        </div>
                    @endfor
                </div>
                </div>
            @endif
            </div>
            @if (count($HotelTourGallery))
                <div class="col-sm-12 col-xl-6">
            @else
                <div class="col-sm-12 col-xl-12">
            @endif
                <div class="tour_info">
                        <div class="titles">
                            <h6> {{$RoomCost->hotelRooms->hotel->hotel_enname}}</h6>
                            <span> {{$RoomCost->hotelRooms->hotel->city->country->en_country}}  <span>|</span> {{$RoomCost->hotelRooms->hotel->city->en_city}} </span>
                            <div class="rating">
                                @for ($i = 0; $i < $RoomCost->hotelRooms->hotel->hotel_stars; $i++)
                                <i class="fa-solid fa-star"></i>
                                @endfor
                                @for ($i = 5; $i > $RoomCost->hotelRooms->hotel->hotel_stars; $i--)
                                    <i class="fa-regular fa-star"></i>
                                @endfor

                                <span> ( {{count($RoomCost->hotelRooms->hotel->reviews)}} review) </span>
                            </div>
                            <div class="sharing_icons">
                              <i class="fa-solid fa-share-nodes"></i>
                              <i class="fa-regular fa-heart"></i>
                            </div>
                        </div>

                        <h6> important note </h6>
                        <p>
                            {{$RoomCost->hotelRooms->hotel->hotel_enoverview}}
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
        @if (count($RoomCost->hotelRooms->hotel->features))
            @foreach ($FeaturesCategories as $k => $category)
          <div class="accordion" id="accordionPanelsStayOpenExample{{$k}}">
            <div class="accordion-item">
                <h2 class="accordion-header" id="panelsStayOpen-headingTwo">
                  <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseTwo{{$k}}" aria-expanded="false" aria-controls="panelsStayOpen-collapseTwo{{$k}}">
                   {{$category->en_category}}
                  </button>
                </h2>
                <div id="panelsStayOpen-collapseTwo{{$k}}" class="accordion-collapse collapse show" aria-labelledby="panelsStayOpen-headingTwo">
                  <div class="accordion-body">
                      <div class="included_info">
                        @foreach ($RoomCost->hotelRooms->hotel->features as $feature)
                            @if ($feature->feature_category_id == $category->id)
                            <div class="include-1">
                                <img src="{{asset("/website_assets/images/tour-details/included/$feature->icon")}}" alt="">
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
            @if ($RoomCost->hotelRooms->hotel->hotel_video)
            <div class="images image-2">
                <!-- <img src="./images/tour-details/video.webp" class="w-100" alt="image mask"> -->

                <button type="button" class="btn js-modal-btn "data-video-url="{{$RoomCost->hotelRooms->hotel->hotel_video}}" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                  <img src="{{asset("/website_assets/images/homePage/play_button.webp")}}" alt=" video play button">
                </button>
              </div>
            @endif
              @if ($RoomCost->hotelRooms->hotel->google_map)
              <div class="map">
                <iframe src="{{$RoomCost->hotelRooms->hotel->google_map}}" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
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
                    <div class="row mx-0 p-0 align-items-center">
                        <input type="hidden" value="{{$RoomCost->hotelRooms->hotel->id}}" name="hotel_id"/>
                        <div class="col-sm-12 col-md-6 col-xl-3 p-0 ">
                            <h5> check in <span>check </span> </h5>
                           <div class="row mx-0">
                            <div class="col-6 p-0">
                              <div class="calender">
                                <i class="fa-solid fa-calendar-days"></i>
                                <input type="text" class="start-date form-control" placeholder="ex 12-12-2022" name="from_date">

                              </div>
                            </div>
                            <div class="col-6 p-0">
                              <input type="text" class="end-date form-control" placeholder="ex 12-12-2022" name="end_date">
                            </div>
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
                                <option value="2"> 3</option>
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
                                <option value="1">2 </option>
                                <option value="2"> 3</option>
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
                                <div class="">
                                    <a href="#">
                                      <i class="fa-solid fa-circle-plus"></i>
                                        Add room
                                    </a>
                                </div>
                                <button class="btn">
                                    <a onclick="fetch_hotel_rooms()"> search</a>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
        <div class="rooms_avaliable container">
            <h5> avaliable rooms </h5>
            <div id="rooms_content">
                @foreach ($RoomCosts as $Room)
                    <div class="rooms">
                        <div class="row mx-0 align-items-center text-center">
                            <div class="col-xl-3 col-sm-12 col-md-6">
                                <h6>{{$Room->en_room_type}}  </h6>
                            </div>
                            <div class="col-xl-2 col-sm-12 col-md-6">
                                <span class="category">
                                    {{$Room->food_bev_type}}
                                </span>
                            </div>
                            <div class="col-xl-3 col-sm-12 col-md-6">
                                <div class="avaliable">
                                    <span> avaliable</span>
                                    <span><a href="#">Cancellation Policy</a></span>
                                </div>
                            </div>
                            <div class="col-xl-3 col-sm-12 col-md-6">
                                <span class="price_info">
                                    {{$Room->cost}} $
                                </span>
                            </div>

                            <div class="col-xl-1 col-sm-12 col-md-6 p-0">
                            <button class="btn rooms_button"> <a href="./booking-hotel.html">book</a> </button>
                            </div>


                        </div>
                    </div>
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
        <button type="button" class="btn add_comment_button" data-bs-toggle="modal" data-bs-target="#exampleModal">
          <i class="fa-solid fa-plus"></i>  add comment
        </button>

        <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
                <form action="{{url("/hotels/review/add")}}" method="POST">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">add comment </h5>
                        <input type="hidden" name="hotel_id" value="{{$RoomCost->hotelRooms->hotel->id}}" />
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
                          <textarea class="form-control" name="review_text" placeholder="Leave a comment here" id="floatingTextarea2" style="height: 200px"></textarea>
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
      @foreach ($RoomCost->hotelRooms->hotel->reviews as $rev)
      <div class="review_details">
        <img src="{{asset("/website_assets/images/tour-details/profile/profile-1.webp")}}" alt="profile picture ">
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


      <button class="btn comments_button">
        load all comments
      </button>
    </section>
    <!--  ending page  -->
@endsection
@section('adds_js')
    <script>

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
                if(index < value){
                    $(".rate_"+(index+1)).removeClass("fa-regular");
                    $(".rate_"+(index+1)).addClass("fa-solid");
                }else{
                    $(".rate_"+(index+1)).removeClass("fa-solid");
                    $(".rate_"+(index+1)).addClass("fa-regular");
                }
                $("input[name=rate_val]").val(value);
            }
        }
        function fetch_hotel_rooms() {
        var url = "/hotels/"+ {{$RoomCost->hotelRooms->hotel->id}} + "/fetch";
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
            success: function(result){
                console.log(result);
                $("#rooms_content").html(result);
            },
            error: function(jqXHR, textStatus, error){
                console.log(textStatus + " - " + jqXHR.responseText);
            }
        });

    }

    </script>
@endsection
