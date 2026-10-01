<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Concerns\PicksServerImages;
use App\Models\Company;
use App\Http\Requests\StoreCompanyRequest;
use App\Http\Requests\UpdateCompanyRequest;
use App\Models\Contact;
use App\Models\Newsletter;
use Illuminate\Http\Request;

class CompanyController extends Controller
{
    use PicksServerImages;

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
        } elseif ($picked = $this->pickedLibraryImage($request, 'image', 'company')) {
            $input['image'] = $picked;
        }
        if ($request->hasFile('master_page_img_bg')) {
            $attach_image2 = $request->file('master_page_img_bg');

            $input['master_page_img_bg'] = $this->UplaodImage($attach_image2);
        } elseif ($picked = $this->pickedLibraryImage($request, 'master_page_img_bg', 'company')) {
            $input['master_page_img_bg'] = $picked;
        }
        if ($request->hasFile('book_img')) {
            $attach_image3 = $request->file('book_img');

            $input['book_img'] = $this->UplaodImage($attach_image3);
        } elseif ($picked = $this->pickedLibraryImage($request, 'book_img', 'company')) {
            $input['book_img'] = $picked;
        }
        if ($request->hasFile('transport_img')) {
            $attach_image4 = $request->file('transport_img');

            $input['transport_img'] = $this->UplaodImage($attach_image4);
        } elseif ($picked = $this->pickedLibraryImage($request, 'transport_img', 'company')) {
            $input['transport_img'] = $picked;
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

public function newsletter(){
    $contacts = Newsletter::orderBy("created_at", "Desc")->get();


    return view($this->viewName . 'newsletter', compact(['contacts']));
}

/**
 * Export newsletter subscribers as a CSV file (opens in Excel).
 * GET (no ids) exports every subscriber. "Export Selected" POSTs the chosen
 * ids as one comma-separated `ids` field, since a long id list doesn't fit in
 * a URL; `ids[]=...` arrays are still accepted.
 */
public function exportNewsletter(Request $request)
{
    $ids = $request->input('ids', []);
    if (is_string($ids)) {
        $ids = explode(',', $ids);
    }
    $ids = array_values(array_filter(array_map('intval', (array) $ids)));

    $query = Newsletter::orderBy('created_at', 'desc');
    if (!empty($ids)) {
        $query->whereIn('id', $ids);
    }
    $contacts = $query->get();

    $filename = 'newsletter-subscribers-' . now()->format('Y-m-d-His') . '.csv';

    $headers = [
        'Content-Type' => 'text/csv',
        'Content-Disposition' => "attachment; filename=\"{$filename}\"",
    ];

    $callback = function () use ($contacts) {
        $file = fopen('php://output', 'w');
        // UTF-8 BOM so Excel correctly detects encoding instead of mangling non-ASCII emails.
        fwrite($file, "\xEF\xBB\xBF");
        fputcsv($file, ['Email', 'Created At']);
        foreach ($contacts as $row) {
            $createdAt = optional($row->created_at)->format('Y-m-d H:i:s');
            // Wrapped as ="..." so Excel treats it as literal text instead of
            // auto-converting it to its internal date type, which is what
            // was producing "####" in a narrow column regardless of content.
            fputcsv($file, [$row->email, '="' . $createdAt . '"']);
        }
        fclose($file);
    };

    return response()->stream($callback, 200, $headers);
}
}
