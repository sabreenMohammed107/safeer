<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Models\Blogs_category;
use App\Models\Company;
use App\Models\Company_branch;
use App\Models\Contact;
use App\Models\Counter;
use App\Models\Newsletter;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use PhpParser\Node\Expr\AssignOp\Concat;
use Illuminate\Support\Facades\Lang as Lang;
class ContentController extends Controller
{
    public function about()
    {
        $BreadCrumb = [["url" => "/", "name" => Lang::get('links.home')]];
        $Company = Company::first();

        $Counters = Counter::get();

        return view("website.about",
            [
                "Company" => $Company,
                "Counters" => $Counters,
                "BreadCrumb" => $BreadCrumb,
            ]);
    }



    public function blogs()
    {
        $BreadCrumb = [["url" => "/", "name" => Lang::get('links.home')]];
        $Company = Company::first();
        $blogs = Blog::paginate(10);
        $categories = Blogs_category::get();
        $latest = Blog::take(5)->orderBy("created_at", "Desc")->get();
        return view("website.blogs.blogs",
            [
                "Company" => $Company,
                "blogs" => $blogs,
                "categories" => $categories,
                "latest" => $latest,
                "BreadCrumb" => $BreadCrumb,
            ]);
    }

    public function fetch_data(Request $request)
    {

        if ($request->ajax()) {
            $blogs = Blog::paginate(10);
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
        $categories = Blogs_category::get();
        $latest = Blog::take(5)->orderBy("created_at", "Desc")->get();
        return view("website.blogs.single",
            [
                "Company" => $Company,
                "blog" => $blog,
                "categories" => $categories,
                "latest" => $latest,
                "BreadCrumb" => $BreadCrumb,
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
        // Form validation
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required',
            'phone' => 'required',

            'message' => 'required',
        ]);
        //  Store data in database
          Contact::create($request->all());
        //
        return back()->with('flash_success',Lang::get('links.contactMsg'));
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


    public function sendNewsLetter(Request $request){
        try{

            $letter= Newsletter::create($request->all());
            // $emails = ['senior.steps.info@gmail.com','info@btsconsultant.com','nasser@btsconsultant.com'];
            // \Mail::to($emails)->send(new NewsLetterNotification($letter));


             return redirect()->back()->with('message', Lang::get('links.contactMsg'));
         }
            catch(QueryException $q){

             return redirect()->back()->with('message',Lang::get('links.empLetter'));

         }
    }
}
