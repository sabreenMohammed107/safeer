@extends("layout.website.layout", ["Company" => $Company,"title"=>"Safer | Home"])
@section('adds_css')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="{{ asset('/website_assets/css/whatsappStyle.css') }}">

@endsection
@section("bottom-header")
<x-website.header.home :company="$Company" :countries="$Countries" :cities="$cities" />
@endsection
@section("content")
<style>

    </style>

<div id='whatsapp-chat' class='hide'>
    <div class='header-chat'>
      <div class='head-home'>
        <div class='info-avatar'>
            <img src="{{asset("/website_assets/images/llogo.JPG")}}" alt="profile picture "></div>
        <p><span class="whatsapp-name">Safer</span><br><small>Typically replies within few minutes</small></p>

      </div>
      <div class='get-new hide'>
        <div id='get-label'></div>
        <div id='get-nama'></div>
      </div>
    </div>
    <div class='home-chat'>

    </div>
    <div class='start-chat'>
      <div pattern="https://elfsight.com/assets/chats/patterns/whatsapp.png" class="WhatsappChat__Component-sc-1wqac52-0 whatsapp-chat-body">
        <div class="WhatsappChat__MessageContainer-sc-1wqac52-1 dAbFpq">
          <div style="opacity: 0;" class="WhatsappDots__Component-pks5bf-0 eJJEeC">
            <div class="WhatsappDots__ComponentInner-pks5bf-1 hFENyl">
              <div class="WhatsappDots__Dot-pks5bf-2 WhatsappDots__DotOne-pks5bf-3 ixsrax"></div>
              <div class="WhatsappDots__Dot-pks5bf-2 WhatsappDots__DotTwo-pks5bf-4 dRvxoz"></div>
              <div class="WhatsappDots__Dot-pks5bf-2 WhatsappDots__DotThree-pks5bf-5 kXBtNt"></div>
            </div>
          </div>
          <div style="opacity: 1;" class="WhatsappChat__Message-sc-1wqac52-4 kAZgZq">
            <div class="WhatsappChat__Author-sc-1wqac52-3 bMIBDo">Safer</div>
            <div class="WhatsappChat__Text-sc-1wqac52-2 iSpIQi">Hi there 👋<br><br>How can I help you?</div>
            <div class="WhatsappChat__Time-sc-1wqac52-5 cqCDVm"></div>
          </div>
        </div>
      </div>

      <div class='blanter-msg'>
        <textarea id='chat-input' placeholder='Write a response' maxlength='120' row='1'></textarea>
        <a href='javascript:void;' id='send-it'><svg viewBox="0 0 448 448"><path d="M.213 32L0 181.333 320 224 0 266.667.213 416 448 224z"/></svg></a>

      </div>
    </div>
    <div id='get-number'></div><a class='close-chat' href='javascript:void'>×</a>
  </div>
  <a class='blantershow-chat' href='javascript:void' title='Show Chat'><svg width="20" viewBox="0 0 24 24"><defs/><path fill="#eceff1" d="M20.5 3.4A12.1 12.1 0 0012 0 12 12 0 001.7 17.8L0 24l6.3-1.7c2.8 1.5 5 1.4 5.8 1.5a12 12 0 008.4-20.3z"/><path fill="#4caf50" d="M12 21.8c-3.1 0-5.2-1.6-5.4-1.6l-3.7 1 1-3.7-.3-.4A9.9 9.9 0 012.1 12a10 10 0 0117-7 9.9 9.9 0 01-7 16.9z"/><path fill="#fafafa" d="M17.5 14.3c-.3 0-1.8-.8-2-.9-.7-.2-.5 0-1.7 1.3-.1.2-.3.2-.6.1s-1.3-.5-2.4-1.5a9 9 0 01-1.7-2c-.3-.6.4-.6 1-1.7l-.1-.5-1-2.2c-.2-.6-.4-.5-.6-.5-.6 0-1 0-1.4.3-1.6 1.8-1.2 3.6.2 5.6 2.7 3.5 4.2 4.2 6.8 5 .7.3 1.4.3 1.9.2.6 0 1.7-.7 2-1.4.3-.7.3-1.3.2-1.4-.1-.2-.3-.3-.6-.4z"/></svg> Chat with Us</a>
<!--Start Social Icon-->
<div class="fixed-icon">
	<div class="f-icon f1"><a href="https://www.facebook.com/Safer4Free/" target="_blank" ><i class="fab fa-facebook-f"></i></a></div>
	<div class="f-icon f2"><a href="http://twitter.com/safer4free" target="_blank"><i class="fab fa-twitter"></i></a></div>
	<div class="f-icon f3"><a href="https://www.linkedin.com/in/safer-4free-107287132" target="_blank"><i class="fab fa-linkedin-in"></i></a></div>
	<div class="f-icon f3"><a href="https://wa.me/?text={{ urlencode('https://safer.travel/') }}" target="_blank"><i class="fab fa-whatsapp"></i></a></div>
	<div class="f-icon f4"><a href="https://www.instagram.com/safer4free.official/" target="_blank" ><i class="fab fa-instagram"></i></a></div>
