@extends('adminlte::page')

@section('title', 'Employee Details')

@section('content_header')
    <div class="d-flex justify-content-between align-items-center">
        <h1 class="mb-0">Employee Details</h1>
        <div>
            <a href="{{ route('employees.edit', $employee->id) }}" class="btn btn-warning">
                <i class="fas fa-edit mr-1"></i> Edit
            </a>
            <a href="{{ route('employees.index') }}" class="btn btn-outline-secondary">Back</a>
        </div>
    </div>
@stop

@section('content')
    <div class="row">
        <div class="col-md-8">
            <x-adminlte-card title="{{ $employee->name }}" theme="info" icon="fas fa-user">
                <dl class="row mb-0">
                    <dt class="col-sm-3">ID</dt>
                    <dd class="col-sm-9">{{ $employee->id }}</dd>

                    <dt class="col-sm-3">Name</dt>
                    <dd class="col-sm-9">{{ $employee->name }}</dd>

                    <dt class="col-sm-3">Email</dt>
                    <dd class="col-sm-9">
                        <a href="mailto:{{ $employee->email }}">{{ $employee->email }}</a>
                    </dd>

                    <dt class="col-sm-3">Iqama / ID</dt>
                    <dd class="col-sm-9">{{ $employee->iqama }}</dd>

                    <dt class="col-sm-3">Department</dt>
                    <dd class="col-sm-9">
                        @if($employee->department)
                            <span class="badge badge-info">{{ $employee->department->name }}</span>
                        @else
                            <span class="text-muted">None</span>
                        @endif
                    </dd>

                    <dt class="col-sm-3">Created At</dt>
                    <dd class="col-sm-9">{{ $employee->created_at?->format('Y-m-d H:i') }}</dd>

                    <dt class="col-sm-3">Updated At</dt>
                    <dd class="col-sm-9">{{ $employee->updated_at?->format('Y-m-d H:i') }}</dd>
                </dl>
            </x-adminlte-card>
        </div>
    </div>
@stop
