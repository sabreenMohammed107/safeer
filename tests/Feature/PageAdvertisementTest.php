<?php

namespace Tests\Feature;

use App\Models\City;
use App\Models\Offer;
use App\Models\PageAdvertisement;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Schema;
use Tests\TestCase;

/**
 * The admin-managed promotional banner of the offers / visa / transport pages:
 * admin editing (images, slider, link, on/off) and conditional rendering.
 */
class PageAdvertisementTest extends TestCase
{
    use DatabaseTransactions;

    /** Prefix of every file this test uploads, so tearDown can remove them. */
    private const FILE_PREFIX = 'zz-ad-test';

    /** Public page URL per ad page. */
    private const PAGE_URLS = ['offers' => '/offers', 'visa' => '/visa', 'transport' => '/transfers'];

    protected function setUp(): void
    {
        parent::setUp();

        $database = config('database.connections.mysql.database');
        if ($database !== 'safer_testing') {
            $this->fail("Refusing to run: expected DB connection 'safer_testing', got '{$database}'. Check .env.testing is being loaded.");
        }
    }

    protected function tearDown(): void
    {
        File::delete(File::glob(public_path('uploads/' . PageAdvertisement::FOLDER . '/*' . self::FILE_PREFIX . '*')));

        parent::tearDown();
    }

    private function actingAsAdmin(): self
    {
        return $this->actingAs(User::create([
            'name' => 'Admin',
            'email' => 'page_ads_' . uniqid() . '@example.com',
            'password' => bcrypt('password'),
            'type' => 1,
        ]));
    }

    private function image(string $name = '1'): UploadedFile
    {
        return UploadedFile::fake()->image(self::FILE_PREFIX . "-{$name}.png", 70, 100);
    }

    /** An ad that's live on a page, with files that exist on disk. */
    private function liveAd(string $page, array $attributes = []): PageAdvertisement
    {
        $ad = PageAdvertisement::forPage($page);
        $names = [];
        foreach ($attributes['images'] ?? ['1'] as $name) {
            $file = self::FILE_PREFIX . "-{$page}-{$name}.png";
            File::ensureDirectoryExists(public_path('uploads/ads'));
            File::put(public_path('uploads/ads/' . $file), $this->image()->get());
            $names[] = $file;
        }
        unset($attributes['images']);
        $ad->update($attributes + ['image_path' => $names, 'is_active' => true, 'media_type' => 'image', 'offer_id' => null, 'link_url' => null]);

        return $ad->fresh();
    }

    private function makeOffer(string $title): Offer
    {
        return Offer::create([
            'subtitle_en' => $title,
            'city_id' => City::create(['en_city' => 'Ad City', 'ar_city' => 'Ad City'])->id,
            'active' => 1,
            'status' => 'basic',
            'start_date' => now()->subDay(),
            'end_date' => now()->addMonth(),
        ]);
    }

    private function adMarkup(string $html, string $page): string
    {
        $marker = strpos($html, 'data-page-ad="' . $page . '"');
        $this->assertNotFalse($marker, "the {$page} ad is on the page");
        $start = strrpos(substr($html, 0, $marker), '<aside');

        return substr($html, $start, strpos($html, '</aside>', $marker) - $start);
    }

    // --- Database -------------------------------------------------------------

    public function test_the_table_exists_with_one_row_per_page()
    {
        $this->assertTrue(Schema::hasColumns('page_advertisements', [
            'id', 'page_type', 'media_type', 'image_path', 'offer_id', 'link_url', 'is_active', 'created_at', 'updated_at',
        ]));

        foreach (array_keys(PageAdvertisement::PAGES) as $page) {
            $this->assertSame($page, PageAdvertisement::forPage($page)->page_type);
        }
        $this->assertSame(3, PageAdvertisement::count());
    }

    // --- Admin ----------------------------------------------------------------

    public function test_admin_pages_require_login()
    {
        $this->get(route('page-ads.index'))->assertRedirect();
        $this->get(route('page-ads.edit', 'visa'))->assertRedirect();
    }

