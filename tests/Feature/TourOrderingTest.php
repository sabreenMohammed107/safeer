<?php

namespace Tests\Feature;

use App\Models\Tour;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Support\Facades\Schema;
use Tests\TestCase;

/**
 * Exercises the admin tour "order" column: schema, default public sorting,
 * and the admin create/update endpoints.
 *
 * Uses DatabaseTransactions (not RefreshDatabase) against the dedicated
 * `safer_testing` database configured in .env.testing — that database is a
 * structure-only clone of `safer` that already has the `order` migration
 * applied, so tests never run `migrate:fresh` and can never touch the real
 * `safer` data.
 */
class TourOrderingTest extends TestCase
{
    use DatabaseTransactions;

    protected function setUp(): void
    {
        parent::setUp();

        // Hard safety net: refuse to run against anything but the disposable
        // test database, no matter how the suite is invoked.
        $database = config('database.connections.mysql.database');
        if ($database !== 'safer_testing') {
            $this->fail("Refusing to run: expected DB connection 'safer_testing', got '{$database}'. Check .env.testing is being loaded.");
        }
    }

    public function test_tours_table_has_an_indexed_order_column()
    {
        $this->assertTrue(Schema::hasColumn('tours', 'order'));
    }

    public function test_public_tours_page_defaults_to_order_column_ascending()
    {
        $last = Tour::create(['en_name' => 'Zebra Tour', 'active' => 1, 'order' => 3]);
        $first = Tour::create(['en_name' => 'Alpha Tour', 'active' => 1, 'order' => 1]);
        $middle = Tour::create(['en_name' => 'Middle Tour', 'active' => 1, 'order' => 2]);

        $response = $this->get('/tours');

        $response->assertOk();
        $html = $response->getContent();

        $posFirst = strpos($html, 'Alpha Tour');
        $posMiddle = strpos($html, 'Middle Tour');
        $posLast = strpos($html, 'Zebra Tour');

        $this->assertNotFalse($posFirst);
        $this->assertNotFalse($posMiddle);
        $this->assertNotFalse($posLast);

        // Ascending by `order` (1, 2, 3), not by id/name/price.
        $this->assertTrue($posFirst < $posMiddle);
        $this->assertTrue($posMiddle < $posLast);
    }

    public function test_by_price_sort_tab_still_sorts_by_price_independently_of_order()
    {
        Tour::create(['en_name' => 'Expensive Tour', 'active' => 1, 'order' => 1, 'tour_person_cost' => 500]);
        Tour::create(['en_name' => 'Cheap Tour', 'active' => 1, 'order' => 2, 'tour_person_cost' => 50]);

        $response = $this->get('/tours');
        $response->assertOk();

        // The "By Price" pane is rendered in the same response; within it the
        // cheaper tour must still come first even though its `order` is higher.
        $html = $response->getContent();
        $byPricePane = substr($html, strpos($html, 'id="pills-profile"'));
        $byPricePane = substr($byPricePane, 0, strpos($byPricePane, 'id="pills-alpha"'));

        $posCheap = strpos($byPricePane, 'Cheap Tour');
        $posExpensive = strpos($byPricePane, 'Expensive Tour');

        $this->assertNotFalse($posCheap);
        $this->assertNotFalse($posExpensive);
        $this->assertTrue($posCheap < $posExpensive);
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

    public function test_admin_can_create_a_tour_with_an_explicit_order()
    {
        $admin = $this->makeAdmin('admin_order_test@example.com');

        $response = $this->actingAs($admin)->post(route('tours.store'), [
            'en_name' => 'New Ordered Tour',
            'ar_name' => 'جولة مرتبة جديدة',
            'order' => 7,
        ]);

        $response->assertRedirect(route('tours.index'));

        $tour = Tour::where('en_name', 'New Ordered Tour')->firstOrFail();
        $this->assertSame(7, $tour->order);
    }

    public function test_admin_creating_a_tour_without_order_appends_it_to_the_end()
    {
        Tour::create(['en_name' => 'Existing Tour', 'active' => 1, 'order' => 10]);

        $admin = $this->makeAdmin('admin_order_test2@example.com');

        $this->actingAs($admin)->post(route('tours.store'), [
            'en_name' => 'Appended Tour',
        ])->assertRedirect(route('tours.index'));

        $tour = Tour::where('en_name', 'Appended Tour')->firstOrFail();
        $this->assertSame(11, $tour->order);
    }

    public function test_admin_can_update_a_tours_order()
    {
        $tour = Tour::create(['en_name' => 'Movable Tour', 'active' => 1, 'order' => 1]);

        $admin = $this->makeAdmin('admin_order_test3@example.com');

        $this->actingAs($admin)->put(route('tours.update', $tour->id), [
            'en_name' => $tour->en_name,
            'order' => 42,
        ])->assertRedirect(route('tours.index'));

        $this->assertSame(42, $tour->fresh()->order);
    }

    public function test_admin_can_bulk_reorder_tours_via_the_drag_and_drop_endpoint()
    {
        $a = Tour::create(['en_name' => 'Tour A', 'active' => 1, 'order' => 1]);
        $b = Tour::create(['en_name' => 'Tour B', 'active' => 1, 'order' => 2]);
        $c = Tour::create(['en_name' => 'Tour C', 'active' => 1, 'order' => 3]);

        $admin = $this->makeAdmin('admin_reorder_test1@example.com');

        // Drag "Tour C" to the top: new sequence is C, A, B.
        $response = $this->actingAs($admin)
            ->postJson(route('tours.reorder'), ['order' => [$c->id, $a->id, $b->id]]);

        $response->assertOk()->assertJson(['status' => 'success']);

        $this->assertSame(1, $c->fresh()->order);
        $this->assertSame(2, $a->fresh()->order);
        $this->assertSame(3, $b->fresh()->order);
    }

    public function test_reorder_endpoint_rejects_ids_that_do_not_exist()
    {
        $a = Tour::create(['en_name' => 'Tour A', 'active' => 1, 'order' => 1]);
        $admin = $this->makeAdmin('admin_reorder_test2@example.com');

        $response = $this->actingAs($admin)
            ->postJson(route('tours.reorder'), ['order' => [$a->id, 999999]]);

        $response->assertStatus(422);
        // The valid tour's order must be untouched by the rejected request.
        $this->assertSame(1, $a->fresh()->order);
    }

    public function test_reorder_endpoint_requires_admin_authentication()
    {
        $tour = Tour::create(['en_name' => 'Tour A', 'active' => 1, 'order' => 1]);

        $response = $this->postJson(route('tours.reorder'), ['order' => [$tour->id]]);

        $response->assertStatus(401);
        $this->assertSame(1, $tour->fresh()->order);
    }

    public function test_public_tours_page_reflects_a_saved_reorder()
    {
        $a = Tour::create(['en_name' => 'Tour Alpha', 'active' => 1, 'order' => 1]);
        $b = Tour::create(['en_name' => 'Tour Beta', 'active' => 1, 'order' => 2]);

        $admin = $this->makeAdmin('admin_reorder_test3@example.com');
        $this->actingAs($admin)
            ->postJson(route('tours.reorder'), ['order' => [$b->id, $a->id]])
            ->assertOk();

        $html = $this->get('/tours')->assertOk()->getContent();

        $posBeta = strpos($html, 'Tour Beta');
        $posAlpha = strpos($html, 'Tour Alpha');

        $this->assertNotFalse($posBeta);
        $this->assertNotFalse($posAlpha);
        $this->assertTrue($posBeta < $posAlpha);
    }
}
