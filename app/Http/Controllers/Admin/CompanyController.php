<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Company;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class CompanyController extends Controller
{
    public function create()
    {
        return view('admin.companies.create');
    }

    public function index()
    {
        $companies = Company::latest()->get();

        return view('admin.companies.index', compact('companies'));
    }

    public function changeStatus($id)
    {
        $company = Company::findOrFail($id);

        if ($company->status == 'active') {
            $company->status = 'inactive';
        } else {
            $company->status = 'active';
        }

        $company->save();

        return redirect()->back();
    }

    public function store(Request $request)
    {
        $request->validate([
            'company_name' => 'required',
            'admin_name' => 'required',
            'admin_email' => 'required|email|unique:users,email',
            'password' => 'required|min:6'
        ]);

        $company = Company::create([
            'name' => $request->company_name,
            'email' => $request->company_email,
            'phone' => $request->phone,
            'status' => 'active'
        ]);

        User::create([
            'name' => $request->admin_name,
            'email' => $request->admin_email,
            'password' => Hash::make($request->password),
            'role' => 'admin',
            'company_id' => $company->id
        ]);

        return redirect()->route('companies.create')
            ->with('success', 'Company & Admin created successfully');
    }
}
