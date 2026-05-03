<?php
namespace App\Http\Controllers;

use App\Http\Requests\ResetPasswordRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;

class PasswordResetController extends Controller
{
    // ORIGINAL EMAIL RESET (Keep these)
    public function store(Request $request)
    {
        $request->validate(['email' => 'required|email']);

        $status = Password::sendResetLink($request->only('email'));

        return $status === Password::RESET_LINK_SENT
            ? back()->with('status', __($status))
            : back()->withErrors(['email' => __($status)]);
    }

    public function showResetForm(Request $request, $token = null)
    {
        return view('auth.reset-password', ['token' => $token, 'request' => $request]);
    }

    public function reset(Request $request)
    {
        $request->validate([
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:8|confirmed',
        ]);

        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function ($user, $password) {
                $user->forceFill(['password' => Hash::make($password)])->save();
            }
        );

        return $status === Password::PASSWORD_RESET
            ? redirect()->route('login')->with('status', 'Password reset!')
            : back()->withErrors(['email' => [__($status)]]);
    }
public function checkEmail(Request $request)
{
    $request->validate(['email' => 'required|email']);
    $user = User::where('email', $request->email)->first();

    if ($user) {
        return response()->json(['success' => true]);
    }

    return response()->json(['success' => false, 'message' => 'User not found with this email.'], 404);
}

public function directReset(Request $request)
{
    $request->validate([
        'email' => 'required|email|exists:users,email',
        'password' => 'required|min:8|confirmed',
    ]);

    $user = User::where('email', $request->email)->first();
    $user->password = Hash::make($request->password);
    $user->save();

    return response()->json(['success' => true, 'message' => 'Password reset successful! Redirecting...']);
}

public function showResetForm(Request $request, $token = null)
    {
        return view('auth.forget-password', ['token' => $token, 'request' => $request]);
    }

}