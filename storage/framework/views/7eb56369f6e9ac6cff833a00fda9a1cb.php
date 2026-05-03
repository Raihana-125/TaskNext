

<?php $__env->startSection('content'); ?>
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-8 text-center hero-section">
            <div class="hero p-5 m-3 rounded-4  shadow-lg bg-primary text-white">
                <h1 class="display-4 mb-4">
                    <i class="fas fa-tasks me-3"></i>
                    Welcome to TaskNext !
                </h1>
                <p class="lead mb-4">Manage your tasks efficiently.</p>
                
                <?php if(auth()->guard()->guest()): ?>
                    <div class="d-flex gap-3 justify-content-center flex-wrap">
                        <a href="<?php echo e(route('login')); ?>" class="btn btn-light btn-lg">
                            <i class="fas fa-sign-in-alt me-2"></i>Login
                        </a>
                        <a href="<?php echo e(route('register')); ?>" class="btn btn-light btn-lg">
                            <i class="fas fa-user-plus me-2"></i>Register
                        </a>
                    </div>
                <?php else: ?>
                    <div class="d-flex gap-3 justify-content-center flex-wrap">
                        <a href="<?php echo e(route('dashboard')); ?>" class="btn btn-light btn-lg">
                            <i class="fas fa-tachometer-alt me-2"></i>Dashboard
                        </a>
                        <a href="<?php echo e(route('todos.index')); ?>" class="btn btn-light btn-lg">
                            <i class="fas fa-list me-2"></i>My Task list
                        </a>
                    </div>
                <?php endif; ?>
            </div>
            
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\SS TECHNOLOGY BD\Desktop\TaskNext\resources\views/welcome.blade.php ENDPATH**/ ?>