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
                        <div id="table_data">
                            @include('website.offers.offerList')

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
                            <img class="mx-2" style="height: 100px;width:130px" src="{{ asset('uploads/offers') }}/{{ $obj->image }}"
                                alt="latest blog image">
                            <div class="blog_info">
                                <h6 style="margin-bottom: 0;font-size: 16px" > <a href="{{ LaravelLocalization::localizeUrl('/single-offer/' . $obj->id . '/' . $obj->slug) }}"
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

@section('adds_js')
    <script>
        $(document).ready(function() {

            $(document).on('click', '.pagination a', function(event) {
                event.preventDefault();
                var page = $(this).attr('href').split('page=')[1];
                fetch_data(page);
            });

            function fetch_data(page) {
                $.ajax({
                    url: "/offers/fetch_data?page=" + page,
                    success: function(data) {
                        $('#table_data').html(data);
                    }
                });
            }

        });
    </script>
@endsection
