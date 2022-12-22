@extends('layout.main')

@section('breadcrumb')
    <div class="toolbar" id="kt_toolbar">
        <div class="container-fluid d-flex flex-stack flex-wrap flex-sm-nowrap">
            <!--begin::Info-->
            <div class="d-flex flex-column align-items-start justify-content-center flex-wrap me-2">
                <!--begin::Title-->
                <h1 class="text-dark fw-bolder my-1 fs-2"> Contact Form</h1>
                <!--end::Title-->
                <!--begin::Breadcrumb-->
                <ul class="breadcrumb fw-bold fs-base my-1">
                    <li class="breadcrumb-item text-muted">
                        <a href="#" class="text-muted text-hover-primary">Home</a>
                    </li>
                    <li class="breadcrumb-item text-muted">Contact Form</li>

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
                            <th class="min-w-200px">Name</th>
                            {{-- <th class="text-end min-w-100px">Date</th> --}}
                            {{-- <th class="text-end min-w-100px">Time</th> --}}
                            <th class="text-end min-w-70px">phone</th>
                            <th class="text-end min-w-100px">Email</th>

                            <th class="text-end min-w-100px">Message</th>
                            {{-- <th class="text-end min-w-70px">Actions</th> --}}
                        </tr>
                        <!--end::Table row-->
                    </thead>
                    <!--end::Table head-->
                    <!--begin::Table body-->
                    <tbody class="fw-bold text-gray-600">
                        @foreach ($contacts as $index => $row)
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
                data-kt-ecommerce-category-filter="category_name" >{{ $row->name ?? ''}}</a>
                <!--end::Title-->
            </div>
        </div>
    </td>
    <!--end::Category=-->
     <!--begin::SKU=-->
     {{-- <td class="text-end pe-0">

        <span class="fw-bolder">{{ $row->event_date_form }}</span>
    </td> --}}
    <!--end::SKU=-->
    <!--begin::SKU=-->
    {{-- <td class="text-end pe-0">
        <input type="hidden" name="" id=""  data-kt-ecommerce-category-filter="category_id" value="{{$row->id}}" >
        <span class="fw-bolder">{{ $row->event_time_form }}</span>
    </td> --}}
    <!--end::SKU=-->
    <!--begin::Qty=-->
     <!--begin::Price=-->
     <td class="text-end pe-0">
        <span class="fw-bolder text-dark">{{ $row->phone ?? '' }}</span>
    </td>
    <!--end::Price=-->
    <td class="text-end pe-0" data-order="15">
        <input type="hidden" name="" id=""  data-kt-ecommerce-category-filter="category_id" value="{{$row->id}}" >
        <span class="fw-bolder ms-3">{{ $row->email ?? '' }}</span>
    </td>
    <!--end::Qty=-->


    <!--begin::Status=-->
    <td class="text-end pe-0">
        <span class="fw-bolder text-dark">{{ $row->message  ?? '' }}</span>
    </td>
    <!--end::Status=-->

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

