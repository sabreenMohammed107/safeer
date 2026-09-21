<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use App\Models\Company;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Str;
use League\CommonMark\CommonMarkConverter;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

class PolicyController extends Controller
{
    /**
     * Stable, order-based anchors for the 4 top-level sections that
     * policies.en.md / policies.ar.md are expected to contain, so footer
     * links keep working even though the heading text differs per locale.
     */
    private const SECTION_SLUGS = [
        'shipping-policies',
        'exchange-return-policy',
        'terms-of-service',
        'privacy-policy',
    ];

    public function show(?string $slug = null)
    {
        $locale = LaravelLocalization::getCurrentLocale() === 'ar' ? 'ar' : 'en';
        $path = base_path("policies.{$locale}.md");

        $sections = Cache::remember(
            "policies.sections.{$locale}." . (is_file($path) ? filemtime($path) : 0),
            now()->addHour(),
            fn () => $this->parseSections($path)
        );

        $Company = Company::first();
        $BreadCrumb = [["url" => "/", "name" => Lang::get('links.home')]];

        return view('website.policies', [
            'Company' => $Company,
            'BreadCrumb' => $BreadCrumb,
            'sections' => $sections,
            'activeSlug' => in_array($slug, self::SECTION_SLUGS, true) ? $slug : null,
        ]);
    }

    private function parseSections(string $path): array
    {
        if (! is_file($path)) {
            return [];
        }

        $markdown = file_get_contents($path);

        preg_match_all('/^##\s+(.+)$/m', $markdown, $headingMatches, PREG_OFFSET_CAPTURE);
        $bodies = preg_split('/^##\s+.+$/m', $markdown);
        array_shift($bodies);

        $converter = new CommonMarkConverter([
            'html_input' => 'escape',
            'allow_unsafe_links' => false,
        ]);

        $sections = [];

        foreach ($headingMatches[1] as $index => $match) {
            $heading = trim(preg_replace('/^\d+\.\s*/', '', $match[0]));
            $slug = self::SECTION_SLUGS[$index] ?? Str::slug($heading);
            $body = $bodies[$index] ?? '';

            $sections[] = [
                'slug' => $slug,
                'title' => $heading,
                'html' => (string) $converter->convert(trim($body)),
            ];
        }

        return $sections;
    }
}
