@extends('layout.website.layout', ['Company' => $Company, 'title' => 'Safer | Visa'])

@section('adds_css')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css">

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
    </style>


@endsection

@section('bottom-header')
    <x-website.header.general title="{{ __('links.visa') }}" :breadcrumb="$BreadCrumb" current="{{ __('links.visa') }}" />
@endsection
@section('content')

    <form action="{{ LaravelLocalization::localizeUrl('/Safer/BookVisa') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <section class="passenger_section container pt-5" id="passenger_section">
            <p class="receipt-title">
                @if (LaravelLocalization::getCurrentLocale() === 'en')
                    Pickup Your Visa
                @else
                    احصل على التأشيرة الخاصة بك
                @endif
            </p>
            <div class=" search_details_info passenger_info_details hotel_details mt-3 ">

                <!-- <button  onclick="removePassenger(this)">
                                  <i class="fa-solid fa-xmark"></i>
                                </button> -->
                {{-- <form data-category="1" > --}}
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
                            id="country" data-dependent="sub" name="country[0]" @if (LaravelLocalization::getCurrentLocale() === 'en')
                            oninvalid="this.setCustomValidity('Please select an item from list')"
                            @else
                            oninvalid="this.setCustomValidity('من فضلك اختر عنصر من القائمة ')"
                            @endif  oninput="setCustomValidity('')" >
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
                            id="sub" name="visa_type_id[0]"
                            @if (LaravelLocalization::getCurrentLocale() === 'en')
                            oninvalid="this.setCustomValidity('Please select an item from list')"
                            @else
                            oninvalid="this.setCustomValidity('من فضلك اختر عنصر من القائمة ')"
                            @endif  oninput="setCustomValidity('')" >
                            <option value="">{{ __('links.select') }}</option>
                        </select>
                    </div>
                    <div class="col-md-6 col-xl-4 col-sm-12">
                        <label for="">{{ __('links.nationality') }} </label>
                        <select class="form-select nationality" required id="nationality"
                            aria-label="Default select example" name="nation[0]"
                            @if (LaravelLocalization::getCurrentLocale() === 'en')
                            oninvalid="this.setCustomValidity('Please select an item from list')"
                            @else
                            oninvalid="this.setCustomValidity('من فضلك اختر عنصر من القائمة ')"
                            @endif  oninput="setCustomValidity('')" >
                            <option value="">{{ __('links.select') }}</option>

                        </select>
                    </div>

                    <div class="col-sm-12 col-md-6 col-xl-4">
                        <label for="">
                            @if (LaravelLocalization::getCurrentLocale() === 'en')
                                Passenger Name
                            @else
                                اسم المسافر
                            @endif
                        </label>
                        <input type="text" required name="name[0]"
                        @if (LaravelLocalization::getCurrentLocale() === 'en')
                        oninvalid="this.setCustomValidity('Please Enter valid name')"
                        @else
                        oninvalid="this.setCustomValidity('يجب ادخال حقل الاسم')"
                        @endif oninput="setCustomValidity('')"
                            placeholder="@if (LaravelLocalization::getCurrentLocale() === 'en') Passenger Name
                                  @else اسم المسافر @endif" />

                    </div>
                    <div class="col-sm-12 col-md-6 col-xl-4">
                        <label for="">@if (LaravelLocalization::getCurrentLocale() === 'en')
                            Country Code
                        @else
                            كود الدولة
                        @endif + {{ __('links.mobile') }}
                        </label>
                        <input type="tel" required name="phone[0]" placeholder="{{ __('links.mobile') }}" @if (LaravelLocalization::getCurrentLocale() === 'en')
                        oninvalid="this.setCustomValidity('Please Enter valid mobile')"
                        @else
                        oninvalid="this.setCustomValidity('يجب ادخال حقل الهاتف')"
                        @endif oninput="setCustomValidity('')" />

                    </div>
                    <div class="col-sm-12 col-md-6 col-xl-4">
                        <label for="">{{ __('links.email') }} </label>
                        <input type="email" required name="email[0]" placeholder="{{ __('links.email') }}"
                        @if (LaravelLocalization::getCurrentLocale() === 'en')
                        oninvalid="this.setCustomValidity('Please Enter valid Email')"
                        @else
                        oninvalid="this.setCustomValidity('يجب ادخال حقل البريد الإلكتروني')"
                        @endif oninput="setCustomValidity('')"/>
                    </div>

                    <div class="col-sm-12 col-md-6 col-xl-4">
                        <label for="">{{ __('links.passImage') }} </label>
                        <input type="file" class="file" onchange="validateSize(this)" required name="passport[0]"
                            placeholder="{{ __('links.passImage') }}"
                            @if (LaravelLocalization::getCurrentLocale() === 'en')
                        oninvalid="this.setCustomValidity('Please Enter valid Image')"
                        @else
                        oninvalid="this.setCustomValidity('يجب ادخال حقل الصورة')"
                        @endif oninput="setCustomValidity('')" />

                    </div>
                    <div class="col-sm-12 col-md-6 col-xl-4">
                        <label for="">{{ __('links.persImage') }} </label>
                        <input type="file" class="file" onchange="validateSize(this)" required name="personal[0]"
                            placeholder="{{ __('links.persImage') }}"  @if (LaravelLocalization::getCurrentLocale() === 'en')
                            oninvalid="this.setCustomValidity('Please Enter valid Image')"
                            @else
                            oninvalid="this.setCustomValidity('يجب ادخال حقل الصورة')"
                            @endif oninput="setCustomValidity('')"/>
                    </div>
                    <div id="costBerVisa" style="display: none" class="col-sm-12 col-md-12 col-xl-12 mt-3">

                        <h5><label for="">{{ __('links.costVis') }} </label><label class="visaCost"> 0 </label> $
                        </h5>
                        <input type="hidden" name="cost[0]" value="0" class="visaCostinp" />
                        <p class="visNotes">

                        </p>
                    </div>
                </div>
                {{-- </form> --}}

            </div>
        </section>


        <section class="totals_section container">
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
            <div class="total">
                <div class="col-12 text-center my-4">
                    <button id="addToCart" type="submit">{{ __('links.add_cart') }}</button>
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
                    {{-- <div class="images"
                        style="background-image:url('@if ($Company->book_img) {{ asset("uploads/company/$Company->book_img") }} @else {{ asset('/website_assets/images/homePage/slider-mask.webp') }} @endif') ">
                        <button type="button" class="btn js-modal-btn "
                            data-video-url="{{ $Company->book_tour_vedio }}" data-bs-toggle="modal"
                            data-bs-target="#video">
                            <img src="{{ asset('/website_assets/images/homePage/play_button.webp') }}"
                                alt=" video play button">
                        </button>

                    </div> --}}
                    <iframe width="100%" height="100%" <iframe width="560" height="315"
                        src=" {{ $Company->visa_vedio }}" title="YouTube video player" frameborder="0"
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
<script src="{{ asset('/website_assets/js/typeahead.js') }}"></script>   --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
    {{-- <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script> --}}
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

    <!-- add adults  -->
    <script src="{{ asset('/website_assets/js/add-adults.js') }}"></script>




    <script>
        let localization = "{{ LaravelLocalization::getCurrentLocale() }}"

        $(document).ready(function() {


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
                                                                    data-dependent="sub" name="country[` + counter + `]" onchange="fetch(this)"
                                                                    @if (LaravelLocalization::getCurrentLocale() === 'en')
                            oninvalid="this.setCustomValidity('Please select an item from list')"
                            @else
                            oninvalid="this.setCustomValidity('من فضلك اختر عنصر من القائمة ')"
                            @endif oninput="setCustomValidity('')" >
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
                                                                    @if (LaravelLocalization::getCurrentLocale() === 'en')
                            oninvalid="this.setCustomValidity('Please select an item from list')"
                            @else
                            oninvalid="this.setCustomValidity('من فضلك اختر عنصر من القائمة ')"
                            @endif  oninput="setCustomValidity('')" >
                                                                    <option value="">{{ __('links.select') }}</option>
                                                                </select>
                    </div>
                <div class="col-md-6 col-xl-4 col-sm-12">
                    <label for="">{{ __('links.nationality') }} </label>
                    <select class="form-select nationality" required  id="nationality" aria-label="Default select example"
                    name="nation[` + counter + `]" onchange="fetchCost(this)"  @if (LaravelLocalization::getCurrentLocale() === 'en')
                            oninvalid="this.setCustomValidity('Please select an item from list')"
                            @else
                            oninvalid="this.setCustomValidity('من فضلك اختر عنصر من القائمة ')"
                            @endif  oninput="setCustomValidity('')" >
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
             اسم المسافر @endif "  @if (LaravelLocalization::getCurrentLocale() === 'en')
                        oninvalid="this.setCustomValidity('Please Enter valid Name')"
                        @else
                        oninvalid="this.setCustomValidity('يجب ادخال حقل الاسم')"
                        @endif oninput="setCustomValidity('')" />

                </div>
                <div class="col-sm-12 col-md-6 col-xl-4">
                    <label for="">@if (LaravelLocalization::getCurrentLocale() === 'en')
                            Country Code
                        @else
                            كود الدولة
                        @endif + {{ __('links.mobile') }}  </label>
                    <input type="tel" name="phone[` + counter + `]" required placeholder="{{ __('links.mobile') }}"
                    @if (LaravelLocalization::getCurrentLocale() === 'en')
                        oninvalid="this.setCustomValidity('Please Enter valid mobile')"
                        @else
                        oninvalid="this.setCustomValidity('يجب ادخال حقل الهاتف')"
                        @endif oninput="setCustomValidity('')" />

                </div>
                <div class="col-sm-12 col-md-6 col-xl-4">
                    <label for="">{{ __('links.email') }}  </label>
                    <input type="email" name="email[` + counter + `]" required placeholder="{{ __('links.email') }}"
                    @if (LaravelLocalization::getCurrentLocale() === 'en')
                        oninvalid="this.setCustomValidity('Please Enter valid Email')"
                        @else
                        oninvalid="this.setCustomValidity('يجب ادخال حقل البريد الإلكتروني')"
                        @endif oninput="setCustomValidity('')" />
                </div>
                <div class="col-sm-12 col-md-6 col-xl-4">
                    <label for="">{{ __('links.passImage') }} </label>
                    <input type="file" class="file" onchange="validateSize(this)" name="passport[` + counter + `]" required placeholder="{{ __('links.passImage') }}"
                    @if (LaravelLocalization::getCurrentLocale() === 'en')
                        oninvalid="this.setCustomValidity('Please Enter valid Image')"
                        @else
                        oninvalid="this.setCustomValidity('يجب ادخال حقل الصورة')"
                        @endif oninput="setCustomValidity('')" />

                </div>
                <div class="col-sm-12 col-md-6 col-xl-4">
                    <label for="">{{ __('links.persImage') }} </label>
                    <input type="file" class="file" onchange="validateSize(this)" name="personal[` + counter + `]" required placeholder="{{ __('links.persImage') }}"  @if (LaravelLocalization::getCurrentLocale() === 'en')
                        oninvalid="this.setCustomValidity('Please Enter valid Image')"
                        @else
                        oninvalid="this.setCustomValidity('يجب ادخال حقل الصورة')"
                        @endif oninput="setCustomValidity('')" />
                </div>
                <div  style="display: none"  class="col-sm-12 col-md-12 col-xl-12 mt-3 costBerVisa">

<h5><label for="">{{ __('links.costVis') }} </label><label class="visaCost">  50 </label> $</h5>
<p class="visNotes">

</p>
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

                            visa_type: $('select[name="visa_type_id[0]"] option:selected').val(),
                            _token: _token
                        },
                        success: function(data) {
                            var result = $.parseJSON(data);

                            // alert(result)
                            $("#costBerVisa").css("display", "block");

                            $('.visaCost').text(result[0]);
                            $('.visaCostinp').val(result[0]);
                            $('.visNotes').text(result[1]);
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
                        trigger.parent().parent().find(".visNotes").text(result[1]);


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

        function fetch(elem) {
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
