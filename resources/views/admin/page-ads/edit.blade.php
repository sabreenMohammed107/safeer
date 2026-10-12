@extends('layout.main')

@php
    $pageLabel = \App\Models\PageAdvertisement::PAGES[$ad->page_type];
    $mediaType = old('media_type', $ad->media_type);
    $offerId = old('offer_id', $ad->offer_id);
@endphp

@section('breadcrumb')
    <div class="toolbar" id="kt_toolbar">
        <div class="container-fluid d-flex flex-stack flex-wrap flex-sm-nowrap">
            <div class="d-flex flex-column align-items-start justify-content-center flex-wrap me-2">
                <h1 class="text-dark fw-bolder my-1 fs-2">Page Ads</h1>
                <ul class="breadcrumb fw-bold fs-base my-1">
                    <li class="breadcrumb-item text-muted">
                        <a href="{{ route('page-ads.index') }}" class="text-muted text-hover-primary">Page Ads</a>
                    </li>
                    <li class="breadcrumb-item text-dark">{{ $pageLabel }}</li>
                </ul>
            </div>
        </div>
    </div>
@endsection

@section('content')
    <div class="post fs-6 d-flex flex-column-fluid" id="kt_post">
        <div class="container-xxl">
            @if ($errors->any())
                <div class="alert alert-danger">
                    @foreach ($errors->all() as $error)
                        <div>{{ $error }}</div>
                    @endforeach
                </div>
            @endif

            <form class="form d-flex flex-column flex-lg-row gap-7 gap-lg-10" id="page_ad_form"
                action="{{ route('page-ads.update', $ad->page_type) }}" method="post" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <!--begin::Aside column-->
                <div class="d-flex flex-column gap-7 w-100 w-lg-300px">
                    <div class="card card-flush py-4">
                        <div class="card-header">
                            <div class="card-title">
                                <h2>Status</h2>
                            </div>
                        </div>
                        <div class="card-body pt-0">
                            <input type="hidden" name="is_active" value="0">
                            <div class="form-check form-switch form-check-custom form-check-solid">
                                <input class="form-check-input" type="checkbox" name="is_active" value="1" id="is_active"
                                    {{ old('is_active', $ad->is_active) ? 'checked' : '' }} />
                                <label class="form-check-label fw-bold" for="is_active">Show the ad on the {{ strtolower($pageLabel) }}</label>
                            </div>
                            <div class="text-muted fs-7 mt-3">When off (or with no image) the page shows no ad and no empty space.</div>
                        </div>
                    </div>

                    <div class="card card-flush py-4">
                        <div class="card-header">
                            <div class="card-title">
                                <h2>Type</h2>
                            </div>
                        </div>
                        <div class="card-body pt-0 d-flex flex-column gap-4">
                            @foreach (['image' => ['Single image', 'One banner image.'], 'slider' => ['Slider', 'Several images that rotate automatically (at least 2).']] as $value => [$label, $hint])
                                <label class="form-check form-check-custom form-check-solid align-items-start">
                                    <input class="form-check-input mt-1" type="radio" name="media_type" value="{{ $value }}"
                                        {{ $mediaType === $value ? 'checked' : '' }}>
                                    <span class="form-check-label ms-3">
                                        <span class="fw-bolder d-block">{{ $label }}</span>
                                        <span class="text-muted fs-7">{{ $hint }}</span>
                                    </span>
                                </label>
                            @endforeach
                        </div>
                    </div>
                </div>
                <!--end::Aside column-->

                <!--begin::Main column-->
                <div class="d-flex flex-column flex-row-fluid gap-7">
                    <div class="card card-flush py-4">
                        <div class="card-header">
                            <div class="card-title flex-column">
                                <h2>Images</h2>
                                <span class="text-muted fs-7 fw-normal">
                                    Recommended size: <strong>{{ \App\Models\PageAdvertisement::RECOMMENDED_SIZE }} px</strong> (portrait 7:10).
                                    Other sizes are cropped to fit.
                                    <span data-media-hint="image" @if ($mediaType !== 'image') style="display:none" @endif>A new image replaces the current one.</span>
                                    <span data-media-hint="slider" @if ($mediaType !== 'slider') style="display:none" @endif>New images are added after the current ones.</span>
                                </span>
                            </div>
                        </div>
                        <div class="card-body pt-0">
                            @if ($ad->image_path)
                                <div class="d-flex flex-wrap gap-4 mb-7" id="current_images">
                                    @foreach ($ad->image_path as $i => $image)
                                        <label class="position-relative d-block text-center current-ad-image">
                                            <img src="{{ $ad->imageUrl($image) }}" alt="" class="rounded border"
                                                style="width: 105px; height: 150px; object-fit: cover;">
                                            <span class="d-flex align-items-center justify-content-center gap-2 mt-2 fs-7">
                                                <input type="checkbox" class="form-check-input" name="remove_images[]" value="{{ $image }}"
                                                    {{ in_array($image, (array) old('remove_images', [])) ? 'checked' : '' }}>
                                                Remove
                                            </span>
                                            @if ($i === 0)
                                                <span class="badge badge-primary position-absolute top-0 start-0 m-1">1st</span>
                                            @endif
                                        </label>
                                    @endforeach
                                </div>
                            @endif

                            <div class="mw-400px">
                                @include('admin.partials.image-picker', ['name' => 'images[]', 'multiple' => true])
                            </div>
                        </div>
                    </div>

                    <div class="card card-flush py-4">
                        <div class="card-header">
                            <div class="card-title flex-column">
                                <h2>Link</h2>
                                <span class="text-muted fs-7 fw-normal">Where visitors go when they click the ad.</span>
                            </div>
                        </div>
                        <div class="card-body pt-0">
                            <div class="mb-8 fv-row" id="offer_select_wrap">
                                <label class="form-label">Linked offer</label>
                                <select name="offer_id" id="offer_id" class="form-select form-select-solid" data-control="select2"
                                    data-dropdown-parent="#offer_select_wrap" data-placeholder="— No offer —" data-allow-clear="true">
                                    <option value=""></option>
                                    @foreach ($offers as $offer)
                                        <option value="{{ $offer->id }}" {{ (string) $offerId === (string) $offer->id ? 'selected' : '' }}>
                                            {{ $offer->subtitle_en }} (#{{ $offer->id }}{{ $offer->active ? '' : ', inactive' }}{{ $offer->period_status === 'expired' ? ', expired' : '' }})
                                        </option>
                                    @endforeach
                                </select>
                                <div class="text-muted fs-7 mt-2">The ad links to this offer's page automatically (in the visitor's language).</div>
                            </div>

                            <div class="fv-row">
                                <label class="form-label">Or a custom link</label>
                                <input type="url" name="link_url" id="link_url" class="form-control mb-2 @error('link_url') is-invalid @enderror"
                                    placeholder="https://…" value="{{ old('link_url', $ad->link_url) }}" @if ($offerId) disabled @endif>
                                <div class="text-muted fs-7">Used only when no offer is selected.</div>
                            </div>
                        </div>
                    </div>

                    <div class="d-flex justify-content-end">
                        <a href="{{ route('page-ads.index') }}" class="btn btn-light me-5">Cancel</a>
                        <button type="submit" class="btn btn-primary">Save Changes</button>
                    </div>
                </div>
                <!--end::Main column-->
            </form>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Custom link only applies when no offer is linked.
            var link = document.getElementById('link_url');
            $('#offer_id').on('change', function() {
                link.disabled = !!this.value;
            });

            // Explain what a new upload does for the chosen type.
            document.querySelectorAll('input[name="media_type"]').forEach(function(radio) {
                radio.addEventListener('change', function() {
                    document.querySelectorAll('[data-media-hint]').forEach(function(hint) {
                        hint.style.display = hint.dataset.mediaHint === radio.value ? '' : 'none';
                    });
                });
            });
        });
    </script>
@endsection
