var addRoomBtn=document.getElementById("roomBtn"),formInput=document.getElementById("details"),removeBtn=document.getElementById('removeBtn"'),roomBtn=document.getElementById("room_main"),hotelMargin=document.getElementById("hotel_search");function addInput(){var o=` <div class="row mx-0  details_content new" id="details-${document.getElementsByClassName("details_content").length}">
\
    <hr>
    <div class="col-xl-6 col-md-12 col-sm-12 ">
\

    <div class="remove">
\
    <button id="removeBtn" onclick="remove(this)">
\
    <i class="fa-solid fa-trash-can"></i>
\
    </button>
\
    </div>
\
      <h5> adults</h5>
\
      <select class="form-select" aria-label="Default select example">
\
          <option selected>1</option>
\
          <option value="1">2 </option>
\
          <option value="2"> 3</option>
\
          <option value="3">4</option>
\
          <option value="4">4</option>
\
          <option value="5">5</option>
\
          <option value="6">6</option>
\
          <option value="7">7</option>
\
          <option value="8">8</option>
\
          <option value="9">9</option>
\
          <option value="10">10</option>
\
        </select>
\
      </div>
\
      <div class="col-xl-6 col-md-12 col-sm-12 ">
\
        <h5> childs</h5>
\
        <select class="form-select" aria-label="Default select example">
\
            <option selected>1</option>
\
            <option value="1">2 </option>
\
            <option value="2"> 3</option>
\
            <option value="3">4</option>
\
            <option value="4">4</option>
\
            <option value="5">5</option>
\
            <option value="6">6</option>
\
            <option value="7">7</option>
\
            <option value="8">8</option>
\
            <option value="9">9</option>
\
            <option value="10">10</option>
\
          </select>
\
        </div>
\
  </div> `;formInput.insertAdjacentHTML("beforeend",o),roomBtn.style.flexDirection="column-reverse",roomBtn.style.justifyContent="space-between"}function remove(o){console.log(o.closest(".details_content")),o.closest(".details_content").remove()}
