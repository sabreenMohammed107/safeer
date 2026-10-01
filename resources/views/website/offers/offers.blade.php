@extends('layout.website.layout', ['Company' => $Company, 'title' => 'Safer | Offers'])

@section('adds_css')
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="stylesheet" href="{{ asset('/website_assets/css/about.css') }}">
    <link rel="stylesheet" href="{{ asset('/website_assets/css/tours.css') }}">
    <link rel="stylesheet" href="{{ asset('/website_assets/css/blog.css') }}">
    <link rel="stylesheet" href="{{ asset('/website_assets/css/hotel.css') }}">
    <link rel="stylesheet" href="{{ asset('/website_assets/css/offers.css') }}">
@endsection

@section('bottom-header')
    <x-website.header.general title="{{ __('links.offers') }}" :breadcrumb="$BreadCrumb" current="" />
@endsection
@section('content')
    <!-- newsearch section -->
    <section class="booking_hotels_section offers_search container">
        <form id="offers_search_form" action="{{ LaravelLocalization::localizeUrl('/offers') }}" method="GET">
            <div class="hotel_details">
                <div class="row mx-0 p-0">
                    <div class="col-sm-12 col-md-6 col-xl-5 p-s-0 ">
                        <h5> {{ __('links.city') }}</h5>

                        <div class="choices">
                            <i class="fa-solid fa-location-dot"></i>
                            <select class="form-select" id="city_id" name="city_id"
                                aria-label="{{ __('links.city') }}">
                                <option value="">{{ __('links.all_cities') }}</option>
                                @foreach ($Cities as $city)
                                    <option value="{{ $city->id }}" {{ $city_id == $city->id ? 'selected' : '' }}>
                                        @if (LaravelLocalization::getCurrentLocale() === 'en')
                                            {{ $city->en_city }}
                                        @else
                                            {{ $city->ar_city }}
                                        @endif
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="col-sm-12 col-md-6 col-xl-5 p-s-0 ">
                        <h5> {{ __('links.date') }}</h5>

                        <div class="choices">
                            <i class="fa-solid fa-calendar-days"></i>
                            <input type="text" class="form-control" id="offer_date" name="date"
                                value="{{ $date }}" placeholder="{{ __('links.pickDate') }}" autocomplete="off"
                                aria-label="{{ __('links.date') }}">
                        </div>
                    </div>

                    <div class="col-sm-12 col-md-12 col-xl-2">
                        <div class="main search_actions">
                            <button class="btn" type="submit">
                                <i class="fa-solid fa-magnifying-glass me-1"></i> {{ __('links.search') }}
                            </button>
                        </div>
                    </div>

                </div>
            </div>
        </form>
    </section>
    <!--end search -->

    <section class="container offers_results">
        <div class="row mx-0">
            <div class="col-sm-12 col-xl-9">
                <div id="table_data">
                    @include('website.offers.offerList')
                </div>
            </div>
            <div class="col-sm-12 col-xl-3">
                <aside class="offers_sidebar latest_blog">
                    <h6>
                        @if (LaravelLocalization::getCurrentLocale() === 'en')
                            Latest Offers
                        @else
                            اخر العروض
                        @endif
                    </h6>
                    @foreach ($latest as $obj)
                        <div class="offers_sidebar__item">
                            <div class="offers_sidebar__thumb">
                                <img src="{{ asset('uploads/offers') }}/{{ $obj->image }}" loading="lazy" width="84"
                                    height="70" alt="" onerror="this.style.visibility='hidden'">
                            </div>
                            <div class="offers_sidebar__info">
                                <a href="{{ LaravelLocalization::localizeUrl('/single-offer/' . $obj->id . '/' . $obj->slug) }}"
                                    class="stretched-link">
                                    @if (LaravelLocalization::getCurrentLocale() === 'en')
                                        {{ strip_tags($obj->subtitle_en ?? '') }}
                                    @else
                                        {{ strip_tags($obj->subtitle_ar ?? '') }}
                                    @endif
                                </a>
                                <small>
                                    @if (LaravelLocalization::getCurrentLocale() === 'en')
                                        {{ $obj->city->en_city ?? '' }}
                                    @else
                                        {{ $obj->city->ar_city ?? '' }}
                                    @endif
                                </small>
                                <strong>{{ money($obj->cost) }}</strong>
                            </div>
                        </div>
                    @endforeach
                </aside>
            </div>
        </div>
    </section>




    <!--  ending page  -->
@endsection

@section('adds_js')
    <script>
        $(document).ready(function() {
            var $form = $('#offers_search_form');

            flatpickr('#offer_date', {
                dateFormat: 'Y-m-d',
                allowInput: true,
            });

            $form.on('submit', function(event) {
                event.preventDefault();
                fetch_data(1);
            });

            $(document).on('click', '#table_data .pagination a', function(event) {
                event.preventDefault();
                var page = new URL($(this).attr('href'), window.location.origin).searchParams.get('page') || 1;
                fetch_data(page);
            });

            // Filters travel with every request so paging keeps the current search.
            function fetch_data(page) {
                var query = $form.serialize();
                $.ajax({
                    url: "{{ LaravelLocalization::localizeUrl('/offers/fetch_data') }}?" + query + "&page=" + page,
                    success: function(data) {
                        $('#table_data').html(data);
                        // Keep the address bar shareable/refreshable with the active filters.
                        history.replaceState(null, '', $form.attr('action') + '?' + query + (page > 1 ? '&page=' + page : ''));
                    }
                });
            }

        });
    </script>
@endsection
