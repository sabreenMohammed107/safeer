@extends("layout.website.layout", ["Company" => $Company,"title"=>"Safer | Home"])

@section("bottom-header")
<x-website.header.home :company="$Company" :countries="$Countries" :cities="$cities" />
@endsection
@section("content")
<style>

    </style>



  <!-- explore turkey -->
  <section class="investigtion">
    <div class="explore explore_position container">
        @if (LaravelLocalization::getCurrentLocale() === 'en')
         <div class="row mx-0 explore_details ">
          <div class=" col-xl-2 col-md-12 col-sm-12">
            <div class="title">
              <div class="info">
                <h4>{{ __('links.explore') }} <br>{{ __('links.turkey') }} </h4>
              </div>
            </div>
          </div>
          <div class=" col-xl-10 col-md-12 col-sm-12">
            <section class="explore_carsoul owl-carousel">
                @foreach ($ExploreCities as $City)
                <div class="card-content">
                    <div class=" card explore_main">
                        {{-- <div class="card-body explore_card" style="background-image: linear-gradient(hsla(0, 0%, 0%, 0.3),hsla(0, 0%, 0%, 0.3)) , url({{asset("/website_assets/images/homePage/places/$City->image")}});"> --}}

                       <div class="card-body explore_card"
                        style="background-image:linear-gradient(hsla(0, 0%, 0%, 0.3),hsla(0, 0%, 0%, 0.3)) , url({{ asset('uploads/explore') }}/{{ $City->image }});">

                            <div class="header_info">
                                <h5>
                                    <a href="#" >
                                        @if (LaravelLocalization::getCurrentLocale() === 'en')

                                        {{$City->city->en_city}}
                                        @else
                                        {{$City->city->ar_city}}
                                        @endif

                                    </a>
                                </h5>
                                <span>
                                    @if (LaravelLocalization::getCurrentLocale() === 'en')

                                    {{$City->subtitle_en}}
                                    @else
                                    {{$City->subtitle_ar}}
                                    @endif
                                   </span>
                                <div class="explore_links">
                                    <button class="btn ">
                                    <a href="{{ LaravelLocalization::getLocalizedURL($localVar, route('hotelByCity', $City->city->id))}}">
                                    <i class="fa-solid fa-hotel"></i>
                                    </a>
                                    </button>
                                    <button class="btn ">
                                    <a href="{{ LaravelLocalization::getLocalizedURL($localVar, route('tourByCity', $City->city->id))}}">
                                        <i class="fa-solid fa-plane"></i>
                                    </a>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach


            </section>
         </div>
         @else
         <div class="row mx-0 explore_details ">

            <div class=" col-xl-10 col-md-12 col-sm-12">
              <section class="explore_carsoul owl-carousel">
                  @foreach ($ExploreCities as $City)
                  <div class="card-content">
                      <div class=" card explore_main">
                          {{-- <div class="card-body explore_card" style="background-image: linear-gradient(hsla(0, 0%, 0%, 0.3),hsla(0, 0%, 0%, 0.3)) , url({{asset("/website_assets/images/homePage/places/$City->image")}});"> --}}

                         <div class="card-body explore_card"
                          style="background-image:linear-gradient(hsla(0, 0%, 0%, 0.3),hsla(0, 0%, 0%, 0.3)) , url({{ asset('uploads/explore') }}/{{ $City->image }});">

                              <div class="header_info">
                                  <h5>
                                      <a href="#" >
                                          @if (LaravelLocalization::getCurrentLocale() === 'en')

                                          {{$City->city->en_city}}
                                          @else
                                          {{$City->city->ar_city}}
                                          @endif

                                      </a>
                                  </h5>
                                  <span>
                                      @if (LaravelLocalization::getCurrentLocale() === 'en')

                                      {{$City->subtitle_en}}
                                      @else
                                      {{$City->subtitle_ar}}
                                      @endif
                                     </span>
                                  <div class="explore_links">
                                      <button class="btn ">
                                      <a href="{{ LaravelLocalization::getLocalizedURL($localVar, route('hotelByCity', $City->city->id))}}">
                                      <i class="fa-solid fa-hotel"></i>
                                      </a>
                                      </button>
                                      <button class="btn ">
                                      <a href="{{ LaravelLocalization::getLocalizedURL($localVar, route('tourByCity', $City->city->id))}}">
                                          <i class="fa-solid fa-plane"></i>
                                      </a>
                                      </button>
                                  </div>
                              </div>
                          </div>
                      </div>
                  </div>
                  @endforeach


              </section>
           </div>

           <div class=" col-xl-2 col-md-12 col-sm-12">
            <div class="title">
              <div class="info">
                <h4>{{ __('links.explore') }} <br>{{ __('links.turkey') }} </h4>
              </div>
            </div>
          </div>
         @endif
    </div>
    <div class="adventure container">
      <div class="row mx-0">
        <div class=" col-xl-5 col- md-5 col-sm-12">
          <img src="{{ asset("/website_assets/images/homePage/$Company->image") }}" alt="why us image">
        </div>

        <div class=" col-xl-7 col- md-7 col-sm-12">
         <div class="adventure_info">
         <div class="heading">
            @if (LaravelLocalization::getCurrentLocale() === 'en')

            <h2>
                {{$Company->oveview_entitle}} <br>
                {{$Company->overview_ensubtitle}}
              </h2>
                @else
                <h2>
                    {{$Company->oveview_artitle}} <br>
                    {{$Company->overview_arsubtitle}}
                  </h2>
                @endif

          <p>
            @if (LaravelLocalization::getCurrentLocale() === 'en')

            {{$Company->overview_en}}
                @else
                {{$Company->overview_ar}}
                @endif

          </p>
          <div class="read">
            <a href="{{ LaravelLocalization::localizeUrl('/about') }}"> {{ __('links.readMore') }}
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
{{-- <x-website.home.offers :offers="$Offers" :title="$Company->limit_offer_endesc" /> --}}
     <!-- offers section -->
  <section class="offers">
    <div class="titles">
        <h3>
            @if (LaravelLocalization::getCurrentLocale() === 'en')
            LIMITED TIME OFFERS

            @else
            عروض لفترة محدودة
            @endif
        </h3>
        <p>
            {{-- {!! $title!!} --}}
            @if (LaravelLocalization::getCurrentLocale() === 'en')
            Limit Offer When it comes to exploring exotic places, the choices are numerous. Whether you like peaceful destinations or vibrant landscapes, we have offers for you.



            @else
            عرض محدود عندما يتعلق الأمر باستكشاف أماكن غريبة ، فإن الخيارات عديدة. سواء كنت تحب الوجهات الهادئة أو المناظر الطبيعية النابضة بالحياة ، لدينا عروض لك.
            @endif
        </p>
    </div>
    <div class="offers_details container">
      <div class="row mx-0">
        <div class="col-sm-12 col-md-12 col-xl-5 p-0">
          <div class="card-content ">
            <div class=" card">
              <div class="card-body explore_card adventure_mind">
                <div class="header_info">
                  <h5>@if (LaravelLocalization::getCurrentLocale() === 'en')
                  {{$mainOffer->subtitle_en}}

                      @else
                    {{$mainOffer->subtitle_ar}}
                      @endif</h5>
                 <p>
                    @if (LaravelLocalization::getCurrentLocale() === 'en')
                    {{$mainOffer->offer_enoverview}}

                      @else
                    {{$mainOffer->offer_aroverview}}
                      @endif
                 </p>
                <div class="start">
                  <span></span>
                  <h6>@if (LaravelLocalization::getCurrentLocale() === 'en')
                    start from

                      @else
                   يبدأ من
                      @endif</h6>
                  <span></span>
                </div>
                  <span> {{$mainOffer->cost}} $</span>
                  <button class="btn">
                    <a href="{{ LaravelLocalization::localizeUrl('/offers') }}">  @if (LaravelLocalization::getCurrentLocale() === 'en')
                        Go to offers

                          @else
                       مشاهدة العروض
                          @endif</a>
                  </button>
                </div>
            </div>
          </div>
          </div>
        </div>
        <div class="col-sm-12 col-md-12 col-xl-7 p-0">
          <div class="row mx-0">
            @foreach ($Offers as $offer)
            <div class="col-md-6 col-sm-12  p-0">
                <div class="card-content">
                    <div class=" card">
                        <div class="card-body offers_card offer_place_1"
                        onmouseenter="darkBG(this)"
                        onmouseleave="rmvDarkBG(this)"

                         style="background-image: linear-gradient(hsla(0, 0%, 0%, 0.3),hsla(0, 0%, 0%, 0.3)) , url({{ asset('uploads/offers') }}/{{ $offer->image }});">
                          <div class="header_info">
                            <h5><a href="{{ LaravelLocalization::localizeUrl('/single-offer/'.$offer->id.'/'.$offer->slug) }}" class="stretched-link"> @if (LaravelLocalization::getCurrentLocale() === 'en')
                                {{$offer->city->en_city ?? ""}}

                                @else
                                {{$offer->city->ar_city ?? ""}}
                                @endif</a>
                            </h5>
                            <span> @if (LaravelLocalization::getCurrentLocale() === 'en')
                               {{$offer->subtitle_en}}

                                @else
                              {{$offer->subtitle_ar}}
                                @endif
                            </span>
                            <span>
                                {{$offer->cost}} $
                            </span>
                          </div>

                      </div>
                      </div>
                </div>
              </div>
            @endforeach


          </div>
        </div>
      </div>
    </div>
