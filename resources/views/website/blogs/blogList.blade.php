<div class="row mx-0 p-0">

    @foreach ($blogs as $blog)
        <div class="col-sm-12 col-md-6 ">
            <div class="card-content">
                <div class=" card  tours_card hotels_card">
                    <img src="{{ asset('uploads/blogs') }}/{{$blog->image}}" alt=" blogimage">
                    <div class="card-body hotel_card_info">
                        <div class="card_info">
                            <h5><a href="{{url('/single-blog/'.$blog->id) }}" class="stretched-link">
                                {{$blog->en_title ?? ''}}</a> </h5>
                            <p>
                                {{ strip_tags(Str::limit($blog->en_text ?? '', $limit = 300, $end = '...')) }}
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
        <li class="page-item"><a class="page-link" href="{{ $blogs->nextPageUrl() }}">
            Next
            </a></li>
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
