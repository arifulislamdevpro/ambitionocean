<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Projects;

class ProjectController extends Controller
{
    public function index()
    {
        $projects = Projects::latest()->get();
        return view('projects.index', compact('projects'));
    }

    // ✅ Show create form
    public function create()
    {
        return view('projects.create');
    }

    // ✅ Store new project
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:projects,name',
            'description' => 'nullable|string',
        ]);

        Projects::create($request->all());

        return redirect()->route('projects.index')
            ->with('success', 'Project created successfully');
    }

    // ✅ Show single project (optional)
    public function show($id)
    {
        $project = Projects::findOrFail($id);
        return view('projects.show', compact('project'));
    }

    // ✅ Show edit form
    public function edit($id)
    {
        $project = Projects::findOrFail($id);
        return view('projects.edit', compact('project'));
    }

    // ✅ Update project
    public function update(Request $request, $id)
    {
        $project = Projects::findOrFail($id);

        $request->validate([
            'name' => 'required|unique:projects,name,' . $id,
            'description' => 'nullable|string',
        ]);

        $project->update($request->all());

        return redirect()->route('projects.index')
            ->with('success', 'Project updated successfully');
    }

    // ✅ Delete department
    public function destroy($id)
    {
        Projects::destroy($id);

        return redirect()->route('projects.index')
            ->with('success', 'Project deleted successfully');
    }
}
