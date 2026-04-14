@extends('adminlte::page')

@section('title', 'Projects')

@section('content_header')
    <div class="d-flex justify-content-between align-items-center">
        <div>
            <h1 class="mb-1">Projects</h1>
            <p class="text-muted mb-0">Manage project records in the admin panel.</p>
        </div>
        <a href="{{ route('projects.create') }}" class="btn btn-primary">
            <i class="fas fa-plus mr-1"></i> Add Project
        </a>
    </div>
@stop

@section('content')
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <x-adminlte-card title="Project List" theme="primary" icon="fas fa-project-diagram">
        @if($projects->isEmpty())
            <div class="text-center py-4">
                <p class="text-muted mb-3">No projects found.</p>
                <a href="{{ route('projects.create') }}" class="btn btn-primary">Create the first project</a>
            </div>
        @else
            <div class="table-responsive">
                <table class="table table-bordered table-striped mb-0">
                    <thead>
                        <tr>
                            <th style="width: 80px;">#</th>
                            <th>Name</th>
                            <th>Description</th>
                            <th>Created</th>
                            <th style="width: 220px;">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($projects as $project)
                            <tr>
                                <td>{{ $project->id }}</td>
                                <td>{{ $project->name }}</td>
                                <td>{{ $project->description ?: 'No description' }}</td>
                                <td>{{ $project->created_at?->format('Y-m-d') }}</td>
                                <td>
                                    <a href="{{ route('projects.show', $project->id) }}" class="btn btn-sm btn-info">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <a href="{{ route('projects.edit', $project->id) }}" class="btn btn-sm btn-warning">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="{{ route('projects.destroy', $project->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button
                                            type="submit"
                                            class="btn btn-sm btn-danger"
                                            onclick="return confirm('Delete this project?')"
                                        >
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </x-adminlte-card>
@stop
