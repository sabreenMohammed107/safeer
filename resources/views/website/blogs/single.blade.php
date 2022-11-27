@extends('layout.website.layout', ['Company' => $Company, 'title' => 'Safer | Blogs'])

@section('adds_css')
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="stylesheet" href="{{ asset('/website_assets/css/about.css') }}">
    <link rel="stylesheet" href="{{ asset('/website_assets/css/tours.css') }}">
    <link rel="stylesheet" href="{{ asset('/website_assets/css/blog.css') }}">
@endsection

@section('bottom-header')
    <x-website.header.general title="Blogs" :breadcrumb="$BreadCrumb" current="" />
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
                                      <h5>  {!! $blog->en_title ?? '' !!} </h5>
                                    <p>
                                        {!! $blog->en_text ?? '' !!}
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
              <i class="fa-solid fa-sliders"></i>   Categories
            </button>
              <div class="categories_section" id="filtered-menu">
                <h6> categories </h6>
                @foreach ($categories as $category)
                <div class="categories">
                    <span>{{$category->en_category}}</span>
                    <span>(1)</span>
                  </div>
                @endforeach

                <div class="blog_img">

                  <img src="{{ asset('/website_assets/images/blog/banner.webp') }}" alt="banner image">
                </div>
              </div>

              <div class="latest_blog">
                <h6> latest blog  </h6>
                @foreach ($latest as $obj)
                <div class="blog_details">
                    <img src="{{ asset('uploads/blogs') }}/{{$obj->image}}" alt="latest blog image">
                    <div class="blog_info">
                      <h6> <a href="{{url('/single-blog/'.$obj->id) }}" class="stretched-link">

                        {{ strip_tags(Str::limit($obj->en_title ?? '', $limit = 50, $end = '')) }}

                    </a></h6>
                      <p>
                        {{ strip_tags(Str::limit($obj->en_text ?? '', $limit = 200, $end = '...')) }}


                      </p>
                      <span> 20 nov 2020</span>
                    </div>
                  </div>
                @endforeach


              </div>
        </div>

    </div>
</section>




<!--  ending page  -->
@endsection


