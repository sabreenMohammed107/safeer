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
                                    <!--begin::Label-->
                                    <label class="required form-label"> En Title</label>
                                    <!--end::Label-->
                                    <!--begin::Input-->
                                    <input type="text" required name="overview_entitle" class="form-control mb-2"
                                        placeholder=" En Title" value="{{ $company->overview_entitle }}" />


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
                                    <input type="text" required name="overview_ensubtitle" class="form-control mb-2"
                                        placeholder=" En Sub Title" value="{{ $company->overview_ensubtitle }}" />


                                </div>
                                <!--end::Input-->

                                <!--begin::Input group-->
                                <div class="fv-row w-100 flex-md-root">
                                    <!--begin::Label-->
                                    <label class="required form-label"> Ar Sub Title</label>
                                    <!--end::Label-->
                                    <!--begin::Input-->
                                    <input type="text" name="overview_arsubtitle" class="form-control mb-2"
                                        placeholder=" Ar Sub title" value="{{ $company->overview_arsubtitle }}" />


                                </div>
                            </div>
                            <!--end::Input-->





                            <!--begin::Input group-->
                            <div class="d-flex flex-wrap gap-5">
                                <!--begin::Input group-->
                                <div class="fv-row w-100 flex-md-root">
                                    <!--begin::Label-->
                                    <label class="form-label">En Overview Text</label>
                                    <!--end::Label-->
                                    <!--begin::Editor-->
                                    <textarea class="form-select form-select-solid" id="kt_docs_tinymce_basic" name="overview_en">{{$company->overview_en}}</textarea>
                                    <!--end::Editor-->

                                </div>
                                <!--end::Input group-->
                                <!--begin::Input group-->
                                <div class="fv-row w-100 flex-md-root">
                                    <!--begin::Label-->
                                    <label class="form-label">Ar Overview Text</label>
                                    <!--end::Label-->
                                    <!--begin::Editor-->
                                    <textarea class="form-select form-select-solid" id="kt_docs_tinymce_basic2" name="overview_ar">{{$company->overview_ar}}</textarea>
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
        <textarea class="form-select form-select-solid" id="kt_docs_tinymce_basic" name="mission_en">{{$company->mission_en}}</textarea>
        <!--end::Editor-->

    </div>
    <!--end::Input group-->
    <!--begin::Input group-->
    <div class="fv-row w-100 flex-md-root">
        <!--begin::Label-->
        <label class="form-label">Ar Mission Text</label>
        <!--end::Label-->
        <!--begin::Editor-->
        <textarea class="form-select form-select-solid" id="kt_docs_tinymce_basic2" name="mission_ar">{{$company->mission_ar}}</textarea>
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
        <textarea class="form-select form-select-solid" id="kt_docs_tinymce_basic" name="vision_en">{{$company->vision_en}}</textarea>
        <!--end::Editor-->

    </div>
    <!--end::Input group-->
    <!--begin::Input group-->
    <div class="fv-row w-100 flex-md-root">
        <!--begin::Label-->
        <label class="form-label">Ar vision Text</label>
        <!--end::Label-->
        <!--begin::Editor-->
        <textarea class="form-select form-select-solid" id="kt_docs_tinymce_basic2" name="vision_ar">{{$company->vision_ar}}</textarea>
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
            data-kt-buttons="true" data-kt-buttons-target="[data-kt-button='true']">


            <!--begin::Col-->
            <div class="col">
                <!--begin::Option-->
                <!--begin::Label-->
                <label class="form-label">Youtube Account</label>
                <!--end::Label-->
                <!--begin::Input-->
                <input type="text" class="form-control mb-2" name="youtube"
                    placeholder="Youtube Account" value="{{$company->youtube}}" />
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
                    <input type="text" name="instagram" class="form-control mb-2"
                        placeholder="instagram" value="{{$company->instagram}}" />
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
                    <input type="text" name="facebook" class="form-control mb-2"
                        placeholder="facebook" value="{{$company->facebook}}" />
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



                        </div>
                        <!--end::Card header-->
                    </div>
                    <!--end::General options-->


                    <div class="d-flex justify-content-end">
                        <!--begin::Button-->
                        <a href="{{ route('company.edit',$company->id) }}" id="kt_ecommerce_add_product_cancel"
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
