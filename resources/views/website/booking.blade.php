@extends('layout.website.layout', ['Company' => $Company, 'title' => 'Safer | User Cart'])

@section('adds_css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.css" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="{{ asset('/website_assets/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('/website_assets/css/about.css') }}">
    <link rel="stylesheet" href="{{ asset('/website_assets/css/tours.css') }}">
    <link rel="stylesheet" href="{{ asset('/website_assets/css/hotel.css') }}">
    <link rel="stylesheet" href="{{ asset('/website_assets/css/booking-hotel.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.css">
@endsection

@section('bottom-header')
    <x-website.header.general title="{{ __('links.cart') }} " :breadcrumb="$BreadCrumb" current="{{ __('links.preBook') }}" />
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
                if ($RoomCost->room_cap == 1) {
                    $Type = __('links.single');
                    $Cost = $RoomCost->single_cost;
                } elseif ($RoomCost->room_cap == 2) {
                    $Type = __('links.double');
                    $Cost = $RoomCost->double_cost;
                } elseif ($RoomCost->room_cap == 3) {
                    $Type = __('links.triple');
                    $Cost = $RoomCost->triple_cost;
                }

                $ChildrenCost = 0;
                $FreeChildren = 0;
                $PaidChildren = 0;
                $ages = null;
                if ($RoomCost->children_count) {
                    $ages = explode(',', $RoomCost->ages);
                    $ChildrenCost = 0;
                    $FreeChildren = 0;
                    $PaidChildren = 0;
                    for ($i = 0; $i < $RoomCost->children_count; $i++) {
                        if ($ages[$i] >= $RoomCost->child_free_age_from && $ages[$i] <= $RoomCost->child_free_age_to) {
                            $FreeChildren++;
                        } else {
                            $PaidChildren++;
                        }
                    }
                }

                $TotalCost = $RoomCost->nights * ($RoomCost->rooms_count * $Cost + $PaidChildren * $RoomCost->child_age_cost);
            @endphp
        @endif
        @if (count($ToursCost) > 0)
            @php
                $TotalToursFees = 0;
            @endphp
        @endif
        @if ($TransferCost)
            @php
                $TotalTransferCost = $TransferCost->person_price;
            @endphp
        @endif
        @if (count($VisasCost) > 0)
            @php
                $TotalVisasCost = 0;
            @endphp
        @endif
        {{-- <a href="www.google.com" class="delete_confirm">aaa</a> --}}
        <!-- passenger details -->
        <section class="passenger_section container">
            <h5> {{ __('links.cartDetails') }} </h5>
            <form action="{{ url('/Book') }}" method="POST">
                <div class="row mx-0">
                    <div class="col-12">
                        <h4 class="bg-info px-3 py-1 text-white">
                            @if (LaravelLocalization::getCurrentLocale() === 'en')
                                Hotel Room Reservation Details
                            @else
                                تفاصيل حجز غرفة الفندق
                            @endif
                        </h4>
                    </div>
                    <div class="col-sm-12 col-md-6">
                        <input type="hidden" name="tax_percentage" value="{{ $tax_percentage }}">
                        @if ($RoomCost)

                            <div class="passenger_info">
                                @csrf
                                <div class="row">

                                    <h6>
                                        @if (LaravelLocalization::getCurrentLocale() === 'en')
                                            Reservation Holder Details:
                                        @else
                                            تفاصيل مسئول الحجز:
                                        @endif
                                    </h6>
                                    {{-- <div class="col-sm-12 col-md-6 col-xl-4">
                                        <label class="form-label">
                                            {{ __('links.salutation') }}
                                        </label>
                                        <input type="text" name="adultsSal[]" required class="form-control"
                                            placeholder=" {{ __('links.mr') }}" aria-label="First name">
                                    </div> --}}
                                    <div class="col-sm-12 col-md-6 col-xl-8">
                                        <label class="form-label"> {{ __('links.cName') }} </label>

                                        <input type="text" name="adultsNames[]" required
                                            value="{{ session()->get('SiteUser')['Name'] }}" class="form-control"
                                            placeholder="{{ __('links.cName') }}">
                                    </div>
                                    <div class="col-sm-12 col-md-6 col-xl-4">
                                        <label class="form-label">{{ __('links.mobile') }}</label>

                                        <input type="text" name="adultsMobile[]" required class="form-control"
                                            placeholder="{{ __('links.mobile') }}">
                                    </div>
                                </div>
                                @if ($RoomCost->adults_count - 1 > 0)
                                    <h6>
                                        @if (LaravelLocalization::getCurrentLocale() === 'en')
                                            Adults Details:
                                        @else
                                            تفاصيل البالغين:
                                        @endif
                                    </h6>
                                    @for ($j = 0; $j < $RoomCost->adults_count - 1; $j++)
                                        <div class="row">
                                            <div class="col-sm-12 col-md-6 col-xl-4">
                                                <label class="form-label">{{ __('links.salutation') }}
                                                    Salutation
                                                </label>
                                                <input type="text" name="adultsSal[]" required class="form-control"
                                                    placeholder="{{ __('links.mr') }} " aria-label="First name">
                                            </div>
                                            <div class="col-sm-12 col-md-6 col-xl-4">
                                                <label class="form-label">{{ __('links.cName') }} </label>

                                                <input type="text" name="adultsNames[]" required class="form-control"
                                                    placeholder="{{ __('links.cName') }} ">
                                            </div>
                                            <div class="col-sm-12 col-md-6 col-xl-4">
                                                <label class="form-label">{{ __('links.mobile') }} </label>

                                                <input type="text" name="adultsMobile[]" required class="form-control"
                                                    placeholder="{{ __('links.mobile') }} ">
                                            </div>
                                        </div>
                                    @endfor
                                @endif
                                @for ($i = 0; $i < $RoomCost->children_count; $i++)
                                    <div class="row">
                                        <div class="col-sm-12">
                                            @if (LaravelLocalization::getCurrentLocale() === 'en')
                                                <label class="form-label">Child Details (Age: {{ $ages[$i] }}):
                                                </label>
                                            @else
                                                <label class="form-label">تفاصيل الاطفال (عمر : {{ $ages[$i] }}):
                                                </label>
                                            @endif

                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-12 col-md-6">
                                            <label class="form-label">{{ __('links.cName') }}
                                            </label>
                                            <input type="text" class="form-control" required name="childrenNames[]"
                                                placeholder="{{ __('links.cName') }} " aria-label="First name">
                                            <input type="hidden" name="childrenAges[]" required
                                                value="{{ $ages[$i] }}" />
                                        </div>
                                    </div>
                                @endfor
                                <div class="row">

                                    <div class="col-12">
                                        <label class="form-label">{{ __('links.notes') }} </label>
                                        <textarea class="form-control" name="{{ __('links.notes') }} " id="exampleFormControlTextarea1" rows="3"></textarea>
                                    </div>

                                    <input type="hidden" name="cart_id" value="{{ $RoomCost->id }}" />
                                    <input type="hidden" name="hotel_id" value="{{ $RoomCost->hotel_id }}" />
                                    <input type="hidden" name="from_date" value="{{ $RoomCost->from_date }}" />
                                    <input type="hidden" name="to_date" value="{{ $RoomCost->to_date }}" />
                                    <input type="hidden" name="nights" value="{{ $RoomCost->nights }}" />
                                    <input type="hidden" name="adults_count" value="{{ $RoomCost->adults_count }}" />
                                    <input type="hidden" name="children_count"
                                        value="{{ $RoomCost->children_count }}" />
                                    <input type="hidden" name="rooms_count" value="{{ $RoomCost->rooms_count }}" />
                                    <input type="hidden" name="room_type" value="{{ $Type }}" />
                                    <input type="hidden" name="room_view" value="{{ $RoomCost->en_room_type }}" />
                                    <input type="hidden" name="food_bev_type" value="{{ $RoomCost->food_bev_type }}" />
                                    <input type="hidden" name="room_cost" value="{{ $Cost }}" />
                                    <input type="hidden" name="total_cost" value="{{ $TotalCost }}" />
                                    <input type="hidden" name="paid_num" value="{{ $PaidChildren }}" />
                                    <input type="hidden" name="room_id" value="{{ $RoomCost->room_type_cost_id }}" />
                                    <input type="hidden" name="room_cap" value="{{ $RoomCost->room_cap }}" />
                                    <input type="hidden" name="user_id" value="{{ $RoomCost->user_id }}" />
                                    <input type="hidden" name="child_free_age_from"
                                        value="{{ $RoomCost->child_free_age_from }}" />
                                    <input type="hidden" name="child_free_age_to"
                                        value="{{ $RoomCost->child_free_age_to }}" />
                                    <input type="hidden" name="child_age_cost"
                                        value="{{ $RoomCost->child_age_cost }}" />

                                </div>
                            </div>
                        @endif
                    </div>
                    <div class="col-sm-12 col-md-6">
                        <div class="passenger_info">
                            @if ($RoomCost)
                                <p class="receipt-title">
                                    @if (LaravelLocalization::getCurrentLocale() === 'en')
                                        Hotel Reservation Receipt
                                    @else
                                        إيصال حجز الفندق
                                    @endif
                                </p>
                                <div class="booking_info_card">
                                    <div class="text-end mb-3">
                                        <a class="del-hotel delete_trash" href="{{ url("/cart/$RoomCost->id") }}"><i
                                                class="fa-solid fa-trash"></i></a>
                                    </div>
                                    <div class="booking_info_card_info">
                                        <div class="info_image">
                                            <img src="{{ asset('uploads/hotels') }}/{{ $RoomCost->hotel_banner }}"
                                                alt=" blogimage" />
                                        </div>
                                        <div class="info_title px-2">
                                            <div class="card_info">
                                                @if (LaravelLocalization::getCurrentLocale() === 'en')
                                                    <h6> <a href="{{ url('/hotels/' . $RoomCost->hotel_id) }}"
                                                            class="">{{ $RoomCost->hotel_enname }} –
                                                            {{ $RoomCost->hotel_stars }} Stars</a></h6>
                                                    <span> <i
                                                            class="fa-solid fa-location-dot"></i>{{ $RoomCost->en_country }}
                                                        <span>|</span> {{ $RoomCost->en_city }}</span>
                                                @else
                                                    <h6> <a href="{{ url('/hotels/' . $RoomCost->hotel_id) }}"
                                                            class="">{{ $RoomCost->hotel_arname ?? '' }} –
                                                            {{ $RoomCost->hotel_stars }} Stars</a></h6>
                                                    <span> <i
                                                            class="fa-solid fa-location-dot"></i>{{ $RoomCost->ar_country ?? '' }}
                                                        <span>|</span> {{ $RoomCost->ar_city ?? '' }}</span>
                                                @endif

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
                                            @if (LaravelLocalization::getCurrentLocale() === 'en')
                                                booking for {{ $RoomCost->nights }} nights
                                            @else
                                                الحجز ل {{ $RoomCost->nights }} ليالي
                                            @endif

                                        </h5>
                                        <div class="date">

                                        </div>
                                        <h5>{{ __('links.rooms') }} </h5>

                                        <p class="mb-0 pb-0">
                                            {{ $RoomCost->rooms_count }} X {{ $RoomCost->en_room_type }}
                                            {{ $Type }}
                                            ({{ $RoomCost->food_bev_type }})
                                            <span class=" text-end">{{ $RoomCost->rooms_count }} X
                                                ${{ number_formaT($Cost, 2, '.', '') }} <br> <span class="fw-bold">
                                                    ${{ number_format((float) $RoomCost->rooms_count * $Cost, 2, '.', '') }}</span></span>
                                        </p>
                                        <br>
                                        <p class="mb-0 pb-0">
                                            {{ $RoomCost->adults_count }} X {{ __('links.adult') }}
                                        </p>
                                        <br>
                                        @if ($ages)
                                            <p class="mb-0 pb-0">
                                                @if (LaravelLocalization::getCurrentLocale() === 'en')
                                                    {{ $FreeChildren }} X Free Childs (Age From
                                                    {{ $RoomCost->child_free_age_from }} To
                                                    {{ $RoomCost->child_free_age_to }}) <span
                                                        class="">Free</span><br>
                                                @else
                                                    {{ $FreeChildren }} X اطفال مجاني (Age From
                                                    {{ $RoomCost->child_free_age_from }} الي
                                                    {{ $RoomCost->child_free_age_to }}) <span
                                                        class="">مجاني</span><br>
                                                @endif
                                            </p>
                                            <br>
                                            <p class="mb-0 pb-0">
                                                @if (LaravelLocalization::getCurrentLocale() === 'en')
                                                    {{ $PaidChildren }} X Paid Childs (Age From
                                                    {{ $RoomCost->child_age_from }} To {{ $RoomCost->child_age_to }})
                                                    <span class=" text-end">{{ $PaidChildren }} X
                                                        ${{ number_format($RoomCost->child_age_cost, 2, '.', '') }} <br>
                                                        <span
                                                            class="fw-bold">${{ number_format($PaidChildren * $RoomCost->child_age_cost, 2, '.', '') }}</span></span><br>
                                                @else
                                                    {{ $PaidChildren }} X الاطفال المدفوعة (Age From
                                                    {{ $RoomCost->child_age_from }} الي {{ $RoomCost->child_age_to }})
                                                    <span class=" text-end">{{ $PaidChildren }} X
                                                        ${{ number_format($RoomCost->child_age_cost, 2, '.', '') }} <br>
                                                        <span
                                                            class="fw-bold">${{ number_format($PaidChildren * $RoomCost->child_age_cost, 2, '.', '') }}</span></span><br>
                                                @endif
                                            </p>

                                            <br>
                                        @endif
                                        <p class="mb-0 pb-0" style="border-top: 1px solid rgb(184, 184, 184)">
                                            <span
                                                class=" text-end fw-bold">${{ number_format((float) $RoomCost->rooms_count * $Cost + $PaidChildren * $RoomCost->child_age_cost, 2, '.', '') }}</span><br>
                                        </p>
                                        <br>
                                        <p class="mb-0 pb-0">
                                            @if (LaravelLocalization::getCurrentLocale() === 'en')
                                                Booking for {{ $RoomCost->nights }} nights<span
                                                    class=" text-end fw-bold">{{ $RoomCost->nights }} X
                                                    ${{ number_format((float) $RoomCost->rooms_count * $Cost + $PaidChildren * $RoomCost->child_age_cost, 2, '.', '') }}</span><br>
                                            @else
                                                الحجز من {{ $RoomCost->nights }} ليالي<span
                                                    class=" text-end fw-bold">{{ $RoomCost->nights }} X
                                                    ${{ number_format((float) $RoomCost->rooms_count * $Cost + $PaidChildren * $RoomCost->child_age_cost, 2, '.', '') }}</span><br>
                                            @endif
                                        </p>
                                        <div class="grand_total">
                                            <h6>
                                                @if (LaravelLocalization::getCurrentLocale() === 'en')
                                                    Sub-total
                                                @else
                                                    المجموع الفرعي
                                                @endif
                                            </h6>
                                            <span class="h6"> {{ number_format((float) $TotalCost, 2, '.', '') }}
                                                <span class="h6">$</span></span>
                                        </div>
                                        <br>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                    <div class="col-12 mb-4" style="border-bottom: 1px solid #d5d5d5">
                        <hr />

                    </div>
                    <div class="col-12">
                        @if (count($ToursCost) > 0)
                            <h4 class="bg-info px-3 py-1 text-white">
                                @if (LaravelLocalization::getCurrentLocale() === 'en')
                                    Tours Reservation Details
                                @else
                                    تفاصيل حجز الرحلات
                                @endif
                            </h4>
                            <div class="row">
                                @foreach ($ToursCost as $index => $Tour)
                                    @php
                                        $TotalPaidPersons[$index] = $Tour->adults_count;
                                    @endphp
                                    <div class="col-sm-12 col-md-6">
                                        <h6 class="bg-light-info px-3 py-1">
                                            @if (LaravelLocalization::getCurrentLocale() === 'en')
                                                {{ $Tour->en_name }}
                                            @else
                                                {{ $Tour->ar_name ?? '' }}
                                            @endif <span
                                                class="">{{ $Tour->tour_date }}</span>
                                        </h6>
                                        <div class="passenger_info">
                                            @csrf
                                            <div class="row">
                                                <h6>
                                                    @if (LaravelLocalization::getCurrentLocale() === 'en')
                                                        Reservation Holder Details:
                                                    @else
                                                        تفاصيل مسئول الحجز:
                                                    @endif
                                                </h6>
                                                {{-- <div class="col-sm-12 col-md-6 col-xl-4">
                                                    <label class="form-label">{{ __('links.salutation') }}
                                                    </label>
                                                    <input type="text" name="tour_adults_sal[{{ $index }}][]"
                                                        required class="form-control"
                                                        placeholder="{{ __('links.mr') }} " aria-label="First name">
                                                </div> --}}
                                                @if($index > 0)
                                                <div class="col-12">
                                                    <button type="button" onclick="copyData({{$index - 1}})" class="btn btn-outline-primary float-end mb-3">Copy Data from Above</button>
                                                </div>
                                                @endif
                                                <div class="col-sm-12 col-md-6 col-xl-8">
                                                    <label class="form-label">{{ __('links.cName') }} </label>

                                                    <input type="text" name="tour_adults_name[{{ $index }}][]"
                                                        value="{{ session()->get('SiteUser')['Name'] }}" required
                                                        class="form-control" id="holder-name-{{$index}}" placeholder="{{ __('links.cName') }} ">
                                                </div>
                                                <div class="col-sm-12 col-md-6 col-xl-4">
                                                    <label class="form-label">{{ __('links.mobile') }} </label>

                                                    <input type="text"
                                                        name="tour_adults_mobile[{{ $index }}][]" required
                                                        class="form-control" id="holder-phone-{{$index}}" placeholder="{{ __('links.mobile') }} ">
                                                </div>
                                                <div class="col-sm-12 col-md-8">
                                                    <label class="form-label">{{ __('links.email') }} </label>

                                                    <input type="text"
                                                        name="tour_adults_email[{{ $index }}][]" required
                                                        class="form-control" id="holder-email-{{$index}}"
                                                        value="{{ session()->get('SiteUser')['Email'] }}"
                                                        placeholder="{{ __('links.email') }} ">
                                                </div>
                                                <div class="col-sm-12 col-md-8">
                                                    <label class="form-label">{{ __('links.pickupP') }}</label>

                                                    <input type="text" name="tour_pickup_point[{{ $index }}]"
                                                        required class="form-control" id="holder-pickup-{{$index}}"
                                                        placeholder="{{ __('links.pickupP') }}">
                                                </div>
                                            </div>
                                            <h6>
                                                @if (LaravelLocalization::getCurrentLocale() === 'en')
                                                    Adults Details:
                                                @else
                                                    تفاصيل البالغين:
                                                @endif
                                            </h6>
                                            @for ($j = 0; $j < $Tour->adults_count - 1; $j++)
                                                <div class="row">
                                                    {{-- <div class="col-sm-12 col-md-6 col-xl-4">
                                                        <label class="form-label">{{ __('links.salutation') }}
                                                        </label>
                                                        <input type="text"
                                                            name="tour_adults_sal[{{ $index }}][]" required
                                                            class="form-control" placeholder="{{ __('links.mr') }} MR"
                                                            aria-label="First name">
                                                    </div> --}}
                                                    <div class="col-sm-12 col-md-6 col-xl-8">
                                                        <label class="form-label">{{ __('links.cName') }} </label>

                                                        <input type="text"
                                                            name="tour_adults_name[{{ $index }}][]" required
                                                            class="form-control" placeholder="{{ __('links.cName') }} ">
                                                    </div>
                                                    <div class="col-sm-12 col-md-6 col-xl-4">
                                                        <label class="form-label">{{ __('links.mobile') }}</label>

                                                        <input type="text"
                                                            name="tour_adults_mobile[{{ $index }}][]" required
                                                            class="form-control"
                                                            placeholder="{{ __('links.mobile') }} ">
                                                    </div>
                                                    <div class="col-sm-12 col-md-8">
                                                        <label class="form-label">{{ __('links.email') }} </label>

                                                        <input type="text"
                                                            name="tour_adults_email[{{ $index }}][]" required
                                                            class="form-control" placeholder="{{ __('links.email') }} ">
                                                    </div>
                                                </div>
                                            @endfor
                                            @for ($i = 0; $i < $Tour->children_count; $i++)
                                                @php
                                                    if ($Tour->ages && explode(',', $Tour->ages)[$i] > 2) {
                                                        $TotalPaidPersons[$index]++;
                                                    }
                                                @endphp
                                                <div class="row">
                                                    <div class="col-sm-12">
                                                        @if (LaravelLocalization::getCurrentLocale() === 'en')
                                                            <label class="form-label">Child Details (Age:
                                                                {{ explode(',', $Tour->ages)[$i] }}):
                                                            </label>
                                                        @else
                                                            <label class="form-label">تفاصيل الاطفال (العمر:
                                                                {{ explode(',', $Tour->ages)[$i] }}):
                                                            </label>
                                                        @endif

                                                    </div>
                                                </div>

                                                <div class="row">
                                                    <div class="col-sm-12 col-md-6">
                                                        <label class="form-label">{{ __('links.cName') }}
                                                        </label>
                                                        <input type="text" class="form-control" required
                                                            name="tour_child_name[{{ $index }}][]"
                                                            placeholder="{{ __('links.cName') }} "
                                                            aria-label="First name">
                                                        <input type="hidden"
                                                            name="tour_child_age[{{ $index }}][]" required
                                                            value="{{ explode(',', $Tour->ages)[$i] }}" />
                                                    </div>
                                                </div>
                                            @endfor
                                            <div class="row">

                                                <div class="col-12">
                                                    <label class="form-label">{{ __('links.notes') }} </label>
                                                    <textarea class="form-control" name="tour_notes[{{ $index }}]" id="holder-notes-{{$index}}"
                                                        rows="3"></textarea>
                                                </div>
                                                <input type="hidden" name="tour_id[{{ $index }}]"
                                                    value="{{ $Tour->tour_id }}" />
                                                <input type="hidden" name="tour_date[{{ $index }}]"
                                                    value="{{ $Tour->tour_date }}" />
                                                <input type="hidden" name="tour_adults_count[{{ $index }}]"
                                                    value="{{ $Tour->adults_count }}" />
                                                <input type="hidden" name="tour_children_count[{{ $index }}]"
                                                    value="{{ $Tour->children_count }}" />
                                                @php
                                                    $TourTotalCost[$index] = $Tour->tour_person_cost * $TotalPaidPersons[$index];
                                                    $TotalToursFees += $TourTotalCost[$index];
                                                @endphp
                                                <input type="hidden" name="tour_total_cost[{{ $index }}]"
                                                    value="{{ $TourTotalCost[$index] }}" />
                                                <input type="hidden" name="tour_cost[{{ $index }}]"
                                                    value="{{ $Tour->tour_person_cost }}" />
                                                <input type="hidden" name="tour_ages[{{ $index }}]"
                                                    value="{{ $Tour->ages }}" />
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-sm-12 col-md-6">
                                        <div class="passenger_info">
                                            <p class="receipt-title">
                                                @if (LaravelLocalization::getCurrentLocale() === 'en')
                                                    Tours Reservation Receipt
                                                @else
                                                    إيصال حجز الجولات
                                                @endif
                                            </p>
                                            <div class="booking_info_card">
                                                <div class="text-end mb-3"><a class="del-hotel delete_trash"
                                                        href="{{ url("/cart/$Tour->id") }}"><i
                                                            class="fa-solid fa-trash"></i></a></div>
                                                <div class="booking_info_card_info">
                                                    <div class="info_image">
                                                        <img src="{{ asset('uploads/tours') }}/{{ $Tour->banner }}"
                                                            alt=" blogimage" />
                                                    </div>
                                                    <div class="info_title px-2">
                                                        <div class="card_info">
                                                            @if (LaravelLocalization::getCurrentLocale() === 'en')
                                                                <h6> <a href="{{ url('/hotels/') }}"
                                                                        class="">{{ $Tour->en_name }}</a></h6>
                                                                <span> <i
                                                                        class="fa-solid fa-location-dot"></i>{{ $Tour->en_country }}
                                                                    <span>|</span> {{ $Tour->en_city }}</span>
                                                            @else
                                                                <h6> <a href="{{ url('/hotels/') }}"
                                                                        class="">{{ $Tour->ar_name ?? '' }}</a>
                                                                </h6>
                                                                <span> <i
                                                                        class="fa-solid fa-location-dot"></i>{{ $Tour->ar_country ?? '' }}
                                                                    <span>|</span> {{ $Tour->ar_city ?? '' }}</span>
                                                            @endif

                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="remain_info mb-3">
                                                    <div class="date">

                                                    </div>
                                                    <h5>{{ __('links.tours') }} </h5>

                                                    <p class="mb-0 pb-0">
                                                        {{ $Tour->adults_count }} X {{ __('links.adult') }} <span
                                                            class=" text-end">{{ $Tour->adults_count }} X
                                                            ${{ $Tour->tour_person_cost }}<br><span
                                                                class="fw-bold">${{ $Tour->adults_count * $Tour->tour_person_cost }}</span></span>
                                                    </p>
                                                    <br>
                                                    <p class="mb-0 pb-0">
                                                        @if (LaravelLocalization::getCurrentLocale() === 'en')
                                                            {{ $Tour->children_count - ($TotalPaidPersons[$index] - $Tour->adults_count) }}
                                                            X Free Childs (< 2 years) <span class="">Free</span><br>
                                                            @else
                                                                {{ $Tour->children_count - ($TotalPaidPersons[$index] - $Tour->adults_count) }}
                                                                X اطفال مجاني (< سنتين) <span class="">
                                                                    مجاني</span><br>
                                                        @endif
                                                    </p>
                                                    <br>
                                                    <p class="mb-0 pb-0">
                                                        @if (LaravelLocalization::getCurrentLocale() === 'en')
                                                            {{ $TotalPaidPersons[$index] - $Tour->adults_count }} X Paid
                                                            Childs
                                                            <span
                                                                class=" text-end">{{ $TotalPaidPersons[$index] - $Tour->adults_count }}
                                                                X ${{ $Tour->tour_person_cost }} <br> <span
                                                                    class="fw-bold text-end">${{ ($TotalPaidPersons[$index] - $Tour->adults_count) * $Tour->tour_person_cost }}</span></span><br>
                                                        @else
                                                            {{ $TotalPaidPersons[$index] - $Tour->adults_count }} X اطفال
                                                            مدفوعة
                                                            <span
                                                                class=" text-end">{{ $TotalPaidPersons[$index] - $Tour->adults_count }}
                                                                X ${{ $Tour->tour_person_cost }} <br> <span
                                                                    class="fw-bold text-end">${{ ($TotalPaidPersons[$index] - $Tour->adults_count) * $Tour->tour_person_cost }}</span></span><br>
                                                        @endif
                                                    </p>

                                                    <br>
                                                    <p class="mb-0 pb-0" style="border-top: 1px solid rgb(184, 184, 184)">
                                                        <span
                                                            class=" text-end fw-bold">${{ $TotalPaidPersons[$index] * $Tour->tour_person_cost }}</span><br>
                                                    </p>
                                                    <br>
                                                    <div class="grand_total">
                                                        <h6>
                                                            @if (LaravelLocalization::getCurrentLocale() === 'en')
                                                                Sub-total
                                                            @else
                                                                المجموع الفرعي
                                                            @endif
                                                        </h6>
                                                        <span class="h6">
                                                            ${{ $TotalPaidPersons[$index] * $Tour->tour_person_cost }}</span></span>
                                                    </div>

                                                    <br>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 mb-4" style="border-bottom: 1px solid #d5d5d5">
                                        <hr />

                                    </div>
                                @endforeach
                            </div>
                        @endif
                    </div>
                    <div class="col-12">
                        @if ($TransferCost)
                            <h4 class="bg-info px-3 py-1 text-white">
                                @if (LaravelLocalization::getCurrentLocale() === 'en')
                                    Transportation Reservation Details
                                @else
                                    تفاصيل حجز الإنتقالات
                                @endif
                            </h4>
                            <div class="row">
                                <div class="col-sm-12 col-md-6">
                                    <div class="passenger_info">
                                        @csrf
                                        <div class="row my-2">
                                            <h6 class="fw-bold">
                                                @if (LaravelLocalization::getCurrentLocale() === 'en')
                                                    Vehicle Details:
                                                @else
                                                    تفاصيل السيارة:
                                                @endif
                                            </h6>
                                            <div class="col-md-4 mb-3">
                                                <div class="img-holder"
                                                    style="background-image: url('{{ asset('uploads/carModels') }}/{{ $TransferCost->image }}')">
                                                </div>
                                            </div>
                                            <div class="col-md-8">
                                                @if (LaravelLocalization::getCurrentLocale() === 'en')
                                                    <p class="mb-0">Car Model:
                                                        <strong>{{ $TransferCost->model_enname }}</strong>
                                                    </p>
                                                    <p class="mb-0">Car Capacity:
                                                        <strong>{{ $TransferCost->capacity }}</strong>
                                                    </p>
                                                    <p class="mb-0">Class Type:
                                                        <strong>{{ $TransferCost->class_enname }}</strong>
                                                    </p>
                                                    <p class="mb-0">Starting point (from):
                                                        <strong>{{ $TransferCost->from_location_enname }}</strong>
                                                    </p>
                                                    <p class="mb-0">Route Destination (to):
                                                        <strong>{{ $TransferCost->to_location_enname }}</strong>
                                                    </p>
                                                    <p class="mb-0">Transportation Fees:
                                                        <strong>{{ $TransferCost->person_price }}$</strong>
                                                    </p>
                                                @else
                                                    <p class="mb-0">موديل السيارة:
                                                        <strong>{{ $TransferCost->model_arname ?? '' }}</strong>
                                                    </p>
                                                    <p class="mb-0">سعة السيارة:
                                                        <strong>{{ $TransferCost->capacity }}</strong>
                                                    </p>
                                                    <p class="mb-0">فئه السيارة:
                                                        <strong>{{ $TransferCost->class_arname ?? '' }}</strong>
                                                    </p>
                                                    <p class="mb-0">نقطه البداية (من):
                                                        <strong>{{ $TransferCost->from_location_arname ?? '' }}</strong>
                                                    </p>
                                                    <p class="mb-0">نقطة الوصول (الي):
                                                        <strong>{{ $TransferCost->to_location_arname ?? '' }}</strong>
                                                    </p>
                                                    <p class="mb-0">تكلفة الرحلة:
                                                        <strong>{{ $TransferCost->person_price }}$</strong>
                                                    </p>
                                                @endif

                                            </div>

                                            <h6 class="fw-bold">
                                                @if (LaravelLocalization::getCurrentLocale() === 'en')
                                                    Reservation Holder Details:
                                                @else
                                                    تفاصيل مسئول الحجز:
                                                @endif
                                            </h6>
                                            <div class="row">
                                                {{-- <div class="col-sm-12 col-md-6 col-xl-4">
                                                    <label class="form-label">{{ __('links.salutation') }}
                                                    </label>
                                                    <input type="text" name="transferSal" class="form-control"
                                                        required="required" placeholder="{{ __('links.mr') }}"
                                                        aria-label="First name">
                                                </div> --}}
                                                <div class="col-sm-12 col-md-6 col-xl-8">
                                                    <label class="form-label">{{ __('links.cName') }} </label>

                                                    <input type="text" name="transferName"
                                                        value="{{ session()->get('SiteUser')['Name'] }}"
                                                        class="form-control" required="required"
                                                        placeholder="{{ __('links.cName') }}">
                                                </div>
                                                <div class="col-sm-12 col-md-6 col-xl-4">
                                                    <label class="form-label">{{ __('links.mobile') }} </label>

                                                    <input type="text" name="transferMobile" class="form-control"
                                                        required="required" placeholder="{{ __('links.mobile') }}">
                                                </div>
                                                <div class="col-sm-12">
                                                    <label class="form-label">{{ __('links.email') }} </label>

                                                    <input type="email" name="transferEmail"
                                                        value="{{ session()->get('SiteUser')['Email'] }}"
                                                        class="form-control" required="required"
                                                        placeholder="{{ __('links.email') }}">
                                                </div>
                                                <div class="col-sm-12">
                                                    <label class="form-label">{{ __('links.job') }}</label>

                                                    <input type="text" name="transferJob" class="form-control"
                                                        placeholder="{{ __('links.job') }}">
                                                </div>
                                                <div class="col-sm-12">
                                                    <label class="form-label">{{ __('links.hotel') }}</label>

                                                    <input type="text" name="hotel_name" class="form-control"
                                                        required="required" placeholder="{{ __('links.hotel') }}">
                                                </div>

                                            </div>
                                            <div class="row">
                                                <div class="col-12">
                                                    <label class="form-label">{{ __('links.notes') }}</label>
                                                    <textarea class="form-control" name="transferNotes" id="exampleFormControlTextarea1" rows="3"></textarea>
                                                </div>
                                                <input type="hidden" name="transfer_id"
                                                    value="{{ $TransferCost->transfer_id }}" />
                                                <input type="hidden" name="transfer_date"
                                                    value="{{ $TransferCost->transfer_date }}" />
                                                <input type="hidden" name="car_model"
                                                    value="@if (LaravelLocalization::getCurrentLocale() === 'en') {{ $TransferCost->model_enname }}
                                                    @else
                                                    {{ $TransferCost->model_arname ?? '' }} @endif" />
                                                <input type="hidden" name="car_class"
                                                    value="@if (LaravelLocalization::getCurrentLocale() === 'en') {{ $TransferCost->class_enname }}

                                                    @else
                                                    {{ $TransferCost->class_arname ?? '' }} @endif" />
                                                <input type="hidden" name="from_loc"
                                                    value="@if (LaravelLocalization::getCurrentLocale() === 'en') {{ $TransferCost->from_location_enname }}

                                                    @else
                                                    {{ $TransferCost->from_location_arname ?? '' }} @endif" />
                                                <input type="hidden" name="to_loc"
                                                    value="@if (LaravelLocalization::getCurrentLocale() === 'en') {{ $TransferCost->to_location_enname }}

                                                    @else
                                                    {{ $TransferCost->to_location_arname ?? '' }} @endif" />

                                                <input type="hidden" name="capacity"
                                                    value="{{ $TransferCost->capacity }}" />
                                                <input type="hidden" name="fees" id="t_price"
                                                    value="{{ $TransferCost->person_price }}" />
                                                <input type="hidden" name="image"
                                                    value="{{ $TransferCost->image }}" />
                                            </div>
                                            <div class="row">
                                                <div class="col-12">
                                                    <div class="form-check my-2">
                                                        <input class="form-check-input" type="checkbox"
                                                            name="default_holder" id="transHolderFlag">
                                                        <label class="form-check-label ps-2" for="transHolderFlag">
                                                            @if (LaravelLocalization::getCurrentLocale() === 'en')
                                                                Go & Return
                                                            @else
                                                                ذهاب & عودة
                                                            @endif

                                                        </label>
                                                    </div>
                                                    <div class="row trans-holder" style="display: none;">
                                                        <div class="col-sm-12 col-md-8">
                                                            <label class="mb-2">
                                                                @if (LaravelLocalization::getCurrentLocale() === 'en')
                                                                    Return Date
                                                                @else
                                                                    تاريخ العودة
                                                                @endif

                                                            </label>
                                                            <br />
                                                            <div class="details px-1">
                                                                <input type="text" id="transfer_date"
                                                                    min="{{ $TransferCost->transfer_date }}"
                                                                    placeholder="DD/MM/YYYY"
                                                                    class="form-control transfer_date is_holder"
                                                                    name="return" max="2025-12-31" autocomplete="off">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>


                                    </div>
                                </div>
                                <div class="col-sm-12 col-md-6">
                                    <div class="passenger_info">
                                        <p class="receipt-title">
                                            @if (LaravelLocalization::getCurrentLocale() === 'en')
                                                Transportation Receipt
                                            @else
                                                إيصال الإنتقال
                                            @endif
                                        </p>
                                        <div class="booking_info_card">
                                            {{-- onclick='confirmClick(event)' --}}
                                            <div class="text-end mb-3"><a class="del-hotel delete_trash"
                                                    href="{{ url("/cart/$TransferCost->id") }}"><i
                                                        class="fa-solid fa-trash"></i></a></div>
                                            <div class="remain_info mb-3">
                                                <h5>
                                                    @if (LaravelLocalization::getCurrentLocale() === 'en')
                                                        Vehicle
                                                    @else
                                                        تفاصيل الإنتقال
                                                    @endif
                                                </h5>

                                                <p class="mb-0 pb-0">
                                                    {{ __('links.from') }} : <span class="">
                                                        {{ $TransferCost->from_location_enname }}</span>
                                                </p>
                                                <br />
                                                <p class="mb-0 pb-0">
                                                    {{ __('links.to') }} : <span class="">
                                                        {{ $TransferCost->to_location_enname }}</span>
                                                </p>
                                                <br>
                                                <p class="mb-0 pb-0">
                                                    @if (LaravelLocalization::getCurrentLocale() === 'en')
                                                        Transportation Date :
                                                    @else
                                                        تاريخ الإنتقال:
                                                    @endif <span class="">
                                                        {{ $TransferCost->transfer_date }}</span>
                                                </p>
                                                <br>
                                                <p class="mb-0 pb-0">
                                                    @if (LaravelLocalization::getCurrentLocale() === 'en')
                                                        Transportation Fees
                                                    @else
                                                        رسوم الإنتقال
                                                    @endif <span
                                                        class=" t_rec">${{ $TransferCost->person_price }}</span><br>
                                                </p>
                                                <br>
                                                <p class="mb-0 pb-0">
                                                    @if (LaravelLocalization::getCurrentLocale() === 'en')
                                                        Capacity:
                                                    @else
                                                        السعة:
                                                    @endif <span class="">
                                                        {{ $TransferCost->capacity }}</span>
                                                </p>

                                                <br>
                                                <p class="mb-0 pb-0" style="border-top: 1px solid rgb(184, 184, 184)">
                                                    @if (LaravelLocalization::getCurrentLocale() === 'en')
                                                        Total Fees
                                                    @else
                                                        المجموع الفرعي
                                                    @endif <span
                                                        class=" text-end fw-bold t_rec">${{ number_format((float) $TransferCost->person_price, 2, '.', '') }}</span><br>
                                                </p>
                                                <br>
                                                <div class="grand_total">
                                                    <h6>
                                                        @if (LaravelLocalization::getCurrentLocale() === 'en')
                                                            Sub-total
                                                        @else
                                                            المجموع الفرعي
                                                        @endif
                                                    </h6>
                                                    <span class="h6 t_rec">
                                                        ${{ number_format((float) $TransferCost->person_price, 2, '.', '') }}</span></span>
                                                </div>

                                                <br>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 mb-4" style="border-bottom: 1px solid #d5d5d5">
                                    <hr />

                                </div>
                            </div>

                        @endif
                    </div>
                    <div class="col-12">
                        <div class="row">

                        @if (count($VisasCost) > 0)
                            <div class="col-12">
                                <h4 class="bg-info px-3 py-1 text-white">
                                        @if (LaravelLocalization::getCurrentLocale() === 'en')
                                            Visa Applications Details
                                        @else
                                            تفاصيل طلبات التأشيرة
                                        @endif
                                    </h4>
                            </div>
                            <div class="col-sm-12 col-md-6">

                                    @foreach ($VisasCost as $idx => $visa)
                                        @php
                                            $TotalVisasCost += $visa->cost;
                                        @endphp
                                        <h6 class="bg-light-info px-3 py-1">{{ $visa->visa_name }}</h6>
                                        <div class="passenger_info">
                                            @csrf
                                            <div class="row">
                                                <div class="col-sm-12 col-md-6 pe-5 pb-4">
                                                    <label class="form-label">{{ __('links.passImage') }}
                                                    </label>
                                                    <br />
                                                    <img style="width:100%;border-radius:10px;"
                                                        src="{{ asset('uploads/visas/' . $visa->visa_passport_photo) }}" />

                                                </div>
                                                <div class="col-sm-12 col-md-6 pe-5 pb-4">
                                                    <label class="form-label">{{ __('links.persImage') }}
                                                    </label>
                                                    <br />
                                                    <img style="width:100%;border-radius:10px;"
                                                        src="{{ asset('uploads/visas/' . $visa->visa_personal_photo) }}" />
                                                </div>
                                                <div class="col-sm-12 col-md-6 col-xl-4">
                                                    <label class="form-label">{{ __('links.country') }}
                                                    </label>
                                                    <p class="fw-bold">
                                                        @if (LaravelLocalization::getCurrentLocale() === 'en')
                                                            {{ $visa->en_country }}
                                                        @else
                                                            {{ $visa->ar_country }}
                                                        @endif
                                                    </p>
                                                </div>
                                                <div class="col-sm-12 col-md-6 col-xl-4">
                                                    <label class="form-label">{{ __('links.vtype') }}
                                                    </label>
                                                    <p class="fw-bold">
                                                        @if (LaravelLocalization::getCurrentLocale() === 'en')
                                                            {{ $visa->en_type }}
                                                        @else
                                                            {{ $visa->ar_type }}
                                                        @endif
                                                    </p>
                                                </div>
                                                <div class="col-sm-12 col-md-6 col-xl-4">
                                                    <label class="form-label">{{ __('links.nationality') }} </label>

                                                    <p class="fw-bold">
                                                        @if (LaravelLocalization::getCurrentLocale() === 'en')
                                                            {{ $visa->en_nationality }}
                                                        @else
                                                            {{ $visa->ar_nationality }}
                                                        @endif
                                                    </p>
                                                </div>
                                                <div class="col-sm-12 col-md-6 col-xl-4">
                                                    <label class="form-label">{{ __('links.fees') }} </label>

                                                    <p class="fw-bold">{{ $visa->cost }}$</p>
                                                </div>
                                                <div class="col-sm-12 col-md-6 col-xl-4">
                                                    <label class="form-label">{{ __('links.mobile') }} </label>

                                                    <p class="fw-bold">{{ $visa->visa_phone }}</p>
                                                </div>
                                                <div class="col-sm-12">
                                                    <label class="form-label">{{ __('links.email') }} </label>

                                                    <p class="fw-bold">{{ $visa->visa_email }}</p>
                                                </div>

                                                <input type="hidden" name="visa_id[{{ $idx }}]"
                                                    value="{{ $visa->visa_id }}">
                                                <input type="hidden" name="visa_name[{{ $idx }}]"
                                                    value="{{ $visa->visa_name }}">
                                                <input type="hidden" name="visa_email[{{ $idx }}]"
                                                    value="{{ $visa->visa_email }}">
                                                <input type="hidden" name="visa_phone[{{ $idx }}]"
                                                    value="{{ $visa->visa_phone }}">
                                                <input type="hidden" name="visa_cost[{{ $idx }}]"
                                                    value="{{ $visa->cost }}">
                                                <input type="hidden" name="visa_personal_photo[{{ $idx }}]"
                                                    value="{{ $visa->visa_personal_photo }}">
                                                <input type="hidden" name="visa_passport_photo[{{ $idx }}]"
                                                    value="{{ $visa->visa_passport_photo }}">

                                            </div>
                                        </div>
                                    @endforeach

                                    <input type="hidden" name="cost" value="{{ $TotalVisasCost }}">

                            </div>
                            <div class="col-sm-12 col-md-6">
                                <div class="passenger_info">
                                        <p class="receipt-title">
                                            @if (LaravelLocalization::getCurrentLocale() === 'en')
                                                Visa Application Receipt
                                            @else
                                                ايصال التأشيرة
                                            @endif
                                        </p>
                                        <div class="booking_info_card">
                                            <div class="text-end mb-3"><a class="del-hotel delete_trash"
                                                    href="{{ url('/cart/visa') }}"><i class="fa-solid fa-trash"></i></a>
                                            </div>
                                            <div class="remain_info mb-3">
                                                <h5>{{ __('links.visa') }} </h5>
                                                @foreach ($GPVisasCost as $_visa)
                                                    <p class="mb-0 pb-0">
                                                        @if (LaravelLocalization::getCurrentLocale() === 'en')
                                                            {{ $_visa->en_type }}:
                                                        @else
                                                            {{ $_visa->ar_type }}:
                                                        @endif <span
                                                            class="">{{ $_visa->groupped_count }} X
                                                            ${{ $_visa->sum_costs }}<span></span>
                                                    </p>
                                                @endforeach

                                                <br>
                                                <p class="mb-0 pb-0" style="border-top: 1px solid rgb(184, 184, 184)">
                                                    <span class=" text-end fw-bold">${{ $TotalVisasCost }}</span><br>
                                                </p>
                                                <br>
                                                <div class="grand_total">
                                                    <h6>
                                                        @if (LaravelLocalization::getCurrentLocale() === 'en')
                                                            Sub-total
                                                        @else
                                                            المجموع الفرعي
                                                        @endif
                                                    </h6>
                                                    <span class="h6"> {{ $TotalVisasCost }}$</span></span>
                                                </div>

                                                <br>
                                            </div>

                                        </div>
                                </div>
                            </div>
                        @endif
                        </div>



                    </div>
                    <div class="col-12">
                        <div class="passenger_info">


                            <p class="receipt-title">
                                @if (LaravelLocalization::getCurrentLocale() === 'en')
                                    Total Fees
                                @else
                                    الرسوم الكلية
                                @endif
                            </p>
                            <div class="remain_info">
                                <p class="mb-0 pb-0">
                                    @if (LaravelLocalization::getCurrentLocale() === 'en')
                                        Before Tax
                                    @else
                                        قبل ضريبة القيمة المضافة
                                    @endif <span
                                        class="float-end text-end BeforeT_txt">${{ number_format($TotalCost + $TotalToursFees + $TotalTransferCost + $TotalVisasCost, 2, '.', '') }}
                                    </span><br>
                                </p>
                                <br>
                                <p class="mb-0 pb-0">
                                    @if (LaravelLocalization::getCurrentLocale() === 'en')
                                        After VAT
                                    @else
                                        بعد ضريبة القيمة المضافة
                                    @endif
                                    <span class="float-end text-end">
                                        <span
                                            class="BeforeT_txt">${{ number_format($TotalCost + $TotalToursFees + $TotalTransferCost + $TotalVisasCost, 2, '.', '') }}</span>
                                        X {{ (float) $tax_percentage / 100 }} <br> <span
                                            class="fw-bold AfterT_txt">${{ number_format((float) ($TotalCost + $TotalToursFees + $TotalTransferCost + $TotalVisasCost) * (1 + (float) $tax_percentage / 100), 2, '.', '') }}</span></span><br>
                                    <input type="hidden" name="BeforeT"
                                        value="{{ number_format((float) ($TotalCost + $TotalToursFees + $TotalTransferCost + $TotalVisasCost), 2, '.', '') }}" />
                                </p>
                                <br />
                            </div>
                            <div class="grand_total final">
                                <h5>
                                    @if (LaravelLocalization::getCurrentLocale() === 'en')
                                        grand total
                                    @else
                                        المجموع الإجمالي
                                    @endif
                                </h5>
                                <span id="gt" class="AfterT_txt">
                                    <span>$</span>{{ number_format(($TotalCost + $TotalToursFees + $TotalTransferCost + $TotalVisasCost) * (1 + (float) $tax_percentage / 100), 2, '.', '') }}
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="my-3 px-3">
                            <div class="row">

                                <div class="form-check mb-3">
                                    <input class="form-check-input terms" style="float:none" required type="checkbox"
                                        value="" id="flexCheckChecked">
                                    <label class="form-check-label" for="flexCheckChecked">
                                        @if (LaravelLocalization::getCurrentLocale() === 'en')
                                            I agree to all <a href="{{ url('/terms') }}" target="_blank">Terms and
                                                Conditions</a> of Safer
                                        @else
                                            أوافق على جميع <a href="{{ url('/terms') }}" target="_blank"> بنود وشروط
                                            </a> Safer
                                        @endif
                                    </label>
                                </div>
                                <div class="col-12">
                                    <button type="submit" class="btn btn-info">
                                        @if (LaravelLocalization::getCurrentLocale() === 'en')
                                            Place Order
                                        @else
                                            استكمال الطلب
                                        @endif
                                    </button>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>

            </form>

        </section>
    @else
        <div class="container bg-light-info text-center p-5">
            @if (LaravelLocalization::getCurrentLocale() === 'en')
                Nothing is Added to cart
            @else
                لا شىء مضاف الى عربة التسوق
            @endif
        </div>
    @endif
