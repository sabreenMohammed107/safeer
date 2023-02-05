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

class FaceBookController extends Controller
{
    /**
     * Login Using Facebook
     */
    public function loginUsingFacebook()
    {
        return Socialite::driver('facebook')->redirect();
    }

    public function callbackFromFacebook()
    {
        try {
            $user = Socialite::driver('facebook')->user();
            return $user->getEmail();
            $saveUser = SiteUser::where("email","=", $user->getEmail())->first();
            if($saveUser)
            {
                $saveUser->facebook_id = $user->getId();
                $saveUser->save();
            }else{
                $saveUser = SiteUser::create([
                    'facebook_id' => $user->getId(),
                    'name' => $user->getName(),
                    'email' => $user->getEmail(),
                    'password' => Hash::make($user->getName() . '@' . $user->getId())
                ]);
            }


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
            //return redirect()->to("/")->with("session-danger", "Facebook Authentication Failed!");
            throw $th;
        }
    }
}
