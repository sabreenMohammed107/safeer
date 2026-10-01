@extends('layout.website.layout', ['Company' => $Company, 'title' => 'Safer | Visa'])

@section('adds_css')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.19/css/intlTelInput.css">

    <link rel="stylesheet" href="{{ asset('/website_assets/css/about.css') }}">
    <link rel="stylesheet" href="{{ asset('/website_assets/css/tours.css') }}">
    <link rel="stylesheet" href="{{ asset('/website_assets/css/hotel.css') }}">
    <link rel="stylesheet" href="{{ asset('/website_assets/css/visa-search.css') }}">
    <link rel="stylesheet" href="{{ asset('/website_assets/css/visa-step-1.css') }}">

    <style>
        .pageActive {
            color: white !important;
            background-color: #210D3A !important;
        }

        .slider_section .slider_details {
            height: 420px !important;
        }

        .icons-container .social-icons .item i.fa-brands {
            padding-top: 15px;
        }

        input.nosubmit {
            border: none;

            margin: 0;
            padding: 7px 8px;
            font-size: 14px;
            color: inherit;
            border: 1px solid #0000001f;
            border-radius: inherit;
            width: 260px;
            /* border: 1px solid #555; */
            display: block;
            padding: 9px 4px 9px 40px;

            background: transparent url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='16' height='16' class='bi bi-search' viewBox='0 0 16 16'%3E%3Cpath d='M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z'%3E%3C/path%3E%3C/svg%3E") no-repeat 13px center;
        }

        .header-icon_search_custom:before {
            content: '\0045';
        }

        [class*='header-']:before {
            display: inline-block;
            font-family: 'header_icons';
            font-style: normal;
            font-weight: normal;
            line-height: 1;
            -webkit-font-smoothing: antialiased;
            -moz-osx-font-smoothing: grayscale;
        }

        .obj {
            position: absolute;
            top: 0;
            right: 0;
        }

        .booking_info .details>label {
            font-size: 12px;
            font-weight: 600;
            text-transform: capitalize;
            color: #1C4482;
            /* width: 80px; */
            margin-right: 10px;
            padding: 0;
        }

        .receipt-title {
            border-bottom: 2px solid #00ACEE;
            border-left: 2px solid #00ACEE;
            font-weight: bold;
            padding-left: 10px;
            padding-bottom: 5px;
            font-size: 1.2em;
        }

        .search_details_info input {
            display: block;
            width: 100%;
            padding: 0.375rem 0.1rem;
        }

        /* Country code + mobile number field */
        .phone_field {
            direction: ltr;
        }

        .phone_field .iti {
            display: block;
            width: 100%;
        }

        .phone_field .iti input {
            display: block;
            width: 100%;
            padding: .375rem .75rem .375rem .75rem;
            font-weight: 400;
            line-height: 1.5;
            color: #212529;
            background-color: transparent;
            border: 1px solid #ced4da;
            border-radius: .25rem;
            font-size: 12px;
            text-align: left;
        }

        .phone_field .iti input:focus {
            outline: none;
            border-color: #1C4482;
            box-shadow: 0 0 0 0.1rem rgba(28, 68, 130, 0.15);
        }

        .phone_field .iti--separate-dial-code .iti__selected-flag {
            background-color: #f8f9fa;
            border-right: 1px solid #ced4da;
            border-radius: .25rem 0 0 .25rem;
        }

        .phone_field .iti__country-list {
            text-align: left;
            z-index: 20;
        }

        .visa-guest-choice {
            border: 1px solid #e4e6ef;
            border-radius: 8px;
            background: #f8f9fb;
        }

        /* Unified action-button system for "Continue as Guest" / "Login / Register".
           Every rule below is scoped under #guestChoiceButtons (an ID selector) so
           it reliably outranks visa-step-1.css's `.passenger_info_details button`
           rule (specificity: 1 class + 1 element). That shared rule targets *every*
           <button> inside this section for the small circular "remove passenger"
           control — background:#f5f5f5, border:none, border-radius:50%, padding:5px 7px,
           position:absolute; top/right:13px — and without out-ranking it,
           #continueAsGuestBtn (a <button>) inherits all of that and renders as
           unstyled/misplaced text instead of a button. #loginRegisterBtn is an <a>
           so it was never affected by that rule, which is why only the primary
           button looked broken. */
        #guestChoiceButtons .visa-btn {
            position: static;
            top: auto;
            right: auto;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            height: 46px;
            padding: 0 28px;
            font-size: 15px;
            font-weight: 600;
            line-height: 1;
            border-radius: 10px;
            border: 1px solid #1C4482;
            text-decoration: none;
            text-transform: capitalize;
            white-space: nowrap;
            cursor: pointer;
            transition: background-color .2s ease, color .2s ease, border-color .2s ease, opacity .2s ease;
        }

        /* Primary / default action */
        #guestChoiceButtons .visa-btn--primary {
            background-color: #1C4482;
            border-color: #1C4482;
            color: #fff;
        }

        #guestChoiceButtons .visa-btn--primary:hover,
        #guestChoiceButtons .visa-btn--primary:focus {
            opacity: .85;
            color: #fff;
            text-decoration: none;
        }

        /* Secondary / outlined action */
        #guestChoiceButtons .visa-btn--outline {
            background-color: transparent;
            border-color: #1C4482;
            color: #1C4482;
        }

        #guestChoiceButtons .visa-btn--outline:hover,
        #guestChoiceButtons .visa-btn--outline:focus {
            background-color: #1C4482;
            color: #fff;
            text-decoration: none;
        }

        /* Visa cost/notes box: the notes HTML comes from a rich-text editor
           (pasted-from-Google-Docs content with heavy inline styles), so the
           !important overrides below are needed to normalize typography —
           a plain class can't beat an inline style="" in CSS specificity. */
        .costBerVisa {
            background-color: #f8f9fb;
            border: 1px solid #e4e6ef;
            border-radius: 12px;
            padding: 20px 22px;
        }

        .costBerVisa .visaCost {
            color: #1C4482;
            font-weight: 700;
        }

        /* 3 cards per row on desktop, 2 on tablet, 1 on mobile */
        .visNotes {
            display: grid;
            grid-template-columns: repeat(3, minmax(0, 1fr));
            gap: 14px;
            margin-top: 14px;
        }

        @media (max-width: 1199.98px) {
            .visNotes {
                grid-template-columns: repeat(2, minmax(0, 1fr));
            }
        }

        @media (max-width: 767.98px) {
            .visNotes {
                grid-template-columns: minmax(0, 1fr);
            }
        }

        .visa-notes-card {
            background-color: #fff;
            border: 1px solid #e4e6ef;
            border-radius: 10px;
            padding: 14px 18px;
            box-shadow: 0 2px 6px rgba(28, 68, 130, 0.06);
            overflow-wrap: anywhere;
        }

        /* intro heading line ("Important instructions ...") spans the full row */
        .visa-notes-card--title {
            grid-column: 1 / -1;
        }

        .visa-notes-card p,
        .visa-notes-card span {
            font-family: inherit !important;
            color: #3a3a3a !important;
            background-color: transparent !important;
            font-size: 15px !important;
            line-height: 1.7 !important;
            margin: 0 !important;
        }

        /* The first line of each card is the section's own title
           ("Visa Validity:", "Basic Requirements:", ...) — styled as a
           heading instead of blending into the body text below it. */
        .visa-notes-card > p:first-child,
        .visa-notes-card > p:first-child span {
            color: #1C4482 !important;
            font-weight: 700 !important;
            font-size: 16px !important;
            margin-bottom: 6px !important;
        }
    </style>


