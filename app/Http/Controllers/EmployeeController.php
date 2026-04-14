<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Employee;
use App\Models\Department;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\EmployeesImport;
use App\Exports\EmployeesExport;

class EmployeeController extends Controller
{
    public function index()
    {
        $employees = Employee::with('department')->get();
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
            'email' => 'required|email|unique:employees',
            'iqama' => 'required|unique:employees',
            'department_id' => 'required'
        ]);

        Employee::create($request->all());

        return redirect()->route('employees.index')->with('success', 'Created');
    }

    public function show($id)
    {
        $employee = Employee::with('department')->findOrFail($id);
        return view('employees.show', compact('employee'));
    }

    public function edit($id)
    {
        $employee = Employee::findOrFail($id);
        $departments = Department::all();

        return view('employees.edit', compact('employee','departments'));
    }

    public function update(Request $request, $id)
    {
        $employee = Employee::findOrFail($id);

        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:employees,email,' . $id,
            'iqama' => 'required|unique:employees,iqama,' . $id,
            'department_id' => 'required'
        ]);

        $employee->update($request->all());

        return redirect()->route('employees.index')->with('success', 'Updated');
    }

    public function destroy($id)
    {
        Employee::destroy($id);
        return back()->with('success', 'Deleted');
    }

    // ✅ Export Excel
    public function export()
    {
        return Excel::download(new EmployeesExport, 'employees.xlsx');
    }

    // ✅ Import Excel
    public function import(Request $request)
    {
        Excel::import(new EmployeesImport, $request->file('file'));
        return back()->with('success', 'Excel Imported Successfully');
    }

    // ✅ Download Demo File
    public function demo()
    {
        return Excel::download(new \App\Exports\EmployeesDemoExport, 'employee_demo.xlsx');
    }
}