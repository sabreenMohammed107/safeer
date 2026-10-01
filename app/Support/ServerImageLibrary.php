<?php

namespace App\Support;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\File;
use Symfony\Component\Finder\Finder;

/**
 * The admin "choose from server" image library: lists reusable images under
 * public/uploads and copies a picked one into the folder of the module using it.
 *
 * The database keeps storing only the bare filename, and every module keeps
 * reading it from its own folder (e.g. uploads/teams/{image}). So when the
 * admin picks an image that lives in another module's folder, it is copied
 * into this module's folder first — no schema or display changes needed.
 */
class ServerImageLibrary
{
    /**
     * Folders under public/uploads that hold customer documents (passports,
     * personal photos, payment receipts). They must never be listed in, or
     * picked from, the library — at any depth.
     */
    public const PRIVATE_FOLDERS = ['visas', 'visa-leads', 'orders'];

    public const EXTENSIONS = ['jpg', 'jpeg', 'png', 'gif', 'webp'];

    /**
     * All pickable images under public/uploads, newest first.
     *
     * @return array<int, array{path: string, name: string, url: string}>
     */
    public static function images(): array
    {
        $root = public_path('uploads');
        if (!File::isDirectory($root)) {
            return [];
        }

        // Private folders (customer documents) are skipped while walking, not
        // filtered afterwards, so they cost nothing however large they grow.
        $files = Finder::create()->files()->in($root)->exclude(static::PRIVATE_FOLDERS)->ignoreDotFiles(true);

        $images = [];
        foreach ($files as $file) {
            $path = str_replace('\\', '/', $file->getRelativePathname());

            if (!static::isPickable($path)) {
                continue;
            }

            try {
                $mtime = $file->getMTime();
            } catch (\RuntimeException $e) {
                // Deleted while we were listing (on Windows it can linger in the
                // listing until its last handle closes) — just leave it out.
                continue;
            }

            $images[] = [
                'path' => $path,
                'name' => $file->getFilename(),
                'url' => static::publicUrl('uploads/' . $path),
                'mtime' => $mtime,
            ];
        }

        usort($images, fn ($a, $b) => $b['mtime'] <=> $a['mtime']);

        return array_map(function ($image) {
            unset($image['mtime']);
            return $image;
        }, $images);
    }

    /**
     * images(), cached until something under public/uploads changes.
     *
     * Rescanning every file is slow on a big uploads folder, so the list is
     * kept indefinitely and rebuilt only when the folders' fingerprint changes:
     * a folder's mtime changes whenever a file is added to or removed from it,
     * and checking a few dozen folder mtimes is near-instant. A daily rebuild
     * also catches files replaced in place under the same name.
     */
    public static function cachedImages(): array
    {
        $cached = Cache::get('server-image-library.v3');

        if (is_array($cached)
            && time() - ($cached['built_at'] ?? 0) < 86400
            && static::foldersFingerprint($cached['dirs']) === $cached['fingerprint']) {
            return $cached['images'];
        }

        $images = static::images();
        $dirs = static::watchedFolders($images);
        Cache::forever('server-image-library.v3', [
            'dirs' => $dirs,
            'fingerprint' => static::foldersFingerprint($dirs),
            'built_at' => time(),
            'images' => $images,
        ]);

        return $images;
    }

    /**
     * Folders whose mtime tells us the list may be stale: public/uploads, its
     * top-level folders, and every folder that holds a library image. A new
     * folder anywhere changes the mtime of its parent, which is one of these.
     */
    private static function watchedFolders(array $images): array
    {
        $root = public_path('uploads');
        $dirs = [$root => true];
        foreach (glob($root . '/*', GLOB_ONLYDIR) ?: [] as $dir) {
            if (!in_array(basename($dir), static::PRIVATE_FOLDERS, true)) {
                $dirs[$dir] = true;
            }
        }
        foreach ($images as $image) {
            $dirs[dirname($root . '/' . $image['path'])] = true;
        }

        return array_keys($dirs);
    }

