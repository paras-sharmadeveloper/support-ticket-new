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

    public function edit($id)
    {
        $company = Company::findOrFail($id);

        $admin = User::where('company_id', $company->id)
            ->where('role', 'admin')
            ->first();

        return view('admin.companies.create', compact('company', 'admin'));
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

    public function update(Request $request, $id)
    {

        $company = Company::findOrFail($id);
        // dd($request->all());

        $company->update([

            'name' => $request->company_name,
            'email' => $request->company_email,
            'phone' => $request->phone,
            'status' => $request->status

        ]);

        // update company admin

        $admin = User::where('company_id', $company->id)
            ->where('role', 'admin')
            ->first();

        if ($admin) {

            $admin->update([

                'name' => $request->admin_name,
                'email' => $request->admin_email

            ]);

            if ($request->password) {

                $admin->password = Hash::make($request->password);
                $admin->save();
            }
        }

        return redirect()
            ->route('companies.index')
            ->with('success', 'Company updated successfully');
    }
}
