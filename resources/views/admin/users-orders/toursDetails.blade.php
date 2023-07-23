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

   {{ $detail->tour_id}}</a>
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
data-kt-ecommerce-category-filter="category_name" >{{ $detail->tour_name?? ''}}</a>
<!--end::Title-->
</div>
</div>
</td>

<!--begin::Qty=-->
<td class="text-center pe-0" data-order="15">
<span class="fw-bolder ms-3">{{$detail->tour->type->en_name ?? '' }}</span>
</td>
<!--end::Qty=-->
<td class="text-center pe-0" data-order="15">
<span class="fw-bolder ms-3"><?php echo  number_format($detail->tour_cost, 2) .'$' ; ?></span>
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
    <span class="fw-bolder text-dark"><?php echo  number_format($detail->total_cost, 2) .'$' ; ?> </span>
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

<th class="min-w-200px">salutation</th>
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
<td>
<div class="d-flex align-items-center">

<div class="ms-5">
<!--begin::Title-->

<a href="#" class="text-gray-800 text-hover-primary fs-5 fw-bolder mb-1"
data-kt-ecommerce-category-filter="category_name" >{{$order->holder_salutation ?? '' }}</a>
<!--end::Title-->
</div>
</div>
</td>

<!--begin::Qty=-->
<td class="text-strt pe-0" data-order="15">
<span class="fw-bolder ms-3">{{$order->holder_name ?? '' }}</span>
</td>
<!--end::Qty=-->
<td class="text-center pe-0" data-order="15">
<span class="fw-bolder ms-3">{{ $order->holder_mobile ?? '' }}</span>
</td>

<td class="text-center pe-0" data-order="15">
<span class="fw-bolder ms-3">{{ $order->notes ?? '' }}</span>
</td>

<td class="text-center pe-0" data-order="15">
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
                   <!--begin::General options-->
                   <div class="card card-flush py-4">
                    <!--begin::Card header-->
                    <div class="card-header">
                        <div class="card-title">
                            <h2>Persons Details </h2>

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
    data-kt-ecommerce-category-filter="category_name" >{{$person->person_salutation ?? '' }} - {{$person->person_name ?? '' }}</a>
    <!--end::Title-->
    </div>
    </div>
    </td>

    <!--begin::Qty=-->
    <td class="text-strt pe-0" data-order="15">
        <span class="fw-bolder ms-3">{{$person->person_type==0 ?'Adult' : 'Child' }}</span>
    </td>
    <!--end::Qty=-->
    <td class="text-center pe-0" data-order="15">
    <span class="fw-bolder ms-3">{{ $person->mobile ?? '' }}</span>
    </td>

    <td class="text-center pe-0" data-order="15">
        <span class="fw-bolder ms-3">{{ $person->age ?? '' }}</span>
        </td>

        <td class="text-center pe-0" data-order="15">
            <span class="fw-bolder ms-3">{{ $person->person_cost ?? '' }} $</span>
            </td>

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
