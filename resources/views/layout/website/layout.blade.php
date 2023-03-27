<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- facebook meta tags -->
    <meta property="og:type" content="website" />
    <meta property="og:title" content="Safer - Online hub for booking  trourism trips" />
    <meta property="og:description"
        content="Safer providing you online planning  your  next vacations and  booking trips around the world" />
        <meta name="robots" content="follow, index, max-snippet:-1, max-video-preview:-1, max-image-preview:large"/>
        <link rel="canonical" href="https://safer.travel/hotels" />
        <meta property="og:url" content="https://safercom/" />
    <meta property="og:image" content="./images/homePage/logo.webp" />
    <meta property="og:image:alt" content="Safer - Online hub for booking  trourism trips" />
    <meta property="og:site_name" content="safer.com" />
    <!-- twitter meta tags -->
    <meta name="twitter:card" content="summary" />
    <meta name="twitter:site" content="safer.com">
    <meta name="twitter:creator" content="safer.com">
    <meta name="twitter:title" content="Safer - Online hub for booking  trourism trips" />
    <meta name="twitter:description"
        content="Safer providing you online planning  your  next vacations and  booking trips around the world " />
    <meta name="twitter:url" content="https://safer.com/" />
    <meta name="twitter:image" content="/images/homePage/logo.webp" />
    <meta property="twitter:image:alt" content="Safer - Online hub for booking  trourism trips" />
    <!-- general meta tags  -->
    <meta name="canonical_tag" content="https://safer.com/" />
    <meta name="canonical_tag" content="" />
    <meta name="title" content="Safer - Online hub for booking  trourism trips" />
    <meta name="description"
        content="Safer providing you online planning  your  next vacations and  booking trips around the world" />
    <meta name="image" content="/images/homePage/logo.webp" />
    <meta property="image:alt" content="Safer - Online hub for booking  trourism trips" />
    <meta name="keywords"
        content="hotels tours transfer visa contact trip destination adults child nights checkin room explore adventure experience offers travel packages agents acitivties hotel  transfer honemoon safari pharonic newsletter   " />
    <!-- style sheets  -->
    <!-- fontawesome  -->
    <link rel="stylesheet" href="{{ asset('/website_assets/css/all.min.css') }}">
    <!-- fonts google -->
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@200;300;400;500;600;700;800;900;1000&display=swap"
        rel="stylesheet">
    <!-- bootstrap -->
    <link rel="stylesheet" href="{{ asset('/website_assets/css/bootstrap/bootstrap.min.css') }}">
    <!-- normalize -->
    <link rel="stylesheet" href="{{ asset('/website_assets/css/normalize.css') }}">
    <!-- slick cdn link -->
    <link rel="stylesheet" href="{{ asset('/website_assets/slick/slick-1.8.1/slick/slick.css') }}">
    <!-- video poppp styele -->
    <link rel="stylesheet"
        href="{{ asset('/website_assets/js/appleple-modal-video-78d211f/css/modal-video.min.css') }}">
    <!-- stylesheet  -->
    {{--
    <link rel="stylesheet" href="{{ asset('/website_assets/css/my-profile.css')}}"> --}}
    <link rel="stylesheet" href="{{ asset('/website_assets/css/style.css') }}">
    {{-- owl Carousel links --}}
    <link rel="stylesheet" href="{{ asset('/website_assets/css/owl.carousel.min.css') }}">
    <link rel="stylesheet" href="{{ asset('/website_assets/css/owl.theme.default.css') }}">
    {{-- owl Carousel links --}}
    <!-- icon -->
    <link rel="icon" href="{{ asset('/website_assets/images/homePage/logo.webp') }}">
    <link rel="stylesheet" href="{{ asset('/website_assets/css/whatsappStyle.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker3.min.css">


<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    @yield("adds_css")
    <title> {{$title}} </title>
</head>

