<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Department;

class DepartmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $departments = Department::latest()->get();
        return view('departments.index', compact('departments'));
    }

    // ✅ Show create form
    public function create()
    {
        return view('departments.create');
    }

    // ✅ Store new department
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:departments,name',
            'description' => 'nullable|string',
        ]);

        Department::create($request->all());

        return redirect()->route('departments.index')
            ->with('success', 'Department created successfully');
    }

    // ✅ Show single department (optional)
    public function show($id)
    {
        $department = Department::findOrFail($id);
        return view('departments.show', compact('department'));
    }

    // ✅ Show edit form
    public function edit($id)
    {
        $department = Department::findOrFail($id);
        return view('departments.edit', compact('department'));
    }

    // ✅ Update department
    public function update(Request $request, $id)
    {
        $department = Department::findOrFail($id);

        $request->validate([
            'name' => 'required|unique:departments,name,' . $id,
            'description' => 'nullable|string',
        ]);

        $department->update($request->all());

        return redirect()->route('departments.index')
            ->with('success', 'Department updated successfully');
    }

    // ✅ Delete department
    public function destroy($id)
    {
        Department::destroy($id);

        return redirect()->route('departments.index')
            ->with('success', 'Department deleted successfully');
    }
}