    public function test_admin_index_lists_the_three_pages_with_their_status()
    {
        $this->liveAd('visa');
        PageAdvertisement::forPage('offers')->update(['is_active' => false]);

        $html = $this->actingAsAdmin()->get(route('page-ads.index'))->assertOk()->getContent();

        foreach (['offers', 'visa', 'transport'] as $page) {
            $this->assertStringContainsString('data-page="' . $page . '"', $html);
            $this->assertStringContainsString(route('page-ads.edit', $page), $html);
        }
        $this->assertStringContainsString('page-ad-status">Enabled</span>', $html);
        $this->assertStringContainsString('page-ad-status">Disabled</span>', $html);
    }

    public function test_only_the_three_pages_can_be_edited()
    {
        $this->actingAsAdmin();

        foreach (['offers', 'visa', 'transport'] as $page) {
            $this->get(route('page-ads.edit', $page))
                ->assertOk()
                ->assertSee('name="images[]"', false)
                ->assertSee('name="offer_id"', false)
                ->assertSee('name="link_url"', false)
                ->assertSee('700 × 1000');
        }

        $this->get('/dashboard/page-ads/hotels/edit')->assertNotFound();
        $this->put('/dashboard/page-ads/hotels', [])->assertNotFound();
    }

    public function test_admin_uploads_an_image_links_an_offer_and_enables_the_ad()
    {
        $offer = $this->makeOffer('Linked Ad Offer');

        $this->actingAsAdmin()->put(route('page-ads.update', 'offers'), [
            'is_active' => '1',
            'media_type' => 'image',
            'images' => [$this->image('a')],
            'offer_id' => $offer->id,
            'link_url' => 'https://example.com/ignored',
        ])->assertRedirect(route('page-ads.index'));

        $ad = PageAdvertisement::forPage('offers');
        $this->assertTrue($ad->is_active);
        $this->assertCount(1, $ad->image_path);
        $this->assertStringEndsWith(self::FILE_PREFIX . '-a.png', $ad->image_path[0]);
        $this->assertFileExists(public_path('uploads/ads/' . $ad->image_path[0]));
        $this->assertSame($offer->id, $ad->offer_id);
        // The linked offer wins over the custom link.
        $this->assertNull($ad->link_url);
    }

    public function test_a_new_single_image_replaces_the_old_one()
    {
        $this->liveAd('visa', ['images' => ['old']]);

        $this->actingAsAdmin()->put(route('page-ads.update', 'visa'), [
            'is_active' => '1',
            'media_type' => 'image',
            'images' => [$this->image('new')],
        ])->assertRedirect();

        $images = PageAdvertisement::forPage('visa')->image_path;
        $this->assertCount(1, $images);
        $this->assertStringEndsWith(self::FILE_PREFIX . '-new.png', $images[0]);
    }

    public function test_a_slider_keeps_adds_and_removes_images()
    {
        $ad = $this->liveAd('transport', ['images' => ['1', '2'], 'media_type' => 'slider']);
        [$first, $second] = $ad->image_path;

        $this->actingAsAdmin()->put(route('page-ads.update', 'transport'), [
            'is_active' => '1',
            'media_type' => 'slider',
            'images' => [$this->image('3')],
            'remove_images' => [$first],
            'link_url' => 'https://example.com/transfers-deal',
        ])->assertRedirect();

        $ad = PageAdvertisement::forPage('transport');
        $this->assertCount(2, $ad->image_path);
        $this->assertSame($second, $ad->image_path[0]);
        $this->assertStringEndsWith(self::FILE_PREFIX . '-3.png', $ad->image_path[1]);
        $this->assertSame('https://example.com/transfers-deal', $ad->link_url);
    }

