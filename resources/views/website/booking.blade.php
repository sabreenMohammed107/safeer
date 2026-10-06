@extends('layout.website.layout', ['Company' => $Company, 'title' => 'Safer | User Cart'])

@section('adds_css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.css" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="{{ asset('/website_assets/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('/website_assets/css/about.css') }}">
    <link rel="stylesheet" href="{{ asset('/website_assets/css/tours.css') }}">
    <link rel="stylesheet" href="{{ asset('/website_assets/css/hotel.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.css">
    {{-- versioned: the server caches CSS for 7 days --}}
    <link rel="stylesheet" href="{{ asset('/website_assets/css/cart.css') }}?v={{ filemtime(public_path('website_assets/css/cart.css')) }}">
@endsection

@section('bottom-header')
    <x-website.header.general title="{{ __('links.cart') }} " :breadcrumb="$BreadCrumb" current="{{ __('links.preBook') }}" />
@endsection
@section('content')
    @php
        $isEn = LaravelLocalization::getCurrentLocale() === 'en';
    @endphp
    @if ($RoomCost || count($ToursCost) || $TransferCost || count($VisasCost))
        @php
            $TotalCost = 0;
            $TotalToursFees = 0;
            $TotalTransferCost = 0;
            $TotalVisasCost = 0;

            /* ---- Hotel room (same formula as BookingController@MakeOrder) ---- */
            if ($RoomCost) {
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

                $FreeChildren = 0;
                $PaidChildren = 0;
                $ages = null;
                if ($RoomCost->children_count) {
                    $ages = explode(',', $RoomCost->ages);
                    for ($i = 0; $i < $RoomCost->children_count; $i++) {
                        if (($ages[$i] ?? null) >= $RoomCost->child_free_age_from && ($ages[$i] ?? null) <= $RoomCost->child_free_age_to) {
                            $FreeChildren++;
                        } else {
                            $PaidChildren++;
                        }
                    }
                }

                $RoomPerNight = (float) $RoomCost->rooms_count * $Cost + $PaidChildren * $RoomCost->child_age_cost;
                $TotalCost = $RoomCost->nights * ($RoomCost->rooms_count * $Cost + $PaidChildren * $RoomCost->child_age_cost);
            }

            /* ---- Tours: children older than 2 are paid ---- */
            $TotalPaidPersons = [];
            $TourTotalCost = [];
            $TourSubtotal = [];
            $TourAges = [];
            foreach ($ToursCost as $index => $Tour) {
                // `ages` can be NULL or shorter than children_count when a tour was added
                // to the cart without picking ages; missing ages render blank and count as
                // free, matching how MakeOrder prices them.
                $TourAges[$index] = $Tour->ages ? explode(',', $Tour->ages) : [];
                $TotalPaidPersons[$index] = $Tour->adults_count;
                for ($i = 0; $i < $Tour->children_count; $i++) {
                    if (($TourAges[$index][$i] ?? 0) > 2) {
                        $TotalPaidPersons[$index]++;
                    }
                }
                $TourTotalCost[$index] = $Tour->tour_person_cost * $TotalPaidPersons[$index];
                $TotalToursFees += $TourTotalCost[$index];
                // Private tours (type 1) are a flat price
                $TourSubtotal[$index] = $Tour->tour_type_id == 1 ? $Tour->tour_person_cost : $TourTotalCost[$index];
            }

            if ($TransferCost) {
                $TotalTransferCost = $TransferCost->person_price;
            }

            foreach ($VisasCost as $visa) {
                $TotalVisasCost += $visa->cost;
            }

            /* ---- Order totals (unchanged from the previous template, including the
                   private-tour branch that keys off the last tour in the cart) ---- */
            $LastTour = $ToursCost->last();
            if ($LastTour && $LastTour->tour_type_id == 1) {
                $BeforeTax = $TotalCost + $LastTour->tour_person_cost + $TotalTransferCost + $TotalVisasCost;
            } else {
                $BeforeTax = $TotalCost + $TotalToursFees + $TotalTransferCost + $TotalVisasCost;
            }
            $TaxRate = (float) $tax_percentage / 100;
            $AfterTax = (float) $BeforeTax * (1 + $TaxRate);

            $ItemsCount = ($RoomCost ? 1 : 0) + count($ToursCost) + ($TransferCost ? 1 : 0) + count($VisasCost);

            // Open the first card by default; the rest start collapsed
            $FirstOpen = $RoomCost ? 'room' : (count($ToursCost) ? 'tour-0' : ($TransferCost ? 'transfer' : 'visa'));
        @endphp

        <section class="sc container">
            <div class="sc-header">
                <h2 class="sc-header__title">{{ __('links.cartDetails') }}</h2>
                <span class="sc-header__count">
                    {{ $ItemsCount }} {{ $isEn ? ($ItemsCount == 1 ? 'item' : 'items') : 'عنصر' }}
                </span>
            </div>

            <form action="{{ LaravelLocalization::getLocalizedURL($localVar, route('makeOrder')) }}" method="POST"
                id="sc-form">
                @csrf
                <input type="hidden" name="tax_percentage" value="{{ $tax_percentage }}">

                <div class="row g-4">
                    {{-- ============ LEFT: cart items ============ --}}
                    <div class="col-lg-8">
                        <div class="sc-items">

                            {{-- ---------- Hotel room ---------- --}}
                            @if ($RoomCost)
                                <x-website.cart.item id="sc-room" icon="fa-hotel" :open="$FirstOpen === 'room'"
                                    :type="$isEn ? 'Hotel Reservation' : 'حجز فندق'"
                                    :title="($isEn ? $RoomCost->hotel_enname : $RoomCost->hotel_arname ?? '') . ' – ' . $RoomCost->hotel_stars . ($isEn ? ' Stars' : ' نجوم')"
                                    :meta="$RoomCost->rooms_count . ' × ' . $Type . ' · ' . $RoomCost->nights . ' ' . __('links.nights') . ' · ' . $RoomCost->from_date"
                                    :price="money((float) $TotalCost)" :delete-url="url('/cart/' . $RoomCost->id)">
                                    <div class="row g-4">
                                        <div class="col-md-7 order-2 order-md-1">
                                            <h6 class="sc-section-title">
                                                {{ $isEn ? 'Reservation Holder' : 'مسئول الحجز' }}
                                            </h6>
                                            <div class="row g-3">
                                                <div class="col-sm-7">
                                                    <label class="form-label">{{ __('links.cName') }}</label>
                                                    <input type="text" name="adultsNames[]" required
                                                        value="{{ session()->get('SiteUser')['Name'] }}"
                                                        class="form-control" placeholder="{{ __('links.cName') }}">
                                                </div>
                                                <div class="col-sm-5">
                                                    <label class="form-label">{{ __('links.mobile') }}</label>
                                                    <input type="text" name="adultsMobile[]" required class="form-control"
                                                        placeholder="{{ __('links.mobile') }}">
                                                </div>
                                            </div>

                                            @if ($RoomCost->adults_count - 1 > 0)
                                                <h6 class="sc-section-title">{{ $isEn ? 'Other Adults' : 'البالغين' }}</h6>
                                                @for ($j = 0; $j < $RoomCost->adults_count - 1; $j++)
                                                    <div class="row g-3 sc-person">
                                                        <div class="col-sm-3">
                                                            <label class="form-label">{{ __('links.salutation') }}</label>
                                                            <input type="text" name="adultsSal[]" required
                                                                class="form-control" placeholder="{{ __('links.mr') }}">
                                                        </div>
                                                        <div class="col-sm-5">
                                                            <label class="form-label">{{ __('links.cName') }}</label>
                                                            <input type="text" name="adultsNames[]" required
                                                                class="form-control" placeholder="{{ __('links.cName') }}">
                                                        </div>
                                                        <div class="col-sm-4">
                                                            <label class="form-label">{{ __('links.mobile') }}</label>
                                                            <input type="text" name="adultsMobile[]" required
                                                                class="form-control" placeholder="{{ __('links.mobile') }}">
                                                        </div>
                                                    </div>
                                                @endfor
                                            @endif

                                            @if ($RoomCost->children_count)
                                                <h6 class="sc-section-title">{{ $isEn ? 'Children' : 'الأطفال' }}</h6>
                                                <div class="row g-3">
                                                    @for ($i = 0; $i < $RoomCost->children_count; $i++)
                                                        <div class="col-sm-6">
                                                            <label class="form-label">
                                                                {{ __('links.cName') }}
                                                                <span class="sc-muted">({{ $isEn ? 'Age' : 'العمر' }}: {{ $ages[$i] ?? '' }})</span>
                                                            </label>
                                                            <input type="text" class="form-control" required
                                                                name="childrenNames[]" placeholder="{{ __('links.cName') }}">
                                                            <input type="hidden" name="childrenAges[]" required
                                                                value="{{ $ages[$i] ?? '' }}" />
                                                        </div>
                                                    @endfor
                                                </div>
                                            @endif

                                            <div class="mt-3">
                                                <label class="form-label">{{ __('links.notes') }}</label>
                                                <textarea class="form-control" name="{{ __('links.notes') }} " rows="2"></textarea>
                                            </div>

                                            <input type="hidden" name="cart_id" value="{{ $RoomCost->id }}" />
                                            <input type="hidden" name="hotel_id" value="{{ $RoomCost->hotel_id }}" />
                                            <input type="hidden" name="from_date" value="{{ $RoomCost->from_date }}" />
                                            <input type="hidden" name="to_date" value="{{ $RoomCost->to_date }}" />
                                            <input type="hidden" name="nights" value="{{ $RoomCost->nights }}" />
                                            <input type="hidden" name="adults_count" value="{{ $RoomCost->adults_count }}" />
                                            <input type="hidden" name="children_count" value="{{ $RoomCost->children_count }}" />
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
                                            <input type="hidden" name="child_free_age_from" value="{{ $RoomCost->child_free_age_from }}" />
                                            <input type="hidden" name="child_free_age_to" value="{{ $RoomCost->child_free_age_to }}" />
                                            <input type="hidden" name="child_age_cost" value="{{ $RoomCost->child_age_cost }}" />
                                        </div>

                                        <div class="col-md-5 order-1 order-md-2">
                                            <div class="sc-panel">
                                                <div class="sc-media">
                                                    <img src="{{ asset('uploads/hotels') }}/{{ $RoomCost->hotel_banner }}"
                                                        loading="lazy" alt="">
                                                    <div>
                                                        <a href="{{ url('/hotels/' . $RoomCost->hotel_id) }}" class="sc-media__title">
                                                            {{ $isEn ? $RoomCost->hotel_enname : $RoomCost->hotel_arname ?? '' }}
                                                        </a>
                                                        <div class="sc-stars">
                                                            @for ($i = 0; $i < $RoomCost->hotel_stars; $i++)
                                                                <i class="fa-solid fa-star"></i>
                                                            @endfor
                                                            @for ($i = 5; $i > $RoomCost->hotel_stars; $i--)
                                                                <i class="fa-regular fa-star"></i>
                                                            @endfor
                                                        </div>
                                                        <span class="sc-muted">
                                                            <i class="fa-solid fa-location-dot"></i>
                                                            {{ $isEn ? $RoomCost->en_city : $RoomCost->ar_city ?? '' }},
                                                            {{ $isEn ? $RoomCost->en_country : $RoomCost->ar_country ?? '' }}
                                                        </span>
                                                    </div>
                                                </div>
                                                <ul class="sc-lines">
                                                    <li>
                                                        <span>{{ $RoomCost->rooms_count }} × {{ $RoomCost->en_room_type }} {{ $Type }}
                                                            <small class="sc-muted d-block">{{ $RoomCost->food_bev_type }}</small></span>
                                                        <span>{{ money((float) $RoomCost->rooms_count * $Cost) }}</span>
                                                    </li>
                                                    <li>
                                                        <span>{{ $RoomCost->adults_count }} × {{ __('links.adult') }}</span>
                                                        <span></span>
                                                    </li>
                                                    @if ($ages)
                                                        <li>
                                                            <span>{{ $FreeChildren }} × {{ $isEn ? 'Free children' : 'أطفال مجاني' }}
                                                                <small class="sc-muted d-block">{{ $isEn ? 'Age' : 'العمر' }}
                                                                    {{ $RoomCost->child_free_age_from }}–{{ $RoomCost->child_free_age_to }}</small></span>
                                                            <span>{{ $isEn ? 'Free' : 'مجاني' }}</span>
                                                        </li>
                                                        <li>
                                                            <span>{{ $PaidChildren }} × {{ $isEn ? 'Paid children' : 'أطفال مدفوعة' }}
                                                                <small class="sc-muted d-block">{{ $isEn ? 'Age' : 'العمر' }}
                                                                    {{ $RoomCost->child_age_from }}–{{ $RoomCost->child_age_to }}</small></span>
                                                            <span>{{ money($PaidChildren * $RoomCost->child_age_cost) }}</span>
                                                        </li>
                                                    @endif
                                                    <li>
                                                        <span>{{ $isEn ? 'Per night' : 'لليلة' }}</span>
                                                        <span>{{ money($RoomPerNight) }}</span>
                                                    </li>
                                                    <li>
                                                        <span>{{ $RoomCost->nights }} {{ __('links.nights') }}
                                                            <small class="sc-muted d-block">{{ $RoomCost->from_date }} → {{ $RoomCost->to_date }}</small></span>
                                                        <span>× {{ $RoomCost->nights }}</span>
                                                    </li>
                                                    <li class="sc-lines__total">
                                                        <span>{{ $isEn ? 'Sub-total' : 'المجموع الفرعي' }}</span>
                                                        <span>{{ money((float) $TotalCost) }}</span>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </x-website.cart.item>
                            @endif

                            {{-- ---------- Tours ---------- --}}
                            @foreach ($ToursCost as $index => $Tour)
                                <x-website.cart.item id="sc-tour-{{ $index }}" icon="fa-route"
                                    :open="$FirstOpen === 'tour-' . $index"
                                    :type="$isEn ? 'Tour Reservation' : 'حجز جولة'"
                                    :title="$isEn ? $Tour->en_name : $Tour->ar_name ?? ''"
                                    :meta="$Tour->tour_date . ' · ' . ($isEn ? $Tour->en_city : $Tour->ar_city ?? '') . ' · ' . ($Tour->tour_type_id == 1 ? ($isEn ? 'Private' : 'خاصة') : $Tour->adults_count . ' × ' . __('links.adult'))"
                                    :price="money($TourSubtotal[$index])" :delete-url="url('/cart/' . $Tour->id)">
                                    <div class="row g-4">
                                        <div class="col-md-7 order-2 order-md-1">
                                            <div class="d-flex flex-wrap align-items-center justify-content-between gap-2">
                                                <h6 class="sc-section-title m-0">
                                                    {{ $isEn ? 'Reservation Holder' : 'مسئول الحجز' }}
                                                </h6>
                                                @if ($index > 0)
                                                    <button type="button" onclick="copyData({{ $index - 1 }})"
                                                        class="sc-link-btn">
                                                        <i class="fa-regular fa-copy"></i>
                                                        {{ $isEn ? 'Copy from previous tour' : 'نسخ من الجولة السابقة' }}
                                                    </button>
                                                @endif
                                            </div>
                                            <div class="row g-3 mt-0">
                                                <div class="col-sm-7">
                                                    <label class="form-label">{{ __('links.cName') }}</label>
                                                    <input type="text" name="tour_adults_name[{{ $index }}][]"
                                                        value="{{ session()->get('SiteUser')['Name'] }}" required
                                                        class="form-control" id="holder-name-{{ $index }}"
                                                        placeholder="{{ __('links.cName') }}">
                                                </div>
                                                <div class="col-sm-5">
                                                    <label class="form-label">{{ __('links.mobile') }}</label>
                                                    <input type="text" name="tour_adults_mobile[{{ $index }}][]" required
                                                        class="form-control" id="holder-phone-{{ $index }}"
                                                        placeholder="{{ __('links.mobile') }}">
                                                </div>
                                                <div class="col-sm-6">
                                                    <label class="form-label">{{ __('links.email') }}</label>
                                                    <input type="text" name="tour_adults_email[{{ $index }}][]" required
                                                        class="form-control" id="holder-email-{{ $index }}"
                                                        value="{{ session()->get('SiteUser')['Email'] }}"
                                                        placeholder="{{ __('links.email') }}">
                                                </div>
                                                <div class="col-sm-6">
                                                    <label class="form-label">{{ __('links.pickupP') }}</label>
                                                    <input type="text" name="tour_pickup_point[{{ $index }}]" required
                                                        class="form-control" id="holder-pickup-{{ $index }}"
                                                        placeholder="{{ __('links.pickupP') }}">
                                                </div>
                                            </div>

                                            @if ($Tour->adults_count - 1 > 0)
                                                <h6 class="sc-section-title">{{ $isEn ? 'Other Adults' : 'البالغين' }}</h6>
                                                @for ($j = 0; $j < $Tour->adults_count - 1; $j++)
                                                    <div class="row g-3 sc-person">
                                                        <div class="col-sm-5">
                                                            <label class="form-label">{{ __('links.cName') }}</label>
                                                            <input type="text" name="tour_adults_name[{{ $index }}][]"
                                                                required class="form-control"
                                                                placeholder="{{ __('links.cName') }}">
                                                        </div>
                                                        <div class="col-sm-3">
                                                            <label class="form-label">{{ __('links.mobile') }}</label>
                                                            <input type="text" name="tour_adults_mobile[{{ $index }}][]"
                                                                required class="form-control"
                                                                placeholder="{{ __('links.mobile') }}">
                                                        </div>
                                                        <div class="col-sm-4">
                                                            <label class="form-label">{{ __('links.email') }}</label>
                                                            <input type="text" name="tour_adults_email[{{ $index }}][]"
                                                                required class="form-control"
                                                                placeholder="{{ __('links.email') }}">
                                                        </div>
                                                    </div>
                                                @endfor
                                            @endif

                                            @if ($Tour->children_count)
                                                <h6 class="sc-section-title">{{ $isEn ? 'Children' : 'الأطفال' }}</h6>
                                                <div class="row g-3">
                                                    @for ($i = 0; $i < $Tour->children_count; $i++)
                                                        <div class="col-sm-6">
                                                            <label class="form-label">
                                                                {{ __('links.cName') }}
                                                                @isset($TourAges[$index][$i])
                                                                    <span class="sc-muted">({{ $isEn ? 'Age' : 'العمر' }}: {{ $TourAges[$index][$i] }})</span>
                                                                @endisset
                                                            </label>
                                                            <input type="text" class="form-control" required
                                                                name="tour_child_name[{{ $index }}][]"
                                                                placeholder="{{ __('links.cName') }}">
                                                            <input type="hidden" name="tour_child_age[{{ $index }}][]"
                                                                required value="{{ $TourAges[$index][$i] ?? '' }}" />
                                                        </div>
                                                    @endfor
                                                </div>
                                            @endif

                                            <div class="mt-3">
                                                <label class="form-label">{{ __('links.notes') }}</label>
                                                <textarea class="form-control" name="tour_notes[{{ $index }}]" id="holder-notes-{{ $index }}" rows="2"></textarea>
                                            </div>

                                            <input type="hidden" name="tour_id[{{ $index }}]" value="{{ $Tour->tour_id }}" />
                                            <input type="hidden" name="tour_date[{{ $index }}]" value="{{ $Tour->tour_date }}" />
                                            <input type="hidden" name="tour_adults_count[{{ $index }}]" value="{{ $Tour->adults_count }}" />
                                            <input type="hidden" name="tour_children_count[{{ $index }}]" value="{{ $Tour->children_count }}" />
                                            <input type="hidden" name="tour_total_cost[{{ $index }}]" value="{{ $TourTotalCost[$index] }}" />
                                            <input type="hidden" name="tour_cost[{{ $index }}]" value="{{ $Tour->tour_person_cost }}" />
                                            <input type="hidden" name="tour_ages[{{ $index }}]" value="{{ $Tour->ages }}" />
                                        </div>

                                        <div class="col-md-5 order-1 order-md-2">
                                            <div class="sc-panel">
                                                <div class="sc-media">
                                                    <img src="{{ asset('uploads/tours') }}/{{ $Tour->banner }}" loading="lazy" alt="">
                                                    <div>
                                                        <a href="{{ url('/tours/') }}" class="sc-media__title">
                                                            {{ $isEn ? $Tour->en_name : $Tour->ar_name ?? '' }}
                                                        </a>
                                                        <span class="sc-muted d-block">
                                                            <i class="fa-solid fa-location-dot"></i>
                                                            {{ $isEn ? $Tour->en_city : $Tour->ar_city ?? '' }},
                                                            {{ $isEn ? $Tour->en_country : $Tour->ar_country ?? '' }}
                                                        </span>
                                                        <span class="sc-muted d-block">
                                                            <i class="fa-regular fa-calendar"></i> {{ $Tour->tour_date }}
                                                        </span>
                                                    </div>
                                                </div>
                                                <ul class="sc-lines">
                                                    @if ($Tour->tour_type_id == 1)
                                                        <li>
                                                            <span>{{ $isEn ? 'Private tour' : 'جولة خاصة' }}
                                                                <small class="sc-muted d-block">{{ $Tour->private_number }}
                                                                    {{ $isEn ? 'allowed number of people' : 'عدد الأشخاص المسموح' }}</small></span>
                                                            <span></span>
                                                        </li>
                                                    @else
                                                        <li>
                                                            <span>{{ $Tour->adults_count }} × {{ __('links.adult') }}
                                                                <small class="sc-muted d-block">{{ $Tour->adults_count }} × {{ money($Tour->tour_person_cost) }}</small></span>
                                                            <span>{{ money($Tour->adults_count * $Tour->tour_person_cost) }}</span>
                                                        </li>
                                                        @if ($Tour->children_count)
                                                            <li>
                                                                <span>{{ $Tour->children_count - ($TotalPaidPersons[$index] - $Tour->adults_count) }}
                                                                    × {{ $isEn ? 'Free children (< 2 years)' : 'أطفال مجاني (< سنتين)' }}</span>
                                                                <span>{{ $isEn ? 'Free' : 'مجاني' }}</span>
                                                            </li>
                                                            <li>
                                                                <span>{{ $TotalPaidPersons[$index] - $Tour->adults_count }}
                                                                    × {{ $isEn ? 'Paid children' : 'أطفال مدفوعة' }}</span>
                                                                <span>{{ money(($TotalPaidPersons[$index] - $Tour->adults_count) * $Tour->tour_person_cost) }}</span>
                                                            </li>
                                                        @endif
                                                    @endif
                                                    <li class="sc-lines__total">
                                                        <span>{{ $isEn ? 'Sub-total' : 'المجموع الفرعي' }}</span>
                                                        <span>{{ money($TourSubtotal[$index]) }}</span>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </x-website.cart.item>
                            @endforeach

                            {{-- ---------- Transfer ---------- --}}
                            @if ($TransferCost)
                                @php
                                    $FromLoc = $isEn ? $TransferCost->from_location_enname : $TransferCost->from_location_arname ?? '';
                                    $ToLoc = $isEn ? $TransferCost->to_location_enname : $TransferCost->to_location_arname ?? '';
                                    $CarModel = $isEn ? $TransferCost->model_enname : $TransferCost->model_arname ?? '';
                                    $CarClass = $isEn ? $TransferCost->class_enname : $TransferCost->class_arname ?? '';
                                @endphp
                                <x-website.cart.item id="sc-transfer" icon="fa-car" :open="$FirstOpen === 'transfer'"
                                    :type="$isEn ? 'Transportation' : 'انتقالات'"
                                    :title="$FromLoc . ' → ' . $ToLoc"
                                    :meta="$TransferCost->transfer_date . ' · ' . $CarModel . ' (' . $CarClass . ')'"
                                    :price="money((float) $TransferCost->person_price)" price-class="t_rec"
                                    :delete-url="url('/cart/' . $TransferCost->id)">
                                    <div class="row g-4">
                                        <div class="col-md-7 order-2 order-md-1">
                                            <h6 class="sc-section-title">
                                                {{ $isEn ? 'Reservation Holder' : 'مسئول الحجز' }}
                                            </h6>
                                            <div class="row g-3">
                                                <div class="col-sm-7">
                                                    <label class="form-label">{{ __('links.cName') }}</label>
                                                    <input type="text" name="transferName"
                                                        value="{{ session()->get('SiteUser')['Name'] }}"
                                                        class="form-control" required="required"
                                                        placeholder="{{ __('links.cName') }}">
                                                </div>
                                                <div class="col-sm-5">
                                                    <label class="form-label">{{ __('links.mobile') }}</label>
                                                    <input type="text" name="transferMobile" class="form-control"
                                                        required="required" placeholder="{{ __('links.mobile') }}">
                                                </div>
                                                <div class="col-sm-6">
                                                    <label class="form-label">{{ __('links.email') }}</label>
                                                    <input type="email" name="transferEmail"
                                                        value="{{ session()->get('SiteUser')['Email'] }}"
                                                        class="form-control" required="required"
                                                        placeholder="{{ __('links.email') }}">
                                                </div>
                                                <div class="col-sm-6">
                                                    <label class="form-label">{{ __('links.hotel') }}</label>
                                                    <input type="text" name="hotel_name" class="form-control"
                                                        required="required" placeholder="{{ __('links.hotel') }}">
                                                </div>
                                            </div>
                                            <input type="hidden" name="transferJob" id="transferJob" value=" ">

                                            <div class="sc-toggle-row">
                                                <div class="form-check m-0">
                                                    <input class="form-check-input" type="checkbox" name="default_holder"
                                                        id="transHolderFlag">
                                                    <label class="form-check-label" for="transHolderFlag">
                                                        {{ $isEn ? 'Go & Return' : 'ذهاب & عودة' }}
                                                    </label>
                                                </div>
                                                <div class="trans-holder" style="display: none;">
                                                    <label class="form-label" for="transfer_date">
                                                        {{ $isEn ? 'Return Date' : 'تاريخ العودة' }}
                                                    </label>
                                                    <input type="text" id="transfer_date"
                                                        min="{{ $TransferCost->transfer_date }}" placeholder="DD/MM/YYYY"
                                                        class="form-control transfer_date is_holder" name="return"
                                                        max="2025-12-31" autocomplete="off">
                                                </div>
                                            </div>

                                            <div class="mt-3">
                                                <label class="form-label">{{ __('links.notes') }}</label>
                                                <textarea class="form-control" name="transferNotes" rows="2"></textarea>
                                            </div>

                                            <input type="hidden" name="transfer_id" value="{{ $TransferCost->transfer_id }}" />
                                            <input type="hidden" name="transfer_date" value="{{ $TransferCost->transfer_date }}" />
                                            <input type="hidden" name="car_model" value="{{ $CarModel }}" />
                                            <input type="hidden" name="car_class" value="{{ $CarClass }}" />
                                            <input type="hidden" name="from_loc" value="{{ $FromLoc }}" />
                                            <input type="hidden" name="to_loc" value="{{ $ToLoc }}" />
                                            <input type="hidden" name="capacity" value="{{ $TransferCost->capacity }}" />
                                            <input type="hidden" name="fees" id="t_price" value="{{ $TransferCost->person_price }}" />
                                            <input type="hidden" name="image" value="{{ $TransferCost->image }}" />
                                        </div>

                                        <div class="col-md-5 order-1 order-md-2">
                                            <div class="sc-panel">
                                                <div class="sc-media">
                                                    <img src="{{ asset('uploads/carModels') }}/{{ $TransferCost->image }}"
                                                        loading="lazy" alt="" class="sc-media__img--contain">
                                                    <div>
                                                        <span class="sc-media__title">{{ $CarModel }}</span>
                                                        <span class="sc-muted d-block">{{ $CarClass }}</span>
                                                        <span class="sc-muted d-block">
                                                            <i class="fa-solid fa-user-group"></i>
                                                            {{ $isEn ? 'Capacity' : 'السعة' }}: {{ $TransferCost->capacity }}
                                                        </span>
                                                    </div>
                                                </div>
                                                <ul class="sc-lines">
                                                    <li><span>{{ __('links.from') }}</span><span>{{ $FromLoc }}</span></li>
                                                    <li><span>{{ __('links.to') }}</span><span>{{ $ToLoc }}</span></li>
                                                    <li>
                                                        <span>{{ $isEn ? 'Transportation Date' : 'تاريخ الإنتقال' }}</span>
                                                        <span>{{ $TransferCost->transfer_date }}</span>
                                                    </li>
                                                    <li class="sc-lines__total">
                                                        <span>{{ $isEn ? 'Sub-total' : 'المجموع الفرعي' }}</span>
                                                        <span class="t_rec">{{ money((float) $TransferCost->person_price) }}</span>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </x-website.cart.item>
                            @endif

                            {{-- ---------- Visas (removed as a group by /cart/visa) ---------- --}}
                            @if (count($VisasCost) > 0)
                                @php
                                    $VisaTitle = $GPVisasCost
                                        ->map(function ($v) use ($isEn) {
                                            return ($isEn ? $v->en_country : $v->ar_country) . ' – ' . ($isEn ? $v->en_type : $v->ar_type);
                                        })
                                        ->implode(', ');
                                @endphp
                                <x-website.cart.item id="sc-visa" icon="fa-passport" :open="$FirstOpen === 'visa'" :ready="true"
                                    :type="($isEn ? 'Visa Applications' : 'طلبات التأشيرات') . ' (' . count($VisasCost) . ')'"
                                    :title="$VisaTitle"
                                    :meta="$VisasCost->pluck('visa_name')->implode(', ')"
                                    :price="money($TotalVisasCost)" :delete-url="url('/cart/visa')"
                                    :delete-message="$isEn ? 'Remove all visa applications from your cart?' : 'حذف جميع طلبات التأشيرات من سلتك؟'">
                                    <div class="sc-applicants">
                                        @foreach ($VisasCost as $idx => $visa)
                                            <div class="sc-applicant">
                                                <div class="sc-applicant__head">
                                                    <div>
                                                        <span class="sc-applicant__name">{{ $visa->visa_name }}</span>
                                                        <span class="sc-muted d-block">
                                                            {{ $isEn ? $visa->en_country : $visa->ar_country }} ·
                                                            {{ $isEn ? $visa->en_type : $visa->ar_type }} ·
                                                            {{ $isEn ? $visa->en_nationality : $visa->ar_nationality }}
                                                        </span>
                                                    </div>
                                                    <span class="sc-applicant__fee">{{ money($visa->cost) }}</span>
                                                </div>
                                                <div class="sc-applicant__body">
                                                    <dl class="sc-facts">
                                                        <div>
                                                            <dt>{{ __('links.mobile') }}</dt>
                                                            <dd>{{ $visa->visa_phone }}</dd>
                                                        </div>
                                                        <div>
                                                            <dt>{{ __('links.email') }}</dt>
                                                            <dd>{{ $visa->visa_email }}</dd>
                                                        </div>
                                                    </dl>
                                                    <div class="sc-docs">
                                                        <a class="sc-doc" target="_blank" rel="noopener"
                                                            href="{{ asset('uploads/visas/' . $visa->visa_passport_photo) }}">
                                                            <img src="{{ asset('uploads/visas/' . $visa->visa_passport_photo) }}"
                                                                loading="lazy" alt="">
                                                            <span>{{ __('links.passImage') }}</span>
                                                        </a>
                                                        <a class="sc-doc" target="_blank" rel="noopener"
                                                            href="{{ asset('uploads/visas/' . $visa->visa_personal_photo) }}">
                                                            <img src="{{ asset('uploads/visas/' . $visa->visa_personal_photo) }}"
                                                                loading="lazy" alt="">
                                                            <span>{{ __('links.persImage') }}</span>
                                                        </a>
                                                    </div>
                                                </div>

                                                <input type="hidden" name="visa_id[{{ $idx }}]" value="{{ $visa->visa_id }}">
                                                <input type="hidden" name="visa_name[{{ $idx }}]" value="{{ $visa->visa_name }}">
                                                <input type="hidden" name="visa_email[{{ $idx }}]" value="{{ $visa->visa_email }}">
                                                <input type="hidden" name="visa_phone[{{ $idx }}]" value="{{ $visa->visa_phone }}">
                                                <input type="hidden" name="visa_cost[{{ $idx }}]" value="{{ $visa->cost }}">
                                                <input type="hidden" name="visa_personal_photo[{{ $idx }}]" value="{{ $visa->visa_personal_photo }}">
                                                <input type="hidden" name="visa_passport_photo[{{ $idx }}]" value="{{ $visa->visa_passport_photo }}">
                                            </div>
                                        @endforeach
                                    </div>
                                    <input type="hidden" name="cost" value="{{ $TotalVisasCost }}">
                                </x-website.cart.item>
                            @endif
                        </div>
                    </div>

                    {{-- ============ RIGHT: sticky order summary ============ --}}
                    <div class="col-lg-4">
                        <aside class="sc-summary">
                            <h3 class="sc-summary__title">{{ $isEn ? 'Order Summary' : 'ملخص الطلب' }}</h3>

                            <ul class="sc-summary__items">
                                @if ($RoomCost)
                                    <li>
                                        <i class="fa-solid fa-hotel"></i>
                                        <span>{{ $isEn ? $RoomCost->hotel_enname : $RoomCost->hotel_arname ?? '' }}
                                            ({{ $RoomCost->nights }} {{ __('links.nights') }})</span>
                                        <strong>{{ money((float) $TotalCost) }}</strong>
                                    </li>
                                @endif
                                @foreach ($ToursCost as $index => $Tour)
                                    <li>
                                        <i class="fa-solid fa-route"></i>
                                        <span>{{ $isEn ? $Tour->en_name : $Tour->ar_name ?? '' }}
                                            @if ($Tour->tour_type_id != 1)
                                                ({{ $TotalPaidPersons[$index] }} × {{ money($Tour->tour_person_cost) }})
                                            @endif
                                        </span>
                                        <strong>{{ money($TourSubtotal[$index]) }}</strong>
                                    </li>
                                @endforeach
                                @if ($TransferCost)
                                    <li>
                                        <i class="fa-solid fa-car"></i>
                                        <span>{{ $FromLoc }} → {{ $ToLoc }}</span>
                                        <strong class="t_rec">{{ money((float) $TransferCost->person_price) }}</strong>
                                    </li>
                                @endif
                                @foreach ($GPVisasCost as $_visa)
                                    <li>
                                        <i class="fa-solid fa-passport"></i>
                                        <span>{{ $isEn ? $_visa->en_type : $_visa->ar_type }}
                                            ({{ $_visa->groupped_count }}×)</span>
                                        <strong>{{ money($_visa->sum_costs) }}</strong>
                                    </li>
                                @endforeach
                            </ul>

                            <div class="sc-summary__totals">
                                <div>
                                    <span>{{ $isEn ? 'Subtotal (before VAT)' : 'المجموع قبل الضريبة' }}</span>
                                    <span class="BeforeT_txt">{{ money($BeforeTax) }}</span>
                                </div>
                                <div>
                                    <span>{{ $isEn ? 'VAT' : 'ضريبة القيمة المضافة' }} ({{ (float) $tax_percentage }}%)</span>
                                    <span class="Tax_txt">{{ money((float) $BeforeTax * $TaxRate) }}</span>
                                </div>
                            </div>

                            <div class="sc-summary__grand">
                                <span>{{ $isEn ? 'Total Amount' : 'المجموع الإجمالي' }}</span>
                                <span id="gt" class="AfterT_txt">{{ money($AfterTax) }}</span>
                            </div>
                            <input type="hidden" name="BeforeT" value="{{ number_format((float) $BeforeTax, 2, '.', '') }}" />

                            <div class="form-check sc-terms">
                                <input class="form-check-input terms" required type="checkbox" value=""
                                    id="flexCheckChecked">
                                <label class="form-check-label" for="flexCheckChecked">
                                    @if ($isEn)
                                        I agree to all <a href="{{ LaravelLocalization::localizeUrl('/terms') }}"
                                            target="_blank">Terms and Conditions</a> of Safer
                                    @else
                                        أوافق على جميع <a href="{{ LaravelLocalization::localizeUrl('/terms') }}"
                                            target="_blank">بنود وشروط</a> Safer
                                    @endif
                                </label>
                            </div>

                            <button type="submit" class="sc-summary__submit" data-sc-submit>
                                {{ $isEn ? 'Place Order' : 'استكمال الطلب' }}
                            </button>
                            <p class="sc-summary__note">
                                <i class="fa-solid fa-circle-info"></i>
                                {{ $isEn ? 'Total includes VAT. Complete each item\'s details before placing the order.' : 'المجموع شامل الضريبة. أكمل بيانات كل عنصر قبل استكمال الطلب.' }}
                            </p>
                        </aside>
                    </div>
                </div>
            </form>
        </section>
    @else
        <section class="sc container">
            <div class="sc-empty">
                <i class="fa-solid fa-cart-shopping"></i>
                <p>{{ $isEn ? 'Nothing is Added to cart' : 'لا شىء مضاف الى عربة التسوق' }}</p>
                <a href="{{ LaravelLocalization::localizeUrl('/tours') }}" class="sc-summary__submit sc-empty__cta">
                    {{ $isEn ? 'Browse tours' : 'تصفح الجولات' }}
                </a>
            </div>
        </section>
    @endif
