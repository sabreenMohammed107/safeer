@extends('layout.main')

@section('breadcrumb')
    <div class="toolbar" id="kt_toolbar">
        <div class="container-fluid d-flex flex-stack flex-wrap flex-sm-nowrap">
            <!--begin::Info-->
            <div class="d-flex flex-column align-items-start justify-content-center flex-wrap me-2">
                <!--begin::Title-->
                <h1 class="text-dark fw-bolder my-1 fs-2">Order</h1>
                <!--end::Title-->
                <!--begin::Breadcrumb-->
                <ul class="breadcrumb fw-bold fs-base my-1">
                    <li class="breadcrumb-item text-muted">
                        <a href="../dist/index.html" class="text-muted text-hover-primary">Home</a>
                    </li>
                    <li class="breadcrumb-item text-muted">Order</li>

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


                <!--begin::Main column-->
                <div class="d-flex flex-column flex-row-fluid gap-7 gap-lg-10">
                    <ul class="nav nav-custom nav-tabs nav-line-tabs nav-line-tabs-2x border-0 fs-4 fw-bold mb-n2">
                        <!--begin:::Tab item-->
                        <li class="nav-item">
                            <a class="nav-link text-active-primary pb-4 active" data-bs-toggle="tab"
                                href="#kt_ecommerce_add_product_general">Order</a>
                        </li>
                        <!--end:::Tab item-->
                        <!--begin:::Tab item-->
                        <li class="nav-item">
                            <a class="nav-link text-active-primary pb-4" data-bs-toggle="tab"
                                href="#kt_ecommerce_add_product_advanced">Order Persons</a>
                        </li>
                        <!--end:::Tab item-->

                        <!--begin:::Tab item-->
                        <li class="nav-item">
                            <a class="nav-link text-active-primary pb-4" data-bs-toggle="tab"
                                href="#kt_ecommerce_add_fixed_advanced">Order Details</a>
                        </li>
                        <!--end:::Tab item-->


                        <!--begin:::Tab item-->
                        {{-- <li class="nav-item">
                            <a class="nav-link text-active-primary pb-4" data-bs-toggle="tab"
                                href="#kt_ecommerce_add_days_advanced">Days</a>
                        </li> --}}
                        <!--end:::Tab item-->
                    </ul>

                    <div class="tab-content">
                        <!--begin::Tab pane-->
                        <div class="tab-pane fade show active" id="kt_ecommerce_add_product_general" role="tab-panel">
                            <div class="d-flex flex-column gap-7 gap-lg-10">
                                <!--begin::General options-->
                                <div class="card card-flush py-4">
                                    <!--begin::Card header-->
                                    <div class="card-header">
                                        <div class="card-title">
                                            <h2>Order </h2>
                                            <span style="color: red;font-size: 14px"> Total Order Cost : {{$totalCost}}</span>
                                        </div>
                                    </div>
                                    <!--end::Card header-->
                                    <!--begin::Card body-->
                                    <div class="card-body pt-0">
                                        <!--begin::Input group-->
                                        <div class="d-flex flex-wrap gap-5">
                                            <!--begin::Input group-->
                                            <div class="fv-row w-100 flex-md-root">
                                                <!--begin::Label-->
                                                <label class="required form-label"> User Name</label>
                                                <!--end::Label-->
                                                <!--begin::Input-->
                                                <input type="text" required name="overview_entitle"
                                                    class="form-control mb-2" placeholder=" En name"
                                                    value="{{ $order->user->name ?? '' }}" />


                                            </div>
                                            <!--end::Input-->

                                            <!--begin::Input group-->
                                            <div class="fv-row w-100 flex-md-root">
                                                <!--begin::Label-->
                                                <label class="required form-label"> Holder Name</label>
                                                <!--end::Label-->
                                                <!--begin::Input-->
                                                <input type="text" name="overview_artitle" class="form-control mb-2"
                                                    placeholder=" Ar title" value="{{$order->holder_salutation}} - {{$order->holder_name }}" />


                                            </div>
                                        </div>
                                        <!--end::Input-->

                                        <!--begin::Input group-->
                                        <div class="d-flex flex-wrap gap-5">
                                            <!--begin::Input group-->
                                            <div class="fv-row w-100 flex-md-root">
                                                <!--begin::Label-->
                                                <label class="required form-label">Holder Mobile</label>
                                                <!--end::Label-->
                                                <!--begin::Input-->
                                                <input type="text" required name="overview_ensubtitle"
                                                    class="form-control mb-2" placeholder="Holder Mobile"
                                                    value="{{ $order->holder_mobile }}" />


                                            </div>
                                            <!--end::Input-->

                                        </div>
                                        <!--end::Input-->





                                        <!--begin::Input group-->
                                        <div class="d-flex flex-wrap gap-5">
                                            <!--begin::Input group-->
                                            <div class="fv-row w-100 flex-md-root">
                                                <!--begin::Label-->
                                                <label class="form-label">Notes</label>
                                                <!--end::Label-->
                                                <!--begin::Editor-->
                                                <textarea class="form-select form-select-solid" id="kt_docs_tinymce_basic" name="notes">{{ $order->notes }}</textarea>
                                                <!--end::Editor-->

                                            </div>
                                            <!--end::Input group-->


                                        </div>


                                        <!--begin::Input group-->
                                        <div class="d-flex flex-wrap gap-5">
                                           <!--begin::Input group-->
                                           <div class="fv-row w-100 flex-md-root">
                                            <!--begin::Label-->
                                            <label class="required form-label">from_date</label>
                                            <!--end::Label-->
                                            <!--begin::Input-->
                                            <input type="text" required name="overview_ensubtitle"
                                                class="form-control mb-2" placeholder="from_date"
                                                value="{{ $order->from_date }}" />


                                        </div>
                                        <!--end::Input-->
                                           <!--begin::Input group-->
                                           <div class="fv-row w-100 flex-md-root">
                                            <!--begin::Label-->
                                            <label class="required form-label">to_date</label>
                                            <!--end::Label-->
                                            <!--begin::Input-->
                                            <input type="text" required name="overview_ensubtitle"
                                                class="form-control mb-2" placeholder="to_date"
                                                value="{{ $order->to_date }}" />


                                        </div>
                                        <!--end::Input-->

                                        </div>


                                        <!--begin::Input group-->
                                        <div class="d-flex flex-wrap gap-5">
                                            <!--begin::Input group-->
                                            <div class="fv-row w-100 flex-md-root">
                                                <!--begin::Label-->
                                                <label class="required form-label">Nights</label>
                                                <!--end::Label-->
                                                <!--begin::Input-->
                                                <input type="text" required name="overview_ensubtitle"
                                                    class="form-control mb-2" placeholder="nights"
                                                    value="{{ $order->nights }}" />


                                            </div>
                                            <!--end::Input-->


                                        </div>
                                        <!--begin::Social options-->
                                        <div class="card card-flush py-4">
                                            <!--begin::Card header-->
                                            <div class="card-header">

                                                <!--begin::Row-->

                                                <div class="row row-cols-1 row-cols-md-3 row-cols-lg-1 row-cols-xl-3 g-9"
                                                    data-kt-buttons="true"
                                                    data-kt-buttons-target="[data-kt-button='true']">


                                                    <!--begin::Col-->
                                                    <div class="col">
                                                        <!--begin::Option-->
                                                        <!--begin::Label-->
                                                        <label class="form-label">Adult Account</label>
                                                        <!--end::Label-->
                                                        <!--begin::Input-->
                                                        <input type="text" class="form-control mb-2" name="adult"
                                                            placeholder="Adult"
                                                            value="{{ $order->adults_count }}" />
                                                        <!--end::Input-->
                                                        <!--end::Option-->
                                                    </div>

                                                    <!--begin::Tax-->
                                                    <div class="col">
                                                        <!--begin::Input group-->
                                                        <div class="fv-row w-100 flex-md-root">
                                                            <label class=" form-label">children</label>
                                                            <!--end::Label-->
                                                            <!--begin::Input-->
                                                            <input type="text" name="children"
                                                                class="form-control mb-2" placeholder="children"
                                                                value="{{ $order->children_count }}" />
                                                            <!--end::Input-->
                                                        </div>
                                                    </div>
                                                    <!--end::Input group-->
                                                    <!--begin::Input group-->
                                                    <div class="col">
                                                        <div class="fv-row w-100 flex-md-root">
                                                            <!--begin::Label-->
                                                            <label class=" form-label">rooms_count</label>
                                                            <!--end::Label-->
                                                            <!--begin::Input-->
                                                            <input type="text" name="rooms_count"
                                                                class="form-control mb-2" placeholder="rooms_count"
                                                                value="{{ $order->rooms_count }}" />
                                                            <!--end::Input-->
                                                        </div>
                                                        <!--end::Input group-->
                                                    </div>
                                                    <!--end:Tax-->
                                                </div>
                                                <!--end::Row-->

                                            </div>
                                            <!--end::Card header-->


                                            <!--end::Card header-->
                                        </div>
                                        <!--end::Social options-->



                                        <!--begin::checkbox-->



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
                                <!--begin::General options-->
                                <div class="card card-flush py-4">
                                    <!--begin::Card header-->
                                    <div class="card-header">
                                        <div class="card-title">
                                            <h2>Order Persons </h2>

                                        </div>
                                        <span style="color: red;font-size: 14px">  " Total Order Cost : {{$totalCost}} "</span>

                                    </div>
                                    <!--end::Card header-->
                                    <!--begin::Card body-->
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
            <th class="min-w-200px">Person type</th>
            {{-- <th class="text-end min-w-100px">Date</th> --}}
            {{-- <th class="text-end min-w-100px">Time</th> --}}
            <th class="text-end min-w-70px">Person Name</th>
            <th class="text-end min-w-100px">Person Mobile</th>

            <th class="text-end min-w-100px">Person Cost</th>

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

