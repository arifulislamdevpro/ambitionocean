@extends('adminlte::page')

@section('title', 'Create Department')

@section('content_header')
    <h1>Create Department</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-md-8">
            <x-adminlte-card title="New Department" theme="primary" icon="fas fa-plus-circle">
                <form action="{{ route('departments.store') }}" method="POST">
                    @include('departments._form', ['submitLabel' => 'Create Department'])
                </form>
            </x-adminlte-card>
        </div>
    </div>
@stop
