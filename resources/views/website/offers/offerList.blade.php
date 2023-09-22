<div class="row mx-0 p-0">

    @foreach ($offers as $offer)
    <div class="col-sm-12 col-md-6 ">
        <div class="card-content">
            <div class=" card  tours_card hotels_card">
                <img class="w-100" src="{{ asset('uploads/offers') }}/{{ $offer->image }}" alt=" blogimage">
                <div class="card-body hotel_card_info"  style="height: 115px; max-height: 115px; overflow: hidden;">
                    <div class="card_info">
                        <h5 style="text-align: center;text-align-last:center"><a href="{{ LaravelLocalization::localizeUrl('/single-offer/'.$offer->id.'/'.$offer->slug) }}" >
                            @if (LaravelLocalization::getCurrentLocale() === 'en')
                       {{$offer->subtitle_en}}

                        @else
                      {{$offer->subtitle_ar}}
                        @endif
                    </a> </h5>
                </div>
                    <span>
                        @if (LaravelLocalization::getCurrentLocale() === 'en')

                        {{ strip_tags(Str::limit($offer->offer_enoverview ?? '', $limit = 300, $end = '...')) }}
                        @else
                        {{ strip_tags(Str::limit($offer->offer_aroverview ?? '', $limit = 300, $end = '...')) }}
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
