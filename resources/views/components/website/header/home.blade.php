<!-- slider -->

<div class="slider_section">
    <div class="slider_details">
        <h1 >
            @if (LaravelLocalization::getCurrentLocale() === 'en')
            {{ $company->master_page_entitle }}  <br> {{ $company->master_page_ensubtitle }}


            @else
            {{ $company->master_page_artitle }}  <br> {{ $company->master_page_arsubtitle }}

            @endif
            </h1>

        <p class="px-5">
            @if (LaravelLocalization::getCurrentLocale() === 'en')

            {{ $company->master_page_entext }}
            @else
            {{ $company->master_page_artext }}
            @endif
          </p>
        <div class="travel_box">
            <ul class="nav travel_tabs nav-tabs" id="myTab" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home"
                        type="button" role="tab" aria-controls="home" aria-selected="true">{{ __('links.home') }}</button>
                </li>
                <li class="nav-item" role="presentation">
                    {{-- <a class="nav-link" href="">tours</a> --}}
                    <a href="{{ LaravelLocalization::localizeUrl('/tours') }}">
                    <button class="nav-link"
                        type="button" >{{ __('links.tours') }}</button>
                    </a>
                    </li>
                <li class="nav-item" role="presentation">
                    {{-- <button class="nav-link" id="contact-tab" data-bs-toggle="tab" data-bs-target="#contact"
                        type="button" role="tab" aria-controls="contact" aria-selected="false">travel</button> --}}

                        <a href="{{ LaravelLocalization::localizeUrl('/transfers') }}">
                            <button class="nav-link"
                                type="button" >{{ __('links.transfer') }}</button>
                            </a>

                    </li>
                <li class="nav-item" role="presentation">
                    {{-- <button class="nav-link" id="visa-tab" data-bs-toggle="tab" data-bs-target="#visa" type="button"
                        role="tab" aria-controls="visa" aria-selected="false">visa payment</button> --}}
                        <a href="{{ LaravelLocalization::localizeUrl('/visa') }}">
                            <button class="nav-link"
                                type="button" >{{ __('links.visa') }} </button>
                            </a>

                    </li>
            </ul>
            <div class="tab-content travel_box_content" id="myTabContent">
                <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                    <form action="{{ LaravelLocalization::localizeUrl('/hotels') }}" method="POST">
                        @csrf
                        <div class="hotel_details">
                            <div class="row mx-0 p-0">
                                <div class="col-sm-12 col-md-6 col-xl-2 p-s-0 ">
                                    <h5> {{ __('links.destination') }}</h5>

                                    <div class="choices">
                                        <i class="fa-solid fa-location-dot"></i>
                                        <select class="form-select dynamic" id="country" name="country_id"
                                            aria-label="Default select example">
                                            @foreach ($countries as $Country)
                                                <option value="{{ $Country->id }}" {{ $Country->id==1 ? 'selected' : '' }} >

                                                    @if (LaravelLocalization::getCurrentLocale() === 'en')

                                                    {{ $Country->en_country }}
                                                    @else
                                                    {{ $Country->ar_country }}
                                                    @endif

                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="col-sm-12 col-md-6 col-xl-2 p-s-0 ">
                                    <h5> {{ __('links.city') }}</h5>

                                    <div class="choices">
                                        <i class="fa-solid fa-location-dot"></i>
                                        <select class="form-select" id="city_id" name="city_id"
                                            aria-label="Default select example">
                                            <option value="">{{ __('links.selectCity') }}</option>
                                            @foreach ($cities as $city)
                                                <option value="{{ $city->id }}" {{ $city->id==1 ? 'selected' : '' }} >
                                                    @if (LaravelLocalization::getCurrentLocale() === 'en')

                                                    {{ $city->en_city }}
                                                    @else
                                                    {{ $city->ar_city }}
                                                    @endif
                                                    </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="col-sm-12 col-md-6 col-xl-3 p-0 ">
                                    @if (LaravelLocalization::getCurrentLocale() === 'en')

                                    <h5> check in <span>check </span> </h5>
                                    @else
                                    <h5>تسجيل وصول | <span>تسجبل مغادرة </span> </h5>
                                    @endif


                                    <div class="datepicker calender">
                                        <i class="fa-solid fa-calendar-days"></i>
                                        <input type="text"  id="demo" name="from_date" class="demo"
                                            value="" />
                                    </div>
                                </div>
                                <div class="col-sm-12 col-md-6 col-xl-1">
                                    <h5> {{ __('links.nights') }}</h5>
                                    {{-- <select class="form-select" name="nights" aria-label="Default select example">
                                        @for ($i = 1; $i < 11; $i++)
                                <option value="{{ $i }}"
                                    @if (session()->has('sessionArr')) {{ Session::get('sessionArr')['nights'] == $i ? 'selected' : '' }} @endif>
                                    {{ $i }} </option>
                            @endfor
                                    </select> --}}
                                    <input type="text" readonly class="form-control" id="nights" name="nights" value="7" >
                                </div>
                                <div class="col-sm-12 col-md-6 col-xl-3">
                                    <h5> {{ __('links.addRoom') }}</h5>
                                    <div class="rooms">
                                        <button class="info form-select" type="button" onclick="open_addnew()">
                                            <i class="fa-regular fa-user"></i>
                                            <span id="adults"> 1 {{ __('links.adult') }} </span>
                                            <span id="children"> 0 {{ __('links.child') }} </span>
                                            <span id="rooms">1 {{ __('links.rooms') }} </span>
                                        </button>
                                        <div class="add_new" id="add_new">
                                            <div class="form-group counter">
                                                <label>{{ __('links.adult') }}</label>
                                                <div class="input-group counter_content">
                                                    <div class="input-group-btn">
                                                        <button id="down" type="button" class=" btn btn-default"
                                                            onclick=" adultdown('1')"><span
                                                                class="glyphicon glyphicon-minus"> <i
                                                                    class="fa-solid fa-minus"></i></span></button>
                                                    </div>
                                                    <input type="text" name="adultsNumber" id="adultsNumber"
                                                        class="form-control input-number" value="1" />
                                                    <div class="input-group-btn">
                                                        <button id="up" type="button" class="btn btn-default"
                                                            onclick="adultup('10')"><span
                                                                class="glyphicon glyphicon-plus"><i
                                                                    class="fa-solid fa-plus"></i></span></button>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group counter">
                                                <label>{{ __('links.child') }}</label>
                                                <div class="input-group counter_content">
                                                    <div class="input-group-btn">
                                                        <button id="down" type="button" class="btn btn-default"
                                                            onclick=" childdown('0') ; removeYearsSelect() "><span
                                                                class="glyphicon glyphicon-minus"> <i
                                                                    class="fa-solid fa-minus"></i></span></button>
                                                    </div>
                                                    <input type="text" name="childNumber" id="childNumber"
                                                        class="form-control input-number" value="0"
                                                        onchange="addYearsSelect()" />
                                                    <div class="input-group-btn">
                                                        <button id="up" type="button" class="btn btn-default"
                                                            onclick="childup('10'); addYearsSelect()"><span
                                                                class="glyphicon glyphicon-plus"><i
                                                                    class="fa-solid fa-plus"></i></span></button>
                                                    </div>
                                                </div>

                                            </div>
                                            <div id="years">

                                            </div>
                                            <div class="form-group counter">
                                                <label>{{ __('links.rooms') }}</label>
                                                <div class="input-group counter_content">
                                                    <div class="input-group-btn">
                                                        <button id="down" type="button" class="btn btn-default"
                                                            onclick=" roomdown('1')"><span
                                                                class="glyphicon glyphicon-minus"> <i
                                                                    class="fa-solid fa-minus"></i></span></button>
                                                    </div>
                                                    <input type="text" name="roomsNumber" id="roomsNumber"
                                                        class="form-control input-number" value="1" />
                                                    <div class="input-group-btn">
                                                        <button id="up" type="button" class="btn btn-default"
                                                            onclick="roomup('10')"><span
                                                                class="glyphicon glyphicon-plus"><i
                                                                    class="fa-solid fa-plus"></i></span></button>
                                                    </div>
                                                </div>
                                            </div>
                                            <button type="button" class="btn done_button" onclick="close_addnew()">
                                                {{ __('links.done') }} </button>
                                        </div>
                                    </div>

                                </div>
                                <div class="col-sm-12 col-md-6 col-xl-1 p-0 ">
                                    <div class="main" id="room_main">

                                        <button class="btn"  type="submit">
                                            {{ __('links.search') }}
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
                            <div class="col-sm-12 col-md-6 col-xl-3 p-0 ">
                                <h5> check in <span>check </span> </h5>
                                <div class="datepicker calender">
                                    <i class="fa-solid fa-calendar-days"></i>
                                    <input type="text" id="demo" class="demo" name="datefilter"
                                        value="" />
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-6 col-xl-2">
                                <h5> nights</h5>
                                <select class="form-select"  aria-label="Default select example">
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
                            <div class="col-sm-12 col-md-6 col-xl-4">
                                <h5> Add room</h5>
                                <div class="rooms">
                                    <button class="info form-select" onclick="open_tabaddnew()">
                                        <i class="fa-regular fa-user"></i>
                                        <span> 3 adults </span>
                                        <span> 3 children </span>
                                        <span> 3 rooms </span>
                                    </button>
                                    <div class="add_new" id="tab_add_new">
                                        <div class="form-group counter">
                                            <label>adults</label>
                                            <div class="input-group counter_content">
                                                <div class="input-group-btn">
                                                    <button id="down" class=" btn btn-default"
                                                        onclick=" tabadultdown('0')"><span
                                                            class="glyphicon glyphicon-minus"> <i
                                                                class="fa-solid fa-minus"></i></span></button>
                                                </div>
                                                <input type="text" id="tabAdultsNumber"
                                                    class="form-control input-number" value="0" disabled />
                                                <div class="input-group-btn">
                                                    <button id="up" class="btn btn-default"
                                                        onclick="tabAdultTop('10')"><span
                                                            class="glyphicon glyphicon-plus"><i
                                                                class="fa-solid fa-plus"></i></span></button>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group counter">
                                            <label>children</label>
                                            <div class="input-group counter_content">
                                                <div class="input-group-btn">
                                                    <button id="down" class="btn btn-default"
                                                        onclick=" tabChilddown('0') ; removeTabYearsSelect() "><span
                                                            class="glyphicon glyphicon-minus"> <i
                                                                class="fa-solid fa-minus"></i></span></button>
                                                </div>
                                                <input type="text" id="tabChildNumber"
                                                    class="form-control input-number" value="0"
                                                    onchange="addTabYearsSelect()" disabled />
                                                <div class="input-group-btn">
                                                    <button id="up" class="btn btn-default"
                                                        onclick="tabChildUp('10'); addTabYearsSelect()"><span
                                                            class="glyphicon glyphicon-plus"><i
                                                                class="fa-solid fa-plus"></i></span></button>
                                                </div>
                                            </div>

                                        </div>
                                        <div id="tabYears">

                                        </div>
                                        <div class="form-group counter">
                                            <label>rooms</label>
                                            <div class="input-group counter_content">
                                                <div class="input-group-btn">
                                                    <button id="down" class="btn btn-default"
                                                        onclick=" tabRoomDown('0')"><span
                                                            class="glyphicon glyphicon-minus"> <i
                                                                class="fa-solid fa-minus"></i></span></button>
                                                </div>
                                                <input type="text" id="tabRoomsNumber"
                                                    class="form-control input-number" value="0" disabled />
                                                <div class="input-group-btn">
                                                    <button id="up" class="btn btn-default"
                                                        onclick="tabRoomUp('10')"><span
                                                            class="glyphicon glyphicon-plus"><i
                                                                class="fa-solid fa-plus"></i></span></button>
                                                </div>
                                            </div>
                                        </div>
                                        <button class="btn done_button"> Done </button>
                                    </div>
                                </div>

                            </div>
                            <div class="col-sm-12 col-md-6 col-xl-1 p-0 ">
                                <div class="main" id="room_main">
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
                            <div class="col-sm-12 col-md-6 col-xl-3 p-0 ">
                                <h5> check in <span>check </span> </h5>

                                <div class="datepicker calender">
                                    <i class="fa-solid fa-calendar-days"></i>
                                    <input type="text" id="demo" class="demo" name="datefilter"
                                        value="" />
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
                            <div class="col-sm-12 col-md-6 col-xl-4">
                                <h5> Add room</h5>
                                <div class="rooms">
                                    <button class="info form-select" onclick="open_traveladdnew()">
                                        <i class="fa-regular fa-user"></i>
                                        <span> 3 adults </span>
                                        <span> 3 children </span>
                                        <span> 3 rooms </span>
                                    </button>
                                    <div class="add_new" id="travel_add_new">
                                        <div class="form-group counter">
                                            <label>adults</label>
                                            <div class="input-group counter_content">
                                                <div class="input-group-btn">
                                                    <button id="down" class=" btn btn-default"
                                                        onclick=" travelAdultDown('0')"><span
                                                            class="glyphicon glyphicon-minus"> <i
                                                                class="fa-solid fa-minus"></i></span></button>
                                                </div>
                                                <input type="text" id="travelAdultsNumber"
                                                    class="form-control input-number" value="0" disabled />
                                                <div class="input-group-btn">
                                                    <button id="up" class="btn btn-default"
                                                        onclick="travelAdulTop('10')"><span
                                                            class="glyphicon glyphicon-plus"><i
                                                                class="fa-solid fa-plus"></i></span></button>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group counter">
                                            <label>children</label>
                                            <div class="input-group counter_content">
                                                <div class="input-group-btn">
                                                    <button id="down" class="btn btn-default"
                                                        onclick=" travelChildDown('0') ; removeTravelYearsSelect() "><span
                                                            class="glyphicon glyphicon-minus"> <i
                                                                class="fa-solid fa-minus"></i></span></button>
                                                </div>
                                                <input type="text" id="travelChildNumber"
                                                    class="form-control input-number" value="0"
                                                    onchange="addTravelYearsSelect()" disabled />
                                                <div class="input-group-btn">
                                                    <button id="up" class="btn btn-default"
                                                        onclick="travelChildUp('10'); addTravelYearsSelect()"><span
                                                            class="glyphicon glyphicon-plus"><i
                                                                class="fa-solid fa-plus"></i></span></button>
                                                </div>
                                            </div>

                                        </div>
                                        <div id="travelYears">

                                        </div>
                                        <div class="form-group counter">
                                            <label>rooms</label>
                                            <div class="input-group counter_content">
                                                <div class="input-group-btn">
                                                    <button id="down" class="btn btn-default"
                                                        onclick=" travelRoomDown('0')"><span
                                                            class="glyphicon glyphicon-minus"> <i
                                                                class="fa-solid fa-minus"></i></span></button>
                                                </div>
                                                <input type="text" id="travelRoomsNumber"
                                                    class="form-control input-number" value="0" disabled />
                                                <div class="input-group-btn">
                                                    <button id="up" class="btn btn-default"
                                                        onclick="travelRoomUp('10')"><span
                                                            class="glyphicon glyphicon-plus"><i
                                                                class="fa-solid fa-plus"></i></span></button>
                                                </div>
                                            </div>
                                        </div>
                                        <button class="btn done_button"> Done </button>
                                    </div>
                                </div>

                            </div>
                            <div class="col-sm-12 col-md-6 col-xl-1 p-0 ">
                                <div class="main" id="room_main">
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
                                <input type="text" class="form-control" id="formGroupExampleInput"
                                    placeholder=" card number">
                            </div>
                            <div class="col-xl-3 col-md-6  col-sm-12">
                                <h5>expiration date </h5>
                                <input type="text" class="start-date form-control" value="2012-04-05">
                            </div>
                            <div class="col-xl-3 col-md-6  col-sm-12 ">
                                <h5>CVN2 </h5>
                                <input type="text" class="form-control" id="formGroupExampleInput"
                                    placeholder="CVN2">
                            </div>

                            <div class="col-xl-2 col-md-12 col-sm-12 d-flex align-items-center justify-content-center">
                                <div class="main w-100">
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

