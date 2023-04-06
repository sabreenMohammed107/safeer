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
                                        @if (LaravelLocalization::getCurrentLocale() === 'en')
                                        {{ $HRec->carClass->class_enname ?? '' }}

                                        @else
                                        {{ $HRec->carClass->class_arname ?? '' }}
                                        @endif
                                                             </span>
                                  </a>
                              <div class="card_info">
                                @if (LaravelLocalization::getCurrentLocale() === 'en')

                                <h6> {{ $HRec->carModel->model_enname ?? '' }} {{ __('links.to') }} {{ $HRec->locationTo->location_enname ?? '' }} </h6>

                                @else
                                <h6> {{ $HRec->carModel->model_arname ?? '' }} {{ __('links.to') }} {{ $HRec->locationTo->location_arname ?? '' }} </h6>

                                @endif

                              </div>
                              <h5>
                              <span  class="duartion py-1" >       @if (LaravelLocalization::getCurrentLocale() === 'en')

                                Number of seats
                                @else
                              عدد المقاعد
                                @endif {{ $HRec->carModel->capacity ??'' }}  </span>
                              </h5>
                                <div class="card_info" >
                                    <p style="margin-bottom:0"> <i style="padding: 0 5px 0 5px;" class="fa-solid fa-suitcase-rolling"></i>{{ __('links.from') }} :  <a href="" style="color:#1C4482;font-weight: 700">{{ $HRec->locationFrom->location_enname ?? '' }} </a></p>
                                    <span>
                                        <p style="margin-bottom:0"> <i style="padding: 0 5px 0 0;" class="fa-solid fa-suitcase-rolling"></i> {{ __('links.to') }} : <a href="" style="color:#1C4482;font-weight: 700">{{ $HRec->locationTo->location_enname ?? '' }}</a></p>
                                    </span>
                                </div>

                                    <div class="card_info" >
                                    <p style="margin-bottom:0"> <i style="padding: 0 5px 0 0;" class="fa-regular fa-clock"></i> {{ __('links.duration') }}: <a href="" style="color:#1C4482;font-weight: 700"> {{ $HRec->duration }} {{ __('links.hours') }} </a></p>
                                    @if (LaravelLocalization::getCurrentLocale() === 'en')

                                    <span>
                                        <p style="margin-bottom:0"><a href="" style="color:#1C4482;font-weight: 700"> $ {{ number_format($HRec->person_price, 2) }} </a>  {{ __('links.drCost') }} </p>
                                    </span>
                                    @else
                                    <span>
                                        <p style="margin-bottom:0"> {{ __('links.drCost') }} <a href="" style="color:#1C4482;font-weight: 700"> $ {{ number_format($HRec->person_price, 2) }} </a>   </p>
                                    </span>
                                    @endif



                                </div>
 <form action="{{ LaravelLocalization::localizeUrl('/bookTransfer') }}" method="POST">
                    @csrf
                    <input type="hidden" name="transfer_id" value="{{ $HRec->id }}">

                              <div class="booking_info">

                              <div class="details px-1">
                                <label>
                                    {{ __('links.pickDate') }}

                                </label>
                                <input type="text" id="transfer_date"    class="form-control transfer_date " name="transfer_date"  />



                                                            </div>
                                <div class="details">


                                    <label >
                                        {{ __('links.adult') }}
                                                                     </label>
                                    <input type="number" name="transfer_adult" value="1" class="form-control px-1"">


                                </div>
                                <button class="btn mx-1 btn-primary"" type="submit">
                                    {{ __('links.book') }}
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
                                    @if (LaravelLocalization::getCurrentLocale() === 'en')

                                    {{ $HPrice->carClass->class_enname ?? '' }}
                                    @else
                                    {{ $HPrice->carClass->class_arname ?? '' }}
                                    @endif
                                               </span>
                              </a>
                          <div class="card_info">
                            @if (LaravelLocalization::getCurrentLocale() === 'en')

                            <h6> {{ $HPrice->carModel->model_enname ?? '' }} {{ __('links.to') }} {{ $HPrice->locationTo->location_enname ?? '' }}</h6>

                            @else
                            <h6> {{ $HPrice->carModel->model_arname ?? '' }} {{ __('links.to') }} {{ $HPrice->locationTo->location_arname ?? '' }}</h6>

                            @endif

                          </div>
                          <h5>
                            <span  class="duartion py-1" >    @if (LaravelLocalization::getCurrentLocale() === 'en')

                                Number of seats
                                @else
                              عدد المقاعد
                                @endif   {{ $HPrice->carModel->capacity ??''}}  </span>
                            </h5>
                              <div class="card_info" >
                                  <p style="margin-bottom:0"> <i style="padding: 0 5px 0 5px;" class="fa-solid fa-suitcase-rolling"></i>{{ __('links.from') }} :  <a href="" style="color:#1C4482;font-weight: 700">{{ $HPrice->locationFrom->location_enname ?? '' }} </a></p>
                                  <span>
                                      <p style="margin-bottom:0"> <i style="padding: 0 5px 0 0;" class="fa-solid fa-suitcase-rolling"></i> {{ __('links.to') }} : <a href="" style="color:#1C4482;font-weight: 700">{{ $HPrice->locationTo->location_enname ?? '' }}</a></p>
                                  </span>
                              </div>

                                  <div class="card_info" >
                                  <p style="margin-bottom:0"> <i style="padding: 0 5px 0 0;" class="fa-regular fa-clock"></i> {{ __('links.duration') }}: <a href="" style="color:#1C4482;font-weight: 700"> {{ $HPrice->duration }} {{ __('links.hours') }} </a></p>
                                  @if (LaravelLocalization::getCurrentLocale() === 'en')

                                  <span>
                                    <p style="margin-bottom:0"><a href="" style="color:#1C4482;font-weight: 700"> $ {{ number_format($HPrice->person_price, 2) }} </a>  {{ __('links.drCost') }} </p>
                                </span>                                @else
                                <span>
                                    <p style="margin-bottom:0"> {{ __('links.drCost') }} <a href="" style="color:#1C4482;font-weight: 700"> $ {{ number_format($HPrice->person_price, 2) }} </a>   </p>
                                </span>                                @endif



                              </div>
                            <form action="{{ LaravelLocalization::localizeUrl('/bookTransfer') }}" method="POST">
                                @csrf
                                <input type="hidden" name="transfer_id" value="{{ $HPrice->id }}">
                                          <div class="booking_info">

                                          <div class="details px-1">
                                            <label>
                                                {{ __('links.pickDate') }}
                                            </label>

                                            <input type="text" id="start_date" placeholder="DD/MM/YYYY"  class="form-control transfer_date" name="transfer_date" min="2000-01-01" max="2025-12-31" autocomplete="off" />
                                        </div>
                                            <div class="details">


                                                <label >
                                                    {{ __('links.adult') }}                                </label>
                                                <input type="number" name="transfer_adult" value="1" class="form-control px-1"">


                                            </div>
                                            <button class="btn mx-1 btn-primary" type="submit">
                                                {{ __('links.book') }}
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
                                    @if (LaravelLocalization::getCurrentLocale() === 'en')

                                    {{ $HAlpha->carClass->class_enname ?? '' }}
                @else
                {{ $HAlpha->carClass->class_arname ?? '' }}
                @endif
                                    </span>
                              </a>
                          <div class="card_info">
                            @if (LaravelLocalization::getCurrentLocale() === 'en')
                            <h6> {{ $HAlpha->carModel->model_enname ?? '' }} {{ __('links.to') }} {{ $HAlpha->locationTo->location_enname ?? '' }}                           </h6>


                @else
                <h6> {{ $HAlpha->carModel->model_arname ?? '' }} {{ __('links.to') }} {{ $HAlpha->locationTo->location_arname ?? '' }}                           </h6>

                @endif

                          </div>
                          <h5>
                            <span  class="duartion py-1" >     @if (LaravelLocalization::getCurrentLocale() === 'en')

                                Number of seats
                                @else
                              عدد المقاعد
                                @endif {{ $HAlpha->carModel->capacity ??'' }}  </span>
                            </h5>
                              <div class="card_info" >
                                  <p style="margin-bottom:0"> <i style="padding: 0 5px 0 5px;" class="fa-solid fa-suitcase-rolling"></i>{{ __('links.from') }} :  <a href="" style="color:#1C4482;font-weight: 700">{{ $HAlpha->locationFrom->location_enname ?? '' }} </a></p>
                                  <span>
                                      <p style="margin-bottom:0"> <i style="padding: 0 5px 0 0;" class="fa-solid fa-suitcase-rolling"></i> {{ __('links.to') }} : <a href="" style="color:#1C4482;font-weight: 700">{{ $HAlpha->locationTo->location_enname ?? '' }}</a></p>
                                  </span>
                              </div>

                                  <div class="card_info" >
                                  <p style="margin-bottom:0"> <i style="padding: 0 5px 0 0;" class="fa-regular fa-clock"></i> {{ __('links.duration') }}: <a href="" style="color:#1C4482;font-weight: 700"> {{ $HAlpha->duration }} {{ __('links.hours') }} </a></p>
                                  @if (LaravelLocalization::getCurrentLocale() === 'en')

                                  <span>
                                    <p style="margin-bottom:0"><a href="" style="color:#1C4482;font-weight: 700"> $ {{ number_format($HAlpha->person_price, 2) }} </a>  {{ __('links.drCost') }} </p>
                                </span>                                  @else
                                <span>
                                    <p style="margin-bottom:0"> {{ __('links.drCost') }} <a href="" style="color:#1C4482;font-weight: 700"> $ {{ number_format($HAlpha->person_price, 2) }} </a>  </p>
                                </span>                                  @endif

                              </div>
                            <form action="{{ LaravelLocalization::localizeUrl('/bookTransfer') }}" method="POST">
                                @csrf
                                <input type="hidden" name="transfer_id" value="{{ $HAlpha->id }}">

                                          <div class="booking_info">

                                          <div class="details px-1">
                                            <label>
                                                {{ __('links.pickDate') }}
                                            </label>

                                            <input type="text" id="end_date" placeholder="DD/MM/YYYY"  class="form-control transfer_date" name="transfer_date" min="2000-01-01" max="2025-12-31" autocomplete="off" />
                                        </div>
                                            <div class="details">


                                                <label >
                                                    {{ __('links.adult') }}                               </label>
                                                <input type="number" name="transfer_adult" value="1" class="form-control px-1">


                                            </div>
                                            <button class="btn mx-1 btn-primary" type="submit">
                                                {{ __('links.book') }}
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
