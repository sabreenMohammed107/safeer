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
                action="{{ route('hotels.store') }}" method="post" enctype="multipart/form-data">
                @csrf
                <!--begin::Aside column-->
                <div class="d-flex flex-column gap-7 gap-lg-10 w-100 w-lg-300px mb-7 me-lg-10">
                    <!--begin::Thumbnail settings-->
                    {{-- <div class="card card-flush py-4">
        <!--begin::Card header-->
        <div class="card-header">
            <!--begin::Card title-->
            <div class="card-title">
                <h2>Thumbnail</h2>
            </div>
            <!--end::Card title-->
        </div>
        <!--end::Card header-->
        <!--begin::Card body-->
        <div class="card-body text-center pt-0">
            <!--begin::Image input-->
            <div class="image-input image-input-empty image-input-outline mb-3" data-kt-image-input="true" style="background-image: url(assets/media/svg/files/blank-image.svg)">
                <!--begin::Preview existing avatar-->
                <div class="image-input-wrapper w-150px h-150px"></div>
                <!--end::Preview existing avatar-->
                <!--begin::Label-->
                <label class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow" data-kt-image-input-action="change" data-bs-toggle="tooltip" title="Change avatar">
                    <!--begin::Icon-->
                    <i class="bi bi-pencil-fill fs-7"></i>
                    <!--end::Icon-->
                    <!--begin::Inputs-->
                    <input type="file" name="hotel_logo" accept=".png, .jpg, .jpeg" />
                    <input type="hidden" name="avatar_remove" />
                    <!--end::Inputs-->
                </label>
                <!--end::Label-->
                <!--begin::Cancel-->
                <span class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow" data-kt-image-input-action="cancel" data-bs-toggle="tooltip" title="Cancel avatar">
                    <i class="bi bi-x fs-2"></i>
                </span>
                <!--end::Cancel-->
                <!--begin::Remove-->
                <span class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow" data-kt-image-input-action="remove" data-bs-toggle="tooltip" title="Remove avatar">
                    <i class="bi bi-x fs-2"></i>
                </span>
                <!--end::Remove-->
            </div>
            <!--end::Image input-->

        </div>
        <!--end::Card body-->
    </div> --}}
                    <!--end::Thumbnail settings-->

                    <!--begin::Thumbnail settings-->
                    <div class="card card-flush py-4">
                        <!--begin::Card header-->
                        <div class="card-header">
                            <!--begin::Card title-->
                            <div class="card-title">
                                <h2>Banner</h2>
                            </div>
                            <!--end::Card title-->
                        </div>
                        <!--end::Card header-->
                        <!--begin::Card body-->
                        <div class="card-body text-center pt-0">
                            <!--begin::Image input-->
                            <div class="image-input image-input-empty image-input-outline mb-3" data-kt-image-input="true"
                                style="background-image: url(assets/media/svg/files/blank-image.svg)">
                                <!--begin::Preview existing avatar-->
                                <div class="image-input-wrapper w-150px h-150px"></div>
                                <!--end::Preview existing avatar-->
                                <!--begin::Label-->
                                <label class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow"
                                    data-kt-image-input-action="change" data-bs-toggle="tooltip" title="Change avatar">
                                    <!--begin::Icon-->
                                    <i class="bi bi-pencil-fill fs-7"></i>
                                    <!--end::Icon-->
                                    <!--begin::Inputs-->
                                    <input type="file" name="hotel_banner" accept=".png, .jpg, .jpeg" />
                                    <input type="hidden" name="avatar_remove" />
                                    <!--end::Inputs-->
                                </label>
                                <!--end::Label-->
                                <!--begin::Cancel-->
                                <span class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow"
                                    data-kt-image-input-action="cancel" data-bs-toggle="tooltip" title="Cancel avatar">
                                    <i class="bi bi-x fs-2"></i>
                                </span>
                                <!--end::Cancel-->
                                <!--begin::Remove-->
                                <span class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow"
                                    data-kt-image-input-action="remove" data-bs-toggle="tooltip" title="Remove avatar">
                                    <i class="bi bi-x fs-2"></i>
                                </span>
                                <!--end::Remove-->
                            </div>
                            <!--end::Image input-->

                        </div>
                        <!--end::Card body-->
                    </div>
                    <!--end::Thumbnail settings-->
                </div>
                <!--end::Aside column-->
                <!--begin::Main column-->
                <div class="d-flex flex-column flex-row-fluid gap-7 gap-lg-10">
                    <!--begin:::Tabs-->
                    <ul class="nav nav-custom nav-tabs nav-line-tabs nav-line-tabs-2x border-0 fs-4 fw-bold mb-n2">
                        <!--begin:::Tab item-->
                        <li class="nav-item">
                            <a class="nav-link text-active-primary pb-4 active" data-bs-toggle="tab"
                                href="#kt_ecommerce_add_product_general">General</a>
                        </li>
                        <!--end:::Tab item-->
                        <!--begin:::Tab item-->
                        {{-- <li class="nav-item">
                            <a class="nav-link text-active-primary pb-4" data-bs-toggle="tab"
                                href="#kt_ecommerce_add_product_advanced">Room Type</a>
                        </li> --}}
                        <!--end:::Tab item-->

                        <!--begin:::Tab item-->
                        {{-- <li class="nav-item">
                           <a class="nav-link text-active-primary pb-4" data-bs-toggle="tab"
                               href="#kt_ecommerce_add_days_advanced">Days</a>
                       </li> --}}
                        <!--end:::Tab item-->
                    </ul>
                    <!--end:::Tabs-->
                    <div class="tab-content">
                        <!--begin::Tab pane-->
                        <div class="tab-pane fade show active" id="kt_ecommerce_add_product_general" role="tab-panel">
                            <div class="d-flex flex-column gap-7 gap-lg-10">
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
                                        <!--begin::Input group-->
                                        <div class="d-flex flex-wrap gap-5">
                                            <!--begin::Input group-->
                                            <div class="fv-row w-100 flex-md-root">
                                                <!--begin::Label-->
                                                <label class="required form-label">Hotel En Name</label>
                                                <!--end::Label-->
                                                <!--begin::Input-->
                                                <input type="text" required name="hotel_enname" class="form-control mb-2"
                                                    placeholder="Hotel En name" value="" />


                                            </div>
                                            <!--end::Input-->

                                            <!--begin::Input group-->
                                            <div class="fv-row w-100 flex-md-root">
                                                <!--begin::Label-->
                                                <label class="required form-label">Hotel Ar Name</label>
                                                <!--end::Label-->
                                                <!--begin::Input-->
                                                <input type="text" name="hotel_arname" class="form-control mb-2"
                                                    placeholder="Hotel Ar name" value="" />


                                            </div>
                                        </div>
                                        <!--end::Input-->

                                        <div class="d-flex flex-wrap gap-5">
                                            <!--begin::Input group-->
                                            <div class="fv-row w-100 flex-md-root">
                                                <label class="fs-6 fw-bold form-label mt-3">
                                                    <option value="">Select Country..</option>
                                                    {{-- <i class="fas fa-exclamation-circle ms-1 fs-7" data-bs-toggle="tooltip" title="Interviewer who conducts the meeting with the interviewee"></i> --}}
                                                </label>
                                                <!--end::Label-->
                                                <select required class="form-select form-select-solid dynamic"
                                                    data-control="select2" data-placeholder="Select an option" required
                                                    data-show-subtext="true" data-live-search="true" id="country"
                                                    data-dependent="sub">
                                                    <option value=""></option>
                                                    @foreach ($countries as $country)
                                                        <option value="{{ $country->id }}">{{ $country->en_country }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <!--begin::Input group-->
                                            <div class="fv-row w-100 flex-md-root">
                                                <label class="fs-6 fw-bold form-label mt-3">
                                                    <option value="">Select City..</option>
                                                    {{-- <i class="fas fa-exclamation-circle ms-1 fs-7" data-bs-toggle="tooltip" title="Interviewer who conducts the meeting with the interviewee"></i> --}}
                                                </label>
                                                <!--end::Label-->
                                                <select required class="form-select form-select-solid" name="city_id"
                                                    data-control="select2" data-placeholder="Select an option"
                                                    data-show-subtext="true" data-live-search="true" id="sub">
                                                    <option value="">select....</option>
                                                </select>
                                            </div>
                                        </div>




                                        <!--begin::Input group-->
                                        <div class="d-flex flex-wrap gap-5">
                                            <!--begin::Input group-->
                                            <div class="fv-row w-100 flex-md-root">
                                                <label class="fs-6 fw-bold form-label mt-3">
                                                    <option value="">Select Zone Type..</option>
                                                </label>
                                                <select  class="form-select form-select-solid"
                                                    name="zone_id" data-control="select2"
                                                    data-placeholder="Select an option">
                                                    <option value=""></option>
                                                    @foreach ($zones as $zone)
                                                        <option value="{{ $zone->id }}">{{ $zone->en_zone }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <!--begin::Input group-->
                                            <div class="fv-row w-100 flex-md-root">
                                                <!--begin::Label-->
                                                <label class="fs-6 fw-bold form-label mt-3">
                                                    <span class="required">Add Features</span>
                                                    <i class="fas fa-exclamation-circle ms-1 fs-7"
                                                        data-bs-toggle="tooltip"
                                                        title="Interviewer who conducts the meeting with the interviewee"></i>
                                                </label>
                                                <!--end::Label-->
                                                <select required class="form-select form-select-solid" name="features[]"
                                                    data-control="select2" data-placeholder="Select an option"
                                                    data-allow-clear="true" multiple="multiple">
                                                    <option></option>
                                                    @foreach ($features as $feature)
                                                        <option value="{{ $feature->id }}">{{ $feature->en_feature }}
                                                        </option>
                                                    @endforeach

                                                </select>
                                            </div>
                                            <!--end::Input group-->


                                            <!--rooms -->
                                              <!--begin::Input group-->
                                               <div class="fv-row w-100 flex-md-root">

                                                <label class="fs-6 fw-bold form-label mt-3">
                                                    <span class="required">Add Tags</span>
                                                    <i class="fas fa-exclamation-circle ms-1 fs-7"
                                                        data-bs-toggle="tooltip"
                                                        title="Interviewer who conducts the meeting with the interviewee"></i>
                                                </label>

                                                <select required class="form-select form-select-solid" name="tags[]"
                                                    data-control="select2" data-placeholder="Select an option"
                                                    data-allow-clear="true" multiple="multiple">
                                                    <option></option>
                                                    @foreach ($tags as $tag)
                                                        <option value="{{ $tag->id }}">{{ $tag->en_tag ?? '' }}
                                                        </option>
                                                    @endforeach

                                                </select>
                                            </div>
                                            <!--end::Input group-->
                                        </div>
                                        <!--end::Input group-->
                                        <!--begin::Input group-->
                                        <div>
                                            <!--begin::Label-->
                                            <label class="form-label">En Overview</label>
                                            <!--end::Label-->
                                            <!--begin::Editor-->
                                            <textarea class="form-control form-control-solid" rows="3" name="hotel_enoverview"
                                                placeholder="Type Hotel En Overview"></textarea>
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
                                                placeholder="Type Hotel Ar Overview"></textarea>
                                            <!--end::Editor-->

                                        </div>

                                        <!--begin::Input group-->
                                        <div>
                                            <!--begin::Label-->
                                            <label class="form-label">En Brief</label>
                                            <!--end::Label-->
                                            <!--begin::Editor-->
                                            <textarea class="form-control form-control-solid" rows="3" name="hotel_enbrief"
                                                placeholder="Type Hotel En Breif"></textarea>
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
                                                placeholder="Type Hotel Ar Breif"></textarea>
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
                                                placeholder="Type Hotel En Address"></textarea>
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
                                                placeholder="Type Hotel Ar Address"></textarea>
                                            <!--end::Editor-->

                                        </div>
                                        <!--end::Input group-->
                                        <div class="d-flex flex-wrap gap-5">
                                            <!--begin::Input group-->
                                            <div class="fv-row w-100 flex-md-root">
                                                <label class="required form-label">Hotel Stars</label>
                                                <!--end::Label-->
                                                <!--begin::Input-->
                                                <input required type="number" min="1" max="5"
                                                    name="hotel_stars" class="form-control mb-2"
                                                    placeholder="hotel_stars" value="1" />
                                                <!--end::Input-->
                                            </div>
                                            <!--end::Input group-->



                                            <div class="fv-row w-100 flex-md-root">
                                                <label class=" form-label">Google Map</label>
                                                <!--end::Label-->
                                                <!--begin::Input-->
                                                <input type="text" name="google_map" class="form-control mb-2"
                                                    placeholder="google_map" value="" />
                                                <!--end::Input-->
                                            </div>

                                        </div>
                                        <div class="d-flex flex-wrap gap-5">
                                            <div class="fv-row w-100 flex-md-root">
                                                <label class=" form-label">Google pace</label>
                                                <!--end::Label-->
                                                <!--begin::Input-->
                                                <input type="text" name="google_place" class="form-control mb-2"
                                                    placeholder="google_place" value="" />
                                                <!--end::Input-->
                                            </div>
                                        </div>
                                        <div class="d-flex flex-wrap gap-5">
                                            <div class="fv-row w-100 flex-md-root">
                                                <label class=" form-label">Google reviews link</label>
                                                <!--end::Label-->
                                                <!--begin::Input-->
                                                <input type="text" name="google_reviews" class="form-control mb-2"
                                                    placeholder="google_reviews" value="" />
                                                <!--end::Input-->
                                            </div>
                                        </div>
 <!--end::Input group-->
 <div class="d-flex flex-wrap gap-5">
 <div class="fv-row w-100 flex-md-root">
    <label class="form-label">Keywords</label>
<br>
    <input type="text" name="keywords" id="keywords" class="typeahead form-control nosubmit" value="{{ old('keywords') }}"
       data-role="tagsinput" />
    @if($errors->has('keywords'))
    <strong class="text-danger">{{ $errors->first('keywords') }}</strong>
    @endif
 </div>
 </div>
                                        <div class="d-flex flex-wrap gap-5">
                                            <div class="fv-row w-100 flex-md-root">
                                                <label class=" form-label">Url Vedio</label>
                                                <!--end::Label-->
                                                <!--begin::Input-->
                                                <input type="url" name="hotel_vedio" class="form-control mb-2"
                                                    placeholder="hotel_vedio" value="" />
                                                <!--end::Input-->
                                            </div>


                                            <!--begin::checkbox-->

                                            <div class="d-flex flex-wrap gap-5 mt-4">
                                                <!--begin::Input group-->
                                                <div class="fv-row w-100 flex-md-root">
                                                    <div class="form-check form-switch form-check-custom form-check-solid">
                                                        <input class="form-check-input" type="checkbox" name="active[]"
                                                            value="1" id="flexSwitchDefault" />
                                                        <label class="form-check-label" for="flexSwitchDefault">
                                                            Active
                                                        </label>
                                                    </div>
                                                </div>
                                                <!--end::Input group-->

                                            </div>
                                        </div>
                                        <!--end:checkbox-->

                                    </div>
                                    <!--end::Card header-->
                                </div>
                                <!--end::General options-->
                                <!--end::General options-->
                            </div>
                        </div>
                        {{-- tab 2  --}}
                        <!--begin::Tab pane-->
                        <div class="tab-pane fade" id="kt_ecommerce_add_product_advanced" role="tab-panel">
                            <div class="d-flex flex-column gap-7 gap-lg-10">

                                <!--begin::Variations-->
                                <div class="card card-flush py-4">
                                    <!--begin::Card header-->
                                    <div class="card-header">
                                        <div class="card-title">
                                            <h2>Room Types</h2>
                                        </div>
                                    </div>
                                    <!--end::Card header-->
                                    <!--begin::Card body-->
                                    <div class="card-body pt-0">
                                        <!--begin::Input group-->
                                        <div class="" data-kt-ecommerce-catalog-add-product="auto-options">
                                            <!--begin::Label-->
                                            <label class="form-label">Add Room Type</label>
                                            <!--end::Label-->


                                            <!--begin::Repeater-->
                                            <div id="kt_ecommerce_add_product_options">


                                                <!--begin::Form group-->
                                                <div class="form-group">
                                                    <div data-repeater-list="kt_ecommerce_add_product_options"
                                                        class="d-flex flex-column gap-3">

                                                            <div data-repeater-item=""
                                                                class="form-group d-flex flex-wrap gap-5">
                                                                <!--begin::Select2-->
                                                                <div class="form-group row">
                                                                    <div class="col-md-3">
                                                                        <select class="form-select" name="specialize_id"
                                                                            data-placeholder="Select a type"
                                                                            data-kt-ecommerce-catalog-add-product="product_option">
                                                                            <option></option>
                                                                            @foreach ($types as $type)
                                                                                <option value="{{ $type->id }}">
                                                                                    {{ $type->en_room_type }}
                                                                                </option>
                                                                            @endforeach

                                                                        </select>

                                                                    </div>
                                                                    <div class="col-md-3">
                                                                        <input
                                                                            class="form-control  form-control-solid dPick"
                                                                            name="event_date_from" value=""
                                                                            placeholder="Pick date"
                                                                            id="kt_datepicker_3" />
                                                                    </div>
                                                                    <div class="col-md-3">
                                                                        <input
                                                                            class="form-control form-control-solid dPick"
                                                                            name="event_date_to" value=""
                                                                            placeholder="Pick date"
                                                                            id="kt_datepicker_4" />
                                                                    </div>
                                                                    <div class="col-md-2">
                                                                        <input type="text" placeholder="Cost"
                                                                            class="form-control" name="cost">
                                                                    </div>

                                                                    <!--end::Select2-->
                                                                    <div class="col-md-1">
                                                                        <button type="button" data-repeater-delete=""
                                                                            class="btn btn-sm btn-icon btn-light-danger">
                                                                            <!--begin::Svg Icon | path: icons/duotune/arrows/arr088.svg-->
                                                                            <span class="svg-icon svg-icon-2">
                                                                                <svg xmlns="http://www.w3.org/2000/svg"
                                                                                    width="24" height="24"
                                                                                    viewBox="0 0 24 24" fill="none">
                                                                                    <rect opacity="0.5" x="7.05025"
                                                                                        y="15.5356" width="12"
                                                                                        height="2" rx="1"
                                                                                        transform="rotate(-45 7.05025 15.5356)"
                                                                                        fill="black" />
                                                                                    <rect x="8.46447" y="7.05029"
                                                                                        width="12" height="2"
                                                                                        rx="1"
                                                                                        transform="rotate(45 8.46447 7.05029)"
                                                                                        fill="black" />
                                                                                </svg>
                                                                            </span>
                                                                            <!--end::Svg Icon-->
                                                                        </button>
                                                                    </div>
                                                                </div>


                                                            </div>

                                                    </div>
                                                </div>

                                                <!--end::Form group-->
                                                <!--begin::Form group-->
                                                <div class="form-group mt-5">
                                                    <button type="button" data-repeater-create=""
                                                        class="btn btn-sm btn-light-primary">
                                                        <!--begin::Svg Icon | path: icons/duotune/arrows/arr087.svg-->
                                                        <span class="svg-icon svg-icon-2">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="24"
                                                                height="24" viewBox="0 0 24 24" fill="none">
                                                                <rect opacity="0.5" x="11" y="18"
                                                                    width="12" height="2" rx="1"
                                                                    transform="rotate(-90 11 18)" fill="black" />
                                                                <rect x="6" y="11" width="12"
                                                                    height="2" rx="1" fill="black" />
                                                            </svg>
                                                        </span>
                                                        <!--end::Svg Icon-->Add another Room Type
                                                    </button>
                                                </div>
                                                <!--end::Form group-->
                                            </div>
                                            <!--end::Repeater-->
                                        </div>
                                        <!--end::Input group-->
                                    </div>
                                    <!--end::Card header-->
                                </div>
                                <!--end::Variations-->

                            </div>
                        </div>
                        <!--end::Tab pane-->
                        {{-- end tab 2 --}}
                    </div>
                    {{-- end all tabs --}}

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
          $(".dPick").flatpickr();
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


        $(document).ready(function() {

            $('.dynamic').change(function() {

                if ($(this).val() != '') {
                    var select = $(this).attr("id");
                    var value = $(this).val();

                    var _token = $('input[name="_token"]').val();

                    $.ajax({
                        url: "{{ route('dynamicdependentCat.fetch') }}",
                        method: "POST",
                        data: {
                            select: select,
                            value: value,
                            _token: _token
                        },
                        success: function(result) {

                            $('#sub').html(result);
                        }

                    })
                }
            });




        });
    </script>
     <script src='https://bootstrap-tagsinput.github.io/bootstrap-tagsinput/dist/bootstrap-tagsinput.min.js'></script>


     <script>
        $(function () {
           $('input').on('change', function (event) {

              var $element = $(event.target);
              var $container = $element.closest('.example');

              if (!$element.data('tagsinput'))
                 return;

              var val = $element.val();
              if (val === null)
                 val = "null";
              var items = $element.tagsinput('items');

              $('code', $('pre.val', $container)).html(($.isArray(val) ? JSON.stringify(val) : "\"" + val.replace('"', '\\"') + "\""));
              $('code', $('pre.items', $container)).html(JSON.stringify($element.tagsinput('items')));


           }).trigger('change');
        });
    //     $(document).ready(function() {
    //         alert('ll')
    //            var path = "{{ route('autocompleteKeywords') }}";

    // $( "#keywords" ).autocomplete({
    //     source: function( request, response ) {
    //       $.ajax({
    //         url: path,
    //         type: 'GET',
    //         dataType: "json",
    //         data: {
    //            search: request.term
    //         },
    //         success: function( data ) {
    //            response( data );
    //         }
    //       });
    //     },
    //     select: function (event, ui) {
    //        $('#keywords').val(ui.item.label);
    //        console.log(ui.item);
    //        return false;
    //     }
    //   });
    // });
     </script>

@endsection