    /** Hash of the given folders' mtimes. */
    private static function foldersFingerprint(array $dirs): string
    {
        clearstatcache();
        $parts = [];
        foreach ($dirs as $dir) {
            $parts[] = $dir . '=' . @filemtime($dir);
        }

        return md5(implode('|', $parts));
    }

    /**
     * Make a library image available in the given module folder and return
     * the filename to store, or null if the path is not a pickable image.
     *
     * @param string $path   Path relative to public/uploads, e.g. "blogs/blog-1.webp".
     * @param string $folder Module folder under public/uploads, e.g. "teams".
     */
    public static function pick(string $path, string $folder): ?string
    {
        $path = ltrim(str_replace('\\', '/', $path), '/');
        if (!static::isPickable($path)) {
            return null;
        }

        // realpath() both confirms the file exists and defeats "../" tricks.
        $root = realpath(public_path('uploads'));
        $source = realpath(public_path('uploads/' . $path));
        if ($root === false || $source === false || !str_starts_with($source, $root . DIRECTORY_SEPARATOR) || !is_file($source)) {
            return null;
        }

        $targetDir = public_path('uploads/' . $folder);
        $name = basename($source);

        // Already in this module's folder: just reference it.
        if (realpath(dirname($source)) === realpath($targetDir)) {
            return $name;
        }

        File::ensureDirectoryExists($targetDir);

        $target = $targetDir . DIRECTORY_SEPARATOR . $name;
        if (File::exists($target) && md5_file($target) !== md5_file($source)) {
            // A different file already uses this name here; don't overwrite it.
            $name = time() . '_' . $name;
            $target = $targetDir . DIRECTORY_SEPARATOR . $name;
        }

        if (!File::exists($target)) {
            File::copy($source, $target);
        }

        return $name;
    }

    /**
     * URL of a small WebP thumbnail for a library image (relative to
     * public/uploads), created on first request and reused afterwards. The
     * library grid shows these instead of the full-size originals. Falls back
     * to the original if the thumbnail can't be made.
     *
     * Thumbnails live in public/uploads-thumbs, outside public/uploads, so
     * they never show up in the library themselves. The name includes the
     * source's size and mtime, so a replaced image gets a fresh thumbnail.
     */
    public const THUMB_WIDTH = 240;

    /**
     * Site-relative URL ("/safeer/public/uploads/...") for a file under public/.
     * Relative, so it works whether the admin is served over http or https
     * (asset() can produce http:// links behind an https proxy).
     */
    public static function publicUrl(string $relative): string
    {
        static $base = null;
        if ($base === null) {
            $base = rtrim((string) parse_url(asset(''), PHP_URL_PATH), '/');
        }

        return $base . '/' . ltrim($relative, '/');
    }

    /**
     * Where the thumbnail for a library image (path relative to public/uploads)
     * lives, or null if the source is gone. Thumbnails sit in
     * public/uploads-thumbs, outside public/uploads, so they never appear in the
     * library themselves; the name includes the source's size and mtime so a
     * replaced image gets a fresh one.
     */
    public static function thumbTarget(string $path): ?string
    {
        $source = public_path('uploads/' . $path);
        if (!is_file($source)) {
            return null;
        }

        $name = md5($path . '|' . filesize($source) . '|' . filemtime($source) . '|' . static::THUMB_WIDTH) . '.webp';

        return public_path('uploads-thumbs/' . $name);
    }

    /**
     * URL for a library image's thumbnail: the static file once it exists,
     * otherwise the route that creates it. Scheme and host are dropped (but
     * not a subfolder like /safeer/public, which route(..., false) would lose).
     */
    public static function thumbSrc(string $path): string
    {
        return static::existingThumbUrl($path)
            ?? preg_replace('#^https?://[^/]+#i', '', route('admin.image-library.thumb', ['path' => $path]));
    }

