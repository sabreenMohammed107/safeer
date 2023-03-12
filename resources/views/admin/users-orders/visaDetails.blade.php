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
data-kt-ecommerce-category-filter="category_name" >{{ $visaDetail->visa->type->en_type ?? ''}}</a>
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
<span class="fw-bolder ms-3">{{$visaDetail->visa->nationality->en_nationality ?? '' }}</span>
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
<span class="fw-bolder ms-3">{{$order->holder_name ?? '' }}</span>
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
</div>

</div>
