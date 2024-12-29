@extends('layout.website.layout', ['Company' => $Company, 'title' => 'Safer | About Us'])

@section('adds_css')
<meta name="csrf-token" content="{{ csrf_token() }}">
<link rel="stylesheet" href="{{ asset('/website_assets/css/about.css') }}">
<style>
    /* General Reset */
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    /* body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            background-color: #f8f9fa;
            color: #333;
            padding: 20px;
        } */

    .form-container {
        background-color: #fff;
        padding: 20px;
        border-radius: 10px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        max-width: 800px;
        margin: 0 auto;
    }

    .form-title {
        text-align: center;
        margin-bottom: 20px;
        font-size: 1.8rem;
        color: #333;
    }

    .form-group {
        margin-bottom: 15px;
    }

    label {
        display: block;
        margin-bottom: 5px;
        font-weight: bold;
        color: #555;
    }

    input,
    select,
    textarea {
        width: 100%;
        padding: 10px;
        border: 1px solid #ddd;
        border-radius: 5px;
        font-size: 16px;
    }

    input:focus,
    select:focus,
    textarea:focus {
        outline: none;
        border-color: #007bff;
    }

    textarea {
        resize: vertical;
        height: 100px;
    }

    .form-section {
        margin-top: 20px;
        margin-bottom: 10px;
        font-weight: bold;
        font-size: 1.2rem;
        color: #007bff;
    }

    .submit-btn {
        display: block;
        
        padding: 10px;
        background-color: #007bff;
        color: #fff;
        border: none;
        border-radius: 5px;
        font-size: 16px;
        font-weight: bold;
        cursor: pointer;
        transition: background-color 0.3s;
    }

    .submit-btn:hover {
        background-color: #0056b3;
    }

    .footer {
        text-align: center;
        margin-top: 20px;
        font-size: 0.9rem;
        color: #666;
    }

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

    .noview {
        display: none;
    }

    #mylayer {
        transition: all 0.3s ease;
    }

    .license-type {
        padding: 1rem;
        border: 1px solid #dee2e6;
        border-radius: 0.5rem;
        cursor: pointer;
        transition: all 0.3s ease;
    }

    .license-type:hover {
        background-color: #f8f9fa;
    }

    .license-type img {
        height: 40px;
        width: auto;
    }

    .form-check-input:checked+.form-check-label {
        color: #0d6efd;
    }

    .license-type:has(.form-check-input:checked) {
        border-color: #0d6efd;
        background-color: #f8f9fa;
    }
    .img-thumbnail {
    width: 250px !important;
    height: 250px !important;
    object-fit: cover;
    object-position: center;
}
</style>
@endsection

@section('bottom-header')
<?php
    $Company = App\Models\Company::first();
    $BreadCrumb = [['url' => '/', 'name' => 'Home']];
    ?>
