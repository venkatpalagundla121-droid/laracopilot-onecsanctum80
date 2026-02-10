<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AdminAuthController extends Controller
{
    public function showLogin()
    {
        // If already logged in, redirect to dashboard
        if (session('admin_logged_in')) {
            return redirect()->route('admin.dashboard');
        }
        
        return view('admin.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        // Hardcoded credentials for admin and worker roles
        $credentials = [
            'admin@hostel.com' => ['password' => 'admin123', 'role' => 'admin', 'name' => 'Admin User'],
            'superadmin@hostel.com' => ['password' => 'superadmin123', 'role' => 'superadmin', 'name' => 'Super Admin'],
            'worker@hostel.com' => ['password' => 'worker123', 'role' => 'worker', 'name' => 'Worker User']
        ];

        // Check if credentials match
        if (isset($credentials[$request->email]) && 
            $credentials[$request->email]['password'] === $request->password) {
            
            $userRole = $credentials[$request->email]['role'];
            $userName = $credentials[$request->email]['name'];
            
            // Set session data
            session([
                'admin_logged_in' => true,
                'admin_email' => $request->email,
                'admin_name' => $userName,
                'admin_role' => $userRole
            ]);

            // Redirect based on role
            if ($userRole === 'worker') {
                return redirect()->route('worker.dashboard');
            }
            
            return redirect()->route('admin.dashboard');
        }

        // Invalid credentials
        return back()->withErrors([
            'email' => 'Invalid email or password. Please check the credentials displayed on the login page.'
        ])->withInput();
    }

    public function logout()
    {
        session()->flush();
        return redirect()->route('admin.login')->with('success', 'Logged out successfully');
    }
}