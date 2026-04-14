@csrf

@if(isset($department))
    @method('PUT')
@endif

<div class="form-group">
    <label for="name">Department Name</label>
    <input
        id="name"
        name="name"
        type="text"
        class="form-control @error('name') is-invalid @enderror"
        value="{{ old('name', $department->name ?? '') }}"
        placeholder="Enter department name"
        required
    >
    @error('name')
        <span class="invalid-feedback d-block">{{ $message }}</span>
    @enderror
</div>

<div class="form-group">
    <label for="description">Description</label>
    <textarea
        id="description"
        name="description"
        class="form-control @error('description') is-invalid @enderror"
        rows="4"
        placeholder="Optional department description"
    >{{ old('description', $department->description ?? '') }}</textarea>
    @error('description')
        <span class="invalid-feedback d-block">{{ $message }}</span>
    @enderror
</div>

<div class="d-flex justify-content-between">
    <a href="{{ route('departments.index') }}" class="btn btn-outline-secondary">Back</a>
    <button type="submit" class="btn btn-primary">{{ $submitLabel }}</button>
</div>
