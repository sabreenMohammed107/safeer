var addRoomBtn =document.getElementById ('roomBtn');
var formInput = document.getElementById('details');
var removeBtn = document.getElementById('removeBtn"');
var roomBtn =document.getElementById('room_main');
var hotelMargin =document.getElementById('hotel_search');



function addInput() {
  var detailCounter = document.getElementsByClassName('details_content').length;
    var fields = ` <div class="row mx-0  details_content new" id="details-${detailCounter}"> \n\
    <hr>
    <div class="col-xl-6 col-md-12 col-sm-12 ">\n\
    
    <div class="remove">\n\
    <button id="removeBtn" onclick="remove(this)">\n\
    <i class="fa-solid fa-trash-can"></i>\n\
    </button>\n\
    </div>\n\
      <h5> adults</h5>\n\
      <select class="form-select" aria-label="Default select example">\n\
          <option selected>1</option>\n\
          <option value="1">2 </option>\n\
          <option value="2"> 3</option>\n\
          <option value="3">4</option>\n\
          <option value="4">4</option>\n\
          <option value="5">5</option>\n\
          <option value="6">6</option>\n\
          <option value="7">7</option>\n\
          <option value="8">8</option>\n\
          <option value="9">9</option>\n\
          <option value="10">10</option>\n\
        </select>\n\
      </div>\n\
      <div class="col-xl-6 col-md-12 col-sm-12 ">\n\
        <h5> childs</h5>\n\
        <select class="form-select" aria-label="Default select example">\n\
            <option selected>1</option>\n\
            <option value="1">2 </option>\n\
            <option value="2"> 3</option>\n\
            <option value="3">4</option>\n\
            <option value="4">4</option>\n\
            <option value="5">5</option>\n\
            <option value="6">6</option>\n\
            <option value="7">7</option>\n\
            <option value="8">8</option>\n\
            <option value="9">9</option>\n\
            <option value="10">10</option>\n\
          </select>\n\
        </div>\n\
  </div> `
  formInput.insertAdjacentHTML ('beforeend',fields);
  roomBtn.style.flexDirection ="column-reverse";
  roomBtn.style.justifyContent ="space-between";

  // var margin = 70;

  // var total = margin+70;
  // // total = margin;
  // console.log (total);
  // hotelMargin.style.marginTop= `${total}+"px"`;
};

function remove($event) {
  console.log ($event.closest('.details_content'));
  $event.closest('.details_content').remove();
  // hotelMargin.style.marginTop="-70px";
}