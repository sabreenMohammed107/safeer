@extends('layout.website.layout', ['Company' => $Company, 'title' => 'Safer | About Us'])

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
    <x-website.header.general title="Terms & Conditions" :breadcrumb="$BreadCrumb" current="" />
@endsection
@section('content')
<section class="investigtion">
{{-- <main class="wrap"> --}}
    <section class="container">
      {{-- <div class="container__heading">
        <h2>Terms & Conditions</h2>

      </div> --}}

      <div class="container__content">
        <div class="mt-1">
            <h2 _ngcontent-serverapp-c181="" class="d-flex align-items-center line-height-normal my-4 pb-2" style="border-bottom:1px solid #ddd ">
                <i class="fa-solid fa-circle-arrow-right px-2"></i> <span>CHANGE IN OUR TERMS AND CONDITIONS</span></h2>
            <p class="px-2">Safer.Travel reserves the right to change and modify these terms and conditions at any time. Changes will be effective as soon as they are published on the Safer.Travel website </p>
        </div>

        <div class="mt-5">
       <h2 _ngcontent-serverapp-c181="" class="d-flex align-items-center line-height-normal mb-4 pb-2" style="border-bottom:1px solid #ddd ">
            <i class="fa-solid fa-circle-arrow-right px-2"></i> <span>NAMES OF PERSONS TRAVELLING</span></h2>


        <p class="px-2">It is important that the person making the booking must enter the correct names of all persons travelling. If TBA or another abbreviation has been entered as the guest's name, the hotel may reject the booking. The names of all persons travelling must be entered and the first name should be followed by the Family name.</p>
    </div>

    <div class="mt-5">
        <h2 _ngcontent-serverapp-c181="" class="d-flex align-items-center line-height-normal mb-4 pb-2" style="border-bottom:1px solid #ddd ">
            <i class="fa-solid fa-circle-arrow-right px-2"></i> <span>E.MAIL ACCOUNTS</span></h2>



        <p class="px-2">It is the responsibility of all Safer.Travel members to ensure they have entered a correct e.mail address. If our e.mail has been sent to your Junk or Bulk mail folder, you can prevent this from happening again by opening our e.mail and clicking on the 'not spam' or 'this is not spam' button. </p>
    </div>

    <div class="mt-5">
         <h2 _ngcontent-serverapp-c181="" class="d-flex align-items-center line-height-normal mb-4 pb-2" style="border-bottom:1px solid #ddd ">
            <i class="fa-solid fa-circle-arrow-right px-2"></i> <span>ROOM TYPES</span></h2>

        <p class="px-2">It is the responsibility of the Safer.Travel member making the booking to ensure that the room type booked will be suitable for the party traveling. If more persons turn up at the hotel than the room can accommodate then the hotel are within their rights not to accept the booking and in this case no refund will be made.
            While Safer.Travel undertake to ensure that your clients requested room type and smoking preference is available, Safer.Travel cannot guarantee the actual bedding make-up of the room. These requests are sent to the hotel and are subject to availability.
            Safer.Travel try to ensure that the hotel provides the room type(s) booked, however there may be occasions when instead of a double-bedded room a twin may be allocated or a double -bedded room instead of a twin. Please be aware that the majority of European hotels provide 2 single beds pushed together to make a Double bed. While all room type preferences are forwarded to the hotel, room allocation is done by the hotel and subject to availability at the time of check in.
             </p>
            </div>

            <div class="mt-5">

             <h2 _ngcontent-serverapp-c181="" class="d-flex align-items-center line-height-normal mb-4 pb-2" style="border-bottom:1px solid #ddd ">
            <i class="fa-solid fa-circle-arrow-right px-2"></i> <span>HOTEL CATEGORIES/ LOCAL CLASSIFICATION AND * RATINGS</span></h2>


        <p class="px-2">Star ratings aim to give a general overview of the quality of the hotel and approximate level of facilities, services and amenities available. However this rating system does vary from country to country. For example a 5* Bangkok hotel will not be the same as a 5* London hotel. Safer.Travel are not responsible for the hotel categories and * ratings as these have been provided to us and accepted in good faith. </p>
    </div>

