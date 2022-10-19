@extends('layout.main')

@section('breadcrumb')
    <div class="toolbar" id="kt_toolbar">
        <div class="container-fluid d-flex flex-stack flex-wrap flex-sm-nowrap">
            <!--begin::Info-->
            <div class="d-flex flex-column align-items-start justify-content-center flex-wrap me-2">
                <!--begin::Title-->
                <h1 class="text-dark fw-bolder my-1 fs-2">Hotels</h1>
                <!--end::Title-->
                <!--begin::Breadcrumb-->
                <ul class="breadcrumb fw-bold fs-base my-1">
                    <li class="breadcrumb-item text-muted">
                        <a href="../dist/index.html" class="text-muted text-hover-primary">Home</a>
                    </li>
                    <li class="breadcrumb-item text-muted">Hotels</li>

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
            <form id="kt_ecommerce_add_category_form" class="form d-flex flex-column flex-lg-row"
                action="{{ route('hotels.store') }}" method="post" enctype="multipart/form-data" >
                @csrf
 <!--begin::Aside column-->
 <div class="d-flex flex-column gap-7 gap-lg-10 w-100 w-lg-300px mb-7 me-lg-10">
    <!--begin::Thumbnail settings-->
    {{-- <div class="card card-flush py-4">
        <!--begin::Card header-->
        <div class="card-header">
            <!--begin::Card title-->
            <div class="card-title">
                <h2>Thumbnail</h2>
            </div>
            <!--end::Card title-->
        </div>
        <!--end::Card header-->
        <!--begin::Card body-->
        <div class="card-body text-center pt-0">
            <!--begin::Image input-->
            <div class="image-input image-input-empty image-input-outline mb-3" data-kt-image-input="true" style="background-image: url(assets/media/svg/files/blank-image.svg)">
                <!--begin::Preview existing avatar-->
                <div class="image-input-wrapper w-150px h-150px"></div>
                <!--end::Preview existing avatar-->
                <!--begin::Label-->
                <label class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow" data-kt-image-input-action="change" data-bs-toggle="tooltip" title="Change avatar">
                    <!--begin::Icon-->
                    <i class="bi bi-pencil-fill fs-7"></i>
                    <!--end::Icon-->
                    <!--begin::Inputs-->
                    <input type="file" name="hotel_logo" accept=".png, .jpg, .jpeg" />
                    <input type="hidden" name="avatar_remove" />
                    <!--end::Inputs-->
                </label>
                <!--end::Label-->
                <!--begin::Cancel-->
                <span class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow" data-kt-image-input-action="cancel" data-bs-toggle="tooltip" title="Cancel avatar">
                    <i class="bi bi-x fs-2"></i>
                </span>
                <!--end::Cancel-->
                <!--begin::Remove-->
                <span class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow" data-kt-image-input-action="remove" data-bs-toggle="tooltip" title="Remove avatar">
                    <i class="bi bi-x fs-2"></i>
                </span>
                <!--end::Remove-->
            </div>
            <!--end::Image input-->

        </div>
        <!--end::Card body-->
    </div> --}}
    <!--end::Thumbnail settings-->

