<?php

namespace App\View\Components\Website;

use App\Models\PageAdvertisement;
use Illuminate\View\Component;

/**
 * The admin-managed promotional banner of a page:
 *
 *   <x-website.page-ad page="offers" />                  sidebar poster
 *   <x-website.page-ad page="visa" layout="banner" />    wide feature banner
 *
 * Renders nothing at all when the page's ad is disabled or has no image.
 */
class PageAd extends Component
{
    /** Per-page heading + icon, so each page's ad matches its theme. */
    private const THEMES = [
        'offers' => ['icon' => 'fa-tags', 'title' => 'ad_offers_title', 'text' => 'ad_offers_text'],
        'visa' => ['icon' => 'fa-passport', 'title' => 'ad_visa_title', 'text' => 'ad_visa_text'],
        'transport' => ['icon' => 'fa-car-side', 'title' => 'ad_transport_title', 'text' => 'ad_transport_text'],
    ];

    public ?PageAdvertisement $ad;
    public string $page;
    public string $layout;
    public array $theme;

    public function __construct(string $page, string $layout = 'poster')
    {
        $this->page = $page;
        $this->layout = $layout === 'banner' ? 'banner' : 'poster';
        $this->theme = self::THEMES[$page] ?? self::THEMES['offers'];
        $this->ad = PageAdvertisement::visibleOn($page);
    }

    public function shouldRender()
    {
        return $this->ad !== null;
    }

    public function render()
    {
        return view('components.website.page-ad');
    }
}
