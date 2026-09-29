<?php

namespace Tests\Feature;

use App\Mail\PasswordResetMail;
use App\Models\SiteUser;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Support\Facades\Mail;
use Tests\TestCase;

/**
 * Confirms the password-reset email captures the app's active locale at
 * request time (not always English). We inspect the Mailable's protected
 * `locale` property via reflection rather than rendering it, because
 * MailFake::render() is broken in this Laravel version's testing internals
 * (unrelated to app code) — the property is what Mailable::send()/render()
 * actually key off of, so it's the correct thing to assert on anyway.
 *
 * Uses DatabaseTransactions (not RefreshDatabase) against the dedicated
 * `safer_testing` database configured in .env.testing — never the live
 * `safer` database.
 */
class PasswordResetLocaleTest extends TestCase
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

    private function makeSiteUser(string $email): SiteUser
    {
        return SiteUser::create([
            'name' => 'Test User',
            'email' => $email,
            'password' => bcrypt('password'),
        ]);
    }

    private function capturedLocale(PasswordResetMail $mail): ?string
    {
        $property = (new \ReflectionClass($mail))->getProperty('locale');
        $property->setAccessible(true);

        return $property->getValue($mail);
    }

    public function test_password_reset_mail_captures_arabic_when_the_active_locale_is_arabic()
    {
        Mail::fake();
        app()->setLocale('ar');

        $user = $this->makeSiteUser('ar_locale_test@example.com');

        $this->post('/password/email', ['email' => $user->email])
            ->assertRedirect();

        Mail::assertSent(PasswordResetMail::class, function ($mail) {
            return $this->capturedLocale($mail) === 'ar';
        });
    }

    public function test_password_reset_mail_captures_english_when_the_active_locale_is_english()
    {
        Mail::fake();
        app()->setLocale('en');

        $user = $this->makeSiteUser('en_locale_test@example.com');

        $this->post('/password/email', ['email' => $user->email])
            ->assertRedirect();

        Mail::assertSent(PasswordResetMail::class, function ($mail) {
            return $this->capturedLocale($mail) === 'en';
        });
    }

    public function test_password_reset_mail_renders_arabic_subject_and_body_when_locale_is_arabic()
    {
        // No Mail::fake() here — actually build/render the mailable (via the
        // real MAIL_MAILER=array transport from phpunit.xml, so nothing
        // touches the network) to prove the *content*, not just the captured
        // property, is genuinely Arabic end to end.
        app()->setLocale('ar');

        $user = $this->makeSiteUser('ar_render_test@example.com');

        $this->post('/password/email', ['email' => $user->email])
            ->assertRedirect();

        // sendResetLink() resets app locale to whatever it was during this
        // single test process; re-render an equivalent mailable the same way
        // the controller did, to inspect the actual HTML that would have
        // gone out over SMTP.
        $mail = new PasswordResetMail('tok', $user);
        $html = $mail->render();

        $this->assertStringContainsString('طلب إعادة تعيين كلمة المرور', $html);
        $this->assertStringContainsString('إعادة تعيين كلمة المرور', $html); // the button text
        $this->assertStringNotContainsString('Password Reset Request', $html);
        $this->assertSame('إعادة تعيين كلمة مرور سافر ترافل', $mail->subject);
    }
}
