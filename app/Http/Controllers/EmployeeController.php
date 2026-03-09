<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Department;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Mail\EmployeeLoginMail;

class EmployeeController extends Controller
{
    public function index()
    {
        $employees = User::where('role', 'employee')->get();

        return view('employees.index', compact('employees'));
    }

    public function create()
    {
        $departments = Department::all();

        return view('employees.create', compact('departments'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required',
            'department_id' => 'required'
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'employee',
            'department_id' => $request->department_id,
            'company_id' => auth()->user()->company_id
        ]);
        Mail::to($user->email)
            ->send(new EmployeeLoginMail($user, $request->password));

        return redirect()->route('employees.index');
    }
}
