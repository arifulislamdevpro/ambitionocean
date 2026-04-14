@extends('adminlte::page')

@section('title', 'Edit Project')

@section('content_header')
    <h1>Edit Project</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-md-8">
            <x-adminlte-card title="Edit {{ $project->name }}" theme="warning" icon="fas fa-edit">
                <form action="{{ route('projects.update', $project->id) }}" method="POST">
                    @include('projects._form', ['submitLabel' => 'Update Project'])
                </form>
            </x-adminlte-card>
        </div>
    </div>
@stop
