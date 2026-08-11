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
            'name'         => ['nullable', 'string', 'max:255'],
            'first_name'   => ['nullable', 'string', 'max:255'],
            'last_name'    => ['nullable', 'string', 'max:255'],
            'company_name' => ['nullable', 'string', 'max:255'],
            'phone'        => ['nullable', 'string', 'max:50'],
            'email'        => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password'     => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $firstName = $request->first_name;
        $lastName  = $request->last_name;

        if (!$firstName && $request->name) {
            $parts = explode(' ', trim($request->name), 2);
            $firstName = $parts[0] ?? 'User';
            $lastName  = $parts[1] ?? '';
        }

        $user = User::create([
            'first_name'   => $firstName ?: 'Valued',
            'last_name'    => $lastName ?: 'Client',
            'email'        => $request->email,
            'password'     => Hash::make($request->password),
            'phone'        => $request->phone,
            'company_name' => $request->company_name,
            'role'         => 'client',
            'is_active'    => true,
        ]);

        // Assign Spatie permission role if available
        try {
            if (class_exists(\Spatie\Permission\Models\Role::class)) {
                \Spatie\Permission\Models\Role::firstOrCreate(['name' => 'client', 'guard_name' => 'web']);
                $user->assignRole('client');
            }
        } catch (\Throwable $e) {
            // Role may already be handled via attribute fallback
        }

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