</section>
<x-website.home.counters :counters="$Counters" />
  <!-- hotels section -->
  <section class=" hotel_section">
    <div class="explore container offers hotels">
      <div class="titles">
        <h3>{{ __('links.bestHotels') }} </h3>
        <p>
            @if (LaravelLocalization::getCurrentLocale() === 'en')

            {{$Company->best_hotels_en_desc}}
            @else
            {{$Company->best_hotels_ar_desc}}
            @endif


        </p>
      </div>
      <div class="hotel_details">
        <div class="row mx-0">
            @foreach ($BestHotels as $Hotel)
            <div class="col-sm-12 col-md-6 col-xl-3">
                <div class="card-content">
                  <div class=" card hotels_card">
                    <div class="card_image">
                        <a href="{{ LaravelLocalization::localizeUrl('/hotels/' . $Hotel->hotel->id) }}">
                        <div class="image_overlay">
                    <img src="{{ asset('uploads/hotels') }}/{{$Hotel->hotel->hotel_banner}}" class="w-100" height="250" alt=" hotel image">
                        </div>
                        </a>
                    </div>
                    <div class="card-body hotel_card_info">
                      <div class="card_info">
                        <h5>

  @if (LaravelLocalization::getCurrentLocale() === 'en')

   {{$Hotel->hotel->hotel_enname}}
  @else
  {{$Hotel->hotel->hotel_arname}}
  @endif
                             </h5>
                        @if (session()->get('SiteUser'))



                                            @php
                                                $favExist = 0;
                                                $favUser = App\Models\Favorite_hotels_tour::where('hotel_id', $Hotel->hotel->id)
                                                    ->where('user_id', session()->get('SiteUser')['ID'])
                                                    ->first();
                                                if ($favUser) {
                                                    $favExist = 1;
                                                }
                                            @endphp

                                            @else
                                                @php
                                                    $favExist=0;
                                                @endphp
                                            @endif
                                            <span >
                                                @if($favExist==1)
                                            <a  href="{{ LaravelLocalization::localizeUrl('/removeFavourite/' . $Hotel->hotel->id) }}"  ><i
                                                     class="fa-regular fa-heart card_info_hover" style="color: #1C4482;font-weight: 600;"></i> </a>

                                                     @else

                                                    <a  href="{{ LaravelLocalization::localizeUrl('/favourite/' . $Hotel->hotel->id) }}"  ><i
                                                        class="fa-regular fa-heart"></i> </a>

                                                @endif </span>
                      </div>
                      <a href="{{ LaravelLocalization::localizeUrl('/hotels/' . $Hotel->hotel->id) }}">
                      <p style="height: 130px;
                      overflow: hidden;
                      line-height: 2;">
                        @if (LaravelLocalization::getCurrentLocale() === 'en')

                        {{$Hotel->hotel->hotel_enbrief}}
  @else
  {{$Hotel->hotel->hotel_arbrief}}
  @endif

                      </p>
                      </a>
                      <div class="location">
                        <i class="fa-sharp fa-solid fa-location-dot"></i>
                        <span> {{$Hotel->hotel->details_enaddress}} </span>
                      </div>
                      <div class="price">
                        <span>$ 140 </span>
                        <span>/{{ __('links.nights') }}</span>
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

    <img class="w-100" src="{{ asset("/website_assets/images/homePage/slider-mask.webp") }}" alt="slider mask">
    <div class="booking_details">
      <div class="row mx-0">
        <div class=" col-xl-6 col- md-6 col-sm-12 p-0">
          <div class="images" style="background-image:url('@if($Company->book_img) {{asset("uploads/company/$Company->book_img")}} @else {{ asset("/website_assets/images/homePage/slider-mask.webp") }}  @endif') ">
            <button type="button" class="btn js-modal-btn " data-video-url="{{$Company->book_tour_vedio}}" data-bs-toggle="modal" data-bs-target="#video">
              <img src="{{ asset('/website_assets/images/homePage/play_button.webp') }}" alt=" video play button">
            </button>
          </div>
        </div>
        <div class=" col-xl-6 col- md-6 col-sm-12 p-0">
        <div class="right_side">
        <div class="heading">
          <h2>
            @if (LaravelLocalization::getCurrentLocale() === 'en')

            {{$Company->book_tour_en_title}}
