<div class="d-flex flex-column gap-7 gap-lg-10">
    <!--begin::General options-->
    <div class="card card-flush py-4">
        <!--begin::Card header-->
        <div class="card-header">
            <div class="card-title">
                <h2>Trans Details </h2>

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
                        <th class="min-w-100px">transfer_date</th>
                        <th class="min-w-100px">transfer_from</th>

                        <th class="text-end min-w-70px">transfer_to</th>

                        <th class="text-end min-w-100px">hotel_mame</th>
                        <th class="text-end min-w-100px">car_model</th>

                        <th class="text-end min-w-100px">car_class</th>
                        <th class="text-end min-w-70px">car_capacity</th>

                        <th class="text-end min-w-100px">transfer_person_price</th>
                        <th class="text-end min-w-70px">transfer_line_cost</th>
                        <th class="text-end min-w-100px">return</th>
                        <th class="text-end min-w-100px">return_date</th>
                        <th class="text-end min-w-70px">edit</th>

                    </tr>
                    <!--end::Table row-->
                </thead>
                <!--end::Table head-->
                <!--begin::Table body-->
                <tbody class="fw-bold text-gray-600">
                    @foreach ($transDetails as $index => $detail)
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
                            <td>
                                <div class="d-flex align-items-center">

                                    <div class="ms-5">
                                        <!--begin::Title-->

                                        <a href="#" class="text-gray-800 text-hover-primary fs-5 fw-bolder mb-1"
                                            data-kt-ecommerce-category-filter="category_name">{{ $detail->transfer_date ?? '' }}</a>
                                        <!--end::Title-->
                                    </div>
                                </div>
                            </td>

                            <!--begin::Qty=-->
                            <td class="text-center pe-0" data-order="15">
                                <span class="fw-bolder ms-3">{{ $detail->transfer_from ?? '' }}</span>
                            </td>
                            <!--end::Qty=-->
                            <td class="text-center pe-0" data-order="15">
                                <span class="fw-bolder ms-3">{{ $detail->transfer_to ?? '' }}</span>
                            </td>
                            <td class="text-center pe-0" data-order="15">
                                <span class="fw-bolder ms-3">{{ $detail->hotel_name ?? '' }}</span>
                            </td>
                            <td class="text-center pe-0" data-order="15">
                                <span class="fw-bolder ms-3">{{ $detail->car_model ?? '' }}</span>
                            </td>
                            <!--begin::Price=-->
                            <td class="text-center pe-0">
                                <span class="fw-bolder text-dark">{{ $detail->car_class ?? '' }} </span>
                            </td>
                            <!--end::Price=-->

                            <!--begin::Status=-->
                            <td class="text-end pe-0">
                                <span class="fw-bolder text-dark">{{ $detail->car_capacity ?? '' }} </span>
                            </td>
                            <!--end::Status=-->
                            <!--begin::Status=-->
                            <td class="text-end pe-0">
                                <span class="fw-bolder text-dark">{{ $detail->transfer_person_price ?? '' }} $</span>
                            </td>
                            <!--end::Status=-->
                            <!--begin::Status=-->
                            <td class="text-end pe-0">
                                <span class="fw-bolder text-dark">{{ $detail->transfer_total_cost ?? '' }} $</span>
                            </td>

                            <td class="text-end pe-0">
                                <span class="fw-bolder text-dark">
                                    @if ($detail->is_return == 1)
                                        Return
                                    @else
                                        Not Return
                                    @endif
                                </span>
                            </td>


                            <td class="text-end pe-0">
                                <span class="fw-bolder text-dark">{{ $detail->return_date }} </span>
                            </td>
                            <!--end::Status=-->
                            <td class="text-end pe-0">
                                <a data-bs-toggle="modal" data-bs-target="#kt_modal_new_targetEdit{{ $detail->id }}"
                                    class="menu-link px-3">Edit</a>
                            </td>

                            <!--begin::Modal - New Target-->
                            <div class="modal fade" id="kt_modal_new_targetEdit{{ $detail->id }}" tabindex="-1"
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
                                                action="{{ route('EditTransDetails') }}" method="post"
                                                enctype="multipart/form-data">
                                                @csrf

                                                <!--begin::Heading-->
                                                <input type="hidden" name="detail_id" value="{{ $detail->id }}">
                                                <div class="mb-13 text-center">
                                                    <!--begin::Title-->
                                                    <h1 class="mb-3">Update Trans Details</h1>
                                                    <!--end::Title-->

                                                </div>
                                                <!--end::Heading-->
                                                <!--begin::Input group-->



                                                <div class="d-flex flex-column mb-8 fv-row">
                                                    <!--begin::Input group-->
                                                    <div class="d-flex flex-column mb-8">
                                                        <label class="fs-6 fw-bold mb-2">transfer_date</label>
                                                        <input type="date" name="transfer_date"
                                                            class="form-control form-control-solid @error('transfer_date') is-invalid @enderror"
                                                            value="{{ $detail->transfer_date ?? '' }}" />
                                                        @error('transfer_date')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </div>
                                                    <!--end::Input group-->
                                                    <div class="d-flex flex-column mb-8">
                                                        <label class="fs-6 fw-bold mb-2">Adults</label>
                                                        <input type="number" name="capacity"
                                                            class="form-control form-control-solid @error('capacity') is-invalid @enderror"
                                                            value="{{ $detail->capacity ?? '' }}" />
                                                        @error('capacity')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </div>
                                                    <!--begin::Input group-->


                                                    <div class="d-flex flex-column mb-8">
                                                        <label class="fs-6 fw-bold mb-2">Select transfer - model
                                                            -capacity</label>
                                                        <select class="form-select form-select-solid "
                                                            data-control="select2" data-placeholder="Select an option"
                                                            required data-show-subtext="true" data-live-search="true"
                                                            name="transfer_id">
                                                            <option value=""></option>
                                                            @foreach ($transfers as $transfer)
                                                                <option value="{{ $transfer->id }}"> Model :
                                                                    {{ $transfer->carModel->model_arname }} / Capacity
                                                                    : {{ $transfer->carModel->capacity }}
                                                                    / From
                                                                    :{{ $transfer->locationFrom->location_enname ?? '' }}
                                                                    / To :
                                                                    {{ $transfer->locationTo->location_enname ?? '' }}
                                                                    / Price : {{ $transfer->person_price }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    <div class="d-flex flex-column mb-8">
                                                        <label class="fs-6 fw-bold mb-2">hotel name</label>
                                                        <input type="text" name="hotel_name"
                                                            class="form-control form-control-solid @error('hotel_name') is-invalid @enderror"
                                                            value="{{ $detail->hotel_name ?? '' }}" />
                                                        @error('hotel_name')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </div>

                                                    <div class="form-check my-2">
                                                        <input class="form-check-input" type="checkbox"
                                                            name="default_holder" id="transHolderFlag">
                                                        <label class="form-check-label ps-2" for="transHolderFlag">
                                                            @if (LaravelLocalization::getCurrentLocale() === 'en')
                                                                Go & Return
                                                            @else
                                                                ذهاب & عودة
                                                            @endif

                                                        </label>
                                                    </div>
                                                    <div class="row trans-holder" style="display: none;">
                                                        <div class="col-sm-12 col-md-12">
                                                            <label class="mb-2">
                                                                @if (LaravelLocalization::getCurrentLocale() === 'en')
                                                                    Return Date
                                                                @else
                                                                    تاريخ العودة
                                                                @endif

                                                            </label>
                                                            <br />
                                                            <div class="details px-1">
                                                                <input type="date" id="return_date"
                                                                    placeholder="DD/MM/YYYY"
                                                                    class="form-control transfer_date is_holder"
                                                                    name="return" max="2025-12-31"
                                                                    autocomplete="off">
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="text-center">
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
                            @if ($errors->any())
                                <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
                                <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
                                <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

                                <script type="text/javascript">
                                    // alert('gg')
                                    //JavaScript code that open up your modal.
                                    $('#kt_modal_new_targetEdit' + {{ $detail->id }}).modal('show');
                                </script>
                            @endif


                        </tr>
                        <!--end::Table row-->
                    @endforeach


                </tbody>
                <!--end::Table body-->
            </table>
            <!--end::Table-->
        </div>
    </div>
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

                        <th class="min-w-200px">Person Name</th>
                        <th class="min-w-100px">Type</th>
                        <th class="min-w-100px">Email</th>
                        <th class="text-end min-w-70px"> Mobile</th>
                        <th class="text-end min-w-70px"> job</th>
                        <th class="text-end min-w-70px"> Notes</th>
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
                        <td>
                            <div class="d-flex align-items-center">

                                <div class="ms-5">
                                    <!--begin::Title-->

                                    <a href="#" class="text-gray-800 text-hover-primary fs-5 fw-bolder mb-1"
                                        data-kt-ecommerce-category-filter="category_name">{{ $order->holder_salutation ?? '' }}
                                        - {{ $order->holder_name ?? '' }}</a>
                                    <!--end::Title-->
                                </div>
                            </div>
                        </td>

                        <!--begin::Qty=-->
                        <td class="text-strt pe-0" data-order="15">
                            <span class="fw-bolder ms-3">Adult</span>
                        </td>
                        <td class="text-start pe-0" data-order="15">
                            <span class="fw-bolder ms-3">{{ $order->holder_email ?? '' }}</span>
                        </td>
                        <!--end::Qty=-->
                        <td class="text-center pe-0" data-order="15">
                            <span class="fw-bolder ms-3">{{ $order->holder_mobile ?? '' }}</span>
                        </td>

                        <td class="text-center pe-0" data-order="15">
                            <span class="fw-bolder ms-3">{{ $order->holder_job ?? '' }}</span>
                        </td>
                        <td class="text-center pe-0" data-order="15">
                            <span class="fw-bolder ms-3">{{ $order->notes ?? '' }}</span>
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
