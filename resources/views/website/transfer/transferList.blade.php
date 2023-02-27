<div class="row mx-0">
    <div class="col-sm-12 p-0">

        <div class="tab-content" id="pills-tabContent">
            <div class="tab-pane fade show active w-100" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">

                @foreach ($TransfersRecommended as $HRec)
                    <div class="card-content">
                        <div class=" card setted_tour_cards ">
                            <div class="card_image">
                                <div class="image_overlay">

                                    <img  src=" {{ asset('uploads/carModels') }}/{{ $HRec->carModel->image ?? '' }}"
                                        alt=" blogimage">
                                </div>
                            </div>
                            <div class="card-body  setted_info">
                                <a href="" class="btn btn-primary obj" >
                                    <span>
                                       {{ $HRec->carClass->class_enname ?? '' }}                               </span>
                                  </a>
                              <div class="card_info">
                                  <h6> {{ $HRec->carModel->model_enname ?? '' }} </h6>

                              </div>
                              <span  class="duartion">     <i class="fa-solid fa-location-dot"></i>  duration {{ $HRec->duration }} hours </span>

                                <div class="card_info" >
                                    <p style="margin-bottom:0"> <i class="fa-solid fa-truck-pickup"></i> pickup:{{ $HRec->locationFrom->location_enname ?? '' }}</p>
                                    <span>
                                        <p style="margin-bottom:0"> <i class="fa-solid fa-truck-pickup"></i> drop off:{{ $HRec->locationTo->location_enname ?? '' }}</p>
                                    </span>
                                </div>

                                    <div class="card_info" >
                                    <p style="margin-bottom:0"> <i class="fa-regular fa-clock"></i> duration:{{ $HRec->duration }} hours</p>
                                    <span>
                                        <p style="margin-bottom:0"> $ {{ $HRec->person_price }} Cost / Seat</p>
                                    </span>
                                </div>
 <form action="{{ url('/bookTransfer') }}" method="POST">
                    @csrf
                    <input type="hidden" name="transfer_id" value="{{ $HRec->id }}">

                              <div class="booking_info">

                              <div class="details px-1">
                                <label>
                                  pick a date
                                </label>
                                <input type="text" id="birth_date" placeholder="DD/MM/YYYY"  class="form-control " name="transfer_date" min="2000-01-01" max="2025-12-31" autocomplete="off" />

                                                            </div>
                                <div class="details">


                                    <label>
                                        Adults                                  </label>
                                    <input type="number" name="transfer_adult" value="1" class="form-control ">


                                </div>
                                <button class="btn mx-1 btn-primary"" type="submit">
                                        BOOK
                                    </button>
                              </div>
 </form>
                            </div>
                        </div>
                    </div>
                @endforeach

            </div>
            <div class="tab-pane fade w-100" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">

                @foreach ($TransfersByPrice  as $HPrice)

                <div class="card-content">
                    <div class=" card setted_tour_cards ">
                        <div class="card_image">
                            <div class="image_overlay">

                                <img  src=" {{ asset('uploads/carModels') }}/{{ $HPrice->carModel->image ?? ''}}"
                                    alt=" blogimage">
                            </div>
                        </div>
                        <div class="card-body  setted_info">
                            <a href="" class="btn btn-primary obj" >
                                <span>
                                    {{ $HPrice->carClass->class_enname ?? '' }}                              </span>
                              </a>
                          <div class="card_info">
                              <h6> {{ $HPrice->carModel->model_enname ?? '' }}</h6>

                          </div>
                          <span  class="duartion">     <i class="fa-solid fa-location-dot"></i>  duration {{ $HPrice->duration }} hours </span>

                            <div class="card_info" >
                                <p style="margin-bottom:0"> <i class="fa-solid fa-truck-pickup"></i> pickup:{{ $HPrice->locationFrom->location_enname ?? '' }}</p>
                                <span>
                                    <p style="margin-bottom:0"> <i class="fa-solid fa-truck-pickup"></i> drop off:{{ $HPrice->locationTo->location_enname ?? '' }}</p>
                                </span>
                            </div>

                                <div class="card_info" >
                                <p style="margin-bottom:0"> <i class="fa-regular fa-clock"></i> duration:{{ $HPrice->duration }} hours</p>
                                <span>
                                    <p style="margin-bottom:0"> $ {{ $HPrice->person_price }} Cost / Seat</p>
                                </span>
                            </div>

                            <form action="{{ url('/bookTransfer') }}" method="POST">
                                @csrf
                                <input type="hidden" name="transfer_id" value="{{ $HPrice->id }}">
                                          <div class="booking_info">

                                          <div class="details px-1">
                                            <label>
                                              pick a date
                                            </label>

                                            <input type="text" id="start_date" placeholder="DD/MM/YYYY"  class="form-control " name="transfer_date" min="2000-01-01" max="2025-12-31" autocomplete="off" />
                                        </div>
                                            <div class="details">


                                                <label>
                                                    Adults                                  </label>
                                                <input type="number" name="transfer_adult" value="1" class="form-control ">


                                            </div>
                                            <button class="btn mx-1 btn-primary" type="submit">
                                                    BOOK
                                                </button>
                                          </div>
             </form>
                        </div>
                    </div>
                </div>
            @endforeach

        </div>
            <div class="tab-pane fade w-100" id="pills-alpha" role="tabpanel" aria-labelledby="pills-alpha-tab">

                @foreach ($TransfersByAlpha as $HAlpha)


                <div class="card-content">
                    <div class=" card setted_tour_cards ">
                        <div class="card_image">
                            <div class="image_overlay">

                                <img  src=" {{ asset('uploads/carModels') }}/{{ $HAlpha->carModel->image ??'' }}"
                                    alt=" blogimage">
                            </div>
                        </div>
                        <div class="card-body  setted_info">
                            <a href="" class="btn btn-primary obj" >
                                <span>
                                    {{ $HAlpha->carClass->class_enname ?? '' }}                            </span>
                              </a>
                          <div class="card_info">
                              <h6> {{ $HAlpha->carModel->model_enname ?? '' }}</h6>

                          </div>
                          <span  class="duartion">     <i class="fa-solid fa-location-dot"></i>  duration {{ $HAlpha->duration }} hours </span>

                            <div class="card_info" >
                                <p style="margin-bottom:0"> <i class="fa-solid fa-truck-pickup"></i> pickup:{{ $HAlpha->locationFrom->location_enname ?? '' }}</p>
                                <span>
                                    <p style="margin-bottom:0"> <i class="fa-solid fa-truck-pickup"></i> drop off:{{ $HAlpha->locationTo->location_enname ?? '' }}</p>
                                </span>
                            </div>

                                <div class="card_info" >
                                <p style="margin-bottom:0"> <i class="fa-regular fa-clock"></i> duration:{{ $HAlpha->duration }} hours</p>
                                <span>
                                    <p style="margin-bottom:0"> $ {{ $HAlpha->person_price }} Cost / Seat</p>
                                </span>
                            </div>

                            <form action="{{ url('/bookTransfer') }}" method="POST">
                                @csrf
                                <input type="hidden" name="transfer_id" value="{{ $HAlpha->id }}">

                                          <div class="booking_info">

                                          <div class="details px-1">
                                            <label>
                                              pick a date
                                            </label>

                                            <input type="text" id="end_date" placeholder="DD/MM/YYYY"  class="form-control " name="transfer_date" min="2000-01-01" max="2025-12-31" autocomplete="off" />
                                        </div>
                                            <div class="details">


                                                <label>
                                                    Adults                                  </label>
                                                <input type="number" name="transfer_adult" value="1" class="form-control ">


                                            </div>
                                            <button class="btn mx-1 btn-primary" type="submit">
                                                    BOOK
                                                </button>
                                          </div>
             </form>
                        </div>
                    </div>
                </div>
            @endforeach

        </div>
        </div>

    </div>

@if($TransfersRecommended->count() > 0)
    <nav id="productt" aria-label="Page navigation page_pagination example">
        <ul class="pagination" id="product">
            @for ($i = 1; $i <= $TransfersRecommended->lastPage(); $i++)
                <li class="page-item page-num"><a
                        class="page-link {{ $TransfersRecommended->currentPage() == $i ? ' pageActive' : '' }}"
                        href="{{ $TransfersRecommended->url($i) }}">{{ $i }}</a></li>
            @endfor
            <input type="hidden" name="page_num" />

        </ul>
    </nav>
    @endif
</div>
