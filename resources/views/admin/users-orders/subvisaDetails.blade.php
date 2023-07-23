<div class="d-flex flex-column gap-7 gap-lg-10">
    <!--begin::General options-->
    <div class="card card-flush py-4">
        <!--begin::Card header-->
        <div class="card-header">
            <div class="card-title">
                <h2>Visa Details </h2>

            </div>
        </div>
        <!--end::Card header-->
        <!--begin::Table-->
        <div class="card-body pt-0">
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
                        <th class="min-w-100px">passport Img</th>
                        <th class="min-w-100px">visa Name</th>
                        <th class="min-w-100px">person Img</th>
                        <th class="min-w-100px">visa_nationality</th>


                        <th class="text-end min-w-100px">visa_date</th>
                        <th class="text-end min-w-70px">visa_cost</th>
                        <th class="text-end min-w-70px">edit</th>
                    </tr>
                    <!--end::Table row-->
                </thead>
                <!--end::Table head-->
                <!--begin::Table body-->
                <tbody class="fw-bold text-gray-600">
                    @foreach ($visaDetails as $index => $visaDetail)
                        <!--begin::Table row-->
                        <tr>
                            <!--begin::Checkbox-->
                            <td>
                                <div class="form-check form-check-sm form-check-custom form-check-solid">
                                    <input class="form-check-input" type="checkbox" value="1" />
                                </div>
                            </td>
                            <!--end::Checkbox-->
                            <!--end::Checkbox-->
                            <td>
                                <!--begin:: Avatar -->
                                <div class="symbol symbol-circle symbol-50px overflow-hidden me-3">
                                    <a href="#">
                                        <div class="symbol-label fs-3 bg-light-danger text-danger">
                                            <img src="{{ asset('uploads/visas') }}/{{ $visaDetail->visa_passport_photo }}"
                                                class="w-100" alt="">
                                        </div>
                                    </a>
                                </div>
                                <!--end::Avatar-->
                            </td>
                            <!--begin::Category=-->
                            <td>
                                <div class="d-flex align-items-center">

                                    <div class="ms-5">
                                        <!--begin::Title-->

                                        <a href="#" class="text-gray-800 text-hover-primary fs-5 fw-bolder mb-1"
                                            data-kt-ecommerce-category-filter="category_name">{{ $visaDetail->visa->type->en_type ?? '' }}</a>
                                        <!--end::Title-->
                                    </div>
                                </div>
                            </td>
                            <td>
                                <!--begin:: Avatar -->
                                <div class="symbol symbol-circle symbol-50px overflow-hidden me-3">
                                    <a href="#">
                                        <div class="symbol-label fs-3 bg-light-danger text-danger">
                                            <img src="{{ asset('uploads/visas') }}/{{ $visaDetail->visa_personal_photo }}"
                                                class="w-100" alt="">
                                        </div>
                                    </a>
                                </div>
                                <!--end::Avatar-->
                            </td>
                            <!--begin::Qty=-->
                            <td class="text-center pe-0" data-order="15">
                                <span
                                    class="fw-bolder ms-3">{{ $visaDetail->visa->nationality->en_nationality ?? '' }}</span>
                            </td>
                            <!--end::Qty=-->
                            <td class="text-center pe-0" data-order="15">
                                <span class="fw-bolder ms-3">{{ $visaDetail->visa_date ?? '' }}</span>
                            </td>


                            <!--begin::Status=-->
                            <td class="text-end pe-0">
                                <span class="fw-bolder text-dark">{{ $visaDetail->visa_cost ?? '' }} $</span>
                            </td>
                            <!--end::Status=-->
                            <td class="text-end pe-0">
                                <a data-bs-toggle="modal" data-bs-target="#kt_modal_new_targetEdit{{ $visaDetail->id }}"
                                    class="menu-link px-3">Edit</a>
                            </td>

                            <!--begin::Modal - New Target-->
                            <div class="modal fade" id="kt_modal_new_targetEdit{{ $visaDetail->id }}" tabindex="-1"
                                aria-hidden="true">
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
                                                action="{{ route('EditVisaDetails') }}" method="post"
                                                enctype="multipart/form-data">
                                                @csrf

                                                <!--begin::Heading-->
                                                <input type="hidden" name="detail_id" value="{{ $visaDetail->id }}">
                                                <input type="hidden" name="order_id"
                                                    value="{{ $visaDetail->order_details_id }}">
                                                <div class="mb-13 text-center">
                                                    <!--begin::Title-->
                                                    <h1 class="mb-3">Update Visa Details</h1>
                                                    <!--end::Title-->

                                                </div>
                                                <!--end::Heading-->
                                                <!--begin::Input group-->



                                                <div class="d-flex flex-column mb-8 fv-row">
                                                    <div class="row mx-0">
                                                        <div class="col-md-12 col-xl-12 col-sm-12 ">
                                                            <label for="">

                                                                visa request

                                                            </label>
                                                            <select class="form-select form-select-solid dynamic"
                                                                data-control="select2"
                                                                data-placeholder="Select an option" required
                                                                data-show-subtext="true" data-live-search="true"
                                                                id="visa" name="visa_id">
                                                                <option value=""></option>
                                                                @foreach ($visas as $visa)
                                                                    <option value="{{ $visa->id }}"
                                                                        {{ $visaDetail->visa_id == $visa->id ? 'selected' : '' }}>
                                                                        {{ $visa->country->en_country ?? '' }}{{ $visa->type->en_type ?? '' }}{{ $visa->nationality->en_nationality ?? '' }}{{ $visa->cost }}
                                                                        {{-- @isset($visa->country)
                                            @php

                                            echo "{$visa->country->en_country} {$visa->type->en_type} {$visa->nationality->en_nationality} {$visa->cost}";



                                            @endphp
  @endisset() --}}

                                                                    </option>
                                                                @endforeach
                                                            </select>
                                                        </div>

                                                        <div class="col-sm-12 col-md-6 col-xl-6">
                                                            <label for="">
                                                                Passenger Name

                                                            </label>
                                                            <input type="text"
                                                                value="{{ $order->holder_name ?? '' }}"
                                                                class="form-control" required name="name" />

                                                        </div>
                                                        <div class="col-sm-12 col-md-6 col-xl-6">
                                                            <label for="">
                                                                {{ __('links.mobile') }}
                                                                Country Code

                                                            </label>
                                                            <input type="tel"
                                                                value="{{ $order->holder_mobile ?? '' }}"
                                                                class="form-control" required name="phone" />

                                                        </div>
                                                        <div class="col-sm-12 col-md-6 col-xl-6">
                                                            <label for="">{{ __('links.email') }} </label>
                                                            <input type="email"
                                                                value="{{ $order->holder_email ?? '' }}"
                                                                class="form-control" required name="email" />
                                                        </div>

                                                        <div class="col-sm-12 col-md-6 col-xl-6">
                                                            <label for="">{{ __('links.passImage') }}
                                                                -{{ $visaDetail->visa_passport_photo }} </label>
                                                            <input type="file" class="file form-control"
                                                                onchange="validateSize(this)" required name="passport"
                                                                placeholder="{{ __('links.passImage') }}" />

                                                        </div>
                                                        <div class="col-sm-12 col-md-6 col-xl-6">
                                                            <label for="">{{ __('links.persImage') }}
                                                                -{{ $visaDetail->visa_personal_photo }} </label>
                                                            <input type="file" class="file form-control"
                                                                onchange="validateSize(this)" required name="personal"
                                                                placeholder="{{ __('links.persImage') }}" />
                                                        </div>

                                                    </div>

                                                    <div class="text-center mt-2">
                                                        <div class="btn btn-sm btn-icon btn-active-color-primary"
                                                            style="margin-right: 25px" data-bs-dismiss="modal">
                                                            <button type="reset" id="kt_modal_update_target_cancel"
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
                            <!--end::Table row-->
                    @endforeach


                </tbody>
                <!--end::Table body-->
            </table>
            <!--end::Table-->
        </div>
    </div>
    <!--end::General options-->
    <!--end::General options-->
    <!--begin::General options-->
    <div class="card card-flush py-4">
        <!--begin::Card header-->
        <div class="card-header">
            <div class="card-title">
                <h2>Holder Details </h2>

            </div>
        </div>
        <!--end::Card header-->
        <!--begin::Table-->
        <div class="card-body pt-0">
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

                        {{-- <th class="min-w-200px">salutation</th> --}}
                        <th class="min-w-100px">holder name</th>
                        <th class="text-end min-w-70px">mobile</th>
                        <th class="text-end min-w-100px">notes</th>
                        <th class="text-end min-w-70px">email </th>

                    </tr>
                    <!--end::Table row-->
                </thead>
                <!--end::Table head-->
                <!--begin::Table body-->
                <tbody class="fw-bold text-gray-600">
                    {{-- @foreach ($persons as $index => $person) --}}
                    <!--begin::Table row-->
                    <tr>
                        <!--begin::Checkbox-->
                        <td>
                            <div class="form-check form-check-sm form-check-custom form-check-solid">
                                <input class="form-check-input" type="checkbox" value="1" />
                            </div>
                        </td>
                        <!--end::Checkbox-->
                        <!--begin::Category=-->
                        {{-- <td>
<div class="d-flex align-items-center">

<div class="ms-5">
<!--begin::Title-->

<a href="#" class="text-gray-800 text-hover-primary fs-5 fw-bolder mb-1"
data-kt-ecommerce-category-filter="category_name" >{{$order->holder_salutation ?? '' }}</a>
<!--end::Title-->
</div>
</div>
</td> --}}

                        <!--begin::Qty=-->
                        <td class="text-strt pe-0" data-order="15">
                            <span class="fw-bolder ms-3">{{ $order->holder_name ?? '' }}</span>
                        </td>
                        <!--end::Qty=-->
                        <td class="text-end pe-0" data-order="15">
                            <span class="fw-bolder ms-3">{{ $order->holder_mobile ?? '' }}</span>
                        </td>

                        <td class="text-end pe-0" data-order="15">
                            <span class="fw-bolder ms-3">{{ $order->notes ?? '' }}</span>
                        </td>

                        <td class="text-end pe-0" data-order="15">
                            <span class="fw-bolder ms-3">{{ $order->holder_email ?? '' }}</span>
                        </td>

                    </tr>
                    <!--end::Table row-->
                    {{-- @endforeach --}}


                </tbody>
                <!--end::Table body-->
            </table>
            <!--end::Table-->
        </div>
    </div>
    <!--end::General options-->


    <div class="card card-flush py-4">
        <!--begin::Card header-->
        <div class="card-header">
            <div class="card-title">
                <h2>receipt Details </h2>

            </div>
        </div>
        <!--end::Card header-->
        <!--begin:Form-->
        <div class="d-flex flex-column mb-8 fv-row mx-5">
        <form id="kt_modal_new_target_form" class="form" action="{{ route('receiptSave') }}" method="post"
            enctype="multipart/form-data">
            @csrf
             <input type="hidden" value="{{ $order->id }}" name="order_id" >
            <div class="mb-7">
                <!--begin::Label-->
                <label class="fs-6 fw-bold mb-3">
                    <span>Update receipt</span>
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
                        style="background-image: url(' {{ asset('uploads/orders') }}/{{ $order->receipt_image }}')">
                        <!--begin::Preview existing avatar-->

                        <div class="image-input-wrapper w-100px h-100px"
                            style="background-image: url(' {{ asset('uploads/orders') }}/{{ $order->receipt_image }}')">

                        </div>
                        <!--end::Preview existing avatar-->
                        <!--begin::Edit-->
                        <label
                            class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow"
                            data-kt-image-input-action="change"
                            data-bs-toggle="tooltip" title="Change avatar">
                            <i class="bi bi-pencil-fill fs-7"></i>
                            <!--begin::Inputs-->
                            <input type="file" name="receipt_image"
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

            <!--begin::Input group-->



                <!--begin::Input group-->
                <div class="d-flex flex-column mb-8">
                    <label class="fs-6 fw-bold mb-2">Notes</label>
                    <textarea class="form-control form-control-solid" rows="3" name="receipt_notes" placeholder="Type Notes">{{ $order->receipt_notes }}</textarea>
                </div>
                <!--end::Input group-->


                <!--begin::Actions-->
                <div class="text-center">
                    <button type="reset" id="kt_modal_new_target_cancel" class="btn btn-light me-3">Cancel</button>
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
    </div>
</div>

</div>
