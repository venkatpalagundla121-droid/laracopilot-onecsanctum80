<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class AdminMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        if (!auth()->guard('admin')->check()) {
            return redirect()->route('admin.login');
        }

        $admin = auth()->guard('admin')->user();

        if (!$admin->is_active) {
            auth()->guard('admin')->logout();
            return redirect()->route('admin.login')->withErrors(['email' => 'Your account has been deactivated.']);
        }

        return $next($request);
    }
}