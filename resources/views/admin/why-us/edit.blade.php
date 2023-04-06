@extends('layout.main')

@section('breadcrumb')
    <div class="toolbar" id="kt_toolbar">
        <div class="container-fluid d-flex flex-stack flex-wrap flex-sm-nowrap">
            <!--begin::Info-->
            <div class="d-flex flex-column align-items-start justify-content-center flex-wrap me-2">
                <!--begin::Title-->
                <h1 class="text-dark fw-bolder my-1 fs-2">Why Us</h1>
                <!--end::Title-->
                <!--begin::Breadcrumb-->
                <ul class="breadcrumb fw-bold fs-base my-1">
                    <li class="breadcrumb-item text-muted">
                        <a href="../dist/index.html" class="text-muted text-hover-primary">Home</a>
                    </li>
                    <li class="breadcrumb-item text-muted">Why us</li>

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

                action="{{ route('why-us.update', $row->id) }}" method="post" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <!--begin::Aside column-->
                <div class="d-flex flex-column gap-7 gap-lg-10 w-100 w-lg-300px mb-7 me-lg-10">
                    <!--begin::Thumbnail settings-->
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
                style="background-image: url('{{ asset('uploads/whyUs') }}/{{ $row->icon }}')">
                <div class="image-input-wrapper w-150px h-150px"
                    style="background-image: url(' {{ asset('uploads/whyUs') }}/{{ $row->icon }}')">

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
                                <input type="text" required name="en_title" class="form-control mb-2"
                                    placeholder=" En Title" value="{{ $row->en_title }}" />


                            </div>
                            <!--end::Input-->

                            <!--begin::Input group-->
                            <div class="mb-10 fv-row">
                                <!--begin::Label-->
                                <label class="required form-label"> Ar Title</label>
                                <!--end::Label-->
                                <!--begin::Input-->
                                <input type="text" name="ar_title" class="form-control mb-2" placeholder="Blog Ar title"
                                    value="{{ $row->ar_title }}" />


                            </div>
                            <!--end::Input-->






                            <!--begin::Input group-->
                            <div>
                                <!--begin::Label-->
                                <label class="form-label">En Text</label>
                                <!--end::Label-->
                                <!--begin::Editor-->
                                <textarea class="form-control form-control-solid" rows="3" name="en_text"
                                placeholder="Type  Ar Text">{{ $row->en_text }}</textarea>                                <!--end::Editor-->

                            </div>
                            <!--end::Input group-->
                            <!--begin::Input group-->
                            <div>
                                <!--begin::Label-->
                                <label class="form-label">Ar Text</label>
                                <!--end::Label-->
                                <!--begin::Editor-->
                                <textarea class="form-control form-control-solid" rows="3" name="ar_artext"
                                placeholder="Type  Ar Text">{{ $row->ar_artext }}</textarea>                                <!--end::Editor-->

                            </div>
                            <!--end::Input group-->











                        </div>
                        <!--end::Card header-->
                    </div>
                    <!--end::General options-->


                    <div class="d-flex justify-content-end">
                        <!--begin::Button-->
                        <a href="{{ route('why-us.index') }}" id="kt_ecommerce_add_product_cancel"
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
    <script src="{{ asset('dist/assets/plugins/custom/tinymce/tinymce.bundle.js') }}"></script>
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


        //         var options = {selector: "#kt_docs_tinymce_basic"};

        // if (KTApp.isDarkMode()) {
        //     options["skin"] = "oxide-dark";
        //     options["content_css"] = "dark";
        // }

        // tinymce.init(options);

        // var options2 = {selector: "#kt_docs_tinymce_basic2"};

        // if (KTApp.isDarkMode()) {
        //     options2["skin"] = "oxide-dark";
        //     options2["content_css"] = "dark";
        // }

        // tinymce.init(options2);
        tinymce.init({
            selector: '#kt_docs_tinymce_basic',
            menubar: false,

            toolbar: ["styleselect fontselect fontsizeselect",
                "undo redo | cut copy paste | bold italic | link image | alignleft aligncenter alignright alignjustify",
                "bullist numlist | outdent indent | blockquote subscript superscript | advlist | autolink | lists charmap | print preview |  code"
            ],
            plugins: "advlist autolink link image lists charmap print preview code"
        });
        tinymce.init({
            selector: '#kt_docs_tinymce_basic2',
            menubar: false,
            toolbar: ["styleselect fontselect fontsizeselect",
                "undo redo | cut copy paste | bold italic | link image | alignleft aligncenter alignright alignjustify",
                "bullist numlist | outdent indent | blockquote subscript superscript | advlist | autolink | lists charmap | print preview |  code"
            ],
            plugins: "advlist autolink link image lists charmap print preview code"
        });
    </script>
@endsection
