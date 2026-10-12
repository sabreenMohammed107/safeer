<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Concerns\PicksServerImages;
use App\Http\Requests\UpdatePageAdvertisementRequest;
use App\Models\Offer;
use App\Models\PageAdvertisement;
use Illuminate\Validation\ValidationException;

/**
 * Admin: the promotional banner of the offers / visa / transport pages.
 * Each page has exactly one ad, so there is no create or delete — only
 * edit (images, link) and an on/off switch.
 */
class PageAdvertisementController extends Controller
{
    use PicksServerImages;

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $ads = collect(array_keys(PageAdvertisement::PAGES))
            ->map(fn ($page) => PageAdvertisement::forPage($page)->load('offer'));

        return view('admin.page-ads.index', compact('ads'));
    }

    public function edit(string $page)
    {
        $ad = PageAdvertisement::forPage($page);
        $offers = Offer::orderBy('created_at', 'desc')->get(['id', 'subtitle_en', 'active', 'start_date', 'end_date']);

        return view('admin.page-ads.edit', compact('ad', 'offers'));
    }

    public function update(UpdatePageAdvertisementRequest $request, string $page)
    {
        $ad = PageAdvertisement::forPage($page);
        $mediaType = $request->input('media_type');

        // Keep the current images minus the removed ones, then add the new ones.
        $removed = (array) $request->input('remove_images', []);
        $kept = array_values(array_diff((array) $ad->image_path, $removed));
        $uploads = (array) $request->file('images', []);
        $picks = array_filter((array) $request->input('library_images', []));

        // Check before saving any file, so a rejected form leaves nothing behind.
        $newCount = count($uploads) + count($picks);
        $total = $mediaType === 'image' ? min(1, $newCount + count($kept)) : $newCount + count($kept);
        $isActive = $request->boolean('is_active');
        if ($isActive && $total === 0) {
            throw ValidationException::withMessages(['images' => 'Add an image before enabling the ad.']);
        }
        if ($isActive && $mediaType === 'slider' && $total < 2) {
            throw ValidationException::withMessages(['images' => 'A slider needs at least 2 images.']);
        }

        $added = [];
        foreach ($uploads as $file) {
            $added[] = $this->moveUploadedImage($file, PageAdvertisement::FOLDER);
        }
        $added = array_merge($added, $this->pickedLibraryImages($request, 'images', PageAdvertisement::FOLDER));

        // A single image: a newly added one replaces the old one.
        $images = $mediaType === 'image'
            ? array_slice($added ?: $kept, 0, 1)
            : array_values(array_unique(array_merge($kept, $added)));

        $ad->update([
            'media_type' => $mediaType,
            'image_path' => $images,
            'offer_id' => $request->input('offer_id') ?: null,
            // The linked offer wins; the custom link is only kept when no offer is chosen.
            'link_url' => $request->input('offer_id') ? null : ($request->input('link_url') ?: null),
            'is_active' => $isActive,
        ]);

        return redirect()->route('page-ads.index')->with('flash_success', 'Successfully Saved!');
    }
}
