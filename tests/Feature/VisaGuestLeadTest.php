<?php

namespace Tests\Feature;

use App\Models\Cart;
use App\Models\Country;
use App\Models\Nationality;
use App\Models\User;
use App\Models\Visa_type;
use App\Models\VisaLead;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

/**
 * Exercises the guest visa lead flow: a not-logged-in visitor submitting the
 * /visa form goes to a `visa_leads` row (never the cart table), and admins
 * can manage those leads. Uses DatabaseTransactions against the dedicated
 * `safer_testing` database (see TeamModuleTest for the same convention).
 */
class VisaGuestLeadTest extends TestCase
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

    private function makeVisaOptions(): array
    {
        $country = Country::create(['en_country' => 'Testland', 'ar_country' => 'تيست لاند', 'flag' => 0]);
        $type = Visa_type::create(['en_type' => 'Tourist', 'ar_type' => 'سياحية', 'country_id' => $country->id]);
        $nationality = Nationality::create(['en_nationality' => 'Testonian', 'ar_nationality' => 'تيستوني']);

        return [$country, $type, $nationality];
    }

    public function test_visa_leads_table_has_the_expected_schema()
    {
        $this->assertTrue(Schema::hasTable('visa_leads'));
        $this->assertTrue(Schema::hasColumns('visa_leads', [
            'country_id', 'visa_type_id', 'nationality_id', 'visa_id',
            'passenger_name', 'mobile_number', 'email',
            'passport_image', 'personal_image', 'status', 'notes',
        ]));
    }

    public function test_guest_submission_creates_a_visa_lead_and_not_a_cart_row()
    {
        // The controller validates email with `email:rfc,dns` (matching the
        // existing bookVisas convention), whose DNS check silently rejects
        // every address when the `intl` extension isn't loaded — true on a
        // stock XAMPP install where php_intl.dll ships disabled in php.ini.
        if (!extension_loaded('intl')) {
            $this->markTestSkipped('email:rfc,dns validation requires the intl PHP extension.');
        }

        Storage::fake('public');
        [$country, $type, $nationality] = $this->makeVisaOptions();

        $response = $this->post(route('visa.guest.store'), [
            'country' => $country->id,
            'visa_type_id' => $type->id,
            'nation' => $nationality->id,
            'name' => 'Guest Traveller',
            'email' => 'guest@example.com',
            'phone' => '+201112223334',
            'passport' => UploadedFile::fake()->image('passport.jpg'),
            'personal' => UploadedFile::fake()->image('personal.jpg'),
        ]);

        $response->assertRedirect();
        $response->assertSessionHas('session-success');

        $this->assertSame(0, Cart::count());

        $lead = VisaLead::firstOrFail();
        $this->assertSame('Guest Traveller', $lead->passenger_name);
        $this->assertSame('guest@example.com', $lead->email);
        $this->assertSame('pending', $lead->status);
        $this->assertSame($country->id, $lead->country_id);
        $this->assertSame($type->id, $lead->visa_type_id);
        $this->assertSame($nationality->id, $lead->nationality_id);

        Storage::disk('public')->assertExists('uploads/visa-leads/' . $lead->passport_image);
        Storage::disk('public')->assertExists('uploads/visa-leads/' . $lead->personal_image);
    }

    public function test_guest_submission_honeypot_silently_drops_the_request()
    {
        Storage::fake('public');
        [$country, $type, $nationality] = $this->makeVisaOptions();

        $response = $this->post(route('visa.guest.store'), [
            'hp_website' => 'http://spam.example',
            'country' => $country->id,
            'visa_type_id' => $type->id,
            'nation' => $nationality->id,
            'name' => 'Bot',
            'email' => 'bot@example.com',
            'phone' => '000',
            'passport' => UploadedFile::fake()->image('passport.jpg'),
            'personal' => UploadedFile::fake()->image('personal.jpg'),
        ]);

        $response->assertRedirect();
        $this->assertSame(0, VisaLead::count());
    }

    public function test_guest_submission_requires_the_core_fields()
    {
        // Personal Image is deliberately excluded here: it's only required
        // when the visa request country is the UAE (see the two tests
        // below), so an empty submission with no country picked at all must
        // not report it as missing.
        $response = $this->post(route('visa.guest.store'), []);

        $response->assertSessionHasErrors(['country', 'visa_type_id', 'nation', 'name', 'email', 'phone', 'passport']);
        $response->assertSessionDoesntHaveErrors(['personal']);
        $this->assertSame(0, VisaLead::count());
    }

    public function test_personal_image_is_required_when_country_is_uae()
    {
        $uae = Country::create(['en_country' => 'United Arab Emirates', 'ar_country' => 'الإمارات', 'flag' => 0]);
        $type = Visa_type::create(['en_type' => 'Tourist', 'ar_type' => 'سياحية', 'country_id' => $uae->id]);
        $nationality = Nationality::create(['en_nationality' => 'Testonian', 'ar_nationality' => 'تيستوني']);

        $response = $this->post(route('visa.guest.store'), [
            'country' => $uae->id,
            'visa_type_id' => $type->id,
            'nation' => $nationality->id,
            'name' => 'Guest Traveller',
            'email' => 'guest@example.com',
            'phone' => '+201112223334',
            'passport' => UploadedFile::fake()->image('passport.jpg'),
            // 'personal' intentionally omitted
        ]);

        $response->assertSessionHasErrors(['personal']);
        $this->assertSame(0, VisaLead::count());
    }

    public function test_personal_image_is_optional_for_a_non_uae_country()
    {
        if (!extension_loaded('intl')) {
            $this->markTestSkipped('email:rfc,dns validation requires the intl PHP extension.');
        }

        Storage::fake('public');
        [$country, $type, $nationality] = $this->makeVisaOptions();

        $response = $this->post(route('visa.guest.store'), [
            'country' => $country->id,
            'visa_type_id' => $type->id,
            'nation' => $nationality->id,
            'name' => 'Guest Traveller',
            'email' => 'guest@example.com',
            'phone' => '+201112223334',
            'passport' => UploadedFile::fake()->image('passport.jpg'),
            // 'personal' intentionally omitted
        ]);

        $response->assertSessionDoesntHaveErrors(['personal']);

        $lead = VisaLead::firstOrFail();
        $this->assertNull($lead->personal_image);
    }

    public function test_admin_can_view_update_and_delete_a_visa_lead()
    {
        [$country, $type, $nationality] = $this->makeVisaOptions();
        $lead = VisaLead::create([
            'country_id' => $country->id,
            'visa_type_id' => $type->id,
            'nationality_id' => $nationality->id,
            'passenger_name' => 'Existing Guest',
            'mobile_number' => '+201234567890',
            'email' => 'existing@example.com',
            'passport_image' => 'passport.jpg',
            'personal_image' => 'personal.jpg',
            'status' => 'pending',
        ]);

        $admin = $this->makeAdmin('admin_visa_lead_test1@example.com');

        $this->actingAs($admin)->get(route('visa-leads.index'))
            ->assertOk()
            ->assertSee('Existing Guest');

        $this->actingAs($admin)->get(route('visa-leads.show', $lead->id))
            ->assertOk()
            ->assertSee('existing@example.com');

        $this->actingAs($admin)->put(route('visa-leads.update', $lead->id), [
            'status' => 'contacted',
            'notes' => 'Called, awaiting documents.',
        ])->assertRedirect(route('visa-leads.index'));

        $lead->refresh();
        $this->assertSame('contacted', $lead->status);
        $this->assertSame('Called, awaiting documents.', $lead->notes);

        $this->actingAs($admin)->delete(route('visa-leads.destroy', $lead->id))
            ->assertRedirect();

        $this->assertNull(VisaLead::find($lead->id));
    }

    public function test_visa_leads_admin_routes_require_authentication()
    {
        [$country, $type, $nationality] = $this->makeVisaOptions();
        $lead = VisaLead::create([
            'country_id' => $country->id,
            'visa_type_id' => $type->id,
            'nationality_id' => $nationality->id,
            'passenger_name' => 'Guarded Guest',
            'mobile_number' => '+201234567890',
            'email' => 'guarded@example.com',
            'passport_image' => 'passport.jpg',
            'personal_image' => 'personal.jpg',
            'status' => 'pending',
        ]);

        $this->get(route('visa-leads.index'))->assertRedirect(route('login'));
        $this->assertNotNull(VisaLead::find($lead->id));
    }
}
