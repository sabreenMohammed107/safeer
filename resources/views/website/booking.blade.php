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
@if ($RoomCost || count($ToursCost) || $TransferCost || count($VisasCost))
@php
    $TotalCost = 0;
    $TotalToursFees = 0;
    $TotalTransferCost = 0;
    $TotalVisasCost = 0;
@endphp
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

@endif
@if (count($ToursCost) > 0)
    @php
        $TotalToursFees = 0;
    @endphp
@endif
@if ($TransferCost)
    @php
        $TotalTransferCost = $TransferCost->capacity * $TransferCost->person_price;
    @endphp
@endif
@if (count($VisasCost) > 0)
    @php
        $TotalVisasCost =0;
    @endphp
@endif
<!-- passenger details -->
<section class="passenger_section container">
    <h5> Cart details </h5>
    <form action="{{url('/Book')}}" method="POST">
    <div class="row mx-0">
        <div class="col-sm-12 col-md-6">
            @if($RoomCost)
            <h4 class="bg-info px-3 py-1 text-white">Hotel Room Reservation Details</h4>
            <div class="passenger_info">
                    @csrf
                    <div class="row">

                        <h6>Reservation Holder Details:</h6>
                        <div class="col-sm-12 col-md-6 col-xl-4">
                            <label  class="form-label">Salutation
                            </label>
                            <input type="text" name="adultsSal[]" required class="form-control" placeholder="MR" aria-label="First name">
                        </div>
                        <div class="col-sm-12 col-md-6 col-xl-4">
                            <label  class="form-label">Name</label>

                          <input type="text" name="adultsNames[]" required class="form-control" placeholder="Name">
                        </div>
                        <div class="col-sm-12 col-md-6 col-xl-4">
                            <label  class="form-label">Mobile</label>

                            <input type="text" name="adultsMobile[]" required class="form-control" placeholder="Mobile">
                          </div>
                    </div>
                    @if($RoomCost->adults_count-1 > 0)
                    <h6>Adults Details:</h6>
                    @for ($j = 0; $j < $RoomCost->adults_count-1; $j++)
                    <div class="row">
                        <div class="col-sm-12 col-md-6 col-xl-4">
                            <label  class="form-label">Salutation
                            </label>
                            <input type="text" name="adultsSal[]" required class="form-control" placeholder="MR" aria-label="First name">
                        </div>
                        <div class="col-sm-12 col-md-6 col-xl-4">
                            <label  class="form-label">Name</label>

                          <input type="text" name="adultsNames[]" required class="form-control" placeholder="Name">
                        </div>
                        <div class="col-sm-12 col-md-6 col-xl-4">
                            <label  class="form-label">Mobile</label>

                            <input type="text" name="adultsMobile[]" required class="form-control" placeholder="Mobile">
                          </div>
                    </div>
                    @endfor
                    @endif
                    @for ($i = 0; $i < $RoomCost->children_count; $i++)
                    <div class="row">
                        <div class="col-sm-12">
                            <label  class="form-label">Child Details (Age: {{$ages[$i]}}):
                            </label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12 col-md-6">
                            <label  class="form-label">Name
                            </label>
                        <input type="text" class="form-control" required name="childrenNames[]" placeholder="Name" aria-label="First name">
                        <input type="hidden" name="childrenAges[]" required value="{{$ages[$i]}}"/>
                        </div>
                    </div>
                    @endfor
                    <div class="row">

                        <div class="col-12">
                            <label  class="form-label">notes</label>
                            <textarea class="form-control" required name="notes" id="exampleFormControlTextarea1" rows="3"></textarea>
                        </div>
                        {{-- <div class="form-check mb-3">
                            <input class="form-check-input terms" required type="checkbox" value="" id="flexCheckChecked">
                            <label class="form-check-label" for="flexCheckChecked">
                                I agree to all <a href="{{url('/terms')}}">Terms and Conditions</a> of Safer
                            </label>
                        </div> --}}
                        <input type="hidden" name="hotel_id" value="{{$RoomCost->hotel_id}}" />
                        <input type="hidden" name="from_date" value="{{$RoomCost->from_date}}" />
                        <input type="hidden" name="to_date" value="{{$RoomCost->to_date}}" />
                        <input type="hidden" name="nights" value="{{$RoomCost->nights}}" />
                        <input type="hidden" name="adults_count" value="{{$RoomCost->adults_count}}" />
                        <input type="hidden" name="children_count" value="{{$RoomCost->children_count}}" />
                        <input type="hidden" name="rooms_count" value="{{$RoomCost->rooms_count}}" />
                        <input type="hidden" name="room_type" value="{{$Type}}" />
                        <input type="hidden" name="room_view" value="{{$RoomCost->en_room_type}}" />
                        <input type="hidden" name="food_bev_type" value="{{$RoomCost->food_bev_type}}" />
                        <input type="hidden" name="room_cost" value="{{$Cost}}" />
                        <input type="hidden" name="total_cost" value="{{$TotalCost}}" />
                        <input type="hidden" name="user_id" value="{{$RoomCost->user_id}}" />
                        <input type="hidden" name="child_free_age_from" value="{{$RoomCost->child_free_age_from}}" />
                        <input type="hidden" name="child_free_age_to" value="{{$RoomCost->child_free_age_to}}" />
                        <input type="hidden" name="child_age_cost" value="{{$RoomCost->child_age_cost}}" />
                        {{-- <div class="col-12 text-center">
                            <button type="submit" class="btn btn-info">Place Order</button>
                        </div> --}}

                    </div>
            </div>
            @endif
            @if (count($ToursCost) > 0)
            <h4 class="bg-info px-3 py-1 text-white">Tours Reservation Details</h4>
            @foreach ($ToursCost as $index => $Tour)
                @php
                    $TotalPaidPersons[$index] = $Tour->adults_count;
                @endphp
            <h6 class="bg-light-info px-3 py-1">{{$Tour->en_name}} <span class="float-end">{{$Tour->tour_date}}</span></h6>
            <div class="passenger_info">
                @csrf
                <div class="row">
                    <h6>Reservation Holder Details:</h6>
                    <div class="col-sm-12 col-md-6 col-xl-4">
                        <label  class="form-label">Salutation
                        </label>
                        <input type="text" name="tour_adults_sal[{{$index}}][]" required class="form-control" placeholder="MR" aria-label="First name">
                    </div>
                    <div class="col-sm-12 col-md-6 col-xl-4">
                        <label  class="form-label">Name</label>

                        <input type="text" name="tour_adults_name[{{$index}}][]" required class="form-control" placeholder="Name">
                    </div>
                    <div class="col-sm-12 col-md-6 col-xl-4">
                        <label  class="form-label">Mobile</label>

                        <input type="text" name="tour_adults_mobile[{{$index}}][]" required class="form-control" placeholder="Mobile">
                        </div>
                </div>
                <h6>Adults Details:</h6>
                @for ($j = 0; $j < $Tour->adults_count-1; $j++)

                <div class="row">
                    <div class="col-sm-12 col-md-6 col-xl-4">
                        <label  class="form-label">Salutation
                        </label>
                        <input type="text" name="tour_adults_sal[{{$index}}][]" required class="form-control" placeholder="MR" aria-label="First name">
                    </div>
                    <div class="col-sm-12 col-md-6 col-xl-4">
                        <label  class="form-label">Name</label>

                        <input type="text" name="tour_adults_name[{{$index}}][]" required class="form-control" placeholder="Name">
                    </div>
                    <div class="col-sm-12 col-md-6 col-xl-4">
                        <label  class="form-label">Mobile</label>

                        <input type="text" name="tour_adults_mobile[{{$index}}][]" required class="form-control" placeholder="Mobile">
                        </div>
                </div>
                @endfor
                @for ($i = 0; $i < $Tour->children_count; $i++)
                @php
                    if($Tour->ages && explode(",", $Tour->ages)[$i] > 2){
                        $TotalPaidPersons[$index]++;
                    }
                @endphp
                @if ($Tour->ages && explode(",", $Tour->ages)[$i] > 2)
                <div class="row">
                    <div class="col-sm-12">
                        <label  class="form-label">Child Details (Age: {{explode(",", $Tour->ages)[$i]}}):
                        </label>
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-12 col-md-6">
                        <label  class="form-label">Name
                        </label>
                    <input type="text" class="form-control" required name="tour_child_name[{{$index}}][]" placeholder="Name" aria-label="First name">
                    <input type="hidden" name="tour_child_age[{{$index}}][]" required value="{{explode(",", $Tour->ages)[$i]}}"/>
                    </div>
                </div>
                @endif
                @endfor
                <div class="row">

                    <div class="col-12">
                        <label  class="form-label">notes</label>
                        <textarea class="form-control" required name="tour_notes[{{$index}}]" id="exampleFormControlTextarea1" rows="3"></textarea>
                    </div>
                    <input type="hidden" name="tour_id[{{$index}}]" value="{{$Tour->tour_id}}" />
                    <input type="hidden" name="tour_date[{{$index}}]" value="{{$Tour->tour_date}}" />
                    <input type="hidden" name="tour_adults_count[{{$index}}]" value="{{$Tour->adults_count}}" />
                    <input type="hidden" name="tour_children_count[{{$index}}]" value="{{$Tour->children_count}}" />
                    @php
                        $TourTotalCost[$index] = $Tour->tour_person_cost*$TotalPaidPersons[$index];
                        $TotalToursFees += $TourTotalCost[$index];
                    @endphp
                    <input type="hidden" name="tour_total_cost[{{$index}}]" value="{{$TourTotalCost[$index]}}" />
                </div>
            </div>
            @endforeach
            @endif
            @if ($TransferCost)
            <h4 class="bg-info px-3 py-1 text-white">Transportation Reservation Details</h4>

            <div class="passenger_info">
                @csrf
                <div class="row my-2">
                    <h6 class="fw-bold">Vehicle Details:</h6>
                    <div class="col-md-4 mb-3">
                        <div class="img-holder"
                        style="background-image: url('{{ asset('uploads/carModels') }}/{{ $TransferCost->image }}')"
                        ></div>
                    </div>
                    <div class="col-md-8">
                        <p class="mb-0">Car Model: <strong>{{$TransferCost->model_enname}}</strong></p>
                        <p class="mb-0">Car Capacity: <strong>{{$TransferCost->capacity}}</strong></p>
                        <p class="mb-0">Class Type: <strong>{{$TransferCost->class_enname}}</strong></p>
                        <p class="mb-0">Starting point (from): <strong>{{$TransferCost->from_location_enname}}</strong></p>
                        <p class="mb-0">Route Destination (to): <strong>{{$TransferCost->to_location_enname}}</strong></p>
                        <p class="mb-0">Fees/Person: <strong>{{$TransferCost->person_price}}$</strong></p>
                    </div>

                    <h6 class="fw-bold">Reservation Holder Details:</h6>
                    <div class="form-check ps-5 my-2">
                        <input class="form-check-input" type="checkbox" name="default_holder" id="transHolderFlag">
                        <label class="form-check-label ps-2" for="transHolderFlag">
                            I am not the holder
                        </label>
                    </div>
                    <div class="row trans-holder" style="display: none;">
                        <div class="col-sm-12 col-md-6 col-xl-4">
                            <label  class="form-label">Salutation
                            </label>
                            <input type="text" name="transferSal" class="form-control is_holder" placeholder="MR" aria-label="First name">
                        </div>
                        <div class="col-sm-12 col-md-6 col-xl-4">
                            <label  class="form-label">Name</label>

                            <input type="text" name="transferName" class="form-control is_holder" placeholder="Name">
                        </div>
                        <div class="col-sm-12 col-md-6 col-xl-4">
                            <label  class="form-label">Mobile</label>

                            <input type="text" name="transferMobile" class="form-control is_holder" placeholder="Mobile">
                        </div>
                        <div class="col-sm-12">
                            <label  class="form-label">Email</label>

                            <input type="email" name="transferEmail"  class="form-control is_holder" placeholder="Email">
                        </div>
                        <div class="col-sm-12">
                            <label  class="form-label">Job</label>

                            <input type="text" name="transferJob" class="form-control is_holder" placeholder="Job">
                        </div>

                    </div>
                    <div class="row">
                        <div class="col-12">
                        <label  class="form-label">notes</label>
                        <textarea class="form-control"  name="transferNotes" id="exampleFormControlTextarea1" rows="3"></textarea>
                        </div>
                        <input type="hidden" name="transfer_id" value="{{$TransferCost->transfer_id}}" />
                        <input type="hidden" name="transfer_date" value="{{$TransferCost->transfer_date}}" />
                        <input type="hidden" name="car_model" value="{{$TransferCost->model_enname}}" />
                        <input type="hidden" name="car_class" value="{{$TransferCost->class_enname}}" />
                        <input type="hidden" name="from_loc" value="{{$TransferCost->from_location_enname}}" />
                        <input type="hidden" name="to_loc" value="{{$TransferCost->to_location_enname}}" />
                        <input type="hidden" name="capacity" value="{{$TransferCost->capacity}}" />
                        <input type="hidden" name="fees" value="{{$TransferCost->person_price}}" />
                        <input type="hidden" name="image" value="{{$TransferCost->image}}" />
                    </div>
                </div>


            </div>
            @endif
            @if(count($VisasCost) > 0)
            <h4 class="bg-info px-3 py-1 text-white">Visa Applications Details</h4>
            @foreach ($VisasCost as $idx => $visa)
            @php
                $TotalVisasCost += $visa->cost;
            @endphp
            <h6 class="bg-light-info px-3 py-1">{{$visa->visa_name}}</h6>
            <div class="passenger_info">
                @csrf
                <div class="row">
                    <div class="col-sm-12 col-md-6 col-xl-4">
                        <label  class="form-label">Country
                        </label>
                        <p class="fw-bold">{{$visa->en_country}}</p>
                    </div>
                    <div class="col-sm-12 col-md-6 col-xl-4">
                        <label  class="form-label">Visa Type
                        </label>
                        <p class="fw-bold">{{$visa->en_type}}</p>
                    </div>
                    <div class="col-sm-12 col-md-6 col-xl-4">
                        <label  class="form-label">Nationality</label>

                        <p class="fw-bold">{{$visa->en_nationality}}</p>
                </div>
                <div class="col-sm-12 col-md-6 col-xl-4">
                        <label  class="form-label">Fees</label>

                        <p class="fw-bold">{{$visa->cost}}$</p>
                </div>
                <div class="col-sm-12 col-md-6 col-xl-4">
                        <label  class="form-label">Mobile</label>

                        <p class="fw-bold">{{$visa->visa_phone}}</p>
                </div>
                <div class="col-sm-12 col-md-6 col-xl-4">
                        <label  class="form-label">Email</label>

                        <p class="fw-bold">{{$visa->visa_email}}</p>
                </div>

                <input type="hidden" name="visa_id[{{$idx}}]" value="{{$visa->visa_id}}">
                <input type="hidden" name="visa_name[{{$idx}}]" value="{{$visa->visa_name}}">
                <input type="hidden" name="visa_email[{{$idx}}]" value="{{$visa->visa_email}}">
                <input type="hidden" name="visa_phone[{{$idx}}]" value="{{$visa->visa_phone}}">
                <input type="hidden" name="visa_cost[{{$idx}}]" value="{{$visa->cost}}">

                </div>
            </div>
            @endforeach

            <input type="hidden" name="cost" value="{{$TotalVisasCost}}">

            @endif
            <div class="">
                <div class="row">

                    <div class="form-check mb-3">
                        <input class="form-check-input terms" required type="checkbox" value="" id="flexCheckChecked">
                        <label class="form-check-label" for="flexCheckChecked">
                            I agree to all <a href="{{url('/terms')}}">Terms and Conditions</a> of Safer
                        </label>
                    </div>
                    <div class="col-12 text-center">
                        <button type="submit" class="btn btn-info">Place Order</button>
                    </div>

                </div>
            </div>

        </div>
        <div class="col-sm-12 col-md-6">
            <div class="passenger_info">
                @if ($RoomCost)
                <p class="receipt-title">Hotel Reservation Receipt</p>
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
                            <span class="float-end text-end">{{$RoomCost->rooms_count}} X ${{number_formaT($Cost,2,'.','')}} <br> <span class="fw-bold"> ${{number_format((float)$RoomCost->rooms_count*$Cost,2,'.','')}}</span></span>
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
                            {{$PaidChildren}} X Paid Childs (Age From {{$RoomCost->child_age_from}} To {{$RoomCost->child_age_to}}) <span class="float-end text-end">{{$PaidChildren}} X ${{number_format($RoomCost->child_age_cost,2,'.','')}} <br> <span class="fw-bold">${{number_format($PaidChildren*$RoomCost->child_age_cost, 2, '.', '')}}</span></span><br>
                        </p>

                        <br>
                        @endif
                        <p class="mb-0 pb-0" style="border-top: 1px solid rgb(184, 184, 184)">
                            <span class="float-end text-end fw-bold">${{number_format((float) $RoomCost->rooms_count*$Cost + $PaidChildren*$RoomCost->child_age_cost, 2, '.', '')}}</span><br>
                        </p>
                        <br>
                        <p class="mb-0 pb-0">
                            Booking for {{$RoomCost->nights}} nights<span class="float-end text-end fw-bold">{{$RoomCost->nights}} X ${{number_format(((float)$RoomCost->rooms_count*$Cost + $PaidChildren*$RoomCost->child_age_cost), 2, '.', '')}}</span><br>
                        </p>
                        <div class="grand_total">
                            <h6> Sub-total</h6>
                            <span class="h6"> {{number_format((float) $TotalCost, 2, '.', '')}} <span class="h6">$</span></span>
                        </div>
                        <br>
                    </div>
                </div>
                @endif
                @if(count($ToursCost) > 0)
                    <p class="receipt-title">Tours Reservation Receipt</p>
                    @foreach ($ToursCost as $idx => $TourRec)
                    <div class="booking_info_card">
                        <div class="text-end mb-3"><a class="del-hotel" href="{{url("/cart/$TourRec->id")}}"><i class="fa-solid fa-trash"></i></a></div>
                        <div class="booking_info_card_info">
                            <div class="info_image">
                                <img src="{{ asset('uploads/tours') }}/{{ $TourRec->banner }}" alt=" blogimage" />
                            </div>
                            <div class="info_title">
                                <div class="card_info">
                                    <h6> <a href="{{ url('/hotels/' ) }}"
                                        class="">{{$TourRec->en_name}}</a></h6>
                                        <span> <i class="fa-solid fa-location-dot"></i>{{ $TourRec->en_country }}
                                        <span>|</span> {{ $TourRec->en_city }}</span>
                                </div>
                            </div>
                        </div>
                        <div class="remain_info mb-3">
                            <div class="date">

                            </div>
                            <h5>Tour</h5>

                            <p class="mb-0 pb-0">
                                {{$TourRec->adults_count}} X Adults<span class="float-end text-end">{{$TourRec->adults_count}} X ${{$TourRec->tour_person_cost}}<br><span class="fw-bold">${{$TourRec->adults_count * $TourRec->tour_person_cost}}</span></span>
                            </p>
                            <br>
                            <p class="mb-0 pb-0">
                                {{$TourRec->children_count - ($TotalPaidPersons[$idx] - $TourRec->adults_count)}} X Free Childs (< 2 years) <span class="float-end">Free</span><br>
                            </p>
                            <br>
                            <p class="mb-0 pb-0">
                                {{$TotalPaidPersons[$idx] - $TourRec->adults_count}} X Paid Childs  <span class="float-end text-end">{{$TotalPaidPersons[$idx] - $TourRec->adults_count}} X ${{$TourRec->tour_person_cost}} <br> <span class="fw-bold text-end">${{($TotalPaidPersons[$idx] - $TourRec->adults_count) * $TourRec->tour_person_cost}}</span></span><br>
                            </p>

                            <br>
                            <p class="mb-0 pb-0" style="border-top: 1px solid rgb(184, 184, 184)">
                                <span class="float-end text-end fw-bold">${{$TotalPaidPersons[$idx]*$TourRec->tour_person_cost}}</span><br>
                            </p>
                            <br>
                            <div class="grand_total">
                                <h6> Sub-total</h6>
                                <span class="h6"> ${{$TotalPaidPersons[$idx]*$TourRec->tour_person_cost}}</span></span>
                            </div>

                            <br>
                        </div>

                    </div>
                    @endforeach

                    <div style="border-top: 1px solid rgb(184, 184, 184)" class="mb-2"></div>
                @endif
                @if ($TransferCost)
                <p class="receipt-title">Transportation Receipt</p>
                <div class="booking_info_card">
                    <div class="text-end mb-3"><a class="del-hotel" href="{{url("/cart/$TransferCost->id")}}"><i class="fa-solid fa-trash"></i></a></div>
                    <div class="remain_info mb-3">
                        <h5>Vehicle</h5>

                        <p class="mb-0 pb-0">
                            From: <span class="float-end"> {{$TransferCost->from_location_enname}}</span>
                        </p>
                        <br/>
                        <p class="mb-0 pb-0">
                            To: <span class="float-end"> {{$TransferCost->to_location_enname}}</span>
                        </p>
                        <br>
                        <p class="mb-0 pb-0">
                            Price/Seat <span class="float-end">${{$TransferCost->person_price}}</span><br>
                        </p>
                        <br>
                        <p class="mb-0 pb-0">
                            Capacity: <span class="float-end"> {{$TransferCost->capacity}}</span>
                        </p>

                        <br>
                        <p class="mb-0 pb-0" style="border-top: 1px solid rgb(184, 184, 184)">
                            Total Fees<span class="float-end text-end fw-bold">{{$TransferCost->capacity}} X ${{number_format((float) $TransferCost->person_price, 2, '.', '')}}
                                <br> <span class="fw-bold">${{number_format($TransferCost->person_price, 2, '.', '') * $TransferCost->capacity}}</span></span><br>
                        </p>
                        <br>
                        <div class="grand_total">
                            <h6> Sub-total</h6>
                            <span class="h6"> ${{number_format((float) ($TransferCost->person_price * $TransferCost->capacity), 2, '.', '')}}</span></span>
                        </div>

                        <br>
                    </div>

                </div>
                @endif
                @if (count($VisasCost) > 0)
                <p class="receipt-title">Visa Application Receipt</p>
                <div class="booking_info_card">
                    <div class="text-end mb-3"><a class="del-hotel" href="{{url("/ca")}}"><i class="fa-solid fa-trash"></i></a></div>
                    <div class="remain_info mb-3">
                        <h5>Visa</h5>
                        @foreach ($GPVisasCost as $_visa)
                        <p class="mb-0 pb-0">
                            {{$_visa->en_type}}:<span class="float-end">{{$_visa->groupped_count}} X ${{$_visa->sum_costs}}<span></span>
                        </p>
                        @endforeach

                        <br>
                        <p class="mb-0 pb-0" style="border-top: 1px solid rgb(184, 184, 184)">
                            <span class="float-end text-end fw-bold">${{$TotalVisasCost}}</span><br>
                        </p>
                        <br>
                        <div class="grand_total">
                            <h6> Sub-total</h6>
                            <span class="h6"> {{$TotalVisasCost}}$</span></span>
                        </div>

                        <br>
                    </div>

                </div>
                @endif

                <p class="receipt-title">Total Fees</p>
                <div class="remain_info">
                    <p class="mb-0 pb-0">
                        Before Tax <span class="float-end text-end">${{number_format(($TotalCost + $TotalToursFees + $TotalTransferCost + $TotalVisasCost),2,'.','')}} </span><br>
                    </p>
                    <br>
                    <p class="mb-0 pb-0">
                        VAT (14%) <span class="float-end text-end">${{number_format(($TotalCost + $TotalToursFees + $TotalTransferCost + $TotalVisasCost),2,'.','')}} X 0.14 <br>  <span class="fw-bold">${{number_format((float)($TotalCost + $TotalToursFees+$TotalTransferCost + $TotalVisasCost)*1.14,2,'.','')}}</span></span><br>
                    </p>
                <br/>
                </div>
                <div class="grand_total final">
                    <h5> grand total</h5>
                    <span> <span>$</span>{{number_format(($TotalCost + $TotalToursFees + $TotalTransferCost + $TotalVisasCost)*1.14,2,'.','')}} </span>
                </div>
             </div>
        </div>
    </div>

    </form>
    {{-- <div class="mt-5">
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
    </div> --}}
</section>
@else
<div class="container bg-light-info text-center p-5">Nothing is Added to cart</div>
@endif
@endsection

@section("adds_js")
<script>
    $("#transHolderFlag").change(function(){
        $(".trans-holder").fadeToggle();
        if ($(".is_holder").attr('required')) {
            $(".is_holder").removeAttr('required');
        } else {
            $(".is_holder").attr('required', 6);
        }
    });
</script>
@endsection
