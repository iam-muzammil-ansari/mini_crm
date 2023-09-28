<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Company; // Import the Company model
use Illuminate\Support\Facades\Storage;

class CompanyController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $company = Company::get(); // Retrieve all companies from the database
        return view('company.index',['company'=>$company]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('company.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
         // Validate the incoming request data
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'logo' => 'required|image|mimes:jpeg,png,jpg,gif|max:3000', // Assuming you want to store images
            'website' => 'required|string|max:255',
        ]);
        
        if ($request->hasFile('logo')) {
            $logoPath = $request->file('logo')->store('public');
            // Remove the "public/" prefix from the storage path
            $logoPath = str_replace('public/', '', $logoPath);
        }
        
        $company = new Company;
        $company->name = $request->name;
        $company->email = $request->email;
        $company->logo = $logoPath;
        $company->website = $request->website;

        $company->save();

        return back()->withSuccess('Company Posted!!!!');

    }


    public function edit($id)
    {
         $company = Company::where('id',$id)->first(); // Find the company by ID
         return view('company.edit', ['company' => $company]);
    }

    // /**
    //  * Update the specified resource in storage.
    //  */
    public function update(Request $request, $id)
    {
         // Validate the incoming request data
         $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'nullable|email|max:255',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:3000', // Assuming you want to store images
            'website' => 'nullable|string|max:255',
        ]);

        $company = Company::where('id',$id)->first();


        if(isset($request->logo)) {
            $logoPath = $request->file('logo')->store('public');
            // Remove the "public/" prefix from the storage path
            $logoPath = str_replace('public/', '', $logoPath);
            $company->logo = $logoPath;
        }
        
        $company->name = $request->name;
        $company->email = $request->email;
        $company->website = $request->website;

        $company->save();

        return back()->withSuccess('Company updated !!!!');
    }

    // /**
    //  * Remove the specified resource from storage.
    //  */
    public function destroy(string $id)
    {
        // Find the company by ID
        $company = Company::where('id',$id)->first();

        // Delete the company's logo file if it exists
        if ($company->logo) {
            Storage::delete($company->logo);
        }

        // Delete the company from the database
        $company->delete();

        // Redirect to the index page with a success message
        return back()->withSuccess('Company Deleted !!!!');
    }
}