{{-- con --}}
    <div class="mt-5">

        <h2 _ngcontent-serverapp-c181="" class="d-flex align-items-center line-height-normal mb-4 pb-2" style="border-bottom:1px solid #ddd ">
       <i class="fa-solid fa-circle-arrow-right px-2"></i> <span>PAYMENT AND RATES</span></h2>


   <p class="px-2">Currency exchange rates generally change on daily basis depending on the fluctuations in the market. Safer.Travel reserve the right to update room rates displayed on the website depending on any market fluctuations.
    Any changes relating to currency exchange rate fluctuations will not affect the rates of an already confirmed booking. Likewise, once a booking has been booked and confirmed at the rates you have accepted, there is no refund for any difference in rates due to exchange rate fluctuations.
    All rates are valid for the leisure market only. Safer.Travel will not accept responsibility for any booking if it becomes known that a client is not travelling for leisure purposes. Hotels may refuse to honour our contract rate and charge rack rate to the clients directly.
    Rates include applicable hotel taxes. Tourist/local/city taxes which generally include the use of local services may not be included. If city tax needs to be paid at the hotel, this info is shown in Remarks and on the voucher.
    </p>
</div>




<div class="mt-5">

    <h2 _ngcontent-serverapp-c181="" class="d-flex align-items-center line-height-normal mb-4 pb-2" style="border-bottom:1px solid #ddd ">
   <i class="fa-solid fa-circle-arrow-right px-2"></i> <span>IMPORTANT</span></h2>


<p class="px-2">Our company name will appear as Safer.Travel LLC on the credit card statement of the credit card used to make the booking. If a Safer.Travel member has used their clients credit card to make the hotel booking then it is the responsibility of the Safer.Travel member to inform their customer of this important information in order to avoid any misunderstandings.
    Safer.Travel reserve the right to correct any pricing or displayed errors and/or omissions. This includes errors and/or omissions which have been entered by a hotelier or local agent. In the event of a price error and/or omission, we will offer you the choice of either keeping the booking at the correct rates, cancelling the booking or subject to availability we will offer you a suitable alternate hotel.
    </p>
</div>



<div class="mt-5">

    <h2 _ngcontent-serverapp-c181="" class="d-flex align-items-center line-height-normal mb-4 pb-2" style="border-bottom:1px solid #ddd ">
   <i class="fa-solid fa-circle-arrow-right px-2"></i> <span>LOCAL MARKET RATES</span></h2>


<p class="px-2">Not all of the hotel rates are displayed on the Safer.Travel website are applicable for the local market. In addition some other markets may be affected and in such cases the hotel is within their rights to change the rates without prior notice.
    You agree that passenger nationality declaration is mandatory and must be determined by selecting Client Nationality at the time of booking. This information must be in accordance with the passenger passport. False declaration of passenger nationality may cause consequences for which we cannot be held liable. If you do not change Client Nationality, Agency Nationality will be taken as passenger nationality by default. In case, any financial damage occurs due to false nationality declaration, it will be covered by the agency towards your customers or to us in full.

    </p>
</div>



<div class="mt-5">

    <h2 _ngcontent-serverapp-c181="" class="d-flex align-items-center line-height-normal mb-4 pb-2" style="border-bottom:1px solid #ddd ">
   <i class="fa-solid fa-circle-arrow-right px-2"></i> <span>RESORT AND INTERNATIONAL TRANSACTION FEES</span></h2>


<p class="px-2">The majority of credit card providers charge some sort of an International Transaction fee. This can be as much as 3% although Capital One not only doesn't impose its own fee, but it also eats the 1% fee that Visa or MasterCard impose. This fee is passed on by certain credit card providers because the charge for your booking has been processed outside of the country that you reside in. Please note that the charge has not been passed on by Safer.Travel and that Safer.Travel cannot be held responsible for any international transaction charges passed on by
    your or your clients credit card issuer.
Some hotels, particularly in the USA do charge a resort fee which must be paid to the hotel directly. This is typically $10 to $20 a room a night. Safer.Travel is not responsible for resort fee charges and have no control over their implementation

</p>
</div>