@endsection

@section('adds_js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.js"></script>
    <script>
        function copyData(id) {
            var data = {
                holder_name: $("#holder-name-" + id).val(),
                holder_mobile: $("#holder-phone-" + id).val(),
                holder_email: $("#holder-email-" + id).val(),
                holder_pickup: $("#holder-pickup-" + id).val(),
                holder_notes: $("#holder-notes-" + id).val(),
            }
            $("#holder-name-" + (id + 1)).val(data.holder_name);
            $("#holder-phone-" + (id + 1)).val(data.holder_mobile);
            $("#holder-email-" + (id + 1)).val(data.holder_email);
            $("#holder-pickup-" + (id + 1)).val(data.holder_pickup);
            $("#holder-notes-" + (id + 1)).val(data.holder_notes);
            scRefreshAllStatuses();
        }

        // Cart item status badge: "Ready" once every required field in the card is valid
        function scRefreshStatus(item) {
            var badge = item.querySelector('[data-sc-status]');
            if (!badge) return;
            var fields = item.querySelectorAll('input[required], textarea[required], select[required]');
            var ready = Array.prototype.every.call(fields, function(f) {
                return f.validity.valid;
            });
            badge.classList.toggle('sc-badge--ready', ready);
            badge.classList.toggle('sc-badge--pending', !ready);
            badge.textContent = ready ? badge.dataset.labelReady : badge.dataset.labelPending;
        }

        function scRefreshAllStatuses() {
            document.querySelectorAll('[data-sc-item]').forEach(scRefreshStatus);
        }

        $("#transHolderFlag").change(function() {
            var price = $("#t_price").val();
            var before_price = $("[name='BeforeT']").val();
            var tax = "{{ $tax_percentage }}";
            var before;
            $(".trans-holder").fadeToggle();
            if ($(".is_holder").attr('required')) {
                $(".is_holder").removeAttr('required');
                $(".t_rec").text('$' + price);
                before = parseFloat(before_price);
            } else {
                $(".is_holder").attr('required', 6);
                $(".t_rec").text('$' + 2.0 * price);
                before = parseFloat(before_price) + parseFloat(price);
            }
            $(".BeforeT_txt").text('$' + before.toFixed(2));
            $(".Tax_txt").text('$' + (before * parseFloat(tax) / 100.0).toFixed(2));
            $(".AfterT_txt").text('$' + (before * (1 + parseFloat(tax) / 100.0)).toFixed(2));
            scRefreshAllStatuses();
        });
    </script>
    <script>
        let localization = "{{ LaravelLocalization::getCurrentLocale() }}"
        $(document).ready(function() {
            var _minDate = "{{ $TransferCost ? $TransferCost->transfer_date : '' }}"
            flatpickr(".transfer_date", {
                enableTime: true,
                dateFormat: "Y-m-d H:i:S",
                minDate: _minDate,
                defaultDate: new Date(_minDate ? _minDate : Date.now()),
                onChange: scRefreshAllStatuses,
            });

            scRefreshAllStatuses();
            $('#sc-form').on('input change', 'input, textarea, select', function() {
                var item = this.closest('[data-sc-item]');
                if (item) scRefreshStatus(item);
            });

            // Required fields can sit inside collapsed cards, where the browser cannot
            // focus them. Expand any card holding an invalid field before validation runs.
            $('[data-sc-submit]').on('click', function() {
                var invalid = this.form.querySelectorAll('input:invalid, textarea:invalid, select:invalid');
                invalid.forEach(function(field) {
                    var panel = field.closest('.collapse');
                    if (panel && !panel.classList.contains('show')) {
                        panel.classList.add('show');
                        var toggle = document.querySelector('[data-bs-target="#' + panel.id + '"]');
                        if (toggle) {
                            toggle.classList.remove('collapsed');
                            toggle.setAttribute('aria-expanded', 'true');
                        }
                    }
                });
            });
        });
        // Remove-from-cart confirmation; on confirm, follows the link's href as before
        $(".delete_trash").click(function(e) {
            e.preventDefault();
            var elem = $(this);
            var isEn = localization === "en";
            $.confirm({
                theme: 'modern',
                rtl: !isEn,
                useBootstrap: false,
                boxWidth: '360px',
                backgroundDismiss: true,
                escapeKey: 'cancel',
                animation: 'scale',
                closeAnimation: 'scale',
                icon: 'fa-solid fa-trash-can',
                title: isEn ? 'Remove item' : 'حذف العنصر',
                content: elem.data('confirm') || (isEn ?
                    'Are you sure you want to remove this item?' :
                    'هل أنت متأكد من حذف هذا العنصر؟'),
                onOpenBefore: function() {
                    this.$el.addClass('sc-confirm');
                },
                // Safer default: Enter/Space on open cancels instead of deleting
                onOpen: function() {
                    this.$$cancel.trigger('focus');
                },
                buttons: {
                    cancel: {
                        text: isEn ? 'Cancel' : 'إلغاء',
                        btnClass: 'sc-confirm__btn sc-confirm__btn--neutral',
                    },
                    confirm: {
                        text: isEn ? 'Yes, Remove' : 'نعم، احذف',
                        btnClass: 'sc-confirm__btn sc-confirm__btn--danger',
                        action: function() {
                            window.location.href = elem.attr("href");
                        },
                    },
                }
            });
        });
    </script>
@endsection