    /** URL of an already-generated thumbnail, or null if it doesn't exist yet. */
    public static function existingThumbUrl(string $path): ?string
    {
        $target = static::thumbTarget($path);

        return $target && is_file($target) ? static::publicUrl('uploads-thumbs/' . basename($target)) : null;
    }

    /**
     * Create the thumbnail if needed and return its file path, or null if this
     * image can't be thumbnailed (the caller then shows the original). Runs in
     * its own small request per image, so one bad image can't break the list.
     */
    public static function ensureThumb(string $path): ?string
    {
        $target = static::thumbTarget($path);
        if (!$target) {
            return null;
        }
        if (is_file($target) || static::makeThumb(public_path('uploads/' . $path), $target, static::THUMB_WIDTH)) {
            return $target;
        }

        return null;
    }

    private static function makeThumb(string $source, string $target, int $width): bool
    {
        // GD decode errors are *fatal* (not catchable), so everything that can
        // trip one is checked first. Many uploads have the wrong extension
        // (PNG/JPEG renamed to .webp), so the decoder follows the real file
        // type from its header, never the extension.
        $info = @getimagesize($source);
        if (!$info || empty($info[0]) || empty($info[1])) {
            return false;
        }
        // Running out of memory is a fatal error too, so skip images whose
        // decoded size (~5 bytes per pixel in GD) wouldn't fit in what's left.
        if (!static::fitsInMemory($info[0] * $info[1] * 5)) {
            return false;
        }
        if (!function_exists('imagewebp')) {
            return false;
        }
        if ($info[2] === IMAGETYPE_WEBP && static::isAnimatedWebp($source)) {
            return false;
        }

        try {
            $image = match ($info[2]) {
                IMAGETYPE_JPEG => @imagecreatefromjpeg($source),
                IMAGETYPE_PNG => @imagecreatefrompng($source),
                IMAGETYPE_GIF => @imagecreatefromgif($source),
                IMAGETYPE_WEBP => @imagecreatefromwebp($source),
                default => false,
            };
            if (!$image) {
                return false;
            }

            if (imagesx($image) > $width) {
                $scaled = imagescale($image, $width);
                imagedestroy($image);
                $image = $scaled;
            }
            imagepalettetotruecolor($image);
            imagealphablending($image, true);
            imagesavealpha($image, true);

            File::ensureDirectoryExists(dirname($target));
            $ok = imagewebp($image, $target, 70);
            imagedestroy($image);

            return $ok;
        } catch (\Throwable $e) {
            return false;
        }
    }

    private static function fitsInMemory(int $bytes): bool
    {
        $limit = trim((string) ini_get('memory_limit'));
        if ($limit === '' || $limit === '-1') {
            return true;
        }
        $value = (int) $limit;
        switch (strtolower(substr($limit, -1))) {
            case 'g': $value *= 1024;
            // no break
            case 'm': $value *= 1024;
            // no break
            case 'k': $value *= 1024;
        }

        // Keep ~16MB headroom for the rest of the request.
        return memory_get_usage(true) + $bytes + 16 * 1024 * 1024 < $value;
    }

    /** Animated WebP: VP8X header with the animation flag set (GD can't read these). */
    private static function isAnimatedWebp(string $source): bool
    {
        $header = (string) @file_get_contents($source, false, null, 0, 21);

        return strlen($header) === 21
            && substr($header, 12, 4) === 'VP8X'
            && (ord($header[20]) & 0x02) === 0x02;
    }

    public static function isPickable(string $path): bool
    {
        if ($path === '' || str_contains($path, '..')) {
            return false;
        }

        // Check every directory segment, so nested copies (uploads/uploads/visas/...) stay hidden too.
        $folders = array_slice(explode('/', $path), 0, -1);
        if (array_intersect($folders, static::PRIVATE_FOLDERS)) {
            return false;
        }

        return in_array(strtolower(pathinfo($path, PATHINFO_EXTENSION)), static::EXTENSIONS, true);
    }
}