@endsection

@section('adds_js')

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.js"></script>
    <script>
        function copyData(id){
            var data = {
                holder_name: $("#holder-name-" + id).val(),
                holder_mobile: $("#holder-phone-" + id).val(),
                holder_email: $("#holder-email-" + id).val(),
                holder_pickup: $("#holder-pickup-" + id).val(),
                holder_notes : $("#holder-notes-" + id).val(),
            }
            console.table(data);
            $("#holder-name-" + (id + 1)).val(data.holder_name);
            $("#holder-phone-" + (id + 1)).val(data.holder_mobile);
            $("#holder-email-" + (id + 1)).val(data.holder_email);
            $("#holder-pickup-" + (id + 1)).val(data.holder_pickup);
            $("#holder-notes-" + (id + 1)).val(data.holder_notes);

        }
        $(".delete_confirm").click(function(){
            $.confirm({
                title: 'Confirm!',
                content: 'Simple confirm!',
                buttons: {
                    confirm: function () {
                        $.alert('Confirmed!');
                    },
                    cancel: function () {
                        $.alert('Canceled!');
                    },
                    somethingElse: {
                        text: 'Something else',
                        btnClass: 'btn-blue',
                        keys: ['enter', 'shift'],
                        action: function(){
                            $.alert('Something else?');
                        }
                    }
                }
            });
        })
        $("#transHolderFlag").change(function() {
            debugger;
            var price = $("#t_price").val();
            var before_price = $("[name='BeforeT']").val();
            var tax = "{{ $tax_percentage }}";
            $(".trans-holder").fadeToggle();
            if ($(".is_holder").attr('required')) {
                $(".is_holder").removeAttr('required');
                $(".t_rec").text('$' + price);
                $(".BeforeT_txt").text('$' + (parseFloat(before_price)).toFixed(2));
                $(".AfterT_txt").text('$' + ((parseFloat(before_price).toFixed(2)) * (1 + parseFloat(tax) / 100.0))
                    .toFixed(2));
            } else {
                $(".is_holder").attr('required', 6);
                $(".t_rec").text('$' + 2.0 * price);
                $(".BeforeT_txt").text('$' + (parseFloat(before_price) + parseFloat(price)).toFixed(2));
                $(".AfterT_txt").text('$' + ((parseFloat(before_price) + parseFloat(price)) * (1 + parseFloat(tax) /
                    100.0)).toFixed(2));

            }
        });
    </script>
    <script>
        let localization = "{{ LaravelLocalization::getCurrentLocale() }}"
        $(document).ready(function() {
            // $('.transfer_date').datepicker();
            var _minDate = "{{ $TransferCost ? $TransferCost->transfer_date : '' }}"
            flatpickr(".transfer_date", {
                enableTime: true,
                dateFormat: "Y-m-d H:i:S",
                minDate: _minDate,
                defaultDate: new Date(_minDate ? _minDate : Date.now()),
            });
        });
        $(".delete_trash").click(function(e) {
            e.preventDefault();
            var elem = $(this);
            console.log($(this).attr("href"));
            var obj = $.confirm({
                title: localization === "en" ? 'Are you sure?' : 'هل أنت متأكد؟',
                content: localization === "en" ?
                    'This is a confirmation regarding your action to delete a cart item.' :
                    'هذا تأكيد بخصوص إجراءك لحذف عنصر من عربة التسوق.',
                buttons: {
                    confirm: {
                        text: localization === "en" ? 'Confirm' : 'تأكيد',
                        action: function() {
                            window.location.href = elem.attr("href");
                        },
                        btnClass: 'btn-blue',
                    },
                    cancel: {
                        text: localization === "en" ? 'Cancel' : 'إلغاء',
                        action: function() {
                            obj.close();
                        },
                    }
                }
            });

            obj.close();
        });
    </script>

    @endsection
