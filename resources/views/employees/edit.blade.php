@extends('adminlte::page')

@section('title', 'Edit Employee')

@section('content_header')
    <h1>Edit Employee</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-md-8">
            <x-adminlte-card title="Edit {{ $employee->name }}" theme="warning" icon="fas fa-user-edit">
                <form action="{{ route('employees.update', $employee->id) }}" method="POST">
                    @method('PUT')
                    @include('employees._form', ['submitLabel' => 'Update Employee'])
                </form>
            </x-adminlte-card>
        </div>
    </div>
@stop
