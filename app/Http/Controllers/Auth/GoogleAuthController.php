<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Notifications\WelcomeClientNotification;
use GuzzleHttp\Client as GuzzleClient;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;
use Throwable;

class GoogleAuthController extends Controller
{
    /**
     * Redirect the user to the Google OAuth page.
     */
    public function redirect(): RedirectResponse
    {
        try {
            if (!class_exists(\Laravel\Socialite\Facades\Socialite::class)) {
                return redirect()->route('login')
                    ->withErrors(['email' => 'Google authentication is currently being configured on the server. Please sign in with your email and password.']);
            }

            return Socialite::driver('google')
                ->scopes(['openid', 'profile', 'email'])
                ->redirect();
        } catch (Throwable $e) {
            \Log::error('[Google OAuth] Redirect error: ' . $e->getMessage());
            return redirect()->route('login')
                ->withErrors(['email' => 'Google sign-in is temporarily unavailable: ' . $e->getMessage()]);
        }
    }

    /**
     * Handle the callback from Google.
     */
    public function callback(): RedirectResponse
    {
        try {
            // Inject a Guzzle client with the CA bundle so SSL works on Windows
            $guzzle = new GuzzleClient($this->guzzleOptions());

            $googleUser = Socialite::driver('google')
                ->setHttpClient($guzzle)
                ->user();

        } catch (Throwable $e) {
            \Log::error('[Google OAuth] Callback error: ' . $e->getMessage());
            return redirect()->route('login')
                ->withErrors(['email' => 'Google sign-in failed (' . class_basename($e) . '). Please try again.']);
        }

        // Parse name from Google profile
        $nameParts = explode(' ', trim($googleUser->getName() ?? ''), 2);
        $firstName = $nameParts[0] ?? 'Google';
        $lastName  = $nameParts[1] ?? 'User';

        // Find existing user by google_id or email
        $user = User::where('google_id', $googleUser->getId())->first()
            ?? User::where('email', $googleUser->getEmail())->first();

        if ($user) {
            // Update google_id / avatar and mark email verified if missing
            $updates = [];
            if (!$user->google_id) {
                $updates['google_id']     = $googleUser->getId();
                $updates['google_avatar'] = $googleUser->getAvatar();
            }
            if (!$user->email_verified_at) {
                $updates['email_verified_at'] = now();
            }
            if (!empty($updates)) {
                $user->forceFill($updates)->save();
            }
        } else {
            // Create a brand new client account
            $user = User::create([
                'first_name'        => $firstName,
                'last_name'         => $lastName,
                'email'             => $googleUser->getEmail(),
                'google_id'         => $googleUser->getId(),
                'google_avatar'     => $googleUser->getAvatar(),
                'password'          => \Illuminate\Support\Facades\Hash::make(\Illuminate\Support\Str::random(32)),
                'role'              => 'client',
                'is_active'         => true,
                'email_verified_at' => now(),
            ]);

            // Assign Spatie permission role
            try {
                \Spatie\Permission\Models\Role::firstOrCreate(['name' => 'client', 'guard_name' => 'web']);
                $user->assignRole('client');
            } catch (Throwable $e) {
                // role already set via attribute
            }

            // Send welcome email (non-blocking)
            try {
                $user->notify(new WelcomeClientNotification(null));
            } catch (Throwable $e) {
                \Log::warning('[Google OAuth] Welcome email failed: ' . $e->getMessage());
            }

            event(new Registered($user));
        }

        // Log the user in
        Auth::login($user, remember: true);

        // Log activity (non-critical)
        try {
            \App\Models\ActivityLog::log('google_login', 'User signed in via Google OAuth', $user, $user->id);
        } catch (Throwable $e) {
            //
        }

        return redirect()->intended($this->dashboardRouteFor($user));
    }

    /**
     * Guzzle HTTP options with SSL CA bundle for Windows compatibility.
     */
    private function guzzleOptions(): array
    {
        // Try several known CA cert locations
        $candidates = [
            'C:/cacert.pem',
            'C:/Windows/System32/cacert.pem',
            base_path('cacert.pem'),
            // PHP bundled cert (if exists)
            dirname(PHP_BINARY) . '/extras/ssl/cacert.pem',
            dirname(PHP_BINARY) . '/cacert.pem',
        ];

        foreach ($candidates as $path) {
            if (file_exists($path)) {
                return ['verify' => $path];
            }
        }

        // Fallback: disable verification only in local dev (never in production)
        return ['verify' => app()->environment('production')];
    }

    /**
     * Determine the correct dashboard URL for the authenticated user.
     */
    private function dashboardRouteFor(User $user): string
    {
        $role = $user->role;
        return match (true) {
            in_array($role, ['admin', 'superadmin', 'subadmin']) => route('admin.dashboard'),
            $role === 'accountant'                               => route('accountant.dashboard'),
            default                                              => route('client.dashboard'),
        };
    }
}
