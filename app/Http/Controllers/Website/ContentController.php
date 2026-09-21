<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Website\Concerns\Favouritable;
use App\Mail\NewsLetterNotification;
use App\Models\Blog;
use App\Models\Blogs_category;
use App\Models\Company;
use App\Models\Company_branch;
use App\Models\Contact;
use App\Models\Counter;
use App\Models\Favorite_hotels_tour;
use App\Models\Newsletter;
use App\Models\Offer;
use App\Models\Why_us;
use App\Rules\NoUrl;
use App\Rules\NotBotEmail;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use PhpParser\Node\Expr\AssignOp\Concat;
use Illuminate\Support\Facades\Lang as Lang;
use Illuminate\Support\Facades\Validator as FacadesValidator;
use Validator;
class ContentController extends Controller
{
    use Favouritable;

    private function favouriteOfferIds()
    {
        if (!session()->get("SiteUser")) {
            return [];
        }

        return Favorite_hotels_tour::where('user_id', session()->get("SiteUser")["ID"])
            ->whereNotNull('offer_id')
            ->pluck('offer_id')
            ->toArray();
    }

    public function favouriteToggle($id)
    {
        return $this->toggleFavourite('offer_id', (int) $id);
    }

    public function about()
    {
        $BreadCrumb = [["url" => "/", "name" => Lang::get('links.home')]];
        $Company = Company::first();

        $Counters = Counter::get();
$whyUss=Why_us::all();
        return view("website.about",
            [
                "Company" => $Company,
                "Counters" => $Counters,
                "BreadCrumb" => $BreadCrumb,
                "whyUss" => $whyUss,
            ]);
    }



    public function blogs()
    {
        $BreadCrumb = [["url" => "/", "name" => Lang::get('links.home')]];
        $Company = Company::first();
        $blogs = Blog::where('blog_category_id','!=',100)->paginate(10);
        $categories = Blogs_category::where('id','!=',100)->get();
        $latest = Blog::where('blog_category_id','!=',100)->take(5)->orderBy("created_at", "Desc")->get();
        $offer = Offer::where('active', 1)->where('poster', 1)->inRandomOrder()->first();

        return view("website.blogs.blogs",
            [
                "Company" => $Company,
                "blogs" => $blogs,
                "categories" => $categories,
                "latest" => $latest,
                "BreadCrumb" => $BreadCrumb,
                "offer" => $offer,
            ]);
    }

    public function fetch_data(Request $request)
    {

        if ($request->ajax()) {
            $blogs = Blog::where('blog_category_id','!=',100)->paginate(10);
            return view("website.blogs.blogList",
                [

                    "blogs" => $blogs,

                ])->render();

        }
    }

    public function singleBlog($id)
    {
        $BreadCrumb = [["url" => "/", "name" => Lang::get('links.home')]];
        $Company = Company::first();
        $blog = Blog::where('id', $id)->first();
        $categories = Blogs_category::where('id','!=',100)->get();
        $latest = Blog::where('blog_category_id','!=',100)->take(5)->orderBy("created_at", "Desc")->get();
        $offer = Offer::where('active', 1)->where('poster', 1)->inRandomOrder()->first();

        return view("website.blogs.single",
            [
                "Company" => $Company,
                "blog" => $blog,
                "categories" => $categories,
                "latest" => $latest,
                "BreadCrumb" => $BreadCrumb,
                "offer" => $offer,
            ]);
    }

    public function dynamicFilterBolgs(Request $request){
        if ($request->ajax()) {
            $blogs = Blog::where('blog_category_id','=',$request->catId)->paginate(10);
            return view("website.blogs.blogList",
                [

                    "blogs" => $blogs,

                ])->render();

        }
    }
 /**
  * offers
  */
  public function offers()
  {
      $BreadCrumb = [["url" => "/", "name" => Lang::get('links.home')]];
      $Company = Company::first();
      $offers = Offer::where('active','=',1)->orderBy("created_at", "Desc")->paginate(10);
      $latest = Offer::where('active','=',1)->take(5)->orderBy("created_at", "Desc")->get();
      return view("website.offers.offers",
          [
              "Company" => $Company,
              "offers" => $offers,
              "latest" => $latest,
              "BreadCrumb" => $BreadCrumb,
              "favOfferIds" => $this->favouriteOfferIds(),
          ]);
  }

