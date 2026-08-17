<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Notifications\WelcomeClientNotification;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name'                => ['nullable', 'string', 'max:255'],
            'first_name'          => ['nullable', 'string', 'max:255'],
            'last_name'           => ['nullable', 'string', 'max:255'],
            'company_name'        => ['nullable', 'string', 'max:255'],
            'phone'               => ['nullable', 'string', 'max:50'],
            'assigned_consultant' => ['nullable', 'string'],
            'assigned_admin_id'   => ['nullable', 'integer'],
            'email'               => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password'            => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $firstName = $request->first_name;
        $lastName  = $request->last_name;

        if (!$firstName && $request->name) {
            $parts = explode(' ', trim($request->name), 2);
            $firstName = $parts[0] ?? 'Valued';
            $lastName  = $parts[1] ?? 'Client';
        }

        // Determine assigned consultant / partner
        $consultantId = null;
        if ($request->filled('assigned_consultant')) {
            if ($request->assigned_consultant === 'olubukunola') {
                $consultant = User::where('email', 'olubukunola@yonbustax.ca')->first();
                $consultantId = $consultant?->id;
            } elseif ($request->assigned_consultant === 'adeshola') {
                $consultant = User::where('email', 'like', 'adeshola%')->first();
                $consultantId = $consultant?->id;
            } elseif (is_numeric($request->assigned_consultant)) {
                $consultantId = (int) $request->assigned_consultant;
            }
        } elseif ($request->filled('assigned_admin_id')) {
            $consultantId = (int) $request->assigned_admin_id;
        }

        if (!$consultantId) {
            $olubukunola = User::where('email', 'olubukunola@yonbustax.ca')->first();
            $consultantId = $olubukunola?->id;
        }

        $user = User::create([
            'first_name'        => $firstName ?: 'Valued',
            'last_name'         => $lastName ?: 'Client',
            'email'             => $request->email,
            'password'          => Hash::make($request->password),
            'phone'             => $request->phone,
            'company_name'      => $request->company_name,
            'role'              => 'client',
            'assigned_admin_id' => $consultantId,
            'is_active'         => true,
            'email_verified_at' => now(),
        ]);

        // Create Client profile record
        \App\Models\Client::firstOrCreate(
            ['user_id' => $user->id],
            [
                'assigned_admin_id' => $consultantId,
                'client_number'     => 'CL-' . strtoupper(\Illuminate\Support\Str::random(6)),
                'company_name'      => $request->company_name,
            ]
        );

        // Assign Spatie permission role if available
        try {
            if (class_exists(\Spatie\Permission\Models\Role::class)) {
                \Spatie\Permission\Models\Role::firstOrCreate(['name' => 'client', 'guard_name' => 'web']);
                $user->assignRole('client');
            }
        } catch (\Throwable $e) {
            // Role handled via column fallback
        }

        $consultantUser = User::find($consultantId);
        $consultantName = $consultantUser ? $consultantUser->name : 'Dedicated Partner';

        \App\Services\AuditService::log(
            'client.registered',
            "Client '{$user->name}' registered and assigned to consultant: {$consultantName}",
            'User',
            $user->id
        );

        // Generate OTP and store in session (valid 10 min)
        $otp = (string) random_int(100000, 999999);
        session(['registration_otp' => $otp, 'otp_user_id' => $user->id]);
        cache()->put('otp_' . $user->id, $otp, now()->addMinutes(10));

        // Send welcome email synchronously (no queue needed)
        try {
            $user->notify(new WelcomeClientNotification($otp));
        } catch (\Throwable $e) {
            \Log::error('[YONBUS] Welcome email failed for user ' . $user->id . ': ' . $e->getMessage());
        }

        event(new Registered($user));

        Auth::login($user);

        return redirect(route('dashboard', absolute: false));
    }
}
