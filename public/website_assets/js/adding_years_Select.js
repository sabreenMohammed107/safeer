// Home tab

// adults name
function adultup(max) {
    document.getElementById("adultsNumber").value =
        parseInt(document.getElementById("adultsNumber").value) + 1;
    if (document.getElementById("adultsNumber").value >= parseInt(max)) {
        document.getElementById("adultsNumber").value = max;
    }
}
function adultdown(min) {
    document.getElementById("adultsNumber").value =
        parseInt(document.getElementById("adultsNumber").value) - 1;
    if (document.getElementById("adultsNumber").value <= parseInt(min)) {
        document.getElementById("adultsNumber").value = min;
    }
}
// children valus
function childup(max) {
    document.getElementById("childNumber").value =
        parseInt(document.getElementById("childNumber").value) + 1;
    if (document.getElementById("childNumber").value >= parseInt(max)) {
        document.getElementById("childNumber").value = max;
    }
}
function childdown(min) {
    document.getElementById("childNumber").value =
        parseInt(document.getElementById("childNumber").value) - 1;
    if (document.getElementById("childNumber").value <= parseInt(min)) {
        document.getElementById("childNumber").value = min;
    }
}
// rooms valus
function roomup(max) {
    document.getElementById("roomsNumber").value =
        parseInt(document.getElementById("roomsNumber").value) + 1;
    if (document.getElementById("roomsNumber").value >= parseInt(max)) {
        document.getElementById("roomsNumber").value = max;
    }
}
function roomdown(min) {
    document.getElementById("roomsNumber").value =
        parseInt(document.getElementById("roomsNumber").value) - 1;
    if (document.getElementById("roomsNumber").value <= parseInt(min)) {
        document.getElementById("roomsNumber").value = min;
    }
}
//  tab max and min buttons

// adults name
function tabAdultTop(max) {
    document.getElementById("tabAdultsNumber").value =
        parseInt(document.getElementById("tabAdultsNumber").value) + 1;
    if (document.getElementById("tabAdultsNumber").value >= parseInt(max)) {
        document.getElementById("tabAdultsNumber").value = max;
    }
}
function tabadultdown(min) {
    document.getElementById("tabAdultsNumber").value =
        parseInt(document.getElementById("tabAdultsNumber").value) - 1;
    if (document.getElementById("tabAdultsNumber").value <= parseInt(min)) {
        document.getElementById("tabAdultsNumber").value = min;
    }
}
// children valus
function tabChildUp(max) {
    document.getElementById("tabChildNumber").value =
        parseInt(document.getElementById("tabChildNumber").value) + 1;
    if (document.getElementById("tabChildNumber").value >= parseInt(max)) {
        document.getElementById("tabChildNumber").value = max;
    }
}
function tabChilddown(min) {
    document.getElementById("tabChildNumber").value =
        parseInt(document.getElementById("tabChildNumber").value) - 1;
    if (document.getElementById("tabChildNumber").value <= parseInt(min)) {
        document.getElementById("tabChildNumber").value = min;
    }
}
// rooms valus
function tabRoomUp(max) {
    document.getElementById("tabRoomsNumber").value =
        parseInt(document.getElementById("tabRoomsNumber").value) + 1;
    if (document.getElementById("tabRoomsNumber").value >= parseInt(max)) {
        document.getElementById("tabRoomsNumber").value = max;
    }
}
function tabRoomDown(min) {
    document.getElementById("tabRoomsNumber").value =
        parseInt(document.getElementById("tabRoomsNumber").value) - 1;
    if (document.getElementById("tabRoomsNumber").value <= parseInt(min)) {
        document.getElementById("tabRoomsNumber").value = min;
    }
}

//  travel max and min buttons

// adults name
function travelAdulTop(max) {
    document.getElementById("travelAdultsNumber").value =
        parseInt(document.getElementById("travelAdultsNumber").value) + 1;
    if (document.getElementById("travelAdultsNumber").value >= parseInt(max)) {
        document.getElementById("travelAdultsNumber").value = max;
    }
}
function travelAdultDown(min) {
    document.getElementById("travelAdultsNumber").value =
        parseInt(document.getElementById("travelAdultsNumber").value) - 1;
    if (document.getElementById("travelAdultsNumber").value <= parseInt(min)) {
        document.getElementById("travelAdultsNumber").value = min;
    }
}
// children valus
function travelChildUp(max) {
    document.getElementById("travelChildNumber").value =
        parseInt(document.getElementById("travelChildNumber").value) + 1;
    if (document.getElementById("travelChildNumber").value >= parseInt(max)) {
        document.getElementById("travelChildNumber").value = max;
    }
}
function travelChildDown(min) {
    document.getElementById("travelChildNumber").value =
        parseInt(document.getElementById("travelChildNumber").value) - 1;
    if (document.getElementById("travelChildNumber").value <= parseInt(min)) {
        document.getElementById("travelChildNumber").value = min;
    }
}
// rooms valus
function travelRoomUp(max) {
    document.getElementById("travelRoomsNumber").value =
        parseInt(document.getElementById("travelRoomsNumber").value) + 1;
    if (document.getElementById("travelRoomsNumber").value >= parseInt(max)) {
        document.getElementById("travelRoomsNumber").value = max;
    }
}
function travelRoomDown(min) {
    document.getElementById("travelRoomsNumber").value =
        parseInt(document.getElementById("travelRoomsNumber").value) - 1;
    if (document.getElementById("travelRoomsNumber").value <= parseInt(min)) {
        document.getElementById("travelRoomsNumber").value = min;
    }
}

