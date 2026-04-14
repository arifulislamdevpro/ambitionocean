@extends('adminlte::page')

@section('title', 'Departments')

@section('content_header')
    <div class="d-flex justify-content-between align-items-center">
        <div>
            <h1 class="mb-1">Departments</h1>
            <p class="text-muted mb-0">Manage department records in the admin panel.</p>
        </div>
        <a href="{{ route('departments.create') }}" class="btn btn-primary">
            <i class="fas fa-plus mr-1"></i> Add Department
        </a>
    </div>
@stop

@section('content')
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <x-adminlte-card title="Department List" theme="primary" icon="fas fa-building">
        @if($departments->isEmpty())
            <div class="text-center py-4">
                <p class="text-muted mb-3">No departments found.</p>
                <a href="{{ route('departments.create') }}" class="btn btn-primary">Create the first department</a>
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
                        @foreach($departments as $department)
                            <tr>
                                <td>{{ $department->id }}</td>
                                <td>{{ $department->name }}</td>
                                <td>{{ $department->description ?: 'No description' }}</td>
                                <td>{{ $department->created_at?->format('Y-m-d') }}</td>
                                <td>
                                    <a href="{{ route('departments.show', $department->id) }}" class="btn btn-sm btn-info">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <a href="{{ route('departments.edit', $department->id) }}" class="btn btn-sm btn-warning">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="{{ route('departments.destroy', $department->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button
                                            type="submit"
                                            class="btn btn-sm btn-danger"
                                            onclick="return confirm('Delete this department?')"
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
