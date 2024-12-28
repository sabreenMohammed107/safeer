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

        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            background-color: #f8f9fa;
            color: #333;
            padding: 20px;
        }

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
            width: 100%;
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
                            <div class="span10"> <a href="#" id="bluebtn" class="btn btn-info"
                                    onclick="clickBluebtn()">Requirements and Instructions</a></div>
                            <!---- Basic Requirements to apply  start ----->
                            <div id="mylayer" class="span8 noview">
                                <h5>Basic Requirements to apply:</h5>
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
                                <h5>Instructions:</h5>
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
                    <form action="#" method="POST">
                        <section id="contact_form">

                            <div class="span8">
                                Application By Mail <a href="print-application.pdf" value="print" id="print"
                                    class="btn ss" target="_blank" />Print</a>&nbsp;&nbsp;to print a form, fill it out by
                                hand, and mail it to us.
                                <!--- 	Application By Mail <a href="#" value="print" id="print"  class="btn ss" onclick="window.print()"/>Print</a>&nbsp;&nbsp;  to print a form, fill it out by hand, and mail it to us. -->
                            </div>

                            <div id="contact_form" class="span12">
                                <form method="post" name="fmapply" action="applydo.php">
                                    <input type="hidden" name="feesum" id="feesum" value="0">

                                    <div class="row">
                                        <div class="span8">
                                            <h3>License Holder Information</h3>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="span2 text-left"><span class="sred">* </span>First name </div>
                                        <div id="confirm_pfname" name="confirmtxt" class="span4 preedit"> </div>
                                        <div name="confirmfrm" class="span4 view"><input name="pfname" type="text"
                                                class="input_field" maxlength="100" placeholder="First Name" /> </div>
                                    </div>
                                    <div class="row">
                                        <div class="span2 text-left left10"> middle name </div>
                                        <div id="confirm_pmname" name="confirmtxt" class="span4 preedit"> </div>
                                        <div name="confirmfrm" class="span3 view"><input name="pmname" type="text"
                                                class="input_field" maxlength="100" placeholder="Middle Name" /> </div>
                                    </div>
                                    <div class="row">
                                        <div class="span2 text-left"><span class="sred">* </span> Last name </div>
                                        <div id="confirm_plname" name="confirmtxt" class="span4 preedit"> </div>
                                        <div name="confirmfrm" class="span4 view"><input name="plname" type="text"
                                                class="input_field" maxlength="100" placeholder="Last Name" /> </div>
                                    </div>
                                    <div class="row">
                                        <div class="span2 text-left"><span class="sred">* </span> Address </div>
                                        <div id="confirm_paddress" name="confirmtxt" class="span4 preedit"> </div>
                                        <div name="confirmfrm" class="span4 view"><input name="paddress" type="text"
                                                class="input_field" maxlength="100" placeholder="Address" value="" />
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="span2 text-left"><span class="sred">* </span> Country </div>
                                        <div id="confirm_pcountry" name="confirmtxt" class="span4 preedit"> </div>
                                        <div name="confirmfrm" class="span4 view"><select id="pcountry" name="pcountry"
                                                class="input_field"></select></div>
                                    </div>
                                    <div class="row">
                                        <div class="span2 text-left"><span class="sred">* </span> State/Province/Region
                                        </div>
                                        <div id="confirm_pstate" name="confirmtxt" class="span4 preedit"> </div>
                                        <div name="confirmfrm" class="span4 view"><select id="pstate" name="pstate"
                                                class="input_field" /></select></div>
                                    </div>
                                    <div class="row">
                                        <div class="span2 text-left"><span class="sred">* </span> City </div>
                                        <div id="confirm_pcity" name="confirmtxt" class="span4 preedit"> </div>
                                        <div name="confirmfrm" class="span4 view"><input id="pcity" name="pcity"
                                                type="text" class="input_field" placeholder="City" value="" />
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="span2 text-left"><span class="sred">* </span> Zip Code/Postal Code
                                        </div>
                                        <div id="confirm_pzipcode" name="confirmtxt" class="span4 preedit"> </div>
                                        <div name="confirmfrm" class="span4 view"><input id="pzipcode" name="pzipcode"
                                                type="text" class="input_field" maxlength="10"
                                                placeholder="Zip Code/Postal Code" value="" /> </div>
                                    </div>
                                    <div class="row">
                                        <div class="span2 text-left"><span class="sred">* </span> Phone Number </div>
                                        <div id="confirm_pphone" name="confirmtxt" class="span4 preedit"> </div>
                                        <div name="confirmfrm" class="span4 view"><input id="pphone" name="pphone"
                                                type="text" class="input_field" maxlength="20"
                                                placeholder="Phone Number" /> </div>
                                    </div>

                                    <div class="line_dot"></div>


                                    <!----2.Original Driver License section start!!-------->

                                    <div class="row">
                                        <div class="span9">
                                            <h3>Original Driver License</h3>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="span2 text-left"><span class="sred">* </span> Number </div>
                                        <div id="confirm_olicense" name="confirmtxt" class="span4 preedit"> </div>
                                        <div name="confirmfrm" class="span4 view"><input id="olicense" name="olicense"
                                                type="text" class="input_field" maxlength="50"
                                                placeholder="License Number" value="" /> </div>
                                    </div>
                                    <div class="row">
                                        <div class="span2 text-left"><span class="sred">* </span> Country </div>
                                        <div id="confirm_odcountry" name="confirmtxt" class="span4 preedit"> </div>
                                        <div name="confirmfrm" class="span4 view"><select id="odcountry"
                                                name="odcountry" type="text" class="input_field" /></select></div>
                                    </div>
                                    <div class="row">
                                        <div class="span2 text-left"><span class="sred">* </span> Expiry Date </div>
                                        <div id="confirm_oexday" name="confirmtxt" class="span4 preedit"> </div>
                                        <div name="confirmfrm" class="span1 view"><select id="oexmonth" name="oexmonth"
                                                class="input_field3_3" /></select></div>
                                        <div name="confirmfrm" class="span1 view"><select id="oexday" name="oexday"
                                                class="input_field3_3" /></select></div>
                                        <div name="confirmfrm" class="span2 view"><select id="oexyear" name="oexyear"
                                                class="input_field3_3" /></select></div>
                                    </div>
                                    <div class="row">
                                        <div class="span2 text-left"><span class="sred">* </span> Date of Birth</div>
                                        <div id="confirm_obday" name="confirmtxt" class="span4 preedit"> </div>
                                        <div name="confirmfrm" class="span1 view"><select id="obmonth" name="obmonth"
                                                class="input_field3_3" /></select></div>
                                        <div name="confirmfrm" class="span1 view"><select id="obday" name="obday"
                                                class="input_field3_3" /></select></div>
                                        <div name="confirmfrm" class="span2 view"><select id="obyear" name="obyear"
                                                class="input_field3_3" /></select></div>
                                    </div>
                                    <div class="row">
                                        <div class="span2 text-left"><span class="sred">* </span> Country of Birth
                                        </div>
                                        <div id="confirm_obcountry" name="confirmtxt" class="span4 preedit"> </div>
                                        <div name="confirmfrm" class="span4 view"><select id="obcountry"
                                                name="obcountry" class="input_field" /></select></div>
                                    </div>
                                    <div class="row">
                                        <div class="span2 text-left"><span class="sred">* </span> Height( ft/inch or cm)
                                        </div>
                                        <div id="confirm_height" name="confirmtxt" class="span4 preedit"> </div>
                                        <div name="confirmfrm" class="span1 view"><select id="ofeet" name="ofeet"
                                                class="input_field" />
                                            <option value="0" selected>0 ft</option>
                                            <option value="3">3 ft</option>
                                            <option value="4">4 ft</option>
                                            <option value="5">5 ft</option>
                                            <option value="6">6 ft</option>
                                            <option value="7">7 ft</option></select>
                                        </div>
                                        <div name="confirmfrm" class="span1 view"><select id="oinch" name="oinch"
                                                class="input_field" />
                                            <option value="0" selected>0 inch</option>
                                            <option value="1">1 inch</option>
                                            <option value="2">2 inch</option>
                                            <option value="3">3 inch</option>
                                            <option value="4">4 inch</option>
                                            <option value="5">5 inch</option>
                                            <option value="6">6 inch</option>
                                            <option value="7">7 inch</option>
                                            <option value="8">8 inch</option>
                                            <option value="9">9 inch</option>
                                            <option value="10">10 inch</option>
                                            <option value="11">11 inch</option></select>
                                        </div>
                                        <div name="confirmfrm" class="span1 view"> <input id="ocm" name="ocm"
                                                type="text" class="input_field" maxlength="3" placeholder="0" />
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="span2 text-left"><span class="sred">* </span> Eye Color</div>
                                        <div id="confirm_oeyecolor" name="confirmtxt" class="span4 preedit"> </div>
                                        <div name="confirmfrm" class="span3 view"><select id="oeyecolor"
                                                name="oeyecolor" class="input_field" />
                                            <option value="">Eye color</option>
                                            <option value="black">Black</option>
                                            <option value="blue">Blue</option>
                                            <option value="brown">Brown</option>
                                            <option value="hazel">Hazel</option>
                                            <option value="gray">Gray</option>
                                            <option value="green">Green</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="span2 text-left"><span class="sred">* </span> Sex </div>
                                        <div id="confirm_osex" name="confirmtxt" class="span4 preedit"> </div>
                                        <div name="confirmfrm" class="span6 view"><input type="radio" name="osex"
                                                value="m" checked="checked" class="radio_b" /> <span
                                                class="sex">Male</span> <input name="osex" type="radio"
                                                value="f" class="radio_b" /> <span class="sex">Female</span>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="span10 text-left"><span class="sred">* </span> Categories of Native
                                            Driver's License </div>
                                        <div class="span2"></div>
                                        <div id="confirm_olicensetype" name="confirmtxt" class="span4 preedit"> </div>
                                        <div name="confirmfrm" class="span10 view">
                                            <ul class="l_type_choices">
                                                <li>
                                                    <input name="olicensetype" class="l_type" type="radio"
                                                        value="a">
                                                    <a style="color: #777; font-size: 1.2em;  cursor:pointer; text-decoration:none;"
                                                        title="MOTORCYCLES"><img src="images/car01.png"> (A)</a>
                                                </li>
                                                <li>
                                                    <input name="olicensetype" class="l_type" type="radio"
                                                        value="b">
                                                    <a style="color: #777; font-size: 1.2em;  cursor:pointer; text-decoration:none;"
                                                        title="PASSENGER CARS"><img src="images/car02.png"> (B)</a>
                                                </li>
                                                <li>
                                                    <input name="olicensetype" class="l_type" type="radio"
                                                        value="c">
                                                    <a style="color: #777; font-size: 1.2em; cursor:pointer; text-decoration:none;"
                                                        title="VEHICLES OVER 7,700 Lbs"><img src="images/car03.png">
                                                        (C)</a>
                                                </li>
                                                <li>
                                                    <input name="olicensetype" class="l_type" type="radio"
                                                        value="d">
                                                    <a style="color: #777; font-size: 1.2em; cursor:pointer; text-decoration:none;"
                                                        title="VEHICLES OVER 8 SEATS"><img src="images/car04.png"> (D)</a>
                                                </li>
                                                <li>
                                                    <input name="olicensetype" class="l_type" type="radio"
                                                        value="e">
                                                    <a style="color: #777; font-size: 1.2em; cursor:pointer; text-decoration:none;"
                                                        title="TRUCK WITH TRAILER"><img src="images/car05.png"> (E)</a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="line_dot"></div>
                                    <!----3.Upload Images start!!-------->
                                    <div class="row">
                                        <div class="span8">
                                            <h3>Upload Images</h3>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="span8">
                                            <!----(1)  photo upload start----->
                                            <div class="span2">
                                                <label for="photo"><span class="sred">* </span> Your Photo</label>
                                                <div id="uploadphoto"><img id="fileimg1" src="images/upload.png"
                                                        alt="find" /></div>
                                            </div>
                                            <!----(1) photo upload  end----->

                                            <!----(2)  license upload start----->
                                            <div class="span2">
                                                <label for="license"><span class="sred">* </span> License <font
                                                        color=red>front side</font></label>
                                                <div id="uploadlicense"><img id="fileimg2" src="images/upload.png"
                                                        alt="find" /></div>
                                            </div>
                                            <!----(2) license upload  end ----->

                                            <!----(4)  license back side upload start----->
                                            <div class="span2">
                                                <label for="licenseback"><span class="sred">* </span> License <font
                                                        color=red>back side</font></label>
                                                <div id="uploadlicenseback"><img id="fileimg4" src="images/upload.png"
                                                        alt="find" /></div>
                                            </div>
                                            <!----(4) license back side upload  end ----->

                                            <!----(3)  sign upload start----->
                                            <div class="span2">
                                                <label for="signature"><span class="sred">* </span> Your
                                                    Signature</label>
                                                <div id="uploadsign"><img id="fileimg3" src="images/upload.png"
                                                        alt="find" /></div>
                                            </div>
                                            <!----(3)  sign upload end ----->
                                            <div class="cleaner"></div>

                                            <div class="span8">
                                                Click on each tab to upload your photo, original government issued driver
                                                license front side, and your signature. If your images are not loading
                                                properly, you can email them to <a
                                                    href="mailto:info@idl-gaa.com">info@idl-gaa.com</a>
                                            </div>
                                            <input type="hidden" name="file1" id="file1" />
                                            <input type="hidden" name="file2" id="file2" />
                                            <input type="hidden" name="file3" id="file3" />
                                            <input type="hidden" name="file4" id="file4" />
                                            <input type="hidden" name="file1o" id="file1o" />
                                            <input type="hidden" name="file2o" id="file2o" />
                                            <input type="hidden" name="file3o" id="file3o" />
                                            <input type="hidden" name="file4o" id="file4o" />
                                        </div>
                                    </div>
                                    <div class="line_dot"></div>


                                    <!----4.E-mail Contact start!!-------->
                                    <div class="row">
                                        <div class="span8">
                                            <h3>E-mail Contact</h3>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="span2 text-left"><span class="sred">* </span> Email Address </div>
                                        <div id="confirm_email" name="confirmtxt" class="span4 preedit"> </div>
                                        <div name="confirmfrm" class="span4 view"><input type="text" name="email"
                                                id="email" class="input_field" placeholder="Your email address"
                                                maxlength="50" /> </div>
                                    </div>
                                    <div name="confirmfrm" class="row">
                                        <div class="span2 text-left"><span class="sred">* </span> Re-Enter Email Address
                                        </div>
                                        <div name="confirmfrm" class="span4 view"><input type="text" name="remail"
                                                id="remail" class="input_field"
                                                placeholder="Re-enter your email address" maxlength="50" /> </div>
                                    </div>
                                    <div class="row">
                                        <div class="span2 text-left left10"> Agent Code </div>
                                        <div id="confirm_agentcd" name="confirmtxt" class="span4 preedit"> </div>
                                        <div name="confirmfrm" class="span4 view"><input type="text" name="agentcd"
                                                id="agentcd" class="input_field" maxlength="20" /> </div>
                                    </div>
                                    <div class="row">
                                        <div class="span2 text-left left10"> Comment </div>
                                        <div id="confirm_contactmemo" name="confirmtxt" class="span4 preedit"> </div>
                                        <div name="confirmfrm" class="span4 view">
                                            <textarea name="contactmemo" id="contactmemo" class="input_field"></textarea>
                                        </div>
                                    </div>
                                    <div class="line_dot"></div>

                                    <!----plus  shipping Address-------->

                                    <div class="row">
                                        <div class="span12">
                                            <h3>Shipping Address (Address where the document is being sent to)</h3>
                                        </div>
                                    </div>
                                    <div class="row" name="confirmfrm">
                                        <div class="span6 text-left">
                                            <p><input name="copyinfo" id="copyinfo" class="l_type" type="checkbox">
                                                Check the Box if the shipping address is the same as the address above.</p>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="span2 text-left"><span class="sred">* </span>First name </div>
                                        <div id="confirm_safname" name="confirmtxt" class="span4 preedit"> </div>
                                        <div name="confirmfrm" class="span4 view"><input name="safname" type="text"
                                                class="input_field" maxlength="100" placeholder="First Name" /> </div>
                                    </div>
                                    <div class="row">
                                        <div class="span2 text-left"><span class="sred">* </span> Last name </div>
                                        <div id="confirm_salname" name="confirmtxt" class="span4 preedit"> </div>
                                        <div name="confirmfrm" class="span4 view"><input name="salname" type="text"
                                                class="input_field" maxlength="100" placeholder="Last Name" /> </div>
                                    </div>
                                    <div class="row">
                                        <div class="span2 text-left"><span class="sred">* </span> Address </div>
                                        <div id="confirm_sadddress" name="confirmtxt" class="span4 preedit"> </div>
                                        <div name="confirmfrm" class="span4 view"><input name="sadddress" type="text"
                                                class="input_field" maxlength="100" placeholder="Address"
                                                value="" /></div>
                                    </div>
                                    <div class="row">
                                        <div class="span2 text-left"><span class="sred">* </span> Country </div>
                                        <div id="confirm_sacountry" name="confirmtxt" class="span4 preedit"> </div>
                                        <div name="confirmfrm" class="span4 view"><select id="sacountry"
                                                name="sacountry" class="input_field"></select> </div>
                                    </div>
                                    <div class="row">
                                        <div class="span2 text-left"><span class="sred">* </span> State/Province/Region
                                        </div>
                                        <div id="confirm_saprovince" name="confirmtxt" class="span4 preedit"> </div>
                                        <div name="confirmfrm" class="span4 view"><select id="saprovince"
                                                name="saprovince" class="input_field" /></select></div>
                                    </div>
                                    <div class="row">
                                        <div class="span2 text-left"><span class="sred">* </span> City </div>
                                        <div id="confirm_sacity" name="confirmtxt" class="span4 preedit"> </div>
                                        <div name="confirmfrm" class="span4 view"><input id="sacity" name="sacity"
                                                type="text" class="input_field" placeholder="City" value="" />
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="span2 text-left"><span class="sred">* </span> Zip Code/Postal Code
                                        </div>
                                        <div id="confirm_sapostalcode" name="confirmtxt" class="span4 preedit"> </div>
                                        <div name="confirmfrm" class="span4 view"><input id="sapostalcode"
                                                name="sapostalcode" type="text" class="input_field" maxlength="10"
                                                placeholder="Zip Code/Postal Code" value="" /> </div>
                                    </div>
                                    <div class="line_dot"></div>






                                    <!----5.Choose your License & Shipping Method start!!-------->
                                    <div class="row">
                                        <div class="span8">
                                            <h3>Choose your License & Shipping Method</h3>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="span2 text-left"><span class="sred">* </span> Choose your License
                                        </div>
                                        <div id="confirm_lfeeyear" name="confirmtxt" class="span3 preedit"> </div>
                                        <div name="confirmfrm" class="span3 view"><select name="lfeeyear" id="lfeeyear"
                                                class="input_field" />
                                            <option value='0' price=''>SELECT YEAR</option>
                                            <option value='1' price='40.00'>1 Year License - $40.00</option>
                                            <option value='2' price='50.00'>3 Year License - $50.00</option>
                                            <option value='3' price='60.00' selected='selected'>5 Year License -
                                                $60.00</option>
                                            <option value='4' price='70.00'>10 Year License - $70.00</option>
                                            <option value='5' price='95.00'>15 Year License - $95.00</option>
                                            <option value='6' price='105.00'>20 Year License - $105.00</option>
                                            </select>
                                        </div>
                                        <div class="span4">
                                            <div id="confirm_linsu" name="confirmtxt"
                                                class="span1 preedit text-right sred" style="margin-right:10px"> </div>
                                            <input name="linsu" id="linsu" class="l_type" type="checkbox"
                                                value="10.00" price="10.00" checked readonly Disabled> Insurance -
                                            &#36;10.00
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="span2 text-left"><span class="sred">* </span>Shipping Method </div>
                                        <div id="confirm_lshipping" name="confirmtxt" class="span4 preedit"> </div>
                                        <div name="confirmfrm" class="span4 view"><select name="lshipping"
                                                id="lshipping" class="input_field" />
                                            <option value='0' price=''>SELECT SHIPPING METHOD</option>
                                            <option value='1' price='15.00' selected='selected'>(USA) Fed Ex/UPS
                                                (5-6 business Days) - $15.00</option>
                                            <option value='2' price='18.00'>(USA) Priority Mail (3-5 business Days)
                                                - $18.00</option>
                                            <option value='3' price='35.00'>(USA) Fed Ex/UPS (2-day) - $35.00
                                            </option>
                                            <option value='4' price='35.00'>(Worldwide) (10-15 days, trackable) Fed
                                                Ex / DHL Express - 35$</option>
                                            <option value='6' price='50.00'>(Worldwide) (3-6 days, trackable) DHL
                                                Express - $50.00</option> </select>
                                        </div>
                                    </div>
                                    <div class="row po_box_number" style="display: none;">
                                        <div class="span2 text-left"><span class="sred">* </span> P.O. Box. Number
                                        </div>
                                        <div id="confirm_po_box_number" name="confirmtxt" class="span4 preedit"> </div>
                                        <div name="confirmfrm" class="span4 view"><input id="po_box_number"
                                                name="po_box_number" type="text" class="input_field" maxlength="10"
                                                placeholder="P.O. Box. Number" value="" /> </div>
                                    </div>
                                    <div class="row">
                                        <div class="span8">
                                            <h2 class="total">Total : <span id="totalsum" class="lssum">$0.00</span>
                                            </h2>
                                            This amount is the amount that the sum of license fee and shipping insurance
                                            (optional) costs.
                                        </div>
                                    </div>

                                    <div class="line_dot"></div>


                        </section>
                        <button type="submit" class="submit-btn">Submit Application</button>
                                </form>
                </div>
            </div>
        </section>
                    @endsection
