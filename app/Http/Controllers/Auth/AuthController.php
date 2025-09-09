<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials, $request->remember)) {
            $user = Auth::user()->name;
            return response()->json(['success' => 'Login successful. Welcome ' . $user]);
        }

        return response()->json(['error' => 'Invalid credentials please enter valid credentials'], 401);
    }

    public function profileUpdate(Request $request)
    {
        $request->validate([
            'fullName' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . Auth::id(),
            'currentPassword' => 'required|string',
            'newPassword' => 'nullable|string|min:8',
            'confirmPassword' => 'nullable|string|same:newPassword',
            'avatar' => 'nullable|image|mimes:jpg,jpeg,png|max:5120',
        ], [
            'confirmPassword.same' => 'The new password and confirm password must match.',
            'avatar.max' => 'The avatar must not be greater than 2MB.',
            'avatar.mimes' => 'The avatar must be a file of type: jpg, jpeg, png.',
            'email.unique' => 'The email has already been taken by another user.',
            'fullName.required' => 'The full name field is required.',
            'email.required' => 'The email field is required.',
            'currentPassword.required' => 'The current password field is required.',
            'newPassword.min' => 'The new password must be at least 8 characters.',
        ]);

        $user = Auth::user();

        if (!Hash::check($request->currentPassword, $user->password)) {
            return response()->json(['message' => 'Current password is incorrect.'], 400);
        }

        $user->name = $request->fullName;
        $user->email = $request->email;

        if ($request->filled('newPassword')) {
            $user->password = Hash::make($request->newPassword);
        }

        if ($request->hasFile('avatar')) {

            // Delete old avatar if exists
            if ($user->avatar && file_exists(public_path($user->avatar))) {
                unlink(public_path($user->avatar));
            }


            $avatarName = time() . '.' . $request->avatar->extension();
            $request->avatar->move(public_path('uploads/avatars'), $avatarName);
            $user->avatar = 'uploads/avatars/' . $avatarName;
        }

        $user->save();

        return response()->json(['success' => 'Profile updated successfully.']);
    }


    public function logout(Request $request)
    {
        Auth::logout();
        return redirect('/admin/login')->with('success', 'Logout Successfully..');
    }
}
