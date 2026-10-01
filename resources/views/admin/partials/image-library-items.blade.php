{{-- One page of the "choose from server" grid, appended into the modal by ImageLibraryController. --}}
@foreach ($libraryImages as $image)
    <div class="col-6 col-sm-4 col-md-3 col-xl-2" data-role="item">
        <button type="button" data-role="choose" data-path="{{ $image['path'] }}"
            data-url="{{ $image['url'] }}" data-name="{{ $image['name'] }}"
            class="library-item position-relative btn p-0 w-100 border border-gray-300 rounded overflow-hidden text-start bg-light"
            title="{{ $image['name'] }}">
            <span class="library-check position-absolute top-0 end-0 m-2 badge badge-circle badge-primary align-items-center justify-content-center">
                <i class="bi bi-check text-white fs-4"></i>
            </span>
            <img src="{{ $image['url'] }}" alt="{{ $image['name'] }}" loading="lazy" decoding="async"
                class="w-100" style="height: 120px; object-fit: cover;">
            <div class="px-2 py-1">
                <div class="fs-8 fw-bold text-gray-800 text-truncate">{{ $image['name'] }}</div>
            </div>
        </button>
    </div>
@endforeach
