@extends("layout.website.layout", ["Company" => $Company,"title"=>"Safeer | Home"])

@section("bottom-header")
<x-website.header.home :company="$Company" />
@endsection
@section("content")

  <!-- explore turkey -->
  <section class="investigtion">
    <div class="explore explore_position container">
         <div class="row mx-0 explore_details ">
          <div class=" col-xl-2 col-md-12 col-sm-12">
            <div class="title">
              <div class="info">
                <h4>explore <br> turkey</h4>
              </div>
            </div>
          </div>
          <div class=" col-xl-10 col-md-12 col-sm-12">
            <section class="explore_carsoul">
                @foreach ($ExploreCities as $City)
                <div class="card-content">
                    <div class=" card explore_main">
                        {{-- <div class="card-body explore_card" style="background-image: linear-gradient(hsla(0, 0%, 0%, 0.3),hsla(0, 0%, 0%, 0.3)) , url({{asset("/website_assets/images/homePage/places/$City->image")}});"> --}}

                       <div class="card-body explore_card" style="background-image: linear-gradient(hsla(0, 0%, 0%, 0.3),hsla(0, 0%, 0%, 0.3)) , url({{ asset('uploads/explore') }}/{{ $City->image }});">

                            <div class="header_info">
                            <h5><a href="#" class="stretched-link">{{$City->city->en_city}}</a>
                            </h5>
                            <span>{{$City->subtitle_en}}</span>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach


          </div>
         </div>
    </div>
    <div class="adventure container">
      <div class="row mx-0">
        <div class=" col-xl-5 col- md-5 col-sm-12">
          <img src="{{ asset("/website_assets/images/homePage/$Company->image") }}" alt="why us image">
        </div>

        <div class=" col-xl-7 col- md-7 col-sm-12">
         <div class="adventure_info">
         <div class="heading">
          <h2>
            {{$Company->oveview_entitle}} <br>
            {{$Company->overview_ensubtitle}}
          </h2>
          <p>
            {{$Company->overview_en}}
          </p>
          <div class="read">
            <a href="#">Read more
              <i class="fa-solid fa-angle-right"></i>
              <i class="fa-solid fa-angle-right"></i>
            </a>
          </div>
         </div>

         </div>
        </div>
      </div>
      <img src="{{ asset('/website_assets/images/homePage/birds (2).webp') }}" alt="birds image">
    </div>
    <!-- <img src="./images/homePage/birds.webp" alt="birds group"> -->
  </section>
