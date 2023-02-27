<div class="row mx-0">
    <div class="col-sm-12 p-0">

        <div class="tab-content" id="pills-tabContent">
            <div class="tab-pane fade show active w-100" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">

                @foreach ($ToursRecommended as $HRec)
                    <div class="card-content">
                        <div class=" card setted_tour_cards ">
                            <div class="card_image">
                                <div class="image_overlay">

                                    <img  src=" {{ asset('uploads/tours') }}/{{ $HRec->banner }}"
                                        alt=" blogimage">
                                </div>
                            </div>
                            <div class="card-body  setted_info">
                                <div class="card_info">
                                    <h6>
                                        <a href="{{ url('/tours/' . $HRec->id) }}"
                                            class=""> {{ $HRec->en_name }} </a> </h6>
                                    <span>
                                      ${{ $HRec->tour_person_cost }}
                                    </span>
                                </div>
                                <span class="duartion">  <i class="fa-solid fa-location-dot"></i>  duration {{ $HRec->duration }}</span>
                                <p>
                                {!! $HRec->en_notes !!}

                                </p>


                              </div>
                        </div>
                    </div>
                @endforeach

            </div>
            <div class="tab-pane fade w-100" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">

                @foreach ($ToursByPrice  as $HPrice)

                <div class="card-content">
                    <div class=" card setted_tour_cards ">
                        <div class="card_image">
                            <div class="image_overlay">

                                <img  src=" {{ asset('uploads/tours') }}/{{ $HPrice->banner }}"
                                    alt=" blogimage">
                            </div>
                        </div>
                        <div class="card-body  setted_info">
                            <div class="card_info">
                                <h6>
                                    <a href="{{ url('/tours/' . $HPrice->id) }}"
                                        class=""> {{ $HPrice->en_name }} </a> </h6>
                                <span>
                                  ${{ $HPrice->tour_person_cost }}
                                </span>
                            </div>
                            <span class="duartion">  <i class="fa-solid fa-location-dot"></i>  duration {{ $HPrice->duration }}</span>
                            <p>
                            {!! $HPrice->en_notes !!}

                            </p>


                          </div>
                    </div>
                </div>
            @endforeach

        </div>
            <div class="tab-pane fade w-100" id="pills-alpha" role="tabpanel" aria-labelledby="pills-alpha-tab">

                @foreach ($ToursByAlpha as $HAlpha)


                <div class="card-content">
                    <div class=" card setted_tour_cards ">
                        <div class="card_image">
                            <div class="image_overlay">

                                <img  src=" {{ asset('uploads/tours') }}/{{ $HAlpha->banner }}"
                                    alt=" blogimage">
                            </div>
                        </div>
                        <div class="card-body  setted_info">
                            <div class="card_info">
                                <h6> <a href="{{ url('/tours/' . $HAlpha->id) }}"
                                    class=""> {{ $HAlpha->en_name }} </a> </h6>
                                <span>
                                  ${{ $HAlpha->tour_person_cost }}
                                </span>
                            </div>
                            <span class="duartion">  <i class="fa-solid fa-location-dot"></i>  duration {{ $HAlpha->duration }}</span>
                            <p>
                            {!! $HAlpha->en_notes !!}

                            </p>


                          </div>
                    </div>
                </div>
            @endforeach

        </div>
        </div>

    </div>

@if($ToursRecommended->count() > 0)
    <nav id="productt" aria-label="Page navigation page_pagination example">
        <ul class="pagination" id="product">
            @for ($i = 1; $i <= $ToursRecommended->lastPage(); $i++)
                <li class="page-item page-num"><a
                        class="page-link {{ $ToursRecommended->currentPage() == $i ? ' pageActive' : '' }}"
                        href="{{ $ToursRecommended->url($i) }}">{{ $i }}</a></li>
            @endfor
            <input type="hidden" name="page_num" />
            {{-- @if ($ToursRecommended->currentPage() !== $ToursRecommended->lastPage())
                <li class="page-item page-inc">
                    <a class="page-link" href="{{ $ToursRecommended->nextPageUrl() }}">Next</a>
                </li>
            @endif --}}
        </ul>
    </nav>
    @endif
</div>
