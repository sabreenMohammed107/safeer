@extends('layout.main')

@php
    $data = $notification->data;
    $color = $data['color'] ?? 'primary';
    $customer = $data['customer'] ?? null;
    $details = $data['details'] ?? [];
@endphp

@section('breadcrumb')
    <div class="toolbar" id="kt_toolbar">
        <div class="container-fluid d-flex flex-stack flex-wrap flex-sm-nowrap">
            <div class="d-flex flex-column align-items-start justify-content-center flex-wrap me-2">
                <h1 class="text-dark fw-bolder my-1 fs-2">Notification Details</h1>
                <ul class="breadcrumb fw-bold fs-base my-1">
                    <li class="breadcrumb-item text-muted">
                        <a href="{{ route('admin.home') }}" class="text-muted text-hover-primary">Home</a>
                    </li>
                    <li class="breadcrumb-item text-muted">
                        <a href="{{ route('admin.notifications.index') }}" class="text-muted text-hover-primary">Notifications</a>
                    </li>
                    <li class="breadcrumb-item text-dark">Details</li>
                </ul>
            </div>
        </div>
    </div>
@endsection

@section('content')
    <div class="post fs-6 d-flex flex-column-fluid" id="kt_post">
        <div class="container-xxl">
            <div class="card card-flush mw-800px">
                {{-- Header: icon, title, message, time --}}
                <div class="card-header align-items-center py-5">
                    <div class="d-flex align-items-center">
                        <div class="symbol symbol-50px me-5">
                            <span class="symbol-label bg-light-{{ $color }}">
                                <i class="{{ $data['icon'] ?? 'bi bi-bell' }} fs-1 text-{{ $color }}"></i>
                            </span>
                        </div>
                        <div>
                            <div class="fw-bolder text-gray-800 fs-3">{{ $data['title'] ?? 'Notification' }}</div>
                            <div class="text-muted fs-7" title="{{ $notification->created_at }}">
                                {{ $notification->created_at->format('d M Y, h:i A') }}
                                ({{ $notification->created_at->diffForHumans() }})
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card-body pt-0">
                    <p class="text-gray-700 fs-5 mb-8">{{ $data['message'] ?? '' }}</p>

                    {{-- Who did it --}}
                    @if ($customer)
                        <h4 class="fw-bolder text-gray-800 mb-4">Customer</h4>
                        <table class="table table-row-dashed fs-6 gy-3 mb-8">
                            <tr>
                                <td class="text-muted w-150px">Name</td>
                                <td class="fw-bolder text-gray-800">{{ $customer['name'] ?? '—' }}</td>
                            </tr>
                            <tr>
                                <td class="text-muted">Email</td>
                                <td class="fw-bolder text-gray-800">
                                    @if (!empty($customer['email']))
                                        <a href="mailto:{{ $customer['email'] }}">{{ $customer['email'] }}</a>
                                    @else
                                        —
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <td class="text-muted">Phone</td>
                                <td class="fw-bolder text-gray-800">
                                    @if (!empty($customer['phone']))
                                        <a href="tel:{{ $customer['phone'] }}">{{ $customer['phone'] }}</a>
                                    @else
                                        —
                                    @endif
                                </td>
                            </tr>
                        </table>
                    @endif

                    {{-- What they did, on which item --}}
                    @if ($details)
                        <h4 class="fw-bolder text-gray-800 mb-4">Details</h4>
                        <table class="table table-row-dashed fs-6 gy-3 mb-8">
                            @foreach ($details as $label => $value)
                                <tr>
                                    <td class="text-muted w-150px">{{ $label }}</td>
                                    <td class="fw-bolder text-gray-800">{{ $value }}</td>
                                </tr>
                            @endforeach
                        </table>
                    @endif

                    <div class="d-flex gap-3">
                        <a href="{{ route('admin.notifications.index') }}" class="btn btn-light">Back to notifications</a>
                        @if (!empty($data['url']))
                            <a href="{{ $data['url'] }}" class="btn btn-light-{{ $color }}">{{ $data['url_label'] ?? 'Open' }}</a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
