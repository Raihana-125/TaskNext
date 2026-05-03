@extends('layouts.app')

@section('content')
<div class="container py-4">
    <!-- Welcome Section -->
    <div class="row justify-content-center mb-5">
        <div class="col-lg-8 text-center">
            <div class="card shadow-lg border-0">
                <div class="card-body p-5">
                    <i class="fas fa-rocket fa-4x text-primary mb-4"></i>
                    <h1 class="card-title mb-3 fw-bold">Welcome Back!</h1>
                    <p class="lead text-muted mb-4">You have <span id="total-count" class="fw-bold text-danger">...</span> tasks in total.</p>

                    <div class="row g-4">
                        <div class="col-md-6">
                            <a href="{{ route('todos.index') }}" class="btn btn-primary btn-lg w-100 h-100 py-4">
                                <i class="fas fa-list fa-2x mb-2 d-block"></i>
                                <h5 class="mb-1">My Task List</h5>
                                <small>View all tasks</small>
                            </a>
                        </div>
                        <div class="col-md-6">
                            <a href="{{ route('todos.create') }}" class="btn btn-primary btn-lg w-100 h-100 py-4">
                                <i class="fas fa-plus fa-2x mb-2 d-block"></i>
                                <h5 class="mb-1">New Todo</h5>
                                <small>Create task</small>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Stats Section -->
    <div class="row g-4 d-flex justify-content-center">
        <!-- Status Overview Card -->
        <div class="col-md-4">
            <div class="card shadow-lg border-1 h-100">
                <div class="card-header bg-primary text-white py-3">
                    <h6 class="mb-0 fw-bold"><i class="fas fa-tasks me-2"></i>Status Overview</h6>
                </div>
                <div class="card-body">
                    <ul class="list-group list-group-flush" id="status-list">
                        <li class="list-group-item d-flex justify-content-between align-items-center border-0 px-0">
                            <span><i class="fas fa-clock text-warning me-2"></i>Pending</span>
                            <span class="badge bg-warning rounded-pill px-3" id="stat-pending">0</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center border-0 px-0">
                            <span><i class="fas fa-check-circle text-success me-2"></i>Completed</span>
                            <span class="badge bg-success rounded-pill px-3" id="stat-completed">0</span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>

        <!-- Priority Overview Card -->
        <div class="col-md-4">
            <div class="card shadow-lg border-1 h-100">
                <div class="card-header bg-primary text-white py-3">
                    <h6 class="mb-0 fw-bold"><i class="fas fa-flag me-2"></i>Priority (Pending Only)</h6>
                </div>
                <div class="card-body">
                    <ul class="list-group list-group-flush" id="priority-list">
                        <li class="list-group-item d-flex justify-content-between align-items-center border-0 px-0">
                            <span><i class="fas fa-exclamation-circle text-danger me-2"></i>High</span>
                            <span class="badge bg-danger rounded-pill px-3" id="stat-high">0</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center border-0 px-0">
                            <span><i class="fas fa-chevron-circle-up text-warning me-2"></i>Medium</span>
                            <span class="badge bg-warning text-dark rounded-pill px-3" id="stat-medium">0</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center border-0 px-0">
                            <span><i class="fas fa-arrow-circle-down text-secondary me-2"></i>Low</span>
                            <span class="badge bg-secondary rounded-pill px-3" id="stat-normal">0</span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    function refreshStats() {

        fetch("{{ route('todos.stats') }}") 
            .then(response => response.json())
            .then(data => {
                // Total tasks update
                const totalEl = document.getElementById('total-count');
                if(totalEl) totalEl.innerText = data.total;

                // Status counts update
                document.getElementById('stat-pending').innerText = data.status.pending;
                document.getElementById('stat-completed').innerText = data.status.completed;

                document.getElementById('stat-high').innerText = data.priority.high;
                document.getElementById('stat-medium').innerText = data.priority.medium;
                document.getElementById('stat-normal').innerText = data.priority.normal;
            })
            .catch(error => console.error('Stats load failed:', error));
    }

    refreshStats();
});
</script>
@endpush
@endsection