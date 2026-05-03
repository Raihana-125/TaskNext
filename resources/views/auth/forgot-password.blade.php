@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-6 col-lg-5">
            <div class="card shadow-lg border-0">
                <div class="card-body p-5 text-center">
                    <i class="fas fa-key fa-3x text-primary mb-4"></i>
                    <h3 class="mb-3 fw-bold">Forgot Password?</h3>
                    <p class="text-muted mb-4">Enter your email to receive a password reset link.</p>
                    
                    @if (session('status'))
                        <div class="alert alert-success border-0">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form method="POST" action="{{ route('password.email') }}">
                        @csrf
                        <div class="mb-4">
                            <input type="email" name="email" class="form-control form-control-lg @error('email') is-invalid @enderror"
                                   value="{{ old('email') }}" placeholder="Enter your email" required>
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <button type="submit" class="btn btn-primary btn-lg w-100 mb-3">
                            <i class="fas fa-paper-plane me-2"></i>Send Reset Link
                        </button>
                    </form>
                    <a href="{{ route('login') }}" class="text-decoration-none text-primary fw-semibold">
                        <i class="fas fa-arrow-left me-2"></i>Back to Login
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