<x-website.home.offers :offers="$Offers" :title="$Company->limit_offer_endesc" />
<x-website.home.counters :counters="$Counters" />
  <!-- hotels section -->
  <section class=" hotel_section">
    <div class="explore container offers hotels">
      <div class="titles">
        <h3>best hotels </h3>
        <p>
          {{$Company->best_hotels_en_desc}}
        </p>
      </div>
      <div class="hotel_details">
        <div class="row mx-0">
            @foreach ($BestHotels as $Hotel)
            <div class="col-sm-12 col-md-6 col-xl-3">
                <div class="card-content">
                  <div class=" card hotels_card">
                    <img src="{{ asset("/website_assets/images/homePage/hotels/{$Hotel->hotel->hotel_banner}") }}" alt=" hotel image">
                    <div class="card-body hotel_card_info">
                      <div class="card_info">
                        <h5>{{$Hotel->hotel->hotel_enname}} </h5>
                       <a href="#">
                        <i class="fa-regular fa-heart"></i>
                       </a>
                      </div>
                      <p>
                        {{$Hotel->hotel->hotel_enbrief}}
                      </p>
                      <div class="location">
                        <i class="fa-sharp fa-solid fa-location-dot"></i>
                        <span> {{$Hotel->hotel->details_enaddress}} </span>
                      </div>
                      <div class="price">
                        <span>$ 140 </span>
                        <span>/nights</span>
                      </div>
                  </div>
                </div>
                </div>
              </div>
            @endforeach
      </div>
      </div>
    </div>
    <img src="{{asset("/website_assets/images/homePage/birds (2).webp")}}" alt="birds image">
    <img src="{{asset("/website_assets/images/homePage/birds (2).webp")}}" alt="birds image">
    <!-- <img src="./images/homePage/slider-mask.webp" alt="slider mask"> -->
  </section>
  <!-- booking section -->
  <section class="booking">
    <img src="{{ asset("/website_assets/images/homePage/slider-mask.webp") }}" alt="slider mask">
    <div class="booking_details">
      <div class="row mx-0">
        <div class=" col-xl-6 col- md-6 col-sm-12 p-0">
          <div class="images">
            <button type="button" class="btn js-modal-btn " data-video-url="{{$Company->book_tour_vedio}}" data-bs-toggle="modal" data-bs-target="#video">
              <img src="{{ asset('/website_assets/images/homePage/play_button.webp') }}" alt=" video play button">
            </button>
          </div>
        </div>
        <div class=" col-xl-6 col- md-6 col-sm-12 p-0">
        <div class="right_side">
        <div class="heading">
          <h2>
            {{$Company->book_tour_en_title}}
          </h2>
          <p>
            {{$Company->book_tour_en_desc}}
          </p>
          <a href="#">Read more
            <i class="fa-solid fa-angle-right"></i>
            <i class="fa-solid fa-angle-right"></i>
          </a>
        </div>
        </div>
        </div>
      </div>
    </div>
  </section>

  <section class="investigtion car booking">
    <div class="adventure container">
      <div class="row mx-0">
        <div class=" col-xl-6 col- md-6 col-sm-12">
        <div class="adventure_info">
        <div class="heading">
          <h2>
            {{$Company->book_transport_en_title}}
          </h2>
          <p>
            {{$Company->book_transport_en_desc}}
        </p>
          <div class="read">
            <a href="#">Read more
              <i class="fa-solid fa-angle-right"></i>
              <i class="fa-solid fa-angle-right"></i>
            </a>
          </div>
        </div>

        </div>
        </div>
        <div class=" col-xl-6 col- md-6 col-sm-12">
          <div class="images image-2">
            <img src="{{ asset('/website_assets/images/homePage/slider-mask.webp') }}" alt="image mask">
            <img src="{{ asset('/website_assets/images/homePage/slider-mask.webp') }}" alt="image mask">

            <img src="{{ asset('/website_assets/images/homePage/slider-mask.webp') }}" alt="image mask">

            <img src="{{ asset('/website_assets/images/homePage/slider-mask.webp') }}" alt="image mask">

            <button type="button" class="btn js-modal-btn "data-video-url="{{$Company->book_transport_vedio}}" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
              <img src="{{ asset('/website_assets/images/homePage/play_button.webp') }}" alt=" video play button">
            </button>
          </div>
        </div>
      </div>
      <!-- <img src="./images/homePage/birds (2).webp" alt="birds image"> -->
    </div>
  </section>
  <!-- blog section -->
    <section class="blog_section ">
      <img src="{{ asset('/website_assets/images/homePage/birds (2).webp') }}" alt="birds image">

      <div class="blog_titles container">
        <div class="title_info">
          <h4>blog</h4>
          <p>
            Increase your knowledge with articles and interesting stories.
          </p>
        </div>
        <div class="blog_filters ms-auto">
          <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
            <li class="nav-item" role="presentation">
                <button class="nav-link active" id="pills-all-tab" data-bs-toggle="pill" data-bs-target="#pills-all" type="button" role="tab" aria-controls="pills-all" aria-selected="true"> <a>all</a></button>
            </li>
            @foreach ($BlogsCategories as $key => $Category)
                <li class="nav-item" role="presentation">
                    <button class="nav-link @if($key == $BlogsCategories->count() - 1) nav-link-4 @endif" id="pills-all-tab{{$Category->id}}" data-bs-toggle="pill" data-bs-target="#pills-all{{$Category->id}}" type="button" role="tab" aria-controls="pills-all{{$Category->id}}" aria-selected="true"> <a>{{$Category->en_category}}</a></button>
                </li>
            @endforeach
        </ul>
        </div>

      </div>
      <div class="filtred_data container">
        <div class="tab-content" id="pills-tabContent">
        @if($AllBlogs->count() > 0)
        <div class="tab-pane fade show active" id="pills-all" role="tabpanel" aria-labelledby="pills-all-tab">
            <div class="row mx-0">
              <div class="col-sm-12 col-md-12 col-xl-6">
                <div class="blog_side">
                  <div class="blog_image left_image" style="background-image: url({{asset("/website_assets/images/homePage/blog/{$AllBlogs[0]->image}")}});">
                    <!-- <img src="./images/homePage/blog/blog-1.webp" alt="blog image"> -->
                  </div>
                  <div class="blog_info">
                    <h5 class="left_heading">
                      {{$AllBlogs[0]->en_title}}
                    </h5>
                    <p>
                      {{$AllBlogs[0]->en_text}}
                    </p>
                    <a href="./single-blog.html" >
                      Read more <i class="fa-solid fa-angle-right"></i>
                    </a>
                  </div>
                </div>
              </div>
              <div class="col-sm-12 col-md-12 col-xl-6">
                <div class="blog_side blog_side_right">
                  <div class="row mx-0">
                    @for ($i = 1; $i < $AllBlogs->count(); $i++)
                    <div class="col-sm-12 col-xl-12">
                        <div class="blog_side_right">
                         <div class="blog_image">
                           <img src="{{ asset("/website_assets/images/homePage/blog/{$AllBlogs[$i]->image}") }}" alt="blog image">
                         </div>
                         <div class="blog_info">
                           <h5>
                             {{$AllBlogs[$i]->en_title}}
                           </h5>
                           <p>
                             {{$AllBlogs[$i]->en_text}}
                            </p>
                           <a href="./single-blog.html" class="stretched-link">
                             Read more <i class="fa-solid fa-angle-right"></i>
                           </a>
                         </div>
                        </div>

                    </div>
                    @endfor
                  </div>
                </div>
              </div>
            </div>
        </div>
        @endif
          @foreach ($BlogsCategories as $Category)
          <div class="tab-pane fade" id="pills-all{{$Category->id}}" role="tabpanel" aria-labelledby="pills-today-tab{{$Category->id}}">
            <div class="row mx-0">
            @if($Category->blogs->count())
                @foreach ($Category->blogs as $k => $blog)
                    @if ($k == 0)
                    <div class="col-sm-12 col-md-12 col-xl-6">
                        <div class="blog_side">
                        <div class="blog_image left_image" style="background-image: url({{asset("/website_assets/images/homePage/blog/{$blog->image}")}});">
                            <!-- <img src="/website_assets/images/homePage/blog/blog-1.webp" alt="blog image"> -->
                        </div>
                        <div class="blog_info">
                            <h5 class="left_heading">
                            {{$blog->en_title}}
                            </h5>
                            <p>
                            {{$blog->en_text}}
                            </p>
                            <a href="./single-blog.html" class="stretched-link">
                            Read more <i class="fa-solid fa-angle-right"></i>
                            </a>
                        </div>
                        </div>
                    </div>
                    @endif
                @endforeach
              @endif
              <div class="col-sm-12 col-md-12 col-xl-6">
                <div class="blog_side blog_side_right">
                  <div class="row mx-0">
                    @foreach ($Category->blogs as $k => $category_blog)
                    @if($k > 0)
                    <div class="col-sm-12 col-xl-12">
                        <div class="blog_side_right">
                         <div class="blog_image">
                           <img src="{{ asset("/website_assets/images/homePage/blog/{$category_blog->image}") }}" alt="blog image">
                         </div>
                         <div class="blog_info">
                           <h5>
                             {{$category_blog->en_title}}
                           </h5>
                           <p>
                             {{$category_blog->en_text}}
                            </p>
                           <a href="./single-blog.html" class="stretched-link">
                             Read more <i class="fa-solid fa-angle-right"></i>
                           </a>
                         </div>
                        </div>

                    </div>
                    @endif
                    @endforeach
                  </div>
                </div>
              </div>
            </div>
          </div>
          @endforeach
        </div>
      </div>
    </section>
@endsection
