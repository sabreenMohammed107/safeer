@extends('layout.website.layout', ['Company' => $Company, 'title' => 'Safer | Offers'])

@section('adds_css')
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="stylesheet" href="{{ asset('/website_assets/css/about.css') }}">
    <link rel="stylesheet" href="{{ asset('/website_assets/css/tours.css') }}">
    <link rel="stylesheet" href="{{ asset('/website_assets/css/blog.css') }}">
    <link rel="stylesheet" href="{{ asset('/website_assets/css/offers.css') }}?v={{ filemtime(public_path('website_assets/css/offers.css')) }}">
@endsection

@section('bottom-header')
    @php
        $offerTitle = LaravelLocalization::getCurrentLocale() === 'en' ? $offer->subtitle_en : $offer->subtitle_ar;
    @endphp
    <x-website.header.general :title="$offerTitle ?: __('links.offers')" :breadcrumb="$BreadCrumb" current="" />
@endsection
@section('content')
  <!-- searching for tors section -->
  <section class="container blog_section">
    <div class="row mx-0 ">
        <div class="col-sm-12 col-xl-9">
            <div class="fitered_data hotels">
                <div class="filtrered_cards hotel_details">
                    <div class="row mx-0 p-0">
                        <div class="col-12 ">
                            <div class="card-content">
                                <div class="  hotels_card">
                                  <img  src="{{ asset('uploads/offers') }}/{{ $offer->image }}" class="w-100" loading="lazy" alt=" single blogimage">
                                  <div class="card-body hotel_card_info">
                                    <div class="card_info">

                                      <h5>  @if (LaravelLocalization::getCurrentLocale() === 'en')

                                        {{$offer->subtitle_en}}
                                        @else
                                        {{$offer->subtitle_ar}}
                                        @endif  </h5>
                                      @php
                                          $isFav = session()->get('SiteUser') && in_array($offer->id, $favOfferIds ?? []);
                                      @endphp
                                      <span>
                                          <button type="button"
                                              class="fav-toggle-btn {{ $isFav ? 'is-fav' : '' }}"
                                              data-fav-type="offer" data-fav-id="{{ $offer->id }}"
                                              aria-label="{{ __('links.add_favorites') }}">
                                              <i class="{{ $isFav ? 'fa-solid' : 'fa-regular' }} fa-heart {{ $isFav ? 'is-fav-icon' : '' }}"></i>
                                          </button>
                                      </span>
                                    </div>
                                        <p> @if (LaravelLocalization::getCurrentLocale() === 'en')
                                            {{$offer->city->en_city ?? ""}}

                                            @else
                                            {{$offer->city->ar_city ?? ""}}
                                            @endif
                                            - {{ money($offer->cost) }}

                                        </p>
                                    @if ($offer->start_date || $offer->end_date)
                                        <section class="offer_period" aria-label="{{ __('links.offer_period') }}">
                                            <h6 class="offer_period__title">
                                                <i class="fa-regular fa-calendar"></i> {{ __('links.offer_period') }}
                                            </h6>
                                            <div class="offer_period__range">
                                                @if ($offer->start_date)
                                                    <div class="offer_period__point">
                                                        <span class="offer_period__label">{{ __('links.offer_starts') }}</span>
                                                        <time datetime="{{ $offer->start_date->toDateString() }}">{{ $offer->periodDate('start_date', 'j F Y') }}</time>
                                                    </div>
                                                @endif
                                                @if ($offer->start_date && $offer->end_date)
                                                    <div class="offer_period__line {{ app()->getLocale() === 'ar' ? 'is-rtl' : '' }}" aria-hidden="true">
                                                        <i class="fa-solid fa-plane"></i>
                                                    </div>
                                                @endif
                                                @if ($offer->end_date)
                                                    <div class="offer_period__point">
                                                        <span class="offer_period__label">{{ __('links.offer_ends') }}</span>
                                                        <time datetime="{{ $offer->end_date->toDateString() }}">{{ $offer->periodDate('end_date', 'j F Y') }}</time>
                                                    </div>
                                                @endif
                                            </div>
                                        </section>
                                    @endif
                                    <div class="rich-content">
                                        @if (LaravelLocalization::getCurrentLocale() === 'en')

                                        {!! $offer->offer_enoverview ?? '' !!}
                                        @else
                                        {!! $offer->offer_aroverview ?? '' !!}
                                        @endif
                                     </div>

                                  </div>
                              </div>
                              </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-12 col-xl-3">



            <div class="latest_blog">
                <h6>
                    @if (LaravelLocalization::getCurrentLocale() === 'en')
                        latest Offers
                    @else
                        اخر العروض
                    @endif
                </h6>
                @forelse ($latest as $obj)
                    <div class="blog_details">
                        <a href="{{ LaravelLocalization::localizeUrl('/single-offer/' . $obj->id . '/' . $obj->slug) }}"
                            class="stretched-link">
                        <img class="mx-2" style="height: 100px;width:130px ;min-width:130px" src="{{ asset('uploads/offers') }}/{{ $obj->image }}"
                            loading="lazy" width="130" height="100" alt="latest blog image">
                        </a>
                        <div class="blog_info">
                            <h6 style="margin-bottom: 0;font-size: 16px"> <a href="{{ LaravelLocalization::localizeUrl('/single-offer/' . $obj->id . '/' . $obj->slug) }}"
                                    class="stretched-link">
                                    @if (LaravelLocalization::getCurrentLocale() === 'en')
                                        {{ strip_tags(Str::limit($obj->subtitle_en ?? '', $limit = 50, $end = '')) }}
                                    @else
                                        {{ strip_tags(Str::limit($obj->subtitle_ar ?? '', $limit = 50, $end = '')) }}
                                    @endif

                                </a></h6>
                            <p>
                                @if (LaravelLocalization::getCurrentLocale() === 'en')
                                    {{ $obj->city->en_city ?? '' }}
                                @else
                                    {{ $obj->city->ar_city ?? '' }}
                                @endif



                            </p>
                            <span> {{ money($obj->cost) }}</span>
                        </div>
                    </div>
                @empty
                    {{-- Every offer has expired --}}
                    <p class="offers_sidebar__soon">
                        <i class="fa-solid fa-bell"></i>
                        {{ __('links.offers_coming_soon') }}
                    </p>
                @endforelse


            </div>
        </div>

    </div>
</section>




<!--  ending page  -->
@endsection


