@extends('layout.website.layout', ['Company' => $Company, 'title' => 'Safer | Contact Us'])

@section('adds_css')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="{{ asset('/website_assets/css/about.css') }}">
    <link rel="stylesheet" href="{{ asset('/website_assets/css/contact.css') }}">
    <link rel="stylesheet" href="{{ asset('/website_assets/css/contacts-1.css') }}">
@endsection

@section('bottom-header')
    <x-website.header.general title="Contact Us" :breadcrumb="$BreadCrumb" current="" />
@endsection
@section('content')
    <!-- socail channels -->
    <section class="socail_channels container">
        <h5>contact us via our social channels.</h5>

        <div class="row mx-0">
            <div class="col-sm-12 col-md-6 col-xl-4">
                <div class="card-content socail">
                    <div class=" card  socail_card">

                        <img src=" {{ asset('/website_assets/images/contact/location.webp') }}" alt=" location pin ">
                        <div class="card-body socail_info">
                            <div class="card_info">
                                <h6>
                                    Our Location

                                </h6>
                                <span>
                                    {{ $master->detailed_address_en }}

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
                                    phone number
                                </h6>
                                <span class="info">
                                    <a href="tel:{{ $master->phone }}"> {!! $master->phone !!}</a>
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
                                    e-mail

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
    </section>
    <!-- need help section -->
    <section class="help_section socail_channels">


        <img src=" {{ asset('/website_assets/images/hotel-details/slider-mask_top.webp') }}" alt=" slider mask top">
        <img src="{{ asset('/website_assets/images/hotel-details/slider-mask-bottom.webp') }}" alt=" slider mask bottom">
        <div class="container">

            <h5> We Provide Best Services <br>
                Need Help? </h5>
                @if(Session::has('flash_success'))

                <div class="alert alert-success alert-dismissible fade show" role="alert"

                <strong ><i class="fa fa-check-circle"></i> {{session('flash_success')}}</strong>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
              </div>

            @endif
            <form action="{{ route('contact.store') }}" method="post">
                @csrf
                <div class="row mx-0">
                    <div class="col-md-12 col-xl-6 col-sm-12">
                        <div class="mb-3">
                            <input type="text" name="name"
                                class="form-control {{ $errors->has('name') ? 'error' : '' }}" id="name"
                                placeholder="Your Name *" required>
                            @if ($errors->has('name'))
                                <div class="error">
                                    {{ $errors->first('name') }}
                                </div>
                            @endif
                        </div>
                        <div class="mb-3">
                            <input type="email" class="form-control {{ $errors->has('email') ? 'error' : '' }}"
                                name="email" id="email" placeholder=" Your Email*" required>
                            @if ($errors->has('email'))
                                <div class="error">
                                    {{ $errors->first('email') }}
                                </div>
                            @endif
                        </div>
                        <div class="mb-3">
                            <input type="number" class="form-control {{ $errors->has('phone') ? 'error' : '' }}"
                                name="phone" id="phone" placeholder="Your Phone *" required>
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
                                placeholder="Send message* " required></textarea>
                            @if ($errors->has('message'))
                                <div class="error">
                                    {{ $errors->first('message') }}
                                </div>
                            @endif
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="mb-3 mt-3">
                            <button type="submit" class="btn btn-primary">send message</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>

    </section>

    <section class="details_office container">
        <div class="row mx-0  mb-3">
            @isset($branches[0])
                <div class="col-sm-12 col-md-6">
                    <div class="offices_info">
                        <div class="help_info">
                            <h6>
                                {{ $branches[0]->branch_enname }}

                            </h6>
                            <span> {{ $branches[0]->detailed_address_en }}</span>
                            {{-- <span> new york NY 10010</span> --}}
                            <span> phone : {{ $branches[0]->phone }}</span>
                            <span>fax: {{ $branches[0]->fax }}</span>
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
        <div class="row mx-0  mb-3">
            @isset($branches[1])
                <div class="col-md-6 col-sm-12">
                    <iframe src="{{ $branches[1]->google_map }}" style="border:0;" allowfullscreen="" loading="lazy"
                        referrerpolicy="no-referrer-when-downgrade"></iframe>
                </div>
                <div class="col-sm-12 col-md-6">
                    <div class="offices_info">
                        <div class="help_info">
                            <h6>
                                {{ $branches[1]->branch_enname }}
                            </h6>
                            <span> {{ $branches[1]->detailed_address_en }}</span>
                            {{-- <span> new york NY 10010</span> --}}
                            <span> phone : {{ $branches[1]->phone }}</span>
                            <span>fax:{{ $branches[1]->fax }}</span>
                            <span>email:{{ $branches[1]->email }}</span>
                        </div>
                    </div>
                </div>
            @endisset




        </div>

    </section>

    <!--  ending page  -->
@endsection
