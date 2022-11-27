@extends('layout.website.layout', ['Company' => $Company, 'title' => 'Safer | About Us'])

@section('adds_css')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="{{ asset('/website_assets/css/about.css') }}">
@endsection

@section('bottom-header')
    <x-website.header.general title="About Us" :breadcrumb="$BreadCrumb" current="" />
@endsection
@section('content')
    <!-- explore turkey -->
    <section class="investigtion">
        <div class="chosing container">
            <div class="choosing_title">
                <h5>why choose us</h5>
                <p>
                    When it comes to exploring exotic places, the choices are numerous. Whether you like peaceful <br>
                    destinations or vibrant landscapes, we have offers for you.
                </p>
            </div>
            <div class="benefits">
                <div class="row mx-0">
                    <div class="col-sm-12 col-md-4">
                        <div class="benefits_info">

                            <img src="{{ asset('/website_assets/images/about/benefits/safe.webp') }}" alt="safty sheild">
                            <h6>
                                Best Price Guarantee
                            </h6>
                            <p>
                                Lorem ipsum dolor sit amet, consectetur <br>
                                adipiscing elit.
                            </p>
                        </div>
                    </div>

                    <div class="col-sm-12 col-md-4">
                        <div class="benefits_info">

                            <img src="{{ asset('/website_assets/images/about/benefits/timer.webp') }}" alt="time">
                            <h6>
                                Easy & Quick Booking
                            </h6>
                            <p>
                                Lorem ipsum dolor sit amet, consectetur <br>
                                adipiscing elit.
                            </p>
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-4">
                        <div class="benefits_info">

                            <img src="{{ asset('/website_assets/images/about/benefits/service.webp') }}" alt="customer service">
                            <h6>
                                customer care 24/7
                            </h6>
                            <p>
                                Lorem ipsum dolor sit amet, consectetur <br>
                                adipiscing elit.
                            </p>
                        </div>
                    </div>
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
                {{-- <div class="read">
                  <a href="#">Read more
                    <i class="fa-solid fa-angle-right"></i>
                    <i class="fa-solid fa-angle-right"></i>
                  </a>
                </div> --}}
               </div>

               </div>
              </div>
            </div>
            <img src="{{ asset('/website_assets/images/homePage/birds (2).webp') }}" alt="birds image">
          </div>
    </section>
    <x-website.home.counters :counters="$Counters" />

    <section class="objectives container">
        <div class="row mx-0">
            <div class="col-sm-12 col-md-6">
                <div class="left">
                    <div class="obj_title">

                        <img src=" {{ asset('/website_assets/images/about/objectives/capaign.webp') }}" alt="campaign icon">
                        <h6>our mission</h6>
                    </div>
                    <p>
                        {{$Company->mission_en}}
                    </p>
                </div>
            </div>
            <div class="col-sm-12 col-md-6">
                <div class="obj_title">

                    <img class="vission_img" src="{{ asset('/website_assets/images/about/objectives/target.webp') }}" alt="target icon">
                    <h6>our vission</h6>
                </div>
                <p>
                    {{$Company->vision_en}}
                </p>
            </div>
        </div>

        <img src="{{ asset('/website_assets/images/about/bird-group.webp') }}" alt="bords group">

    </section>
    <!--  ending page  -->
@endsection
