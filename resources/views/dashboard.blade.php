@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <div class="d-flex justify-content-between align-items-center">
        <div>
            <h1 class="mb-1">Dashboard</h1>
            <p class="text-muted mb-0">Employee Manager control panel</p>
        </div>
        <div class="text-muted">
            Signed in as <strong>{{ $user->name }}</strong>
        </div>
    </div>
@stop

@section('content')
    <div class="row">
        <div class="col-lg-4 col-12">
            <x-adminlte-small-box title="{{ $stats['users'] }}" text="Registered users" icon="fas fa-users" theme="info" />
        </div>
        <div class="col-lg-4 col-12">
            <x-adminlte-small-box title="{{ $stats['roles'] }}" text="Available roles" icon="fas fa-user-shield" theme="success" />
        </div>
        <div class="col-lg-4 col-12">
            <x-adminlte-small-box title="{{ $stats['permissions'] }}" text="Permission rules" icon="fas fa-key" theme="warning" />
        </div>
    </div>

    <div class="row">
        <div class="col-md-8">
            <x-adminlte-card title="Project Status" theme="primary" icon="fas fa-briefcase">
                <p>This panel is now running on AdminLTE.</p>
                <p class="mb-0">
                    The current setup includes authentication, profile management, dashboard routing,
                    and role infrastructure through Spatie Permission.
                </p>
            </x-adminlte-card>
        </div>
        <div class="col-md-4">
            <x-adminlte-card title="Next Modules" theme="lightblue" icon="fas fa-list-check">
                <ul class="mb-0 pl-3">
                    <li>Employees</li>
                    <li>Departments</li>
                    <li>Attendance</li>
                    <li>Leave requests</li>
                </ul>
            </x-adminlte-card>
        </div>
    </div>
@stop
