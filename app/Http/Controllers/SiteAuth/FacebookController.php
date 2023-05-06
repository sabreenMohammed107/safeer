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
            $saveUser = SiteUser::where("email","=", $user->getEmail())->first();
            $FBNoEmailUser = SiteUser::where("facebook_id", "=", $user->getId())->first();
            if($saveUser)
            {
                $saveUser->facebook_id = $user->getId();
                $saveUser->save();
            }
            elseif(!$FBNoEmailUser){
                $nameArr = explode(' ', $user->name);
                $firstname = $nameArr[0];
                $lastname = (count($nameArr) > 1)? $nameArr[count($nameArr) - 1] : '';
                $saveUser = SiteUser::create([
                    'facebook_id' => $user->getId(),
                    'name' => $user->getName(),
                    'email' => ($user->getEmail())? $user->getEmail(): $user->getName().$user->getId()."@fb.com",
                    'password' => Hash::make($user->getName() . '@' . $user->getId()),
                    'first_name' => $firstname,
                    'last_name' => $lastname
                ]);
            }else{
                $saveUser = $FBNoEmailUser;
            }


            session()->put("SiteUser", [
                "Email" => $saveUser->email,
                "Name" => $saveUser->name,
                "ID" => $saveUser->id,
                'facebook_id' => $saveUser->facebook_id,
            ]);

            return AuthController::LoginProcess($saveUser);
            //Auth::loginUsingId($saveUser->id);

            //return redirect()->to(LaravelLocalization::localizeUrl("/"));
        } catch (\Throwable $th) {
            return redirect()->to(LaravelLocalization::localizeUrl("/"))->with("session-danger", "Facebook Authentication Failed!");
            throw $th;
        }
    }
}