    public function test_an_ad_cannot_be_enabled_without_enough_images()
    {
        $this->actingAsAdmin();
        PageAdvertisement::forPage('visa')->update(['image_path' => [], 'is_active' => false]);

        $this->put(route('page-ads.update', 'visa'), ['is_active' => '1', 'media_type' => 'image'])
            ->assertSessionHasErrors(['images' => 'Add an image before enabling the ad.']);

        $this->put(route('page-ads.update', 'visa'), ['is_active' => '1', 'media_type' => 'slider', 'images' => [$this->image('only')]])
            ->assertSessionHasErrors(['images' => 'A slider needs at least 2 images.']);

        $this->assertFalse(PageAdvertisement::forPage('visa')->is_active);
        // Nothing was saved for the rejected slider.
        $this->assertEmpty(File::glob(public_path('uploads/ads/*' . self::FILE_PREFIX . '-only.png')));

        // Saving it disabled (and empty) is fine.
        $this->put(route('page-ads.update', 'visa'), ['is_active' => '0', 'media_type' => 'image'])
            ->assertRedirect(route('page-ads.index'));
    }

    public function test_admin_rejects_bad_input()
    {
        $this->actingAsAdmin()->put(route('page-ads.update', 'offers'), [
            'media_type' => 'video',
            'offer_id' => 999999999,
            'link_url' => 'not a url',
            'images' => [UploadedFile::fake()->create(self::FILE_PREFIX . '.pdf', 10, 'application/pdf')],
        ])->assertSessionHasErrors(['media_type', 'offer_id', 'link_url', 'images.0']);
    }

    // --- Website ----------------------------------------------------------------

    public function test_nothing_renders_when_the_ad_is_disabled_or_has_no_image()
    {
        foreach (self::PAGE_URLS as $page => $url) {
            PageAdvertisement::forPage($page)->update(['is_active' => false, 'image_path' => ['x.png']]);
            $this->get($url)->assertOk()->assertDontSee('data-page-ad', false)->assertDontSee('page-ads.css', false);

            PageAdvertisement::forPage($page)->update(['is_active' => true, 'image_path' => []]);
            $this->get($url)->assertOk()->assertDontSee('data-page-ad', false);
        }
    }

    public function test_each_page_shows_its_ad_in_its_own_style()
    {
        $this->liveAd('offers');
        $this->liveAd('visa');
        $this->liveAd('transport');

        $offers = $this->adMarkup($this->get('/offers')->assertOk()->getContent(), 'offers');
        $this->assertStringContainsString('page_ad--poster page_ad--offers', $offers);

        $visa = $this->adMarkup($this->get('/visa')->assertOk()->getContent(), 'visa');
        $this->assertStringContainsString('page_ad--banner page_ad--visa', $visa);
        $this->assertStringContainsString(__('links.ad_visa_title'), $visa);

        $transfers = $this->get('/transfers')->assertOk()->getContent();
        $this->assertStringContainsString('page_ad--poster page_ad--transport', $this->adMarkup($transfers, 'transport'));
        // Stylesheet and slider script only once, even with the extra mobile copy.
        $this->assertSame(1, substr_count($transfers, 'page-ads.css'));
    }

    public function test_clicking_the_ad_opens_the_linked_offer()
    {
        $offer = $this->makeOffer('Clickable Ad Offer');
        $this->liveAd('offers', ['offer_id' => $offer->id]);

        $ad = $this->adMarkup($this->get('/offers')->assertOk()->getContent(), 'offers');

        $this->assertStringContainsString('href="' . url('/single-offer/' . $offer->id . '/' . $offer->slug) . '"', $ad);
        $this->assertStringNotContainsString('target="_blank"', $ad);
    }

    public function test_a_custom_external_link_opens_in_a_new_tab()
    {
        $this->liveAd('visa', ['link_url' => 'https://partner.example.com/visa-deal']);

        $ad = $this->adMarkup($this->get('/visa')->assertOk()->getContent(), 'visa');

        $this->assertStringContainsString('href="https://partner.example.com/visa-deal" target="_blank" rel="noopener sponsored"', $ad);
        $this->assertStringContainsString('class="page_ad__cta"', $ad);
    }

