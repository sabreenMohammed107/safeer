{{--
    Contents of the header bell dropdown. Rendered by layout/header.blade.php
    on page load, and re-rendered by AdminNotificationController::poll so the
    header script can swap it in without a page reload.
    Expects: $unreadCount, $latestUnread
--}}
<div class="d-flex flex-stack px-6 py-4 border-bottom">
    <span class="fw-bolder fs-5 text-dark">Notifications</span>
    <span class="badge badge-light-primary">{{ $unreadCount }} new</span>
</div>
<div class="scroll-y mh-325px">
    @forelse ($latestUnread as $notification)
        <a href="{{ route('admin.notifications.show', $notification->id) }}"
            class="d-flex align-items-start px-6 py-4 bg-hover-light-primary border-bottom">
            <div class="symbol symbol-35px me-4">
                <span class="symbol-label bg-light-{{ $notification->data['color'] ?? 'primary' }}">
                    <i class="{{ $notification->data['icon'] ?? 'bi bi-bell' }} fs-4 text-{{ $notification->data['color'] ?? 'primary' }}"></i>
                </span>
            </div>
            <div class="flex-grow-1">
                <div class="fw-bolder text-gray-800 fs-6">{{ $notification->data['title'] ?? 'Notification' }}</div>
                <div class="text-gray-600 fs-7">{{ $notification->data['message'] ?? '' }}</div>
                @if (!empty($notification->data['customer']))
                    <div class="text-muted fs-8 mt-1">
                        <i class="bi bi-envelope me-1 fs-8"></i>{{ $notification->data['customer']['email'] ?: '—' }}
                        @if (!empty($notification->data['customer']['phone']))
                            <span class="mx-2">|</span>
                            <i class="bi bi-telephone me-1 fs-8"></i>{{ $notification->data['customer']['phone'] }}
                        @endif
                    </div>
                @endif
                <div class="text-muted fs-8 mt-1">{{ $notification->created_at->diffForHumans() }}</div>
            </div>
        </a>
    @empty
        <div class="text-center text-muted py-10">No new notifications</div>
    @endforelse
</div>
<div class="d-flex flex-stack px-6 py-3">
    <a href="{{ route('admin.notifications.index') }}" class="btn btn-sm btn-light-primary">View all</a>
    @if ($unreadCount)
        <form action="{{ route('admin.notifications.readAll') }}" method="POST" class="m-0">
            @csrf
            <button type="submit" class="btn btn-sm btn-light">Mark all as read</button>
        </form>
    @endif
</div>
