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
                    <li class="breadcrumb-item text-dark">View</li>
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
            <div class="d-flex flex-column flex-row-fluid gap-7 gap-lg-10">
                <!--begin::General options-->
                <div class="card card-flush py-4">
                    <div class="card-header">
                        <div class="card-title">
                            <h2>Passenger Details</h2>
                        </div>
                    </div>
                    <div class="card-body pt-0">
                        <table class="table align-middle table-row-dashed fs-6 gy-5">
                            <tbody class="fw-bold text-gray-600">
                                <tr>
                                    <td class="text-muted">Passenger Name</td>
                                    <td>{{ $row->passenger_name }}</td>
                                </tr>
                                <tr>
                                    <td class="text-muted">Mobile Number</td>
                                    <td>{{ $row->mobile_number }}</td>
                                </tr>
                                <tr>
                                    <td class="text-muted">Email</td>
                                    <td>{{ $row->email }}</td>
                                </tr>
                                <tr>
                                    <td class="text-muted">Visa Request Country</td>
                                    <td>{{ $row->country->en_country ?? '' }} / {{ $row->country->ar_country ?? '' }}</td>
                                </tr>
                                <tr>
                                    <td class="text-muted">Visa Type</td>
                                    <td>{{ $row->visaType->en_type ?? '' }} / {{ $row->visaType->ar_type ?? '' }}</td>
                                </tr>
                                <tr>
                                    <td class="text-muted">Nationality</td>
                                    <td>{{ $row->nationality->en_nationality ?? '' }} / {{ $row->nationality->ar_nationality ?? '' }}</td>
                                </tr>
                                <tr>
                                    <td class="text-muted">Status</td>
                                    <td>
                                        @if ($row->status === 'contacted')
                                            <div class="badge badge-light-primary">Contacted</div>
                                        @elseif ($row->status === 'closed')
                                            <div class="badge badge-light-success">Closed</div>
                                        @else
                                            <div class="badge badge-light-warning">Pending</div>
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <td class="text-muted">Notes</td>
                                    <td>{{ $row->notes }}</td>
                                </tr>
                                <tr>
                                    <td class="text-muted">Submitted</td>
                                    <td>{{ $row->created_at->format('Y-m-d H:i') }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <!--end::General options-->

                <!--begin::General options-->
                <div class="card card-flush py-4">
                    <div class="card-header">
                        <div class="card-title">
                            <h2>Uploaded Images</h2>
                        </div>
                    </div>
                    <div class="card-body pt-0">
                        <div class="row">
                            <div class="col-md-6 mb-5">
                                <label class="fw-bold mb-3 d-block">Passport Image</label>
                                <a href="{{ asset('uploads/visa-leads/' . $row->passport_image) }}" target="_blank">
                                    <img src="{{ asset('uploads/visa-leads/' . $row->passport_image) }}"
                                        class="w-100 rounded border" alt="Passport Image">
                                </a>
                            </div>
                            <div class="col-md-6 mb-5">
                                <label class="fw-bold mb-3 d-block">Personal Image</label>
                                @if ($row->personal_image)
                                    <a href="{{ asset('uploads/visa-leads/' . $row->personal_image) }}" target="_blank">
                                        <img src="{{ asset('uploads/visa-leads/' . $row->personal_image) }}"
                                            class="w-100 rounded border" alt="Personal Image">
                                    </a>
                                @else
                                    <span class="text-muted">Not applicable (not the UAE)</span>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                <!--end::General options-->

                <div class="d-flex justify-content-end">
                    <a href="{{ route('visa-leads.index') }}" class="btn btn-light me-5">Back</a>
                    <a href="{{ route('visa-leads.edit', $row->id) }}" class="btn btn-primary">Edit Status / Notes</a>
                </div>
            </div>
        </div>
        <!--end::Container-->
    </div>
    <!--end::Post-->
@endsection
