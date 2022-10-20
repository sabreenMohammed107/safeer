@extends('layout.main')

@section('breadcrumb')
    <div class="toolbar" id="kt_toolbar">
        <div class="container-fluid d-flex flex-stack flex-wrap flex-sm-nowrap">
            <!--begin::Info-->
            <div class="d-flex flex-column align-items-start justify-content-center flex-wrap me-2">
                <!--begin::Title-->
                <h1 class="text-dark fw-bolder my-1 fs-2">Home Sections</h1>
                <!--end::Title-->
                <!--begin::Breadcrumb-->
                <ul class="breadcrumb fw-bold fs-base my-1">
                    <li class="breadcrumb-item text-muted">
                        <a href="../dist/index.html" class="text-muted text-hover-primary">Home</a>
                    </li>
                    <li class="breadcrumb-item text-muted">Home Sections</li>

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
                action="{{ route('company.store') }}" method="post" enctype="multipart/form-data">
                @csrf


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
                        <input type="hidden" name="company_id" value="{{$company->id}}" >
                        <div class="card-body pt-0">


                            <!--begin::Input group-->
                            <div class="d-flex flex-wrap gap-5">
                                <!--begin::Input group-->
                                <div class="fv-row w-100 flex-md-root">
                                    <!--begin::Label-->
                                    <label class="form-label">En Best Hotel Text</label>
                                    <!--end::Label-->
                                    <!--begin::Editor-->
                                    <textarea class="form-select form-select-solid" id="kt_docs_tinymce_basic" name="best_hotels_en_desc">{{$company->best_hotels_en_desc}}</textarea>
                                    <!--end::Editor-->

                                </div>
                                <!--end::Input group-->
                                <!--begin::Input group-->
                                <div class="fv-row w-100 flex-md-root">
                                    <!--begin::Label-->
                                    <label class="form-label">Ar Best Hotel Text</label>
                                    <!--end::Label-->
                                    <!--begin::Editor-->
                                    <textarea class="form-select form-select-solid" id="kt_docs_tinymce_basic2" name="best_hotels_ar_desc">{{$company->best_hotels_ar_desc}}</textarea>
                                    <!--end::Editor-->

                                </div>
                                <!--end::Input group-->

                            </div>


<!--begin::Input group-->
<div class="d-flex flex-wrap gap-5">
    <!--begin::Input group-->
    <div class="fv-row w-100 flex-md-root">
        <!--begin::Label-->
        <label class="form-label">En Book Tour Text</label>
        <!--end::Label-->
        <!--begin::Editor-->
        <textarea class="form-select form-select-solid" id="kt_docs_tinymce_basic" name="book_tour_en_desc">{{$company->book_tour_en_desc}}</textarea>
        <!--end::Editor-->

    </div>
    <!--end::Input group-->
    <!--begin::Input group-->
    <div class="fv-row w-100 flex-md-root">
        <!--begin::Label-->
        <label class="form-label">Ar Book Tour Text</label>
        <!--end::Label-->
        <!--begin::Editor-->
        <textarea class="form-select form-select-solid" id="kt_docs_tinymce_basic2" name="book_tour_ar_desc">{{$company->book_tour_ar_desc}}</textarea>
        <!--end::Editor-->

    </div>
    <!--end::Input group-->

</div>

 <!--begin::Input group-->
 <div class="d-flex flex-wrap gap-5">
    <!--begin::Input group-->
    <div class="fv-row w-100 flex-md-root">
        <!--begin::Label-->
        <label class="required form-label"> En  Book Tour Title</label>
        <!--end::Label-->
        <!--begin::Input-->
        <input type="text"  name="book_tour_en_title" class="form-control mb-2"
            placeholder=" En Title" value="{{ $company->book_tour_en_title }}" />


    </div>
    <!--end::Input-->

    <!--begin::Input group-->
    <div class="fv-row w-100 flex-md-root">
        <!--begin::Label-->
        <label class="required form-label"> Ar Book Tour Title</label>
        <!--end::Label-->
        <!--begin::Input-->
        <input type="text" name="book_tour_ar_title" class="form-control mb-2"
            placeholder=" Ar title" value="{{ $company->book_tour_ar_title }}" />


    </div>
</div>
<!--end::Input-->

 <!--begin::Input group-->
 <div class="mb-10 fv-row">
    <!--begin::Label-->
    <label class="required form-label">Book Tour Vedio</label>
    <!--end::Label-->
    <!--begin::Input-->
    <input type="text"  name="book_tour_vedio" class="form-control mb-2"
        placeholder="Book Tour Vedio" value="{{$company->book_tour_vedio}}" />


</div>
<!--end::Input-->

<!--begin::Input group-->
<div class="d-flex flex-wrap gap-5">
    <!--begin::Input group-->
    <div class="fv-row w-100 flex-md-root">
        <!--begin::Label-->
        <label class="form-label">En Book Transport Text</label>
        <!--end::Label-->
        <!--begin::Editor-->
        <textarea class="form-select form-select-solid" id="kt_docs_tinymce_basic" name="book_transport_en_desc">{{$company->book_transport_en_desc}}</textarea>
        <!--end::Editor-->

    </div>
    <!--end::Input group-->
    <!--begin::Input group-->
    <div class="fv-row w-100 flex-md-root">
        <!--begin::Label-->
        <label class="form-label">Ar Book Transport Text</label>
        <!--end::Label-->
        <!--begin::Editor-->
        <textarea class="form-select form-select-solid" id="kt_docs_tinymce_basic2" name="book_transport_ar_desc">{{$company->book_transport_ar_desc}}</textarea>
        <!--end::Editor-->

    </div>
    <!--end::Input group-->

</div>

 <!--begin::Input group-->
 <div class="d-flex flex-wrap gap-5">
    <!--begin::Input group-->
    <div class="fv-row w-100 flex-md-root">
        <!--begin::Label-->
        <label class="required form-label"> En  Transport  Title</label>
        <!--end::Label-->
        <!--begin::Input-->
        <input type="text"  name="book_transport_en_title" class="form-control mb-2"
            placeholder=" En Title" value="{{ $company->book_transport_en_title }}" />


    </div>
    <!--end::Input-->

    <!--begin::Input group-->
    <div class="fv-row w-100 flex-md-root">
        <!--begin::Label-->
        <label class="required form-label"> Ar Book Transport Title</label>
        <!--end::Label-->
        <!--begin::Input-->
        <input type="text" name="book_transport_ar_title" class="form-control mb-2"
            placeholder=" Ar title" value="{{ $company->book_transport_ar_title }}" />


    </div>
</div>
<!--end::Input-->

 <!--begin::Input group-->
 <div class="mb-10 fv-row">
    <!--begin::Label-->
    <label class="required form-label">Book Transport Vedio</label>
    <!--end::Label-->
    <!--begin::Input-->
    <input type="text"  name="book_transport_vedio" class="form-control mb-2"
        placeholder="Book Transport Vedio" value="{{$company->book_transport_vedio}}" />


</div>
<!--end::Input-->




                            <!--begin::checkbox-->



                        </div>
                        <!--end::Card header-->
                    </div>
                    <!--end::General options-->


                    <div class="d-flex justify-content-end">
                        <!--begin::Button-->
                        <a href="{{ route('company.show',$company->id) }}" id="kt_ecommerce_add_product_cancel"
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
