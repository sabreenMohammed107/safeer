@extends('layout.main')

@section('breadcrumb')
    <div class="toolbar" id="kt_toolbar">
        <div class="container-fluid d-flex flex-stack flex-wrap flex-sm-nowrap">
            <!--begin::Info-->
            <div class="d-flex flex-column align-items-start justify-content-center flex-wrap me-2">
                <!--begin::Title-->
                <h1 class="text-dark fw-bolder my-1 fs-2">Visa Guest Lead</h1>
                <!--end::Title-->
                <!--begin::Breadcrumb-->
                <ul class="breadcrumb fw-bold fs-base my-1">
                    <li class="breadcrumb-item text-muted">
                        <a href="{{ route('visa-leads.index') }}" class="text-muted text-hover-primary">Guest Leads</a>
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
            <form class="form d-flex flex-column flex-lg-row" action="{{ route('visa-leads.update', $row->id) }}"
                method="post">
                @csrf
                @method('PUT')

                <div class="d-flex flex-column flex-row-fluid gap-7 gap-lg-10">
                    <div class="card card-flush py-4">
                        <div class="card-header">
                            <div class="card-title">
                                <h2>{{ $row->passenger_name }}</h2>
                            </div>
                        </div>
                        <div class="card-body pt-0">
                            <div class="fv-row w-100 flex-md-root mb-5">
                                <label class="fs-6 fw-bold form-label mt-3">Status</label>
                                <select required class="form-select form-select-solid" name="status">
                                    <option value="pending" {{ $row->status === 'pending' ? 'selected' : '' }}>Pending</option>
                                    <option value="contacted" {{ $row->status === 'contacted' ? 'selected' : '' }}>Contacted</option>
                                    <option value="closed" {{ $row->status === 'closed' ? 'selected' : '' }}>Closed</option>
                                </select>
                            </div>

                            <div class="fv-row w-100 flex-md-root">
                                <label class="form-label">Notes</label>
                                <textarea class="form-control form-control-solid" rows="4" name="notes"
                                    placeholder="Internal notes about this lead">{{ $row->notes }}</textarea>
                            </div>
                        </div>
                    </div>

                    <div class="d-flex justify-content-end">
                        <a href="{{ route('visa-leads.show', $row->id) }}" class="btn btn-light me-5">Cancel</a>
                        <button type="submit" class="btn btn-primary">Save Changes</button>
                    </div>
                </div>
            </form>
        </div>
        <!--end::Container-->
    </div>
    <!--end::Post-->
@endsection
