@extends('adminlte::page')

@section('title', 'Create Employee')

@section('content_header')
    <h1>Create Employee</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-md-8">
            <x-adminlte-card title="New Employee" theme="primary" icon="fas fa-user-plus">
                <form action="{{ route('employees.store') }}" method="POST">
                    @include('employees._form', ['submitLabel' => 'Create Employee'])
                </form>
            </x-adminlte-card>
        </div>
    </div>
@stop