<a  class="text-gray-800 text-hover-primary fs-5 fw-bolder mb-1"
data-kt-ecommerce-category-filter="category_name" >{{ $person->person_type == 0 ? 'Adult' : 'child'}} </a>
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
<td class="text-end pe-0" data-order="15">
<input type="hidden" name="" id=""  data-kt-ecommerce-category-filter="category_id" value="{{$person->id}}" >
<span class="fw-bolder ms-3">{{ $person->person_name ?? '' }}</span>
</td>
<!--end::Qty=-->
<!--begin::Price=-->
<td class="text-end pe-0">
<span class="fw-bolder text-dark">{{ $person->person_mobile ?? '' }}</span>
</td>
<!--end::Price=-->

<!--begin::Status=-->
<td class="text-end pe-0">
<span class="fw-bolder text-dark">{{ $person->person_cost ?? '' }}</span>
</td>
<!--end::Status=-->
<!--begin::Action=-->

<!--end::Action=-->
</tr>
<!--end::Table row-->
@endforeach


    </tbody>
    <!--end::Table body-->
</table>
<!--end::Table-->
 </div>
                                    <!--end::Card header-->
                                </div>
                                <!--end::General options-->
                            </div>
                        </div>

                        <div class="tab-pane fade" id="kt_ecommerce_add_fixed_advanced" role="tab-panel">
                            <div class="d-flex flex-column gap-7 gap-lg-10">
                                <!--begin::General options-->
                                <div class="card card-flush py-4">
                                    <!--begin::Card header-->
                                    <div class="card-header">
                                        <div class="card-title">
                                            <h2>Order Details </h2>
                                            <span style="color: red;font-size: 14px"> Total Order Cost : {{$totalCost}}</span>

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
               <th class="min-w-200px">Hotel Name</th>
               <th class="min-w-100px">room_type</th>

               <th class="text-end min-w-70px">room_view</th>
               <th class="text-end min-w-100px">food_bev_type</th>

               <th class="text-end min-w-100px">room_cost</th>
               <th class="text-end min-w-70px">line_cost</th>
           </tr>
           <!--end::Table row-->
       </thead>
       <!--end::Table head-->
       <!--begin::Table body-->
       <tbody class="fw-bold text-gray-600">
           @foreach ($details as $index => $detail)
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
   data-kt-ecommerce-category-filter="category_name" >{{ $detail->hotel->hotel_enname ?? ''}}</a>
   <!--end::Title-->
   </div>
   </div>
   </td>

   <!--begin::Qty=-->
   <td class="text-center pe-0" data-order="15">
   <span class="fw-bolder ms-3">{{$detail->room_type ?? '' }}</span>
   </td>
   <!--end::Qty=-->
   <td class="text-center pe-0" data-order="15">
    <span class="fw-bolder ms-3">{{ $detail->room_view ?? '' }}</span>
    </td>
    <td class="text-center pe-0" data-order="15">
        <span class="fw-bolder ms-3">{{ $detail->food_bev_type ?? '' }}</span>
        </td>
   <!--begin::Price=-->
   <td class="text-center pe-0">
   <span class="fw-bolder text-dark">{{ $detail->room_cost ?? '' }}</span>
   </td>
   <!--end::Price=-->

   <!--begin::Status=-->
   <td class="text-end pe-0">
   <span class="fw-bolder text-dark">{{ $detail->total_cost ?? '' }}</span>
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
                                </div>
                                <!--end::General options-->
                            </div>
                        </div>
                        <div class="d-flex justify-content-end">
                            <!--begin::Button-->
                            <a href="{{ route('users-orders.index',) }}" id="kt_ecommerce_add_product_cancel"
                                class="btn btn-light me-5">Cancel</a>
                            <!--end::Button-->

                        </div>
                    </div>
                    <!--end::Main column-->

        </div>
        <!--end::Container-->
    </div>

    <!--end::Post-->
@endsection
