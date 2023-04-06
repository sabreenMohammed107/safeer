@extends('layout.website.layout', ['Company' => $Company, 'title' => 'Safer | About Us'])

@section('adds_css')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="{{ asset('/website_assets/css/about.css') }}">
@endsection

@section('bottom-header')
    <x-website.header.general title="{{ __('links.about_us') }}"  :breadcrumb="$BreadCrumb" current="" />
@endsection
@section('content')
    <!-- explore turkey -->
    <section class="investigtion">
        <div class="chosing container">
            <div class="choosing_title">
                @if (LaravelLocalization::getCurrentLocale() === 'en')

                <h5>{{ $Company->why_us_entitle }}</h5>
                <p class="px-5">
                    {{ $Company->why_us_entext }}
                </p>
                @else
                <h5> {{ $Company->why_us_artitle }}</h5>
                <p class="px-5">
                    {{ $Company->why_us_artext }}  </p>
                @endif

            </div>
            <div class="benefits">
                <div class="row mx-0">
                    @foreach ($whyUss as $whyUs)
                    <div class="col-sm-12 col-md-4">
                        <div class="benefits_info">

                            <img src="{{ asset('uploads/whyUs') }}/{{$whyUs->icon}}" alt="safty sheild">
                            @if (LaravelLocalization::getCurrentLocale() === 'en')
                            <h6>
                                {{$whyUs->en_title}}
                            </h6>
                            <p>
                                {{$whyUs->en_text}}
                            </p>

                @else
                <h6>

                    {{$whyUs->ar_title}}
                </h6>
                <p>
                    {{$whyUs->ar_artext}}
                </p>
                @endif

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
                @if (LaravelLocalization::getCurrentLocale() === 'en')

                <h2>
                    {{$Company->oveview_entitle}} <br>
                    {{$Company->overview_ensubtitle}}
                  </h2>
                  <p>
                    {{$Company->overview_en}}
                  </p>
                @else
                <h2>
                    {{$Company->oveview_artitle}} <br>
                    {{$Company->overview_arsubtitle}}
                  </h2>
                  <p>
                    {{$Company->overview_ar}}
                  </p>
                @endif

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
                        <h6> @if (LaravelLocalization::getCurrentLocale() === 'en')

                            our mission
                            @else

مهمتنا
                            @endif</h6>
                    </div>
                    <p>
                        @if (LaravelLocalization::getCurrentLocale() === 'en')
                        {{$Company->mission_en}}

                    @else
                    {{$Company->mission_ar}}
                    @endif

                    </p>
                </div>
            </div>
            <div class="col-sm-12 col-md-6">
                <div class="obj_title">

                    <img class="vission_img" src="{{ asset('/website_assets/images/about/objectives/target.webp') }}" alt="target icon">
                    <h6>@if (LaravelLocalization::getCurrentLocale() === 'en')

                        our vission
                        @else

                        رؤيتنا
                        @endif</h6>
                </div>
                <p>
                    @if (LaravelLocalization::getCurrentLocale() === 'en')
                    {{$Company->vision_en}}

                    @else
                    {{$Company->vision_ar}}
                    @endif

                </p>
            </div>
        </div>

        <img src="{{ asset('/website_assets/images/about/bird-group.webp') }}" alt="bords group">

    </section>
    <!--  ending page  -->
@endsection
