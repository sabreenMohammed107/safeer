<?php

namespace App\Support;

use App\Models\User;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Notification as NotificationFacade;

/**
 * Sends a notification to every dashboard admin.
 *
 * "Admin" means users.type = 1 — the same rule the `user-access:admin`
 * middleware uses to guard the dashboard (0 = user, 1 = admin, 2 = manager).
 */
class AdminNotifier
{
    public static function send(Notification $notification): void
    {
        // Called after the customer's action has already succeeded, so a
        // failure here (SMTP down, queue misconfigured...) must never turn
        // into an error page for the customer — log it and move on.
        try {
            $admins = User::where('type', 1)->get();

            if ($admins->isNotEmpty()) {
                NotificationFacade::send($admins, $notification);
            }
        } catch (\Throwable $e) {
            Log::error('Admin notification failed to send.', [
                'notification' => get_class($notification),
                'error' => $e->getMessage(),
            ]);
        }
    }
}
