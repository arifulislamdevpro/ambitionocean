@extends('adminlte::page')

@section('title', 'Edit Department')

@section('content_header')
    <h1>Edit Department</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-md-8">
            <x-adminlte-card title="Edit {{ $department->name }}" theme="warning" icon="fas fa-edit">
                <form action="{{ route('departments.update', $department->id) }}" method="POST">
                    @include('departments._form', ['submitLabel' => 'Update Department'])
                </form>
            </x-adminlte-card>
        </div>
    </div>
@stop
