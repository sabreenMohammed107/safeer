<?php

namespace App\Http\Controllers\SiteAuth;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Company;
use App\Models\Favorite_hotels_tour;
use App\Models\OrderDetails;
use App\Models\Orders;
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
                ]);
                $request->session()->put("hasCart", Cart::where("user_id", '=', $User->id)->count());
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
            $CartItem->user_id = session()->get("SiteUser")["ID"];
            $CartItem->room_type_cost_id = session()->get("cartItem")["ID"];
            $CartItem->room_cap = session()->get("cartItem")["Cap"];
            $CartItem->adults_count = session()->get("cartItem")["adultsNumber"];
            $CartItem->children_count = session()->get("cartItem")["childNumber"];
            $CartItem->rooms_count = session()->get("cartItem")["roomsNumber"];
            $CartItem->nights = session()->get("cartItem")["Nights"];
            $CartItem->from_date = session()->get("cartItem")["from_date"];
            $CartItem->to_date = session()->get("cartItem")["to_date"];
            if (!session()->get("sessionArr")["ages"]) {
                $CartItem->ages = null;
            } else {
                $CartItem->ages = implode(",", session()->get("cartItem")["ages"]);
            }
            $CartItem->save();
            $redirect_url = '/cart';
            session()->forget("cartItem");
            $request->session()->put("hasCart", 1);

            return redirect()->to($redirect_url)->with("session-success", "Room is added in your cart successfully");
        }

        if (session()->get("AddFavHotel")) {
            $input = [
                'hotel_id' => session()->get("AddFavHotel"),
                'user_id' => session()->get("SiteUser")["ID"],
            ];
            Favorite_hotels_tour::create($input);
            session()->forget("AddFavHotel");
            $redirect_url = '/hotels';
        } else if (session()->get("RemFavHotel")) {
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
        } catch (\Illuminate\Database\QueryException$e) {
            $Count = SiteUser::where("Email", '=', $request['email'])->count();
            if ($Count) {
                return redirect()->to("/safer/register")->with("session-danger", "Email Address is Already in-use");
            } else {
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
        $userSite = SiteUser::where('id', $id)->first();
        $orderData = [];
        // $data=$userSite->favorites();
        $data = Favorite_hotels_tour::where('user_id', $id)->orderBy('id', 'DESC')->limit(3)->get();
        $allRows = Favorite_hotels_tour::where('user_id', $id)->orderBy('id', 'DESC')->get();
        $order = Orders::where('user_id', $id)->first();
        if($order){
            $orderData = OrderDetails::where('order_id', $order->id)->get();
        }
        $Company = Company::first();
        $BreadCrumb = [["url" => "/", "name" => "Home"]];
        return view("website.userProfile",
            [
                "Company" => $Company,
                "userSite" => $userSite,
                "BreadCrumb" => $BreadCrumb,
                "data" => $data,
                "allRows" => $allRows,
                "orderData" => $orderData,
            ]);
    }

    public function loadMoreData(Request $request)
    {
        if ($request->id > 0) {
            //info($request->id);
            \Log::info('clicked');

            $data = Favorite_hotels_tour::where('user_id', session()->get("SiteUser")["ID"])->where('id', '<', $request->id)->limit(3)->orderBy('id', 'DESC')->get();
        }
        $allRows = Favorite_hotels_tour::where('user_id', session()->get("SiteUser")["ID"])->orderBy('id', 'DESC')->get();
        $output = '';
        $last_id = '';

        if (!$data->isEmpty()) {
            $limit = 0;
            $end = 0;
            $i = 0;
            foreach ($data as $row) {
                $output .= '<div class="card-content">
                    <div class=" card setted_tour_cards ">
                        <div class="card_image">
                            <div class="image_overlay">

                                    <img src="' . asset('uploads/hotels') . '/' . $row->hotel->hotel_banner . '"
                                    alt=" blogimage">
                            </div>
                        </div>
                        <div class="card-body  setted_info">
                            <div class="card_info">
                                <h6>' . $row->hotel->hotel_enname . '  ???
                                    ' . $row->hotel->hotel_stars . 'Stars</h6>
                                <span>
                                    <i class="fa-regular fa-heart"></i>
                                </span>
                            </div>
                            <span> <i class="fa-solid fa-location-dot"></i>';
                if ($row->hotel->city && $row->hotel->city->country) {
                    $output .= $row->hotel->city->country->en_country . ' <span>|</span>';
                }
                if ($row->hotel->city) {
                    $output .= $row->hotel->city->en_city . '</span>';
                }

                $output .= '<p>
                                ' . $row->hotel->hotel_enoverview . '

                            </p>
                            <div class="price">
                                <div class="rating">
                                ';

                for ($i = 0; $i < $row->hotel->hotel_stars; $i++) {
                    $output .= '
                                        <i class="fa-solid fa-star"></i>';
                }

                for ($i = 5; $i > $row->hotel->hotel_stars; $i--) {
                    $output .= '<i class="fa-regular fa-star"></i>';
                }

                $output .= '<span> (' . $row->hotel->totalreviews . ' review) </span>
                                </div>
                            </div>
                        </div>
                    </div>
                    </div>';

                $last_id = $row->id;

            }

        }

        \Log::info($output);
        $arr = [
            'output' => $output,
            'last_id' => $last_id,
        ];
        // return json_encode($arr);
        return response()->json($arr);
    }

    public function updateProfile(Request $request)
    {
        $userSite = SiteUser::where('id', $request->get('userId'))->first();
        $input = $request->except(['_token', 'userId']);
        $userSite->update($input);
        return redirect()->back();

    }
}
