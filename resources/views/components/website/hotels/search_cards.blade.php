


  <div class="filtered_hotels">
    <div class="filters">
      <span> {{$Count}} hotels found</span>
      <div class="left_filter">
        <ul class="nav nav-pills " id="pills-tab" role="tablist">
          <li class="nav-item" role="presentation">
            <button class="nav-link sort_by active" data-val="rec" id="pills-home-tab" data-bs-toggle="pill" data-bs-target="#pills-home" type="button" role="tab" aria-controls="pills-home" aria-selected="true">Recommended </button>
          </li>
          <li class="nav-item" role="presentation">
            <button class="nav-link sort_by" data-val="price" id="pills-profile-tab" data-bs-toggle="pill" data-bs-target="#pills-profile" type="button" role="tab" aria-controls="pills-profile" aria-selected="false"> by price</button>
          </li>
          <input type="hidden" name="sort_by" />
        </ul>
        <div class="dropdown">
          <button class="btn dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
           alphabitic
          </button>
          <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="#">A</a></li>
            <li><a class="dropdown-item" href="#">B</a></li>
            <li><a class="dropdown-item" href="#">C</a></li>
          </ul>
        </div>
        <div class="dropdown">
          <button class="btn  dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
          EUR
          </button>
          <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="#">EUR</a></li>
            <li><a class="dropdown-item" href="#">LE</a></li>
            <li><a class="dropdown-item" href="#">USA</a></li>
          </ul>
        </div>
      </div>
    </div>
  </div>
  <div class="row mx-0">
    <div class="col-sm-12 p-0" id="hotels_content">

        <div class="tab-content" id="pills-tabContent">
            <div class="tab-pane fade show active w-100" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab" tabindex="0">
                @foreach ($HotelsRecommended as $HRec)
                <div class="card-content">
                    <div class=" card setted_tour_cards ">
                      <img src="{{asset("/website_assets/images/homePage/hotels/$HRec->hotel_banner")}}" alt=" blogimage">
                      <div class="card-body  setted_info">
                        <div class="card_info">
                            @php
                                $datetime1 = new DateTime($HRec->from_date);
                                $datetime2 = new DateTime($HRec->end_date);
                                $interval = $datetime1->diff($datetime2);
                                $days = $interval->format('%a');
                            @endphp
                            <h6> <a href="{{url("/hotels/$HRec->id")}}" class="stretched-link">{{$HRec->hotel_enname}} – {{$days}} Days</a></h6>
                            <span>
                              <i class="fa-regular fa-heart"></i>
                            </span>
                        </div>
                        <span>     <i class="fa-solid fa-location-dot"></i>  {{$HRec->en_country}}  <span>|</span> {{$HRec->en_city}}</span>
                        <p>
                          {{$HRec->hotel_enoverview}}
                        </p>
                        <div class="price">
                          <div class="rating">
                            @for ($i = 0; $i < $HRec->hotel_stars; $i++)
                                <i class="fa-solid fa-star"></i>
                            @endfor
                            @for ($i = 5; $i > $HRec->hotel_stars; $i--)
                                <i class="fa-regular fa-star"></i>
                            @endfor

                              <span> ({{$HRec->totalreviews}} review) </span>
                          </div>
                          <span class="hotels_price"> $ {{$HRec->cost}}</span>
                        </div>
                      </div>
                  </div>
                </div>
                @endforeach

            </div>
            <div class="tab-pane fade w-100" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab" tabindex="0">
                @foreach ($HotelsByPrice as $HPrice)
                <div class="card-content">
                    <div class=" card setted_tour_cards ">
                      <img src="{{asset("/website_assets/images/homePage/hotels/$HPrice->hotel_banner")}}" alt=" blogimage">
                      <div class="card-body  setted_info">
                        <div class="card_info">
                            @php
                                $datetime1 = new DateTime($HPrice->from_date);
                                $datetime2 = new DateTime($HPrice->end_date);
                                $interval = $datetime1->diff($datetime2);
                                $days = $interval->format('%a');
                            @endphp
                            <h6> <a href="{{url("/hotels/$HPrice->id")}}" class="stretched-link">{{$HPrice->hotel_enname}} – {{$days}} Days</a></h6>
                            <span>
                              <i class="fa-regular fa-heart"></i>
                            </span>
                        </div>
                        <span>     <i class="fa-solid fa-location-dot"></i>  {{$HPrice->en_country}}  <span>|</span> {{$HPrice->en_city}}</span>
                        <p>
                          {{$HPrice->hotel_enoverview}}
                        </p>
                        <div class="price">
                          <div class="rating">
                            @for ($i = 0; $i < $HPrice->hotel_stars; $i++)
                                <i class="fa-solid fa-star"></i>
                            @endfor
                            @for ($i = 5; $i > $HPrice->hotel_stars; $i--)
                                <i class="fa-regular fa-star"></i>
                            @endfor

                              <span> ({{$HPrice->totalreviews}} review) </span>
                          </div>
                          <span class="hotels_price"> $ {{$HPrice->cost}}</span>
                        </div>
                      </div>
                  </div>
                </div>
                @endforeach

            </div>
          </div>

    </div>
    <nav aria-label="Page navigation page_pagination example">
      <ul class="pagination">
        @for ($i = 0; $i < $Count/ 6; $i++)
        <li class="page-item page-num" onclick="paginationSetter({{$i+1}})"><a class="page-link">{{$i+1}}</a></li>
        @endfor
        <input type="hidden" name="page_num" />
        <li class="page-item @if($page_num != ($Count/2)) page-inc @else disabled @endif" @if($page_num != ($Count/6)) onclick="paginationSetter({{$page_num+1}})" @endif>
          <a class="page-link">Next</a>
        </li>
      </ul>
    </nav>
  </div>
