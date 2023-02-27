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
    </style>


@endsection

@section('bottom-header')
    <x-website.header.general title="All Visa" :breadcrumb="$BreadCrumb" current="All Visa" />
@endsection
@section('content')


    <section class="passenger_section container pt-5" id="passenger_section">
        <p class="receipt-title">Pickup Your Visa </p>
        <div class=" search_details_info passenger_info_details hotel_details mt-3 ">

            <!-- <button  onclick="removePassenger(this)">
              <i class="fa-solid fa-xmark"></i>
            </button> -->
            <form data-category="1" >
            <div class="passenger_info_title">
                <h5> passenger </h5>
                <!-- <span>1200 LE</span> -->
            </div>
            <div class="row mx-0">
                <div class="col-md-6 col-xl-4 col-sm-12 ">
                    <label for=""> visa request country </label>
                    <select required class="form-select form-select-solid dynamic"
                                                    data-control="select2" data-placeholder="Select an option" required
                                                    data-show-subtext="true" data-live-search="true" id="country"
                                                    data-dependent="sub">
                                                    <option value=""></option>
                                                    @foreach ($countries as $country)
                                                        <option value="{{ $country->id }}">{{ $country->en_country }}
                                                        </option>
                                                    @endforeach
                                                </select>
                </div>
                <div class="col-md-6 col-xl-4 col-sm-12">
                    <label for=""> Visa type </label>
                    <select required class="form-select form-select-solid" name="visa_type_id"
                    data-control="select2 sub2" data-placeholder="Select an option"
                    data-show-subtext="true" data-live-search="true" id="sub">
                    <option value="">select....</option>
                </select>
                </div>
                <div class="col-md-6 col-xl-4 col-sm-12">
                    <label for="">Nationality </label>
                    <select class="form-select nationality" id="nationality" aria-label="Default select example">
                        <option value="" disabled selected hidden>Choose...</option>
                        @foreach ($nationalities as $nationality)
                            <option value="{{ $nationality->id }}">{{ $nationality->en_nationality }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="col-sm-12 col-md-6 col-xl-4">
                    <label for="">Name </label>
                    <input type="text" name="name" placeholder="name" />

                </div>
                <div class="col-sm-12 col-md-6 col-xl-4">
                    <label for="">Mobile </label>
                    <input type="tel" name="phone" placeholder="Mobile" />

                </div>
                <div class="col-sm-12 col-md-6 col-xl-4">
                    <label for="">Email </label>
                    <input type="email" name="email" placeholder="Email" />
                </div>

                <!-- <div class="col-sm-12 col-md-6 col-xl-4">
                 <a class="btn btn-primary" id="visaaa" >Add </a>
               </div>
               -->

            </div>
            </form>

        </div>
    </section>


    <section class="totals_section container">
        <div class="total">
            <p id="numform"></p>
            <button id="visaaa">
                <i class="fa-solid fa-plus"></i>
                Add
                <!-- <a href="#" id="visaaa">Add</a> -->
            </button>
            <!-- <span>
            Total price:  <span> 2400 LE</span>
          </span> -->
        </div>
        <div class="total">
            <div class="col-12 text-center my-4">
                <button id="addToCart" type="submit">Add To Cart</button>
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

    <!-- add adults  -->
    <script src="{{ asset('/website_assets/js/add-adults.js') }}"></script>




    <script>

        $(document).ready(function() {

            var x = `
        <div class=" search_details_info passenger_info_details hotel_details my-3">

 <button  onclick="removePassenger(this)">
  <i class="fa-solid fa-xmark"></i>
</button>
<form data-category="">

   <div class="passenger_info_title">
      <h5> passenger </h5>
      <!-- <span>1200 LE</span> -->
  </div>
 <div class="row mx-0">
  <div class="col-md-6 col-xl-4 col-sm-12 ">
    <label for=""> visa request country </label>
    <select required class="form-select form-select-solid dynamic"
                                                    data-control="select2" data-placeholder="Select an option" required
                                                    data-show-subtext="true" data-live-search="true" id="country"
                                                    data-dependent="sub">
                                                    <option value=""></option>
                                                    @foreach ($countries as $country)
                                                        <option value="{{ $country->id }}">{{ $country->en_country }}
                                                        </option>
                                                    @endforeach
                                                </select>
  </div>
  <div class="col-md-6 col-xl-4 col-sm-12">
    <label for=""> Visa type  </label>
    <select required class="form-select form-select-solid" name="visa_type_id"
                                                    data-control="select2 sub2" data-placeholder="Select an option"
                                                    data-show-subtext="true" data-live-search="true" id="sub">
                                                    <option value="">select....</option>
                                                </select>
    </div>
  <div class="col-md-6 col-xl-4 col-sm-12">
    <label for="">Nationality </label>
      <select class="form-select nationality"  id="nationality" aria-label="Default select example" >
          <option value="" disabled selected hidden>Choose...</option>
          @foreach ($nationalities as $nationality)
                                                        <option value="{{ $nationality->id }}">{{ $nationality->en_nationality }}
                                                        </option>
                                                    @endforeach
        </select>
  </div>

  <div class="col-sm-12 col-md-6 col-xl-4">
     <label for="">Name  </label>
     <input type="text" name="name" placeholder="name" />

  </div>
  <div class="col-sm-12 col-md-6 col-xl-4">
      <label for="">Mobile  </label>
      <input type="tel" name="phone" placeholder="Mobile" />

   </div>
   <div class="col-sm-12 col-md-6 col-xl-4">
      <label for="">Email  </label>
      <input type="email" name="email" placeholder="Email" />
   </div>

   <!-- <div class="col-sm-12 col-md-6 col-xl-4">
     <a class="btn btn-primary" id="visaaa" >Add </a>
   </div>
   -->

 </div>
</form>
</div>

 `;
            $("#visaaa").click(function() {

                $('#passenger_section').append(x);

                $('.dynamic').change(function() {

if ($(this).val() != '') {
    var select = $(this).attr("id");
    var value = $(this).val();

    var _token = $('input[name="_token"]').val();

    $.ajax({
        url: "{{ route('dynamicvisatype.fetch') }}",
        method: "POST",
        data: {
            select: select,
            value: value,
            _token: _token
        },
        success: function(result) {

            $("[name='visa_type_id']").html(result);
        }

    })
}
});

            });


            $('.dynamic').change(function() {

if ($(this).val() != '') {
    var select = $(this).attr("id");
    var value = $(this).val();

    var _token = $('input[name="_token"]').val();

    $.ajax({
        url: "{{ route('dynamicvisatype.fetch') }}",
        method: "POST",
        data: {
            select: select,
            value: value,
            _token: _token
        },
        success: function(result) {

            $("[name='visa_type_id']").html(result);
        }

    })
}
});


$("#addToCart").click(function() {
//                 let forms = document.forms.length-1;
//                 var index=forms;
//       document.getElementById('numform').innerHTML = "Number of forms: " + forms;
//       var passengers = [];
//       var i;
//       for (i = 0; i < index; i++) {
//         var detail = {
//                         total_item_price : parseFloat($(this).children('.total_item_price').text()),
//                         total_after_discounts : parseFloat($(this).children('.total_after_discounts').text()),
//                         vat_tax_value : parseFloat($(this).children('.vat_tax_value').text()),
//                         comm_industr_tax : parseFloat($(this).children('.comm_industr_tax').text()),
//                         net_value : parseFloat($(this).find('.net_value').text()),
//                         item_discount : parseFloat($(this).find('.item_discount').val()),
//                         is_stored : $('input[type=radio][name=optionsRadios'+row_num+']:checked').val(),
//                         item_text : item_arabic_name,
//                         item_id : item_id,
//                         item_price : $(this).find('.item_price').val(),
//                         item_quantity : $(this).find('.item_quantity').val(),
//                         tax_exemption : tax_exemption,
//                     }
//                     passengers.push(passenger);
// }
// const data = [];
//   for(let i=0; i<form.length; i++) {
//     const elements = form[i].elements;
//     data.push({form: form[i].getAttribute('data-category'), inputData: {}});

//   };

        });
    });
    </script>