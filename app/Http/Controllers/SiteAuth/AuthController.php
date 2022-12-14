<?php

namespace App\Http\Controllers\SiteAuth;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Company;
use App\Models\SiteUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;

class AuthController extends Controller
{
    public function Login(Request $request)
    {
        /*
        Validating On The Request Data
         */
        $validated = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $User = SiteUser::where("email", '=', $request->email)->first();

        if ($User) {
            $isHashEQ = Hash::check($request->password, $User->password); // Hash Compare
            if ($isHashEQ) {
                $request->session()->put("SiteUser", [
                    "Email" => $User->email,
                    "Name" => $User->name,
                    "ID" => $User->id,
                    "hasCart" => Cart::where("user_id", '=', $User->id)->count(),
                ]);
            } else {
                return redirect()->back()->with("session-danger", "Incorrect Password");
            }
        } else {
            return redirect()->back()->with("session-danger", "No User with Specific Data");
        }

        if (session()->get("redirect_url")) {
            $redirect_url = session()->get("redirect_url");
            session()->forget("redirect_url");
        } else {
            $redirect_url = "/";
        }
        if (session()->get("cartItem")) {
            $CartItem = Cart::where([["user_id", '=', $User->id], ["room_type_cost_id", "=", session()->get("cartItem")["ID"]], ["room_cap", '=', session()->get("cartItem")["Cap"]]])->first();
            if ($CartItem) {
                return redirect()->to($redirect_url)->with("session-warning", "Room is already in your cart");
            }

            $CartItem = new Cart();
            $CartItem->user_id = $User->id;
            $CartItem->room_type_cost_id = session()->get("cartItem")["ID"];
            $CartItem->room_cap = session()->get("cartItem")["Cap"];
            $CartItem->save();

            session()->forget("cartItem");

            return redirect()->to($redirect_url)->with("session-success", "Room is added in your cart successfully");
        }

        return redirect()->to($redirect_url);

    }

    public function Register(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255'],
            'phone' => ['numeric'],
            'password' => ['required', 'string', 'min:8'],
        ]);

        $User = SiteUser::create([
            'name' => $request['name'],
            'email' => $request['email'],
            'password' => Hash::make($request['password']),
        ]);

        return redirect()->to("/safeer/login");

    }

    // Just for Testing
    public function testSessions()
    {
        //session()->forget('SiteUser');
        return session()->all();
    }
    public function Logout()
    {
        if (session()->get("SiteUser")) {
            session()->forget('SiteUser');
        }

        if (session()->get("cartItem")) {
            session()->forget('cartItem');
        }

        return redirect()->back();
    }

    public function profile($id)
    {
        $userSite=SiteUser::where('id',$id)->first();
        $Company = Company::first();
        $BreadCrumb = [["url" => "/", "name" => "Home"]];
        return view("website.userProfile",
        [
            "Company" => $Company,
            "userSite" => $userSite,
            "BreadCrumb" => $BreadCrumb,
        ]);
    }


    public function updateProfile(Request $request){
        $userSite=SiteUser::where('id',$request->get('userId'))->first();
        $input = $request->except(['_token','userId']);
        $userSite->update($input);
        return redirect()->back();

    }
}
