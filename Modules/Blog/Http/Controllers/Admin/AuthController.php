<?php

namespace Modules\Blog\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function showLogin()
    {
        if (auth()->check() && auth()->user()->role === 'admin') {
            return redirect()->route('blog-admin.dashboard');
        }

        return view('blog::admin.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (auth()->attempt($credentials, $request->boolean('remember'))) {
            if (auth()->user()->role === 'admin') {
                $request->session()->regenerate();

                return redirect()->intended(route('blog-admin.dashboard'));
            }

            auth()->logout();
        }

        return back()->withErrors(['email' => 'Invalid admin credentials']);
    }

    public function logout(Request $request)
    {
        auth()->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('blog-admin.login');
    }
}
