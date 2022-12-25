<?php

namespace App\Http\Controllers\SiteAuth;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Company;
use App\Models\Favorite_hotels_tour;
use App\Models\SiteUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
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
                    "ID" => $User->id
                ]);
                $request->session()->put("hasCart" , Cart::where("user_id", '=', $User->id)->count());
            } else {
                return redirect()->back()->with("session-danger", "Incorrect Password");
            }
        } else {
            return redirect()->back()->with("session-danger", "No User with Specific Data");
        }

        $redirect_url = "/";
        if (session()->get("cartItem")) {
            $CartItem = Cart::where("user_id", '=', $User->id)->first();
            if ($CartItem) {
                return redirect()->to($redirect_url)->with("session-warning", "A reservation item is already in your cart");
            }

            $CartItem = new Cart();
            $CartItem->user_id              = session()->get("SiteUser")["ID"];
            $CartItem->room_type_cost_id    = session()->get("cartItem")["ID"];
            $CartItem->room_cap             = session()->get("cartItem")["Cap"];
            $CartItem->adults_count         = session()->get("cartItem")["adultsNumber"];
            $CartItem->children_count       = session()->get("cartItem")["childNumber"];
            $CartItem->rooms_count          = session()->get("cartItem")["roomsNumber"];
            $CartItem->nights               = session()->get("cartItem")["Nights"];
            $CartItem->from_date            = session()->get("cartItem")["from_date"];
            $CartItem->to_date              = session()->get("cartItem")["to_date"];
            if(!session()->get("sessionArr")["ages"]){
                $CartItem->ages                 = null;
            }else{
                $CartItem->ages                 = implode(",",session()->get("cartItem")["ages"]);
            }
            $CartItem->save();
            $redirect_url = '/cart';
            session()->forget("cartItem");
            $request->session()->put("hasCart" , 1);

            return redirect()->to($redirect_url)->with("session-success", "Room is added in your cart successfully");
        }

        if(session()->get("AddFavHotel"))
        {
            $input = [
                'hotel_id' => session()->get("AddFavHotel"),
                'user_id' => session()->get("SiteUser")["ID"],
            ];
            Favorite_hotels_tour::create($input);
            session()->forget("AddFavHotel");
            $redirect_url = '/hotels';
        }else if(session()->get("RemFavHotel"))
        {
            $fav = Favorite_hotels_tour::where('hotel_id', session()->get("RemFavHotel"))
            ->where('user_id', session()->get("SiteUser")["ID"])->first();
            if ($fav) {
                $fav->delete();
            }
            session()->forget("RemFavHotel");
            $redirect_url = '/hotels';
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

        try {
            $User = SiteUser::create([
                'name' => $request['name'],
                'email' => $request['email'],
                'password' => Hash::make($request['password']),
            ]);
        } catch(\Illuminate\Database\QueryException $e) {
            $Count = SiteUser::where("Email",'=',$request['email'])->count();
            if($Count){
                return redirect()->to("/safer/register")->with("session-danger","Email Address is Already in-use");
            }else{
                return redirect()->to("/safer/register")->with("session-danger", "Can't Register with this data please try again later");
            }
        }


        return redirect()->to("/safer/login");

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

        if (session()->get("hasCart")) {
            session()->forget('hasCart');
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
