<?php

namespace App\Http\Controllers;

use App\Support\ServerImageLibrary;
use Illuminate\Http\Request;
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
     * broken or huge upload can't make the list fail. The file list is a
     * per-folder cache refreshed only where folders changed, with a time budget
     * (see ServerImageLibrary::index()), so a request never scans everything.
     */
    public function index(Request $request)
    {
        try {
            $started = microtime(true);
            $offset = max(0, (int) $request->query('offset', 0));
            $limit = $offset === 0 ? self::FIRST_BATCH : self::MORE_BATCH;
            $term = mb_strtolower(trim((string) $request->query('q', '')));

            // Time-boxed so a slow uploads folder can't run into PHP's time limit.
            $index = ServerImageLibrary::index(15.0);
            $images = $index['images'];
            $indexed = microtime(true);

            if ($term !== '') {
                $images = array_values(array_filter(
                    $images,
                    fn ($image) => str_contains(mb_strtolower($image['name']), $term)
                ));
            }

            $total = count($images);
            $html = view('admin.partials.image-library-items', [
                'libraryImages' => array_slice($images, $offset, $limit),
            ])->render();
            $rendered = microtime(true);

            // Where the time went, visible in DevTools > Network > (request) > Timing.
            // "boot" = Laravel start-up before this method; a long wait that isn't
            // in any of these is the server queueing the request before PHP ran.
            $ms = fn ($from, $to) => round(($to - $from) * 1000, 1);
            $timing = [
                'boot' => defined('LARAVEL_START') ? $ms(LARAVEL_START, $started) : 0,
                'index' => $ms($started, $indexed),
                'render' => $ms($indexed, $rendered),
            ];
            $stats = $index['stats'];
            if (array_sum($timing) > 3000) {
                Log::warning('Image library request was slow', $timing + $stats + ['images' => $total]);
            }

            return response()->json([
                'html' => $html,
                'total' => $total,
                'has_more' => $offset + $limit < $total,
                'complete' => $index['complete'],
            ])->header('Server-Timing', implode(', ', [
                "boot;dur={$timing['boot']}",
                "index;dur={$timing['index']};desc=\"cache {$stats['cache']}, {$stats['folders']} folders, {$stats['rescanned']} re-read\"",
                "render;dur={$timing['render']}",
            ]));
        } catch (\Throwable $e) {
            Log::error('Image library listing failed', ['exception' => $e]);

            // Admin-only endpoint: show the real reason instead of a bare 500.
            return response()->json(['message' => 'Could not load the images: ' . $e->getMessage()], 500);
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
