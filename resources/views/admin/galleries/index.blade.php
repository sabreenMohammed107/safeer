@extends('layout.main')

@section('breadcrumb')
    <div class="toolbar" id="kt_toolbar">
        <div class="container-fluid d-flex flex-stack flex-wrap flex-sm-nowrap">
            <!--begin::Info-->
            <div class="d-flex flex-column align-items-start justify-content-center flex-wrap me-2">
                <!--begin::Title-->
                <h1 class="text-dark fw-bolder my-1 fs-2">Gallery</h1>
                <!--end::Title-->
                <!--begin::Breadcrumb-->
                <ul class="breadcrumb fw-bold fs-base my-1">
                    <li class="breadcrumb-item text-muted">
                        <a href="../dist/index.html" class="text-muted text-hover-primary">Home</a>
                    </li>
                    <li class="breadcrumb-item text-muted">Gallery</li>

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
            <!--begin::Category-->
            <div class="card card-flush">
                <!--begin::Card header-->
                <div class="card-header align-items-center py-5 gap-2 gap-md-5">
                    <!--begin::Card title-->
                    <div class="card-title">
                        <!--begin::Search-->
                        <div class="d-flex align-items-center position-relative my-1">
                            <!--begin::Svg Icon | path: icons/duotune/general/gen021.svg-->
                            <span class="svg-icon svg-icon-1 position-absolute ms-4">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                    fill="none">
                                    <rect opacity="0.5" x="17.0365" y="15.1223" width="8.15546" height="2"
                                        rx="1" transform="rotate(45 17.0365 15.1223)" fill="black" />
                                    <path
                                        d="M11 19C6.55556 19 3 15.4444 3 11C3 6.55556 6.55556 3 11 3C15.4444 3 19 6.55556 19 11C19 15.4444 15.4444 19 11 19ZM11 5C7.53333 5 5 7.53333 5 11C5 14.4667 7.53333 17 11 17C14.4667 17 17 14.4667 17 11C17 7.53333 14.4667 5 11 5Z"
                                        fill="black" />
                                </svg>
                            </span>
                            <!--end::Svg Icon-->
                            <input type="text" data-kt-ecommerce-category-filter="search"
                                class="form-control form-control-solid w-250px ps-14" placeholder="Search Field" />
                        </div>
                        <!--end::Search-->
                    </div>
                    <!--end::Card title-->
                    <!--begin::Card toolbar-->
                    <div class="card-toolbar">
                        <!--begin::Add customer-->
                        <a href="#" class="btn btn-sm btn-primary me-3" data-bs-toggle="modal"
                            data-bs-target="#kt_modal_new_target">Add Gallery</a>

                        <!--end::Add customer-->
                    </div>
                    <!--end::Card toolbar-->
                </div>
                <!--end::Card header-->
                <!--begin::Card body-->
                <div class="card-body pt-0">
                    <!--begin::Table-->
                    <table class="table align-middle table-row-dashed fs-6 gy-5" id="kt_ecommerce_category_table">
                        <!--begin::Table head-->
                        <thead>
                            <!--begin::Table row-->
                            <tr class="text-start text-gray-400 fw-bolder fs-7 text-uppercase gs-0">
                                <th class="w-10px pe-2">
                                    <div class="form-check form-check-sm form-check-custom form-check-solid me-3">
                                        <input class="form-check-input" type="checkbox" data-kt-check="true"
                                            data-kt-check-target="#kt_ecommerce_category_table .form-check-input"
                                            value="1" />
                                    </div>
                                </th>
                                <th class="min-w-150px">image</th>
                                <th class="min-w-250px">hotel</th>
                                {{-- <th class="min-w-150px">tour</th> --}}

                                <th class="text-end min-w-70px">Actions</th>
                            </tr>
                            <!--end::Table row-->
                        </thead>
                        <!--end::Table head-->
                        <!--begin::Table body-->
                        <tbody class="fw-bold text-gray-600">
                            @foreach ($rows as $index => $row)
                                <!--begin::Table row-->
                                <tr>
                                    <!--begin::Checkbox-->
                                    <td>
                                        <div class="form-check form-check-sm form-check-custom form-check-solid">
                                            <input class="form-check-input" type="checkbox" value="1" />
                                        </div>
                                    </td>
                                    <!--end::Checkbox-->
                                    <td>
                                        <!--begin:: Avatar -->
                                        <div class="symbol symbol-circle symbol-50px overflow-hidden me-3">
                                            <a href="#">
                                                <div class="symbol-label fs-3 bg-light-danger text-danger">
                                                    <img src="{{ asset('uploads/galleries') }}/{{ $row->img }}"
                                                        class="w-100" alt="">
                                                </div>
                                            </a>
                                        </div>
                                        <!--end::Avatar-->
                                    </td>
                                    <td>

                                        <div class="d-flex">

                                            <a href="#" class="text-gray-800 text-hover-primary fs-5 fw-bolder mb-1"
                                                data-kt-ecommerce-category-filter="category_name">
                                                {{ $row->hotel->hotel_enname ?? '' }}</a>


                                        </div>
                                    </td>


                                    {{-- <td>

                                        <div class="d-flex">
                                            <input type="hidden" name="" id=""
                                                data-kt-ecommerce-category-filter="category_id" value="{{ $row->id }}">

                                            <span class="symbol-label"> {{ $row->tour->en_overview ?? '' }}</span>

                                        </div>

                                    </td> --}}
                                    <!--end::Type=-->
                                    <!--begin::Action=-->
                                    <td class="text-end">
                                        <a href="#" class="btn btn-sm btn-light btn-active-light-primary"
                                            data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">Actions
                                            <!--begin::Svg Icon | path: icons/duotune/arrows/arr072.svg-->
                                            <span class="svg-icon svg-icon-5 m-0">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                    viewBox="0 0 24 24" fill="none">
                                                    <path
                                                        d="M11.4343 12.7344L7.25 8.55005C6.83579 8.13583 6.16421 8.13584 5.75 8.55005C5.33579 8.96426 5.33579 9.63583 5.75 10.05L11.2929 15.5929C11.6834 15.9835 12.3166 15.9835 12.7071 15.5929L18.25 10.05C18.6642 9.63584 18.6642 8.96426 18.25 8.55005C17.8358 8.13584 17.1642 8.13584 16.75 8.55005L12.5657 12.7344C12.2533 13.0468 11.7467 13.0468 11.4343 12.7344Z"
                                                        fill="black" />
                                                </svg>
                                            </span>
                                            <!--end::Svg Icon-->
                                        </a>
                                        <!--begin::Menu-->
                                        <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-bold fs-7 w-125px py-4"
                                            data-kt-menu="true">
                                            <!--begin::Menu item-->
                                            <div class="menu-item px-3">
                                                <a data-bs-toggle="modal"
                                                    data-bs-target="#kt_modal_new_targetEdit{{ $row->id }}"
                                                    class="menu-link px-3">Edit</a>
                                            </div>
                                            <!--end::Menu item-->
                                            <!--begin::Menu item-->
                                            <div class="menu-item px-3">
                                                <a href="#" class="menu-link px-3"
                                                    data-kt-ecommerce-category-filter="delete_row">Delete</a>


                                                <form id="delete_{{ $row->id }}"
                                                    action="{{ route('galleries.destroy', $row) }}" method="POST"
                                                    style="display: none;">
                                                    @csrf
                                                    @method('DELETE')

                                                    <button type="submit" value=""></button>
                                                </form>
                                            </div>
                                            <!--end::Menu item-->
                                        </div>
                                        <!--end::Menu-->
                                    </td>
                                    <!--end::Action=-->



                                    <!--begin::Modal - New Target-->
                                    <div class="modal fade" id="kt_modal_new_targetEdit{{ $row->id }}"
                                        tabindex="-1" aria-hidden="true">
                                        <!--begin::Modal dialog-->
                                        <div class="modal-dialog modal-dialog-centered mw-650px">
                                            <!--begin::Modal content-->
                                            <div class="modal-content rounded">
                                                <!--begin::Modal header-->
                                                <div class="modal-header pb-0 border-0 justify-content-end">
                                                    <!--begin::Close-->
                                                    <div class="btn btn-sm btn-icon btn-active-color-primary"
                                                        data-bs-dismiss="modal">
                                                        <!--begin::Svg Icon | path: icons/duotune/arrows/arr061.svg-->
                                                        <span class="svg-icon svg-icon-1">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="24"
                                                                height="24" viewBox="0 0 24 24" fill="none">
                                                                <rect opacity="0.5" x="6" y="17.3137"
                                                                    width="16" height="2" rx="1"
                                                                    transform="rotate(-45 6 17.3137)" fill="black" />
                                                                <rect x="7.41422" y="6" width="16"
                                                                    height="2" rx="1"
                                                                    transform="rotate(45 7.41422 6)" fill="black" />
                                                            </svg>
                                                        </span>
                                                        <!--end::Svg Icon-->
                                                    </div>
                                                    <!--end::Close-->
                                                </div>
                                                <!--begin::Modal header-->
                                                <!--begin::Modal body-->
                                                <div class="modal-body scroll-y px-10 px-lg-15 pt-0 pb-15">
                                                    <!--begin:Form-->
                                                    <form id="kt_modal_update_target_updateForm" class="form"
                                                        action="{{ route('galleries.update', $row->id) }}" method="post"
                                                        enctype="multipart/form-data">
                                                        @csrf
                                                        @method('PUT')
                                                        <!--begin::Heading-->
                                                        <div class="mb-13 text-center">
                                                            <!--begin::Title-->
                                                            <h1 class="mb-3">Update Gallery</h1>
                                                            <!--end::Title-->

                                                        </div>
                                                        <!--end::Heading-->
                                                        <!--begin::Input group-->
                                                        <div class="mb-7">
                                                            <!--begin::Label-->
                                                            <label class="fs-6 fw-bold mb-3">
                                                                <span>Update Avatar</span>
                                                                <i class="fas fa-exclamation-circle ms-1 fs-7"
                                                                    data-bs-toggle="tooltip"
                                                                    title="Allowed file types: png, jpg, jpeg."></i>
                                                            </label>
                                                            <!--end::Label-->
                                                            <!--begin::Image input wrapper-->
                                                            <div class="mt-1">
                                                                <!--begin::Image input-->
                                                                <div class="image-input image-input-outline"
                                                                    data-kt-image-input="true"
                                                                    style="background-image: url(' {{ asset('uploads/galleries') }}/{{ $row->img }}')">
                                                                    <!--begin::Preview existing avatar-->

                                                                    <div class="image-input-wrapper w-100px h-100px"
                                                                        style="background-image: url(' {{ asset('uploads/galleries') }}/{{ $row->img }}')">

                                                                    </div>
                                                                    <!--end::Preview existing avatar-->
                                                                    <!--begin::Edit-->
                                                                    <label
                                                                        class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow"
                                                                        data-kt-image-input-action="change"
                                                                        data-bs-toggle="tooltip" title="Change avatar">
                                                                        <i class="bi bi-pencil-fill fs-7"></i>
                                                                        <!--begin::Inputs-->
                                                                        <input type="file" name="img"
                                                                            accept=".png, .jpg, .jpeg" />
                                                                        <input type="hidden" name="avatar_remove" />
                                                                        <!--end::Inputs-->
                                                                    </label>
                                                                    <!--end::Edit-->

                                                                </div>
                                                                <!--end::Image input-->
                                                            </div>
                                                            <!--end::Image input wrapper-->
                                                        </div>


                                                        <div class="d-flex flex-column mb-8 fv-row">

                                                            <div>
                                                                <label class="fs-6 fw-bold form-label mt-3">
                                                                    <option value="">Select a Hotel...</option>

                                                                </label>

                                                                <select name="hotel_id" required aria-label="Select a hotel"
                                                                    data-control="select2"
                                                                    data-placeholder="Select a hotel..."
                                                                    data-dropdown-parent="#kt_modal_new_targetEdit{{ $row->id }}"
                                                                    class="form-select form-select-solid fw-bolder">
                                                                    <option value=""></option>
                                                                    @foreach ($hotels as $hotel)
                                                                        <option value="{{ $hotel->id }}"
                                                                            {{ $row->hotel_id == $hotel->id ? 'selected' : '' }}>
                                                                            {{ $hotel->hotel_enname }}
                                                                        </option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                            <!--end::Input group-->

                                                        <div class="d-flex flex-column mb-8 fv-row">

                                                            {{-- <div>
                                                                <label class="fs-6 fw-bold form-label mt-3">
                                                                    <option value="">Select a Tour...</option>

                                                                </label>

                                                                <select name="tour_id" required aria-label="Select a tour"
                                                                    data-control="select2"
                                                                    data-placeholder="Select a tour..."
                                                                    data-dropdown-parent="#kt_modal_new_targetEdit{{ $row->id }}"
                                                                    class="form-select form-select-solid fw-bolder">
                                                                    <option value=""></option>
                                                                    @foreach ($tours as $tour)
                                                                        <option value="{{ $tour->id }}"
                                                                            {{ $row->tour_id == $tour->id ? 'selected' : '' }}>
                                                                            {{ $tour->en_overview }}
                                                                        </option>
                                                                    @endforeach
                                                                </select>
                                                            </div> --}}
                                                            <!--end::Input group-->

                                                            <!--begin::Input group-->
                                                            <div class="d-flex flex-column mb-8">
                                                                <div
                                                                    class="form-check form-switch form-check-custom form-check-solid">
                                                                    <input class="form-check-input" type="checkbox"
                                                                        name="active[]" value="1"
                                                                        id="flexSwitchDefault2"
                                                                        {{ $row->active == 1 ? 'checked' : '' }} />
                                                                    <label class="form-check-label"
                                                                        for="flexSwitchDefault2">
                                                                        Active
                                                                    </label>
                                                                </div>
                                                            </div>
                                                            <!--end::Input group-->


                                                            <!--begin::Actions-->
                                                            <div class="text-center">
                                                                <div class="btn btn-sm btn-icon btn-active-color-primary"
                                                                    style="margin-right: 25px" data-bs-dismiss="modal">
                                                                    <button type="reset"
                                                                        id="kt_modal_update_target_cancel"
                                                                        class="btn btn-light me-3"
                                                                        data-dismiss="modal">Cancel</button>
                                                                </div>
                                                                <button type="submit" id="kt_modal_update_target_submit"
                                                                    class="btn btn-primary">
                                                                    <span class="indicator-label">Submit</span>
                                                                    <span class="indicator-progress">Please wait...
                                                                        <span
                                                                            class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                                                                </button>
                                                            </div>
                                                            <!--end::Actions-->
                                                    </form>
                                                    <!--end:Form-->
                                                </div>
                                                <!--end::Modal body-->
                                            </div>
                                            <!--end::Modal content-->
                                        </div>
                                        <!--end::Modal dialog-->
                                    </div>
                                    <!--end::Modal - New Target-->
                                </tr>
                                <!--end::Table row-->
                            @endforeach
                        </tbody>
                        <!--end::Table body-->
                    </table>
                    <!--end::Table-->
                </div>
                <!--end::Card body-->
            </div>
            <!--end::Category-->
        </div>
        <!--end::Container-->
    </div>
    <!--end::Post-->
    <!--begin::Modal - New Target-->
    <div class="modal fade" id="kt_modal_new_target" tabindex="-1" aria-hidden="true">
        <!--begin::Modal dialog-->
        <div class="modal-dialog modal-dialog-centered mw-650px">
            <!--begin::Modal content-->
            <div class="modal-content rounded">
                <!--begin::Modal header-->
                <div class="modal-header pb-0 border-0 justify-content-end">
                    <!--begin::Close-->
                    <div class="btn btn-sm btn-icon btn-active-color-primary" data-bs-dismiss="modal">
                        <!--begin::Svg Icon | path: icons/duotune/arrows/arr061.svg-->
                        <span class="svg-icon svg-icon-1">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                fill="none">
                                <rect opacity="0.5" x="6" y="17.3137" width="16" height="2"
                                    rx="1" transform="rotate(-45 6 17.3137)" fill="black" />
                                <rect x="7.41422" y="6" width="16" height="2" rx="1"
                                    transform="rotate(45 7.41422 6)" fill="black" />
                            </svg>
                        </span>
                        <!--end::Svg Icon-->
                    </div>
                    <!--end::Close-->
                </div>
                <!--begin::Modal header-->
                <!--begin::Modal body-->
                <div class="modal-body scroll-y px-10 px-lg-15 pt-0 pb-15">
                    <!--begin:Form-->
                    <form id="kt_modal_new_target_form" class="form" action="{{ route('galleries.store') }}"
                        method="post" enctype="multipart/form-data">
                        @csrf
                        <!--begin::Heading-->
                        <div class="mb-13 text-center">
                            <!--begin::Title-->
                            <h1 class="mb-3">Set Gallery Field</h1>
                            <!--end::Title-->

                        </div>
                        <!--end::Heading-->
                        <!--begin::Thumbnail settings-->
                        <div class="card card-flush py-4">
                            <!--begin::Card header-->
                            <div class="card-header">
                                <!--begin::Card title-->
                                <div class="card-title">
                                    <h2>Image</h2>
                                </div>
                                <!--end::Card title-->
                            </div>
                            <!--end::Card header-->
                            <!--begin::Card body-->
                            <div class="card-body text-center pt-0">
                                <!--begin::Image input-->
                                <div class="image-input image-input-empty image-input-outline mb-3"
                                    data-kt-image-input="true"
                                    style="background-image: url(assets/media/svg/files/blank-image.svg)">
                                    <!--begin::Preview existing avatar-->
                                    <div class="image-input-wrapper w-150px h-150px"></div>
                                    <!--end::Preview existing avatar-->
                                    <!--begin::Label-->
                                    <label
                                        class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow"
                                        data-kt-image-input-action="change" data-bs-toggle="tooltip"
                                        title="Change avatar">
                                        <i class="bi bi-pencil-fill fs-7"></i>
                                        <!--begin::Inputs-->
                                        <input type="file" name="img" accept=".png, .jpg, .jpeg" />
                                        <input type="hidden" name="avatar_remove" />
                                        <!--end::Inputs-->
                                    </label>
                                    <!--end::Label-->
                                    <!--begin::Cancel-->
                                    <span
                                        class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow"
                                        data-kt-image-input-action="cancel" data-bs-toggle="tooltip"
                                        title="Cancel avatar">
                                        <i class="bi bi-x fs-2"></i>
                                    </span>
                                    <!--end::Cancel-->
                                    <!--begin::Remove-->
                                    <span
                                        class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow"
                                        data-kt-image-input-action="remove" data-bs-toggle="tooltip"
                                        title="Remove avatar">
                                        <i class="bi bi-x fs-2"></i>
                                    </span>
                                    <!--end::Remove-->
                                </div>
                                <!--end::Image input-->

                            </div>
                            <!--end::Card body-->
                        </div>
                        <!--end::Thumbnail settings-->
                        <!--begin::Input group-->



                        <div class="d-flex flex-column mb-8 fv-row">

                            <div>
                                <label class="fs-6 fw-bold form-label mt-3">
                                    <option value="">Select a Hotel...</option>

                                </label>

                                <select name="hotel_id" required aria-label="Select a hotel"
                                    data-control="select2"
                                    data-placeholder="Select a hotel..."
                                    data-dropdown-parent="#kt_modal_new_target"
                                    class="form-select form-select-solid fw-bolder">
                                    <option value=""></option>
                                    @foreach ($hotels as $hotel)
                                        <option value="{{ $hotel->id }}"