  public function fetch_data_offer(Request $request)
  {

      if ($request->ajax()) {
        $offers = Offer::where('active','=',1)->orderBy("created_at", "Desc")->paginate(10);
        return view("website.offers.offerList",
              [

                  "offers" => $offers,
                  "favOfferIds" => $this->favouriteOfferIds(),

              ])->render();

      }
  }

  public function singleOffer($id)
  {
      $BreadCrumb = [["url" => "/", "name" => Lang::get('links.home')]];
      $Company = Company::first();
      $offer = Offer::where('id', $id)->first();
      $latest = Offer::where('active','=',1)->take(5)->orderBy("created_at", "Desc")->get();
      return view("website.offers.single",
          [
              "Company" => $Company,
              "offer" => $offer,
              "latest" => $latest,
              "BreadCrumb" => $BreadCrumb,
              "favOfferIds" => $this->favouriteOfferIds(),
          ]);
  }
    // Create Contact Form
    public function createForm(Request $request)
    {
        $BreadCrumb = [["url" => "/", "name" => Lang::get('links.home')]];
        $Company = Company::first();
        $master=Company_branch::where('master_flag',1)->firstorfail();
        $branches = Company_branch::get();
        return view("website.contact",
            [
                "Company" => $Company,
                "branches" => $branches,
                "BreadCrumb" => $BreadCrumb,
                "master" => $master,
            ]);

    }
    // Store Contact Form data
    public function ContactUsForm(Request $request)
    {
        // Honeypot check: this field is hidden from real users via CSS and
        // must stay empty. Bots that auto-fill every input will trip it.
        // We silently pretend success so the bot doesn't adapt its behaviour.
        if (!empty($request->input('website'))) {
            return back()->with('flash_success', Lang::get('links.contactMsg'));
        }

        // Form validation

        $validator = Validator::make($request->all(), [
            'name' => ['required', new NoUrl],
            'email' => 'required|email',
            'phone' => 'required',
            'captcha' => 'required|captcha',
            'message' => ['required', new NoUrl],

        ], [

            'captcha.captcha' => Lang::get('links.captcha_captcha'),
        ]);
        if ($validator->fails()) {

            return redirect()->back()->withInput()
                ->withErrors($validator->messages());

        }
        //  Store data in database, stripping any HTML/script tags first
        Contact::create([
            'name' => strip_tags($request->input('name')),
            'email' => strip_tags($request->input('email')),
            'phone' => strip_tags($request->input('phone')),
            'message' => strip_tags($request->input('message')),
        ]);
        //
        return back() ->withInput($request->input())->with('flash_success',Lang::get('links.contactMsg'));
    }
    public function reloadCaptcha()
    {
        return response()->json(['captcha'=> captcha_img()]);
    }

    public function loginSite(){
        if(session()->get("_previous")){
            $redirectURL = session()->get("_previous")["url"];
            session()->put("redirect_url", $redirectURL);
        }


        $Company = Company::first();
        return view("website.login",
        [
            "Company" => $Company,

        ]);
    }

    public function signupSite(){
        $Company = Company::first();
        return view("website.signup",
        [
            "Company" => $Company,

        ]);
    }


