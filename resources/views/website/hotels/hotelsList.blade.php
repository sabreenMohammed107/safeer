<div class="row mx-0">
    <div class="col-sm-12 p-0">

        <div class="tab-content" id="pills-tabContent">
            <div class="tab-pane fade show active w-100" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">

                @foreach ($HotelsRecommended as $HRec)
                    <div class="card-content">
                        <div class=" card setted_tour_cards ">
                            <div class="card_image">
                                <div class="image_overlay">

                                    <img src=" {{ asset('uploads/hotels') }}/{{ $HRec->hotel->hotel_banner }}"
                                        alt=" blogimage">
                                </div>
                            </div>
                            <div class="card-body  setted_info">
                                <div class="card_info">
                                    @php
                                        $datetime1 = new DateTime($HRec->from_date);
                                        $datetime2 = new DateTime($HRec->end_date);
                                        $interval = $datetime1->diff($datetime2);
                                        $days = $interval->format('%a');
                                        //form date & end date
                                        $minPrice = $HRec->single_cost;
                                        if ($todate && $enddate) {
                                            $minPrice = App\Models\Room_type_cost::where('hotel_id', $HRec->hotel_id)
                                                ->where('from_date', '<=', $todate)
                                                ->where('end_date', '>=', $todate)
                                                ->min('single_cost');
                                        } else {
                                            $minPrice = $HRec->single_cost;
                                        }

                                    @endphp
                                    <h6> <a href="{{ LaravelLocalization::localizeUrl('/hotels/' . $HRec->hotel_id) }}"
                                            class="">@if (LaravelLocalization::getCurrentLocale() === 'en')

                                            {{ $HRec->hotel->hotel_enname }}
                                            @else
                                            {{ $HRec->hotel->hotel_arname }}
                                            @endif
                             –
                                            {{ $HRec->hotel->hotel_stars }} Stars</a></h6>
                                    <span>
                                        @php
                                            $isFav = session()->get('SiteUser') && in_array($HRec->hotel_id, $favHotelIds ?? []);
                                        @endphp
                                        <button type="button"
                                            class="fav-toggle-btn {{ $isFav ? 'is-fav' : '' }}"
                                            data-fav-type="hotel" data-fav-id="{{ $HRec->hotel_id }}"
                                            aria-label="{{ __('links.add_favorites') }}">
                                            <i class="{{ $isFav ? 'fa-solid' : 'fa-regular' }} fa-heart card_info_hover {{ $isFav ? 'is-fav-icon' : '' }}"></i>
                                        </button>
                                    </span>
                                </div>
                                <span> <i
                                        class="fa-solid fa-location-dot"></i>

  @if (LaravelLocalization::getCurrentLocale() === 'en')
  {{ $HRec->hotel->country->en_country ?? '' }}
  <span>|</span> {{ $HRec->hotel->city->en_city }}</span>
<p>
  {!! \Illuminate\Support\Str::limit($HRec->hotel->hotel_enoverview ?? '', $limit = 200, $end = '') !!}
  {{-- {{ $HRec->hotel->hotel_enoverview }} --}}
</p>

  @else
  {{ $HRec->hotel->country->ar_country ?? '' }}
  <span>|</span> {{ $HRec->hotel->city->ar_city }}</span>
<p>
  {!! \Illuminate\Support\Str::limit($HRec->hotel->hotel_aroverview ?? '', $limit = 200, $end = '') !!}

