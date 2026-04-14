@csrf

<div class="form-group mb-3">
    <label for="name" class="form-label">Employee Name <span class="text-danger">*</span></label>
    <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" 
           value="{{ old('name', $employee->name ?? '') }}" required placeholder="Enter employee name">
    @error('name')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<div class="form-group mb-3">
    <label for="email" class="form-label">Email Address <span class="text-danger">*</span></label>
    <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" 
           value="{{ old('email', $employee->email ?? '') }}" required placeholder="Enter email address">
    @error('email')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<div class="form-group mb-3">
    <label for="iqama" class="form-label">Iqama / ID Number <span class="text-danger">*</span></label>
    <input type="text" class="form-control @error('iqama') is-invalid @enderror" id="iqama" name="iqama" 
           value="{{ old('iqama', $employee->iqama ?? '') }}" required placeholder="Enter Iqama / ID num">
    @error('iqama')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<div class="form-group mb-4">
    <label for="department_id" class="form-label">Department <span class="text-danger">*</span></label>
    <select class="form-control @error('department_id') is-invalid @enderror" id="department_id" name="department_id" required>
        <option value="" disabled {{ old('department_id', $employee->department_id ?? '') == '' ? 'selected' : '' }}>Select Department</option>
        @foreach($departments as $department)
            <option value="{{ $department->id }}" {{ old('department_id', $employee->department_id ?? '') == $department->id ? 'selected' : '' }}>
                {{ $department->name }}
            </option>
        @endforeach
    </select>
    @error('department_id')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<div class="d-flex justify-content-between">
    <a href="{{ route('employees.index') }}" class="btn btn-secondary">Cancel</a>
    <button type="submit" class="btn btn-primary">
        <i class="fas fa-save mr-1"></i> {{ $submitLabel ?? 'Save Employee' }}
    </button>
</div>
