@extends('layout.website.layout', ['Company' => $Company, 'title' => 'Safer | User Cart'])

@section('adds_css')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="{{ asset('/website_assets/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('/website_assets/css/about.css') }}">
    <link rel="stylesheet" href="{{ asset('/website_assets/css/tours.css') }}">
    <link rel="stylesheet" href="{{ asset('/website_assets/css/hotel.css') }}">
    <link rel="stylesheet" href="{{ asset('/website_assets/css/booking-hotel.css') }}">
@endsection

@section('bottom-header')
    <x-website.header.general title="User Cart" :breadcrumb="$BreadCrumb" current="All your pre-booked rooms" />
@endsection
@section('content')
<!-- passenger details -->
<section class="passenger_section container">
    <h5> passenger details </h5>
    <div class="row mx-0">
        <div class="col-sm-12 col-md-8">
            <div class="passenger_info">
                <form action="">
                    <div class="row">
                        <div class="col-sm-12 col-md-6 col-xl-4">
                            <label  class="form-label">Salutation
                            </label>
                          <input type="text" class="form-control" placeholder="MR" aria-label="First name">
                        </div>
                        <div class="col-sm-12 col-md-6 col-xl-4">
                            <label  class="form-label">Name</label>

                          <input type="text" class="form-control" placeholder="Name">
                        </div>
                        <div class="col-sm-12 col-md-6 col-xl-4">
                            <label  class="form-label">GSM</label>

                            <input type="text" class="form-control" placeholder="GSM">
                          </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12 col-md-6 col-xl-4">
                            <label  class="form-label">Salutation
                            </label>
                          <input type="text" class="form-control" placeholder="MR" aria-label="First name">
                        </div>
                        <div class="col-sm-12 col-md-6 col-xl-4">
                            <label  class="form-label">Name</label>

                          <input type="text" class="form-control" placeholder="Name">
                        </div>
                        <div class="col-12">
                            <label  class="form-label">notes</label>
                            <textarea class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
                          </div>
                          <div class="col-12">
                            <button type="submit" class="btn btn-outline-secondary w-100">Book</button>
                          </div>
                    </div>
                </form>
            </div>


        </div>
        <div class="col-sm-12 col-md-4">
            <div class="passenger_info">
                <div class="booking_info_card">
                    <div class="text-end mb-3"><a class="del-hotel" href="#"><i class="fa-solid fa-trash"></i></a></div>
                    <div class="booking_info_card_info">
                        <div class="info_image">
                            <img src="{{ asset('/website_assets/images/homePage/hotels/hotel-1.webp') }}" alt="hotel image">
                        </div>
                        <div class="info_title">
                            <div class="card_info">
                                <h6> Venice, Rome and</h6>
                                <span>     <i class="fa-solid fa-location-dot"></i>  turkey  <span>|</span> istanbul</span>
                            </div>
                            <div class="rating">
                                <i class="fa-solid fa-star"></i>
                                <i class="fa-solid fa-star"></i>
                                <i class="fa-solid fa-star"></i>
                                <i class="fa-solid fa-star"></i>
                                <i class="fa-regular fa-star"></i>
                                    <span> ( 1 review) </span>
                            </div>
                         </div>
                    </div>
                    <div class="remain_info mb-3">
                        <h5>
                            booking for 3 nights
                        </h5>
                        <div class="date">

                        </div>
                        <h5>rooms</h5>
                        <p class="mb-0 pb-0">
                            1 X Standers Double or Twin (bed) <span class="float-end">1 X $140</span>
                        </p>
                        <p class="mb-0 pb-0">
                            5 X Adults <span class="float-end">5 X $5</span>
                        </p>
                        <div class="grand_total">
                            <h6> Sub-total</h6>
                            <span class="h6"> 165 <span class="h6">$</span></span>
                        </div>
                    </div>
                    <div class="text-end mb-3"><a class="del-hotel" href="#"><i class="fa-solid fa-trash"></i></a></div>
                    <div class="booking_info_card_info">
                        <div class="info_image">
                            <img src="{{ asset('/website_assets/images/homePage/hotels/hotel-1.webp') }}" alt="hotel image">
                        </div>
                        <div class="info_title">
                            <div class="card_info">
                                <h6> Venice, Rome and</h6>
                                <span>     <i class="fa-solid fa-location-dot"></i>  turkey  <span>|</span> istanbul</span>
                            </div>
                            <div class="rating">
                                <i class="fa-solid fa-star"></i>
                                <i class="fa-solid fa-star"></i>
                                <i class="fa-solid fa-star"></i>
                                <i class="fa-solid fa-star"></i>
                                <i class="fa-regular fa-star"></i>
                                    <span> ( 1 review) </span>
                            </div>
                         </div>
                    </div>
                    <div class="remain_info mb-3">
                        <h5>
                            Included tour: Alexandria Tour
                        </h5>
                        <div class="date">

                        </div>
                        <h5>Details</h5>
                        <p class="mb-0 pb-0">
                            2 X Participant <span class="float-end">2 X $20</span>
                        </p>
                        <p class="mb-0 pb-0">
                            1 free child <span class="float-end">$0</span>
                        </p>
                        <p class="mb-0 pb-0">
                            3 child <span class="float-end">3 X $10</span>
                        </p>
                        <div class="grand_total">
                            <h6> Sub-total</h6>
                            <span class="h6"> 70 <span class="h6">$</span></span>
                        </div>
                    </div>
                    <div class="grand_total final">
                        <h5> grand total</h5>
                        <span> 235 <span>$</span></span>
                    </div>
                </div>
             </div>
        </div>
    </div>
    <div class="mt-5">
      <h5> Recommended tours </h5>
    <div class="mt-3">
      <div class="row">
        <div class="col-12">
          <div class="card-content">
            <div class=" card setted_tour_cards ">
              <img src="{{ asset('/website_assets/images/homePage/hotels/hotel-1.webp') }}" alt=" blogimage">
              <div class="card-body  setted_info">
                <div class="card_info">
                    <h6> Venice, Rome and Milan – 9 Days 8</h6>
                    <span>
                      $ 140
                    </span>
                </div>
                <span>     <i class="fa-solid fa-location-dot"></i>  duration 4 hours </span>
                <p>
                  Amet minim mollit non deserunt  ullamco est sit aliqua dolor do amet
                </p>
                <div class="booking_info">
                  <div class="details">
                    <span>
                      set in coach
                    </span>
                    <span>
                      Entertainments
                    </span>
                  </div>
                 <div class="details">
                    <div class="cancelation">
                      <span> Adult-2</span>
                      <span> <a href="#">
                        cancelation policy
                      </a></span>
                    </div>
                  <span>
                    140 EUR
                  </span>
                 </div>
                  <button>
                    <a href="./tours-details.html" class="btn stretched-link"> book</a>
                  </button>
                </div>
                <div class="booking_info">
                <div class="details">
                  <span>
                    private
                  </span>
                  <span>
                    Entertainments
                  </span>
                </div>
                  <div class="details">
                    <div class="cancelation">
                      <span> Adult-2</span>
                      <span> <a href="#">
                        cancelation policy
                      </a></span>
                    </div>
                    <span>
                      140 EUR
                    </span>
                  </div>
                  <button>
                     <a href="./tours-details.html" class="btn stretched-link"> book</a>
                  </button>
                </div>
              </div>
          </div>
          </div>
          <div class="card-content">
            <div class=" card setted_tour_cards ">
              <img src="{{ asset('/website_assets/images/homePage/hotels/hotel-1.webp') }}" alt=" blogimage">
              <div class="card-body  setted_info">
                <div class="card_info">
                    <h6> Venice, Rome and Milan – 9 Days 8</h6>
                    <span>
                      $ 140
                    </span>
                </div>
                <span>     <i class="fa-solid fa-location-dot"></i>  duration 4 hours </span>
                <p>
                  Amet minim mollit non deserunt  ullamco est sit aliqua dolor do amet
                </p>
                <div class="booking_info">
                  <div class="details">
                    <span>
                      set in coach
                    </span>
                    <span>
                      Entertainments
                    </span>
                  </div>
                 <div class="details">
                    <div class="cancelation">
                      <span> Adult-2</span>
                      <span> <a href="#">
                        cancelation policy
                      </a></span>
                    </div>
                  <span>
                    140 EUR
                  </span>
                 </div>
                  <button>
                    <a href="./tours-details.html" class="btn stretched-link"> book</a>
                  </button>
                </div>
                <div class="booking_info">
                <div class="details">
                  <span>
                    private
                  </span>
                  <span>
                    Entertainments
                  </span>
                </div>
                  <div class="details">
                    <div class="cancelation">
                      <span> Adult-2</span>
                      <span> <a href="#">
                        cancelation policy
                      </a></span>
                    </div>
                    <span>
                      140 EUR
                    </span>
                  </div>
                  <button>
                     <a href="./tours-details.html" class="btn stretched-link"> book</a>
                  </button>
                </div>
              </div>
          </div>
          </div>
          <div class="card-content">
            <div class=" card setted_tour_cards ">
              <img src="{{ asset('/website_assets/images/homePage/hotels/hotel-1.webp') }}" alt=" blogimage">
              <div class="card-body  setted_info">
                <div class="card_info">
                    <h6> Venice, Rome and Milan – 9 Days 8</h6>
                    <span>
                      $ 140
                    </span>
                </div>
                <span>     <i class="fa-solid fa-location-dot"></i>  duration 4 hours </span>
                <p>
                  Amet minim mollit non deserunt  ullamco est sit aliqua dolor do amet
                </p>
                <div class="booking_info">
                  <div class="details">
                    <span>
                      set in coach
                    </span>
                    <span>
                      Entertainments
                    </span>
                  </div>
                 <div class="details">
                    <div class="cancelation">
                      <span> Adult-2</span>
                      <span> <a href="#">
                        cancelation policy
                      </a></span>
                    </div>
                  <span>
                    140 EUR
                  </span>
                 </div>
                  <button>
                    <a href="./tours-details.html" class="btn stretched-link"> book</a>
                  </button>
                </div>
                <div class="booking_info">
                <div class="details">
                  <span>
                    private
                  </span>
                  <span>
                    Entertainments
                  </span>
                </div>
                  <div class="details">
                    <div class="cancelation">
                      <span> Adult-2</span>
                      <span> <a href="#">
                        cancelation policy
                      </a></span>
                    </div>
                    <span>
                      140 EUR
                    </span>
                  </div>
                  <button>
                     <a href="./tours-details.html" class="btn stretched-link"> book</a>
                  </button>
                </div>
              </div>
          </div>
          </div>
          <div class="card-content">
            <div class=" card setted_tour_cards ">
              <img src="{{ asset('/website_assets/images/homePage/hotels/hotel-1.webp') }}" alt=" blogimage">
              <div class="card-body  setted_info">
                <div class="card_info">
                    <h6> Venice, Rome and Milan – 9 Days 8</h6>
                    <span>
                      $ 140
                    </span>
                </div>
                <span>     <i class="fa-solid fa-location-dot"></i>  duration 4 hours </span>
                <p>
                  Amet minim mollit non deserunt  ullamco est sit aliqua dolor do amet
                </p>
                <div class="booking_info">
                  <div class="details">
                    <span>
                      set in coach
                    </span>
                    <span>
                      Entertainments
                    </span>
                  </div>
                 <div class="details">
                    <div class="cancelation">
                      <span> Adult-2</span>
                      <span> <a href="#">
                        cancelation policy
                      </a></span>
                    </div>
                  <span>
                    140 EUR
                  </span>
                 </div>
                  <button>
                    <a href="./tours-details.html" class="btn stretched-link"> book</a>
                  </button>
                </div>
                <div class="booking_info">
                <div class="details">
                  <span>
                    private
                  </span>
                  <span>
                    Entertainments
                  </span>
                </div>
                  <div class="details">
                    <div class="cancelation">
                      <span> Adult-2</span>
                      <span> <a href="#">
                        cancelation policy
                      </a></span>
                    </div>
                    <span>
                      140 EUR
                    </span>
                  </div>
                  <button>
                     <a href="./tours-details.html" class="btn stretched-link"> book</a>
                  </button>
                </div>
              </div>
          </div>
          </div>
        </div>
      </div>
    </div>
    </div>
</section>
@endsection
