@extends('layout.main')

@section('breadcrumb')
    <div class="toolbar" id="kt_toolbar">
        <div class="container-fluid d-flex flex-stack flex-wrap flex-sm-nowrap">
            <!--begin::Info-->
            <div class="d-flex flex-column align-items-start justify-content-center flex-wrap me-2">
                <!--begin::Title-->
                <h1 class="text-dark fw-bolder my-1 fs-2">Company</h1>
                <!--end::Title-->
                <!--begin::Breadcrumb-->
                <ul class="breadcrumb fw-bold fs-base my-1">
                    <li class="breadcrumb-item text-muted">
                        <a href="../dist/index.html" class="text-muted text-hover-primary">Home</a>
                    </li>
                    <li class="breadcrumb-item text-muted">Company</li>

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
                action="{{ route('company.update', $company->id) }}" method="post" enctype="multipart/form-data">
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
                                style="background-image: url('{{ asset('uploads/company') }}/{{ $company->image }}')">
                                <div class="image-input-wrapper w-150px h-150px"
                                    style="background-image: url(' {{ asset('uploads/company') }}/{{ $company->image }}')">

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
                    <ul class="nav nav-custom nav-tabs nav-line-tabs nav-line-tabs-2x border-0 fs-4 fw-bold mb-n2">
                        <!--begin:::Tab item-->
                        <li class="nav-item">
                            <a class="nav-link text-active-primary pb-4 active" data-bs-toggle="tab"
                                href="#kt_ecommerce_add_product_general">About Us</a>
                        </li>
                        <!--end:::Tab item-->
                        <!--begin:::Tab item-->
                        <li class="nav-item">
                            <a class="nav-link text-active-primary pb-4" data-bs-toggle="tab"
                                href="#kt_ecommerce_add_product_advanced">Home Banner</a>
                        </li>
                        <!--end:::Tab item-->

                        <!--begin:::Tab item-->
                        <li class="nav-item">
                            <a class="nav-link text-active-primary pb-4" data-bs-toggle="tab"
                                href="#kt_ecommerce_add_fixed_advanced">Home Sections</a>
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
                                            <h2>About Us</h2>
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
                                                <label class="required form-label"> En Title</label>
                                                <!--end::Label-->
                                                <!--begin::Input-->
                                                <input type="text" required name="overview_entitle"
                                                    class="form-control mb-2" placeholder=" En Title"
                                                    value="{{ $company->overview_entitle }}" />


                                            </div>
                                            <!--end::Input-->

                                            <!--begin::Input group-->
                                            <div class="fv-row w-100 flex-md-root">
                                                <!--begin::Label-->
                                                <label class="required form-label"> Ar Title</label>
                                                <!--end::Label-->
                                                <!--begin::Input-->
                                                <input type="text" name="overview_artitle" class="form-control mb-2"
                                                    placeholder=" Ar title" value="{{ $company->overview_artitle }}" />


                                            </div>
                                        </div>
                                        <!--end::Input-->

                                        <!--begin::Input group-->
                                        <div class="d-flex flex-wrap gap-5">
                                            <!--begin::Input group-->
                                            <div class="fv-row w-100 flex-md-root">
                                                <!--begin::Label-->
                                                <label class="required form-label"> En Sub Title</label>
                                                <!--end::Label-->
                                                <!--begin::Input-->
                                                <input type="text" required name="overview_ensubtitle"
                                                    class="form-control mb-2" placeholder=" En Sub Title"
                                                    value="{{ $company->overview_ensubtitle }}" />


                                            </div>
                                            <!--end::Input-->

                                            <!--begin::Input group-->
                                            <div class="fv-row w-100 flex-md-root">
                                                <!--begin::Label-->
                                                <label class="required form-label"> Ar Sub Title</label>
                                                <!--end::Label-->
                                                <!--begin::Input-->
                                                <input type="text" name="overview_arsubtitle" class="form-control mb-2"
                                                    placeholder=" Ar Sub title"
                                                    value="{{ $company->overview_arsubtitle }}" />


                                            </div>
                                        </div>
                                        <!--end::Input-->


