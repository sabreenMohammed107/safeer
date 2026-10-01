<?php

namespace App\Http\Controllers;

use App\Support\ServerImageLibrary;

class ImageLibraryController extends Controller
{
    /**
     * The "choose from server" grid, fetched by the image-library modal the
     * first time it is opened. Rendering it into every admin page instead
     * meant scanning all of public/uploads on each page load.
     */
    public function index()
    {
        return view('admin.partials.image-library-items', [
            'libraryImages' => ServerImageLibrary::images(),
        ]);
    }
}
