<?php

namespace Tests\Feature;

use App\Models\Company;
use Illuminate\Support\Facades\View;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
use Tests\TestCase;

/**
 * Guards against a real bug found in production: `$localVar` (used across
 * ~20 Blade views to build locale-aware links/form actions via
 * LaravelLocalization::getLocalizedURL($localVar, ...)) was being computed
 * once in AppServiceProvider::boot() and shared globally via View::share().
 * Provider boot() runs *before* RouteServiceProvider loads routes/web.php,
 * which is where LaravelLocalization::setLocale() actually detects the
 * locale from the URL's locale prefix — so the shared value was always
 * stale (falling back to the browser's Accept-Language header or the app
 * default), regardless of which locale the current page was actually in.
 * In practice this made e.g. the "forgot password" form on the Arabic site
 * silently POST to the English (unprefixed) route, forcing that whole
 * request — including any translated flash message set during it — back to
 * English even though the page itself rendered correctly in Arabic.
 *
 * Fixed by registering `localVar` via View::composer('*', ...) instead,
 * which runs per-view at render time (after routing has resolved the real
 * locale) rather than once at boot.
 */
class LocaleAwareLinksTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();

        $database = config('database.connections.mysql.database');
        if ($database !== 'safer_testing') {
            $this->fail("Refusing to run: expected DB connection 'safer_testing', got '{$database}'. Check .env.testing is being loaded.");
        }
    }

    private function renderPasswordResetFormAction(string $locale): string
    {
        // Mirrors what real route dispatch does before a controller renders
        // a view: LaravelLocalization::setLocale() runs first (from the
        // URL's locale segment), and only then is the view rendered.
        LaravelLocalization::setLocale($locale);

        $html = View::make('auth.password_reset', [
            'Company' => new Company(),
            'errors' => new \Illuminate\Support\MessageBag(),
        ])->render();

        preg_match('/<form[^>]*action="([^"]*)"/', $html, $matches);

        return $matches[1] ?? '';
    }

    public function test_locale_var_is_arabic_prefixed_when_the_page_is_arabic()
    {
        $action = $this->renderPasswordResetFormAction('ar');

        $this->assertStringContainsString('/ar/password/email', $action);
    }

    public function test_locale_var_is_unprefixed_when_the_page_is_english()
    {
        $action = $this->renderPasswordResetFormAction('en');

        $this->assertStringNotContainsString('/ar/', $action);
        $this->assertStringContainsString('/password/email', $action);
    }
}
