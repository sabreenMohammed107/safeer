function adultup(e){document.getElementById("adultsNumber").value=parseInt(document.getElementById("adultsNumber").value)+1,document.getElementById("adultsNumber").value>=parseInt(e)&&(document.getElementById("adultsNumber").value=e)}function adultdown(e){document.getElementById("adultsNumber").value=parseInt(document.getElementById("adultsNumber").value)-1,document.getElementById("adultsNumber").value<=parseInt(e)&&(document.getElementById("adultsNumber").value=e)}function childup(e){document.getElementById("childNumber").value=parseInt(document.getElementById("childNumber").value)+1,document.getElementById("childNumber").value>=parseInt(e)&&(document.getElementById("childNumber").value=e)}function childdown(e){document.getElementById("childNumber").value=parseInt(document.getElementById("childNumber").value)-1,document.getElementById("childNumber").value<=parseInt(e)&&(document.getElementById("childNumber").value=e)}function roomup(e){document.getElementById("roomsNumber").value=parseInt(document.getElementById("roomsNumber").value)+1,document.getElementById("roomsNumber").value>=parseInt(e)&&(document.getElementById("roomsNumber").value=e)}function roomdown(e){document.getElementById("roomsNumber").value=parseInt(document.getElementById("roomsNumber").value)-1,document.getElementById("roomsNumber").value<=parseInt(e)&&(document.getElementById("roomsNumber").value=e)}function tabAdultTop(e){document.getElementById("tabAdultsNumber").value=parseInt(document.getElementById("tabAdultsNumber").value)+1,document.getElementById("tabAdultsNumber").value>=parseInt(e)&&(document.getElementById("tabAdultsNumber").value=e)}function tabadultdown(e){document.getElementById("tabAdultsNumber").value=parseInt(document.getElementById("tabAdultsNumber").value)-1,document.getElementById("tabAdultsNumber").value<=parseInt(e)&&(document.getElementById("tabAdultsNumber").value=e)}function tabChildUp(e){document.getElementById("tabChildNumber").value=parseInt(document.getElementById("tabChildNumber").value)+1,document.getElementById("tabChildNumber").value>=parseInt(e)&&(document.getElementById("tabChildNumber").value=e)}function tabChilddown(e){document.getElementById("tabChildNumber").value=parseInt(document.getElementById("tabChildNumber").value)-1,document.getElementById("tabChildNumber").value<=parseInt(e)&&(document.getElementById("tabChildNumber").value=e)}function tabRoomUp(e){document.getElementById("tabRoomsNumber").value=parseInt(document.getElementById("tabRoomsNumber").value)+1,document.getElementById("tabRoomsNumber").value>=parseInt(e)&&(document.getElementById("tabRoomsNumber").value=e)}function tabRoomDown(e){document.getElementById("tabRoomsNumber").value=parseInt(document.getElementById("tabRoomsNumber").value)-1,document.getElementById("tabRoomsNumber").value<=parseInt(e)&&(document.getElementById("tabRoomsNumber").value=e)}function travelAdulTop(e){document.getElementById("travelAdultsNumber").value=parseInt(document.getElementById("travelAdultsNumber").value)+1,document.getElementById("travelAdultsNumber").value>=parseInt(e)&&(document.getElementById("travelAdultsNumber").value=e)}function travelAdultDown(e){document.getElementById("travelAdultsNumber").value=parseInt(document.getElementById("travelAdultsNumber").value)-1,document.getElementById("travelAdultsNumber").value<=parseInt(e)&&(document.getElementById("travelAdultsNumber").value=e)}function travelChildUp(e){document.getElementById("travelChildNumber").value=parseInt(document.getElementById("travelChildNumber").value)+1,document.getElementById("travelChildNumber").value>=parseInt(e)&&(document.getElementById("travelChildNumber").value=e)}function travelChildDown(e){document.getElementById("travelChildNumber").value=parseInt(document.getElementById("travelChildNumber").value)-1,document.getElementById("travelChildNumber").value<=parseInt(e)&&(document.getElementById("travelChildNumber").value=e)}function travelRoomUp(e){document.getElementById("travelRoomsNumber").value=parseInt(document.getElementById("travelRoomsNumber").value)+1,document.getElementById("travelRoomsNumber").value>=parseInt(e)&&(document.getElementById("travelRoomsNumber").value=e)}function travelRoomDown(e){document.getElementById("travelRoomsNumber").value=parseInt(document.getElementById("travelRoomsNumber").value)-1,document.getElementById("travelRoomsNumber").value<=parseInt(e)&&(document.getElementById("travelRoomsNumber").value=e)}function open_addnew(){document.getElementById("add_new").classList.toggle("show")}function close_addnew(){var e=document.getElementById("adultsNumber").value,t=document.getElementById("childNumber").value,l=document.getElementById("roomsNumber").value;document.getElementById("add_new").classList.toggle("show"),document.getElementById("adults").innerHTML=e+" adults",document.getElementById("children").innerHTML=t+" children",document.getElementById("rooms").innerHTML=l+" rooms"}function open_tabaddnew(){document.getElementById("tab_add_new").classList.toggle("show")}function open_traveladdnew(){document.getElementById("travel_add_new").classList.toggle("show")}var yearsValue,tabyearsValue,travelyearsValue,yearSelect=document.getElementById("years"),yearInput=document.getElementById("childNumber");function addYearsSelect(){yearsValue=yearInput.value;var e=$("html").attr("lang");console.log(e);var t=`
      <select class="form-select" name="ages[]" aria-label="Default select example">
\
          <option value="1" selected> 1
          ${"en"===e?"years old":"سنة"}
           </option>
\
          <option value="2"> 2  ${"en"===e?"years old":"سنة"}</option>
\
          <option value="3">3  ${"en"===e?"years old":"سنة"}</option>
\
          <option value="4">4  ${"en"===e?"years old":"سنة"} </option>
\
          <option value="5">5  ${"en"===e?"years old":"سنة"}</option>
\
          <option value="6">6  ${"en"===e?"years old":"سنة"}</option>
\
          <option value="7">7  ${"en"===e?"years old":"سنة"}</option>
\
          <option value="8">8  ${"en"===e?"years old":"سنة"}</option>
\
          <option value="9">9  ${"en"===e?"years old":"سنة"}</option>
\
          <option value="10">10  ${"en"===e?"years old":"سنة"}</option>
\
        </select>
\
     `;yearSelect.insertAdjacentHTML("beforeend",t)}function removeYearsSelect(){yearsValue=yearInput.value,$("#years select").last().remove()}var tabyearSelect=document.getElementById("tabYears"),tabyearInput=document.getElementById("tabChildNumber");function addTabYearsSelect(){tabyearsValue=tabyearInput.value;var e=`
      <select class="form-select" aria-label="Default select example">
\
          <option value="1" selected> 1 years old </option>
\
          <option value="2"> 2 years old</option>
\
          <option value="3">3 years old</option>
\
          <option value="4">4 years old </option>
\
          <option value="5">5 years old</option>
\
          <option value="6">6 years old</option>
\
          <option value="7">7 years old</option>
\
          <option value="8">8 years old</option>
\
          <option value="9">9 years old</option>
\
          <option value="10">10 years old</option>
\
        </select>
\
     `;tabyearSelect.insertAdjacentHTML("beforeend",e)}function removeTabYearsSelect(){tabyearsValue=tabyearInput.value,$("#tabYears select").last().remove()}var travelyearSelect=document.getElementById("travelYears"),travelyearInput=document.getElementById("travelChildNumber");function addTravelYearsSelect(){travelyearsValue=travelyearInput.value;var e=`
      <select class="form-select" aria-label="Default select example">
\
          <option value="1" selected> 1 years old </option>
\
          <option value="2"> 2 years old</option>
\
          <option value="3">3 years old</option>
\
          <option value="4">4 years old </option>
\
          <option value="5">5 years old</option>
\
          <option value="6">6 years old</option>
\
          <option value="7">7 years old</option>
\
          <option value="8">8 years old</option>
\
          <option value="9">9 years old</option>
\
          <option value="10">10 years old</option>
\
        </select>
\
     `;travelyearSelect.insertAdjacentHTML("beforeend",e)}function removeTravelYearsSelect(){travelyearsValue=travelyearInput.value,$("#travelYears select").last().remove()}
