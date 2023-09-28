@extends('layout.website.layout', ['Company' => $Company, 'title' => 'Safer | Blogs'])

@section('adds_css')
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="stylesheet" href="{{ asset('/website_assets/css/about.css') }}">
    <link rel="stylesheet" href="{{ asset('/website_assets/css/tours.css') }}">
    <link rel="stylesheet" href="{{ asset('/website_assets/css/blog.css') }}">
@endsection

@section('bottom-header')
    <x-website.header.general title="{{ __('links.blogs') }}" :breadcrumb="$BreadCrumb" current="" />
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
                                  <img src="{{ asset('uploads/blogs') }}/{{$blog->image}}" class="w-100" alt=" single blogimage">
                                  <div class="card-body hotel_card_info">
                                    <div class="card_info">
                                      <h5>  @if (LaravelLocalization::getCurrentLocale() === 'en')

                                        {!! $blog->en_title ?? '' !!}
                                        @else
                                        {!! $blog->ar_title ?? '' !!}
                                        @endif  </h5>
                                    <p>
                                        @if (LaravelLocalization::getCurrentLocale() === 'en')

                                        {!! $blog->en_text ?? '' !!}
                                        @else
                                        {!! $blog->ar_text ?? '' !!}
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
        </div>
        <div class="col-sm-12 col-xl-3">
            <button class="btn filtered_button" onclick="openFilter()" id="filterButton">
              <i class="fa-solid fa-sliders"></i>   {{ __('links.categories') }}
            </button>
              <div class="categories_section" id="filtered-menu">
                <h6> {{ __('links.categories') }} </h6>
                @foreach ($categories as $category)
                <div class="categories">
                    <span> @if (LaravelLocalization::getCurrentLocale() === 'en')

                        {{$category->en_category}}
                        @else
                        {{$category->ar_category}}
                        @endif</span>
                    <span>(1)</span>
                  </div>
                @endforeach

                <div class="blog_img">

                  <img src="{{ asset('/website_assets/images/blog/banner.webp') }}" alt="banner image">
                </div>
              </div>

              <div class="latest_blog">
                <h6> @if (LaravelLocalization::getCurrentLocale() === 'en')

                    latest blog
                    @else
                  اخرالمقالات
                    @endif </h6>
                @foreach ($latest as $obj)
                <div class="blog_details">
                    <img src="{{ asset('uploads/blogs') }}/{{$obj->image}}" alt="latest blog image"
                    @if (LaravelLocalization::getCurrentLocale() === 'en')

                       style="margin-right: 20px;margin-left: 0;"
                @else
                style="margin-left: 20px;margin-right: 0;"
                @endif  >
                    <div class="blog_info">
                      <h6> <a href="{{ LaravelLocalization::localizeUrl('/single-blog/'.$obj->id.'/'.$obj->slug) }}" class="stretched-link">

                        @if (LaravelLocalization::getCurrentLocale() === 'en')

                        {{ strip_tags(Str::limit($obj->en_title ?? '', $limit = 50, $end = '')) }}
                @else
                {{ strip_tags(Str::limit($obj->ar_title ?? '', $limit = 50, $end = '')) }}
                @endif

                    </a></h6>
                      <p>
                        @if (LaravelLocalization::getCurrentLocale() === 'en')

                        {{Str::limit($obj->en_bref ?? '', $limit = 300, $end = '...') }}
                        @else
                        {{Str::limit($obj->ar_bref ?? '', $limit = 300, $end = '...') }}
                        @endif

                      </p>
                      {{-- <span> 20 nov 2020</span> --}}
                    </div>
                  </div>
                @endforeach


              </div>
        </div>

    </div>
</section>




<!--  ending page  -->
@endsection


