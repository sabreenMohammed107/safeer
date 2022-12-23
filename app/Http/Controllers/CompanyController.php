<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Http\Requests\StoreCompanyRequest;
use App\Http\Requests\UpdateCompanyRequest;
use App\Models\Contact;

class CompanyController extends Controller
{
    protected $object;
    protected $viewName;
    protected $routeName;

    /**
     * UserController Constructor.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct(Company $object)
    {
        $this->middleware('auth');

        $this->object = $object;
        $this->viewName = 'admin.company.';
        $this->routeName = 'company.';
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreCompanyRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCompanyRequest $request)
    {
        $input = $request->except(['_token','company_id']);

        Company::findOrFail($request->get('company_id'))->update($input);

        return redirect()->route($this->routeName. 'show',$request->get('company_id'))->with('flash_success', 'Successfully Saved!');    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function show(Company $company)
    {
        return view($this->viewName . 'show', compact(['company']));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function edit(Company $company)
    {
        return view($this->viewName . 'edit', compact(['company']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateCompanyRequest  $request
     * @param  \App\Models\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCompanyRequest $request, Company $company)
    {
        $input = $request->except(['_token','image','master_page_img_bg','book_img','transport_img']);

        if ($request->hasFile('image')) {
            $attach_image = $request->file('image');

            $input['image'] = $this->UplaodImage($attach_image);
        }
        if ($request->hasFile('master_page_img_bg')) {
            $attach_image2 = $request->file('master_page_img_bg');

            $input['master_page_img_bg'] = $this->UplaodImage($attach_image2);
        }
        if ($request->hasFile('book_img')) {
            $attach_image3 = $request->file('book_img');

            $input['book_img'] = $this->UplaodImage($attach_image3);
        }
        if ($request->hasFile('transport_img')) {
            $attach_image4 = $request->file('transport_img');

            $input['transport_img'] = $this->UplaodImage($attach_image4);
        }
        $company->update($input);
        return redirect()->route($this->routeName. 'edit',$company->id)->with('flash_success', 'Successfully Saved!');    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function destroy(Company $company)
    {
        //
    }


     /* uplaud image
       */
      public function UplaodImage($file_request)
      {
          //  This is Image Info..
          $file = $file_request;
          $name = $file->getClientOriginalName();
          $ext = $file->getClientOriginalExtension();
          $size = $file->getSize();
          $path = $file->getRealPath();
          $mime = $file->getMimeType();

          // Rename The Image ..
          $imageName = $name;
          $uploadPath = public_path('uploads/company');

          // Move The image..
          $file->move($uploadPath, $imageName);

          return $imageName;
      }


      public function contact()
      {
        $contacts = Contact::orderBy("created_at", "Desc")->get();


        return view($this->viewName . 'contact', compact(['contacts']));
      }
}
