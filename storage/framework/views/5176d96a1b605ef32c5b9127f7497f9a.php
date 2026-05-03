

<?php $__env->startSection('content'); ?>
<div class="container py-4">
    <div class="row">
        <div class="col-12">
            <!-- Success Alert -->
            <?php if(session('success')): ?>
                <div class="alert alert-success alert-dismissible fade show border-0" role="alert">
                    <i class="fas fa-check-circle me-2"></i><?php echo e(session('success')); ?>

                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            <?php endif; ?>

            <!-- Search + Filters - Perfect Alignment -->
            <div class="card border-1 shadow-lg mb-4">
                <div class="card-body p-4">
                    <div class="row g-3 align-items-end">
                        <div class="col-lg-4 col-md-5">
                            <label class="form-label fw-bold small text-muted mb-1">Search Task</label>
                            <input type="text" class="form-control" id="searchInput" 
                                   placeholder="Search by title or description..."
                                   value="<?php echo e(request('search')); ?>">
                        </div>
                        <div class="col-lg-3 col-md-3">
                            <label class="form-label fw-bold small text-muted mb-1">Status</label>
                            <select class="form-select" id="statusFilter">
                                <option value="">All Status</option>
                                <option value="pending" <?php echo e(request('status') == 'pending' ? 'selected' : ''); ?>>Pending</option>
                                <option value="completed" <?php echo e(request('status') == 'completed' ? 'selected' : ''); ?>>Completed</option>
                            </select>
                        </div>
                        <div class="col-lg-3 col-md-3">
                            <label class="form-label fw-bold small text-muted mb-1">Priority</label>
                            <select class="form-select" id="priorityFilter">
                                <option value="">All Priority</option>
                                <option value="high" <?php echo e(request('priority') == 'high' ? 'selected' : ''); ?>>High</option>
                                <option value="medium" <?php echo e(request('priority') == 'medium' ? 'selected' : ''); ?>>Medium</option>
                                <option value="normal" <?php echo e(request('priority') == 'normal' ? 'selected' : ''); ?>>Normal</option>
                            </select>
                        </div>
                        <div class="col-lg-2 col-md-1">
                            <button class="btn btn-outline-secondary w-100 h-100" id="clearFilters" color="blue">
                                <i class="fas fa-times"></i><br><small><b>Clear</b></small>
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Task Table -->
            <div class="card border-1 shadow-lg">
                <div class="card-header bg-white border-bottom py-3">
                    <div class="d-flex justify-content-between align-items-center">
                        <h4 class="mb-0 fw-bold text-dark">
                            <i class="fas fa-list me-2 text-primary"></i>
                            My Tasks <span class="badge bg-light text-dark ms-2"><?php echo e($todos->total()); ?></span>
                        </h4>
                        <a href="<?php echo e(route('todos.create')); ?>" class="btn btn-primary">
                            <i class="fas fa-plus me-1"></i>New Todo
                        </a>
                    </div>
                </div>
                <div class="card-body p-3">
                    <?php if($todos->count()): ?>
                        <div class="table-responsive">
                            <table class="table table-hover mb-0 align-middle">
                                <thead class="table-light sticky-top">
                                    <tr class="border-bottom border-2">
                                        <th class="border-5 py-3 fw-bold text-uppercase text-muted small ls-1">
                                            <i class="fas fa-square me-1"></i>  Title
                                        </th>
                                        <th class="border-5 py-3 fw-bold text-uppercase text-muted small ls-1 text-center">
                                            <i class="fas fa-star me-1"></i>Priority
                                        </th>
                                        <th class="border-5 py-3 fw-bold text-uppercase text-muted small ls-1 text-center">
                                            <i class="fas fa-circle-check me-1"></i>Status
                                        </th>
                                        <th class="border-5 py-3 fw-bold text-uppercase text-muted small ls-1 text-center">
                                            <i class="fas fa-clock me-1"></i>Last Updated
                                        </th>
                                        <th class="border-5 py-3 fw-bold text-uppercase text-muted small ls-1 text-end">
                                            <i class="fas fa-cogs me-1"></i>Actions
                                        </th>
                                    </tr>
                                </thead>
                                <tbody class="border-top">
                                    <?php $__empty_1 = true; $__currentLoopData = $todos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $todo): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                        <tr class="border-bottom hover-shadow">
                                            <td class="py-3">
                                                <a href="#" class="text-decoration-none fw-semibold text-dark" 
                                                   data-bs-toggle="modal" data-bs-target="#todoModal<?php echo e($todo->id); ?>"
                                                   style="max-width: 300px; display: inline-block;">
                                                    <?php echo e(Str::limit($todo->title, 45)); ?>

                                                </a>
                                            </td>
                                            <td class="py-3 text-center">
                                                <span class="badge fs-6 fw-bold px-2 py-1 <?php echo e($todo->priority === 'high' ?  : ($todo->priority === 'medium' ?  : 'bg-primery')); ?>">
                                                    <?php echo e($todo->priority_stars); ?>

                                                </span>
                                            </td>
                                            <td class="py-3 text-center">
                                                <a href="#" class="status-toggle badge fs-6 px-3 py-2 fw-semibold text-decoration-none
                                                   <?php echo e($todo->status === 'completed' ? 'bg-success text-white shadow-sm' : 'bg-warning text-dark shadow-sm'); ?>"
                                                   data-todo-id="<?php echo e($todo->id); ?>" style="transition: all 0.2s;">
                                                    <?php echo e(ucfirst($todo->status)); ?>

                                                </a>
                                            </td>
                                            <td class="py-3 text-center small text-muted">
                                                <?php echo e($todo->updated_at?->format('M d, H:i') ?? 'Just now'); ?>

                                            </td>
                                            <td class="py-3 text-end">
                                                <div class="btn-group btn-group-sm" role="group">
                                                    <a href="<?php echo e(route('todos.edit', $todo)); ?>" class="btn btn-outline-primary border-1 shadow-sm px-3" title="Edit">
                                                        <i class="fas fa-edit"></i>
                                                    </a>
                                                    <form method="POST" action="<?php echo e(route('todos.destroy', $todo)); ?>" class="d-inline">
                                                        <?php echo csrf_field(); ?> <?php echo method_field('DELETE'); ?>
                                                        <button type="submit" class="btn btn-outline-danger border-1 shadow-sm px-3 ms-1" 
                                                                title="Delete" onclick="return confirm('Delete this todo?')">
                                                            <i class="fas fa-trash"></i>
                                                        </button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>

                                        <!-- Detail Modal -->
                                        <div class="modal fade" id="todoModal<?php echo e($todo->id); ?>" tabindex="-1">
                                            <div class="modal-dialog modal-dialog-centered modal-lg">
                                                <div class="modal-content border-0 shadow-lg">
                                                    <div class="modal-header border-0 bg-light">
                                                        <h5 class="modal-title fw-bold"><?php echo e($todo->title); ?></h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                                    </div>
                                                    <div class="modal-body p-4">
                                                        <div class="row">
                                                            <div class="col-md-8">
                                                                <p class="lead mb-1"><?php echo e($todo->description ?? 'No description added.'); ?></p>
                                                            </div>
                                                            <div class="col-md-4 text-end">
                                                                <span class="badge fs-6 me-2 mb-1"><?php echo e($todo->priority_stars); ?></span>
                                                                <span class="badge fs-6 <?php echo e($todo->status === 'completed' ? 'bg-success' : 'bg-warning'); ?>">
                                                                    <?php echo e(ucfirst($todo->status)); ?>

                                                                </span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                        <tr>
                                            <td colspan="5" class="text-center py-5 border-0">
                                                <div class="text-muted">
                                                    <i class="fas fa-inbox fa-3x mb-3 opacity-50"></i>
                                                    <h5 class="mb-3">No todos match your search</h5>
                                                    <a href="<?php echo e(route('todos.index')); ?>" class="btn btn-outline-primary">
                                                        <i class="fas fa-arrow-left me-1"></i>Clear Filters
                                                    </a>
                                                </div>
                                            </td>
                                        </tr>
                                    <?php endif; ?>
                                </tbody>
                            </table>
                        </div>
                        <div class="card-footer bg-white border-top py-3">
                            <?php echo e($todos->appends(request()->query())->links('pagination::bootstrap-5')); ?>

                        </div>
                    <?php else: ?>
                        <div class="text-center py-5">
                            <i class="fas fa-inbox fa-4x text-muted mb-4"></i>
                            <h4 class="text-muted mb-4">No todos yet</h4>
                            <a href="<?php echo e(route('todos.create')); ?>" class="btn btn-primary btn-lg">
                                <i class="fas fa-plus me-1"></i>Create Your First Todo
                            </a>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>