<!--begin::Thumbnail settings-->
<div class="card card-flush py-4">
    <!--begin::Card header-->
    <div class="card-header">
        <!--begin::Card title-->
        <div class="card-title">
            <h2>Banner</h2>
        </div>
        <!--end::Card title-->
    </div>
    <!--end::Card header-->
    <!--begin::Card body-->
    <div class="card-body text-center pt-0">
        <!--begin::Image input-->
        <div class="image-input image-input-empty image-input-outline mb-3" data-kt-image-input="true" style="background-image: url(assets/media/svg/files/blank-image.svg)">
            <!--begin::Preview existing avatar-->
            <div class="image-input-wrapper w-150px h-150px"></div>
            <!--end::Preview existing avatar-->
            <!--begin::Label-->
            <label class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow" data-kt-image-input-action="change" data-bs-toggle="tooltip" title="Change avatar">
                <!--begin::Icon-->
                <i class="bi bi-pencil-fill fs-7"></i>
                <!--end::Icon-->
                <!--begin::Inputs-->
                <input type="file" name="hotel_banner" accept=".png, .jpg, .jpeg" />
                <input type="hidden" name="avatar_remove" />
                <!--end::Inputs-->
            </label>
            <!--end::Label-->
            <!--begin::Cancel-->
            <span class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow" data-kt-image-input-action="cancel" data-bs-toggle="tooltip" title="Cancel avatar">
                <i class="bi bi-x fs-2"></i>
            </span>
            <!--end::Cancel-->
            <!--begin::Remove-->
            <span class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow" data-kt-image-input-action="remove" data-bs-toggle="tooltip" title="Remove avatar">
                <i class="bi bi-x fs-2"></i>
            </span>
            <!--end::Remove-->
        </div>
        <!--end::Image input-->

    </div>
    <!--end::Card body-->
