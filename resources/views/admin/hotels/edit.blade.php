@extends('layout.main')

@section('breadcrumb')
    <div class="toolbar" id="kt_toolbar">
        <div class="container-fluid d-flex flex-stack flex-wrap flex-sm-nowrap">
            <!--begin::Info-->
            <div class="d-flex flex-column align-items-start justify-content-center flex-wrap me-2">
                <!--begin::Title-->
                <h1 class="text-dark fw-bolder my-1 fs-2">Hotels</h1>
                <!--end::Title-->
                <!--begin::Breadcrumb-->
                <ul class="breadcrumb fw-bold fs-base my-1">
                    <li class="breadcrumb-item text-muted">
                        <a href="../dist/index.html" class="text-muted text-hover-primary">Home</a>
                    </li>
                    <li class="breadcrumb-item text-muted">Hotels</li>

                    <li class="breadcrumb-item text-dark">All</li>
                </ul>
                <!--end::Breadcrumb-->
            </div>
            <!--end::Info-->

        </div>
    </div>
@endsection

@section('content')
    <!--begin::Post-->
    <div class="post fs-6 d-flex flex-column-fluid" id="kt_post">
        <!--begin::Container-->
        <div class="container-xxl">
            <form id="kt_ecommerce_add_category_form" class="form d-flex flex-column flex-lg-row"
            action="{{ route('hotels.update', $hotel->id) }}" method="post" enctype="multipart/form-data">
            @csrf
            @method('PUT')
 <!--begin::Aside column-->
 <div class="d-flex flex-column gap-7 gap-lg-10 w-100 w-lg-300px mb-7 me-lg-10">
          <!--begin::Thumbnail settings-->
          <div class="card card-flush py-4">
            <!--begin::Card header-->
            <div class="card-header">
                <!--begin::Card title-->
                <div class="card-title">
                    <h2> Edit Thumbnail</h2>
                </div>
                <!--end::Card title-->
            </div>
            <!--end::Card header-->
            <!--begin::Image input wrapper-->
            <div class="card-body text-center pt-0">
                <!--begin::Image input-->
                <div class="image-input image-input-empty image-input-outline mb-3" data-kt-image-input="true"
                    style="background-image: url('{{ asset('uploads/hotels') }}/{{ $hotel->hotel_logo }}')">
                    <div class="image-input-wrapper w-150px h-150px"
                        style="background-image: url(' {{ asset('uploads/hotels') }}/{{ $hotel->hotel_logo }}')">

                    </div>
                    <!--end::Preview existing avatar-->
                    <!--begin::Edit-->
                    <label class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow"
                        data-kt-image-input-action="change" data-bs-toggle="tooltip" title="Change avatar">
                        <i class="bi bi-pencil-fill fs-7"></i>
                        <!--begin::Inputs-->
                        <input type="file" name="hotel_logo" accept=".png, .jpg, .jpeg" />
                        <input type="hidden" name="avatar_remove" />
                        <!--end::Inputs-->
                    </label>
                    <!--end::Edit-->

                </div>
                <!--end::Image input-->
            </div>
            <!--end::Image input wrapper-->
        </div>
        <!--end::Thumbnail settings-->

      <!--begin::Thumbnail settings-->
      <div class="card card-flush py-4">
        <!--begin::Card header-->
        <div class="card-header">
            <!--begin::Card title-->
            <div class="card-title">
                <h2> Edit Thumbnail</h2>
            </div>
            <!--end::Card title-->
        </div>
        <!--end::Card header-->
        <!--begin::Image input wrapper-->
        <div class="card-body text-center pt-0">
            <!--begin::Image input-->
            <div class="image-input image-input-empty image-input-outline mb-3" data-kt-image-input="true"
                style="background-image: url('{{ asset('uploads/hotels') }}/{{ $hotel->hotel_banner }}')">
                <div class="image-input-wrapper w-150px h-150px"
                    style="background-image: url(' {{ asset('uploads/hotels') }}/{{ $hotel->hotel_banner }}')">

                </div>
                <!--end::Preview existing avatar-->
                <!--begin::Edit-->
                <label class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow"
                    data-kt-image-input-action="change" data-bs-toggle="tooltip" title="Change avatar">
                    <i class="bi bi-pencil-fill fs-7"></i>
                    <!--begin::Inputs-->
                    <input type="file" name="hotel_banner" accept=".png, .jpg, .jpeg" />
                    <input type="hidden" name="avatar_remove" />
                    <!--end::Inputs-->
                </label>
                <!--end::Edit-->

            </div>
            <!--end::Image input-->
        </div>
        <!--end::Image input wrapper-->
    </div>
    <!--end::Thumbnail settings-->
