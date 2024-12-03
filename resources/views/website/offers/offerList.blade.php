<div class="row mx-0 p-0">

    @foreach ($offers as $offer)
    <div class="col-sm-12 col-md-6 ">
        <div class="card-content">
            <div class=" card  tours_card hotels_card">
                <a href="{{ LaravelLocalization::localizeUrl('/single-offer/'.$offer->id.'/'.$offer->slug) }}" >
                <img class="w-100" style="height: 250px" src="{{ asset('uploads/offers') }}/{{ $offer->image }}" alt=" blogimage">
                </a>
                <div class="card-body hotel_card_info"  >
                    <div class="card_info">
                        <h5 style="text-align: center;text-align-last:center"><a href="{{ LaravelLocalization::localizeUrl('/single-offer/'.$offer->id.'/'.$offer->slug) }}" >
                            @if (LaravelLocalization::getCurrentLocale() === 'en')
                       {{Str::words($offer->subtitle_en ?? '', $limit = 7, $end = '...')}}

                        @else
                      {{Str::words($offer->subtitle_ar ?? '', $limit = 7, $end = '...')}}
                        @endif
                    </a> </h5>
                </div>
                    <span>
                        @if (LaravelLocalization::getCurrentLocale() === 'en')
                        {{ Str::words(strip_tags($offer->offer_enoverview ?? ''), 30, '...') }}
                        {{-- {{ strip_tags(Str::words($offer->offer_enoverview ?? '', $limit = 30, $end = '...')) }} --}}
                        @else
                        {{ Str::words(strip_tags($offer->offer_aroverview ?? ''), 30, '...') }}
                        {{-- {{ strip_tags(Str::words($offer->offer_aroverview ?? '', $limit = 30, $end = '...')) }} --}}
                        @endif
                    </span>

                        <p >
                            @if (LaravelLocalization::getCurrentLocale() === 'en')
                            {{$offer->city->en_city ?? ""}}

                            @else
                            {{$offer->city->ar_city ?? ""}}
                            @endif
                             -
                             <span>
                                {{$offer->cost}} $
                            </span>

                </div>
            </div>
        </div>
    </div>

    @endforeach


</div>
<nav aria-label="Page navigation page_pagination example">
    <ul class="pagination">
        <!-- a Tag for previous page -->

        @for ($i = 1; $i <= $offers->lastPage(); $i++)
            <!-- a Tag for another page -->
            <li class="page-item"> <a href="{{ $offers->url($i) }}"
                    class="page-link {{ $offers->currentPage() == $i ? ' active' : '' }}">{{ $i }}</a></li>
        @endfor
        <!-- a Tag for next page -->

    </ul>

</nav>
