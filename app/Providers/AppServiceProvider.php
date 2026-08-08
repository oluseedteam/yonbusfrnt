<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use App\Contracts\RepositoryInterface;
use App\Repositories\UserRepository;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        // Repository bindings
        $this->app->bind(\App\Contracts\RepositoryInterface::class, UserRepository::class);
        $this->app->bind('user.repository',        \App\Repositories\UserRepository::class);
        $this->app->bind('appointment.repository', \App\Repositories\AppointmentRepository::class);
        $this->app->bind('client.repository',      \App\Repositories\ClientRepository::class);
    }

    public function boot(): void
    {
        // API rate limiting
        RateLimiter::for('api', function (Request $request) {
            return Limit::perMinute(60)->by($request->user()?->id ?: $request->ip());
        });

        // Register policies
        \Illuminate\Support\Facades\Gate::policy(\App\Models\Appointment::class, \App\Policies\AppointmentPolicy::class);
        \Illuminate\Support\Facades\Gate::policy(\App\Models\Document::class,    \App\Policies\DocumentPolicy::class);
        \Illuminate\Support\Facades\Gate::policy(\App\Models\Client::class,      \App\Policies\ClientPolicy::class);
        \Illuminate\Support\Facades\Gate::policy(\App\Models\User::class,        \App\Policies\UserPolicy::class);

        // Auto-seed default Spatie roles on production if missing
        try {
            if (\Schema::hasTable('roles')) {
                foreach (['admin', 'superadmin', 'subadmin', 'accountant', 'client'] as $roleName) {
                    \Spatie\Permission\Models\Role::firstOrCreate(['name' => $roleName, 'guard_name' => 'web']);
                }
            }
        } catch (\Throwable $e) {
            // Database not yet migrated or ready
        }
    }
}
