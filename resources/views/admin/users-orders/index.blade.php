@extends('layout.main')

@section('breadcrumb')
    <div class="toolbar" id="kt_toolbar">
        <div class="container-fluid d-flex flex-stack flex-wrap flex-sm-nowrap">
            <!--begin::Info-->
            <div class="d-flex flex-column align-items-start justify-content-center flex-wrap me-2">
                <!--begin::Title-->
                <h1 class="text-dark fw-bolder my-1 fs-2"> Orders</h1>
                <!--end::Title-->
                <!--begin::Breadcrumb-->
                <ul class="breadcrumb fw-bold fs-base my-1">
                    <li class="breadcrumb-item text-muted">
                        <a href="#" class="text-muted text-hover-primary">Home</a>
                    </li>
                    <li class="breadcrumb-item text-muted">Order Data</li>

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
                      <!--begin::Add product-->
                                        {{-- <a href="{{ route('blogs.create') }}" class="btn btn-primary">Add Blog</a> --}}
                                        <!--end::Add product-->

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
                            <th class="min-w-100px">Order ID</th>
                            <th class="min-w-100px">User Name</th>
                            {{-- <th class="text-end min-w-100px">Date</th> --}}
                            {{-- <th class="text-end min-w-100px">Time</th> --}}
                            <th class="text-end min-w-70px">User ID</th>
                            <th class="text-end min-w-100px">Type</th>
                            <th class="text-end min-w-100px">pickup_point</th>
                            <th class="text-end min-w-100px">Created Date</th>
                            <th class="text-end min-w-100px">Grand Total</th>
                            <th class="text-end min-w-100px">Status</th>
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
    <!--begin::Category=-->
    <td>
        <div class="d-flex align-items-center">

            <div class="ms-5">
                <!--begin::Title-->

                 {{ $row->order->id ?? ''}}
                <!--end::Title-->
            </div>
        </div>
    </td>
    <td>
        <div class="d-flex align-items-center">

            <div class="ms-5">
                <!--begin::Title-->

                <a href="{{ route('users-orders.show', $row->order_id ) }}" class="text-gray-800 text-hover-primary fs-5 fw-bolder mb-1"
                 >{{ $row->order->user->name ?? ''}}</a>
                <!--end::Title-->
            </div>
        </div>
    </td>

    <!--begin::Qty=-->
    <td class="text-end pe-0" data-order="15">
        <input type="hidden" name="" id=""  data-kt-ecommerce-category-filter="category_id" value="{{$row->id}}" >
        <span class="fw-bolder ms-3">{{ $row->order->user->id ?? '' }}</span>
    </td>
    <!--end::Qty=-->
    <!--begin::Price=-->
    <td class="text-center pe-0">
        <span class="fw-bolder text-dark">

            @if ($row->detail_type == 0)
                Booking Room
            @endif

            @if ($row->detail_type == 1)

                Booking Tours
            @endif

            @if ($row->detail_type == 2)
                Booking Transfer
            @endif

            @if ($row->detail_type == 3)
            <?php
             $visaDetail= App\Models\VisaDetails::where('order_details_id',$row->id)->first();
             ?>

                Booking Visa / {{ $visaDetail->visa->country->en_country ?? ''}}
                {{-- {{$visaDetail->visa->nationality->en_nationality  }} --}}
            @endif
           </span>
    </td>
    <td class="text-end pe-0">

        <span class="fw-bolder text-dark">{{ $row->pickup_point ?? '' }}</span>
    </td>
    <td class="text-end pe-0">

        <span class="fw-bolder text-dark">{{ $row->order->created_at ?? '' }}</span>
    </td>

    <td class="text-end pe-0">

        <span class="fw-bolder text-dark">
            @if ($row->detail_type == 0)
            <?php
            $taxVal=($row->room_details->sum('total_cost') * ($row->order->tax_percentage))/100;
            $grandTotal=$row->room_details->sum('total_cost') + $taxVal;
                    ?>
                    {{number_format((float)$grandTotal, 2, '.', '')}}$

        @endif

        @if ($row->detail_type == 1)
        <?php

        $taxVal=($row->tours_details->sum('total_cost')* ($row->order->tax_percentage))/100;
        $grandTotal=$row->tours_details->sum('total_cost')+$taxVal;
                ?>
            {{number_format((float)$grandTotal, 2, '.', '')}}$
        @endif

        @if ($row->detail_type == 2)
        <?php
        $taxVal=($row->transfer_details->sum('transfer_total_cost')* ($row->order->tax_percentage))/100;
        $grandTotal=$row->transfer_details->sum('transfer_total_cost') + $taxVal;
                ?>
                {{number_format((float)$grandTotal, 2, '.', '')}}$
        @endif

        @if ($row->detail_type == 3)
        <?php
        $taxVal=($row->visa_details->sum('visa_cost')* ($row->order->tax_percentage))/100;
        $grandTotal=$row->visa_details->sum('visa_cost') + $taxVal;
                ?>
                {{number_format((float)$grandTotal, 2, '.', '')}}$
        @endif
        </span>
    </td>
    <td class="text-end pe-0">
