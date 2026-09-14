<?php

namespace App\Http\Controllers\SiteAuth;

use App\Http\Controllers\Controller;
use App\Http\Controllers\SiteAuth\AuthController;
use App\Models\SiteUser;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Laravel\Socialite\Facades\Socialite;
use Laravel\Socialite\Two\InvalidStateException;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

class GoogleController extends Controller
{
   public function loginWithGoogle()
    {
       return Socialite::driver('google')->redirect();
    }

    public function callbackFromGoogle()
    {
        try {
            $user = Socialite::driver('google')->user();

            // Check Users Email If Already There (Email/Google Account)
            $saveUser = SiteUser::where('email', $user->getEmail())->first();
            $GoogleNoEmailUser = SiteUser::where("google_id", "=", $user->getId())->first();
            if ($saveUser) {
                $saveUser->google_id = $user->getId();
                $saveUser->save();
            } elseif (!$GoogleNoEmailUser) {
                $saveUser = SiteUser::create([
                    'google_id' => $user->getId(),
                    'name' => $user->getName(),
                    'email' => ($user->getEmail()) ? $user->getEmail() : $user->getName() . $user->getId() . "@g.com",
                    'password' => Hash::make($user->getName() . '@' . $user->getId()),
                    'first_name' => $user->user['given_name'],
                    'last_name' => isset($user->user['family_name']) ? $user->user['family_name'] : "",
                ]);
            } else {
                $saveUser = $GoogleNoEmailUser;
            }


            session()->put("SiteUser", [
                "Email" => $saveUser->email,
                "Name" => $saveUser->name,
                "ID" => $saveUser->id,
                'google_id' => $saveUser->facebook_id,

            ]);


            return AuthController::LoginProcess($saveUser);

            // return redirect()->to(LaravelLocalization::localizeUrl("/"));
        } catch (InvalidStateException $th) {
            // Session/state mismatch (expired session, stale/replayed callback,
            // or the callback was opened in a different session than the one
            // that started the redirect). Clear the leftover OAuth session
            // state so it can't cause the same mismatch on the next attempt,
            // then send the user back to the login page instead of
            // surfacing a raw exception.
            Log::warning('Google OAuth callback: invalid state', ['message' => $th->getMessage()]);

            session()->forget(['state', 'code_verifier']);

            return redirect()->to(LaravelLocalization::localizeUrl("/safer/login"))
                ->with("session-warning", "Google login expired or failed due to session mismatch. Please try again.");
        } catch (\Throwable $th) {
            Log::error('Google OAuth callback failed', ['message' => $th->getMessage()]);

            return redirect()->to(LaravelLocalization::localizeUrl("/"))
                ->with("session-warning", "Google login failed, please try again.");
        }
    }
}
