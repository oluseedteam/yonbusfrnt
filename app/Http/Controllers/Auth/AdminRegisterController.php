<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Services\AuditService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

class AdminRegisterController extends Controller
{
    public function create()
    {
        $adminCount = User::roleSafe(['admin', 'superadmin', 'subadmin'])->count();

        // If admins exist and user is not logged in as admin, redirect to admin login
        if ($adminCount > 0 && (!Auth::check() || !Auth::user()->isAdmin())) {
            return redirect()->route('admin.login')->with('error', 'Administrator setup completed. Please log in.');
        }

        return view('auth.admin-register', compact('adminCount'));
    }

    public function store(Request $request)
    {
        $adminCount = User::roleSafe(['admin', 'superadmin', 'subadmin'])->count();

        // If admins exist and user is not logged in as admin, block registration
        if ($adminCount > 0 && (!Auth::check() || !Auth::user()->isAdmin())) {
            return redirect()->route('admin.login')->with('error', 'Unauthorized attempt to register administrator account.');
        }

        $request->validate([
            'first_name' => ['required', 'string', 'max:255'],
            'last_name'  => ['required', 'string', 'max:255'],
            'email'      => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password'   => ['required', 'confirmed', Rules\Password::defaults()],
            'phone'      => ['nullable', 'string', 'max:20'],
        ]);

        $user = User::create([
            'first_name' => $request->first_name,
            'last_name'  => $request->last_name,
            'email'      => $request->email,
            'password'   => Hash::make($request->password),
            'role'       => 'admin',
            'phone'      => $request->phone,
            'is_active'  => true,
        ]);

        // Assign Spatie role if exists
        try {
            $user->assignRole('admin');
        } catch (\Throwable $e) {
            // Role assignment fallback
        }

        AuditService::log('admin.registered', "Registered admin user: {$user->email}", 'User', $user->id);

        Auth::login($user);

        return redirect()->route('admin.dashboard')->with('message', 'Initial Administrator account registered successfully!');
    }
}
