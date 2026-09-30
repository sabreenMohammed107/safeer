{{--
    Image field with two sources: a normal file upload, or an image picked from
    public/uploads through the shared server-library modal. Pair it with the
    PicksServerImages controller trait: a file input named "image" posts its
    library pick as "library_image".

    @include('admin.partials.image-picker', [
        'name'     => 'image',                                  // file input name
        'current'  => $row->image ? asset('uploads/teams/' . $row->image) : null, // optional preview
        'multiple' => false,                                    // optional, true for "files[]"
        'size'     => 150,                                      // optional preview size in px
    ])
--}}
@php
    $name = $name ?? 'image';
    $multiple = $multiple ?? false;
    $current = $current ?? null;
    $size = $size ?? 150;
    $baseName = rtrim($name, '[]');
    $libraryName = 'library_' . $baseName . ($multiple ? '[]' : '');
    $oldPicks = array_filter((array) old('library_' . $baseName));
@endphp

<div class="image-picker text-center" data-image-picker data-multiple="{{ $multiple ? '1' : '0' }}"
    data-library-name="{{ $libraryName }}">
    @if ($multiple)
        <!--begin::Picked thumbnails-->
        <div data-role="thumbs" class="d-flex flex-wrap gap-2 justify-content-center mb-3"></div>
        <div data-role="library-list">
            @foreach ($oldPicks as $pick)
                <input type="hidden" name="{{ $libraryName }}" value="{{ $pick }}">
            @endforeach
        </div>
        <!--end::Picked thumbnails-->
    @else
        <!--begin::Preview-->
        <div class="border border-dashed border-gray-300 rounded mb-3 mx-auto d-flex align-items-center justify-content-center overflow-hidden"
            style="width: {{ $size }}px; height: {{ $size }}px;">
            <img data-role="preview" src="{{ $current ?: '' }}" alt="" class="w-100 h-100"
                style="object-fit: cover; {{ $current ? '' : 'display: none;' }}"
                onerror="this.style.display='none'; this.nextElementSibling.style.display='';">
            <span data-role="placeholder" class="text-muted fs-7" style="{{ $current ? 'display: none;' : '' }}">No image</span>
        </div>
        <input type="hidden" name="{{ $libraryName }}" data-role="library" value="{{ reset($oldPicks) ?: '' }}">
        <!--end::Preview-->
    @endif
    <div data-role="source-label" class="text-muted fs-8 mb-2 text-break"></div>

    <input type="file" name="{{ $name }}" data-role="file" class="form-control form-control-sm mb-3"
        accept=".png,.jpg,.jpeg,.gif,.webp" @if ($multiple) multiple @endif />

    <button type="button" class="btn btn-sm btn-light-primary w-100" data-role="open-library">
        <i class="bi bi-images fs-5 me-1"></i> Choose from server
    </button>
</div>

@once
    @include('admin.partials.image-library-modal')
@endonce
