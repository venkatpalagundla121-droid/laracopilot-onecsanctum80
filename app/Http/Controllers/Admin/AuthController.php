<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function showLogin()
    {
        if (auth()->guard('admin')->check()) {
            return $this->redirectBasedOnRole();
        }
        
        return view('admin.auth.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        $admin = Admin::where('email', $request->email)
            ->where('is_active', true)
            ->with('role')
            ->first();

        if ($admin && Hash::check($request->password, $admin->password)) {
            auth()->guard('admin')->login($admin, $request->filled('remember'));
            
            $admin->update(['last_login_at' => now()]);
            
            return $this->redirectBasedOnRole();
        }

        return back()->withErrors([
            'email' => 'Invalid credentials or account is inactive.'
        ])->withInput();
    }

    public function logout()
    {
        auth()->guard('admin')->logout();
        return redirect()->route('admin.login')->with('success', 'Logged out successfully');
    }

    private function redirectBasedOnRole()
    {
        $admin = auth()->guard('admin')->user();
        
        if ($admin->isWorker()) {
            return redirect()->route('worker.dashboard');
        }
        
        return redirect()->route('admin.dashboard');
    }
}