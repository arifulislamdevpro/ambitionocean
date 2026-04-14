@extends('adminlte::page')

@section('title', 'Department Details')

@section('content_header')
    <div class="d-flex justify-content-between align-items-center">
        <h1 class="mb-0">Department Details</h1>
        <div>
            <a href="{{ route('departments.edit', $department->id) }}" class="btn btn-warning">
                <i class="fas fa-edit mr-1"></i> Edit
            </a>
            <a href="{{ route('departments.index') }}" class="btn btn-outline-secondary">Back</a>
        </div>
    </div>
@stop

@section('content')
    <div class="row">
        <div class="col-md-8">
            <x-adminlte-card title="{{ $department->name }}" theme="info" icon="fas fa-building">
                <dl class="row mb-0">
                    <dt class="col-sm-3">ID</dt>
                    <dd class="col-sm-9">{{ $department->id }}</dd>

                    <dt class="col-sm-3">Name</dt>
                    <dd class="col-sm-9">{{ $department->name }}</dd>

                    <dt class="col-sm-3">Description</dt>
                    <dd class="col-sm-9">{{ $department->description ?: 'No description' }}</dd>

                    <dt class="col-sm-3">Created At</dt>
                    <dd class="col-sm-9">{{ $department->created_at?->format('Y-m-d H:i') }}</dd>

                    <dt class="col-sm-3">Updated At</dt>
                    <dd class="col-sm-9">{{ $department->updated_at?->format('Y-m-d H:i') }}</dd>
                </dl>
            </x-adminlte-card>
        </div>
    </div>
@stop
