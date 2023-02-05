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
                    'password' => Hash::make($user->getName() . '@' . $user->getId())
                ]);
            } else {
                $saveUser = $GoogleNoEmailUser;
            }
            // if (!$is_user) {

            //     $saveUser = SiteUser::updateOrCreate([
            //         'google_id' => $user->getId(),
            //     ], [
            //         'name' => $user->getName(),
            //         'email' => $user->getEmail(),
            //         'password' => Hash::make($user->getName() . '@' . $user->getId())
            //     ]);
            // } else {
            //     $saveUser = User::where('email',  $user->getEmail())->update([
            //         'google_id' => $user->getId(),
            //     ]);
            //     $saveUser = User::where('email', $user->getEmail())->first();
            // }

            session()->put("SiteUser", [
                "Email" => $saveUser->email,
                "Name" => $saveUser->name,
                "ID" => $saveUser->id,
                'facebook_id' => $saveUser->facebook_id,
            ]);


            AuthController::LoginProcess($saveUser);
            //Auth::loginUsingId($saveUser->id);

            return redirect()->to("/");
        } catch (\Throwable $th) {
            redirect()->to("/");
            throw $th;
        }
    }
}
