<?php

namespace App\Http\Controllers\SiteAuth;

use App\Http\Controllers\Controller;
use App\Http\Controllers\SiteAuth\AuthController;
use App\Models\SiteUser;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Laravel\Socialite\Contracts\User as SocialiteUser;
use Laravel\Socialite\Facades\Socialite;
use Laravel\Socialite\Two\InvalidStateException;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

/**
 * "Login with Facebook" for site visitors (SiteUser + the "SiteUser" session,
 * not Laravel's admin auth). Redirect URI: config('services.facebook.redirect').
 */
class FaceBookController extends Controller
{
    public function loginUsingFacebook()
    {
        return Socialite::driver('facebook')->scopes(['email'])->redirect();
    }

    public function callbackFromFacebook()
    {
        // The visitor pressed "Cancel" on Facebook's consent screen.
        if (request()->filled('error')) {
            return redirect()->to(LaravelLocalization::localizeUrl('/safer/login'))
                ->with('session-warning', __('links.facebook_login_cancelled'));
        }

        try {
            $facebookUser = Socialite::driver('facebook')->user();
        } catch (InvalidStateException $e) {
            // Expired session or a callback opened in another browser/session.
            Log::warning('Facebook OAuth callback: invalid state', ['message' => $e->getMessage()]);
            session()->forget(['state']);

            return redirect()->to(LaravelLocalization::localizeUrl('/safer/login'))
                ->with('session-warning', __('links.facebook_login_failed'));
        } catch (\Throwable $e) {
            Log::error('Facebook OAuth callback failed', ['message' => $e->getMessage()]);

            return redirect()->to(LaravelLocalization::localizeUrl('/safer/login'))
                ->with('session-warning', __('links.facebook_login_failed'));
        }

        $siteUser = $this->findOrCreateSiteUser($facebookUser);

        session()->put('SiteUser', [
            'Email' => $siteUser->email,
            'Name' => $siteUser->name,
            'ID' => $siteUser->id,
            'facebook_id' => $siteUser->facebook_id,
        ]);

        // Same post-login flow as email/password: resumes a pending cart item, then redirects.
        return AuthController::LoginProcess($siteUser);
    }

    /**
     * The visitor's account: matched by Facebook ID first (works even when
     * Facebook shares no email), then by email (links an existing account),
     * otherwise a new one.
     */
    private function findOrCreateSiteUser(SocialiteUser $facebookUser): SiteUser
    {
        $facebookId = (string) $facebookUser->getId();
        $email = $facebookUser->getEmail();

        $siteUser = SiteUser::where('facebook_id', $facebookId)->first();
        if ($siteUser) {
            return $siteUser;
        }

        if ($email && ($siteUser = SiteUser::where('email', $email)->first())) {
            $siteUser->facebook_id = $facebookId;
            $siteUser->save();

            return $siteUser;
        }

        $name = trim((string) $facebookUser->getName()) ?: 'Facebook User';
        $nameParts = preg_split('/\s+/', $name);

        return SiteUser::create([
            'facebook_id' => $facebookId,
            'name' => $name,
            // Facebook accounts registered by phone have no email; keep a unique placeholder.
            'email' => $email ?: 'fb_' . $facebookId . '@facebook.local',
            // Random: these accounts sign in through Facebook (or "forgot password" if they have a real email).
            'password' => Hash::make(Str::random(40)),
            'first_name' => $nameParts[0],
            'last_name' => count($nameParts) > 1 ? end($nameParts) : '',
        ]);
    }
}
