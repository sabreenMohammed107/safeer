<?php

namespace Tests\Feature\Admin;

use App\Models\Team;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\File;
use Tests\TestCase;

/**
 * The "choose from server" image library (PicksServerImages trait +
 * admin.partials.image-picker), exercised through the Teams admin module.
 *
 * Fixture images live in throwaway folders under public/uploads and every
 * file the tests create is removed in tearDown.
 */
class ServerImagePickerTest extends TestCase
{
    use DatabaseTransactions;

    private string $fixtureFolder = 'zz-picker-test';

    private string $privateFolder = 'visas';

    private array $createdFiles = [];

    protected function setUp(): void
    {
        parent::setUp();

        $database = config('database.connections.mysql.database');
        if ($database !== 'safer_testing') {
            $this->fail("Refusing to run: expected DB connection 'safer_testing', got '{$database}'. Check .env.testing is being loaded.");
        }

        $this->makeImage($this->fixtureFolder . '/library-pick.png');
        $this->makeImage($this->fixtureFolder . '/notes.txt');
        $this->makeImage($this->privateFolder . '/zz-passport-secret.png');
    }

    protected function tearDown(): void
    {
        foreach ($this->createdFiles as $file) {
            File::delete($file);
        }
        File::deleteDirectory(public_path('uploads/' . $this->fixtureFolder));

        parent::tearDown();
    }

    private function makeImage(string $relativePath): string
    {
        $path = public_path('uploads/' . $relativePath);
        File::ensureDirectoryExists(dirname($path));
        File::put($path, UploadedFile::fake()->image('x.png', 10, 10)->get());

        return $this->createdFiles[] = $path;
    }

    private function admin(): User
    {
        return User::create([
            'name' => 'Admin',
            'email' => 'picker_' . uniqid() . '@example.com',
            'password' => bcrypt('password'),
            'type' => 1,
        ]);
    }

    public function test_create_page_lists_server_images_but_hides_private_folders_and_non_images()
    {
        $html = $this->actingAs($this->admin())->get(route('teams.create'))
            ->assertOk()
            ->getContent();

        $this->assertStringContainsString('data-path="' . $this->fixtureFolder . '/library-pick.png"', $html);
        $this->assertStringContainsString('name="library_image"', $html);
        $this->assertStringContainsString('name="image"', $html);
        $this->assertStringNotContainsString('zz-passport-secret.png', $html);
        $this->assertStringNotContainsString('notes.txt', $html);
    }

    public function test_edit_page_shows_the_library_and_the_current_image_preview()
    {
        $team = Team::create(['en_name' => 'Has Photo', 'active' => true, 'image' => 'current.png']);

        $this->actingAs($this->admin())->get(route('teams.edit', $team->id))
            ->assertOk()
            ->assertSee(asset('uploads/teams/current.png'), false)
            ->assertSee('data-path="' . $this->fixtureFolder . '/library-pick.png"', false);
    }

    public function test_picking_an_image_from_another_folder_copies_it_and_stores_only_the_filename()
    {
        $this->actingAs($this->admin())->post(route('teams.store'), [
            'en_name' => 'Picked Member',
            'library_image' => $this->fixtureFolder . '/library-pick.png',
        ])->assertRedirect(route('teams.index'));

        $team = Team::where('en_name', 'Picked Member')->firstOrFail();
        $this->createdFiles[] = public_path('uploads/teams/' . $team->image);

        $this->assertSame('library-pick.png', $team->image);
        $this->assertFileExists(public_path('uploads/teams/library-pick.png'));
        // The original is left in place for the module that owns it.
        $this->assertFileExists(public_path('uploads/' . $this->fixtureFolder . '/library-pick.png'));
    }

    public function test_picking_an_image_already_in_the_module_folder_reuses_it_without_copying()
    {
        $this->makeImage('teams/zz-existing-team.png');
        $team = Team::create(['en_name' => 'Reuse', 'active' => true, 'image' => 'old.png']);
        $before = count(File::files(public_path('uploads/teams')));

        $this->actingAs($this->admin())->put(route('teams.update', $team->id), [
            'en_name' => 'Reuse',
            'library_image' => 'teams/zz-existing-team.png',
        ])->assertRedirect(route('teams.index'));

        $this->assertSame('zz-existing-team.png', $team->fresh()->image);
        $this->assertCount($before, File::files(public_path('uploads/teams')));
    }

    public function test_a_different_file_with_the_same_name_is_not_overwritten()
    {
        $existing = $this->makeImage('teams/library-pick.png');
        File::put($existing, 'different content');

        $this->actingAs($this->admin())->post(route('teams.store'), [
            'en_name' => 'Name Clash',
            'library_image' => $this->fixtureFolder . '/library-pick.png',
        ]);

        $team = Team::where('en_name', 'Name Clash')->firstOrFail();
        $this->createdFiles[] = public_path('uploads/teams/' . $team->image);

        $this->assertNotSame('library-pick.png', $team->image);
        $this->assertStringEndsWith('_library-pick.png', $team->image);
        $this->assertSame('different content', File::get($existing));
    }

    public function test_a_new_upload_wins_over_a_library_pick()
    {
        $this->actingAs($this->admin())->post(route('teams.store'), [
            'en_name' => 'Uploaded Member',
            'image' => UploadedFile::fake()->image('fresh.jpg', 20, 20),
            'library_image' => $this->fixtureFolder . '/library-pick.png',
        ])->assertRedirect(route('teams.index'));

        $team = Team::where('en_name', 'Uploaded Member')->firstOrFail();
        $this->createdFiles[] = public_path('uploads/teams/' . $team->image);

        $this->assertStringEndsWith('_fresh.jpg', $team->image);
        $this->assertFileExists(public_path('uploads/teams/' . $team->image));
    }

    public function test_update_without_upload_or_pick_keeps_the_current_image()
    {
        $team = Team::create(['en_name' => 'Keep', 'active' => true, 'image' => 'keep.png']);

        $this->actingAs($this->admin())->put(route('teams.update', $team->id), [
            'en_name' => 'Keep',
            'library_image' => '',
        ])->assertRedirect(route('teams.index'));

        $this->assertSame('keep.png', $team->fresh()->image);
    }

    /**
     * @dataProvider rejectedLibraryPaths
     */
    public function test_unsafe_or_private_library_paths_are_ignored(string $path)
    {
        $team = Team::create(['en_name' => 'Safe', 'active' => true, 'image' => 'keep.png']);

        $this->actingAs($this->admin())->put(route('teams.update', $team->id), [
            'en_name' => 'Safe',
            'library_image' => $path,
        ])->assertRedirect(route('teams.index'));

        $this->assertSame('keep.png', $team->fresh()->image);
        $this->assertFileDoesNotExist(public_path('uploads/teams/' . basename($path)));
    }

    public function rejectedLibraryPaths(): array
    {
        return [
            'customer passport folder' => ['visas/zz-passport-secret.png'],
            'nested private folder' => ['uploads/visas/zz-passport-secret.png'],
            'path traversal' => ['../../.env'],
            'traversal disguised as image' => ['zz-picker-test/../../index.png'],
            'non-image file' => ['zz-picker-test/notes.txt'],
            'missing file' => ['zz-picker-test/does-not-exist.png'],
        ];
    }
}
