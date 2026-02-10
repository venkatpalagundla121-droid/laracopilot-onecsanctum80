<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class WorkerMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        if (!auth()->guard('admin')->check()) {
            return redirect()->route('admin.login');
        }

        $admin = auth()->guard('admin')->user();

        if (!$admin->isWorker()) {
            return redirect()->route('admin.dashboard');
        }

        return $next($request);
    }
}