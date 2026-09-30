<?php

namespace App\Http\Controllers\Concerns;

use App\Support\ServerImageLibrary;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;

/**
 * Controller side of the admin image picker (admin.partials.image-picker).
 *
 * For a file input named "{field}", the picker posts the chosen server image
 * as "library_{field}" — a path relative to public/uploads. A newly uploaded
 * file always wins over a library pick.
 */
trait PicksServerImages
{
    /**
     * Filename to store for a single-image field picked from the library,
     * or null when nothing (valid) was picked.
     */
    protected function pickedLibraryImage(Request $request, string $field, string $folder): ?string
    {
        $path = $request->input('library_' . $field);

        return is_string($path) && $path !== '' ? ServerImageLibrary::pick($path, $folder) : null;
    }

    /**
     * Filenames to store for a multiple-image field ("files[]") picked from the library.
     *
     * @return string[]
     */
    protected function pickedLibraryImages(Request $request, string $field, string $folder): array
    {
        $names = [];
        foreach ((array) $request->input('library_' . $field, []) as $path) {
            if (is_string($path) && $path !== '' && ($name = ServerImageLibrary::pick($path, $folder))) {
                $names[] = $name;
            }
        }

        return array_values(array_unique($names));
    }

    /**
     * New upload (saved as "{time}_{original name}") or library pick, or null
     * to keep the current value. For modules without their own upload helper.
     */
    protected function resolveImage(Request $request, string $folder, string $field = 'image'): ?string
    {
        if ($request->hasFile($field)) {
            return $this->moveUploadedImage($request->file($field), $folder);
        }

        return $this->pickedLibraryImage($request, $field, $folder);
    }

    protected function moveUploadedImage(UploadedFile $file, string $folder): string
    {
        $imageName = time() . '_' . $file->getClientOriginalName();
        $file->move(public_path('uploads/' . $folder), $imageName);

        return $imageName;
    }
}
