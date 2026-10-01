<?php

namespace App\Http\Controllers;

use App\Support\ServerImageLibrary;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;

class ImageLibraryController extends Controller
{
    // First batch is small so the modal fills fast; "Load more" adds the rest in steps.
    private const FIRST_BATCH = 6;
    private const MORE_BATCH = 10;

    /**
     * One batch of the "choose from server" grid (newest first), fetched by the
     * image-library modal when it opens (first 6), on "Load more" (10 more each
     * time, from `offset` = how many are already shown), and on search.
     *
     * Only lists files: no image decoding happens here (see thumb()), so a
     * broken or huge upload can't make the list fail. The file list is cached
     * until an upload folder changes (see ServerImageLibrary::cachedImages()),
     * so opening the library doesn't rescan public/uploads each time.
     */
    public function index(Request $request)
    {
        try {
            $offset = max(0, (int) $request->query('offset', 0));
            $limit = $offset === 0 ? self::FIRST_BATCH : self::MORE_BATCH;
            $term = mb_strtolower(trim((string) $request->query('q', '')));

            $images = ServerImageLibrary::cachedImages();

            if ($term !== '') {
                $images = array_values(array_filter(
                    $images,
                    fn ($image) => str_contains(mb_strtolower($image['name']), $term)
                ));
            }

            $total = count($images);

            return response()->json([
                'html' => view('admin.partials.image-library-items', [
                    'libraryImages' => array_slice($images, $offset, $limit),
                ])->render(),
                'total' => $total,
                'has_more' => $offset + $limit < $total,
            ]);
        } catch (\Throwable $e) {
            Log::error('Image library listing failed', ['exception' => $e]);

            return response()->json(['message' => 'Could not load the images.'], 500);
        }
    }

    /**
     * Thumbnail of one library image, created on first request. The grid
     * points here only for images whose thumbnail doesn't exist yet; once
     * made, the grid links the static file directly. Anything that can't be
     * thumbnailed falls back to the original image.
     */
    public function thumb(Request $request)
    {
        $path = ltrim(str_replace('\\', '/', (string) $request->query('path', '')), '/');
        if (!ServerImageLibrary::isPickable($path) || !is_file(public_path('uploads/' . $path))) {
            abort(404);
        }

        try {
            $thumb = ServerImageLibrary::ensureThumb($path);
        } catch (\Throwable $e) {
            Log::warning('Image library thumbnail failed', ['path' => $path, 'exception' => $e]);
            $thumb = null;
        }

        if (!$thumb) {
            return redirect(ServerImageLibrary::publicUrl('uploads/' . $path));
        }

        return response()->file($thumb, [
            'Content-Type' => 'image/webp',
            'Cache-Control' => 'public, max-age=604800',
        ]);
    }
}
