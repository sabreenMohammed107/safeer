
<div class="row mx-0">
    <div class="col-sm-12 p-0">

        <div class="tab-content" id="pills-tabContent">
            <div class="tab-pane fade show active w-100" id="pills-home" role="tabpanel"
                aria-labelledby="pills-home-tab" >

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
                                    <h6> <a href="{{ url('/hotels/' . $HRec->hotel_id) }}"
                                            class="stretched-link">{{ $HRec->hotel->hotel_enname }} –
                                            {{ $HRec->hotel->hotel_stars }} Stars</a></h6>
                                        <div class="heart" data-bs-toggle="modal"
                                            data-bs-target="#staticBackdrop{{ $HRec->hotel_id }}">
                                            {{-- <input type="checkbox" id="fav" type="submit modl_fav_add_remov"
                                                onclick="setHeart(this)" data-info-fav="not_added">

                                            <label class="heart" for="fav"></label> --}}
                                        </div>
                                        <div class="modal fade  addFavDialog"
                                        id="staticBackdrop{{ $HRec->hotel_id }}" data-bs-backdrop="static"
                                        data-bs-keyboard="false" tabindex="-1"
                                        aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="staticBackdropLabel">Add
                                                        Favorite</h5>
                                                    <button type="button" class="btn-close"
                                                        data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <h3>Add To Favorite</h3>
                                                    <h6> <a class="stretched-link">{{
                                                            $HRec->hotel->hotel_enname }} –
                                                            {{ $HRec->hotel->hotel_stars }} Stars</a></h6>

                                                </div>
                                                <div class="modal-footer">

                                                        @if (session()->get('SiteUser'))
                                                <a href="{{ url('/favourite/' . $HRec->hotel_id) }}" class="btn btn-primary"  onclick="setHeart(this)"
                                                    data-bs-dismiss="modal" >Add </a>
                                                @else

                                                <a href="{{ route('siteLogin') }}" class="btn btn-primary"  onclick="setHeart(this)"
                                                data-bs-dismiss="modal" >Add </a>
                                                @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <span> <i
                                        class="fa-solid fa-location-dot"></i>{{ $HRec->hotel->country->en_country ?? '' }}
                                    <span>|</span> {{ $HRec->hotel->city->en_city }}</span>
                                <p>
                                    {{ $HRec->hotel->hotel_enoverview }}
                                </p>
                                <div class="price">
                                    <div class="rating">
                                        @for ($i = 0; $i < $HRec->hotel->hotel_stars; $i++)
                                            <i class="fa-solid fa-star"></i>
                                        @endfor
                                        @for ($i = 5; $i > $HRec->hotel->hotel_stars; $i--)
                                            <i class="fa-regular fa-star"></i>
                                        @endfor

                                        <span> ({{ $HRec->totalreviews }} review) </span>
                                    </div>
                                    <span class="hotels_price"><span
                                            style="color:#5f5858;font-size: 16px;font-weight: 300">start
                                            with</span> $ {{ $minPrice ?? $HRec->single_cost }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach

            </div>
            <div class="tab-pane fade w-100" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab"
                >

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
                                    <h6> <a href="{{ url('/hotels/' . $HPrice->hotel_id) }}"
                                            class="stretched-link">{{ $HPrice->hotel->hotel_enname }} –
                                            {{ $HPrice->hotel->hotel_stars }} Stars</a></h6>
                                        <div class="heart" data-bs-toggle="modal"
                                            data-bs-target="#static{{ $HPrice->hotel_id }}Backdrop">
                                            {{-- <input type="checkbox" id="fav" type="submit modl_fav_add_remov"
                                                onclick="setHeart(this)" data-info-fav="not_added">

                                            <label class="heart" for="fav"></label> --}}
                                        </div>
                                        <div class="modal fade addFavDialog"
                                        id="static{{ $HPrice->hotel_id }}Backdrop" data-bs-backdrop="static"
                                        data-bs-keyboard="false" tabindex="-1"
                                        aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="staticBackdropLabel">Add
                                                        Favorite</h5>
                                                    <button type="button" class="btn-close"
                                                        data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <h3>Add To Favorite</h3>
                                                    <h6> <a class="stretched-link">{{
                                                            $HPrice->hotel->hotel_enname }} –
                                                            {{ $HPrice->hotel->hotel_stars }} Stars</a></h6>

                                                </div>
                                                <div class="modal-footer">

                                                        @if (session()->get('SiteUser'))
                                                <a href="{{ url('/favourite/' . $HPrice->hotel_id) }}" class="btn btn-primary"  onclick="setHeart(this)"
                                                    data-bs-dismiss="modal" >Add </a>
                                                @else

                                                <a href="{{ route('siteLogin') }}" class="btn btn-primary"  onclick="setHeart(this)"
                                                data-bs-dismiss="modal" >Add </a>
                                                @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <span> <i class="fa-solid fa-location-dot"></i> {{ $HPrice->hotel->country->en_country ?? '' }}
                                    <span>|</span> {{ $HPrice->hotel->city->en_city }}</span>
                                <p>
                                    {{ $HPrice->hotel->hotel_enoverview }}
                                </p>
                                <div class="price">
                                    <div class="rating">
                                        @for ($i = 0; $i < $HPrice->hotel->hotel_stars; $i++)
                                            <i class="fa-solid fa-star"></i>
                                        @endfor
                                        @for ($i = 5; $i > $HPrice->hotel->hotel_stars; $i--)
                                            <i class="fa-regular fa-star"></i>
                                        @endfor

                                        <span> ({{ $HPrice->totalreviews }} review) </span>
                                    </div>
                                    <span class="hotels_price"><span
                                            style="color:#5f5858;font-size: 16px;font-weight: 300">start
                                            with</span> $ {{ $HPrice->single_cost }}</span>
                                    {{-- <span class="hotels_price"> $ {{$HPrice->cost}}</span> --}}
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach

            </div>
            <div class="tab-pane fade w-100" id="pills-alpha" role="tabpanel" aria-labelledby="pills-alpha-tab"
                >

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
                                    <h6> <a href="{{ url('/hotels/' . $HAlpha->hotel_id) }}"
                                            class="stretched-link">{{ $HAlpha->hotel->hotel_enname }} –
                                            {{ $HAlpha->hotel->hotel_stars }} Stars</a></h6>
                                        <div class="heart" data-bs-toggle="modal"
                                            data-bs-target="#staticBack{{ $HAlpha->hotel_id }}drop">
                                            {{-- <input type="checkbox" id="fav" type="submit modl_fav_add_remov"
                                                onclick="setHeart(this)" data-info-fav="not_added">

                                            <label class="heart" for="fav"></label> --}}
                                        </div>
                                        <div class="modal fade addFavDialog"
                                        id="staticBack{{ $HAlpha->hotel_id }}drop" data-bs-backdrop="static"
                                        data-bs-keyboard="false" tabindex="-1"
                                        aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="staticBackdropLabel">Add
                                                        Favorite</h5>
                                                    <button type="button" class="btn-close"
                                                        data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <h3>Add To Favorite</h3>
                                                    <h6> <a class="stretched-link">{{
                                                            $HAlpha->hotel->hotel_enname }} –
                                                            {{ $HAlpha->hotel->hotel_stars }} Stars</a></h6>

                                                </div>
                                                <div class="modal-footer">

                                                        @if (session()->get('SiteUser'))
                                                <a href="{{ url('/favourite/' . $HAlpha->hotel_id) }}" class="btn btn-primary"  onclick="setHeart(this)"
                                                    data-bs-dismiss="modal" >Add </a>
                                                @else

                                                <a href="{{ route('siteLogin') }}" class="btn btn-primary"  onclick="setHeart(this)"
                                                data-bs-dismiss="modal" >Add </a>
                                                @endif
                                                </div>
                                            </div>
                                        </div>
                                </div>
                                </div>
                                <span> <i class="fa-solid fa-location-dot"></i> {{ $HAlpha->hotel->country->en_country ?? '' }}
                                    <span>|</span> {{ $HAlpha->hotel->city->en_city }}</span>
                                <p>
                                    {{ $HAlpha->hotel->hotel_enoverview }}
                                </p>
                                <div class="price">
                                    <div class="rating">
                                        @for ($i = 0; $i < $HAlpha->hotel->hotel_stars; $i++)
                                            <i class="fa-solid fa-star"></i>
                                        @endfor
                                        @for ($i = 5; $i > $HAlpha->hotel->hotel_stars; $i--)
                                            <i class="fa-regular fa-star"></i>
                                        @endfor

                                        <span> ({{ $HAlpha->totalreviews }} review) </span>
                                    </div>
                                    <span class="hotels_price"><span
                                            style="color:#5f5858;font-size: 16px;font-weight: 300">start
                                            with</span> $ {{ $HAlpha->single_cost }}</span>
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
        <ul class="pagination" id="product" >
           @for($i=1;$i<=$HotelsRecommended->lastPage();$i++)
                <li class="page-item page-num" ><a  class="page-link {{ ($HotelsRecommended->currentPage() == $i) ? ' pageActive' : '' }}"
                        href="{{$HotelsRecommended->url($i)}}">{{$i}}</a></li>
            @endfor
            <input type="hidden" name="page_num" />
            <li class="page-item page-inc">
                <a class="page-link" href="{{$HotelsRecommended->nextPageUrl()}}">Next</a>
            </li>
        </ul>
    </nav>
</div>