@else
{{$Company->book_tour_ar_title}}
@endif

          </h2>
          <p>
            @if (LaravelLocalization::getCurrentLocale() === 'en')

            {{$Company->book_tour_en_desc}}
@else
{{$Company->book_tour_ar_desc}}
@endif

          </p>
          <a href="{{ LaravelLocalization::localizeUrl('/tours') }}">{{ __('links.readMore') }}
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
            @if (LaravelLocalization::getCurrentLocale() === 'en')

            {{$Company->book_transport_en_title}}
@else
{{$Company->book_transport_ar_title}}
@endif

          </h2>
          <p>
            @if (LaravelLocalization::getCurrentLocale() === 'en')

            {{$Company->book_transport_en_desc}}
@else
{{$Company->book_transport_ar_desc}}
@endif

        </p>
          <div class="read">
            <a href="{{ url('/transfers') }}">{{ __('links.readMore') }}
              <i class="fa-solid fa-angle-right"></i>
              <i class="fa-solid fa-angle-right"></i>
            </a>
          </div>
        </div>

        </div>
        </div>
        <div class=" col-xl-6 col- md-6 col-sm-12">
          <div class="images image-2" style="background-image:url('@if($Company->transport_img) {{asset("uploads/company/$Company->transport_img")}} @else {{ asset("/website_assets/images/homePage/slider-mask.webp") }}  @endif') " >
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
          <h4>{{ __('links.blogs') }}</h4>
          <p>
            @if (LaravelLocalization::getCurrentLocale() === 'en')

            Increase your knowledge with articles and interesting stories.
