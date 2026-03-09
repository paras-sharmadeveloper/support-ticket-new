<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Company;
use App\Models\Subscription;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Models\Plan;

class RegisteredUserController extends Controller
{
    public function create()
    {
        $plans = Plan::all();

        return view('auth.register', compact('plans'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|confirmed',
            'company_name' => 'required'
        ]);

        $company = Company::create([
            'name' => $request->company_name,
            'email' => $request->email
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'company_id' => $company->id,
            'role' => 'company_admin'
        ]);

        Subscription::create([
            'company_id' => $company->id,
            'plan_id' => $request->plan_id,
            'start_date' => now(),
            'status' => 'active'
        ]);

        Auth::login($user);

        return redirect('/dashboard');
    }
}
