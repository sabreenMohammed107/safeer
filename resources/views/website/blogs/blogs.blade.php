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
                        <div id="table_data">
                            @include('website.blogs.blogList')

                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-12 col-xl-3">
                <button class="btn filtered_button" onclick="openFilter()" id="filterButton">
                    <i class="fa-solid fa-sliders"></i> {{ __('links.categories') }}
                </button>
                <div class="categories_section" id="filtered-menu">
                    <h6> {{ __('links.categories') }} </h6>
                    @foreach ($categories as $category)
                        <?php
                        $countBlogs = App\Models\Blog::where('blog_category_id', $category->id)->count();
                        ?>
                        <div class="categories">
                            <span>@if (LaravelLocalization::getCurrentLocale() === 'en')

                                {{ $category->en_category }}
                                @else
                                {{ $category->ar_category }}
                                @endif</span>
                            <span>({{$countBlogs}})</span>
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
                            <img src="{{ asset('uploads/blogs') }}/{{ $obj->image }}" alt="latest blog image">
                            <div class="blog_info">
                                <h6> <a href="{{ LaravelLocalization::localizeUrl('/single-blog/' . $obj->id) }}" class="stretched-link">
                                    @if (LaravelLocalization::getCurrentLocale() === 'en')

                                    {{ strip_tags(Str::limit($obj->en_title ?? '', $limit = 50, $end = '')) }}

                                    @else
                                    {{ strip_tags(Str::limit($obj->ar_title ?? '', $limit = 50, $end = '')) }}

                                    @endif

                                    </a></h6>
                                <p>
                                    @if (LaravelLocalization::getCurrentLocale() === 'en')

                                    {{ strip_tags(Str::limit($obj->en_text ?? '', $limit = 200, $end = '...')) }}

                                    @else
                                    {{ strip_tags(Str::limit($obj->ar_text ?? '', $limit = 200, $end = '...')) }}

                                    @endif


                                </p>
                                <span>{{ \Carbon\Carbon::parse($obj->blog_date)->format('d F Y') }}</span>
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
                    url: "/blogs/fetch_data?page=" + page,
                    success: function(data) {
                        $('#table_data').html(data);
                    }
                });
            }

        });
    </script>
@endsection
