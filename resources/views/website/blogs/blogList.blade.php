<div class="row mx-0 p-0">

    @foreach ($blogs as $blog)
        <div class="col-sm-12 col-md-6 ">
            <div class="card-content">
                <div class=" card  tours_card hotels_card">
                    <img src="{{ asset('uploads/blogs') }}/{{$blog->image}}" alt=" blogimage">
                    <div class="card-body hotel_card_info">
                        <div class="card_info" style="height: 115px; max-height: 115px; overflow: hidden;">
                            <h5 style="text-align: center;text-align-last:center"><a href="{{ LaravelLocalization::localizeUrl('/single-blog/'.$blog->id.'/'.$blog->slug) }}" >
                                @if (LaravelLocalization::getCurrentLocale() === 'en')

                                {{$blog->en_title ?? ''}}
                                @else
                                {{$blog->ar_title ?? ''}}
                                @endif</a> </h5>
                            <p>
                                @if (LaravelLocalization::getCurrentLocale() === 'en')

                                {{Str::limit($blog->en_bref ?? '', $limit = 300, $end = '...') }}
                                @else
                                {{Str::limit($blog->ar_bref ?? '', $limit = 300, $end = '...') }}
                                @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endforeach


</div>
<nav aria-label="Page navigation page_pagination example">
    <ul class="pagination">
        <!-- a Tag for previous page -->

        @for ($i = 1; $i <= $blogs->lastPage(); $i++)
            <!-- a Tag for another page -->
            <li class="page-item"> <a href="{{ $blogs->url($i) }}"
                    class="page-link {{ $blogs->currentPage() == $i ? ' active' : '' }}">{{ $i }}</a></li>
        @endfor
        <!-- a Tag for next page -->

    </ul>
    {{-- <ul class="pagination ">
        <li class="page-item"><a class="page-link" href="#">1</a></li>
        <li class="page-item"><a class="page-link" href="#">2</a></li>
        <li class="page-item"><a class="page-link" href="#">3</a></li>
        <li class="page-item"><a class="page-link" href="#">4</a></li>
        <li class="page-item">
            <a class="page-link" href="#">Next</a>
        </li>
    </ul> --}}
</nav>
