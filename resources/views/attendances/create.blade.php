@extends('adminlte::page')

@section('title', 'Add Attendance')

@section('content_header')
    <h1 class="m-0 text-dark">Add Attendance</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-md-6">
            <x-adminlte-card theme="primary" theme-mode="outline">
                <form action="{{ route('attendances.store') }}" method="POST">
                    @csrf
                    
                    <div class="form-group">
                        <label>Employee <span class="text-danger">*</span></label>
                        <select name="employee_id" class="form-control @error('employee_id') is-invalid @enderror" required>
                            <option value="">Select Employee</option>
                            @foreach($employees as $employee)
                                <option value="{{ $employee->id }}" {{ old('employee_id') == $employee->id ? 'selected' : '' }}>
                                    {{ $employee->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('employee_id') <span class="invalid-feedback">{{ $message }}</span> @enderror
                    </div>

                    <div class="form-group">
                        <label>Date <span class="text-danger">*</span></label>
                        <input type="date" name="date" class="form-control @error('date') is-invalid @enderror" value="{{ old('date', date('Y-m-d')) }}" required>
                        @error('date') <span class="invalid-feedback">{{ $message }}</span> @enderror
                    </div>

                    <div class="form-group">
                        <label>Check In <span class="text-danger">*</span></label>
                        <input type="time" name="check_in" class="form-control @error('check_in') is-invalid @enderror" value="{{ old('check_in') }}" required>
                        @error('check_in') <span class="invalid-feedback">{{ $message }}</span> @enderror
                    </div>

                    <div class="form-group">
                        <label>Check Out</label>
                        <input type="time" name="check_out" class="form-control @error('check_out') is-invalid @enderror" value="{{ old('check_out') }}">
                        @error('check_out') <span class="invalid-feedback">{{ $message }}</span> @enderror
                    </div>

                    <div class="mt-4">
                        <button type="submit" class="btn btn-primary">Save</button>
                        <a href="{{ route('attendances.index') }}" class="btn btn-default">Cancel</a>
                    </div>
                </form>
            </x-adminlte-card>
        </div>
    </div>
@stop