<?php $__env->startPush('scripts'); ?>
<script>
// Search + Filter + Status Toggle
document.addEventListener('DOMContentLoaded', function() {
    // Filters
    const searchInput = document.getElementById('searchInput');
    const statusFilter = document.getElementById('statusFilter');
    const priorityFilter = document.getElementById('priorityFilter');
    const clearBtn = document.getElementById('clearFilters');

    function applyFilters() {
        const params = new URLSearchParams(window.location.search);
        const search = searchInput.value.trim();
        const status = statusFilter.value;
        const priority = priorityFilter.value;

        if (search) params.set('search', search);
        else params.delete('search');
        if (status) params.set('status', status);
        else params.delete('status');
        if (priority) params.set('priority', priority);
        else params.delete('priority');

        window.location.search = params.toString();
    }

    searchInput.addEventListener('keypress', e => e.key === 'Enter' && applyFilters());
    statusFilter.addEventListener('change', applyFilters);
    priorityFilter.addEventListener('change', applyFilters);
    clearBtn.addEventListener('click', () => window.location.href = "<?php echo e(route('todos.index')); ?>");

    // Status Toggle
    document.querySelectorAll('.status-toggle').forEach(link => {
        link.addEventListener('click', function(e) {
            e.preventDefault();
            const todoId = this.dataset.todoId;
            
            if (confirm('Change status?')) {
                fetch(`/todos/${todoId}/toggle-status`, {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                        'Content-Type': 'application/json',
                        'Accept': 'application/json'
                    }
                })
                .then(res => res.json())
                .then(data => location.reload())
                .catch(err => alert('Error updating status'));
            }
        });
    });
});
</script>
<?php $__env->stopPush(); ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\SS TECHNOLOGY BD\Desktop\TaskNext\resources\views/todos/index.blade.php ENDPATH**/ ?>