{{-- login --}}
 <!--begin::Input group-->
 <div class="d-flex flex-wrap gap-5">
    <!--begin::Input group-->
    <div class="fv-row w-100 flex-md-root">
        <!--begin::Label-->
        <label class="required form-label">Login En  Title</label>
        <!--end::Label-->
        <!--begin::Input-->
        <input type="text" required name="login_en_title"
            class="form-control mb-2" placeholder=" En  Title"
            value="{{ $company->login_en_title }}" />


    </div>
    <!--end::Input-->

    <!--begin::Input group-->
    <div class="fv-row w-100 flex-md-root">
        <!--begin::Label-->
        <label class="required form-label">Login Ar  Title</label>
        <!--end::Label-->
        <!--begin::Input-->
        <input type="text" name="login_ar_title" class="form-control mb-2"
            placeholder=" Ar  title"
            value="{{ $company->login_ar_title }}" />


    </div>
</div>
<!--end::Input-->
 <!--begin::Input group-->
 <div class="d-flex flex-wrap gap-5">
    <!--begin::Input group-->
    <div class="fv-row w-100 flex-md-root">
        <!--begin::Label-->
        <label class="required form-label">Login En Sub Title</label>
        <!--end::Label-->
        <!--begin::Input-->
        <input type="text" required name="login_en_sub_title"
            class="form-control mb-2" placeholder=" En Sub Title"
            value="{{ $company->login_en_sub_title }}" />


    </div>
    <!--end::Input-->

    <!--begin::Input group-->
    <div class="fv-row w-100 flex-md-root">
        <!--begin::Label-->
        <label class="required form-label"> Login Ar Sub Title</label>
        <!--end::Label-->
        <!--begin::Input-->
        <input type="text" name="login_ar_sub_title" class="form-control mb-2"
            placeholder=" Ar Sub title"
            value="{{ $company->login_ar_sub_title }}" />


    </div>
</div>
<!--end::Input-->