</p>
  @endif

                                <div class="price">
                                    <div class="rating">
                                        @for ($i = 0; $i < $HRec->hotel->hotel_stars; $i++)
                                            <i class="fa-solid fa-star"></i>
                                        @endfor
                                        @for ($i = 5; $i > $HRec->hotel->hotel_stars; $i--)
                                            <i class="fa-regular fa-star"></i>
                                        @endfor

                                        <span> ({{ $HRec->totalreviews }} {{ __('links.review') }}) </span>
                                    </div>
                                    <span class="hotels_price"><span
                                            style="color:#5f5858;font-size: 16px;font-weight: 300">{{ __('links.start') }}</span> $ {{ $minPrice ?? $HRec->single_cost }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach

            </div>
            <div class="tab-pane fade w-100" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">

                @foreach ($HotelsByPrice as $HPrice)
                    <div class="card-content">
                        <div class=" card setted_tour_cards ">
                            <div class="card_image">
                                <div class="image_overlay">

                                    <img src="{{ asset('uploads/hotels') }}/{{ $HPrice->hotel->hotel_banner }}"
                                        alt=" blogimage">
                                </div>
                            </div>
                            <div class="card-body  setted_info">
                                <div class="card_info">
                                    @php
                                        $datetime1 = new DateTime($HRec->from_date);
                                        $datetime2 = new DateTime($HRec->end_date);
                                        $interval = $datetime1->diff($datetime2);
                                        $days = $interval->format('%a');
                                    @endphp
                                    <h6> <a href="{{ LaravelLocalization::localizeUrl('/hotels/' . $HPrice->hotel_id) }}"
                                            class=""> @if (LaravelLocalization::getCurrentLocale() === 'en')

                                            {{ $HPrice->hotel->hotel_enname }}
                                            @else
                                            {{ $HPrice->hotel->hotel_arname }}
                                            @endif –
                                            {{ $HPrice->hotel->hotel_stars }} {{ __('links.stars') }}</a></h6>
                                    <span>
                                        @php
                                            $isFav = session()->get('SiteUser') && in_array($HPrice->hotel_id, $favHotelIds ?? []);
                                        @endphp
                                        <button type="button"
                                            class="fav-toggle-btn {{ $isFav ? 'is-fav' : '' }}"
                                            data-fav-type="hotel" data-fav-id="{{ $HPrice->hotel_id }}"
                                            aria-label="{{ __('links.add_favorites') }}">
                                            <i class="{{ $isFav ? 'fa-solid' : 'fa-regular' }} fa-heart {{ $isFav ? 'is-fav-icon' : '' }}"></i>
                                        </button>
                                    </span>
                                </div>
                                <span> <i class="fa-solid fa-location-dot"></i>
                                    @if (LaravelLocalization::getCurrentLocale() === 'en')
                                    {{ $HPrice->hotel->country->en_country ?? '' }}
                                    <span>|</span> {{ $HPrice->hotel->city->en_city }}</span>
                                <p>
                                    {!! \Illuminate\Support\Str::limit($HPrice->hotel->hotel_enoverview ?? '', $limit = 200, $end = '') !!}

                                </p>

                                    @else
                                    {{ $HPrice->hotel->country->ar_country ?? '' }}
                                    <span>|</span> {{ $HPrice->hotel->city->ar_city }}</span>
                                <p>
                                    {!! \Illuminate\Support\Str::limit($HPrice->hotel->hotel_aroverview ?? '', $limit = 200, $end = '') !!}

                                </p>
                                    @endif

                                <div class="price">
                                    <div class="rating">
                                        @for ($i = 0; $i < $HPrice->hotel->hotel_stars; $i++)
                                            <i class="fa-solid fa-star"></i>
                                        @endfor
                                        @for ($i = 5; $i > $HPrice->hotel->hotel_stars; $i--)
                                            <i class="fa-regular fa-star"></i>
                                        @endfor

                                        <span> ({{ $HPrice->totalreviews }} {{ __('links.review') }}) </span>
                                    </div>
                                    <span class="hotels_price"><span
                                            style="color:#5f5858;font-size: 16px;font-weight: 300">{{ __('links.start') }}</span> $ {{ $HPrice->single_cost }}</span>
                                    {{-- <span class="hotels_price"> $ {{$HPrice->cost}}</span> --}}
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach

            </div>
            <div class="tab-pane fade w-100" id="pills-alpha" role="tabpanel" aria-labelledby="pills-alpha-tab">

                @foreach ($HotelsByAlpha as $HAlpha)
                    <div class="card-content">
                        <div class=" card setted_tour_cards ">
                            <div class="card_image">
                                <div class="image_overlay">

                                    <img src="{{ asset('uploads/hotels') }}/{{ $HAlpha->hotel->hotel_banner }}"
                                        alt=" blogimage">
                                </div>
                            </div>
                            <div class="card-body  setted_info">
                                <div class="card_info">
                                    @php
                                        $datetime1 = new DateTime($HAlpha->from_date);
                                        $datetime2 = new DateTime($HAlpha->end_date);
                                        $interval = $datetime1->diff($datetime2);
                                        $days = $interval->format('%a');
                                    @endphp
                                    <h6> <a href="
                                        {{ LaravelLocalization::localizeUrl('/hotels/' . $HAlpha->hotel_id) }}"
                                            class="">  @if (LaravelLocalization::getCurrentLocale() === 'en')

                                            {{ $HAlpha->hotel->hotel_enname }}
                                            @else
                                            {{ $HAlpha->hotel->hotel_arname }}
                                            @endif –
                                            {{ $HAlpha->hotel->hotel_stars }} Stars</a></h6>
                                    <span>
                                        @php
                                            $isFav = session()->get('SiteUser') && in_array($HAlpha->hotel_id, $favHotelIds ?? []);
                                        @endphp
                                        <button type="button"
                                            class="fav-toggle-btn {{ $isFav ? 'is-fav' : '' }}"
                                            data-fav-type="hotel" data-fav-id="{{ $HAlpha->hotel_id }}"
                                            aria-label="{{ __('links.add_favorites') }}">
                                            <i class="{{ $isFav ? 'fa-solid' : 'fa-regular' }} fa-heart {{ $isFav ? 'is-fav-icon' : '' }}"></i>
                                        </button>
                                    </span>
                                </div>
                                <span> <i class="fa-solid fa-location-dot"></i>

  @if (LaravelLocalization::getCurrentLocale() === 'en')

  {{ $HAlpha->hotel->country->en_country ?? '' }}
  <span>|</span> {{ $HAlpha->hotel->city->en_city }}</span>
<p>
  {!! \Illuminate\Support\Str::limit($HAlpha->hotel->hotel_enoverview ?? '', $limit = 200, $end = '') !!}

</p>
  @else
  {{ $HAlpha->hotel->country->ar_country ?? '' }}
  <span>|</span> {{ $HAlpha->hotel->city->ar_city }}</span>
<p>
  {!! \Illuminate\Support\Str::limit($HAlpha->hotel->hotel_aroverview ?? '', $limit = 200, $end = '') !!}

</p>
  @endif

                                <div class="price">
                                    <div class="rating">
                                        @for ($i = 0; $i < $HAlpha->hotel->hotel_stars; $i++)
                                            <i class="fa-solid fa-star"></i>
                                        @endfor
                                        @for ($i = 5; $i > $HAlpha->hotel->hotel_stars; $i--)
                                            <i class="fa-regular fa-star"></i>
                                        @endfor

                                        <span> ({{ $HAlpha->totalreviews }} {{ __('links.review') }}) </span>
                                    </div>
                                    <span class="hotels_price"><span
                                            style="color:#5f5858;font-size: 16px;font-weight: 300">{{ __('links.start') }}</span> $ {{ $HAlpha->single_cost }}</span>
                                    {{-- <span class="hotels_price"> $ {{$HPrice->cost}}</span> --}}
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach

            </div>
        </div>

    </div>


    <nav id="productt" aria-label="Page navigation page_pagination example">
        <ul class="pagination" id="product">
            @for ($i = 1; $i <= $HotelsRecommended->lastPage(); $i++)
                <li class="page-item page-num"><a
                        class="page-link {{ $HotelsRecommended->currentPage() == $i ? ' pageActive' : '' }}"
                        href="{{ $HotelsRecommended->url($i) }}">{{ $i }}</a></li>
            @endfor
            <input type="hidden" name="page_num" />
            @if ($HotelsRecommended->currentPage() !== $HotelsRecommended->lastPage())
                <li class="page-item page-inc">
                    <a class="page-link" href="{{ $HotelsRecommended->nextPageUrl() }}">{{ __('links.next') }}</a>
                </li>
            @endif
        </ul>
    </nav>
</div>
