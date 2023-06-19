<div class="row mx-0">
    <div class="col-sm-12 p-0">

        <div class="tab-content" id="pills-tabContent">
            <div class="tab-pane fade show active w-100" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">

                @foreach ($ToursRecommended as $HRec)
                    <div class="card-content">
                        <div class=" card setted_tour_cards ">
                            <a href="
                            {{ LaravelLocalization::localizeUrl('/tours/' . $HRec->id.'/'.$HRec->slug) }}"
                                class="">
                            <div class="card_image">
                                <div class="image_overlay">

                                    <img src=" {{ asset('uploads/tours') }}/{{ $HRec->banner }}" alt=" blogimage">
                                </div>
                            </div>
                            </a>
                            <div class="card-body  setted_info">
                                <div class="card_info">
                                    <h6>
                                        <a href="
                                        {{ LaravelLocalization::localizeUrl('/tours/' . $HRec->id.'/'.$HRec->slug) }}"
                                            class="">
                                            @if (LaravelLocalization::getCurrentLocale() === 'en')
                                                {{ $HRec->en_name }}
                                            @else
                                                {{ $HRec->ar_name }}
                                            @endif
                                        </a>
                                    </h6>
                                    <span>
                                        ${{ $HRec->tour_person_cost }}
                                    </span>
                                </div>
                                <span class="duartion"> <i class="fa-solid fa-location-dot"></i>
                                    @if (LaravelLocalization::getCurrentLocale() === 'en')
                                        duration
                                    @else
                                        المدة
                                    @endif {{ $HRec->duration }}
                                </span>
                                <p>

                                    @if (LaravelLocalization::getCurrentLocale() === 'en')
                                        {!! $HRec->en_notes !!}
                                    @else
                                        {!! $HRec->ar_notes !!}
                                    @endif


                                </p>


                            </div>
                        </div>
                    </div>
                @endforeach

            </div>
            <div class="tab-pane fade w-100" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">

                @foreach ($ToursByPrice as $HPrice)
                    <div class="card-content">
                        <div class=" card setted_tour_cards ">
                            <a href="{{ LaravelLocalization::localizeUrl('/tours/' . $HPrice->id.'/'.$HPrice->slug) }}"
                                class="">
                            <div class="card_image">
                                <div class="image_overlay">

                                    <img src=" {{ asset('uploads/tours') }}/{{ $HPrice->banner }}" alt=" blogimage">
                                </div>
                            </div>
                            </a>
                            <div class="card-body  setted_info">
                                <div class="card_info">
                                    <h6>
                                        <a href="{{ LaravelLocalization::localizeUrl('/tours/' . $HPrice->id.'/'.$HPrice->slug) }}"
                                            class="">
                                            @if (LaravelLocalization::getCurrentLocale() === 'en')
                                                {{ $HPrice->en_name }}
                                            @else
                                                {{ $HPrice->ar_name }}
                                            @endif
                                        </a>
                                    </h6>
                                    <span>
                                        ${{ $HPrice->tour_person_cost }}
                                    </span>
                                </div>
                                <span class="duartion"> <i class="fa-solid fa-location-dot"></i>
                                    @if (LaravelLocalization::getCurrentLocale() === 'en')
                                        duration
                                    @else
                                        المدة
                                    @endif {{ $HPrice->duration }}
                                </span>
                                <p>
                                    @if (LaravelLocalization::getCurrentLocale() === 'en')
                                        {!! $HPrice->en_notes !!}
                                    @else
                                        {!! $HPrice->ar_notes !!}
                                    @endif


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
                            <a href="{{ LaravelLocalization::localizeUrl('/tours/' . $HAlpha->id.'/'.$HAlpha->slug) }}"
                                class="">
                            <div class="card_image">
                                <div class="image_overlay">

                                    <img src=" {{ asset('uploads/tours') }}/{{ $HAlpha->banner }}" alt=" blogimage">
                                </div>
                            </div>
                            </a>
                            <div class="card-body  setted_info">
                                <div class="card_info">
                                    <h6> <a href="{{ LaravelLocalization::localizeUrl('/tours/' . $HAlpha->id.'/'.$HAlpha->slug) }}"
                                            class="">
                                            @if (LaravelLocalization::getCurrentLocale() === 'en')
                                                {{ $HAlpha->en_name }}
                                            @else
                                                {{ $HAlpha->ar_name }}
                                            @endif
                                        </a> </h6>
                                    <span>
                                        ${{ $HAlpha->tour_person_cost }}
                                    </span>
                                </div>
                                <span class="duartion"> <i class="fa-solid fa-location-dot"></i>
                                    @if (LaravelLocalization::getCurrentLocale() === 'en')
                                        duration
                                    @else
                                        المدة
                                    @endif {{ $HAlpha->duration }}
                                </span>
                                <p>

                                    @if (LaravelLocalization::getCurrentLocale() === 'en')
                                        {!! $HAlpha->en_notes !!}
                                    @else
                                        {!! $HAlpha->ar_notes !!}
                                    @endif
                                </p>


                            </div>
                        </div>
                    </div>
                @endforeach

            </div>
        </div>

    </div>
</div>
    @if ($ToursRecommended->count() > 0)
        <nav id="productt" aria-label="Page navigation page_pagination example">
            <ul class="pagination" id="product">
                @for ($i = 1; $i <= $ToursRecommended->lastPage(); $i++)
                    <li class="page-item page-num"><a
                            class="page-link {{ $ToursRecommended->currentPage() == $i ? ' pageActive' : '' }}"
                            href="{{ $ToursRecommended->url($i) }}">{{ $i }}</a></li>
                @endfor
                {{-- <input type="hidden" name="page_num" /> --}}
                {{-- @if ($ToursRecommended->currentPage() !== $ToursRecommended->lastPage())
                <li class="page-item page-inc">
                    <a class="page-link" href="{{ $ToursRecommended->nextPageUrl() }}">Next</a>
                </li>
            @endif --}}
            </ul>
        </nav>
    @endif