>
                                            {{ $hotel->hotel_enname }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <!--end::Input group-->

                        <div class="d-flex flex-column mb-8 fv-row">

                            {{-- <div>
                                <label class="fs-6 fw-bold form-label mt-3">
                                    <option value="">Select a Tour...</option>

                                </label>

                                <select name="tour_id" required aria-label="Select a tour"
                                    data-control="select2"
                                    data-placeholder="Select a tour..."
                                    data-dropdown-parent="#kt_modal_new_target"
                                    class="form-select form-select-solid fw-bolder">
                                    <option value=""></option>
                                    @foreach ($tours as $tour)
                                        <option value="{{ $tour->id }}"
                                            >
                                            {{ $tour->en_overview }}
                                        </option>
                                    @endforeach
                                </select>
                            </div> --}}
                            <!--end::Input group-->
                            <!--begin::Input group-->
                            <div class="d-flex flex-column mb-8">
                                <div
                                    class="form-check form-switch form-check-custom form-check-solid">
                                    <input class="form-check-input" type="checkbox"
                                        name="active[]" value="1"
                                        id="flexSwitchDefault2"
                                        checked />
                                    <label class="form-check-label"
                                        for="flexSwitchDefault2">
                                        Active
                                    </label>
                                </div>
                            </div>
                            <!--end::Input group-->

                        <!--begin::Actions-->
                        <div class="text-center">
                            <button type="reset" id="kt_modal_new_target_cancel"
                                class="btn btn-light me-3">Cancel</button>
                            <button type="submit" id="kt_modal_new_target_submit" class="btn btn-primary">
                                <span class="indicator-label">Submit</span>
                                <span class="indicator-progress">Please wait...
                                    <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                            </button>
                        </div>
                        <!--end::Actions-->
                    </form>
                    <!--end:Form-->
                </div>
                <!--end::Modal body-->
            </div>
            <!--end::Modal content-->
        </div>
        <!--end::Modal dialog-->
    </div>
    <!--end::Modal - New Target-->
@endsection
