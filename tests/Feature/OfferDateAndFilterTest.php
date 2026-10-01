<?php

namespace Tests\Feature;

use App\Models\City;
use App\Models\Offer;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Support\Facades\Schema;
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
        ])->assertRedirect(route('offers.index'));

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
        ])->assertRedirect(route('offers.index'));

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
        ])->assertRedirect(route('offers.index'));

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
        ])->assertRedirect(route('offers.index'));

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
        ])->assertSessionHasErrors('offer_date');

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
}
