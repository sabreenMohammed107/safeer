<?php

namespace Tests\Feature;

use App\Models\City;
use App\Models\Company;
use App\Models\Offer;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Support\Facades\Schema;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
use Tests\TestCase;

/**
 * Covers the admin-managed `offer_date` (with its created_at fallback) and
 * the public /offers City + Date search filter.
 *
 * Uses DatabaseTransactions against the structure-only `safer_testing`
 * database, same as TourOrderingTest — never migrate:fresh.
 */
class OfferDateAndFilterTest extends TestCase
{
    use DatabaseTransactions;

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
        Carbon::setTestNow();
        parent::tearDown();
    }

    private function makeAdmin(string $email): User
    {
        return User::create([
            'name' => 'Admin',
            'email' => $email,
            'password' => bcrypt('password'),
            'type' => 1, // 1 => "admin" per User::type() accessor
        ]);
    }

    private function makeCity(string $name): City
    {
        return City::create(['en_city' => $name, 'ar_city' => $name]);
    }

    /** A valid start/end pair — required by the admin add & edit forms. */
    private const PERIOD = ['start_date' => '2026-10-01 09:00', 'end_date' => '2026-12-31 23:59'];

    private function makeOffer(string $title, City $city, ?string $date, array $extra = []): Offer
    {
        return Offer::create(array_merge([
            'subtitle_en' => $title,
            'city_id' => $city->id,
            'active' => 1,
            'status' => 'basic',
            'offer_date' => $date,
        ], $extra));
    }

    /**
     * The filtered results grid only — the page's "latest offers" sidebar
     * intentionally ignores the search filters.
     */
    private function resultsGrid(string $url): string
    {
        $html = $this->get($url)->assertOk()->getContent();
        $grid = substr($html, strpos($html, 'id="table_data"'));

        return substr($grid, 0, strpos($grid, 'class="offers_sidebar'));
    }

    public function test_offers_table_has_an_offer_date_column()
    {
        $this->assertTrue(Schema::hasColumn('offers', 'offer_date'));
    }

    // --- Admin: offer_date + created_at fallback ---------------------------

    public function test_admin_can_create_an_offer_with_an_explicit_date()
    {
        $city = $this->makeCity('Admin City');
        $admin = $this->makeAdmin('offer_date_admin1@example.com');

        $this->actingAs($admin)->post(route('offers.store'), [
            'subtitle_en' => 'Dated Offer',
            'city_id' => $city->id,
            'offer_date' => '2026-12-25',
        ] + self::PERIOD)->assertRedirect(route('offers.index'));

        $offer = Offer::where('subtitle_en', 'Dated Offer')->firstOrFail();
        $this->assertSame('2026-12-25', $offer->offer_date->toDateString());
    }

    public function test_admin_creating_an_offer_without_a_date_falls_back_to_created_at()
    {
        Carbon::setTestNow('2026-10-01 23:59:58');
        $city = $this->makeCity('Admin City');
        $admin = $this->makeAdmin('offer_date_admin2@example.com');

        $this->actingAs($admin)->post(route('offers.store'), [
            'subtitle_en' => 'Undated Offer',
            'city_id' => $city->id,
            'offer_date' => '', // empty field as submitted by the form
        ] + self::PERIOD)->assertRedirect(route('offers.index'));

        $offer = Offer::where('subtitle_en', 'Undated Offer')->firstOrFail();
        $this->assertSame('2026-10-01', $offer->offer_date->toDateString());
        $this->assertSame($offer->created_at->toDateString(), $offer->offer_date->toDateString());
    }

    public function test_admin_can_change_an_offer_date()
    {
        $city = $this->makeCity('Admin City');
        $offer = $this->makeOffer('Editable Offer', $city, '2026-11-01');
        $admin = $this->makeAdmin('offer_date_admin3@example.com');

        $this->actingAs($admin)->put(route('offers.update', $offer->id), [
            'subtitle_en' => 'Editable Offer',
            'city_id' => $city->id,
            'offer_date' => '2027-01-15',
        ] + self::PERIOD)->assertRedirect(route('offers.index'));

        $this->assertSame('2027-01-15', $offer->fresh()->offer_date->toDateString());
    }

    public function test_clearing_the_date_on_update_falls_back_to_created_at()
    {
        Carbon::setTestNow('2026-09-20 10:00:00');
        $city = $this->makeCity('Admin City');
        $offer = $this->makeOffer('Cleared Offer', $city, '2026-11-01');
        Carbon::setTestNow('2026-10-01 10:00:00');
        $admin = $this->makeAdmin('offer_date_admin4@example.com');

        $this->actingAs($admin)->put(route('offers.update', $offer->id), [
            'subtitle_en' => 'Cleared Offer',
            'city_id' => $city->id,
            'offer_date' => '',
        ] + self::PERIOD)->assertRedirect(route('offers.index'));

        // Falls back to the creation day, not "today".
        $this->assertSame('2026-09-20', $offer->fresh()->offer_date->toDateString());
    }

    public function test_admin_rejects_an_invalid_date()
    {
        $city = $this->makeCity('Admin City');
        $admin = $this->makeAdmin('offer_date_admin5@example.com');

        $this->actingAs($admin)->post(route('offers.store'), [
            'subtitle_en' => 'Bad Date Offer',
            'city_id' => $city->id,
            'offer_date' => 'not-a-date',
        ] + self::PERIOD)->assertSessionHasErrors('offer_date');

        $this->assertFalse(Offer::where('subtitle_en', 'Bad Date Offer')->exists());
    }

    public function test_admin_add_and_edit_forms_render_the_date_field()
    {
        $city = $this->makeCity('Admin City');
        $offer = $this->makeOffer('Form Offer', $city, '2026-11-05');
        $admin = $this->makeAdmin('offer_date_admin6@example.com');

        $this->actingAs($admin)->get(route('offers.create'))
            ->assertOk()
            ->assertSee('name="offer_date"', false);

        $this->actingAs($admin)->get(route('offers.edit', $offer->id))
            ->assertOk()
            ->assertSee('value="2026-11-05"', false);
    }

    public function test_admin_index_lists_each_offers_date()
    {
        $city = $this->makeCity('Admin City');
        $this->makeOffer('Listed Offer', $city, '2026-11-07');
        $admin = $this->makeAdmin('offer_date_admin7@example.com');

        $this->actingAs($admin)->get(route('offers.index'))
            ->assertOk()
            ->assertSee('<th class="min-w-125px">date</th>', false)
            ->assertSee('data-order="2026-11-07"', false);
    }

    // --- Admin: start_date / end_date ----------------------------------------

    public function test_offers_table_has_start_and_end_date_columns()
    {
        $this->assertTrue(Schema::hasColumns('offers', ['start_date', 'end_date']));
    }

    public function test_admin_saves_the_offer_period()
    {
        $city = $this->makeCity('Admin City');
        $admin = $this->makeAdmin('offer_period_admin1@example.com');

        $this->actingAs($admin)->post(route('offers.store'), [
            'subtitle_en' => 'Period Offer',
            'city_id' => $city->id,
            'start_date' => '2026-10-15 08:30',
            'end_date' => '2026-10-20 22:00',
        ])->assertRedirect(route('offers.index'));

        $offer = Offer::where('subtitle_en', 'Period Offer')->firstOrFail();
        $this->assertSame('2026-10-15 08:30:00', $offer->start_date->toDateTimeString());
        $this->assertSame('2026-10-20 22:00:00', $offer->end_date->toDateTimeString());

        $this->actingAs($admin)->put(route('offers.update', $offer->id), [
            'subtitle_en' => 'Period Offer',
            'city_id' => $city->id,
            'start_date' => '2026-10-16 08:30',
            'end_date' => '2026-10-25 22:00',
        ])->assertRedirect(route('offers.index'));

        $this->assertSame('2026-10-25 22:00:00', $offer->fresh()->end_date->toDateTimeString());
    }

    public function test_admin_requires_an_end_date_after_the_start_date()
    {
        $city = $this->makeCity('Admin City');
        $offer = $this->makeOffer('Valid Period Offer', $city, null, $this->period('2026-10-01 00:00', '2026-10-31 00:00'));
        $admin = $this->makeAdmin('offer_period_admin2@example.com');

        foreach (['2026-10-10 10:00', '2026-10-09 10:00'] as $end) { // equal, then before
            $this->actingAs($admin)->post(route('offers.store'), [
                'subtitle_en' => 'Backwards Offer',
                'city_id' => $city->id,
                'start_date' => '2026-10-10 10:00',
                'end_date' => $end,
            ])->assertSessionHasErrors(['end_date' => 'The end date must be after the start date.']);

            $this->actingAs($admin)->put(route('offers.update', $offer->id), [
                'subtitle_en' => 'Valid Period Offer',
                'city_id' => $city->id,
                'start_date' => '2026-10-10 10:00',
                'end_date' => $end,
            ])->assertSessionHasErrors('end_date');
        }

        $this->actingAs($admin)->post(route('offers.store'), [
            'subtitle_en' => 'Undated Period Offer',
            'city_id' => $city->id,
        ])->assertSessionHasErrors(['start_date', 'end_date']);

        $this->assertFalse(Offer::whereIn('subtitle_en', ['Backwards Offer', 'Undated Period Offer'])->exists());
        $this->assertSame('2026-10-31 00:00:00', $offer->fresh()->end_date->toDateTimeString());
    }

    public function test_admin_forms_render_the_period_fields()
    {
        $offer = $this->makeOffer('Period Form Offer', $this->makeCity('Admin City'), null,
            $this->period('2026-10-05 09:30', '2026-11-20 18:00'));
        $admin = $this->makeAdmin('offer_period_admin3@example.com');

        $this->actingAs($admin)->get(route('offers.create'))
            ->assertOk()
            ->assertSee('name="start_date"', false)
            ->assertSee('name="end_date"', false);

        $this->actingAs($admin)->get(route('offers.edit', $offer->id))
            ->assertOk()
            ->assertSee('value="2026-10-05 09:30"', false)
            ->assertSee('value="2026-11-20 18:00"', false);
    }

    public function test_admin_index_shows_each_offers_period_and_status()
    {
        Carbon::setTestNow('2026-10-12 12:00:00');
        $city = $this->makeCity('Admin City');
        $this->makeOffer('Running Admin Offer', $city, null, $this->period('2026-10-01 00:00', '2026-10-30 00:00'));
        $this->makeOffer('Upcoming Admin Offer', $city, null, $this->period('2026-11-01 00:00', '2026-11-30 00:00'));
        $this->makeOffer('Expired Admin Offer', $city, null, $this->period('2026-09-01 00:00', '2026-09-30 00:00'));
        $admin = $this->makeAdmin('offer_period_admin4@example.com');

        $html = $this->actingAs($admin)->get(route('offers.index'))->assertOk()->getContent();

        $this->assertStringContainsString('<th class="min-w-125px">start</th>', $html);
        $this->assertStringContainsString('<th class="min-w-125px">end</th>', $html);
        $this->assertStringContainsString('2026-11-01 00:00', $html);
        foreach ([
            'Running Admin Offer' => 'badge-light-success offer-period-status">Active',
            'Upcoming Admin Offer' => 'badge-light-warning offer-period-status">Not started',
            'Expired Admin Offer' => 'badge-light-danger offer-period-status">Expired',
        ] as $title => $badge) {
            $row = substr($html, strpos($html, $title));
            $row = substr($row, 0, strpos($row, '</tr>'));
            $this->assertStringContainsString($badge, $row, $title);
        }
    }

    // --- Public: City + Date filter ----------------------------------------

    public function test_public_offers_page_shows_the_search_form_with_offer_cities()
    {
        $withOffer = $this->makeCity('Filter City With Offer');
        $this->makeCity('Filter City Without Offer');
        $this->makeOffer('Visible Offer', $withOffer, '2026-11-01');

        $this->get('/offers')
            ->assertOk()
            ->assertSee('id="offers_search_form"', false)
            ->assertSee('name="date_from"', false)
            ->assertSee('name="date_to"', false)
            ->assertSee('Filter City With Offer')
            ->assertDontSee('Filter City Without Offer');
    }

    public function test_public_offers_can_be_filtered_by_city()
    {
        $cairo = $this->makeCity('Filter Cairo');
        $dubai = $this->makeCity('Filter Dubai');
        $this->makeOffer('Cairo Offer', $cairo, '2026-11-01');
        $this->makeOffer('Dubai Offer', $dubai, '2026-11-01');

        $grid = $this->resultsGrid('/offers?city_id=' . $cairo->id);

        $this->assertStringContainsString('Cairo Offer', $grid);
        $this->assertStringNotContainsString('Dubai Offer', $grid);
    }

    public function test_public_offers_can_be_filtered_by_a_date_period_inclusive_of_both_ends()
    {
        $city = $this->makeCity('Filter City');
        $this->makeOffer('Before Period Offer', $city, '2026-10-31');
        $this->makeOffer('Period Start Offer', $city, '2026-11-01');
        $this->makeOffer('Mid Period Offer', $city, '2026-11-15');
        $this->makeOffer('Period End Offer', $city, '2026-11-30');
        $this->makeOffer('After Period Offer', $city, '2026-12-01');

        $grid = $this->resultsGrid('/offers?date_from=2026-11-01&date_to=2026-11-30');

        $this->assertStringContainsString('Period Start Offer', $grid);
        $this->assertStringContainsString('Mid Period Offer', $grid);
        $this->assertStringContainsString('Period End Offer', $grid);
        $this->assertStringNotContainsString('Before Period Offer', $grid);
        $this->assertStringNotContainsString('After Period Offer', $grid);
    }

    public function test_only_a_from_date_returns_offers_on_or_after_it()
    {
        $city = $this->makeCity('Filter City');
        $this->makeOffer('Old Offer', $city, '2026-10-31');
        $this->makeOffer('Upcoming Offer', $city, '2026-11-01');

        $grid = $this->resultsGrid('/offers?date_from=2026-11-01');

        $this->assertStringContainsString('Upcoming Offer', $grid);
        $this->assertStringNotContainsString('Old Offer', $grid);
    }

    public function test_only_a_to_date_returns_offers_on_or_before_it()
    {
        $city = $this->makeCity('Filter City');
        $this->makeOffer('Early Offer', $city, '2026-11-01');
        $this->makeOffer('Late Offer', $city, '2026-11-02');

        $grid = $this->resultsGrid('/offers?date_to=2026-11-01');

        $this->assertStringContainsString('Early Offer', $grid);
        $this->assertStringNotContainsString('Late Offer', $grid);
    }

    public function test_a_reversed_period_is_swapped_instead_of_returning_nothing()
    {
        $city = $this->makeCity('Filter City');
        $this->makeOffer('Inside Offer', $city, '2026-11-15');

        $grid = $this->resultsGrid('/offers?date_from=2026-11-30&date_to=2026-11-01');

        $this->assertStringContainsString('Inside Offer', $grid);
    }

    public function test_public_offers_can_be_filtered_by_city_and_date_together()
    {
        $cairo = $this->makeCity('Filter Cairo');
        $dubai = $this->makeCity('Filter Dubai');
        $this->makeOffer('Cairo Nov Offer', $cairo, '2026-11-01');
        $this->makeOffer('Cairo Dec Offer', $cairo, '2026-12-01');
        $this->makeOffer('Dubai Dec Offer', $dubai, '2026-12-01');

        $grid = $this->resultsGrid('/offers?city_id=' . $cairo->id . '&date_from=2026-12-01&date_to=2026-12-01');

        $this->assertStringContainsString('Cairo Dec Offer', $grid);
        $this->assertStringNotContainsString('Cairo Nov Offer', $grid);
        $this->assertStringNotContainsString('Dubai Dec Offer', $grid);
    }

    public function test_public_filter_never_shows_inactive_offers()
    {
        $city = $this->makeCity('Filter City');
        $this->makeOffer('Hidden Offer', $city, '2026-11-01', ['active' => 0]);

        $grid = $this->resultsGrid('/offers?city_id=' . $city->id . '&date_from=2026-11-01&date_to=2026-11-01');

        $this->assertStringNotContainsString('Hidden Offer', $grid);
        $this->assertStringContainsString(__('links.no_offers_found'), $grid);
    }

    public function test_an_invalid_public_date_is_ignored_instead_of_erroring()
    {
        $city = $this->makeCity('Filter City');
        $this->makeOffer('Any Date Offer', $city, '2026-11-01');

        $this->get('/offers?city_id=' . $city->id . '&date_from=2026-13-45&date_to=2026-02-30')
            ->assertOk()
            ->assertSee('Any Date Offer');
    }

    public function test_ajax_fetch_endpoint_applies_the_same_filters_and_keeps_them_in_pagination()
    {
        $cairo = $this->makeCity('Filter Cairo');
        $dubai = $this->makeCity('Filter Dubai');
        $this->makeOffer('Cairo Ajax Offer', $cairo, '2026-11-01');
        $this->makeOffer('Dubai Ajax Offer', $dubai, '2026-11-01');
        // Enough matching offers for a second page (10 per page), so pagination renders.
        for ($i = 1; $i <= 10; $i++) {
            $this->makeOffer("Cairo Ajax Offer {$i}", $cairo, '2026-11-01');
        }

        $response = $this->get('/offers/fetch_data?city_id=' . $cairo->id . '&date_from=2026-11-01&date_to=2026-11-30', [
            'X-Requested-With' => 'XMLHttpRequest',
        ]);

        $response->assertOk()
            ->assertSee('Cairo Ajax Offer')
            ->assertDontSee('Dubai Ajax Offer')
            // Pagination links carry the active filters.
            ->assertSee('city_id=' . $cairo->id, false);
    }

    // --- Public: full list vs. "latest offers" sidebar ----------------------

    /**
     * The "latest offers" sidebar only.
     */
    private function latestSidebar(string $html): string
    {
        $sidebar = substr($html, strpos($html, 'class="offers_sidebar'));

        return substr($sidebar, 0, strpos($sidebar, '</aside>'));
    }

    private function period(string $start, string $end): array
    {
        return ['start_date' => $start, 'end_date' => $end];
    }

    public function test_full_list_shows_every_active_offer_newest_first_expired_included()
    {
        $city = $this->makeCity('Order City');
        Carbon::setTestNow('2026-09-01 10:00:00');
        $this->makeOffer('Older Expired Offer', $city, '2026-09-05', $this->period('2026-09-01 10:00', '2026-09-05 23:59'));
        Carbon::setTestNow('2026-10-10 10:00:00');
        $this->makeOffer('Newer Current Offer', $city, '2026-11-01', $this->period('2026-10-10 10:00', '2026-11-01 23:59'));
        Carbon::setTestNow('2026-10-12 12:00:00');

        $grid = $this->resultsGrid('/offers');

        $this->assertStringContainsString('Older Expired Offer', $grid);
        $this->assertLessThan(
            strpos($grid, 'Older Expired Offer'),
            strpos($grid, 'Newer Current Offer')
        );
    }

    public function test_latest_sidebar_only_shows_offers_running_now()
    {
        Carbon::setTestNow('2026-10-12 12:00:00');
        $city = $this->makeCity('Expiry City');
        $this->makeOffer('Expired Offer', $city, null, $this->period('2026-10-01 00:00', '2026-10-12 11:59'));
        $this->makeOffer('Ends Soon Offer', $city, null, $this->period('2026-10-01 00:00', '2026-10-12 12:00'));
        $this->makeOffer('Running Offer', $city, null, $this->period('2026-10-12 12:00', '2026-12-01 00:00'));
        $this->makeOffer('Upcoming Offer', $city, null, $this->period('2026-10-12 12:01', '2026-12-01 00:00'));

        $sidebar = $this->latestSidebar($this->get('/offers')->assertOk()->getContent());

        $this->assertStringContainsString('Ends Soon Offer', $sidebar);
        $this->assertStringContainsString('Running Offer', $sidebar);
        $this->assertStringNotContainsString('Expired Offer', $sidebar);
        $this->assertStringNotContainsString('Upcoming Offer', $sidebar);
        $this->assertStringNotContainsString(__('links.offers_coming_soon'), $sidebar);
    }

    public function test_latest_sidebar_is_sorted_by_start_date_newest_first()
    {
        Carbon::setTestNow('2026-10-12 12:00:00');
        $city = $this->makeCity('Order City');
        // Created first but started most recently.
        $this->makeOffer('Recently Started Offer', $city, null, $this->period('2026-10-11 00:00', '2026-12-01 00:00'));
        $this->makeOffer('Long Running Offer', $city, null, $this->period('2026-09-01 00:00', '2026-12-01 00:00'));

        $sidebar = $this->latestSidebar($this->get('/offers')->assertOk()->getContent());

        $this->assertLessThan(
            strpos($sidebar, 'Long Running Offer'),
            strpos($sidebar, 'Recently Started Offer')
        );
    }

    public function test_offer_cards_show_the_start_and_end_dates()
    {
        $this->makeOffer('Period Card Offer', $this->makeCity('Card City'), null,
            $this->period('2026-10-05 09:30', '2026-11-20 18:00'));

        $grid = $this->resultsGrid('/offers');

        $this->assertStringContainsString('offer_card__dates', $grid);
        $this->assertStringContainsString('<time datetime="2026-10-05">5 Oct 2026</time>', $grid);
        $this->assertStringContainsString('<time datetime="2026-11-20">20 Nov 2026</time>', $grid);
        // Date only — no time of day.
        $this->assertStringNotContainsString('09:30', $grid);
        $this->assertStringNotContainsString('18:00', $grid);

        LaravelLocalization::setLocale('ar');
        $offer = Offer::where('subtitle_en', 'Period Card Offer')->first();
        $this->assertSame('5 أكتوبر 2026', $offer->periodDate('start_date'));
    }

    public function test_latest_sidebar_shows_coming_soon_when_every_offer_has_expired()
    {
        Carbon::setTestNow('2026-10-12 12:00:00');
        $offer = $this->makeOffer('Long Gone Offer', $this->makeCity('Expiry City'), '2026-09-01',
            $this->period('2026-08-01 00:00', '2026-09-01 23:59'));

        $html = $this->get('/offers')->assertOk()->getContent();
        $sidebar = $this->latestSidebar($html);

        $this->assertStringContainsString('Stay tuned for our latest offers soon', $sidebar);
        $this->assertStringNotContainsString('Long Gone Offer', $sidebar);
        // The full list (and its search bar) still shows it.
        $this->assertStringContainsString('Long Gone Offer', $this->resultsGrid('/offers'));
        $this->assertStringContainsString('id="offers_search_form"', $html);

        // Same on the single-offer page's sidebar.
        $this->get('/single-offer/' . $offer->id)
            ->assertOk()
            ->assertSee('Stay tuned for our latest offers soon');

        // The locale prefix is fixed when routes register, so check Arabic by rendering directly.
        LaravelLocalization::setLocale('ar');
        $html = view('website.offers.single', [
            'Company' => Company::first(),
            'offer' => $offer,
            'latest' => Offer::current()->get(),
            'BreadCrumb' => [],
        ])->render();
        $this->assertStringContainsString('انتظر أحدث العروض قريباً', $html);
    }

    // --- Public: single offer ----------------------------------------------

    public function test_single_offer_hero_shows_the_offer_title_in_the_current_language()
    {
        $offer = $this->makeOffer('Hero Title Offer', $this->makeCity('Hero City'), '2026-11-01', [
            'subtitle_ar' => 'عرض العنوان',
        ]);

        $this->get('/single-offer/' . $offer->id)
            ->assertOk()
            ->assertSee('<h1> Hero Title Offer</h1>', false);

        LaravelLocalization::setLocale('ar');
        $html = view('website.offers.single', [
            'Company' => Company::first(),
            'offer' => $offer,
            'latest' => collect(),
            'BreadCrumb' => [],
        ])->render();
        $this->assertStringContainsString('<h1> عرض العنوان</h1>', $html);
    }

    public function test_single_offer_page_shows_the_start_and_end_dates()
    {
        $offer = $this->makeOffer('Period Single Offer', $this->makeCity('Single City'), null,
            $this->period('2026-10-05 09:30', '2026-11-20 18:00'));

        $this->get('/single-offer/' . $offer->id)
            ->assertOk()
            ->assertSee('class="offer_period"', false)
            ->assertSee('<time datetime="2026-10-05">5 October 2026</time>', false)
            ->assertSee('<time datetime="2026-11-20">20 November 2026</time>', false)
            ->assertDontSee('09:30')
            ->assertDontSee('18:00');
    }

    public function test_unknown_single_offer_returns_404()
    {
        $this->get('/single-offer/999999999')->assertNotFound();
    }
}
