<?php

namespace App\Http\Controllers\SiteAuth;

use App\Http\Controllers\Controller;
use App\Http\Controllers\SiteAuth\AuthController;
use App\Models\SiteUser;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Laravel\Socialite\Facades\Socialite;
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
        } catch (\Throwable $th) {
            redirect()->to(LaravelLocalization::localizeUrl("/"));
            throw $th;
        }
    }
}
