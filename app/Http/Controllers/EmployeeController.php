<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Employee; // Import the Employee model
use App\Models\Company; // Import the Company model

class EmployeeController extends Controller
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
        $employee = Employee::get(); // Retrieve all employees from the database
        return view('employee.index', ['employees' => $employee]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Retrieve all companies from the database
        $companies = Company::get();
        return view('employee.create', ['companies' => $companies]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'company_id' => 'required|exists:companies,id', // Ensure the company exists
            'email' => 'required|email',
            'phone' => 'required|string|max:20',
            'profile_picture' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Handle profile picture file upload
        if ($request->hasFile('profile_picture')) {
            $profilePicturePath = $request->file('profile_picture')->store('public');
            $profilePicturePath = str_replace('public/', '', $profilePicturePath);
        } else {
            $profilePicturePath = null;
        }

        // Create a new employee
        $employee = new Employee;
        $employee->first_name = $request->input('first_name');
        $employee->last_name = $request->input('last_name');
        $employee->company_id = $request->input('company_id');
        $employee->email = $request->input('email');
        $employee->phone = $request->input('phone');
        $employee->profile_picture = $profilePicturePath;

        $employee->save();

        return back()->withSuccess('Employee Posted!!!!');
    }

    public function edit($id)
    {
        $employee = Employee::where('id', $id)->first(); // Find the company by ID
        $companies = Company::get();
        return view('employee.edit', ['employee' => $employee], ['companies' => $companies]);
    }
    public function update(Request $request, $id)
    {
        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'company_id' => 'nullable|exists:companies,id', // Ensure the company exists
            'email' => 'nullable|email',
            'phone' => 'nullable|string|max:20',
            'profile_picture' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $employee = Employee::where('id', $id)->first();

        // Handle profile picture file upload
        // Handle profile picture file upload
        if ($request->hasFile('profile_picture')) {
            $profilePicturePath = $request->file('profile_picture')->store('public');
            $profilePicturePath = str_replace('public/', '', $profilePicturePath);
        } else {
            $profilePicturePath = null;
        }

        // update a new employee
        $employee->first_name = $request->input('first_name');
        $employee->last_name = $request->input('last_name');
        $employee->company_id = $request->input('company_id');
        $employee->email = $request->input('email');
        $employee->phone = $request->input('phone');

        $employee->save();

        return back()->withSuccess('Employee Updated!!!!');
    }

    public function destroy(string $id)
    {
        $employee = Employee::where('id', $id)->first();
        $employee->delete();

        // Redirect to the index page with a success message
        return back()->withSuccess('employee Deleted !!!!');
    }
}
