<?php

namespace App\Http\Controllers\Website\Concerns;

use App\Models\Favorite_hotels_tour;
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

        Favorite_hotels_tour::create([$column => $id, 'user_id' => $userId]);

        return response()->json(['ok' => true, 'favourited' => true]);
    }
}
