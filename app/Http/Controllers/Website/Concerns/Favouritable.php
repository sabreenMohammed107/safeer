<?php

namespace App\Http\Controllers\Website\Concerns;

use App\Models\Favorite_hotels_tour;
use App\Notifications\AddedToFavoritesNotification;
use App\Support\AdminNotifier;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

trait Favouritable
{
    /**
     * Toggle a favourite row for the current site user.
     *
     * @param string $column 'hotel_id' | 'tour_id' | 'transfer_id'
     */
    protected function toggleFavourite(string $column, int $id)
    {
        $siteUser = session()->get('SiteUser');

        if (!$siteUser) {
            return response()->json([
                'ok' => false,
                'auth' => false,
                'redirect' => LaravelLocalization::localizeUrl('/safer/login'),
            ], 401);
        }

        $userId = $siteUser['ID'];

        $existing = Favorite_hotels_tour::where($column, $id)
            ->where('user_id', $userId)
            ->first();

        if ($existing) {
            $existing->delete();

            return response()->json(['ok' => true, 'favourited' => false]);
        }

        $favourite = Favorite_hotels_tour::create([$column => $id, 'user_id' => $userId]);
        $this->notifyAdminsOfFavourite($favourite, $column);

        return response()->json(['ok' => true, 'favourited' => true]);
    }

    /**
     * @param string $column 'hotel_id' | 'tour_id' | 'transfer_id' | 'offer_id'
     */
    protected function notifyAdminsOfFavourite(Favorite_hotels_tour $favourite, string $column): void
    {
        // 'tour_id' -> tour() relation on Favorite_hotels_tour
        $item = $favourite->{str_replace('_id', '', $column)};

        if ($item) {
            AdminNotifier::send(new AddedToFavoritesNotification($item, $favourite->user));
        }
    }
}
