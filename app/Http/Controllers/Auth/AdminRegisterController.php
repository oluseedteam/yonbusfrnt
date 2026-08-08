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
        // If user is already logged in as admin, redirect to admin dashboard
        if (Auth::check() && in_array(Auth::user()->role, ['admin', 'superadmin', 'subadmin'])) {
            return redirect()->route('admin.dashboard');
        }

        $adminCount = User::whereIn('role', ['admin', 'superadmin', 'subadmin'])->count();

        return view('auth.admin-register', compact('adminCount'));
    }

    public function store(Request $request)
    {
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