<x-website.header.general title="{{ __('Applicant Form') }}" :breadcrumb="$BreadCrumb" current="" />
@endsection
@section('content')
<section class="passenger_section container my-5">
    <div class="row">
        <div class="span12">
            <section class="row">
                <div class="span12">
                    <div class="span10"> <button id="bluebtn" class="btn btn-info my-2"
                            onclick="toggleRequirements()">Requirements and Instructions</button></div>
                    <!---- Basic Requirements to apply  start ----->
                    <div id="mylayer" class="span8 noview heading">
                        <h2>Basic Requirements to apply:</h2>
                        <ul class="basic">
                            <li>You must have an official, valid government issued driver license (uploaded)</li>
                            <li>You must be 18 years or older to apply</li>
                            <li>A valid mailing address, and email</li>
                            <li>Passport size photo (uploaded). Your photo can be a scan of an actual size passport
                                photo; however we will accept a clear passport style photo as well (i.e. a photo
                                taken from your chest up in a light colored background)</li>
                            <li>Signature (uploaded). Sign a blank document, scan it or take a photo, and upload.
                            </li>
                        </ul>
                        <h2>Instructions:</h2>
                        <ul class="basic">
                            <li>Fill out the 3 part form below. All <span class="sred">* </span> are required
                                fields.
                                <ol>
                                    <li>Applicant and License Information. Enter your all your detailed information,
                                        and upload your official driver license, photo, and signature.</li>
                                    <li>Mailing Address. Complete the mailing information</li>
                                    <li>Payment. Select duration of license, shipping method, and payment
                                        information</li>
                                </ol>
                            </li>
                            <li>Click Submit and Continue.</li>
                            <li>Confirm all details and Submit.</li>
                            <li>You will receive an email with your order confirmation details.</li>
                        </ul>
                    </div>
                    <!---- Basic Requirements to apply  end----->
                </div>


            </section>
            <!----1. License Holder Information section start!!-------->
            <section id="contact_form">

                <div class="span8">
                    Application By Mail <a href="print-application.pdf" value="print" id="print" class="btn ss"
                        target="_blank">Print</a> to print a form, fill it out by
                    hand, and mail it to us.
                    <!--- 	Application By Mail <a href="#" value="print" id="print"  class="btn ss" onclick="window.print()"/>Print</a>&nbsp;&nbsp;  to print a form, fill it out by hand, and mail it to us. -->
                </div>

                <div id="contact_form" class="span12">
                    <form method="post" action="">
                        @csrf
                        <section class="passenger_section container pt-5">
                            <p class="receipt-title">
                                License Holder Information
                            </p>
                            <div class="row mx-0">
                                <div class="col-md-6 col-xl-4 col-sm-12 ">
                                    <label for="">First name</label>
                                    <input type="text" name="" placeholder="First name">
                                </div>
                                <div class="col-md-6 col-xl-4 col-sm-12 ">
                                    <label for="">middle name</label>
                                    <input type="text" name="" placeholder="middle name">
                                </div>
                                <div class="col-md-6 col-xl-4 col-sm-12 ">
                                    <label for="">Last name</label>
                                    <input type="text" name="" placeholder="Last name">
                                </div>
                                <div class="col-md-6 col-xl-4 col-sm-12 ">
                                    <label for="">Address</label>
                                    <input type="text" name="" placeholder="Address">
                                </div>
                                <div class="col-md-6 col-xl-4 col-sm-12 ">
                                    <label for="">Country</label>
                                    <select class="form-select nationality" required="" id=""
                                        aria-label="Default select example">
                                        <option value="">Select </option>
                                        <option value="">Select </option>
                                        <option value="">Select </option>
                                        <option value="">Select </option>

                                    </select>
                                </div>
                                <div class="col-md-6 col-xl-4 col-sm-12 ">
                                    <label for="">State/Region</label>
                                    <select class="form-select nationality" required="" id=""
                                        aria-label="Default select example">
                                        <option value="">Select </option>
                                        <option value="">Select </option>
                                        <option value="">Select </option>
                                        <option value="">Select </option>

                                    </select>
                                </div>
                                <div class="col-md-6 col-xl-4 col-sm-12 ">
                                    <label for="">City</label>
                                    <select class="form-select nationality" required="" id=""
                                        aria-label="Default select example">
                                        <option value="">Select </option>
                                        <option value="">Select </option>
                                        <option value="">Select </option>
                                        <option value="">Select </option>

                                    </select>
                                </div>
                                <div class="col-md-6 col-xl-4 col-sm-12 ">
                                    <label for="">City</label>
                                    <select class="form-select nationality" required="" id=""
                                        aria-label="Default select example">
                                        <option value="">Select </option>
                                        <option value="">Select </option>
                                        <option value="">Select </option>
                                        <option value="">Select </option>

                                    </select>
                                </div>
                                <div class="col-md-6 col-xl-4 col-sm-12 ">
                                    <label for="">Postal Code</label>
                                    <input type="text" name="" placeholder="Postal Code">
                                </div>
                                <div class="col-md-6 col-xl-4 col-sm-12 ">
                                    <label for="">Phone Number</label>
                                    <input type="text" name="" placeholder="Phone Number">
                                </div>
                            </div>
                        </section>
                        <section class="passenger_section container pt-5">
                            <p class="receipt-title">
                                Original Driver License
                            </p>
                            <div class="row mx-0">
                                <div class="col-md-6 col-xl-4 col-sm-12 ">
                                    <label for="">Number</label>
                                    <input type="text" name="" placeholder="Number">
                                </div>
                                <div class="col-md-6 col-xl-4 col-sm-12 ">
                                    <label for="">Country</label>
                                    <select class="form-select nationality" required="" id=""
                                        aria-label="Default select example">
                                        <option value="">Select </option>
                                        <option value="">Select </option>
                                        <option value="">Select </option>
                                        <option value="">Select </option>
                                    </select>
                                </div>
                                <div class="col-md-6 col-xl-4 col-sm-12 ">
                                    <div class="details px-1">
                                        <label>Expiry Date</label>
                                        <div class="d-flex gap-2">
                                            <select class="form-select" name="expiry_day" required>
                                                <option value="">Day</option>
                                                @for ($i = 1; $i <= 31; $i++) <option value="{{ $i }}">{{ $i }}</option>
                                                    @endfor
                                            </select>

                                            <select class="form-select" name="expiry_month" required>
                                                <option value="">Month</option>
                                                @for ($i = 1; $i <= 12; $i++) <option value="{{ $i }}">{{ date('F',
                                                    mktime(0, 0, 0, $i, 1)) }}</option>
                                                    @endfor
                                            </select>

                                            <select class="form-select" name="expiry_year" required>
                                                <option value="">Year</option>
                                                @for ($i = date('Y'); $i <= date('Y')+20; $i++) <option
                                                    value="{{ $i }}">{{ $i }}</option>
                                                    @endfor
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6 col-xl-4 col-sm-12 ">
                                    <div class="details px-1">
                                        <label>Date of Birth</label>
                                        <div class="d-flex gap-2">
                                            <select class="form-select" name="birth_day" required>
                                                <option value="">Day</option>
                                                @for ($i = 1; $i <= 31; $i++) <option value="{{ $i }}">{{ $i }}</option>
                                                    @endfor
                                            </select>

                                            <select class="form-select" name="birth_month" required>
                                                <option value="">Month</option>
                                                @for ($i = 1; $i <= 12; $i++) <option value="{{ $i }}">{{ date('F',
                                                    mktime(0, 0, 0, $i, 1)) }}</option>
                                                    @endfor
                                            </select>

                                            <select class="form-select" name="birth_year" required>
                                                <option value="">Year</option>
                                                @for ($i = date('Y')-100; $i <= date('Y')-18; $i++) <option
                                                    value="{{ $i }}">{{ $i }}</option>
                                                    @endfor
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6 col-xl-4 col-sm-12 ">
                                    <label for="">Country of Birth</label>
                                    <select class="form-select nationality" required="" id=""
                                        aria-label="Default select example">
                                        <option value="">Select </option>
                                        <option value="">Select </option>
                                        <option value="">Select </option>
                                        <option value="">Select </option>
                                    </select>
                                </div>
                                <div class="col-md-6 col-xl-4 col-sm-12 ">
                                    <label for="">Height</label>
                                    <input type="text" name="" placeholder="Height">
                                </div>
                                <div class="col-md-6 col-xl-4 col-sm-12 ">
                                    <label for="">Eye Color</label>
                                    <input type="text" name="" placeholder="Eye Color">
                                </div>
                                <div class="col-md-6 col-xl-4 col-sm-12 ">
                                    <label for="">Gender</label>
                                    <select class="form-select nationality" required="" id=""
                                        aria-label="Default select example">
                                        <option value="">Male </option>
                                        <option value="">Female </option>
                                    </select>
                                </div>
                                <div class="col-12 mb-4">
                                    <label class="form-label"><span class="text-danger">*</span> Categories of Native
                                        Driver's License</label>
                                    <div class="d-flex flex-wrap gap-4">
                                        <div class="form-check license-type">
                                            <input class="form-check-input" type="radio" name="olicensetype" value="a"
                                                id="license-a">
                                            <label class="form-check-label d-flex align-items-center gap-2"
                                                for="license-a">
                                                <img src="{{ asset('website_assets/images/car01.png') }}"
                                                    alt="Motorcycles">
                                                <span class="fs-5">(A)</span>
                                            </label>
                                        </div>

                                        <div class="form-check license-type">
                                            <input class="form-check-input" type="radio" name="olicensetype" value="b"
                                                id="license-b">
                                            <label class="form-check-label d-flex align-items-center gap-2"
                                                for="license-b">
                                                <img src="{{ asset('website_assets/images/car02.png') }}"
                                                    alt="Passenger Cars">
                                                <span class="fs-5">(B)</span>
                                            </label>
                                        </div>

                                        <div class="form-check license-type">
                                            <input class="form-check-input" type="radio" name="olicensetype" value="c"
                                                id="license-c">
                                            <label class="form-check-label d-flex align-items-center gap-2"
                                                for="license-c">
                                                <img src="{{ asset('website_assets/images/car03.png') }}"
                                                    alt="Vehicles over 7,700 Lbs">
                                                <span class="fs-5">(C)</span>
                                            </label>
                                        </div>

                                        <div class="form-check license-type">
                                            <input class="form-check-input" type="radio" name="olicensetype" value="d"
                                                id="license-d">
                                            <label class="form-check-label d-flex align-items-center gap-2"
                                                for="license-d">
                                                <img src="{{ asset('website_assets/images/car04.png') }}"
                                                    alt="Vehicles over 8 seats">
                                                <span class="fs-5">(D)</span>
                                            </label>
                                        </div>

                                        <div class="form-check license-type">
                                            <input class="form-check-input" type="radio" name="olicensetype" value="e"
                                                id="license-e">
                                            <label class="form-check-label d-flex align-items-center gap-2"
                                                for="license-e">
                                                <img src="{{ asset('website_assets/images/car05.png') }}"
                                                    alt="Truck with trailer">
                                                <span class="fs-5">(E)</span>
                                            </label>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </section>
                        <section class="passenger_section container pt-5">
                            <p class="receipt-title">
                                Upload Images
                            </p>
                            <div class="row mx-0">

                                <div class="col-sm-12 col-md-6 col-xl-3">
                                    <label for="photo">Your Photo</label>
                                    <img width="250px" height="250px"  src="{{ asset('website_assets/images/up.png') }}"
                                        class="img-thumbnail preview-photo" alt="Photo preview">
                                    <input type="file" class="file" name="photo" id="photo" accept="image/*"
                                        onchange="previewImage(this, 'preview-photo')">
                                </div>

                                <div class="col-sm-12 col-md-6 col-xl-3">
                                    <label for="license_front">License Front</label>
                                    <img width="250px" height="250px"  src="{{ asset('website_assets/images/up.png') }}"
                                        class="img-thumbnail preview-license-front" alt="License front preview">
                                    <input type="file" class="file" name="license_front" id="license_front"
                                        accept="image/*" onchange="previewImage(this, 'preview-license-front')">
                                </div>

                                <div class="col-sm-12 col-md-6 col-xl-3">
                                    <label for="license_back">License Back</label>
                                    <img width="250px" height="250px"  src="{{ asset('website_assets/images/up.png') }}"
                                        class="img-thumbnail preview-license-back" alt="License back preview">
                                    <input type="file" class="file" name="license_back" id="license_back"
                                        accept="image/*" onchange="previewImage(this, 'preview-license-back')">
                                </div>
                                <div class="col-sm-12 col-md-6 col-xl-3">
                                    <label for="license_back">Your Signature</label>
                                    <img width="250px" height="250px" src="{{ asset('website_assets/images/up.png') }}"
                                        class="img-thumbnail preview-your-license" alt="Your Signature preview">
                                    <input type="file" class="file" name="license_back" id="Your_Signature"
                                        accept="image/*" onchange="previewImage(this, 'preview-your-license')">
                                </div>
                                <p class="col-12 mt-3">
                                    Click on each tab to upload your photo, original government issued driver
                                    license front side, and your signature. If your images are not loading
                                    properly, you can email them to <a
                                        href="mailto:info@idl-gaa.com">info@idl-gaa.com</a>
                                </p>
                            </div>
                        </section>
                        <section class="passenger_section container pt-5">
                            <p class="receipt-title">
                                E-mail Contact
                            </p>
                            <div class="row mx-0">
                                <div class="col-md-6 col-xl-4 col-sm-12 ">
                                    <label for="">Email Address</label>
                                    <input type="text" name="" placeholder="Email Address">
                                </div>
                                <div class="col-md-6 col-xl-4 col-sm-12 ">
                                    <label for="">Re-Enter Email Address</label>
                                    <input type="text" name="" placeholder="Re-Enter Email Address">
                                </div>
                                <div class="col-md-6 col-xl-4 col-sm-12 ">
                                    <label for="">Agent Code</label>
                                    <input type="text" name="" placeholder="Agent Code">
                                </div>
                                <div class="col-12 ">
                                    <label for="">Comment</label>
                                    <textarea class="form-control" name="comment" rows="4" placeholder="Enter your comment"></textarea>
                                </div>
                            </div>
                        </section>
                        <section class="passenger_section container pt-5">
                            <p class="receipt-title">
                                Shipping Address (Address where the document is being sent to)
                            </p>
                            <div class="row mx-0">
                                <div class="col-12 d-flex align-items-center mb-3">
                                    <input type="checkbox" name="" class="form-check-input me-2">
                                    <label for="" class="form-check-label mb-0">use shipping address above.</label>
                                </div>
                                <div class="col-md-6 col-xl-4 col-sm-12 ">
                                    <label for="">First name</label>
                                    <input type="text" name="" placeholder="First name">
                                </div>
                                <div class="col-md-6 col-xl-4 col-sm-12 ">
                                    <label for="">Last name</label>
                                    <input type="text" name="" placeholder="Last name">
                                </div>
                                <div class="col-md-6 col-xl-4 col-sm-12 ">
                                    <label for="">Address</label>
                                    <input type="text" name="" placeholder="Address">
                                </div>
                                <div class="col-md-6 col-xl-4 col-sm-12 ">
                                    <label for="">Country</label>
                                    <select class="form-select nationality" required="" id=""
                                        aria-label="Default select example">
                                        <option value="">Select </option>
                                        <option value="">Select </option>
                                        <option value="">Select </option>
                                        <option value="">Select </option>
                                    </select>
                                </div>
                                <div class="col-md-6 col-xl-4 col-sm-12 ">
                                    <label for="">State / Region</label>
                                    <input type="text" name="" placeholder="State / Region">
                                </div>
                                <div class="col-md-6 col-xl-4 col-sm-12 ">
                                    <label for="">City</label>
                                    <input type="text" name="" placeholder="City">
                                </div>
                                <div class="col-md-6 col-xl-4 col-sm-12 ">
                                    <label for="">Postal Code</label>
                                    <input type="text" name="" placeholder="Postal Code">
                                </div>
                            </div>
                        </section>
                        <section class="passenger_section container pt-5">
                            <p class="receipt-title">
                                Choose your License & Shipping Method
                            </p>
                            <div class="row mx-0">

                                <div class="col-md-6 col-xl-4 col-sm-12 ">
                                    <label for="">Choose your License</label>
                                    <select class="form-select nationality" required="" id=""
                                        aria-label="Default select example">
                                        <option value="">Select </option>
                                        <option value="">Select </option>
                                        <option value="">Select </option>
                                        <option value="">Select </option>
                                    </select>
                                </div>

                                <div class="col-md-6 col-xl-4 col-sm-12 ">
                                    <label for="">Shipping Method </label>
                                    <select class="form-select nationality" required="" id=""
                                        aria-label="Default select example">
                                        <option value="">Select </option>
                                        <option value="">Select </option>
                                        <option value="">Select </option>
                                        <option value="">Select </option>
                                    </select>
                                </div>
                                <div class="col-12 d-flex align-items-center mb-3">
                                    <input type="checkbox" name="" class="form-check-input me-2">
                                    <label for="" class="form-check-label mb-0">Insurance -
                                        &#36;10.00</label>
                                </div>
                            </div>
                        </section>
                    </div>
                    <button type="submit" class="submit-btn">Submit Application</button>
                </form>
    </div>
    <script>
        function toggleRequirements() {
                    const requirementsLayer = document.getElementById('mylayer');
                    requirementsLayer.classList.toggle('noview');
                }


        function previewImage(input, previewClass) {
            if (input.files && input.files[0]) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    document.querySelector('.' + previewClass).src = e.target.result;
                }
                reader.readAsDataURL(input.files[0]);
            }
        }

    </script>
</section>


@endsection
