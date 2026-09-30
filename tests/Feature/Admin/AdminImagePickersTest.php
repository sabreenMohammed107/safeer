<?php

namespace Tests\Feature\Admin;

use App\Models\Blog;
use App\Models\Car_model;
use App\Models\Company;
use App\Models\Counter;
use App\Models\Explore_city;
use App\Models\Feature;
use App\Models\Gallery;
use App\Models\Offer;
use App\Models\User;
use App\Models\Why_us;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\File;
use Tests\TestCase;

/**
 * Every admin image upload also offers "choose from server": each form page
 * renders the picker (plus exactly one shared library modal), and each
 * store/update saves a library pick into that module's own folder + column.
 */
class AdminImagePickersTest extends TestCase
{
    use DatabaseTransactions;

    private const FIXTURE_FOLDER = 'zz-picker-fixture';

    private const PICK = self::FIXTURE_FOLDER . '/zz-lib-pick.png';

    private const TARGET_FOLDERS = ['blogs', 'carModels', 'company', 'counter', 'explore', 'features', 'galleries', 'hotels', 'offers', 'tours', 'whyUs'];

    protected function setUp(): void
    {
        parent::setUp();

        $database = config('database.connections.mysql.database');
        if ($database !== 'safer_testing') {
            $this->fail("Refusing to run: expected DB connection 'safer_testing', got '{$database}'. Check .env.testing is being loaded.");
        }

        File::ensureDirectoryExists(public_path('uploads/' . self::FIXTURE_FOLDER));
        File::put(public_path('uploads/' . self::PICK), UploadedFile::fake()->image('x.png', 10, 10)->get());

        $this->actingAs(User::create([
            'name' => 'Admin',
            'email' => 'pickers_' . uniqid() . '@example.com',
            'password' => bcrypt('password'),
            'type' => 1,
        ]));
    }

    protected function tearDown(): void
    {
        foreach (self::TARGET_FOLDERS as $folder) {
            File::delete(public_path('uploads/' . $folder . '/zz-lib-pick.png'));
        }
        File::deleteDirectory(public_path('uploads/' . self::FIXTURE_FOLDER));

        parent::tearDown();
    }

    private function assertPickerPage(string $html, int $minPickers): void
    {
        $this->assertGreaterThanOrEqual($minPickers, substr_count($html, 'data-image-picker '), 'image pickers on page');
        $this->assertSame(1, substr_count($html, 'id="serverImageLibrary"'), 'exactly one shared library modal');
        $this->assertStringContainsString('data-path="' . self::PICK . '"', $html);
        $this->assertStringNotContainsString('data-kt-image-input="true"', $html);
    }

    /**
     * @dataProvider formPages
     */
    public function test_form_page_renders_the_picker_and_one_shared_library(string $route, int $minPickers)
    {
        $html = $this->get(route($route))->assertOk()->getContent();

        $this->assertPickerPage($html, $minPickers);
    }

    public function formPages(): array
    {
        return [
            'blogs add' => ['blogs.create', 1],
            'car models index (add modal)' => ['car-models.index', 1],
            'counter index (add modal)' => ['counter.index', 1],
            'explore index (add modal)' => ['explore.index', 1],
            'features index (add modal)' => ['features.index', 1],
            'galleries index (multi add modal)' => ['galleries.index', 1],
            'hotels add (banner; logo field is commented out in the view)' => ['hotels.create', 1],
            'offers add (image + poster)' => ['offers.create', 2],
            'offers index (add modal)' => ['offers.index', 1],
            'tour galleries index (add modal)' => ['tour-galleries.index', 1],
            'tours add' => ['tours.create', 1],
            'tours index (add modal)' => ['tours.index', 1],
            'why us add' => ['why-us.create', 1],
            'teams add' => ['teams.create', 1],
        ];
    }

    public function test_index_pages_with_rows_get_a_picker_per_edit_modal_but_one_library()
    {
        Counter::create(['image' => 'a.png']);
        Counter::create(['image' => 'b.png']);

        $html = $this->get(route('counter.index'))->assertOk()->getContent();

        // Add modal + one edit modal per row.
        $this->assertPickerPage($html, 3);
        $this->assertStringContainsString(asset('uploads/counter/a.png'), $html);
    }

    public function test_company_edit_has_pickers_for_all_four_images()
    {
        $company = Company::firstOrFail();

        $html = $this->get(route('company.edit', $company->id))->assertOk()->getContent();

        $this->assertPickerPage($html, 4);
        foreach (['image', 'master_page_img_bg', 'book_img', 'transport_img'] as $field) {
            $this->assertStringContainsString('name="library_' . $field . '"', $html);
        }
    }

