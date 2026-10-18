<?php

namespace Tests\Feature;

use App\Models\SiteUser;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Support\Facades\Hash;
use Laravel\Socialite\Facades\Socialite;
use Laravel\Socialite\Two\InvalidStateException;
use Laravel\Socialite\Two\User as SocialiteUser;
use Mockery;
use Tests\TestCase;

/**
 * "Login with Facebook" for site visitors (SiteUser), with Facebook mocked.
 */
class FacebookLoginTest extends TestCase
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

    /** Make Socialite's Facebook driver return this user (or throw this exception). */
    private function facebookReturns(SocialiteUser|\Throwable $result): void
    {
        $provider = Mockery::mock(\Laravel\Socialite\Two\FacebookProvider::class);
        $expectation = $provider->shouldReceive('user');
        $result instanceof \Throwable ? $expectation->andThrow($result) : $expectation->andReturn($result);

        Socialite::shouldReceive('driver')->with('facebook')->andReturn($provider);
    }

    private function facebookUser(string $id, ?string $email, string $name = 'Mona Ali Hassan'): SocialiteUser
    {
        return (new SocialiteUser())->setRaw([])->map(['id' => $id, 'name' => $name, 'email' => $email]);
    }

    public function test_redirects_to_facebook_with_the_configured_app_and_callback()
    {
        config([
            'services.facebook.client_id' => '1558751629355390',
            'services.facebook.client_secret' => 'test-secret',
            'services.facebook.redirect' => 'https://safer.travel/auth/facebook/callback',
        ]);

        $location = $this->get('/auth/facebook')->assertRedirect()->headers->get('Location');

        $this->assertStringStartsWith('https://www.facebook.com/', $location);
        $this->assertStringContainsString('client_id=1558751629355390', $location);
        $this->assertStringContainsString('redirect_uri=' . urlencode('https://safer.travel/auth/facebook/callback'), $location);
        $this->assertStringContainsString('scope=email', $location);
    }

    public function test_the_redirect_setting_is_read_from_facebook_redirect_uri()
    {
        $this->assertSame(
            env('FACEBOOK_REDIRECT_URI', env('FACEBOOK_REDIRECT_URL', 'https://safer.travel/auth/facebook/callback')),
            config('services.facebook.redirect')
        );
    }

    public function test_a_new_visitor_is_registered_and_logged_in()
    {
        $this->facebookReturns($this->facebookUser('fb-new-1', 'fb.new.visitor@example.com'));

        $this->get('/auth/facebook/callback?code=x&state=y')->assertRedirect();

        $user = SiteUser::where('email', 'fb.new.visitor@example.com')->firstOrFail();
        $this->assertSame('fb-new-1', $user->facebook_id);
        $this->assertSame('Mona', $user->first_name);
        $this->assertSame('Hassan', $user->last_name);
        // The password isn't derivable from public Facebook data (it used to be "name@id").
        $this->assertFalse(Hash::check('Mona Ali Hassan@fb-new-1', $user->password));
        $this->assertSame($user->id, session('SiteUser')['ID']);
    }

    public function test_an_existing_account_with_the_same_email_is_linked_not_duplicated()
    {
        $existing = SiteUser::create([
            'name' => 'Existing Visitor', 'email' => 'fb.existing@example.com',
            'password' => Hash::make('secret123'), 'first_name' => 'Existing', 'last_name' => 'Visitor',
        ]);
        $this->facebookReturns($this->facebookUser('fb-link-2', 'fb.existing@example.com'));

        $this->get('/auth/facebook/callback?code=x&state=y')->assertRedirect();

        $this->assertSame(1, SiteUser::where('email', 'fb.existing@example.com')->count());
        $this->assertSame('fb-link-2', $existing->fresh()->facebook_id);
        // Their own password still works.
        $this->assertTrue(Hash::check('secret123', $existing->fresh()->password));
        $this->assertSame($existing->id, session('SiteUser')['ID']);
    }

    public function test_a_returning_visitor_is_found_by_facebook_id_even_without_email()
    {
        $returning = SiteUser::create([
            'name' => 'Phone Signup', 'email' => 'fb_fb-phone-3@facebook.local', 'facebook_id' => 'fb-phone-3',
            'password' => Hash::make('x'), 'first_name' => 'Phone', 'last_name' => 'Signup',
        ]);
        $this->facebookReturns($this->facebookUser('fb-phone-3', null, 'Phone Signup'));

        $this->get('/auth/facebook/callback?code=x&state=y')->assertRedirect();

        $this->assertSame(1, SiteUser::where('facebook_id', 'fb-phone-3')->count());
        $this->assertSame($returning->id, session('SiteUser')['ID']);
    }

    public function test_a_new_visitor_without_email_gets_a_placeholder_address()
    {
        $this->facebookReturns($this->facebookUser('fb-noemail-4', null, 'No Email'));

        $this->get('/auth/facebook/callback?code=x&state=y')->assertRedirect();

        $this->assertSame('fb_fb-noemail-4@facebook.local', SiteUser::where('facebook_id', 'fb-noemail-4')->value('email'));
    }

    public function test_cancelling_on_facebook_returns_to_login_with_a_message()
    {
        $this->get('/auth/facebook/callback?error=access_denied&error_reason=user_denied')
            ->assertRedirect(url('/safer/login'))
            ->assertSessionHas('session-warning', __('links.facebook_login_cancelled'));

        $this->assertNull(session('SiteUser'));
    }

    public function test_a_failed_or_expired_callback_returns_to_login_without_logging_in()
    {
        foreach ([new InvalidStateException(), new \RuntimeException('Facebook is down')] as $error) {
            $before = SiteUser::count();
            $this->facebookReturns($error);

            $this->get('/auth/facebook/callback?code=x&state=y')
                ->assertRedirect(url('/safer/login'))
                ->assertSessionHas('session-warning', __('links.facebook_login_failed'));

            $this->assertNull(session('SiteUser'));
            $this->assertSame($before, SiteUser::count());
        }
    }

    public function test_the_old_callback_path_still_works()
    {
        $this->facebookReturns($this->facebookUser('fb-legacy-5', 'fb.legacy@example.com'));

        $this->get('/facebook/callback?code=x&state=y')->assertRedirect();

        $this->assertSame('fb-legacy-5', SiteUser::where('email', 'fb.legacy@example.com')->value('facebook_id'));
    }

    public function test_login_and_signup_pages_show_the_facebook_button_next_to_google()
    {
        foreach (['/safer/login', '/safer/register'] as $page) {
            $this->get($page)
                ->assertOk()
                ->assertSee('href="' . route('facebook.login') . '" class="btn btn-facebook', false)
                ->assertSee('socail-logins/facebook.webp', false)
                ->assertSee('href="' . route('google.login') . '"', false);
        }
    }
}
