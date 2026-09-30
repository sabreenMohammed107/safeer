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
    @if ($visaDetail->visa_passport_photo)
        <div class="d-flex align-items-center gap-2">
            <div class="symbol symbol-circle symbol-50px overflow-hidden">
                <a href="#" class="image-preview-trigger" data-full-src="{{ asset('uploads/visas') }}/{{ $visaDetail->visa_passport_photo }}"
                    data-title="Passport Image">
                    <div class="symbol-label fs-3 bg-light-danger text-danger">
                        <img src="{{ asset('uploads/visas') }}/{{ $visaDetail->visa_passport_photo }}"
                            class="w-100" alt="Passport">
                    </div>
                </a>
            </div>
            <a href="{{ route('visaDetails.download', ['visaDetail' => $visaDetail->id, 'field' => 'passport']) }}"
                class="btn btn-icon btn-sm btn-light-primary" title="Download passport image">
                <i class="bi bi-download"></i>
            </a>
        </div>
    @endif
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
    @if ($visaDetail->visa_personal_photo)
        <div class="d-flex align-items-center gap-2">
            <div class="symbol symbol-circle symbol-50px overflow-hidden">
                <a href="#" class="image-preview-trigger" data-full-src="{{ asset('uploads/visas') }}/{{ $visaDetail->visa_personal_photo }}"
                    data-title="Personal Photo">
                    <div class="symbol-label fs-3 bg-light-danger text-danger">
                        <img src="{{ asset('uploads/visas') }}/{{ $visaDetail->visa_personal_photo }}"
                            class="w-100" alt="Personal photo">
                    </div>
                </a>
            </div>
            <a href="{{ route('visaDetails.download', ['visaDetail' => $visaDetail->id, 'field' => 'personal']) }}"
                class="btn btn-icon btn-sm btn-light-primary" title="Download personal photo">
                <i class="bi bi-download"></i>
            </a>
        </div>
    @endif
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
<span class="fw-bolder text-dark">{{ $visaDetail->visa_cost !== null ? money($visaDetail->visa_cost) : '' }}</span>
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

<!--begin::Image preview modal (shared by every thumbnail trigger on this page)-->
<div class="modal fade" id="imagePreviewModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="imagePreviewModalLabel">Image Preview</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body text-center">
                <img id="imagePreviewModalImg" src="" alt="Preview" class="img-fluid rounded" />
            </div>
        </div>
    </div>
</div>
<!--end::Image preview modal-->

<script>
    // Event delegation on document: works for every .image-preview-trigger
    // on the page without binding a listener per thumbnail.
    document.addEventListener('click', function (e) {
        var trigger = e.target.closest('.image-preview-trigger');
        if (!trigger) return;
        e.preventDefault();

        document.getElementById('imagePreviewModalImg').src = trigger.dataset.fullSrc;
        document.getElementById('imagePreviewModalLabel').textContent = trigger.dataset.title || 'Image Preview';

        var modalEl = document.getElementById('imagePreviewModal');
        var modal = bootstrap.Modal.getOrCreateInstance(modalEl);
        modal.show();
    });
</script>
