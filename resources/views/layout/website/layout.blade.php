<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <!-- facebook meta tags -->
  <meta property="og:type" content="website"/>
  <meta property="og:title" content="Safer - Online hub for booking  trourism trips"/>
  <meta property="og:description" content="Safer providing you online planning  your  next vacations and  booking trips around the world"/>
  <meta property="og:url" content="https://safercom/"/>
  <meta property="og:image" content="./images/homePage/logo.webp"/>
  <meta property="og:image:alt" content="Safer - Online hub for booking  trourism trips"/>
  <meta property="og:site_name" content="safer.com" />
<!-- twitter meta tags -->
  <meta name="twitter:card" content="summary"/>
  <meta name="twitter:site" content="safer.com">
  <meta name="twitter:creator" content="safer.com">
  <meta name="twitter:title" content="Safer - Online hub for booking  trourism trips"/>
  <meta name="twitter:description" content="Safer providing you online planning  your  next vacations and  booking trips around the world "/>
  <meta name="twitter:url" content="https://safer.com/"/>
  <meta name="twitter:image" content="/images/homePage/logo.webp"/>
  <meta property="twitter:image:alt" content="Safer - Online hub for booking  trourism trips"/>
  <!-- general meta tags  -->
  <meta name="canonical_tag" content="https://safer.com/"/>
  <meta name="canonical_tag" content=""/>
  <meta name="title" content="Safer - Online hub for booking  trourism trips"/>
  <meta name="description" content="Safer providing you online planning  your  next vacations and  booking trips around the world"/>
  <meta name="image" content="/images/homePage/logo.webp"/>
  <meta property="image:alt" content="Safer - Online hub for booking  trourism trips"/>
  <meta name="keywords" content="hotels tours transfer visa contact trip destination adults child nights checkin room explore adventure experience offers travel packages agents acitivties hotel  transfer honemoon safari pharonic newsletter   " />
<!-- style sheets  -->
  <!-- fontawesome  -->
  <link rel="stylesheet" href="{{ asset('/website_assets/css/all.min.css') }}">
  <!-- fonts google -->
  <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@200;300;400;500;600;700;800;900;1000&display=swap" rel="stylesheet">
  <!-- bootstrap -->
  <link rel="stylesheet" href="{{ asset('/website_assets/css/bootstrap/bootstrap.min.css') }}">
  <!-- normalize -->
  <link rel="stylesheet" href="{{ asset('/website_assets/css/normalize.css') }}">
  <!-- slick cdn link -->
  <link rel="stylesheet" href="{{ asset('/website_assets/slick/slick-1.8.1/slick/slick.css') }}">
  <!-- video poppp styele -->
  <link rel="stylesheet" href="{{ asset('/website_assets/js/appleple-modal-video-78d211f/css/modal-video.min.css') }}">
  <!-- stylesheet  -->
  <link rel="stylesheet" href="{{ asset('/website_assets/css/style.css') }}">
  <!-- icon -->
  <link rel="icon" href="{{ asset('/website_assets/images/homePage/logo.webp') }}">
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

            <div class="input-group input">
              <input type="email" class="form-control" placeholder="Enter your email" aria-label="Recipient's username" aria-describedby="button-addon2">
              <button class="btn btn-outline-secondary" type="button" id="button-addon2"><a href="#">
                Join our newsletter
              </a></button>
            </div>


          </div>
        </div>
      </div>
    </div>
    <footer>
      <div class="container">
        <div class="row mx-0">
          <div class="col-xl-5 col-md-12 col-sm-12">
            <div class="left_info">
              <h6>About us  </h6>
              <p>
                {{$Company->overview_en}}             </p>
            </div>
          </div>
          <!-- useful links -->
          <div class="col-xl-4 col-md-6 col-sm-12">
            <div class="useful_links">
              <h6>useful links </h6>
            <div class="row mx-0">
              <div class="col-6">
                <ul>
                  <li><i class="fa-solid fa-angle-right"></i><a href = "#">product 1 </a></li>
                   <li><i class="fa-solid fa-angle-right"></i><a href = "#">product 1 </a></li>
                <li><i class="fa-solid fa-angle-right"></i><a href = "#">product 1 </a></li>
                   <li><i class="fa-solid fa-angle-right"></i><a href = "#">product 1 </a></li>
                   <li><i class="fa-solid fa-angle-right"></i><a href = "#">product 1 </a></li>
                </ul>
              </div>
              <div class="col-6">
                <ul>
                  <li><i class="fa-solid fa-angle-right"></i><a href = "#">product 1 </a></li>
                   <li><i class="fa-solid fa-angle-right"></i><a href = "#">product 1 </a></li>
                   <li><i class="fa-solid fa-angle-right"></i><a href = "#">product 1 </a></li>
                   <li><i class="fa-solid fa-angle-right"></i><a href = "#">product 1 </a></li>
                   <li><i class="fa-solid fa-angle-right"></i><a href = "#">product 1 </a></li>

                </ul>
              </div>
            </div>
            </div>
          </div>
          <!-- contact details -->
          <div class="col-xl-3 col-md-6">
            <div class="contact_details">
              <h6>Contact us</h6>
              <div class="contact_info">
                <div class="info">
                  <i class="fa-solid fa-phone"></i>
                  <span>01093174220</span>
                </div>
              </div>
              <div class="contact_info">
                <div class="info">
                  <i class="fa-solid fa-envelope"></i>
                  <span>e-mail@geenf.com</span>
                </div>
              </div>
              <div class="contact_info">
                <div class="info">
                  <i class="fa-solid fa-location-dot"></i>
                  <span>Nasr city -Abbas el akkad</span>
                </div>
              </div>
              <div class="contact_info">
                <div class="info socail_links">
                 <a href="{{$Company->facebook}}" target="_blank"> <i class="fa-brands fa-facebook-f"></i></a>
                 <a href="{{$Company->youtube}}" target="_blank"> <i class="fa-brands fa-youtube"></i></a>
                 <a href="{{$Company->instagram}}" target="_blank"><i class="fa-brands fa-instagram"></i></a>

                </div>
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
    <h6>All copyrights reserved to website 2021 </h6>
  </div>

  <!-- javascripts links -->
  <!-- bootstrap 5.0v scripts -->
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
  <script src="{{ asset('/website_assets/js/bootstrap/bootstrap.bundle.min.js') }}"></script>
<!-- date picker range links -->
  <script src="  https://code.jquery.com/jquery-2.2.4.min.js"></script>
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
  <script src="{{ asset('/website_assets/js/video.js') }}"></script>
@yield("adds_js")
</body>
</html>
