<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Department;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Mail\EmployeeLoginMail;
use App\Models\EmailSetting; 
class EmployeeController extends Controller
{
    public function index()
    {
        $employees = User::where(
            'company_id',
            auth()->user()->company_id
        )->where('role', 'employee')
            ->get();

        return view('employees.index', compact('employees'));
    }

    

    public function resendEmail($id)
    {

        $companyId = auth()->user()->company_id ?? 0;

        $emailSetting = EmailSetting::where('company_id', $companyId)->first();

        if (!$emailSetting || !$emailSetting->from_address) {

            return back()->with(
                'error',
                'Email sender is not configured. Please setup Email Settings first.'
            );
        }

        $employee = User::where('company_id', $companyId)
            ->findOrFail($id);

        Mail::to($employee->email)
            ->send(new EmployeeLoginMail($employee, null));

        return back()->with(
            'success',
            'Login email resent successfully'
        );
    }

    public function create()
    {
        $departments = Department::where('company_id', auth()->user()->company_id)->get();

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
