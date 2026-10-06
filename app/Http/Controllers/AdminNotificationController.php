<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

/**
 * The admin's own notifications (new orders, new favourites...).
 * The header bell dropdown lives in layout/header.blade.php.
 */
class AdminNotificationController extends Controller
{
    /** The list only shows notifications from the last N months. */
    public const LIST_MONTHS = 6;

    /** "Delete old" removes notifications older than N months. */
    public const DELETE_AFTER_MONTHS = 3;

    public function index(Request $request)
    {
        $notifications = $request->user()->notifications()
            ->where('created_at', '>=', now()->subMonths(self::LIST_MONTHS))
            ->paginate(20);

        $oldCount = $this->oldNotifications($request)->count();

        return view('admin.notifications.index', compact('notifications', 'oldCount'));
    }

    /**
     * Unread count + latest unread for the header bell, limited to the same
     * LIST_MONTHS window as the list page.
     *
     * @return array{0:int, 1:\Illuminate\Support\Collection}
     */
    public static function bellData(User $user): array
    {
        $recentUnread = $user->unreadNotifications()
            ->where('created_at', '>=', now()->subMonths(self::LIST_MONTHS));

        return [(clone $recentUnread)->count(), $recentUnread->take(6)->get()];
    }

    /**
     * Polled by the header bell script every few seconds to refresh the
     * badge and dropdown without a page reload.
     */
    public function poll(Request $request)
    {
        [$unreadCount, $latestUnread] = self::bellData($request->user());

        return response()->json([
            'count' => $unreadCount,
            'menu' => view('admin.notifications._menu', compact('unreadCount', 'latestUnread'))->render(),
        ]);
    }

    /**
     * Mark one notification as read and show a short summary of it:
     * who did what, on which item (with a link to the item itself).
     */
    public function show(Request $request, string $id)
    {
        $notification = $request->user()->notifications()->findOrFail($id);
        $notification->markAsRead();

        return view('admin.notifications.show', compact('notification'));
    }

    public function markAllAsRead(Request $request)
    {
        $request->user()->unreadNotifications->markAsRead();

        return back()->with('success', 'All notifications marked as read.');
    }

    /**
     * Delete this admin's notifications older than DELETE_AFTER_MONTHS.
     * Other admins keep their own copies.
     */
    public function destroyOld(Request $request)
    {
        $deleted = $this->oldNotifications($request)->delete();

        return back()->with('success', "{$deleted} notification(s) older than " . self::DELETE_AFTER_MONTHS . ' months deleted.');
    }

    private function oldNotifications(Request $request)
    {
        return $request->user()->notifications()
            ->where('created_at', '<', now()->subMonths(self::DELETE_AFTER_MONTHS));
    }
}
