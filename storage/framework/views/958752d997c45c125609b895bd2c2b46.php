

<?php $__env->startSection('content'); ?>
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-8 col-lg-6">
            <?php if(session('success')): ?>
                <div class="alert alert-success alert-dismissible fade show border-0" role="alert">
                    <i class="fas fa-check-circle me-2"></i><?php echo e(session('success')); ?>

                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            <?php endif; ?>

            <div class="card shadow-lg border-0">
                <div class="card-header bg-primary text-white py-4">
                    <div class="text-center">
                        <i class="fas fa-user-circle fa-4x mb-3 opacity-75"></i>
                        <h3 class="mb-0 fw-bold">Profile Settings</h3>
                        <p class="mb-0 opacity-75">Update your account information</p>
                    </div>
                </div>
                <div class="card-body p-5">
                    <form method="POST" action="<?php echo e(route('profile.update')); ?>" class="needs-validation" novalidate>
                        <?php echo csrf_field(); ?>
                        <?php echo method_field('PATCH'); ?>
                        
                        <div class="mb-4">
                            <label class="form-label fw-bold fs-5">Full Name</label>
                            <input type="text" name="name" class="form-control form-control-lg <?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                   value="<?php echo e(old('name', $user->name)); ?>" required>
                            <?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <div class="invalid-feedback"><?php echo e($message); ?></div>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>

                        <div class="mb-4">
                            <label class="form-label fw-bold fs-5">Email Address</label>
                            <input type="email" name="email" class="form-control form-control-lg <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                   value="<?php echo e(old('email', $user->email)); ?>" required>
                            <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <div class="invalid-feedback"><?php echo e($message); ?></div>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>

                        <div class="mb-5">
                            <label class="form-label fw-bold fs-5">New Password</label>
                            <div class="form-text small text-muted mb-2">
                                Leave blank to keep current password
                            </div>
                            <input type="password" name="password" class="form-control form-control-lg <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                placeholder="Enter new password (optional)">
                            <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <div class="invalid-feedback"><?php echo e($message); ?></div>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            <input type="password" name="password_confirmation" class="form-control form-control-lg mt-2"
                                placeholder="Confirm new password (optional)">
                        </div>
                        
                        <div class="d-flex gap-3 justify-content-between flex-wrap">
                            <a href="<?php echo e(route('dashboard')); ?>" class="btn btn-outline-secondary btn-lg px-4">
                                <i class="fas fa-arrow-left me-2"></i>Back to Dashboard
                            </a>
                            <button type="submit" class="btn btn-primary btn-lg px-5">
                                <i class="fas fa-save me-2"></i>Update Profile
                            </button>
                        </div>
                    </form>

                    <!-- Delete Account -->
                    <div class="mt-5 pt-4 border-top">
                        <div class="text-center">
                            <h5 class="text-danger mb-3 fw-bold">Danger Zone</h5>
                            <form method="POST" action="<?php echo e(route('profile.destroy')); ?>" class="d-inline">
                                <?php echo csrf_field(); ?> <?php echo method_field('DELETE'); ?>
                                <button type="submit" class="btn btn-outline-danger btn-lg px-5" 
                                        onclick="return confirm('This will delete your account and all todos permanently! Type your password to confirm.')"
                                        style="border-width: 2px;">
                                    <i class="fas fa-user-times me-2"></i>Delete Profile
                                </button>
                                <input type="password" name="password" placeholder="Confirm password" 
                                       class="form-control mt-2 mx-auto" style="max-width: 300px;" required>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\SS TECHNOLOGY BD\Desktop\TaskNext\resources\views/profile/edit.blade.php ENDPATH**/ ?>