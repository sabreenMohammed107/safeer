<?php

namespace App\Http\Controllers\SiteAuth\Services;

use App\Models\SiteUser;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;

class RememberMeService
{
    public static function GenerateToken(SiteUser $user)
    {
        // Generate Token || Retrieve the already set token
        $token = ($user->remember_token)? $user->remember_token : bin2hex(random_bytes(16));
        // Return the combined encrypted cookie value
        //      - Changing Password Requires New Remember Me Token Generation
        $rem_token = encrypt($user->name.'|'.$token.'|'.$user->password);

        // $response = new Response('Set Cookie');
        // $response->withCookie(cookie('SAFER_REMEMBER_TOKEN', $rem_token, 43200)); // It should last for 30 days
    }
}