<div class="mt-5">

    <h2 _ngcontent-serverapp-c181="" class="d-flex align-items-center line-height-normal mb-4 pb-2" style="border-bottom:1px solid #ddd ">
   <i class="fa-solid fa-circle-arrow-right px-2"></i> <span>ADDITIONAL CHARGES MADE BY THE HOTEL</span></h2>


<p class="px-2">Safer.Travel has no control over any extra charges that a hotel may decide to their implement for guest room incidentals such as air conditioning, safe, mini fridge, hire of television remote etc... Any such charges must be paid direct to the hotel and Safer.Travel cannot be held responsible for any incidental charges passed on by the hotel.
    Likewise Safer.Travel has no control over any fees that a hotel may pass on for luggage storage, Sauna, spa and swimming pool use, car parking fees etc.
    During the festive season, essentially Christmas and the New Year, there are hotels which impose a compulsory gala and guests must pay any supplement for the gala dinner. Our company is not always informed about Gala dinner supplements and Safer.Travel cannot be held responsible for any gala supplements passed on by the hotel

</p>
</div>




<div class="mt-5">

    <h2 _ngcontent-serverapp-c181="" class="d-flex align-items-center line-height-normal mb-4 pb-2" style="border-bottom:1px solid #ddd ">
   <i class="fa-solid fa-circle-arrow-right px-2"></i> <span>CANCELLATION AND AMENDMENT</span></h2>


<p class="px-2">We prefer that all cancellations and amendments are made on the Safer.Travel website. Alternatively you can contact the Safer.Travel Reservation Team via e-mail or fax before the cancellation deadline for that specific booking/hotel. We do not accept cancellations or amendments over the telephone.
    Safer.Travel will not be bound by nor responsible for any changes and cancellations made directly with the hotel.
    It is important to note that only one amendment per booking will be accepted. If you require further amendments, please cancel and rebook with new details.
    Any more than one amendment is not permitted and the booking will have to be cancelled and re-booked. New rates may be applicable.
    During special event periods, certain dates and early bird type bookings, the hotel may pass on a different cancellation policy of which you will be informed as soon as Safer.Travel are notified.
    In certain cases, name changes are nor permitted and the booking may need to be cancelled and re-booked. In this case new rates may apply.
    Any booking which offers free nights or early booking savings are liable to certain restrictions which we will inform you about as soon as Safer.Travel are notified. Generally these restrictions are; No name changes and no extension or reduction of nights. If you have booked a stay that includes 1 night free and your client decides to cancel- The free night will not be refunded because this is free.
    Please note that nightly room rates might increase after a confirmed amendment even if you decrease the number of nights. This might be either due to changes in currency exchange rates or promotions on the original booking date.

</p>
</div>


<div class="mt-5">

    <h2 _ngcontent-serverapp-c181="" class="d-flex align-items-center line-height-normal mb-4 pb-2" style="border-bottom:1px solid #ddd ">
   <i class="fa-solid fa-circle-arrow-right px-2"></i> <span>PROOF OF ID</span></h2>


<p class="px-2">To protect your Safer.Travel account - When a booking has been made by a 3rd party, Safer.Travel reserves the right to request proof of ID from the credit cardholder as well as a signed authorisation form.
    This security measure is not to cause any inconvenience but merely to protect the credit card holder against any credit card misuse.
</p>
</div>



<div class="mt-5">

    <h2 _ngcontent-serverapp-c181="" class="d-flex align-items-center line-height-normal mb-4 pb-2" style="border-bottom:1px solid #ddd ">
   <i class="fa-solid fa-circle-arrow-right px-2"></i> <span>RELOCATION OF YOUR CLIENTS</span></h2>


<p class="px-2">If the original hotel booked is closed, over booked or has maintenance problems and /or cannot provide the room(s) booked. You accept that the hotelier or supplier is responsible for finding you alternate accommodation of a similar standard. Where we have prior notice Safer.Travel will contact you by e.mail.
    Safer.Travel accepts no liability for any losses or costs that might occur as a result of re-location as this is completely beyond our control.
    A booking is considered to be a group booking when there will be 10 or more pax travelling. Safer.Travel reserve the right to cancel any FIT booking made for a group or if we consider them to have been made for the purpose of holding space for future sale. Please submit your group request using the Safer.Travel group page.

</p>

