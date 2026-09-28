@extends('layout.main')

@section('breadcrumb')
    <div class="toolbar" id="kt_toolbar">
        <div class="container-fluid d-flex flex-stack flex-wrap flex-sm-nowrap">
            <!--begin::Info-->
            <div class="d-flex flex-column align-items-start justify-content-center flex-wrap me-2">
                <!--begin::Title-->
                <h1 class="text-dark fw-bolder my-1 fs-2">Team</h1>
                <!--end::Title-->
                <!--begin::Breadcrumb-->
                <ul class="breadcrumb fw-bold fs-base my-1">
                    <li class="breadcrumb-item text-muted">
                        <a href="{{ route('teams.index') }}" class="text-muted text-hover-primary">Team</a>
                    </li>
                    <li class="breadcrumb-item text-dark">Edit</li>
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
            <form class="form d-flex flex-column flex-lg-row" action="{{ route('teams.update', $row->id) }}"
                method="post" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <!--begin::Aside column-->
                <div class="d-flex flex-column gap-7 gap-lg-10 w-100 w-lg-300px mb-7 me-lg-10">
                    <!--begin::Thumbnail settings-->
                    <div class="card card-flush py-4">
                        <div class="card-header">
                            <div class="card-title">
                                <h2>Photo</h2>
                            </div>
                        </div>
                        <div class="card-body text-center pt-0">
                            <div class="image-input image-input-outline mb-3" data-kt-image-input="true"
                                style="background-image: url('{{ asset('uploads/teams') }}/{{ $row->image }}')">
                                <div class="image-input-wrapper w-150px h-150px"
                                    style="background-image: url('{{ asset('uploads/teams') }}/{{ $row->image }}')">
                                </div>
                                <label class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow"
                                    data-kt-image-input-action="change" data-bs-toggle="tooltip" title="Change photo">
                                    <i class="bi bi-pencil-fill fs-7"></i>
                                    <input type="file" name="image" accept=".png, .jpg, .jpeg" />
                                    <input type="hidden" name="avatar_remove" />
                                </label>
                                <span class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow"
                                    data-kt-image-input-action="cancel" data-bs-toggle="tooltip" title="Cancel photo">
                                    <i class="bi bi-x fs-2"></i>
                                </span>
                            </div>
                        </div>
                    </div>
                    <!--end::Thumbnail settings-->

                    <!--begin::Status-->
                    <div class="card card-flush py-4">
                        <div class="card-header">
                            <div class="card-title">
                                <h2>Status</h2>
                            </div>
                        </div>
                        <div class="card-body pt-0">
                            <div class="form-check form-switch form-check-custom form-check-solid mb-6">
                                <input class="form-check-input" type="checkbox" name="active" value="1"
                                    @checked($row->active) id="teamActiveSwitch" />
                                <label class="form-check-label" for="teamActiveSwitch">Active</label>
                            </div>
                            <div class="form-check form-switch form-check-custom form-check-solid mb-6">
                                <input class="form-check-input" type="checkbox" name="featured" value="1"
                                    @checked($row->featured) id="teamFeaturedSwitch" />
                                <label class="form-check-label" for="teamFeaturedSwitch">Featured</label>
                            </div>
                        </div>
                    </div>
                    <!--end::Status-->
                </div>
                <!--end::Aside column-->

                <!--begin::Main column-->
                <div class="d-flex flex-column flex-row-fluid gap-7 gap-lg-10">
                    <div class="card card-flush py-4">
                        <div class="card-header">
                            <div class="card-title">
                                <h2>General</h2>
                            </div>
                        </div>
                        <div class="card-body pt-0">
                            <div class="d-flex flex-wrap gap-5">
                                <div class="fv-row w-100 flex-md-root">
                                    <label class="required form-label">En Name</label>
                                    <input type="text" required name="en_name" class="form-control mb-2"
                                        value="{{ $row->en_name }}" />
                                </div>
                                <div class="fv-row w-100 flex-md-root">
                                    <label class="form-label">Ar Name</label>
                                    <input type="text" name="ar_name" class="form-control mb-2"
                                        value="{{ $row->ar_name }}" />
                                </div>
                            </div>

                            <div class="d-flex flex-wrap gap-5 mt-4">
                                <div class="fv-row w-100 flex-md-root">
                                    <label class="form-label">En Job Title</label>
                                    <input type="text" name="en_job" class="form-control mb-2"
                                        value="{{ $row->en_job }}" />
                                </div>
                                <div class="fv-row w-100 flex-md-root">
                                    <label class="form-label">Ar Job Title</label>
                                    <input type="text" name="ar_job" class="form-control mb-2"
                                        value="{{ $row->ar_job }}" />
                                </div>
                            </div>

                            <div class="mt-4">
                                <label class="form-label">En Description</label>
                                <textarea class="form-control form-control-solid" rows="4" name="en_description">{{ $row->en_description }}</textarea>
                            </div>
                            <div class="mt-4">
                                <label class="form-label">Ar Description</label>
                                <textarea class="form-control form-control-solid" rows="4" name="ar_description">{{ $row->ar_description }}</textarea>
                            </div>
                        </div>
                    </div>

                    <div class="d-flex justify-content-end">
                        <a href="{{ route('teams.index') }}" class="btn btn-light me-5">Cancel</a>
                        <button type="submit" class="btn btn-primary">
                            <span class="indicator-label">Save Changes</span>
                        </button>
                    </div>
                </div>
                <!--end::Main column-->
            </form>
        </div>
        <!--end::Container-->
    </div>
    <!--end::Post-->
@endsection