<body>

    <!-- start of nav bar  and mega menu -->

    <section class="landing_section ">
        <x-website.header />
        @yield("bottom-header")
    </section>

    @yield("content")

    <!--  ending page  -->
    <section class="ending">
        <div class="newsletter">
            <div class="container">
                <div class="row mx-0 align-items-center">
                    <div class="col-md-6 col-sm-12">
                        <span>
                            Prepare yourself and let's <br>
                            explore the beauty of the world
                        </span>
                    </div>

                    <div class="col-md-6 col-sm-12">
                        <form action="{{url('/sendNewsLetter')}}" method="POST">
                            @csrf
                            <div class="input-group input">
                                <input type="email" name="email" class="form-control" placeholder="Enter your email"
                                    aria-label="Recipient's username" aria-describedby="button-addon2">
                                <button class="btn btn-outline-secondary" type="submit">
                                    Join our newsletter
                                </button>
                            </div>


                    </div>
                    </form>
                </div>
            </div>
        </div>

                        <footer>
                            <div class="container">
                                <div class="row mx-0">
                                    <div class="col-xl-5 col-md-12 col-sm-12">
                                        <div class="left_info">
                                            <h6>About us </h6>
                                            <p>
                                                {{$Company->overview_en}} </p>
                                        </div>
                                    </div>
                                    <!-- useful links -->

                                    <div class="col-xl-4 col-md-6 col-sm-12">
                                        <div class="useful_links">
                                            <h6>useful links </h6>
                                            <div class="row mx-0">
                                                <div class="col-6">
                                                    <ul>
                                                        <li><i class="fa-solid fa-angle-right"></i><a
                                                                href="{{ url('/') }}"> Home </a>
                                                        </li>
                                                        <li><i class="fa-solid fa-angle-right"></i><a
                                                                href="{{ url('/about') }}">About
                                                            </a></li>
                                                        <li><i class="fa-solid fa-angle-right"></i><a
                                                                href="{{ url('/hotels') }}">Hotels
                                                            </a></li>
                                                        <li><i class="fa-solid fa-angle-right"></i><a
                                                                href="{{ url('/terms') }}">Terms & Conditions </a></li>

                                                    </ul>
                                                </div>
                                                <div class="col-6">
                                                    <ul>
                                                        <li><i class="fa-solid fa-angle-right"></i><a
                                                                href="{{ url('/blogs') }}">Blogs
                                                            </a></li>
                                                        <li><i class="fa-solid fa-angle-right"></i><a href="{{ url('/tours') }}">Tours
                                                            </a></li>
                                                        <li><i class="fa-solid fa-angle-right"></i><a href="{{ url('/transfers') }}">Transfer
                                                            </a></li>
                                                        <li><i class="fa-solid fa-angle-right"></i><a href="{{ url('/visa') }}">Visa </a>
                                                        </li>


                                                    </ul>
                                                </div>
                                                <div class="col-12">
                                                    <a href="http://" class="pay-link  "> <img
                                                            src="{{ asset('img/payment/visa.png') }}" alt="visa"
                                                            srcset=""></a>


                                                    <a href="http://" class="pay-link "> <img
                                                            src="{{ asset('img/payment/google-pay.png') }}" alt="google-pay"
                                                            srcset=""></a>


                                                    <a href="http://" class="pay-link "> <img
                                                            src="{{ asset('img/payment/apple-pay.png') }}" alt="apple-pay"
                                                            srcset=""></a>


                                                    <a href="http://" class="pay-link "> <img
                                                            src="{{ asset('img/payment/mastercard.png') }}" alt="mastercard"
                                                            srcset=""></a>


                                                    <a href="http://" class="pay-link "> <img
                                                            src="{{ asset('img/payment/samsung-pay.png') }}" alt="samsung-pay"
                                                            srcset=""></a>


                                                    <a href="http://" class="pay-link "> <img
                                                            src="{{ asset('img/payment/stripe.png') }}" alt="stripe"
                                                            srcset=""></a>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- contact details -->
                                    <div class="col-xl-3 col-md-6">
                                        <div class="contact_details">
                                            <h6>Contact us</h6>

                                            <div class="contact_info" style="margin-bottom: 10px;">
                                                <div class="info">
                                                    <i class="fa-solid fa-phone"></i>
                                                    <span>For individuals: </span>
                                                </div>
                                            </div>
                                            <div class="contact_info" style="margin-bottom: 10px;">
                                                <div class="info" style="margin-left: 25px;">

                                                    <span >
                                                        00905521501111 - 00905016451111 </span>
                                                </div>
                                            </div>
                                             <div class="contact_info" style="margin-bottom: 10px;">
                                                <div class="info">
                                                    <i class="fa-solid fa-phone"></i>
                                                    <span>
                                                        For companies: 00905445019185</span>
                                                </div>
                                            </div>
                                            <div class="contact_info" style="margin-bottom: 10px;">
                                                <div class="info">
                                                    <i class="fa-solid fa-envelope"></i>
                                                    <span>Info@Safer.Travel</span>
                                                </div>
                                            </div>
                                            <div class="contact_info" style="margin-bottom: 10px;">
                                                <div class="info">
                                                    <i class="fa-solid fa-location-dot"></i>
                                                    <span>Sixth floor above Kababji Mahmoud Restaurant - Watan Square - Al-Fateh - Istanbul - Turkey</span>
                                                </div>
                                            </div>

                                            <div class="contact_info" style="margin:0">

                                                <div class="icons-container">
                                                    <div class="social-icons spinned">
                                                        <a class="item facebook" href="{{ $comFooter->facebook }}" target="_blank" ><i
                                                                class="fa-brands fa-facebook-f"></i></a>
                                                        <a class="item youtube" href="{{ $comFooter->youtube }}" target="_blank" ><i
                                                                class="fa-brands fa-youtube"></i></a>
                                                        <a class="item instagram" href="{{ $comFooter->instagram }}" target="_blank" ><i
                                                                class="fa-brands fa-instagram"></i></a>
                                                    </div>
                                                </div>
                                            </div>
                                             <div class="contact_info qr-code-custome" >

                                                {{-- <img src="{{ asset('img/payment/QR-Code-PNG-Transparent.png') }}" alt=""
                                                    srcset=""> --}}
                                                    {{-- <a href="https://www.tursab.org.tr/pl/qr/AFEHS231182135358d44e025792c4c1" target="_blank" > --}}
                                                        {{-- <img src="data:image/png;base64, {!! base64_encode(
                                                           QrCode::format('png')->color(255, 255, 255)->backgroundColor(27, 34, 76)->size(100)->generate('https://www.tursab.org.tr/pl/qr/AFEHS231182135358d44e025792c4c1'),
                                                       ) !!}" style="margin-bottom: 10px;"> --}}
                                                       {{-- <img src="{{ asset('/website_assets/images/qrNew.PNG') }}" width="90" alt=""> --}}
                                                       {{-- <img src="{{ asset('/website_assets/images/Dijital Doğrulama Sistemi Tursab Belge No 14079(2).png') }}" width="210" alt="">
                                                       </a> --}}
                                                       <div style="position: relative">
                                                       <img src="{{ asset('/website_assets/images/Dijital.png') }}" width="200"  alt="Dijital">


                                                   <a href="https://www.tursab.org.tr/pl/qr/AFEHS231182135358d44e025792c4c1" style="position: absolute;
                                                      bottom: 5px;right: 7px;" target="_blank" >
                                                    {{  QrCode::size(60)->color(255, 255, 255)->backgroundColor(27, 34, 76)->generate('https://www.tursab.org.tr/pl/qr/AFEHS231182135358d44e025792c4c1')}}
                                                </a>
                                            </div>
                                                       <a href="https://etbis.eticaret.gov.tr/sitedogrulama/8317670085184517?638099226044423463" target="_blank" >
                                                        <?php
                                                        $im=QrCode::format('png')
                                                        ->merge('website_assets/images/q1.png', 0.4, true)
                                                        ->size(90)->color(27, 34, 76)->errorCorrection('H')
                                                        ->generate('https://etbis.eticaret.gov.tr/sitedogrulama/8317670085184517?638099226044423463');

                                                        ?>

