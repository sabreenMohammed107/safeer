<section class="offers">
    <div class="titles">
        <h3>
            @if (LaravelLocalization::getCurrentLocale() === 'en')
            LIMITED TIME OFFERS

            @else
            عروض لفترة محدودة
            @endif
        </h3>
        <p>
            {{-- {!! $title!!} --}}
            @if (LaravelLocalization::getCurrentLocale() === 'en')
            Limit Offer When it comes to exploring exotic places, the choices are numerous. Whether you like peaceful
            destinations or vibrant landscapes, we have offers for you.



            @else
            عرض محدود عندما يتعلق الأمر باستكشاف أماكن غريبة ، فإن الخيارات عديدة. سواء كنت تحب الوجهات الهادئة أو
            المناظر الطبيعية النابضة بالحياة ، لدينا عروض لك.
            @endif
        </p>
    </div>
    <div class="offers_details container">
        <div class="row mx-0">
            <div class="col-sm-12 col-md-12 col-xl-5 p-0">
                <div class="card-content ">
                    <div class=" card">
                        <div class="card-body explore_card adventure_mind">
                            <div class="header_info">
                                <h5>@if (LaravelLocalization::getCurrentLocale() === 'en')
                                    {{$mainOffer->subtitle_en}}

                                    @else
                                    {{$mainOffer->subtitle_ar}}
                                    @endif</h5>
                                <p>
                                    @if (LaravelLocalization::getCurrentLocale() === 'en')
                                    {{$mainOffer->offer_enoverview}}

                                    @else
                                    {{$mainOffer->offer_aroverview}}
                                    @endif
                                </p>
                                <div class="start">
                                    <span></span>
                                    <h6>@if (LaravelLocalization::getCurrentLocale() === 'en')
                                        start from

                                        @else
                                        يبدأ من
                                        @endif</h6>
                                    <span></span>
                                </div>
                                <span> {{$mainOffer->cost}} $</span>
                                <button class="btn">
                                    <a href="{{ LaravelLocalization::localizeUrl('/offers') }}">
                                        @if(LaravelLocalization::getCurrentLocale() === 'en')
                                        Go to offers

                                        @else
                                        مشاهدة العروض
                                        @endif</a>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-12 col-md-12 col-xl-7 p-0">
                <div class="row mx-0">
                    @foreach ($Offers as $offer)
                    <div class="col-md-6 col-sm-12  p-0">
                        <div class="card-content">
                            <div class=" card">
                                <div class="card-body offers_card offer_place_1" onmouseenter="darkBG(this)"
                                    onmouseleave="rmvDarkBG(this)"
                                    style="background-image: linear-gradient(hsla(0, 0%, 0%, 0.3),hsla(0, 0%, 0%, 0.3)) , url({{ asset('uploads/offers') }}/{{ $offer->image }});">
                                    <div class="header_info">
                                        <h5><a href="{{ LaravelLocalization::localizeUrl('/single-offer/'.$offer->id.'/'.$offer->slug) }}"
                                                class="stretched-link">
                                                @if(LaravelLocalization::getCurrentLocale() ==='en')
                                                {{$offer->city->en_city ?? ""}}

                                                @else
                                                {{$offer->city->ar_city ?? ""}}
                                                @endif</a>
                                        </h5>
                                        <span> @if (LaravelLocalization::getCurrentLocale() === 'en')
                                            {{$offer->subtitle_en}}

                                            @else
                                            {{$offer->subtitle_ar}}
                                            @endif
                                        </span>
                                        <span>
                                            {{$offer->cost}} $
                                        </span>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach


                </div>
            </div>
        </div>
    </div>
</section>