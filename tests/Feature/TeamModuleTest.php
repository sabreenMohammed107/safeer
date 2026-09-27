<?php

namespace Tests\Feature;

use App\Models\Team;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Support\Facades\Schema;
use Tests\TestCase;

/**
 * Exercises the Teams module end to end: schema, admin CRUD, drag-and-drop
 * reordering, and the public /team page (featured spotlight + general grid).
 *
 * Uses DatabaseTransactions (not RefreshDatabase) against the dedicated
 * `safer_testing` database configured in .env.testing — never the live
 * `safer` database.
 */
class TeamModuleTest extends TestCase
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

    private function makeAdmin(string $email): User
    {
        return User::create([
            'name' => 'Admin',
            'email' => $email,
            'password' => bcrypt('password'),
            'type' => 1, // 1 => "admin" per User::type() accessor
        ]);
    }

    public function test_teams_table_has_the_expected_schema()
    {
        $this->assertTrue(Schema::hasTable('teams'));
        $this->assertTrue(Schema::hasColumns('teams', [
            'en_name', 'ar_name', 'en_job', 'ar_job',
            'en_description', 'ar_description', 'image',
            'featured', 'active', 'order',
        ]));
    }

    public function test_admin_can_create_a_team_member()
    {
        $admin = $this->makeAdmin('admin_team_test1@example.com');

        $response = $this->actingAs($admin)->post(route('teams.store'), [
            'en_name' => 'Test Member',
            'ar_name' => 'عضو تجريبي',
            'en_job' => 'Tour Guide',
            'featured' => '1',
            'active' => '1',
            'order' => 5,
        ]);

        $response->assertRedirect(route('teams.index'));

        $team = Team::where('en_name', 'Test Member')->firstOrFail();
        $this->assertTrue((bool) $team->featured);
        $this->assertTrue((bool) $team->active);
        $this->assertSame(5, $team->order);
    }

    public function test_creating_a_team_member_without_active_or_featured_defaults_to_false()
    {
        $admin = $this->makeAdmin('admin_team_test2@example.com');

        $this->actingAs($admin)->post(route('teams.store'), [
            'en_name' => 'Unchecked Member',
        ])->assertRedirect(route('teams.index'));

        $team = Team::where('en_name', 'Unchecked Member')->firstOrFail();
        $this->assertFalse((bool) $team->featured);
        $this->assertFalse((bool) $team->active);
    }

    public function test_admin_can_update_a_team_member()
    {
        $team = Team::create(['en_name' => 'Old Name', 'active' => true, 'order' => 1]);
        $admin = $this->makeAdmin('admin_team_test3@example.com');

        $this->actingAs($admin)->put(route('teams.update', $team->id), [
            'en_name' => 'New Name',
            'en_job' => 'Senior Guide',
            'featured' => '1',
            'active' => '1',
        ])->assertRedirect(route('teams.index'));

        $team->refresh();
        $this->assertSame('New Name', $team->en_name);
        $this->assertSame('Senior Guide', $team->en_job);
        $this->assertTrue((bool) $team->featured);
    }

    public function test_admin_can_delete_a_team_member()
    {
        $team = Team::create(['en_name' => 'To Delete', 'active' => true]);
        $admin = $this->makeAdmin('admin_team_test4@example.com');

        $this->actingAs($admin)->delete(route('teams.destroy', $team->id))
            ->assertRedirect();

        $this->assertNull(Team::find($team->id));
    }

    public function test_admin_can_bulk_reorder_team_members()
    {
        $a = Team::create(['en_name' => 'A', 'active' => true, 'order' => 1]);
        $b = Team::create(['en_name' => 'B', 'active' => true, 'order' => 2]);
        $c = Team::create(['en_name' => 'C', 'active' => true, 'order' => 3]);

        $admin = $this->makeAdmin('admin_team_test5@example.com');

        $response = $this->actingAs($admin)
            ->postJson(route('teams.reorder'), ['order' => [$c->id, $a->id, $b->id]]);

        $response->assertOk()->assertJson(['status' => 'success']);

        $this->assertSame(1, $c->fresh()->order);
        $this->assertSame(2, $a->fresh()->order);
        $this->assertSame(3, $b->fresh()->order);
    }

    public function test_reorder_endpoint_requires_admin_authentication()
    {
        $team = Team::create(['en_name' => 'A', 'active' => true, 'order' => 1]);

        $response = $this->postJson(route('teams.reorder'), ['order' => [$team->id]]);

        $response->assertStatus(401);
        $this->assertSame(1, $team->fresh()->order);
    }

    public function test_public_team_page_separates_featured_from_general_and_hides_inactive()
    {
        Team::create(['en_name' => 'Featured One', 'active' => true, 'featured' => true, 'order' => 1]);
        Team::create(['en_name' => 'General One', 'active' => true, 'featured' => false, 'order' => 2]);
        Team::create(['en_name' => 'Hidden Inactive', 'active' => false, 'featured' => true, 'order' => 3]);

        $response = $this->get('/team');
        $response->assertOk();

        $html = $response->getContent();

        $this->assertStringContainsString('Featured One', $html);
        $this->assertStringContainsString('General One', $html);
        $this->assertStringNotContainsString('Hidden Inactive', $html);
    }

    public function test_public_team_page_orders_by_order_column()
    {
        Team::create(['en_name' => 'Zebra Member', 'active' => true, 'featured' => false, 'order' => 3]);
        Team::create(['en_name' => 'Alpha Member', 'active' => true, 'featured' => false, 'order' => 1]);
        Team::create(['en_name' => 'Middle Member', 'active' => true, 'featured' => false, 'order' => 2]);

        $html = $this->get('/team')->assertOk()->getContent();

        $posAlpha = strpos($html, 'Alpha Member');
        $posMiddle = strpos($html, 'Middle Member');
        $posZebra = strpos($html, 'Zebra Member');

        $this->assertNotFalse($posAlpha);
        $this->assertNotFalse($posMiddle);
        $this->assertNotFalse($posZebra);
        $this->assertTrue($posAlpha < $posMiddle);
        $this->assertTrue($posMiddle < $posZebra);
    }
}
