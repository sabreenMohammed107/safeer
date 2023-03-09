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
data-kt-ecommerce-category-filter="category_name" >{{ $detail->transfer_date ?? ''}}</a>
<!--end::Title-->
</div>
</div>
</td>

<!--begin::Qty=-->
<td class="text-center pe-0" data-order="15">
<span class="fw-bolder ms-3">{{$detail->transfer_from ?? '' }}</span>
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
        <span class="fw-bolder text-dark">@if( $detail->is_return == 1) Return @else Not Return @endif</span>
        </td>


        <td class="text-end pe-0">
            <span class="fw-bolder text-dark">{{ $detail->return_date}} </span>
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
    data-kt-ecommerce-category-filter="category_name" >{{$order->holder_salutation ?? '' }} - {{$order->holder_name ?? '' }}</a>
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
</div>
