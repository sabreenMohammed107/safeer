@extends('layout.main')

@section('breadcrumb')
    <div class="toolbar" id="kt_toolbar">
        <div class="container-fluid d-flex flex-stack flex-wrap flex-sm-nowrap">
            <!--begin::Info-->
            <div class="d-flex flex-column align-items-start justify-content-center flex-wrap me-2">
                <!--begin::Title-->
                <h1 class="text-dark fw-bolder my-1 fs-2">Offers</h1>
                <!--end::Title-->
                <!--begin::Breadcrumb-->
                <ul class="breadcrumb fw-bold fs-base my-1">
                    <li class="breadcrumb-item text-muted">
                        <a href="../dist/index.html" class="text-muted text-hover-primary">Home</a>
                    </li>
                    <li class="breadcrumb-item text-muted">Offers</li>

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
            action="{{ route('offers.update', $offer->id) }}" method="post" enctype="multipart/form-data">
            @csrf
            @method('PUT')
 <!--begin::Aside column-->
 <div class="d-flex flex-column gap-7 gap-lg-10 w-100 w-lg-300px mb-7 me-lg-10">
     <!--begin::Thumbnail settings-->
     <div class="card card-flush py-4">
        <!--begin::Card header-->
        <div class="card-header">
            <!--begin::Card title-->
            <div class="card-title">
                <h2> Edit Thumbnail</h2>
            </div>
            <!--end::Card title-->
        </div>
        <!--end::Card header-->
        <!--begin::Image input wrapper-->
        <div class="card-body text-center pt-0">
            <!--begin::Image input-->
            <div class="image-input image-input-empty image-input-outline mb-3" data-kt-image-input="true"
                style="background-image: url('{{ asset('uploads/offers') }}/{{ $offer->image }}')">
                <div class="image-input-wrapper w-150px h-150px"
                    style="background-image: url(' {{ asset('uploads/offers') }}/{{ $offer->image }}')">

                </div>
                <!--end::Preview existing avatar-->
                <!--begin::Edit-->
                <label class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow"
                    data-kt-image-input-action="change" data-bs-toggle="tooltip" title="Change avatar">
                    <i class="bi bi-pencil-fill fs-7"></i>
                    <!--begin::Inputs-->
                    <input type="file" name="image" accept=".png, .jpg, .jpeg" />
                    <input type="hidden" name="avatar_remove" />
                    <!--end::Inputs-->
                </label>
                <!--end::Edit-->

            </div>
            <!--end::Image input-->
        </div>
        <!--end::Image input wrapper-->
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
                            <div class="mb-10 fv-row">
                                <!--begin::Label-->
                                <label class="required form-label"> En Title</label>
                                <!--end::Label-->
                                <!--begin::Input-->
                                <input type="text" value="{{$offer->subtitle_en}}" required name="subtitle_en" class="form-control mb-2" placeholder=" En Title"
                                    value="" />


                            </div>
                            <!--end::Input-->

                               <!--begin::Input group-->
                               <div class="mb-10 fv-row">
                                <!--begin::Label-->
                                <label class="required form-label"> Ar Title</label>
                                <!--end::Label-->
                                <!--begin::Input-->
                                <input type="text" value="{{$offer->subtitle_ar}}" name="subtitle_ar" class="form-control mb-2" placeholder=" Ar title"
                                    value="" />


                            </div>
                            <!--end::Input-->

                            <div>
                                <label class="fs-6 fw-bold form-label mt-3">
                                    <option value="">Select a City...</option>

                                </label>

                                <select name="city_id" required aria-label="Select a City"
                                    data-control="select2"
                                    data-placeholder="Select a Country..."
                                    data-dropdown-parent="#kt_modal_new_targetEdit{{ $offer->id }}"
                                    class="form-select form-select-solid fw-bolder">
                                    <option value=""></option>
                                    @foreach ($cities as $city)
                                        <option value="{{ $city->id }}"
                                            {{ $offer->city_id == $city->id ? 'selected' : '' }}>
                                            {{ $city->en_city }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <!--end::Input group-->
       <!--begin::Input group-->
       <div class="mb-10 fv-row">
        <!--begin::Label-->
        <label class="required form-label"> Cost</label>
        <!--end::Label-->
        <!--begin::Input-->
        <input type="text" name="cost" class="form-control mb-2" placeholder=" cost"
            value="{{$offer->cost}}" />


    </div>
    <!--end::Input-->



<!--begin::Input group-->
<div>
    <!--begin::Label-->
    <label class="form-label">En Text</label>
    <!--end::Label-->
    <!--begin::Editor-->
    <textarea class="form-select form-select-solid" id="kt_docs_tinymce_basic"  name="offer_enoverview"
        >{!! $offer->offer_enoverview !!}</textarea>
    <!--end::Editor-->

</div>
<!--end::Input group-->
<!--begin::Input group-->
<div>
    <!--begin::Label-->
    <label class="form-label">Ar Text</label>
    <!--end::Label-->
    <!--begin::Editor-->
    <textarea class="tox-target" id="kt_docs_tinymce_basic2"  name="offer_aroverview"
        >{!! $offer->offer_aroverview !!}</textarea>
    <!--end::Editor-->

</div>
<!--end::Input group-->









                            <!--begin::checkbox-->

                            <div class="d-flex flex-wrap gap-5 mt-4">
                                <!--begin::Input group-->
                                <div class="fv-row w-100 flex-md-root">
                                    <div class="form-check form-switch form-check-custom form-check-solid">
                                        <input class="form-check-input" type="checkbox" name="active[]" value="1"
                                            id="flexSwitchDefault" {{ $offer->active == 1 ? ' checked' : '' }} />
                                        <label class="form-check-label" for="flexSwitchDefault">
                                            Active
                                        </label>
                                    </div>
                                </div>
                                <!--end::Input group-->

                            </div>
                            <!--end:checkbox-->
                            <div class="d-flex flex-wrap gap-5 mt-4">
                                <!--begin::Input group-->
                                <div class="fv-row w-100 flex-md-root">
                                    <div class="form-check form-switch form-check-custom form-check-solid">
                                        <input class="form-check-input" type="checkbox" name="status[]" value="main"
                                            id="flexSwitchDefault" {{ $offer->status == 'main' ? ' checked' : '' }} />
                                        <label class="form-check-label" for="flexSwitchDefault">
                                            main
                                        </label>
                                    </div>
                                </div>
                                <!--end::Input group-->

                            </div>
                            <!--end:checkbox-->
                        </div>
                        <!--end::Card header-->
                    </div>
                    <!--end::General options-->


                    <div class="d-flex justify-content-end">
                        <!--begin::Button-->
                        <a href="{{ route('offers.index') }}" id="kt_ecommerce_add_product_cancel"
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
<script src="{{asset('dist/assets/plugins/custom/tinymce/tinymce.bundle.js')}}"></script>
    <script>

tinymce.init({
    selector: '#kt_docs_tinymce_basic',
    menubar: false,

    toolbar: ["styleselect fontselect fontsizeselect",
                "undo redo | cut copy paste | bold italic | link image | alignleft aligncenter alignright alignjustify",
                "bullist numlist | outdent indent | blockquote subscript superscript | advlist | autolink | lists charmap | print preview |  code forecolor | backcolor"
            ],
            plugins: "advlist autolink link image lists charmap print preview code textcolor colorpicker",
            color_picker_callback: function(callback, value) {
    callback('#FF00FF');
  }
});
tinymce.init({
    selector: '#kt_docs_tinymce_basic2',
    menubar: false,
    toolbar: ["styleselect fontselect fontsizeselect",
                "undo redo | cut copy paste | bold italic | link image | alignleft aligncenter alignright alignjustify",
                "bullist numlist | outdent indent | blockquote subscript superscript | advlist | autolink | lists charmap | print preview |  code forecolor | backcolor"
            ],
            plugins: "advlist autolink link image lists charmap print preview code textcolor colorpicker",
            color_picker_callback: function(callback, value) {
    callback('#FF00FF');
  }
});
    </script>
@endsection
