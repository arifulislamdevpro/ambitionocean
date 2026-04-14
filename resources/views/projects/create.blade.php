@extends('adminlte::page')

@section('title', 'Create Project')

@section('content_header')
    <h1>Create Project</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-md-8">
            <x-adminlte-card title="New Project" theme="primary" icon="fas fa-plus-circle">
                <form action="{{ route('projects.store') }}" method="POST">
                    @include('projects._form', ['submitLabel' => 'Create Project'])
                </form>
            </x-adminlte-card>
        </div>
    </div>
@stop
