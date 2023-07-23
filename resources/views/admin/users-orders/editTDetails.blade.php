<div class="d-flex flex-column gap-7 gap-lg-10">
    <!--begin::General options-->
    <div class="card card-flush py-4">
        <!--begin::Card header-->
        <div class="card-header">
            <div class="card-title">
                <h2>Tours Details </h2>

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
                        <th class="min-w-70px">Tour ID</th>
                        <th class="min-w-200px">Tour Name</th>
                        <th class="min-w-100px">Tour Type</th>

                        <th class="text-end min-w-70px">Tour Cost</th>
                        <th class="text-end min-w-100px">Tour Date</th>

                        <th class="text-end min-w-100px">Adults Count</th>
                        <th class="text-end min-w-70px">children Count</th>
                        <th class="text-end min-w-70px">line_cost</th>
                        <th class="text-end min-w-70px">edit</th>
                    </tr>
                    <!--end::Table row-->
                </thead>
                <!--end::Table head-->
                <!--begin::Table body-->
                <tbody class="fw-bold text-gray-600">
                    @foreach ($tourDetails as $index => $detail)
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
                                <div class="d-flex align-items-center">

                                    <div class="ms-5">
                                        <!--begin::Title-->

                                        {{ $detail->tour_id }}</a>
                                        <!--end::Title-->
                                    </div>
                                </div>
                            </td>
                            <!--begin::Category=-->
                            <td>
                                <div class="d-flex align-items-center">

                                    <div class="ms-5">
                                        <!--begin::Title-->

                                        <a href="#" class="text-gray-800 text-hover-primary fs-5 fw-bolder mb-1"
                                            data-kt-ecommerce-category-filter="category_name">{{ $detail->tour_name ?? '' }}</a>
                                        <!--end::Title-->
                                    </div>
                                </div>
                            </td>

                            <!--begin::Qty=-->
                            <td class="text-center pe-0" data-order="15">
                                <span class="fw-bolder ms-3">{{ $detail->tour->type->en_name ?? '' }}</span>
                            </td>
                            <!--end::Qty=-->
                            <td class="text-center pe-0" data-order="15">
                                <span class="fw-bolder ms-3"><?php echo number_format($detail->tour_cost, 2) . '$'; ?></span>
                            </td>
                            <td class="text-center pe-0" data-order="15">
                                <span class="fw-bolder ms-3">{{ $detail->tour_date ?? '' }}</span>
                            </td>
                            <!--begin::Price=-->
                            <td class="text-center pe-0">
                                <span class="fw-bolder text-dark">{{ $detail->adults_count ?? '' }} </span>
                            </td>
                            <!--end::Price=-->

                            <!--begin::Status=-->
                            <td class="text-end pe-0">
                                <span class="fw-bolder text-dark">{{ $detail->children_count ?? '' }} </span>
                            </td>
                            <!--end::Status=-->
                            <!--begin::Status=-->
                            <td class="text-end pe-0">
                                <span class="fw-bolder text-dark"><?php echo number_format($detail->total_cost, 2) . '$'; ?> </span>
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
                                                action="{{ route('EditTourDetails') }}" method="post"
                                                enctype="multipart/form-data">
                                                @csrf

                                                <!--begin::Heading-->
                                                <input type="hidden" name="detail_id" value="{{ $detail->id }}">
                                                <div class="mb-13 text-center">
                                                    <!--begin::Title-->
                                                    <h1 class="mb-3">Update Details</h1>
                                                    <!--end::Title-->

                                                </div>
                                                <!--end::Heading-->
                                                <!--begin::Input group-->



                                                <div class="d-flex flex-column mb-8 fv-row">
                                                    <!--begin::Input group-->
                                                    <div class="d-flex flex-column mb-8">
                                                        <label class="fs-6 fw-bold mb-2">Tour Name</label>
                                                        <input type="text" class="form-control form-control-solid"
                                                            value="{{ $detail->tour_name ?? '' }}" />
                                                    </div>
                                                    <!--end::Input group-->

                                                    <!--begin::Input group-->


                                                    <div class="d-flex flex-column mb-8">
                                                        <label class="fs-6 fw-bold mb-2">Tour Date</label>
                                                        <input type="date" name="tour_date"
                                                            class="form-control form-control-solid"
                                                            value="{{ $detail->tour_date ?? '' }}" />
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

                        <th class="min-w-200px">salutation</th>
                        <th class="min-w-100px">holder name</th>
                        <th class="text-end min-w-70px">mobile</th>
                        <th class="text-end min-w-100px">notes</th>
                        <th class="text-end min-w-70px">email </th>
                        <th class="text-end min-w-70px">edit </th>

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
                                        data-kt-ecommerce-category-filter="category_name">{{ $order->holder_salutation ?? '' }}</a>
                                    <!--end::Title-->
                                </div>
                            </div>
                        </td>

                        <!--begin::Qty=-->
                        <td class="text-strt pe-0" data-order="15">
                            <span class="fw-bolder ms-3">{{ $order->holder_name ?? '' }}</span>
                        </td>
                        <!--end::Qty=-->
                        <td class="text-center pe-0" data-order="15">
                            <span class="fw-bolder ms-3">{{ $order->holder_mobile ?? '' }}</span>
                        </td>

                        <td class="text-center pe-0" data-order="15">
                            <span class="fw-bolder ms-3">{{ $order->notes ?? '' }}</span>
                        </td>

                        <td class="text-end pe-0" data-order="15">
                            <span class="fw-bolder ms-3">{{ $order->holder_email ?? '' }}</span>
                        </td>
                        <!--end::Status=-->
                        <td class="text-end pe-0">
                            <a data-bs-toggle="modal" data-bs-target="#kt_modal_new_holder{{ $order->id }}"
                                class="menu-link px-3">Edit</a>
                        </td>

                        <!--begin::Modal - New Target-->
                        <div class="modal fade" id="kt_modal_new_holder{{ $order->id }}" tabindex="-1"
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
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                    viewBox="0 0 24 24" fill="none">
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
                                        <form id="kt_modal_update_target_holder" class="form"
                                            action="{{ route('EditholderDetails') }}" method="post"
                                            enctype="multipart/form-data">
                                            @csrf

                                            <!--begin::Heading-->
                                            <input type="hidden" name="order_id" value="{{ $order->id }}">
                                            <div class="mb-13 text-center">
                                                <!--begin::Title-->
                                                <h1 class="mb-3">Update holder Details</h1>
                                                <!--end::Title-->

                                            </div>
                                            <!--end::Heading-->
                                            <!--begin::Input group-->



                                            <div class="d-flex flex-column mb-8 fv-row">
                                                <!--begin::Input group-->
                                                <div class="d-flex flex-column mb-8">
                                                    <label class="fs-6 fw-bold mb-2">SALUTATION</label>
                                                    <input type="text" name="holder_salutation"
                                                        class="form-control form-control-solid"
                                                        value="{{ $order->holder_salutation ?? '' }}" />
                                                </div>
                                                <!--end::Input group-->

                                                <!--begin::Input group-->


                                                <div class="d-flex flex-column mb-8">
                                                    <label class="fs-6 fw-bold mb-2">HOLDER NAME</label>
                                                    <input type="text" name="holder_name"
                                                        class="form-control form-control-solid"
                                                        value="{{ $order->holder_name ?? '' }}" />
                                                </div>

                                                <!--begin::Input group-->
                                                <div class="d-flex flex-column mb-8">
                                                    <label class="fs-6 fw-bold mb-2">MOBILE</label>
                                                    <input type="text" name="holder_mobile"
                                                        class="form-control form-control-solid"
                                                        value="{{ $order->holder_mobile ?? '' }}" />
                                                </div>
                                                <!--end::Input group-->

                                                <!--begin::Input group-->


                                                <div class="d-flex flex-column mb-8">
                                                    <label class="fs-6 fw-bold mb-2">EMAIL</label>
                                                    <input type="text" name="holder_email"
                                                        class="form-control form-control-solid"
                                                        value="{{ $order->holder_email ?? '' }}" />
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
    <!--begin::General options-->
    <div class="card card-flush py-4">
        <!--begin::Card header-->
        <div class="card-header">
            <div class="card-title">
                <h2>Persons Details </h2>

            </div>
            <!--begin::Card toolbar-->
            <div class="card-toolbar">
                <!--begin::Add customer-->
                <a data-bs-toggle="modal" data-bs-target="#add_adult" class="btn btn-primary mx-2">Add Adult</a>

                <a data-bs-toggle="modal" data-bs-target="#add_adult_child" class="btn btn-primary">Add Child</a>

                <!--end::Add customer-->
            </div>
            <!--end::Card toolbar-->
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
                        <th class="min-w-100px">P/Type</th>
                        <th class="text-end min-w-70px">Person Mobile</th>
                        <th class="text-end min-w-100px">Age</th>
                        <th class="text-end min-w-70px">Person Cost</th>

                    </tr>
                    <!--end::Table row-->
                </thead>
                <!--end::Table head-->
                <!--begin::Table body-->
                <tbody class="fw-bold text-gray-600">
                    @foreach ($persons as $index => $person)
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
                                            data-kt-ecommerce-category-filter="category_name">{{ $person->person_salutation ?? '' }}
                                            - {{ $person->person_name ?? '' }}</a>
                                        <!--end::Title-->
                                    </div>
                                </div>
                            </td>

                            <!--begin::Qty=-->
                            <td class="text-strt pe-0" data-order="15">
                                <span
                                    class="fw-bolder ms-3">{{ $person->person_type == 0 ? 'Adult' : 'Child' }}</span>
                            </td>
                            <!--end::Qty=-->
                            <td class="text-center pe-0" data-order="15">
                                <span class="fw-bolder ms-3">{{ $person->mobile ?? '' }}</span>
                            </td>

                            <td class="text-end pe-0" data-order="15">
                                <span class="fw-bolder ms-3">{{ $person->age ?? '' }}</span>
                            </td>

                            <td class="text-end pe-0" data-order="15">
                                <span class="fw-bolder ms-3">{{ $person->person_cost ?? '' }} $</span>
                            </td>
                            <td class="text-end pe-0">
                                <a data-bs-toggle="modal" data-bs-target="#kt_modal_new_person{{ $person->id }}"
                                    class="menu-link px-3">Edit</a>

                                {{-- <a href="#" class="menu-link px-3"
                                    data-kt-ecommerce-category-filter="delete_row" >Delete</a> --}}


                                <form id="delete_{{ $person->id }}" style="display: inline-block"
                                    action="{{ route('deleteTourPersons') }}" method="POST">
                                    @csrf
                                    {{-- <input type="hidden" name="_method" value="delete"> --}}
                                    <input type="hidden" name="preson_id" value="{{ $person->id }}">
                                    <input type="hidden" name="order_details_id" value="{{ $order->id }}">

                                    <button type="submit" class="menu-link px-3"
                                        style="border: none">Delete</button>
                                </form>
                            </td>

                            <!--begin::Modal - New Target-->
                            <div class="modal fade" id="kt_modal_new_person{{ $person->id }}" tabindex="-1"
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
                                                action="{{ route('EditTourPersons') }}" method="post"
                                                enctype="multipart/form-data">
                                                @csrf

                                                <!--begin::Heading-->
                                                <input type="hidden" name="detail_id" value="{{ $detail->id }}">
                                                <div class="mb-13 text-center">
                                                    <!--begin::Title-->
                                                    <h1 class="mb-3">Update Person</h1>
                                                    <!--end::Title-->

                                                </div>
                                                <!--end::Heading-->
                                                <!--begin::Input group-->



                                                <div class="d-flex flex-column mb-8 fv-row">
                                                    <!--begin::Input group-->
                                                    <div class="d-flex flex-column mb-8">
                                                        <label class="fs-6 fw-bold mb-2">Person Name</label>
                                                        <input type="text" name="person_name"
                                                            class="form-control form-control-solid"
                                                            value="{{ $person->person_name ?? '' }}" />
                                                    </div>
                                                    <!--end::Input group-->

                                                    <!--begin::Input group-->


                                                    <div class="d-flex flex-column mb-8">
                                                        <label class="fs-6 fw-bold mb-2">Person Mobile</label>
                                                        <input type="text" name="person_mobile"
                                                            class="form-control form-control-solid"
                                                            value="{{ $person->person_mobile ?? '' }}" />
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
    <!--begin::Modal - New Target-->
    <div class="modal fade" id="add_adult_child" tabindex="-1" aria-hidden="true">
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
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                viewBox="0 0 24 24" fill="none">
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
                    <form id="kt_modal_update_target_updateForm" class="form"
                        action="{{ route('AddChildTourPersons') }}" method="post" enctype="multipart/form-data">
                        @csrf

                        <!--begin::Heading-->
                        <input type="hidden" name="detail_id" value="{{ $detail->id }}">
                        <input type="hidden" name="order_details_id" value="{{ $order->id }}">
                        <div class="mb-13 text-center">
                            <!--begin::Title-->
                            <h1 class="mb-3">add child</h1>
                            <!--end::Title-->

                        </div>
                        <!--end::Heading-->
                        <!--begin::Input group-->



                        <div class="d-flex flex-column mb-8 fv-row">
                            <!--begin::Input group-->
                            <div class="d-flex flex-column mb-8">
                                <label class="fs-6 fw-bold mb-2">Child Name</label>
                                <input type="text" name="person_name" class="form-control form-control-solid"
                                    value="{{ $person->person_name ?? '' }}" />
                            </div>
                            <!--end::Input group-->

                            <!--begin::Input group-->


                            <div class="d-flex flex-column mb-8">
                                <label class="fs-6 fw-bold mb-2">Child Age</label>
                                <input type="number" name="age" class="form-control form-control-solid"
                                    value="{{ old('age') }}" />
                            </div>


                            <div class="text-center">
                                <div class="btn btn-sm btn-icon btn-active-color-primary" style="margin-right: 25px"
                                    data-bs-dismiss="modal">
                                    <button type="reset" id="kt_modal_update_target_cancel"
                                        class="btn btn-light me-3" data-dismiss="modal">Cancel</button>
                                </div>
                                <button type="submit" id="kt_modal_update_target_submit" class="btn btn-primary">
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
</div>

