@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-6 col-lg-5">
            <div class="card shadow-lg border-0">
                <div class="card-body p-5">
                    <div class="text-center mb-4">
                        <i class="fas fa-lock-open fa-3x text-success mb-3"></i>
                        <h3 class="mb-0 fw-bold">Reset Password</h3>
                    </div>

                    <form method="POST" action="{{ route('password.update') }}">
                        @csrf
                        <input type="hidden" name="token" value="{{ $token }}">

                        <div class="mb-4">
                            <input type="email" name="email" class="form-control form-control-lg @error('email') is-invalid @enderror"
                                   value="{{ old('email') }}" placeholder="Email address" required>
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <input type="password" name="password" class="form-control form-control-lg @error('password') is-invalid @enderror"
                                   placeholder="New password" required>
                            @error('password')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <input type="password" name="password_confirmation" class="form-control form-control-lg"
                                   placeholder="Confirm new password" required>
                        </div>

                        <button type="submit" class="btn btn-success btn-lg w-100">
                            <i class="fas fa-check me-2"></i>Reset Password
                        </button>
                    </form>

                    <div class="text-center mt-4">
                        <a href="{{ route('login') }}" class="text-decoration-none text-primary fw-semibold">
                            Back to Login
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