    public function sendNewsLetter(Request $request)
    {
        $wantsJson = $request->ajax() || $request->wantsJson();

        // Honeypot check: hidden field, invisible to real visitors, that
        // spam bots fill in anyway because they auto-populate every input.
        // We fake a success response so the bot has no signal to adapt to.
        if (!empty($request->input('hp_website'))) {
            $message = Lang::get('links.newsletter_success');

            if ($wantsJson) {
                return response()->json(['status' => 'success', 'message' => $message]);
            }

            return redirect()->back()->with('flash_success', $message)->withFragment('newsletter');
        }

        $validator = FacadesValidator::make($request->all(), [
            // `dns` confirms the domain actually has an MX/A record instead of
            // being a made-up domain; `rfc` keeps standard format checking.
            'email' => ['required', 'email:rfc,dns', new NotBotEmail],
        ], [
            'email.required' => Lang::get('links.newsletter_required'),
            'email.email' => Lang::get('links.newsletter_invalid'),
        ]);

        if ($validator->fails()) {
            $message = $validator->errors()->first('email');

            if ($wantsJson) {
                return response()->json(['status' => 'error', 'message' => $message], 422);
            }

            return redirect()->back()
                ->withInput()
                ->withErrors($validator->messages())
                ->withFragment('newsletter'); // Redirects to the #newsletter section
        }

        $email = $request->input('email');

        // No unique DB constraint on newsletters.email, so check explicitly
        // rather than relying on a QueryException that would never fire.
        // Gmail/Googlemail ignore dots in the local part, so compare the
        // normalized form too — otherwise "a.b.c@gmail.com" and "abc@gmail.com"
        // would both be accepted as "unique" despite reaching the same inbox.
        [$local, $domain] = array_pad(explode('@', $email, 2), 2, '');
        $normalizedEmail = in_array(strtolower($domain), ['gmail.com', 'googlemail.com'], true)
            ? str_replace('.', '', $local) . '@' . strtolower($domain)
            : $email;

        $alreadySubscribed = Newsletter::where('email', $email)->exists()
            || Newsletter::where('email', $normalizedEmail)->exists();

        if ($alreadySubscribed) {
            $message = Lang::get('links.newsletter_duplicate');

            if ($wantsJson) {
                return response()->json(['status' => 'error', 'message' => $message], 409);
            }

            return redirect()->back()
                ->withInput($request->input())
                ->with('flash_error', $message)
                ->withFragment('newsletter');
        }

        try {
            $letter = Newsletter::create(['email' => $email]);
            // $emails = ['senior.steps.info@gmail.com', 'Info@Safer.Travel', 'sabreenm312@gmail.com'];
            // \Mail::to($emails)->send(new NewsLetterNotification($letter));
        } catch (QueryException $q) {
            $message = Lang::get('links.newsletter_duplicate');

            if ($wantsJson) {
                return response()->json(['status' => 'error', 'message' => $message], 409);
            }

            return redirect()->back()
                ->withInput($request->input())
                ->with('flash_error', $message)
                ->withFragment('newsletter');
        }

        $message = Lang::get('links.newsletter_success');

        if ($wantsJson) {
            return response()->json(['status' => 'success', 'message' => $message]);
        }

        return redirect()->back()
            ->withInput($request->input())
            ->with('flash_success', $message)
            ->withFragment('newsletter'); // Redirects to the #newsletter section
    }


    public function partners(){
        $BreadCrumb = [["url" => "/", "name" => Lang::get('links.home')]];
        $Company = Company::first();
        return view("website.partners",
            [
                "Company" => $Company,
                "BreadCrumb" => $BreadCrumb,
            ]);
      }
      public function careers(){
        $BreadCrumb = [["url" => "/", "name" => Lang::get('links.home')]];
        $Company = Company::first();
        return view("website.careers",
            [
                "Company" => $Company,
                "BreadCrumb" => $BreadCrumb,
            ]);
      }

      public function agents(){
        $BreadCrumb = [["url" => "/", "name" => Lang::get('links.home')]];
        $Company = Company::first();
        return view("website.Agents",
            [
                "Company" => $Company,
                "BreadCrumb" => $BreadCrumb,
            ]);
      }
}