// set dropdown

function open_addnew() {
    document.getElementById("add_new").classList.toggle("show");
}

function close_addnew() {
    adultsNumber;
    var adultsNumber = document.getElementById("adultsNumber").value;
    var childNumber = document.getElementById("childNumber").value;
    var roomsNumber = document.getElementById("roomsNumber").value;

    document.getElementById("add_new").classList.toggle("show");
    document.getElementById("adults").innerHTML=adultsNumber + ' adults';
    document.getElementById("children").innerHTML=childNumber + ' children';
    document.getElementById("rooms").innerHTML=roomsNumber + ' rooms';
}

// open tab drop down

function open_tabaddnew() {
    document.getElementById("tab_add_new").classList.toggle("show");
}

//  open travel tab
function open_traveladdnew() {
    document.getElementById("travel_add_new").classList.toggle("show");
}

// Home tab  adding years select
var yearSelect = document.getElementById("years");
var yearInput = document.getElementById("childNumber");
var yearsValue;

function addYearsSelect() {
    yearsValue = yearInput.value;
    var lang = $('html').attr('lang');
console.log(lang);
    // console.log(userLang);
    var years = `
      <select class="form-select" name="ages[]" aria-label="Default select example">\n\
          <option value="1" selected> 1
          ${lang === 'en' ? 'years old' : 'سنة'}
           </option>\n\
          <option value="2"> 2  ${lang === 'en' ? 'years old' : 'سنة'}</option>\n\
          <option value="3">3  ${lang === 'en' ? 'years old' : 'سنة'}</option>\n\
          <option value="4">4  ${lang === 'en' ? 'years old' : 'سنة'} </option>\n\
          <option value="5">5  ${lang === 'en' ? 'years old' : 'سنة'}</option>\n\
          <option value="6">6  ${lang === 'en' ? 'years old' : 'سنة'}</option>\n\
          <option value="7">7  ${lang === 'en' ? 'years old' : 'سنة'}</option>\n\
          <option value="8">8  ${lang === 'en' ? 'years old' : 'سنة'}</option>\n\
          <option value="9">9  ${lang === 'en' ? 'years old' : 'سنة'}</option>\n\
          <option value="10">10  ${lang === 'en' ? 'years old' : 'سنة'}</option>\n\
        </select>\n\
     `;
    yearSelect.insertAdjacentHTML("beforeend", years);
}

function removeYearsSelect() {
    yearsValue = yearInput.value;
    $("#years select").last().remove();
}

// tour tab
var tabyearSelect = document.getElementById("tabYears");
var tabyearInput = document.getElementById("tabChildNumber");
var tabyearsValue;

function addTabYearsSelect() {
    tabyearsValue = tabyearInput.value;
    var years = `
      <select class="form-select" aria-label="Default select example">\n\
          <option value="1" selected> 1 years old </option>\n\
          <option value="2"> 2 years old</option>\n\
          <option value="3">3 years old</option>\n\
          <option value="4">4 years old </option>\n\
          <option value="5">5 years old</option>\n\
          <option value="6">6 years old</option>\n\
          <option value="7">7 years old</option>\n\
          <option value="8">8 years old</option>\n\
          <option value="9">9 years old</option>\n\
          <option value="10">10 years old</option>\n\
        </select>\n\
     `;
    tabyearSelect.insertAdjacentHTML("beforeend", years);
}

function removeTabYearsSelect() {
    tabyearsValue = tabyearInput.value;
    $("#tabYears select").last().remove();
}

// travel tab
var travelyearSelect = document.getElementById("travelYears");
var travelyearInput = document.getElementById("travelChildNumber");
var travelyearsValue;

function addTravelYearsSelect() {
    travelyearsValue = travelyearInput.value;
    var years = `
      <select class="form-select" aria-label="Default select example">\n\
          <option value="1" selected> 1 years old </option>\n\
          <option value="2"> 2 years old</option>\n\
          <option value="3">3 years old</option>\n\
          <option value="4">4 years old </option>\n\
          <option value="5">5 years old</option>\n\
          <option value="6">6 years old</option>\n\
          <option value="7">7 years old</option>\n\
          <option value="8">8 years old</option>\n\
          <option value="9">9 years old</option>\n\
          <option value="10">10 years old</option>\n\
        </select>\n\
     `;
    travelyearSelect.insertAdjacentHTML("beforeend", years);
}

function removeTravelYearsSelect() {
    travelyearsValue = travelyearInput.value;
    $("#travelYears select").last().remove();
}
