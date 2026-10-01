<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;

/*
|--------------------------------------------------------------------------
| Console Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of your Closure based console
| commands. Each Closure is bound to a command instance allowing a
| simple approach to interacting with each command's IO methods.
|
*/

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');

// Build the admin "choose from server" image list and create every thumbnail
// ahead of time, so the first person to open the library doesn't wait for it.
// Safe to run any time (e.g. after a deploy or a bulk upload); existing
// thumbnails are reused.
Artisan::command('image-library:warm', function () {
    $images = \App\Support\ServerImageLibrary::cachedImages();
    $this->info(count($images) . ' images listed.');

    $made = 0;
    $failed = 0;
    $this->withProgressBar($images, function ($image) use (&$made, &$failed) {
        \App\Support\ServerImageLibrary::ensureThumb($image['path']) ? $made++ : $failed++;
    });
    $this->newLine();
    $this->info("Thumbnails ready: {$made}" . ($failed ? ", shown as originals: {$failed}" : ''));
})->purpose('Pre-build the admin image library list and thumbnails');
