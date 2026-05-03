@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-8 col-lg-6">
            <div class="card shadow-lg">
                <div class="card-header bg-primary text-white">
                    <h3 class="mb-0"><i class="fas fa-plus me-2"></i>New Todo</h3>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('todos.store') }}" id="todoForm">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label fw-bold">Title <span class="text-danger">*</span></label>
                            <input type="text" name="title" class="form-control @error('title') is-invalid @enderror"
                                   value="{{ old('title') }}" required>
                            @error('title') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-bold">Description</label>
                            <textarea name="description" rows="4" class="form-control @error('description') is-invalid @enderror"
                                      placeholder="Optional...">{{ old('description') }}</textarea>
                            @error('description') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                        <div class="mb-4">
                            <label class="form-label fw-bold">Priority <span class="text-danger">*</span></label>
                            <select name="priority" class="form-select @error('priority') is-invalid @enderror" required>
                                <option value="normal" {{ old('priority') == 'normal' ? 'selected' : '' }}>Normal ⭐</option>
                                <option value="medium" {{ old('priority') == 'medium' ? 'selected' : '' }}>Medium ⭐⭐</option>
                                <option value="high" {{ old('priority') == 'high' ? 'selected' : '' }}>High ⭐⭐⭐</option>
                            </select>
                            @error('priority') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                        <div class="d-flex gap-3">
                            <a href="{{ route('todos.index') }}" class="btn btn-secondary">Cancel</a>
                            <button type="submit" class="btn btn-primary">Create Todo</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection