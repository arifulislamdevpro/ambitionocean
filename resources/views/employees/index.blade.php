@extends('adminlte::page')

@section('title', 'Employees')

@section('content_header')
    <div class="d-flex justify-content-between align-items-center">
        <div>
            <h1 class="mb-1">Employees</h1>
            <p class="text-muted mb-0">Manage employee records in the admin panel.</p>
        </div>
        <div>
            <a href="{{ url('employees-demo') }}" class="btn btn-outline-info mr-2">
                <i class="fas fa-file-download mr-1"></i> Demo File
            </a>
            <a href="{{ url('employees-export') }}" class="btn btn-success mr-2">
                <i class="fas fa-file-excel mr-1"></i> Export Excel
            </a>
            <a href="{{ route('employees.create') }}" class="btn btn-primary">
                <i class="fas fa-plus mr-1"></i> Add Employee
            </a>
        </div>
    </div>
@stop

@section('content')
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <x-adminlte-card title="Employee List" theme="primary" icon="fas fa-users">
        
        <div class="mb-4 p-3 bg-light rounded border">
            <form action="{{ url('employees-import') }}" method="POST" enctype="multipart/form-data" class="d-flex align-items-center">
                @csrf
                <div class="form-group mb-0 mr-2 flex-grow-1">
                    <input type="file" name="file" class="form-control" required accept=".xlsx,.xls,.csv">
                </div>
                <button type="submit" class="btn btn-warning">
                    <i class="fas fa-file-upload mr-1"></i> Import Excel
                </button>
            </form>
        </div>

        @if($employees->isEmpty())
            <div class="text-center py-4">
                <p class="text-muted mb-3">No employees found.</p>
                <a href="{{ route('employees.create') }}" class="btn btn-primary">Create the first employee</a>
            </div>
        @else
            <div class="table-responsive">
                <table class="table table-bordered table-striped mb-0">
                    <thead>
                        <tr>
                            <th style="width: 80px;">#</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Iqama/ID</th>
                            <th>Department</th>
                            <th style="width: 220px;">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($employees as $employee)
                            <tr>
                                <td>{{ $employee->id }}</td>
                                <td>{{ $employee->name }}</td>
                                <td>{{ $employee->email }}</td>
                                <td>{{ $employee->iqama }}</td>
                                <td>
                                    @if($employee->department)
                                        <span class="badge badge-info">{{ $employee->department->name }}</span>
                                    @else
                                        <span class="badge badge-secondary">None</span>
                                    @endif
                                </td>
                                <td>
                                    <a href="{{ route('employees.show', $employee->id) }}" class="btn btn-sm btn-info">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <a href="{{ route('employees.edit', $employee->id) }}" class="btn btn-sm btn-warning">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="{{ route('employees.destroy', $employee->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button
                                            type="submit"
                                            class="btn btn-sm btn-danger"
                                            onclick="return confirm('Delete this employee?')"
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
