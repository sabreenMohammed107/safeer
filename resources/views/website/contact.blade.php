@extends('layout.website.layout', ['Company' => $Company, 'title' => 'Safer | Contact Us'])

@section('adds_css')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="{{ asset('/website_assets/css/about.css') }}">
    <link rel="stylesheet" href="{{ asset('/website_assets/css/contact.css') }}">
    <link rel="stylesheet" href="{{ asset('/website_assets/css/contacts-1.css') }}">
@endsection

@section('bottom-header')
    <x-website.header.general title="{{ __('links.contact_us') }}" :breadcrumb="$BreadCrumb" current="" />
@endsection
@section('content')
    <!-- socail channels -->
    <section class="socail_channels container">
        <h5>
            @if (LaravelLocalization::getCurrentLocale() === 'en')
                contact us via our social channels.
            @else
                اتصل بنا عبر قنواتنا الاجتماعية.
            @endif
        </h5>

        <div class="row mx-0">
            <div class="col-sm-12 col-md-6 col-xl-4">
                <div class="card-content socail">
                    <div class=" card  socail_card">

                        <img src=" {{ asset('/website_assets/images/contact/location.webp') }}" alt=" location pin ">
                        <div class="card-body socail_info">
                            <div class="card_info">
                                <h6>
                                    @if (LaravelLocalization::getCurrentLocale() === 'en')
                                        Our Location
                                    @else
                                        موقعنا
                                    @endif

                                </h6>
                                <span>
                                    @if (LaravelLocalization::getCurrentLocale() === 'en')
                                        {{ $master->detailed_address_en }}
                                    @else
                                        {{ $master->detailed_address_ar }}
                                    @endif


                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-12 col-md-6 col-xl-4">
                <div class="card-content socail">
                    <div class=" card  socail_card">

                        <img src=" {{ asset('/website_assets/images/contact/call center.webp') }}"
                            alt=" call center logo  ">
                        <div class="card-body socail_info">
                            <div class="card_info">
                                <h6>

                                    @if (LaravelLocalization::getCurrentLocale() === 'en')
                                        phone number
                                    @else
                                        رقم التليفون
                                    @endif
                                </h6>
                                <span class="info">
                                    <a href="tel:{{ $master->phone }}">  @if (LaravelLocalization::getCurrentLocale() === 'en')
                                        {!! $master->phone !!}
                                    @else
                                    {!! $master->ar_phone !!}
                                    @endif</a>
                                </span>
                                {{-- <span class="info">
                              <a href="tel:011551112211">011551112211</a>
                            </span> --}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-12 col-md-6 col-xl-4">
                <div class="card-content socail">
                    <div class=" card  socail_card">

                        <img src="{{ asset('/website_assets/images/contact/message.webp') }}" alt="messages logo ">
                        <div class="card-body socail_info">
                            <div class="card_info">
                                <h6>
                                    {{ __('links.email') }}
                                </h6>
                                <span class="info">
                                    <a href="mailto:{{ $master->email }}"> {{ $master->email }}</a>

                                </span>
                                {{-- <span class="info">
                          <a href="mailto:ADMIN@yahoo.com">ADMIN@yahoo.com</a>

                        </span> --}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-12 col-md-6 col-xl-4 mt-2"></div>
            <div class="col-sm-12 col-md-6 col-xl-4 mt-2">
                <div class="card-content ">
                    <div class=" card" style="border: none">

                        {{-- <img src="{{ asset('/website_assets/images/contact/message.webp') }}" alt="messages logo "> --}}
                        <div class="card-body " style="margin: auto;display:flex">

                             <div style="position: relative ;margin:0 10px">
                                <img src="{{ asset('/website_assets/images/Dijital.png') }}" width="270"  alt="Dijital">


                                <a href="https://www.tursab.org.tr/pl/qr/AFEHS231182135358d44e025792c4c1" style="position: absolute;
                                   bottom: 5px;right: 7px;" target="_blank" >
                                 {{  QrCode::size(60)->color(255, 255, 255)->backgroundColor(27, 34, 76)->generate('https://www.tursab.org.tr/pl/qr/AFEHS231182135358d44e025792c4c1')}}
                             </a>
</div>
                            <a href="https://etbis.eticaret.gov.tr/sitedogrulama/8317670085184517?638099226044423463" target="_blank" >
                                <?php
                                $im=QrCode::format('png')
                                ->merge('website_assets/images/q1.png', 0.4, true)
                                ->size(100)->color(27, 34, 76)->errorCorrection('H')
                                ->generate('https://etbis.eticaret.gov.tr/sitedogrulama/8317670085184517?638099226044423463');

                                ?>

<img src="data:image/png;base64, {!! base64_encode($im)!!}" style="margin-bottom: 10px;">
</a>
                        </div>
                        {{-- </div>  --}}
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- need help section -->
    <section class="help_section socail_channels">


        <img class="w-100" src=" {{ asset('/website_assets/images/hotel-details/slider-mask_top.webp') }}" alt=" slider mask top">
        <img class="w-100" src="{{ asset('/website_assets/images/hotel-details/slider-mask-bottom.webp') }}" alt=" slider mask bottom">
        <div class="container">

            <h5>
                @if (LaravelLocalization::getCurrentLocale() === 'en')
                    We Provide Best Services <br>
                    Need Help?
                @else
                    نحن نقدم أفضل الخدمات <br>
                    تحتاج مساعدة؟
                @endif
            </h5>
            @if (Session::has('flash_success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert" <strong><i
                        class="fa fa-check-circle"></i> {{ session('flash_success') }}</strong>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div><br />
            @endif
            <form action="{{ route('contact.store') }}" method="post">
                @csrf
                <div class="row mx-0">
                    <div class="col-md-12 col-xl-6 col-sm-12">
                        <div class="mb-3">
                            <input type="text" name="name" value="{{ old('name') }}"
                                class="form-control {{ $errors->has('name') ? 'error' : '' }}" id="name"
                                placeholder="{{ __('links.name') }}
                                " required>
                            @if ($errors->has('name'))
                                <div class="error">
                                    {{ $errors->first('name') }}
                                </div>
                            @endif
                        </div>
                        <div class="mb-3">
                            <input type="email" class="form-control {{ $errors->has('email') ? 'error' : '' }}"
                                name="email" value="{{ old('email') }}" id="email"
                                placeholder=" {{ __('links.email') }}
                                " required>
                            @if ($errors->has('email'))
                                <div class="error">
                                    {{ $errors->first('email') }}
                                </div>
                            @endif
                        </div>
                        <div class="mb-3">
                            <input type="number" value="{{ old('phone') }}"
                                class="form-control {{ $errors->has('phone') ? 'error' : '' }}" name="phone"
                                id="phone" placeholder="{{ __('links.mobile') }}
                                "
                                required>
                            @if ($errors->has('phone'))
                                <div class="error">
                                    {{ $errors->first('phone') }}
                                </div>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-12 col-xl-6 col-sm-12">
                        <div class="mb-3">
                            <textarea class="form-control{{ $errors->has('message') ? 'error' : '' }}" name="message" id="message" rows="3"
                                placeholder="{{ __('links.send_msg') }}
                                " required>{{ old('message') }}</textarea>
                            @if ($errors->has('message'))
                                <div class="error">
                                    {{ $errors->first('message') }}
                                </div>
                            @endif
                        </div>
                    </div>
                    <div class="form-group mb-4">
                        <div class="captcha">
                            <span>{!! captcha_img() !!}</span>
                            <button type="button" class="btn btn-danger" class="reload" id="reload">
                                &#x21bb;
                            </button>
                        </div>
                    </div>
                    <div class="form-group mb-4">
                        <input id="captcha" type="text" class="form-control" required
                            placeholder="{{ __('links.enterCapcha') }}" name="captcha">
                        @if ($errors->has('captcha'))
                            <div class="error">
                                {{ $errors->first('captcha') }}
                            </div>
                        @endif
                    </div>
                    <div class="col-12">
                        <div class="mb-3 mt-3">
                            <button type="submit" class="btn btn-primary">{{ __('links.send_msg') }}</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>

    </section>

    <section class="details_office container" style="padding-top: 0">
        <div class="row mx-0  mb-3">
            @isset($branches[0])
                <div class="col-sm-12 col-md-6">
                    <div class="offices_info">
                        <div class="help_info">
                            <h6 class="mb-3">
                                @if (LaravelLocalization::getCurrentLocale() === 'en')
                                    {{ $branches[0]->branch_enname }}
                                @else
                                    {{ $branches[0]->branch_arname }}
                                @endif


                            </h6>
                            <span>
                                @if (LaravelLocalization::getCurrentLocale() === 'en')
                                    {{ $branches[0]->detailed_address_en }}
                                @else
                                    {{ $branches[0]->detailed_address_ar }}
                                @endif
                            </span>
                            {{-- <span> new york NY 10010</span> --}}
                            <span> phone :<br> {!! $branches[0]->phone !!}</span>
                            {{-- <span>fax: {{ $branches[0]->fax }}</span> --}}
                            <span>email: {{ $branches[0]->email }}</span>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-sm-12">
                    <iframe src=" {{ $branches[0]->google_map }}" style="border:0;" allowfullscreen="" loading="lazy"
                        referrerpolicy="no-referrer-when-downgrade"></iframe>
                </div>
            @endisset



        </div>


    </section>

    <!--  ending page  -->
@endsection
@section('adds_js')
    <script type="text/javascript">
        $('#reload').click(function() {
            $.ajax({
                type: 'GET',
                url: 'reload-captcha',
                success: function(data) {
                    $(".captcha span").html(data.captcha);
                }
            });
        });
    </script>
@endsection
