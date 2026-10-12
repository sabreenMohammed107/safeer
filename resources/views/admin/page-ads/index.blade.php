@extends('layout.main')

@section('breadcrumb')
    <div class="toolbar" id="kt_toolbar">
        <div class="container-fluid d-flex flex-stack flex-wrap flex-sm-nowrap">
            <div class="d-flex flex-column align-items-start justify-content-center flex-wrap me-2">
                <h1 class="text-dark fw-bolder my-1 fs-2">Page Ads</h1>
                <ul class="breadcrumb fw-bold fs-base my-1">
                    <li class="breadcrumb-item text-muted">Home</li>
                    <li class="breadcrumb-item text-dark">Page Ads</li>
                </ul>
            </div>
        </div>
    </div>
@endsection

@section('content')
    <div class="post fs-6 d-flex flex-column-fluid" id="kt_post">
        <div class="container-xxl">
            <div class="text-muted mb-7">
                The promotional banner shown on each page. Recommended image size:
                <strong>{{ \App\Models\PageAdvertisement::RECOMMENDED_SIZE }} px</strong> (portrait).
            </div>
            <div class="row g-7">
                @foreach ($ads as $ad)
                    @php $images = $ad->images(); @endphp
                    <div class="col-md-6 col-xl-4">
                        <div class="card card-flush h-100 page-ad-card" data-page="{{ $ad->page_type }}">
                            <div class="card-header pt-7">
                                <div class="card-title flex-column">
                                    <h3 class="fw-bolder mb-1">{{ \App\Models\PageAdvertisement::PAGES[$ad->page_type] }}</h3>
                                    <span class="text-muted fs-7">/{{ $ad->page_type === 'transport' ? 'transfers' : $ad->page_type }}</span>
                                </div>
                                <div class="card-toolbar">
                                    @if ($ad->is_active && $images)
                                        <span class="badge badge-light-success page-ad-status">Enabled</span>
                                    @elseif ($ad->is_active)
                                        <span class="badge badge-light-warning page-ad-status">Enabled — no image</span>
                                    @else
                                        <span class="badge badge-light-danger page-ad-status">Disabled</span>
                                    @endif
                                </div>
                            </div>
                            <div class="card-body d-flex flex-column">
                                <div class="d-flex gap-2 mb-5 overflow-auto">
                                    @forelse ($images as $image)
                                        <img src="{{ $ad->imageUrl($image) }}" alt="" class="rounded border"
                                            style="width: 70px; height: 100px; object-fit: cover;">
                                    @empty
                                        <div class="rounded border border-dashed d-flex align-items-center justify-content-center text-muted fs-8"
                                            style="width: 70px; height: 100px;">No image</div>
                                    @endforelse
                                </div>
                                <div class="fs-7 mb-2">
                                    <span class="text-muted">Type:</span>
                                    <strong>{{ $ad->media_type === 'slider' ? 'Slider (' . count($images) . ' images)' : 'Single image' }}</strong>
                                </div>
                                <div class="fs-7 mb-7 text-break">
                                    <span class="text-muted">Link:</span>
                                    @if ($ad->offer)
                                        <strong>Offer: {{ $ad->offer->subtitle_en }}</strong>
                                    @elseif ($ad->link_url)
                                        <strong>{{ $ad->link_url }}</strong>
                                    @else
                                        <span class="text-muted">None</span>
                                    @endif
                                </div>
                                <a href="{{ route('page-ads.edit', $ad->page_type) }}" class="btn btn-primary mt-auto">Edit</a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection
