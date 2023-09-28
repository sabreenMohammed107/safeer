@extends('layout.website.layout', ['Company' => $Company, 'title' => 'Safer | Terms'])

@section('adds_css')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="{{ asset('/website_assets/css/about.css') }}">
    <style>
        .wrap {
            display: flex;
            justify-content: space-around;
            align-items: center;
            box-sizing: border-box;
            height: 100vh;
            padding: 2rem;
            background-color: #eee;
        }

        h2 {
            font-size: calc(1.065rem + .12vw);
        }
    </style>
@endsection

@section('bottom-header')
    <x-website.header.general title="{{ __('links.term_condation') }}" :breadcrumb="$BreadCrumb" current="" />
@endsection
@section('content')
    <section class="investigtion">

        <section class="container">

            @if (LaravelLocalization::getCurrentLocale() === 'en')
            <div class="container__content">
                <div class="mt-1">
                    <h2 _ngcontent-serverapp-c181="" class="d-flex align-items-center line-height-normal my-4 pb-2"
                        style="border-bottom:1px solid #ddd ">
                        <i class="fa-solid fa-circle-arrow-right px-2"></i> <span>CHANGE IN OUR TERMS AND CONDITIONS</span>
                    </h2>
                    <p class="px-2">Safer.Travel reserves the right to change and modify these terms and conditions at any
                        time. Changes will be effective as soon as they are published on the Safer.Travel website </p>
                </div>

                <div class="mt-5">
                    <h2 _ngcontent-serverapp-c181="" class="d-flex align-items-center line-height-normal mb-4 pb-2"
                        style="border-bottom:1px solid #ddd ">
                        <i class="fa-solid fa-circle-arrow-right px-2"></i> <span>NAMES OF PERSONS TRAVELLING</span>
                    </h2>


                    <p class="px-2">It is important that the person making the booking must enter the correct names of all
                        persons travelling. If TBA or another abbreviation has been entered as the guest's name, the hotel
                        may reject the booking. The names of all persons travelling must be entered and the first name
                        should be followed by the Family name.</p>
                </div>

                <div class="mt-5">
                    <h2 _ngcontent-serverapp-c181="" class="d-flex align-items-center line-height-normal mb-4 pb-2"
                        style="border-bottom:1px solid #ddd ">
                        <i class="fa-solid fa-circle-arrow-right px-2"></i> <span>E.MAIL ACCOUNTS</span>
                    </h2>



                    <p class="px-2">It is the responsibility of all Safer.Travel members to ensure they have entered a
                        correct e.mail address. If our e.mail has been sent to your Junk or Bulk mail folder, you can
                        prevent this from happening again by opening our e.mail and clicking on the 'not spam' or 'this is
                        not spam' button. </p>
                </div>

                <div class="mt-5">
                    <h2 _ngcontent-serverapp-c181="" class="d-flex align-items-center line-height-normal mb-4 pb-2"
                        style="border-bottom:1px solid #ddd ">
                        <i class="fa-solid fa-circle-arrow-right px-2"></i> <span>ROOM TYPES</span>
                    </h2>

                    <p class="px-2">It is the responsibility of the Safer.Travel member making the booking to ensure that
                        the room type booked will be suitable for the party traveling. If more persons turn up at the hotel
                        than the room can accommodate then the hotel are within their rights not to accept the booking and
                        in this case no refund will be made.
                        While Safer.Travel undertake to ensure that your clients requested room type and smoking preference
                        is available, Safer.Travel cannot guarantee the actual bedding make-up of the room. These requests
                        are sent to the hotel and are subject to availability.
                        Safer.Travel try to ensure that the hotel provides the room type(s) booked, however there may be
                        occasions when instead of a double-bedded room a twin may be allocated or a double -bedded room
                        instead of a twin. Please be aware that the majority of European hotels provide 2 single beds pushed
                        together to make a Double bed. While all room type preferences are forwarded to the hotel, room
                        allocation is done by the hotel and subject to availability at the time of check in.
                    </p>
                </div>

                <div class="mt-5">

                    <h2 _ngcontent-serverapp-c181="" class="d-flex align-items-center line-height-normal mb-4 pb-2"
                        style="border-bottom:1px solid #ddd ">
                        <i class="fa-solid fa-circle-arrow-right px-2"></i> <span>HOTEL CATEGORIES/ LOCAL CLASSIFICATION AND
                            * RATINGS</span>
                    </h2>


                    <p class="px-2">Star ratings aim to give a general overview of the quality of the hotel and
                        approximate level of facilities, services and amenities available. However this rating system does
                        vary from country to country. For example a 5* Bangkok hotel will not be the same as a 5* London
                        hotel. Safer.Travel are not responsible for the hotel categories and * ratings as these have been
                        provided to us and accepted in good faith. </p>
                </div>


                <div class="mt-5">

                    <h2 _ngcontent-serverapp-c181="" class="d-flex align-items-center line-height-normal mb-4 pb-2"
                        style="border-bottom:1px solid #ddd ">
                        <i class="fa-solid fa-circle-arrow-right px-2"></i> <span>PAYMENT AND RATES</span>
                    </h2>


                    <p class="px-2">Currency exchange rates generally change on daily basis depending on the fluctuations
                        in the market. Safer.Travel reserve the right to update room rates displayed on the website
                        depending on any market fluctuations.
                        Any changes relating to currency exchange rate fluctuations will not affect the rates of an already
                        confirmed booking. Likewise, once a booking has been booked and confirmed at the rates you have
                        accepted, there is no refund for any difference in rates due to exchange rate fluctuations.
                        All rates are valid for the leisure market only. Safer.Travel will not accept responsibility for any
                        booking if it becomes known that a client is not travelling for leisure purposes. Hotels may refuse
                        to honour our contract rate and charge rack rate to the clients directly.
                        Rates include applicable hotel taxes. Tourist/local/city taxes which generally include the use of
                        local services may not be included. If city tax needs to be paid at the hotel, this info is shown in
                        Remarks and on the voucher.
                    </p>
                </div>




                <div class="mt-5">

                    <h2 _ngcontent-serverapp-c181="" class="d-flex align-items-center line-height-normal mb-4 pb-2"
                        style="border-bottom:1px solid #ddd ">
                        <i class="fa-solid fa-circle-arrow-right px-2"></i> <span>IMPORTANT</span>
                    </h2>


                    <p class="px-2">Our company name will appear as Safer.Travel LLC on the credit card statement of the
                        credit card used to make the booking. If a Safer.Travel member has used their clients credit card to
                        make the hotel booking then it is the responsibility of the Safer.Travel member to inform their
                        customer of this important information in order to avoid any misunderstandings.
                        Safer.Travel reserve the right to correct any pricing or displayed errors and/or omissions. This
                        includes errors and/or omissions which have been entered by a hotelier or local agent. In the event
                        of a price error and/or omission, we will offer you the choice of either keeping the booking at the
                        correct rates, cancelling the booking or subject to availability we will offer you a suitable
                        alternate hotel.
                    </p>
                </div>



                <div class="mt-5">

                    <h2 _ngcontent-serverapp-c181="" class="d-flex align-items-center line-height-normal mb-4 pb-2"
                        style="border-bottom:1px solid #ddd ">
                        <i class="fa-solid fa-circle-arrow-right px-2"></i> <span>LOCAL MARKET RATES</span>
                    </h2>


                    <p class="px-2">Not all of the hotel rates are displayed on the Safer.Travel website are applicable
                        for the local market. In addition some other markets may be affected and in such cases the hotel is
                        within their rights to change the rates without prior notice.
                        You agree that passenger nationality declaration is mandatory and must be determined by selecting
                        Client Nationality at the time of booking. This information must be in accordance with the passenger
                        passport. False declaration of passenger nationality may cause consequences for which we cannot be
                        held liable. If you do not change Client Nationality, Agency Nationality will be taken as passenger
                        nationality by default. In case, any financial damage occurs due to false nationality declaration,
                        it will be covered by the agency towards your customers or to us in full.

                    </p>
                </div>



                <div class="mt-5">

                    <h2 _ngcontent-serverapp-c181="" class="d-flex align-items-center line-height-normal mb-4 pb-2"
                        style="border-bottom:1px solid #ddd ">
                        <i class="fa-solid fa-circle-arrow-right px-2"></i> <span>RESORT AND INTERNATIONAL TRANSACTION
                            FEES</span>
                    </h2>


                    <p class="px-2">The majority of credit card providers charge some sort of an International Transaction
                        fee. This can be as much as 3% although Capital One not only doesn't impose its own fee, but it also
                        eats the 1% fee that Visa or MasterCard impose. This fee is passed on by certain credit card
                        providers because the charge for your booking has been processed outside of the country that you
                        reside in. Please note that the charge has not been passed on by Safer.Travel and that Safer.Travel
                        cannot be held responsible for any international transaction charges passed on by
                        your or your clients credit card issuer.
                        Some hotels, particularly in the USA do charge a resort fee which must be paid to the hotel
                        directly. This is typically $10 to $20 a room a night. Safer.Travel is not responsible for resort
                        fee charges and have no control over their implementation

                    </p>
                </div>


                <div class="mt-5">

                    <h2 _ngcontent-serverapp-c181="" class="d-flex align-items-center line-height-normal mb-4 pb-2"
                        style="border-bottom:1px solid #ddd ">
                        <i class="fa-solid fa-circle-arrow-right px-2"></i> <span>ADDITIONAL CHARGES MADE BY THE
                            HOTEL</span>
                    </h2>


                    <p class="px-2">Safer.Travel has no control over any extra charges that a hotel may decide to their
                        implement for guest room incidentals such as air conditioning, safe, mini fridge, hire of television
                        remote etc... Any such charges must be paid direct to the hotel and Safer.Travel cannot be held
                        responsible for any incidental charges passed on by the hotel.
                        Likewise Safer.Travel has no control over any fees that a hotel may pass on for luggage storage,
                        Sauna, spa and swimming pool use, car parking fees etc.
                        During the festive season, essentially Christmas and the New Year, there are hotels which impose a
                        compulsory gala and guests must pay any supplement for the gala dinner. Our company is not always
                        informed about Gala dinner supplements and Safer.Travel cannot be held responsible for any gala
                        supplements passed on by the hotel

                    </p>
                </div>




                <div class="mt-5">

                    <h2 _ngcontent-serverapp-c181="" class="d-flex align-items-center line-height-normal mb-4 pb-2"
                        style="border-bottom:1px solid #ddd ">
                        <i class="fa-solid fa-circle-arrow-right px-2"></i> <span>CANCELLATION AND AMENDMENT</span>
                    </h2>


                    <p class="px-2">We prefer that all cancellations and amendments are made on the Safer.Travel website.
                        Alternatively you can contact the Safer.Travel Reservation Team via e-mail or fax before the
                        cancellation deadline for that specific booking/hotel. We do not accept cancellations or amendments
                        over the telephone.
                        Safer.Travel will not be bound by nor responsible for any changes and cancellations made directly
                        with the hotel.
                        It is important to note that only one amendment per booking will be accepted. If you require further
                        amendments, please cancel and rebook with new details.
                        Any more than one amendment is not permitted and the booking will have to be cancelled and
                        re-booked. New rates may be applicable.
                        During special event periods, certain dates and early bird type bookings, the hotel may pass on a
                        different cancellation policy of which you will be informed as soon as Safer.Travel are notified.
                        In certain cases, name changes are nor permitted and the booking may need to be cancelled and
                        re-booked. In this case new rates may apply.
                        Any booking which offers free nights or early booking savings are liable to certain restrictions
                        which we will inform you about as soon as Safer.Travel are notified. Generally these restrictions
                        are; No name changes and no extension or reduction of nights. If you have booked a stay that
                        includes 1 night free and your client decides to cancel- The free night will not be refunded because
                        this is free.
                        Please note that nightly room rates might increase after a confirmed amendment even if you decrease
                        the number of nights. This might be either due to changes in currency exchange rates or promotions
                        on the original booking date.

                    </p>
                </div>


                <div class="mt-5">

                    <h2 _ngcontent-serverapp-c181="" class="d-flex align-items-center line-height-normal mb-4 pb-2"
                        style="border-bottom:1px solid #ddd ">
                        <i class="fa-solid fa-circle-arrow-right px-2"></i> <span>PROOF OF ID</span>
                    </h2>


                    <p class="px-2">To protect your Safer.Travel account - When a booking has been made by a 3rd party,
                        Safer.Travel reserves the right to request proof of ID from the credit cardholder as well as a
                        signed authorisation form.
                        This security measure is not to cause any inconvenience but merely to protect the credit card holder
                        against any credit card misuse.
                    </p>
                </div>



                <div class="mt-5">

                    <h2 _ngcontent-serverapp-c181="" class="d-flex align-items-center line-height-normal mb-4 pb-2"
                        style="border-bottom:1px solid #ddd ">
                        <i class="fa-solid fa-circle-arrow-right px-2"></i> <span>RELOCATION OF YOUR CLIENTS</span>
                    </h2>


                    <p class="px-2">If the original hotel booked is closed, over booked or has maintenance problems and
                        /or cannot provide the room(s) booked. You accept that the hotelier or supplier is responsible for
                        finding you alternate accommodation of a similar standard. Where we have prior notice Safer.Travel
                        will contact you by e.mail.
                        Safer.Travel accepts no liability for any losses or costs that might occur as a result of
                        re-location as this is completely beyond our control.
                        A booking is considered to be a group booking when there will be 10 or more pax travelling.
                        Safer.Travel reserve the right to cancel any FIT booking made for a group or if we consider them to
                        have been made for the purpose of holding space for future sale. Please submit your group request
                        using the Safer.Travel group page.

                    </p>
                </div>
                    <div class="mt-5">

                        <h2 _ngcontent-serverapp-c181="" class="d-flex align-items-center line-height-normal mb-4 pb-2"
                            style="border-bottom:1px solid #ddd ">
                            <i class="fa-solid fa-circle-arrow-right px-2"></i> <span>ON REQUEST RESERVATIONS</span>
                        </h2>


                        <p class="px-2">The hotels with “REQUEST” button and bookings with On Request Processing status
                            means that the hotel does not have any available allotment, however Safer.Travel will contact
                            the hotel to request extra space. Kindly be informed that in very rare occasions, the
                            availability at the hotel might change until the time you complete your booking and the final
                            status might turn to On Request Processing. In these cases, please do not attempt to book the
                            same hotel again. You will be informed within 48 hours if your booking has been confirmed or
                            rejected. If the hotel could be confirmed at a different rate, you will be advised. Please bear
                            in mind that the confirmation may not be guaranteed and the hotels have the right to reject ON
                            REQUEST bookings. If your accommodation request is urgent, it is suggested that you select a
                            hotel with Instant confirmation. Depending upon when a new search is made on Safer.Travel
                            system, you may see the same hotel appearing again. This is because space may have become
                            available although at different rates from when the initial request was made.
                        </p>


                        <div class="mt-5">

                            <h2 _ngcontent-serverapp-c181="" class="d-flex align-items-center line-height-normal mb-4 pb-2"
                                style="border-bottom:1px solid #ddd ">
                                <i class="fa-solid fa-circle-arrow-right px-2"></i> <span>HOTEL INFORMATION AND
                                    FACILITIES</span>
                            </h2>


                            <p class="px-2">Hotel information: While Safer.Travel strives to present hotel information as
                                accurately as possible, we are not responsible for the accuracy of this information or for
                                any facilities that may or may not be available at the hotel during your client's stay or
                                not suited to your client's individual tastes and preferences.
                                Redecoration/ renovations and maintenance are necessary to the upkeep of the hotel and may
                                take place without prior warning, however the hotelier will endeavour to keep inconvenience
                                to a minimum. The effects of normal wear and tear can be expected in a hotel and these are
                                beyond our control. Safer.Travel cannot accept responsibility for any disturbance or
                                inconvenience to your client beyond the hoteliers control nor for accidents or loss in a
                                hotel caused by hotel management or staff.
                                We have no control over any extra charges that a hotel may decide to implement for guest
                                room incidentals such as air conditioning, safe box, mini fridge, hire of television remote
                                etc...Any such charges must be paid direct to the hotel and Safer.Travel cannot be held
                                responsible for any incidental charges passed on by the hotel.
                                Hotel and guest room photographs are provided to give a general overview of the hotel. Guest
                                room photographs may be of a different category to the one you book and not identical to the
                                room your client(s) are allocated at the hotel.
                                All of the hotels on the Safer.Travel website require one of the guests to be at least 18
                                years old. In some states of America there are higher age limits. If you have booked a hotel
                                in the Unites States and the travellers are under 25 years of age please contact the hotel
                                directly for clarification.

                            </p>
                        </div>


                        <div class="mt-5">

                            <h2 _ngcontent-serverapp-c181=""
                                class="d-flex align-items-center line-height-normal mb-4 pb-2"
                                style="border-bottom:1px solid #ddd ">
                                <i class="fa-solid fa-circle-arrow-right px-2"></i> <span>MAP INFORMATION</span>
                            </h2>


                            <p class="px-2">Maps are provided for information purposes only. While Safer.Travel strives
                                to present hotel and map information as accurately as possible, we do not accept any
                                responsibility for the accuracy of this information or for any errors and/or omissions. We
                                suggest that you contact the hotel directly to obtain the most current and complete location
                                information and directions.
                            </p>
                        </div>



                        <div class="mt-5">

                            <h2 _ngcontent-serverapp-c181=""
                                class="d-flex align-items-center line-height-normal mb-4 pb-2"
                                style="border-bottom:1px solid #ddd ">
                                <i class="fa-solid fa-circle-arrow-right px-2"></i> <span>COMPLAINTS</span>
                            </h2>


                            <p class="px-2">Any complaint which cannot be resolved at the hotel must be notified to us by
                                logging into your Safer.Travel system and selecting the message category 'Complaint'. All
                                complaints must be notified to us within 20 days of the check out date.
                                A copy of the complaint must be also be submitted to and signed by the hotel manager.
                                Complaints relating to hotel services will be forwarded by Safer.Travel to the relevant
                                party.
                                Response times do vary from between 5-20 working days depending upon the nature of the query
                                in question.

                            </p>
                        </div>

                        <div class="mt-5">

                            <h2 _ngcontent-serverapp-c181=""
                                class="d-flex align-items-center line-height-normal mb-4 pb-2"
                                style="border-bottom:1px solid #ddd ">
                                <i class="fa-solid fa-circle-arrow-right px-2"></i> <span>VISA SUPPORT</span>
                            </h2>


                            <p class="px-2">
                            <ul>
                                <li>Safer.Travel will not be obliged to request any visa documents from the hotel for any
                                    bookings which have not been paid for in full.</li>
                                <li>Safer.Travel will request these visa documents from the hotel upon your acceptance of a
                                    10Eur charge in the event that you cancel the booking.</li>
                                <li>Safer.Travel will do the best to accomodate your request but it is not guaranteed that
                                    the hotel will respond to your visa document request.</li>
                                <li>Safer.Travel has no control over any charges that a hotel may implement for visa support
                                    documents.</li>
                                <li>In the event that a hotel implements charges for visa support documents, Safer.Travel
                                    expects that the agency will make the relevant payment direct to the hotel.</li>
                            </ul>

                            </p>
                        </div>
                        <div class="mt-5">

                            <h2 _ngcontent-serverapp-c181=""
                                class="d-flex align-items-center line-height-normal mb-4 pb-2"
                                style="border-bottom:1px solid #ddd ">
                                <i class="fa-solid fa-circle-arrow-right px-2"></i> <span>PROMOTIONS AND PROMOTIONAL
                                    RATES</span>
                            </h2>


                            <p class="px-2">Promotions are offered in good faith only. Some promotions are more popular
                                than others in which case the rooms featured will be sold out much quicker. Safer.Travel
                                reserves the right to modify or change any promotion or offer at any time without notice.
                                Please make a search for your requested dates for the most current rates.
                            </p>
                        </div>


                        <div class="mt-5">

                            <h2 _ngcontent-serverapp-c181=""
                                class="d-flex align-items-center line-height-normal mb-4 pb-2"
                                style="border-bottom:1px solid #ddd ">
                                <i class="fa-solid fa-circle-arrow-right px-2"></i> <span>GENERAL TERMS AND
                                    CONDITIONS</span>
                            </h2>


                            <p class="px-2">Telephone calls to Safer.Travel may be recorded to enable us to monitor and
                                improve our services.
                                Please contact us at info@Safer.Travel if you do not want to receive any promotional
                                e.mails/ Newsletters or special deals.
                                Safer.Travel shall not be liable for any failure in service relating from uncontrollable
                                circumstances such as flood, earthquake, riot, terrorist acts, acts of governments or
                                authority change in a country, bad weather conditions etc.
                                The climate differences and energy saving rules of different countries might affect the
                                heating systems at the hotel which is located at that particular area and/or country. For
                                instance, in Italy the heating system can only be operated between Nov 15 and March 15 due
                                to government regulations. Opening and closing dates of the swimming pools also might be
                                affected by the climate and weather conditions. Safer.Travel is not liable for the practices
                                of the hotels regarding to these issues.

                            </p>
                        </div>



                        <div class="mt-5">

                            <h2 _ngcontent-serverapp-c181=""
                                class="d-flex align-items-center line-height-normal mb-4 pb-2"
                                style="border-bottom:1px solid #ddd ">
                                <i class="fa-solid fa-circle-arrow-right px-2"></i> <span>TRANSFERS</span>
                            </h2>


                            <p class="px-2">
                            <ol>
                                <li>Transfers cannot be booked seperately.</li>
                                <li>Transfers can only be booked as an addition to hotel bookings.</li>
                                <li>No amendments of any kinds (date changes, name changes, flight number change, vehicle
                                    type change) are accepted. Transfers are non-amendable.</li>
                                <li>It is mandatory to enter valid and accurate flight details at the time of booking since
                                    it is not possible to amend.</li>
                                <li>Safer.Travel will not assume any responsibility in omissions and typo errors which may
                                    result in any interruption of the service.</li>
                            </ol>

                            </p>
                        </div>

                        <div class="mt-5">
                            <p class="px-2">
                                <strong> IMPORTANT - </strong> When the Safer.Travel member has completed the booking
                                online, they must check and make sure all the details on the pre paid accommodation voucher
                                (such as hotel address, hotel info, city and country details) are correct.
                                Use of the Safer.Travel website is subject to your acceptance of our terms and conditions.
                                If you do not accept these Terms and Conditions, you must refrain from using the website.
                            </p>
                        </div>
                    </div>
            </div>
        @else
        <div class="container__content">
            <div class="mt-1">
                <h2 _ngcontent-serverapp-c181="" class="d-flex align-items-center line-height-normal my-4 pb-2"
                    style="border-bottom:1px solid #ddd ">
                    <i class="fa-solid fa-circle-arrow-right px-2"></i> <span>تغيير في الشروط والأحكام الخاصة بنا</span>
                </h2>
                <p class="px-2">Safer.Travel تحتفظ لنفسها بالحق في تغيير وتعديل هذه الشروط والأحكام في أي وقت. ستكون التغييرات سارية بمجرد نشرها على موقع Safer.Travel.</p>
            </div>

            <div class="mt-5">
                <h2 _ngcontent-serverapp-c181="" class="d-flex align-items-center line-height-normal mb-4 pb-2"
                    style="border-bottom:1px solid #ddd ">
                    <i class="fa-solid fa-circle-arrow-right px-2"></i> <span>أسماء الأشخاص المسافرين</span>
                </h2>


                <p class="px-2">من المهم أن يقوم الشخص الذي يقوم بالحجز بإدخال الأسماء الصحيحة لجميع الأشخاص المسافرين. إذا تم إدخال TBA أو اختصار آخر كاسم الضيف، فيجوز للفندق رفض الحجز. يجب إدخال أسماء جميع الأشخاص المسافرين ويجب أن يتبع الاسم الأول اسم العائلة.</p>
            </div>

            <div class="mt-5">
                <h2 _ngcontent-serverapp-c181="" class="d-flex align-items-center line-height-normal mb-4 pb-2"
                    style="border-bottom:1px solid #ddd ">
                    <i class="fa-solid fa-circle-arrow-right px-2"></i> <span>حسابات البريد الإلكتروني</span>
                </h2>



                <p class="px-2">تقع على عاتق جميع أعضاء Safer.Travel مسؤولية التأكد من إدخالهم لعنوان بريد إلكتروني صحيح. إذا تم إرسال بريدنا الإلكتروني إلى مجلد البريد غير المهم أو المهمل، فيمكنك منع حدوث ذلك مرة أخرى عن طريق فتح بريدنا الإلكتروني والنقر على زر "ليس بريدًا عشوائيًا" أو "هذا ليس بريدًا عشوائيًا". </p>
            </div>

            <div class="mt-5">
                <h2 _ngcontent-serverapp-c181="" class="d-flex align-items-center line-height-normal mb-4 pb-2"
                    style="border-bottom:1px solid #ddd ">
                    <i class="fa-solid fa-circle-arrow-right px-2"></i> <span>أنواع الغرف</span>
                </h2>

                <p class="px-2">تقع على عاتق عضو Safer.Travel الذي يقوم بالحجز مسؤولية التأكد من أن نوع الغرفة المحجوزة سيكون مناسبًا للحفلة التي تسافر. إذا حضر عدد أكبر من الأشخاص في الفندق أكثر مما يمكن للغرفة أن تستوعبه، فسيكون للفندق حق عدم قبول الحجز وفي هذه الحالة لن يتم استرداد أي مبلغ.
                    بينما يتعهد Safer.Travel بضمان أن يطلب عملاؤك نوع الغرفة وتفضيلات التدخين المتاحة، لا يمكن لـ Safer.Travel ضمان تكوين الفراش الفعلي للغرفة. يتم إرسال هذه الطلبات إلى الفندق وهي رهن بالتوافر.
                    يحاول Safer.Travel التأكد من أن الفندق يوفر نوع (أنواع) الغرف المحجوزة، ولكن قد تكون هناك مناسبات عندما يتم تخصيص غرفة مزدوجة أو غرفة مزدوجة بدلاً من غرفة مزدوجة بدلاً من غرفة مزدوجة. يرجى العلم أن غالبية الفنادق الأوروبية توفر سريرين مفردين مدمجين معًا لتكوين سرير مزدوج. بينما يتم إعادة توجيه جميع تفضيلات نوع الغرفة إلى الفندق، يتم تخصيص الغرف بواسطة الفندق ويخضع للتوافر في وقت تسجيل الوصول.
                    فئات الفنادق / التصنيف والتصنيفات المحلية
                    تهدف تصنيفات النجوم إلى إعطاء لمحة عامة عن جودة الفندق والمستوى التقريبي للمرافق والخدمات والمرافق المتاحة. ومع ذلك، فإن نظام التصنيف هذا يختلف من بلد إلى آخر. على سبيل المثال، لن يكون فندق 5 نجوم في بانكوك هو نفسه فندق 5 نجوم في لندن. Safer.Travel ليست مسؤولة عن فئات الفنادق والتقييمات * حيث تم توفيرها لنا وقبولها بحسن نية.

                </p>
            </div>

            <div class="mt-5">

                <h2 _ngcontent-serverapp-c181="" class="d-flex align-items-center line-height-normal mb-4 pb-2"
                    style="border-bottom:1px solid #ddd ">
                    <i class="fa-solid fa-circle-arrow-right px-2"></i> <span>الدفع والأسعار</span>
                </h2>


                <p class="px-2">تتغير أسعار صرف العملات بشكل عام على أساس يومي اعتمادًا على تقلبات السوق. يحتفظ Safer.Travel بالحق في تحديث أسعار الغرف المعروضة على موقع الويب وفقًا لتقلبات السوق.
                    لن تؤثر أي تغييرات تتعلق بتقلبات أسعار صرف العملات على أسعار حجز تم تأكيده بالفعل. وبالمثل، بمجرد أن يتم حجز الحجز وتأكيده بالأسعار التي قبلتها، لا يمكن استرداد أي فرق في الأسعار بسبب تقلبات أسعار الصرف.
                    جميع الأسعار صالحة لسوق الترفيه فقط. لن يقبل Safer.Travel المسؤولية عن أي حجز إذا أصبح معروفًا أن العميل لا يسافر لأغراض الترفيه. قد ترفض الفنادق احترام سعر العقد الخاص بنا وفرض سعر الرف على العملاء مباشرة.
                    الأسعار تشمل ضرائب الفندق المطبقة. قد لا يتم تضمين ضرائب السياحة / المحلية / المدينة التي تتضمن عمومًا استخدام الخدمات المحلية. إذا كان يلزم دفع ضريبة المدينة في الفندق، فستظهر هذه المعلومات في الملاحظات والقسيمة.
                    الأهمية
                    سيظهر اسم شركتنا باسم Safer.Travel LLC في بيان بطاقة الائتمان الخاصة ببطاقة الائتمان المستخدمة في إجراء الحجز. إذا استخدم عضو Safer.Travel بطاقة ائتمان عملائه لإجراء حجز الفندق، فمن مسؤولية عضو Safer.Travel إبلاغ عملائه بهذه المعلومات المهمة لتجنب أي سوء فهم.
                    يحتفظ Safer.Travel بالحق في تصحيح أي أسعار أو أخطاء و / أو سهو معروض. يتضمن ذلك الأخطاء و / أو السهو التي تم إدخالها من قبل صاحب فندق أو وكيل محلي. في حالة وجود خطأ في السعر و / أو إغفال، سوف نعرض عليك الاختيار بين الاحتفاظ بالحجز بالأسعار الصحيحة، أو إلغاء الحجز أو حسب التوافر، سنقدم لك فندقًا بديلاً مناسبًا.
                     </p>
            </div>


            <div class="mt-5">

                <h2 _ngcontent-serverapp-c181="" class="d-flex align-items-center line-height-normal mb-4 pb-2"
                    style="border-bottom:1px solid #ddd ">
                    <i class="fa-solid fa-circle-arrow-right px-2"></i> <span>أسعار السوق المحلية</span>
                </h2>


                <p class="px-2">  لا يتم عرض جميع أسعار الفنادق على موقع Safer.Travel الإلكتروني المطبقة على السوق المحلي. بالإضافة إلى ذلك، قد تتأثر بعض الأسواق الأخرى وفي مثل هذه الحالات يحق للفندق تغيير الأسعار دون إشعار مسبق.
                    أنت توافق على أن إعلان جنسية المسافر إلزامي ويجب تحديده عن طريق تحديد جنسية العميل في وقت الحجز. يجب أن تكون هذه المعلومات متوافقة مع جواز سفر الراكب. قد يؤدي الإعلان الكاذب عن جنسية الركاب إلى عواقب لا يمكن أن نتحمل المسؤولية عنها. إذا لم تقم بتغيير جنسية العميل، فسيتم اعتبار جنسية الوكالة كجنسية ركاب بشكل افتراضي. في حالة حدوث أي ضرر مالي يحدث بسبب إعلان جنسية كاذب، ستتم تغطيته من قبل الوكالة تجاه عملائك أو لنا بالكامل.

                </p>
            </div>




            <div class="mt-5">

                <h2 _ngcontent-serverapp-c181="" class="d-flex align-items-center line-height-normal mb-4 pb-2"
                    style="border-bottom:1px solid #ddd ">
                    <i class="fa-solid fa-circle-arrow-right px-2"></i> <span>رسوم المنتجع والمعاملات الدولية</span>
                </h2>


                <p class="px-2">يتقاضى غالبية مزودي بطاقات الائتمان نوعًا من رسوم المعاملات الدولية. يمكن أن يصل هذا إلى 3 ٪ على الرغم من أن Capital One لا يفرض رسومًا خاصة به فحسب، بل يأكل أيضًا رسوم 1 ٪ التي تفرضها Visa أو MasterCard. يتم تمرير هذه الرسوم من قبل موفري بطاقات ائتمان معينين لأنه تمت معالجة رسوم حجزك خارج البلد الذي تقيم فيه. يرجى ملاحظة أن Safer.Travel لم يتم تمرير هذه الرسوم وأنه لا يمكن حجز Safer.Travel مسؤول عن أي رسوم معاملات دولية تفرضها جهة إصدار بطاقة الائتمان الخاصة بك أو لعملائك.
                    تفرض بعض الفنادق، خاصة في الولايات المتحدة الأمريكية، رسوم منتجع يجب دفعها للفندق مباشرةً. هذا عادة ما يكون من 10 دولارات إلى 20 دولارًا للغرفة في الليلة. Safer.Travel غير مسؤول عن رسوم المنتجع وليس له سيطرة على تنفيذها.
                    رسوم إضافية من قبل الفندق
                    لا يتحكم Safer.Travel في أي رسوم إضافية قد يقرر الفندق تنفيذها لتغطية نفقات غرفة الضيوف الطارئة مثل تكييف الهواء، وخزنة، وثلاجة صغيرة، واستئجار جهاز التحكم عن بعد في التلفزيون، وما إلى ذلك ... يجب دفع أي رسوم من هذا القبيل مباشرة إلى الفندق و Safer.Travel لا يمكن أن يكون مسؤولاً عن أي رسوم عرضية يفرضها الفندق.
                    وبالمثل، فإن Safer.Travel لا يتحكم في أي رسوم قد يفرضها الفندق على تخزين الأمتعة، والساونا، واستخدام المنتجع الصحي وحمام السباحة، ورسوم مواقف السيارات وما إلى ذلك.
                    خلال موسم الأعياد، وخاصة عيد الميلاد ورأس السنة الجديدة، هناك فنادق تفرض حفلًا إلزاميًا ويجب على الضيوف دفع أي رسوم إضافية مقابل حفل العشاء. لا يتم إبلاغ شركتنا دائمًا بمكملات حفل العشاء ولا يمكن تحميل Safer.Travel المسؤولية عن أي مكملات احتفالية ينقلها الفندق.

                </p>
            </div>

            <div class="mt-5">

                <h2 _ngcontent-serverapp-c181="" class="d-flex align-items-center line-height-normal mb-4 pb-2"
                    style="border-bottom:1px solid #ddd ">
                    <i class="fa-solid fa-circle-arrow-right px-2"></i> <span> رسوم إضافية من قبل الفندق  </span>
                </h2>


                <p class="px-2">لا يتحكم Safer.Travel في أي رسوم إضافية قد يقرر الفندق تنفيذها لتغطية نفقات غرفة الضيوف الطارئة مثل تكييف الهواء، وخزنة، وثلاجة صغيرة، واستئجار جهاز التحكم عن بعد في التلفزيون، وما إلى ذلك ... يجب دفع أي رسوم من هذا القبيل مباشرة إلى الفندق و Safer.Travel لا يمكن أن يكون مسؤولاً عن أي رسوم عرضية يفرضها الفندق.
                    وبالمثل، فإن Safer.Travel لا يتحكم في أي رسوم قد يفرضها الفندق على تخزين الأمتعة، والساونا، واستخدام المنتجع الصحي وحمام السباحة، ورسوم مواقف السيارات وما إلى ذلك.
                    خلال موسم الأعياد، وخاصة عيد الميلاد ورأس السنة الجديدة، هناك فنادق تفرض حفلًا إلزاميًا ويجب على الضيوف دفع أي رسوم إضافية مقابل حفل العشاء. لا يتم إبلاغ شركتنا دائمًا بمكملات حفل العشاء ولا يمكن تحميل Safer.Travel المسؤولية عن أي مكملات احتفالية ينقلها الفندق.

                </p>
            </div>

            <div class="mt-5">

                <h2 _ngcontent-serverapp-c181="" class="d-flex align-items-center line-height-normal mb-4 pb-2"
                    style="border-bottom:1px solid #ddd ">
                    <i class="fa-solid fa-circle-arrow-right px-2"></i> <span>الإلغاء والتعديل</span>
                </h2>


                <p class="px-2">نفضل أن تتم جميع الإلغاءات والتعديلات على موقع Safer.Travel. بدلاً من ذلك، يمكنك الاتصال بفريق الحجز Safer.Travel عبر البريد الإلكتروني أو الفاكس قبل الموعد النهائي للإلغاء لهذا الحجز / الفندق المحدد. لا نقبل الإلغاءات أو التعديلات عبر الهاتف.
                    Safer.Travel لن يكون ملزمًا أو مسؤولاً عن أي تغييرات وإلغاءات تتم مباشرة مع الفندق.
                    من المهم ملاحظة أنه سيتم قبول تعديل واحد فقط لكل حجز. إذا كنت بحاجة إلى مزيد من التعديلات، فيرجى الإلغاء وإعادة الحجز بتفاصيل جديدة.
                    لا يُسمح بأي أكثر من تعديل واحد وسيتعين إلغاء الحجز وإعادة الحجز. قد تكون معدلات جديدة قابلة للتطبيق.
                    خلال فترات الأحداث الخاصة وتواريخ معينة والحجوزات المبكرة، قد يمر الفندق بسياسة إلغاء مختلفة سيتم إبلاغك بها بمجرد إخطار Safer.Travel.
                    في حالات معينة، لا يُسمح بتغيير الاسم وقد يلزم إلغاء الحجز وإعادة الحجز. في هذه الحالة قد يتم تطبيق معدلات جديدة.
                    أي حجز يقدم ليالي مجانية أو مدخرات للحجز المبكر يخضع لقيود معينة سنبلغك بها بمجرد إخطار Safer.Travel. بشكل عام هذه القيود هي؛ لا تغيير في الاسم ولا تمديد أو تقليل الليالي. إذا كنت قد حجزت إقامة تشمل ليلة واحدة مجانًا وقرر عميلك الإلغاء - لن يتم استرداد قيمة الليلة المجانية لأنها مجانية.
                    يرجى ملاحظة أن أسعار الغرف الليلية قد ترتفع بعد تعديل مؤكد حتى إذا قمت بتقليل عدد الليالي. قد يكون هذا إما بسبب التغييرات في أسعار صرف العملات أو العروض الترويجية في تاريخ الحجز الأصلي.


                </p>
            </div>



            <div class="mt-5">

                <h2 _ngcontent-serverapp-c181="" class="d-flex align-items-center line-height-normal mb-4 pb-2"
                    style="border-bottom:1px solid #ddd ">
                    <i class="fa-solid fa-circle-arrow-right px-2"></i> <span>إثبات الهوية</span>
                </h2>


                <p class="px-2">لحماية حساب Safer.Travel الخاص بك - عندما يتم إجراء حجز من قبل طرف ثالث، تحتفظ Safer.Travel بالحق في طلب إثبات الهوية من حامل بطاقة الائتمان وكذلك نموذج تفويض موقع.
                    هذا الإجراء الأمني لا يسبب أي إزعاج ولكن فقط لحماية حامل بطاقة الائتمان من أي إساءة استخدام لبطاقة الائتمان.
                    نقل عملائك
                    إذا كان الفندق الأصلي المحجوز مغلقًا أو تم حجزه بشكل زائد أو به مشاكل في الصيانة و / أو لا يمكنه توفير الغرفة (الغرف) المحجوزة. أنت تقبل أن يكون صاحب الفندق أو المورد مسؤولاً عن إيجاد سكن بديل لك من نفس المستوى. عندما يكون لدينا إشعار مسبق، سوف يتصل بك Safer.Travel عبر البريد الإلكتروني.
                    Safer.Travel لا يتحمل أي مسؤولية عن أي خسائر أو تكاليف قد تحدث نتيجة لإعادة الموقع لأن هذا خارج عن سيطرتنا تمامًا.
                    يعتبر الحجز بمثابة حجز جماعي عندما يكون هناك 10 أشخاص أو أكثر مسافرون. يحتفظ Safer.Travel بالحق في إلغاء أي حجز FIT تم إجراؤه لمجموعة أو إذا اعتبرنا أنه تم لغرض الاحتفاظ بمساحة للبيع في المستقبل. يرجى تقديم طلب مجموعتك باستخدام صفحة مجموعة Safer.Travel.
                    عند طلب الحجوزات
                    الفنادق التي بها زر "طلب" والحجوزات ذات حالة المعالجة عند الطلب تعني أن الفندق ليس لديه أي تخصيص متاح، ومع ذلك سيتصل Safer.Travel بالفندق لطلب مساحة إضافية.

                    يرجى العلم أنه في حالات نادرة جدًا، قد يتغير التوافر في الفندق حتى وقت إكمال الحجز وقد تتحول الحالة النهائية إلى عند معالجة الطلب. في هذه الحالات، يرجى عدم محاولة حجز نفس الفندق مرة أخرى. سيتم إبلاغك في غضون 48 ساعة إذا تم تأكيد حجزك أو رفضه. إذا كان من الممكن تأكيد الفندق بسعر مختلف، فسيتم إبلاغك بذلك. يرجى الأخذ في الاعتبار أنه قد لا يتم ضمان التأكيد وأن الفنادق لها الحق في رفض الحجوزات عند الطلب. إذا كان طلب الإقامة الخاص بك عاجلاً، فمن المقترح أن تختار فندقًا بتأكيد فوري. اعتمادًا على وقت إجراء بحث جديد على نظام Safer.Travel ، قد ترى نفس الفندق يظهر مرة أخرى. هذا لأن المساحة ربما أصبحت متاحة على الرغم من أن معدلاتها مختلفة عن وقت تقديم الطلب الأولي.


                </p>
            </div>


            <div class="mt-5">

                <h2 _ngcontent-serverapp-c181="" class="d-flex align-items-center line-height-normal mb-4 pb-2"
                    style="border-bottom:1px solid #ddd ">
                    <i class="fa-solid fa-circle-arrow-right px-2"></i> <span>معلومات الفنادق والمرافق</span>
                </h2>


                <p class="px-2">معلومات الفندق: بينما يسعى Safer.Travel جاهدًا لتقديم معلومات الفندق بأكبر قدر ممكن من الدقة، فإننا لسنا مسؤولين عن دقة هذه المعلومات أو عن أي مرافق قد تكون أو لا تكون متاحة في الفندق أثناء إقامة العميل أو غير مناسبة لك الأذواق والتفضيلات الفردية للعميل.
                    تعتبر إعادة الديكور / التجديدات والصيانة ضرورية لصيانة الفندق ويمكن أن تتم دون سابق إنذار، ومع ذلك سيحاول صاحب الفندق تقليل الإزعاج إلى الحد الأدنى. يمكن توقع آثار الاهتراء العادي في فندق وهي خارجة عن إرادتنا. لا يمكن لـ Safer.Travel قبول المسؤولية عن أي إزعاج أو إزعاج لعميلك خارج نطاق سيطرة أصحاب الفنادق ولا عن الحوادث أو الخسارة في الفندق بسبب إدارة الفندق أو الموظفين.
                    ليس لدينا أي سيطرة على أي رسوم إضافية قد يقرر الفندق تنفيذها لنفقات غرف النزلاء مثل تكييف الهواء، وخزنة آمنة، وثلاجة صغيرة، واستئجار جهاز التحكم عن بعد في التلفزيون، وما إلى ذلك ... يجب دفع أي رسوم من هذا القبيل مباشرةً إلى الفندق و Safer.Travel لا يمكن أن يكون مسؤولاً عن أي رسوم عرضية يفرضها الفندق.
                    يتم توفير صور الفندق وغرف النزلاء لإعطاء لمحة عامة عن الفندق. قد تكون صور غرفة الضيوف من فئة مختلفة عن تلك التي تحجزها وليست متطابقة مع الغرفة المخصصة لعميلك (عملائك) في الفندق.
                    تتطلب جميع الفنادق الموجودة على موقع Safer.Travel ألا يقل عمر أحد الضيوف عن 18 عامًا. في بعض الولايات الأمريكية توجد حدود عمرية أعلى. إذا كنت قد حجزت فندقًا في الولايات المتحدة وكان عمر المسافرين أقل من 25 عامًا، فيرجى الاتصال بالفندق مباشرةً للحصول على توضيح.


                </p>
            </div>




            <div class="mt-5">

                <h2 _ngcontent-serverapp-c181="" class="d-flex align-items-center line-height-normal mb-4 pb-2"
                    style="border-bottom:1px solid #ddd ">
                    <i class="fa-solid fa-circle-arrow-right px-2"></i> <span>معلومات الخريطة</span>
                </h2>


                <p class="px-2">يتم توفير الخرائط لأغراض المعلومات فقط. بينما يسعى Safer.Travel لتقديم معلومات عن الفندق والخريطة بأكبر قدر ممكن من الدقة، فإننا لا نتحمل أي مسؤولية عن دقة هذه المعلومات أو عن أي أخطاء و / أو سهو. نقترح عليك الاتصال بالفندق مباشرةً للحصول على أحدث معلومات وإرشادات الموقع الكاملة والأكثر اكتمالاً.

                </p>
            </div>


            <div class="mt-5">

                <h2 _ngcontent-serverapp-c181="" class="d-flex align-items-center line-height-normal mb-4 pb-2"
                    style="border-bottom:1px solid #ddd ">
                    <i class="fa-solid fa-circle-arrow-right px-2"></i> <span>شكاوى</span>
                </h2>


                <p class="px-2">يجب إخطارنا بأي شكوى لا يمكن حلها في الفندق عن طريق تسجيل الدخول إلى نظام Safer.Travel الخاص بك واختيار فئة الرسالة "شكوى". يجب إخطارنا بجميع الشكاوى في غضون 20 يومًا من تاريخ المغادرة.
                    يجب أيضًا تقديم نسخة من الشكوى إلى مدير الفندق وتوقيعها. سيتم إرسال الشكاوى المتعلقة بالخدمات الفندقية بواسطة Safer.Travel إلى الطرف ذي الصلة.
                    تختلف أوقات الاستجابة من 5 إلى 20 يوم عمل حسب طبيعة الاستعلام المعني.

                </p>
            </div>



            <div class="mt-5">

                <h2 _ngcontent-serverapp-c181="" class="d-flex align-items-center line-height-normal mb-4 pb-2"
                    style="border-bottom:1px solid #ddd ">
                    <i class="fa-solid fa-circle-arrow-right px-2"></i> <span>دعم التأشيرة</span>
                </h2>


                <p class="px-2">
                    - لن يكون Safer.Travel ملزمًا بطلب أي وثائق تأشيرة من الفندق لأي حجوزات لم يتم دفع ثمنها بالكامل.
                    - سيطلب Safer.Travel مستندات التأشيرة هذه من الفندق عند موافقتك على رسوم 10Eur في حالة إلغاء الحجز.
                    - سوف يبذل Safer.Travel قصارى جهده لتلبية طلبك ولكن ليس من المضمون أن يستجيب الفندق لطلب مستند التأشيرة الخاص بك.
                    - لا يتحكم Safer.Travel في أي رسوم قد يفرضها الفندق على مستندات دعم التأشيرة.
                    - في حالة قيام فندق بفرض رسوم على مستندات دعم التأشيرة ، يتوقع Safer.Travel أن تقوم الوكالة بتسديد الدفعة ذات الصلة مباشرة إلى الفندق.
                    الترقيات والأسعار الترويجية
                    يتم تقديم العروض الترويجية بحسن نية فقط. بعض العروض الترويجية أكثر شيوعًا من غيرها وفي هذه الحالة سيتم بيع الغرف المعروضة بشكل أسرع. يحتفظ Safer.Travel بالحق في تعديل أو تغيير أي ترويج أو عرض في أي وقت دون إشعار. يرجى البحث عن التواريخ المطلوبة للحصول على أحدث الأسعار.

                </p>
            </div>
                <div class="mt-5">

                    <h2 _ngcontent-serverapp-c181="" class="d-flex align-items-center line-height-normal mb-4 pb-2"
                        style="border-bottom:1px solid #ddd ">
                        <i class="fa-solid fa-circle-arrow-right px-2"></i> <span>الاحكام والشروط العامة</span>
                    </h2>


                    <p class="px-2">قد يتم تسجيل المكالمات الهاتفية إلى Safer.Travel لتمكيننا من مراقبة خدماتنا وتحسينها.
                        يرجى الاتصال بنا على info@Safer.Travel إذا كنت لا ترغب في تلقي أي رسائل بريد إلكتروني ترويجية / رسائل إخبارية أو عروض خاصة.
                        لن يكون Safer.Travel مسؤولاً عن أي فشل في الخدمة يتعلق بظروف لا يمكن السيطرة عليها مثل الفيضانات والزلازل، وأفعال الحكومات أو تغيير السلطة في بلد ما، والظروف الجوية السيئة، وما إلى ذلك.
                        قد تؤثر الاختلافات المناخية وقواعد توفير الطاقة في مختلف البلدان على أنظمة التدفئة في الفندق الذي يقع في تلك المنطقة و / أو البلد المعين. على سبيل المثال، في إيطاليا، لا يمكن تشغيل نظام التدفئة إلا بين 15 نوفمبر و15 مارس بسبب اللوائح الحكومية. قد تتأثر مواعيد افتتاح وإغلاق حمامات السباحة أيضًا بالمناخ والظروف الجوية. Safer.Travel غير مسؤول عن ممارسات الفنادق فيما يتعلق بهذه القضايا.
                        التحويلات
                        1- لا يمكن حجز الانتقالات بشكل منفصل.
                        2- لا يمكن حجز الانتقالات إلا كإضافة إلى حجوزات الفنادق.
                        3- لا تقبل أي تعديلات من أي نوع (تغيير التاريخ، تغيير الاسم، تغيير رقم الرحلة، تغيير نوع السيارة). التحويلات غير قابلة للتعديل.
                        4- من الضروري إدخال تفاصيل رحلة طيران صحيحة ودقيقة في وقت الحجز حيث لا يمكن تعديلها.
                        5.Safer.Travel لن يتحمل أي مسؤولية عن السهو والأخطاء المطبعية التي قد تؤدي إلى أي انقطاع في الخدمة.
                        هام - عندما يكمل عضو Safer.Travel الحجز عبر الإنترنت، يجب عليه التحقق والتأكد من صحة جميع التفاصيل الموجودة في قسيمة الإقامة المدفوعة مسبقًا (مثل عنوان الفندق ومعلومات الفندق وتفاصيل المدينة والبلد).
                        يخضع استخدام موقع Safer.Travel لموافقتك على الشروط والأحكام الخاصة بنا. إذا كنت لا تقبل هذه الشروط والأحكام، يجب عليك الامتناع عن استخدام الموقع.

                    </p>

                </div>

                    <div class="mt-5">
                        <p class="px-2">
                            <strong> أوافق  - </strong> إذا كنت لا تفهم تمامًا أو لا تقبل هذه الشروط والأحكام، فيرجى عدم "قبول" ولكن اتصل بنا للحصول على توضيح.
                        </p>
                    </div>
                </div>
        </div>
        @endif


        </section>
        {{-- </main> --}}
    </section>
@endsection