</div>
<!--end::Aside column-->
                <!--begin::Main column-->
                <div class="d-flex flex-column flex-row-fluid gap-7 gap-lg-10">
                    <!--begin::General options-->
                    <div class="card card-flush py-4">
                        <!--begin::Card header-->
                        <div class="card-header">
                            <div class="card-title">
                                <h2>General</h2>
                            </div>
                        </div>
                        <!--end::Card header-->
                        <!--begin::Card body-->
                        <div class="card-body pt-0">
                            <!--begin::Input group-->
                            <div class="mb-10 fv-row">
                                <!--begin::Label-->
                                <label class="required form-label">Hotel En Name</label>
                                <!--end::Label-->
                                <!--begin::Input-->
                                <input type="text" name="hotel_enname" value="{{$hotel->hotel_enname}}" class="form-control mb-2" placeholder="Hotel En name"
                                    value="" />


                            </div>
                            <!--end::Input-->

                               <!--begin::Input group-->
                               <div class="mb-10 fv-row">
                                <!--begin::Label-->
                                <label class="required form-label">Hotel Ar Name</label>
                                <!--end::Label-->
                                <!--begin::Input-->
                                <input type="text" name="hotel_arname" value="{{$hotel->hotel_arname}}" class="form-control mb-2" placeholder="Hotel Ar name"
                                    value="" />


                            </div>
                            <!--end::Input-->



                            <!--begin::Input group-->
                            <div class="fv-row mb-7">
                                <!--begin::Label-->
                                <label class="fs-6 fw-bold form-label mt-3">
                                    <option value="">Select City..</option>
                                    {{-- <i class="fas fa-exclamation-circle ms-1 fs-7" data-bs-toggle="tooltip" title="Interviewer who conducts the meeting with the interviewee"></i> --}}
                                </label>
                                <!--end::Label-->
                                <select class="form-select form-select-solid" name="city_id" data-control="select2"
                                    data-placeholder="Select an option">
                                    <option value=""></option>
                                    @foreach ($cities as $city)
                                        <option value="{{ $city->id }}" {{ $hotel->city_id == $city->id ? 'selected' : '' }} >{{ $city->en_city }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <!--end::Input group-->


                            <!--begin::Input group-->
                            <div class="fv-row mb-7">
                                <!--begin::Label-->
                                <label class="fs-6 fw-bold form-label mt-3">
                                    <option value="">Select Type..</option>
                                    {{-- <i class="fas fa-exclamation-circle ms-1 fs-7" data-bs-toggle="tooltip" title="Interviewer who conducts the meeting with the interviewee"></i> --}}
                                </label>
                                <!--end::Label-->
                                <select class="form-select form-select-solid" name="hotel_type_id" data-control="select2"
                                    data-placeholder="Select an option">
                                    <option value=""></option>
                                    @foreach ($types as $type)
                                        <option value="{{ $type->id }}" {{ $hotel->hotel_type_id  == $type->id ? 'selected' : '' }}>{{ $type->en_room_type }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <!--end::Input group-->
<!--begin::Input group-->
<div>
    <!--begin::Label-->
    <label class="form-label">En Overview</label>
    <!--end::Label-->
    <!--begin::Editor-->
    <textarea class="form-control form-control-solid" rows="3" name="hotel_enoverview"
        placeholder="Type Hotel En Overview">{{$hotel->hotel_enoverview}}</textarea>
    <!--end::Editor-->

</div>
<!--end::Input group-->
<!--begin::Input group-->
<div>
    <!--begin::Label-->
    <label class="form-label">Ar Overview</label>
    <!--end::Label-->
    <!--begin::Editor-->
    <textarea class="form-control form-control-solid" rows="3" name="hotel_aroverview"
        placeholder="Type Hotel Ar Overview">{{$hotel->hotel_aroverview}}</textarea>
    <!--end::Editor-->

</div>
<!--end::Input group-->

<!--begin::Input group-->
<div>
    <!--begin::Label-->
    <label class="form-label">En Brief</label>
    <!--end::Label-->
    <!--begin::Editor-->
    <textarea class="form-control form-control-solid" rows="3" name="hotel_enbrief"
        placeholder="Type Hotel En Breif">{{$hotel->hotel_enbrief}}</textarea>
    <!--end::Editor-->

</div>
<!--end::Input group-->
<!--begin::Input group-->
<div>
    <!--begin::Label-->
    <label class="form-label">Ar Breif</label>
    <!--end::Label-->
    <!--begin::Editor-->
    <textarea class="form-control form-control-solid" rows="3" name="hotel_arbrief"
        placeholder="Type Hotel Ar Breif">{{$hotel->hotel_arbrief}}</textarea>
    <!--end::Editor-->

</div>
<!--end::Input group-->
<!--begin::Input group-->
<div>
    <!--begin::Label-->
    <label class="form-label">En Address</label>
    <!--end::Label-->
    <!--begin::Editor-->
    <textarea class="form-control form-control-solid" rows="3" name="details_enaddress"
        placeholder="Type Hotel En Address">{{$hotel->details_enaddress}}</textarea>
    <!--end::Editor-->

</div>
<!--end::Input group-->
<!--begin::Input group-->
<div>
    <!--begin::Label-->
    <label class="form-label">Ar Address</label>
    <!--end::Label-->
    <!--begin::Editor-->
    <textarea class="form-control form-control-solid" rows="3" name="details_araddress"
        placeholder="Type Hotel Ar Address">{{$hotel->details_araddress}}</textarea>
    <!--end::Editor-->

</div>
<!--end::Input group-->

                            <!--begin::Input group-->
                            <div class="fv-row w-100 flex-md-root">
                                <label class="required form-label">Hotel Stars</label>
                                <!--end::Label-->
                                <!--begin::Input-->
                                <input type="number" min="1" max="5" name="hotel_stars" class="form-control mb-2"
                                    placeholder="hotel_stars" value="{{$hotel->hotel_stars}}" />
                                <!--end::Input-->
                            </div>
                            <!--end::Input group-->

	<!--begin::Input group-->
    <div class="fv-row mb-7">
        <!--begin::Label-->
        <label class="fs-6 fw-bold form-label mt-3">
            <span class="required">Add Features</span>
            <i class="fas fa-exclamation-circle ms-1 fs-7" data-bs-toggle="tooltip" title="Interviewer who conducts the meeting with the interviewee"></i>
        </label>
        <!--end::Label-->
        <select class="form-select form-select-solid" name="features[]" data-control="select2" data-placeholder="Select an option" data-allow-clear="true" multiple="multiple">
            <option></option>

            @foreach ($features as $feature)
            <option value="{{$feature->id}}"
                @foreach ($hotelFeatures as $sublist) {{ $sublist->pivot->feature_id  == $feature->id ? 'selected' : '' }} @endforeach>
                {{$feature->en_feature}}
            </option>
        @endforeach

        </select>
    </div>
    <!--end::Input group-->








                            <!--begin::checkbox-->

                            <div class="d-flex flex-wrap gap-5 mt-4">
                                <!--begin::Input group-->
                                <div class="fv-row w-100 flex-md-root">
                                    <div class="form-check form-switch form-check-custom form-check-solid">
                                        <input class="form-check-input" type="checkbox" name="active[]" value="1"
                                            id="flexSwitchDefault" {{ $hotel->active == 1 ? ' checked' : '' }} />
                                        <label class="form-check-label" for="flexSwitchDefault">
                                            Active
                                        </label>
                                    </div>
                                </div>
                                <!--end::Input group-->

                            </div>
                            <!--end:checkbox-->

                        </div>
                        <!--end::Card header-->
                    </div>
                    <!--end::General options-->


                    <div class="d-flex justify-content-end">
                        <!--begin::Button-->
                        <a href="{{ route('hotels.index') }}" id="kt_ecommerce_add_product_cancel"
                            class="btn btn-light me-5">Cancel</a>
                        <!--end::Button-->
                        <!--begin::Button-->
                        <button type="submit" id="kt_ecommerce_add_category_submit" class="btn btn-primary">
                            <span class="indicator-label">Save Changes</span>
                            <span class="indicator-progress">Please wait...
                                <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                        </button>
                        <!--end::Button-->
                    </div>
                </div>
                <!--end::Main column-->
            </form>
        </div>
        <!--end::Container-->
    </div>
    <!--end::Post-->
@endsection
@section('scripts')
    <script>
        $("#kt_datepicker_1").flatpickr();
        $("#kt_datepicker_2").flatpickr();
        $("#kt_datepicker_8").flatpickr({
            enableTime: true,
            noCalendar: true,
            dateFormat: "H:i",
        });

        $("#kt_datepicker_7").flatpickr({
            enableTime: true,
            noCalendar: true,
            dateFormat: "H:i",
        });
    </script>
@endsection