</div>
<!--end::Thumbnail settings-->
</div>
<!--end::Aside column-->
                <!--begin::Main column-->
                <div class="d-flex flex-column flex-row-fluid gap-7 gap-lg-10">
                    <!--begin::General options-->
                    <div class="card card-flush py-4">
                        <!--begin::Card header-->
                        <div class="card-header">
                            <div class="card-title">
                                <h2>General</h2>
                            </div>
                        </div>
                        <!--end::Card header-->
                        <!--begin::Card body-->
                        <div class="card-body pt-0">
                            <!--begin::Input group-->
                            <!--begin::Input group-->
                            <div class="d-flex flex-wrap gap-5">
                                <!--begin::Input group-->
                                <div class="fv-row w-100 flex-md-root">
                                <!--begin::Label-->
                                <label class="required form-label">Hotel En Name</label>
                                <!--end::Label-->
                                <!--begin::Input-->
                                <input type="text" required name="hotel_enname" class="form-control mb-2" placeholder="Hotel En name"
                                    value="" />


                            </div>
                            <!--end::Input-->

                               <!--begin::Input group-->
                               <div class="fv-row w-100 flex-md-root">
                                <!--begin::Label-->
                                <label class="required form-label">Hotel Ar Name</label>
                                <!--end::Label-->
                                <!--begin::Input-->
                                <input type="text" name="hotel_arname" class="form-control mb-2" placeholder="Hotel Ar name"
                                    value="" />


                            </div>
                            </div>
                            <!--end::Input-->

                            <div class="d-flex flex-wrap gap-5">
                                <!--begin::Input group-->
                                <div class="fv-row w-100 flex-md-root">
                                    <label class="fs-6 fw-bold form-label mt-3">
                                        <option value="">Select Country..</option>
                                        {{-- <i class="fas fa-exclamation-circle ms-1 fs-7" data-bs-toggle="tooltip" title="Interviewer who conducts the meeting with the interviewee"></i> --}}
                                    </label>
                                    <!--end::Label-->
                                    <select required class="form-select form-select-solid dynamic"  data-control="select2"
                                        data-placeholder="Select an option" required data-show-subtext="true" data-live-search="true" id="country" data-dependent="sub">
                                        <option value=""></option>
                                        @foreach ($countries as $country)
                                            <option value="{{ $country->id }}">{{ $country->en_country }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                   <!--begin::Input group-->
                                   <div class="fv-row w-100 flex-md-root">
                                    <label class="fs-6 fw-bold form-label mt-3">
                                        <option value="">Select City..</option>
                                        {{-- <i class="fas fa-exclamation-circle ms-1 fs-7" data-bs-toggle="tooltip" title="Interviewer who conducts the meeting with the interviewee"></i> --}}
                                    </label>
                                    <!--end::Label-->
                                    <select required class="form-select form-select-solid" name="city_id" data-control="select2"
                                        data-placeholder="Select an option" data-show-subtext="true" data-live-search="true" id="sub">
                                        <option value="">select....</option>
                                    </select>
                                </div>
                            </div>




                            <!--begin::Input group-->
                            <div class="d-flex flex-wrap gap-5">
                                <!--begin::Input group-->
                                <div class="fv-row w-100 flex-md-root">
                                <!--begin::Label-->
                                <label class="fs-6 fw-bold form-label mt-3">
                                    <option value="">Select Room Type..</option>
                                    {{-- <i class="fas fa-exclamation-circle ms-1 fs-7" data-bs-toggle="tooltip" title="Interviewer who conducts the meeting with the interviewee"></i> --}}
                                </label>
                                <!--end::Label-->
                                <select required class="form-select form-select-solid" name="hotel_type_id" data-control="select2"
                                    data-placeholder="Select an option">
                                    <option value=""></option>
                                    @foreach ($types as $type)
                                        <option value="{{ $type->id }}">{{ $type->en_room_type }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <!--begin::Input group-->
                            <div class="fv-row w-100 flex-md-root">
        <!--begin::Label-->
        <label class="fs-6 fw-bold form-label mt-3">
            <span class="required">Add Features</span>
            <i class="fas fa-exclamation-circle ms-1 fs-7" data-bs-toggle="tooltip" title="Interviewer who conducts the meeting with the interviewee"></i>
        </label>
        <!--end::Label-->
        <select required class="form-select form-select-solid" name="features[]" data-control="select2" data-placeholder="Select an option" data-allow-clear="true" multiple="multiple">
            <option></option>
            @foreach ($features as $feature)
            <option value="{{$feature->id}}">{{$feature->en_feature}}</option>
            @endforeach

        </select>
    </div>
    <!--end::Input group-->
                            </div>
                            <!--end::Input group-->
<!--begin::Input group-->
<div>
    <!--begin::Label-->
    <label class="form-label">En Overview</label>
    <!--end::Label-->
    <!--begin::Editor-->
    <textarea class="form-control form-control-solid" rows="3" name="hotel_enoverview"
        placeholder="Type Hotel En Overview"></textarea>
    <!--end::Editor-->

</div>
<!--end::Input group-->
<!--begin::Input group-->
<div>
    <!--begin::Label-->
    <label class="form-label">Ar Overview</label>
    <!--end::Label-->
    <!--begin::Editor-->
    <textarea class="form-control form-control-solid" rows="3" name="hotel_aroverview"
        placeholder="Type Hotel Ar Overview"></textarea>
    <!--end::Editor-->

</div>
<!--end::Input group-->

<!--begin::Input group-->
<div>
    <!--begin::Label-->
    <label class="form-label">En Brief</label>
    <!--end::Label-->
    <!--begin::Editor-->
    <textarea class="form-control form-control-solid" rows="3" name="hotel_enbrief"
        placeholder="Type Hotel En Breif"></textarea>
    <!--end::Editor-->

</div>
<!--end::Input group-->
<!--begin::Input group-->
<div>
    <!--begin::Label-->
    <label class="form-label">Ar Breif</label>
    <!--end::Label-->
    <!--begin::Editor-->
    <textarea class="form-control form-control-solid" rows="3" name="hotel_arbrief"
        placeholder="Type Hotel Ar Breif"></textarea>
    <!--end::Editor-->

</div>
<!--end::Input group-->
<!--begin::Input group-->
<div>
    <!--begin::Label-->
    <label class="form-label">En Address</label>
    <!--end::Label-->
    <!--begin::Editor-->
    <textarea class="form-control form-control-solid" rows="3" name="details_enaddress"
        placeholder="Type Hotel En Address"></textarea>
    <!--end::Editor-->

</div>
<!--end::Input group-->
<!--begin::Input group-->
<div>
    <!--begin::Label-->
    <label class="form-label">Ar Address</label>
    <!--end::Label-->
    <!--begin::Editor-->
    <textarea class="form-control form-control-solid" rows="3" name="details_araddress"
        placeholder="Type Hotel Ar Address"></textarea>
    <!--end::Editor-->

</div>
<!--end::Input group-->
<div class="d-flex flex-wrap gap-5">
                            <!--begin::Input group-->
                            <div class="fv-row w-100 flex-md-root">
                                <label class="required form-label">Hotel Stars</label>
                                <!--end::Label-->
                                <!--begin::Input-->
                                <input required type="number" min="1" max="5" name="hotel_stars" class="form-control mb-2"
                                    placeholder="hotel_stars" value="1" />
                                <!--end::Input-->
                            </div>
                            <!--end::Input group-->



                            <div class="fv-row w-100 flex-md-root">
                                <label class=" form-label">Google Map</label>
                                <!--end::Label-->
                                <!--begin::Input-->
                                <input type="text"  name="google_map"
                                    class="form-control mb-2" placeholder="google_map"
                                    value="" />
                                <!--end::Input-->
                            </div>

                        </div>

                        <div class="d-flex flex-wrap gap-5">
                        <div class="fv-row w-100 flex-md-root">
                            <label class=" form-label">Url Vedio</label>
                            <!--end::Label-->
                            <!--begin::Input-->
                            <input type="url"  name="hotel_vedio"
                                class="form-control mb-2" placeholder="hotel_vedio"
                                value="" />
                            <!--end::Input-->
                        </div>


                            <!--begin::checkbox-->

                            <div class="d-flex flex-wrap gap-5 mt-4">
                                <!--begin::Input group-->
                                <div class="fv-row w-100 flex-md-root">
                                    <div class="form-check form-switch form-check-custom form-check-solid">
                                        <input class="form-check-input" type="checkbox" name="active[]" value="1"
                                            id="flexSwitchDefault" />
                                        <label class="form-check-label" for="flexSwitchDefault">
                                            Active
                                        </label>
                                    </div>
                                </div>
                                <!--end::Input group-->

                            </div>
                        </div>
                            <!--end:checkbox-->

                        </div>
                        <!--end::Card header-->
                    </div>
                    <!--end::General options-->


                    <div class="d-flex justify-content-end">
                        <!--begin::Button-->
                        <a href="{{ route('hotels.index') }}" id="kt_ecommerce_add_product_cancel"
                            class="btn btn-light me-5">Cancel</a>
                        <!--end::Button-->
                        <!--begin::Button-->
                        <button type="submit" id="kt_ecommerce_add_category_submit" class="btn btn-primary">
                            <span class="indicator-label">Save Changes</span>
                            <span class="indicator-progress">Please wait...
                                <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                        </button>
                        <!--end::Button-->
                    </div>
                </div>
                <!--end::Main column-->
            </form>
        </div>
        <!--end::Container-->
    </div>
    <!--end::Post-->
@endsection
@section('scripts')
    <script>
        $("#kt_datepicker_1").flatpickr();
        $("#kt_datepicker_2").flatpickr();
        $("#kt_datepicker_8").flatpickr({
            enableTime: true,
            noCalendar: true,
            dateFormat: "H:i",
        });

        $("#kt_datepicker_7").flatpickr({
            enableTime: true,
            noCalendar: true,
            dateFormat: "H:i",
        });


        $(document).ready(function(){

$('.dynamic').change(function(){

 if($(this).val() != '')
 {
  var select = $(this).attr("id");
  var value = $(this).val();

  var _token = $('input[name="_token"]').val();

  $.ajax({
   url:"{{route('dynamicdependentCat.fetch')}}",
   method:"POST",
   data:{select:select, value:value, _token:_token},
   success:function(result)
   {

    $('#sub').html(result);
   }

  })
 }
});




});
    </script>
@endsection
