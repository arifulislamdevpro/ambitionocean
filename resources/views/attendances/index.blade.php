@extends('adminlte::page')

@section('title', 'Attendances')

@section('content_header')
    <div class="d-flex justify-content-between align-items-center">
        <div>
            <h1 class="mb-1">Attendances</h1>
            <p class="text-muted mb-0">Manage employee attendances in the admin panel.</p>
        </div>
        <div>
            <a href="{{ route('attendances.create') }}" class="btn btn-primary">
                <i class="fas fa-plus mr-1"></i> Add Attendance
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

    <x-adminlte-card title="Filters" theme="secondary" collapsible>
        <form action="{{ route('attendances.index') }}" method="GET">
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label>Date</label>
                        <input type="date" name="date" class="form-control" value="{{ request('date') }}">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label>Employee Name</label>
                        <select name="employee_id" class="form-control">
                            <option value="">All Employees</option>
                            @foreach($employees as $employee)
                                <option value="{{ $employee->id }}" {{ request('employee_id') == $employee->id ? 'selected' : '' }}>
                                    {{ $employee->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-md-4 d-flex align-items-end">
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary mr-2"><i class="fas fa-filter"></i> Filter</button>
                        <a href="{{ route('attendances.index') }}" class="btn btn-default">Clear</a>
                    </div>
                </div>
            </div>
        </form>
    </x-adminlte-card>

    <x-adminlte-card title="Attendance List" theme="primary" icon="fas fa-clock">
        @if($attendances->isEmpty())
            <div class="text-center py-4">
                <p class="text-muted mb-3">No attendances found.</p>
                <a href="{{ route('attendances.create') }}" class="btn btn-primary">Record the first attendance</a>
            </div>
        @else
            <div class="table-responsive">
                <table class="table table-bordered table-striped mb-0">
                    <thead>
                        <tr>
                            <th style="width: 80px;">#</th>
                            <th>Employee</th>
                            <th>Date</th>
                            <th>Check In</th>
                            <th>Check Out</th>
                            <th style="width: 150px;">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($attendances as $att)
                        <tr>
                            <td>{{ $att->id }}</td>
                            <td>{{ $att->employee->name ?? 'N/A' }}</td>
                            <td>{{ $att->date }}</td>
                            <td>{{ $att->check_in }}</td>
                            <td>{{ $att->check_out }}</td>
                            <td>
                                <a href="{{ route('attendances.edit', $att->id) }}" class="btn btn-sm btn-warning">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="{{ route('attendances.destroy', $att->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button
                                        type="submit"
                                        class="btn btn-sm btn-danger"
                                        onclick="return confirm('Delete this attendance record?')"
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