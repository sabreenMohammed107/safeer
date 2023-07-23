@extends('layout.main')

@section('breadcrumb')
    <div class="toolbar" id="kt_toolbar">
        <div class="container-fluid d-flex flex-stack flex-wrap flex-sm-nowrap">
            <!--begin::Info-->
            <div class="d-flex flex-column align-items-start justify-content-center flex-wrap me-2">
                <!--begin::Title-->
                <h1 class="text-dark fw-bolder my-1 fs-2"> Assign orders for {{ $user->name }}</h1>
                <!--end::Title-->
                <!--begin::Breadcrumb-->
                <ul class="breadcrumb fw-bold fs-base my-1">
                    <li class="breadcrumb-item text-muted">
                        <a href="#" class="text-muted text-hover-primary">Home</a>
                    </li>
                    <li class="breadcrumb-item text-muted">
                        <a href="{{ route('user-role.index') }}" class="text-muted text-hover-primary">Users Data </a></li>

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

                {{--  --}}
                <form action="{{ route('storeAssign') }}" method="post" enctype="multipart/form-data">
                    {{ csrf_field() }}
                   <!--begin::Table-->
                   <div class="d-flex justify-content-end">
                    <!--begin::Button-->
<input type="hidden" name="user_id" value="{{  $user->id}}" >
                    <!--end::Button-->
                    <!--begin::Button-->
                    <button type="submit" id="kt_ecommerce_add_category_submit" class="btn btn-primary">
                        <span class="indicator-label">Assign orders to {{$user->name  }}</span>
                        <span class="indicator-progress">Please wait...
                            <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                    </button>
                    <button type="reset"  class="btn btn-danger mx-2">
                        <span >Cancel Changes</span>

                    </button>
                    <!--end::Button-->
                </div>
                   <table class="table align-middle table-row-dashed fs-6 gy-5" id="kt_ecommerce_category_table2">
                    <!--begin::Table head-->
                    <thead>
                        <!--begin::Table row-->
                        <tr class="text-start text-gray-400 fw-bolder fs-7 text-uppercase gs-0">
                            <th class="w-10px pe-2">
                                <div class="form-check form-check-sm form-check-custom form-check-solid me-3">
                                    <input class="form-check-input" type="checkbox" data-kt-check="true"
                                        data-kt-check-target="#kt_ecommerce_category_table2 .form-check-input"
                                        value="1" />
                                </div>
                            </th>
                            <th class="min-w-100px"> Order Id</th>

                            <th class="text-end min-w-100px">Order Date</th>
                            <th class="text-end min-w-100px">Order Status</th>
                            <th class="text-center min-w-100px">Holder Name</th>

                            <th class="text-end min-w-100px">Order Type</th>

                            <th class="text-end min-w-100px">Grand Total</th>

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
            <input class="form-check-input" type="checkbox" name="checkboxlist[]" value="{{$row->id}}"
            @foreach ($userorders as $sublist) {{ $sublist->pivot->order_details_id == $row->id ? 'checked' : '' }} @endforeach />
        </div>
    </td>
    <!--end::Checkbox-->
    <!--begin::Category=-->
    <td>
        <div class="d-flex align-items-center">

            <div class="ms-5">
                <!--begin::Title-->

                 {{ $row->id ?? ''}}
                <!--end::Title-->
            </div>
        </div>
    </td>

    <td class="text-end pe-0">

        <span class="fw-bolder text-dark">{{ $row->order->created_at ?? '' }}</span>
    </td>

    <td class="text-end pe-0">

        <span class="fw-bolder text-dark">{{ $row->status->status ?? '' }}</span>
    </td>
    <!--begin::Qty=-->
    <td class="text-center pe-0">
        {{-- <div class="d-flex align-items-center">

            <div class="ms-5"> --}}
                <!--begin::Title-->

                <a href="{{ route('users-orders.show', $row->order_id ) }}" class="text-gray-800 text-hover-primary fs-5 fw-bolder mb-1"
                 >{{ $row->order->user->name ?? ''}}</a>
                <!--end::Title-->
            {{-- </div>
        </div> --}}
    </td>

    <!--begin::Price=-->
    <td class="text-end pe-0">
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
                Booking Visa
            @endif
           </span>
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

    <!--end::Status=-->

</tr>
<!--end::Table row-->
@endforeach


                    </tbody>
                    <!--end::Table body-->
                </table>

                </form><!--end::Table-->

            </div>
            <!--end::Card body-->
        </div>
        <!--end::Category-->
    </div>
    <!--end::Container-->
</div>
<!--end::Post-->
@endsection
@section('scripts')
<script>
    datatable = $('#kt_ecommerce_category_table2').DataTable({
            "info": false,
            'order': [],
            "search": false,
            'pageLength': 5000,
            'columnDefs': [
                { orderable: false, targets: 0 }, // Disable ordering on column 0 (checkbox)
                { orderable: false, targets: 3 }, // Disable ordering on column 3 (actions)
            ]
        });
    </script>
@endsection

