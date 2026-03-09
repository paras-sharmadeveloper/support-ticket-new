<?php

namespace App\Http\Controllers;

use App\Models\Department;
use Illuminate\Http\Request;

class DepartmentController extends Controller
{
    public function index()
    {
        $departments = Department::where('company_id', auth()->user()->company_id)->get();
        return view('departments.index', compact('departments'));
    }

    public function create()
    {
        return view('departments.create');
    }
    public function edit($id)
    {
        $department = Department::findOrFail($id);

        return view('departments.create', compact('department'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string'
        ]);

        $department = Department::where('company_id', auth()->user()->company_id)
            ->findOrFail($id);

        $department->update([
            'name' => $request->name,
            'description' => $request->description,
        ]);

        return redirect()
            ->route('departments.index')
            ->with('success', 'Department updated successfully');
    }

    public function store(Request $request)
    {
        Department::create([
            'name' => $request->name,
            'description' => $request->description,
            'company_id' => auth()->user()->company_id
        ]);

        return redirect()->route('departments.index')->with('success', 'Department created');
    }

    public function destroy($id)
    {
        $department = Department::where(
            'company_id',
            auth()->user()->company_id
        )->findOrFail($id);

        $department->delete();

        return redirect()
            ->route('departments.index')
            ->with('success', 'Department deleted successfully');
    }
}