<!--begin::Modal - New Target-->
<div class="modal fade" id="add_adult" tabindex="-1" aria-hidden="true">
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
                <form id="kt_modal_update_target_updateForm" class="form"
                    action="{{ route('AddAdultTourPersons') }}" method="post" enctype="multipart/form-data">
                    @csrf

                    <!--begin::Heading-->
                    <input type="hidden" name="detail_id" value="{{ $detail->id }}">
                    <input type="hidden" name="order_details_id" value="{{ $order->id }}">
                    <div class="mb-13 text-center">
                        <!--begin::Title-->
                        <h1 class="mb-3">add adult</h1>
                        <!--end::Title-->

                    </div>
                    <!--end::Heading-->
                    <!--begin::Input group-->



                    <div class="d-flex flex-column mb-8 fv-row">

                        <!--begin::Input group-->
                        <div class="d-flex flex-column mb-8">
                            <label class="fs-6 fw-bold mb-2">Person salutation</label>
                            <input type="text" name="person_salutation" placeholder="Mr"
                                class="form-control form-control-solid" value="{{ old('person_salutation') }}" />
                        </div>
                        <!--end::Input group-->
                        <!--begin::Input group-->
                        <div class="d-flex flex-column mb-8">
                            <label class="fs-6 fw-bold mb-2">Person Name</label>
                            <input type="text" name="person_name" class="form-control form-control-solid"
                                value="{{ old('person_name') }}" />
                        </div>
                        <!--end::Input group-->

                        <!--begin::Input group-->


                        <div class="d-flex flex-column mb-8">
                            <label class="fs-6 fw-bold mb-2">Person Mobile</label>
                            <input type="text" name="person_mobile" class="form-control form-control-solid"
                                value="{{ old('person_mobile') }}" />
                        </div>
                        <div class="d-flex flex-column mb-8">
                            <label class="fs-6 fw-bold mb-2">Person email</label>
                            <input type="text" name="person_email" class="form-control form-control-solid"
                                value="{{ old('person_email') }}" />
                        </div>
                        <div class="text-center">
                            <div class="btn btn-sm btn-icon btn-active-color-primary" style="margin-right: 25px"
                                data-bs-dismiss="modal">
                                <button type="reset" id="kt_modal_update_target_cancel" class="btn btn-light me-3"
                                    data-dismiss="modal">Cancel</button>
                            </div>
                            <button type="submit" id="kt_modal_update_target_submit" class="btn btn-primary">
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