<div class="mt-5">

    <h2 _ngcontent-serverapp-c181="" class="d-flex align-items-center line-height-normal mb-4 pb-2" style="border-bottom:1px solid #ddd ">
   <i class="fa-solid fa-circle-arrow-right px-2"></i> <span>ON REQUEST RESERVATIONS</span></h2>


<p class="px-2">The hotels with “REQUEST” button and bookings with On Request Processing status means that the hotel does not have any available allotment, however Safer.Travel will contact the hotel to request extra space. Kindly be informed that in very rare occasions, the availability at the hotel might change until the time you complete your booking and the final status might turn to On Request Processing. In these cases, please do not attempt to book the same hotel again. You will be informed within 48 hours if your booking has been confirmed or rejected. If the hotel could be confirmed at a different rate, you will be advised. Please bear in mind that the confirmation may not be guaranteed and the hotels have the right to reject ON REQUEST bookings. If your accommodation request is urgent, it is suggested that you select a hotel with Instant confirmation. Depending upon when a new search is made on Safer.Travel system, you may see the same hotel appearing again. This is because space may have become available although at different rates from when the initial request was made.
</p>


<div class="mt-5">

    <h2 _ngcontent-serverapp-c181="" class="d-flex align-items-center line-height-normal mb-4 pb-2" style="border-bottom:1px solid #ddd ">
   <i class="fa-solid fa-circle-arrow-right px-2"></i> <span>HOTEL INFORMATION AND FACILITIES</span></h2>


<p class="px-2">Hotel information: While Safer.Travel strives to present hotel information as accurately as possible, we are not responsible for the accuracy of this information or for any facilities that may or may not be available at the hotel during your client's stay or not suited to your client's individual tastes and preferences.
    Redecoration/ renovations and maintenance are necessary to the upkeep of the hotel and may take place without prior warning, however the hotelier will endeavour to keep inconvenience to a minimum. The effects of normal wear and tear can be expected in a hotel and these are beyond our control. Safer.Travel cannot accept responsibility for any disturbance or inconvenience to your client beyond the hoteliers control nor for accidents or loss in a hotel caused by hotel management or staff.
    We have no control over any extra charges that a hotel may decide to implement for guest room incidentals such as air conditioning, safe box, mini fridge, hire of television remote etc...Any such charges must be paid direct to the hotel and Safer.Travel cannot be held responsible for any incidental charges passed on by the hotel.
    Hotel and guest room photographs are provided to give a general overview of the hotel. Guest room photographs may be of a different category to the one you book and not identical to the room your client(s) are allocated at the hotel.
    All of the hotels on the Safer.Travel website require one of the guests to be at least 18 years old. In some states of America there are higher age limits. If you have booked a hotel in the Unites States and the travellers are under 25 years of age please contact the hotel directly for clarification.

</p>
</div>


<div class="mt-5">

    <h2 _ngcontent-serverapp-c181="" class="d-flex align-items-center line-height-normal mb-4 pb-2" style="border-bottom:1px solid #ddd ">
   <i class="fa-solid fa-circle-arrow-right px-2"></i> <span>MAP INFORMATION</span></h2>


<p class="px-2">Maps are provided for information purposes only. While Safer.Travel strives to present hotel and map information as accurately as possible, we do not accept any responsibility for the accuracy of this information or for any errors and/or omissions. We suggest that you contact the hotel directly to obtain the most current and complete location information and directions.
</p>
</div>



<div class="mt-5">

    <h2 _ngcontent-serverapp-c181="" class="d-flex align-items-center line-height-normal mb-4 pb-2" style="border-bottom:1px solid #ddd ">
   <i class="fa-solid fa-circle-arrow-right px-2"></i> <span>COMPLAINTS</span></h2>


<p class="px-2">Any complaint which cannot be resolved at the hotel must be notified to us by logging into your Safer.Travel system and selecting the message category 'Complaint'. All complaints must be notified to us within 20 days of the check out date.
    A copy of the complaint must be also be submitted to and signed by the hotel manager. Complaints relating to hotel services will be forwarded by Safer.Travel to the relevant party.
    Response times do vary from between 5-20 working days depending upon the nature of the query in question.

</p>
</div>

