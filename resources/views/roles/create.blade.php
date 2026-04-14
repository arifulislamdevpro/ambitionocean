@extends('adminlte::page')

@section('title', 'Add Role')

@section('content_header')
    <h1 class="m-0 text-dark">Add Role</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-md-6">
            <x-adminlte-card theme="primary" theme-mode="outline">
                <form action="{{ route('roles.store') }}" method="POST">
                    @csrf
                    
                    <div class="form-group">
                        <label>Role Name <span class="text-danger">*</span></label>
                        <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}" required>
                        @error('name') <span class="invalid-feedback">{{ $message }}</span> @enderror
                    </div>

                    <div class="form-group mt-4">
                        <label>Assign Permissions</label>
                        @if($permissions->isEmpty())
                            <p class="text-muted">No permissions available in the system.</p>
                        @else
                            <div class="row">
                                @foreach($permissions as $permission)
                                    <div class="col-md-6">
                                        <div class="custom-control custom-checkbox">
                                            <input class="custom-control-input" type="checkbox" name="permissions[]" id="perm_{{ $permission->id }}" value="{{ $permission->name }}" {{ (is_array(old('permissions')) && in_array($permission->name, old('permissions'))) ? 'checked' : '' }}>
                                            <label for="perm_{{ $permission->id }}" class="custom-control-label">{{ $permission->name }}</label>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @endif
                        @error('permissions') <span class="text-danger d-block mt-2">{{ $message }}</span> @enderror
                    </div>

                    <div class="mt-4">
                        <button type="submit" class="btn btn-primary">Save Role</button>
                        <a href="{{ route('roles.index') }}" class="btn btn-default">Cancel</a>
                    </div>
                </form>
            </x-adminlte-card>
        </div>
    </div>
@stop
