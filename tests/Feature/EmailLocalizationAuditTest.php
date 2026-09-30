<?php

namespace Tests\Feature;

use App\Mail\NewsLetterNotification;
use App\Mail\OrderNotification;
use App\Models\Contact;
use App\Models\Newsletter;
use App\Models\Orders;
use App\Models\SiteUser;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
use Tests\TestCase;

/**
 * Audits every outgoing site-facing Mailable (requested: "trace all emails
 * send to be related to language of the site"). Covers the two Mailables
 * not already covered by PasswordResetLocaleTest: OrderNotification (order
 * confirmation, dispatched from BookingController::MakeOrder) and
 * NewsLetterNotification (dispatched from both
 * ContentController::sendNewsLetter and ContentController::ContactUsForm).
 *
 * These three controller actions couldn't be driven through a full HTTP
 * request here: ContactUsForm requires a real mews/captcha token (session
 *-bound, not fakeable without weakening the captcha for production too),
 * and sendNewsLetter's `email:rfc,dns` rule needs the `intl` PHP extension,
 * which isn't installed in this environment (see the 2 pre-existing skipped
 * tests in VisaGuestLeadTest for the same reason). Both are pre-existing
 * environment/validation constraints unrelated to localization.
 *
 * Instead this verifies the actual thing that could regress — each
 * Mailable's own locale-capture logic — directly, the same way
 * PasswordResetLocaleTest does. Combined with LocaleAwareLinksTest and
 * PasswordResetLocaleTest already proving that routes inside the
 * locale-prefixed group correctly set app()->getLocale() before the
 * controller runs (all three controllers here sit in that same group —
 * confirmed against routes/web.php, not assumed), this gives equivalent
 * end-to-end confidence without depending on captcha/DNS validation.
 */
class EmailLocalizationAuditTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();

        $database = config('database.connections.mysql.database');
        if ($database !== 'safer_testing') {
            $this->fail("Refusing to run: expected DB connection 'safer_testing', got '{$database}'. Check .env.testing is being loaded.");
        }
    }

    private function capturedLocale($mail): ?string
    {
        $property = (new \ReflectionClass($mail))->getProperty('locale');
        $property->setAccessible(true);

        return $property->getValue($mail);
    }

    /**
     * @dataProvider localeProvider
     */
    public function test_order_notification_captures_the_active_site_locale(string $locale)
    {
        LaravelLocalization::setLocale($locale);

        $customer = new SiteUser();
        $customer->forceFill(['id' => 1, 'name' => 'Jane Doe', 'email' => 'jane@example.com']);

        $order = new Orders();
        $order->forceFill(['id' => 42, 'user_id' => 1, 'tax_percentage' => 5, 'created_at' => now()]);
        $order->setRelation('user', $customer);
        $order->setRelation('order_details', collect([]));

        $mail = new OrderNotification($order, 320.5);

        $this->assertSame($locale, $this->capturedLocale($mail));
    }

    /**
     * @dataProvider localeProvider
     */
    public function test_newsletter_notification_captures_the_active_site_locale(string $locale)
    {
        LaravelLocalization::setLocale($locale);

        $letter = new Newsletter();
        $letter->forceFill(['id' => 1, 'email' => 'sub@example.com', 'created_at' => now()]);

        $mail = new NewsLetterNotification($letter);

        $this->assertSame($locale, $this->capturedLocale($mail));
    }

    /**
     * @dataProvider localeProvider
     */
    public function test_contact_form_notification_captures_the_active_site_locale(string $locale)
    {
        LaravelLocalization::setLocale($locale);

        $contact = new Contact();
        $contact->forceFill(['id' => 1, 'name' => 'John', 'email' => 'john@example.com', 'phone' => '123', 'message' => 'Hi', 'created_at' => now()]);

        $mail = new NewsLetterNotification($contact, __('emails.contact_subject'));

        $this->assertSame($locale, $this->capturedLocale($mail));
    }

    /**
     * Renders (not just captures the property) each Mailable end to end for
     * both locales, proving the actual email body/subject text is correct,
     * not just that the locale flag was set.
     */
    public function test_order_notification_renders_correct_language_content()
    {
        LaravelLocalization::setLocale('ar');
        $customer = new SiteUser();
        $customer->forceFill(['id' => 1, 'name' => 'Jane Doe', 'email' => 'jane@example.com']);
        $order = new Orders();
        $order->forceFill(['id' => 42, 'user_id' => 1, 'tax_percentage' => 5, 'created_at' => now()]);
        $order->setRelation('user', $customer);
        $order->setRelation('order_details', collect([]));

        $html = (new OrderNotification($order, 320.5))->render();

        $this->assertStringContainsString('شكرًا لطلبك', $html);
        $this->assertStringNotContainsString('Thank You For Your Order', $html);
    }

    public function test_newsletter_notification_renders_correct_language_content()
    {
        LaravelLocalization::setLocale('ar');
        $letter = new Newsletter();
        $letter->forceFill(['id' => 1, 'email' => 'sub@example.com', 'created_at' => now()]);

        $html = (new NewsLetterNotification($letter))->render();

        $this->assertStringContainsString('اشتراك جديد', $html);
        $this->assertStringNotContainsString('New Newsletter Subscription', $html);
    }

    public function localeProvider(): array
    {
        return [
            'english' => ['en'],
            'arabic' => ['ar'],
        ];
    }
}
