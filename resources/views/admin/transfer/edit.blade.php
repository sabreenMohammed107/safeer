@extends('layout.main')

@section('breadcrumb')
    <div class="toolbar" id="kt_toolbar">
        <div class="container-fluid d-flex flex-stack flex-wrap flex-sm-nowrap">
            <!--begin::Info-->
            <div class="d-flex flex-column align-items-start justify-content-center flex-wrap me-2">
                <!--begin::Title-->
                <h1 class="text-dark fw-bolder my-1 fs-2">Transfer</h1>
                <!--end::Title-->
                <!--begin::Breadcrumb-->
                <ul class="breadcrumb fw-bold fs-base my-1">
                    <li class="breadcrumb-item text-muted">
                        <a href="../dist/index.html" class="text-muted text-hover-primary">Home</a>
                    </li>
                    <li class="breadcrumb-item text-muted">Transfer</li>

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
            action="{{ route('transfer.update', $row->id) }}" method="post" enctype="multipart/form-data">
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

                                        <!--end::Input-->

                                        <div class="d-flex flex-wrap gap-5">
                                            <!--begin::Input group-->
                                            <div class="fv-row w-100 flex-md-root">
                                                <label class="fs-6 fw-bold form-label mt-3">
                                                    <option value="">Select transfer From..</option>
                                                    {{-- <i class="fas fa-exclamation-circle ms-1 fs-7" data-bs-toggle="tooltip" title="Interviewer who conducts the meeting with the interviewee"></i> --}}
                                                </label>
                                                <!--end::Label-->
                                                <select required class="form-select form-select-solid "
                                                    data-control="select2" data-placeholder="Select an option" required
                                                    data-show-subtext="true" data-live-search="true" name="from_location_id" >
                                                    <option value=""></option>
                                                    @foreach ($transferFrom as $transferF)
                                                        <option value="{{ $transferF->id }}" {{ $row->from_location_id == $transferF->id ? 'selected' : '' }} >{{ $transferF->location_enname }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <!--begin::Input group-->
                                            <div class="fv-row w-100 flex-md-root">
                                                <label class="fs-6 fw-bold form-label mt-3">
                                                    <option value="">Select transfer To..</option>
                                                </label>
                                                <!--end::Label-->
                                                <select required class="form-select form-select-solid" name="to_location_id"
                                                    data-control="select2" data-placeholder="Select an option"
                                                    data-show-subtext="true" data-live-search="true" id="sub">
                                                    <option value=""></option>
                                                    @foreach ($transferTo as $transferT)
                                                        <option value="{{ $transferT->id }}" {{ $row->to_location_id == $transferT->id ? 'selected' : '' }} >{{ $transferT->location_enname }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>




                                        <!--begin::Input group-->
                                        <div class="d-flex flex-wrap gap-5">
                                            <!--begin::Input group-->
                                            <div class="fv-row w-100 flex-md-root">
                                                <label class="fs-6 fw-bold form-label mt-3">
                                                    <option value="">Select Model Type..</option>
                                                </label>
                                                <select  class="form-select form-select-solid"
                                                    name="car_model_id" data-control="select2"
                                                    data-placeholder="Select an option">
                                                    <option value=""></option>
                                                    @foreach ($carModel as $carMod)
                                                        <option value="{{ $carMod->id }}" {{ $row->car_model_id == $carMod->id ? 'selected' : '' }}>{{ $carMod->model_enname }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <!--begin::Input group-->
                                            <div class="fv-row w-100 flex-md-root">
                                                <label class="fs-6 fw-bold form-label mt-3">
                                                    <option value="">Select Car Class..</option>
                                                </label>
                                                <select  class="form-select form-select-solid"
                                                    name="class_id" data-control="select2"
                                                    data-placeholder="Select an option">
                                                    <option value=""></option>
                                                    @foreach ($carClass as $carclas)
                                                        <option value="{{ $carclas->id }}" {{ $row->class_id == $carclas->id ? 'selected' : '' }}>{{ $carclas->class_enname }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <!--end::Input group-->


                                            <!--rooms -->

                                        </div>


                                        <div class="d-flex flex-wrap gap-5">
                                            <!--begin::Input group-->
                                            <div class="fv-row w-100 flex-md-root">
                                                <label class="required form-label">Duration</label>
                                                <!--end::Label-->
                                                <!--begin::Input-->
                                                <input required type="text"
                                                    name="duration" class="form-control mb-2"
                                                    placeholder="duration" value="{{ $row->duration}}" />
                                                <!--end::Input-->
                                            </div>
                                            <!--end::Input group-->



                                           <!--begin::Input group-->
                                           <div class="fv-row w-100 flex-md-root">
                                            <label class="required form-label">Person Cost</label>
                                            <!--end::Label-->
                                            <!--begin::Input-->
                                            <input required type="number" min="1"
                                                name="person_price" class="form-control mb-2"
                                                placeholder="person_price" value="{{ $row->person_price }}" />
                                            <!--end::Input-->
                                        </div>
                                        <!--end::Input group-->

                                        </div>

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
                        <a href="{{ route('transfer.index') }}" id="kt_ecommerce_add_product_cancel"
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




@endsection
