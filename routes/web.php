<?php
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TodoController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
        Route::get('/todos/stats', [TodoController::class, 'stats'])->name('todos.stats');

    Route::resource('todos', TodoController::class);

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Forgot Password Routes
Route::middleware('guest')->group(function () {
    Route::get('forgot-password', [PasswordResetController::class, 'showResetForm'])->name('password.request');
    Route::post('forgot-password', [PasswordResetController::class, 'store'])->name('password.email');
    Route::get('reset-password/{token}', [PasswordResetController::class, 'showResetForm'])->name('password.reset');
    Route::post('reset-password', [PasswordResetController::class, 'reset'])->name('password.store');
    Route::post('/check-email', [PasswordResetController::class, 'checkEmail'])->name('password.check');
    Route::post('/direct-reset', [PasswordResetController::class, 'directReset'])->name('password.directUpdate');
});

require __DIR__.'/auth.php';