    public function test_edit_pages_show_the_current_image()
    {
        $blog = Blog::create(['image' => 'current-blog.png']);
        $why = Why_us::create(['icon' => 'current-why.png']);

        $this->get(route('blogs.edit', $blog->id))->assertOk()
            ->assertSee(asset('uploads/blogs/current-blog.png'), false);
        $this->get(route('why-us.edit', $why->id))->assertOk()
            ->assertSee(asset('uploads/whyUs/current-why.png'), false);
    }

    /**
     * @dataProvider storeCases
     */
    public function test_store_saves_a_library_pick_into_the_module_folder(string $route, string $field, string $model, string $column, string $folder)
    {
        $before = $model::max('id') ?? 0;

        $this->post(route($route), ['library_' . $field => self::PICK])->assertRedirect();

        $row = $model::where('id', '>', $before)->latest('id')->firstOrFail();
        $this->assertSame('zz-lib-pick.png', $row->{$column});
        $this->assertFileExists(public_path("uploads/$folder/zz-lib-pick.png"));
    }

    public function storeCases(): array
    {
        return [
            'blogs' => ['blogs.store', 'image', Blog::class, 'image', 'blogs'],
            'car models' => ['car-models.store', 'image', Car_model::class, 'image', 'carModels'],
            'counter' => ['counter.store', 'image', Counter::class, 'image', 'counter'],
            'explore' => ['explore.store', 'image', Explore_city::class, 'image', 'explore'],
            'features (icon)' => ['features.store', 'icon', Feature::class, 'icon', 'features'],
            'offers image' => ['offers.store', 'image', Offer::class, 'image', 'offers'],
            'offers poster' => ['offers.store', 'poster_image', Offer::class, 'poster_image', 'offers'],
            'tour galleries' => ['tour-galleries.store', 'img', Gallery::class, 'img', 'galleries'],
            'why us (image -> icon column)' => ['why-us.store', 'image', Why_us::class, 'icon', 'whyUs'],
        ];
    }

    public function test_update_saves_a_library_pick_and_keeps_the_image_when_nothing_is_picked()
    {
        $counter = Counter::create(['image' => 'old.png']);

        // CounterController::update() reads the row id from the form, not the route.
        $this->put(route('counter.update', $counter->id), ['counter_id' => $counter->id, 'library_image' => ''])->assertRedirect();
        $this->assertSame('old.png', $counter->fresh()->image);

        $this->put(route('counter.update', $counter->id), ['counter_id' => $counter->id, 'library_image' => self::PICK])->assertRedirect();
        $this->assertSame('zz-lib-pick.png', $counter->fresh()->image);
    }

    public function test_company_update_saves_library_picks_for_every_image_field()
    {
        $company = Company::firstOrFail();
        $fields = ['image', 'master_page_img_bg', 'book_img', 'transport_img'];

        $this->put(route('company.update', $company->id), collect($fields)
            ->mapWithKeys(fn ($f) => ['library_' . $f => self::PICK])->all())
            ->assertRedirect();

        $company->refresh();
        foreach ($fields as $field) {
            $this->assertSame('zz-lib-pick.png', $company->{$field}, $field);
        }
    }

    public function test_gallery_multi_add_creates_a_row_per_upload_and_per_library_pick()
    {
        $before = Gallery::max('id') ?? 0;

        $this->post(route('galleries.store'), [
            'files' => [UploadedFile::fake()->image('zz-upload.png', 10, 10)],
            'library_files' => [self::PICK, 'visas/anything.png'],
            'active' => '1',
        ])->assertRedirect();

        $images = Gallery::where('id', '>', $before)->pluck('img')->all();
        File::delete(public_path('uploads/galleries/zz-upload.png'));

        // The private-folder path is ignored; the upload and the valid pick each get a row.
        $this->assertEqualsCanonicalizing(['zz-upload.png', 'zz-lib-pick.png'], $images);
    }

    public function test_a_new_upload_still_wins_over_a_library_pick()
    {
        $before = Why_us::max('id') ?? 0;

        $this->post(route('why-us.store'), [
            'image' => UploadedFile::fake()->image('zz-fresh.png', 10, 10),
            'library_image' => self::PICK,
        ])->assertRedirect();

        $row = Why_us::where('id', '>', $before)->firstOrFail();
        File::delete(public_path('uploads/whyUs/' . $row->icon));

        $this->assertStringContainsString('zz-fresh', $row->icon);
        $this->assertFileDoesNotExist(public_path('uploads/whyUs/zz-lib-pick.png'));
    }
}
