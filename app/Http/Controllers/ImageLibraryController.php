<?php

namespace App\Http\Controllers;

use App\Support\ServerImageLibrary;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class ImageLibraryController extends Controller
{
    private const PER_PAGE = 24;

    /**
     * One page of the "choose from server" grid (newest first), fetched by the
     * image-library modal when it opens, on "Load more", and on search.
     *
     * The folder scan is cached briefly so paging and typing in the search box
     * don't rescan public/uploads on every request; a new upload shows up in
     * the library within a minute.
     */
    public function index(Request $request)
    {
        $page = max(1, (int) $request->query('page', 1));
        $term = mb_strtolower(trim((string) $request->query('q', '')));

        $images = Cache::remember('server-image-library', 60, fn () => ServerImageLibrary::images());

        if ($term !== '') {
            $images = array_values(array_filter(
                $images,
                fn ($image) => str_contains(mb_strtolower($image['name']), $term)
            ));
        }

        $total = count($images);
        $offset = ($page - 1) * self::PER_PAGE;

        return response()->json([
            'html' => view('admin.partials.image-library-items', [
                'libraryImages' => array_slice($images, $offset, self::PER_PAGE),
            ])->render(),
            'total' => $total,
            'has_more' => $offset + self::PER_PAGE < $total,
        ]);
    }
}
