<?php

namespace App\Support;

use Illuminate\Support\Facades\File;

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

        $images = [];
        foreach (File::allFiles($root) as $file) {
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
                'url' => asset('uploads/' . $path),
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
