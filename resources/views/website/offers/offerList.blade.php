@php
    $isEn = LaravelLocalization::getCurrentLocale() === 'en';
@endphp

<div class="offers_results__head">
    <h2>{{ __('links.availableOffers') }}</h2>
    <span>{{ trans_choice('links.offers_count', $offers->total(), ['count' => $offers->total()]) }}</span>
</div>

@if ($offers->isEmpty())
    <div class="offers_empty">
        <i class="fa-solid fa-magnifying-glass"></i>
        {{ __('links.no_offers_found') }}
    </div>
@endif

<div class="row g-4">
    @foreach ($offers as $offer)
        @php
            $offerUrl = LaravelLocalization::localizeUrl('/single-offer/' . $offer->id . '/' . $offer->slug);
            $isFav = session()->get('SiteUser') && in_array($offer->id, $favOfferIds ?? []);
        @endphp
        <div class="col-sm-12 col-md-6">
            <article class="offer_card">
                <div class="offer_card__media">
                    <a href="{{ $offerUrl }}">
                        <img src="{{ asset('uploads/offers') }}/{{ $offer->image }}" loading="lazy" width="350"
                            height="220" alt="{{ $isEn ? $offer->subtitle_en : $offer->subtitle_ar }}"
                            onerror="this.style.visibility='hidden'">
                    </a>
                    <button type="button" class="fav-toggle-btn {{ $isFav ? 'is-fav' : '' }}" data-fav-type="offer"
                        data-fav-id="{{ $offer->id }}" aria-label="{{ __('links.add_favorites') }}">
                        <i class="{{ $isFav ? 'fa-solid' : 'fa-regular' }} fa-heart {{ $isFav ? 'is-fav-icon' : '' }}"></i>
                    </button>
                </div>

                <div class="offer_card__body">
                    <div class="offer_card__meta">
                        @if ($offer->city)
                            <span class="offer_card__chip">
                                <i class="fa-solid fa-location-dot"></i>
                                {{ $isEn ? $offer->city->en_city : $offer->city->ar_city }}
                            </span>
                        @endif
                        @if ($offer->offer_date)
                            <span class="offer_card__chip offer_date">
                                <i class="fa-solid fa-calendar-days"></i> {{ $offer->offer_date->format('Y-m-d') }}
                            </span>
                        @endif
                    </div>

                    <h5 class="offer_card__title">
                        <a href="{{ $offerUrl }}">{{ $isEn ? $offer->subtitle_en : $offer->subtitle_ar }}</a>
                    </h5>

                    @php
                        // Overviews are TinyMCE HTML: decode entities (&nbsp; etc.) after stripping tags so
                        // Blade doesn't print them literally, then collapse the leftover whitespace.
                        $overview = html_entity_decode(strip_tags($isEn ? $offer->offer_enoverview ?? '' : $offer->offer_aroverview ?? ''), ENT_QUOTES | ENT_HTML5, 'UTF-8');
                        $overview = trim(preg_replace('/[\s\x{00A0}]+/u', ' ', $overview));
                    @endphp
                    <p class="offer_card__text">{{ Str::words($overview, 30, '...') }}</p>

                    <div class="offer_card__footer">
                        <span class="offer_card__price">{{ money($offer->cost) }}</span>
                        <a href="{{ $offerUrl }}" class="offer_card__link">{{ __('links.view_offer') }}</a>
                    </div>
                </div>
            </article>
        </div>
    @endforeach
</div>

@if ($offers->lastPage() > 1)
    <nav class="offers_pagination" aria-label="{{ __('links.offers') }}">
        <ul class="pagination">
            @for ($i = 1; $i <= $offers->lastPage(); $i++)
                <li class="page-item"> <a href="{{ $offers->url($i) }}"
                        class="page-link {{ $offers->currentPage() == $i ? ' active' : '' }}">{{ $i }}</a></li>
            @endfor
        </ul>
    </nav>
@endif
