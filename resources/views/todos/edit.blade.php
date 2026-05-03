@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-8 col-lg-6">
            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            <div class="card shadow-lg">
                <div class="card-header bg-success text-white">
                    <h3 class="mb-0">
                        <i class="fas fa-edit me-2"></i>Edit Todo
                    </h3>
                </div>
                <div class="card-body p-4">
                    <form method="POST" action="{{ route('todos.update', $todo) }}" id="editForm">
                        @csrf
                        @method('PUT')
                        
                        <div class="mb-3">
                            <label class="form-label fw-bold">Title <span class="text-danger">*</span></label>
                            <input type="text" name="title" id="title" 
                                   class="form-control @error('title') is-invalid @enderror"
                                   value="{{ old('title', $todo->title) }}" required>
                            @error('title')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-bold">Description</label>
                            <textarea name="description" id="description" rows="4"
                                      class="form-control @error('description') is-invalid @enderror"
                                      placeholder="Optional description...">{{ old('description', $todo->description) }}</textarea>
                            @error('description')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-bold">Status <span class="text-danger">*</span></label>
                            <select name="status" id="status" class="form-select @error('status') is-invalid @enderror" required>
                                <option value="pending" {{ old('status', $todo->status) === 'pending' ? 'selected' : '' }}>
                                    Pending
                                </option>
                                <option value="completed" {{ old('status', $todo->status) === 'completed' ? 'selected' : '' }}>
                                    Completed
                                </option>
                            </select>
                            @error('status')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label class="form-label fw-bold">Priority <span class="text-danger">*</span></label>
                            <select name="priority" id="priority" class="form-select @error('priority') is-invalid @enderror" required>
                                <option value="normal" {{ old('priority', $todo->priority) === 'normal' ? 'selected' : '' }}>
                                    Normal ⭐
                                </option>
                                <option value="medium" {{ old('priority', $todo->priority) === 'medium' ? 'selected' : '' }}>
                                    Medium ⭐⭐
                                </option>
                                <option value="high" {{ old('priority', $todo->priority) === 'high' ? 'selected' : '' }}>
                                    High ⭐⭐⭐
                                </option>
                            </select>
                            @error('priority')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="d-flex gap-3 justify-content-between">
                            <a href="{{ route('todos.index') }}" class="btn btn-secondary">
                                <i class="fas fa-arrow-left me-1"></i> Cancel
                            </a>
                            <button type="submit" class="btn btn-success btn-lg">
                                <i class="fas fa-save me-1"></i> Update Todo
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    document.getElementById('editForm').addEventListener('submit', function(e) {
        const title = document.getElementById('title').value.trim();
        if (!title) {
            e.preventDefault();
            alert('Title is required!');
            document.getElementById('title').focus();
            return false;
        }
    });
});
</script>
@endpush
@endsection