@else
زيادة معرفتك بالمقالات والقصص الشيقة.
@endif

          </p>
        </div>
        <div class="blog_filters ms-auto">
          <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
            <li class="nav-item" role="presentation">
                <button class="nav-link active" id="pills-all-tab" data-bs-toggle="pill" data-bs-target="#pills-all" type="button" role="tab" aria-controls="pills-all" aria-selected="true"> <a> @if (LaravelLocalization::getCurrentLocale() === 'en')

                    all
                    @else
                  الكل
                    @endif</a></button>
            </li>
            @foreach ($BlogsCategories as $key => $Category)
                <li class="nav-item" role="presentation">
                    <button class="nav-link @if($key == $BlogsCategories->count() - 1) nav-link-4 @endif" id="pills-all-tab{{$Category->id}}" data-bs-toggle="pill" data-bs-target="#pills-all{{$Category->id}}" type="button" role="tab" aria-controls="pills-all{{$Category->id}}" aria-selected="true"> <a> @if (LaravelLocalization::getCurrentLocale() === 'en')

                        {{$Category->en_category}}
                        @else
                        {{$Category->ar_category}}
                        @endif</a></button>
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
                  <div class="blog_image left_image" style="background-image: url({{ asset('uploads/blogs') }}/{{$AllBlogs[0]->image}});">
                    <!-- <img src="./images/homePage/blog/blog-1.webp" alt="blog image"> -->
                  </div>
                  <div class="blog_info">
                    <h5 class="left_heading">
                        <a href="{{ LaravelLocalization::localizeUrl('/single-blog/'.$AllBlogs[0]->id.'/'.$AllBlogs[0]->slug) }}">
                            @if (LaravelLocalization::getCurrentLocale() === 'en')

                            {!! $AllBlogs[0]->en_breif !!}
                            @else
                            {!! $AllBlogs[0]->ar_breif !!}
                            @endif

                        </a>
                    </h5>
                    <p>

                        @if (LaravelLocalization::getCurrentLocale() === 'en')

                        {!! strip_tags(\Illuminate\Support\Str::limit($AllBlogs[0]->en_breif ?? '', $limit = 800, $end = '...')) !!}
                        @else
                        {!! strip_tags(\Illuminate\Support\Str::limit($AllBlogs[0]->ar_breif ?? '', $limit = 800, $end = '...')) !!}
                        @endif
                    </p>
                    <a href="{{ LaravelLocalization::localizeUrl('/single-blog/'.$AllBlogs[0]->id.'/'.$AllBlogs[0]->slug) }}"   >
                        {{ __('links.readMore') }} <i class="fa-solid fa-angle-right"></i>
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
                         <div class="blog_image ">
                           <img width="150" src="{{ asset('uploads/blogs') }}/{{$AllBlogs[$i]->image}}" alt="blog image">
                         </div>
                         <div class="blog_info">
                           <h5>
                            <a href="{{ LaravelLocalization::localizeUrl('/single-blog/'.$AllBlogs[$i]->id.'/'.$AllBlogs[$i]->slug) }}">

                                @if (LaravelLocalization::getCurrentLocale() === 'en')

                                {!! $AllBlogs[$i]->en_title !!}
                            @else
                            {!! $AllBlogs[$i]->ar_title !!}
                            @endif
                            </a>
                           </h5>
                           <p>
                            @if (LaravelLocalization::getCurrentLocale() === 'en')

                            {{ strip_tags(\Illuminate\Support\Str::limit($AllBlogs[$i]->en_breif ?? '', $limit = 300, $end = '...')) }}
                            @else
                            {{ strip_tags(\Illuminate\Support\Str::limit($AllBlogs[$i]->ar_breif ?? '', $limit = 300, $end = '...')) }}
                            @endif

                            </p>
                           <a href="{{ LaravelLocalization::localizeUrl('/single-blog/'.$AllBlogs[$i]->id.'/'.$AllBlogs[$i]->slug) }}" >
                            {{ __('links.readMore') }} <i class="fa-solid fa-angle-right"></i>
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

                        </div>
                        <div class="blog_info">
                            <h5 class="left_heading">
                                <a href="{{ LaravelLocalization::localizeUrl('/single-blog/'.$blog->id.'/'.$blog->slug) }}">
                                    @if (LaravelLocalization::getCurrentLocale() === 'en')

                                    {!! $blog->en_title !!}
                @else
                {!! $blog->ar_title !!}
                @endif

                                </a>
                            </h5>
                            <p>
                                @if (LaravelLocalization::getCurrentLocale() === 'en')

                            {{ strip_tags(\Illuminate\Support\Str::limit($blog->en_breif ?? '', $limit = 300, $end = '...')) }}
                            @else
                            {{ strip_tags(\Illuminate\Support\Str::limit($blog->ar_breif ?? '', $limit = 300, $end = '...')) }}
                            @endif

                            </p>
                            <a href="{{ LaravelLocalization::localizeUrl('/single-blog/'.$blog->id.'/'.$blog->slug) }}" >
                                {{ __('links.readMore') }}<i class="fa-solid fa-angle-right"></i>
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
                            <img width="150" src="{{ asset('uploads/blogs') }}/{{$category_blog->image}}" alt="blog image">

                         </div>
                         <div class="blog_info">
                           <h5>
                            <a href="{{url('/single-blog/'.$category_blog->id) }}">
                                @if (LaravelLocalization::getCurrentLocale() === 'en')
                                {!! $category_blog->en_title !!}


                @else
                {!! $category_blog->ar_title !!}

                @endif


                            </a>
                           </h5>
                           <p>
                            @if (LaravelLocalization::getCurrentLocale() === 'en')

                            {{ strip_tags(\Illuminate\Support\Str::limit($category_blog->en_text ?? '', $limit = 300, $end = '...')) }}
                            @else
                            {{ strip_tags(\Illuminate\Support\Str::limit($category_blog->ar_text ?? '', $limit = 300, $end = '...')) }}
                            @endif



                            </p>
                           <a href="{{ LaravelLocalization::localizeUrl('/single-blog/'.$category_blog->id.'/'.$category_blog->slug) }}" >
                            {{ __('links.readMore') }} <i class="fa-solid fa-angle-right"></i>
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

@section('adds_js')
<script>
    $(document).ready(function() {


$('.dynamic').change(function() {

    if ($(this).val() != '') {
        var select = $(this).attr("id");
        var value = $(this).val();


        $.ajax({
            url: "{{route('dynamicSearchCity.fetch')}}",
            method: "get",
            data: {
                select: select,
                value: value,

            },
            success: function(result) {

                $('#city_id').html(result);
            }

        })
    }
});
    });


    function getNumberOfDays(start, end) {
    const date1 = new Date(start);
    const date2 = new Date(end);

    // One day in milliseconds
    const oneDay = 1000 * 60 * 60 * 24;

    // Calculating the time difference between two dates
    const diffInTime = date2.getTime() - date1.getTime();

    // Calculating the no. of days between two dates
    const diffInDays = Math.round(diffInTime / oneDay);
$('#nights').val(diffInDays);
    return diffInDays;
}

    </script>
@endsection
