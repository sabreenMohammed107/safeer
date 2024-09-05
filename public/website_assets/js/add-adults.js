var addAdultsBtn=document.getElementById("adultButton"),adultInput=document.getElementById("adult_dtails"),inputs=document.getElementsByClassName("dating_inputs"),removeBtn=document.getElementById('removeBtn"'),passengerSectionMargin=document.getElementById("passenger_section");function addAdults(){var o=`
    <div class="row">

    <div class="col-xl-12 col-sm-12 adults_fileds " id="adult_dtails-${document.getElementsByClassName("adults_fileds").length}">
\
    <hr>
    <div class="remove">
        <button id="removeBtn" onclick="remove(this)">
         <i class="fa-solid fa-trash-can"></i>
        </button>
    </div>
    <div class="row">
      <div class="col-md-6 col-xl-4 col-sm-12 ">
        <h5> visa request country </h5>
        <select class="form-select SelExample"  id="SelExample"" >
            <option value="" disabled selected hidden>Choose...</option>
            <option value="1">country 1 </option>
            <option value="2"> country 2 </option>
            <option value="3">country 3 </option>
            <option value="4">country 4 </option>
            <option value="5">country 5 </option>
            <option value="6">country 6 </option>
            <option value="7">country 7</option>
            <option value="8">country 8 </option>
            <option value="9">country 9 </option>
            <option value="10"> country 10</option>
          </select>
    </div>
    <div class="col-md-6 col-xl-4 col-sm-12">
        <h5>Nationality </h5>
        <select class="form-select nationality"  id="nationality" >
            <option value="" disabled selected hidden>Choose...</option>
            <option value="1">Nationality 1 </option>
            <option value="2"> Nationality 2 </option>
            <option value="3">Nationality 3 </option>
            <option value="4">Nationality 4 </option>
            <option value="5">Nationality 5 </option>
            <option value="6">Nationality 6 </option>
            <option value="7">Nationality 7</option>
            <option value="8">Nationality 8 </option>
            <option value="9">Nationality 9 </option>
            <option value="10"> Nationality 10</option>
          </select>
    </div>
    <div class="col-md-6 col-xl-4 col-sm-12">
      <h5> Visa type  </h5>
      <select class="form-select " id="visa" >
        <option value="" disabled selected hidden>Choose...</option>
        <option value="1">type 1 </option>
        <option value="2"> type 2 </option>
        <option value="3">type 3 </option>
        <option value="4">type 4 </option>
        <option value="5">type 5 </option>
        <option value="6">type 6 </option>
        <option value="7">type 7</option>
        <option value="8">type 8 </option>
        <option value="9">type 9 </option>
        <option value="10"> type 10</option>
      </select>
    </div>

    </div>


  </div> `;adultInput.insertAdjacentHTML("beforeend",o)}function remove(o){console.log(o.closest(".adults_fileds")),o.closest(".adults_fileds").remove()}var passengerInfo=document.getElementsByClassName("passenger_info");function removePassenger(o){swal({title:"en"===localization?"Are you sure?":"هل أنت متأكد؟",text:"en"===localization?"This is a confirmation regarding your action to delete this item.":"هذا تأكيد بخصوص إجراءك لحذف هذا العنصر .",icon:"warning",buttons:!0,dangerMode:!0,buttons:{conf:{text:"en"===localization?"Confirm":"تأكيد",value:"conf"},catch:{text:"en"===localization?"No":"إلغاء",value:"catch"}},confirmButtonClass:"btn btn-success",cancelButtonClass:"btn btn-danger",buttonsStyling:!0}).then(t=>{switch(t){case"conf":o.closest(".passenger_info_details").remove();break;case"catch":"en"===localization?swal("ok!","complete your data!","success"):swal("حسنا!","استكمل بياناتك");break;default:swal.close()}})}
