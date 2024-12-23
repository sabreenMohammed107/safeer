@extends('layout.main')

@section('breadcrumb')
    <div class="toolbar" id="kt_toolbar">
        <div class="container-fluid d-flex flex-stack flex-wrap flex-sm-nowrap">
            <!--begin::Info-->
            <div class="d-flex flex-column align-items-start justify-content-center flex-wrap me-2">
                <!--begin::Title-->
                <h1 class="text-dark fw-bolder my-1 fs-2">Visa</h1>
                <!--end::Title-->
                <!--begin::Breadcrumb-->
                <ul class="breadcrumb fw-bold fs-base my-1">
                    <li class="breadcrumb-item text-muted">
                        <a href="../dist/index.html" class="text-muted text-hover-primary">Home</a>
                    </li>
                    <li class="breadcrumb-item text-muted">Visa</li>

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
            action="{{ route('visa.update', $row->id) }}" method="post" enctype="multipart/form-data">
            @csrf
            @method('PUT')

                <!--begin::Main column-->
                <div class="d-flex flex-column flex-row-fluid gap-7 gap-lg-10">
                    <!--begin:::Tabs-->
                    <ul class="nav nav-custom nav-tabs nav-line-tabs nav-line-tabs-2x border-0 fs-4 fw-bold mb-n2">
                        <!--begin:::Tab item-->
                        <li class="nav-item">
                            <a class="nav-link text-active-primary pb-4 active" data-bs-toggle="tab"
                                href="#kt_ecommerce_add_product_general">General</a>
                        </li>

                    </ul>
                    <!--end:::Tabs-->
                    <div class="tab-content">
                        <!--begin::Tab pane-->
                        <div class="tab-pane fade show active" id="kt_ecommerce_add_product_general" role="tab-panel">
                            <div class="d-flex flex-column gap-7 gap-lg-10">
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


                                        <div class="d-flex flex-wrap gap-5">
                                             <!--begin::Input group-->
                                             <div class="fv-row w-100 flex-md-root">
                                                <label class="fs-6 fw-bold form-label mt-3">
                                                    <option value="">Select Visa Type</option>
                                                    {{-- <i class="fas fa-exclamation-circle ms-1 fs-7" data-bs-toggle="tooltip" title="Interviewer who conducts the meeting with the interviewee"></i> --}}
                                                </label>
                                                <!--end::Label-->
                                                <select required class="form-select form-select-solid "
                                                    data-control="select2" data-placeholder="Select an option" required
                                                    data-show-subtext="true" data-live-search="true" name="visa_type_id" >
                                                    <option value=""></option>
                                                    @foreach ($types as $type)
                                                        <option value="{{ $type->id }}" {{ $row->visa_type_id == $type->id ? 'selected' : '' }} >{{ $type->country->en_country ?? ''}} - {{ $type->en_type }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>


                                            <div class="fv-row w-100 flex-md-root">
                                                <label class="fs-6 fw-bold form-label mt-3">
                                                    <option value="">Select nationality</option>
                                                    {{-- <i class="fas fa-exclamation-circle ms-1 fs-7" data-bs-toggle="tooltip" title="Interviewer who conducts the meeting with the interviewee"></i> --}}
                                                </label>
                                                <!--end::Label-->
                                                <select required class="form-select form-select-solid "
                                                    data-control="select2" data-placeholder="Select an option" required
                                                    data-show-subtext="true" data-live-search="true" name="nationality_id" >
                                                    <option value=""></option>
                                                    @foreach ($nationalities as $nationality)
                                                        <option value="{{ $nationality->id }}" {{ $row->nationality_id == $nationality->id ? 'selected' : '' }} >{{ $nationality->en_nationality }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>









                                        <div class="d-flex flex-wrap gap-5">
                                           <!--begin::Input group-->
                                           <div class="fv-row w-100 flex-md-root">
                                            <label class="required form-label"> Cost</label>
                                            <!--end::Label-->
                                            <!--begin::Input-->
                                            <input required type="number" min="1"
                                                name="cost" class="form-control mb-2"
                                                placeholder="cost" value="{{ $row->cost }}" />
                                            <!--end::Input-->
                                        </div>
                                        <!--end::Input group-->

                                        </div>
                                           <!--begin::Input group-->
                                           <div class="d-flex flex-column mb-8">
                                            <div
                                                class="form-check form-switch form-check-custom form-check-solid">
                                                <input class="form-check-input" type="checkbox"
                                                    name="active[]" value="1"
                                                    id="flexSwitchDefault2"
                                                    {{ $row->active == 1 ? 'checked' : '' }} />
                                                <label class="form-check-label"
                                                    for="flexSwitchDefault2">
                                                    Active
                                                </label>
                                            </div>
                                        </div>
                                        <!--end::Input group-->

 <!--end::Input group-->
 {{-- <div class="d-flex flex-wrap gap-5">
 <div class="fv-row w-100 flex-md-root">
    <label class="fs-6 fw-bold form-label mt-3">
        <option value="">Select Currency Class..</option>
    </label>
    <select  class="form-select form-select-solid"
        name="currency_id" data-control="select2"
        data-placeholder="Select an option">
        <option value=""></option>
        @foreach ($currancies as $currancy)
            <option value="{{ $currancy->id }}" {{ $row->currency_id == $currancy->id ? 'selected' : '' }} >{{ $currancy->currency }}
            </option>
        @endforeach
    </select>
 </div>
 </div> --}}

 <div class="d-flex flex-wrap gap-5">
    <div class="fv-row w-100 flex-md-root">
    <!--begin::Label-->
    <label class="form-label">En notes</label>
    <!--end::Label-->
    <!--begin::Editor-->
    <textarea class="form-control form-control-solid" id="kt_docs_tinymce_basic" rows="3" name="en_notes"
        placeholder="Type Visa En notes">{{ $row->en_notes }}</textarea>
    <!--end::Editor-->

</div>
 </div>
<!--end::Input group-->
<!--begin::Input group-->
<div class="d-flex flex-wrap gap-5">
    <div class="fv-row w-100 flex-md-root">
    <!--begin::Label-->
    <label class="form-label">Ar notes</label>
    <!--end::Label-->
    <!--begin::Editor-->
    <textarea class="form-control form-control-solid" id="kt_docs_tinymce_basic2" rows="3" name="ar_notes"
        placeholder="Type Visa Ar notes">{{ $row->ar_notes }}</textarea>
    <!--end::Editor-->

</div>
 </div>

                                    </div>
                                    <!--end::Card header-->
                                </div>
                                <!--end::General options-->
                                <!--end::General options-->
                            </div>
                        </div>
                        {{-- tab 2  --}}

                        {{-- end tab 2 --}}
                    </div>
                    {{-- end all tabs --}}

                    <div class="d-flex justify-content-end">
                        <!--begin::Button-->
                        <a href="{{ route('visa.index') }}" id="kt_ecommerce_add_product_cancel"
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

     <script src='https://bootstrap-tagsinput.github.io/bootstrap-tagsinput/dist/bootstrap-tagsinput.min.js'></script>

     <script src="{{ asset('dist/assets/plugins/custom/tinymce/tinymce.bundle.js') }}"></script>
     <script>

         tinymce.init({
             selector: '#kt_docs_tinymce_basic',
             menubar: false,

             toolbar: ["styleselect fontselect fontsizeselect",
                 "undo redo | cut copy paste | bold italic | link image | alignleft aligncenter alignright alignjustify",
                 "bullist numlist | outdent indent | blockquote subscript superscript | advlist | autolink | lists charmap | print preview |  code  | forecolor backcolor"
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
