<?php $__env->startSection('content'); ?>
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-6 col-lg-5">
            <div class="card shadow-lg">
                <div class="card-body p-5">
                    <div class="text-center mb-4">
                        <i class="fas fa-sign-in-alt fa-3x text-primary mb-3"></i>
                        <h2>Login</h2>
                    </div>

                    <form method="POST" action="<?php echo e(route('login')); ?>">
                        <?php echo csrf_field(); ?>
                        
                        <div class="mb-3">
                            <label class="form-label">Email</label>
                            <input type="email" class="form-control <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" 
                                   name="email" value="<?php echo e(old('email')); ?>" required autofocus>
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

                        <div class="mb-4">
                            <label class="form-label">Password</label>
                            <input type="password" class="form-control <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" 
                                   name="password" required>
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
                        </div>

                        <div class="mb-4 text-end">
                            <a href="#" class="text-decoration-none text-primary fw-semibold small" data-bs-toggle="modal" data-bs-target="#forgotPasswordModal">
                                <i class="fas fa-key me-1"></i>Forgot Password?
                            </a>
                        </div>                        

                        <div class="d-grid">
                            <button type="submit" class="btn btn-primary btn-lg">Login</button>
                        </div>
                    </form>

                    <div class="text-center mt-4">
                        <a href="<?php echo e(route('register')); ?>" class="text-decoration-none">Haven't registered yet?</a>
                    </div>

<!-- Forgot Password Modal -->
<div class="modal fade" id="forgotPasswordModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow-lg">
            <div class="modal-header border-0 bg-primary text-white py-4">
                <h5 class="modal-title fw-bold mb-0">
                    <i class="fas fa-key me-2"></i>Reset Password
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body p-4">
                <!-- Success/Error Messages -->
                <div id="modalAlert" class="alert d-none border-0 mb-3"></div>

                <form id="resetPasswordForm">
                    <?php echo csrf_field(); ?>
                    <!-- Step 1: Verify Email -->
                    <div id="emailStep">
                        <div class="mb-3">
                            <label class="form-label fw-bold">Email Address</label>
                            <input type="email" name="email" id="resetEmail" class="form-control" placeholder="Enter registered email" required>
                        </div>
                        <button type="button" id="verifyBtn" class="btn btn-primary w-100 py-2 fw-bold" onclick="verifyEmail()">
                            Verify Email
                        </button>
                    </div>

                    <!-- Step 2: New Password (Initially Hidden) -->
                    <div id="passwordStep" class="d-none">
                        <div class="mb-3">
                            <label class="form-label fw-bold">New Password</label>
                            <input type="password" name="password" id="resetPassword" class="form-control" minlength="8">
                        </div>
                        <div class="mb-4">
                            <label class="form-label fw-bold">Confirm Password</label>
                            <input type="password" name="password_confirmation" id="resetPasswordConfirm" class="form-control">
                        </div>
                        <div class="d-flex gap-2">
                            <button type="button" class="btn btn-outline-secondary flex-fill" onclick="backToEmail()">Back</button>
                            <button type="submit" id="updateBtn" class="btn btn-primary flex-fill fw-bold">Update Password</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    const emailStep = document.getElementById('emailStep');
    const passwordStep = document.getElementById('passwordStep');
    const modalAlert = document.getElementById('modalAlert');
    const resetEmailInput = document.getElementById('resetEmail');

    function showAlert(msg, type) {
        modalAlert.innerText = msg;
        modalAlert.className = `alert alert-${type} border-0 mb-3`;
        modalAlert.classList.remove('d-none');
    }

    async function verifyEmail() {
        const email = resetEmailInput.value;
        const verifyBtn = document.getElementById('verifyBtn');

        if (!email) { showAlert('Please enter an email address.', 'danger'); return; }

        verifyBtn.disabled = true;
        verifyBtn.innerHTML = '<span class="spinner-border spinner-border-sm"></span> Verifying...';

        try {
            const response = await fetch("<?php echo e(route('password.check')); ?>", {
                method: 'POST',
                headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': '<?php echo e(csrf_token()); ?>' },
                body: JSON.stringify({ email })
            });
            const data = await response.json();

            if (response.ok) {
                modalAlert.classList.add('d-none');
                emailStep.classList.add('d-none');
                passwordStep.classList.remove('d-none');
            } else {
                showAlert(data.message, 'danger');
            }
        } catch (error) {
            showAlert('Something went wrong. Try again.', 'danger');
        } finally {
            verifyBtn.disabled = false;
            verifyBtn.innerText = 'Verify Email';
        }
    }

    function backToEmail() {
        passwordStep.classList.add('d-none');
        emailStep.classList.remove('d-none');
        modalAlert.classList.add('d-none');
    }

    document.getElementById('resetPasswordForm').addEventListener('submit', async (e) => {
        e.preventDefault();
        const updateBtn = document.getElementById('updateBtn');
        const formData = new FormData(e.target);

        updateBtn.disabled = true;
        updateBtn.innerHTML = '<span class="spinner-border spinner-border-sm"></span> Updating...';

        try {
            const response = await fetch("<?php echo e(route('password.directUpdate')); ?>", {
                method: 'POST',
                headers: { 'X-CSRF-TOKEN': '<?php echo e(csrf_token()); ?>' },
                body: formData
            });
            const data = await response.json();

            if (response.ok) {
                showAlert(data.message, 'success');
                passwordStep.classList.add('d-none');
                setTimeout(() => { window.location.href = "<?php echo e(route('login')); ?>"; }, 2000);
            } else {
                showAlert('Check password requirements or mismatch.', 'danger');
            }
        } catch (error) {
            showAlert('Failed to update password.', 'danger');
        } finally {
            updateBtn.disabled = false;
            updateBtn.innerText = 'Update Password';
        }
    });
</script>

                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\SS TECHNOLOGY BD\Desktop\TaskNext\resources\views/auth/login.blade.php ENDPATH**/ ?>