@endsection

@section('bottom-header')
    <x-website.header.general title="{{ __('links.visa') }}" :breadcrumb="$BreadCrumb" current="{{ __('links.visa') }}" />
@endsection
@section('content')

    @php
        $isGuest = !session()->get('SiteUser');
    @endphp

    <div class="container mt-3">
        @if (session('session-success'))
            <div class="alert alert-success">
                {{ session('session-success') }}
            </div>
        @endif
        @if (session('session-danger'))
            <div class="alert alert-danger">
                {{ session('session-danger') }}
            </div>
        @endif
        @if ($errors->any())
            <div class="alert alert-danger">
                @foreach ($errors->all() as $error)
                    <p class="mb-1">{{ $error }}</p>
                @endforeach
            </div>
        @endif
    </div>

    <form action="{{ $isGuest ? route('visa.guest.store') : LaravelLocalization::localizeUrl('/Safer/BookVisa') }}"
        method="POST" enctype="multipart/form-data">
        @csrf
        {{-- Honeypot field: hidden from real users, spam bots tend to fill every input --}}
        <div class="visually-hidden" aria-hidden="true">
            <label for="hp_website">Leave this field blank</label>
            <input type="text" name="hp_website" id="hp_website" tabindex="-1" autocomplete="off">
        </div>
        <section class="passenger_section container pt-5" id="passenger_section">
            <p class="receipt-title">
                @if (LaravelLocalization::getCurrentLocale() === 'en')
                    Pickup Your Visa
                @else
                    احصل على التأشيرات الخاصة بك
                @endif
            </p>
            <div class=" search_details_info passenger_info_details hotel_details mt-3 ">

                <!-- <button  onclick="removePassenger(this)">
                                      <i class="fa-solid fa-xmark"></i>
                                    </button> -->
                {{-- <form data-category="1"> --}}
                <div class="passenger_info_title">
                    <h5> {{ __('links.passenger') }} </h5>
                    <!-- <span>1200 LE</span> -->
                </div>
                <div class="row mx-0">
                    <div class="col-md-6 col-xl-4 col-sm-12 ">
                        <label for="">
                            @if (LaravelLocalization::getCurrentLocale() === 'en')
                                visa request country
                            @else
                                الدولة المسافر إليها
                            @endif
                        </label>
                        <select class="form-select form-select-solid dynamic" data-control="select2"
                            data-placeholder="Select an option" required data-show-subtext="true" data-live-search="true"
                            id="country" data-dependent="sub" name="{{ $isGuest ? 'country' : 'country[0]' }}"
                            @if (LaravelLocalization::getCurrentLocale() === 'en') oninvalid="this.setCustomValidity('Please select an item from list')" @else
                            oninvalid="this.setCustomValidity('من فضلك اختر عنصر من القائمة ')" @endif
                            oninput="setCustomValidity('')">
                            <option value=""></option>
                            @foreach ($countries as $country)
                                <option value="{{ $country->id }}">
                                    @if (LaravelLocalization::getCurrentLocale() === 'en')
                                        {{ $country->en_country }}
                                    @else
                                        {{ $country->ar_country }}
                                    @endif

                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-6 col-xl-4 col-sm-12">
                        <label for="">
                            @if (LaravelLocalization::getCurrentLocale() === 'en')
                                Visa type
                            @else
                                نوع الفيزا
                            @endif
                        </label>
                        <select required class="form-select form-select-solid visa_type" data-control="select2 sub2"
                            data-placeholder="Select an option" data-show-subtext="true" data-live-search="true"
                            id="sub" name="{{ $isGuest ? 'visa_type_id' : 'visa_type_id[0]' }}"
                            @if (LaravelLocalization::getCurrentLocale() === 'en') oninvalid="this.setCustomValidity('Please select an item from list')" @else
                            oninvalid="this.setCustomValidity('من فضلك اختر عنصر من القائمة ')" @endif
                            oninput="setCustomValidity('')">
                            <option value="">{{ __('links.select') }}</option>
                        </select>
                    </div>
                    <div class="col-md-6 col-xl-4 col-sm-12">
                        <label for="">{{ __('links.nationality') }} </label>
                        <select class="form-select nationality" required id="nationality"
                            aria-label="Default select example" name="{{ $isGuest ? 'nation' : 'nation[0]' }}"
                            @if (LaravelLocalization::getCurrentLocale() === 'en') oninvalid="this.setCustomValidity('Please select an item from list')" @else
                            oninvalid="this.setCustomValidity('من فضلك اختر عنصر من القائمة ')" @endif
                            oninput="setCustomValidity('')">
                            <option value="">{{ __('links.select') }}</option>

                        </select>
                    </div>

                    @if ($isGuest)
                        <div class="col-12" id="guestChoiceButtons">
                            <div class="visa-guest-choice my-4 p-3">
                                <p class="mb-3">{{ __('links.visa_guest_prompt') }}</p>
                                <div class="d-flex align-items-center gap-3 mt-3">
                                    <button type="button" id="continueAsGuestBtn" class="visa-btn visa-btn--primary"
                                        aria-pressed="true">
                                        {{ __('links.visa_guest_continue') }}
                                    </button>
                                    <a id="loginRegisterBtn" class="visa-btn visa-btn--outline"
                                        href="{{ LaravelLocalization::getLocalizedURL(LaravelLocalization::getCurrentLocale(), route('siteLogin')) }}">
                                        {{ __('links.visa_guest_login') }}
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endif

                    <div class="col-sm-12 col-md-6 col-xl-4 personal-field-group"
                        @if ($isGuest) style="display:none" @endif>
                        <label for="">
                            @if (LaravelLocalization::getCurrentLocale() === 'en')
                                Passenger Name
                            @else
                                اسم المسافر
                            @endif
                        </label>
                        <input type="text" required name="{{ $isGuest ? 'name' : 'name[0]' }}"
                            @if (LaravelLocalization::getCurrentLocale() === 'en') oninvalid="this.setCustomValidity('Please Enter valid name')" @else
                            oninvalid="this.setCustomValidity('يجب ادخال حقل الاسم')" @endif
                            oninput="setCustomValidity('')"
                            placeholder="@if (LaravelLocalization::getCurrentLocale() === 'en') Passenger Name
                                  @else اسم المسافر @endif" />

                    </div>
                    <div class="col-sm-12 col-md-6 col-xl-4 personal-field-group"
                        @if ($isGuest) style="display:none" @endif>
                        <label for="">
                            @if (LaravelLocalization::getCurrentLocale() === 'en')
                                Mobile Number
                            @else
                                رقم الجوال
                            @endif
                        </label>
                        <div class="phone_field">
                            <input type="tel" class="phone-input" required placeholder="{{ __('links.mobile') }}"
                                @if (LaravelLocalization::getCurrentLocale() === 'en') oninvalid="this.setCustomValidity('Please Enter valid mobile')" @else
                                oninvalid="this.setCustomValidity('يجب ادخال حقل الهاتف')" @endif
                                oninput="setCustomValidity('')" />
                            <input type="hidden" class="phone-hidden" name="{{ $isGuest ? 'phone' : 'phone[0]' }}" />
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-6 col-xl-4 personal-field-group"
                        @if ($isGuest) style="display:none" @endif>
                        <label for="">{{ __('links.email') }} </label>
                        <input type="email" required name="{{ $isGuest ? 'email' : 'email[0]' }}"
                            placeholder="{{ __('links.email') }}"
                            @if (LaravelLocalization::getCurrentLocale() === 'en') oninvalid="this.setCustomValidity('Please Enter valid Email')" @else
                            oninvalid="this.setCustomValidity('يجب ادخال حقل البريد الإلكتروني')" @endif
                            oninput="setCustomValidity('')" />
                    </div>

                    <div class="col-sm-12 col-md-6 col-xl-4 personal-field-group"
                        @if ($isGuest) style="display:none" @endif>
                        <label for="">{{ __('links.passImage') }} </label>
                        <input type="file" class="file" onchange="validateSize(this)" required
                            name="{{ $isGuest ? 'passport' : 'passport[0]' }}" placeholder="{{ __('links.passImage') }}"
                            @if (LaravelLocalization::getCurrentLocale() === 'en') oninvalid="this.setCustomValidity('Please Enter valid Image')" @else
                            oninvalid="this.setCustomValidity('يجب ادخال حقل الصورة')" @endif
                            oninput="setCustomValidity('')" />

                    </div>
                    <div class="col-sm-12 col-md-6 col-xl-4 personal-image-field" style="display:none">
                        <label for="">{{ __('links.persImage') }} </label>
                        <input type="file" class="file" onchange="validateSize(this)"
                            name="{{ $isGuest ? 'personal' : 'personal[0]' }}" placeholder="{{ __('links.persImage') }}"
                            @if (LaravelLocalization::getCurrentLocale() === 'en') oninvalid="this.setCustomValidity('Please Enter valid Image')" @else
                            oninvalid="this.setCustomValidity('يجب ادخال حقل الصورة')" @endif
                            oninput="setCustomValidity('')" />
                    </div>
                    <div id="costBerVisa" style="display: none" class="col-sm-12 col-md-12 col-xl-12 mt-3">

                        <h5><label for="">{{ __('links.costVis') }} </label><label class="visaCost"> 0 </label> $
                        </h5>
                        <input type="hidden" name="cost[0]" value="0" class="visaCostinp" />
                        <div class="visNotes"></div>
                    </div>
                </div>
                {{--
            </form> --}}

            </div>
        </section>


        <section class="totals_section container">
            @if (!$isGuest)
                <div class="total">
                    <p id="numform"></p>
                    <button id="visaaa">
                        <i class="fa-solid fa-plus"></i>
                        @if (LaravelLocalization::getCurrentLocale() === 'en')
                            Add 1 more passanger
                        @else
                            اضافة مسافر اخر
                        @endif
                        <!-- <a href="#" id="visaaa">Add</a> -->
                    </button>
                    <!-- <span>
                                    Total price:  <span> 2400 LE</span>
                                  </span> -->
                </div>
            @endif
            <div class="total personal-field-group" @if ($isGuest) style="display:none" @endif>
                <div class="col-12 text-center my-4">
                    <button id="addToCart"
                        type="submit">{{ $isGuest ? __('links.visa_guest_submit') : __('links.add_cart') }}</button>
                </div>
            </div>
        </section>
    </form>

    <!-- booking section -->
    <section class="booking py-4">

        <img class="w-100" src="{{ asset('/website_assets/images/homePage/slider-mask.webp') }}" alt="slider mask">
        <div class="booking_details">
            <div class="row mx-0">
                <div class=" col-xl-6 col- md-6 col-sm-12 p-0">
                    {{-- <div class="images" style="background-image:url('@if ($Company->book_img) {{ asset("
                    uploads/company/$Company->book_img") }} @else {{
                    asset('/website_assets/images/homePage/slider-mask.webp') }} @endif') ">
                    <button type="button" class="btn js-modal-btn " data-video-url="{{ $Company->book_tour_vedio }}"
                        data-bs-toggle="modal" data-bs-target="#video">
                        <img src="{{ asset('/website_assets/images/homePage/play_button.webp') }}"
                            alt=" video play button">
                    </button>

                </div> --}}
                    <iframe width="100%" height="100%" src="{{ $Company->visa_vedio }}" title="YouTube video player"
                        frameborder="0"
                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                        allowfullscreen></iframe>
                </div>
                <div class=" col-xl-6 col- md-6 col-sm-12 p-0">
                    <div class="right_side">
                        <div class="heading">
                            <h2>
                                @if (LaravelLocalization::getCurrentLocale() === 'en')
                                    {{ $Company->visa_en_title }}
                                @else
                                    {{ $Company->visa_ar_title }}
                                @endif

                            </h2>
                            <p>
                                @if (LaravelLocalization::getCurrentLocale() === 'en')
                                    {{ $Company->visa_en_text }}
                                @else
                                    {{ $Company->visa_ar_text }}
                                @endif

                            </p>
                            {{-- <a href="{{ LaravelLocalization::localizeUrl('/tours') }}">{{ __('links.readMore') }}
                            <i class="fa-solid fa-angle-right"></i>
                            <i class="fa-solid fa-angle-right"></i>
                        </a> --}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
@section('adds_js')
    {{-- <script src="{{ asset('/website_assets/js/hotel_filters.js') }}"></script> --}}

    {{-- <script src="  https://code.jquery.com/jquery-2.2.4.min.js"></script>
<script src="{{ asset('/website_assets/js/typeahead.js') }}"></script> --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
    {{-- <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script> --}}
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

    <!-- country code + mobile number field -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.19/js/intlTelInput.min.js"></script>

    <!-- add adults  -->
    <script src="{{ asset('/website_assets/js/add-adults.js') }}"></script>




    <script>
        let localization = "{{ LaravelLocalization::getCurrentLocale() }}"
        var uaeCountryId = "{{ $uaeCountryId }}";
        var isGuestPage = {{ $isGuest ? 'true' : 'false' }};
        // Only relevant when isGuestPage is true: flips once "Continue as Guest"
        // is clicked, since guests never see any personal fields before that.
        var guestContinued = false;

        // The visa notes come back as one long blob of pasted-from-Google-Docs
        // <p> tags with no semantic structure, separated only by empty
        // "&nbsp;" paragraphs wherever the original doc had a blank line.
        // That blank-paragraph pattern is the only reliable signal for where
        // one topic ends and the next begins, so it's used here to split the
        // blob into separate visually-boxed sections instead of one wall of
        // text.
        function renderVisaNotes(container, rawHtml) {
            var $container = $(container);

            if (!rawHtml || !$.trim(rawHtml)) {
                $container.empty();
                return;
            }

            var $parsed = $('<div>').html(rawHtml);
            var sections = [];
            var current = $();

            $parsed.children().each(function() {
                var $el = $(this);
                var isBlank = $el.is('p') && $.trim($el.text()).length === 0;

                if (isBlank) {
                    if (current.length) {
                        sections.push(current);
                        current = $();
                    }
                    return;
                }

                current = current.add($el);
            });
            if (current.length) {
                sections.push(current);
            }

            $container.empty();

            if (!sections.length) {
                // No blank-paragraph separators found (unusual content) —
                // still show it, just as one card instead of failing silently.
                $('<div class="visa-notes-card"></div>').html(rawHtml).appendTo($container);
                return;
            }

            sections.forEach(function($section, index) {
                var $card = $('<div class="visa-notes-card"></div>');
                // a one-line first section is the intro heading of the whole
                // list, so it gets a full-width row above the card grid
                if (index === 0 && $section.length === 1 && sections.length > 1) {
                    $card.addClass('visa-notes-card--title');
                }
                $section.each(function() {
                    $card.append($(this).clone());
                });
                $container.append($card);
            });
        }

        // Personal Image is only required (and only shown) for the UAE, and for
        // guests it must additionally stay hidden until they've chosen to
        // continue as a guest. Both conditions are re-evaluated together here so
        // neither toggle silently overwrites the other's inline display style.
        function refreshPersonalImageVisibility(row) {
            var group = row.find('.personal-image-field');
            var input = group.find('input[type=file]');
            var isUAE = row.find('.dynamic').val() === uaeCountryId;
            var personalFieldsVisible = !isGuestPage || guestContinued;

            if (isUAE && personalFieldsVisible) {
                group.show();
                input.prop('required', true);
            } else {
                group.hide();
                input.prop('required', false);
                input.val('');
            }
        }

        // Initialize the country-code + mobile-number field (intl-tel-input) on every
        // ".phone-input" that hasn't been initialized yet (initial + dynamically added rows).
        function initPhoneInputs() {
            $('.phone-input').each(function() {
                if ($(this).data('iti')) {
                    return;
                }
                var iti = window.intlTelInput(this, {
                    initialCountry: "sa",
                    preferredCountries: ["sa", "ae", "eg", "kw", "qa", "bh", "om"],
                    separateDialCode: true,
                    autoPlaceholder: "off",
                    utilsScript: "https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.19/js/utils.js"
                });
                $(this).data('iti', iti);
                syncPhoneHidden(this);
            });
        }

        // Keep the hidden "phone[i]" input (the one actually submitted to the backend)
        // in sync with the full international number selected in the widget.
        function syncPhoneHidden(input) {
            var iti = $(input).data('iti');
            if (!iti) {
                return;
            }
            var $hidden = $(input).closest('.phone_field').find('.phone-hidden');
            var full = iti.getNumber();
            if (!full && $(input).val()) {
                full = '+' + iti.getSelectedCountryData().dialCode + $(input).val();
            }
            $hidden.val(full);
        }

        $(document).on('input change countrychange', '.phone-input', function() {
            syncPhoneHidden(this);
        });

        $(document).on('submit', 'form', function(e) {
            var valid = true;
            $('.phone-input').each(function() {
                var iti = $(this).data('iti');
                if (!iti) {
                    return;
                }
                syncPhoneHidden(this);
                if ($.trim(this.value) !== '' && typeof iti.isValidNumber === 'function' && !iti
                    .isValidNumber()) {
                    valid = false;
                    this.setCustomValidity(localization === 'en' ?
                        'Please enter a valid mobile number' :
                        'يجب إدخال رقم هاتف صحيح');
                    this.reportValidity();
                } else {
                    this.setCustomValidity('');
                }
            });
            if (!valid) {
                e.preventDefault();
            }
        });

        $(document).ready(function() {

            initPhoneInputs();

            $("#continueAsGuestBtn").click(function() {
                $(".personal-field-group").show();
                $("#guestChoiceButtons").hide();
                guestContinued = true;
                refreshPersonalImageVisibility($(this).closest('.row.mx-0'));
            });

            var counter = 0;

            $("#visaaa").click(function() {
                counter++;
                var x = `
                        <div class=" search_details_info passenger_info_details hotel_details my-3">

                <button  onclick="removePassenger(this)">
                <i class="fa-solid fa-xmark"></i>
                </button>


                <div class="passenger_info_title">
                    <h5> {{ __('links.passenger') }} </h5>
                    <!-- <span>1200 LE</span> -->
                </div>
                <div class="row mx-0">
                <div class="col-md-6 col-xl-4 col-sm-12 ">
                    <label for="">  @if (LaravelLocalization::getCurrentLocale() === 'en')
                        visa request country

                                      @else
                                      الدولة المسافر إليها                                      @endif </label>
                    <select  class="form-select form-select-solid dynamic"
                                                                    data-control="select2" data-placeholder="Select an option" required
                                                                    data-show-subtext="true" data-live-search="true" id="country"
                                                                    data-dependent="sub" name="country[` + counter + `]" onchange="fetchVisaCountryType(this)"
                                                                    @if (LaravelLocalization::getCurrentLocale() === 'en') oninvalid="this.setCustomValidity('Please select an item from list')"
                            @else
                            oninvalid="this.setCustomValidity('من فضلك اختر عنصر من القائمة ')" @endif oninput="setCustomValidity('')" >
                                                                    <option value=""></option>
                                                                    @foreach ($countries as $country)
                                                                        <option value="{{ $country->id }}">            @if (LaravelLocalization::getCurrentLocale() === 'en')

{{ $country->en_country }}
@else
{{ $country->ar_country }}
@endif
                                                                        </option>
                                                                    @endforeach
                                                                </select>
                </div>
                <div class="col-md-6 col-xl-4 col-sm-12">
                    <label for="">  @if (LaravelLocalization::getCurrentLocale() === 'en')

Visa type
@else
نوع الفيزا
@endif  </label>
                    <select required class="form-select form-select-solid visa_type"
                                                                    data-control="select2 sub2" data-placeholder="Select an option"
                                                                    data-show-subtext="true" data-live-search="true" id="sub"
                                                                    name="visa_type_id[` + counter + `]" onchange="fetchNationality(this)"
                                                                    @if (LaravelLocalization::getCurrentLocale() === 'en') oninvalid="this.setCustomValidity('Please select an item from list')"
                            @else
                            oninvalid="this.setCustomValidity('من فضلك اختر عنصر من القائمة ')" @endif  oninput="setCustomValidity('')" >
                                                                    <option value="">{{ __('links.select') }}</option>
                                                                </select>
                    </div>
                <div class="col-md-6 col-xl-4 col-sm-12">
                    <label for="">{{ __('links.nationality') }} </label>
                    <select class="form-select nationality" required  id="nationality" aria-label="Default select example"
                    name="nation[` + counter + `]" onchange="fetchCost(this)"  @if (LaravelLocalization::getCurrentLocale() === 'en') oninvalid="this.setCustomValidity('Please select an item from list')"
                            @else
                            oninvalid="this.setCustomValidity('من فضلك اختر عنصر من القائمة ')" @endif  oninput="setCustomValidity('')" >
                    <option value="">{{ __('links.select') }}</option>

                        </select>
                </div>

                <div class="col-sm-12 col-md-6 col-xl-4">
                    <label for="">@if (LaravelLocalization::getCurrentLocale() === 'en')
                    Passenger Name
                                  @else اسم المسافر
                                  @endif  </label>
                    <input type="text" name="name[` + counter + `]" required placeholder="@if (LaravelLocalization::getCurrentLocale() === 'en') Passenger Name
              @else
             اسم المسافر @endif "  @if (LaravelLocalization::getCurrentLocale() === 'en') oninvalid="this.setCustomValidity('Please Enter valid Name')"
                        @else
                        oninvalid="this.setCustomValidity('يجب ادخال حقل الاسم')" @endif oninput="setCustomValidity('')" />

                </div>
                <div class="col-sm-12 col-md-6 col-xl-4">
                    <label for="">@if (LaravelLocalization::getCurrentLocale() === 'en')
                            Mobile Number
                        @else
                            رقم الجوال
                        @endif  </label>
                    <div class="phone_field">
                        <input type="tel" class="phone-input" required placeholder="{{ __('links.mobile') }}"
                        @if (LaravelLocalization::getCurrentLocale() === 'en') oninvalid="this.setCustomValidity('Please Enter valid mobile')"
                            @else
                            oninvalid="this.setCustomValidity('يجب ادخال حقل الهاتف')" @endif oninput="setCustomValidity('')" />
                        <input type="hidden" class="phone-hidden" name="phone[` + counter + `]" />
                    </div>
                </div>
                <div class="col-sm-12 col-md-6 col-xl-4">
                    <label for="">{{ __('links.email') }}  </label>
                    <input type="email" name="email[` + counter + `]" required placeholder="{{ __('links.email') }}"
                    @if (LaravelLocalization::getCurrentLocale() === 'en') oninvalid="this.setCustomValidity('Please Enter valid Email')"
                        @else
                        oninvalid="this.setCustomValidity('يجب ادخال حقل البريد الإلكتروني')" @endif oninput="setCustomValidity('')" />
                </div>
                <div class="col-sm-12 col-md-6 col-xl-4">
                    <label for="">{{ __('links.passImage') }} </label>
                    <input type="file" class="file" onchange="validateSize(this)" name="passport[` + counter + `]" required placeholder="{{ __('links.passImage') }}"
                    @if (LaravelLocalization::getCurrentLocale() === 'en') oninvalid="this.setCustomValidity('Please Enter valid Image')"
                        @else
                        oninvalid="this.setCustomValidity('يجب ادخال حقل الصورة')" @endif oninput="setCustomValidity('')" />

                </div>
                <div class="col-sm-12 col-md-6 col-xl-4 personal-image-field" style="display:none">
                    <label for="">{{ __('links.persImage') }} </label>
                    <input type="file" class="file" onchange="validateSize(this)" name="personal[` + counter + `]" placeholder="{{ __('links.persImage') }}"  @if (LaravelLocalization::getCurrentLocale() === 'en') oninvalid="this.setCustomValidity('Please Enter valid Image')"
                        @else
                        oninvalid="this.setCustomValidity('يجب ادخال حقل الصورة')" @endif oninput="setCustomValidity('')" />
                </div>
                <div  style="display: none"  class="col-sm-12 col-md-12 col-xl-12 mt-3 costBerVisa">

<h5><label for="">{{ __('links.costVis') }} </label><label class="visaCost"> 0 </label> $</h5>
<div class="visNotes"></div>
</div>
                <!-- <div class="col-sm-12 col-md-6 col-xl-4">
                    <a class="btn btn-primary" id="visaaa" > @if (LaravelLocalization::getCurrentLocale() === 'en')

                        Add 1 more passanger
@else
اضافة مسافر اخر
@endif  </a>
                </div>
                -->

                </div>
                </div>

                `;
                $('#passenger_section').append(x);
                initPhoneInputs();
            });
            // $('.dynamic').change(function() {
            //     if ($(this).val() != '') {
            //         var select = $(this).attr("id");
            //         var value = $(this).val();

            //         var _token = $('input[name="_token"]').val();
            //         alert("First");
            //         $.ajax({
            //             url: "{{ route('dynamicvisatype.fetch') }}",
            //             method: "POST",
            //             data: {
            //                 select: select,
            //                 value: value,
            //                 _token: _token
            //             },
            //             success: function(result) {

            //                 $(this).parent().parent().find(".visa_type").html(result);
            //             },
            //             error: function(xhr, status, error) {
            //                 var err = eval("(" + xhr.responseText + ")");
            //                 alert(err.Message);
            //             }

            //         })
            //     }
            // });




            $('.dynamic').change(function() {
                refreshPersonalImageVisibility($(this).closest('.row.mx-0'));
                if ($(this).val() != '') {
                    var select = $(this).attr("id");
                    var value = $(this).val();

                    var trigger = $(this);
                    var _token = $('input[name="_token"]').val();
                    // alert("Second");

                    $.ajax({
                        url: "{{ route('dynamicvisatype.fetch') }}",
                        method: "get",
                        data: {
                            select: select,
                            value: value,
                            _token: _token
                        },
                        success: function(result) {

                            trigger.parent().parent().find(".visa_type").html(result);
                            $("#costBerVisa").css("display", "none");
                            $('.visaCost').html('');
                            $('.visNotes').html('');
                        },
                        error: function(xhr, status, error) {
                            alert("xhr.responseText");
                            var err = eval("(" + xhr.responseText + ")");

                        }

                    })
                }
            });

            $('.visa_type').change(function() {
                if ($(this).val() != '') {
                    var select = $(this).attr("id");
                    var value = $(this).val();

                    var trigger = $(this);
                    var _token = $('input[name="_token"]').val();
                    // alert("Second");

                    $.ajax({
                        url: "{{ route('dynamicnationality.fetch') }}",
                        method: "get",
                        data: {
                            select: select,
                            value: value,
                            _token: _token
                        },
                        success: function(result) {
                            trigger.parent().parent().find(".nationality").html(result);
                            $("#costBerVisa").css("display", "none");
                            $('.visaCost').html('');
                            $('.visNotes').html('');
                        },
                        error: function(xhr, status, error) {
                            var err = eval("(" + xhr.responseText + ")");
                            alert("err.Message");
                        }

                    })
                }
            });

            $('.nationality').change(function() {
                if ($(this).val() != '') {
                    var select = $(this).attr("id");
                    var value = $(this).val();

                    var trigger = $(this);
                    var _token = $('input[name="_token"]').val();
                    // alert("Second");

                    $.ajax({
                        url: "{{ route('dynamicCost.fetch') }}",
                        method: "get",
                        data: {
                            select: select,
                            nationality: value,

                            // Scoped to this row instead of a hardcoded
                            // name="visa_type_id[0]" selector: that name only
                            // exists for logged-in users (multi-passenger
                            // rows) — guests' visa type select is named
                            // plain "visa_type_id", so the hardcoded lookup
                            // silently matched nothing and sent no visa_type
                            // at all, making the cost/notes lookup always
                            // fail for guests.
                            visa_type: trigger.closest('.row.mx-0').find('.visa_type option:selected').val(),
                            _token: _token
                        },
                        success: function(data) {
                            var result = $.parseJSON(data);

                            // alert(result)
                            $("#costBerVisa").css("display", "block");

                            $('.visaCost').text(result[0]);
                            $('.visaCostinp').val(result[0]);
                            renderVisaNotes('.visNotes', result[1]);
                        },
                        error: function(xhr, status, error) {
                            var err = eval("(" + xhr.responseText + ")");
                            alert(" 222");
                        }

                    })
                }
            });

        });

        function fetchCost(elem) {

            if ($(elem).val() != '') {
                var select = $(elem).attr("id");
                var selectName = $(elem).attr("name");
                var value = $(elem).val();
                let numbers = selectName.match(/\d/g);
                var trigger = $(elem);

                var _token = $('input[name="_token"]').val();
                $.ajax({
                    url: "{{ route('dynamicCost.fetch') }}",
                    method: "GET",
                    data: {
                        select: select,
                        nationality: value,
                        visa_type: $('select[name="visa_type_id[' + numbers + ']"] option:selected').val(),
                        _token: _token
                    },
                    success: function(data) {
                        var result = $.parseJSON(data);
                        // alert(result)
                        trigger.parent().parent().find(".costBerVisa").css("display", "block");
                        trigger.parent().parent().find(".visaCost").text(result[0]);
                        // .html()/renderVisaNotes, not .text() — the response
                        // is rich HTML (see the single-passenger handler
                        // above); .text() was rendering the raw <p>/<span>
                        // tags as literal visible text for added passenger rows.
                        renderVisaNotes(trigger.parent().parent().find(".visNotes"), result[1]);


                    },
                    error: function(xhr, status, error) {
                        var err = eval("(" + xhr.responseText + ")");
                        alert("333");
                    }


                })
            }
        }

        function fetchNationality(elem) {
            if ($(elem).val() != '') {
                var select = $(elem).attr("id");
                var value = $(elem).val();

                var trigger = $(elem);
                var _token = $('input[name="_token"]').val();
                // alert("Second");

                $.ajax({
                    url: "{{ route('dynamicnationality.fetch') }}",
                    method: "Get",
                    data: {
                        select: select,
                        value: value,
                        _token: _token
                    },
                    success: function(result) {
                        trigger.parent().parent().find(".nationality").html(result);
                        trigger.parent().parent().find(".costBerVisa").css("display", "none");

                    },
                    error: function(xhr, status, error) {
                        var err = eval("(" + xhr.responseText + ")");
                        alert("444");
                    }

                })
            }
        }

        function fetchVisaCountryType(elem) {
            refreshPersonalImageVisibility($(elem).closest('.row.mx-0'));
            if ($(elem).val() != '') {
                var select = $(elem).attr("id");
                var value = $(elem).val();

                var trigger = $(elem);
                var _token = $('input[name="_token"]').val();
                // alert("Second");

                $.ajax({
                    url: "{{ route('dynamicvisatype.fetch') }}",
                    method: "Get",
                    data: {
                        select: select,
                        value: value,
                        _token: _token
                    },
                    success: function(result) {
                        trigger.parent().parent().find(".visa_type").html(result);
                        trigger.parent().parent().find(".costBerVisa").css("display", "none");

                    },
                    error: function(xhr, status, error) {
                        var err = eval("(" + xhr.responseText + ")");
                        alert("555");
                    }

                })
            }
        }
        // $("#addToCart").click(function() {
        // //                 let forms = document.forms.length-1;
        // //                 var index=forms;
        // //       document.getElementById('numform').innerHTML = "Number of forms: " + forms;
        // //       var passengers = [];
        // //       var i;
        // //       for (i = 0; i < index; i++) {
        // //         var detail = {
        // //                         total_item_price : parseFloat($(this).children('.total_item_price').text()),
        // //                         total_after_discounts : parseFloat($(this).children('.total_after_discounts').text()),
        // //                         vat_tax_value : parseFloat($(this).children('.vat_tax_value').text()),
        // //                         comm_industr_tax : parseFloat($(this).children('.comm_industr_tax').text()),
        // //                         net_value : parseFloat($(this).find('.net_value').text()),
        // //                         item_discount : parseFloat($(this).find('.item_discount').val()),
        // //                         is_stored : $('input[type=radio][name=optionsRadios'+row_num+']:checked').val(),
        // //                         item_text : item_arabic_name,
        // //                         item_id : item_id,
        // //                         item_price : $(this).find('.item_price').val(),
        // //                         item_quantity : $(this).find('.item_quantity').val(),
        // //                         tax_exemption : tax_exemption,
        // //                     }
        // //                     passengers.push(passenger);
        // // }
        // // const data = [];
        // //   for(let i=0; i<form.length; i++) {
        // //     const elements = form[i].elements;
        // //     data.push({form: form[i].getAttribute('data-category'), inputData: {}});

        // //   };

        //         });
        //     });

        function validateSize(input) {

            const fileSize = input.files[0].size / 1024 / 1024; // in MiB
            if (fileSize > 2) {
                //   alert('File size exceeds 2 MiB');
                swal({
                    title: localization === "en" ? "warning" : "تحذير",
                    text: localization === "en" ? "File size exceeds 2 MiB" : "حجم الملف يتجاوز 2 ميغا بايت",
                    icon: "warning",
                    button: localization === "en" ? "Confirm" : "تأكيد",
                });
                // const file =
                //     document.querySelector('.file');
                input.value = '';
                // return false;
            } else {
                // Proceed further
                return true;
            }
        }
    </script>
