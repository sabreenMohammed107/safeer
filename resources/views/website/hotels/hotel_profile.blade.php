@extends("layout.website.layout",["Company"=>$Company, "title"=>"Safeer | {$Hotel->hotel_enname} Profile"])

@section("adds_css")
<link rel="stylesheet" href="{{ asset('/website_assets/css/about.css') }}">
<link rel="stylesheet" href="{{ asset('/website_assets/css/tour-details.css') }}">
<link rel="stylesheet" href="{{ asset('/website_assets/css/hotel-details.css') }}">
@endsection

@section("bottom-header")
<x-website.header.general :title="$Hotel->hotel_enname" :breadcrumb="$BreadCrumb" :current="$Hotel->hotel_enname" />
@endsection
@section("content")

    <!-- tour details -->
    <section class="container details_section">
        <div class="row mx-0">
            <div class="col-sm-12 col-xl-6">
                <div class="row mx-0 left_side_imgages">
                    <div class="col-12">

                        <img src="{{ asset("/website_assets/images/tour-details/{$HotelTourGallery[0]->img}") }}" class="w-100 mb-3" alt=" tour hotel image ">

                    </div>
                    @for ($i = 1; $i < 4; $i++)
                    <div class="col-4">
                        <img src="{{ asset("/website_assets/images/tour-details/{$HotelTourGallery[$i]->img}") }}"  class="w-100" alt=" tour hotel image ">

                    </div>
                    @endfor
                </div>
            </div>
            <div class="col-sm-12 col-xl-6">
                <div class="tour_info">
                        <div class="titles">
                            <h6> Half Day Bosphorus Tour</h6>
                            <span> turkey  <span>|</span> istanbul </span>
                            <div class="rating">

                              <i class="fa-solid fa-star"></i>
                              <i class="fa-solid fa-star"></i>
                              <i class="fa-solid fa-star"></i>
                              <i class="fa-solid fa-star"></i>
                              <i class="fa-solid fa-star"></i>

                                <span> ( 5 review) </span>
                            </div>
                            <div class="sharing_icons">
                              <i class="fa-solid fa-share-nodes"></i>
                              <i class="fa-regular fa-heart"></i>
                            </div>
                        </div>

                        <h6> important note </h6>
                        <p>
                            Located centrally in Sisli District the 5-star Lausos Palace is 500 metres from the chic Nisantasi area with its popular shops cafés and bars. It offers guestrooms with modern amenities and free Wi-Fi throughout the premises. Free on-site parking is available and guests can benefit from the concierge desk.
                            <br> <br>
                            Offering city views the air-conditioned rooms at Palace Lausos feature a minibar flat-screen TV with satellite and cable channels and a seating area. A laptop sized safety box is standard in each unit. Complimentary tea and coffee making facilities are provided.
                            <br> <br>
                            The hotel’s restaurant serves a buffet breakfast every morning. Situated in a lively neigbourhood you can also venture out and sense the local atmosphere.
                            <br><br>
                            You can benefit from the Lausos Palace’s laundry and ironing services. The hotel also has a tour desk that assists with car hire and provides information on local attractions.
                        </p>


                </div>
            </div>

        </div>
    </section>


    <!-- included and not included section -->

    <section class="included container">
        <h5> hotel facilities</h5>
      <div class="row mx-0">
        <div class="col-sm-12 col-xl-6">
          <div class="accordion" id="accordionPanelsStayOpenExample">
            <div class="accordion-item">
              <h2 class="accordion-header" id="panelsStayOpen-headingTwo">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseTwo" aria-expanded="false" aria-controls="panelsStayOpen-collapseTwo">
                 general
                </button>
              </h2>
              <div id="panelsStayOpen-collapseTwo" class="accordion-collapse collapse show" aria-labelledby="panelsStayOpen-headingTwo">
                <div class="accordion-body">
                    <div class="included_info">
                      <div class="include-1">
                        <img src="images/tour-details/included/24 hour cutomer service.webp" alt="24 hour customer service">
                        <span> 24 hour cutomer service</span>
                      </div>
                      <div class="include-1">
                        <img src="images/tour-details/included/parking Car.webp" alt="parking Car">
                        <span> 24 hour cutomer service</span>
                      </div>
                      <div class="include-1">
                        <img src="images/tour-details/included/laundry.webp" alt="laundry">
                        <span> 24 hour cutomer service</span>
                      </div>
                    </div>
                    <div class="included_info">
                      <div class="include-1">
                        <img src="images/tour-details/included/24 hour cutomer service.webp" alt="24 hour customer service">
                        <span> 24 hour cutomer service</span>
                      </div>
                      <div class="include-1">
                        <img src="images/tour-details/included/parking Car.webp" alt="parking Car">
                        <span> 24 hour cutomer service</span>
                      </div>
                      <div class="include-1">
                        <img src="images/tour-details/included/laundry.webp" alt="laundry">
                        <span> 24 hour cutomer service</span>
                      </div>
                    </div>
                </div>
              </div>
            </div>
          </div>
          <div class="accordion" id="accordionPanelsStayOpenExample">
            <div class="accordion-item">
              <h2 class="accordion-header" id="panelsStayOpen-headingThree">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseThree" aria-expanded="false" aria-controls="panelsStayOpen-collapseThree">
                food & drink
                </button>
              </h2>
              <div id="panelsStayOpen-collapseThree" class="accordion-collapse collapse show" aria-labelledby="panelsStayOpen-headingThree">
                <div class="accordion-body">
                  <div class="included_info">
                    <div class="include-1">
                      <img src="images/tour-details/included/24 hour cutomer service.webp" alt="24 hour customer service">
                      <span> 24 hour cutomer service</span>
                    </div>
                    <div class="include-1">
                      <img src="images/tour-details/included/parking Car.webp" alt="parking Car">
                      <span> 24 hour cutomer service</span>
                    </div>
                    <div class="include-1">
                      <img src="images/tour-details/included/laundry.webp" alt="laundry">
                      <span> 24 hour cutomer service</span>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="accordion" id="accordionPanelsStayOpenExample">
            <div class="accordion-item">
              <h2 class="accordion-header" id="panelsStayOpen-headingforth">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseforth" aria-expanded="false" aria-controls="panelsStayOpen-collapseforth">
                parking & transportation
                </button>
              </h2>
              <div id="panelsStayOpen-collapseforth" class="accordion-collapse collapse show" aria-labelledby="panelsStayOpen-headingforth">
                <div class="accordion-body">
                  <div class="included_info">
                    <div class="include-1">
                      <img src="images/tour-details/included/24 hour cutomer service.webp" alt="24 hour customer service">
                      <span> 24 hour cutomer service</span>
                    </div>
                    <div class="include-1">
                      <img src="images/tour-details/included/parking Car.webp" alt="parking Car">
                      <span> 24 hour cutomer service</span>
                    </div>
                    <div class="include-1">
                      <img src="images/tour-details/included/laundry.webp" alt="laundry">
                      <span> 24 hour cutomer service</span>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="accordion" id="accordionPanelsStayOpenExample">
            <div class="accordion-item">
              <h2 class="accordion-header" id="panelsStayOpen-headingfifth">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapsefifth" aria-expanded="false" aria-controls="panelsStayOpen-collapsefifth">
              gest service
                </button>
              </h2>
              <div id="panelsStayOpen-collapsefifth" class="accordion-collapse collapse show" aria-labelledby="panelsStayOpen-headingfifth">
                <div class="accordion-body">
                    <div class="included_info">
                      <div class="include-1">
                        <img src="images/tour-details/included/24 hour cutomer service.webp" alt="24 hour customer service">
                        <span> 24 hour cutomer service</span>
                      </div>
                      <div class="include-1">
                        <img src="images/tour-details/included/parking Car.webp" alt="parking Car">
                        <span> 24 hour cutomer service</span>
                      </div>
                      <div class="include-1">
                        <img src="images/tour-details/included/laundry.webp" alt="laundry">
                        <span> 24 hour cutomer service</span>
                      </div>
                    </div>
                    <div class="included_info">
                      <div class="include-1">
                        <img src="images/tour-details/included/24 hour cutomer service.webp" alt="24 hour customer service">
                        <span> 24 hour cutomer service</span>
                      </div>
                      <div class="include-1">
                        <img src="images/tour-details/included/parking Car.webp" alt="parking Car">
                        <span> 24 hour cutomer service</span>
                      </div>
                      <div class="include-1">
                        <img src="images/tour-details/included/laundry.webp" alt="laundry">
                        <span> 24 hour cutomer service</span>
                      </div>
                    </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-sm-12 col-xl-6 ">
          <div class="images image-2">
            <!-- <img src="./images/tour-details/video.webp" class="w-100" alt="image mask"> -->

            <button type="button" class="btn js-modal-btn "data-video-url="https://www.youtube.com/embed/emAzmJCSEuI" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
              <img src="./images/homePage/play_button.webp" alt=" video play button">
            </button>
          </div>
          <div class="map">
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d13825.076326161745!2d31.113743195085064!3d29.97169599528912!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x14584514019cd63f%3A0xcd9b620a6cdaf277!2sThe%20Great%20Pyramid%20of%20Giza!5e0!3m2!1sen!2seg!4v1667161032416!5m2!1sen!2seg" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
          </div>
      </div>
    </section>
    <!-- search hitels and rooms avaliable  section -->
    <section class="rooms_search">
      <img src="./images/hotel-details/slider-mask_top.webp" alt="slider mask">
      <img src="./images/hotel-details/slider-mask-bottom.webp" alt="slider mask">

        <div class="hotels container">
            <h5> search hotels </h5>
            <section class="booking_hotels_section container">
                <div class="hotel_details">
                    <div class="row mx-0 p-0 align-items-center">
                        <div class="col-sm-12 col-md-6 col-xl-2 p-s-0 ">
                            <h5> destination</h5>

                          <div class="choices">
                            <i class="fa-solid fa-location-dot"></i>
                            <select class="form-select" aria-label="Default select example">
                              <option selected>indonisia</option>
                              <option value="1">turkey </option>
                              <option value="2"> egypt</option>
                              <option value="3">Japan</option>
                            </select>
                          </div>
                        </div>
                        <div class="col-sm-12 col-md-6 col-xl-3 p-0 ">
                            <h5> check in <span>check </span> </h5>
                           <div class="row mx-0">
                            <div class="col-6 p-0">
                              <div class="calender">
                                <i class="fa-solid fa-calendar-days"></i>
                                <input type="text" class="start-date form-control" value="2012-04-05">

                              </div>
                            </div>
                            <div class="col-6 p-0">
                              <input type="text" class="end-date form-control" value="2012-04-19">
                            </div>
                           </div>
                        </div>
                        <div class="col-sm-12 col-md-6 col-xl-2">
                            <h5> nights</h5>
                            <select class="form-select" aria-label="Default select example">
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
                            <h5> adults</h5>
                            <select class="form-select" aria-label="Default select example">
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
                            <select class="form-select" aria-label="Default select example">
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
                                    <a href="#"> search</a>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
        <div class="rooms_avaliable container">
            <h5> avaliable rooms </h5>
            <div class="rooms">
                <div class="row mx-0 align-items-center text-center">
                    <div class="col-xl-3 col-sm-12 col-md-6">
                        <h6>Deluxe Room DBL USE  </h6>
                    </div>
                    <div class="col-xl-2 col-sm-12 col-md-6">
                        <span class="category">
                            Bed and Breakfast
                        </span>
                    </div>
                    <div class="col-xl-3 col-sm-12 col-md-6">
                        <div class="avaliable">
                            <span> avaliable</span>
                            <span><a href="#">Cancellation Policy</a></span>
                        </div>
                    </div>
                    <div class="col-xl-2 col-sm-12 col-md-6">
                        <span class="price_info">
                            621,78 EUR
                        </span>
                    </div>
                    <div class="col-xl-1 col-sm-12 col-md-6">
                        <span class="offer_name">
                            <a href="#">offers</a>
                        </span>
                    </div>

                    <div class="col-xl-1 col-sm-12 col-md-6 p-0">
                       <button class="btn rooms_button"> <a href="./booking-hotel.html">book</a> </button>
                    </div>


                </div>
            </div>
            <div class="rooms">
              <div class="row mx-0 align-items-center text-center">
                  <div class="col-xl-3 col-sm-12 col-md-6">
                      <h6>Deluxe Room DBL USE  </h6>
                  </div>
                  <div class="col-xl-2 col-sm-12 col-md-6">
                      <span class="category">
                          Bed and Breakfast
                      </span>
                  </div>
                  <div class="col-xl-3 col-sm-12 col-md-6">
                      <div class="avaliable">
                          <span> avaliable</span>
                          <span><a href="#">Cancellation Policy</a></span>
                      </div>
                  </div>
                  <div class="col-xl-2 col-sm-12 col-md-6">
                      <span class="price_info">
                          621,78 EUR
                      </span>
                  </div>
                  <div class="col-xl-1 col-sm-12 col-md-6">
                      <span class="offer_name">
                          <a href="#">offers</a>
                      </span>
                  </div>

                  <div class="col-xl-1 col-sm-12 col-md-6 p-0">
                     <button class="btn rooms_button"> <a href="./booking-hotel.html">book</a> </button>
                  </div>


              </div>
            </div>
            <div class="rooms">
            <div class="row mx-0 align-items-center text-center">
                <div class="col-xl-3 col-sm-12 col-md-6">
                    <h6>Deluxe Room DBL USE  </h6>
                </div>
                <div class="col-xl-2 col-sm-12 col-md-6">
                    <span class="category">
                        Bed and Breakfast
                    </span>
                </div>
                <div class="col-xl-3 col-sm-12 col-md-6">
                    <div class="avaliable">
                      <span class="request"> on request </span>
                        <span><a href="#">Cancellation Policy</a></span>
                    </div>
                </div>
                <div class="col-xl-2 col-sm-12 col-md-6">
                    <span class="price_info">
                        621,78 EUR
                    </span>
                </div>
                <div class="col-xl-1 col-sm-12 col-md-6">
                    <span class="offer_name">
                        <a href="#">offers</a>
                    </span>
                </div>

                <div class="col-xl-1 col-sm-12 col-md-6 p-0">
                   <button class="btn rooms_button"> <a href="./booking-hotel.html">book</a> </button>
                </div>


            </div>
            </div>
           <div class="rooms">
          <div class="row mx-0 align-items-center text-center">
              <div class="col-xl-3 col-sm-12 col-md-6">
                  <h6>Deluxe Room DBL USE  </h6>
              </div>
              <div class="col-xl-2 col-sm-12 col-md-6">
                  <span class="category">
                      Bed and Breakfast
                  </span>
              </div>
              <div class="col-xl-3 col-sm-12 col-md-6">
                  <div class="avaliable">
                      <span> avaliable</span>
                      <span><a href="#">Cancellation Policy</a></span>
                  </div>
              </div>
              <div class="col-xl-2 col-sm-12 col-md-6">
                  <span class="price_info">
                      621,78 EUR
                  </span>
              </div>
              <div class="col-xl-1 col-sm-12 col-md-6">
                  <span class="offer_name">
                      <a href="#">offers</a>
                  </span>
              </div>

              <div class="col-xl-1 col-sm-12 col-md-6 p-0">
                 <button class="btn rooms_button"> <a href="./booking-hotel.html">book</a> </button>
              </div>


          </div>
            </div>
           <div class="rooms">
          <div class="row mx-0 align-items-center text-center">
              <div class="col-xl-3 col-sm-12 col-md-6">
                  <h6>Deluxe Room DBL USE  </h6>
              </div>
              <div class="col-xl-2 col-sm-12 col-md-6">
                  <span class="category">
                      Bed and Breakfast
                  </span>
              </div>
              <div class="col-xl-3 col-sm-12 col-md-6">
                  <div class="avaliable">
                      <span class="request"> on request </span>
                      <span><a href="#">Cancellation Policy</a></span>
                  </div>
              </div>
              <div class="col-xl-2 col-sm-12 col-md-6">
                  <span class="price_info">
                      621,78 EUR
                  </span>
              </div>
              <div class="col-xl-1 col-sm-12 col-md-6">
                  <span class="offer_name">
                      <a href="#">offers</a>
                  </span>
              </div>

              <div class="col-xl-1 col-sm-12 col-md-6 p-0">
                <button class="btn rooms_button"> <a href="./booking-hotel.html">book</a> </button>
              </div>


          </div>
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
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">add comment </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">
                <div class="rating">
                  <i class="fa-solid fa-star"></i>
                  <i class="fa-solid fa-star"></i>
                  <i class="fa-solid fa-star"></i>
                  <i class="fa-solid fa-star"></i>
                  <i class="fa-solid fa-star"></i>
                </div>
                <div class="form-floating comment_input">
                  <textarea class="form-control" placeholder="Leave a comment here" id="floatingTextarea2" style="height: 200px"></textarea>
                  <label for="floatingTextarea2"> your Comments ...</label>
                </div>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-primary comment_pop_btn">add comment </button>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="review_details">
        <img src="./images/tour-details/profile/profile-1.webp" alt="profile picture ">
        <div class="review_info">
          <div class="heading">
            <h6> Felecia Lawson - Paris, France </h6>
            <div class="rating">
              <i class="fa-solid fa-star"></i>
              <i class="fa-solid fa-star"></i>
              <i class="fa-solid fa-star"></i>
              <i class="fa-solid fa-star"></i>
              <i class="fa-solid fa-star"></i>
            </div>
          </div>
          <p>
            Everything was absolutely great, staff were excellent and helpful.
          </p>
        </div>

      </div>
      <div class="review_details">
        <img src="./images/tour-details/profile/profile-2.webp" alt="profile picture ">
        <div class="review_info">
          <div class="heading">
            <h6> William W. - Lisbone, Portugal</h6>
            <div class="rating">
              <i class="fa-solid fa-star"></i>
              <i class="fa-solid fa-star"></i>
              <i class="fa-solid fa-star"></i>
              <i class="fa-solid fa-star"></i>
              <i class="fa-solid fa-star"></i>
            </div>
          </div>
          <p>
            Everything was absolutely great, staff were excellent and helpful. Room was spacious and clean. Breakfast was great. Everything was absolutely great, staff were excellent and helpful. Room was spacious and clean. Breakfast was great.          </p>
        </div>

      </div>
      <div class="review_details">
        <img src="./images/tour-details/profile/profile-3.webp" alt="profile picture ">
        <div class="review_info">
          <div class="heading">
            <h6> John Doe - Rome, Italy </h6>
            <div class="rating">
              <i class="fa-solid fa-star"></i>
              <i class="fa-solid fa-star"></i>
              <i class="fa-solid fa-star"></i>
              <i class="fa-solid fa-star"></i>
              <i class="fa-solid fa-star"></i>
            </div>
          </div>
          <p>
            Everything was absolutely great, staff were excellent and helpful. Room was spacious and clean. Breakfast was great .Everything was absolutely great, staff were excellent and helpful. Room was spacious and clean. Breakfast was great .Everything was absolutely great, staff were excellent and helpful. Room was spacious and clean. Breakfast was great.          </p>
        </div>

      </div>

      <button class="btn comments_button">
        load all comments
      </button>
    </section>
    <!--  ending page  -->
@endsection

