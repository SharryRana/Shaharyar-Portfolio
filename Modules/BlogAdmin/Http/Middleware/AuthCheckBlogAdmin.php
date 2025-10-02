<?php

namespace Modules\BlogAdmin\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class AuthCheckBlogAdmin
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next)
    {
        if (Auth::guard('admin')->check()) {
            return redirect('admin-dash');
        } else {
            return redirect('blog-login')->with('error', 'You are not allowed to access');
        }
        return $next($request);
    }
}