{{-- endlogin --}}


                                        <!--begin::Input group-->
                                        <div class="d-flex flex-wrap gap-5">
                                            <!--begin::Input group-->
                                            <div class="fv-row w-100 flex-md-root">
                                                <!--begin::Label-->
                                                <label class="form-label">En Overview Text</label>
                                                <!--end::Label-->
                                                <!--begin::Editor-->
                                                <textarea class="form-select form-select-solid" id="kt_docs_tinymce_basic" name="overview_en">{{ $company->overview_en }}</textarea>
                                                <!--end::Editor-->

                                            </div>
                                            <!--end::Input group-->
                                            <!--begin::Input group-->
                                            <div class="fv-row w-100 flex-md-root">
                                                <!--begin::Label-->
                                                <label class="form-label">Ar Overview Text</label>
                                                <!--end::Label-->
                                                <!--begin::Editor-->
                                                <textarea class="form-select form-select-solid" id="kt_docs_tinymce_basic2" name="overview_ar">{{ $company->overview_ar }}</textarea>
                                                <!--end::Editor-->

                                            </div>
                                            <!--end::Input group-->

                                        </div>


                                        <!--begin::Input group-->
                                        <div class="d-flex flex-wrap gap-5">
                                            <!--begin::Input group-->
                                            <div class="fv-row w-100 flex-md-root">
                                                <!--begin::Label-->
                                                <label class="form-label">En Mission Text</label>
                                                <!--end::Label-->
                                                <!--begin::Editor-->
                                                <textarea class="form-select form-select-solid" id="kt_docs_tinymce_basic" name="mission_en">{{ $company->mission_en }}</textarea>
                                                <!--end::Editor-->

                                            </div>
                                            <!--end::Input group-->
                                            <!--begin::Input group-->
                                            <div class="fv-row w-100 flex-md-root">
                                                <!--begin::Label-->
                                                <label class="form-label">Ar Mission Text</label>
                                                <!--end::Label-->
                                                <!--begin::Editor-->
                                                <textarea class="form-select form-select-solid" id="kt_docs_tinymce_basic2" name="mission_ar">{{ $company->mission_ar }}</textarea>
                                                <!--end::Editor-->

                                            </div>
                                            <!--end::Input group-->

                                        </div>


                                        <!--begin::Input group-->
                                        <div class="d-flex flex-wrap gap-5">
                                            <!--begin::Input group-->
                                            <div class="fv-row w-100 flex-md-root">
                                                <!--begin::Label-->
                                                <label class="form-label">En vision Text</label>
                                                <!--end::Label-->
                                                <!--begin::Editor-->
                                                <textarea class="form-select form-select-solid" id="kt_docs_tinymce_basic" name="vision_en">{{ $company->vision_en }}</textarea>
                                                <!--end::Editor-->

                                            </div>
                                            <!--end::Input group-->
                                            <!--begin::Input group-->
                                            <div class="fv-row w-100 flex-md-root">
                                                <!--begin::Label-->
                                                <label class="form-label">Ar vision Text</label>
                                                <!--end::Label-->
                                                <!--begin::Editor-->
                                                <textarea class="form-select form-select-solid" id="kt_docs_tinymce_basic2" name="vision_ar">{{ $company->vision_ar }}</textarea>
                                                <!--end::Editor-->

                                            </div>
                                            <!--end::Input group-->

                                        </div>
                                        <!--begin::Social options-->
                                        <div class="card card-flush py-4">
                                            <!--begin::Card header-->
                                            <div class="card-header">
                                                <div class="card-title">
                                                    <h2>Social links</h2>
                                                </div>
                                                <!--begin::Row-->

                                                <div class="row row-cols-1 row-cols-md-3 row-cols-lg-1 row-cols-xl-3 g-9"
                                                    data-kt-buttons="true"
                                                    data-kt-buttons-target="[data-kt-button='true']">


                                                    <!--begin::Col-->
                                                    <div class="col">
                                                        <!--begin::Option-->
                                                        <!--begin::Label-->
                                                        <label class="form-label">Youtube Account</label>
                                                        <!--end::Label-->
                                                        <!--begin::Input-->
                                                        <input type="text" class="form-control mb-2" name="youtube"
                                                            placeholder="Youtube Account"
                                                            value="{{ $company->youtube }}" />
                                                        <!--end::Input-->
                                                        <!--end::Option-->
                                                    </div>

                                                    <!--begin::Tax-->
                                                    <div class="col">
                                                        <!--begin::Input group-->
                                                        <div class="fv-row w-100 flex-md-root">
                                                            <label class=" form-label">Instagram</label>
                                                            <!--end::Label-->
                                                            <!--begin::Input-->
                                                            <input type="text" name="instagram"
                                                                class="form-control mb-2" placeholder="instagram"
                                                                value="{{ $company->instagram }}" />
                                                            <!--end::Input-->
                                                        </div>
                                                    </div>
                                                    <!--end::Input group-->
                                                    <!--begin::Input group-->
                                                    <div class="col">
                                                        <div class="fv-row w-100 flex-md-root">
                                                            <!--begin::Label-->
                                                            <label class=" form-label">Fb Account</label>
                                                            <!--end::Label-->
                                                            <!--begin::Input-->
                                                            <input type="text" name="facebook"
                                                                class="form-control mb-2" placeholder="facebook"
                                                                value="{{ $company->facebook }}" />
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
   <!--begin::Input group-->
   <div class="d-flex flex-wrap gap-5">
    <!--begin::Input group-->
    <div class="fv-row w-100 flex-md-root">
        <!--begin::Label-->
        <label class="required form-label"> chat whatsapp</label>
        <!--end::Label-->
        <!--begin::Input-->
        <input type="text" required name="chat_whatsapp"
            class="form-control mb-2" placeholder=" chat whatsapp"
            value="{{ $company->chat_whatsapp}}" />


    </div>
    <!--end::Input-->