@if($row->status_id ==2)
        <button class="btn btn-sm btn-light" > <span class="fw-bolder text-success">
            {{ $row->status->status ?? '' }}</span></button>
        {{--  --}}
@elseif ($row->status_id ==4)
<button class="btn btn-sm btn-light" > <span class="fw-bolder text-danger">
    {{ $row->status->status ?? '' }}</span></button>
@else
<button class="btn btn-sm btn-light" > <span class="fw-bolder text-dark">
    {{ $row->status->status ?? '' }}</span></button>
@endif
        {{-- <span class="fw-bolder text-dark">
            {{ $row->status->status ?? '' }}</span> --}}
    </td>
    <!--end::Status=-->
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
                <a href="{{ route('users-orders.show', $row->id ) }}"
                    class="menu-link px-3">show</a>
            </div>
            <!--end::Menu item-->
            <div class="menu-item px-3">
                <a href="{{ route('users-orders.edit', $row->id ) }}"
                    class="menu-link px-3">edit</a>
            </div>

             <!--begin::Menu item-->
             <div class="menu-item px-3">
                <a data-bs-toggle="modal"
                    data-bs-target="#kt_modal_new_targetEdit{{$row->id}}"
                    class="menu-link px-3">Assign</a>
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
                        action="{{ route('assignThisOrder') }}" method="post">
                        @csrf

                        <!--begin::Heading-->
                        <input type="hidden" name="order_details_id" value="{{ $row->id }}"
                            id="">
                        <div class="mb-13 text-center">
                            <!--begin::Title-->
                            <h1 class="mb-3">Assign Order</h1>
                            <!--end::Title-->

                        </div>
                        <!--end::Heading-->




                        <div>
                            <label class="fs-6 fw-bold form-label mt-3">
                                <option value="">Select a Seller...</option>
                                <i class="fas fa-exclamation-circle ms-1 fs-7"
                                    data-bs-toggle="tooltip"
                                    title="Interviewer who conducts the meeting with the interviewee"></i>
                            </label>

                            <select name="seller_id" required aria-label="Select a seller"
                                data-control="select2"
                                data-placeholder="Select a seller..."
                                data-dropdown-parent="#kt_modal_new_targetEdit{{ $row->id }}"
                                class="form-select form-select-solid fw-bolder">
                                <option value=""></option>
                                @foreach ($sellers as $seller)
                                    <option value="{{ $seller->id }}"
                                        {{ $row->tour_id == $seller->id ? 'selected' : '' }}>
                                        {{ $seller->name ?? '' }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <!--end::Input group-->

                        <!--begin::Actions-->
                        <div class="text-center mt-4">
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
            <!--end::Card body-->
        </div>
        <!--end::Category-->
    </div>
    <!--end::Container-->
</div>
<!--end::Post-->
@endsection

