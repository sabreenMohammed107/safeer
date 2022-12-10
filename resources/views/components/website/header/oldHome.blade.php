<div class="slider_section" style="background-image: linear-gradient(rgba(28, 69, 130, 0.81),rgba(28, 69, 130, 0.81)) , url({{asset("uploads/company/$company->master_page_img_bg")}});">
    <div class="slider_details">
      <h1> {{$company->master_page_entitle}} {{--title--}} <br> {{$company->master_page_ensubtitle}}  {{--sub-title--}} </h1>
      <p>{{$company->master_page_entext}}</p>
      <div class="travel_box">
        <ul class="nav travel_tabs nav-tabs" id="myTab" role="tablist">
            <li class="nav-item" role="presentation">
              <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home" type="button" role="tab" aria-controls="home" aria-selected="true">Home</button>
            </li>
            <li class="nav-item" role="presentation">
              <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile" type="button" role="tab" aria-controls="profile" aria-selected="false">tours</button>
            </li>
            <li class="nav-item" role="presentation">
              <button class="nav-link" id="contact-tab" data-bs-toggle="tab" data-bs-target="#contact" type="button" role="tab" aria-controls="contact" aria-selected="false">travel</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="visa-tab" data-bs-toggle="tab" data-bs-target="#visa" type="button" role="tab" aria-controls="visa" aria-selected="false">visa payment</button>
            </li>
          </ul>
          <div class="tab-content travel_box_content" id="myTabContent">
            <div class="tab-panel fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">

                <form action="{{url("/hotels")}}" method="POST">
                    @csrf
                        <div class="hotel_details">
                          <div class="row mx-0 p-0">
                            <div class="col-sm-12 col-md-6 col-xl-2 p-s-0 ">
                                <h5> destination</h5>

                              <div class="choices">
                                <i class="fa-solid fa-location-dot"></i>
                                <select class="form-select" name="country_id" aria-label="Default select example">
                                    @foreach ($countries as $Country)
                                  <option value="{{$Country->id}}">{{$Country->en_country}}</option>
                                  @endforeach
                                </select>
                              </div>
                            </div>
                            {{-- <div class="col-sm-12 col-md-6 col-xl-3 p-0 ">
                                <h5> check in <span>check </span> </h5>
                               <div class="row mx-0">
                                <div class="col-6 p-0">
                                  <div class="calender">
                                    <i class="fa-solid fa-calendar-days"></i>
                                    <input type="text" class="start-date form-control" name="from_date" placeholder="ex 2022-12-12">

                                  </div>
                                </div>
                                <div class="col-6 p-0">
                                    <div class="calender">
                                        <i class="fa-solid fa-calendar-days"></i>
                                        <input type="text" class="end-date form-control" name="end_date" placeholder="ex 2022-12-12">
                                    </div>
                                </div>
                               </div>
                            </div> --}}
                            <div class="col-sm-12 col-md-6 col-xl-3 p-0 ">
                                <h5> check in <span>check </span> </h5>

                                <div class="datepicker calender">
                                  <i class="fa-solid fa-calendar-days"></i>
                                  <input type="text" id="demo" name="from_date" class="demo"  value="" />
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-6 col-xl-2">
                                <h5> nights</h5>
                                <select class="form-select" name="nights" aria-label="Default select example">
                                    <option selected>1</option>
                                    <option value="1">2 </option>
                                    <option value="2">3</option>
                                    <option value="3">4</option>
                                    <option value="4">4</option>
                                    <option value="5">5</option>
                                    <option value="6">6</option>
                                    <option value="7">7</option>
                                    <option value="8">8</option>
                                    <option value="9">9</option>
                                    <option value="10">10</option>
                                  </select>
                            </div>
                            <div class="col-sm-12 col-md-6 col-xl-2">
                                <h5> adults</h5>
                                <select class="form-select" name="adults" aria-label="Default select example">
                                    <option selected>1</option>
                                    <option value="1">2 </option>
                                    <option value="2">3</option>
                                    <option value="3">4</option>
                                    <option value="4">4</option>
                                    <option value="5">5</option>
                                    <option value="6">6</option>
                                    <option value="7">7</option>
                                    <option value="8">8</option>
                                    <option value="9">9</option>
                                    <option value="10">10</option>
                                  </select>
                            </div>
                            <div class="col-sm-12 col-md-6 col-xl-2">
                                <h5> childs</h5>
                                <select class="form-select" name="childs" aria-label="Default select example">
                                    <option selected>1</option>
                                    <option value="1">2</option>
                                    <option value="2">3</option>
                                    <option value="3">4</option>
                                    <option value="4">4</option>
                                    <option value="5">5</option>
                                    <option value="6">6</option>
                                    <option value="7">7</option>
                                    <option value="8">8</option>
                                    <option value="9">9</option>
                                    <option value="10">10</option>
                                  </select>
                            </div>
                            <div class="col-sm-12 col-md-6 col-xl-1 p-0">
                                <div class="main">
                                    {{-- <div class="">
                                        <button id="roomBtn" onclick="addInput()">
                                            <i class="fa-solid fa-circle-plus"></i>
                                            Add room
                                          </button>
                                    </div> --}}
                                    <button class="btn text-white" type="submit">
                                         Search
                                    </button>
                                </div>
                            </div>
                        </div>
                      </div>
                </form>
                </div>
            <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                <div class="hotel_details">
                    <div class="row mx-0 p-0">
                        <div class="col-sm-12 col-md-6 col-xl-2 p-s-0 ">
                            <h5> destination</h5>

                          <div class="choices">
                            <i class="fa-solid fa-location-dot"></i>
                            <select class="form-select" aria-label="Default select example">
                              <option selected>indonisia</option>
                              <option value="1">turkey </option>
                              <option value="2"> egypt</option>
                              <option value="3">Japan</option>
                            </select>
                          </div>
                        </div>
                        <div class="col-sm-12 col-md-6 col-xl-3">
                            <h5> check in <span>check </span> </h5>
                           {{-- <div class="row mx-0">
                            <div class="col-6 p-0">
                              <div class="calender">
                                <i class="fa-solid fa-calendar-days"></i>
                                <input type="text" class="start-date form-control" value="2012-04-05">

                              </div>
                            </div>
                            <div class="col-6 p-0">
                              <input type="text" class="end-date form-control" value="2012-04-19"> --}}
                              <div class="datepicker calender">
                                <i class="fa-solid fa-calendar-days"></i>
                                <input type="text" id="demo" class="demo" name="datefilter" value="" />
                              </div>
                        </div>
                        <div class="col-sm-12 col-md-6 col-xl-2">
                            <h5> nights</h5>
                            <select class="form-select" aria-label="Default select example">
                                <option selected>1</option>
                                <option value="1">2 </option>
                                <option value="2"> 3</option>
                                <option value="3">4</option>
                                <option value="4">4</option>
                                <option value="5">5</option>
                                <option value="6">6</option>
                                <option value="7">7</option>
                                <option value="8">8</option>
                                <option value="9">9</option>
                                <option value="10">10</option>
                              </select>
                        </div>
                        <div class="col-sm-12 col-md-6 col-xl-2">
                            <h5> adults</h5>
                            <select class="form-select" aria-label="Default select example">
                                <option selected>1</option>
                                <option value="1">2 </option>
                                <option value="2"> 3</option>
                                <option value="3">4</option>
                                <option value="4">4</option>
                                <option value="5">5</option>
                                <option value="6">6</option>
                                <option value="7">7</option>
                                <option value="8">8</option>
                                <option value="9">9</option>
                                <option value="10">10</option>
                              </select>
                        </div>
                        <div class="col-sm-12 col-md-6 col-xl-2">
                            <h5> childs</h5>
                            <select class="form-select" aria-label="Default select example">
                                <option selected>1</option>
                                <option value="1">2 </option>
                                <option value="2"> 3</option>
                                <option value="3">4</option>
                                <option value="4">4</option>
                                <option value="5">5</option>
                                <option value="6">6</option>
                                <option value="7">7</option>
                                <option value="8">8</option>
                                <option value="9">9</option>
                                <option value="10">10</option>
                              </select>
                        </div>
                        <div class="col-sm-12 col-md-6 col-xl-1 p-0">
                            <div class="main">
                                <div class="">
                                    <a href="#">
                                      <i class="fa-solid fa-circle-plus"></i>
                                        Add room
                                    </a>
                                </div>
                                <button class="btn">
                                    <a href="#"> search</a>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">
               <div class="hotel_details">
                <div class="row mx-0 p-0">
                  <div class="col-sm-12 col-md-6 col-xl-2 p-s-0 ">
                      <h5> destination</h5>

                    <div class="choices">
                      <i class="fa-solid fa-location-dot"></i>
                      <select class="form-select" aria-label="Default select example">
                        <option selected>indonisia</option>
                        <option value="1">turkey </option>
                        <option value="2"> egypt</option>
                        <option value="3">Japan</option>
                      </select>
                    </div>
                  </div>
                  {{-- <div class="col-sm-12 col-md-6 col-xl-3 p-0 ">
                      <h5> check in <span>check </span> </h5>
                     <div class="row mx-0">
                      <div class="col-6 p-0">
                        <div class="calender">
                          <i class="fa-solid fa-calendar-days"></i>
                          <input type="text" class="start-date form-control" value="2012-04-05">

                        </div>
                      </div>
                      <div class="col-6 p-0">
                        <input type="text" class="end-date form-control" value="2012-04-19">
                      </div>
                     </div>
                  </div> --}}
                  <div class="col-sm-12 col-md-6 col-xl-3 p-0 ">
                    <h5> check in <span>check </span> </h5>

                    <div class="datepicker calender">
                      <i class="fa-solid fa-calendar-days"></i>
                      <input type="text" id="demo" class="demo" name="datefilter" value="" />
                    </div>
                </div>
                  <div class="col-sm-12 col-md-6 col-xl-2">
                      <h5> nights</h5>
                      <select class="form-select" aria-label="Default select example">
                          <option selected>1</option>
                          <option value="1">2 </option>
                          <option value="2"> 3</option>
                          <option value="3">4</option>
                          <option value="4">4</option>
                          <option value="5">5</option>
                          <option value="6">6</option>
                          <option value="7">7</option>
                          <option value="8">8</option>
                          <option value="9">9</option>
                          <option value="10">10</option>
                        </select>
                  </div>
                  <div class="col-sm-12 col-md-6 col-xl-2">
                      <h5> adults</h5>
                      <select class="form-select" aria-label="Default select example">
                          <option selected>1</option>
                          <option value="1">2 </option>
                          <option value="2"> 3</option>
                          <option value="3">4</option>
                          <option value="4">4</option>
                          <option value="5">5</option>
                          <option value="6">6</option>
                          <option value="7">7</option>
                          <option value="8">8</option>
                          <option value="9">9</option>
                          <option value="10">10</option>
                        </select>
                  </div>
                  <div class="col-sm-12 col-md-6 col-xl-2">
                      <h5> childs</h5>
                      <select class="form-select" aria-label="Default select example">
                          <option selected>1</option>
                          <option value="1">2 </option>
                          <option value="2"> 3</option>
                          <option value="3">4</option>
                          <option value="4">4</option>
                          <option value="5">5</option>
                          <option value="6">6</option>
                          <option value="7">7</option>
                          <option value="8">8</option>
                          <option value="9">9</option>
                          <option value="10">10</option>
                        </select>
                  </div>
                  <div class="col-sm-12 col-md-6 col-xl-1 p-0">
                      <div class="main">
                          <div class="">
                              <a href="#">
                                <i class="fa-solid fa-circle-plus"></i>
                                  Add room
                              </a>
                          </div>
                          <button class="btn">
                              <a href="#"> search</a>
                          </button>
                      </div>
                  </div>
              </div>
                </div>
            </div>
            <div class="tab-pane fade" id="visa" role="tabpanel" aria-labelledby="visa-tab">
              <div class="hotel_details">
                    <div class="row">
                        <div class="col-xl-4 col-md-12  col-sm-12">
                            <h5> card number </h5>
                            <input type="text" class="form-control" id="formGroupExampleInput" placeholder=" card number">
                          </div>
                        <div class="col-xl-3 col-md-6  col-sm-12">
                            <h5>expiration date  </h5>
                            <input type="text" class="start-date form-control" value="2012-04-05">
                        </div>
                        <div class="col-xl-3 col-md-6  col-sm-12 ">
                          <h5>CVN2 </h5>
                          <input type="text" class="form-control" id="formGroupExampleInput" placeholder="CVN2">
                        </div>

                        <div class="col-xl-2 col-md-12 col-sm-12">
                            <div class="main">
                                <button class="btn">
                                    <a href="#"> pay </a>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
          </div>
    </div>
    </div>

</div>

