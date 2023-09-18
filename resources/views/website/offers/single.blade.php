@extends('layout.website.layout', ['Company' => $Company, 'title' => 'Safer | Offers'])

@section('adds_css')
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="stylesheet" href="{{ asset('/website_assets/css/about.css') }}">
    <link rel="stylesheet" href="{{ asset('/website_assets/css/tours.css') }}">
    <link rel="stylesheet" href="{{ asset('/website_assets/css/blog.css') }}">
@endsection

@section('bottom-header')
    <x-website.header.general title="{{ __('links.offers') }}" :breadcrumb="$BreadCrumb" current="" />
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
                                  <img  src="{{ asset('uploads/offers') }}/{{ $offer->image }}" class="w-100" alt=" single blogimage">
                                  <div class="card-body hotel_card_info">
                                    <div class="card_info">

                                      <h5>  @if (LaravelLocalization::getCurrentLocale() === 'en')

                                        {{$offer->subtitle_en}}
                                        @else
                                        {{$offer->subtitle_ar}}
                                        @endif  </h5>
                                    </div>
                                        <p> @if (LaravelLocalization::getCurrentLocale() === 'en')
                                            {{$offer->city->en_city ?? ""}}

                                            @else
                                            {{$offer->city->ar_city ?? ""}}
                                            @endif
                                            - {{ $offer->cost }} $

                                        </p>
                                    <p>
                                        @if (LaravelLocalization::getCurrentLocale() === 'en')

                                        {!! $blog->offer_enoverview ?? '' !!}
                                        @else
                                        {!! $blog->offer_aroverview ?? '' !!}
                                        @endif
                                     </p>

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
                @foreach ($latest as $obj)
                    <div class="blog_details">
                        <img class="mx-2" style="height: 100px;width:130px ;min-width:130px" src="{{ asset('uploads/offers') }}/{{ $obj->image }}"
                            alt="latest blog image">
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
                            <span> {{ $obj->cost }} $</span>
                        </div>
                    </div>
                @endforeach


            </div>
        </div>

    </div>
</section>




<!--  ending page  -->
@endsection


