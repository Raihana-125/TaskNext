<?php
namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class ProfileController extends Controller
{
    /**
     * Display profile form
     */
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update profile
     */
 public function update(ProfileUpdateRequest $request): RedirectResponse
{
    $user = $request->user();

    // Update name and email always
    $user->name = $request->name;
    $user->email = $request->email;

    // Update password ONLY if provided
    if ($request->filled('password')) {
        $user->password = Hash::make($request->password);
    }

    $user->save();

    return Redirect::route('profile.edit')->with('success', 'Profile updated successfully!');
}

    /**
     * Delete user account
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validate([
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->todos()->delete(); // Delete todos
        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}