<div class="mt-5">

    <h2 _ngcontent-serverapp-c181="" class="d-flex align-items-center line-height-normal mb-4 pb-2" style="border-bottom:1px solid #ddd ">
   <i class="fa-solid fa-circle-arrow-right px-2"></i> <span>VISA SUPPORT</span></h2>


<p class="px-2">
    <ul>
        <li>Safer.Travel will not be obliged to request any visa documents from the hotel for any bookings which have not been paid for in full.</li>
        <li>Safer.Travel will request these visa documents from the hotel upon your acceptance of a 10Eur charge in the event that you cancel the booking.</li>
        <li>Safer.Travel will do the best to accomodate your request but it is not guaranteed that the hotel will respond to your visa document request.</li>
        <li>Safer.Travel has no control over any charges that a hotel may implement for visa support documents.</li>
        <li>In the event that a hotel implements charges for visa support documents, Safer.Travel expects that the agency will make the relevant payment direct to the hotel.</li>
    </ul>

</p>
</div>
<div class="mt-5">

    <h2 _ngcontent-serverapp-c181="" class="d-flex align-items-center line-height-normal mb-4 pb-2" style="border-bottom:1px solid #ddd ">
   <i class="fa-solid fa-circle-arrow-right px-2"></i> <span>PROMOTIONS AND PROMOTIONAL RATES</span></h2>


<p class="px-2">Promotions are offered in good faith only. Some promotions are more popular than others in which case the rooms featured will be sold out much quicker. Safer.Travel reserves the right to modify or change any promotion or offer at any time without notice. Please make a search for your requested dates for the most current rates.
</p>
</div>


<div class="mt-5">

    <h2 _ngcontent-serverapp-c181="" class="d-flex align-items-center line-height-normal mb-4 pb-2" style="border-bottom:1px solid #ddd ">
   <i class="fa-solid fa-circle-arrow-right px-2"></i> <span>GENERAL TERMS AND CONDITIONS</span></h2>


<p class="px-2">Telephone calls to Safer.Travel may be recorded to enable us to monitor and improve our services.
    Please contact us at info@Safer.Travel if you do not want to receive any promotional e.mails/ Newsletters or special deals.
    Safer.Travel shall not be liable for any failure in service relating from uncontrollable circumstances such as flood, earthquake, riot, terrorist acts, acts of governments or authority change in a country, bad weather conditions etc.
    The climate differences and energy saving rules of different countries might affect the heating systems at the hotel which is located at that particular area and/or country. For instance, in Italy the heating system can only be operated between Nov 15 and March 15 due to government regulations. Opening and closing dates of the swimming pools also might be affected by the climate and weather conditions. Safer.Travel is not liable for the practices of the hotels regarding to these issues.

</p>
</div>



<div class="mt-5">

    <h2 _ngcontent-serverapp-c181="" class="d-flex align-items-center line-height-normal mb-4 pb-2" style="border-bottom:1px solid #ddd ">
   <i class="fa-solid fa-circle-arrow-right px-2"></i> <span>TRANSFERS</span></h2>


<p class="px-2">
    <ol>
        <li>Transfers cannot be booked seperately.</li>
        <li>Transfers can only be booked as an addition to hotel bookings.</li>
        <li>No amendments of any kinds (date changes, name changes, flight number change, vehicle type change) are accepted. Transfers are non-amendable.</li>
        <li>It is mandatory to enter valid and accurate flight details at the time of booking since it is not possible to amend.</li>
        <li>Safer.Travel will not assume any responsibility in omissions and typo errors which may result in any interruption of the service.</li>
    </ol>

</p>
</div>

<div class="mt-5">
    <p class="px-2">
<strong> IMPORTANT - </strong> When the Safer.Travel member has completed the booking online, they must check and make sure all the details on the pre paid accommodation voucher (such as hotel address, hotel info, city and country details) are correct.
Use of the Safer.Travel website is subject to your acceptance of our terms and conditions. If you do not accept these Terms and Conditions, you must refrain from using the website.
</p>
</div>
    </div>
      {{-- <div class="container__nav">
        <small>By clicking 'Accept' you are agreeing to our terms and conditions.</small>
        <a class="button" href="#">Accept</a>
      </div> --}}
    </section>
  {{-- </main> --}}
</section>
@endsection
