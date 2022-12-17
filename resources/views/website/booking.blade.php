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
@if ($RoomCost)
@php
if($RoomCost->room_cap == 1){
$Type = "Single";
$Cost = $RoomCost->single_cost;
}
else if ($RoomCost->room_cap == 2){
$Type = "Double";
$Cost = $RoomCost->double_cost;
}
elseif($RoomCost->room_cap == 3){
$Type = "Triple";
$Cost = $RoomCost->triple_cost;
}

$ChildrenCost = 0;
$FreeChildren = 0;
$PaidChildren = 0;
$ages = null;
if($RoomCost->children_count){
    $ages = explode(",", $RoomCost->ages);
    $ChildrenCost = 0;
    $FreeChildren = 0;
    $PaidChildren = 0;
    for ($i=0; $i < $RoomCost->children_count; $i++) {
        if($ages[$i] >= $RoomCost->child_free_age_from && $ages[$i] <= $RoomCost->child_free_age_to){
            $FreeChildren++;
        }else{
            $PaidChildren++;
        }
    }
}

$TotalCost = $RoomCost->nights * ($RoomCost->rooms_count*$Cost + $PaidChildren*$RoomCost->child_age_cost);
@endphp
<!-- passenger details -->
<section class="passenger_section container">
    <h5> passenger details </h5>
    <div class="row mx-0">
        <div class="col-sm-12 col-md-6">
            <div class="passenger_info">
                <form action="">
                    <div class="row">
                        <h6>Reservation Holder Details:</h6>
                        <div class="col-sm-12 col-md-6 col-xl-4">
                            <label  class="form-label">Salutation
                            </label>
                            <input type="text" name="adultsSal[]" class="form-control" placeholder="MR" aria-label="First name">
                        </div>
                        <div class="col-sm-12 col-md-6 col-xl-4">
                            <label  class="form-label">Name</label>

                          <input type="text" name="adultsNames[]" class="form-control" placeholder="Name">
                        </div>
                        <div class="col-sm-12 col-md-6 col-xl-4">
                            <label  class="form-label">Mobile</label>

                            <input type="text" name="adultsMobile[]" class="form-control" placeholder="Mobile">
                          </div>
                    </div>
                    <h6>Adults Details:</h6>
                    @for ($j = 0; $j < $RoomCost->adults_count-1; $j++)
                    <div class="row">
                        <div class="col-sm-12 col-md-6 col-xl-4">
                            <label  class="form-label">Salutation
                            </label>
                            <input type="text" name="adultsSal[]" class="form-control" placeholder="MR" aria-label="First name">
                        </div>
                        <div class="col-sm-12 col-md-6 col-xl-4">
                            <label  class="form-label">Name</label>

                          <input type="text" name="adultsNames[]" class="form-control" placeholder="Name">
                        </div>
                        <div class="col-sm-12 col-md-6 col-xl-4">
                            <label  class="form-label">Mobile</label>

                            <input type="text" name="adultsMobile[]" class="form-control" placeholder="Mobile">
                          </div>
                    </div>
                    @endfor
                    @for ($i = 0; $i < $RoomCost->children_count; $i++)
                    <div class="row">
                        <div class="col-sm-12 col-md-6 col-xl-4">
                            <label  class="form-label">Child Details (Age: {{$ages[$i]}}):
                            </label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12 col-md-6 col-xl-4">
                            <label  class="form-label">Name
                            </label>
                        <input type="text" class="form-control" name="childrenNames[]" placeholder="Name" aria-label="First name">
                        <input type="hidden" name="childrenAges[]" value="{{$ages[$i]}}"/>
                        </div>
                    </div>
                    @endfor
                    <div class="row">

                        <div class="col-12">
                            <label  class="form-label">notes</label>
                            <textarea class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
                          </div>
                          <div class="col-12 text-center">
                            <button type="submit" class="btn btn-outline-secondary">Place Order</button>
                          </div>
                    </div>
                </form>
            </div>


        </div>
        <div class="col-sm-12 col-md-6">
            <div class="passenger_info">
                <div class="booking_info_card">
                    <div class="text-end mb-3"><a class="del-hotel" href="{{url("/cart/$RoomCost->id")}}"><i class="fa-solid fa-trash"></i></a></div>
                    <div class="booking_info_card_info">
                        <div class="info_image">
                            <img src="{{ asset('uploads/hotels') }}/{{ $RoomCost->hotel_banner }}" alt=" blogimage" />
                        </div>
                        <div class="info_title">
                            <div class="card_info">
                                <h6> <a href="{{ url('/hotels/' . $RoomCost->hotel_id) }}"
                                    class="">{{ $RoomCost->hotel_enname }} –
                                    {{ $RoomCost->hotel_stars }} Stars</a></h6>
                                    <span> <i class="fa-solid fa-location-dot"></i>{{ $RoomCost->en_country }}
                                        <span>|</span> {{ $RoomCost->en_city }}</span>
                            </div>
                            <div class="rating">
                                    @for ($i = 0; $i < $RoomCost->hotel_stars; $i++)
                                    <i class="fa-solid fa-star"></i>
                                    @endfor
                                    @for ($i = 5; $i > $RoomCost->hotel_stars; $i--)
                                    <i class="fa-regular fa-star"></i>
                                    @endfor

                            </div>
                         </div>
                    </div>
                    <div class="remain_info mb-3">
                        <h5>
                            booking for {{ $RoomCost->nights}} nights
                        </h5>
                        <div class="date">

                        </div>
                        <h5>rooms</h5>

                        <p class="mb-0 pb-0">
                            {{$RoomCost->rooms_count}} X {{$RoomCost->en_room_type}} {{$Type}} ({{$RoomCost->food_bev_type}})
                            <span class="float-end text-end">{{$RoomCost->rooms_count}} X ${{$Cost}} <br> <span class="fw-bold"> ${{$RoomCost->rooms_count*$Cost}}</span></span>
                        </p>
                        <br>
                        <p class="mb-0 pb-0">
                            {{$RoomCost->adults_count}} X Adults
                        </p>
                        <br>
                        @if($ages)
                        <p class="mb-0 pb-0">
                            {{$FreeChildren}} X Free Childs (Age From {{$RoomCost->child_free_age_from}} To {{$RoomCost->child_free_age_to}}) <span class="float-end">Free</span><br>
                        </p>
                        <br>
                        <p class="mb-0 pb-0">
                            {{$PaidChildren}} X Paid Childs (Age From {{$RoomCost->child_age_from}} To {{$RoomCost->child_age_to}}) <span class="float-end text-end">{{$PaidChildren}} X ${{$RoomCost->child_age_cost}} <br> <span class="fw-bold">${{$PaidChildren*$RoomCost->child_age_cost}}</span></span><br>
                        </p>

                        <br>
                        @endif
                        <p class="mb-0 pb-0" style="border-top: 1px solid rgb(184, 184, 184)">
                            <span class="float-end text-end fw-bold">${{$RoomCost->rooms_count*$Cost + $PaidChildren*$RoomCost->child_age_cost}}</span><br>
                        </p>
                        <br>
                        <p class="mb-0 pb-0">
                            Booking for {{$RoomCost->nights}} nights<span class="float-end text-end fw-bold">{{$RoomCost->nights}} X ${{($RoomCost->rooms_count*$Cost + $PaidChildren*$RoomCost->child_age_cost)}}</span><br>
                        </p>
                        <div class="grand_total">
                            <h6> Sub-total</h6>
                            <span class="h6"> {{$TotalCost}} <span class="h6">$</span></span>
                        </div>
                        <p class="mb-0 pb-0">
                            VAT (14%) <span class="float-end text-end">${{$TotalCost}} X 0.14 <br>  <span class="fw-bold">${{$TotalCost*0.14}}</span></span><br>
                        </p>
                        <br>
                    </div>
                    <div class="grand_total final">
                        <h5> grand total</h5>
                        <span> {{$TotalCost*1.14}} <span>$</span></span>
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

        </div>
      </div>
    </div>
    </div>
</section>
@else
<div class="container bg-light-info text-center p-5">Nothing is Added to cart</div>
@endif
@endsection