</div>
<!--End Social Icon-->

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
                                        {{$City->city->en_city}}
                                    </a>
                                </h5>
                                <span>{{$City->subtitle_en}}</span>
                                <div class="explore_links">
                                    <button class="btn ">
                                    <a href="{{ route('hotelByCity', $City->city->id) }}">
                                    <i class="fa-solid fa-hotel"></i>
                                    </a>
                                    </button>
                                    <button class="btn ">
                                    <a href="./tours.html">
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
            <a href="{{url('/about')}}">Read more
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
                    <div class="card_image">
                        <div class="image_overlay">
                    <img src="{{ asset('uploads/hotels') }}/{{$Hotel->hotel->hotel_banner}}" class="w-100" height="250" alt=" hotel image">
                        </div>
                    </div>
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
                  <div class="blog_image left_image" style="background-image: url({{ asset('uploads/blogs') }}/{{$AllBlogs[0]->image}});">
                    <!-- <img src="./images/homePage/blog/blog-1.webp" alt="blog image"> -->
                  </div>
                  <div class="blog_info">
                    <h5 class="left_heading">
                        <a href="{{url('/single-blog/'.$AllBlogs[0]->id) }}">
                            {!! $AllBlogs[0]->en_title !!}
                        </a>
                    </h5>
                    <p>
                      {!! $AllBlogs[0]->en_text !!}
                    </p>
                    <a href="{{url('/single-blog/'.$AllBlogs[0]->id) }}"   >
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
                         <div class="blog_image ">
                           <img width="150" src="{{ asset('uploads/blogs') }}/{{$AllBlogs[$i]->image}}" alt="blog image">
                         </div>
                         <div class="blog_info">
                           <h5>
                            <a href="{{url('/single-blog/'.$AllBlogs[$i]->id) }}">
                                {!! $AllBlogs[$i]->en_title !!}
                            </a>
                           </h5>
                           <p>
                            {!! \Illuminate\Support\Str::limit($AllBlogs[$i]->en_text ?? '', $limit = 300, $end = '...') !!}
                            {{-- {{ strip_tags(Str::limit($AllBlogs[$i]->en_text ?? '', $limit = 300, $end = '...')) }} --}}

                            </p>
                           <a href="{{url('/single-blog/'.$AllBlogs[$i]->id) }}" >
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

                        </div>
                        <div class="blog_info">
                            <h5 class="left_heading">
                                <a href="{{url('/single-blog/'.$blog->id) }}">
                                    {!! $blog->en_title !!}
                                </a>
                            </h5>
                            <p>
                                {!! \Illuminate\Support\Str::limit($blog->en_text ?? '', $limit = 300, $end = '...') !!}

                            </p>
                            <a href="{{url('/single-blog/'.$blog->id) }}" >
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
                            <img width="150" src="{{ asset('uploads/blogs') }}/{{$category_blog->image}}" alt="blog image">

                         </div>
                         <div class="blog_info">
                           <h5>
                            <a href="{{url('/single-blog/'.$category_blog->id) }}">
                                {!! $category_blog->en_title !!}
                            </a>
                           </h5>
                           <p>
                            {!! \Illuminate\Support\Str::limit($category_blog->en_text ?? '', $limit = 300, $end = '...') !!}


                            </p>
                           <a href="{{url('/single-blog/'.$category_blog->id) }}" >
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

@section('adds_js')
<script>
    $(document).ready(function() {
// whts pp
$(document).on("click", "#send-it", function() {
  var a = document.getElementById("chat-input");
  if ("" != a.value) {
    var b = $("#get-number").text(),
      c = document.getElementById("chat-input").value,
      d = "https://web.whatsapp.com/send",
      e = b,
      f = "&text=" + c;
    if (
      /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(
        navigator.userAgent
      )
    )
      var d = "whatsapp://send";
    //   +31 6 29320129
    var g = d + "?phone=+905445019185" + e + f;
    window.open(g, "_blank");
  }
}),
  $(document).on("click", ".informasi", function() {
    (document.getElementById("get-number").innerHTML = $(this)
      .children(".my-number")
      .text()),
      $(".start-chat,.get-new")
        .addClass("show")
        .removeClass("hide"),
      $(".home-chat,.head-home")
        .addClass("hide")
        .removeClass("show"),
      (document.getElementById("get-nama").innerHTML = $(this)
        .children(".info-chat")
        .children(".chat-nama")
        .text()),
      (document.getElementById("get-label").innerHTML = $(this)
        .children(".info-chat")
        .children(".chat-label")
        .text());
  }),
  $(document).on("click", ".close-chat", function() {
    $("#whatsapp-chat")
      .addClass("hide")
      .removeClass("show");
  }),
  $(document).on("click", ".blantershow-chat", function() {
    $("#whatsapp-chat")
      .addClass("show")
      .removeClass("hide");
  });

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
