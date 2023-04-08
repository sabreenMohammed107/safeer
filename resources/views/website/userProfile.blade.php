@extends('layout.website.layout', ['Company' => $Company, 'title' => 'Safer | Profile'])

@section('adds_css')
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="stylesheet" href="{{ asset('/website_assets/css/about.css') }}">
    <link rel="stylesheet" href="{{ asset('/website_assets/css/tours.css') }}">
    <link rel="stylesheet" href="{{ asset('/website_assets/css/hotel.css') }}">
    <link rel="stylesheet" href="{{ asset('/website_assets/css/visa-step-2.css') }}">
    <link rel="stylesheet" href="{{ asset('/website_assets/css/visa-step-3.css') }}">
    <link rel="stylesheet" href="{{ asset('/website_assets/css/my-profile.css') }}">
@endsection

@section('bottom-header')
    <x-website.header.general title="{{ __('links.profile') }} " :breadcrumb="$BreadCrumb" current="" />
@endsection
@section('content')
    <!-- searching for tors section -->
    <section class="container profile_details">
        <div class="row mx-0">
            <div class="col-xl-3 col-md-12 col-sm-12 ">
                <div class="profile_tabs">
                    <div class="nav  faq_tabs flex-column nav-pills me-3" id="v-pills-tab" role="tablist"
                        aria-orientation="vertical">
                        <button class="nav-link active"  @if (LaravelLocalization::getCurrentLocale() === 'ar')

                        style="text-align: right !important"
                        @endif  id="v-pills-account-tab" data-bs-toggle="pill"
                            data-bs-target="#v-pills-account" type="button" role="tab" aria-controls="v-pills-account"
                            aria-selected="true"> <i class="fa-solid fa-user account_icon"></i> {{ __('links.myAccount') }}  </button>
                        <button class="nav-link" @if (LaravelLocalization::getCurrentLocale() === 'ar')

                        style="text-align: right !important"
                        @endif  id="v-pills-favorite-tab" data-bs-toggle="pill"
                            data-bs-target="#v-pills-favorite" type="button" role="tab"
                            aria-controls="v-pills-favorite" aria-selected="false"> <i
                                class="fa-regular fa-heart"></i>{{ __('links.myFavorite') }}  </button>
                        <button class="nav-link" @if (LaravelLocalization::getCurrentLocale() === 'ar')

                        style="text-align: right !important"
                        @endif  id="v-pills-orders-tab" data-bs-toggle="pill"
                            data-bs-target="#v-pills-orders" type="button" role="tab" aria-controls="v-pills-orders"
                            aria-selected="false"><i class="fa-regular fa-file-lines"></i> {{ __('links.myOrder') }}  </button>
                        {{-- <button class="nav-link" id="v-pills-payment-tab" data-bs-toggle="pill"
                            data-bs-target="#v-pills-payment" type="button" role="tab" aria-controls="v-pills-payment"
                            aria-selected="false"><i class="fa-regular fa-file-lines"></i> My payment method </button> --}}
                        <!-- Button trigger modal -->
                        {{-- <button type="button" class="btn logout_button" data-bs-toggle="modal"
                            data-bs-target="#staticBackdrop">
                            <i class="fa-solid fa-arrow-right-from-bracket"></i> Log out
                        </button> --}}

                            {{-- <button type="submit" onclick="" class="btn logout_button" >
                            <i class="fa-solid fa-arrow-right-from-bracket"></i> Log out
                        </button> --}}

                        {{-- <a href="{{ route('siteLogout') }}" class="links hybrid sign_up">Logout</a> --}}

                        <!-- Modal -->
                        @if (session()->get('SiteUser'))
                            <form action="{{ LaravelLocalization::getLocalizedURL($localVar, route('siteLogout'))}}">
                                <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static"
                                    data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel"
                                    aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content log_popup">
                                            <div class="modal-header">


                                                <h5 class="modal-title log_title" id="staticBackdropLabel">{{ __('links.logout') }}  </h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>

                                            <div class="modal-body log_popup_info">
                                                @if (LaravelLocalization::getCurrentLocale() === 'en')

                                                Oh no! You are leaving... <br>
                                                Are you Sure ?
                                                @else
                                                أوه لا! أنت تغادر ... <br>
                                                هل أنت متأكد ؟
                                                @endif

                                            </div>
                                            <div class="modal-footer log_popup_button">
                                                <button type="submit" class="btn">{{ __('links.logout') }} </button>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </form>
                        @endif
                    </div>

                </div>
            </div>
            <div class="col-xl-9 col-md-12 col-sm-12">
                <div class="tab-content" id="v-pills-tabContent">
                    <div class="tab-pane fade show active" id="v-pills-account" role="tabpanel"
                        aria-labelledby="v-pills-account-tab" tabindex="0">
                        <form action="{{ LaravelLocalization::getLocalizedURL($localVar, route('updateProfile'))}}" method="post">
                            @csrf
                            <input type="hidden" name="userId" value="{{ session()->get('SiteUser')['ID'] ?? '' }}" <div
                                class="account_info">
                            <h6 class="profile_heading">
                                <i class="fa-solid fa-user account_icon"></i>{{ __('links.accountinfo') }}
                            </h6>
                            {{-- <div class="profile_change">
                            <img src="./images/my-profile/profile_picture.webp" alt="profile picture">
                            <div class="change">
                                <button> change image profile</button>
                                <span>
                                    Max File Size 500 Kb and Min Size File 500 Mb
                                </span>
                            </div>
                        </div> --}}
                            <div class="profile_info mt-4">

                                <div class="row mx-0">
                                    <div class="col-sm-12 col-md-6">
                                        <label for="fisrtname">{{ __('links.firstName') }} </label>
                                        <input type="text" name="first_name" value="{{ $userSite->first_name }}"
                                            class="form-control" id="fisrtname" placeholder="{{ __('links.firstName') }} ">
                                    </div>
                                    <div class="col-sm-12 col-md-6">
                                        <label for="lastname">{{ __('links.lastName') }} </label>
                                        <input type="text" name="last_name" value="{{ $userSite->last_name }}"
                                            class="form-control" id="lastname" placeholder="{{ __('links.lastName') }} ">
                                    </div>
                                    <div class="col-sm-12 col-md-6">
                                        <label for="email">{{ __('links.email') }}</label>
                                        <input disabled type="email" name="email" value="{{ $userSite->email }}"
                                            class="form-control" id="email" placeholder="{{ __('links.email') }} ">
                                    </div>
                                    <div class="col-sm-12 col-md-6">
                                        <label for="phonenumber">{{ __('links.mobile') }}</label>
                                        <input type="number" name="phone" class="form-control"
                                            value="{{ $userSite->phone }}" id="phonenumber" placeholder="{{ __('links.mobile') }}">
                                    </div>
                                    <div class="col-12">
                                        <label for="address">{{ __('links.address') }}</label>
                                        <input type="text" name="address" class="form-control"
                                            value="{{ $userSite->address }}" id="address" placeholder="{{ __('links.address') }}">
                                    </div>
                                </div>
                                <button type="submit" class="btn submit_button mb-4">{{ __('links.submitProfile') }} </button>


                            </div>
                        </form>


                        {{-- <div class="account_info password">
                            <div class="password_change">
                                <h6 class="profile_heading"> My password </h6>
                                <button class="btn password_button">
                                    change password
                                </button>
                            </div>

                        </div> --}}
                    </div>
                    <div class="tab-pane fade" id="v-pills-favorite" role="tabpanel"
                        aria-labelledby="v-pills-favorite-tab" tabindex="0">
                        <div class="favorite">
                            <div class="heading">
                                <h6 class="profile_heading"><i class="fa-regular fa-heart"></i> {{ __('links.myFavorite') }}  </h6>
                                <div class="left_filter">
                                    <ul class="nav nav-pills " id="pills-tab" role="tablist">
                                        <li class="nav-item" role="presentation">
                                            <button class="nav-link active" id="pills-hotels-tab" data-bs-toggle="pill"
                                                data-bs-target="#pills-hotels" type="button" role="tab"
                                                aria-controls="pills-hotels" aria-selected="true">{{ __('links.hotels') }} </button>
                                        </li>
                                        {{-- <li class="nav-item" role="presentation">
                                        <button class="nav-link" id="pills-tours-tab" data-bs-toggle="pill"
                                            data-bs-target="#pills-tours" type="button" role="tab"
                                            aria-controls="pills-tours" aria-selected="false"> tours</button>
                                    </li>
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link" id="pills-trips-tab" data-bs-toggle="pill"
                                            data-bs-target="#pills-trips" type="button" role="tab"
                                            aria-controls="pills-trips" aria-selected="false"> trips</button>
                                    </li> --}}
                                    </ul>
                                </div>
                            </div>
                            <div class="filters_items">
                                <div class="row mx-0">
                                    <div class="col-sm-12 p-0">
                                        <div class="tab-content" id="pills-tabContent">
                                            <div class="tab-pane fade show active w-100" id="pills-hotels"
                                                role="tabpanel" aria-labelledby="pills-hotels-tab" tabindex="0">
                                                <div id="loadData">
                                                    <?php
                                                    $last_id = 0;

                                                    ?>
                                                    @foreach ($data as $fav)
                                                    @if($fav->hotel)
                                                        <div class="card-content">
                                                            <div class=" card setted_tour_cards ">
                                                                <div class="card_image">
                                                                    <div class="image_overlay">
                                                                        <img src="{{ asset('uploads/hotels') }}/{{ $fav->hotel->hotel_banner ?? '' }}"
                                                                            alt=" blogimage">
                                                                    </div>
                                                                </div>
                                                                <div class="card-body  setted_info">
                                                                    <div class="card_info">
                                                                        <h6> @if (LaravelLocalization::getCurrentLocale() === 'en')
                                                                            {{ $fav->hotel->hotel_enname ?? '' }}

                                                                            @else
                                                                            {{ $fav->hotel->hotel_arname ?? '' }}
                                                                            @endif –
                                                                            {{ $fav->hotel->hotel_stars ?? ''}} Stars</h6>
                                                                        <span>
                                                                            <i class="fa-regular fa-heart"></i>
                                                                        </span>
                                                                    </div>
                                                                    @if (LaravelLocalization::getCurrentLocale() === 'en')

                                                                    <span> <i class="fa-solid fa-location-dot"></i>
                                                                        {{ $fav->hotel->city->country->en_country ?? '' }}
                                                                        <span>|</span>
                                                                        {{ $fav->hotel->city->en_city ?? '' }}</span>
                                                                    <p>
                                                                        {!! \Illuminate\Support\Str::limit($fav->hotel->hotel_enoverview ?? '', $limit = 200, $end = '') !!}

                                                                    </p>
                                                                    @else
                                                                    <span> <i class="fa-solid fa-location-dot"></i>
                                                                        {{ $fav->hotel->city->country->ar_country ?? '' }}
                                                                        <span>|</span>
                                                                        {{ $fav->hotel->city->ar_city ?? '' }}</span>
                                                                    <p>
                                                                        {!! \Illuminate\Support\Str::limit($fav->hotel->hotel_aroverview ?? '', $limit = 200, $end = '') !!}

                                                                    </p>
                                                                    @endif

                                                                    <div class="price">
                                                                        <div class="rating">

                                                                            @for ($i = 0; $i < $fav->hotel->hotel_stars; $i++)
                                                                                <i class="fa-solid fa-star"></i>
                                                                            @endfor
                                                                            @for ($i = 5; $i > $fav->hotel->hotel_stars; $i--)
                                                                                <i class="fa-regular fa-star"></i>
                                                                            @endfor

                                                                            <span> ({{ $fav->hotel->totalreviews }} {{ __('links.review') }})
                                                                            </span>
                                                                        </div>
                                                                        {{-- <span class="hotels_price"> $ 140</span> --}}
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        @php
                                                            $last_id = $fav->id;

                                                        @endphp
                                                        @endif
                                                    @endforeach

                                                </div>



                                            </div>
                                            <div class="tab-pane fade w-100" id="pills-tours" role="tabpanel"
                                                aria-labelledby="pills-tours-tab" tabindex="0">

                                                <div class="card-content">
                                                    <div class=" card setted_tour_cards ">
                                                        <div class="card_image">
                                                            <div class="image_overlay">
                                                                <img src="./images/homePage/hotels/hotel-1.webp"
                                                                    alt=" blogimage">
                                                            </div>
                                                        </div>
                                                        <div class="card-body  setted_info">
                                                            <div class="card_info">
                                                                <h6>Venice, Rome and Milan – 9 Days 8</h6>
                                                                <span>
                                                                    <i class="fa-regular fa-heart"></i>
                                                                </span>
                                                            </div>
                                                            <span> <i class="fa-solid fa-location-dot"></i> turkey
                                                                <span>|</span> istanbul</span>
                                                            <p>
                                                                Amet minim mollit non deserunt ullamco est sit aliqua dolor
                                                                do
                                                                amet
                                                            </p>
                                                            <div class="price">
                                                                <div class="rating">

                                                                    <i class="fa-solid fa-star"></i>
                                                                    <i class="fa-solid fa-star"></i>
                                                                    <i class="fa-solid fa-star"></i>
                                                                    <i class="fa-solid fa-star"></i>
                                                                    <i class="fa-regular fa-star"></i>

                                                                    <span> ( 5 review) </span>
                                                                </div>
                                                                <span class="hotels_price"> $ 140</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>


                                                <div class="card-content">
                                                    <div class=" card setted_tour_cards ">
                                                        <div class="card_image">
                                                            <div class="image_overlay">
                                                                <img src="./images/homePage/hotels/hotel-4.webp"
                                                                    alt=" blogimage">
                                                            </div>
                                                        </div>
                                                        <div class="card-body  setted_info">
                                                            <div class="card_info">
                                                                <h6>Venice, Rome and Milan – 9 Days 8</h6>
                                                                <span>
                                                                    <i class="fa-regular fa-heart"></i>
                                                                </span>
                                                            </div>
                                                            <span> <i class="fa-solid fa-location-dot"></i> turkey
                                                                <span>|</span> istanbul</span>
                                                            <p>
                                                                Amet minim mollit non deserunt ullamco est sit aliqua dolor
                                                                do
                                                                amet
                                                            </p>
                                                            <div class="price">
                                                                <div class="rating">

                                                                    <i class="fa-solid fa-star"></i>
                                                                    <i class="fa-solid fa-star"></i>
                                                                    <i class="fa-solid fa-star"></i>
                                                                    <i class="fa-solid fa-star"></i>
                                                                    <i class="fa-regular fa-star"></i>

                                                                    <span> ( 5 review) </span>
                                                                </div>
                                                                <span class="hotels_price"> $ 140</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>


                                                <div class="card-content">
                                                    <div class=" card setted_tour_cards ">
                                                        <div class="card_image">
                                                            <div class="image_overlay">
                                                                <img src="./images/homePage/hotels/hotel-5.webp"
                                                                    alt=" blogimage">
                                                            </div>
                                                        </div>
                                                        <div class="card-body  setted_info">
                                                            <div class="card_info">
                                                                <h6>Venice, Rome and Milan – 9 Days 8</h6>
                                                                <span>
                                                                    <i class="fa-regular fa-heart"></i>
                                                                </span>
                                                            </div>
                                                            <span> <i class="fa-solid fa-location-dot"></i> turkey
                                                                <span>|</span> istanbul</span>
                                                            <p>
                                                                Amet minim mollit non deserunt ullamco est sit aliqua dolor
                                                                do
                                                                amet
                                                            </p>
                                                            <div class="price">
                                                                <div class="rating">

                                                                    <i class="fa-solid fa-star"></i>
                                                                    <i class="fa-solid fa-star"></i>
                                                                    <i class="fa-solid fa-star"></i>
                                                                    <i class="fa-solid fa-star"></i>
                                                                    <i class="fa-regular fa-star"></i>

                                                                    <span> ( 5 review) </span>
                                                                </div>
                                                                <span class="hotels_price"> $ 140</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>



                                                <div class="card-content">
                                                    <div class=" card setted_tour_cards ">
                                                        <div class="card_image">
                                                            <div class="image_overlay">
                                                                <img src="./images/homePage/hotels/hotel-3.webp"
                                                                    alt=" blogimage">
                                                            </div>
                                                        </div>

                                                        <div class="card-body  setted_info">
                                                            <div class="card_info">
                                                                <h6>Venice, Rome and Milan – 9 Days 8</h6>
                                                                <span>
                                                                    <i class="fa-regular fa-heart"></i>
                                                                </span>
                                                            </div>
                                                            <span> <i class="fa-solid fa-location-dot"></i> turkey
                                                                <span>|</span> istanbul</span>
                                                            <p>
                                                                Amet minim mollit non deserunt ullamco est sit aliqua dolor
                                                                do
                                                                amet
                                                            </p>
                                                            <div class="price">
                                                                <div class="rating">

                                                                    <i class="fa-solid fa-star"></i>
                                                                    <i class="fa-solid fa-star"></i>
                                                                    <i class="fa-solid fa-star"></i>
                                                                    <i class="fa-solid fa-star"></i>
                                                                    <i class="fa-regular fa-star"></i>

                                                                    <span> ( 5 review) </span>
                                                                </div>
                                                                <span class="hotels_price"> $ 140</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>


                                                <div class="card-content">
                                                    <div class=" card setted_tour_cards ">
                                                        <div class="card_image">
                                                            <div class="image_overlay">
                                                                <img src="./images/homePage/hotels/hotel-4.webp"
                                                                    alt=" blogimage">
                                                            </div>
                                                        </div>
                                                        <div class="card-body  setted_info">
                                                            <div class="card_info">
                                                                <h6>Venice, Rome and Milan – 9 Days 8</h6>
                                                                <span>
                                                                    <i class="fa-regular fa-heart"></i>
                                                                </span>
                                                            </div>
                                                            <span> <i class="fa-solid fa-location-dot"></i> turkey
                                                                <span>|</span> istanbul</span>
                                                            <p>
                                                                Amet minim mollit non deserunt ullamco est sit aliqua dolor
                                                                do
                                                                amet
                                                            </p>
                                                            <div class="price">
                                                                <div class="rating">

                                                                    <i class="fa-solid fa-star"></i>
                                                                    <i class="fa-solid fa-star"></i>
                                                                    <i class="fa-solid fa-star"></i>
                                                                    <i class="fa-solid fa-star"></i>
                                                                    <i class="fa-regular fa-star"></i>

                                                                    <span> ( 5 review) </span>
                                                                </div>
                                                                <span class="hotels_price"> $ 140</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>


                                            </div>
                                            <div class="tab-pane fade w-100" id="pills-trips" role="tabpanel"
                                                aria-labelledby="pills-trips-tab" tabindex="0">

                                                <div class="card-content">
                                                    <div class=" card setted_tour_cards ">
                                                        <div class="card_image">
                                                            <div class="image_overlay">
                                                                <img src="./images/homePage/hotels/hotel-1.webp"
                                                                    alt=" blogimage">
                                                            </div>
                                                        </div>
                                                        <div class="card-body  setted_info">
                                                            <div class="card_info">
                                                                <h6>Venice, Rome and Milan – 9 Days 8</h6>
                                                                <span>
                                                                    <i class="fa-regular fa-heart"></i>
                                                                </span>
                                                            </div>
                                                            <span> <i class="fa-solid fa-location-dot"></i> turkey
                                                                <span>|</span> istanbul</span>
                                                            <p>
                                                                Amet minim mollit non deserunt ullamco est sit aliqua dolor
                                                                do
                                                                amet
                                                            </p>
                                                            <div class="price">
                                                                <div class="rating">

                                                                    <i class="fa-solid fa-star"></i>
                                                                    <i class="fa-solid fa-star"></i>
                                                                    <i class="fa-solid fa-star"></i>
                                                                    <i class="fa-solid fa-star"></i>
                                                                    <i class="fa-regular fa-star"></i>

                                                                    <span> ( 5 review) </span>
                                                                </div>
                                                                <span class="hotels_price"> $ 140</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>


                                                <div class="card-content">
                                                    <div class=" card setted_tour_cards ">
                                                        <div class="card_image">
                                                            <div class="image_overlay">
                                                                <img src="./images/homePage/hotels/hotel-4.webp"
                                                                    alt=" blogimage">
                                                            </div>
                                                        </div>
                                                        <div class="card-body  setted_info">
                                                            <div class="card_info">
                                                                <h6>Venice, Rome and Milan – 9 Days 8</h6>
                                                                <span>
                                                                    <i class="fa-regular fa-heart"></i>
                                                                </span>
                                                            </div>
                                                            <span> <i class="fa-solid fa-location-dot"></i> turkey
                                                                <span>|</span> istanbul</span>
                                                            <p>
                                                                Amet minim mollit non deserunt ullamco est sit aliqua dolor
                                                                do
                                                                amet
                                                            </p>
                                                            <div class="price">
                                                                <div class="rating">

                                                                    <i class="fa-solid fa-star"></i>
                                                                    <i class="fa-solid fa-star"></i>
                                                                    <i class="fa-solid fa-star"></i>
                                                                    <i class="fa-solid fa-star"></i>
                                                                    <i class="fa-regular fa-star"></i>

                                                                    <span> ( 5 review) </span>
                                                                </div>
                                                                <span class="hotels_price"> $ 140</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>


                                                <div class="card-content">
                                                    <div class=" card setted_tour_cards ">
                                                        <div class="card_image">
                                                            <div class="image_overlay">
                                                                <img src="./images/homePage/hotels/hotel-5.webp"
                                                                    alt=" blogimage">
                                                            </div>
                                                        </div>
                                                        <div class="card-body  setted_info">
                                                            <div class="card_info">
                                                                <h6>Venice, Rome and Milan – 9 Days 8</h6>
                                                                <span>
                                                                    <i class="fa-regular fa-heart"></i>
                                                                </span>
                                                            </div>
                                                            <span> <i class="fa-solid fa-location-dot"></i> turkey
                                                                <span>|</span> istanbul</span>
                                                            <p>
                                                                Amet minim mollit non deserunt ullamco est sit aliqua dolor
                                                                do
                                                                amet
                                                            </p>
                                                            <div class="price">
                                                                <div class="rating">

                                                                    <i class="fa-solid fa-star"></i>
                                                                    <i class="fa-solid fa-star"></i>
                                                                    <i class="fa-solid fa-star"></i>
                                                                    <i class="fa-solid fa-star"></i>
                                                                    <i class="fa-regular fa-star"></i>

                                                                    <span> ( 5 review) </span>
                                                                </div>
                                                                <span class="hotels_price"> $ 140</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>



                                                <div class="card-content">
                                                    <div class=" card setted_tour_cards ">
                                                        <div class="card_image">
                                                            <div class="image_overlay">
                                                                <img src="./images/homePage/hotels/hotel-3.webp"
                                                                    alt=" blogimage">
                                                            </div>
                                                        </div>

                                                        <div class="card-body  setted_info">
                                                            <div class="card_info">
                                                                <h6>Venice, Rome and Milan – 9 Days 8</h6>
                                                                <span>
                                                                    <i class="fa-regular fa-heart"></i>
                                                                </span>
                                                            </div>
                                                            <span> <i class="fa-solid fa-location-dot"></i> turkey
                                                                <span>|</span> istanbul</span>
                                                            <p>
                                                                Amet minim mollit non deserunt ullamco est sit aliqua dolor
                                                                do
                                                                amet
                                                            </p>
                                                            <div class="price">
                                                                <div class="rating">

                                                                    <i class="fa-solid fa-star"></i>
                                                                    <i class="fa-solid fa-star"></i>
                                                                    <i class="fa-solid fa-star"></i>
                                                                    <i class="fa-solid fa-star"></i>
                                                                    <i class="fa-regular fa-star"></i>

                                                                    <span> ( 5 review) </span>
                                                                </div>
                                                                <span class="hotels_price"> $ 140</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>


                                                <div class="card-content">
                                                    <div class=" card setted_tour_cards ">
                                                        <div class="card_image">
                                                            <div class="image_overlay">
                                                                <img src="./images/homePage/hotels/hotel-4.webp"
                                                                    alt=" blogimage">
                                                            </div>
                                                        </div>
                                                        <div class="card-body  setted_info">
                                                            <div class="card_info">
                                                                <h6>Venice, Rome and Milan – 9 Days 8</h6>
                                                                <span>
                                                                    <i class="fa-regular fa-heart"></i>
                                                                </span>
                                                            </div>
                                                            <span> <i class="fa-solid fa-location-dot"></i> turkey
                                                                <span>|</span> istanbul</span>
                                                            <p>
                                                                Amet minim mollit non deserunt ullamco est sit aliqua dolor
                                                                do
                                                                amet
                                                            </p>
                                                            <div class="price">
                                                                <div class="rating">

                                                                    <i class="fa-solid fa-star"></i>
                                                                    <i class="fa-solid fa-star"></i>
                                                                    <i class="fa-solid fa-star"></i>
                                                                    <i class="fa-solid fa-star"></i>
                                                                    <i class="fa-regular fa-star"></i>

                                                                    <span> ( 5 review) </span>
                                                                </div>
                                                                <span class="hotels_price"> $ 140</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>


                                            </div>
                                        </div>

                                    </div>
                                    <input type="text" style="opacity: 0;" id="last"
                                        value="{{ $last_id }}">
                                    @if ($data->count() >= 1 && $allRows->count() > $data->count())
                                        <button id="loadBtn"
                                            onclick="loadMoreData(document.getElementById('last').value);"
                                            class="btn load_button">Load More Rooms</button>
                                    @endif
                                    {{-- <button class="btn load_button">
                                        load more
                                    </button> --}}
                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="v-pills-orders" role="tabpanel" aria-labelledby="v-pills-orders-tab"
                        tabindex="0">
                        <div class="orders">
                            <h6 class="profile_heading"><i class="fa-regular fa-file-lines"></i>{{ __('links.myOrder') }}  </h6>

                            <div class="orders_info">
                                <div class="passenger_info">
                                    <div class="passenger_table">
                                        <div class="row mx-0">
                                            <table class="table">
                                                <thead class="table-light">
                                            {{-- <table class="table table-light table-striped">
                                                <thead> --}}
                                                    <tr>


                                                      @if (LaravelLocalization::getCurrentLocale() === 'en')

                                                      <th scope="col">Hotel Name</th>
                                                      <th scope="col">Start Date / End Date</th>
                                                      <th scope="col">Room Type</th>
                                                      <th scope="col">Adults</th>
                                                      <th scope="col">Children</th>
                                                      <th scope="col">Room Count</th>
                                                      <th scope="col">Total Order Cost</th>
                                                      @else
                                                      <th scope="col">اسم الفندق</th>
                                                      <th scope="col">تاريخ البداية / تاريخ النهاية</th>
                                                      <th scope="col">نوع الغرفة</th>
                                                      <th scope="col">بالغين</th>
                                                      <th scope="col">اطفال</th>
                                                      <th scope="col">تكلفة الغرفة</th>
                                                      <th scope="col">تكلفة الطلب</th>
                                                      @endif
                                                    </tr>
                                                  </thead>
                                                  <tbody>
                                                    @foreach ($orderData as $order)
                                                    <tr>

                                                        <td> @if (LaravelLocalization::getCurrentLocale() === 'en')
                                                            {{$order->hotel->hotel_enname ?? ''}}

                                                            @else
                                                            {{$order->hotel->hotel_arname ?? ''}}
                                                            @endif</td>
                                                        <td>{{ $order->order->from_date }} / {{ $order->order->to_date }}</td>
                                                        <td>{{ $order->room_type }}</td>
                                                        <td>{{ $order->order->adults_count }}</td>
                                                        <td>{{ $order->order->children_count }}</td>
                                                        <td>{{ $order->order->rooms_count }}</td>
                                                        <td>{{ $order->total_cost }}</td>
                                                      </tr>
                                                    @endforeach


                                                  </tbody>
                                              </table>
                                            {{-- <div class=" col p-0 info_edit">
                                                <div class="info">
                                                    <span class="name main_row"> reservation no </span>
                                                    <span class="name">222187597 </span>
                                                    <span class="name">222187597 </span>
                                                    <span class="name rejected">222187597 </span>
                                                    <span class="name">222187597 </span>
                                                    <span class="name">222187597 </span>
                                                </div>
                                            </div>
                                            <div class=" col p-0 info_edit  ">
                                                <div class="info">
                                                    <span class="main_row"> Booking time </span>
                                                    <span>04.09.2022</span>
                                                    <span>04.09.2022</span>
                                                    <span class="rejected">04.09.2022</span>
                                                    <span>04.09.2022</span>
                                                    <span>04.09.2022</span>
                                                </div>
                                            </div>
                                            <div class=" col p-0 info_edit  ">
                                                <div class="info">
                                                    <span class="main_row"> check in </span>
                                                    <span>04.09.2022</span>
                                                    <span>04.09.2022</span>
                                                    <span class="rejected">04.09.2022</span>
                                                    <span>04.09.2022</span>
                                                    <span>04.09.2022</span>
                                                </div>
                                            </div>
                                            <div class=" col p-0 info_edit ">
                                                <div class="info">
                                                    <span class="main_row"> service </span>
                                                    <span> Piya Sport Hotel </span>
                                                    <span> Piya Sport Hotel </span>
                                                    <span class="rejected"> Piya Sport Hotel </span>
                                                    <span> Piya Sport Hotel </span>
                                                    <span> Piya Sport Hotel </span>

                                                </div>
                                            </div>
                                            <div class=" col p-0 info_edit ">
                                                <div class="info">
                                                    <span class="main_row"> Payment Type </span>
                                                    <span> Credit Card</span>
                                                    <span> Credit Card</span>
                                                    <span class="rejected"> Credit Card</span>
                                                    <span> Credit Card</span>
                                                    <span> Credit Card</span>

                                                </div>
                                            </div>
                                            <div class=" col p-0 info_edit ">
                                                <div class="info">
                                                    <span class="main_row"> status </span>
                                                    <span> Confirmed</span>
                                                    <span> Confirmed</span>
                                                    <span class="rejected"> rejected</span>
                                                    <span> Confirmed</span>
                                                    <span> Confirmed</span>

                                                </div>
                                            </div>
                                            <div class=" col p-0 info_edit ">
                                                <div class="info">
                                                    <span class="total main_row"> total </span>
                                                    <span class="total"> 48,90 EUR</span>
                                                    <span class="total"> 48,90 EUR</span>
                                                    <span class="total rejected"> 48,90 EUR</span>
                                                    <span class="total"> 48,90 EUR</span>
                                                    <span class="total"> 48,90 EUR</span>
                                                </div>
                                            </div> --}}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="v-pills-payment" role="tabpanel"
                        aria-labelledby="v-pills-payment-tab" tabindex="0">
                        <div class="payment">
                            <h6 class="profile_heading"><i class="fa-regular fa-file-lines"></i> my payment method </h6>
                            <span>
                                All Transactions are secure and encrypted
                            </span>
                            <div class="payment_option">
                                <div class="visa_info">
                                    <div class="form-check visa ">
                                        <div class="info">
                                            <input class="form-check-input" type="radio" name="visa-info"
                                                id="visa-info-1" value="option1" checked>
                                            <div class="visa_details">
                                                <label class="form-check-label" for="visa-info-1">
                                                    Visa ....... 4242
                                                </label>
                                                <span>Ahmed Mohamed </span>
                                            </div>
                                        </div>
                                        <div class="edits">
                                            <div class="edit">
                                                <i class="fa-solid fa-pen-to-square"></i> edit
                                            </div>
                                            <div class="delete">
                                                <i class="fa-solid fa-xmark"></i> delete
                                            </div>
                                        </div>


                                    </div>
                                    <div class="form-check visa ">
                                        <div class="info">
                                            <input class="form-check-input" type="radio" name="visa-info"
                                                id="visa-info-2" value="option2">
                                            <div class="visa_details">
                                                <label class="form-check-label" for="visa-info-2">
                                                    Visa ....... 4242
                                                </label>
                                                <span>Ahmed Mohamed </span>
                                            </div>
                                        </div>
                                        <div class="edits">
                                            <div class="edit">
                                                <i class="fa-solid fa-pen-to-square"></i> edit
                                            </div>
                                            <div class="delete">
                                                <i class="fa-solid fa-xmark"></i> delete
                                            </div>
                                        </div>


                                    </div>
                                    <div class="form-check visa add_card">
                                        <div class="new_card">
                                            <div>
                                                <input class="form-check-input" type="radio" name="visa-info"
                                                    id="visa-info-3" value="option2">
                                                <label class="form-check-label" for="visa-info-3">
                                                    Credit or debit card
                                                </label>
                                            </div>
                                            <div class="visa_types">
                                                <img src="{{ asset('/website_assets/images/visa-steps/payment options/visa.webp') }}"
                                                    alt="visa card">
                                                <img src="{{ asset('/website_assets/images/visa-steps/payment options/master_card.webp') }}"
                                                    alt="master card">
                                                <img src="{{ asset('/website_assets/images/visa-steps/payment options/american-express.webp') }}"
                                                    alt="american express">
                                                <img src="{{ asset('/website_assets/images/visa-steps/payment options/discover.webp') }}"
                                                    alt="discover">
                                                <img src="{{ asset('/website_assets/images/visa-steps/payment options/diners-club.webp') }}"
                                                    alt="diners-club">
                                                <img src="{{ asset('/website_assets/images/visa-steps/payment options/paypal.webp') }}"
                                                    alt="paypal">
                                            </div>
                                        </div>
                                        <div class="new_card_form">
                                            <form action="">
                                                <div class="row">
                                                    <div class="col-sm-12 col-md-12 col-xl-8">
                                                        <div class="card_inputs">
                                                            <label for="ccnum">Credit card number</label>
                                                            <input type="text" class="form-control" id="ccnum"
                                                                placeholder="Card Number">
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-12 col-md-6 col-xl-2">
                                                        <div class="card_inputs">
                                                            <label for="expirationdate">Expiration (mm/yy)</label>
                                                            <input type="number" class="form-control"
                                                                id="expirationdate" placeholder="M/Y">
                                                            <!-- <input id="expirationdate" type="number" pattern="[0-9]*" inputmode="numeric"> -->
                                                        </div>

                                                    </div>
                                                    <div class="col-sm-12 col-md-6 col-xl-2">
                                                        <div class="card_inputs">
                                                            <label for="cvv">CCV</label>
                                                            <input type="number" class="form-control" id="cvv"
                                                                placeholder="CCV">
                                                            <!-- <input id="securitycode" type="number" pattern="[0-9]*" inputmode="numeric"> -->
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="billing_info">
                                                        <h6> billing iformation</h6>
                                                    </div>
                                                    <div class="col-sm-12 col-md-6">
                                                        <div class="card_inputs">
                                                            <label for="fisrtname">First name </label>
                                                            <input type="text" class="form-control" id="fisrtname"
                                                                placeholder="First Name ">
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-12 col-md-6">
                                                        <div class="card_inputs">
                                                            <label for="lastname">Last name </label>
                                                            <input type="text" class="form-control" id="lastname"
                                                                placeholder="Last Name ">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-sm-12 col-md-9">
                                                        <div class="card_inputs">
                                                            <label for="address">Address 1</label>
                                                            <input type="text" class="form-control" id="address"
                                                                placeholder="Address">
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-12 col-md-3">
                                                        <div class="card_inputs">
                                                            <label for="country">country</label>
                                                            <select class="form-select"
                                                                aria-label="Default select example">
                                                                <option selected=""> country</option>
                                                                <option value="1">country 1</option>
                                                                <option value="2">country 2</option>
                                                                <option value="3">country 3</option>
                                                            </select>
                                                        </div>

                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-sm-12 col-md-4">
                                                        <div class="card_inputs">
                                                            <label for="city">city</label>
                                                            <select class="form-select"
                                                                aria-label="Default select example">
                                                                <option selected=""> city</option>
                                                                <option value="1">city 1</option>
                                                                <option value="2">city 2</option>
                                                                <option value="3">city 3</option>
                                                            </select>
                                                        </div>

                                                    </div>
                                                    <div class="col-sm-12 col-md-4">
                                                        <div class="card_inputs">
                                                            <label for="state">state</label>
                                                            <select class="form-select"
                                                                aria-label="Default select example">
                                                                <option selected=""> state</option>
                                                                <option value="1">state 1</option>
                                                                <option value="2">state 2</option>
                                                                <option value="3">state 3</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-12 col-md-4">
                                                        <div class="card_inputs">
                                                            <label for="postalcode">Postal Code </label>
                                                            <input type="number" class="form-control" id="postalcode"
                                                                min="0" placeholder="Postal Code ">
                                                        </div>
                                                    </div>
                                                </div>
                                                <button class="btn add_card_button">
                                                    add card
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>


        </div>
    </section>


    <script>
        function loadMoreData(id) {

            $.ajax({
                url: '{{ url('load-rooms-data') }}',
                data: {
                    id: id,

                },

                type: "GET",
                headers: {
                    'X-CSRF-Token': '{{ csrf_token() }}',
                },
                success: function(data) {

                    $('#loadData').append(data.output);
                    document.getElementById('last').value = data.last_id;
                    if (data.last_id <= 1) {

                        document.getElementById('loadBtn').style.display = 'none';
                    } else {

                        document.getElementById('loadBtn').style.display = 'block';
                    }

                },
                error: function() {

                    document.getElementById('loadBtn').style.display = 'none';
                }

            });
        }
    </script>
    <!--  ending page  -->
@endsection