<img src="data:image/png;base64, {!! base64_encode($im)!!}" style="margin-bottom: 10px;">
</a>


                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>

                        </footer>
    </section>
    <!-- footer -->

    <!-- copy right section -->
    <div class="copyright">
        <h6>All copyrights reserved to safer 2022 </h6>
    </div>

    <!-- javascripts links -->
    <!-- bootstrap 5.0v scripts -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"
        integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous">
    </script>
    <script src="{{ asset('/website_assets/js/bootstrap/bootstrap.bundle.min.js') }}"></script>
    <!-- date picker range links -->
    {{-- <script src="  https://code.jquery.com/jquery-2.2.4.min.js"></script> --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>

    <!-- date picker range links -->

    <!--   double date picker -->
    <!-- Include Required Prerequisites -->
    {{-- <script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/1/jquery.min.js"></script> --}}
    <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>

    <!-- Include Date Range Picker -->
    <script type="text/javascript" src="https://cdn.jsdelivr.net/bootstrap.daterangepicker/2/daterangepicker.js">
    </script>
    <link rel="stylesheet" type="text/css"
        href="https://cdn.jsdelivr.net/bootstrap.daterangepicker/2/daterangepicker.css" />
    <script src="{{ asset('/website_assets/js/datepicker.js') }}"></script>

    <script src="{{ asset('/website_assets/js/momnet.js') }}"></script>
    <script src="{{ asset('/website_assets/js/bootstrap-datepicker.min.js') }}"></script>
    <script src="{{ asset('/website_assets/js/date_picker.js') }}"></script>

    <!-- Slick.s library -->
    <script type="text/javascript" src="https://code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
    <script src="{{ asset('/website_assets/slick/slick-1.8.1/slick/slick.min.js') }}"></script>
    <!-- explore carsoul for turkey section -->
    <script src="{{ asset('/website_assets/js/explore_carsoul.js') }}"></script>
    <!-- video popup library -->
    <script src="{{ asset('/website_assets/js/appleple-modal-video-78d211f/js/jquery-modal-video.min.js') }}"></script>
    <script src="{{ asset('/website_assets/js/appleple-modal-video-78d211f/js/modal-video.js') }}"></script>
    <script async defer src="https://buttons.github.io/buttons.js"></script>
    <script src="{{ asset('/website_assets/js/video.js') }}"></script>
    <!-- image gallery  -->
    <script src="{{ asset('/website_assets/js/image_gllery.js')}}"></script>
    <!-- adding room -->
    <script src="{{ asset('/website_assets/js/main.js')}}"></script>
    {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/dayjs/1.11.4/dayjs.min.js" integrity="sha512-Ot7ArUEhJDU0cwoBNNnWe487kjL5wAOsIYig8llY/l0P2TUFwgsAHVmrZMHsT8NGo+HwkjTJsNErS6QqIkBxDw==" crossorigin="anonymous" referrerpolicy="no-referrer" defer=""defer"></script> --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/js/all.min.js" integrity="sha512-Tn2m0TIpgVyTzzvmxLNuqbSJH3JP8jm+Cy3hvHrW7ndTDcJ1w5mBiksqDBb8GpE2ksktFvDB/ykZ0mDpsZj20w==" crossorigin="anonymous" referrerpolicy="no-referrer" defer="defer"></script>
    {{-- <script src="{{ asset('/website_assets/js/datepicker-bs4.js?')}}" defer="defer"></script> --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>    {{-- owl carousel --}}
    <script>
        $(document).ready(function(){
            // whts pp
$(document).on("click", "#send-it", function() {
  var a = document.getElementById("chat-input");
  if ("" != a.value) {
    var b = $("#get-number").text(),
      c = document.getElementById("chat-input").value,
      d = "https://web.whatsapp.com/send",
      e = b,
      f = "&text=" +  c;
    if (
      /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(
        navigator.userAgent
      )
    )
      var d = "whatsapp://send";
    //   +31 6 29320129
    var g = d + "?phone=+905444668838" + e + f;
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
                $(".owl-carousel").owlCarousel({
                    items:4,
                    loop:true,
                    margin:10,
                    autoplay:true,
                    autoplayTimeout:3000,
                    autoplayHoverPause:true,
                    responsiveClass:true,
                    responsive:{
                        0:{
                            items:1,

                        },
                        600:{
                            items:2,
                            margin:0
                        },
                        900:{
                            items:3,
                            margin:0

                        },
                        1345:{
                            items:4,
                            margin:0
                        }
                    }
                });
            });
    </script>
    <script src="{{ asset('/website_assets/js/owl.carousel.min.js')}}"></script>
    {{-- owl carousel --}}
    <script src="{{ asset('/website_assets/js/add_room.js')}}"></script>
    <script src="{{ asset('/website_assets/js/adding_years_Select.js')}}"></script>
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    @yield("adds_js")
</body>

</html>