</div>
<!--end::Input-->


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
                                            <h2>Home Banner</h2>
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
                                                <label class="required form-label"> Banner En Title</label>
                                                <!--end::Label-->
                                                <!--begin::Input-->
                                                <input type="text" required name="master_page_entitle"
                                                    class="form-control mb-2" placeholder=" En Title"
                                                    value="{{ $company->master_page_entitle }}" />


                                            </div>
                                            <!--end::Input-->

                                            <!--begin::Input group-->
                                            <div class="fv-row w-100 flex-md-root">
                                                <!--begin::Label-->
                                                <label class="required form-label">Banner Ar Title</label>
                                                <!--end::Label-->
                                                <!--begin::Input-->
                                                <input type="text" name="master_page_artitle"
                                                    class="form-control mb-2" placeholder=" Ar title"
                                                    value="{{ $company->master_page_artitle }}" />


                                            </div>
                                        </div>
                                        <!--end::Input-->

                                        <!--begin::Input group-->
                                        <div class="d-flex flex-wrap gap-5">
                                            <!--begin::Input group-->
                                            <div class="fv-row w-100 flex-md-root">
                                                <!--begin::Label-->
                                                <label class="required form-label">Banner En Sub Title</label>
                                                <!--end::Label-->
                                                <!--begin::Input-->
                                                <input type="text" required name="master_page_ensubtitle"
                                                    class="form-control mb-2" placeholder=" En Sub Title"
                                                    value="{{ $company->master_page_ensubtitle }}" />


                                            </div>
                                            <!--end::Input-->

                                            <!--begin::Input group-->
                                            <div class="fv-row w-100 flex-md-root">
                                                <!--begin::Label-->
                                                <label class="required form-label">Banner Ar Sub Title</label>
                                                <!--end::Label-->
                                                <!--begin::Input-->
                                                <input type="text" name="master_page_arsubtitle"
                                                    class="form-control mb-2" placeholder=" Ar Sub title"
                                                    value="{{ $company->master_page_arsubtitle }}" />


                                            </div>
                                        </div>
                                        <!--end::Input-->





                                        <!--begin::Input group-->
                                        <div class="d-flex flex-wrap gap-5">
                                            <!--begin::Input group-->
                                            <div class="fv-row w-100 flex-md-root">
                                                <!--begin::Label-->
                                                <label class="form-label">Banner En Text</label>
                                                <!--end::Label-->
                                                <!--begin::Editor-->
                                                <textarea class="form-select form-select-solid" id="kt_docs_tinymce_basic" name="master_page_entext">{{ $company->master_page_entext }}</textarea>
                                                <!--end::Editor-->

                                            </div>
                                            <!--end::Input group-->
                                            <!--begin::Input group-->
                                            <div class="fv-row w-100 flex-md-root">
                                                <!--begin::Label-->
                                                <label class="form-label">Banner Ar Text</label>
                                                <!--end::Label-->
                                                <!--begin::Editor-->
                                                <textarea class="form-select form-select-solid" id="kt_docs_tinymce_basic2" name="master_page_artext">{{ $company->master_page_artext }}</textarea>
                                                <!--end::Editor-->

                                            </div>
                                            <!--end::Input group-->

                                        </div>
                                        <!--begin::Input group-->
                                        <div class="d-flex flex-wrap gap-5 mt-4">
                                            <!--begin::Input group-->
                                            <div class="fv-row w-100 flex-md-root">
                                                <div class="image-input image-input-empty image-input-outline mb-3"
                                                    data-kt-image-input="true"
                                                    style="background-image: url('{{ asset('uploads/company') }}/{{ $company->master_page_img_bg }}')">
                                                    <div class="image-input-wrapper w-150px h-150px"
                                                        style="background-image: url(' {{ asset('uploads/company') }}/{{ $company->master_page_img_bg }}')">

                                                    </div>
                                                    <!--end::Preview existing avatar-->
                                                    <!--begin::Edit-->
                                                    <label
                                                        class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow"
                                                        data-kt-image-input-action="change" data-bs-toggle="tooltip"
                                                        title="Change avatar">
                                                        <i class="bi bi-pencil-fill fs-7"></i>
                                                        <!--begin::Inputs-->
                                                        <input type="file" name="master_page_img_bg"
                                                            accept=".png, .jpg, .jpeg" />
                                                        <input type="hidden" name="avatar_remove" />
                                                        <!--end::Inputs-->
                                                    </label>
                                                    <!--end::Edit-->

                                                </div>
                                            </div>
                                        </div>
                                        <!--end::Image input-->




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
                                            <h2>Home Sections</h2>
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
                                                <label class="form-label">Limit Offer Endesc</label>
                                                <!--end::Label-->
                                                <!--begin::Editor-->
                                                <textarea class="form-select form-select-solid" id="kt_docs_tinymce_basic" name="limit_offer_endesc">{{ $company->limit_offer_endesc }}</textarea>
                                                <!--end::Editor-->

                                            </div>
                                            <!--end::Input group-->
                                            <!--begin::Input group-->
                                            <div class="fv-row w-100 flex-md-root">
                                                <!--begin::Label-->
                                                <label class="form-label">Limit Offer Ardesc</label>
                                                <!--end::Label-->
                                                <!--begin::Editor-->
                                                <textarea class="form-select form-select-solid" id="kt_docs_tinymce_basic2" name="limit_offer_ardesc">{{ $company->limit_offer_ardesc }}</textarea>
                                                <!--end::Editor-->

                                            </div>
                                            <!--end::Input group-->

                                        </div>


                                        <!--begin::Input group-->
                                        <div class="d-flex flex-wrap gap-5">
                                            <!--begin::Input group-->
                                            <div class="fv-row w-100 flex-md-root">
                                                <!--begin::Label-->
                                                <label class="form-label">Best Hotels En Desc</label>
                                                <!--end::Label-->
                                                <!--begin::Editor-->
                                                <textarea class="form-select form-select-solid" id="kt_docs_tinymce_basic" name="best_hotels_en_desc">{{ $company->best_hotels_en_desc }}</textarea>
                                                <!--end::Editor-->

                                            </div>
                                            <!--end::Input group-->
                                            <!--begin::Input group-->
                                            <div class="fv-row w-100 flex-md-root">
                                                <!--begin::Label-->
                                                <label class="form-label">Best Hotels Ar Desc</label>
                                                <!--end::Label-->
                                                <!--begin::Editor-->
                                                <textarea class="form-select form-select-solid" id="kt_docs_tinymce_basic2" name="best_hotels_ar_desc">{{ $company->best_hotels_ar_desc }}</textarea>
                                                <!--end::Editor-->

                                            </div>
                                            <!--end::Input group-->

                                        </div>

                                        <!--begin::Input group-->
                                        <div class="d-flex flex-wrap gap-5">
                                            <!--begin::Input group-->
                                            <div class="fv-row w-100 flex-md-root">
                                                <!--begin::Label-->
                                                <label class="form-label">Book Tour En Desc</label>
                                                <!--end::Label-->
                                                <!--begin::Editor-->
                                                <textarea class="form-select form-select-solid" id="kt_docs_tinymce_basic" name="book_tour_en_desc">{{ $company->book_tour_en_desc }}</textarea>
                                                <!--end::Editor-->

                                            </div>
                                            <!--end::Input group-->
                                            <!--begin::Input group-->
                                            <div class="fv-row w-100 flex-md-root">
                                                <!--begin::Label-->
                                                <label class="form-label">Book Tour Ar Desc</label>
                                                <!--end::Label-->
                                                <!--begin::Editor-->
                                                <textarea class="form-select form-select-solid" id="kt_docs_tinymce_basic2" name="book_tour_ar_desc">{{ $company->book_tour_ar_desc }}</textarea>
                                                <!--end::Editor-->

                                            </div>
                                            <!--end::Input group-->

                                        </div>
                                        <!--begin::Input group-->
                                        <div class="d-flex flex-wrap gap-5 mt-4">
                                            <!--begin::Input group-->
                                            <div class="fv-row w-100 flex-md-root">
                                                <!--begin::Label-->
                                                <label class="required form-label"> Book Tour En Title</label>
                                                <!--end::Label-->
                                                <!--begin::Input-->
                                                <input type="text" required name="book_tour_en_title"
                                                    class="form-control mb-2" placeholder=" En Title"
                                                    value="{{ $company->book_tour_en_title }}" />


                                            </div>
                                            <!--end::Input-->

                                            <!--begin::Input group-->
                                            <div class="fv-row w-100 flex-md-root">
                                                <!--begin::Label-->
                                                <label class="required form-label">Book Tour Ar Title</label>
                                                <!--end::Label-->
                                                <!--begin::Input-->
                                                <input type="text" name="book_tour_ar_title" class="form-control mb-2"
                                                    placeholder=" Ar title" value="{{ $company->book_tour_ar_title }}" />


                                            </div>
                                        </div>


                                        {{-- ABOUT NEW --}}
                                         <!--begin::Input group-->
                                         <div class="d-flex flex-wrap gap-5">
                                            <!--begin::Input group-->
                                            <div class="fv-row w-100 flex-md-root">
                                                <!--begin::Label-->
                                                <label class="form-label">Why Us En Desc</label>
                                                <!--end::Label-->
                                                <!--begin::Editor-->
                                                <textarea class="form-select form-select-solid" id="kt_docs_tinymce_basic" name="why_us_entext">{{ $company->why_us_entext }}</textarea>
                                                <!--end::Editor-->

                                            </div>
                                            <!--end::Input group-->
                                            <!--begin::Input group-->
                                            <div class="fv-row w-100 flex-md-root">
                                                <!--begin::Label-->
                                                <label class="form-label">Why Us Ar Desc</label>
                                                <!--end::Label-->
                                                <!--begin::Editor-->
                                                <textarea class="form-select form-select-solid" id="kt_docs_tinymce_basic2" name="why_us_artext">{{ $company->why_us_artext }}</textarea>
                                                <!--end::Editor-->

                                            </div>
                                            <!--end::Input group-->

                                        </div>
                                        <!--begin::Input group-->
                                        <div class="d-flex flex-wrap gap-5 mt-4">
                                            <!--begin::Input group-->
                                            <div class="fv-row w-100 flex-md-root">
                                                <!--begin::Label-->
                                                <label class="required form-label"> Why Us En Title</label>
                                                <!--end::Label-->
                                                <!--begin::Input-->
                                                <input type="text" required name="why_us_entitle"
                                                    class="form-control mb-2" placeholder=" En Title"
                                                    value="{{ $company->why_us_entitle }}" />


                                            </div>
                                            <!--end::Input-->

                                            <!--begin::Input group-->
                                            <div class="fv-row w-100 flex-md-root">
                                                <!--begin::Label-->
                                                <label class="required form-label">Why Us Ar Title</label>
                                                <!--end::Label-->
                                                <!--begin::Input-->
                                                <input type="text" name="why_us_artitle" class="form-control mb-2"
                                                    placeholder=" Ar title" value="{{ $company->why_us_artitle }}" />


                                            </div>
                                        </div>
                                        {{-- END ABOUT --}}
                                        {{-- visa data --}}
                                         <!--begin::Input group-->
                                         <div class="d-flex flex-wrap gap-5 mt-4">
                                            <!--begin::Input group-->
                                            <div class="fv-row w-100 flex-md-root">
                                                <!--begin::Label-->
                                                <label class="required form-label"> Visa video En Title</label>
                                                <!--end::Label-->
                                                <!--begin::Input-->
                                                <input type="text" required name="visa_en_title"
                                                    class="form-control mb-2" placeholder=" En Title"
                                                    value="{{ $company->visa_en_title }}" />


                                            </div>
                                            <!--end::Input-->

                                            <!--begin::Input group-->
                                            <div class="fv-row w-100 flex-md-root">
                                                <!--begin::Label-->
                                                <label class="required form-label">Visa video Ar Title</label>
                                                <!--end::Label-->
                                                <!--begin::Input-->
                                                <input type="text" name="visa_ar_title" class="form-control mb-2"
                                                    placeholder=" Ar title" value="{{ $company->visa_ar_title }}" />


                                            </div>
                                        </div>
                                         <!--begin::Input group-->
                                         <div class="d-flex flex-wrap gap-5">
                                            <!--begin::Input group-->
                                            <div class="fv-row w-100 flex-md-root">
                                                <!--begin::Label-->
                                                <label class="form-label">Visa video En Desc</label>
                                                <!--end::Label-->
                                                <!--begin::Editor-->
                                                <textarea class="form-select form-select-solid" id="kt_docs_tinymce_basic" name="visa_en_text">{{ $company->visa_en_text }}</textarea>
                                                <!--end::Editor-->

                                            </div>
                                            <!--end::Input group-->
                                            <!--begin::Input group-->
                                            <div class="fv-row w-100 flex-md-root">
                                                <!--begin::Label-->
                                                <label class="form-label">Visa video Ar Desc</label>
                                                <!--end::Label-->
                                                <!--begin::Editor-->
                                                <textarea class="form-select form-select-solid" id="kt_docs_tinymce_basic2" name="visa_ar_text">{{ $company->visa_ar_text }}</textarea>
                                                <!--end::Editor-->

                                            </div>
                                            <!--end::Input group-->

                                        </div>
                                        <div class="d-flex flex-wrap gap-5">
                                            <!--begin::Input group-->
                                            <div class="fv-row w-100 flex-md-root">
                                                <!--begin::Label-->
                                                <label class="required form-label"> Visa video (embed youtube)</label>
                                                <!--end::Label-->
                                                <!--begin::Input-->
                                                <input type="text" required name="visa_vedio"
                                                    class="form-control mb-2" placeholder="  Visa video embed youtube"
                                                    value="{{ $company->visa_vedio }}" />


                                            </div>
                                            <!--end::Input-->
                                        </div>
                                        {{-- end visa data --}}
                                        <div class="d-flex flex-wrap gap-5">
                                            <!--begin::Input group-->
                                            <div class="fv-row w-100 flex-md-root">
                                                <!--begin::Label-->
                                                <label class="required form-label"> Book Tour Vedio</label>
                                                <!--end::Label-->
                                                <!--begin::Input-->
                                                <input type="text" required name="book_tour_vedio"
                                                    class="form-control mb-2" placeholder=" En Title"
                                                    value="{{ $company->book_tour_vedio }}" />


                                            </div>
                                            <!--end::Input-->
                                        </div>
                                        <div class="d-flex flex-wrap gap-5">
                                            <!--begin::Input group-->
                                            <div class="fv-row w-100 flex-md-root">
                                                <!--begin::Label-->
                                                <label for="book_img" class="btn btn-danger"> Book image  </label>
                                                <!--end::Label-->
                                                <!--begin::Input-->
                                                {{ $company->book_img }}
                                                <input type="file" id="book_img" style="visibility: hidden" name="book_img"
                                                    class="form-control mb-2" placeholder=""
                                                    value="{{ $company->book_img }}" />


                                            </div>
                                            <!--end::Input-->
                                        </div>
                                        <!--end::Input-->

                                        <!--begin::Input group-->


                                        <!--begin::Input group-->
                                        <div class="d-flex flex-wrap gap-5">
                                            <!--begin::Input group-->
                                            <div class="fv-row w-100 flex-md-root">
                                                <!--begin::Label-->
                                                <label class="form-label">Book Transport En Desc</label>
                                                <!--end::Label-->
                                                <!--begin::Editor-->
                                                <textarea class="form-select form-select-solid" id="kt_docs_tinymce_basic" name="book_transport_en_desc">{{ $company->book_transport_en_desc }}</textarea>
                                                <!--end::Editor-->

                                            </div>
                                            <!--end::Input group-->
                                            <!--begin::Input group-->
                                            <div class="fv-row w-100 flex-md-root">
                                                <!--begin::Label-->
                                                <label class="form-label">Book Transport Ar Desc</label>
                                                <!--end::Label-->
                                                <!--begin::Editor-->
                                                <textarea class="form-select form-select-solid" id="kt_docs_tinymce_basic2" name="book_transport_ar_desc">{{ $company->book_transport_ar_desc }}</textarea>
                                                <!--end::Editor-->

                                            </div>
                                            <!--end::Input group-->

                                        </div>
                                        <!--begin::Input group-->
                                        <div class="d-flex flex-wrap gap-5 mt-4">
                                            <!--begin::Input group-->
                                            <div class="fv-row w-100 flex-md-root">
                                                <!--begin::Label-->
                                                <label class="required form-label"> Book Transport En Title</label>
                                                <!--end::Label-->
                                                <!--begin::Input-->
                                                <input type="text" required name="book_transport_en_title"
                                                    class="form-control mb-2" placeholder=" En Title"
                                                    value="{{ $company->book_transport_en_title }}" />


                                            </div>
                                            <!--end::Input-->

                                            <!--begin::Input group-->
                                            <div class="fv-row w-100 flex-md-root">
                                                <!--begin::Label-->
                                                <label class="required form-label">Book Transport Title</label>
                                                <!--end::Label-->
                                                <!--begin::Input-->
                                                <input type="text" name="book_transport_ar_title" class="form-control mb-2"
                                                    placeholder=" Ar title" value="{{ $company->book_transport_ar_title }}" />


                                            </div>
                                        </div>

                                        <div class="d-flex flex-wrap gap-5">
                                            <!--begin::Input group-->
                                            <div class="fv-row w-100 flex-md-root">
                                                <!--begin::Label-->
                                                <label class="required form-label"> Book Transport Vedio</label>
                                                <!--end::Label-->
                                                <!--begin::Input-->
                                                <input type="text" required name="book_transport_vedio"
                                                    class="form-control mb-2" placeholder=" En Title"
                                                    value="{{ $company->book_transport_vedio }}" />


                                            </div>
                                            <!--end::Input-->
                                        </div>
                                        <!--end::Input-->

                                        <div class="d-flex flex-wrap gap-5">
                                            <!--begin::Input group-->
                                            <div class="fv-row w-100 flex-md-root">
                                                <!--begin::Label-->
                                                <label for="book_img2" class="btn btn-danger"> Transport image  </label>
                                                <!--end::Label-->
                                                <!--begin::Input-->
                                                {{ $company->transport_img }}
                                                <input type="file" id="book_img2" style="visibility: hidden" name="transport_img"
                                                    class="form-control mb-2" placeholder=""
                                                    value="{{ $company->transport_img }}" />



                                            </div>
                                            <!--end::Input-->
                                        </div>

                                    </div>
                                    <!--end::Card header-->
                                </div>
                                <!--end::General options-->
                            </div>
                        </div>
                        <div class="d-flex justify-content-end">
                            <!--begin::Button-->
                            <a href="{{ route('company.edit', $company->id) }}" id="kt_ecommerce_add_product_cancel"
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
