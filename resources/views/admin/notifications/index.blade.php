@extends('layout.main')

@section('breadcrumb')
    <div class="toolbar" id="kt_toolbar">
        <div class="container-fluid d-flex flex-stack flex-wrap flex-sm-nowrap">
            <div class="d-flex flex-column align-items-start justify-content-center flex-wrap me-2">
                <h1 class="text-dark fw-bolder my-1 fs-2">Notifications</h1>
                <ul class="breadcrumb fw-bold fs-base my-1">
                    <li class="breadcrumb-item text-muted">
                        <a href="{{ route('admin.home') }}" class="text-muted text-hover-primary">Home</a>
                    </li>
                    <li class="breadcrumb-item text-dark">Notifications</li>
                </ul>
            </div>
        </div>
    </div>
@endsection

@section('content')
    <div class="post fs-6 d-flex flex-column-fluid" id="kt_post">
        <div class="container-xxl">
            <div class="card card-flush">
                <div class="card-header align-items-center py-5">
                    <div class="card-title">
                        <span class="fw-bolder fs-4">Notifications</span>
                        <span class="text-muted fs-7 ms-3">Last {{ \App\Http\Controllers\AdminNotificationController::LIST_MONTHS }} months</span>
                    </div>
                    <div class="card-toolbar gap-3">
                        <form action="{{ route('admin.notifications.readAll') }}" method="POST" class="m-0">
                            @csrf
                            <button type="submit" class="btn btn-sm btn-light-primary">Mark all as read</button>
                        </form>
                        <form action="{{ route('admin.notifications.destroyOld') }}" method="POST" class="m-0"
                            onsubmit="return confirm('Delete {{ $oldCount }} notification(s) older than {{ \App\Http\Controllers\AdminNotificationController::DELETE_AFTER_MONTHS }} months? This cannot be undone.');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-light-danger" @disabled(!$oldCount)>
                                <i class="bi bi-trash"></i>
                                Delete older than {{ \App\Http\Controllers\AdminNotificationController::DELETE_AFTER_MONTHS }} months ({{ $oldCount }})
                            </button>
                        </form>
                    </div>
                </div>
                <div class="card-body pt-0">
                    @if (session('success'))
                        <div class="alert alert-success">{{ session('success') }}</div>
                    @endif

                    @forelse ($notifications as $notification)
                        @php($data = $notification->data)
                        <a href="{{ route('admin.notifications.show', $notification->id) }}"
                            class="d-flex align-items-center py-4 border-bottom bg-hover-light px-3 {{ $notification->read_at ? '' : 'bg-light-primary' }}">
                            <div class="symbol symbol-40px me-5">
                                <span class="symbol-label bg-light-{{ $data['color'] ?? 'primary' }}">
                                    <i class="{{ $data['icon'] ?? 'bi bi-bell' }} fs-3 text-{{ $data['color'] ?? 'primary' }}"></i>
                                </span>
                            </div>
                            <div class="flex-grow-1">
                                <div class="fw-bolder text-gray-800 fs-6">
                                    {{ $data['title'] ?? 'Notification' }}
                                    @unless ($notification->read_at)
                                        <span class="badge badge-light-danger ms-2">New</span>
                                    @endunless
                                </div>
                                <div class="text-gray-600">{{ $data['message'] ?? '' }}</div>
                                @if (!empty($data['customer']))
                                    <div class="text-muted fs-7 mt-1">
                                        <i class="bi bi-envelope me-1"></i>{{ $data['customer']['email'] ?: '—' }}
                                        <span class="mx-3">|</span>
                                        <i class="bi bi-telephone me-1"></i>{{ $data['customer']['phone'] ?: '—' }}
                                    </div>
                                @endif
                            </div>
                            <div class="text-muted fs-7 text-end ms-4" title="{{ $notification->created_at }}">
                                {{ $notification->created_at->diffForHumans() }}
                            </div>
                        </a>
                    @empty
                        <div class="text-center text-muted py-10">No notifications in the last {{ \App\Http\Controllers\AdminNotificationController::LIST_MONTHS }} months.</div>
                    @endforelse

                    <div class="mt-5">
                        {{ $notifications->links('pagination::bootstrap-5') }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