    public function test_an_ad_without_a_link_is_not_clickable()
    {
        $this->liveAd('visa');

        $ad = $this->adMarkup($this->get('/visa')->assertOk()->getContent(), 'visa');

        $this->assertStringNotContainsString('href=', $ad);
        $this->assertStringNotContainsString('page_ad__cta', $ad);
    }

    public function test_the_visa_slider_shows_one_poster_at_a_time_with_clear_controls()
    {
        $this->liveAd('visa', ['images' => ['1', '2', '3', '4'], 'media_type' => 'slider']);

        $ad = $this->adMarkup($this->get('/visa')->assertOk()->getContent(), 'visa');

        $this->assertStringContainsString('page_ad--multi', $ad);
        $this->assertSame(1, substr_count($ad, 'class="page_ad__frame"'));
        $this->assertStringContainsString('data-ad-carousel', $ad);
        $this->assertSame(4, substr_count($ad, 'data-ad-slide'));
        $this->assertStringContainsString('data-ad-prev', $ad);
        $this->assertStringContainsString('data-ad-next', $ad);
        $this->assertStringContainsString('<span data-ad-current>1</span> / 4', $ad);
        $this->assertSame(4, substr_count($ad, 'data-ad-dot='));
        // Whole image shown over a blurred copy of itself, never cropped.
        $this->assertStringContainsString("--ad-img: url('", $ad);

        // A single image: no carousel, no controls.
        PageAdvertisement::forPage('visa')->update(['media_type' => 'image']);
        $ad = $this->adMarkup($this->get('/visa')->assertOk()->getContent(), 'visa');
        $this->assertStringContainsString('page_ad--single', $ad);
        $this->assertSame(1, substr_count($ad, 'data-ad-slide'));
        $this->assertStringNotContainsString('data-ad-carousel', $ad);
        $this->assertStringNotContainsString('data-ad-prev', $ad);
        $this->assertStringNotContainsString('data-ad-current', $ad);
    }

    public function test_the_visa_banner_describes_the_linked_offer()
    {
        $offer = $this->makeOffer('Istanbul 6 Days Visa Deal');
        $offer->update(['cost' => 505, 'end_date' => '2026-12-31 23:59:00']);
        $this->liveAd('visa', ['offer_id' => $offer->id]);

        $ad = $this->adMarkup($this->get('/visa')->assertOk()->getContent(), 'visa');

        $this->assertStringContainsString('<h3 class="page_ad__title">Istanbul 6 Days Visa Deal</h3>', $ad);
        $this->assertStringContainsString(money(505), $ad);
        $this->assertStringContainsString('31 Dec 2026', $ad);

        // Without an offer it falls back to the page's own heading.
        PageAdvertisement::forPage('visa')->update(['offer_id' => null]);
        $ad = $this->adMarkup($this->get('/visa')->assertOk()->getContent(), 'visa');
        $this->assertStringContainsString('<h3 class="page_ad__title">' . __('links.ad_visa_title') . '</h3>', $ad);
        $this->assertStringNotContainsString('page_ad__facts', $ad);
    }

    public function test_a_slider_renders_every_image_with_dots()
    {
        $this->liveAd('offers', ['images' => ['1', '2', '3'], 'media_type' => 'slider']);

        $ad = $this->adMarkup($this->get('/offers')->assertOk()->getContent(), 'offers');

        $this->assertStringContainsString('data-ad-carousel', $ad);
        $this->assertSame(3, substr_count($ad, 'data-ad-slide'));
        $this->assertSame(3, substr_count($ad, 'data-ad-dot='));
        $this->assertStringContainsString('<span data-ad-current>1</span> / 3', $ad);

        // As a single image, only the first one shows and there's no slider.
        PageAdvertisement::forPage('offers')->update(['media_type' => 'image']);
        $ad = $this->adMarkup($this->get('/offers')->assertOk()->getContent(), 'offers');
        $this->assertSame(1, substr_count($ad, 'data-ad-slide'));
        $this->assertStringNotContainsString('data-ad-carousel', $ad);
    }
}
